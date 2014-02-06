// closure to avoid namespace collision
(function(){
	//-------
	var html_form = '<div id="text_box-form">\
				<div class="popup_submit_wrap"><p class="wpp_message"><strong>Тестовый период wppage закончился. <a target="_blank" href="http://wppage.ru/buy" >Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a></strong> </p></div>\
				<div class="ps_text_box_form coach_box">\
				<div>\
					<label class="ps_text_box wppage_checkbox ps_text_box_1"><input type="radio" name="text_box_style" value="1" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_1_1"><input type="radio" name="text_box_style" value="1_1" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_2"><input type="radio" name="text_box_style" value="2" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_2_1"><input type="radio" name="text_box_style" value="2_1" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_3"><input type="radio" name="text_box_style" value="3" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_3_1"><input type="radio" name="text_box_style" value="3_1" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_4"><input type="radio" name="text_box_style" value="4" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_4_1"><input type="radio" name="text_box_style" value="4_1" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_5"><input type="radio" name="text_box_style" value="5" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_5_1"><input type="radio" name="text_box_style" value="5_1" /></label>\
					<label class="ps_text_box wppage_checkbox ps_text_box_6"><input type="radio" name="text_box_style" value="6" /></label>\
				</div>\
				</div></div>';
	
	//-------
	
	// creates the plugin
	tinymce.create('tinymce.plugins.textbox', {
		// creates control instances based on the control's id.
		// our button's id is "smartresponder_button"
		createControl : function(id, controlManager) {
			if (id == 'text_box_button') {
				// creates the button
				var button = controlManager.createButton('text_box_button', {
					title : 'Боксы', // title of the button
					image : plugin_url+'/wppage/i/trial/box.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Боксы', '#TB_inline?inlineId=text_box-form' );
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
	tinymce.PluginManager.add('textbox', tinymce.plugins.textbox);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#text_box_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'id'    : ''
				};
			
			var text_box_style = jQuery('input[name=text_box_style]:checked').val()
			
			var shortcode = '<p class="aligncenter"><div class="ps_text_box ps_text_box_'+text_box_style+'"><p class="ps_text_box_text">Текст</p></div></p><p>&nbsp;</p>';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()
