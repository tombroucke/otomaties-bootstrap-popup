# Otomaties Bootstrap Popup

## Load Bootstrap JS from theme or other plugin

If you're loading bootstrap JS in your theme or another plugin, there's no need to load it twice. Loading it twice leads to slower loading times and could cause conflicts.

Make sure otomaties-bootstrap-popup is loaded first
```php
if (class_exists('Otomaties\\BootstrapPopup\\Plugin')) {
    bundle('app')->enqueueCss()->enqueueJs(true, ['otomaties-bootstrap-popup']);
} else {
    bundle('app')->enqueue();
}
```

Load javascript without bootstrap
```php
add_filter('otomaties_bootstrap_popup_load_bootstrap', '__return_false');
```

Pass modal component through a custom BootstrapLoaded event
```javascript
import { Modal } from 'bootstrap';

const bootstrapComponents = {
    modal: Modal,
}

const bootstrapLoadedEvent = new CustomEvent('BootstrapLoaded', {detail: {components : bootstrapComponents}});
window.dispatchEvent(bootstrapLoadedEvent);
```

## Filters

Filter available bootstrap themes

`otomaties_bootstrap_popup_button_themes`
