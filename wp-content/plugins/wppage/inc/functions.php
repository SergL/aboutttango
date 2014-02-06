<?php

define('WPP_SEСRET_KEY_START', 'aCqY0G6cte74zUhbP3wksvMOJlnoEymQDNFL5SZB82VWuTrpgRKdfxAaHi9IjX1');
define('WPP_SEСRET_KEY_PRO', 'bCqgHYaGFcK3zoVRf4jnd6Op7Utmb8ED9ALXIMiJZWw2xehsSNklPu1rTQB50yv');
define('WPP_SEСRET_KEY_GURU', 'c3CrtZFlzWKaf9BT6oh4MvGm5uiQE2bJnqSgsXxNU1PLRIj78VOH0wcdDYypkAe');





//---------------------------

function fix_images_url()
{
    // fix for img path - from local to static
    global $wpdb;
    $old_url = plugins_url() . '/wppage/';
    $new_url = 'http://static.wppage.ru/wppage/';
    $update_sql = "UPDATE $wpdb->posts SET `post_content` = REPLACE( `post_content`, '" . $old_url . "', '" . $new_url . "');";
    $wpdb->query($update_sql);
}

//-------------------

function add_page_selling_metabox()
{
    add_meta_box('page_selling_metabox', 'Параметры страницы wppage', 'page_selling_extra', 'page_selling', 'normal');
}

//--------------------

function wppage_admin_menu()
{
    add_submenu_page('edit.php?post_type=page_selling', 'Параметры', 'Параметры', 'manage_options', 'wppage-options', 'wppage_settings_page');
    if (wpp_package() == 'GURU' || wpp_package() == 'TEST' || wpp_package() == 'TRIAL') {
        add_submenu_page('edit.php?post_type=page_selling', 'Статист', 'Статист', 'manage_options', 'wppage_stats', 'wppage_stats_content');
        add_submenu_page('edit.php?post_type=page_selling', 'А/Б тестирование', 'А/Б тестирование', 'manage_options', 'wpp_maxab-experiment', 'wpp_maxab_experiment');
    }
    add_submenu_page('edit.php?post_type=page_selling', 'Уроки', 'Уроки', 'manage_options', 'wppage-lessons', 'wppage_lessons_page');
    add_submenu_page('edit.php?post_type=page_selling', 'Полезное', 'Полезное', 'manage_options', 'wppage-useful', 'wppage_useful_page');
    add_submenu_page('edit.php?post_type=page_selling', 'Обновление', 'Обновление', 'update_plugins', 'wppage-updater', 'wppage_updater');

    add_action('admin_init', 'register_wppage_settings');

}

//-----------------------

function register_wppage_settings()
{
    //register our settings
    register_setting('coach-settings-group', 'wppage_secret');
    register_setting('coach-settings-group', 'wppage_serial_number');
    register_setting('coach-settings-group', 'facebook_app_id');
    register_setting('coach-settings-group', 'facebook_admin');
    register_setting('coach-settings-group', 'vkontakte_apiId');
    register_setting('coach-settings-group', 'twetter_nickname');
    register_setting('coach-settings-group', 'coach_analytics');
    register_setting('coach-settings-group', 'use_as_home_page');
    register_setting('coach-settings-group', 'wppage_base_slug');

    if(!get_option('use_as_home_page')){
        update_option('use_as_home_page', 'no_page');
    }

}



//-----------------------

function wppage_meta()
{
    do_action('wppage_meta');


}

function wppage_head()
{

    wp_enqueue_script('jquery');
    $version = version_compare(get_bloginfo('version'), '3.5');
    if ($version != '-1')
        wp_enqueue_script('jquery-ui-widget');
    do_action('wppage_head');
}

function wppage_footer()
{
    do_action('wppage_footer');

}


//------------------------

function rewrite_init()
{
    flush_rewrite_rules();
}

//------------------------

function plugin_get_version()
{
    $wppage_data = get_plugin_data('wppage');
    $version = $wppage_data['Version'];
    return $version;

}

//--------------------- for counter

function nn($num)
{
    if ($num <= '0') {
        return '00';
    } elseif ($num < 10) {
        return '0' . $num;
    } else {
        return $num;
    }
}

//------------------------

function wpp_register_image_sizes()
{

    add_image_size('vk_share_image', 100, 63);
    add_image_size('facebook_share_image', 100, 73);
    add_image_size('linked_share_image', 200, 200);
}

//------------------

function wppage_redirect()
{
    global $wp_query;

    if (is_home() || is_front_page()) {
        $redirect_id = get_option('use_as_home_page');
        if ($redirect_id != 'no_page') {
            $redirect_url = get_permalink($redirect_id);
            wp_redirect($redirect_url, 301);
            exit;
        }
    }
}

//-------------------

function wppage_tinymce_config($init)
{

    global $typenow;
    global $current_screen;

    $upload_dir = wp_upload_dir();

    if ($current_screen->post_type != 'page_selling' || $typenow != 'page_selling') return $init;

    $init['remove_linebreaks'] = 'false';
    $init['wpautop'] = 'false';
    $init['apply_source_formatting'] = 'true';
    $init['paste_auto_cleanup_on_paste'] = 'true';
    $init['paste_convert_headers_to_strong'] = 'false';
    $init['paste_strip_class_attributes'] = 'all';
    $init['paste_strip_class_attributes'] = 'false';
    $init['paste_remove_spans'] = 'true';
    $init['paste_remove_styles'] = 'true';
    $init['theme_advanced_font_sizes'] = '10pt,11pt,12pt,13pt,14pt,15pt,16pt,17pt,18pt,19pt,20pt,21pt,22pt,23pt,24pt,25pt,26pt,27pt,28pt,29pt,30pt,32pt,42pt,48pt,52pt';
    $init['theme_advanced_styles'] = 'Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1';
    $init['content_css'] = plugins_url() . '/wppage/css/editor-style-page_selling.css?'.time();
    $init['content_css'] .= ', '.$upload_dir['baseurl'].'/wppage/editor-style-'.get_the_ID().'.css?'.time();
    // Pass $init back to WordPress
    return $init;
}

//add_action('admin_head', 'wppage_wp_editor');

function wppage_wp_editor()
{
    global $typenow;
    global $current_screen;
    if ($current_screen->post_type != 'page_selling' || $typenow != 'page_selling') return;

    // The 'mode' and 'editor_selector' options are for adding
    // TinyMCE to any textarea with class="tinymce-textarea"
    wp_tiny_mce(false, array('mode' => 'specific_textareas','editor_selector' => 'tinymce-textarea'));
}

//-------------------

function wpp_add_fancybox()
{
    ?>
    <!-- fancybox -->
    <link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/wppage/js/fancybox/jquery.fancybox-1.3.4.css" media="all"/>
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/wppage/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="<?php echo plugins_url(); ?>/wppage/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript">
        jQuery(function ($) {
            $('.ps_make_order').fancybox({
                'padding': '20',
                'autoScale': false,
                'scrolling': 'no',
                'transitionIn': 'none',
                'transitionOut': 'none',
                'type': 'inline',
                'href': '#order_popup'
            });
            $('a[href$=".jpg"],a[href$=".png"],a[href$=".gif"]').fancybox();
        });
    </script>
    <!-- //fancybox -->
<?php
}

//----------

function add_jquery_ui()
{
    ?>
    <!-- jquery ui -->
    <script type="text/javascript"
            src="<?php echo plugins_url(); ?>/wppage/js/jquery_ui/jquery.ui.core.min.js"></script>
    <script type="text/javascript"
            src="<?php echo plugins_url(); ?>/wppage/js/jquery_ui/jquery.ui.widget.min.js"></script>
    <script type="text/javascript"
            src="<?php echo plugins_url(); ?>/wppage/js/jquery_ui/jquery.ui.tabs.min.js"></script>
    <script type="text/javascript"
            src="<?php echo plugins_url(); ?>/wppage/js/miscellaneous/jquery.scrollTo-min.js"></script>
    <!-- // jquery ui -->

<?php
}

function add_social_scripts()
{
    $html = '<!-- Vkontakte Share -->
    <script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?11" charset="windows-1251"></script>
    <!-- end of Vkontakte -->
    <!-- Facebook -->
    <script type="text/javascript" src="http://userapi.com/js/api/openapi.js?33"></script>
    <script type="text/javascript">
    VK.init({apiId: ' . get_option('vkontakte_apiId') . ', onlyWidgets: true});
    </script>
    <!-- Google plus one -->
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>';
    echo $html;
}

//----------

function load_wppage_styles()
{
    global $current_screen;
    wp_enqueue_style('wppage_admin_style', plugins_url('/wppage/css/admin_styles.css?'.WPPAGE_VERSION));

    if ($current_screen->post_type == 'page_selling') {
        echo '<!-- wppage -->';

        //wp_enqueue_style('coach_reset_style', plugins_url('/wppage/css/reset.css'));
        wp_enqueue_style('coach_style', plugins_url('/wppage/css/wppage.css?'.WPPAGE_VERSION));
        wp_enqueue_style('jquery_ui_slider_core_css', plugins_url('/wppage/js/jquery_ui/themes/base/jquery.ui.core.css'));
        wp_enqueue_style('jquery_ui_slider_slider_css', plugins_url('/wppage/js/jquery_ui/themes/base/jquery.ui.slider.css'));
        wp_enqueue_style('jquery_ui_slider_accordion_css', plugins_url('/wppage/js/jquery_ui/themes/base/jquery.ui.accordion.css'));
        wp_enqueue_style('jquery_ui_slider_datepicker_css', plugins_url('/wppage/js/jquery_ui/themes/base/jquery.ui.datepicker.css'));
        // wp_enqueue_style('jquery_ui_slider_theme_css', plugins_url('/wppage/js/jquery_ui/themes/base/jquery.ui.theme.css'));
        wp_enqueue_style('jquery_ui_time_picker_css', plugins_url('/wppage/js/time_picker/jquery-ui-timepicker.css'));

        echo '<!-- // wppage -->';
    }
}

function load_wppage_scripts()
{
    global $current_screen;
    wp_enqueue_script('wppage_admin_js', plugins_url('/wppage/js/wppage_admin_js.js'));

    if (is_admin() && $current_screen->post_type == 'page_selling') {
        echo '<!-- wppage -->';
        echo '<script type="text/javascript">var plugin_url = "' . WP_PLUGIN_URL . '"; var wppage_lang = "' . get_bloginfo('language') . '"</script>';

        wp_enqueue_script('jquery-ui-widget');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-mouse');
        wp_enqueue_script('jquery-ui-slider');
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('jquery-ui-droppable');

        wp_enqueue_script('jquery-ui-timepicker', plugins_url('/wppage/js/time_picker/jquery.ui.timepicker.js'));
        wp_enqueue_script('js-color-picker', plugins_url('/wppage/js/jscolor/jscolor.js'));

        wp_enqueue_script('jquery-ui_cookie', plugins_url('/wppage/js/miscellaneous/jquery.cookie.js'));

        echo '<!-- // wppage -->';
    }
}

//---------

function wppage_js_settings()
{
    global $typenow;
    $post_type = (isset($_POST['post_type'])) ? $_POST['post_type'] : '';
    if (is_admin() && ($post_type == 'page_selling' || $typenow == 'page_selling')) {
        echo '<script type="text/javascript">var plugin_url = "' . WP_PLUGIN_URL . '"</script>';
    }

}

//---------------

function add_seo_meta_tags()
{
    global $post;
    $facebook_thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'facebook_share_image', true);
    $title = str_replace(array('"', '"'), array('&quot;', '&quot;'), get_post_meta($post->ID, '_wppage_seo_title', true));
    $desc = str_replace(array('"', '"'), array('&quot;', '&quot;'), get_post_meta($post->ID, '_wppage_seo_desc', true));

    $linked_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'linked_share_image', false);

    ?>
    <!-- social meta tags -->
    <meta property="og:title" content="<?php echo $title; ?>"/>
    <meta property="og:description" content="<?php echo $desc; ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo $desc; ?>"/>
    <meta property="og:image" content="<?php echo $facebook_thumb_url[0]; ?>"/>
    <meta property="fb:app_id" content="<?php echo get_option('facebook_app_id'); ?>"/>
    <meta property="fb:admins" content="<?php echo get_option('facebook_admin'); ?>"/>
    <link rel="image_src" href="<?php echo $facebook_thumb_url[0]; ?>"/>
    <!-- // social meta tags -->
<?php
}

//--------------

function add_seo_meta_in_footer()
{
    global $post;
    $title = str_replace(array('"', '"'), array('&quot;', '&quot;'), get_post_meta($post->ID, '_wppage_seo_title', true));
    $desc = str_replace(array('"', '"'), array('&quot;', '&quot;'), get_post_meta($post->ID, '_wppage_seo_desc', true));
    $linked_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'linked_share_image', false);
    ?>
    <div itemscope itemtype="http://schema.org/Product" style="display: none;">
        <h1 itemprop="name"><?php echo $title; ?></h1>
        <img itemprop="image" src="<?php echo $linked_image[0]; ?>"/>

        <p itemprop="description"><?php echo $desc; ?></p>
    </div>
<?php
}

//--------------

function ahtung_message()
{
    global $typenow;
    $post_type = (isset($_POST['post_type'])) ? $_POST['post_type'] : '';


    $package = wpp_package();
    $end_date = get_option('wpp_trial_end_date_new');

    if ($post_type != 'page_selling' && $typenow != 'page_selling') {
        return;
    }
    if ($package == 'START') {
        notify_new_version();

    } elseif ($package == 'PRO') {
        notify_new_version();

    } elseif ($package == 'GURU') {
        notify_new_version();

    } elseif ($package == 'NULL') {
        echo '<div id="wppage_warning_trial" class="updated fade wpp_message wpp_message_warning" style="background-color: transparent;"> <p><strong>Время действия пробной версии закончилось. <a target="_blank" href="http://wppage.ru/buy" style="color: #FF0000">Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a></strong> </p><p><a target="_blank" href="http://wppage.ru/webinar/webinar-register.php?trackingID1=XXXXXXXX&trackingID2=YYYYYYYYY&landingpage=default&expiration=defa">VIP Приглашение на Бесплатный Эксперт-Вебинар!</a> </p><p><a target="_blank" href="http://wppage.ru/blog/wppage/otchet/">«Как собирать и монетизировать подписчиков» [PDF, 36 стр.]</a></p> </div>';

    } elseif ($package == 'TRIAL') {

        echo '<div id="wppage_warning_trial" class="updated fade wpp_message wpp_message_warning" style="background-color: transparent;"> <p> <strong>Вы используете ознакомительную версию wppage. ' . date('j-m-Y', $end_date) . ' плагин будет отключен. <a target="_blank" href="http://wppage.ru/buy" style="color: #FF0000">Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a></strong></p><p><a target="_blank" href="http://wppage.ru/webinar/webinar-register.php?trackingID1=XXXXXXXX&trackingID2=YYYYYYYYY&landingpage=default&expiration=defa">VIP Приглашение на Бесплатный Эксперт-Вебинар!</a> </p> <p><a target="_blank" href="http://wppage.ru/blog/wppage/otchet/">«Как собирать и монетизировать подписчиков» [PDF, 36 стр.]</a> </p> </div>';

    }


}

function notify_new_version(){
    global $wp_query;

    $wppage_latest_version = get_option('wppage_latest_version');
    $wppage_version = get_option('wppage_version');

    $html = '';

    if (isset($_GET['page']) && $_GET['page'] == 'wppage-updater') {
        return false;
    }

    if (version_compare($wppage_version, $wppage_latest_version) < 0) {// we need to update
        ?>
        <div class="wppage_notify_update updated fade wpp_message">
            <p><b>Появилась новая версия wppage <?php echo $wppage_latest_version; ?></b> &nbsp;&nbsp;<a
                    class="button button-primary" href="edit.php?post_type=page_selling&page=wppage-updater">Обновить</a>
            </p>
        </div>
        <script type="text/javascript">
            jQuery(function ($) {
                $('li#menu-posts-page_selling a[href="edit.php?post_type=page_selling&page=wppage-updater"]').addClass('new_update');
            });
        </script>
    <?php }
    return $html;
}


function wpp_orderby_in_admin($wp_query)
{
    global $wp_query, $typenow;
    $post_type = (isset($_POST['post_type'])) ? $_POST['post_type'] : '';

    if (is_admin() && ($post_type == 'page_selling' || $typenow == 'page_selling') && (!isset($_GET['orderby']) || !isset($_GET['order']))) {
        $wp_query->set('orderby', 'date');
        $wp_query->set('order', 'DESC');
    }
}


//------------------------- youtube url


function parse_yturl($url)
{
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}


//------------------------- hex to rgb

function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

//---------------- wppage comment form

function wppage_comment_form(){
    global $post;
    global $user_identity;
    $commenter = wp_get_current_commenter();

    ?>
    <form class="wppage-form" action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="commentform">

        <header class="info">
            <h4><?php comment_form_title(); ?></h4>
            <?php cancel_comment_reply_link(); ?>

            <?php if (is_user_logged_in()){ ?>
            <div>Вы вошли как <a href="<?php echo admin_url('profile.php'); ?>"><?php echo $user_identity; ?></a></div>
        </header>

        <ul>
            <?php }else{ ?>
            </header>

            <ul>
                <li class="leftThird">
                    <label for="author" class="desc">Имя
                        <span class="req">*</span>
                    </label>
                    <div>
                        <input type="text" name="author" value="<?php echo esc_attr($commenter['comment_author']); ?>" id="author" class="field text medium">
                    </div>
                </li>

                <li class="middleThird">
                    <label for="email" class="desc">Email
                        <span class="req">*</span>
                    </label>
                    <div>
                        <input type="text" name="email" value="<?php echo esc_attr($commenter['comment_author_email']); ?>" id="email" class="field text medium">
                    </div>
                </li>

                <li class="rightThird">
                    <label for="url" class="desc">Сайт</label>
                    <div>
                        <input type="text" name="url" value="<?php echo esc_attr($commenter['comment_author_url']); ?>" id="url" class="field text medium">
                    </div>
                </li>
                <?php } ?>

                <li>
                    <label for="comment" class="desc">Текст комментария</label>
                    <div>
                        <textarea name="comment" id="comment" cols="50" rows="10" class="field textarea medium"></textarea>
                    </div>
                </li>

                <li class="buttons">
                    <div>
                        <input id="saveForm" name="saveForm" class="btTxt submit" type="submit" value="Отправить" />
                    </div>
                </li>
            </ul>
            <?php comment_id_fields(); ?>
            <?php do_action('comment_form', $post->ID); ?>
            </ul>
    </form>
<?php }

function reorder_meta_boxes(){
    $meta_order = get_user_meta(get_current_user_id(), 'meta-box-order_page_selling', true);
}

/**/
function wppage_sanitize_option($option) {
    global $wpdb;

    $iso9_table = array(
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G`',
        'Ґ' => 'G`', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K`',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N`',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U`', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '``',
        'Ы' => 'Y`', 'Ь' => '`', 'Э' => 'E`', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k`',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n`',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u`', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '``',
        'ы' => 'y`', 'ь' => '`', 'э' => 'e`', 'ю' => 'yu', 'я' => 'ya'
    );
    $geo2lat = array(
        'ა' => 'a', 'ბ' => 'b', 'გ' => 'g', 'დ' => 'd', 'ე' => 'e', 'ვ' => 'v',
        'ზ' => 'z', 'თ' => 'th', 'ი' => 'i', 'კ' => 'k', 'ლ' => 'l', 'მ' => 'm',
        'ნ' => 'n', 'ო' => 'o', 'პ' => 'p','ჟ' => 'zh','რ' => 'r','ს' => 's',
        'ტ' => 't','უ' => 'u','ფ' => 'ph','ქ' => 'q','ღ' => 'gh','ყ' => 'qh',
        'შ' => 'sh','ჩ' => 'ch','ც' => 'ts','ძ' => 'dz','წ' => 'ts','ჭ' => 'tch',
        'ხ' => 'kh','ჯ' => 'j','ჰ' => 'h'
    );
    $iso9_table = array_merge($iso9_table, $geo2lat);

    $locale = get_locale();
    switch ( $locale ) {
        case 'bg_BG':
            $iso9_table['Щ'] = 'SHT';
            $iso9_table['щ'] = 'sht';
            $iso9_table['Ъ'] = 'A`';
            $iso9_table['ъ'] = 'a`';
            break;
        case 'uk':
            $iso9_table['И'] = 'Y`';
            $iso9_table['и'] = 'y`';
            break;
    }


        $option = strtr($option, apply_filters('ctl_table', $iso9_table));
        if (function_exists('iconv')){
            $option = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $option);
        }
        $option = preg_replace("/[^A-Za-z0-9'_\-\.]/", '-', $option);
        $option = preg_replace('/\-+/', '-', $option);
        $option = preg_replace('/^-+/', '', $option);
        $option = preg_replace('/-+$/', '', $option);

    return $option;
}

//=================

function ajax_action_stuff() {
    $wppage_slug = $_POST['wppage_slug']; // getting variables from ajax post
    // doing ajax stuff
    if(empty($wppage_slug)) {
        $wppage_slug = 'wppage';
    }
    $wppage_slug = wppage_sanitize_option($wppage_slug);
    update_option('wppage_base_slug', $wppage_slug);
    $wppage_updater_plugin = 'wppage/wppage.php';
    deactivate_plugins( $wppage_updater_plugin );
    activate_plugins( $wppage_updater_plugin );
    echo $wppage_slug;
    die(); // stop executing script
}
add_action( 'wp_ajax_ajax_action', 'ajax_action_stuff' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_ajax_action', 'ajax_action_stuff' ); // ajax for not logged in users

//==================
