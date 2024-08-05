<?php

/**
* @author Pedro Moreno https://pmdesign.dev
* @license Public Domain
* @url https://github.com/pmoreno-rodriguez/grav-theme-editorial
*/

namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Parsedown;

class ImageFloatShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('ed-float', function (ShortcodeInterface $sc) {
            $classes = $sc->getParameter('classes', '');
            $direction = $sc->getParameter('direction', false);
            $image = $sc->getParameter('image', '');
            $alt = $sc->getParameter('alt', '');
            $title = $sc->getParameter('title', '');
            // Get the shortcode content
            $content = $sc->getContent();
            // Remove paragraph tags
            $content = str_replace(array('<p>', '</p>'), '', $content);
            $parsedown = new Parsedown();
            $parsedContent = $parsedown->text($content);

            // Get the relative path to the current page
            $page = $this->grav['page'];
            $basePath = $this->grav['base_url'];
            $imagePath = $basePath . '/' . $page->relativePagePath();

            $output = '<p>';

            $output .= '<span class="image ' . $classes . ' ' . $direction . '"><img src="' . $imagePath . '/' . $image . '" alt="' . $alt . '" title="' . $title . '"></span>';
            $output .= $parsedContent;
            $output .= '</p>';

            return $output;
        });
    }
}
