<?php
/**
 * Plugin Name: Killer Pads
 * Plugin URI: https://github.com/kodansha/killer-pads
 * Description: This plugin activate the defaults for sophisticated WordPress sites.
 * Version: 1.0.0
 * Author: Kodansha Ltd.
 * Author URI: https://github.com/kodansha
 * License: GPL v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 */

// Don't do anything if called directly.
if (!defined('ABSPATH') || !defined('WPINC')) {
    die();
}

// Autoloader
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

(new KillerPads\AdminPad())->init();
(new KillerPads\RestRoutesPad())->init();
(new KillerPads\SecurityPad())->init();
