<?php
/*
Plugin Name: MaxA/B
Plugin URI: http://maxfoundry.com/plugins/maxab/
Description: Easily perform A/B split testing from within WordPress itself. Any post or page can be used in an A/B experiment, and each experiment can contain up to 3 variation pages. Metrics are automatically calculated in real-time, and your conversion pages can even be on a different website.
Version: 2.2.2
Author: Max Foundry
Author URI: http://maxfoundry.com/

Copyright 2011 Max Foundry, LLC (http://maxfoundry.com/)
*/

include_once 'includes/functions.php';

define('WPPMAXAB_VERSION_KEY', 'wpp_maxab_version');
define('WPPMAXAB_VERSION_NUM', '2.2.2');

wpp_maxab_set_global_paths();
register_activation_hook(__FILE__, 'wpp_maxab_register_activation_hook');
register_deactivation_hook(__FILE__, 'wpp_maxab_register_deactivation_hook');

function wpp_maxab_set_global_paths()
{
    if (!defined('WPPMAXAB_PLUGIN_NAME'))
        define('WPPMAXAB_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

    if (!defined('WPPMAXAB_PLUGIN_DIR'))
        define('WPPMAXAB_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . WPPMAXAB_PLUGIN_NAME);

    if (!defined('WPPMAXAB_PLUGIN_URL'))
        define('WPPMAXAB_PLUGIN_URL', WP_PLUGIN_URL . '/' . WPPMAXAB_PLUGIN_NAME);
}



function wpp_maxab_register_activation_hook()
{
    if (function_exists('is_multisite') && is_multisite()) {
        if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
            wpp_maxab_call_function_for_each_site('wpp_maxab_activate');
            return;
        }
    }

    // Otherwise do it for a single blog/site
    wpp_maxab_activate();
}

function wpp_maxab_activate()
{
    wpp_maxab_create_database_table();
    update_option(WPPMAXAB_VERSION_KEY, WPPMAXAB_VERSION_NUM);
}

function wpp_maxab_register_deactivation_hook()
{
    if (function_exists('is_multisite') && is_multisite()) {
        if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {
            wpp_maxab_call_function_for_each_site('wpp_maxab_deactivate');
            return;
        }
    }

    // Otherwise do it for a single blog/site
    wpp_maxab_deactivate();
}

function wpp_maxab_deactivate()
{
    delete_option(WPPMAXAB_VERSION_KEY);
}

function wpp_maxab_call_function_for_each_site($function)
{
    global $wpdb;

    // Hold this so we can switch back to it
    $root_blog = $wpdb->blogid;

    // Get all the blogs/sites in the network and invoke the function for each one
    $blog_ids = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM $wpdb->blogs"));
    foreach ($blog_ids as $blog_id) {
        switch_to_blog($blog_id);
        call_user_func($function);
    }

    // Now switch back to the root blog
    switch_to_blog($root_blog);
}

add_filter('plugin_action_links', 'wpp_maxab_add_plugin_action_links', 10, 2);
function wpp_maxab_add_plugin_action_links($links, $file)
{
    static $this_plugin;

    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }

    if ($file == $this_plugin) {
        $dashboard_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=list">Експерименты</a>';
        array_unshift($links, $dashboard_link);
    }

    return $links;
}


function wpp_maxab_experiment()
{
    include_once 'includes/experiment-controller.php';
}

function wpp_maxab_faq()
{
    include_once 'includes/faq.php';
}

add_action('admin_print_styles', 'wpp_maxab_enqueue_styles_into_wp_admin');
function wpp_maxab_enqueue_styles_into_wp_admin()
{
    global $typenow;
    if (is_admin() && $typenow == 'page_selling') {
        $handle = 'wpp_maxab-css';
        $src = WPPMAXAB_PLUGIN_URL . '/styles.css';

        wp_register_style($handle, $src);
        wp_enqueue_style($handle);
    }

}

add_action('admin_print_scripts', 'wpp_maxab_enqueue_jquery');
function wpp_maxab_enqueue_jquery()
{
    wp_enqueue_script('jquery');
    do_action('wpp_maxab_enqueue_jquery');
}

add_action('admin_print_scripts', 'wpp_maxab_enqueue_jquery_plugins');
function wpp_maxab_enqueue_jquery_plugins()
{
    global $typenow;
    if (is_admin() && $typenow == 'page_selling') {
        $handle = 'wpp_maxab-jquery-form-js';
        $src = WPPMAXAB_PLUGIN_URL . '/js/jquery.form.js';
        wp_enqueue_script($handle, $src);

        $handle = 'wpp_maxab-jquery-validate-js';
        $src = WPPMAXAB_PLUGIN_URL . '/js/jquery.validate.js';
        wp_enqueue_script($handle, $src);

        $handle = 'wpp_maxab-jquery-simplemodal-js';
        $src = WPPMAXAB_PLUGIN_URL . '/js/jquery.simplemodal.js';
        wp_enqueue_script($handle, $src);
    }

}

function wpp_maxab_create_database_table()
{
    $table_name = wpp_maxab_get_table_name();

    if (!wpp_maxab_database_table_exists($table_name)) {
        $sql = "CREATE TABLE " . $table_name . " (
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(250) NOT NULL DEFAULT '',
				status VARCHAR(25) NOT NULL DEFAULT '',
				end_criteria VARCHAR(50) NOT NULL DEFAULT '',
				traffic_threshold INT NOT NULL DEFAULT 0,
				page_threshold INT NOT NULL DEFAULT 0,
				original_id INT NOT NULL DEFAULT 0,
				original_url VARCHAR(500) NOT NULL DEFAULT '',
				original_visitors INT NOT NULL DEFAULT 0,
				variation1_id INT NOT NULL DEFAULT 0,
				variation1_url VARCHAR(500) NOT NULL DEFAULT '',
				variation1_visitors INT NOT NULL DEFAULT 0,
				variation2_id INT NOT NULL DEFAULT 0,
				variation2_url VARCHAR(500) NOT NULL DEFAULT '',
				variation2_visitors INT NOT NULL DEFAULT 0,
				variation3_id INT NOT NULL DEFAULT 0,
				variation3_url VARCHAR(500) NOT NULL DEFAULT '',
				variation3_visitors INT NOT NULL DEFAULT 0,
				conversion_id INT NOT NULL DEFAULT 0,
				conversion_url VARCHAR(500) NOT NULL DEFAULT '',
				conversion_visitors_from_original INT NOT NULL DEFAULT 0,
				conversion_visitors_from_variation1 INT NOT NULL DEFAULT 0,
				conversion_visitors_from_variation2 INT NOT NULL DEFAULT 0,
				conversion_visitors_from_variation3 INT NOT NULL DEFAULT 0,
				total_visitors INT NOT NULL DEFAULT 0,
				date_created DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
				) CHARACTER SET utf8 COLLATE utf8_unicode_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}

function wpp_maxab_get_table_name()
{
    global $wpdb;
    return $wpdb->prefix . 'wpp_maxab_experiments';
}

function wpp_maxab_database_table_exists($table_name)
{
    global $wpdb;
    return strtolower($wpdb->get_var("SHOW TABLES LIKE '$table_name'")) == strtolower($table_name);
}

//add_action( 'all', print_my_actions );
function print_my_actions(){
    global $wp_filter, $wp_actions;
    echo '<pre>';
    print_r($wp_actions);
    echo '</pre>';
    echo '<pre>';
    print_r($wp_filter);
    echo '</pre>';
}

add_action('wp', 'wpp_maxab_init', 999);
function wpp_maxab_init()
{
    global $wpdb, $wp_current_filter;

    $url_long = wpp_maxab_get_url(); // does not work wit query string with '?'
    $url = wpp_maxab_get_url_without_querystring();

    // 'redirected' was added because counter was added twice
    // so we redirect after first add and tne second time we do nothing
    if (isset($_GET['smartreferer']) ) { // add conversion '+1' if we have 'smartreferer' param
        if (!is_admin() && !isset($_GET['redirected'])) {

           // wp_mail('admin@webografica.com', 'test smartreferer', time());

            $url_long .= '&redirected=1';

            header('Location: ' . $url_long);

            $table_name = $wpdb->prefix . 'wpp_maxab_experiments';
            $url_referer = urldecode($_GET['smartreferer']);


            $experiments = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_name . " WHERE conversion_url = %s AND status = 'running'", $url));
            foreach ($experiments as $experiment) {

                switch ($url_referer) {
                    case $experiment->original_url: // Original page
                        $conversion_visitors_from_original = $experiment->conversion_visitors_from_original + 1;
                        $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_original = %d WHERE id = %d", $conversion_visitors_from_original, $experiment->id));
                        break;
                    case $experiment->variation1_url: // Variation page 1
                        $conversion_visitors_from_variation1 = $experiment->conversion_visitors_from_variation1 + 1;
                        $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_variation1 = %d WHERE id = %d", $conversion_visitors_from_variation1, $experiment->id));
                        break;
                    case $experiment->variation2_url: // Variation page 2
                        $conversion_visitors_from_variation2 = $experiment->conversion_visitors_from_variation2 + 1;
                        $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_variation2 = %d WHERE id = %d", $conversion_visitors_from_variation2, $experiment->id));
                        break;
                    case $experiment->variation3_url: // Variation page 3
                        $conversion_visitors_from_variation3 = $experiment->conversion_visitors_from_variation3 + 1;
                        $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_variation3 = %d WHERE id = %d", $conversion_visitors_from_variation3, $experiment->id));
                        break;
                }
                /**/


               /* if ($url_referer == $experiment->original_url) {
                    $conversion_visitors_from_original = $experiment->conversion_visitors_from_original + 1;
                    $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_original = %d WHERE id = %d", $conversion_visitors_from_original, $experiment->id));
                }*/
            }




        }
    }else{
        if ((!wpp_maxab_url_contains($url, 'wp-admin')) && (!wpp_maxab_url_contains($url, 'wp-login'))) {
            global $wpdb;

            $table_name = wpp_maxab_get_table_name();
            $cookie_name_prefix = 'wpp_maxab_experiment_';

            // First check to process the front end of the experiment. An original page should only be part of 1 experiment.
            $experiment = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . $table_name . " WHERE original_url = %s AND status = 'running'", $url));
            if (!empty($experiment)) {

                // Otherwise we're good so continue on

                $cookie_name = $cookie_name_prefix . $experiment->id;


                if (isset($_COOKIE[$cookie_name])) {
                    $cookie_value = $_COOKIE[$cookie_name];
                    wpp_maxab_update_metrics_and_redirect($cookie_value, $experiment);
                } else {
                    $cookie_value = wpp_maxab_get_cookie_value($experiment);
                    $cookie_expires = time() + (60 * 60 * 24 * 30); // 30 days from now
                    $cookie_path = '/';

                    $success = setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);
                    if ($success) {
                        wpp_maxab_update_metrics_and_redirect($cookie_value, $experiment);
                    }
                }
            }

            // Now check to process the tail end of the experiment. Conversion pages can be part of multiple experiments.
            $experiments = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $table_name . " WHERE conversion_url = %s AND status = 'running'", $url));
            foreach ($experiments as $experiment) {
                $cookie_name = $cookie_name_prefix . $experiment->id;
                if (isset($_COOKIE[$cookie_name])) {
                   // wp_mail('admin@webografica.com', 'test smart cookie', time());
                    switch ($_COOKIE[$cookie_name]) {
                        case 0: // Original page
                            $conversion_visitors_from_original = $experiment->conversion_visitors_from_original + 1;
                            $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_original = %d WHERE id = %d", $conversion_visitors_from_original, $experiment->id));
                            break;
                        case 1: // Variation page 1
                            $conversion_visitors_from_variation1 = $experiment->conversion_visitors_from_variation1 + 1;
                            $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_variation1 = %d WHERE id = %d", $conversion_visitors_from_variation1, $experiment->id));
                            break;
                        case 2: // Variation page 2
                            $conversion_visitors_from_variation2 = $experiment->conversion_visitors_from_variation2 + 1;
                            $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_variation2 = %d WHERE id = %d", $conversion_visitors_from_variation2, $experiment->id));
                            break;
                        case 3: // Variation page 3
                            $conversion_visitors_from_variation3 = $experiment->conversion_visitors_from_variation3 + 1;
                            $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET conversion_visitors_from_variation3 = %d WHERE id = %d", $conversion_visitors_from_variation3, $experiment->id));
                            break;
                    }

                    // Delete the cookie by setting its value to an empty string and setting its
                    // expiration to 30 days ago (opposite of when we initially set the cookie).
                    // We delete the cookie to ensure that the conversion count is incremented
                    // only once. For example, if we didn't delete the cookie, then when the user
                    // refreshes the conversion page, it would get counted again.
                    setcookie($cookie_name, '', time() - (60 * 60 * 24 * 30), '/');
                }
            }
        }
    }


}

function wpp_maxab_experiment_is_over_traffic_threshold($experiment)
{
    if ($experiment->end_criteria == 'traffic_threshold') {
        if (($experiment->total_visitors + 1) > $experiment->traffic_threshold) {
            return true;
        }
    }
    return false;
}

function wpp_maxab_experiment_is_over_page_threshold($experiment)
{
    if ($experiment->end_criteria == 'page_threshold') {
        $number_of_variations = wpp_maxab_get_number_of_variations($experiment);
        switch ($number_of_variations) {
            case 1:
                if (($experiment->original_visitors + 1 > $experiment->page_threshold) && ($experiment->variation1_visitors + 1 > $experiment->page_threshold)) {
                    return true;
                }
                break;
            case 2:
                if (($experiment->original_visitors + 1 > $experiment->page_threshold) && ($experiment->variation1_visitors + 1 > $experiment->page_threshold) && ($experiment->variation2_visitors + 1 > $experiment->page_threshold)) {
                    return true;
                }
                break;
            case 3:
                if (($experiment->original_visitors + 1 > $experiment->page_threshold) && ($experiment->variation1_visitors + 1 > $experiment->page_threshold) && ($experiment->variation2_visitors + 1 > $experiment->page_threshold) && ($experiment->variation3_visitors + 1 > $experiment->page_threshold)) {
                    return true;
                }
                break;
        }
    }

    return false;
}

function wpp_maxab_update_metrics_and_redirect($cookie_value, $experiment)
{

   // wpp_maxab_check_threshold_counts($experiment);

    global $wpdb;
    $table_name = wpp_maxab_get_table_name();
    $total_visitors = $experiment->total_visitors + 1;
    switch ($cookie_value) {
        case 0: // Original page, no redirect
            $original_visitors = $experiment->original_visitors + 1;
            $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET original_visitors = %d, total_visitors = %d WHERE id = %d", $original_visitors, $total_visitors, $experiment->id));
            break;
        case 1: // Variation page 1
            $variation1_visitors = $experiment->variation1_visitors + 1;
            $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET variation1_visitors = %d, total_visitors = %d WHERE id = %d", $variation1_visitors, $total_visitors, $experiment->id));
            wpp_maxab_redirect($experiment->variation1_url);
            break;
        case 2: // Variation page 2
            $variation2_visitors = $experiment->variation2_visitors + 1;
            $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET variation2_visitors = %d, total_visitors = %d WHERE id = %d", $variation2_visitors, $total_visitors, $experiment->id));
            wpp_maxab_redirect($experiment->variation2_url);
            break;
        case 3: // Variation page 3
            $variation3_visitors = $experiment->variation3_visitors + 1;
            $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET variation3_visitors = %d, total_visitors = %d WHERE id = %d", $variation3_visitors, $total_visitors, $experiment->id));
            wpp_maxab_redirect($experiment->variation3_url);
            break;
    }
}

function wpp_maxab_check_threshold_counts($experiment)
{
    if ($experiment->end_criteria == 'traffic_threshold') {
        if ($experiment->total_visitors + 1 >= $experiment->traffic_threshold) {
            wpp_maxab_pause_experiment($experiment->id);
        }
    }

    if ($experiment->end_criteria == 'page_threshold') {
        $number_of_variations = wpp_maxab_get_number_of_variations($experiment);
        switch ($number_of_variations) {
            case 1:
                if (($experiment->original_visitors + 1 >= $experiment->page_threshold) && ($experiment->variation1_visitors + 1 >= $experiment->page_threshold)) {
                    wpp_maxab_pause_experiment($experiment->id);
                }
                break;
            case 2:
                if (($experiment->original_visitors + 1 >= $experiment->page_threshold) && ($experiment->variation1_visitors + 1 >= $experiment->page_threshold) && ($experiment->variation2_visitors + 1 >= $experiment->page_threshold)) {
                    wpp_maxab_pause_experiment($experiment->id);
                }
                break;
            case 3:
                if (($experiment->original_visitors + 1 >= $experiment->page_threshold) && ($experiment->variation1_visitors + 1 >= $experiment->page_threshold) && ($experiment->variation2_visitors + 1 >= $experiment->page_threshold) && ($experiment->variation3_visitors + 1 >= $experiment->page_threshold)) {
                    wpp_maxab_pause_experiment($experiment->id);
                }
                break;
        }
    }
}

function wpp_maxab_pause_experiment($id)
{
    global $wpdb;
    $table_name = wpp_maxab_get_table_name();

    $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET status = 'paused' WHERE id = %d", $id));
}

function wpp_maxab_get_cookie_value($experiment)
{
    // To get the cookie value, we use a random number within the range of
    // zero and the number of variations in the experiment. For example, if
    // the experiment has 3 variations, the cookie value will be a number
    // between 0 and 3. For any given experiment the following is true:
    //    Cookie value = 0 = user sees original page
    //    Cookie value = 1 = user sees variation page 1
    //    Cookie value = 2 = user sees variation page 2
    //    Cookie value = 3 = user sees variation page 3

    $value = 0;

    $number_of_variations = wpp_maxab_get_number_of_variations($experiment);
    switch ($number_of_variations) {
        case 1:
            $value = mt_rand(0, 1);
            break;
        case 2:
            $value = mt_rand(0, 2);
            break;
        case 3:
            $value = mt_rand(0, 3);
            break;
    }

    return $value;
}

function wpp_maxab_get_number_of_variations($experiment)
{
    // We know we'll have at least 1 variation, but if either id of variation2
    // or variation3 is greater than zero, we know a page was selected for that
    // variation in the experiment, so we increment the counter.

    $number_of_variations = 1;

    if ($experiment->variation2_id > 0) {
        $number_of_variations++;
    }

    if ($experiment->variation3_id > 0) {
        $number_of_variations++;
    }

    return $number_of_variations;
}

?>