// closure to avoid namespace collision
(function(){
    //-------
    var html_form = '<div id="subscriptions-form">\
				<div class="popup_submit_wrap" style="height:68px;"><p class="wpp_message border_yellow"><strong>В пакете START доступен только SmartResponder. <a target="_blank" href="http://wppage.ru/wppage/obnovit-paket/" >Обновить пакет <span style="font-size:18px">→</span></a></strong> </p><span class="wpp_helper_box"><a class="" target="_blank" href="http://wppage.ru/wppage_lessons/SmartResponder.mp4">Видео урок</a></span><input type="button" id="subscription_submit" class="button-primary" value="Вставить" name="submit" style="margin-top:15px" /></div>\
				<div class="ps_subscription_form coach_box" style="margin-top: 50px;">\
				<ul>\
				<li>\
				<label class="wpp_subsc_thumb subsc_getresponse_trial">\
				<input type="radio" name="wpp_subscription" value="getresponse" class="trial"/>\
				</label>\
				</li>\
				<li>\
				<label class="wpp_subsc_thumb subsc_mailchimp_trial">\
				<input type="radio" name="wpp_subscription" value="mailchimp" class="trial"/>\
				</label>\
				</li>\
				<li>\
				<label class="wpp_subsc_thumb subsc_justclick_trial">\
				<input type="radio" name="wpp_subscription" value="justclick" class="trial"/>\
				</label>\
				</li>\
				<li>\
				<label class="wpp_subsc_thumb subsc_unisender_trial">\
				<input type="radio" name="wpp_subscription" value="unisender" class="trial"/>\
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

            var subscription = jQuery('input[name=wpp_subscription]:checked').val();
            var shortcode = '&nbsp;';
            if(subscription != undefined){
                shortcode = '[wpp_'+ subscription +']';
            }

            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });
    });
})()
