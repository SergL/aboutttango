
(function(){
	
	//-------
	var html_form = '<div id="countdown-form">\
					<div class="popup_submit_wrap"><p class="wpp_message"><strong>Недоступно в пакете START. <a target="_blank" href="http://wppage.ru/wppage/obnovit-paket/" >Обновить пакет <span style="font-size:18px">→</span></a></strong> </p></div>\
					<div class="coach_form coach_box countdown_box">\
						<label><input type="text" name="wpp_date" id="wpp_date" value="" /> Дата</label><br><br>\
	<label><input type="text" id="c-hours" name="c-hours" /> Часы </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\
	<label><input type="text" id="c-minutes" name="c-minutes" /> Минуты </label><br><br>\
					<label class="ps_timer_image timer_image_1"><input type="radio" name="timer_image" value="1"></label>\
					<label class="ps_timer_image timer_image_2"><input type="radio" name="timer_image" value="2"></label>\
					<label class="ps_timer_image timer_image_3"><input type="radio" name="timer_image" value="3"></label>\
					<label class="ps_timer_image timer_image_4"><input type="radio" name="timer_image" value="4"></label>\
					<label class="ps_timer_image timer_image_5"><input type="radio" name="timer_image" value="5"></label>\
					<label class="ps_timer_image timer_image_6"><input type="radio" name="timer_image" value="6"></label>\
					</div>\
					</div>';
				
	//-------
	// creates the plugin
	tinymce.create('tinymce.plugins.coachcountdown', {
		// creates control instances based on the control's id.
		// our button's id is "audio_button"
		createControl : function(id, controlManager) {
			if (id == 'countdown_button') {
				// creates the button
				var button = controlManager.createButton('countdown_button', {
					title : 'Таймер обратного отсчета', // title of the button
					image : plugin_url+'/wppage/i/countdown.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Таймер обратного отсчета', '#TB_inline?inlineId=countdown-form' );
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
	tinymce.PluginManager.add('coachcountdown', tinymce.plugins.coachcountdown);
	
	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		
		var table = form.find('table');
		form.appendTo('body').hide();
		jQuery.datepicker.setDefaults(jQuery.datepicker.regional['ru']);
		jQuery("#wpp_date").datepicker({ dateFormat: "yy-mm-dd" });
		jQuery('#c-hours').timepicker({
			showMinutes: false,
    		showPeriod: false,
    		showPeriodLabels: false,
    		hourText: 'Часы',
			});
		jQuery('#c-minutes').timepicker({
			showMinutes: true,
			showHours: false,
    		showPeriod: false,
    		showPeriodLabels: false,
    		minuteText: 'Минуты',
			});
		
		// handles the click event of the submit button
		form.find('#countdown-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var c_date = jQuery('#wpp_date').val();
			var c_hours = jQuery('#c-hours').val()? jQuery('#c-hours').val() : '15';
			var c_minutes = jQuery('#c-minutes').val()? jQuery('#c-minutes').val(): '30' ;
            var c_image = jQuery('input[name=timer_image]:checked').val();
            var counter_image = '';
            if(c_image) {
               counter_image = '<img src="http://static.wppage.ru/wppage/i/timer/'+ c_image +'.png"><br>';
            }

			var shortcode = '<p class="aligncenter">'+ counter_image +'[wpp_countdown date='+ c_date +' hours='+ c_hours +' minutes='+ c_minutes +']</p>';

			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()