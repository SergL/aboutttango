<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<!-- Страница разработана генератором целевых страниц wppage для wordpress (http://wppage.ru) -->














































































































































































































































































































































<html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" itemscope itemtype="http://schema.org/Article">

<head>
<meta name="generator" content="wppage 3.0 | http://wppage.ru"/>
<?php
global $post;

//--------------------

/**/
$media = get_post_meta($post->ID, '_coach_media', true);
$coach_media_only = get_post_meta( $post->ID, '_coach_media_only', true);
if($coach_media_only != 'on'){
    $coach_media_only = 'off';
}

// get stopper options
$stopper_status = get_post_meta($post->ID, '_stopper_status', true);
$stopper_url = get_post_meta($post->ID, '_stopper_url', true);
$stopper_text = get_post_meta($post->ID, '_stopper_text', true);
$stopper_text = str_replace(array("\n", "\r"), array('\n', ''), $stopper_text);

// get responder options
$wpp_media_response_type = get_post_meta($post->ID, '_wpp_media_response_type', true);
$wpp_getresponse_wid = get_post_meta($post->ID, '_wpp_getresponse_wid', true);

//-------
$wpp3_media_response_type = get_post_meta($post->ID, '_wpp3_media_response_type', true);
$wpp3_media_smartresponder_code = get_post_meta($post->ID, '_wpp3_media_smartresponder_code', true);
$wpp3_media_mailchimp_code = get_post_meta($post->ID, '_wpp3_media_mailchimp_code', true);
$wpp3_media_getresponse_code = get_post_meta($post->ID, '_wpp3_media_getresponse_code', true);
$wpp3_media_justclick_code = get_post_meta($post->ID, '_wpp3_media_justclick_code', true);
$wpp3_media_unisender_code = get_post_meta($post->ID, '_wpp3_media_unisender_code', true);

//options
$ps_background_color = get_post_meta($post->ID, '_ps_background_color', true);
$ps_background_image = get_post_meta($post->ID, '_ps_background_image', true);
$ps_background_image_repeat = get_post_meta($post->ID, '_ps_background_image_repeat', true);
$ps_background_image_attachment = get_post_meta($post->ID, '_ps_background_image_attachment', true);

$responder_button_style = (get_post_meta($post->ID, '_responder_button_style', true)) ? get_post_meta($post->ID, '_responder_button_style', true) : '1';
$coach_newsletter_name_helper = get_post_meta($post->ID, '_coach_newsletter_name_helper', true);
$coach_newsletter_email_helper = get_post_meta($post->ID, '_coach_newsletter_email_helper', true);
$responder_button_text = get_post_meta($post->ID, '_responder_button_text', true);
$coach_newsletter_description = get_post_meta($post->ID, '_coach_newsletter_description', true);

$coach_responder_tid = get_post_meta($post->ID, '_coach_responder_tid', true);
$coach_responder_uid = get_post_meta($post->ID, '_coach_responder_uid', true);
$coach_responder_did = get_post_meta($post->ID, '_coach_responder_did', true);

//
$wppage_head_code = get_post_meta($post->ID, '_wppage_head_code', true);
$wppage_body_code = get_post_meta($post->ID, '_wppage_body_code', true);
$wppage_footer_code = get_post_meta($post->ID, '_wppage_footer_code', true);


// get seo options
$title = get_post_meta($post->ID, '_wppage_seo_title', true);
$keywords = get_post_meta($post->ID, '_wppage_seo_keywords', true);
$desc = get_post_meta($post->ID, '_wppage_seo_desc', true);

$ps_border_color = get_post_meta($post->ID, '_ps_border_color', true);
$ps_border_style = get_post_meta($post->ID, '_ps_border_style', true);
$ps_border_width = get_post_meta($post->ID, '_ps_border_width', true);
$ps_content_shadow_color = get_post_meta($post->ID, '_ps_content_shadow_color', true);
$ps_content_shadow_blur = get_post_meta($post->ID, '_ps_content_shadow_blur', true);
$ps_content_background_color = get_post_meta($post->ID, '_ps_content_background_color', true);
$ps_content_color = get_post_meta($post->ID, '_ps_content_color', true);
$ps_content_width = get_post_meta($post->ID, '_ps_content_width', true) ? get_post_meta($post->ID,
    '_ps_content_width', true) : '687';

$mediabox_background_color = get_post_meta($post->ID, '_mediabox_background_color', true);
$mediabox_color = get_post_meta($post->ID, '_mediabox_color', true);
$mediabox_border_color = get_post_meta($post->ID, '_mediabox_border_color', true);
$mediabox_border_style = get_post_meta($post->ID, '_mediabox_border_style', true);
$mediabox_border_width = get_post_meta($post->ID, '_mediabox_border_width', true);
$mediabox_shadow_color = get_post_meta($post->ID, '_mediabox_shadow_color', true);
$mediabox_shadow_blur = get_post_meta($post->ID, '_mediabox_shadow_blur', true);

$wpp_media_response_type = get_post_meta($post->ID, '_wpp_media_response_type', true);
$wpp_media_smartresponder_code = get_post_meta($post->ID, '_wpp_media_smartresponder_code', true);
$wpp_media_unisender_code = get_post_meta($post->ID, '_wpp_media_unisender_code', true);
$wpp_media_mailchimp_code = get_post_meta($post->ID, '_wpp_media_mailchimp_code', true);
$wpp_media_justclick_code = get_post_meta($post->ID, '_wpp_media_justclick_code', true);
$wpp_media_getresponse_code = get_post_meta($post->ID, '_wpp_media_getresponse_code', true);

/* smartresponder options */
$wpp_smartresponder_bg_color_1 = get_post_meta($post->ID, '_wpp_smartresponder_bg_color_1', true);
$wpp_smartresponder_bg_color_2 = get_post_meta($post->ID, '_wpp_smartresponder_bg_color_2', true);
$wpp_smartresponder_border_color = get_post_meta($post->ID, '_wpp_smartresponder_border_color', true);
$wpp_smartresponder_border_width = get_post_meta($post->ID, '_wpp_smartresponder_border_width', true);
$wpp_smartresponder_border_style = get_post_meta($post->ID, '_wpp_smartresponder_border_style', true);
$wpp_smartresponder_button_style = get_post_meta($post->ID, '_wpp_smartresponder_button_style', true);
$wpp_smartresponder_button_text = get_post_meta($post->ID, '_wpp_smartresponder_button_text', true);
$wpp_smartresponder_code = get_post_meta($post->ID, '_wpp_smartresponder_code', true);
$wpp_smartresponder_tid = get_post_meta($post->ID, '_wpp_smartresponder_tid', true);
$wpp_smartresponder_uid = get_post_meta($post->ID, '_wpp_smartresponder_uid', true);
$wpp_smartresponder_did = get_post_meta($post->ID, '_wpp_smartresponder_did', true);

$wpp_smartresponder_code_3 = get_post_meta($post->ID, '_wpp_smartresponder_code_3', true);
/* */

$wpp_media_smartresponder_form_version = get_post_meta($post->ID, '_wpp_media_smartresponder_form_version', true);

$wpp_media_smartresponder_title = get_post_meta($post->ID, '_wpp_media_smartresponder_title', true);
$wpp_media_smartresponder_bg_color_1 = get_post_meta($post->ID, '_wpp_media_smartresponder_bg_color_1', true);
$wpp_media_smartresponder_bg_color_2 = get_post_meta($post->ID, '_wpp_media_smartresponder_bg_color_2', true);
$wpp_media_smartresponder_border_color = get_post_meta($post->ID, '_wpp_media_smartresponder_border_color', true);
$wpp_media_smartresponder_border_width = get_post_meta($post->ID, '_wpp_media_smartresponder_border_width', true);
$wpp_media_smartresponder_border_style = get_post_meta($post->ID, '_wpp_media_smartresponder_border_style', true);
$wpp_media_smartresponder_button_style = get_post_meta($post->ID, '_wpp_media_smartresponder_button_style', true);
$wpp_media_smartresponder_button_text = get_post_meta($post->ID, '_wpp_media_smartresponder_button_text', true);
$wpp_media_smartresponder_code = get_post_meta($post->ID, '_wpp_media_smartresponder_code', true);
$wpp_media_smartresponder_tid = get_post_meta($post->ID, '_wpp_media_smartresponder_tid', true);
$wpp_media_smartresponder_uid = get_post_meta($post->ID, '_wpp_media_smartresponder_uid', true);
$wpp_media_smartresponder_did = get_post_meta($post->ID, '_wpp_media_smartresponder_did', true);
$wpp_media_smartresponder_show_name = get_post_meta($post->ID, '_wpp_media_smartresponder_show_name', true);
$wpp_media_smartresponder_show_email = get_post_meta($post->ID, '_wpp_media_smartresponder_show_email', true);
$wpp_media_smartresponder_show_tel = get_post_meta($post->ID, '_wpp_media_smartresponder_show_tel', true);

/**/

if ($ps_border_width) {
    $ps_width = $ps_content_width - $ps_border_width * 2;
    $bonus_box_margin_left = 122 + $ps_border_width;

} else {
    $ps_width = $ps_content_width;
    $bonus_box_margin_left = 122;
}
if (($ps_width + $ps_border_width + $mediabox_border_width) < 860) {
    $mediabox_margin_left = -40 - (860 - $ps_width) / 2 - $ps_border_width - $mediabox_border_width;

} else {
    $mediabox_margin_left = -40 - $ps_border_width - $mediabox_border_width;
}

if ($ps_background_image_attachment == 'on') {
    $ps_background_image_attachment_prop = 'fixed';
}else{
    $ps_background_image_attachment_prop = 'repeat';
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="description" content="<?php echo $desc; ?>">
<?php wppage_meta(); ?>
<title><?php echo $title; ?></title>
<link type="text/css" rel="stylesheet"
      href="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wppage/css/page_selling_style.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
<?php wppage_head(); ?>

<script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?11" charset="windows-1251"></script>
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?33"></script>
<script type="text/javascript">
    VK.init({apiId: <?php echo (get_option('vkontakte_apiId')) ? get_option('vkontakte_apiId') : '0'; ?>, onlyWidgets:true});
</script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<?php if ($stopper_status == 'on') { ?>
    <?php if (function_exists(add_stopper_audio)) {
        add_stopper_audio();
    } ?>
<style type="text/css">
    html, body {
        height: 100%;
    }
</style>
    <?php } ?>
<style type="text/css">
    body {
        background-color: #<?php echo $ps_background_color; ?> !important;
        <?php if($ps_background_image) {?>
        background-image: url(<?php echo $ps_background_image; ?>);
        background-attachment: <?php echo $ps_background_image_attachment_prop; ?> !important;
        background-repeat: <?php echo $ps_background_image_repeat; ?> !important;
        <?php } ?>
    }

    #ps_content {
        width: <?php echo $ps_width; ?>px;
        border-style:<?php echo $ps_border_style; ?>;
        border-color: #<?php echo $ps_border_color; ?>;
        border-width: <?php echo $ps_border_width; ?>px;
        background-color: #<?php echo $ps_content_background_color; ?>;
        color: #<?php echo $ps_content_color; ?>;
        box-shadow: 0px 0px <?php echo $ps_content_shadow_blur ?>px #<?php echo $ps_content_shadow_color; ?>;
        -webkit-box-shadow: 0px 0px <?php echo $ps_content_shadow_blur ?>px #<?php echo $ps_content_shadow_color; ?>;
        -moz-box-shadow: 0px 0px <?php echo $ps_content_shadow_blur ?>px #<?php echo $ps_content_shadow_color; ?>;
    }

    .ps_bonus_box_wide {
        width: <?php echo $ps_width + ($ps_border_width * 2); ?>px;
        margin: 10px <?php echo (-20 - $ps_border_width); ?>px;
    }

    .ps_bonus_box {
        margin: 10px 0px 10px -<?php echo $bonus_box_margin_left; ?>px !important;
    }

    .bonus_table_box_t {
        margin: 0 <?php echo (-20 - $ps_border_width); ?>px !important;
    }

    .ps_media_box {
        border-style:<?php echo $mediabox_border_style; ?>;
        border-color: #<?php echo $mediabox_border_color; ?>;
        border-width: <?php echo $mediabox_border_width; ?>px;
        background-color: #<?php echo $mediabox_background_color; ?>;
        color: #<?php echo $mediabox_color; ?>;
        margin: 0 <?php echo $mediabox_margin_left; ?>px;
        box-shadow: 0px 0px <?php echo $mediabox_shadow_blur ?>px #<?php echo $mediabox_shadow_color; ?>;
        -moz-box-shadow: 0px 0px <?php echo $mediabox_shadow_blur ?>px #<?php echo $mediabox_shadow_color; ?>;
        -webkit-box-shadow: 0px 0px <?php echo $mediabox_shadow_blur ?>px #<?php echo $mediabox_shadow_color; ?>;

    }
    <?php if($coach_media_only == 'on' && $media == 'on'){ ?>
        #ps_content{
            border-color: transparent!important;
            background: transparent!important;
        }
    <?php } ?>

</style>
<script type="text/javascript">
    jQuery(function ($) {
        //----------------------- activate external payment buttons
        $('input.ps_external_make_order').live('click', function () {
            window.open($(this).attr('alt'), $(this).attr('formtarget'));
        });

        //-----------
        $('.ps_media_wrap input.wf-button').live('change', function () {
            $('.ps_media_wrap input.wf-button').addClass('ps_cbutton').addClass('ps_button_<?php echo $responder_button_style; ?>');
        });

    });
</script>
<!-- wppage head code -->
<?php echo $wppage_head_code; ?>
<!-- / wppage head code -->
</head>

<body <?php body_class(); echo ' '.$wppage_body_code; ?>>
<?php if ($stopper_status == 'on') { ?>
<div id="stopper_sound" style="display:none">
</div>
<div id="stopper_plugin_content_part_one">
<?php } ?>
<div id="ps_page">
<div id="ps_content">
<?php edit_post_link(); ?>
<?php if (have_posts()): while (have_posts()): the_post(); ?>
    <?php
    if ( $media == 'on'):
        ?>
    <h1 class="ps_page_title">
        <?php echo $coach_title = get_post_meta($post->ID, '_coach_title', true); ?>
    </h1>
    <div class="ps_media_wrap">
        <div class="ps_media_box">
            <div class="ps_media_content">
                <div class="ps_video">
                    <?php
                    if (get_post_meta(get_the_ID(), '_coach_use_image', true) == 'on') {
                        the_post_thumbnail(array(579, 359), false);

                    } else {
                        $video_link = get_post_meta(get_the_ID(), '_coach_video_link', true);
                        $autoplay = get_post_meta(get_the_ID(), '_coach_video_play', true);

                        $video_url = parse_url($video_link);
                        if ($video_url[host] == 'vimeo.com') { // if it's vimeo

                            sscanf(parse_url($video_link, PHP_URL_PATH), '/%d', $vimeo_video_id);
                            $autoplay = ($autoplay == on) ? '?autoplay=true' : '';
                            $video = '<iframe class="no_border" src="http://player.vimeo.com/video/' . $vimeo_video_id . $autoplay . '" width="579" height="359" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                            echo $video;

                        } else { // if youtube or hosted on this site

                            $video = $video_link . '?' . $video_play;
                            echo do_shortcode('[wpp_uppod video=' . $video . ' width=570 height=353 autoplay=' . $autoplay . ']');
                        }

                    }

                    ?>
                </div>
                <div class="wpp_media_subscription">
        <?php

        $wpp_media_smartresponder_title = get_post_meta($post->ID, '_wpp_media_smartresponder_title', true);
        $wpp_media_smartresponder_bg_color_1 = get_post_meta($post->ID, '_wpp_media_smartresponder_bg_color_1', true);
        $wpp_media_smartresponder_bg_color_2 = get_post_meta($post->ID, '_wpp_media_smartresponder_bg_color_2', true);
        $wpp_media_smartresponder_border_color = get_post_meta($post->ID, '_wpp_media_smartresponder_border_color', true);
        $wpp_media_smartresponder_border_width = get_post_meta($post->ID, '_wpp_media_smartresponder_border_width', true);
        $wpp_media_smartresponder_border_style = get_post_meta($post->ID, '_wpp_media_smartresponder_border_style', true);
        $wpp_media_smartresponder_button_style = get_post_meta($post->ID, '_wpp_media_smartresponder_button_style', true);
        $wpp_media_smartresponder_button_text = get_post_meta($post->ID, '_wpp_media_smartresponder_button_text', true);
        $wpp_media_smartresponder_code = get_post_meta($post->ID, '_wpp_media_smartresponder_code', true);
        $wpp_media_smartresponder_tid = get_post_meta($post->ID, '_wpp_media_smartresponder_tid', true);
        $wpp_media_smartresponder_uid = get_post_meta($post->ID, '_wpp_media_smartresponder_uid', true);
        $wpp_media_smartresponder_did = get_post_meta($post->ID, '_wpp_media_smartresponder_did', true);
        $wpp_media_smartresponder_show_name = get_post_meta($post->ID, '_wpp_media_smartresponder_show_name', true);
        $wpp_media_smartresponder_show_email = get_post_meta($post->ID, '_wpp_media_smartresponder_show_email', true);
        $wpp_media_smartresponder_show_tel = get_post_meta($post->ID, '_wpp_media_smartresponder_show_tel', true);

        if ($wpp3_media_response_type == 'smartresponder'){
            if ($wpp_media_smartresponder_form_version == 'old') {
                $css = "<style type='text/css'>
                                .wpp_media_smartresp_box{
                                background-color: #$wpp_media_smartresponder_bg_color_1;
                                background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#$wpp_media_smartresponder_bg_color_1), to(#$wpp_media_smartresponder_bg_color_2));
                                background-image: -webkit-linear-gradient(top, #$wpp_media_smartresponder_bg_color_1, #$wpp_media_smartresponder_bg_color_2);
                                background-image:    -moz-linear-gradient(top, #$wpp_media_smartresponder_bg_color_1, #$wpp_media_smartresponder_bg_color_2);
                                background-image:     -ms-linear-gradient(top, #$wpp_media_smartresponder_bg_color_1, #$wpp_media_smartresponder_bg_color_2);
                                background-image:      -o-linear-gradient(top, #$wpp_media_smartresponder_bg_color_1, #$wpp_media_smartresponder_bg_color_2);
                                border-color:#$wpp_media_smartresponder_border_color;
                                border-style:$wpp_media_smartresponder_border_style;
                                border-width:" . $wpp_media_smartresponder_border_width . "px;
                                }
                                .wpp_media_smartresp_box input[type=text]{
                                border: 1px solid #$wpp_media_smartresponder_border_color;
                                }
                                </style>";
                echo $css;
                ?>

            <!-- -->
            <div class="wpp_media_smartresp_box">
                <script language="JavaScript" type="text/javascript">
                    function SR_IsListSelected(el) {
                        for (var i = 0; i < el.length; i++)
                            if (el[i].selected ||
                                    el[i].checked)
                                return i;
                        return -1;
                    }
                    function SR_trim(f) {
                        return f.toString().replace(/^[ ]+/, '').replace(/[ ]+$/, '');
                    }
                    function SR_submit(f) {
                        f["field_email"].value = SR_trim(f["field_email"].value);
                        f["field_name_first"].value = SR_trim(f["field_name_first"].value);
                        if ((SR_focus = f["field_email"]) && f["field_email"].value.replace(/^[ ]+/, '').replace(/[ ]+$/, '').length < 1 || (SR_focus = f["field_name_first"]) && f["field_name_first"].value.replace(/^[ ]+/, '').replace(/[ ]+$/, '').length < 1) {
                            alert("Укажите значения всех обязательных для заполнения полей (помечены звездочкой)");
                            SR_focus.focus();
                            return false;
                        }
                        if (!f["field_email"].value.match(/^[A-Za-z0-9][A-Za-z0-9\._-]*[A-Za-z0-9_]*@([A-Za-z0-9]+([A-Za-z0-9-]*[A-Za-z0-9]+)*\.)+[A-Za-z]+$/)) {
                            alert("Некорректный синтаксис email-адреса!");
                            f["field_email"].focus();
                            return false;
                        }
                        return true;
                    }
                </script>
                <?php if($wpp_media_smartresponder_title) echo '<div class="ps_SM_headline">' . $wpp_media_smartresponder_title . '</div>' ?>
                <form name="SR_form" target="_blank" action="http://smartresponder.ru/subscribe.html"
                      method="post"
                      onsubmit="return SR_submit(this)">
                    <input type="hidden" name="version" value="1">
                    <input type="hidden" name="tid" value="<?php echo $wpp_media_smartresponder_tid; ?>">
                    <input type="hidden" name="uid" value="<?php echo $wpp_media_smartresponder_uid; ?>">
                    <input type="hidden" name="lang" value="ru">
                    <input type="hidden" name="charset" value="windows-1251">
                    <input type="hidden" name="did[]" value="<?php echo $wpp_media_smartresponder_did; ?>">
                    <?php if ($wpp_media_smartresponder_show_name) { ?>
                    <input type="text" size="17" class="Contact0FirstName"
                           value="Ваше имя"
                           onblur="if(this.value=='') this.value='Ваше имя'"
                           onfocus="if(this.value=='Ваше имя') this.value=''"
                           name="field_name_first">
                    <?php } ?>
                    <?php if ($wpp_media_smartresponder_show_email) { ?>
                    <input type="text" size="17" class="Contact0Email"
                           value="Ваш E-mail"
                           onblur="if(this.value=='') this.value='Ваш E-mail'"
                           onfocus="if(this.value=='Ваш E-mail') this.value=''"
                           name="field_email">
                    <?php } ?>
                    <?php if ($wpp_media_smartresponder_show_tel) { ?>
                    <input class="field" type="text" name="field_phones" value="Введите ваш телефон"
                           onblur='if(this.value=="") this.value="Введите ваш телефон"'
                           onfocus='if(this.value=="Введите ваш телефон") this.value=""'>
                    <?php } ?>

                    <input type="submit"
                           class="ps_cbutton ps_button_<?php echo $wpp_media_smartresponder_button_style; ?>"
                           value="<?php echo $wpp_media_smartresponder_button_text; ?>" name="SR_submitButton">

                </form>
                <?php $coach_privacy_show = get_post_meta($post->ID, '_coach_privacy_show', true);
                if ($coach_privacy_show == 'on'):  ?>
                    <div class="ps_privacy">
                        <?php echo $coach_privacy_description = get_post_meta($post->ID, '_coach_privacy_description', true); ?>
                    </div>
                    <?php endif; ?>
            </div>

            <!-- // smartresponder -->

                <?php
            }elseif ($wpp_media_smartresponder_form_version == 'new') {
            echo $wpp3_media_smartresponder_code;

        }else {
            echo $wpp3_media_smartresponder_code;
        }

    } elseif ($wpp3_media_response_type == 'getresponse') {
        echo $wpp3_media_getresponse_code;
    } elseif ($wpp3_media_response_type == 'mailchimp') {
        echo $wpp3_media_mailchimp_code;
    } elseif ($wpp3_media_response_type == 'justclick') {
        echo $wpp3_media_justclick_code;
    } elseif ($wpp3_media_response_type == 'unisender') {
        echo $wpp3_media_unisender_code;
    } elseif ($wpp_media_response_type == 'smartresponder') {
        ?>
            <!-- -->
    <script language="JavaScript" type="text/javascript">
        function SR_IsListSelected(el) {
            for (var i = 0; i < el.length; i++)
                if (el[i].selected ||
                        el[i].checked)
                    return i;
            return -1;
        }
        function SR_trim(f) {
            return f.toString().replace(/^[ ]+/, '').replace(/[ ]+$/, '');
        }
        function SR_submit(f) {
            f["field_email"].value = SR_trim(f["field_email"].value);
            f["field_name_first"].value = SR_trim(f["field_name_first"].value);
            if ((SR_focus = f["field_email"]) && f["field_email"].value.replace(/^[ ]+/, '').replace(/[ ]+$/, '').length < 1 || (SR_focus = f["field_name_first"]) && f["field_name_first"].value.replace(/^[ ]+/, '').replace(/[ ]+$/, '').length < 1) {
                alert("Укажите значения всех обязательных для заполнения полей (помечены звездочкой)");
                SR_focus.focus();
                return false;
            }
            if (!f["field_email"].value.match(/^[A-Za-z0-9][A-Za-z0-9\._-]*[A-Za-z0-9_]*@([A-Za-z0-9]+([A-Za-z0-9-]*[A-Za-z0-9]+)*\.)+[A-Za-z]+$/)) {
                alert("Некорректный синтаксис email-адреса!");
                f["field_email"].focus();
                return false;
            }
            return true;
        }
    </script>
    <form name="SR_form" target="_blank" action="http://smartresponder.ru/subscribe.html"
          method="post"
          onsubmit="return SR_submit(this)">
        <input type="hidden" name="version" value="1">
        <input type="hidden" name="tid" value="<?php echo $coach_responder_tid; ?>">
        <input type="hidden" name="uid" value="<?php echo $coach_responder_uid; ?>">
        <input type="hidden" name="lang" value="ru">
        <input type="hidden" name="charset" value="windows-1251">
        <input type="hidden" name="did[]" value="<?php echo $coach_responder_did; ?>">


        <input type="text" size="17" class="Contact0FirstName"
               value="<?php echo $coach_newsletter_name_helper; ?>"
               onblur="if(this.value=='') this.value='<?php echo $coach_newsletter_name_helper; ?>'"
               onfocus="if(this.value=='<?php echo $coach_newsletter_name_helper; ?>') this.value=''"
               name="field_name_first">
        <input type="text" size="17" class="Contact0Email"
               value="<?php echo $coach_newsletter_email_helper; ?>"
               onblur="if(this.value=='') this.value='<?php echo $coach_newsletter_email_helper; ?>'"
               onfocus="if(this.value=='<?php echo $coach_newsletter_email_helper; ?>') this.value=''"
               name="field_email">
        <input type="submit" class="ps_cbutton ps_button_<?php echo $responder_button_style; ?>"
               value="<?php echo $responder_button_text; ?>" name="SR_submitButton">

    </form>

        <?php } elseif ($wpp_media_response_type == 'getresponse') { ?>
            <!-- getresponse -->
    <div id="WFItem<?php echo $wpp_getresponse_wid; ?>" class="wf-formTpl">
        <form accept-charset="utf-8" action="https://app.getresponse.com/add_contact_webform.html"
              method="post">
            <div class="box">
                <div id="WFIcenter" class="wf-body">
                    <ul class="wf-sortable" id="wf-sort-id">
                        <li class="wf-name" rel="undefined" style="display:  block !important; ">
                            <div class="wf-contbox">
                                <div class="wf-inputpos">
                                    <input class="wf-input wf-valid__length1to255" type="text"
                                           name="name"
                                           value="<?php echo $coach_newsletter_name_helper; ?>"
                                           onblur="if(this.value=='') this.value='<?php echo $coach_newsletter_name_helper; ?>'"
                                           onfocus="if(this.value=='<?php echo $coach_newsletter_name_helper; ?>') this.value=''"/>
                                </div>
                                <em class="clearfix clearer"></em>
                            </div>
                        </li>
                        <li class="wf-email" rel="undefined" style="display:  block !important; ">
                            <div class="wf-contbox">
                                <div class="wf-inputpos">
                                    <input class="wf-input wf-req wf-valid__email" type="text"
                                           name="email"
                                           value="<?php echo $coach_newsletter_email_helper; ?>"
                                           onblur="if(this.value=='') this.value='<?php echo $coach_newsletter_email_helper; ?>'"
                                           onfocus="if(this.value=='<?php echo $coach_newsletter_email_helper; ?>') this.value=''"/>
                                </div>
                                <em class="clearfix clearer"></em>
                            </div>
                        </li>
                        <li class="wf-submit" rel="undefined" style="display:  block !important; ">
                            <div class="wf-contbox">
                                <div class="wf-inputpos">
                                    <input type="submit"
                                           class="wf-button ps_cbutton ps_button_<?php echo $responder_button_style; ?>"
                                           name="submit"
                                           value="<?php echo $responder_button_text; ?>"/>
                                </div>
                                <em class="clearfix clearer"></em>
                            </div>
                        </li>
                        <li class="wf-counter" rel="undefined" style="display: none !important; ">
                            <div class="wf-contbox">
                                <div>
														<span
                                                                style="padding-top: 4px; padding-right: 6px; padding-bottom: 8px; padding-left: 24px; background-image: url(https://app.getresponse.com/images/core/webforms/countertemplates.png); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: 0% 0px; background-repeat: no-repeat no-repeat; "
                                                                class="wf-counterbox">
															<span class="wf-counterboxbg"
                                                                  style="padding-top: 4px; padding-right: 12px; padding-bottom: 8px; padding-left: 5px; background-image: url(https://app.getresponse.com/images/core/webforms/countertemplates.png); background-attachment: initial; background-origin: initial; background-clip: initial; background-color: initial; background-position: 100% -36px; background-repeat: no-repeat no-repeat; ">
																<span class="wf-counterbox0"
                                                                      style="padding-top: 5px; padding-right: 0px; padding-bottom: 5px; padding-left: 0px; "></span>
																<span
                                                                        style="padding-top: 5px; padding-right: 5px; padding-bottom: 5px; padding-left: 5px; "
                                                                        name="https://app.getresponse.com/display_subscribers_count.js?campaign_name=user321654&var=0"
                                                                        class="wf-counterbox1 wf-counterq">0</span>
																<span
                                                                        style="padding-top: 5px; padding-right: 0px; padding-bottom: 5px; padding-left: 0px; "
                                                                        class="wf-counterbox2">subscribers</span>
															</span>
														</span>
                                </div>
                            </div>
                        </li>
                        <li class="wf-captcha" rel="undefined" style="display:  none !important; ">
                            <div class="wf-contbox wf-captcha-1" id="wf-captcha-1"
                                 wf-captchaword="Enter the words above:"
                                 wf-captchasound="Enter the numbers you hear:"
                                 wf-captchaerror="Incorrect please try again"></div>
                        </li>
                    </ul>
                </div>
            </div>
            <input type="hidden" name="webform_id" value="<?php echo $wpp_getresponse_wid; ?>"/>
        </form>
    </div>
    <script type="text/javascript"
            src="http://app.getresponse.com/view_webform.js?wid=<?php echo $wpp_getresponse_wid; ?>&mg_param1=1"></script>
            <!-- // getresponse -->
        <?php } ?>
                </div>

            </div>
        </div>
    </div>
        <?php
    endif;
    ?>
<?php if($coach_media_only != 'on' && $media == 'on' || $media != 'on'){ ?>
<div class="ps_content">
    <?php
    remove_all_actions('the_content');
    remove_all_filters('the_content');
    add_filter('the_content', 'wpautop');
    add_filter('the_content', 'do_shortcode');
    the_content();

    ?>
    <div class="ps_clear"></div>
    <div class="ps_comments_wrap">
        <?php
//----
   /*     $use_comments_tabs = get_post_meta($post->ID, '_use_comments_tabs', true);
        $use_comments_stack = get_post_meta($post->ID, '_use_comments_stack', true);
        $use_comments_columns = get_post_meta($post->ID, '_use_comments_columns', true);

        $use_comments_tabs_order = explode(',', get_post_meta($post->ID, '_use_comments_tabs_order', true));
        $use_comments_stack_order = explode(',', get_post_meta($post->ID, '_use_comments_stack_order', true));
        $use_comments_columns_order = explode(',', get_post_meta($post->ID, '_use_comments_columns_order', true));

        $use_comments = get_post_meta($post->ID, '_use_comments', true);

        $use_comments_array = explode(',', $use_comments);

        if (get_post_meta($post->ID, '_use_comments_order', true) != '') {
            $use_comments_order = explode(',', get_post_meta($post->ID, '_use_comments_order', true));
        } else {
            $use_comments_order = explode(',', 'facebook,vk,wordpress');
        }*/

        $wppage_comments_style = get_post_meta($post->ID, '_wppage_comments_style', true); // keep this line

        if($wppage_comments_style){

            if($wppage_comments_style == 'tabs'){

                // if we have new comments options
                $use_comments_tabs = get_post_meta($post->ID, '_use_comments_tabs', true);
                if($use_comments_tabs != ''){
                    $use_comments = get_post_meta($post->ID, '_use_comments_tabs', true);
                    $use_comments_order = explode(',', get_post_meta($post->ID, '_use_comments_tabs_order', true));
                    $use_comments_array = explode(',', $use_comments);
                }else{ // if here no new comments options, than we have to check old options
                    $use_comments = get_post_meta($post->ID, '_use_comments', true);
                    $use_comments_order = explode(',', get_post_meta($post->ID, '_use_comments_order', true));
                    $use_comments_array = explode(',', $use_comments);
                }
                ?>
                <script type="text/javascript">
                    jQuery(function ($) {
                        $("#wpp_comments_tab").tabs({
                            select: function(myevent, ui){
                                $.scrollTo($('#wpp_comments_tab'),300,{offset:0, margin:true});
                            }
                        });
                        //---------------------------------------------------
                        var nav_top = $('#wppage_comments_tabs_nav').offset();
                        var top = $(window).scrollTop();
                        $(window).scroll(function () {
                            top = $(window).scrollTop();
                            if (nav_top.top < top) {
                                $('#wppage_comments_tabs_nav').addClass('fixed');
                                $('#wpp_comments_tab').css({'padding-top': '53px'});
                            } else {
                                if ($('#wppage_comments_tabs_nav').hasClass('fixed')) {
                                    $('#wppage_comments_tabs_nav').removeClass('fixed').addClass( 'normal');
                                    $('#wpp_comments_tab').css({'padding-top': '0px'});
                                }
                            }
                        });


                    });
                </script>
                <style type="text/css">
                    .fixed{
                        position: fixed;
                        top:0;

                    }
                    #wppage_comments_tabs_nav{
                        display: block;
                        width: <?php echo $ps_content_width-20; ?>px;
                        background: #<?php echo  $ps_content_background_color; ?>;
                        z-index: 99;
                        padding: 10px 0;
                    }

                </style>
                <div id="wpp_comments_tab">
                    <ul id="wppage_comments_tabs_nav">
                        <?php foreach ($use_comments_order as $comment_item) :
                            ?>
                            <?php if ($comment_item == 'facebook' && in_array($comment_item, $use_comments_array)) { ?>
                            <li><a href="#tab-<?php echo $comment_item; ?>" class="fb_comments_ico s_icon">Комментарии Facebook</a></li>
                        <?php } ?>
                            <?php if ($comment_item == 'vk' && in_array($comment_item, $use_comments_array)) { ?>
                            <li><a href="#tab-<?php echo $comment_item; ?>" class="vk_comments_ico s_icon">Комментарии Вконтакте</a></li>
                        <?php } ?>
                            <?php if ($comment_item == 'wordpress' && in_array($comment_item, $use_comments_array)) { ?>
                            <li><a href="#tab-<?php echo $comment_item; ?>" class="wp_comments_ico s_icon">Комментарии wordpress</a></li>
                        <?php } ?>
                        <?php endforeach; ?>
                    </ul>
                    <?php foreach ($use_comments_order as $comment_item) :
                        ?>
                        <?php if ($comment_item == 'facebook' && in_array($comment_item, $use_comments_array)) { ?>
                        <div id="tab-<?php echo $comment_item; ?>">
                            <div id="fb-root"></div>
                            <script src="http://connect.facebook.net/ru_RU/all.js#xfbml=1"></script>
                            <fb:comments href="<?php the_permalink(); ?>" num_posts="300" width="<?php echo
                                $ps_content_width - 20;
                            ?>"></fb:comments>
                        </div>
                    <?php } ?>
                        <?php if ($comment_item == 'vk' && in_array($comment_item, $use_comments_array)) { ?>
                        <div id="tab-<?php echo $comment_item; ?>">
                            <div id="vk_comments"></div>
                            <script type="text/javascript">
                                VK.Widgets.Comments("vk_comments", {limit:10, width:"<?php echo $ps_content_width - 20;
                            ?>", attach:"*"});
                            </script>
                        </div>
                    <?php } ?>
                        <?php if ($comment_item == 'wordpress' && in_array($comment_item, $use_comments_array)) { ?>
                        <div id="tab-<?php echo $comment_item; ?>">
                            <?php if(comments_open() || have_comments()): ?>
                                <div id="comments">
                                    <?php global $post;
                                    $comments = get_comments('post_id='.$post->ID); ?>

                                    <h2 id="comments-title"><?php
                                        printf( _n( 'Один комментарий к &ldquo;%2$s&rdquo;', '%1$s комментариев к &ldquo;%2$s&rdquo;', get_comments_number() ),
                                            number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                                        ?></h2>

                                    <ol class="commentlist clearfix">
                                        <?php wp_list_comments('',$comments); ?>
                                    </ol>

                                    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                                        <div class="navigation">
                                            <div class="nav-previous"><?php previous_comments_link(); ?></div>
                                            <div class="nav-next"><?php next_comments_link(); ?></div>
                                            <div class="clear"></div>
                                        </div><!-- .navigation -->
                                    <?php endif; // check for comment navigation ?>


                                    <?php if (comments_open()): ?>
                                        <div id="respond" class="noI">
                                            <?php wppage_comment_form(); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    <?php } ?>
                    <?php endforeach; ?>

                </div>

            <?php
            }elseif($wppage_comments_style == 'stack'){
                // if we have new comments options
                $use_comments_stack = get_post_meta($post->ID, '_use_comments_stack', true);
                if($use_comments_stack != ''){
                    $use_comments = get_post_meta($post->ID, '_use_comments_stack', true);
                    $use_comments_order = explode(',', get_post_meta($post->ID, '_use_comments_stack_order', true));
                    $use_comments_array = explode(',', $use_comments);
                }else{ // if here no new comments options, than we have to check old options
                    $use_comments = get_post_meta($post->ID, '_use_comments', true);
                    $use_comments_order = explode(',', get_post_meta($post->ID, '_use_comments_order', true));
                    $use_comments_array = explode(',', $use_comments);
                }

                foreach ($use_comments_order as $comment_item) :
                    ?>
                    <?php if ($comment_item == 'facebook' && in_array($comment_item, $use_comments_array)) { ?>
                    <div id="tab-<?php echo $comment_item; ?>">
                        <div id="fb-root"></div>
                        <script src="http://connect.facebook.net/ru_RU/all.js#xfbml=1"></script>
                        <fb:comments href="<?php the_permalink(); ?>" num_posts="300" width="<?php echo
                            $ps_content_width - 20;
                        ?>"></fb:comments>
                    </div>
                    <br>
                <?php } ?>
                    <?php if ($comment_item == 'vk' && in_array($comment_item, $use_comments_array)) { ?>
                    <div id="tab-<?php echo $comment_item; ?>">
                        <div id="vk_comments"></div>
                        <script type="text/javascript">
                            VK.Widgets.Comments("vk_comments", {limit:10, width:"<?php echo $ps_content_width - 20;
                                ?>", attach:"*"});
                        </script>
                    </div>
                    <br>
                <?php } ?>
                    <?php if ($comment_item == 'wordpress' && in_array($comment_item, $use_comments_array)) { ?>
                    <div id="tab-<?php echo $comment_item; ?>">
                        <?php if(comments_open() || have_comments()): ?>
                            <div id="comments">
                                <?php global $post;
                                $comments = get_comments('post_id='.$post->ID); ?>

                                <h2 id="comments-title"><?php
                                    printf( _n( 'Один комментарий к &ldquo;%2$s&rdquo;', '%1$s комментариев к &ldquo;%2$s&rdquo;', get_comments_number() ),
                                        number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                                    ?></h2>

                                <ol class="commentlist clearfix">
                                    <?php wp_list_comments('',$comments); ?>
                                </ol>

                                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                                    <div class="navigation">
                                        <div class="nav-previous"><?php previous_comments_link(); ?></div>
                                        <div class="nav-next"><?php next_comments_link(); ?></div>
                                        <div class="clear"></div>
                                    </div><!-- .navigation -->
                                <?php endif; // check for comment navigation ?>


                                <?php if (comments_open()): ?>
                                    <div id="respond" class="noI">
                                        <?php wppage_comment_form(); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                <?php }  endforeach;
            }elseif($wppage_comments_style == 'columns'){
                // if we have new comments options
                $use_comments_columns = get_post_meta($post->ID, '_use_comments_columns', true);
                if($use_comments_columns != ''){
                    $use_comments = get_post_meta($post->ID, '_use_comments_columns', true);
                    $use_comments_order = explode(',', get_post_meta($post->ID, '_use_comments_columns_order', true));
                    $use_comments_array = explode(',', $use_comments);
                }else{ // if here no new comments options, than we have to check old options
                    $use_comments = get_post_meta($post->ID, '_use_comments', true);
                    $use_comments_order = explode(',', get_post_meta($post->ID, '_use_comments_order', true));
                    $use_comments_array = explode(',', $use_comments);
                }

                foreach ($use_comments_order as $comment_item) :
                    ?>
                    <?php if ($comment_item == 'facebook' && in_array($comment_item, $use_comments_array)) { ?>
                    <div id="tab-<?php echo $comment_item; ?>" class="two_columns" style="width: <?php echo $ps_content_width/2 - 24; ?>px">
                        <div id="fb-root"></div>
                        <script src="http://connect.facebook.net/ru_RU/all.js#xfbml=1"></script>
                        <fb:comments href="<?php the_permalink(); ?>" num_posts="300" width="<?php echo
                            $ps_content_width/2 - 24;
                        ?>"></fb:comments>
                    </div>
                <?php } ?>
                    <?php if ($comment_item == 'vk' && in_array($comment_item, $use_comments_array)) { ?>
                    <div id="tab-<?php echo $comment_item; ?>" class="two_columns" style="width: <?php echo $ps_content_width/2 - 24; ?>px">
                        <div id="vk_comments"></div>
                        <script type="text/javascript">
                            VK.Widgets.Comments("vk_comments", {limit:10, width:"<?php echo $ps_content_width/2 - 24; ?>", attach:"*"});
                        </script>
                    </div>

                <?php } ?>
                    <?php if ($comment_item == 'wordpress' && in_array($comment_item, $use_comments_array)) { ?>
                    <div id="tab-<?php echo $comment_item; ?>" class="two_columns" style="width: <?php echo $ps_content_width/2 - 24; ?>px">
                        <?php if(comments_open() || have_comments()): ?>
                            <div id="comments">
                                <?php global $post;
                               // $comments = get_comments('post_id='.$post->ID);
                                $comments = get_comments(array('order' => 'ASC', 'post_id' => get_the_ID() ));
                                ?>

                                <h2 id="comments-title"><?php
                                    printf( _n( 'Один комментарий к &ldquo;%2$s&rdquo;', '%1$s комментариев к &ldquo;%2$s&rdquo;', get_comments_number() ),
                                        number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                                    ?></h2>

                                <ol class="commentlist clearfix">
                                    <?php wp_list_comments('',$comments); ?>
                                </ol>

                                <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
                                    <div class="navigation">
                                        <div class="nav-previous"><?php previous_comments_link(); ?></div>
                                        <div class="nav-next"><?php next_comments_link(); ?></div>
                                        <div class="clear"></div>
                                    </div><!-- .navigation -->
                                <?php endif; // check for comment navigation ?>


                                <?php if (comments_open()): ?>
                                    <div id="respond" class="noI">
                                        <?php wppage_comment_form(); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>
                    </div>
                <?php }  endforeach;

            }

        }?>
    </div>
</div>
    <?php } ?>
    <?php endwhile; endif; ?>
</div>


</div>
<div style="display:none">
    <div id="order_popup" class="ps_order_content">
        <?php wp_reset_query(); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post();
        $product_title = get_post_meta(get_the_ID(), '_product_title', true);
        $shop_id = get_post_meta(get_the_ID(), '_product_shop_id', true);
        $price = get_post_meta(get_the_ID(), '_product_price', true);
        $currency = get_post_meta(get_the_ID(), '_product_currency', true);
        $desc = get_post_meta(get_the_ID(), '_product_desc', true);
        $payment_id = uniqid();
        ?>
        <div class="p_content">
            <h2 class="p_title"><?php echo $product_title; ?></h2>

            <div class="p_thumb"><?php the_post_thumbnail(array(150, 150), false); ?></div>
            <div class="p_info" style="text-align: center;">
                <div>Цена: <span class="price"><?php echo $price; ?></span><span
                        class="currency"> <?php echo $currency; ?></span></div>
                <div>Описание: <?php echo $desc; ?></div>
            </div>
            <form name="payment" id="ik_form" action="https://interkassa.com/lib/payment.php" method="post"
                  enctype="application/x-www-form-urlencoded" accept-charset="cp1251" target="_blank">
                <input type="hidden" name="ik_shop_id" id="p_shop_id" value="<?php echo $shop_id; ?>">
                <input type="hidden" name="ik_payment_amount" id="p_price" value="<?php echo $price; ?>">
                <input type="hidden" name="ik_payment_id" id="p_payment_id" value="<?php echo $payment_id; ?>">
                <input type="hidden" name="ik_payment_desc" id="p_desc" value="<?php echo $product_title; ?>">
                <input type="hidden" name="ik_baggage_fields" id="ik_baggage_fields" value="">
                <span>Заполните форму</span><br/>

                <label for="p_name">Ф.И.О</label><input type="text" name="name" id="p_name" value="Ваше имя"
                                                        onBlur="if(this.value=='') this.value='Ваше имя'"
                                                        onFocus="if(this.value=='Ваше имя') this.value=''"/><br/>
                <label for="p_country">Страна</label><input type="text" name="country" id="p_country"
                                                            value="Ваша страна"
                                                            onBlur="if(this.value=='') this.value='Ваша страна'"
                                                            onFocus="if(this.value=='Ваша страна') this.value=''"/><br/>
                <label for="p_city">Город</label><input type="text" name="city" id="p_city" value="Ваш город"
                                                        onBlur="if(this.value=='') this.value='Ваш город'"
                                                        onFocus="if(this.value=='Ваш город') this.value=''"/><br/>
                <label for="p_address">Адрес</label><input type="text" name="address" id="p_address" value="Ваш адрес"
                                                           onBlur="if(this.value=='') this.value='Ваш адрес'"
                                                           onFocus="if(this.value=='Ваш адрес') this.value=''"/><br/>
                <label for="p_index">Индекс</label><input type="text" name="index" id="p_index" value="Ваш индекс"
                                                          onBlur="if(this.value=='') this.value='Ваш индекс'"
                                                          onFocus="if(this.value=='Ваш индекс') this.value=''"/><br/>
                <label for="p_tel">Телефон</label><input type="text" name="tel" id="p_tel" value="Ваш телефон"
                                                         onBlur="if(this.value=='') this.value='Ваш телефон'"
                                                         onFocus="if(this.value=='Ваш телефон') this.value=''"/><br/>
                <label for="p_e-mail">E-mail</label><input type="text" name="e-mail" id="p_e-mail" value="Ваш e-mail"
                                                           onBlur="if(this.value=='') this.value='Ваш e-mail'"
                                                           onFocus="if(this.value=='Ваш e-mail') this.value=''"/><br/>
                <input type="submit" name="process" id="ik_submit" value="Оплатить" on>
            </form>
            <script type="text/javascript">

                jQuery(function ($) {
                    $('#ik_form').submit(function () {
                        var fields = new Array('p_name', 'p_country', 'p_city', 'p_address', 'p_index', 'p_tel', 'p_e-mail');
                        var info = '';
                        for (var i = 0; i < fields.length; i++) {
                            if ($('#' + fields[i]).val()) {
                                info += $('#' + fields[i]).val() + ', ';
                            }
                        }
                        $('#ik_baggage_fields').val(info);
                        //return false;
                    });

                });
            </script>

        </div>
        <?php endwhile; endif; wp_reset_query(); ?>
    </div>
</div>
<?php if ($stopper_status == 'on') { ?>
	</div>
	<iframe style="z-index: 9999; display: none;" id="stopper_plugin_content_part_two" src="<?php echo $stopper_url; ?>"
            width="100%" height="100%"></iframe>
<script type="text/javascript">
    jQuery(function ($) {
        $(window).bind('beforeunload', function () {
            soundManager.play('stopper_sound');
            $('#stopper_plugin_content_part_one').css({'display':'none'});
            $('#stopper_plugin_content_part_two').css({'display':'block'});
            return '<?php echo $stopper_text; ?>';
        });
    });
</script>
    <?php } ?>
<?php wppage_footer(); ?>
<!-- wppage footer code -->
<?php echo $wppage_footer_code; ?>
<!-- / wppage footer code -->
<?php echo get_option('coach_analytics'); ?>
<!--
<?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds.
 -->
</body>
</html>