<?php

namespace Otomaties\BootstrapPopup;

class Cache
{
    public function cleanPost(array|string $postIds): void
    {
        $postUrls = array_map('get_permalink', (array) $postIds);
        do_action('swcfpc_purge_cache', $postUrls);

        if (function_exists('rocket_clean_post')) {
            foreach ($postIds as $postId) {
                rocket_clean_post($postId);
            }
        }
    }

    public function cleanDomain(?string $language = null): void
    {
        // Super Page Cache
        do_action('swcfpc_purge_cache');

        // WP Rocket
        if (function_exists('rocket_clean_domain')) {
            rocket_clean_domain($language);
        }
    }
}
