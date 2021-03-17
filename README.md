# Killer Pads (WordPress Plug-in)

Killer Pads is a plugin like security pads for "prevention is better than cure".
It activates the default configuration of security and operational efficiency
to WordPress websites.

## Features

### Admin page customization

- Disable admin dashboard page
- Add favicon to admin pages (`favicon.ico` or `favicon.png` must be placed in your theme's root directory)
- Disable post autosave
- Remove comments menu by default

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

### REST routes

By default, only the following namespaces are allowed in whitelist:

- `api`
- `preview`

If you want to provide your own whitelist (e.g. `wp/v2`), add the following to `wp-config.php`:

```php
define('KILLER_PADS_NAMESPACE_WHITELIST', ['wp/v2', 'preview']);
```

### Remove Dashboard function configuration

When activating this plugin, admin home page is being redirected to `/edit.php?post_type=post`.
If you want to change the path to be redirected, add the following to `wp-config.php`:

```php
define('KILLER_PADS_ADMIN_HOME_PAGE_PATH', "edit.php?post_type=page");
```

### Enable comments menu in admin pages

Comments menus are disabled by default. If you want to use comments and need to
show comments menu in admin pages, add the following to `wp-config.php`:

```php
define('KILLER_PADS_ENABLE_COMMENTS_MENU', true);
```
