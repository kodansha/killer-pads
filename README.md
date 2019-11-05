# Killer Pads (WordPress Plug-in)

Killer Pads is a plugin like security pads for "prevention is better than cure".
It activates the default configuration of security and operational efficiency
to WordPress websites.

## Features

### Admin page customization

- Remove admin dashboard
- Add favicon to admin pages (`favicon.ico` or `favicon.png` must be placed in your theme's root directory)
- Disable autosave functions

### Remove REST routes

- Remove all routes except ones used by famous plugins and explicitly whitelisted

### Security concerns

- Disable XML-RPC

## Configuration

### Remove Dashboard function configuration

When activating this plugin, admin home page is redirected to `/edit.php?post_type=post`.
If you want to change the path to be redirected, add the following to `wp-config.php`:

```php
define('KILLER_PADS_ADMIN_HOME_PAGE_PATH', "edit.php?post_type=page")
```
