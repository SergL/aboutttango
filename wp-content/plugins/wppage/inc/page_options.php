<?php

function page_selling_extra()
{
    global $post;

    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="page_selling_noncename" id="page_selling_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';

    // package;

    $user_serial = get_option('wppage_serial_number');


    // Get the data if its already been entered
    $coach_media = (get_post_meta($post->ID, '_coach_media', true) == 'on') ? 'on' : 'off';
    $coach_media_only = (get_post_meta($post->ID, '_coach_media_only', true) == 'on') ? 'checked="checked"' : '';

    $coach_title = get_post_meta($post->ID, '_coach_title', true);
    $coach_video_link = get_post_meta($post->ID, '_coach_video_link', true);
    $coach_video_play = (get_post_meta($post->ID, '_coach_video_play', true) == 'on') ? 'checked="checked"' : '';
    $coach_newsletter_description = get_post_meta($post->ID, '_coach_newsletter_description', true);
    $coach_newsletter_name_helper = get_post_meta($post->ID, '_coach_newsletter_name_helper', true);
    if ($coach_newsletter_name_helper == '') $coach_newsletter_name_helper = 'Подсказка к подписке';

    $wpp3_media_response_type = get_post_meta($post->ID, '_wpp3_media_response_type', true);
    if ($wpp3_media_response_type == '') $wpp3_media_response_type = 'smartresponder';
    $wpp3_media_mailchimp_code = get_post_meta($post->ID, '_wpp3_media_mailchimp_code', true);
    $wpp3_media_getresponse_code = get_post_meta($post->ID, '_wpp3_media_getresponse_code', true);
    $wpp3_media_justclick_code = get_post_meta($post->ID, '_wpp3_media_justclick_code', true);
    $wpp3_media_unisender_code = get_post_meta($post->ID, '_wpp3_media_unisender_code', true);

    $wpp3_media_smartresponder_code = get_post_meta($post->ID, '_wpp3_media_smartresponder_code', true);

    $wpp_media_smartresponder_form_version = get_post_meta($post->ID, '_wpp_media_smartresponder_form_version', true);
    if ($wpp_media_smartresponder_form_version == '') $wpp_media_smartresponder_form_version = 'new';
    $wpp_media_smartresponder_title = get_post_meta($post->ID, '_wpp_media_smartresponder_title', true);

    $wpp_media_smartresponder_bg_color_1 = get_post_meta($post->ID, '_wpp_media_smartresponder_bg_color_1', true);
    $wpp_media_smartresponder_bg_color_2 = get_post_meta($post->ID, '_wpp_media_smartresponder_bg_color_2', true);
    $wpp_media_smartresponder_border_color = get_post_meta($post->ID, '_wpp_media_smartresponder_border_color', true);
    $wpp_media_smartresponder_border_width = get_post_meta($post->ID, '_wpp_media_smartresponder_border_width', true);
    $wpp_media_smartresponder_border_style = get_post_meta($post->ID, '_wpp_media_smartresponder_border_style', true);
    $wpp_media_smartresponder_button_style = get_post_meta($post->ID, '_wpp_media_smartresponder_button_style', true);
    if ($wpp_media_smartresponder_button_style == '') $wpp_media_smartresponder_button_style = 1;
    $wpp_media_smartresponder_button_text = get_post_meta($post->ID, '_wpp_media_smartresponder_button_text', true);
    if ($wpp_media_smartresponder_button_text == '') $wpp_media_smartresponder_button_text = 'Подписаться';
    $wpp_media_smartresponder_code = get_post_meta($post->ID, '_wpp_media_smartresponder_code', true);
    $wpp_media_smartresponder_tid = get_post_meta($post->ID, '_wpp_media_smartresponder_tid', true);
    $wpp_media_smartresponder_uid = get_post_meta($post->ID, '_wpp_media_smartresponder_uid', true);
    $wpp_media_smartresponder_did = get_post_meta($post->ID, '_wpp_media_smartresponder_did', true);
    $wpp_media_smartresponder_show_name = get_post_meta($post->ID, '_wpp_media_smartresponder_show_name', true);
    $wpp_media_smartresponder_show_email = get_post_meta($post->ID, '_wpp_media_smartresponder_show_email', true);
    $wpp_media_smartresponder_show_tel = get_post_meta($post->ID, '_wpp_media_smartresponder_show_tel', true);


    $ps_background_color = get_post_meta($post->ID, '_ps_background_color', true) ? get_post_meta($post->ID, '_ps_background_color', true) : 'e3e3e3';
    $ps_content_shadow_color = get_post_meta($post->ID, '_ps_content_shadow_color', true);
    $ps_content_shadow_blur = get_post_meta($post->ID, '_ps_content_shadow_blur', true);
    $ps_border_color = get_post_meta($post->ID, '_ps_border_color', true) ? get_post_meta($post->ID, '_ps_border_color', true) : 'afafaf';
    $ps_border_style = get_post_meta($post->ID, '_ps_border_style', true) ? get_post_meta($post->ID, '_ps_border_style', true) : 'solid';
    $ps_border_width = get_post_meta($post->ID, '_ps_border_width', true);
    if ($ps_border_width === false) $ps_border_width = 1;

    $ps_content_width = get_post_meta($post->ID, '_ps_content_width', true);
    if($ps_content_width == '') $ps_content_width = 720;

    $ps_content_background_color = get_post_meta($post->ID, '_ps_content_background_color', true);
    $ps_content_color = get_post_meta($post->ID, '_ps_content_color', true);
    $ps_background_image = get_post_meta($post->ID, '_ps_background_image', true);
    $no_image_class = ($ps_background_image == '')? 'no_image': '';
    $ps_background_image_repeat = get_post_meta($post->ID, '_ps_background_image_repeat', true);
    $ps_background_image_attachment = get_post_meta($post->ID, '_ps_background_image_attachment', true);

    $mediabox_background_color = get_post_meta($post->ID, '_mediabox_background_color', true);
    $mediabox_color = get_post_meta($post->ID, '_mediabox_color', true);
    $mediabox_border_width = get_post_meta($post->ID, '_mediabox_border_width', true);
    $mediabox_border_color = get_post_meta($post->ID, '_mediabox_border_color', true);
    $mediabox_border_style = get_post_meta($post->ID, '_mediabox_border_style', true);
    $mediabox_shadow_color = get_post_meta($post->ID, '_mediabox_shadow_color', true);
    $mediabox_shadow_blur = get_post_meta($post->ID, '_mediabox_shadow_blur', true);

    $wpp_smartresponder_code_3 = get_post_meta($post->ID, '_wpp_smartresponder_code_3', true);

    $wpp_smartresponder_form_version = get_post_meta($post->ID, '_wpp_smartresponder_form_version', true);
    if ($wpp_smartresponder_form_version == '') $wpp_smartresponder_form_version = 'new';
    $wpp_smartresponder_title = get_post_meta($post->ID, '_wpp_smartresponder_title', true);

    $wpp_smartresponder_bg_color_1 = get_post_meta($post->ID, '_wpp_smartresponder_bg_color_1', true);
    $wpp_smartresponder_bg_color_2 = get_post_meta($post->ID, '_wpp_smartresponder_bg_color_2', true);
    $wpp_smartresponder_border_color = get_post_meta($post->ID, '_wpp_smartresponder_border_color', true);
    $wpp_smartresponder_border_width = get_post_meta($post->ID, '_wpp_smartresponder_border_width', true);
    $wpp_smartresponder_border_style = get_post_meta($post->ID, '_wpp_smartresponder_border_style', true);
    $wpp_smartresponder_button_style = get_post_meta($post->ID, '_wpp_smartresponder_button_style', true);
    if ($wpp_smartresponder_button_style == '') $wpp_smartresponder_button_style = 1;
    $wpp_smartresponder_button_text = get_post_meta($post->ID, '_wpp_smartresponder_button_text', true);
    if ($wpp_smartresponder_button_text == '') $wpp_smartresponder_button_text = 'Подписаться';
    $wpp_smartresponder_code = get_post_meta($post->ID, '_wpp_smartresponder_code', true);
    $wpp_smartresponder_tid = get_post_meta($post->ID, '_wpp_smartresponder_tid', true);
    $wpp_smartresponder_uid = get_post_meta($post->ID, '_wpp_smartresponder_uid', true);
    $wpp_smartresponder_did = get_post_meta($post->ID, '_wpp_smartresponder_did', true);

    $wpp_smartresponder_show_name = get_post_meta($post->ID, '_wpp_smartresponder_show_name', true);
    $wpp_smartresponder_show_email = get_post_meta($post->ID, '_wpp_smartresponder_show_email', true);
    $wpp_smartresponder_show_tel = get_post_meta($post->ID, '_wpp_smartresponder_show_tel', true);


    $wppage_seo_title = get_post_meta($post->ID, '_wppage_seo_title', true);
    $wppage_seo_keywords = get_post_meta($post->ID, '_wppage_seo_keywords', true);
    $wppage_seo_desc = get_post_meta($post->ID, '_wppage_seo_desc', true);

    $product_title = get_post_meta($post->ID, '_product_title', true);
    $product_desc = get_post_meta($post->ID, '_product_desc', true);
    $product_price = get_post_meta($post->ID, '_product_price', true);
    $product_currency = get_post_meta($post->ID, '_product_currency', true);
    $product_shop_id = get_post_meta($post->ID, '_product_shop_id', true);
    $use_comments = explode(',', get_post_meta($post->ID, '_use_comments', true));
    $use_comments_tabs = explode(',', get_post_meta($post->ID, '_use_comments_tabs', true));
    $use_comments_stack = explode(',', get_post_meta($post->ID, '_use_comments_stack', true));
    $use_comments_columns = explode(',', get_post_meta($post->ID, '_use_comments_columns', true));

    if(get_post_meta($post->ID, '_use_comments_columns', true) == ''){
        $use_comments_columns = explode(',', 'facebook,vk');
    }

    if (get_post_meta($post->ID, '_use_comments_order', true) != '') {
        $use_comments_order = explode(',', get_post_meta($post->ID, '_use_comments_order', true));
    } else {
        $use_comments_order = explode(',', 'facebook,vk,wordpress');
    }

    if (get_post_meta($post->ID, '_use_comments_tabs_order', true) != '') {
        $use_comments_tabs_order = explode(',', get_post_meta($post->ID, '_use_comments_tabs_order', true));
    } else {
        if (get_post_meta($post->ID, '_use_comments_order', true) != '') {
            $use_comments_tabs_order = explode(',', get_post_meta($post->ID, '_use_comments_order', true));
        } else {
            $use_comments_tabs_order = explode(',', 'facebook,vk,wordpress');
        }
    }

    if (get_post_meta($post->ID, '_use_comments_stack_order', true) != '') {
        $use_comments_stack_order = explode(',', get_post_meta($post->ID, '_use_comments_stack_order', true));
    } else {
        if (get_post_meta($post->ID, '_use_comments_order', true) != '') {
            $use_comments_stack_order = explode(',', get_post_meta($post->ID, '_use_comments_order', true));
        } else {
            $use_comments_stack_order = explode(',', 'facebook,vk,wordpress');
        }
    }

    if (get_post_meta($post->ID, '_use_comments_columns_order', true) != '') {
        $use_comments_columns_order = explode(',', get_post_meta($post->ID, '_use_comments_columns_order', true));
        //$use_comments_columns_order = explode(',', 'facebook,vk,wordpress');
    } else {
        if (get_post_meta($post->ID, '_use_comments_order', true) != '') {
            $use_comments_columns_order = explode(',', get_post_meta($post->ID, '_use_comments_order', true));
        } else {
            $use_comments_columns_order = explode(',', 'facebook,vk,wordpress');
        }
    }

    $wppage_comments_style = get_post_meta($post->ID, '_wppage_comments_style', true);
    if(!$wppage_comments_style || $wppage_comments_style == '') $wppage_comments_style = 'tabs';

    $wpp_getresponse = get_post_meta($post->ID, '_wpp_getresponse', true);

    $wpp_mailchimp_code = get_post_meta($post->ID, '_wpp_mailchimp_code', true);
    $wpp_unisender_code = get_post_meta($post->ID, '_wpp_unisender_code', true);
    $wpp_justclick_code = get_post_meta($post->ID, '_wpp_justclick_code', true);

    $wppage_head_code = get_post_meta($post->ID, '_wppage_head_code', true);
    $wppage_body_code = get_post_meta($post->ID, '_wppage_body_code', true);
    $wppage_footer_code = get_post_meta($post->ID, '_wppage_footer_code', true);

    $btypes = array('solid' => 'Сплошная', 'dashed' => 'Пунктир', 'dotted' => 'Точка', 'double' => 'Двойная');
    $bsizes = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 20);
    $ssizes = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 20, 30, 40, 50, 100);

    if ($ps_border_width) {
        $body_width = $ps_content_width - $ps_border_width * 2;
        $bonus_box_margin_left = 122 + $ps_border_width;
    } else {
        $body_width = $ps_content_width;
        $bonus_box_margin_left = 122;
    }

    $img_url = 'http://static.wppage.ru/wppage/i/bg/big/';
    $wpp_bg = array(
        $img_url.'1.jpg',$img_url.'2.jpg',$img_url.'3.jpg',$img_url.'4.jpg',$img_url.'5.jpg',$img_url.'6.jpg',$img_url.'7.jpg',
        $img_url.'8.jpg',$img_url.'9.jpg',$img_url.'10.jpg',$img_url.'11.jpg',$img_url.'12.jpg',$img_url.'13.jpg',$img_url.'14.jpg',
        $img_url.'15.jpg',$img_url.'16.jpg',$img_url.'17.jpg',$img_url.'18.jpg',$img_url.'19.jpg',$img_url.'20.jpg',$img_url.'21.jpg',
        $img_url.'22.jpg',$img_url.'23.jpg',$img_url.'24.jpg',$img_url.'25.png',$img_url.'26.png',$img_url.'27.png',$img_url.'28.png',
        $img_url.'29.png',$img_url.'30.png',$img_url.'31.png',$img_url.'32.png',$img_url.'33.png',$img_url.'34.png',$img_url.'35.png',
        $img_url.'36.png',$img_url.'37.png',$img_url.'38.png',$img_url.'39.png',$img_url.'40.gif',$img_url.'41.gif',$img_url.'42.gif',
        $img_url.'43.gif',$img_url.'44.gif',$img_url.'45.gif',$img_url.'46.gif',$img_url.'47.gif',$img_url.'48.gif',$img_url.'49.gif',
        $img_url.'50.gif'

    );

    $ps_background_image_attachment_prop ='';
    if ($ps_background_image_attachment == 'on') {
        $ps_background_image_attachment_prop = 'fixed';
    }
    $box_sc = hex2rgb($ps_content_shadow_color);

    $editor_base_style = "html{ background-color:#$ps_background_color !important; background-image:url($ps_background_image); background-attachment: $ps_background_image_attachment_prop !important; background-repeat: $ps_background_image_repeat !important;}
    html .mcecontentbody{ max-width:1600px;}
    body#tinymce{ width:" . $body_width . "px!important; border-color:#" . $ps_border_color . "!important; border-width:" . $ps_border_width . "px!important; border-style:" . $ps_border_style . "!important; background-color:#" . $ps_content_background_color . "; color:#" . $ps_content_color . "; box-shadow:0 0 " . $ps_content_shadow_blur . "px rgba(" . $box_sc[0] .",". $box_sc[1] .",".$box_sc[2] .",1); }
    .ps_bonus_box_wide{ margin:10px " . (-20 - $ps_border_width) . "px!important; width: " . $ps_content_width . "px; }
    .ps_bonus_box{ margin:10px 0px 10px -" . $bonus_box_margin_left . "px!important;}
    .bonus_table_box_t{ margin:0 " . (-20 - $ps_border_width) . "px!important; }";

   // file_put_contents(WP_PLUGIN_DIR . '/wppage/css/editor-style-bg.css', $editor_base_style);
    //=====
    $upload_dir = wp_upload_dir();
    $my_file = $upload_dir['basedir'] . '/wppage/editor-style-' . get_the_ID() . '.css';
    $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
    fwrite($handle, $editor_base_style);
    fclose($handle);
    //=====

   if(get_bloginfo('language') == "ru-RU")
       echo '<script type="text/javascript" src="'.plugins_url() . '/wppage/js/wppage-ru.js"></script>';
    else
        echo '<script type="text/javascript" src="'.plugins_url() . '/wppage/js/wppage.js"></script>';
    ?>
    <div class="wppage_box">
<a target="_blank" href="http://wppage.ru" title="wppage" id="wppage_home_link"></a>

<div class="p_box wppage_tabs" id="wppage_tabs">
<ul class="wppage_tabs_nav">
    <li><a href="#wppage_tab_1">Дизайн</a></li>
    <li><a href="#wppage_tab_2">Медиа блок</a></li>
    <li><a href="#wppage_tab_3">Подписки</a></li>
    <li><a href="#wppage_tab_4">Интеркасса</a></li>
    <li><a href="#wppage_tab_5">Комментарии</a></li>
    <li><a href="#wppage_tab_6">SEO</a></li>
    <li><a href="#wppage_tab_7">Скрипты</a></li>
</ul>
<div class="tab_content_box" id="wppage_tab_1">
    <div class="triangle"></div>
    <div class="wppage_content_round">
        <input name="save" type="submit" class="button-primary" id="publish" tabindex="5" accesskey="p"
               value="Обновить">

        <div class="wppage_inner_tabs">
            <ul class="wppage_innter_tab_nav">
                <li><a href="#wppage_inner_tab_1_1">Фон страницы</a></li>
                <li><a href="#wppage_inner_tab_1_2">Тело страницы</a></li>
            </ul>
            <?php if( $user_serial == WPP_SECRET_KEY_START): ?>
            <div class="wpp_message">
                <p>Раздел "Дизайн" не доступен в пакете START. <a class="" href="http://wppage.ru/wppage/obnovit-paket/" target="_blank">Обновить пакет</a></p>
            </div>
            <?php endif; ?>
            <div class="inner_tab_content" id="wppage_inner_tab_1_1">
                <div class="wppage_preview preview_1_1">
                    <label class="wppage_color_box" id="ps_background_color_box">
                        <input type="text" id="ps_background_color" name="ps_background_color" class="color"
                               value="<?php echo ($ps_background_color) ? $ps_background_color : 'ebebeb'; ?>"/>
                    </label>

                </div>
                <div class="inner_options wppage_right_side">
                    <div class="section">
                        <p>
                            <label>Фоновое изображение<br>
                                <input type="text" id="ps_background_image" name="ps_background_image"
                                       value="<?php echo $ps_background_image; ?>"/>
                            </label>
                        </p>
                        <div class="section">
                            <div class="wpp_select_box wpp radius_3" id="ps_background_image_box"
                                 box_id="ps_background_image_box">
                                <div id="ps_background_image_selected"
                                     box_id="ps_background_image_box">
                                    <div id="bg_preview" class="bg_preview <?php echo $no_image_class; ?>" <?php if($ps_background_image != '') echo 'style="background-image: url('.$ps_background_image.')"'; ?> ></div>
                                     </div>
                                <div class="wpp_popup_box wpp_buttons_box ps_background_image_box">
                                    <a class="wppage_button wpp_button_red radius_3 wpp_close_box"
                                       box_id="ps_background_image_box">Закрыть</a>

                                    <div class="wpp_buttons_content wpp_bg_images_content">
                                        <label class="ps_cbutton wpp_bg no_image">
                                            <input type="radio" name="ps_background_image_thumb" value="no_image"/>
                                        </label>
                                        <?php for ($i = 1; $i <= 50; $i++): if($i == 2 || $i == 22)continue; ?>
                                        <label class="ps_cbutton wpp_bg wpp_bg_thumb_<?php echo $i; ?>">
                                            <input type="radio" name="ps_background_image_thumb"
                                                   value="<?php echo $wpp_bg[$i-1]; ?>" <?php echo ($i == $ps_background_image) ? 'checked="checked"' : '';  ?> />
                                        </label>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p>
                            <label
                                    class="wppage_checkbox <?php echo ($ps_background_image_attachment == 'on') ? 'wppage_checked' : ''; ?>">
                                <input type="checkbox" name="ps_background_image_attachment" <?php
                                    echo ($ps_background_image_attachment == 'on') ? 'checked="checked"' : ''; ?>>
                                Зафиксировать фоновое изображение
                            </label>
                        </p>
                    </div>
                    <div class="section">
                        <label class="wppage_radio wppage_radio_bg bg_repeat"><input type="radio"
                                                                                     name="ps_background_image_repeat"
                                                                                     value="repeat"<?php echo ($ps_background_image_repeat == 'repeat') ? 'checked="checked"' : ''; ?>></label>
                        <label class="wppage_radio wppage_radio_bg bg_repeat_x"><input type="radio"
                                                                                       name="ps_background_image_repeat"
                                                                                       value="repeat-x"<?php echo ($ps_background_image_repeat == 'repeat-x') ? 'checked="checked"' : ''; ?>></label>
                        <label class="wppage_radio wppage_radio_bg bg_repeat_y"><input type="radio"
                                                                                       name="ps_background_image_repeat"
                                                                                       value="repeat-y" <?php echo ($ps_background_image_repeat == 'repeat-y') ? 'checked="checked"' : ''; ?>></label>
                        <label class="wppage_radio wppage_radio_bg bg_no_repeat"><input type="radio"
                                                                                        name="ps_background_image_repeat"
                                                                                        value="no-repeat"<?php echo ($ps_background_image_repeat == 'no-repeat') ? 'checked="checked"' : ''; ?>></label>
                        <br>
                    </div>
                </div>
                <div class="wppage_clear"></div>

            </div>
            <div class="inner_tab_content" id="wppage_inner_tab_1_2">
                <div class="wppage_preview preview_1_2">
                    <label class="wppage_color_box" id="ps_content_background_color_box">
                        <input type="text" id="ps_content_background_color" name="ps_content_background_color"
                               class="color"
                               value="<?php echo ($ps_content_background_color) ? $ps_content_background_color : 'ffffff'; ?>"/>
                    </label>

                    <label class="wppage_text_color_box" id="ps_content_color_box">
                        <input type="text" id="ps_content_color" name="ps_content_color" class="color"
                               value="<?php echo ($ps_content_color) ? $ps_content_color : '000000'; ?>"/>
                    </label>

                    <div class="content_width_slider_box">
                        <input type="text" name="ps_content_width" id="ps_content_width"/>

                        <div id="ps_content_width_slider"></div>
                        <script type="text/javascript">
                            jQuery(function ($) {
                                $("#ps_content_width_slider").slider({
                                    value:<?php echo $ps_content_width; ?>,
                                    min:720,
                                    max:1600,
                                    step:1,
                                    slide:function (event, ui) {
                                        $("#ps_content_width").val(ui.value);
                                    }
                                });
                                $("#ps_content_width").val($("#ps_content_width_slider").slider("value"));
                            });
                        </script>
                    </div>

                </div>
                <div class="inner_option wppage_right_side">
                    <span class="section_title section_title_1_2_1">Рамка</span>

                    <div class="section section_1_2_1">
                        <div class="section">
                            <label class="wppage_color_box" id="ps_border_color_box">
                                <input type="text" id="ps_border_color" name="ps_border_color" class="color"
                                       value="<?php echo ($ps_border_color) ? $ps_border_color : '000000'; ?>"/>
                            </label>
                            <select name="ps_border_width">
                                <?php foreach ($bsizes as $key => $value) { ?>
                                <option
                                        value="<?php echo $value; ?>"<?php echo ($value == $ps_border_width) ? 'selected="selected"' : ''; ?>><?php echo $value; ?>px
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="section">
                            <label class="wppage_radio wppage_radio_border border_solid"><input type="radio"
                                                                                                name="ps_border_style"
                                                                                                value="solid"<?php echo ($ps_border_style == 'solid') ? 'checked="checked"' : ''; ?>></label>
                            <label class="wppage_radio wppage_radio_border border_double"><input type="radio"
                                                                                                 name="ps_border_style"
                                                                                                 value="double"<?php echo ($ps_border_style == 'double') ? 'checked="checked"' : ''; ?>></label>
                            <label class="wppage_radio wppage_radio_border border_dashed"><input type="radio"
                                                                                                 name="ps_border_style"
                                                                                                 value="dashed" <?php echo ($ps_border_style == 'dashed') ? 'checked="checked"' : ''; ?>></label>
                            <label class="wppage_radio wppage_radio_border border_dotted"><input type="radio"
                                                                                                 name="ps_border_style"
                                                                                                 value="dotted"<?php echo ($ps_border_style == 'dotted') ? 'checked="checked"' : ''; ?>></label>
                        </div>

                    </div>
                    <span class="section_title section_title_1_2_2">Тень</span>

                    <div class="section">
                        <label class="wppage_color_box" id="ps_content_shadow_color_box"> <input type="text"
                                                                                                 id="ps_content_shadow_color"
                                                                                                 name="ps_content_shadow_color"
                                                                                                 class="color"
                                                                                                 value="<?php echo ($ps_content_shadow_color) ? $ps_content_shadow_color : 'сссссс'; ?>"/>
                        </label>
                        <select name="ps_content_shadow_blur">
                            <?php foreach ($ssizes as $key => $value) { ?>
                            <option
                                    value="<?php echo $value; ?>"<?php echo ($value == $ps_content_shadow_blur) ? 'selected="selected"' : ''; ?>><?php echo $value; ?>px
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="wppage_clear"></div>
            </div>

        </div>
        <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=Gh5NYZFBdZQ&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=16')">Видео урок</a>
        </div>
    </div>
</div>
<div class="tab_content_box" id="wppage_tab_2">
<div class="triangle"></div>
<div class="wppage_content_round">
<input name="save" type="submit" class="button-primary" tabindex="5" accesskey="p" value="Обновить">

<div class="wppage_inner_tabs">
<ul class="wppage_innter_tab_nav">
    <li><a href="#wppage_inner_tab_2_1">Основное</a></li>
    <li><a href="#wppage_inner_tab_2_2">Дизайн</a></li>
    <li><a href="#wppage_inner_tab_2_3">Подписная форма</a></li>
</ul>
<div class="inner_tab_content" id="wppage_inner_tab_2_1">
    <div class="wppage_preview preview_2_1">

    </div>
    <div class="wppage_right_side">

        <span class="media_on"><label class="wppage_checkbox">Вкл.
            <input name="coach_media" id="coach_media_on" type="radio" <?php echo ($coach_media == 'on')? 'checked="checked"': ''; ?> value="on" />
        </label></span>&nbsp;&nbsp;
        <span class="media_off">
        <label class="wppage_checkbox">Выкл.
            <input name="coach_media" id="coach_media_off" type="radio" <?php echo ($coach_media == 'off')? 'checked="checked"': ''; ?> value="off" />
        </label>
        </span>
        <br><br>
        <label class="wppage_checkbox" id="coach_media_only_box">Только медиа-блок
            <input name="coach_media_only" id="coach_media_only" type="checkbox" <?php echo $coach_media_only; ?> />
        </label>
        <span class="section_title section_title_2_1_1">Видео</span>

        <div class="section">
            <label for="coach_video_link">
                <input name="coach_video_link" id="coach_video_link" type="text"
                       value="<?php echo $coach_video_link; ?>"/>
            </label>
            <label class="wppage_checkbox" id="coach_video_play_box"><input name="coach_video_play"
                                                                            id="coach_video_play"
                                                                            type="checkbox" <?php echo $coach_video_play; ?> />
                Автовоспроизведение</label>
        </div>
    </div>
    <div class="wppage_clear"></div>
    <div class="wppage_bottom">
        <div class="section">
            <div class="text_preview coach_title_preview">
                <span class="wppage_edit_ico" text_id="coach_title"></span>

                <div class="wppage_text_preview coach_title_text" text_id="coach_title">
                    <?php echo $coach_title; ?>
                </div>
                <div class="wppage_editor_box coach_title_box">
                    <div class="wppage_editor_content">
                        <textarea id="coach_title" name="coach_title"><?php echo $coach_title; ?></textarea>
                        <a class="wppage_save_text wppage_button wpp_button_green radius_3"
                           text_id="coach_title">Сохранить</a>
                        <a class="wppage_cancel_text wppage_button wpp_button_red radius_3"
                           text_id="coach_title">Отмена</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="inner_tab_content" id="wppage_inner_tab_2_2">
    <div class="wppage_preview preview_2_2">

    </div>
    <div class="wppage_right_side">
        <span class="section_title section_title_2_2_1">Фон</span>

        <div class="section">
            <label class="wppage_color_box" id="mediabox_background_color_box">
                <input type="text" id="mediabox_background_color" name="mediabox_background_color" class="color"
                       value="<?php echo ($mediabox_background_color) ? $mediabox_background_color : 'f3f3f3'; ?>"/>
            </label>
            <label class="wppage_text_color_box">
                <input type="text" id="mediabox_color" name="mediabox_color" class="color"
                       value="<?php echo ($mediabox_color) ? $mediabox_color : '000000'; ?>"/>
            </label>
        </div>
        <span class="section_title section_title_2_2_2">Рамка</span>

        <div class="section">
            <label class="wppage_color_box">
                <input type="text" id="mediabox_border_color" name="mediabox_border_color" class="color"
                       value="<?php echo ($mediabox_border_color) ? $mediabox_border_color : '000000'; ?>"/>
            </label>
            <select name="mediabox_border_width">
                <?php foreach ($bsizes as $key => $value) { ?>
                <option
                        value="<?php echo $value; ?>"<?php echo ($value == $mediabox_border_width) ? 'selected="selected"' : ''; ?>><?php echo $value; ?>px
                </option>
                <?php } ?>
            </select>

        </div>
        <div class="section">
            <label class="wppage_radio wppage_radio_border border_solid"><input type="radio"
                                                                                name="mediabox_border_style"
                                                                                value="solid"<?php echo ($mediabox_border_style == 'solid') ? 'checked="checked"' : ''; ?>></label>
            <label class="wppage_radio wppage_radio_border border_double"><input type="radio"
                                                                                 name="mediabox_border_style"
                                                                                 value="double"<?php echo ($mediabox_border_style == 'double') ? 'checked="checked"' : ''; ?>></label>
            <label class="wppage_radio wppage_radio_border border_dashed"><input type="radio"
                                                                                 name="mediabox_border_style"
                                                                                 value="dashed" <?php echo ($mediabox_border_style == 'dashed') ? 'checked="checked"' : ''; ?>></label>
            <label class="wppage_radio wppage_radio_border border_dotted"><input type="radio"
                                                                                 name="mediabox_border_style"
                                                                                 value="dotted"<?php echo ($mediabox_border_style == 'dotted') ? 'checked="checked"' : ''; ?>></label>
        </div>
        <span class="section_title section_title_2_2_3">Тень</span>

        <div class="section">
            <label class="wppage_color_box">
                <input type="text" id="mediabox_shadow_color" name="mediabox_shadow_color" class="color"
                       value="<?php echo ($mediabox_shadow_color) ? $mediabox_shadow_color : 'сссссс'; ?>"/>
            </label>
            <select name="mediabox_shadow_blur">
                <?php foreach ($ssizes as $key => $value) { ?>
                <option
                        value="<?php echo $value; ?>"<?php echo ($value == $mediabox_shadow_blur) ? 'selected="selected"' : ''; ?>><?php echo $value; ?>px
                </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="wppage_clear"></div>

</div>
<div class="inner_tab_content" id="wppage_inner_tab_2_3">
<div class="wppage_preview preview_2_3">

</div>
<div class="wppage_right_side">
<div class="section">
    <select class="wppage_select width_100p" name="wpp3_media_response_type" id="wpp3_media_response_type">
        <option
                value="smartresponder" <?php echo ($wpp3_media_response_type == 'smartresponder') ? 'selected="selected"' : ''; ?>>SmartResponder
        </option>
        <option
                value="getresponse"<?php echo ($wpp3_media_response_type == 'getresponse') ? 'selected="selected"' : ''; ?>>GetResponse
        </option>
        <option
                value="mailchimp"<?php echo ($wpp3_media_response_type == 'mailchimp') ? 'selected="selected"' : ''; ?>>MailChimp
        </option>
        <option
                value="justclick"<?php echo ($wpp3_media_response_type == 'justclick') ? 'selected="selected"' : ''; ?>>JustClick
        </option>
        <option
                value="unisender"<?php echo ($wpp3_media_response_type == 'unisender') ? 'selected="selected"' : ''; ?>>Unisender
        </option>
    </select>
    <script type="text/javascript">
        jQuery(function ($) {
            $('#wpp3_media_response_type').live('change', function () {
                $('.wpp_media_settings').css({'display':'none'});
                if ($(this).val() == 'smartresponder') {
                    $('.wpp_media_' + $(this).val() + '_settings').css({'display':'block'});
                } else {
                    $('.wpp_' + $(this).val() + '_settings').css({'display':'block'});
                }

            });
        });
    </script>
</div>
<div class="section">
<div class="wpp_media_smartresponder_settings wpp_media_settings"
     style="display:<?php echo ($wpp3_media_response_type == 'smartresponder') ? 'block' : 'none';?>">
    <label class="wppage_checkbox">
        <input type="radio" name="wpp_media_smartresponder_form_version"
               value="new" <?php echo ($wpp_media_smartresponder_form_version == 'new') ? 'checked="checked"' : ''; ?>>Новая форма
    </label>
    <label class="wppage_checkbox">
        <input type="radio" name="wpp_media_smartresponder_form_version"
               value="old" <?php echo ($wpp_media_smartresponder_form_version == 'old') ? 'checked="checked"' : ''; ?>>Старая форма
    </label>
    <br><br>

    <div class="tabs_content_wrap">
        <div class="inner_tab_content wpp_media_smartresponder_settings_box" id="wppage_media_inner_tab_old">
            <label for="wpp_media_smartresponder_code">Код формы</label>
            <br>
            <textarea name="wpp_media_smartresponder_code" id="wpp_media_smartresponder_code"
                      class="wpp_textarea"><?php echo $wpp_media_smartresponder_code;
                ?></textarea>

            <div>
                <div class="wpp_box" style="display: none;">
                    <div id="crc_temp_3" style="display:none;"></div>
                    <input type="text" name="wpp_media_smartresponder_tid" class="width_100"
                           id="wpp_media_smartresponder_tid"
                           value="<?php echo $wpp_media_smartresponder_tid; ?>"/>

                    <input type="text" name="wpp_media_smartresponder_did" class="width_100"
                           id="wpp_media_smartresponder_did"
                           value="<?php echo $wpp_media_smartresponder_did; ?>"/>

                    <input type="text" name="wpp_media_smartresponder_uid" class="width_100"
                           id="wpp_media_smartresponder_uid"
                           value="<?php echo $wpp_media_smartresponder_uid; ?>"/>
                </div>
                <div class="wpp_box">
                    <div class="section">
                        <div class="section">
                            <span class="section_title" style="margin-bottom: 10px">Описание подписки</span>
                            <div class="text_preview wpp_media_smartresponder_title_preview">
                                <span class="wppage_edit_ico" text_id="wpp_media_smartresponder_title"></span>

                                <div class="wppage_text_preview wpp_media_smartresponder_title_text"
                                     text_id="wpp_media_smartresponder_title">
                                    <?php echo $wpp_media_smartresponder_title; ?>
                                </div>
                                <div class="wppage_editor_box wpp_media_smartresponder_title_box">
                                    <div class="wppage_editor_content">
                                        <textarea id="wpp_media_smartresponder_title"
                                                  name="wpp_media_smartresponder_title"><?php echo $wpp_media_smartresponder_title; ?></textarea>
                                        <a class="wppage_save_text wppage_button wpp_button_green radius_3"
                                           text_id="wpp_media_smartresponder_title">Сохранить</a>
                                        <a class="wppage_cancel_text wppage_button wpp_button_red radius_3"
                                           text_id="wpp_media_smartresponder_title">Отмена</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section">
                            <span class="section_title border_bottom">Поля</span>
                            <label class="wppage_checkbox">
                                <input type="checkbox"
                                       name="wpp_media_smartresponder_show_name" <?php echo ($wpp_media_smartresponder_show_name == 'on') ? 'checked="checked"' : ''; ?>>Имя</label>
                            <label class="wppage_checkbox">
                                <input type="checkbox"
                                       name="wpp_media_smartresponder_show_email" <?php echo ($wpp_media_smartresponder_show_email == 'on') ? 'checked="checked"' : ''; ?>>E-mail</label>
                            <label class="wppage_checkbox">
                                <input type="checkbox"
                                       name="wpp_media_smartresponder_show_tel" <?php echo ($wpp_media_smartresponder_show_tel == 'on') ? 'checked="checked"' : ''; ?>>Телефон</label>
                        </div>
                        <div class="section">
                            <span class="section_title border_bottom">Кнопка</span>
                            <input type="text" name="wpp_media_smartresponder_button_text"
                                   id="wpp_media_smartresponder_button_text"
                                   class="width_200"
                                   value="<?php echo $wpp_media_smartresponder_button_text; ?>"/><br><br>

                            <div class="wpp_select_box wpp_select_button radius_3"
                                 box_id="wpp_media_smartresponder_button_style_box">
                                <div id="wpp_media_smartresponder_button_style_selected"
                                     class="ps_button_<?php echo $wpp_media_smartresponder_button_style; ?>"
                                     box_id="wpp_media_smartresponder_button_style_box"></div>
                                <div class="wpp_popup_box wpp_buttons_box wpp_media_smartresponder_button_style_box">
                                    <a class="wppage_button wpp_button_red radius_3 wpp_close_box"
                                       box_id="wpp_media_smartresponder_button_style_box">Закрыть</a>

                                    <div class="wpp_buttons_content ">
                                        <?php for ($i = 1; $i < 25; $i++): ?>
                                        <label class="ps_cbutton ps_button_<?php echo $i; ?>">
                                            <input type="radio" name="wpp_media_smartresponder_button_style"
                                                   value="<?php echo $i; ?>" <?php echo ($i == $wpp_media_smartresponder_button_style) ? 'checked="checked"' : '';  ?> />
                                        </label>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="section">
                        <span class="section_title border_bottom">Фон</span>
                        <label class="wppage_color_box">
                            <input type="text" id="wpp_media_smartresponder_bg_color_1"
                                   name="wpp_media_smartresponder_bg_color_1" class="color"
                                   value="<?php echo $wpp_media_smartresponder_bg_color_1 ? $wpp_media_smartresponder_bg_color_1 : 'ebebeb'; ?>"/>
                        </label>
                        <label class="wppage_color_box">
                            <input type="text" id="wpp_media_smartresponder_bg_color_2"
                                   name="wpp_media_smartresponder_bg_color_2" class="color"
                                   value="<?php echo $wpp_media_smartresponder_bg_color_2 ? $wpp_media_smartresponder_bg_color_2 : 'ebebeb'; ?>"/>
                        </label>
                    </div>
                    <div class="section">
                        <span class="section_title border_bottom">Рамка</span>
                        <input type="text" id="wpp_media_smartresponder_border_color"
                               name="wpp_media_smartresponder_border_color" class="color"
                               value="<?php echo $wpp_media_smartresponder_border_color ? $wpp_media_smartresponder_border_color : '000000'; ?>"/>
                        <select name="wpp_media_smartresponder_border_width">
                            <?php foreach ($bsizes as $key => $value) { ?>
                            <option
                                    value="<?php echo $value; ?>"<?php echo ($value == $wpp_media_smartresponder_border_width) ? 'selected="selected"' : ''; ?>><?php echo $value; ?>px
                            </option>
                            <?php } ?>
                        </select>
                        <br><br>

                        <div>
                            <label class="wppage_radio wppage_radio_border border_solid"><input type="radio"
                                                                                                name="wpp_media_smartresponder_border_style"
                                                                                                value="solid"<?php echo ($wpp_media_smartresponder_border_style == 'solid') ? 'checked="checked"' : ''; ?>></label>
                            <label class="wppage_radio wppage_radio_border border_double"><input type="radio"
                                                                                                 name="wpp_media_smartresponder_border_style"
                                                                                                 value="double"<?php echo ($wpp_media_smartresponder_border_style == 'double') ? 'checked="checked"' : ''; ?>></label>
                            <label class="wppage_radio wppage_radio_border border_dashed"><input type="radio"
                                                                                                 name="wpp_media_smartresponder_border_style"
                                                                                                 value="dashed" <?php echo ($wpp_media_smartresponder_border_style == 'dashed') ? 'checked="checked"' : ''; ?>></label>
                            <label class="wppage_radio wppage_radio_border border_dotted"><input type="radio"
                                                                                                 name="wpp_media_smartresponder_border_style"
                                                                                                 value="dotted"<?php echo ($wpp_media_smartresponder_border_style == 'dotted') ? 'checked="checked"' : ''; ?>></label>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="inner_tab_content wpp_media_smartresponder_settings_box" id="wppage_media_inner_tab_new">
            <label for="wpp3_media_smartresponder_code">Код формы</label>
            <br>
            <textarea name="wpp3_media_smartresponder_code" id="wpp3_media_smartresponder_code"
                      class="wpp_textarea"><?php echo $wpp3_media_smartresponder_code;
                ?></textarea>
        </div>
    </div>


    <div class="clear"></div>
    <!-- -->


</div>
<div class="wpp_getresponse_settings wpp_media_settings"
     style="display:<?php echo ($wpp3_media_response_type == 'getresponse') ? 'block' : 'none';?>">
    <div class="section">
        <label>Код формы<br/>
            <textarea name="wpp3_media_getresponse_code" id="wpp3_media_getresponse_code"
                      class="wpp_textarea width_100p radius_3"><?php echo $wpp3_media_getresponse_code; ?></textarea>
        </label>
    </div>
</div>
<div class="wpp_mailchimp_settings wpp_media_settings"
     style="display:<?php echo ($wpp3_media_response_type == 'mailchimp') ? 'block' : 'none';?>">
    <div class="section">
        <label>Код формы<br/>
            <textarea name="wpp3_media_mailchimp_code" id="wpp3_media_mailchimp_code"
                      class="wpp_textarea width_100p radius_3"><?php echo $wpp3_media_mailchimp_code; ?></textarea>
        </label>
    </div>

</div>
<div class="wpp_justclick_settings wpp_media_settings"
     style="display:<?php echo ($wpp3_media_response_type == 'justclick') ? 'block' : 'none';?>">
    <div class="section">
        <label>Код формы<br/>
            <textarea name="wpp3_media_justclick_code" id="wpp3_media_justclick_code"
                      class="wpp_textarea width_100p radius_3"><?php echo $wpp3_media_justclick_code; ?></textarea>
        </label>
    </div>

</div>
<div class="wpp_unisender_settings wpp_media_settings"
     style="display:<?php echo ($wpp3_media_response_type == 'unisender') ? 'block' : 'none';?>">
    <div class="section">
        <label>Код формы<br/>
            <textarea name="wpp3_media_unisender_code" id="wpp3_media_unisender_code"
                      class="wpp_textarea width_100p radius_3"><?php echo $wpp3_media_unisender_code; ?></textarea>
        </label>
    </div>

</div>

</div>
</div>
<div class="wppage_clear"></div>

</div>
</div>
<div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=LI5TqWaH-qg&feature=youtu.be')">Видео урок</a>
</div>
</div>
</div>
<div class="tab_content_box" id="wppage_tab_3">
<div class="triangle"></div>
<div class="wppage_content_round">
<input name="save" type="submit" class="button-primary" tabindex="5" accesskey="p" value="Обновить">

<div class="wppage_inner_tabs">
<ul class="wppage_innter_tab_nav">
    <li><a href="#wppage_inner_tab_3_1">GetResponse</a></li>
    <li><a href="#wppage_inner_tab_3_2">MailChimp</a></li>
    <li><a href="#wppage_inner_tab_3_3">UniSender</a></li>
    <li><a href="#wppage_inner_tab_3_4">SmartResponder</a></li>
    <li><a href="#wppage_inner_tab_3_5">JustClick</a></li>
</ul>
<div class="inner_tab_content" id="wppage_inner_tab_3_1">
    <?php if( $user_serial == WPP_SECRET_KEY_START): ?>
    <div class="wpp_message">
        <p>Недоступно в пакете START. <a class="" href="http://wppage.ru/wppage/obnovit-paket/" target="_blank">Обновить пакет</a></p>
    </div>
    <?php endif; ?>
    <div class="section">
    <label for="wpp_getresponse">Код формы</label>
    <textarea name="wpp_getresponse" id="wpp_getresponse" class="wpp_textarea"><?php echo
    $wpp_getresponse; ?></textarea>

    <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=546KJehwzzw&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=5')">Видео урок</a></div>
        </div>
</div>
<div class="inner_tab_content" id="wppage_inner_tab_3_2">
    <?php if( $user_serial == WPP_SECRET_KEY_START): ?>
    <div class="wpp_message">
        <p>Недоступно в пакете START. <a class="" href="http://wppage.ru/wppage/obnovit-paket/" target="_blank">Обновить пакет</a></p>
    </div>
    <?php endif; ?>
    <div class="section">
        <label for="wpp_mailchimp_code">Код формы</label>
        <br/>
        <textarea name="wpp_mailchimp_code" id="wpp_mailchimp_code" class="wpp_textarea"><?php echo
        $wpp_mailchimp_code;
            ?></textarea>
    </div>
    <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=546KJehwzzw&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=5')">Видео урок</a></div>
</div>
<div class="inner_tab_content" id="wppage_inner_tab_3_3">
    <?php if( $user_serial == WPP_SECRET_KEY_START): ?>
    <div class="wpp_message">
        <p>Недоступно в пакете START. <a class="" href="http://wppage.ru/wppage/obnovit-paket/" target="_blank">Обновить пакет</a></p>
    </div>
    <?php endif; ?>
    <div class="section">
    <label for="wpp_unisender_code">Код формы</label>
    <br/>
    <textarea name="wpp_unisender_code" id="wpp_unisender_code"
              class="wpp_textarea"><?php echo $wpp_unisender_code;
        ?></textarea>

    <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=546KJehwzzw&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=5')">Видео урок</a></div>
        </div>
</div>
<div class="inner_tab_content" id="wppage_inner_tab_3_4">
    <label class="wppage_checkbox">
        <input type="radio" name="wpp_smartresponder_form_version"
               value="new" <?php echo ($wpp_smartresponder_form_version == 'new') ? 'checked="checked"' : ''; ?>>Новая форма
    </label>
    <label class="wppage_checkbox">
        <input type="radio" name="wpp_smartresponder_form_version"
               value="old" <?php echo ($wpp_smartresponder_form_version == 'old') ? 'checked="checked"' : ''; ?>>Старая форма
    </label>
    <br><br>

    <div class="tabs_content_wrap">
        <div class="inner_tab_content wpp_smartresponder_settings" id="wppage_inner_tab_old">
            <label for="wpp_smartresponder_code">Код формы</label>
            <br>
            <textarea name="wpp_smartresponder_code" id="wpp_smartresponder_code"
                      class="wpp_textarea"><?php echo $wpp_smartresponder_code;
                ?></textarea>

            <div>
                <div class="wpp_box" style="display: none;">
                    <div id="crc_temp_2" style="display:none;"></div>
                    <input type="text" name="wpp_smartresponder_tid" class="width_100"
                           id="wpp_smartresponder_tid"
                           value="<?php echo $wpp_smartresponder_tid; ?>"/>

                    <input type="text" name="wpp_smartresponder_did" class="width_100"
                           id="wpp_smartresponder_did"
                           value="<?php echo $wpp_smartresponder_did; ?>"/>

                    <input type="text" name="wpp_smartresponder_uid" class="width_100"
                           id="wpp_smartresponder_uid"
                           value="<?php echo $wpp_smartresponder_uid; ?>"/>
                </div>
                <div class="wpp_box">
                    <div class="wppage_right_side">
                        <div class="section">
                            <div class="section">
                                <span class="section_title">Описание подписки</span>
                                <div class="text_preview wpp_smartresponder_title_preview">
                                    <span class="wppage_edit_ico" text_id="wpp_smartresponder_title"></span>

                                    <div class="wppage_text_preview wpp_smartresponder_title_text"
                                         text_id="wpp_smartresponder_title">
                                        <?php echo $wpp_smartresponder_title; ?>
                                    </div>
                                    <div class="wppage_editor_box wpp_smartresponder_title_box">
                                        <div class="wppage_editor_content">
                                            <textarea id="wpp_smartresponder_title"
                                                      name="wpp_smartresponder_title"><?php echo $wpp_smartresponder_title; ?></textarea>
                                            <a class="wppage_save_text wppage_button wpp_button_green radius_3"
                                               text_id="wpp_smartresponder_title">Сохранить</a>
                                            <a class="wppage_cancel_text wppage_button wpp_button_red radius_3"
                                               text_id="wpp_smartresponder_title">Отмена</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section">
                                <span class="section_title border_bottom">Поля</span>
                                <label class="wppage_checkbox">
                                    <input type="checkbox"
                                           name="wpp_smartresponder_show_name" <?php echo ($wpp_smartresponder_show_name == 'on') ? 'checked="checked"' : ''; ?>>Имя</label>
                                <label class="wppage_checkbox">
                                    <input type="checkbox"
                                           name="wpp_smartresponder_show_email" <?php echo ($wpp_smartresponder_show_email == 'on') ? 'checked="checked"' : ''; ?>>E-mail</label>
                                <label class="wppage_checkbox">
                                    <input type="checkbox"
                                           name="wpp_smartresponder_show_tel" <?php echo ($wpp_smartresponder_show_tel == 'on') ? 'checked="checked"' : ''; ?>>Телефон</label>
                            </div>
                            <div class="section">
                                <span class="section_title border_bottom">Кнопка</span>
                                <input type="text" name="wpp_smartresponder_button_text"
                                       id="wpp_smartresponder_button_text"
                                       class="width_200"
                                       value="<?php echo $wpp_smartresponder_button_text; ?>"/><br><br>

                                <div class="wpp_select_box wpp_select_button radius_3"
                                     box_id="responder_button_style_box">
                                    <div id="wpp_smartresponder_button_style_selected"
                                         class="ps_button_<?php echo $wpp_smartresponder_button_style; ?>"
                                         box_id="wpp_smartresponder_button_style_box"></div>
                                    <div class="wpp_popup_box wpp_buttons_box wpp_smartresponder_button_style_box">
                                        <a class="wppage_button wpp_button_red radius_3 wpp_close_box"
                                           box_id="wpp_smartresponder_button_style_box">Закрыть</a>

                                        <div class="wpp_buttons_content ">
                                            <?php for ($i = 1; $i < 25; $i++): ?>
                                            <label class="ps_cbutton ps_button_<?php echo $i; ?>">
                                                <input type="radio" name="wpp_smartresponder_button_style"
                                                       value="<?php echo $i; ?>" <?php echo ($i == $wpp_smartresponder_button_style) ? 'checked="checked"' : '';  ?> />
                                            </label>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="wppage_left_side">
                        <div class="section">
                            <span class="section_title border_bottom">Фон</span>
                            <label class="wppage_color_box">
                                <input type="text" id="wpp_smartresponder_bg_color_1"
                                       name="wpp_smartresponder_bg_color_1" class="color"
                                       value="<?php echo $wpp_smartresponder_bg_color_1 ? $wpp_smartresponder_bg_color_1 : 'ebebeb'; ?>"/>
                            </label>
                            <label class="wppage_color_box">
                                <input type="text" id="wpp_smartresponder_bg_color_2"
                                       name="wpp_smartresponder_bg_color_2" class="color"
                                       value="<?php echo $wpp_smartresponder_bg_color_2 ? $wpp_smartresponder_bg_color_2 : 'ebebeb'; ?>"/>
                            </label>
                        </div>
                        <div class="section">
                            <span class="section_title border_bottom">Рамка</span>
                            <input type="text" id="wpp_smartresponder_border_color"
                                   name="wpp_smartresponder_border_color" class="color"
                                   value="<?php echo $wpp_smartresponder_border_color ? $wpp_smartresponder_border_color : '000000'; ?>"/>
                            <select name="wpp_smartresponder_border_width">
                                <?php foreach ($bsizes as $key => $value) { ?>
                                <option
                                        value="<?php echo $value; ?>"<?php echo ($value == $wpp_smartresponder_border_width) ? 'selected="selected"' : ''; ?>><?php echo $value; ?>px
                                </option>
                                <?php } ?>
                            </select>
                            <br><br>

                            <div>
                                <label class="wppage_radio wppage_radio_border border_solid"><input type="radio"
                                                                                                    name="wpp_smartresponder_border_style"
                                                                                                    value="solid"<?php echo ($wpp_smartresponder_border_style == 'solid') ? 'checked="checked"' : ''; ?>></label>
                                <label class="wppage_radio wppage_radio_border border_double"><input
                                        type="radio"
                                        name="wpp_smartresponder_border_style"
                                        value="double"<?php echo ($wpp_smartresponder_border_style == 'double') ? 'checked="checked"' : ''; ?>></label>
                                <label class="wppage_radio wppage_radio_border border_dashed"><input
                                        type="radio"
                                        name="wpp_smartresponder_border_style"
                                        value="dashed" <?php echo ($wpp_smartresponder_border_style == 'dashed') ? 'checked="checked"' : ''; ?>></label>
                                <label class="wppage_radio wppage_radio_border border_dotted"><input
                                        type="radio"
                                        name="wpp_smartresponder_border_style"
                                        value="dotted"<?php echo ($wpp_smartresponder_border_style == 'dotted') ? 'checked="checked"' : ''; ?>></label>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="inner_tab_content wpp_smartresponder_settings" id="wppage_inner_tab_new">
            <label for="wpp_smartresponder_code_3">Код формы</label>
            <br>
            <textarea name="wpp_smartresponder_code_3" id="wpp_smartresponder_code_3"
                      class="wpp_textarea"><?php echo $wpp_smartresponder_code_3;
                ?></textarea>
        </div>
    </div>


    <div class="clear"></div>
    <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=546KJehwzzw&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=5')">Видео урок</a></div>
</div>
<div class="inner_tab_content" id="wppage_inner_tab_3_5">
    <?php if( $user_serial == WPP_SECRET_KEY_START): ?>
    <div class="wpp_message">
        <p>Недоступно в пакете START. <a class="" href="http://wppage.ru/wppage/obnovit-paket/" target="_blank">Обновить пакет</a></p>
    </div>
    <?php endif; ?>
    <div class="section">
        <label for="wpp_unisender_code">Код формы</label>
        <br/>
        <textarea name="wpp_justclick_code" id="wpp_justclick_code"
                  class="wpp_textarea"><?php echo $wpp_justclick_code;
            ?></textarea>
    </div>
    <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=LI5TqWaH-qg&feature=youtu.be')">Видео урок</a></div>
</div>
</div>
</div>
</div>
<div class="tab_content_box" id="wppage_tab_4">
    <div class="triangle"></div>
    <div class="wppage_content_round">
        <input name="save" type="submit" class="button-primary" tabindex="5" accesskey="p" value="Обновить">

        <div class="wpp_top_nav_bar">

        </div>
        <div class="section">
            <label>Название продукта <br>
                <input type="text" name="product_title" id="product_title" class="wpp_input_text width_100p"
                       value="<?php echo $product_title; ?>"/>
            </label><br/>
            <label for="product_desc">Описание продукта<br>
                <input type="text" name="product_desc" id="product_desc" class="wpp_input_text width_100p"
                       value="<?php echo $product_desc; ?>"/>
            </label><br/>
            <label>Цена<br/>
                <input type="text" name="product_price" id="product_price" class="wpp_input_text"
                       value="<?php echo $product_price; ?>"/>
            </label><br/>
            <label>Валюта<br>
                <input type="text" name="product_currency" id="product_currency" class="wpp_input_text"
                       value="<?php echo $product_currency; ?>"/>
            </label><br/>
            <label>ID магазина<br/>
                <input type="text" name="product_shop_id" id="product_shop_id" class="wpp_input_text"
                       value="<?php echo $product_shop_id; ?>"/>
            </label>
        </div>
        <div class="wppage_clear"></div>
        <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=FpudLpZygxQ&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=6')">Видео урок</a></div>

    </div>
</div>
<div class="tab_content_box" id="wppage_tab_5">
    <div class="triangle"></div>
    <div class="wppage_content_round">
        <input name="save" type="submit" class="button-primary" tabindex="5" accesskey="p" value="Обновить">

        <div class="wpp_top_nav_bar">

        </div>
        <?php if( $user_serial == WPP_SECRET_KEY_START): ?>
        <div class="wpp_message">
            <p>Раздел "Комментарии" не доступен в пакете START. <a class="" href="http://wppage.ru/wppage/obnovit-paket/" target="_blank">Обновить пакет</a></p>
        </div>
        <?php endif; ?>
        <input type="hidden" name="use_comments_tabs_order" id="use_comments_tabs_order" value="<?php echo
        implode(',', $use_comments_tabs_order); ?>">
        <input type="hidden" name="use_comments_stack_order" id="use_comments_stack_order" value="<?php echo
        implode(',', $use_comments_stack_order); ?>">
        <input type="hidden" name="use_comments_columns_order" id="use_comments_columns_order" value="<?php echo
        implode(',', $use_comments_columns_order); ?>">
        <p>Отображать комментарии в виде: &nbsp;&nbsp;
        <span class="green_border_button"><label class="wppage_checkbox"><input type="radio" name="wppage_comments_style" value="tabs" <?php if($wppage_comments_style == 'tabs') echo 'checked="checked"'; ?>>Закладок</label></span>
            <span class="green_border_button"><label class="wppage_checkbox"><input type="radio" name="wppage_comments_style" value="stack" <?php if($wppage_comments_style == 'stack') echo 'checked="checked"'; ?>>Друг под другом</label></span>
         <span class="green_border_button"> <label class="wppage_checkbox"><input type="radio" name="wppage_comments_style" value="columns" <?php if($wppage_comments_style == 'columns') echo 'checked="checked"'; ?>>В две колонки</label></span>
        </p><br>
        <table>
            <tr>
                <td>
                    <div id="comments-container-tabs" class="comments-container ui-helper-clearfix <?php if($wppage_comments_style != 'tabs') echo 'display_none'; ?>" >
                        <ul class="block sortable sortable_comments" id="sortable_comments_tabs">
                            <?php
                            foreach ($use_comments_tabs_order as $comment) {
                                ?>
                                <li class="border_1_solid_gray radius_5 wpp_comment_item wpp_<?php echo $comment; ?>">
                                    <label class="wppage_checkbox">
                                        <input type="checkbox" name="use_comments_tabs[]" class="use_comments"
                                               value="<?php echo $comment; ?>" <?php echo (in_array($comment, $use_comments_tabs)) ? 'checked="checked"' : ''; ?> />
                                    </label>
                                </li>
                            <?php
                            } ?>

                        </ul>
                    </div>
                    <div id="comments-container-stack" class="comments-container ui-helper-clearfix <?php if($wppage_comments_style != 'stack') echo 'display_none'; ?>" >
                        <ul class="block sortable sortable_comments" id="sortable_comments_stack">
                            <?php
                            foreach ($use_comments_stack_order as $comment) {
                                ?>
                                <li class="border_1_solid_gray radius_5 wpp_comment_item wpp_<?php echo $comment; ?>">
                                    <label class="wppage_checkbox">
                                        <span><?php
                                                if($comment == 'facebook') echo 'Facebook';
                                                if($comment == 'vk') echo 'ВКонтакте';
                                                if($comment == 'wordpress') echo 'WordPress';
                                            ?></span>
                                        <input type="checkbox" name="use_comments_stack[]" class="use_comments"
                                               value="<?php echo $comment; ?>" <?php echo (in_array($comment, $use_comments_stack)) ? 'checked="checked"' : ''; ?> />
                                    </label>
                                </li>
                            <?php
                            } ?>

                        </ul>
                    </div>

                    <div id="comments-container-columns" class="comments-container ui-helper-clearfix <?php if($wppage_comments_style != 'columns') echo 'display_none'; ?>">

                                <?php
                                $ul_1 = '<ul class="block sortable sortable_comments comments-column ui-helper-reset" id="sortable_comments_columns">';
                                $ul_2 = '<ul class="block sortable sortable_comments comments-column ui-helper-reset" id="sortable_comments_disabled">';
                                foreach ($use_comments_columns_order as $comment) {
                                    if(in_array($comment, $use_comments_columns)){
                                        $ul_1 .= '<li class="border_1_solid_gray radius_5 wpp_comment_item wpp_'.$comment.'">
                                        <label class="wppage_checkbox ui-widget-content ui-corner-tr">
                                            <input type="checkbox" name="use_comments_columns[]" class="use_comments"
                                                   value="'.$comment.'" checked="checked"/>
                                            </label>
                                        </li>';
                                    }else{
                                        $ul_2 .='<li class="border_1_solid_gray radius_5 wpp_comment_item wpp_'.$comment.'">
                                        <label class="wppage_checkbox ui-widget-content ui-corner-tr">
                                            <input type="checkbox" name="use_comments_columns[]" class="use_comments"
                                                   value="'.$comment.'"/>
                                            </label>
                                        </li>';
                                    }
                                }
                                $ul_1 .= '</ul>';
                                $ul_2 .= '</ul>';
                                echo $ul_1;
                                echo $ul_2;
                                ?>

                    </div>
                    <script type="text/javascript">
                        jQuery(function($){

                            $('#sortable_comments_tabs').sortable({
                                update: function (event, ui) {
                                    var order = [];
                                    $('#sortable_comments_tabs > li input').each(function () {
                                        order.push($(this).val());
                                    });
                                    $('#use_comments_tabs_order').val(order);
                                }
                            });
                            $('#sortable_comments_stack').sortable({
                                update: function (event, ui) {
                                    var order = [];
                                    $('#sortable_comments_stack > li input').each(function () {
                                        order.push($(this).val());
                                    });
                                    $('#use_comments_stack_order').val(order);
                                }
                            });

                            //-----------

                            $( "#sortable_comments_columns, #sortable_comments_disabled" ).sortable({
                                connectWith: ".comments-column",
                                receive: function(event, ui) {
                                    if ($(this).attr('id')=='sortable_comments_columns' && $(this).children().length > 2) {
                                        ui.item.children().children().removeAttr('checked');
                                        ui.item.children().removeClass('wppage_checked');
                                        ui.sender.sortable('cancel');
                                        console.log($(this).attr('id')+', '+ui.item.children().children().val()+', remove');
                                    }else{
                                        if($(this).attr('id')=='sortable_comments_columns'){
                                            ui.item.children().children().attr('checked','checked');
                                            ui.item.children().addClass('wppage_checked');
                                            console.log($(this).attr('id')+', '+ui.item.children().children().val()+', add');
                                        }
                                        if($(this).attr('id')=='sortable_comments_disabled'){
                                            ui.item.children().children().removeAttr('checked');
                                            ui.item.children().removeClass('wppage_checked');
                                            console.log($(this).attr('id')+', '+ui.item.children().children().val()+', remove');
                                        }
                                    }
                                },
                                update: function (event, ui) {
                                    var order1 = [];
                                    var order2 = [];
                                    $('#sortable_comments_columns > li input').each(function () {
                                        order1.push($(this).val());
                                    });
                                    $('#sortable_comments_disabled > li input').each(function () {
                                        order2.push($(this).val());
                                    });
                                    var order = order1.concat(order2);
                                    $('#use_comments_columns_order').val(order);
                                }
                               /* stop: function(event, ui) {
                                    console.log('stop, '+$(this).attr('id')+', '+ui.item.children().children().val());
                                    if($(this).attr('id')=='sortable_comments_disabled'){
                                        ui.item.children().children().attr('checked','checked');
                                        ui.item.children().addClass('wppage_checked');
                                    }
                                    if($(this).attr('id')=='sortable_comments_columns'){
                                        ui.item.children().children().removeAttr('checked');
                                        ui.item.children().removeClass('wppage_checked');
                                    }

                                }*/
                            }).disableSelection();

                            //----------

                            $('input[name=wppage_comments_style]').live('change',function(){
                               var comment_tab = $('#comments-container-'+$(this).val());
                               comment_tab.siblings().addClass('display_none');
                               comment_tab.removeClass('display_none');
                            });

                            //-------
                            $('#sortable_comments_2 input').live('change',function(){
                                if($(this).attr('checked')) {
                                    $(this).removeAttr('checked')
                                        .parent().removeClass('wppage_checked');
                                }
                            });
                        });

                    </script>


                </td>
        </table>
        <div class="wppage_clear"></div>
        <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=7wWO7WT64y0&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=17')">Видео урок</a>
        </div>
    </div>
</div>
<div class="tab_content_box" id="wppage_tab_6">
    <div class="triangle"></div>
    <div class="wppage_content_round">
        <input name="save" type="submit" class="button-primary" tabindex="5" accesskey="p" value="Обновить">

        <div class="wpp_top_nav_bar">
        </div>
        <label>Заголовок (<span class="text_green">title</span>)</label>
        <br/>
        <input type="text" name="wppage_seo_title" id="wppage_seo_tilte" class="wpp_input_text width_100p"
               value="<?php echo $wppage_seo_title; ?>"/>
        <br/>
        <label>Ключевые слова (<span class="text_green">keywords</span>)</label>
        <br/>
        <input type="text" name="wppage_seo_keywords" id="wppage_seo_keywords" class="wpp_input_text width_100p"
               value="<?php echo $wppage_seo_keywords; ?>"/>
        <br/>Описание (<span class="text_green">description</span>)</label>
        <br/>
        <textarea name="wppage_seo_desc" id="wppage_seo_desc"
                  class="wpp_textarea width_100p"><?php echo $wppage_seo_desc;
            ?></textarea>
    </div>
</div>
<div class="tab_content_box" id="wppage_tab_7">
    <div class="triangle"></div>
    <div class="wppage_content_round">
        <input name="save" type="submit" class="button-primary" tabindex="5" accesskey="p" value="Обновить">

        <div class="wpp_top_nav_bar">

        </div>
        <div class="section ">
            <label>&lt;head&gt;&nbsp; <span class="text_green">ваш код</span> &lt;/head&gt;</label>
            <textarea name="wppage_head_code" id="wppage_head_code"
                      class="wpp_textarea width_100p"><?php echo $wppage_head_code;
                ?></textarea>
            <label>&lt;body <span class="text_green">ваш код</span> &gt;&nbsp;&lt;/body&gt;</label>
            <textarea name="wppage_body_code" id="wppage_body_code"
                      class="wpp_textarea width_100p"><?php echo $wppage_body_code;
                ?></textarea>
            <label>&lt;body&gt;&nbsp; <span class="text_green">ваш код</span> &lt;/body&gt;</label>
            <textarea name="wppage_footer_code" id="wppage_footer_code"
                      class="wpp_textarea width_100p"><?php echo $wppage_footer_code;
                ?></textarea>
        </div>
        <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=_kTPYCTPGYA&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=18')">Видео урок</a>
        </div>
    </div>
</div>
</div>
<div class="wppage_clear"></div>
</div>
<?php
}

function page_selling_save_meta($post_id, $post)
{

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    if (!wp_verify_nonce($_POST['page_selling_noncename'], plugin_basename(__FILE__))) {
        return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if (!current_user_can('edit_post', $post->ID)) {
        return $post->ID;
    }

    if(wpp_trial() || wpp_package() != 'START'){

        $page_selling_meta['_coach_media'] = $_POST['coach_media'];
        $page_selling_meta['_coach_media_only'] = $_POST['coach_media_only'];
        $page_selling_meta['_coach_title'] = $_POST['coach_title'];
        $page_selling_meta['_coach_use_image'] = $_POST['coach_use_image'];
        $page_selling_meta['_coach_video_link'] = $_POST['coach_video_link'];
        $page_selling_meta['_coach_video_play'] = $_POST['coach_video_play'];

        /* old responder options -- deprecated */
        $page_selling_meta['_coach_newsletter_description'] = $_POST['coach_newsletter_description'];
        $page_selling_meta['_coach_newsletter_name_helper'] = $_POST['coach_newsletter_name_helper'];
        $page_selling_meta['_coach_newsletter_email_helper'] = $_POST['coach_newsletter_email_helper'];
        $page_selling_meta['_coach_responder_code'] = $_POST['coach_responder_code'];
        $page_selling_meta['_coach_responder_tid'] = $_POST['coach_responder_tid'];
        $page_selling_meta['_coach_responder_did'] = $_POST['coach_responder_did'];
        $page_selling_meta['_coach_responder_uid'] = $_POST['coach_responder_uid'];
        $page_selling_meta['_coach_privacy_show'] = $_POST['coach_privacy_show'];
        $page_selling_meta['_coach_privacy_description'] = $_POST['coach_privacy_description'];
        $page_selling_meta['_responder_button_style'] = $_POST['responder_button_style'];
        $page_selling_meta['_responder_button_text'] = $_POST['responder_button_text'];

        $page_selling_meta['_wpp3_media_smartresponder_code'] = $_POST['wpp3_media_smartresponder_code'];
        $page_selling_meta['_wpp3_media_justclick_code'] = $_POST['wpp3_media_justclick_code'];
        $page_selling_meta['_wpp3_media_mailchimp_code'] = $_POST['wpp3_media_mailchimp_code'];
        $page_selling_meta['_wpp3_media_getresponse_code'] = $_POST['wpp3_media_getresponse_code'];
        $page_selling_meta['_wpp3_media_unisender_code'] = $_POST['wpp3_media_unisender_code'];

        $page_selling_meta['_ps_background_color'] = $_POST['ps_background_color'];
        $page_selling_meta['_ps_background_image'] = $_POST['ps_background_image'];
        $page_selling_meta['_ps_background_image_attachment'] = $_POST['ps_background_image_attachment'];
        $page_selling_meta['_ps_background_image_repeat'] = $_POST['ps_background_image_repeat'];
        $page_selling_meta['_ps_border_color'] = $_POST['ps_border_color'];
        $page_selling_meta['_ps_border_width'] = $_POST['ps_border_width'];
        $page_selling_meta['_ps_border_style'] = $_POST['ps_border_style'];
        $page_selling_meta['_ps_content_shadow_color'] = $_POST['ps_content_shadow_color'];
        $page_selling_meta['_ps_content_shadow_blur'] = $_POST['ps_content_shadow_blur'];
        $page_selling_meta['_ps_content_background_color'] = $_POST['ps_content_background_color'];
        $page_selling_meta['_ps_content_color'] = $_POST['ps_content_color'];
        $page_selling_meta['_ps_content_width'] = $_POST['ps_content_width'];

        $page_selling_meta['_wpp_getresponse'] = $_POST['wpp_getresponse'];
        $page_selling_meta['_wpp_getresponse_code'] = $_POST['wpp_getresponse_code'];
        $page_selling_meta['_wpp_getresponse_wid'] = $_POST['wpp_getresponse_wid'];
        $page_selling_meta['_wpp3_media_response_type'] = $_POST['wpp3_media_response_type'];

        $page_selling_meta['_wpp_mailchimp_code'] = $_POST['wpp_mailchimp_code'];
        $page_selling_meta['_wpp_unisender_code'] = $_POST['wpp_unisender_code'];
        $page_selling_meta['_wpp_justclick_code'] = $_POST['wpp_justclick_code'];

        $page_selling_meta['_mediabox_background_color'] = $_POST['mediabox_background_color'];
        $page_selling_meta['_mediabox_color'] = $_POST['mediabox_color'];
        $page_selling_meta['_mediabox_border_color'] = $_POST['mediabox_border_color'];
        $page_selling_meta['_mediabox_border_width'] = $_POST['mediabox_border_width'];
        $page_selling_meta['_mediabox_border_style'] = $_POST['mediabox_border_style'];
        $page_selling_meta['_mediabox_shadow_color'] = $_POST['mediabox_shadow_color'];
        $page_selling_meta['_mediabox_shadow_blur'] = $_POST['mediabox_shadow_blur'];

        $page_selling_meta['_wpp_smartresponder_code_3'] = $_POST['wpp_smartresponder_code_3'];

        $page_selling_meta['_wpp_smartresponder_form_version'] = $_POST['wpp_smartresponder_form_version'];
        $page_selling_meta['_wpp_smartresponder_title'] = $_POST['wpp_smartresponder_title'];
        $page_selling_meta['_wpp_smartresponder_button_style'] = $_POST['wpp_smartresponder_button_style'];
        $page_selling_meta['_wpp_smartresponder_button_text'] = $_POST['wpp_smartresponder_button_text'];
        $page_selling_meta['_wpp_smartresponder_bg_color_1'] = $_POST['wpp_smartresponder_bg_color_1'];
        $page_selling_meta['_wpp_smartresponder_bg_color_2'] = $_POST['wpp_smartresponder_bg_color_2'];
        $page_selling_meta['_wpp_smartresponder_border_style'] = $_POST['wpp_smartresponder_border_style'];
        $page_selling_meta['_wpp_smartresponder_border_width'] = $_POST['wpp_smartresponder_border_width'];
        $page_selling_meta['_wpp_smartresponder_border_color'] = $_POST['wpp_smartresponder_border_color'];
        $page_selling_meta['_wpp_smartresponder_code'] = $_POST['wpp_smartresponder_code'];
        $page_selling_meta['_wpp_smartresponder_tid'] = $_POST['wpp_smartresponder_tid'];
        $page_selling_meta['_wpp_smartresponder_uid'] = $_POST['wpp_smartresponder_uid'];
        $page_selling_meta['_wpp_smartresponder_did'] = $_POST['wpp_smartresponder_did'];
        $page_selling_meta['_wpp_smartresponder_show_name'] = $_POST['wpp_smartresponder_show_name'];
        $page_selling_meta['_wpp_smartresponder_show_email'] = $_POST['wpp_smartresponder_show_email'];
        $page_selling_meta['_wpp_smartresponder_show_tel'] = $_POST['wpp_smartresponder_show_tel'];


        $page_selling_meta['_wpp_media_smartresponder_form_version'] = $_POST['wpp_media_smartresponder_form_version'];
        $page_selling_meta['_wpp_media_smartresponder_title'] = $_POST['wpp_media_smartresponder_title'];
        $page_selling_meta['_wpp_media_smartresponder_button_style'] = $_POST['wpp_media_smartresponder_button_style'];
        $page_selling_meta['_wpp_media_smartresponder_button_text'] = $_POST['wpp_media_smartresponder_button_text'];
        $page_selling_meta['_wpp_media_smartresponder_bg_color_1'] = $_POST['wpp_media_smartresponder_bg_color_1'];
        $page_selling_meta['_wpp_media_smartresponder_bg_color_2'] = $_POST['wpp_media_smartresponder_bg_color_2'];
        $page_selling_meta['_wpp_media_smartresponder_border_style'] = $_POST['wpp_media_smartresponder_border_style'];
        $page_selling_meta['_wpp_media_smartresponder_border_width'] = $_POST['wpp_media_smartresponder_border_width'];
        $page_selling_meta['_wpp_media_smartresponder_border_color'] = $_POST['wpp_media_smartresponder_border_color'];
        $page_selling_meta['_wpp_media_smartresponder_code'] = $_POST['wpp_media_smartresponder_code'];
        $page_selling_meta['_wpp_media_smartresponder_tid'] = $_POST['wpp_media_smartresponder_tid'];
        $page_selling_meta['_wpp_media_smartresponder_uid'] = $_POST['wpp_media_smartresponder_uid'];
        $page_selling_meta['_wpp_media_smartresponder_did'] = $_POST['wpp_media_smartresponder_did'];
        $page_selling_meta['_wpp_media_smartresponder_show_name'] = $_POST['wpp_media_smartresponder_show_name'];
        $page_selling_meta['_wpp_media_smartresponder_show_email'] = $_POST['wpp_media_smartresponder_show_email'];
        $page_selling_meta['_wpp_media_smartresponder_show_tel'] = $_POST['wpp_media_smartresponder_show_tel'];

        $page_selling_meta['_wppage_seo_title'] = $_POST['wppage_seo_title'];
        $page_selling_meta['_wppage_seo_keywords'] = $_POST['wppage_seo_keywords'];
        $page_selling_meta['_wppage_seo_desc'] = $_POST['wppage_seo_desc'];

        $page_selling_meta['_product_title'] = $_POST['product_title'];
        $page_selling_meta['_product_price'] = $_POST['product_price'];
        $page_selling_meta['_product_currency'] = $_POST['product_currency'];
        $page_selling_meta['_product_shop_id'] = $_POST['product_shop_id'];
        $page_selling_meta['_product_desc'] = $_POST['product_desc'];
        $page_selling_meta['_is_product'] = $_POST['is_product'];
        $page_selling_meta['_use_comments'] = $_POST['use_comments'];
        $page_selling_meta['_use_comments_tabs'] = $_POST['use_comments_tabs'];
        $page_selling_meta['_use_comments_stack'] = $_POST['use_comments_stack'];
        $page_selling_meta['_use_comments_columns'] = $_POST['use_comments_columns'];
        $page_selling_meta['_use_comments_order'] = $_POST['use_comments_order'];
        $page_selling_meta['_use_comments_tabs_order'] = $_POST['use_comments_tabs_order'];
        $page_selling_meta['_use_comments_stack_order'] = $_POST['use_comments_stack_order'];
        $page_selling_meta['_use_comments_columns_order'] = $_POST['use_comments_columns_order'];
        $page_selling_meta['_wppage_comments_style'] = $_POST['wppage_comments_style'];



        $page_selling_meta['_wppage_head_code'] = $_POST['wppage_head_code'];
        $page_selling_meta['_wppage_body_code'] = $_POST['wppage_body_code'];
        $page_selling_meta['_wppage_footer_code'] = $_POST['wppage_footer_code'];

    }elseif(wpp_package() == 'START'){

        $page_selling_meta['_coach_media'] = $_POST['coach_media'];
        $page_selling_meta['_coach_media_only'] = $_POST['coach_media_only'];
        $page_selling_meta['_coach_title'] = $_POST['coach_title'];
        $page_selling_meta['_coach_use_image'] = $_POST['coach_use_image'];
        $page_selling_meta['_coach_video_link'] = $_POST['coach_video_link'];
        $page_selling_meta['_coach_video_play'] = $_POST['coach_video_play'];

        /* old responder options -- deprecated */
        $page_selling_meta['_coach_newsletter_description'] = $_POST['coach_newsletter_description'];
        $page_selling_meta['_coach_newsletter_name_helper'] = $_POST['coach_newsletter_name_helper'];
        $page_selling_meta['_coach_newsletter_email_helper'] = $_POST['coach_newsletter_email_helper'];
        $page_selling_meta['_coach_responder_code'] = $_POST['coach_responder_code'];
        $page_selling_meta['_coach_responder_tid'] = $_POST['coach_responder_tid'];
        $page_selling_meta['_coach_responder_did'] = $_POST['coach_responder_did'];
        $page_selling_meta['_coach_responder_uid'] = $_POST['coach_responder_uid'];
        $page_selling_meta['_coach_privacy_show'] = $_POST['coach_privacy_show'];
        $page_selling_meta['_coach_privacy_description'] = $_POST['coach_privacy_description'];
        $page_selling_meta['_responder_button_style'] = $_POST['responder_button_style'];
        $page_selling_meta['_responder_button_text'] = $_POST['responder_button_text'];

        $page_selling_meta['_wpp_getresponse'] = $_POST['wpp_getresponse'];
        $page_selling_meta['_wpp_getresponse_code'] = $_POST['wpp_getresponse_code'];
        $page_selling_meta['_wpp_getresponse_wid'] = $_POST['wpp_getresponse_wid'];
        $page_selling_meta['_wpp3_media_response_type'] = $_POST['wpp3_media_response_type'];

        $page_selling_meta['_wpp_mailchimp_code'] = $_POST['wpp_mailchimp_code'];
        $page_selling_meta['_wpp_unisender_code'] = $_POST['wpp_unisender_code'];
        $page_selling_meta['_wpp_justclick_code'] = $_POST['wpp_justclick_code'];

        $page_selling_meta['_wpp3_media_smartresponder_code'] = $_POST['wpp3_media_smartresponder_code'];
        $page_selling_meta['_wpp3_media_justclick_code'] = $_POST['wpp3_media_justclick_code'];
        $page_selling_meta['_wpp3_media_mailchimp_code'] = $_POST['wpp3_media_mailchimp_code'];
        $page_selling_meta['_wpp3_media_getresponse_code'] = $_POST['wpp3_media_getresponse_code'];
        $page_selling_meta['_wpp3_media_unisender_code'] = $_POST['wpp3_media_unisender_code'];

        $page_selling_meta['_mediabox_background_color'] = $_POST['mediabox_background_color'];
        $page_selling_meta['_mediabox_color'] = $_POST['mediabox_color'];
        $page_selling_meta['_mediabox_border_color'] = $_POST['mediabox_border_color'];
        $page_selling_meta['_mediabox_border_width'] = $_POST['mediabox_border_width'];
        $page_selling_meta['_mediabox_border_style'] = $_POST['mediabox_border_style'];
        $page_selling_meta['_mediabox_shadow_color'] = $_POST['mediabox_shadow_color'];
        $page_selling_meta['_mediabox_shadow_blur'] = $_POST['mediabox_shadow_blur'];

        $page_selling_meta['_wpp_smartresponder_code_3'] = $_POST['wpp_smartresponder_code_3'];

        $page_selling_meta['_wpp_smartresponder_form_version'] = $_POST['wpp_smartresponder_form_version'];
        $page_selling_meta['_wpp_smartresponder_title'] = $_POST['wpp_smartresponder_title'];
        $page_selling_meta['_wpp_smartresponder_button_style'] = $_POST['wpp_smartresponder_button_style'];
        $page_selling_meta['_wpp_smartresponder_button_text'] = $_POST['wpp_smartresponder_button_text'];
        $page_selling_meta['_wpp_smartresponder_bg_color_1'] = $_POST['wpp_smartresponder_bg_color_1'];
        $page_selling_meta['_wpp_smartresponder_bg_color_2'] = $_POST['wpp_smartresponder_bg_color_2'];
        $page_selling_meta['_wpp_smartresponder_border_style'] = $_POST['wpp_smartresponder_border_style'];
        $page_selling_meta['_wpp_smartresponder_border_width'] = $_POST['wpp_smartresponder_border_width'];
        $page_selling_meta['_wpp_smartresponder_border_color'] = $_POST['wpp_smartresponder_border_color'];
        $page_selling_meta['_wpp_smartresponder_code'] = $_POST['wpp_smartresponder_code'];
        $page_selling_meta['_wpp_smartresponder_tid'] = $_POST['wpp_smartresponder_tid'];
        $page_selling_meta['_wpp_smartresponder_uid'] = $_POST['wpp_smartresponder_uid'];
        $page_selling_meta['_wpp_smartresponder_did'] = $_POST['wpp_smartresponder_did'];
        $page_selling_meta['_wpp_smartresponder_show_name'] = $_POST['wpp_smartresponder_show_name'];
        $page_selling_meta['_wpp_smartresponder_show_email'] = $_POST['wpp_smartresponder_show_email'];
        $page_selling_meta['_wpp_smartresponder_show_tel'] = $_POST['wpp_smartresponder_show_tel'];

        $page_selling_meta['_wpp_media_smartresponder_form_version'] = $_POST['wpp_media_smartresponder_form_version'];
        $page_selling_meta['_wpp_media_smartresponder_title'] = $_POST['wpp_media_smartresponder_title'];
        $page_selling_meta['_wpp_media_smartresponder_button_style'] = $_POST['wpp_media_smartresponder_button_style'];
        $page_selling_meta['_wpp_media_smartresponder_button_text'] = $_POST['wpp_media_smartresponder_button_text'];
        $page_selling_meta['_wpp_media_smartresponder_bg_color_1'] = $_POST['wpp_media_smartresponder_bg_color_1'];
        $page_selling_meta['_wpp_media_smartresponder_bg_color_2'] = $_POST['wpp_media_smartresponder_bg_color_2'];
        $page_selling_meta['_wpp_media_smartresponder_border_style'] = $_POST['wpp_media_smartresponder_border_style'];
        $page_selling_meta['_wpp_media_smartresponder_border_width'] = $_POST['wpp_media_smartresponder_border_width'];
        $page_selling_meta['_wpp_media_smartresponder_border_color'] = $_POST['wpp_media_smartresponder_border_color'];
        $page_selling_meta['_wpp_media_smartresponder_code'] = $_POST['wpp_media_smartresponder_code'];
        $page_selling_meta['_wpp_media_smartresponder_tid'] = $_POST['wpp_media_smartresponder_tid'];
        $page_selling_meta['_wpp_media_smartresponder_uid'] = $_POST['wpp_media_smartresponder_uid'];
        $page_selling_meta['_wpp_media_smartresponder_did'] = $_POST['wpp_media_smartresponder_did'];
        $page_selling_meta['_wpp_media_smartresponder_show_name'] = $_POST['wpp_media_smartresponder_show_name'];
        $page_selling_meta['_wpp_media_smartresponder_show_email'] = $_POST['wpp_media_smartresponder_show_email'];
        $page_selling_meta['_wpp_media_smartresponder_show_tel'] = $_POST['wpp_media_smartresponder_show_tel'];

        $page_selling_meta['_wppage_seo_title'] = $_POST['wppage_seo_title'];
        $page_selling_meta['_wppage_seo_keywords'] = $_POST['wppage_seo_keywords'];
        $page_selling_meta['_wppage_seo_desc'] = $_POST['wppage_seo_desc'];

        $page_selling_meta['_product_title'] = $_POST['product_title'];
        $page_selling_meta['_product_price'] = $_POST['product_price'];
        $page_selling_meta['_product_currency'] = $_POST['product_currency'];
        $page_selling_meta['_product_shop_id'] = $_POST['product_shop_id'];
        $page_selling_meta['_product_desc'] = $_POST['product_desc'];
        $page_selling_meta['_is_product'] = $_POST['is_product'];


        $page_selling_meta['_wppage_head_code'] = $_POST['wppage_head_code'];
        $page_selling_meta['_wppage_body_code'] = $_POST['wppage_body_code'];
        $page_selling_meta['_wppage_footer_code'] = $_POST['wppage_footer_code'];
    }

    // Add values of $sinus_meta as custom fields

    foreach ($page_selling_meta as $key => $value) { // Cycle through the $sinus_meta array!
        // if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
        if (get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { // If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }

}