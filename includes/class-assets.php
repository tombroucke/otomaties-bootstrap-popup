<?php
namespace Otomaties\Popup;

class CustomJsonManifest
{
    private $manifest;

    public function __construct($manifest_path)
    {
        if (file_exists($manifest_path)) {
            $this->manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $this->manifest = [];
        }
    }

    public function get()
    {
        return $this->manifest;
    }
}

function asset_path($filename)
{

    $filename = rtrim(ltrim($filename, '/'), '/');
    $distPath = plugins_url('/dist/', dirname(__FILE__));
    $directory = dirname($filename) . '/';
    $file = basename($filename);
    $fileArray = explode('.', $file);

    static $manifest;

    if (empty($manifest)) {
        $manifest_path = __DIR__ . '/../dist/manifest.json';
        $manifest = new CustomJsonManifest($manifest_path);
    }
    $themanifest = $manifest->get();

    if (array_key_exists($filename, $themanifest)) {
        return $distPath . $themanifest[$filename];
    } else {
        return get_theme_file_uri('assets/' . $filename);
    }
}
