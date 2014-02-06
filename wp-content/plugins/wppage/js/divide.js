// closure to avoid namespace collision
(function(){
    //-------
    var html_form = '<div id="divider-form">\
				<p class="popup_submit_wrap"><span class="wpp_helper_box"><a onclick="open_win(\'http://www.youtube.com/watch?v=sYEuensDTNY&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=15\')">Видео урок</a></span><input type="button" id="divider_submit" class="button-primary" value="Вставить" name="submit" /></p>\
				<div class="ps_divider_form coach_box"><br>\
				<div class="divide_width_slider_box">\
        <input type="text" name="ps_divide_width" id="ps_divide_width" value="65"/> - <input type="text" name="ps_divide_width_2" id="ps_divide_width_2"><br><br>\
        <div id="ps_divide_slider"></div><br>\
        <table class="table_preview"><tr><td class="wpp_divide_first" style="width: 65%">текст<br>&nbsp;<br>&nbsp;<br>&nbsp;</td><td class="wpp_divide_second" style="width: 35%">текст<br>&nbsp;<br>&nbsp;</td></tr></table>\
        <script type="text/javascript">\
        jQuery(function ($) {\
            $("#ps_divide_slider").slider({\
                value: 65,\
                min:5,\
                max:95,\
                step:5,\
                slide:function (event, ui) {\
                    $("#ps_divide_width").val(ui.value);\
                    $("#ps_divide_width_2").val(100-ui.value);\
                    $(".wpp_divide_first").css({"width": ui.value+"%"});\
                    $(".wpp_divide_second").css({"width": 100-ui.value + "%"});\
                    },\
                    create: function(event, ui){\
                        $("#ps_divide_width").val(65);\
                        $("#ps_divide_width_2").val(35);\
                        $(".wpp_divide_first").css({"width": ui.value+"%"});\
                        $(".wpp_divide_second").css({"width": 100-ui.value + "%"});\
                    }\
                });\
                            });\
                        </script>\
                    </div>\
				</div>\
				</div>';

    //-------

    // creates the plugin
    tinymce.create('tinymce.plugins.divide', {
        // creates control instances based on the control's id.
        // our button's id is "smartresponder_button"
        createControl : function(id, controlManager) {
            if (id == 'divide_button') {
                // creates the button
                var button = controlManager.createButton('divide_button', {
                    title : 'Разделитель', // title of the button
                    image : plugin_url+'/wppage/i/divide.png',  // path to the button's image
                    onclick : function() {
                        // triggers the thickbox
                        tb_show( 'Разделитель', '#TB_inline?width=600&height=400&inlineId=divider-form' );
                        jQuery('#TB_ajaxContent').css({'width': '640', 'height': (jQuery('#TB_window').height()-50)+'px'});
                        jQuery(window).resize(function(){
                            jQuery('#TB_ajaxContent').css({'width': '640', 'height': (jQuery('#TB_window').height()-50)+'px'});
                        });
                    }
                });
                return button;
            }
            return null;
        }
    });

    // registers the plugin. DON'T MISS THIS STEP!!!
    tinymce.PluginManager.add('divide', tinymce.plugins.divide);

    // executes this when the DOM is ready
    jQuery(function($){
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery(html_form);

        form.appendTo('body').hide();

        //-----------------

        $("#ps_divide_width").bind('change', function(){
            $("#ps_divide_width_2").val(100- $(this).val());
        });
        $("#ps_divide_width_2").bind('change', function(){
            $("#ps_divide_width").val(100- $(this).val());
        });

        // handles the click event of the submit button
        form.find('#divider_submit').click(function(){
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless

            var width_1 = width_2 = '';
            width_1 = jQuery('#ps_divide_width').val();
            if(width_1 == ''){
                width_1 = 65;
            }
            width_2 = 100 - width_1;


            var shortcode = '<table width="100%" class="wpp_divider"><tr><td style="width:'+ width_1 +'%"><div>текст</div></td><td style="width:'+ width_2 +'%"><div>текст</div></td></tr></table>';

            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });
    });
})()
