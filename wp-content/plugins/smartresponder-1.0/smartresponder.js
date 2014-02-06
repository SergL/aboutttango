$(function(){
    //Default settings
    var sub_form_c = 0;
    if($.browser.mozilla) {
        sub_form_c = 28;
    }
    else {
        sub_form_c = 10;
    }
    var sub_form_settings_height_d = $('#sub-form-settings').height();
    var additional_settings_settings_height_d = $('#additional-settings-settings').height();
    var header_settings_height_d = $('#header-settings').height();
    var field_settings_height_d = $('#field-settings').height();
    var button_settings_height_d = $('#button-settings').height();
    $('#additional-settings-header').css('margin-top',sub_form_settings_height_d+sub_form_c+'px');
    $('#header-settings-header').css('margin-top',additional_settings_settings_height_d+10+'px');
    $('#field-settings-header').css('margin-top',header_settings_height_d+10+'px');
    $('#button-settings-header').css('margin-top',field_settings_height_d+10+'px');
    $('#form_generator').removeClass('visible');
    $('#setup').addClass('visible');
    //link
    var link = window.location.href;
    var splitted = link.split('wp-admin');
    //Get API key
    var get_api_key_data = {
        action: 'get_api_key'
    }
    $.getJSON(ajaxurl, get_api_key_data, function(data){
        if(data != 'no') {
            $('input[name="api_key"]').val(data);
        }
    });
    //Get Author id
    var get_author_id_data = {
        action: 'get_author_id'
    }
    $.getJSON(ajaxurl, get_author_id_data, function(data){
        $('input[name="author_id"]').val(data.id);
        $('.sr-box-list').after('<input type="hidden" name="uid" value='+data.id+'>');
    });
    //Check authentication
    var data = {
        action: 'authentication'
    }
    $.getJSON(ajaxurl, data, function(data){
        if(data != null) {
            if(data.result != 0) {
                $('.login').hide();
                $('.logout').show();
                $('.author_stats').text('Вы зашли как: '+data.login+' ('+data.name_last+' '+data.name_first+')');
                $('#tabs').removeClass('tabs-disabled').addClass('tabs');
            }
        }
    });
    //Log In
    $('input[name="login-sr"]').click(function(){
        var loading_img_link = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/loading.gif';
        $('.login_loading').html('<img src="'+loading_img_link+'" class="loading_img" />');
        var api_key = $('input[name="apikey"]').val();
        if(api_key.length == 0) {
            $('.error p.red').text('Введите API ключ.');
            $('.error').show();
            $('.loading_img').remove();
        }
        else {
            var data = {
                action: 'login',
                api_key: api_key
            }
            $.getJSON(ajaxurl, data, function(data){
                if(data == 'error_u') {
                    $('.error p.red').text('Вы указали не верный API ключ.');
                    $('.error').show();
                    $('.loading_img').remove();
                }
                if(data == 'error_d') {
                    $('.error p.red').text('Для использования плагина вам необходимо иметь хотя бы одну рассылку.');
                    $('.error').show();
                    $('.loading_img').remove();
                }
                if(data != 'error_u' && data != 'error_d') {
                    $('input[name="uid"]').remove();
                    $('.error, .login').hide();
                    $('.loading_img').remove();
                    $('.logout').show();
                    $('.author_stats').text('Вы зашли как: '+data.login+' ('+data.name_last+' '+data.name_first+')');
                    $('input[name="api_key"]').val(api_key);
                    $('input[name="author_id"]').val(data.id);
                    $('.sr-box-list').after('<input type="hidden" name="uid" value='+data.id+'>');
                    $('#tabs').removeClass('tabs-disabled').addClass('tabs');
                }
            });
        }
    });
    //Log Out
    $('input[name="logout-sr"]').click(function(){
        var data = {
            action: 'logout'
        }
        $.getJSON(ajaxurl, data, function(){
            $('.logout').hide();
            $('.login').show();
            $('#tabs').removeClass('tabs').addClass('tabs-disabled');
            window.location.reload(true);
        });
    });
    //Tabs
    $('#tabs').delegate('li:not(.current)', 'click', function(){
        if($('#tabs').hasClass('tabs')) {
            $(this).addClass('current').siblings().removeClass('current')
                   .parents('div.section').find('div.box').hide().eq($(this).index()).fadeIn(150);
        }
    });
    //Header checkbox
    $('input[name="element_header"]').click(function(){
        var n = $('input[name="element_header"]:checked').length;
        if(n == 1) {
            $('.form-header').show();
            $('#header-settings-header, #header-settings').show();
            $('#field-settings-header').css('margin-top',header_settings_height_d+10+'px');
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        else {
            $('.form-header').hide();
            $('#header-settings-header, #header-settings').hide();
            $('#field-settings-header').css('margin-top',additional_settings_settings_height_d+10+'px');
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
    });
    //subscribe
    $('.user-caption').click(function(){
        if($('.order-caption').hasClass('minus')) {
            $('.order-fields').hide('blind', { direction: 'vertical' }, 200);
            $('.user-fields').show('blind', { direction: 'vertical' }, 200);
            $('.user-caption').addClass('minus').css('background-image' ,'url(https://smartresponder.ru/imgs/static/send_message/minus.png)');
            $('.order-caption').removeClass('minus').css('background-image' ,'url(https://smartresponder.ru/imgs/static/send_message/plus.png)');
            if(!$('.mega-table:first tbody tr').hasClass('wp_users')) {
                $('#tablePagination').hide();
                var loading_img_link = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/loading.gif';
                $('.mega-table tbody').append('<tr class="loading_users_result"><td colspan="5"><img src="'+loading_img_link+'" /></td></tr>');
                var send_users_ch = '';
                if($('input[name="send_users_ch"]:checked').length == 1) {
                    send_users_ch = '1';
                }
                else {
                    send_users_ch = '0';
                }
                var getUsersData = {
                    action: 'get_users',
                    send_users_ch: send_users_ch
                }
                $.ajax({
                    url : ajaxurl,
                    data : getUsersData,
                    dataType : 'json',
                    success : function(data) {
                        $.each(data, function(number, item){
                            $('#tablePagination').show();
                            $('.loading_users_result').remove();
                            $('.mega-table tbody').append('<tr class="wp_users"><td id="user_id">'+item.id+'</td><td id="wp_nickname_'+item.id+'">'+item.user_nicename+'</td><td id="wp_email_'+item.id+'">'+item.user_email+'</td><td>'+item.user_registered+'</td><td><input type="checkbox" class="checkbox_users" name="wp_users_'+item.id+'" value="" /></td></tr>');
                            $('.wp_users').show();
                        });
                        $('.mega-table:first tr').each(function(i, it){
                            if(i % 2 == 0) {
                                $(this).addClass('even');
                            }
                        });
                        if($('.maga-table tr').hasClass('wp_users')) {
                            var users_count = $('.mega-table tbody tr.wp_users').length;
                            $('#users_count').text(users_count);    
                        }
                        else {
                            $('#users_count').text('0');
                        }
                        var records_on_page = parseInt($('select[name="records_on_page"]').val());
                        var users_count = parseInt($('#users_count').text());
                        $('.mega-table').paginateTable({ rowsPerPage: records_on_page });
                        if(records_on_page < users_count) {
                            $('.pager').show();
                        }
                        else {
                            $('.pager').hide();
                        }
                    }
                });
                var records_on_page = parseInt($('select[name="records_on_page"]').val());
                var users_count = parseInt($('#users_count').text());
                $('.mega-table').paginateTable({ rowsPerPage: records_on_page });
                if(records_on_page < users_count) {
                    $('.pager').show();
                }
                else {
                    $('.pager').hide();
                }
            }
        }
    });
    $('.order-caption').click(function(){
        $('#modalWindow_pixel2').hide();
        if(!$('.mega-table tr').hasClass('no_result')) {
            var selected_number_count = $('.mega-table tr.wp_users .checkbox_users:checked').length;
            $('#selected_number_count').text(selected_number_count);
            if(selected_number_count == 0) {
                var no_selected_number_count = $('.mega-table tr.wp_users .checkbox_users').length;
                $('#selected_number_count').text(no_selected_number_count);
            }
            if($('.user-caption').hasClass('minus')) {
                $('.user-fields').hide('blind', { direction: 'vertical' }, 200);
                $('.order-fields').show('blind', { direction: 'vertical' }, 200);
                $('.order-caption').addClass('minus').css('background-image' ,'url(https://smartresponder.ru/imgs/static/send_message/minus.png)');
                $('.user-caption').removeClass('minus').css('background-image' ,'url(https://smartresponder.ru/imgs/static/send_message/plus.png)');    
            }
        }
        else {
            alert('У вас нет данных для импорта.');
        }
    });
    $('input[name="nextstep"]').click(function(){
        $('#modalWindow_pixel2').hide();
        if(!$('.mega-table tr').hasClass('no_result')) {
            var selected_number_count = $('.mega-table tr.wp_users .checkbox_users:checked').length;
            $('#selected_number_count').text(selected_number_count);
            if(selected_number_count == 0) {
                var no_selected_number_count = $('.mega-table tr.wp_users .checkbox_users').length;
                $('#selected_number_count').text(no_selected_number_count);
            }
            if($('.user-caption').hasClass('minus')) {
                $('.user-fields').hide('blind', { direction: 'vertical' }, 200);
                $('.order-fields').show('blind', { direction: 'vertical' }, 200);
                $('.order-caption').addClass('minus').css('background-image' ,'url(https://smartresponder.ru/imgs/static/send_message/minus.png)');
                $('.user-caption').removeClass('minus').css('background-image' ,'url(https://smartresponder.ru/imgs/static/send_message/plus.png)');    
            }
        }
        else {
            alert('У вас нет данных для импорта.');
        }
    });
    $('#sub-form').change(function(){
        $('input[name="did"], input[name="did[]"]').remove();
        var sub_form = $('#sub-form').val();
        $('#counter_li').remove();
        if(sub_form.length > 1) {
            //delete tr
            $('#d_tbl tbody tr').remove();
            //create li
            if(!$('.sr-box-list li').is('.subscribe-li')) {
                $('.form-header').after('<li class="subscribe-li"><label style="margin-top: 10px; font-size: 13px; color: rgb(189, 189, 189); font-family: arial; font-weight: bold; font-style: normal; ">Выберите рассылки:</label></li>');
                $('.subscribe-li').attr('style', $('.form-header').attr('style'));
            }
            //create table
            if(!$('.subscribe-li table').is('#d_tbl')) {
                var width = $('.fields').css('width');
                $('.subscribe-li').append('<table style="display:inline-table; width: '+width+'" cellpadding="4" id="d_tbl"><tbody></tbody></table>');
            }
            //add subscribe
            var sub_form_id_Array = sub_form.toString().split(',');
            for(var i=0;i<sub_form_id_Array.length;i++){
                var sub_form_text = $('#sub-form option[value="'+sub_form_id_Array[i]+'"]').text();
                var indexOfcode = sub_form_text.indexOf(' [');
                var new_sub_form_text = sub_form_text.substr(0,indexOfcode);
                if(!$('#d_tbl tbody tr').is('#'+sub_form_id_Array[i])) {
                    $("#d_tbl > tbody").append('<tr id="'+sub_form_id_Array[i]+'"><td><input type="checkbox" name="delivery_variant" checked="checked" value="'+sub_form_id_Array[i]+'"><td style="text-align: left; height: 27px;">'+new_sub_form_text+'</td></tr>');
                }
                $('.sr-box-list').after('<input type="hidden" name="did[]" value="'+sub_form_id_Array[i]+'" />');
            }
            $('#counter-settings-header, #counter-settings').hide();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        else {
            $('.subscribe-li').remove();
            if(sub_form.length == 1) {
                $('.sr-box-list').after('<input type="hidden" name="did[]" value="'+sub_form+'" />');
                var counter_img_font = $('input[name="counter_img_font"]').val();
                var counter_img_size = $('input[name="counter_img_size"]').val();
                var counter_img_color = $('input[name="counter_img_color"]').val();
                var counter_img_bg = $('input[name="counter_img_bg"]').val();
                var counter_img_alignment = $('input[name="counter_img_alignment"]').val();
                var counter_title = $('input[name="unique_element_counter_title"]').val();
                var img = '';
                var n = $('input[name="element_counter"]:checked').length;
                if(n == 1) {
                    var counter_key = $('#'+sub_form).val();
                    var author_id = $('input[name="author_id"]').val();
                    var counter_img = 'http://smartresponder.ru/dcounter/'+author_id+'_'+counter_key+'_'+sub_form+'_1_'+counter_img_font+'_'+counter_img_size+'_'+counter_img_color+'_'+counter_img_bg+'_'+counter_img_alignment+'/counter.gif?1347869353';
                    if(counter_img_alignment == 'top') {
                        img = '<img style="vertical-align: middle; " src="'+counter_img+'"><br>'+counter_title;
                    }
                    if(counter_img_alignment == 'right') {
                        img = counter_title+'<img style="vertical-align: middle; " src="'+counter_img+'">';
                    }
                    if(counter_img_alignment == 'bottom') {
                        img = counter_title+'<br /><img style="vertical-align: middle; " src="'+counter_img+'">';
                    }
                    if(counter_img_alignment == 'left') {
                        img = '<img style="vertical-align: middle; " src="'+counter_img+'">'+counter_title;
                    }
                    $('.subscribe').after('<li id="counter_li" style="text-align: center; height: 45px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; "><label id="cnt" style="font-size: 13px; color: rgb(189, 189, 189); font-family: arial; font-weight: bold; font-style: normal; height: 40px;">'+img+'</label><input type="hidden" name="element_counter"></li>');
                    var element_counter_font = $('input[name="element_counter_font"]').val();
                    var element_counter_size = $('input[name="element_counter_size"]').val();
                    var element_counter_type = $('input[name="element_counter_type"]').val();
                    var element_counter_color = $('input[name="element_counter_color"]').val();
                    $('#cnt').css('font-family',element_counter_font);
                    $('#cnt').css('font-size',element_counter_size);
                    if(element_counter_type == 'normal') {
                        $('#cnt').css('font-weight','normal')
                                 .css('font-style','normal');
                    }
                    if(element_counter_type == 'bold') {
                        $('#cnt').css('font-weight','bold')
                                 .css('font-style','normal');
                    }
                    if(element_counter_type == 'italic') {
                        $('#cnt').css('font-weight','normal')
                                 .css('font-style','italic');
                    }
                    $('#cnt').css('color',element_counter_color);
                    $('#counter-settings-header, #counter-settings').show();
                    var counter_settings_height = $('#counter-settings').height();
                    $('#counter-settings-header').css('margin-top',button_settings_height_d+10+'px');
                }
                var form_height = $('.sr-box').height();
                $('#bg_image').css('height',form_height);
            }
        }
    });
    $('input[name="element_counter"]').click(function(){
        var sfc = $('#sub-form option:selected').length;
        if(sfc == 0) {
            alert('Выберите рассылки для подписки');
            $('input[name="element_counter"]').removeAttr('checked');
            $('input[name="element_counter"]').scroll(0,300); 
            $('html, body').animate({scrollTop:0}, 'slow');
            $('select[name="deliveries[]"]').css('border-color','red');
            setTimeout(function(){ 
                $('select[name="deliveries[]"]').css('border-color','#959595'); 
            }, 1900);
        }
        else {
            if(sfc == 1) {
                var counter_img_font = $('input[name="counter_img_font"]').val();
                var counter_img_size = $('input[name="counter_img_size"]').val();
                var counter_img_color = $('input[name="counter_img_color"]').val();
                var counter_img_bg = $('input[name="counter_img_bg"]').val();
                var counter_img_alignment = $('input[name="counter_img_alignment"]').val();
                var counter_title = $('input[name="unique_element_counter_title"]').val();
                var img = '';
                var n = $('input[name="element_counter"]:checked').length;
                if(n == 1) {
                    var sub_form = $('#sub-form').val();
                    var counter_key = $('#'+sub_form).val();
                    var author_id = $('input[name="author_id"]').val();
                    var counter_img = 'http://smartresponder.ru/dcounter/'+author_id+'_'+counter_key+'_'+sub_form+'_1_'+counter_img_font+'_'+counter_img_size+'_'+counter_img_color+'_'+counter_img_bg+'_'+counter_img_alignment+'/counter.gif?1347869353';
                    if(counter_img_alignment == 'top') {
                        img = '<img style="vertical-align: middle; " src="'+counter_img+'"><br>'+counter_title;
                    }
                    if(counter_img_alignment == 'right') {
                        img = counter_title+'<img style="vertical-align: middle; " src="'+counter_img+'">';
                    }
                    if(counter_img_alignment == 'bottom') {
                        img = counter_title+'<br /><img style="vertical-align: middle; " src="'+counter_img+'">';
                    }
                    if(counter_img_alignment == 'left') {
                        img = '<img style="vertical-align: middle; " src="'+counter_img+'">'+counter_title;
                    }
                    $('.subscribe').after('<li id="counter_li" style="text-align: center; height: 45px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; "><label id="cnt" style="font-size: 13px; color: rgb(189, 189, 189); font-family: arial; font-weight: bold; font-style: normal; height: 40px;">'+img+'</label><input type="hidden" name="element_counter"></li>');
                    var element_counter_font = $('input[name="element_counter_font"]').val();
                    var element_counter_size = $('input[name="element_counter_size"]').val();
                    var element_counter_type = $('input[name="element_counter_type"]').val();
                    var element_counter_color = $('input[name="element_counter_color"]').val();
                    $('#cnt').css('font-family',element_counter_font);
                    $('#cnt').css('font-size',element_counter_size);
                    if(element_counter_type == 'normal') {
                        $('#cnt').css('font-weight','normal')
                                 .css('font-style','normal');
                    }
                    if(element_counter_type == 'bold') {
                        $('#cnt').css('font-weight','bold')
                                 .css('font-style','normal');
                    }
                    if(element_counter_type == 'italic') {
                        $('#cnt').css('font-weight','normal')
                                 .css('font-style','italic');
                    }
                    $('#cnt').css('color',element_counter_color);
                    $('#counter-settings-header, #counter-settings').show();
                    var counter_settings_height = $('#counter-settings').height();
                    $('#counter-settings-header').css('margin-top',button_settings_height_d+10+'px');
                    var form_height = $('.sr-box').height();
                    $('#bg_image').css('height',form_height);
                }
                else {
                    $('#counter_li').remove();
                    $('#counter-settings-header, #counter-settings').hide();
                    var form_height = $('.sr-box').height();
                    $('#bg_image').css('height',form_height);
                }
            }
        }
    });
    $('#number_font').change(function(){
        var counter_img_font = $('input[name="counter_img_font"]').val();
        var img_src = $('#cnt img').attr('src');
        var number_font = $('#number_font option:selected').val();
        var new_img_src = img_src.replace(counter_img_font,number_font);
        $('input[name="counter_img_font"]').val(number_font);
        $('#cnt img').attr('src',new_img_src);
    });
    $('#number_size').change(function(){
        var counter_img_size = $('input[name="counter_img_size"]').val();
        var img_src = $('#cnt img').attr('src');
        var number_size = $('#number_size option:selected').val();
        var new_img_src = img_src.replace(counter_img_size,number_size);
        $('input[name="counter_img_size"]').val(number_size);
        $('#cnt img').attr('src',new_img_src);
    });
    $('.color-picker12').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            var counter_img_color = $('input[name="counter_img_color"]').val();
            var img_src = $('#cnt img').attr('src');
            var number_color = hex.replace('#','');
            var new_img_src = img_src.replace(counter_img_color,number_color);
            $('input[name="counter_img_color"]').val(number_color);
            $('#cnt img').attr('src',new_img_src);
        }
    });
    $('input[name="number_bg_color"]').click(function(){
        var counter_img_bg = $('input[name="counter_img_bg"]').val();
        var counter_img_bg_new = counter_img_bg.substring(1, counter_img_bg.length);
        var n = $('input[name="number_bg_color"]:checked').length;
        var img_src = $('#cnt img').attr('src');
        if(n == 1) {
            var new_img_src = img_src.replace('0'+counter_img_bg_new,'1'+counter_img_bg_new);
            $('input[name="color13"]').val('#'+counter_img_bg_new.toUpperCase());
            $('input[name="counter_img_bg"]').val('1'+counter_img_bg_new);
            $('#cnt img').attr('src',new_img_src);
            $('.colorBoxArea13').show();
        }
        else {
            var new_img_src = img_src.replace('1'+counter_img_bg_new,'0'+counter_img_bg_new);
            $('input[name="counter_img_bg"]').val('0'+counter_img_bg_new);
            $('#cnt img').attr('src',new_img_src);
            $('.colorBoxArea13').hide();
        }
    });
    $('.color-picker13').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            var number_bg = hex.replace('#','');
            var counter_bg_color_old = $('input[name="counter_img_bg"]').val();
            $('input[name="counter_img_bg"]').val('1'+number_bg);
            var counter_bg_color_new = $('input[name="counter_img_bg"]').val();
            var img_src = $('#cnt img').attr('src');
            var new_img_src = img_src.replace(counter_bg_color_old,counter_bg_color_new);
            $('#cnt img').attr('src',new_img_src);
        }
    });
    $('#number_alignment').change(function(){
        var counter_title = $('input[name="unique_element_counter_title"]').val();
        var counter_img_alignment = $('input[name="counter_img_alignment"]').val();
        var img_src = $('#cnt img').attr('src');
        var number_alignment = $('#number_alignment option:selected').val();
        var new_img_src = img_src.replace(counter_img_alignment,number_alignment);
        $('input[name="counter_img_alignment"]').val(number_alignment);
        $('#cnt img').attr('src',new_img_src);
        if(number_alignment == 'top') {
            $('#cnt').html('<img style="vertical-align: middle; " src="'+new_img_src+'"><br>'+counter_title);
            $('#counter_li').css('height','auto');
            $('#cnt').css('height','auto');
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        if(number_alignment == 'right') {
            $('#cnt').html(counter_title+'<img style="vertical-align: middle; " src="'+new_img_src+'">');
            $('#counter_li').css('height','45px');
            $('#cnt').css('height','60px');
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        if(number_alignment == 'bottom') {
            $('#cnt').html(counter_title+'<br /><img style="vertical-align: middle; " src="'+new_img_src+'">');
            $('#counter_li').css('height','auto');
            $('#cnt').css('height','auto');
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        if(number_alignment == 'left') {
            $('#cnt').html('<img style="vertical-align: middle; " src="'+new_img_src+'">'+counter_title);
            $('#counter_li').css('height','45px');
            $('#cnt').css('height','60px');
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
    });
    //Checks Level
    $('select[name="checksLevel"]').change(function(){
        var checksLevel = $('select[name="checksLevel"]').val();
        if(checksLevel == 0) {
            $('input[name="field_name_first"], input[name="field_email"]').removeClass('sr-required');
            $('input[name="field_email"]').removeClass('2');
            
        }
        if(checksLevel == 1) {
            $('input[name="field_name_first"], input[name="field_email"]').addClass('sr-required');
            $('input[name="field_email"]').removeClass('2');
        }
        if(checksLevel == 2) {
            $('input[name="field_name_first"], input[name="field_email"]').addClass('sr-required');
            $('input[name="field_email"]').addClass('2');
        }
    });
    //Meaning
    $('select[name="meaning"]').change(function(){
        var meaning = $('select[name="meaning"]').val();
        if(meaning == 'ru_latin') {
            $('input[name="field_name_first"]').removeClass('ru').removeClass('latin');
        }
        if(meaning == 'ru') {
            $('input[name="field_name_first"]').removeClass('latin');
            $('input[name="field_name_first"]').addClass('ru');
        }
        if(meaning == 'latin') {
            $('input[name="field_name_first"]').removeClass('ru');
            $('input[name="field_name_first"]').addClass('latin');
        }
    });
    //Form settings
    $('input[name="form_width"]').keyup(function(){
        if($.trim($('input[name="form_width"]').val() != '')) {
            var wf = parseInt($.trim($('input[name="form_width"]').val()));
            if(wf >= 200 && wf <=500){
                $('.sr-box').css('width',wf);
                $('#bg_image').css('width',wf);
                var field_name_first = $('input[name="field_name_first"]').css('width');
                $('select[name="field_charset_code"], select[name="field_country_id"]').css('width',field_name_first);
                if(wf >= 200 && wf < 260) {
                    $('input[name="subscribe"]').css('width','150px');
                }
                else {
                    $('input[name="subscribe"]').css('width','208px');
                }
            }
        }
    });
    $('select[name="fBorder"]').change(function(){
        var fBorder = $('select[name="fBorder"] option:selected').val();
        $('.sr-box').css('border',fBorder+'px #'+$('input[name="css_form_border_color"]').val());
        if($('input[name="f_dashed"]').is(':checked')) {
            $('form[name="SR_form"]').css('border-style', 'dashed');
        } else {
            $('form[name="SR_form"]').css('border-style', 'solid');
        }
    });
    $('input[name="f_dashed"]').click(function(){
        var n = $('input[name="f_dashed"]:checked').length;
        if(n == 1) {
            $('form[name="SR_form"]').css('border-style', 'dashed');
        }
        else {
            $('form[name="SR_form"]').css('border-style', 'solid');
        }
    });
    $('.color-picker1').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('form[name="SR_form"]').css('border-color',hex);
            $('input[name="css_form_border_color"]').val(hex.substring(1, hex.length).toUpperCase());
        }
    });
    //Background color
    $('input[name="bg_color"]').click(function(){
        var n = $('input[name="bg_color"]:checked').length;
        if(n == 1) {
            var color = $('input[name="css_bg_color"]').val();
            $('.sr-box').css('background-color','#'+color);
            $('#bg_image').css('background-color','#'+color);
            $('input[name="color2"]').val('#'+color);
            $('.colorBoxArea2').show();
        }
        else {
            $('.colorBoxArea2').hide();
            $('.sr-box').css('background-color','#FFFFFF');
            $('#bg_image').css('background-color','#FFFFFF');
            $('input[name="color2"]').val('#FFFFFF');
        }
    });
    $('.color-picker2').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('.sr-box').css('background-color',hex);
            $('#bg_image').css('background-color',hex);
            $('input[name="css_bg_color"]').val(hex.substring(1, hex.length).toUpperCase());
        }
    });
    //Background image
    $('input[name="bg_picture"]').click(function(){
        var n = $('input[name="bg_picture"]:checked').length;
        if(n == 1) {
            if($('.sr-box div').is('#bg_image')) {
                $('#bg_image_target').css('display','inline');
                $('#resize_img').show();
            }
            else {
                $('#upload').show();
            }
            if($('#ready_img').css('display') == 'block') {
                $('#resize').show();
                $('#ready_img').css('display','block');
            }
        }
        else {
            if($('.sr-box div').is('#bg_image')) {
                $('#bg_image_target').css('display','none');
            }
            if($('#upload').css('display') == 'block') {
                $('#upload').css('display','none');
            }
            if($('#resize_img').css('display') == 'block') {
                $('#resize_img').css('display','none');
            }
            if($('#ready_img').css('display') == 'block') {
                $('#ready_img').css('display','none');
                $('#resize').hide();
            }
        }
    });
    var check_ext = '';
    var check_size = '';
    var file_path = '';
    $('#fileupload').change(function(){
        var ext = $('#fileupload').val().split('.').pop().toLowerCase();
        file_path = $('#fileupload').val();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            check_ext = '-';
        }
        else {
            check_ext = '+';
            if($("#fileupload")[0].files[0].size > 524288) {
                check_size = '-';
            }
            else {
                check_size = '+';
            }
        }
    });
    $('#fileupload').fileupload({
        dataType: 'json',
        beforeSend: function(e, data){
            $('#upload').hide();
            $('#percent').show();
            if(check_ext == '-') {
                $('#percent').hide();
                $('#upload').show();
                var file_name = file_path.replace(/^.*[\\\/]/, '');
                alert(file_name+' не является картинкой. Файлы только со следующими расширениями: jpg, jpeg, png, gif, могут быть загружены.');
                return false;
            }
            else {
                if(check_size == '-') {
                    $('#percent').hide();
                    $('#upload').show();
                    alert('Размер файла не должен превышать 0.5 MB!');
                    return false;
                }    
            }          
        },
        done: function (e, data) {
            $.each(data.result, function (index, file) {
                $('#upload').show();
                $('#percent').hide();
                var image_name = file.name;
                var image = splitted[0]+'wp-content/plugins/smartresponder-1.0/plugins/fileUploader/server/php/files/'+image_name;
                var modal_close = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/modal_close.gif';
                var bg_color = $('input[name="css_bg_color"]').val();
                var form_width = $('.sr-box').width();
                var form_height = $('.sr-box').height();
                $('input[name="css_form_background_image"]').val(image);
                bg_color = $('input[name="css_bg_color"]').val();
                $('.sr-box-list').before('<div class="resize_container" style="position: absolute; display: block; "><div id="resize" style="cursor: pointer; position: absolute; width: 400px; height: 300px; z-index: 30; border: 1px dashed rgb(153, 153, 153); display: none; " class="ui-draggable ui-resizable"><div style="float: right; margin: -7px; background: url('+modal_close+') no-repeat; width: 24px; height:24px;" id="remove_bg_image"></div></div></div><div id="bg_image" style="overflow: hidden; position: absolute; display: block; width: '+form_width+'px; height: '+form_height+'px; background-color: '+bg_color+'; z-index: 0; border-top-left-radius: 6px; border-top-right-radius: 6px; border-bottom-right-radius: 6px; border-bottom-left-radius: 6px; "><img style=" position: relative; z-index: -1;" id="bg_image_target" src="'+image+'"></div>');
                $('div[id*="remove_bg_image"]').unbind('click').on('click',function(){
                    $('.resize_container, #bg_image').remove();
                    $('input[name="bg_picture"]').removeAttr('checked');
                    $('#ready_img').css('display','none');
                });
                $('#upload').hide();
                $('#resize_img').show();
            });
        }
    });
    $('input[name="res_btn"]').click(function(){
        var image_width = $('#bg_image_target').width();
        var image_height = $('#bg_image_target').height();
        $('#resize').css('width',image_width)
                    .css('height',image_height);
        $('#resize').resizable({
            alsoResize: '#bg_image_target'
        });
        $('#resize').draggable({
            drag: function(event, ui) {
                $('#bg_image_target').css({'position':'absolute','top': ui.position['top'],'left': ui.position['left']});
            }
        });
        $('#resize').show();
        $('#resize_img').hide();
        $('#ready_img').show();
    });
    $('input[name="ready_btn"]').click(function(){
        $('#bg_image').resizable('destroy')
                      .draggable('destroy')
                      .css('border','0px')
                      .css('cursor','default');
        $('#resize').hide();
        $('#ready_img').hide();
        $('#resize_img').show();
        
    });
    //Button
    $('input[name="unique_subscribe_title"]').keyup(function(){
        var btn_value = $('input[name="unique_subscribe_title"]').val();
        $('input[name="subscribe"]').val(btn_value);
    });
    $('select[name="unique_subscribe_font"]').change(function(){
        var btn_font_family = $('select[name="unique_subscribe_font"]').val();
        $('input[name="subscribe"]').css('font-family',btn_font_family);
    });
    $('select[name="unique_subscribe_size"]').change(function(){
        var btn_font_size = $('select[name="unique_subscribe_size"]').val();
        $('input[name="subscribe"]').css('font-size',btn_font_size);
    });
    $('select[name="unique_subscribe_type"]').change(function(){
        var btn_font_weight = $('select[name="unique_subscribe_type"]').val();
        if(btn_font_weight == 'normal') {
            $('input[name="subscribe"]').css('font-weight','normal')
                                        .css('font-style','normal');
        }
        if(btn_font_weight == 'bold') {
            $('input[name="subscribe"]').css('font-weight','bold')
                                        .css('font-style','normal');
        }
        if(btn_font_weight == 'italic') {
            $('input[name="subscribe"]').css('font-weight','normal')
                                        .css('font-style','italic');
        }
    });
    $('.color-picker3').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('input[name="subscribe"]').css('color',hex);
        }
    });
    $('select[name="unique_subscribe_border_weight"]').change(function(){
        var btn_border_width = $('select[name="unique_subscribe_border_weight"]').val();
        $('input[name="subscribe"]').css('border-width',btn_border_width);
    });
    $('.color-picker4').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('input[name="subscribe"]').css('border-color',hex);
        }
    });
    $('input[name="unique_subscribe_bg_color"]').click(function(){
        var btn_color = $('input[name="btn_color"]').val();
        var n = $('input[name="unique_subscribe_bg_color"]:checked').length;
        if(n == 1) {
            $('input[name="subscribe"]').css('background-color',btn_color);
            $('#bgColorArea5').show();
        }
        else {
            $('#bgColorArea5').hide();
            $('input[name="subscribe"]').css('background-color','white');
        }
    });
    $('.color-picker5').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('input[name="subscribe"]').css('background',hex);
            $('input[name="btn_color"]').val(hex);
        }
    });
    //Form Header
    $('input[name="unique_element_header_title"]').keyup(function(){
        var header_title = $('input[name="unique_element_header_title"]').val();
        $('.header_title').text(header_title);
    });
    $('select[name="unique_element_header_font"]').change(function(){
        var header_font = $('select[name="unique_element_header_font"]').val();
        $('.header_title').css('font-family',header_font);
    });
    $('select[name="unique_element_header_size"]').change(function(){
        var header_size = $('select[name="unique_element_header_size"]').val();
        $('.header_title').css('font-size',header_size);
    });
    $('select[name="unique_element_header_type"]').change(function(){
        var header_type = $('select[name="unique_element_header_type"]').val();
        if(header_type == 'normal') {
            $('.header_title').css('font-weight','normal')
                              .css('font-style','normal');
        }
        if(header_type == 'bold') {
            $('.header_title').css('font-weight','bold')
                              .css('font-style','normal');
        }
        if(header_type == 'italic') {
            $('.header_title').css('font-weight','normal')
                              .css('font-style','italic');
        }
    });
    $('.color-picker11').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('.header_title').css('color',hex);
        }
    });
    //Fields
    $('.over:radio').click(function(){
        $('.remove_labels').show();
        $('.sr-box input[type=text]').css('margin-top','1px');
        $('.fields').css('height','80px');
        $('.subscribe').css('height','80px');
        $('input[name="subscribe"]').css('margin-top','15px');
        $('.sr-box-list input[type=text]').val('');
        var form_height = $('.sr-box').height();
        $('#bg_image').css('height',form_height);
        if($('#over_text_field').css('display') == 'none') {
            $('#over_text_field').css('display','block');
            $('#over_text-table').css('display','table');
            $('#over_text_field').before('<div class="separator-sr mtb" id="separator-for-overF"></div>');
            $('#span_field').text('4.');
            var field_settings_height = $('#field-settings').height();
            $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
        }
        if($('#field_birth').hasClass('not-added') && $('#field_sex').hasClass('not-added') && $('#field_charset_code').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
            $('#under_text_field, #under_text-table, #separator-for-underF').css('display','none');
            $('#over_text_field span').text('2.');
            $('#span_field').text('3.');
            var field_settings_height = $('#field-settings').height();
            $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
        }
    });
    $('.under:radio').click(function(){
        $('.remove_labels').hide();
        $('.sr-box input[type=text]').css('margin-top','10px');
        $('.fields').css('height','60px');
        $('.subscribe').css('height','80px');
        $('input[name="subscribe"]').css('margin-top','15px');
        $('input[name="field_name_first"]').val('Ваше имя');
        $('input[name="field_email"]').val('Ваш email-адрес');
        $('input[name="field_name_last"]').val('Фамилия:');
        $('input[name="field_name_mid"]').val('Отчество:');
        $('input[name="field_city"]').val('Ваш город:');
        $('input[name="field_address"]').val('Ваш адрес:');
        $('input[name="field_phones"]').val('Ваш телефон:');
        $('input[name="field_company"]').val('Название компании:');
        var form_height = $('.sr-box').height();
        $('#bg_image').css('height',form_height);
        if($('#field_birth').hasClass('not-added') && $('#field_sex').hasClass('not-added') && $('#field_charset_code').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
            $('#over_text_field, #over_text-table').css('display','none');
            $('#separator-for-overF').remove();
            $('#span_field').text('3.');
            $('#under_text_field').css('display','block');
            $('#under_text-table').css('display','table');
            $('#separator-for-underF').show();
            var field_settings_height = $('#field-settings').height();
            $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
        }
    });
    $('select[name="over_unique_field_initial_font"]').change(function(){
        var font = $('select[name="over_unique_field_initial_font"]').val();
        $('.remove_labels, .s_label').css('font-family',font);
        $('input[name="over_field_initial_font"]').val(font);
    });
    $('select[name="over_unique_field_initial_size"]').change(function(){
        var size = $('select[name="over_unique_field_initial_size"]').val();
        $('.remove_labels, .s_label').css('font-size',size);
        $('input[name="over_field_initial_size"]').val(size);
    });
    $('select[name="over_unique_field_initial_type"]').change(function(){
        var type = $('select[name="over_unique_field_initial_type"]').val();
        if(type == 'normal') {
            $('.remove_labels, .s_lebel').css('font-weight','normal')
                                         .css('font-style','normal');
        }
        if(type == 'bold') {
            $('.remove_labels, .s_label').css('font-weight','bold')
                                         .css('font-style','normal');
        }
        if(type == 'italic') {
            $('.remove_labels, .s_label').css('font-weight','normal')
                                         .css('font-style','italic');
        }
        $('input[name="over_field_initial_type"]').val(type);
    });
    $('.color-picker10').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('.remove_labels, .s_label').css('color',hex);
            $('input[name="over_field_initial_color"]').val(hex);
        }
    });
    $('select[name="under_unique_field_initial_font"]').change(function(){
        var font = $('select[name="under_unique_field_initial_font"]').val();
        $('.sr-box [type=text], .sr-box select, #sex_table p, #slyle_for_select, #slyle_for_p').css('font-family',font);
        $('input[name="under_field_initial_font"]').val(font);
    });
    $('select[name="under_unique_field_initial_size"]').change(function(){
        var size = $('select[name="under_unique_field_initial_size"]').val();
        $('.sr-box [type=text], .sr-box select, #sex_table p, #slyle_for_select, #style_for_p').css('font-size',size);
        $('input[name="under_field_initial_size"]').val(size);
    });
    $('select[name="under_unique_field_initial_type"]').change(function(){
        var type = $('select[name="under_unique_field_initial_type"]').val();
        if(type == 'normal') {
            $('.sr-box [type=text], .sr-box select, #sex_table p, #style_for_p, #slyle_for_select').css('font-weight','normal')
                                                                                                   .css('font-style','normal');
        }
        if(type == 'bold') {
            $('.sr-box [type=text], .sr-box select, #sex_table p, #style_for_p, #slyle_for_select').css('font-weight','bold')
                                                                                                   .css('font-style','normal');
        }
        if(type == 'italic') {
            $('.sr-box [type=text], .sr-box select, #sex_table p, #style_for_p, #slyle_for_select').css('font-weight','normal')
                                                                                                   .css('font-style','italic');
        }
        $('input[name="under_field_initial_type"]').val(type);
    });
    $('.color-picker6').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('.sr-box [type=text], .sr-box select, #sex_table p, #slyle_for_select, #style_for_p').css('color',hex);
            $('input[name="under_field_initial_color"]').val(hex);
        }
    });
    $('select[name="unique_field_border_weight"]').change(function(){
        var border_weight = $('select[name="unique_field_border_weight"]').val();
        $('.sr-box [type=text], .sr-box select, #slyle_for_select').css('border-width',border_weight);
    });
    $('.color-picker7').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('.sr-box [type=text], .sr-box select, #slyle_for_select').css('border-color',hex);
        }
    });
    $('input[name="unique_field_bg_color"]').click(function(){
        var n = $('input[name="unique_field_bg_color"]:checked').length;
        if(n == 1) {
            $('#bgColorArea8').show();
            var color = $('input[name="color8"]').val();
            $('.sr-box [type=text], .sr-box select, #slyle_for_select').css('background',color);
        }
        else {
            $('#bgColorArea8').hide();
            $('.sr-box [type=text], .sr-box select, #slyle_for_select').css('background','white');
        }
    });
    $('.color-picker8').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('.sr-box [type=text], .sr-box select, #slyle_for_select').css('background',hex);
        }
    });
    //Counter
    $('input[name="unique_element_counter_title"]').keyup(function(){
        var counter_title = $('input[name="unique_element_counter_title"]').val();
        var counter_img_alignment = $('input[name="counter_img_alignment"]').val();
        var counter_img = $('#cnt img').attr('src');
        if(counter_img_alignment == 'left') {
            $('#cnt').html('<img style="vertical-align: middle;" src="'+counter_img+'">'+counter_title);    
        }
        if(counter_img_alignment == 'right') {
            $('#cnt').html(counter_title+'<img style="vertical-align: middle;" src="'+counter_img+'">');
        }
        if(counter_img_alignment == 'top') {
            $('#cnt').html('<img src="'+counter_img+'"><br />'+counter_title);
        }
        if(counter_img_alignment == 'bottom') {
            $('#cnt').html(counter_title+'<br /><img src="'+counter_img+'">');
        }
    });
    $('select[name="unique_element_counter_font"]').change(function(){
        var counter_font = $('select[name="unique_element_counter_font"]').val();
        $('#cnt').css('font-family',counter_font);
        $('input[name="element_counter_font"]').val(counter_font);
    });
    $('select[name="unique_element_counter_size"]').change(function(){
        var counter_size = $('select[name="unique_element_counter_size"]').val();
        $('#cnt').css('font-size',counter_size);
        $('input[name="element_counter_size"]').val(counter_size);
    });
    $('select[name="unique_element_counter_type"]').change(function(){
        var counter_type = $('select[name="unique_element_counter_type"]').val();
        if(counter_type == 'normal') {
            $('#cnt').css('font-weight','normal')
                     .css('font-style','normal');
        }
        if(counter_type == 'bold') {
            $('#cnt').css('font-weight','bold')
                     .css('font-style','normal');
        }
        if(counter_type == 'italic') {
            $('#cnt').css('font-weight','normal')
                     .css('font-style','italic');
        }
        $('input[name="element_counter_type"]').val(counter_type);
    });
    $('.color-picker9').miniColors({
        letterCase: 'uppercase',
        change: function(hex, rgb) {
            $('#cnt').css('color',hex);
            $('input[name="element_counter_color"]').val(hex);
        }
    });
    //flds
    $('#field_name_last').click(function(){
        if($('.over:checked').length > 0) {
            var li_height = '75';
            var under = '';
        }
        else {
            var li_height = '60';
            var under = 'Фамилия:';
        }
        var li_style = 'style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: '+li_height+'px; text-align: center; background-position: initial initial; background-repeat: initial initial; "';
        if($('#field_name_last').hasClass('not-added')) {
            $('#field_name_last').removeClass('not-added');
            $('#field_name_last').addClass('added-not-required');
            $('.subscribe').before('<li class="fields" id="field_name_last_li" '+li_style+'><label class="remove_labels">Фамилия:</label><input type="text" name="field_name_last" id="field_name_last_c" value="'+under+'"></li>');
            $('.remove_labels').attr('style', $('.remove_labels').attr('style'));
            $('input[name="field_name_last"]').attr('style', $('input[name="field_email"]').attr('style'));
            if($('.over:checked').length > 0) {
                $('.remove_labels').show();
            }
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        else if($('#field_name_last').hasClass('added-not-required')) {
            $('#field_name_last').removeClass('added-not-required');
            $('#field_name_last').addClass('required');
            $('input[name="field_name_last"]').addClass('sr-required');
        }
        else if($('#field_name_last').hasClass('required')) {
            $('#field_name_last').removeClass('required');
            $('#field_name_last').addClass('not-added');
            $('#field_name_last_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
    });
    $('#field_name_mid').click(function(){
        if($('.over:checked').length > 0) {
            var li_height = '75';
            var under = '';
        }
        else {
            var li_height = '60';
            var under = 'Отчество:';
        }
        var li_style = 'style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: '+li_height+'px; text-align: center; background-position: initial initial; background-repeat: initial initial; "';
        if($('#field_name_mid').hasClass('not-added')) {
            $('#field_name_mid').removeClass('not-added');
            $('#field_name_mid').addClass('added-not-required');
            $('.subscribe').before('<li class="fields" id="field_name_mid_li" '+li_style+'><label class="remove_labels">Отчество:</label><input type="text" name="field_name_mid" id="field_name_mid_c" value="'+under+'"></li>');
            $('.remove_labels').attr('style', $('.remove_labels').attr('style'));
            $('input[name="field_name_mid"]').attr('style', $('input[name="field_email"]').attr('style'));
            if($('.over:checked').length > 0) {
                $('.remove_labels').show();
            }
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        else if($('#field_name_mid').hasClass('added-not-required')) {
            $('#field_name_mid').removeClass('added-not-required');
            $('#field_name_mid').addClass('required');
            $('input[name="field_name_mid"]').addClass('sr-required');
        }
        else if($('#field_name_mid').hasClass('required')) {
            $('#field_name_mid').removeClass('required');
            $('#field_name_mid').addClass('not-added');
            $('#field_name_mid_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
    });    
    $('#field_city').click(function(){
        if($('.over:checked').length > 0) {
            var li_height = '75';
            var under = '';
        }
        else {
            var li_height = '60';
            var under = 'Ваш город:';
        }
        var li_style = 'style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: '+li_height+'px; text-align: center; background-position: initial initial; background-repeat: initial initial; "';
        if($('#field_city').hasClass('not-added')) {
            $('#field_city').removeClass('not-added');
            $('#field_city').addClass('added-not-required');
            $('.subscribe').before('<li class="fields" id="field_city_li" '+li_style+'><label class="remove_labels">Ваш город:</label><input type="text" name="field_city" id="field_city_c" value="'+under+'"></li>');
            $('.remove_labels').attr('style', $('.remove_labels').attr('style'));
            $('input[name="field_city"]').attr('style', $('input[name="field_email"]').attr('style'));
            if($('.over:checked').length > 0) {
                $('.remove_labels').show();
            }
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        else if($('#field_city').hasClass('added-not-required')) {
            $('#field_city').removeClass('added-not-required');
            $('#field_city').addClass('required');
            $('input[name="field_city"]').addClass('sr-required');
        }
        else if($('#field_city').hasClass('required')){
            $('#field_city').removeClass('required');
            $('#field_city').addClass('not-added');
            $('#field_city_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
    });
    $('#field_address').click(function(){
        if($('.over:checked').length > 0) {
            var li_height = '75';
            var under = '';
        }
        else {
            var li_height = '60';
            var under = 'Ваш адрес:';
        }
        var li_style = 'style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: '+li_height+'px; text-align: center; background-position: initial initial; background-repeat: initial initial; "';
        if($('#field_address').hasClass('not-added')) {
            $('#field_address').removeClass('not-added');
            $('#field_address').addClass('added-not-required');
            $('.subscribe').before('<li class="fields" id="field_address_li" '+li_style+'><label class="remove_labels">Ваш адрес:</label><input type="text" name="field_address" id="field_address_c" value="'+under+'"></li>');
            $('.remove_labels').attr('style', $('.remove_labels').attr('style'));
            $('input[name="field_address"]').attr('style', $('input[name="field_email"]').attr('style'));
            if($('.over:checked').length > 0) {
                $('.remove_labels').show();
            }
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        else if($('#field_address').hasClass('added-not-required')) {
            $('#field_address').removeClass('added-not-required');
            $('#field_address').addClass('required');
            $('input[name="field_address"]').addClass('sr-required');
        }
        else if ($('#field_address').hasClass('required')){
            $('#field_address').removeClass('required');
            $('#field_address').addClass('not-added');
            $('#field_address_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
    });
    $('#field_phones').click(function(){
        if($('.over:checked').length > 0) {
            var li_height = '75';
            var under = '';
        }
        else {
            var li_height = '60';
            var under = 'Ваш телефон:';
        }
        var li_style = 'style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: '+li_height+'px; text-align: center; background-position: initial initial; background-repeat: initial initial; "';
        if($('#field_phones').hasClass('not-added')) {
            $('#field_phones').removeClass('not-added');
            $('#field_phones').addClass('added-not-required');
            $('.subscribe').before('<li class="fields" id="field_phones_li" '+li_style+'><label class="remove_labels">Ваш телефон:</label><input type="text" name="field_phones" id="field_phones_c" value="'+under+'"></li>');
            $('.remove_labels').attr('style', $('.remove_labels').attr('style'));
            $('input[name="field_phones"]').attr('style', $('input[name="field_email"]').attr('style'));
            if($('.over:checked').length > 0) {
                $('.remove_labels').show();
            }
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        else if($('#field_phones').hasClass('added-not-required')) {
            $('#field_phones').removeClass('added-not-required');
            $('#field_phones').addClass('required');
            $('input[name="field_phones"]').addClass('sr-required');
        }
        else if($('#field_phones').hasClass('required')) {
            $('#field_phones').removeClass('required');
            $('#field_phones').addClass('not-added');
            $('#field_phones_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
    });
    $('#field_company').click(function(){
        if($('.over:checked').length > 0) {
            var li_height = '75';
            var under = '';
        }
        else {
            var li_height = '60';
            var under = 'Название компании:';
        }
        var li_style = 'style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: '+li_height+'px; text-align: center; background-position: initial initial; background-repeat: initial initial; "';
        if($('#field_company').hasClass('not-added')) {
            $('#field_company').removeClass('not-added');
            $('#field_company').addClass('added-not-required');
            $('.subscribe').before('<li class="fields" id="field_company_li" '+li_style+'><label class="remove_labels">Название компании:</label><input type="text" name="field_company" id="field_company_c" value="'+under+'"></li>');
            $('.remove_labels').attr('style', $('.remove_labels').attr('style'));
            $('input[name="field_company"]').attr('style', $('input[name="field_email"]').attr('style'));
            if($('.over:checked').length > 0) {
                $('.remove_labels').show();
            }
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
        else if($('#field_company').hasClass('added-not-required')) {
            $('#field_company').removeClass('added-not-required');
            $('#field_company').addClass('required');
            $('input[name="field_company"]').addClass('sr-required');
        }
        else if($('#field_company').hasClass('required')) {
            $('#field_company').removeClass('required');
            $('#field_company').addClass('not-added');
            $('#field_company_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
        }
    });
    $('#field_birth').click(function(){
        var li_style = 'style="text-align: center; height: 80px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; "';
        if($('#field_birth').hasClass('not-added')) {
            $('#field_birth').removeClass('not-added');
            $('#field_birth').addClass('added-not-required');
            $('.subscribe').before('<li id="field_birth_li" '+li_style+'><label class="s_label">Дата рождения:</label><select name="field_birth" id="day" class="listbox"><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select><select name="field_birth" id="month" class="listbox"><option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option><option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select name="field_birth" id="year" class="listbox"><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option></select></li>');
            $('.s_label').attr('style', $('.remove_labels').attr('style')).show();
            $('select[name="field_birth"]').attr('style', $('#slyle_for_select').attr('style'));
            var form_height = $('.sr-box').height();
            $('input[name="subscribe"]').css('margin-top','15px');
            $('#bg_image').css('height',form_height);
            if($('#over_text_field').css('display') == 'none') {
                $('#over_text_field').css('display','block');
                $('#over_text-table').css('display','table');
                $('#over_text_field').before('<div class="separator-sr mtb" id="separator-for-overF"></div>');
                $('#span_field').text('4.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
            if($('#under_text_field').css('display') == 'none') {
                $('#under_text_field').css('display','block');
                $('#under_text-table').css('display','table');
                $('#over_text_field span').text('3.');
                $('#span_field').text('4.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
        }
        else if($('#field_birth').hasClass('added-not-required')) {
            $('#field_birth').removeClass('added-not-required');
            $('#field_birth').addClass('required');
        }
        else if($('#field_birth').hasClass('required')){
            $('#field_birth').removeClass('required');
            $('#field_birth').addClass('not-added');
            $('#field_birth_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
            $('.subscribe').css('height','80px');
            if($('.over:checked').length == 0 && $('#field_sex').hasClass('not-added') && $('#field_charset_code').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
                $('#over_text_field, #over_text-table').css('display','none');
                $('#separator-for-overF').remove();
                $('#span_field').text('3.');
                $('#over_text_field span').text('3.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
            if($('.over:checked').length == 1 && $('#field_sex').hasClass('not-added') && $('#field_charset_code').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
                $('#under_text_field, #under_text-table').css('display','none');
                $('#over_text_field span').text('2.');
                $('#span_field').text('3.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
        }
    });
    $('#field_charset_code').click(function(){
        var li_style = 'style="text-align: center; height: 80px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; "';
        if($('#field_charset_code').hasClass('not-added')) {
            $('#field_charset_code').removeClass('not-added');
            $('#field_charset_code').addClass('added-not-required');
            var field_name_first = $('input[name="field_name_first"]').css('width');
            $('.subscribe').before('<li id="field_charset_code_li" '+li_style+'><label class="s_label">Кодировка писем:</label><select name="field_charset_code" class="listbox wide_relatively"><option value="windows-1251">Windows-1251</option><option value="utf-8" selected="selected">Unicode (UTF-8)</option><option value="koi8-r">Кириллица (KOI8-R)</option></select></li>');
            $('.s_label').attr('style', $('.remove_labels').attr('style')).show();
            $('select[name="field_charset_code"]').attr('style', $('#slyle_for_select').attr('style'));
            $('select[name="field_charset_code"]').css('width',field_name_first);
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
            if($('#over_text_field').css('display') == 'none') {
                $('#over_text_field').css('display','block');
                $('#over_text-table').css('display','table');
                $('#over_text_field').before('<div class="separator-sr mtb" id="separator-for-overF"></div>');
                $('#span_field').text('4.');    
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
            if($('#under_text_field').css('display') == 'none') {
                $('#under_text_field').css('display','block');
                $('#under_text-table').css('display','table');
                $('#over_text_field span').text('3.');
                $('#span_field').text('4.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
        }
        else if($('#field_charset_code').hasClass('added-not-required')) {
            $('#field_charset_code').removeClass('added-not-required');
            $('#field_charset_code').addClass('required');
        }
        else if($('#field_charset_code').hasClass('required')){
            $('#field_charset_code').removeClass('required');
            $('#field_charset_code').addClass('not-added');
            $('#field_charset_code_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
            if($('.over:checked').length == 0 && $('#field_birth').hasClass('not-added') && $('#field_sex').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
                $('#over_text_field, #over_text-table').css('display','none');
                $('#separator-for-overF').remove();
                $('#span_field').text('3.');    
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
            if($('.over:checked').length == 1 && $('#field_sex').hasClass('not-added') && $('#field_charset_code').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
                $('#under_text_field, #under_text-table').css('display','none');
                $('#over_text_field span').text('2.');
                $('#span_field').text('3.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
        }
    });
    $('#field_country_id').click(function(){
        var li_style = 'style="text-align: center; height: 80px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; "';
        if($('#field_country_id').hasClass('not-added')) {
            $('#field_country_id').removeClass('not-added');
            $('#field_country_id').addClass('added-not-required');
            var field_name_first = $('input[name="field_name_first"]').css('width');
            $('.subscribe').before('<li id="field_country_id_li" '+li_style+'><label class="s_label">Ваша страна:</label><select name="field_country_id" class="listbox wide_relatively"><option value="12">Австралия</option><option value="13">Австрия</option><option value="2">Азербайджан</option><option value="14">Азербайджан</option><option value="1">Албания</option><option value="3">Американское Самоа</option><option value="5">Ангола</option><option value="6">Ангуилла</option><option value="4">Андора</option><option value="7">Антарктика</option><option value="8">Антигуа и Барбуда</option><option value="9">Аргентина</option><option value="10">Армения</option><option value="11">Аруба</option><option value="15">Багамы</option><option value="17">Бангладеш</option><option value="18">Барбадос</option><option value="16">Бахрейн</option><option value="19">Беларусь</option><option value="21">Белиз</option><option value="20">Бельгия</option><option value="22">Бенин</option><option value="23">Бермуды</option><option value="199">Болгария</option><option value="25">Босния и Герцеговина</option><option value="26">Боцвана</option><option value="27">Бразилия</option><option value="28">Бруней Дарусалам</option><option value="29">Буркина-Фасо</option><option value="30">Бурунди</option><option value="24">Бутан</option><option value="194">Вайлис и Футуна</option><option value="191">Вануату</option><option value="81">Ватикан</option><option value="187">Великобритания</option><option value="84">Венгрия</option><option value="192">Венесуелла</option><option value="193">Вьетнам</option><option value="65">Габон</option><option value="80">Гаити</option><option value="66">Гамбия</option><option value="69">Гана</option><option value="74">Гваделупа</option><option value="76">Гватемала</option><option value="77">Гвинея</option><option value="78">Гвиния-Бизау</option><option value="68">Германия</option><option value="70">Гибралтар</option><option value="82">Гондурас</option><option value="83">Гонконг</option><option value="73">Гренада</option><option value="71">Греция</option><option value="72">Гринландия</option><option value="67">Грузия</option><option value="75">Гуам</option><option value="79">Гуяна</option><option value="49">Дания</option><option value="50">Джиботи</option><option value="51">Доминика</option><option value="52">Доминиканская республика</option><option value="54">Египет</option><option value="197">Замбия</option><option value="195">Западная Сахара</option><option value="198">Зимбабве</option><option value="90">Израиль</option><option value="87">Индия</option><option value="88">Иран</option><option value="89">Ирландия</option><option value="86">Исландия</option><option value="167">Испания</option><option value="91">Италия</option><option value="85">Йемен</option><option value="94">Казахстан</option><option value="35">Каймановы острова</option><option value="31">Камбоджи</option><option value="32">Камерун</option><option value="33">Канада</option><option value="150">Катар</option><option value="34">Кейп Вирд</option><option value="95">Кения</option><option value="40">Кипр</option><option value="96">Кирибати</option><option value="39">Китай</option><option value="41">Колумбия</option><option value="42">Коморос</option><option value="43">Конго</option><option value="44">Коста Рика</option><option value="45">Коте Дльвойре</option><option value="46">Кроатия</option><option value="47">Куба</option><option value="99">Кувейт</option><option value="100">Кыргызстан</option><option value="101">Латвия</option><option value="102">Либанон</option><option value="104">Либерия</option><option value="103">Лисото</option><option value="106">Литва</option><option value="105">Лихтенштейн</option><option value="107">Луксембург</option><option value="117">Мавритания</option><option value="118">Мавритиус</option><option value="110">Мадагасхар</option><option value="119">Майотти</option><option value="108">Макао</option><option value="109">Македония</option><option value="111">Малави</option><option value="112">Малазия</option><option value="114">Мали</option><option value="113">Мальдивы</option><option value="115">Мальта</option><option value="116">Мартиника</option><option value="120">Мексика</option><option value="128">Мианмар</option><option value="121">Микронезия</option><option value="127">Мозамбик</option><option value="122">Молдова</option><option value="123">Монако</option><option value="124">Монголия</option><option value="125">Монтсерат</option><option value="126">Морокко</option><option value="129">Намибия</option><option value="130">Науру</option><option value="136">Нигер</option><option value="132">Нидерланды</option><option value="135">Никарагуа</option><option value="131">Нипал</option><option value="137">Ниуи</option><option value="134">Новая Зеландия</option><option value="133">Новая Каледония</option><option value="138">Норвегия</option><option value="200">Объед. Арабские Эмираты</option><option value="139">Палау</option><option value="140">Палестина</option><option value="141">Панама</option><option value="142">Папуа</option><option value="143">Парагвай</option><option value="144">Перу</option><option value="146">Питкайрн</option><option value="147">Польша</option><option value="148">Португалия</option><option value="149">Пуерто Рико</option><option value="151">Реуньен</option><option value="152">Романия</option><option value="153">Российская Федерация</option><option value="188">США</option><option value="155">Самоа</option><option value="156">Сан Марино</option><option value="154">Санта Лучия</option><option value="169">Свальбард и Жан Майен</option><option value="98">Северная Корея (КНДР)</option><option value="158">Сейшилы</option><option value="157">Сенегал</option><option value="196">Сербия и Черногория</option><option value="160">Сингапур</option><option value="161">Сирия</option><option value="162">Словакия</option><option value="163">Словения</option><option value="164">Соломоновы острова</option><option value="165">Сомали</option><option value="159">Сьерра Леоне</option><option value="173">Таджикистан</option><option value="172">Тайвань</option><option value="175">Тайланд</option><option value="174">Танзания</option><option value="176">Тимор-Лесте</option><option value="177">Того</option><option value="178">Токелау</option><option value="179">Тонга</option><option value="180">Тринидад и Тобаго</option><option value="184">Тувалу</option><option value="181">Тунис</option><option value="183">Туркменистан</option><option value="182">Турция</option><option value="185">Уганда</option><option value="190">Узбекистан</option><option value="186">Украина</option><option value="189">Уругвай</option><option value="60">Фиджи</option><option value="145">Филипины</option><option value="61">Финляндия</option><option value="62">Франция</option><option value="63">Французская Гуана</option><option value="64">Французская Полинезия</option><option value="36">Центр. Африканская респ-ка</option><option value="37">Чад</option><option value="48">Чешская республика</option><option value="38">Чили</option><option value="171">Швейцария</option><option value="170">Швеция</option><option value="168">Шри Ланка</option><option value="53">Эквадор</option><option value="56">Экваториальная Гвинея</option><option value="55">Эль Сальвадор</option><option value="57">Эритрия</option><option value="58">Эстония</option><option value="59">Эфиопия</option><option value="166">ЮАР</option><option value="97">Южная Корея</option><option value="92">Ямайка</option><option value="93">Япония</option></select></li>');
            $('.s_label').attr('style', $('.remove_labels').attr('style')).show();
            $('select[name="field_country_id"]').attr('style', $('#slyle_for_select').attr('style'));
            $('select[name="field_country_id"]').css('width',field_name_first);
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
            if($('#over_text_field').css('display') == 'none') {
                $('#over_text_field').css('display','block');
                $('#over_text-table').css('display','table');
                $('#over_text_field').before('<div class="separator-sr mtb" id="separator-for-overF"></div>');
                $('#span_field').text('4.');    
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
            if($('#under_text_field').css('display') == 'none') {
                $('#under_text_field').css('display','block');
                $('#under_text-table').css('display','table');
                $('#over_text_field span').text('3.');
                $('#span_field').text('4.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
        }
        else if($('#field_country_id').hasClass('added-not-required')) {
            $('#field_country_id').removeClass('added-not-required');
            $('#field_country_id').addClass('required');
        }
        else if($('#field_country_id').hasClass('required')){
            $('#field_country_id').removeClass('required');
            $('#field_country_id').addClass('not-added');
            $('#field_country_id_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
            if($('.over:checked').length == 0 && $('#field_birth').hasClass('not-added') && $('#field_sex').hasClass('not-added') && $('#field_charset_code').hasClass('not-added')) {
                $('#over_text_field, #over_text-table').css('display','none');
                $('#separator-for-overF').remove();
                $('#span_field').text('3.');    
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
            if($('.over:checked').length == 1 && $('#field_sex').hasClass('not-added') && $('#field_charset_code').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
                $('#under_text_field, #under_text-table').css('display','none');
                $('#over_text_field span').text('2.');
                $('#span_field').text('3.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
        }
    });
    $('#field_sex').click(function(){
        var li_style = 'style="text-align: center; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; "';
        if($('#field_sex').hasClass('not-added')) {
            $('#field_sex').removeClass('not-added');
            $('#field_sex').addClass('added-not-required');
            $('.subscribe').before('<li id="field_sex_li" '+li_style+'><label class="s_label">Ваша пол:</label><table id="sex_table" border="0" cellspacing="0" cellpadding="0" style="display:inline-table;"><tbody><tr><td><input type="radio" value="m" name="field_sex" checked="checked"></td><td><p>&nbsp;&nbsp;Мужчина</p></td><td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="w" name="field_sex"></td><td><p>&nbsp;&nbsp;Женщина</p></td></tr></tbody></table></li>');
            $('.s_label').attr('style', $('.remove_labels').attr('style')).show();
            $('#sex_table p').attr('style', $('#style_for_p').attr('style'));
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
            if($('#over_text_field').css('display') == 'none') {
                $('#over_text_field').css('display','block');
                $('#over_text-table').css('display','table');
                $('#over_text_field').before('<div class="separator-sr mtb" id="separator-for-overF"></div>');
                $('#span_field').text('4.');    
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
            if($('#under_text_field').css('display') == 'none') {
                $('#under_text_field').css('display','block');
                $('#under_text-table').css('display','table');
                $('#over_text_field span').text('3.');
                $('#span_field').text('4.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
        }
        else if($('#field_sex').hasClass('added-not-required')) {
            $('#field_sex').removeClass('added-not-required');
            $('#field_sex').addClass('required');
        }
        else if($('#field_sex').hasClass('required')) {
            $('#field_sex').removeClass('required');
            $('#field_sex').addClass('not-added');
            $('#field_sex_li').remove();
            var form_height = $('.sr-box').height();
            $('#bg_image').css('height',form_height);
            if($('.over:checked').length == 0 && $('#field_birth').hasClass('not-added') && $('#field_charset_code').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
                $('#over_text_field').css('display','none');
                $('#over_text-table').css('display','none');
                $('#separator-for-overF').remove();
                $('#span_field').text('3.');    
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
            if($('.over:checked').length == 1 && $('#field_sex').hasClass('not-added') && $('#field_charset_code').hasClass('not-added') && $('#field_country_id').hasClass('not-added')) {
                $('#under_text_field, #under_text-table').css('display','none');
                $('#over_text_field span').text('2.');
                $('#span_field').text('3.');
                var field_settings_height = $('#field-settings').height();
                $('#button-settings-header').css('margin-top',field_settings_height+10+'px');
            }
        }
    });
    //Get HTML Btn
    $('input[name="get"]').click(function(){
        var deliveries = $('select[name="deliveries[]"]').val();
        if(deliveries == null) {
            alert('Пожалуйста выберите хотя бы одну рассылку, на которую будет подписывать форма');
            $('.input-button').scroll(0,300); 
            $('html, body').animate({scrollTop:0}, 'slow');
            $('select[name="deliveries[]"]').css('border-color','red');
            setTimeout(function(){ 
                $('select[name="deliveries[]"]').css('border-color','#959595'); 
            }, 1900);
        }
        else {
            jQuery.fn.center = function () {
                this.css('position','absolute');
                this.css('top', (($(window).height() - this.outerHeight()) / 3) + $(window).scrollTop() + 'px');
                this.css('left', (($(window).width() - this.outerWidth()) / 4) + $(window).scrollLeft() + 'px');
                return this;
            }
            var modal_bg = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/modal_bg.gif';
            var modal_close = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/modal_close.gif';
            $('#modalWindowDefault_area').css('display','block').center();
            var start_form_code = '<!-- SmartResponder.ru subscribe form code (begin) --><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"><html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/></meta><body>';
            var end_form_code = '</body></html><!-- SmartResponder.ru subscribe form code (end) --!>';
            $('.subscribe span').remove();
            var outer_alignment = $('select[name="outer_alignment"]').val();
            if(outer_alignment == 'left') {
                $('form.sr-box').css('margin-left','0px').css('margin-top','0px');
            }
            if(outer_alignment == 'right') {
                $('form.sr-box').css('margin-right','0px').css('margin-top','0px');
            }
            if(outer_alignment == 'center') {
                $('form.sr-box').css('margin','0 auto').css('margin-top','0px');
            }
            var form_code = $('.scene-editor').html();
            $('form.sr-box').css('margin','85px auto 0px');
            var for_form_link = splitted[0]+'wp-content/plugins/smartresponder-1.0/for_form.html';
            $('input[name="subscribe"]').before('<span class="box-item-edit-left" id="left3" style="display: none; "></span><span class="left-top-edit-corner" id="left-top-corner3" style="display: none; "></span><span class="box-item-edit-top" id="top3" style="display: none; "></span><span class="left-bottom-edit-corner" id="left-bottom-corner3" style="display: none; "></span><span class="box-item-edit-bottom" id="bottom3" style="bottom: -3px; display: none; "></span><span class="right-top-edit-corner" id="right-top-corner3" style="display: none; "></span><span class="box-item-edit-right" id="right3" style="display: none; "></span><span class="right-bottom-edit-corner" id="right-bottom-corner3" style="display: none; "></span>');
            $.get(for_form_link, function(data) {
                $('.form_code').val(start_form_code+data+form_code+end_form_code);
                var zeroClipboardSWF = splitted[0]+'wp-content/plugins/smartresponder-1.0/plugins/zeroClipboard/ZeroClipboard.swf';
                $("#copy_to_clipboard").zclip({
                    path: zeroClipboardSWF,
                    copy: $('.form_code').val(),
                    afterCopy: function(){
                        $('#modalWindowDefault_area p').append('Код был скопирован в буфер обмена!').css('margin-top','10px').css('margin-right','15px').css('color','green');
                        $('#copy_to_clipboard').remove();
                        $('#zclip-ZeroClipboardMovie_1').remove();
                    }
                });
            });
            $('body').after('<img id="modalWindow_pixel" style="z-index: 98; width: 100%; height: 100%; position: fixed; left: 0px; top: 0px; display: block; opacity: 0.5; " src="'+modal_bg+'">')
            var modalWindow_top = $("#modalWindowDefault_area").offset().top-10;
            var modalWindow_left = $("#modalWindowDefault_area").offset().left+615;
            $('#modalWindow_pixel').after('<img id="modalWindowDefault_close_image" src="'+modal_close+'" height="24" border="0" style="cursor: pointer; z-index: 100; display: block; position: absolute; left: '+modalWindow_left+'px; top: '+modalWindow_top+'px; ">');
            $('#modalWindowDefault_area p').text('');
            $('#modalWindowDefault_area p').append('<input type="button" id="copy_to_clipboard" name="copy_to_clipboard" value="Скопировать в буфер обмена" />').css('margin-top','2px').css('margin-right','15px');
            $('#modalWindowDefault_close_image').click(function(){
                $('#modalWindow_pixel, #modalWindowDefault_close_image').hide();
                $('#modalWindowDefault_area').css('display','none');
            });
        }
    });
    //Widget
    $('input[name="widget"]').click(function(){
        var deliveries = $('select[name="deliveries[]"]').val();
        if(deliveries == null) {
            alert('Пожалуйста выберите хотя бы одну рассылку, на которую будет подписывать форма');
            $('.input-button').scroll(0,300); 
            $('html, body').animate({scrollTop:0}, 'slow');
            $('select[name="deliveries[]"]').css('border-color','red');
            setTimeout(function(){ 
                $('select[name="deliveries[]"]').css('border-color','#959595'); 
            }, 1900);
        }
        else {
            $('form[name="SR_form"]').css('margin-top','0px').css('margin-bottom','2.2em');
            var outer_alignment = $('select[name="outer_alignment"]').val();
            if(outer_alignment == 'left') {
                $('form.sr-box').css('margin-left','0px');
            }
            if(outer_alignment == 'right') {
                $('form.sr-box').css('margin-right','0px');
            }
            if(outer_alignment == 'center') {
                $('form.sr-box').css('margin','0 auto');
            }
            var form_code = $('.scene-editor').html();
            $('form.sr-box').css('margin','85px auto 0px');
            $('form[name="SR_form"]').css('margin-top','85px').css('margin-bottom','0px');
            var data = {
                action: 'widget',
                html: form_code
            }
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                dataType: 'JSON',
                data: data,
                success: function(json){
                    if(json == 'ok') {
                        alert('Виджет был создан.');
                    }
                    else {
                        alert('Виджет небыл создан.');
                    }
                },
                error: function() {
                    alert('Виджет небыл создан.');
                }
            });
        }
    });
    //Get deliveries for form generator
    $('#tabs li').first().click(function(){
        var ua = navigator.userAgent;
        if(/chrome/i.test(ua)) {
            $('.flds input').css('padding','3px')
        }
        //Loading background
        var modal_bg = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/modal_bg.gif';
        var icoLoading = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/loading.gif';
        var sub_form = $('#sub-form option').val();
        if($('#tabs').hasClass('tabs') && sub_form == undefined) {
            $('body').after('<img id="form_generator_load" style="z-index: 99; position: absolute; top: 300px; left: 670px; " src="'+icoLoading+'">');
            var api_key = $('input[name="api_key"]').val();
            var data = {
                action: 'get_deliveries',
                api_key: api_key
            }
            $('.leftCol, .rightCol').css('display','none');
            $.getJSON(ajaxurl, data, function(data){
                $('#modalWindow_pixel, #form_generator_load').hide();
                $('.leftCol, .rightCol').css('display','block');
                $.each(data, function(i1, item1){
                    $.each(item1, function(i2, item2){
                        $.each(item2, function(i3, item3){
                            var id = item3.id;
                            var title = item3.title;
                            var code = item3.code;
                            var counter_key = item3.counter_key;
                            var mySelect = $('#sub-form');
                            mySelect.append(
                                $('<option></option>').val(id).html(title+' [код: '+code+']')
                            );
                            $('.counter_key').append('<input type="hidden" id="'+id+'" value="'+counter_key+'" />');
                        });
                    });
                });
            });
        } 
    });
    //Get tracks for form generator
    $('#tabs li').first().click(function(){
        var trackId = $('select[name="trackId"] option').val();
        if(trackId == undefined) {
            var api_key = $('input[name="api_key"]').val();
            $('select[name="trackId"]').append('<option value="0">выбрать →</option>');
            var data = {
                action: 'get_tracks',
                api_key: api_key
            }
            $.getJSON(ajaxurl, data, function(data){
                $.each(data, function(i1, item1){
                    $.each(item1, function(i2, item2){
                        $.each(item2, function(i3, item3){
                            var id = item3.id;
                            var title = item3.title;
                            var code = item3.code;
                            var mySelect = $('select[name="trackId"]');
                            mySelect.append(
                                $('<option></option>').val(id).html(title+' (код: '+code+')')
                            );
                        });
                    });
                });
            });
        } 
    });
    //Get deliveries for subscribers
    $('input[name="get_deliveries"]').click(function(){
        if(!$('.get_deliveries_select').is(':visible')) {
            $('input[name="get_groups"]').attr('checked', false);
            $('.get_deliveries_select').show('blind', { direction: 'vertical' }, 200);
            if($('.get_groups_select').is(':visible')) {
                $('.get_groups_select').hide('blind', { direction: 'vertical' }, 200); 
            }
        }
    });
    $('input[name="get_groups"]').click(function(){
        if(!$('.get_groups_select').is(':visible')) {
            $('input[name="get_deliveries"]').attr('checked', false);
            $('.get_groups_select').show('blind', { direction: 'vertical' }, 200);
            if($('.get_deliveries_select').is(':visible')) {
                $('.get_deliveries_select').hide('blind', { direction: 'vertical' }, 200); 
            }
        }
    });
    //Get deliveries for subscribers
    $('#subscribers_li').click(function(){
        var deliveries_check = $('#rDestinationId_d option').length;
        if(deliveries_check == 1) {
            var api_key = $('input[name="api_key"]').val();
            var data = {
                action: 'get_deliveries',
                api_key: api_key
            }
            $.getJSON(ajaxurl, data, function(data){
                $.each(data, function(i1, item1){
                    $.each(item1, function(i2, item2){
                        $.each(item2, function(i3, item3){
                            var id = item3.id;
                            var title = item3.title;
                            var mySelect = $('#rDestinationId_d');
                            mySelect.append(
                                $('<option style="color:black; background-color:white; "></option>').val('d:'+id).html(title)
                            );
                        });
                    });
                });
            });
        }
    });
    //Get groups for subscribers
    $('#subscribers_li').click(function(){
        var groups_check = $('#rDestinationId_g option').length;
        if(groups_check == 1) {
            var api_key = $('input[name="api_key"]').val();
            var data = {
                action: 'get_groups',
                api_key: api_key
            }
            $.getJSON(ajaxurl, data, function(data){
                $.each(data, function(i1, item1){
                    $.each(item1, function(i2, item2){
                        $.each(item2, function(i3, item3){
                            var id = item3.id;
                            var title = item3.title;
                            var mySelect = $('#rDestinationId_g');
                            mySelect.append(
                                $('<option style="color:black; background-color:white; "></option>').val('g:'+id).html(title)
                            );
                        });
                    });
                });
            });
        }
    });
    //Users check
    $('input[name="check_all_users"]').click(function(){
        var n = $('input[name="check_all_users"]:checked').length;
        if(n == 1) {
            $('.checkbox_users').attr('checked','checked');
        }
        else {
            $('.checkbox_users').removeAttr('checked');
        }
    });
    //Select track
    $('select[name="trackId"]').change(function(){
        var trackId = $('select[name="trackId"]').val();
        $('input[name="tid"]').remove();
        if(trackId != '0') {
            $('.sr-box-list').after('<input type="hidden" name="tid" value="'+trackId+'" />');
        }
        else {
            $('input[name="tid"]').remove();
        }
    });
    //Get Users
    $('#subscribers_li').click(function(){
        if(!$('.mega-table:first tbody tr').hasClass('wp_users')) {
            $('#tablePagination').hide();
            var loading_img_link = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/loading.gif';
            $('.mega-table tbody').append('<tr class="loading_users_result"><td colspan="5"><img src="'+loading_img_link+'" /></td></tr>');
            var send_users_ch = '';
            if($('input[name="send_users_ch"]:checked').length == 1) {
                send_users_ch = '1';
            }
            else {
                send_users_ch = '0';
            }
            var getUsersData = {
                action: 'get_users',
                send_users_ch: send_users_ch
            }
            $.ajax({
                url : ajaxurl,
                data : getUsersData,
                dataType : 'json',
                success : function(data) {
                    if(data.length == 0) {
                        $('.loading_users_result').remove();
                        $('#users_count').text('0');
                        $('.mega-table tbody').append('<tr class="wp_users no_result"><td colspan="5">Нет данных</td></tr>');
                        var records_on_page = parseInt($('select[name="records_on_page"]').val());
                        var users_count = parseInt($('#users_count').text());
                        $('.mega-table').paginateTable({ rowsPerPage: records_on_page });
                        if(records_on_page < users_count) {
                            $('.pager').show();
                        }
                        else {
                            $('.pager').hide();
                        }
                    }
                    else {
                        $.each(data, function(number, item){
                            $('#tablePagination').show();
                            $('.loading_users_result').remove();
                            $('.mega-table tbody').append('<tr class="wp_users"><td id="user_id">'+item.id+'</td><td id="wp_nickname_'+item.id+'">'+item.user_nicename+'</td><td id="wp_email_'+item.id+'">'+item.user_email+'</td><td>'+item.user_registered+'</td><td><input type="checkbox" class="checkbox_users" name="wp_users_'+item.id+'" value="" /></td></tr>');
                            $('.wp_users').show();
                        });
                        $('.mega-table:first tr').each(function(i, it){
                            if(i % 2 == 0) {
                                $(this).addClass('even');
                            }
                        });
                        if($('.mega-table tr').hasClass('wp_users')) {
                            var users_count = $('.mega-table tbody tr.wp_users').length;
                            $('#users_count').text(users_count);    
                        }
                        else {
                            $('#users_count').text('0');
                        }    
                    }
                }
            });
            var records_on_page = parseInt($('select[name="records_on_page"]').val());
            var users_count = parseInt($('#users_count').text());
            $('.mega-table').paginateTable({ rowsPerPage: records_on_page });
            if(records_on_page < users_count) {
                $('.pager').show();
            }
            else {
                $('.pager').hide();
            }
        }
    });
    //Send request 
    $('input[name="send_request_btn"]').click(function(){
        var api_key = $('input[name="api_key"]').val();
        $('.bad_import, .close_import1').hide();
        if(!$('.wp_users').hasClass('no_result')) {
            //Get users data
            var ind1 = 0;
            var ind2 = 0;
            var ind3 = 0;
            var checkbox_arr = [];
            var nickname_arr = [];
            var email_arr = [];
            //Get all checked checkbox
            $('.checkbox_users:checked').each(function(){
            checkbox_arr[ind1] = $(this).attr('name');
                ind1++;
            });
            var rDestinationId = 0;
            if($('input[name="get_deliveries"]:checked').length == 1) {
                rDestinationId = $('#rDestinationId_d').val();
            }
            if($('input[name="get_groups"]:checked').length == 1) {
                rDestinationId = $('#rDestinationId_g').val();
            }
            if(rDestinationId == 0) {
                alert('Выберите, куда Вы хотите добавить импортируемый список.');
                $('.import-request-options').css('color','red');
                setTimeout(function(){ 
                    $('.import-request-options').css('color','black'); 
                }, 1900);
            }
            else {
                //Modal window
                $('.import_progress').text('0%');
                var modal_bg = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/modal_bg.gif';
                $('#modalWindow_pixel2').attr('src',modal_bg);
                $('#modalWindow_pixel2').fadeTo("slow",0.8);
                $('.modal_import1').show();
                $('.import_step_1').show();
                $('#progressbar').show();
                if(ind1 == 0) {
                    //Get id
                    var user_id_arr = [];
                    var ind1 = 0;
                    $('.mega-table #user_id').each(function(){
                        user_id_arr[ind1] = $(this).text();
                        ind1++;
                    });
                    $.each(user_id_arr.toString().split(','), function(number, item){
                        //Get nickname 
                        $('#wp_nickname_'+item).each(function(){
                            nickname_arr[ind2] = $(this).text();
                            ind2++;
                        });
                        //Get email
                        $('#wp_email_'+item).each(function(){
                            email_arr[ind3] = $(this).text();
                            ind3++;
                        }); 
                    });
                    var selected_number_count = $('.checkbox_users').length;
                    $('input[name="selected_number_count"]').val(selected_number_count);
                    $('input[name="import_users_id"]').val(user_id_arr.toString());
                    var data = {
                        action: 'import',
                        import_users_id: user_id_arr.toString(),
                        api_key: api_key,
                        destination: rDestinationId,
                        nickname: nickname_arr.toString(),
                        email: email_arr.toString(),
                        selected_number_count: selected_number_count
                    }
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        dataType: 'JSON',
                        data: data,
                        success: function(json) {
                            if(json.result == '1') {
                                var import_key = json.element.import_key;
                                setTimeout(DisplayImportRequest(import_key), 3000);
                            }
                            else {
                                $('#progressbar').hide();
                                $('.bad_import, .close_import1').show();
                            }
                        },
                        error: function() {
                            $('#progressbar').hide();
                            $('.bad_import, .close_import1').show();
                        }  
                    });
                }
                else
                {
                    $.each(checkbox_arr.toString().split(','), function(number, item){
                        //Get checked_id
                        var checked_id = item.split('wp_users_');
                        //Get nickname
                        $('#wp_nickname_'+checked_id[1]).each(function(){
                            nickname_arr[ind2] = $(this).text();
                            ind2++;
                        });
                        //Get email
                        $('#wp_email_'+checked_id[1]).each(function(){
                            email_arr[ind3] = $(this).text();
                            ind3++;
                        });                        
                    });
                    var selected_number_count = $('#selected_number_count').text();
                    $('input[name="selected_number_count"]').val(selected_number_count);
                    $('input[name="import_users_id"]').val(checkbox_arr.toString());
                    var data = {
                        action: 'import',
                        api_key: api_key,
                        destination: rDestinationId,
                        nickname: nickname_arr.toString(),
                        email: email_arr.toString()
                    }
                    var import_key = '';
                    $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        dataType: 'JSON',
                        data: data,
                        success: function(json) {
                            if(json.result == '1') {
                                import_key = json.element.import_key
                                setTimeout(DisplayImportRequest(import_key), 3000);
                            }
                            else {
                                $('#progressbar').hide();
                                $('.bad_import, .close_import1').show();
                            }
                        },
                        error: function() {
                            $('#progressbar').hide();
                            $('.import_step_2, .close_import1').show();
                        } 
                    });
                }
            }
        }
        else {
            alert('Нет данных для отправки.');
        }
    });
    function DisplayImportRequest(import_key) {
        var api_key = $('input[name="api_key"]').val();
        var data = {
            action: 'result',
            api_key: api_key,
            import_key: import_key
        }
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'JSON',
            data: data,
            success: function(json) {
                if(json.result == '1') {
                    if(json.element.progress=='100') {
                        $('.modal_import1').hide();
                        $('.modal_import2').show();
                        $('.import_progress').html(json.element.progress+'%');
                        $('#ticketId').text(json.element.ticket);
                        SaveStatistics();
                        $('#progressbar').hide();
                        $('.import_step_2, .close_import2').show();
                    }
                    else {
                         $('.import_progress').html(json.element.progress+'%');
                         var import_progress = parseInt($('.import_progress').val());
                         var progressvar_img = '5px';
                         if(import_progress > 20) {
                             progressvar_img = '40px';
                         }
                         if(import_progress > 40) {
                             progressvar_img = '80px';
                         }
                         if(import_progress > 60 ) {
                             progressvar_img = '120px';
                         }
                         if(import_progress > 80) {
                             progressvar_img = '160px';
                         }
                         if(import_progress == 100) {
                             progressvar_img = '200px';
                         }
                         $('.progressbar_img').css('width',progressvar_img);
                         setTimeout(DisplayImportRequest(import_key), 3000);
                    }
                }
                else {
                    $('#progressbar').hide();
                    $('.bad_import, .close_import1').show();
                }
            },
            error: function() {
                $('#progressbar').hide();
                $('.import_step_2, .close_import2').show();
            } 
        });
    }
    function SaveStatistics() {
        var selected_number_count = $('input[name="selected_number_count"]').val();
        var import_users_id = $('input[name="import_users_id"]').val();
        var ticket_id = $('#ticketId').text();
        var data2 = {
            action: 'save_statistics_data',
            selected_number_count: selected_number_count,
            import_users_id: import_users_id,
            ticket_id: ticket_id
        }
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            dataType: 'JSON',
            data: data2,
            success: function(){}
        });
    }
    //Close import
    $('input[name="close_import1"]').click(function(){
        $('#modalWindow_pixel, #modalWindow_pixel2, .modal_import1, .bad_import').hide();
    });
    $('input[name="close_import2"]').click(function(){
        $('#modalWindow_pixel, .modal_import2').hide();
        $('.mega-table tr.wp_users, .mega-table-subscribers-table tr.import_users').remove();
        $('.order-fields').hide('blind', { direction: 'vertical' }, 200);
        $('.user-fields').show('blind', { direction: 'vertical' }, 200);
        $('.user-caption').addClass('minus').css('background-image' ,'url(https://smartresponder.ru/imgs/static/send_message/minus.png)');
        $('.order-caption').removeClass('minus').css('background-image' ,'url(https://smartresponder.ru/imgs/static/send_message/plus.png)');
        var loading_img_link = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/loading.gif';
        $('.mega-table tbody').append('<tr class="loading_users_result"><td colspan="5"><img src="'+loading_img_link+'" /></td></tr>');
        var send_users_ch = '';
        if($('input[name="send_users_ch"]:checked').length == 1) {
            send_users_ch = '1';
        }
        else {
            send_users_ch = '0';
        }
        var getUsersData = {
            action: 'get_users',
            send_users_ch: send_users_ch
        }
        $('#users_count').text('0');
        $.ajax({
            url : ajaxurl,
            data : getUsersData,
            dataType : 'json',
            success : function(data) {
                if(data.length == 0) {
                    $('.loading_users_result').remove();
                    $('#users_count').text('0');
                    $('.mega-table tbody').append('<tr class="wp_users no_result"><td colspan="5">Нет данных</td></tr>');
                    var records_on_page = parseInt($('select[name="records_on_page"]').val());
                    var users_count = parseInt($('#users_count').text());
                    $('.mega-table').paginateTable({ rowsPerPage: records_on_page });
                    if(records_on_page < users_count) {
                        $('.pager').show();
                    }
                    else {
                        $('.pager').hide();
                    }
                }
                else {
                    $.each(data, function(number, item){
                        $('#tablePagination').show();
                        $('.loading_users_result').remove();
                        $('.mega-table tbody').append('<tr class="wp_users"><td id="user_id">'+item.id+'</td><td id="wp_nickname_'+item.id+'">'+item.user_nicename+'</td><td id="wp_email_'+item.id+'">'+item.user_email+'</td><td>'+item.user_registered+'</td><td><input type="checkbox" class="checkbox_users" name="wp_users_'+item.id+'" value="" /></td></tr>');
                        $('.wp_users').show();
                    });
                    $('.mega-table:first tr').each(function(i, it){
                        if(i % 2 == 0) {
                            $(this).addClass('even');
                        }
                    });
                    if($('.mega-table tr').hasClass('wp_users')) {
                        var users_count = $('.mega-table tbody tr.wp_users').length;
                        $('#users_count').text(users_count);    
                    }
                    else {
                        $('#users_count').text('0');
                    }    
                }
            }
        });
    });
    //Datepicker
    $('input[name="search[date_mode]"]').click(function(){
        var data_mode = $('.period:checked').length;
        if(data_mode == 1) {
            //Enable datepicker
            $('#from, #to').datepicker('enable');
            //From
            $('#from').datepicker({
                defaultDate: '+1w',
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                numberOfMonths: 1,
                onSelect: function(selectedDate){
                        $('#to').datepicker('option','minDate',selectedDate);
                }
            });
            //To
            $('#to').datepicker({
                defaultDate: '+1w',
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                numberOfMonths: 1,
                onSelect: function(selectedDate) {
                        $('#from').datepicker('option','maxDate', selectedDate );
                }
            });
        } 
        else {
            //Disable datepicker
            $('#from, #to').datepicker('disable');
        }
    });
    //Filtre
    $('input[name="sample"]').click(function(){
        $('.loading_users_result').remove();
        var ready_period_checked = $('.ready_period:checked').length;
        var period_checked = $('.period:checked').length;
        if(ready_period_checked == 1) {
            $('#from, #to').val('');
            var data_mode = $('select[name="search[date_mode]"]').val();
            var email_filter = $('input[name="email_filter"]').val();
            $('.mega-table tr.wp_users').remove();
            $('#users_count').text('');
            $('#tablePagination').hide();
            var loading_img_link = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/loading.gif';
            $('.mega-table tbody').append('<tr class="loading_users_result"><td colspan="5"><img src="'+loading_img_link+'" /></td></tr>');
            var send_users_ch = '';
            if($('input[name="send_users_ch"]:checked').length == 1) {
                send_users_ch = '1';
            }
            else {
                send_users_ch = '0';
            }
            var getUsersData = {
                action: 'get_users',
                data_mode: data_mode,
                email: email_filter,
                send_users_ch: send_users_ch
            }
            $.ajax({
                url : ajaxurl,
                data : getUsersData,
                dataType : 'json',
                success : function(data) {
                    if(data.length > 0) {
                        $.each(data, function(number, item){
                            $('#tablePagination').show();
                            $('.loading_users_result').remove();
                            $('.mega-table tbody').append('<tr class="wp_users"><td id="user_id">'+item.id+'</td><td id="wp_nickname_'+item.id+'">'+item.user_nicename+'</td><td id="wp_email_'+item.id+'">'+item.user_email+'</td><td>'+item.user_registered+'</td><td><input type="checkbox" class="checkbox_users" name="wp_users_'+item.id+'" value="" /></td></tr>');
                        });
                        $('.mega-table tr').each(function(i, it){
                            if(i % 2 == 0) {
                                $(this).addClass('even');
                            }
                        });
                        if(!$('.mega-table tr').hasClass('no_result')) {
                            var users_count = $('.mega-table tbody tr.wp_users').length;
                            $('#users_count').text(users_count);    
                        }
                        else {
                            $('#users_count').text('0');
                        }
                        var records_on_page = parseInt($('select[name="records_on_page"]').val());
                        var users_count = parseInt($('#users_count').text());
                        $('.mega-table').paginateTable({ rowsPerPage: records_on_page });
                        if(records_on_page < users_count) {
                            $('.pager').show();
                        }
                        else {
                            $('.pager').hide();
                        }
                    }
                    else {
                        $('.loading_users_result').remove();
                        $('#users_count').text('0');
                        $('.mega-table tbody').append('<tr class="wp_users no_result"><td colspan="5">Нет данных</td></tr>');
                        var records_on_page = parseInt($('select[name="records_on_page"]').val());
                        var users_count = parseInt($('#users_count').text());
                        $('.mega-table').paginateTable({ rowsPerPage: records_on_page });
                        if(records_on_page < users_count) {
                            $('.pager').show();
                        }
                        else {
                            $('.pager').hide();
                        }
                    }
                }
            });
        }
        if(period_checked == 1) {
            $('select[name="search[date_mode]"] option:first').attr('selected',true);
            var from = $('input[name="from"]').val();
            var to = $('input[name="to"]').val();
            if(from.length == 0 && to.length == 0) {
                alert('Укажите период.');
            }
            else {
                if(from.length == 0) {
                    alert('Укажите с кокого периода');
                }
                if(to.length == 0) {
                    alert('Укажите до кокого периода')
                }
            }
            if(from.length > 0 && to.length > 0) {
                var email_filter = $('input[name="email_filter"]').val();
                $('tr.wp_users').remove();
                $('#users_count').text('');
                var loading_img_link = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/loading.gif';
                $('.mega-table tbody').append('<tr class="loading_users_result"><td colspan="5"><img src="'+loading_img_link+'" /></td></tr>');
                var getUsersData = {
                    action: 'get_users',
                    email: email_filter,
                    from: from,
                    to: to
                }
                $.ajax({
                    url : ajaxurl,
                    data : getUsersData,
                    dataType : 'json',
                    success : function(data) {
                        if(data.length > 0) {
                            $.each(data, function(number, item){
                                $('.loading_users_result').remove();
                                $('.mega-table tbody').append('<tr class="wp_users"><td id="user_id">'+item.id+'</td><td id="wp_nickname_'+item.id+'">'+item.user_nicename+'</td><td id="wp_email_'+item.id+'">'+item.user_email+'</td><td>'+item.user_registered+'</td><td><input type="checkbox" class="checkbox_users" name="wp_users_'+item.id+'" value="" /></td></tr>');
                            });
                            $('.mega-table tr').each(function(i, it){
                                if(i % 2 == 0) {
                                    $(this).addClass('even');
                                }
                            });
                            if(!$('.mega-table tr').hasClass('no_result')) {
                                var users_count = $('.mega-table tbody tr.wp_users').length;
                                $('#users_count').text(users_count);  
                                $('.wp_users_pagination').css('display','block');  
                            }
                            else {
                                $('#users_count').text('0');
                                $('.wp_users_pagination').css('display','none');
                            }
                        }
                        else {
                            $('.loading_users_result').remove();
                            $('.mega-table tbody').append('<tr class="wp_users no_result"><td colspan="5">Нет данных</td></tr>');
                            $('#users_count').text('0');
                            $('.wp_users_pagination').css('display','none');
                        }
                    }
                });
            }
        }
    });
    //Pagination
    $('.mega-table').paginateTable({ rowsPerPage: 5 });
    $('select[name="records_on_page"]').change(function(){
        $('.wp_users').show();
        var records_on_page = parseInt($('select[name="records_on_page"]').val());
        var users_count = parseInt($('#users_count').text());
        $('.mega-table').paginateTable({ rowsPerPage: records_on_page });
        if(records_on_page < users_count) {
            $('.pager').show();
        }
        else {
            $('.pager').hide();
        }
    });
    //statistics_li
    $('#statistics_li').click(function(){
        if($('.mega-table-subscribers-table tr').length == 1) {
            var loading_img_link = splitted[0]+'wp-content/plugins/smartresponder-1.0/images/loading.gif';
            $('.mega-table-subscribers-table .mega-table-title').after('<tr class="loading_users_result" style="border: 0px; "><td colspan="5"><img src="'+loading_img_link+'" /></td></tr>');
            var getStatistics_data = {
                action: 'get_statistics_data'
            }
            $.ajax({
                url : ajaxurl,
                type : 'POST', 
                data : getStatistics_data,
                dataType : 'json',
                success : function(data) {
                    if(data.length > 0) {
                        $.each(data, function(number, item){
                            $('.mega-table-subscribers-table .mega-table-title').after('<tr class="import_users"><td>'+item.import_date+'</td><td>'+item.import_users_count+'</td><td>'+item.ticket_id+'</td></tr>');
                        });
                        $('#import_users_count').text($('.import_users').length);
                        $('.mega-table-subscribers-table tr').each(function(i, it){
                            if(i % 2 == 0) {
                                $(this).addClass('even');
                            }
                        });
                        $('.loading_users_result').remove();
                    }
                    else {
                        $('.loading_users_result').remove();
                        $('.mega-table-subscribers-table .mega-table-title').after('<tr class="wp_users no_result"><td colspan="5">Нет данных</td></tr>');
                    }
                }
            });  
        }
    });
    //scroll .leftCol
    $(window).scroll(function(){
        var rightColHeight = parseInt($('.rightCol').css('height'));
        var leftColHeight = parseInt($('.leftCol').css('height'));
        var heightScroll = rightColHeight-leftColHeight;
        var sectionTop = $('.section').offset().top;
        var leftColTop = 107;
        if(sectionTop > 48) {
            leftColTop = sectionTop-48+leftColTop;
        }
        if ($(this).scrollTop() > heightScroll) {
            $('.leftCol').css('position','relative').css('top',heightScroll);
        } else {
            $('.leftCol').css('position','fixed').css('top',leftColTop+'px');
        }
    }); 
});