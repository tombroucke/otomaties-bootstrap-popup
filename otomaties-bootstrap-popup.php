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

if ( ! defined( 'ABSPATH' ) ) exit;

class Bootstrap_Plugin {

	private static $instance = null;

	/**
	 * Creates or returns an instance of this class.
	 * @since  1.0.0
	 * @return Bootstrap_Plugin A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
		$this->includes();
		$this->init();
	}

	private function includes() {
		include 'includes/class-assets.php';
	}

	private function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 90 );
		add_action( 'wp_footer', array( $this, 'include_popup' ) );
		add_action( 'acf/init', array( $this, 'add_options_page' ) );
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'otomaties-popup', asset_path('main.js'), array('jquery'), '1.0.0', true );
	}

	public function include_popup() {
		include 'templates/popup.php';
	}

	public function add_options_page() {
		if( function_exists('acf_add_options_page') ) {

			acf_add_options_page( array(
				'page_title' 	=> __('Popup', 'sage'),
				'menu_title'	=> __('Popup settings', 'sage'),
				'menu_slug' 	=> 'otomaties-popup-settings',
				'capability'	=> 'edit_posts',
				'icon_url' 		=> 'dashicons-megaphone',
				'redirect'		=> false
			) );

		}

		if( function_exists('acf_add_local_field_group') ) {
			include 'acf/acf-popup.php';
		}
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'otomaties-popup', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}
}
Bootstrap_Plugin::get_instance();
