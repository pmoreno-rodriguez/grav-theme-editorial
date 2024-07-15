<?php
namespace Grav\Theme;

use Grav\Common\Theme;
use RocketTheme\Toolbox\Event\Event;
use Grav\Common\Page\Interfaces\PageInterface;

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
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
        ];
    }

    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/shortcodes');
    }

    public function onTwigSiteVariables()
    {
        if ($this->isAdmin() && ($this->grav['config']->get('plugins.shortcode-core.enabled'))) {
        }

        $themeConfig = $this->config->get('themes.editorial');

        if (isset($themeConfig['custom_css']) && $themeConfig['custom_css'] && file_exists(__DIR__ . '/assets/css/custom.css')) {
            $this->grav['assets']->addCss('theme://assets/css/custom.css', ['priority' => 5]);
        }

        if (isset($themeConfig['custom_js']) && $themeConfig['custom_js'] && file_exists(__DIR__ . '/assets/js/custom.js')) {
            $this->grav['assets']->addJs('theme://assets/js/custom.js', ['group' => 'bottom', 'priority' => 15]);
        }
    }
}
