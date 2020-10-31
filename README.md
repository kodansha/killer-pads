# Killer Pads (WordPress Plug-in)

Killer Pads is a plugin like security pads for "prevention is better than cure".
It activates the default configuration of security and operational efficiency
to WordPress websites.

## Features

### Admin page customization

- Disable admin dashboard page
- Add favicon to admin pages (`favicon.ico` or `favicon.png` must be placed in your theme's root directory)
- Disable post autosave

### Remove REST routes

- Remove all routes except ones used by famous plugins and explicitly whitelisted

### Security concerns

- Disable XML-RPC

## Installation

This plugin is intended to be installed via [Composer](https://getcomposer.org).

Configure your `composer.json` like the following:

```json
{
  ...
  "require": {
    ...
    "kodansha/killer-pads": "^1.0.0",
    ...
  },
  ...
}
```

As an alternative way, of course you can just download the source codes and put
them into the plugin directory of your WordPress installation.

## Configuration

### Remove Dashboard function configuration

When activating this plugin, admin home page is being redirected to `/edit.php?post_type=post`.
If you want to change the path to be redirected, add the following to `wp-config.php`:

```php
define('KILLER_PADS_ADMIN_HOME_PAGE_PATH', "edit.php?post_type=page");
```
