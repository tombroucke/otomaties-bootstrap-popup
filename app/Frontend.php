<?php

namespace Otomaties\BootstrapPopup;

use Otomaties\BootstrapPopup\Models\Popup;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 */
class Frontend
{
    /**
     * The ID of this plugin.
     *
     * @var string The ID of this plugin.
     */
    private $pluginName;

    /**
     * Initialize the class and set its properties.
     *
     * @param  string  $pluginName  The name of the plugin.
     */
    public function __construct($pluginName)
    {

        $this->pluginName = $pluginName;
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     */
    public function enqueueScripts(): void
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        if (count(Popup::eligiblePopups()) == 0) {
            return;
        }

        $loadBootstrap = apply_filters('otomaties_bootstrap_popup_load_bootstrap', true);
        wp_enqueue_script($this->pluginName, ($loadBootstrap ? Assets::find('js/main.js') : Assets::find('js/main_no_bootstrap.js')), [], null, true);
    }

    public function renderPopups(): void
    {
        $popups = Popup::eligiblePopups();
        foreach ($popups as $popup) {
            $version = apply_filters('otomaties_bootstrap_popup_bootstrap_version', '5.x');
            $popupTemplate = dirname(__FILE__, 2).'/templates/popup.php';
            ob_start();
            include $popupTemplate;
            $output = ob_get_clean();
            echo apply_filters('otomaties_bootstrap_popup_template', $output, $popup, $version);
        }
    }
}
