<?php
/**
 * Plugin Name: Otomaties Bootstrap Popup
 * Description: Add a configurable popup to your website
 * Author: Tom Broucke
 * Author URI: https://tombroucke.be
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: otomaties-popup
 * Domain Path: languages
 */

namespace Otomaties\Popup;

if (! defined('ABSPATH')) {
    exit;
}

class Plugin
{

    private static $instance = null;

    /**
     * Creates or returns an instance of this class.
     * @since  1.0.0
     * @return Plugin A single instance of this class.
     */
    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct()
    {
        $this->includes();
        $this->init();
    }

    private function includes()
    {
        include 'includes/class-assets.php';
    }

    private function init()
    {
        add_action('wp_enqueue_scripts', array( $this, 'enqueueScripts' ), 90);
        add_action('wp_footer', array( $this, 'popupTemplate' ));
        add_action('acf/init', array( $this, 'addOptionsPage' ));
        add_action('plugins_loaded', array( $this, 'loadTextdomain' ));
    }

    public function enqueueScripts()
    {
        if ($this->enabled()) {
            wp_enqueue_script('otomaties-popup', asset_path('main.js'), array('jquery'), '1.0.0', true);
        }
    }

    public function enabled()
    {
        if (!function_exists('get_field')) {
            return false;
        };

        $enabledPages = array_map(function ($page) {
            return $page->ID;
        }, (array)get_field('popup_show_on_pages', 'option'));

        
        if (!get_field('popup_enabled', 'option')) {
            return false;
        }

        if (!empty($enabledPages) && !in_array(get_the_ID(), $enabledPages)) {
            return false;
        }
        
        return true;
    }

    public function popupTemplate()
    {
        if ($this->enabled()) {
            include 'templates/popup.php';
        }
    }

    public function addOptionsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
            'page_title'    => __('Popup', 'sage'),
            'menu_title'    => __('Popup settings', 'sage'),
            'menu_slug'     => 'otomaties-popup-settings',
            'capability'    => apply_filters('otomaties_popup_edit_cap', 'edit_posts'),
            'icon_url'      => 'dashicons-megaphone',
            'redirect'      => false
            ));
        }

        if (function_exists('acf_add_local_field_group')) {
            include 'acf/acf-popup.php';
        }
    }

    public function loadTextdomain()
    {
        load_plugin_textdomain('otomaties-popup', false, plugin_basename(dirname(__FILE__)) . '/languages');
    }
}
Plugin::get_instance();
