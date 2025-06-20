# Otomaties Bootstrap Popup

## Load Bootstrap JS from theme or other plugin

If you're loading bootstrap JS in your theme or another plugin, there's no need to load it twice. Loading it twice leads to slower loading times and could cause conflicts.

Make sure otomaties-bootstrap-popup is loaded first
```php
$dependencies = wp_script_is('otomaties-bootstrap-popup', 'enqueued') ? ['otomaties-bootstrap-popup'] : [];
bundle('app')->enqueueCss()->enqueueJs(true, $dependencies);
```
`wp_enqueue_scripts` priority should be > 999

Load javascript without bootstrap
```php
add_filter('otomaties_bootstrap_popup_load_bootstrap', fn() => false);
```

Pass modal component through a custom BootstrapLoaded event
```javascript
import { Modal } from 'bootstrap';

const bootstrapComponents = {
    modal: Modal, // `bootstrap.Modal` if you're not importing bootstrap
}

const bootstrapLoadedEvent = new CustomEvent('BootstrapLoaded', {detail: {components : bootstrapComponents}});
window.dispatchEvent(bootstrapLoadedEvent);
```

## Filters

### Use BS 4.x instead of 5.x
```php
add_filter('otomaties_bootstrap_popup_bootstrap_version', fn() => '4.x');
```

### Filter available bootstrap themes

`otomaties_bootstrap_popup_button_themes`

### Center popup
```php
add_filter('otomaties_bootstrap_popup_modal_dialog_classes', fn($classes) => $classes . ' modal-dialog-centered');
```
