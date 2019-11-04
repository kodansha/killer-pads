<?php

namespace KillerPads;

class AdminPad
{
    public function init()
    {
        add_action('login_head', [$this, 'addFavicon']);
        add_action('admin_head', [$this, 'addFavicon']);
        add_action('admin_menu', [$this, 'removeDashboard']);
        add_action('admin_menu', [$this, 'removeComments']);

        add_action('wp_print_scripts', [$this, 'disableAutosave']);
    }

    public function addFavicon()
    {
        $favicon_files = ["favicon.ico", "favicon.png"];

        foreach ($favicon_files as $favicon_file) {
            $abspath = get_stylesheet_directory() . '/' . $favicon_file;

            if (file_exists($abspath)) {
                $url = get_stylesheet_directory_uri() . '/' . $favicon_file;
                echo '<link rel="shortcut icon" href="' . $url . '" />';
                break;
            }
        }
    }

    public function removeDashboard()
    {
        remove_menu_page('index.php');
    }

    public function removeComments()
    {
        remove_menu_page('edit-comments.php');
    }

    public function disableAutosave()
    {
        wp_deregister_script('autosave');
    }
}
