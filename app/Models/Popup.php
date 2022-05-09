<?php
namespace Otomaties\BootstrapPopup\Models;

if (! defined('ABSPATH')) {
    exit;
}

class Popup extends Abstracts\Post
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

    public function delay()
    {
        return get_field('delay', $this->getId());
    }

    public function showOnce()
    {
        return get_field('show_once', $this->getId());
    }

    public function title() : string
    {
        return get_field('title', $this->getId());
    }

    public function showCloseButton()
    {
        return get_field('show_close_button', $this->getId());
    }

    public function buttons()
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

    public function enabled()
    {
        return $this->get('enabled');
    }

    public function hash()
    {
        return substr(md5($this->title() . $this->content()), 0, 6);
    }

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

        $popups = self::find($args);
        return array_filter($popups, function ($popup) {
            return !$popup->showOnce() || !isset($_COOKIE['saw_popup_' . $popup->hash()]);
        });
    }
}
