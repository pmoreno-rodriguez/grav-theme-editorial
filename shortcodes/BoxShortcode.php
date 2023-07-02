<?php
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
            // Remove paragraph tags
            $content = str_replace(array('<p>', '</p>'), '', $content);

            $boxHeading= $sc->getParameter('heading', $sc->getBbCode());
            $boxColor= $sc->getParameter('color', $sc->getBbCode());
            $boxClass= $sc->getParameter('class', $sc->getBbCode());

            $output = '<h3>'.$boxHeading.'</h3>
                        <div class="box '. $boxClass . $boxColor .'"><p>'.$content.'</p></div>';
            return $output;

        });
    }
}