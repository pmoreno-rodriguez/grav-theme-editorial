<?php
namespace Grav\Theme;

use Grav\Common\Theme;
use RocketTheme\Toolbox\Event\Event;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Theme\Editorial\WordCountTwigExtension;

/**
 * Editorial Theme
 *
 * Class Editorial
 *
 * @category Extensions
 * @package  Grav\Theme
 * @author   Pedro Moreno <https://github.com/pmoreno-rodriguez>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/pmoreno-rodriguez/grav-theme-editorial
 */

class Editorial extends Theme
{
    // Access plugin events in this class


    public static function getSubscribedEvents()
    {
        return [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
            'onTwigExtensions' => ['onTwigExtensions', 0]
        ];
    }

    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/shortcodes');
    }

    /**
     * Register custom CSS or JavaScript assets
     **/
    public function onTwigSiteVariables()
    {
        // Get active theme dynamically
        $activeTheme = $this->grav['theme']->name;
        $themeConfig = $this->config->get("themes.$activeTheme");
        
        // Register custom CSS
        $custom_css_path = $this->grav['locator']->findResource('theme://assets/css/custom.css');
        if (isset($themeConfig['custom_css']) && $themeConfig['custom_css'] && $custom_css_path) {
            $this->grav['assets']->addCss('theme://assets/css/custom.css', ['priority' => 10]);
        }
        
        // Register custom JavaScript
        $custom_js_path = $this->grav['locator']->findResource('theme://assets/js/custom.js');
        if (isset($themeConfig['custom_js']) && $themeConfig['custom_js'] && $custom_js_path) {
            $this->grav['assets']->addJs('theme://assets/js/custom.js', ['group' => 'bottom', 'priority' => 15]);
        }
    }

    public function onTwigExtensions()
    {
        $twig = $this->grav['twig'];
        // Include and add WordCount extension
        include_once __DIR__ . '/twig/WordCountTwigExtension.php';
        $twig->twig->addExtension(new WordCountTwigExtension()); 
    }
}
