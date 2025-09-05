<?php

namespace Otomaties\BootstrapPopup;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 */
class Admin
{
    /**
     * The ID of this plugin.
     *
     * @var string The ID of this plugin.
     */
    private $pluginName;

    /**
     * The version of this plugin.
     *
     * @var string The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param  string  $pluginName  The name of this plugin.
     * @param  string  $version  The version of this plugin.
     */
    public function __construct($pluginName, $version)
    {

        $this->pluginName = $pluginName;
        $this->version = $version;
    }

    /**
     * Register the JavaScript for the admin area.
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
        wp_enqueue_script($this->pluginName, Assets::find('js/admin.js'), [], $this->version, false);
    }

    public function clearCachesAfterSave(int|string $post_ID): void
    {
        if (get_post_type($post_ID) !== 'popup') {
            return;
        }

        if (wp_is_post_autosave($post_ID)) {
            return;
        }

        if (wp_is_post_revision($post_ID)) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (! function_exists('get_field')) {
            return;
        }

        (new Cache)->cleanDomain();
    }
}
