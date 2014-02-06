// closure to avoid namespace collision
(function(){
	
	//-------
	var html_form = '<div id="googleform-form">\
					<div class="popup_submit_wrap"><p class="wpp_message"><strong>Недоступно в пакете START. <a target="_blank" href="http://wppage.ru/wppage/obnovit-paket/" >Обновить пакет <span style="font-size:18px">→</span></a></strong> </p></div>\
					<div class="coach_form coach_box">\
					<label for="googleform-key">URL Адрес<br>\
					<input type="text" id="googleform-key" name="key" class="width_100p" value="" /></label><br><br>\
					<label for="googleform-height"><input type="text" id="googleform-height" name="height" value="500" style="width:100px" /> Высота </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
					<label for="googleform-width"><input type="text" id="googleform-width" name="width" value="600" style="width:100px" /> Ширина </label><br><br>\
					<div class="wpp_helper_box"><a class="" target="_blank" href="http://wppage.ru/wppage_lessons/google_forms.mp4">Видео урок</a></div>\
					</div></div><div style"display:none" id="temp-form-code"></div>';
				
	//-------
	// creates the plugin
	tinymce.create('tinymce.plugins.coachforms', {
		// creates control instances based on the control's id.
		// our button's id is "googleform_button"
		createControl : function(id, controlManager) {
			if (id == 'googleform_button') {
				// creates the button
				var button = controlManager.createButton('googleform_button', {
					title : 'Форма Google', // title of the button
					image : plugin_url+'/wppage/i/trial/forms.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Вставить форму', '#TB_inline?width=600&height=300&inlineId=googleform-form' );
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
	tinymce.PluginManager.add('coachforms', tinymce.plugins.coachforms);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		// my
		function get_formkey(url) {
			var request = [];
			var pairs = url.substring(url.indexOf('?') + 1).split('&');
			for (var i = 0; i < pairs.length; i++) {
				var pair = pairs[i].split('=');
				if(decodeURIComponent(pair[0]) == 'formkey') return decodeURIComponent(pair[1]);
				//request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
			}
			
		}

		
		// /my
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
        form.find('#googleform-submit').click(function(){

            var url = jQuery('#googleform-key').val();
            var src = '';
            if (url.substring(0, 7) == "<iframe") {
                jQuery('#temp-form-code').html(url);
                src = jQuery('#temp-form-code iframe').attr('src');
            }else{
                src = url+'?embedded=true';
            }
            var height = (jQuery('#googleform-height').val())? jQuery('#googleform-height').val() : 500;
            var width = (jQuery('#googleform-width').val())? jQuery('#googleform-width').val() : 600;

            var shortcode = '<p class="aligncenter">[wpp_googleform url="' + src + '" width="'+ width +'" height="' + height + '"]</p>';

            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

            // closes Thickbox
            tb_remove();
        });
	});
})()