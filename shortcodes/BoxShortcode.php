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

            $output = '';

            if (!empty($boxHeading)) {
                $output .= '<h3>' . $boxHeading . '</h3>';
            }

            $output .= '<div class="box ' . $boxClass . ' ' . $boxColor . '">' . $content . '</div>';
            return $output;

        });
    }
}