<?php

/**
* @author Pedro Moreno https://pmdesign.dev
* @license Public Domain
* @url https://github.com/pmoreno-rodriguez/grav-theme-editorial
*/

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class TableShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ed-table', function (ShortcodeInterface $sc) {
            $class = $sc->getParameter('class', '');
            $header = $sc->getParameter('header', true);

            $content = $sc->getContent();

            $output = "<table class=\"$class\">";

            // Process the table headers
            if ($header) {
                $headerRows = explode("\n", $content);

                if (count($headerRows) >= 2) {
                    $headers = explode('|', trim($headerRows[1]));
                    array_shift($headers); // Remove the empty first column
                    array_pop($headers); // Remove the empty last column

                    $output .= "<thead><tr>";
                    foreach ($headers as $header) {
                        $output .= "<th>$header</th>";
                    }
                    $output .= "</tr></thead>";
                }
            }

            // Process the table rows
            $rows = explode("\n", $content);
            if (count($rows) > 2) {
                $output .= "<tbody>";
                for ($i = 2; $i < count($rows); $i++) {
                    if (empty(trim($rows[$i]))) {
                        continue; // Skip empty rows
                    }

                    $row = explode('|', trim($rows[$i]));
                    array_shift($row); // Remove the empty first column
                    array_pop($row); // Remove the empty last column

                    $output .= "<tr>";
                    foreach ($row as $cell) {
                        $output .= "<td>$cell</td>";
                    }
                    $output .= "</tr>";
                }
                $output .= "</tbody>";
            }

            $output .= "</table>";

            return $output;
        });
    }
}
