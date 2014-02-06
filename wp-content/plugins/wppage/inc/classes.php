<?php
class product_shortdoce_button
{
    function __construct()
    {
        add_action('admin_init', array($this, 'action_admin_init'));
    }

    function action_admin_init()
    {
        // only hook up these filters if we're in the admin panel, and the current user has permission
        // to edit posts and pages
        global $current_screen;

        if (current_user_can('edit_posts') && current_user_can('edit_pages')) {
            add_filter('mce_buttons', array($this, 'filter_mce_button'), 1000);
            add_filter('mce_external_plugins', array($this, 'filter_mce_plugin'));
        }
    }

    function filter_mce_button($buttons)
    {
        global $current_screen;
        if ($current_screen->post_type == 'page_selling') {
            // add a separation before our button, here our button's id is "audio_button"
            $buttons = array('social_button', 'audio_button', 'video_button', 'googleform_button', 'subscriptions_button', 'product_button', 'bullets_button', 'bonus_button', 'arrows_button', 'text_box_button', 'satisfaction_button', 'review_button', 'header_button', 'countdown_button', 'divide_button');
            add_filter('mce_buttons_2', array($this, 'set_mce_buttons_2'), 1000);
            add_filter('mce_buttons_3', array($this, 'set_mce_buttons_3'), 1000);
            add_filter('mce_buttons_4', array($this, 'set_mce_buttons_4'), 1000);

        } else {
            array_push($buttons, '|');
        }
        return $buttons;
    }

    function set_mce_buttons_2()
    {
        $buttons = array('bold', 'italic', 'strikethrough', 'underline', 'bullist', 'numlist', 'blockquote', '|', 'outdent', 'indent', '|', 'justifyright', 'justifyfull', 'justifycenter', 'justifyleft', '|', 'link', 'unlink', '|', 'undo', 'redo', '|', 'wp_fullscreen');
        return $buttons;
    }

    function set_mce_buttons_3()
    {
        $buttons = array('fontselect', 'fontsizeselect', 'formatselect', 'forecolor', 'backcolor', '|', 'removeformat', '|', 'image', 'wp_adv');
        return $buttons;
    }

    function set_mce_buttons_4()
    {
        $buttons = array('table', 'row_props', 'cell_props', 'delete_col', 'delete_row', 'delete_table', 'col_after', 'col_before', 'row_after', 'row_before', 'split_cells', 'merge_cells');
        return $buttons;
    }

    function filter_mce_plugin($plugins)
    {
        // this plugin file will work the magic of our button
        if (get_post_type() == 'page_selling') {

            $package = wpp_package();

            if( $package == 'START' ) { //

                $plugins['product'] = plugins_url() . '/wppage/js/product.js';
                $plugins['bullets'] = plugins_url() . '/wppage/js/bullets.js';
                $plugins['bonus'] = plugins_url() . '/wppage/js/bonus.js';
                $plugins['arrows'] = plugins_url() . '/wppage/js/arrows.js';
                $plugins['coachaudio'] = plugins_url() . '/wppage/js/audio.js';
                $plugins['coachforms'] = plugins_url() . '/wppage/js/trial/googleforms.js';
                $plugins['subscriptions'] = plugins_url() . '/wppage/js/trial/subscriptions.js';
                $plugins['socialbuttons'] = plugins_url() . '/wppage/js/socialbuttons.js';
                $plugins['textbox'] = plugins_url() . '/wppage/js/box.js';
                $plugins['satisfaction'] = plugins_url() . '/wppage/js/satisfaction.js';
                $plugins['review'] = plugins_url() . '/wppage/js/reviews.js';
                $plugins['header'] = plugins_url() . '/wppage/js/headers.js';
                $plugins['coachcountdown'] = plugins_url() . '/wppage/js/trial/countdown.js';
                $plugins['wppvideo'] = plugins_url() . '/wppage/js/video.js';
                $plugins['table'] = plugins_url() . '/wppage/js/mce/mce/table/editor_plugin.js';
                $plugins['divide'] = plugins_url() . '/wppage/js/divide.js';

            }elseif($package == 'PRO' || $package == 'GURU' || $package == 'TRIAL' ) { //

                $plugins['product'] = plugins_url() . '/wppage/js/product.js';
                $plugins['bullets'] = plugins_url() . '/wppage/js/bullets.js';
                $plugins['bonus'] = plugins_url() . '/wppage/js/bonus.js';
                $plugins['arrows'] = plugins_url() . '/wppage/js/arrows.js';
                $plugins['coachaudio'] = plugins_url() . '/wppage/js/audio.js';
                $plugins['coachforms'] = plugins_url() . '/wppage/js/googleforms.js';
                $plugins['subscriptions'] = plugins_url() . '/wppage/js/subscriptions.js';
                $plugins['socialbuttons'] = plugins_url() . '/wppage/js/socialbuttons.js';
                $plugins['textbox'] = plugins_url() . '/wppage/js/box.js';
                $plugins['review'] = plugins_url() . '/wppage/js/reviews.js';
                $plugins['header'] = plugins_url() . '/wppage/js/headers.js';
                $plugins['satisfaction'] = plugins_url() . '/wppage/js/satisfaction.js';
                $plugins['coachcountdown'] = plugins_url() . '/wppage/js/countdown.js';
                $plugins['wppvideo'] = plugins_url() . '/wppage/js/video.js';
                $plugins['table'] = plugins_url() . '/wppage/js/mce/mce/table/editor_plugin.js';
                $plugins['divide'] = plugins_url() . '/wppage/js/divide.js';

            }elseif($package == 'NULL') { //
                $plugins['product'] = plugins_url() . '/wppage/js/null/product.js';
                $plugins['bullets'] = plugins_url() . '/wppage/js/null/bullets.js';
                $plugins['bonus'] = plugins_url() . '/wppage/js/null/bonus.js';
                $plugins['arrows'] = plugins_url() . '/wppage/js/null/arrows.js';
                $plugins['coachaudio'] = plugins_url() . '/wppage/js/null/audio.js';
                $plugins['coachforms'] = plugins_url() . '/wppage/js/null/googleforms.js';
                $plugins['subscriptions'] = plugins_url() . '/wppage/js/null/subscriptions.js';
                $plugins['socialbuttons'] = plugins_url() . '/wppage/js/null/socialbuttons.js';
                $plugins['textbox'] = plugins_url() . '/wppage/js/null/box.js';
                $plugins['review'] = plugins_url() . '/wppage/js/null/reviews.js';
                $plugins['header'] = plugins_url() . '/wppage/js/null/headers.js';
                $plugins['satisfaction'] = plugins_url() . '/wppage/js/null/satisfaction.js';
                $plugins['coachcountdown'] = plugins_url() . '/wppage/js/null/countdown.js';
                $plugins['wppvideo'] = plugins_url() . '/wppage/js/null/video.js';
                $plugins['table'] = plugins_url() . '/wppage/js/mce/mce/table/editor_plugin.js';
                $plugins['divide'] = plugins_url() . '/wppage/js/null/divide.js';

            }

        }
        return $plugins;
    }
}
