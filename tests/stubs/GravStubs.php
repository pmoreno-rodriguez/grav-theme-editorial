<?php

/**
 * Stub classes for Grav framework dependencies.
 *
 * These stubs allow shortcode classes to be loaded and their
 * pure-PHP logic to be exercised without a full Grav installation.
 */

// ---------------------------------------------------------------------------
// Thunder\Shortcode stubs
// ---------------------------------------------------------------------------

namespace Thunder\Shortcode\Shortcode {

    interface ShortcodeInterface
    {
        public function getContent(): ?string;
        /** @return mixed */
        public function getParameter(string $name, $default = null);
        public function getBbCode(): ?string;
        public function getParent(): ?ShortcodeInterface;
    }
}

// ---------------------------------------------------------------------------
// Grav\Plugin\Shortcodes stubs
// ---------------------------------------------------------------------------

namespace Grav\Plugin\Shortcodes {

    /**
     * Minimal stub for the Grav shortcode base class.
     * Shortcode subclasses extend this; we only need the class to exist so
     * that PHP can load the shortcode files.
     */
    abstract class Shortcode
    {
        // Intentionally empty – tests target protected helper methods only.
    }
}

// ---------------------------------------------------------------------------
// Parsedown stub (used by ImageFloatShortcode)
// ---------------------------------------------------------------------------

namespace {
    if (!class_exists('Parsedown')) {
        class Parsedown
        {
            public function text(string $text): string
            {
                return $text;
            }
        }
    }
}
