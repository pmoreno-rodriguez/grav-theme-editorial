<?php

/**
* @author Pedro Moreno https://pmdesign.dev
* @license Public Domain
* @url https://github.com/pmoreno-rodriguez/grav-theme-editorial
*/

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ButtonsShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ed-buttons', function (ShortcodeInterface $sc) {
            $content = $sc->getContent();
            $buttons = $this->parseContent($content);
            $ulclass= $sc->getParameter('ulclass', $sc->getBbCode());

            return $this->buildButtonsHtml($buttons, $ulclass);
        });
    }

    /**
     * Build the buttons list HTML.
     *
     * @param array       $buttons  Array of parsed button parameter arrays
     * @param string|null $ulclass  Extra CSS class for the <ul> element
     * @return string
     */
    protected function buildButtonsHtml(array $buttons, ?string $ulclass): string
    {
        $output = '<ul class="actions '.$ulclass.'">';
        foreach ($buttons as $button) {
            $text = $button['content'] ?? 'Button'; // Get the button content
            $class = $button['class'] ?? '';
            $type = $button['type'] ?? 'default';
            $size = $button['size'] ?? '';
            $target = $button['target'] ?? '_self';
            $url = $button['url'] ?? '#';

            $buttonClass = 'button ' . $type . ' ' . $size . ' ' . $class;
            $output .= '<li><a class="' . $buttonClass . '" href="' . $url . '" target="' . $target . '">' . $text . '</a></li>';
        }
        $output .= '</ul>';

        return $output;
    }

    protected function parseContent($content)
    {
        $buttons = [];

        preg_match_all('/\[ed-button(.*?)\](.*?)\[\/ed-button\]/s', $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $buttonParams = $this->parseButtonParams($match[1]);
            $buttonParams['content'] = $match[2]; // Save the content in the parameters array
            $buttons[] = $buttonParams;
        }

        return $buttons;
    }

    protected function parseButtonParams($paramsString)
    {
        $params = [];

        if (is_string($paramsString)) {
            $matches = [];
            preg_match_all('/(\w+)\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|(\S+))/', $paramsString, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $key = $match[1];
                $value = $match[2] !== '' ? $match[2] : ($match[3] !== '' ? $match[3] : ($match[4] ?? ''));
                $params[$key] = $value;
            }
        }

        return $params;
    }
}
