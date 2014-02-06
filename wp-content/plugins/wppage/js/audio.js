// closure to avoid namespace collision
(function(){
	
	//-------
	var html_form = '<div id="audio-form">\
					<p class="popup_submit_wrap"><span class="wpp_helper_box"><a onclick="open_win(\'http://www.youtube.com/watch?v=dzCvAj4T17g&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=2\')">Видео урок</a></span><input type="button" id="audiolink-submit" class="button-primary" value="Вставить аудио" name="submit" /></p>\
					<div class="wpp_audio_form coach_box">\
						<label for="audio-link">Ссылка</label><br>\
						<input type="text" id="audio-link" name="link" class="width_100p" value="" /><br><br>\
						<ul class="audio_setting">\
						<li><label class="wppage_checkbox wppage_checked"><input type="radio" class="audio_color" name="audio_color" value="black" checked="checked" /><span class="black_player"></span></label></li>\
						<li><label class="wppage_checkbox"><input type="radio" class="audio_color" name="audio_color" value="white" /><span class="white_player"></span></label></li>\
						</ul>\
						<br>\
						<label class="wppage_checkbox"><input type="checkbox" id="autoplay" name="autoplay" value="on" />&nbsp;Автовоспроизведение</label><br><br><br>\
					</div>\
					</div>';
				
	//-------
	// creates the plugin
	tinymce.create('tinymce.plugins.coachaudio', {
		// creates control instances based on the control's id.
		// our button's id is "audio_button"
		createControl : function(id, controlManager) {
			if (id == 'audio_button') {
				// creates the button
				var button = controlManager.createButton('audio_button', {
					title : 'Аудио', // title of the button
					image : plugin_url+'/wppage/i/audio.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Вставить аудио', '#TB_inline?width=600&height=300&inlineId=audio-form' );
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
	tinymce.PluginManager.add('coachaudio', tinymce.plugins.coachaudio);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#audiolink-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var audio_link = jQuery('#audio-link').val();
            if(audio_link == '') {
                audio_link = 'null';
            }

			var autoplay = (jQuery('#autoplay:checked').val())? 'on': 'off';
			var audio_color = jQuery('.audio_color:checked').val();
			var shortcode = '<p class="aligncenter">[wpp_uppod audio='+ audio_link +' color='+ audio_color +' autoplay='+ autoplay +']</p>';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()