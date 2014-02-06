// closure to avoid namespace collision
(function(){
	//-------
	var html_form = '<div id="bullets-form">\
				<div class="popup_submit_wrap"><p class="wpp_message"><strong>Тестовый период wppage закончился. <a target="_blank" href="http://wppage.ru/buy" >Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a></strong> </p></div>\
				<div class="ps_bullets_form coach_box">\
				<div>\
					<span>Маленькие (16px)</span>\
					<br>\
					<label class="ps_bullet ps_bullet_1"><input type="radio" name="bullet_style" value="1" /></label>\
					<label class="ps_bullet ps_bullet_2"><input type="radio" name="bullet_style" value="2" /></label>\
					<label class="ps_bullet ps_bullet_3"><input type="radio" name="bullet_style" value="3" /></label>\
					<label class="ps_bullet ps_bullet_4"><input type="radio" name="bullet_style" value="4" /></label>\
					<label class="ps_bullet ps_bullet_5"><input type="radio" name="bullet_style" value="5" /></label>\
					<label class="ps_bullet ps_bullet_6"><input type="radio" name="bullet_style" value="6" /></label>\
					<label class="ps_bullet ps_bullet_7"><input type="radio" name="bullet_style" value="7" /></label>\
					<label class="ps_bullet ps_bullet_8"><input type="radio" name="bullet_style" value="8" /></label>\
					<label class="ps_bullet ps_bullet_9"><input type="radio" name="bullet_style" value="9" /></label>\
					<label class="ps_bullet ps_bullet_10"><input type="radio" name="bullet_style" value="10" /></label>\
					<label class="ps_bullet ps_bullet_11"><input type="radio" name="bullet_style" value="11" /></label>\
					<label class="ps_bullet ps_bullet_12"><input type="radio" name="bullet_style" value="12" /></label>\
					<label class="ps_bullet ps_bullet_13"><input type="radio" name="bullet_style" value="13" /></label>\
					<label class="ps_bullet ps_bullet_14"><input type="radio" name="bullet_style" value="14" /></label>\
					<label class="ps_bullet ps_bullet_15"><input type="radio" name="bullet_style" value="15" /></label>\
					<label class="ps_bullet ps_bullet_16"><input type="radio" name="bullet_style" value="16" /></label>\
					<label class="ps_bullet ps_bullet_17"><input type="radio" name="bullet_style" value="17" /></label>\
					<label class="ps_bullet ps_bullet_18"><input type="radio" name="bullet_style" value="18" /></label>\
					<label class="ps_bullet ps_bullet_23"><input type="radio" name="bullet_style" value="23" /></label>\
					<label class="ps_bullet ps_bullet_25"><input type="radio" name="bullet_style" value="25" /></label>\
					<label class="ps_bullet ps_bullet_26"><input type="radio" name="bullet_style" value="26" /></label>\
					<label class="ps_bullet ps_bullet_27"><input type="radio" name="bullet_style" value="27" /></label>\
					<label class="ps_bullet ps_bullet_28"><input type="radio" name="bullet_style" value="28" /></label>\
					<label class="ps_bullet ps_bullet_29"><input type="radio" name="bullet_style" value="29" /></label>\
					<label class="ps_bullet ps_bullet_30"><input type="radio" name="bullet_style" value="30" /></label>\
					<label class="ps_bullet ps_bullet_31"><input type="radio" name="bullet_style" value="31" /></label>\
					<label class="ps_bullet ps_bullet_32"><input type="radio" name="bullet_style" value="32" /></label>\
					<label class="ps_bullet ps_bullet_33"><input type="radio" name="bullet_style" value="33" /></label>\
					<br><br>\
					<span>Средние (24px)</span>\
					<br>\
					<label class="ps_bullet ps_bullet_24_1"><input type="radio" name="bullet_style" value="24_1 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_2"><input type="radio" name="bullet_style" value="24_2 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_3"><input type="radio" name="bullet_style" value="24_3 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_4"><input type="radio" name="bullet_style" value="24_4 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_5"><input type="radio" name="bullet_style" value="24_5 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_6"><input type="radio" name="bullet_style" value="24_6 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_7"><input type="radio" name="bullet_style" value="24_7 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_8"><input type="radio" name="bullet_style" value="24_8 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_9"><input type="radio" name="bullet_style" value="24_9 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_10"><input type="radio" name="bullet_style" value="24_10 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_11"><input type="radio" name="bullet_style" value="24_11 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_12"><input type="radio" name="bullet_style" value="24_12 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_13"><input type="radio" name="bullet_style" value="24_13 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_14"><input type="radio" name="bullet_style" value="24_14 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_15"><input type="radio" name="bullet_style" value="24_15 middle_bullets" /></label>\
					<label class="ps_bullet ps_bullet_24_16"><input type="radio" name="bullet_style" value="24_16 middle_bullets" /></label>\
					<br><br>\
					<span>Большие (32px)</span>\
					<br>\
					<label class="ps_bullet ps_bullet_big_1 big_bullet"><input type="radio" name="bullet_style" value="big_1 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_2 big_bullet"><input type="radio" name="bullet_style" value="big_2 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_3 big_bullet"><input type="radio" name="bullet_style" value="big_3 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_4 big_bullet"><input type="radio" name="bullet_style" value="big_4 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_5 big_bullet"><input type="radio" name="bullet_style" value="big_5 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_6 big_bullet"><input type="radio" name="bullet_style" value="big_6 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_7 big_bullet"><input type="radio" name="bullet_style" value="big_7 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_8 big_bullet"><input type="radio" name="bullet_style" value="big_8 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_9 big_bullet"><input type="radio" name="bullet_style" value="big_9 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_10 big_bullet"><input type="radio" name="bullet_style" value="big_10 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_11 big_bullet"><input type="radio" name="bullet_style" value="big_11 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_12 big_bullet"><input type="radio" name="bullet_style" value="big_12 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_13 big_bullet"><input type="radio" name="bullet_style" value="big_13 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_14 big_bullet"><input type="radio" name="bullet_style" value="big_14 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_15 big_bullet"><input type="radio" name="bullet_style" value="big_15 big_bullets" /></label>\
					<label class="ps_bullet ps_bullet_big_16 big_bullet"><input type="radio" name="bullet_style" value="big_16 big_bullets" /></label>\
        </div>\
				</div></div>';
	
	//-------
	
	// creates the plugin
	tinymce.create('tinymce.plugins.bullets', {
		// creates control instances based on the control's id.
		// our button's id is "smartresponder_button"
		createControl : function(id, controlManager) {
			if (id == 'bullets_button') {
				// creates the button
				var button = controlManager.createButton('bullets_button', {
					title : 'Списки', // title of the button
					image : plugin_url+'/wppage/i/trial/bullet.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Вставить список', '#TB_inline?width=600&height=700&inlineId=bullets-form' );
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
	tinymce.PluginManager.add('bullets', tinymce.plugins.bullets);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#bullets_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'id'    : ''
				};
			
			var bullets_style = jQuery('input[name=bullet_style]:checked').val();
			
			
			var shortcode = '<ul class="ps_ul ps_bullet ps_bullet_'+bullets_style+'"><li>Список</li><li>Список</li></ul>';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()
