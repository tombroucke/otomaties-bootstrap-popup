<?php //phpcs:ignore
namespace Otomaties\BootstrapPopup;

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Create custom post types and taxonomies
 */
class CustomPostTypes
{

    /**
     * Register post type popup
     */
    public function addPopups()
    {
        $postType = 'popup';
        $slug = 'popup';
        $postSingularName = __('Popup', 'otomaties-popup');
        $postPluralName = __('Popups', 'otomaties-popup');

        register_extended_post_type(
            $postType,
            [
                'show_in_feed' => false,
                'show_in_rest' => true,
                'publicly_queryable' => false,
                'exclude_from_search' => true,
                'has_archive' => false,
                'public' => false,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'menu_icon' => 'dashicons-megaphone',
                'labels' => $this->postTypeLabels($postSingularName, $postPluralName),
                'support' => ['title', 'editor', 'author', 'revisions']
            ],
            [
                'singular' => $postSingularName,
                'plural'   => $postPluralName,
                'slug'     => $slug,
            ]
        );
    }

    public function addPopupFields()
    {
        $themeChoices = apply_filters('otomaties_bootstrap_popup_button_themes', [
            'primary' => __('Primary', 'otomaties-popup'),
            'secondary' => __('Secondary', 'otomaties-popup'),
            'light' => __('Light', 'otomaties-popup'),
            'dark' => __('Dark', 'otomaties-popup'),
            'danger' => __('Danger', 'otomaties-popup'),
            'warning' => __('Warning', 'otomaties-popup'),
            'success' => __('Success', 'otomaties-popup'),
            'info' => __('Info', 'otomaties-popup'),
        ]);
        $popup = new FieldsBuilder('popup');
        $popup
            ->addTrueFalse('enabled', [
                'label' => __('Enabled', 'otomaties-popup'),
                'message' => __('Enable popup', 'otomaties-popup'),
            ])
            ->addPostObject('show_on_pages', [
                'label' => __('Show on pages', 'otomaties-popup'),
                'multiple' => true,
            ])
            ->addTrueFalse('show_once', [
                'label' => __('Only show once', 'otomaties-popup'),
                'message' => __('Show popup only once', 'otomaties-popup'),
            ])
            ->addNumber('delay', [
                'label' => __('Delay', 'otomaties-popup'),
                'instructions' => __('In milliseconds', 'otomaties-popup'),
            ])
            ->addTrueFalse('show_close_button', [
                'label' => __('Close button', 'otomaties-popup'),
                'default_value' => true,
                'message' => __('Show close button', 'otomaties-popup'),
            ])
            ->addText('title', [
                'label' => __('Title', 'otomaties-popup'),
            ])
            ->addRepeater('buttons', [
                'label' => __('Buttons', 'otomaties-popup'),
            ])
                ->addLink('button', [
                    'label' => __('button', 'otomaties-popup'),
                ])
                ->addSelect('theme', [
                    'label' => __('Theme', 'otomaties-popup'),
                    'choices' => $themeChoices,
                ])
            ->endRepeater()
            ->setLocation('post_type', '==', 'popup');
        acf_add_local_field_group($popup->build());
    }

    /**
     * Translate post type labels
     *
     * @param  string $singular_name The singular name for the post type.
     * @param  string $plural_name   The plural name for the post type.
     * @return array
     */
    private function postTypeLabels($singular_name, $plural_name)
    {
        return [
            'add_new'                  => __('Add New', 'otomaties-popup'),
            /* translators: %s: singular post name */
            'add_new_item'             => sprintf(__('Add New %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'edit_item'                => sprintf(__('Edit %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'new_item'                 => sprintf(__('New %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'view_item'                => sprintf(__('View %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: plural post name */
            'view_items'               => sprintf(__('View %s', 'otomaties-popup'), $plural_name),
            /* translators: %s: singular post name */
            'search_items'             => sprintf(__('Search %s', 'otomaties-popup'), $plural_name),
            /* translators: %s: plural post name to lower */
            'not_found'                => sprintf(__('No %s found.', 'otomaties-popup'), strtolower($plural_name)),
            /* translators: %s: plural post name to lower */
            'not_found_in_trash'       => sprintf(__('No %s found in trash.', 'otomaties-popup'), strtolower($plural_name)),
            /* translators: %s: singular post name */
            'parent_item_colon'        => sprintf(__('Parent %s:', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'all_items'                => sprintf(__('All %s', 'otomaties-popup'), $plural_name),
            /* translators: %s: singular post name */
            'archives'                 => sprintf(__('%s Archives', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'attributes'               => sprintf(__('%s Attributes', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name to lower */
            'insert_into_item'         => sprintf(__('Insert into %s', 'otomaties-popup'), strtolower($singular_name)),
            /* translators: %s: singular post name to lower */
            'uploaded_to_this_item'    => sprintf(__('Uploaded to this %s', 'otomaties-popup'), strtolower($singular_name)),
            /* translators: %s: plural post name to lower */
            'filter_items_list'        => sprintf(__('Filter %s list', 'otomaties-popup'), strtolower($plural_name)),
            /* translators: %s: singular post name */
            'items_list_navigation'    => sprintf(__('%s list navigation', 'otomaties-popup'), $plural_name),
            /* translators: %s: singular post name */
            'items_list'               => sprintf(__('%s list', 'otomaties-popup'), $plural_name),
            /* translators: %s: singular post name */
            'item_published'           => sprintf(__('%s published.', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'item_published_privately' => sprintf(__('%s published privately.', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'item_reverted_to_draft'   => sprintf(__('%s reverted to draft.', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'item_scheduled'           => sprintf(__('%s scheduled.', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular post name */
            'item_updated'             => sprintf(__('%s updated.', 'otomaties-popup'), $singular_name),
        ];
    }

    /**
     * Translate taxonomy labels
     *
     * @param  string $singular_name The singular name for the taxonomy.
     * @param  string $plural_name   The plural name for the taxonomy.
     * @return array
     */
    private function taxonomyLabels($singular_name, $plural_name)
    {
        return [
            /* translators: %s: plural taxonomy name */
            'search_items'               => sprintf(__('Search %s', 'otomaties-popup'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'popular_items'              => sprintf(__('Popular %s', 'otomaties-popup'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'all_items'                  => sprintf(__('All %s', 'otomaties-popup'), $plural_name),
            /* translators: %s: singular taxonomy name */
            'parent_item'                => sprintf(__('Parent %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'parent_item_colon'          => sprintf(__('Parent %s:', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'edit_item'                  => sprintf(__('Edit %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'view_item'                  => sprintf(__('View %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'update_item'                => sprintf(__('Update %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'add_new_item'               => sprintf(__('Add New %s', 'otomaties-popup'), $singular_name),
            /* translators: %s: singular taxonomy name */
            'new_item_name'              => sprintf(__('New %s Name', 'otomaties-popup'), $singular_name),
            /* translators: %s: plural taxonomy name to lower */
            'separate_items_with_commas' => sprintf(__('Separate %s with commas', 'otomaties-popup'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'add_or_remove_items'        => sprintf(__('Add or remove %s', 'otomaties-popup'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'choose_from_most_used'      => sprintf(__('Choose from most used %s', 'otomaties-popup'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'not_found'                  => sprintf(__('No %s found', 'otomaties-popup'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name to lower */
            'no_terms'                   => sprintf(__('No %s', 'otomaties-popup'), strtolower($plural_name)),
            /* translators: %s: plural taxonomy name */
            'items_list_navigation'      => sprintf(__('%s list navigation', 'otomaties-popup'), $plural_name),
            /* translators: %s: plural taxonomy name */
            'items_list'                 => sprintf(__('%s list', 'otomaties-popup'), $plural_name),
            'most_used'                  => 'Most Used',
            /* translators: %s: plural taxonomy name */
            'back_to_items'              => sprintf(__('&larr; Back to %s', 'otomaties-popup'), $plural_name),
            /* translators: %s: singular taxonomy name to lower */
            'no_item'                    => sprintf(__('No %s', 'otomaties-popup'), strtolower($singular_name)),
            /* translators: %s: singular taxonomy name to lower */
            'filter_by'                  => sprintf(__('Filter by %s', 'otomaties-popup'), strtolower($singular_name)),
        ];
    }
}
