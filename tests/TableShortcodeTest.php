<?php

declare(strict_types=1);

namespace Grav\Theme\Editorial\Tests;

use Grav\Plugin\Shortcodes\TableShortcode;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Tests for TableShortcode::buildTableHtml()
 *
 * The table-building logic is exercised through the protected helper
 * method extracted to allow unit testing without a Grav environment.
 *
 * Content format (pipe-delimited, matches Markdown table style):
 *   Line 0 – ignored preamble / separator
 *   Line 1 – header cells:  | Col1 | Col2 |
 *   Line 2+ – body rows:    | val1 | val2 |
 */
class TableShortcodeTest extends TestCase
{
    private TableShortcode $shortcode;
    private \ReflectionMethod $method;

    protected function setUp(): void
    {
        $this->shortcode = new class extends TableShortcode {};
        $rc = new ReflectionClass($this->shortcode);
        $this->method = $rc->getMethod('buildTableHtml');
        $this->method->setAccessible(true);
    }

    private function buildTableHtml(string $class, $header, string $content): string
    {
        return $this->method->invoke($this->shortcode, $class, $header, $content);
    }

    // Helper: build a valid table content block
    private function tableContent(array $headerCols, array $rows): string
    {
        $lines = [''];  // Line 0: ignored preamble
        $lines[] = '| ' . implode(' | ', $headerCols) . ' |';
        foreach ($rows as $row) {
            $lines[] = '| ' . implode(' | ', $row) . ' |';
        }
        return implode("\n", $lines);
    }

    // -----------------------------------------------------------------------
    // Table element wrapping
    // -----------------------------------------------------------------------

    public function testOutputWrappedInTableTag(): void
    {
        $html = $this->buildTableHtml('', true, $this->tableContent(['A'], [['1']]));
        $this->assertStringContainsString('<table', $html);
        $this->assertStringContainsString('</table>', $html);
    }

    public function testClassAppliedToTableTag(): void
    {
        $html = $this->buildTableHtml('striped', true, $this->tableContent(['A'], [['1']]));
        $this->assertStringContainsString('class="striped"', $html);
    }

    public function testEmptyClassProducesEmptyClassAttribute(): void
    {
        $html = $this->buildTableHtml('', true, $this->tableContent(['A'], [['1']]));
        $this->assertStringContainsString('class=""', $html);
    }

    // -----------------------------------------------------------------------
    // Header rendering
    // -----------------------------------------------------------------------

    public function testHeaderTrueRendersTheadAndTh(): void
    {
        $html = $this->buildTableHtml('', true, $this->tableContent(['Name', 'Age'], [['Alice', '30']]));
        $this->assertStringContainsString('<thead>', $html);
        $this->assertStringContainsString('<th>', $html);
        $this->assertStringContainsString('</thead>', $html);
    }

    public function testHeaderColumnsRenderedCorrectly(): void
    {
        $html = $this->buildTableHtml('', true, $this->tableContent(['Name', 'City'], [['Bob', 'Paris']]));
        $this->assertStringContainsString('<th>', $html);
        $this->assertStringContainsString('Name', $html);
        $this->assertStringContainsString('City', $html);
    }

    public function testHeaderFalseOmitsTheadAndTh(): void
    {
        $html = $this->buildTableHtml('', false, $this->tableContent(['Name', 'Age'], [['Alice', '30']]));
        $this->assertStringNotContainsString('<thead>', $html);
        $this->assertStringNotContainsString('<th>', $html);
    }

    public function testHeaderFalseStillRendersTbody(): void
    {
        $html = $this->buildTableHtml('', false, $this->tableContent(['Name'], [['Alice']]));
        $this->assertStringContainsString('<tbody>', $html);
    }

    // -----------------------------------------------------------------------
    // Body / row rendering
    // -----------------------------------------------------------------------

    public function testBodyRowsRendered(): void
    {
        $html = $this->buildTableHtml('', true, $this->tableContent(['A', 'B'], [['1', '2'], ['3', '4']]));
        $this->assertStringContainsString('<tbody>', $html);
        $this->assertStringContainsString('</tbody>', $html);
        // The thead also contains one <tr>; check tbody-specific row count
        $this->assertSame(2, substr_count($html, '<td>1</td>') + substr_count($html, ' 1 ') ? 2 : 2);
        $tbodyContent = substr($html, strpos($html, '<tbody>'), strpos($html, '</tbody>') - strpos($html, '<tbody>'));
        $this->assertSame(2, substr_count($tbodyContent, '<tr>'));
    }

    public function testCellsRenderedWithTdTags(): void
    {
        $html = $this->buildTableHtml('', true, $this->tableContent(['Col'], [['CellValue']]));
        $this->assertStringContainsString('<td>', $html);
        $this->assertStringContainsString('CellValue', $html);
    }

    public function testMultipleCellsPerRow(): void
    {
        $html = $this->buildTableHtml('', true, $this->tableContent(['X', 'Y', 'Z'], [['a', 'b', 'c']]));
        $this->assertSame(3, substr_count($html, '<td>'));
    }

    public function testEmptyRowsSkipped(): void
    {
        // Manually inject an empty line between data rows
        $content = "\n| Name |\n| Alice |\n\n| Bob |";
        $html = $this->buildTableHtml('', true, $content);
        // Two non-empty data rows should produce two <tr> inside tbody
        // The empty line must be skipped.
        $this->assertStringNotContainsString('<tr></tr>', $html);
    }

    // -----------------------------------------------------------------------
    // Edge cases: no body rows
    // -----------------------------------------------------------------------

    public function testNoBodyRowsOmitsTbody(): void
    {
        // Content with only header line (fewer than 3 lines total)
        $content = "\n| Name |";  // 2 lines: line0 + header only
        $html = $this->buildTableHtml('', true, $content);
        $this->assertStringNotContainsString('<tbody>', $html);
    }

    // -----------------------------------------------------------------------
    // Multiple columns consistency
    // -----------------------------------------------------------------------

    public function testHeaderAndBodyColumnCountMatch(): void
    {
        $html = $this->buildTableHtml(
            '', true,
            $this->tableContent(
                ['First', 'Last', 'Email'],
                [['John', 'Doe', 'john@example.com']]
            )
        );
        $this->assertSame(3, substr_count($html, '<th>'));
        $this->assertSame(3, substr_count($html, '<td>'));
    }

    // -----------------------------------------------------------------------
    // Full structure integration
    // -----------------------------------------------------------------------

    public function testFullTableStructureOrder(): void
    {
        $html = $this->buildTableHtml(
            'my-table', true,
            $this->tableContent(['Col1', 'Col2'], [['A', 'B']])
        );

        $theadPos  = strpos($html, '<thead>');
        $tbodyPos  = strpos($html, '<tbody>');
        $tablePos  = strpos($html, '<table');
        $endPos    = strpos($html, '</table>');

        $this->assertLessThan($theadPos, $tablePos);
        $this->assertLessThan($tbodyPos, $theadPos);
        $this->assertLessThan($endPos, $tbodyPos);
    }
}
