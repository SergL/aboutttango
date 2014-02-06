// closure to avoid namespace collision
(function(){
	
	//-------
	var html_form = '<div id="socialbuttons-form">\
					<div class="popup_submit_wrap"><p class="wpp_message"><strong>Тестовый период wppage закончился. <a target="_blank" href="http://wppage.ru/buy" >Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a></strong> </p></div>\
					<div class="ps_socialbuttons_form coach_box">\
						<ul id="wpp_sortable_social" class="wpp_sortable block">\
						<li><label class="sbutton wppage_checkbox wppage_checked"><span class="wpp_facebook_thumb"></span><input type="checkbox" name="facebook" value="facebook" checked="checked" /></label></li>\
						<li><label class="sbutton wppage_checkbox wppage_checked"><span class="wpp_vk_like_thumb"></span><input type="checkbox" name="vk_like" value="vk_like" checked="checked" /></label></li>\
						<li><label class="sbutton wppage_checkbox wppage_checked"><span class="wpp_vk_share_thumb"></span><input type="checkbox" name="vk_share" value="vk_share" checked="checked" /></label></li>\
						<li><label class="sbutton wppage_checkbox wppage_checked"><span class="wpp_twitter_thumb"></span><input type="checkbox" name="twitter" value="twitter" checked="checked" /></label></li>\
						<li><label class="sbutton wppage_checkbox wppage_checked"><span class="wpp_gplus_thumb"></span><input type="checkbox" name="gplus" value="gplus" checked="checked" /></label></li>\
						<li><label class="sbutton wppage_checkbox wppage_checked"><span class="wpp_linkedin_thumb"></span><input type="checkbox" name="linkedin" value="linkedin" checked="checked" /></label></li>\
						<li><label class="sbutton wppage_checkbox wppage_checked"><span class="wpp_mailru_thumb"></span><input type="checkbox" name="mailru" value="mailru" checked="checked" /></label></li>\
						<li><label class="sbutton wppage_checkbox wppage_checked"><span class="wpp_odnoklasniki_thumb"></span><input type="checkbox" name="odnoklasniki" value="odnoklasniki" checked="checked" /></label></li>\
						</ul><br><br>\
						<div class="wpp_helper_box"><a class="" target="_blank" href="http://wppage.ru/wppage_lessons/Social_like_buttons.mp4">Видео урок</a></div>\
					</div>\
					</div>';
				
	//-------
	// creates the plugin
	tinymce.create('tinymce.plugins.socialbuttons', {
		// creates control instances based on the control's id.
		// our button's id is "audio_button"
		createControl : function(id, controlManager) {
			if (id == 'social_button') {
				// creates the button
				var button = controlManager.createButton('social_button', {
					title : 'Социальные кнопки', // title of the button
					image : plugin_url+'/wppage/i/trial/social.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Вставить социальные кнопки', '#TB_inline?width=600&height=300&inlineId=socialbuttons-form' );
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
	tinymce.PluginManager.add('socialbuttons', tinymce.plugins.socialbuttons);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		var table = form.find('table');
		form.appendTo('body').hide();

        jQuery('#wpp_sortable_social').sortable();


		// handles the click event of the submit button
		form.find('#social_buttons_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var sb = '';
			jQuery('.ps_socialbuttons_form input:checked').each(function(){
				if(sb==''){
					sb += jQuery(this).val();
					
					}else{
					sb += (','+ jQuery(this).val());
					
						}
				});
			var shortcode = '';	
			if(sb == '') shortcode = '';
			else shortcode = '<p class="aligncenter">[wpp_socialbuttons buttons="'+ sb +'"]</p>';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()