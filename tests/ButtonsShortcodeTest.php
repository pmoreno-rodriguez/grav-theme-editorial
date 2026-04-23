<?php

declare(strict_types=1);

namespace Grav\Theme\Editorial\Tests;

use Grav\Plugin\Shortcodes\ButtonsShortcode;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Tests for ButtonsShortcode
 *
 * Covers:
 *  - parseContent()       – parses [ed-button …]…[/ed-button] tags
 *  - parseButtonParams()  – parses key=value attribute strings
 *  - buildButtonsHtml()   – generates the final <ul>/<li> markup
 */
class ButtonsShortcodeTest extends TestCase
{
    private ButtonsShortcode $shortcode;
    private ReflectionClass $rc;

    protected function setUp(): void
    {
        $this->shortcode = new class extends ButtonsShortcode {};
        $this->rc = new ReflectionClass($this->shortcode);
    }

    // -----------------------------------------------------------------------
    // Helpers
    // -----------------------------------------------------------------------

    private function parseContent(string $content): array
    {
        $m = $this->rc->getMethod('parseContent');
        $m->setAccessible(true);
        return $m->invoke($this->shortcode, $content);
    }

    private function parseButtonParams(string $params): array
    {
        $m = $this->rc->getMethod('parseButtonParams');
        $m->setAccessible(true);
        return $m->invoke($this->shortcode, $params);
    }

    private function buildButtonsHtml(array $buttons, ?string $ulclass): string
    {
        $m = $this->rc->getMethod('buildButtonsHtml');
        $m->setAccessible(true);
        return $m->invoke($this->shortcode, $buttons, $ulclass);
    }

    // -----------------------------------------------------------------------
    // parseButtonParams – attribute string parsing
    // -----------------------------------------------------------------------

    public function testParseButtonParamsEmptyStringReturnsEmptyArray(): void
    {
        $this->assertSame([], $this->parseButtonParams(''));
    }

    public function testParseButtonParamsDoubleQuotedValue(): void
    {
        $params = $this->parseButtonParams(' url="https://example.com"');
        $this->assertSame('https://example.com', $params['url']);
    }

    public function testParseButtonParamsSingleQuotedValue(): void
    {
        $params = $this->parseButtonParams(" url='https://example.com'");
        $this->assertSame('https://example.com', $params['url']);
    }

    public function testParseButtonParamsUnquotedValue(): void
    {
        $params = $this->parseButtonParams(' type=primary');
        $this->assertSame('primary', $params['type']);
    }

    public function testParseButtonParamsMultipleAttributes(): void
    {
        $params = $this->parseButtonParams(' url="https://example.com" type="primary" size="large"');
        $this->assertSame('https://example.com', $params['url']);
        $this->assertSame('primary', $params['type']);
        $this->assertSame('large', $params['size']);
    }

    public function testParseButtonParamsReturnsMixedQuoteStyles(): void
    {
        $params = $this->parseButtonParams(" url='https://example.com' type=\"primary\"");
        $this->assertSame('https://example.com', $params['url']);
        $this->assertSame('primary', $params['type']);
    }

    public function testParseButtonParamsNonStringReturnsEmptyArray(): void
    {
        // The method guards on is_string(); passing non-string should return [].
        $m = $this->rc->getMethod('parseButtonParams');
        $m->setAccessible(true);
        $result = $m->invoke($this->shortcode, null);
        $this->assertSame([], $result);
    }

    // -----------------------------------------------------------------------
    // parseContent – [ed-button …] tag parsing
    // -----------------------------------------------------------------------

    public function testParseContentEmptyStringReturnsEmptyArray(): void
    {
        $this->assertSame([], $this->parseContent(''));
    }

    public function testParseContentNoButtonTagsReturnsEmptyArray(): void
    {
        $this->assertSame([], $this->parseContent('Some random text without shortcodes'));
    }

    public function testParseContentSingleButton(): void
    {
        $content = '[ed-button url="https://example.com"]Click me[/ed-button]';
        $buttons = $this->parseContent($content);
        $this->assertCount(1, $buttons);
        $this->assertSame('Click me', $buttons[0]['content']);
        $this->assertSame('https://example.com', $buttons[0]['url']);
    }

    public function testParseContentMultipleButtons(): void
    {
        $content = '[ed-button url="/page1"]First[/ed-button][ed-button url="/page2"]Second[/ed-button]';
        $buttons = $this->parseContent($content);
        $this->assertCount(2, $buttons);
        $this->assertSame('First', $buttons[0]['content']);
        $this->assertSame('Second', $buttons[1]['content']);
    }

    public function testParseContentPreservesAllParams(): void
    {
        $content = '[ed-button url="/go" type="primary" size="large" class="icon" target="_blank"]Go[/ed-button]';
        $buttons = $this->parseContent($content);
        $this->assertCount(1, $buttons);
        $btn = $buttons[0];
        $this->assertSame('/go', $btn['url']);
        $this->assertSame('primary', $btn['type']);
        $this->assertSame('large', $btn['size']);
        $this->assertSame('icon', $btn['class']);
        $this->assertSame('_blank', $btn['target']);
        $this->assertSame('Go', $btn['content']);
    }

    public function testParseContentButtonWithNoAttributes(): void
    {
        $content = '[ed-button]Label[/ed-button]';
        $buttons = $this->parseContent($content);
        $this->assertCount(1, $buttons);
        $this->assertSame('Label', $buttons[0]['content']);
    }

    public function testParseContentMultilineButtonContent(): void
    {
        $content = "[ed-button url=\"/x\"]\nMulti\nLine\n[/ed-button]";
        $buttons = $this->parseContent($content);
        $this->assertCount(1, $buttons);
        $this->assertStringContainsString('Multi', $buttons[0]['content']);
    }

    // -----------------------------------------------------------------------
    // buildButtonsHtml – HTML generation
    // -----------------------------------------------------------------------

    public function testBuildButtonsHtmlEmptyButtonsRendersEmptyList(): void
    {
        $html = $this->buildButtonsHtml([], null);
        $this->assertStringContainsString('<ul class="actions ', $html);
        $this->assertStringContainsString('</ul>', $html);
        $this->assertStringNotContainsString('<li>', $html);
    }

    public function testBuildButtonsHtmlAppliesUlClass(): void
    {
        $html = $this->buildButtonsHtml([], 'stacked');
        $this->assertStringContainsString('stacked', $html);
    }

    public function testBuildButtonsHtmlSingleButtonRendersAnchor(): void
    {
        $buttons = [['content' => 'Click', 'url' => '/page', 'type' => 'primary', 'size' => 'large', 'class' => '', 'target' => '_self']];
        $html = $this->buildButtonsHtml($buttons, '');
        $this->assertStringContainsString('<a ', $html);
        $this->assertStringContainsString('href="/page"', $html);
        $this->assertStringContainsString('Click', $html);
    }

    public function testBuildButtonsHtmlDefaultValues(): void
    {
        // No type/size/class/target/url provided → defaults used
        $buttons = [['content' => 'Go']];
        $html = $this->buildButtonsHtml($buttons, '');
        $this->assertStringContainsString('href="#"', $html);
        $this->assertStringContainsString('target="_self"', $html);
        $this->assertStringContainsString('default', $html);
    }

    public function testBuildButtonsHtmlDefaultContentFallback(): void
    {
        // No 'content' key → falls back to 'Button'
        $buttons = [[]];
        $html = $this->buildButtonsHtml($buttons, '');
        $this->assertStringContainsString('Button', $html);
    }

    public function testBuildButtonsHtmlMultipleButtonsMultipleLiTags(): void
    {
        $buttons = [
            ['content' => 'One', 'url' => '/one'],
            ['content' => 'Two', 'url' => '/two'],
        ];
        $html = $this->buildButtonsHtml($buttons, '');
        $this->assertSame(2, substr_count($html, '<li>'));
    }

    public function testBuildButtonsHtmlTargetBlank(): void
    {
        $buttons = [['content' => 'Ext', 'url' => 'https://ext.com', 'target' => '_blank']];
        $html = $this->buildButtonsHtml($buttons, '');
        $this->assertStringContainsString('target="_blank"', $html);
    }

    public function testBuildButtonsHtmlButtonClassComposed(): void
    {
        $buttons = [['type' => 'primary', 'size' => 'large', 'class' => 'icon solid fa-download']];
        $html = $this->buildButtonsHtml($buttons, '');
        $this->assertStringContainsString('button', $html);
        $this->assertStringContainsString('primary', $html);
        $this->assertStringContainsString('large', $html);
        $this->assertStringContainsString('icon solid fa-download', $html);
    }
}
