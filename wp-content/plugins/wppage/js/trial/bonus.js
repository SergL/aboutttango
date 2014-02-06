// closure to avoid namespace collision
(function(){
	//-------
	var html_form = '<div id="bonus-form">\
				<p class="popup_submit_wrap"><span class="wpp_helper_box"><a class="" target="_blank" href="http://wppage.ru/wppage_lessons/lenti.mp4">Видео урок</a></span><input type="button" id="bonus_submit" class="button-primary" value="Вставить" name="submit" /></p>\
				<div class="ps_bonus_form coach_box">\
				<div>\
					<label class="ps_bonus ps_bonus_1"><input type="radio" name="bonus_style" value="1" /></label>\
					<label class="ps_bonus ps_bonus_2"><input type="radio" name="bonus_style" value="2" /></label>\
					<label class="ps_bonus ps_bonus_3"><input type="radio" name="bonus_style" value="3" /></label>\
					<label class="ps_bonus ps_bonus_4"><input type="radio" name="bonus_style" value="4" /></label>\
					<label class="ps_bonus ps_bonus_5"><input type="radio" name="bonus_style" value="5" /></label>\
					<label class="ps_bonus ps_bonus_6"><input type="radio" name="bonus_style" value="6" /></label>\
					<label class="ps_bonus ps_bonus_7"><input type="radio" name="bonus_style" value="7" /></label>\
					<label class="ps_bonus ps_bonus_8"><input type="radio" name="bonus_style" value="8" /></label>\
					<label class="ps_bonus ps_bonus_9"><input type="radio" name="bonus_style" value="9" /></label>\
					<label class="ps_bonus ps_bonus_10"><input type="radio" name="bonus_style" value="10" /></label>\
					<label class="ps_bonus ps_bonus_11"><input type="radio" name="bonus_style" value="11" /></label>\
					<label class="ps_bonus ps_bonus_12"><input type="radio" name="bonus_style" value="12" /></label>\
					<label class="ps_bonus ps_bonus_13"><input type="radio" name="bonus_style" value="13" /></label>\
					<label class="ps_bonus ps_bonus_14"><input type="radio" name="bonus_style" value="14" /></label>\
					<label class="ps_bonus ps_bonus_15"><input type="radio" name="bonus_style" value="15" /></label>\
					<label class="ps_bonus ps_bonus_16"><input type="radio" name="bonus_style" value="16" /></label>\
					<label class="ps_bonus ps_bonus_17"><input type="radio" name="bonus_style" value="17" /></label>\
					<label class="ps_bonus ps_bonus_18"><input type="radio" name="bonus_style" value="18" /></label>\
					<label class="ps_bonus ps_bonus_19"><input type="radio" name="bonus_style" value="19" /></label>\
					<label class="ps_bonus ps_bonus_20"><input type="radio" name="bonus_style" value="20" /></label>\
					<label class="ps_bonus ps_bonus_21"><input type="radio" name="bonus_style" value="21" /></label>\
					<label class="ps_bonus ps_bonus_22"><input type="radio" name="bonus_style" value="22" /></label>\
					<label class="ps_bonus ps_bonus_23"><input type="radio" name="bonus_style" value="23" /></label>\
				</div>\
				</div></div>';
	
	//-------
	
	// creates the plugin
	tinymce.create('tinymce.plugins.bonus', {
		// creates control instances based on the control's id.
		// our button's id is "smartresponder_button"
		createControl : function(id, controlManager) {
			if (id == 'bonus_button') {
				// creates the button
				var button = controlManager.createButton('bonus_button', {
					title : 'Ленты', // title of the button
					image : plugin_url+'/wppage/i/bonus.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Ленты', '#TB_inline?inlineId=bonus-form' );
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
	tinymce.PluginManager.add('bonus', tinymce.plugins.bonus);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#bonus_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'id'    : ''
				};
			
			var bonus_style = jQuery('input[name=bonus_style]:checked').val()
			
			var shortcode_old = '<h2 class="ps_bonus_box_wide ps_bonus_wide_'+bonus_style+'"><span class="left">&nbsp;</span><span class="ps_bonus_text_wide">Текст</span><span class="right">&nbsp;</span></h2><p>&nbsp;</p>';

            var shortcode = '<div class="bonus_table_box_t"><table class="ps_bonus_box_wide_t ps_bonus_wide_t_'+bonus_style+'"><tr><td class="td_left_box left"></td><td class="wp_bonus_text_box_t"><span class="ps_bonus_text_wide_t">Текст</span></td><td class="td_right_box right"></td></tr></table></div><p>&nbsp;</p>'
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()
