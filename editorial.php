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
    /**
     * Subscribe to Grav events
     *
     * @return array Event subscriptions
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
            'onTwigExtensions' => ['onTwigExtensions', 0],
        ];
    }

    /**
     * Register shortcodes handlers
     *
     * @return void
     */
    public function onShortcodeHandlers(): void
    {
        if (!isset($this->grav['shortcode'])) {
            return;
        }

        $shortcodesPath = __DIR__ . '/shortcodes';
        
        if (!is_dir($shortcodesPath)) {
            $this->grav['log']->warning("Editorial Theme: Shortcodes directory not found at {$shortcodesPath}");
            return;
        }

        $this->grav['shortcode']->registerAllShortcodes($shortcodesPath);
    }

    /**
     * Register custom Twig extensions
     * Adds word_count filter for accurate word counting in multiple languages
     *
     * @return void
     */
    public function onTwigExtensions(): void
    {
        require_once __DIR__ . '/twig/WordCountTwigExtension.php';
        
        $this->grav['twig']->twig->addExtension(new WordCountTwigExtension());
    }

    /**
     * Register custom CSS and JavaScript assets
     * Only loads assets on frontend, not in admin panel
     *
     * @return void
     */
    public function onTwigSiteVariables(): void
    {
        // Only load theme assets on frontend
        if ($this->isAdmin()) {
            return;
        }

        $themeConfig = $this->getThemeConfig();
        
        $this->registerCustomCss($themeConfig);
        $this->registerCustomJs($themeConfig);
    }

    /**
     * Get current theme configuration
     *
     * @return array Theme configuration
     */
    private function getThemeConfig(): array
    {
        $activeTheme = $this->grav['theme']->name ?? 'editorial';
        return $this->config->get("themes.{$activeTheme}", []);
    }

    /**
     * Register custom CSS if enabled and exists
     *
     * @param array $themeConfig Theme configuration
     * @return void
     */
    private function registerCustomCss(array $themeConfig): void
    {
        if (empty($themeConfig['custom_css'])) {
            return;
        }

        $customCssPath = 'theme://assets/css/custom.css';
        
        if (!$this->assetExists($customCssPath)) {
            $this->grav['log']->notice("Editorial Theme: Custom CSS enabled but file not found at {$customCssPath}");
            return;
        }

        $this->grav['assets']->addCss($customCssPath, ['priority' => 10]);
    }

    /**
     * Register custom JavaScript if enabled and exists
     *
     * @param array $themeConfig Theme configuration
     * @return void
     */
    private function registerCustomJs(array $themeConfig): void
    {
        if (empty($themeConfig['custom_js'])) {
            return;
        }

        $customJsPath = 'theme://assets/js/custom.js';
        
        if (!$this->assetExists($customJsPath)) {
            $this->grav['log']->notice("Editorial Theme: Custom JS enabled but file not found at {$customJsPath}");
            return;
        }

        $this->grav['assets']->addJs($customJsPath, [
            'group' => 'bottom',
            'priority' => 15
        ]);
    }

    /**
     * Check if asset exists using Grav's locator
     *
     * @param string $path Asset path using Grav's stream notation
     * @return bool True if asset exists, false otherwise
     */
    private function assetExists(string $path): bool
    {
        return (bool) $this->grav['locator']->findResource($path);
    }
}