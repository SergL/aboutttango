// closure to avoid namespace collision
(function(){
	//-------
	var html_form = '<div id="header-form">\
				<div class="popup_submit_wrap"><p class="wpp_message"><strong>Тестовый период wppage закончился. <a target="_blank" href="http://wppage.ru/buy" >Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a></strong> </p></div>\
				<div class="wpp_header_form coach_box">\
				<div>\
					<label class="wpp_header wpp_header_1"><input type="radio" name="header" value="1" /></label>\
					<label class="wpp_header wpp_header_2"><input type="radio" name="header" value="2" /></label>\
					<label class="wpp_header wpp_header_3"><input type="radio" name="header" value="3" /></label>\
					<label class="wpp_header wpp_header_4"><input type="radio" name="header" value="4" /></label>\
					<label class="wpp_header wpp_header_5"><input type="radio" name="header" value="5" /></label>\
					<label class="wpp_header wpp_header_6"><input type="radio" name="header" value="6" /></label>\
					<label class="wpp_header wpp_header_7"><input type="radio" name="header" value="7" /></label>\
					<label class="wpp_header wpp_header_8"><input type="radio" name="header" value="8" /></label>\
					<label class="wpp_header wpp_header_9"><input type="radio" name="header" value="9" /></label>\
					<label class="wpp_header wpp_header_10"><input type="radio" name="header" value="10" /></label>\
					<label class="wpp_header wpp_header_11"><input type="radio" name="header" value="11" /></label>\
					<label class="wpp_header wpp_header_12"><input type="radio" name="header" value="12" /></label>\
					<label class="wpp_header wpp_header_13"><input type="radio" name="header" value="13" /></label>\
					<label class="wpp_header wpp_header_14"><input type="radio" name="header" value="14" /></label>\
					<label class="wpp_header wpp_header_15"><input type="radio" name="header" value="15" /></label>\
					<label class="wpp_header wpp_header_16"><input type="radio" name="header" value="16" /></label>\
					<label class="wpp_header wpp_header_17"><input type="radio" name="header" value="17" /></label>\
					<label class="wpp_header wpp_header_18"><input type="radio" name="header" value="18" /></label>\
					<label class="wpp_header wpp_header_19"><input type="radio" name="header" value="19" /></label>\
					<label class="wpp_header wpp_header_20"><input type="radio" name="header" value="20" /></label>\
					<label class="wpp_header wpp_header_21"><input type="radio" name="header" value="21" /></label>\
					<label class="wpp_header wpp_header_22"><input type="radio" name="header" value="22" /></label>\
					<label class="wpp_header wpp_header_23"><input type="radio" name="header" value="23" /></label>\
					<label class="wpp_header wpp_header_24"><input type="radio" name="header" value="24" /></label>\
					</div>\
				</div></div>';
	
	//-------
	
	// creates the plugin
	tinymce.create('tinymce.plugins.header', {
		// creates control instances based on the control's id.
		// our button's id is "smartresponder_button"
		createControl : function(id, controlManager) {
			if (id == 'header_button') {
				// creates the button
				var button = controlManager.createButton('header_button', {
					title : 'Заголовки', // title of the button
					image : plugin_url+'/wppage/i/trial/header.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Заголовки', '#TB_inline?width=600&height=400&inlineId=header-form' );
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
	tinymce.PluginManager.add('header', tinymce.plugins.header);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#header_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'id'    : ''
				};
			
			var header = jQuery('input[name=header]:checked').val();
			
			var shortcode = '<p style="text-align: center"><img class="aligncenter wpp_header" src="'+plugin_url+'/wppage/i/headers/'+header+'.png" alt="" /></p><p>&nbsp;</p>';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()
