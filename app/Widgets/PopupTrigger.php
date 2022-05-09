<?php
namespace Otomaties\BootstrapPopup\Widgets;

use Otomaties\BootstrapPopup\Models\Popup;

class PopupTrigger extends \WP_Widget
{

    /**
     * Sets up a new Popup trigger widget instance.
     *
     * @since 2.8.0
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname'                   => 'popup_trigger',
            'description'                 => __('Display a popup trigger', 'otomaties-popup'),
            'customize_selective_refresh' => true,
            'show_instance_in_rest'       => true,
        );
        parent::__construct('popup_trigger', __('Popup trigger', 'otomaties-popup'), $widget_ops);
    }

    /**
     * Outputs the content for the current Popup trigger widget instance.
     *
     * @since 2.8.0
     * @since 4.2.0 Creates a unique HTML ID for the `<select>` element
     *              if more than one instance is displayed on the page.
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Popup trigger widget instance.
     */
    public function widget($args, $instance)
    {

        echo $args['before_widget'];
        if (isset($instance['popup_id'])) :
            $popup = new Popup($instance['popup_id']);
            if ($popup->enabled() && 'publish' == get_post_status($instance['popup_id'])) :
                ?>
                <button class="<?php echo esc_attr(apply_filters('otomaties_bootstrap_popup_trigger_btn_class', 'btn btn-primary')) ?>" type="button" data-bs-toggle="modal" data-bs-target="#popup-<?php echo esc_attr($instance['popup_id']); ?>" target="popup-<?php echo esc_attr($instance['popup_id']); ?>">
                    <?php echo esc_html($instance['label']); ?>
                </button>
                <?php
            endif;
        endif;
        echo $args['after_widget'];
    }

    /**
     * Handles updating settings for the current Categories widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update($new_instance, $old_instance)
    {
        $instance                 = $old_instance;
        $instance['label']        = sanitize_text_field($new_instance['label']);
        $instance['popup_id']        = sanitize_text_field($new_instance['popup_id']);

        return $instance;
    }

    /**
     * Outputs the settings form for the Categories widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    public function form($instance)
    {
        // Defaults.
        $instance     = wp_parse_args((array) $instance, array('label' => '', 'popup' => null));
        $popups = Popup::find();
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('label'); ?>"><?php _e('Label:', 'otomaties-popup'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('label'); ?>"
                name="<?php echo $this->get_field_name('label'); ?>" type="text"
                value="<?php echo esc_attr($instance['label']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('popup_id'); ?>"><?php _e('Popup:', 'otomaties-popup'); ?></label>
            <select name="<?php echo $this->get_field_name('popup_id'); ?>" id="">
                <option value=""><?php _e('Select', 'otomaties-popup'); ?></option>
                <?php foreach ($popups as $popup) : ?>
                    <option value="<?php echo esc_attr($popup->getId()); ?>" <?php selected($popup->getId(), $instance['popup_id']) ?>><?php echo esc_attr($popup->title()) ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }
}
