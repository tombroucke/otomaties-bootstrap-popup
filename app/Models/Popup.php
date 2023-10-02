<?php
namespace Otomaties\BootstrapPopup\Models;

use Otomaties\WpModels\PostType;

if (! defined('ABSPATH')) {
    exit;
}

class Popup extends PostType
{
    /**
     * Construct parent
     * @param int $id post_id
     */
    public function __construct($id)
    {
        parent::__construct($id);
    }

    public static function postType() : string
    {
        return 'popup';
    }

    public function delay() : int
    {
        return (int)$this->meta()->get('delay');
    }

    public function showOnce() : bool
    {
        return (bool)$this->meta()->get('show_once');
    }

    public function title() : string
    {
        return $this->meta()->get('title');
    }

    public function showCloseButton() : bool
    {
        return (bool)$this->meta()->get('show_close_button');
    }

    /**
     * Get all popup buttons
     *
     * @return array<array<string, mixed>>
     */
    public function buttons() : array
    {
        $buttons = [];
        $buttons = array_filter((array)get_field('buttons', $this->getId()));
        return array_map(function ($button) {
            return [
                'label' => $button['button']['title'],
                'target' => $button['button']['target'],
                'link' => $button['button']['url'],
                'theme' => $button['theme'],
            ];
        }, $buttons);
    }

    public function enabled() : bool
    {
        return (bool)$this->meta()->get('enabled');
    }

    public function hash() : string
    {
        return substr(hash('sha1', $this->title() . $this->content()), 0, 6);
    }

    public function showOnPages() : array
    {
        return array_filter((array)$this->meta()->get('show_on_pages'));
    }

    /**
     * Get all eligible popups for a certain page
     *
     * @return \Otomaties\WpModels\Collection<int, Popup>
     */
    public static function eligiblePopups()
    {
        $id = get_the_ID();
        $metaQuery = [
            'relation' => 'AND',
            [
                [
                    'key' => 'enabled',
                    'value' => '1',
                ],
            ],
            [
                'relation' => 'OR',
                [
                    'key' => 'show_on_pages',
                    'compare' => 'NOT EXISTS'
                ],
                [
                    'key' => 'show_on_pages',
                    'value' => '',
                ],
            ]
        ];
        if ($id) {
            $metaQuery[1][] = [
                'key' => 'show_on_pages',
                'value' => '"' . $id . '"',
                'compare' => 'LIKE'
            ];
        }
        $args['meta_query'] = $metaQuery;
        $popups = Popup::find($args);
        return $popups;
    }
}
