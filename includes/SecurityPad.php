<?php

namespace KillerPads;

class SecurityPad
{
    public function init()
    {
        add_filter('xmlrpc_enabled', '__return_false');
    }
}
