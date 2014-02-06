// closure to avoid namespace collision
(function(){
    //-------
    var html_form = '<div id="subscriptions-form">\
				<p class="popup_submit_wrap"><span class="wpp_helper_box"><a onclick="open_win(\'http://www.youtube.com/watch?v=546KJehwzzw&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=5\')">Видео урок</a></span><input type="button" id="subscription_submit" class="button-primary" value="Вставить" name="submit" /></p>\
				<div class="ps_subscription_form coach_box">\
				<ul>\
				<li>\
				<label class="wpp_subsc_thumb subsc_getresponse">\
				<input type="radio" name="wpp_subscription" value="getresponse"/>\
				</label>\
				</li>\
				<li>\
				<label class="wpp_subsc_thumb subsc_mailchimp">\
				<input type="radio" name="wpp_subscription" value="mailchimp"/>\
				</label>\
				</li>\
				<li>\
				<label class="wpp_subsc_thumb subsc_justclick">\
				<input type="radio" name="wpp_subscription" value="justclick"/>\
				</label>\
				</li>\
				<li>\
				<label class="wpp_subsc_thumb subsc_unisender">\
				<input type="radio" name="wpp_subscription" value="unisender"/>\
				</label>\
				</li>\
				<li>\
				<label class="wpp_subsc_thumb subsc_smartresponder">\
				<input type="radio" name="wpp_subscription" value="smartresponder"/>\
				</label>\
				</li>\
				</ul>\
				</div></div>';

    //-------

    // creates the plugin
    tinymce.create('tinymce.plugins.subscriptions', {
        // creates control instances based on the control's id.
        // our button's id is "smartresponder_button"
        createControl : function(id, controlManager) {
            if (id == 'subscriptions_button') {
                // creates the button
                var button = controlManager.createButton('subscriptions_button', {
                    title : 'Подписки', // title of the button
                    image : plugin_url+'/wppage/i/subscriptions.png',  // path to the button's image
                    onclick : function() {
                        // triggers the thickbox
                        tb_show( 'Подписки', '#TB_inline?inlineId=subscriptions-form' );
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
    tinymce.PluginManager.add('subscriptions', tinymce.plugins.subscriptions);

    // executes this when the DOM is ready
    jQuery(function(){
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery(html_form);

        form.appendTo('body').hide();

        // handles the click event of the submit button
        form.find('#subscription_submit').click(function(){
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = {
                'id'    : ''
            };

            var subscription = jQuery('input[name=wpp_subscription]:checked').val()

            var shortcode = '[wpp_'+ subscription +']'

            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });
    });
})()
