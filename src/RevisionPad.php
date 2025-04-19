<?php

namespace Kodansha\KillerPads;

class RevisionPad
{
    /**
     * Initializes the revision pad functionality.
     */
    public function init()
    {
        if (!defined('WP_POST_REVISIONS')) {
            define('WP_POST_REVISIONS', 100);
        }
    }
}
