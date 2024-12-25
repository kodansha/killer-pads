<?php

/**
 * Plugin Name: Killer Pads
 * Plugin URI: https://github.com/kodansha/killer-pads
 * Description: Killer Pads is a plugin like security pads for "prevention is better than cure". It activates the default configuration of security and operational efficiency to WordPress websites.
 * Version: 1.5.5
 * Author: KODANSHAtech LLC.
 * Author URI: https://github.com/kodansha
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

// Don't do anything if called directly.
if (!defined('ABSPATH') || !defined('WPINC')) {
    die();
}

// Autoloader
if (is_readable(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Initialize plugin
 */
function init()
{
    (new Kodansha\KillerPads\AdminPad())->init();
    (new Kodansha\KillerPads\RestRoutesPad())->init();
    (new Kodansha\KillerPads\SecurityPad())->init();
    (new Kodansha\KillerPads\RestEndpointsPad())->init();

    if (!(defined('KILLER_PADS_ENABLE_COMMENTS') && KILLER_PADS_ENABLE_COMMENTS == true)) {
        (new Kodansha\KillerPads\CommentsPad())->init();
    }
}

add_action('plugins_loaded', 'init', PHP_INT_MAX - 1);
