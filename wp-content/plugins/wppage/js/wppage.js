jQuery(function ($) {


        /*if (typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function") {
            tinyMCE.settings = {
                width: '100%',
                height: '100',
                theme: 'advanced',
                skin: 'wp_theme',
                theme_advanced_buttons1: 'bold,italic,underline,forecolor,|,numlist,bullist,|,outdent,indent,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,removeformat, |,image',
                theme_advanced_buttons2: 'fontselect,fontsizeselect,formatselect,',
                theme_advanced_buttons3: '',
                theme_advanced_buttons4: '',
                theme_advanced_toolbar_location: 'top',
                theme_advanced_toolbar_align: 'left',
                //theme_advanced_statusbar_location : 'bottom',
                theme_advanced_resizing: false,
                //theme_advanced_resize_horizontal : false,
                dialog_type: 'modal',
                relative_urls: false,
                remove_script_host: false,
                convert_urls: false,
                apply_source_formatting: false,
                remove_linebreaks: false,
                //gecko_spellcheck : true,
                entities: '38,amp,60,lt,62,gt',
                accessibility_focus: true,
                tabfocus_elements: 'major-publishing-actions',
                //media_strict : false,
                //paste_remove_styles : true,
                //paste_remove_spans : true,
                paste_strip_class_attributes: 'all',
                wpeditimage_disable_captions: false
            };
            tinyMCE.execCommand("mceAddControl", true, "coach_title");
            tinyMCE.execCommand("mceAddControl", true, "coach_newsletter_description");
            tinyMCE.execCommand("mceAddControl", true, "coach_timer_description");
            tinyMCE.execCommand("mceAddControl", true, "coach_privacy_description");
            tinyMCE.execCommand("mceAddControl", true, "wpp_smartresponder_title");
            tinyMCE.execCommand("mceAddControl", true, "wpp_media_smartresponder_title");
        }*/


    $("#wppage_tabs").tabs({
        autoHeight: false,

        collapsible: false,
        fx: {
            opacity: 'toggle',
            duration: 'fast'
        }

    }).addClass('ui-tabs-vertical ui-helper-clearfix');

    $('.wppage_inner_tabs').tabs({

        collapsible: false,
        fx: {
            opacity: 'toggle',
            duration: 'fast'
        }

    });

    //------------------------- radio, checkbox, select

    $('.wppage_radio input:checked').each(function () {
        $(this).parent().addClass('wppage_checked');
    });

    $('.wppage_radio input').live('change', function () {
        var name = $(this).attr('name');
        $('input[name = ' + name + ']').each(function () {
            $(this).parent().removeClass('wppage_checked');
        });
        $(this).parent().addClass('wppage_checked');
    });

    $('.wpp_subsc_thumb input').live('change', function () {
        if ($(this).hasClass('trial')) return false;
        var name = $(this).attr('name');
        $('input[name = ' + name + ']').each(function () {
            $(this).parent().removeClass('wppage_checked');
        });
        $(this).parent().addClass('wppage_checked');
    });
    $('.ps_bullets_form input, .p_cbutton input, .ps_satisfaction input, .ps_arrows input, .ps_bonus input, .ps_cbutton input, .ps_timer_image input, .wpp_header input').live('change', function () {
        var name = $(this).attr('name');
        $('input[name = ' + name + ']').each(function () {
            $(this).parent().removeClass('wppage_checked');
        });
        $(this).parent().addClass('wppage_checked');
    });


    $('.wppage_checkbox input:checked, .p_cbutton input:checked').each(function () {
        $(this).parent().addClass('wppage_checked');
    });

    $('.wppage_checkbox input:checkbox').live('change', function () {
        $(this).parent().toggleClass('wppage_checked');
    });

    $('.wppage_checkbox input:radio').live('change', function () {
        $('input[name=' + $(this).attr("name") + ']').each(function () {
            $(this).parent().removeClass('wppage_checked');
        });
        $(this).parent().toggleClass('wppage_checked');
    });
    $('.wppage_checkbox input:disabled, .wppage_radio input:disabled').live('click', function () {
        return false;
    });


    //----------------------------- video border style  -------

    $('.wppage_radio_V input:checked').each(function () {
        $(this).parent().addClass('wppage_checked');
    });

    $('.wppage_radio_v input').live('change', function () {
        if ($('input[name=video_border]:checked').val() == 'yes') {
            var name = $(this).attr('name');
            $('input[name = ' + name + ']').each(function () {
                $(this).parent().removeClass('wppage_checked');
            });
            $(this).parent().addClass('wppage_checked');
        }
    });

    $('input[name=video_border]').live('change', function () {
        if ($(this).val() == 'yes') {
            $('#video-width, #video-height').attr('disabled', 'disabled');
            $('.video_border_640 input').click();
            $('.video_styles label:first-child input').click();
        } else {
            $('#video-width, #video-height').removeAttr('disabled');
            $('.video_border_sizes label, .video_styles > label').removeClass('wppage_checked');
            $('.video_border_sizes input:checked, .video_styles input:checked').removeAttr('checked');
        }
    });
    $('input[name=video_border_size]').live('click', function () {

        if ($('input[name=video_border]:checked').val() == 'yes') {
            if ($(this).val() == '480x270') {
                $('#video-width').val('480');
                $('#video-height').val('270');
            }
            if ($(this).val() == '560x315') {
                $('#video-width').val('560');
                $('#video-height').val('315');
            }
            if ($(this).val() == '640x360') {
                $('#video-width').val('640');
                $('#video-height').val('360');
            }
            if ($(this).val() == '720x405') {
                $('#video-width').val('720');
                $('#video-height').val('405');
            }
        }
    });


    // --------------------------- wppage editor

    $('.wppage_edit_ico, .wppage_text_preview').click(function () {
        var name = $(this).attr('text_id');
        tinyMCE.get(name).dom.setStyles(tinyMCE.get(name).dom.select('body'), {'min-height': '75px', 'line-height': 'normal'});
        $('.wppage_editor_box').css({'display': 'none', 'opacity': 0});
        //$('.' + $(this).attr('text_id')).css({'display':'block'});
        $('.' + $(this).attr('text_id') + '_box').css({'display': 'block'}).animate({'opacity': 1}, 150, function () {
            // alert(tinyMCE.get(name).getContent(content));
        });
    });

    $('a.wppage_save_text').click(function () {
        var name = $(this).attr('text_id');
        var content = tinyMCE.get(name).getContent();
        $('.' + name + '_text').html(content);
        $(this).parent().parent().animate({'opacity': 0}, 150).css({'display': 'none'});

    });
    $('a.wppage_cancel_text').click(function () {
        var name = $(this).attr('text_id');
        var content = $('.' + name + '_text').html();
        tinyMCE.get(name).setContent(content);
        $(this).parent().parent().css({'display': 'none'});
    });
    //---------------------------   wppage select

    $('#wpp_media_smartresponder_button_style_selected, #wpp_smartresponder_button_style_selected').live('click', function () {
        var name = $(this).attr('box_id');
        $('.' + name).css({'display': 'block'});
    });
    $('a.wpp_close_box').click(function () {
        $(this).parent().css({'display': 'none'});
    });
    $('input[name=wpp_media_smartresponder_button_style]').live('change', function () {
        $('#wpp_media_smartresponder_button_style_selected').attr('class', '').addClass('ps_button_' + $(this).val());
    });
    $('input[name=wpp_smartresponder_button_style]').live('change', function () {
        $('#wpp_smartresponder_button_style_selected').attr('class', '').addClass('ps_button_' + $(this).val());
    });


    //------------------------------ wpp_smartresponder_form_version

    $('input[name=wpp_smartresponder_form_version]:checked').each(function () {
        $('.wpp_smartresponder_settings').css({'display': 'none'});
        $('#wppage_inner_tab_' + $(this).val()).css({'display': 'block'});
    });

    $('input[name=wpp_smartresponder_form_version]').live('change', function () {
        $('.wpp_smartresponder_settings').css({'display': 'none'});
        $('#wppage_inner_tab_' + $(this).val()).css({'display': 'block'});
    });


    $('input[name=wpp_media_smartresponder_form_version]:checked').each(function () {
        $('.wpp_media_smartresponder_settings_box').css({'display': 'none'});
        $('#wppage_media_inner_tab_' + $(this).val()).css({'display': 'block'});
    });

    $('input[name=wpp_media_smartresponder_form_version]').live('change', function () {
        $('.wpp_media_smartresponder_settings_box').css({'display': 'none'});
        $('#wppage_media_inner_tab_' + $(this).val()).css({'display': 'block'});
    });


    //------------------------- find uid gid

    $('#coach_responder_code').bind('blur', function () {

        var uid = did = tid = '';
        $('#crc_temp_1').html($('#coach_responder_code').val());
        uid = $('#crc_temp_1').find('input[name="uid"]').val();
        did = $('#crc_temp_1').find('input[name="did[]"]').val();
        tid = $('#crc_temp_1').find('input[name="tid"]').val();


        $('#coach_responder_uid').attr('value', uid);
        $('#coach_responder_did').attr('value', did);
        $('#coach_responder_tid').attr('value', tid);

    });

    $('#wpp_getresponse_code').bind('blur', function () {

        var wid = '';
        $('#getresponse_code_temp').html($('#wpp_getresponse_code').val());
        var url = $('#getresponse_code_temp').find('script').attr('src');

        $('#wpp_getresponse_wid').attr('value', wid);

    });

    $('#smartresponder_code').live('change', (function () {
        var uid = did = tid = "";
        $('body').append('<div id="temp_code" style="display:none"></div>');
        $("#temp_code").html($('#smartresponder_code').val());

        uid = $("#temp_code").find("input[name='uid']").val();
        did = $("#temp_code").find("input[name='did[]']").val();
        tid = $("#temp_code").find("input[name='tid']").val();
        $("#r_uid").attr("value", uid);
        $("#r_did").attr("value", did);
        $("#r_tid").attr("value", tid);
        $('#temp_code').remove();
    }));

    $('#wpp_smartresponder_code').live('change', (function () {
        var uid = did = tid = "";
        $('body').append('<div id="crc_temp_2" style="display:none"></div>');
        $("#crc_temp_2").html($('#wpp_smartresponder_code').val());

        uid = $("#crc_temp_2").find("input[name='uid']").val();
        did = $("#crc_temp_2").find("input[name='did[]']").val();
        tid = $("#crc_temp_2").find("input[name='tid']").val();
        $("#wpp_smartresponder_uid").attr("value", uid);
        $("#wpp_smartresponder_did").attr("value", did);
        $("#wpp_smartresponder_tid").attr("value", tid);
        $('#crc_temp_2').remove();
    }));
    $('#wpp_media_smartresponder_code').live('change', (function () {
        var uid = did = tid = "";
        $('body').append('<div id="crc_temp_3" style="display:none"></div>');
        $("#crc_temp_3").html($('#wpp_media_smartresponder_code').val());

        uid = $("#crc_temp_3").find("input[name='uid']").val();
        did = $("#crc_temp_3").find("input[name='did[]']").val();
        tid = $("#crc_temp_3").find("input[name='tid']").val();
        $("#wpp_media_smartresponder_uid").attr("value", uid);
        $("#wpp_media_smartresponder_did").attr("value", did);
        $("#wpp_media_smartresponder_tid").attr("value", tid);
        $('#crc_temp_3').remove();
    }));


    //---------------

    $('#ps_background_image_selected').live('click', function () {
        var name = $(this).attr('box_id');
        $('.' + name).css({'display': 'block'});
    });

    $('#ps_background_image').bind('change', function () {
        $('#bg_preview').css({'background-image': 'url(' + $("#ps_background_image").val() + ')'});

    });

    $('.wpp_bg_images_content .wpp_bg').live('click', function () {
        var bg = $(this).children('input').val();
        if (bg != 'no_image') {
            $('#bg_preview').css({'background-image': 'url(' + bg + ')'});
            $('#ps_background_image').val(bg);

        } else {
            $('#bg_preview').css({'background-image': ''}).addClass('no_image');
            $('#ps_background_image').val('');
        }


    });


});
function getParameterByName(name, string) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(string);
    if (results == null)
        return "";
    else
        return decodeURIComponent(results[1].replace(/\+/g, " "));
}