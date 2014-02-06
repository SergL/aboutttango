// closure to avoid namespace collision
(function(){
	//-------
	var html_form = '<div id="product-form">\
				<p class="popup_submit_wrap"><span class="wpp_helper_box"><a onclick="open_win(\'http://www.youtube.com/watch?v=FpudLpZygxQ&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=6\')">Видео урок</a></span><input type="button" id="product-submit" class="button-primary" value="Вставить кнопку заказа" name="submit" /></p>\
				<div class="ps_product_form coach_box">\
				<ul class="wpp_buy_button_type">\
				<li><label class="wppage_checkbox wppage_checked"><input type="radio" name="type" class="type" value="external" checked="checked" />Своя ссылка</label></li>\
				<li><label class="wppage_checkbox"><input type="radio" name="type" class="type" value="interkasa"/>Интеркасса</label></li></ul>\
				<br>\
				<div class="wppage-product-link-options-box">\
				<label>Ссылка<br>\
				<input type="text" name="external_url" id="external_url" value="" class="width_100p" /></label><br>\
				<br>\
				<ul class="wppage-product-link-options">\
				<li><label class="wppage_checkbox wppage_checked"><input type="radio" name="link-type" class="link-type" value="_self" checked="checked">Открывать в текущей вкладке</label></li>\
				<li><label class="wppage_checkbox"><input type="radio" name="link-type" class="link-type" value="_blank">Открывать на новой вкладке</label></li></ul>\
				</div>\
				<br>\
					<br>\
					<ul class="wpp_buttons_sizes">\
					<li><label class="wppage_checkbox  wppage_checked"><input type="radio" name="wpp_button_size" value="big" checked="checked">Большая</label></li>\
					<li><label class="wppage_checkbox"><input type="radio" name="wpp_button_size" value="medium">Средняя</label></li>\
					<li><label class="wppage_checkbox"><input type="radio" name="wpp_button_size" value="small">Маленькая</label></li>\
					</ul>\
					<br>\
					<div class="buttons_style">\
					<label class="p_cbutton ps_p_button_1 wppage_checked"><input type="radio" name="button_style" value="1" checked="checked" /></label>\
					<label class="p_cbutton ps_p_button_2"><input type="radio" name="button_style" value="2" /></label>\
					<label class="p_cbutton ps_p_button_3"><input type="radio" name="button_style" value="3" /></label>\
					<label class="p_cbutton ps_p_button_4"><input type="radio" name="button_style" value="4" /></label>\
					<label class="p_cbutton ps_p_button_5"><input type="radio" name="button_style" value="5" /></label>\
					<label class="p_cbutton ps_p_button_6"><input type="radio" name="button_style" value="6" /></label>\
					<label class="p_cbutton ps_p_button_7"><input type="radio" name="button_style" value="7" /></label>\
					<label class="p_cbutton ps_p_button_8"><input type="radio" name="button_style" value="8" /></label>\
					<label class="p_cbutton ps_p_button_9"><input type="radio" name="button_style" value="9" /></label>\
					<label class="p_cbutton ps_p_button_10"><input type="radio" name="button_style" value="10" /></label>\
					<label class="p_cbutton ps_p_button_11"><input type="radio" name="button_style" value="11" /></label>\
					<label class="p_cbutton ps_p_button_12"><input type="radio" name="button_style" value="12" /></label>\
					<label class="p_cbutton ps_p_button_13"><input type="radio" name="button_style" value="13" /></label>\
					<label class="p_cbutton ps_p_button_14"><input type="radio" name="button_style" value="14" /></label>\
					<label class="p_cbutton ps_p_button_15"><input type="radio" name="button_style" value="15" /></label>\
					<label class="p_cbutton ps_p_button_16"><input type="radio" name="button_style" value="16" /></label>\
					<label class="p_cbutton ps_p_button_17"><input type="radio" name="button_style" value="17" /></label>\
					<label class="p_cbutton ps_p_button_18"><input type="radio" name="button_style" value="18" /></label>\
					<label class="p_cbutton ps_p_button_19"><input type="radio" name="button_style" value="19" /></label>\
					<label class="p_cbutton ps_p_button_20"><input type="radio" name="button_style" value="20" /></label>\
					<label class="p_cbutton ps_p_button_21"><input type="radio" name="button_style" value="21" /></label>\
					<label class="p_cbutton ps_p_button_22"><input type="radio" name="button_style" value="22" /></label>\
					<label class="p_cbutton ps_p_button_23"><input type="radio" name="button_style" value="23" /></label>\
					<label class="p_cbutton ps_p_button_24"><input type="radio" name="button_style" value="24" /></label>\
					<label class="p_cbutton ps_p_button_25"><input type="radio" name="button_style" value="25" /></label>\
					<label class="p_cbutton ps_p_button_26"><input type="radio" name="button_style" value="26" /></label>\
					<label class="p_cbutton ps_p_button_27"><input type="radio" name="button_style" value="27" /></label>\
					<label class="p_cbutton ps_p_button_28"><input type="radio" name="button_style" value="28" /></label>\
					<label class="p_cbutton ps_p_button_29"><input type="radio" name="button_style" value="29" /></label>\
					<label class="p_cbutton ps_p_button_30"><input type="radio" name="button_style" value="30" /></label>\
					<label class="p_cbutton ps_p_button_31"><input type="radio" name="button_style" value="31" /></label>\
					<label class="p_cbutton ps_p_button_32"><input type="radio" name="button_style" value="32" /></label>\
					<label class="p_cbutton ps_p_button_33"><input type="radio" name="button_style" value="33" /></label>\
					<label class="p_cbutton ps_p_button_34"><input type="radio" name="button_style" value="34" /></label>\
					<label class="p_cbutton ps_p_button_35"><input type="radio" name="button_style" value="35" /></label>\
					<label class="p_cbutton ps_p_button_36"><input type="radio" name="button_style" value="36" /></label>\
					<label class="p_cbutton ps_p_button_37"><input type="radio" name="button_style" value="37" /></label>\
					<label class="p_cbutton ps_p_button_38"><input type="radio" name="button_style" value="38" /></label>\
					<label class="p_cbutton ps_p_button_39"><input type="radio" name="button_style" value="39" /></label>\
					<label class="p_cbutton ps_p_button_40"><input type="radio" name="button_style" value="40" /></label>\
					<label class="p_cbutton ps_p_button_41"><input type="radio" name="button_style" value="41" /></label>\
					<label class="p_cbutton ps_p_button_42"><input type="radio" name="button_style" value="42" /></label>\
					<label class="p_cbutton ps_p_button_43"><input type="radio" name="button_style" value="43" /></label>\
					<label class="p_cbutton ps_p_button_44"><input type="radio" name="button_style" value="44" /></label>\
					<label class="p_cbutton ps_p_button_45"><input type="radio" name="button_style" value="45" /></label>\
					<label class="p_cbutton ps_p_button_46"><input type="radio" name="button_style" value="46" /></label>\
					<label class="p_cbutton ps_p_button_47"><input type="radio" name="button_style" value="47" /></label>\
					<label class="p_cbutton ps_p_button_48"><input type="radio" name="button_style" value="48" /></label>\
					<label class="p_cbutton ps_p_button_49"><input type="radio" name="button_style" value="49" /></label>\
					<label class="p_cbutton ps_p_button_50"><input type="radio" name="button_style" value="50" /></label>\
					<label class="p_cbutton ps_p_button_51"><input type="radio" name="button_style" value="51" /></label>\
					<label class="p_cbutton ps_p_button_52"><input type="radio" name="button_style" value="52" /></label>\
					<label class="p_cbutton ps_p_button_53"><input type="radio" name="button_style" value="53" /></label>\
					<label class="p_cbutton ps_p_button_54"><input type="radio" name="button_style" value="54" /></label>\
					<label class="p_cbutton ps_p_button_55"><input type="radio" name="button_style" value="55" /></label>\
					<label class="p_cbutton ps_p_button_56"><input type="radio" name="button_style" value="56" /></label>\
					<label class="p_cbutton ps_p_button_57"><input type="radio" name="button_style" value="57" /></label>\
					<label class="p_cbutton ps_p_button_58"><input type="radio" name="button_style" value="58" /></label>\
					<label class="p_cbutton ps_p_button_59"><input type="radio" name="button_style" value="59" /></label>\
					<label class="p_cbutton ps_p_button_60"><input type="radio" name="button_style" value="60" /></label>\
					<label class="p_cbutton ps_p_button_61"><input type="radio" name="button_style" value="61" /></label>\
					<label class="p_cbutton ps_p_button_62"><input type="radio" name="button_style" value="62" /></label>\
					<label class="p_cbutton ps_p_button_63"><input type="radio" name="button_style" value="63" /></label>\
					<label class="p_cbutton ps_p_button_64"><input type="radio" name="button_style" value="64" /></label>\
					<label class="p_cbutton ps_p_button_65"><input type="radio" name="button_style" value="65" /></label>\
					<label class="p_cbutton ps_p_button_66"><input type="radio" name="button_style" value="66" /></label>\
					<label class="p_cbutton ps_p_button_67"><input type="radio" name="button_style" value="67" /></label>\
					<label class="p_cbutton ps_p_button_68"><input type="radio" name="button_style" value="68" /></label>\
					<label class="p_cbutton ps_p_button_69"><input type="radio" name="button_style" value="69" /></label>\
					<label class="p_cbutton ps_p_button_70"><input type="radio" name="button_style" value="70" /></label>\
					<label class="p_cbutton ps_p_button_71"><input type="radio" name="button_style" value="71" /></label>\
					<label class="p_cbutton ps_p_button_72"><input type="radio" name="button_style" value="72" /></label>\
					<label class="p_cbutton ps_p_button_73"><input type="radio" name="button_style" value="73" /></label>\
					<label class="p_cbutton ps_p_button_74"><input type="radio" name="button_style" value="74" /></label>\
					<label class="p_cbutton ps_p_button_75"><input type="radio" name="button_style" value="75" /></label>\
					<label class="p_cbutton ps_p_button_76"><input type="radio" name="button_style" value="76" /></label>\
					<label class="p_cbutton ps_p_button_77"><input type="radio" name="button_style" value="77" /></label>\
					</div>\
				</div></div>';
	
	//-------
	
	// creates the plugin
	tinymce.create('tinymce.plugins.product', {
		// creates control instances based on the control's id.
		// our button's id is "smartresponder_button"
		createControl : function(id, controlManager) {
			if (id == 'product_button') {
				// creates the button
				var button = controlManager.createButton('product_button', {
					title : 'Продукты', // title of the button
					image : plugin_url+'/wppage/i/product.png',  // path to the button's image
					onclick : function() {
						// triggers the thickbox
						tb_show( 'Вставить продукт', '#TB_inline?width=600&height=700&inlineId=product-form' );
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
	tinymce.PluginManager.add('product', tinymce.plugins.product);
	
	// executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery(html_form);
		jQuery('input.type').live('change', function(){
			var type_s = jQuery('input.type:checked').val();
			if( type_s == 'interkasa') {
				jQuery('.wppage-product-link-options-box').css({'display': 'none'});
				
				}
			else {
				jQuery('.wppage-product-link-options-box').css({'display': 'block'});
				}
			});
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#product-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'id'    : ''
				};
			var url = '';
			var shortcode = '';
			var type = jQuery('input.type:checked').val();
			var button_style = jQuery('input[name=button_style]:checked').val();
            var button_size = jQuery('input[name=wpp_button_size]:checked').val();
            var link_type = jQuery('input[name=link-type]:checked').val();
            if(button_size == undefined || button_style == undefined || type == undefined){
                alert('Виберите размер, вид кнопки');
                return false;
            }

            if( type == 'interkasa') {
				url = '#order_popup';
				}
			else {
				url = jQuery('#external_url').val();
				}
			
			if(type == 'interkasa'){
				shortcode = '<p class="aligncenter"><input type="button" class="product_cbutton ps_make_order ps_product_button_'+ button_size +'_'+button_style+'" value="" /></p><br>'
			}else{
				shortcode = '<p class="aligncenter"><input type="button" formtarget="'+ link_type +'" class="product_cbutton ps_external_make_order ps_product_button_'+ button_size +'_'+button_style+'" alt="'+url+'"/></p><br>'
				
				}
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})()
