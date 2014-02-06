<?php
/*
Plugin Name: wppage
Plugin URI: http://wppage.ru/
Description:
Version: 3.4.3
Author: Виктор Левчук
Author URI: http://wppage.ru/
*/

define('WPPAGE_VERSION', '3.4.3');

include_once('inc/functions.php');
include_once('inc/func.php');
include_once('plugins/maxab/maxab.php');
include_once('plugins/uppod/wpp_uppod.php');
include_once('plugins/stats/wppage-stats.php');
include_once('plugins/updater/updater.php');
include_once('inc/classes.php');
include_once('inc/shortcodes.php');
include_once('inc/page_options.php');
include_once('inc/page_settings.php');
include_once('inc/page_useful.php');
include_once('inc/page_lessons.php');



if (!function_exists('post_type_page_selling')):
    function post_type_page_selling()
    {

        $slug = (get_option('wppage_base_slug'))? get_option('wppage_base_slug'): 'wppage';

        $labels = array(
            'name'               => 'wppage',
            'singular_name'      => 'Продающую страницу',
            'all_items'          => 'Все страницы',
            'add_new'            => 'Добавить страницу',
            'add_new_item'       => 'Добавить страницу',
            'edit_item'          => 'Редактировать',
            'new_item'           => 'Новая страница',
            'view_item'          => 'Смотреть',
            'search_items'       => 'Поиск',
            'not_found'          => 'Ничего не найдено',
            'not_found_in_trash' => 'Ничего не найдено в корзине',
            'parent_item_colon'  => ''
        );
        $args = array(
            'labels'               => $labels,
            'public'               => true,
            'publicly_queryable'   => true,
            'show_ui'              => true,
            'query_var'            => true,
           // 'rewrite' => true,
            'rewrite'              => array(
                'slug'       => $slug,
                'with_front' => false,
            ),
            'capability_type'      => 'page',
            'hierarchical'         => true,
            'supports'             => array(
                'title',
                'thumbnail',
                'editor',
                'page-attributes',
                //'excerpt',
                //'custom-fields',
                //'post-formats',
                'comments',
                'revisions'
            ),
            'menu_position'        => 5,
            'register_meta_box_cb' => 'add_page_selling_metabox'
        );
        register_post_type('page_selling', $args);

    }

    add_action('init', 'post_type_page_selling');
//------------------------------

endif;

register_activation_hook(__FILE__, 'page_selling_activate');
register_deactivation_hook(__FILE__, 'page_selling_deactivate');


add_filter('pre_get_posts', 'wpp_orderby_in_admin' );

add_filter('tiny_mce_before_init', 'wppage_tinymce_config', 9998);


add_theme_support('post-thumbnails');
add_action('init', 'rewrite_init');

add_action('wp', 'wppage_redirect');
add_action('init', 'wpp_register_image_sizes');
add_action("wppage_head", "add_seo_meta_tags");
add_action('wppage_footer', 'add_seo_meta_in_footer');
add_action('wppage_footer', 'wpp_add_fancybox');
add_action('wppage_footer', 'add_jquery_ui');

add_action('admin_print_styles', 'load_wppage_styles');
add_action('admin_print_scripts', 'load_wppage_scripts');

add_action('admin_notices', 'ahtung_message');


add_shortcode('wpp_product', 'product_shortcode');

add_shortcode('wpp_smartresponder', 'smartresponder_shortcode');
add_shortcode('wpp_getresponse', 'getresponse_shortcode');
add_shortcode('wpp_mailchimp', 'wpp_mailchimp_shortcode');
add_shortcode('wpp_unisender', 'wpp_unisender_shortcode');
add_shortcode('wpp_justclick', 'wpp_justclick_shortcode');
add_shortcode('wpp_socialbuttons', 'socialbuttons_shortcode');
add_shortcode('wpp_countdown', 'countdown_shortcode');
add_shortcode('wpp_googleform', 'wppage_google_shortcode');
add_shortcode('wpp_youtube', 'wpp_youtube_shortcode');
add_shortcode('wpp_vimeo', 'wpp_vimeo_shortcode');
add_shortcode('wpp_video', 'wpp_video_shortcode');

add_action('admin_menu', 'wppage_admin_menu');


add_action('save_post', 'page_selling_save_meta', 1, 2);

$coachshortcodes = new product_shortdoce_button();