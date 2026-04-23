<?php

/**
 * Test bootstrap file.
 *
 * Loaded before any test runs (and before autoloading resolves test files).
 * Registers the stubs first so that class_exists() checks in shortcode files
 * find the stub classes, then wires up the production autoloader.
 */

// Stubs must be loaded before the shortcode files that extend them.
require_once __DIR__ . '/stubs/GravStubs.php';

// Register a simple PSR-0 / file-based autoloader for the shortcode classes
// so that test files can reference them without a full Grav installation.
spl_autoload_register(function (string $class): void {
    $map = [
        'Grav\\Plugin\\Shortcodes\\BoxShortcode'      => __DIR__ . '/../shortcodes/BoxShortcode.php',
        'Grav\\Plugin\\Shortcodes\\ButtonsShortcode'  => __DIR__ . '/../shortcodes/ButtonsShortcode.php',
        'Grav\\Plugin\\Shortcodes\\FlexRowShortcode'  => __DIR__ . '/../shortcodes/FlexRowShortcode.php',
        'Grav\\Plugin\\Shortcodes\\ImageFloatShortcode' => __DIR__ . '/../shortcodes/ImageFloatShortcode.php',
        'Grav\\Plugin\\Shortcodes\\TableShortcode'    => __DIR__ . '/../shortcodes/TableShortcode.php',
        'Grav\\Theme\\Editorial\\WordCountTwigExtension' => __DIR__ . '/../twig/WordCountTwigExtension.php',
    ];

    if (isset($map[$class])) {
        require_once $map[$class];
    }
});
