// closure to avoid namespace collision
(function(){
	//-------
	var html_form = '<div id="satisfaction-form">\
				<p class="popup_submit_wrap"><span class="wpp_helper_box"><a onclick="open_win(\'http://www.youtube.com/watch?v=r2m4_ifhKSY&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=11\')">Видео урок</a></span><input type="button" id="satisfaction_submit" class="button-primary" value="Вставить" name="submit" /></p>\
				<div class="ps_satisfaction_form coach_box">\
				<div>\
					<label class="ps_satisfaction ps_satisfaction_1"><input type="radio" name="satisfaction" value="1" /></label>\
					<label class="ps_satisfaction ps_satisfaction_2"><input type="radio" name="satisfaction" value="2" /></label>\
					<label class="ps_satisfaction ps_satisfaction_3"><input type="radio" name="satisfaction" value="3" /></label>\
					<label class="ps_satisfaction ps_satisfaction_4"><input type="radio" name="satisfaction" value="4" /></label>\
					<label class="ps_satisfaction ps_satisfaction_5"><input type="radio" name="satisfaction" value="5" /></label>\
					<label class="ps_satisfaction ps_satisfaction_6"><input type="radio" name="satisfaction" value="6" /></label>\
					<label class="ps_satisfaction ps_satisfaction_7"><input type="radio" name="satisfaction" value="7" /></label>\
					<label class="ps_satisfaction ps_satisfaction_8"><input type="radio" name="satisfaction" value="8" /></label>\
					<label class="ps_satisfaction ps_satisfaction_9"><input type="radio" name="satisfaction" value="9" /></label>\
					<label class="ps_satisfaction ps_satisfaction_10"><input type="radio" name="satisfaction" value="10" /></label>\
					<label class="ps_satisfaction ps_satisfaction_11"><input type="radio" name="satisfaction" value="11" /></label>\
					<label class="ps_satisfaction ps_satisfaction_12"><input type="radio" name="satisfaction" value="12" /></label>\
					<label class="ps_satisfaction ps_satisfaction_13"><input type="radio" name="satisfaction" value="13" /></label>\
					<label class="ps_satisfaction ps_satisfaction_14"><input type="radio" name="satisfaction" value="14" /></label>\
					<label class="ps_satisfaction ps_satisfaction_15"><input type="radio" name="satisfaction" value="15" /></label>\
					<label class="ps_satisfaction ps_satisfaction_16"><input type="radio" name="satisfaction" value="16" /></label>\
					<label class="ps_satisfaction ps_satisfaction_17"><input type="radio" name="satisfaction" value="17" /></label>\
					<label class="ps_satisfaction ps_satisfaction_18"><input type="radio" name="satisfaction" value="18" /></label>\
					<label class="ps_satisfaction ps_satisfaction_19"><input type="radio" name="satisfaction" value="19" /></label>\
					<label class="ps_satisfaction ps_satisfaction_20"><input type="radio" name="satisfaction" value="20" /></label>\
					<label class="ps_satisfaction ps_satisfaction_21"><input type="radio" name="satisfaction" value="21" /></label>\
					<label class="ps_satisfaction ps_satisfaction_22"><input type="radio" name="satisfaction" value="22" /></label>\
					<label class="ps_satisfaction ps_satisfaction_23"><input type="radio" name="satisfaction" value="23" /></label>\
					<label class="ps_satisfaction ps_satisfaction_24"><input type="radio" name="satisfaction" value="24" /></label>\
					<label class="ps_satisfaction ps_satisfaction_25"><input type="radio" name="satisfaction" value="25" /></label>\
					<label class="ps_satisfaction ps_satisfaction_26"><input type="radio" name="satisfaction" value="26" /></label>\
					<label class="ps_satisfaction ps_satisfaction_27"><input type="radio" name="satisfaction" value="27" /></label>\
					<label class="ps_satisfaction ps_satisfaction_28"><input type="radio" name="satisfaction" value="28" /></label>\
					<label class="ps_satisfaction ps_satisfaction_29"><input type="radio" name="satisfaction" value="29" /></label>\
					<label class="ps_satisfaction ps_satisfaction_30"><input type="radio" name="satisfaction" value="30" /></label>\
					<label class="ps_satisfaction ps_satisfaction_31"><input type="radio" name="satisfaction" value="31" /></label>\
					<label class="ps_satisfaction ps_satisfaction_32"><input type="radio" name="satisfaction" value="32" /></label>\
					<label class="ps_satisfaction ps_satisfaction_33"><input type="radio" name="satisfaction" value="33" /></label>\
					<label class="ps_satisfaction ps_satisfaction_34"><input type="radio" name="satisfaction" value="34" /></label>\
					<label class="ps_satisfaction ps_satisfaction_35"><input type="radio" name="satisfaction" value="35" /></label>\
				</div>\
				</div></div>';
	
	//-------
	
	// creates the plugin
	tinymce.create('tinymce.plugins.satisfaction', {
		// creates control instances based on the control's id.
		// our button's id is "smartresponder_button"
		createControl : function(id, controlManager) {
			if (id == 'satisfaction_button') {
				// creates the button
				var button = controlManager.createButton('satisfaction_button', {
					title : 'Гарантии', // title of the button
					image : plugin_url+'/wppage/i/satisfaction.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Гарантии', '#TB_inline?width=600&height=400&inlineId=satisfaction-form' );
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
	tinymce.PluginManager.add('satisfaction', tinymce.plugins.satisfaction);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#satisfaction_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'id'    : ''
				};
			
			var satisfaction = jQuery('input[name=satisfaction]:checked').val()
			
			var shortcode = '<p><img class="aligncenter ps_satisfaction" src="http://static.wppage.ru/wppage/i/satisfaction/'+satisfaction+'.png" alt="" /></p>';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()
