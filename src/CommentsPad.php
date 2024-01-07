<?php

namespace KillerPads;

/**
 * Completely disable comments in WordPress
 * ref: https://gist.github.com/mattclements/eab5ef656b2f946c4bfb?permalink_comment_id=4563915#gistcomment-4563915
 */
class CommentsPad
{
    public function init()
    {
        add_action('admin_init', function () {
            // Redirect any user trying to access comments page
            global $pagenow;

            if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
                wp_redirect(admin_url());
                exit;
            }

            // Remove comments metabox from dashboard
            remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

            // Disable support for comments and trackbacks in post types
            foreach (get_post_types() as $post_type) {
                if (post_type_supports($post_type, 'comments')) {
                    remove_post_type_support($post_type, 'comments');
                    remove_post_type_support($post_type, 'trackbacks');
                }
            }
        });

        // Close comments on the front-end
        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);

        // Hide existing comments
        add_filter('comments_array', '__return_empty_array', 10, 2);

        // Remove comments page in menu
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
            remove_submenu_page('options-general.php', 'options-discussion.php');
        });

        // Remove comments links from admin bar
        add_action('init', function () {
            if (is_admin_bar_showing()) {
                remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
            }
        });

        // Remove comments icon from admin bar
        add_action('wp_before_admin_bar_render', function () {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('comments');
        });

        // Return a comment count of zero to hide existing comment entry link.
        add_filter('get_comments_number', '__return_zero');

        // Multisite - Remove manage comments from admin bar
        add_action('admin_bar_menu', function ($wp_admin_bar) {
            $sites = get_blogs_of_user(get_current_user_id());
            foreach ($sites as $site) {
                $wp_admin_bar->remove_node("blog-{$site->userblog_id}-c");
            }
        }, PHP_INT_MAX - 1);
    }
}
