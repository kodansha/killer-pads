<?php

namespace KillerPads;

use WP_Error;

class RestRoutesPad
{
    const DEFAULT_NAMESPACE_WHITELIST = ['api', 'preview'];

    // Route namespaces used by well-known plug-ins
    // https://wpcerber.com/restrict-access-to-wordpress-rest-api/
    const DEFAULT_PLUGIN_NAMESPACE_WHITELIST = [
        'contact-form-7', // Contact Form 7
        'cf-api', // Caldera Forms
        'yoast', // Yoast SEO
        'jetpack' // Jetpack
    ];

    public function init()
    {
        add_filter(
            'rest_pre_dispatch',
            [$this, 'allowWhitelistedRoutesOnly'],
            10,
            3
        );
    }

    public function allowWhitelistedRoutesOnly(
        $result,
        $wp_rest_server,
        $request
    ) {
        $route = $request->get_route();

        // Allow every routes if a user has permission to edit post
        // (Otherwise Gutenberg does not work at all)
        if (current_user_can('edit_posts')) {
            return $result;
        }

        $namespace_whitelist = defined('KILLER_PADS_NAMESPACE_WHITELIST')
            ? KILLER_PADS_NAMESPACE_WHITELIST
            : self::DEFAULT_NAMESPACE_WHITELIST;

        foreach ($namespace_whitelist as $namespace) {
            if (strpos($route, $namespace) === 1) {
                return $result;
            }
        }

        // TODO: make this configurable
        $plugin_namespace_whitelist = self::DEFAULT_PLUGIN_NAMESPACE_WHITELIST;

        foreach ($plugin_namespace_whitelist as $plugin_namespace) {
            if (strpos($route, $plugin_namespace) === 1) {
                return $result;
            }
        }

        return new WP_Error('rest_unauthorized', 'Unauthorized', [
            'status' => rest_authorization_required_code()
        ]);
    }
}
