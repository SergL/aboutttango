// closure to avoid namespace collision
(function(){
	//-------
	var html_form = '<div id="arrows-form">\
				<p class="popup_submit_wrap"><span class="wpp_helper_box"><a class="" target="_blank" href="http://wppage.ru/wppage_lessons/arrows.mp4">Видео урок</a></span><input type="button" id="arrows_submit" class="button-primary" value="Вставить" name="submit" /></p>\
				<div class="ps_arrows_form coach_box"><br>\
				<div>\
					<label class="ps_arrows ps_arrows_1"><input type="radio" name="arrow" value="1" /></label>\
					<label class="ps_arrows ps_arrows_2"><input type="radio" name="arrow" value="2" /></label>\
					<label class="ps_arrows ps_arrows_3"><input type="radio" name="arrow" value="3" /></label>\
					<label class="ps_arrows ps_arrows_4"><input type="radio" name="arrow" value="4" /></label>\
					<label class="ps_arrows ps_arrows_5"><input type="radio" name="arrow" value="5" /></label>\
					<label class="ps_arrows ps_arrows_6"><input type="radio" name="arrow" value="6" /></label>\
					<label class="ps_arrows ps_arrows_7"><input type="radio" name="arrow" value="7" /></label>\
					<label class="ps_arrows ps_arrows_8"><input type="radio" name="arrow" value="8" /></label>\
					<label class="ps_arrows ps_arrows_9"><input type="radio" name="arrow" value="9" /></label>\
					<label class="ps_arrows ps_arrows_10"><input type="radio" name="arrow" value="10" /></label>\
					<label class="ps_arrows ps_arrows_11"><input type="radio" name="arrow" value="11" /></label>\
					<label class="ps_arrows ps_arrows_12"><input type="radio" name="arrow" value="12" /></label>\
					<label class="ps_arrows ps_arrows_13"><input type="radio" name="arrow" value="13" /></label>\
					<label class="ps_arrows ps_arrows_14"><input type="radio" name="arrow" value="14" /></label>\
					<label class="ps_arrows ps_arrows_15"><input type="radio" name="arrow" value="15" /></label>\
					<label class="ps_arrows ps_arrows_16"><input type="radio" name="arrow" value="16" /></label>\
					<label class="ps_arrows ps_arrows_17"><input type="radio" name="arrow" value="17" /></label>\
					<label class="ps_arrows ps_arrows_18"><input type="radio" name="arrow" value="18" /></label>\
					<label class="ps_arrows ps_arrows_19"><input type="radio" name="arrow" value="19" /></label>\
					<label class="ps_arrows ps_arrows_20"><input type="radio" name="arrow" value="20" /></label>\
					<label class="ps_arrows ps_arrows_21"><input type="radio" name="arrow" value="21" /></label>\
					<label class="ps_arrows ps_arrows_22"><input type="radio" name="arrow" value="22" /></label>\
					<label class="ps_arrows ps_arrows_23"><input type="radio" name="arrow" value="23" /></label>\
					<label class="ps_arrows ps_arrows_24"><input type="radio" name="arrow" value="24" /></label>\
					<label class="ps_arrows ps_arrows_25"><input type="radio" name="arrow" value="25" /></label>\
					<label class="ps_arrows ps_arrows_26"><input type="radio" name="arrow" value="26" /></label>\
					<label class="ps_arrows ps_arrows_27"><input type="radio" name="arrow" value="27" /></label>\
					<label class="ps_arrows ps_arrows_28"><input type="radio" name="arrow" value="28" /></label>\
					<label class="ps_arrows ps_arrows_29"><input type="radio" name="arrow" value="29" /></label>\
					<label class="ps_arrows ps_arrows_30"><input type="radio" name="arrow" value="30" /></label>\
					<label class="ps_arrows ps_arrows_31"><input type="radio" name="arrow" class="gif" value="31" /></label>\
					<label class="ps_arrows ps_arrows_32"><input type="radio" name="arrow" class="gif" value="32" /></label>\
					<label class="ps_arrows ps_arrows_33"><input type="radio" name="arrow" class="gif" value="33" /></label>\
					<label class="ps_arrows ps_arrows_34"><input type="radio" name="arrow" value="34" /></label>\
					<label class="ps_arrows ps_arrows_35"><input type="radio" name="arrow" value="35" /></label>\
					<label class="ps_arrows ps_arrows_36"><input type="radio" name="arrow" value="36" /></label>\
					<label class="ps_arrows ps_arrows_37"><input type="radio" name="arrow" value="37" /></label>\
					<label class="ps_arrows ps_arrows_38"><input type="radio" name="arrow" value="38" /></label>\
					<label class="ps_arrows ps_arrows_39"><input type="radio" name="arrow" value="39" /></label>\
					<label class="ps_arrows ps_arrows_40"><input type="radio" name="arrow" value="40" /></label>\
					<label class="ps_arrows ps_arrows_41"><input type="radio" name="arrow" value="41" /></label>\
					<label class="ps_arrows ps_arrows_42"><input type="radio" name="arrow" value="42" /></label>\
					<label class="ps_arrows ps_arrows_43"><input type="radio" name="arrow" value="43" /></label>\
					<label class="ps_arrows ps_arrows_44"><input type="radio" name="arrow" value="44" /></label>\
					<label class="ps_arrows ps_arrows_45"><input type="radio" name="arrow" value="45" /></label>\
					<label class="ps_arrows ps_arrows_46"><input type="radio" name="arrow" value="46" /></label>\
					<label class="ps_arrows ps_arrows_47"><input type="radio" name="arrow" value="47" /></label>\
					<label class="ps_arrows ps_arrows_48"><input type="radio" name="arrow" value="48" /></label>\
					<label class="ps_arrows ps_arrows_49"><input type="radio" name="arrow" value="49" /></label>\
					<label class="ps_arrows ps_arrows_50"><input type="radio" name="arrow" value="50" /></label>\
					<label class="ps_arrows ps_arrows_51"><input type="radio" name="arrow" value="51" /></label>\
					<label class="ps_arrows ps_arrows_52"><input type="radio" name="arrow" value="52" /></label>\
					<label class="ps_arrows ps_arrows_53"><input type="radio" name="arrow" value="53" /></label>\
					<label class="ps_arrows ps_arrows_54"><input type="radio" name="arrow" value="54" /></label>\
					<label class="ps_arrows ps_arrows_55"><input type="radio" name="arrow" value="55" /></label>\
					<label class="ps_arrows ps_arrows_56"><input type="radio" name="arrow" value="56" /></label>\
					<label class="ps_arrows ps_arrows_57"><input type="radio" name="arrow" value="57" /></label>\
					<label class="ps_arrows ps_arrows_58"><input type="radio" name="arrow" value="58" /></label>\
					<label class="ps_arrows ps_arrows_59"><input type="radio" name="arrow" value="59" /></label>\
					<label class="ps_arrows ps_arrows_60"><input type="radio" name="arrow" value="60" /></label>\
					<label class="ps_arrows ps_arrows_61"><input type="radio" name="arrow" value="61" /></label>\
					<label class="ps_arrows ps_arrows_62"><input type="radio" name="arrow" value="62" /></label>\
					<label class="ps_arrows ps_arrows_63"><input type="radio" name="arrow" value="63" /></label>\
					<label class="ps_arrows ps_arrows_64"><input type="radio" name="arrow" value="64" /></label>\
					<label class="ps_arrows ps_arrows_65"><input type="radio" name="arrow" value="65" /></label>\
				</div>\
				</div>\
				</div>';
	
	//-------
	
	// creates the plugin
	tinymce.create('tinymce.plugins.arrows', {
		// creates control instances based on the control's id.
		// our button's id is "smartresponder_button"
		createControl : function(id, controlManager) {
			if (id == 'arrows_button') {
				// creates the button
				var button = controlManager.createButton('arrows_button', {
					title : 'Стрелки', // title of the button
					image : plugin_url+'/wppage/i/arrows.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Стрелки', '#TB_inline?width=600&height=400&inlineId=arrows-form' );
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
	tinymce.PluginManager.add('arrows', tinymce.plugins.arrows);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#arrows_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'id'    : ''
				};
			var extention = '.png';
			var arrow = jQuery('input[name=arrow]:checked');
			var arrow_name = arrow.val();
			if(arrow.hasClass('gif')){
				extention = '.gif';
			}
			
			var shortcode = '<p class="aligncenter"><img class="aligncenter ps_arrow" src="http://static.wppage.ru/wppage/i/arrows/'+arrow_name+extention+'" alt="" /></p>';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()
