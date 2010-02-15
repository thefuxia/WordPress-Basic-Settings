<?php
/*
Plugin Name: Toscho's basic settings
Plugin URI:  http://toscho.de/2010/wordpress-grundeinstellungen-per-plugin-setzen/
Description: Some useful default configuration settings. See 'wp-admin/options.php' for more options. 
Version:     0.3
Author:      Thomas Scholz
Author URI:  http://toscho.de
*/

function set_toscho_defaults()
{
    global $wpdb;

    $o = array(
        'avatar_default'            => 'blank',
        'avatar_rating'             => 'G',
        'category_base'             => '/thema',
        'comment_max_links'         => 0,
        'comments_per_page'         => 0,
        'date_format'               => 'd.m.Y',
        'default_ping_status'       => 'closed',
        'default_post_edit_rows'    => 30,
        'links_updated_date_format' => 'j. F Y, H:i',
        'permalink_structure'       => '/%year%/%postname%/',
        'rss_language'              => 'de',
        'start_of_week'             => 1,
        'timezone_string'           => 'Etc/GMT-1',
        'use_smilies'               => 0
    );

    foreach ( $o as $k => $v )
    {
        update_option($k, $v);
    }

    // Delete dummy post and comment.
    wp_delete_post(1, TRUE);
    wp_delete_comment(1);

    // empty blogroll
    $wpdb->query("DELETE FROM $wpdb->links WHERE link_id != ''");

    return;
}
register_activation_hook(__FILE__, 'set_toscho_defaults');