<?php

declare(strict_types=1);

namespace Grav\Theme\Editorial\Tests;

use Grav\Plugin\Shortcodes\BoxShortcode;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Tests for BoxShortcode::buildBoxHtml()
 *
 * The HTML generation is exercised via the protected helper method
 * introduced to make the logic independently testable.
 */
class BoxShortcodeTest extends TestCase
{
    private BoxShortcode $shortcode;
    private \ReflectionMethod $method;

    protected function setUp(): void
    {
        // BoxShortcode extends the stub Shortcode base; no constructor args needed.
        $this->shortcode = new class extends BoxShortcode {};

        $rc = new ReflectionClass($this->shortcode);
        $this->method = $rc->getMethod('buildBoxHtml');
        $this->method->setAccessible(true);
    }

    private function buildBoxHtml(?string $heading, ?string $class, ?string $color, ?string $content): string
    {
        return $this->method->invoke($this->shortcode, $heading, $class, $color, $content);
    }

    // -----------------------------------------------------------------------
    // Heading presence / absence
    // -----------------------------------------------------------------------

    public function testWithHeadingRendersH3(): void
    {
        $html = $this->buildBoxHtml('My Title', '', '', 'Content');
        $this->assertStringContainsString('<h3>My Title</h3>', $html);
    }

    public function testWithoutHeadingOmitsH3(): void
    {
        $html = $this->buildBoxHtml(null, '', '', 'Content');
        $this->assertStringNotContainsString('<h3>', $html);
    }

    public function testEmptyHeadingOmitsH3(): void
    {
        $html = $this->buildBoxHtml('', '', '', 'Content');
        $this->assertStringNotContainsString('<h3>', $html);
    }

    // -----------------------------------------------------------------------
    // Box div structure
    // -----------------------------------------------------------------------

    public function testBoxDivAlwaysPresent(): void
    {
        $html = $this->buildBoxHtml(null, '', '', '');
        $this->assertMatchesRegularExpression('/<div class="box/', $html);
        $this->assertStringContainsString('</div>', $html);
    }

    public function testContentInsideBoxDiv(): void
    {
        $html = $this->buildBoxHtml(null, '', '', 'Inner text');
        $this->assertStringContainsString('Inner text', $html);
    }

    // -----------------------------------------------------------------------
    // CSS classes
    // -----------------------------------------------------------------------

    public function testClassAppliedToBoxDiv(): void
    {
        $html = $this->buildBoxHtml(null, 'alt', '', '');
        $this->assertStringContainsString('alt', $html);
    }

    public function testColorAppliedToBoxDiv(): void
    {
        $html = $this->buildBoxHtml(null, '', 'special', '');
        $this->assertStringContainsString('special', $html);
    }

    public function testClassAndColorBothIncluded(): void
    {
        $html = $this->buildBoxHtml(null, 'alt', 'special', '');
        $this->assertStringContainsString('alt', $html);
        $this->assertStringContainsString('special', $html);
    }

    public function testBaseBoxClassAlwaysPresent(): void
    {
        $html = $this->buildBoxHtml(null, 'alt', 'special', '');
        $this->assertMatchesRegularExpression('/class="box\s/', $html);
    }

    // -----------------------------------------------------------------------
    // Order of elements
    // -----------------------------------------------------------------------

    public function testHeadingAppearsBeforeBoxDiv(): void
    {
        $html = $this->buildBoxHtml('Title', '', '', 'Body');
        $this->assertLessThan(strpos($html, '<div'), strpos($html, '<h3>'));
    }

    // -----------------------------------------------------------------------
    // HTML content passthrough
    // -----------------------------------------------------------------------

    public function testHtmlContentIsNotEscaped(): void
    {
        $html = $this->buildBoxHtml(null, '', '', '<em>emphasis</em>');
        $this->assertStringContainsString('<em>emphasis</em>', $html);
    }

    public function testNullContentProducesEmptyBody(): void
    {
        $html = $this->buildBoxHtml(null, '', '', null);
        // Should not throw; box div still rendered
        $this->assertMatchesRegularExpression('/<div class="box/', $html);
    }
}
