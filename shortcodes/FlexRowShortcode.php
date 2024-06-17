<?php

/**
* @author Pedro Moreno https://pmdesign.dev
* @license Public Domain
* @url https://github.com/pmoreno-rodriguez/grav-theme-editorial
*/

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FlexRowShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ed-flex-row', function (ShortcodeInterface $sc) {

            $hash = $this->shortcode->getId($sc);

            $output = $this->twig->processTemplate(
                'shortcodes/flexbox-layout.html.twig', // Twig template for shortcode
                [
                    'hash' => $hash,
                    'row_class' => 'row ' . $sc->getParameter('class', ''), // Concatenate 'row' with user-provided class
                    'row_styles' => $sc->getParameter('style',''), // Define inline styles
                    'columns' => $this->shortcode->getStates($hash),
                ]
            );

            return $output;
        });

        $this->shortcode->getHandlers()->add('column', function (ShortcodeInterface $sc) {
            // Add column to layout state using parent layout id
            $hash = $this->shortcode->getId($sc->getParent());
            $this->shortcode->setStates($hash, $sc);

            return '';
        });
    }
}