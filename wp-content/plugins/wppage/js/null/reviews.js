// closure to avoid namespace collision
(function(){
	//-------
	var html_form = '<div id="review-form">\
				<div class="popup_submit_wrap"><p class="wpp_message"><strong>Тестовый период wppage закончился. <a target="_blank" href="http://wppage.ru/buy" >Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a></strong> </p></div>\
				<div class="ps_review_form coach_box">\
				<div>\
					<label class="ps_review_box wppage_checkbox ps_review_1"><input type="radio" name="review_style" value="1" /></label>\
					<label class="ps_review_box wppage_checkbox ps_review_2"><input type="radio" name="review_style" value="2" /></label>\
					<label class="ps_review_box wppage_checkbox ps_review_3"><input type="radio" name="review_style" value="3" /></label>\
					<label class="ps_review_box wppage_checkbox ps_review_4"><input type="radio" name="review_style" value="4" /></label>\
					<label class="ps_review_box wppage_checkbox ps_review_5"><input type="radio" name="review_style" value="5" /></label>\
				</div>\
				</div></div>';
	
	//-------
	
	// creates the plugin
	tinymce.create('tinymce.plugins.review', {
		// creates control instances based on the control's id.
		// our button's id is "smartresponder_button"
		createControl : function(id, controlManager) {
			if (id == 'review_button') {
				// creates the button
				var button = controlManager.createButton('review_button', {
					title : 'Отзывы', // title of the button
					image : plugin_url+'/wppage/i/trial/review.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Отзывы', '#TB_inline?inlineId=review-form' );
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
	tinymce.PluginManager.add('review', tinymce.plugins.review);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#review_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'id'    : ''
				};
			var shortcode = '';
			var review_style = jQuery('input[name=review_style]:checked').val();

                shortcode = '<table class="wpp_review wpp_review_'+ review_style +'"><tr><td class="review_header"></td></tr>' +
                    '<tr><td class="review_text"><p>Текст</p></td></tr>' +
                    '<tr><td class="review_footer"></td></tr></table>';


			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()
