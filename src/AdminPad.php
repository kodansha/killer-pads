<?php

namespace KillerPads;

class AdminPad
{
    private $redirect_path;

    public function __construct()
    {
        if (defined('KILLER_PADS_ADMIN_HOME_PAGE_PATH')) {
            $this->redirect_path = KILLER_PADS_ADMIN_HOME_PAGE_PATH;
        } else {
            $this->redirect_path = "edit.php?post_type=post";
        }
    }

    public function init()
    {
        add_action('login_head', [$this, 'addFavicon']);
        add_action('admin_head', [$this, 'addFavicon']);
        add_action('admin_menu', [$this, 'removeDashboardMenu']);
        add_action('load-index.php', [$this, 'redirectDashboard']);
        add_action('login_redirect', [$this, 'redirectAfterLogin']);

        if (!(defined('KILLER_PADS_ENABLE_COMMENTS') && KILLER_PADS_ENABLE_COMMENTS == true)) {
            add_action('admin_init', [$this, 'removeCommentsFeatures']);
            add_action('admin_menu', [$this, 'removeCommentsMenu']);
            add_action('wp_before_admin_bar_render', [
                $this,
                'removeCommentsBarMenu'
            ]);
        }

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

    public function removeDashboardMenu()
    {
        remove_menu_page('index.php');
    }

    public function redirectDashboard()
    {
        wp_safe_redirect(admin_url($this->redirect_path));
    }

    public function redirectAfterLogin()
    {
        return admin_url($this->redirect_path);
    }

    public function removeCommentsFeatures()
    {
        global $pagenow;

        if ($pagenow === 'edit-comments.php') {
            wp_safe_redirect(admin_url($this->redirect_path));
        }

        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

        foreach (get_post_types() as $post_type) {
            if (post_type_supports($post_type, 'comments')) {
                remove_post_type_support($post_type, 'comments');
                remove_post_type_support($post_type, 'trackbacks');
            }
        }
    }

    public function removeCommentsMenu()
    {
        remove_menu_page('edit-comments.php');
    }

    public function removeCommentsBarMenu()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }

    public function disableAutosave()
    {
        wp_deregister_script('autosave');
    }
}
