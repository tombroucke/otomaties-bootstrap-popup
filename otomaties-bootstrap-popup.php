<?php

namespace Otomaties\BootstrapPopup;

/**
 * Plugin Name: Otomaties Bootstrap Popup
 * Description: Add a configurable popup to your website
 * Author: Tom Broucke
 * Author URI: https://tombroucke.be
 * Version:           2.5.3
 * License: GPL2
 * Text Domain: otomaties-popup
 * Domain Path: languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

// Autoload files
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once realpath(__DIR__ . '/vendor/autoload.php');
}

// Setup / teardown
register_activation_hook(__FILE__, '\\Otomaties\\BootstrapPopup\\Activator::activate');
register_deactivation_hook(__FILE__, '\\Otomaties\\BootstrapPopup\\Deactivator::deactivate');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
function init() : void
{
    if (! function_exists('get_plugin_data')) {
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }
    $pluginData = \get_plugin_data(__FILE__, false, false);
    $pluginData['pluginName'] = basename(__FILE__, '.php');

    $plugin = new Plugin($pluginData);
    $plugin->run();
}
init();
