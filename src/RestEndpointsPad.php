<?php

namespace Kodansha\KillerPads;

use WP_Error;

class RestEndpointsPad
{
    public function init()
    {
        add_filter('rest_url', [$this, 'fixRestApiUrlOnSeparateDomain']);
    }

    /**
     * When operating multiple sites on different domains, REST APIs used internally
     * by the Gutenberg editor fail if the site URL is different from the domain of the admin panel.
     * https://github.com/WordPress/gutenberg/issues/1761
     *
     * Similarly, some plugins use REST APIs (e.g. the Offload Media Lite),
     * that are executed from the browser, also causes an error.
     *
     * For a workaround, this filter rewrite the URL of the REST APIs.
     */
    public function fixRestApiUrlOnSeparateDomain($url)
    {
        $home_url = home_url();
        $site_url = site_url();

        if ($home_url === $site_url) {
            return $url;
        }

        $home_path = parse_url($home_url, PHP_URL_PATH);
        $site_path = parse_url($site_url, PHP_URL_PATH);
        $home_base = $home_path ? str_replace($home_path, '', $home_url) : $home_url;
        $site_base = $site_path ? str_replace($site_path, '', $site_url) : $site_url;

        return str_replace($home_base, $site_base, $url);
    }
}
