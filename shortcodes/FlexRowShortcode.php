<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FlexRowShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ed-flex-row', function (ShortcodeInterface $sc) {
            // Get the shortcode content
            $content = $sc->getContent();
            // Remove paragraph tags
            $content = str_replace(array('<p>', '</p>'), '', $content);

            // Process your custom logic here to distribute the content in columns and flex row
            $columns = $this->parseColumns($content);
            $rowClass = $sc->getParameter('class', '');

            $columnClasses = [];
            foreach ($columns as $column) {
                $columnClass = $column['class'] ?? '';
                $columnContent = $column['content'] ?? '';

                $columnClasses[] = '<div class="' . $columnClass . '">' . $columnContent . '</div>';
            }

            // Return the processed content
            return '<p><div class="row ' . $rowClass . '">' . implode('', $columnClasses) . '</div></p>';
        });
    }

    protected function parseColumns($content)
    {
        $pattern = '/\[column\s+class="([^"]+)"\](.*?)\[\/column\]/is';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $columns = [];
        foreach ($matches as $match) {
            $column = [
                'class' => $match[1],
                'content' => $match[2],
            ];
            $columns[] = $column;
        }

        return $columns;
    }
}
