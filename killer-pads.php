<?php

/**
 * Plugin Name: Killer Pads
 * Plugin URI: https://github.com/kodansha/killer-pads
 * Description: Killer Pads is a plugin like security pads for "prevention is better than cure". It activates the default configuration of security and operational efficiency to WordPress websites.
 * Version: 1.4.0
 * Author: Kodansha Ltd.
 * Author URI: https://github.com/kodansha
 * License: GPL v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

// Don't do anything if called directly.
if (!defined('ABSPATH') || !defined('WPINC')) {
    die();
}

// Autoloader
if (is_readable(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

(new KillerPads\AdminPad())->init();
(new KillerPads\RestRoutesPad())->init();
(new KillerPads\SecurityPad())->init();

if (!(defined('KILLER_PADS_ENABLE_COMMENTS') && KILLER_PADS_ENABLE_COMMENTS == true)) {
    (new KillerPads\CommentsPad())->init();
}
