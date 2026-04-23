<?php

/**
* @author Pedro Moreno https://pmdesign.dev
* @license Public Domain
* @url https://github.com/pmoreno-rodriguez/grav-theme-editorial
*/

namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class BoxShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ed-box', function(ShortcodeInterface $sc) {

            // Get shortcode content and parameters;

            // Get the shortcode content
            $content = $sc->getContent();

            $boxHeading= $sc->getParameter('heading', $sc->getBbCode());
            $boxColor= $sc->getParameter('color', $sc->getBbCode());
            $boxClass= $sc->getParameter('class', $sc->getBbCode());

            return $this->buildBoxHtml($boxHeading, $boxClass, $boxColor, $content);
        });
    }

    /**
     * Build the box HTML output.
     *
     * @param string|null $heading Optional heading text
     * @param string|null $class   Additional CSS class(es)
     * @param string|null $color   Color modifier CSS class
     * @param string|null $content Inner content
     * @return string
     */
    protected function buildBoxHtml(?string $heading, ?string $class, ?string $color, ?string $content): string
    {
        $output = '';

        if (!empty($heading)) {
            $output .= '<h3>' . $heading . '</h3>';
        }

        $output .= '<div class="box ' . $class . ' ' . $color . '">' . $content . '</div>';
        return $output;
    }
}