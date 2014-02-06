// closure to avoid namespace collision
(function(){
	
	//-------
	var html_form = '<div id="video-form">\
					<div class="popup_submit_wrap"><p class="wpp_message"><strong>Тестовый период wppage закончился. <a target="_blank" href="http://wppage.ru/buy">Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a></strong> </p></div>\
					<div class="wpp_video_form coach_box">\
						<label for="video-link">Ссылка<br>\
						<input type="text" id="video-link" name="videolink" class="width_100p" value="" /></label><br><br>\
						<label for="video-width"><input type="text" id="video-width" name="width" value="640" class="width_100" /> Ширина</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
						<label for="video-height"><input type="text" id="video-height" name="height" value="360" class="width_100" /> Высота</label><br><br>\
						<label class="wppage_checkbox"><input type="checkbox" id="autoplay" name="autoplay" value="on" />&nbsp;Автовоспроизведение</label><br><br>\
						<div>\
						<label class="wppage_checkbox wppage_checked"><input type="radio" name="video_border" value="no" checked="checked">Без рамки</label>\
						<label class="wppage_checkbox"><input type="radio" name="video_border" value="yes">В рамке</label>\
						</div>\
						<br>\
						<div class="video_border_sizes">\
						<label class="wppage_radio_v video_border_480"><input type="radio" name="video_border_size" value="480x270"></label>\
						<label class="wppage_radio_v video_border_560"><input type="radio" name="video_border_size" value="560x315"></label>\
						<label class="wppage_radio_v video_border_640"><input type="radio" name="video_border_size" value="640x360"></label>\
						<label class="wppage_radio_v video_border_720"><input type="radio" name="video_border_size" value="720x405"></label>\
						</div>\
						<br>\
						<div class="video_styles">\
						<label class="wppage_radio_v video_style video_style_1"><input type="radio" name="video_border_style" value="1"></label>\
						<label class="wppage_radio_v video_style video_style_2"><input type="radio" name="video_border_style" value="2"></label>\
						<label class="wppage_radio_v video_style video_style_3"><input type="radio" name="video_border_style" value="3"></label>\
						<label class="wppage_radio_v video_style video_style_4"><input type="radio" name="video_border_style" value="4"></label>\
						<label class="wppage_radio_v video_style video_style_5"><input type="radio" name="video_border_style" value="5"></label>\
						<label class="wppage_radio_v video_style video_style_6"><input type="radio" name="video_border_style" value="6"></label>\
						<label class="wppage_radio_v video_style video_style_7"><input type="radio" name="video_border_style" value="7"></label>\
						<label class="wppage_radio_v video_style video_style_8"><input type="radio" name="video_border_style" value="8"></label>\
						<label class="wppage_radio_v video_style video_style_9"><input type="radio" name="video_border_style" value="9"></label>\
						<label class="wppage_radio_v video_style video_style_10"><input type="radio" name="video_border_style" value="10"></label>\
						</div>\
					<div class="wpp_helper_box"><a class="" target="_blank" href="http://wppage.ru/wppage_lessons/Video.mp4">Видео урок</a></div></div>\
					</div>';
				
	//-------
	// creates the plugin
	tinymce.create('tinymce.plugins.wppvideo', {
		// creates control instances based on the control's id.
		// our button's id is "audio_button"
		createControl : function(id, controlManager) {
			if (id == 'video_button') {
				// creates the button
				var button = controlManager.createButton('video_button', {
					title : 'Видео', // title of the button
					image : plugin_url+'/wppage/i/trial/video.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Видео', '#TB_inline?width=600&height=300&inlineId=video-form' );
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
	tinymce.PluginManager.add('wppvideo', tinymce.plugins.wppvideo);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#videolink-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var video = jQuery('#video-link').val();
			var width = jQuery('#video-width').val();
			var height = jQuery('#video-height').val();
			var autoplay = (jQuery('#autoplay:checked').val())? 'on': 'off';
            var size = jQuery('input[name=video_border_size]:checked').val();
            var style = jQuery('input[name=video_border_style]:checked').val();
            var video_border = jQuery('input[name=video_border]:checked').val();
            if(video_border == 'yes'){
                var shortcode = '<p class="aligncenter" style="position: relative; padding: 0; margin: 0 auto;">[wpp_video video='+ video +' width='+ width +' height='+ height +' autoplay='+ autoplay +' style=' + style + ' size=' + size + ']</p>';
            }else{
                var shortcode = '<p class="aligncenter" style="position: relative; padding: 0; margin: 0 auto;">[wpp_video video='+ video +' width='+ width +' height='+ height +' autoplay='+ autoplay +']</p>';
            }


			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()