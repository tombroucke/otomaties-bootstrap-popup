<?php

namespace Otomaties\BootstrapPopup;

class Cache
{

    public function cleanPost (array|string $postIds) {
        foreach ($postIds as $postId) {
            if (function_exists('rocket_clean_post')) {
                rocket_clean_post($postId);
            }
        }
    }

    public function cleanDomain(string $language = null) {
        if (function_exists('rocket_clean_domain')) {
            rocket_clean_domain($language);
        }
    }

}
