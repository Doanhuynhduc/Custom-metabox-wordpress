<?php
/*
 * Plugin Name: Hhd Custom metabox
 * Description: Tùy biến các trường tùy chỉnh cho bài viết bất động sản
 * Version: 1.0 
 * Author: huynh duc
 * Author URI: http://fb.com/hd7447
 * License: GPLv2 or later
*/


require_once( dirname( __FILE__ ) . '/admin/hhd-metabox.php' );
require_once( dirname( __FILE__ ) . '/admin/hhd_custom_shortcode.php' );

function addMyScript() {
    wp_enqueue_style(
        'hhd-add-style-css',
        plugin_dir_url(__FILE__) . 'style/style.css',
    );
}
add_action('wp_head', 'addMyScript');


