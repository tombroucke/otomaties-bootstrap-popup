<?php

namespace Otomaties\BootstrapPopup;

class JsonManifest
{
    /**
     * The json manifest with assets
     *
     * @var array<string, array<string, string>>
     */
    private $manifest;

    /**
     * Set manifest
     *
     * @param  string  $manifest_path
     */
    public function __construct($manifest_path)
    {
        if (file_exists($manifest_path)) {
            $this->manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $this->manifest = [];
        }
    }

    /**
     * Get the manifest
     *
     * @return array<string, array<string, string>>
     */
    public function get()
    {
        return $this->manifest;
    }
}
