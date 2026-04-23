<?php

declare(strict_types=1);

namespace Grav\Theme\Editorial\Tests;

use Grav\Theme\Editorial\WordCountTwigExtension;
use PHPUnit\Framework\TestCase;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Tests for WordCountTwigExtension
 *
 * Covers the wordCountFilter() method for all supported locales,
 * as well as the Twig filter/function registration.
 */
class WordCountTwigExtensionTest extends TestCase
{
    private WordCountTwigExtension $extension;

    protected function setUp(): void
    {
        $this->extension = new WordCountTwigExtension();
    }

    // -----------------------------------------------------------------------
    // Registration / metadata
    // -----------------------------------------------------------------------

    public function testGetNameReturnsCorrectName(): void
    {
        $this->assertSame('wordcount', $this->extension->getName());
    }

    public function testGetFiltersReturnsTwigFilter(): void
    {
        $filters = $this->extension->getFilters();
        $this->assertCount(1, $filters);
        $this->assertInstanceOf(TwigFilter::class, $filters[0]);
    }

    public function testFilterIsNamedWordcount(): void
    {
        $filters = $this->extension->getFilters();
        $this->assertSame('wordcount', $filters[0]->getName());
    }

    public function testGetFunctionsReturnsTwigFunction(): void
    {
        $functions = $this->extension->getFunctions();
        $this->assertCount(1, $functions);
        $this->assertInstanceOf(TwigFunction::class, $functions[0]);
    }

    public function testFunctionIsNamedWordCount(): void
    {
        $functions = $this->extension->getFunctions();
        $this->assertSame('word_count', $functions[0]->getName());
    }

    // -----------------------------------------------------------------------
    // Empty / falsy input
    // -----------------------------------------------------------------------

    public function testEmptyStringReturnsZero(): void
    {
        $this->assertSame(0, $this->extension->wordCountFilter(''));
    }

    public function testNullReturnsZero(): void
    {
        $this->assertSame(0, $this->extension->wordCountFilter(null));
    }

    public function testWhitespaceOnlyReturnsZero(): void
    {
        $this->assertSame(0, $this->extension->wordCountFilter('   '));
    }

    public function testHtmlTagsOnlyReturnsZero(): void
    {
        $this->assertSame(0, $this->extension->wordCountFilter('<p></p><br/>'));
    }

    public function testPunctuationOnlyReturnsZero(): void
    {
        $this->assertSame(0, $this->extension->wordCountFilter('... --- !!!'));
    }

    // -----------------------------------------------------------------------
    // Default (English / western) locale
    // -----------------------------------------------------------------------

    public function testSingleWord(): void
    {
        $this->assertSame(1, $this->extension->wordCountFilter('Hello'));
    }

    public function testMultipleWords(): void
    {
        $this->assertSame(5, $this->extension->wordCountFilter('The quick brown fox jumps'));
    }

    public function testExtraWhitespaceIsNormalised(): void
    {
        $this->assertSame(3, $this->extension->wordCountFilter('  one   two   three  '));
    }

    public function testHtmlTagsAreStripped(): void
    {
        $this->assertSame(3, $this->extension->wordCountFilter('<p>Hello <strong>World</strong> today</p>'));
    }

    public function testHtmlEntitiesAreDecoded(): void
    {
        // &amp; decodes to "&" which is punctuation → not counted as a word
        $this->assertSame(2, $this->extension->wordCountFilter('Hello &amp; World'));
    }

    public function testContractionsCounted(): void
    {
        // "it's" and "don't" each count as one word
        $this->assertSame(2, $this->extension->wordCountFilter("it's don't"));
    }

    public function testHyphenatedWordCountedAsOne(): void
    {
        $this->assertSame(1, $this->extension->wordCountFilter('well-known'));
    }

    public function testNumbersCountedAsWords(): void
    {
        $this->assertSame(3, $this->extension->wordCountFilter('2 plus 2'));
    }

    public function testMixedContentWithHtmlAndText(): void
    {
        $html = '<h1>Title</h1><p>This is a <em>test</em> sentence.</p>';
        $this->assertSame(5, $this->extension->wordCountFilter($html));
    }

    public function testDefaultLocaleIsEnglish(): void
    {
        // Calling without locale should produce the same result as locale='en'
        $text = 'one two three';
        $this->assertSame(
            $this->extension->wordCountFilter($text, 'en'),
            $this->extension->wordCountFilter($text)
        );
    }

    // -----------------------------------------------------------------------
    // Chinese locale
    // -----------------------------------------------------------------------

    public function testChineseLocaleZh(): void
    {
        // 4 Chinese characters
        $this->assertSame(4, $this->extension->wordCountFilter('你好世界', 'zh'));
    }

    public function testChineseLocaleZhCn(): void
    {
        $this->assertSame(4, $this->extension->wordCountFilter('你好世界', 'zh-cn'));
    }

    public function testChineseLocaleZhTw(): void
    {
        $this->assertSame(4, $this->extension->wordCountFilter('你好世界', 'zh-tw'));
    }

    public function testChineseLocaleChinese(): void
    {
        $this->assertSame(4, $this->extension->wordCountFilter('你好世界', 'chinese'));
    }

    public function testChineseLocaleExcludesPunctuation(): void
    {
        // 4 characters + 1 Chinese comma → 4 counted characters
        $this->assertSame(4, $this->extension->wordCountFilter('你好，世界', 'zh'));
    }

    public function testChineseLocaleWithHtmlStripped(): void
    {
        $this->assertSame(2, $this->extension->wordCountFilter('<p>你好</p>', 'zh'));
    }

    public function testChineseLocaleEmptyReturnsZero(): void
    {
        $this->assertSame(0, $this->extension->wordCountFilter('', 'zh'));
    }

    // -----------------------------------------------------------------------
    // Japanese locale
    // -----------------------------------------------------------------------

    public function testJapaneseLocaleJa(): void
    {
        // 5 Hiragana characters: こ, ん, に, ち, は
        $this->assertSame(5, $this->extension->wordCountFilter('こんにちは', 'ja'));
    }

    public function testJapaneseLocaleJapanese(): void
    {
        $this->assertSame(5, $this->extension->wordCountFilter('こんにちは', 'japanese'));
    }

    public function testJapaneseLocaleExcludesSpaces(): void
    {
        // "こんにちは 世界" – 5 + 2 chars (space excluded) = 7 counted
        $this->assertSame(7, $this->extension->wordCountFilter('こんにちは 世界', 'ja'));
    }

    public function testJapaneseLocaleEmptyReturnsZero(): void
    {
        $this->assertSame(0, $this->extension->wordCountFilter('', 'ja'));
    }

    // -----------------------------------------------------------------------
    // Korean locale
    // -----------------------------------------------------------------------

    public function testKoreanLocaleKo(): void
    {
        $this->assertSame(4, $this->extension->wordCountFilter('안녕하세', 'ko'));
    }

    public function testKoreanLocaleKorean(): void
    {
        $this->assertSame(4, $this->extension->wordCountFilter('안녕하세', 'korean'));
    }

    public function testKoreanLocaleExcludesSpaces(): void
    {
        // "안녕 세계" – 4 chars + 1 space → 4 counted
        $this->assertSame(4, $this->extension->wordCountFilter('안녕 세계', 'ko'));
    }

    public function testKoreanLocaleEmptyReturnsZero(): void
    {
        $this->assertSame(0, $this->extension->wordCountFilter('', 'ko'));
    }

    // -----------------------------------------------------------------------
    // Case-insensitive locale matching
    // -----------------------------------------------------------------------

    public function testLocaleIsCaseInsensitive(): void
    {
        $text = 'Hello World';
        $this->assertSame(
            $this->extension->wordCountFilter($text, 'EN'),
            $this->extension->wordCountFilter($text, 'en')
        );
    }

    // -----------------------------------------------------------------------
    // Unknown / fallback locale
    // -----------------------------------------------------------------------

    public function testUnknownLocaleUsesWesternWordCount(): void
    {
        $this->assertSame(3, $this->extension->wordCountFilter('one two three', 'xx'));
    }
}
