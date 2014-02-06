<?php
/**
 * Theme Options - fields and args
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */

require_once( dirname( __FILE__ ) . '/fonts.php' );
require_once( dirname( __FILE__ ) . '/options.php' );


/**
 * Options Page fields and args
 */
function mfn_opts_setup(){
	
	// Navigation elements
	$menu = array(	
	
		// General --------------------------------------------
		'general' => array(
			'title' => __('Getting started', 'mfn-opts'),
			'icon' => MFN_OPTIONS_URI. 'img/icons/general.png',
			'sections' => array( 'general', 'sidebars', 'blog', 'portfolio', 'slider'),
		),
		
		// Layout --------------------------------------------
		'elements' => array(
			'title' => __('Layout', 'mfn-opts'),
			'icon' => MFN_OPTIONS_URI. 'img/icons/elements.png',
			'sections' => array( 'layout-general', 'layout-header', 'social', 'custom-css' ),
		),
		
		// Colors --------------------------------------------
		'colors' => array(
			'title' => __('Colors', 'mfn-opts'),
			'icon' => MFN_OPTIONS_URI. 'img/icons/colors.png',
			'sections' => array( 'colors-general', 'boxes', 'menu', 'colors-header', 'content', 'colors-footer', 'colors-blog', 'headings', 'colors-shortcodes', 'colors-widgets'),
		),
		
		// Fonts --------------------------------------------
		'font' => array(
			'title' => __('Fonts', 'mfn-opts'),
			'icon' => MFN_OPTIONS_URI. 'img/icons/font.png',
			'sections' => array( 'font-family', 'font-size' ),
		),
		
		// Translate --------------------------------------------
		'translate' => array(
			'title' => __('Translate', 'mfn-opts'),
			'icon' => MFN_OPTIONS_URI. 'img/icons/translate.png',
			'sections' => array( 'translate-general', 'translate-blog', 'translate-contact', 'translate-404' ),
		),
		
	);

	$sections = array();

	// General ----------------------------------------------------------------------------------------
	
	// General -------------------------------------------
	$sections['general'] = array(
		'title' => __('General', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
				
			array(
				'id' => 'responsive',
				'type' => 'switch',
				'title' => __('Responsive', 'mfn-opts'), 
				'desc' => __('<b>Notice:</b> Responsive menu is working only with WordPress custom menu, please add one in Appearance > Menus and select it for Theme Locations section. <a href="http://en.support.wordpress.com/menus/" target="_blank">http://en.support.wordpress.com/menus/</a>', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'mfn-seo',
				'type' => 'switch',
				'title' => __('Use built-in SEO fields', 'mfn-opts'), 
				'desc' => __('Turn it off if you want to use external SEO plugin.', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'meta-description',
				'type' => 'text',
				'title' => __('Meta Description', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts & pages.', 'mfn-opts'),
				'std' => get_bloginfo( 'description' ),
			),
			
			array(
				'id' => 'meta-keywords',
				'type' => 'text',
				'title' => __('Meta Keywords', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts & pages.', 'mfn-opts'),
			),
			
			array(
				'id' => 'google-analytics',
				'type' => 'textarea',
				'title' => __('Google Analytics', 'mfn-opts'), 
				'sub_desc' => __('Paste your Google Analytics code here.', 'mfn-opts'),
			),
			
		),
	);
	
	// Sidebars --------------------------------------------
	$sections['sidebars'] = array(
		'title' => __('Sidebars', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'sidebar-layout',
				'type' => 'radio_img',
				'title' => __('Default Layout', 'mfn-opts'), 
				'sub_desc' => __('Default post or page sidebar', 'mfn-opts'),
				'options' => array(
					'no-sidebar' => array('title' => 'Full width without sidebar', 'img' => MFN_OPTIONS_URI.'img/1col.png'),
					'left-sidebar' => array('title' => 'Left Sidebar', 'img' => MFN_OPTIONS_URI.'img/2cl.png'),
					'right-sidebar' => array('title' => 'Right Sidebar', 'img' => MFN_OPTIONS_URI.'img/2cr.png')
				),
				'std' => '2'																		
			),
	
			array(
				'id' => 'sidebars',
				'type' => 'multi_text',
				'title' => __('Sidebars', 'mfn-opts'),
				'sub_desc' => __('Manage custom sidebars', 'mfn-opts'),
				'desc' => __('Sidebars can be used on pages, blog and portfolio', 'mfn-opts')
			),
				
		),
	);
	
	// Blog --------------------------------------------
	$sections['blog'] = array(
		'title' => __('Blog', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'blog-posts',
				'type' => 'text',
				'title' => __('Posts per page', 'mfn-opts'),
				'sub_desc' => __('Number of posts per page.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '5',
			),
			
			array(
				'id' => 'blog-categories',
				'type' => 'switch',
				'title' => __('Show Categories', 'mfn-opts'), 
				'sub_desc' => __('Show categories on single post.', 'mfn-opts'), 
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'blog-comments',
				'type' => 'switch',
				'title' => __('Show Comments', 'mfn-opts'), 
				'sub_desc' => __('Show comments number on posts list and single post.', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'blog-time',
				'type' => 'switch',
				'title' => __('Show Date', 'mfn-opts'), 
				'sub_desc' => __('Show date on posts list and single post.', 'mfn-opts'), 
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'), 
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'blog-tags',
				'type' => 'switch',
				'title' => __('Show Tags', 'mfn-opts'), 
				'sub_desc' => __('Show tags list on posts list and single post.', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'),  
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'blog-social',
				'type' => 'switch',
				'title' => __('Social network sharing', 'mfn-opts'), 
				'sub_desc' => __('Show social network sharing on single post.', 'mfn-opts'),
				'desc' => __('These setting may be overridden for single posts.', 'mfn-opts'),  
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'blog-readmore',
				'type' => 'text',
				'title' => __('Read more', 'mfn-opts'),
				'sub_desc' => __('Read more button text.', 'mfn-opts'),
				'desc' => __('Leave blank if you don`t want the buttons on blog page.', 'mfn-opts'),
				'std' => 'Read more',
			),
			
			array(
				'id' => 'pagination-show-all',
				'type' => 'switch',
				'title' => __('All pages in pagination', 'mfn-opts'),
				'desc' => __('Show all of the pages instead of a short list of the pages near the current page.', 'mfn-opts'),  
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
				
		),
	);
	
	// Portfolio --------------------------------------------
	$sections['portfolio'] = array(
		'title' => __('Portfolio', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'portfolio-posts',
				'type' => 'text',
				'title' => __('Posts per page', 'mfn-opts'),
				'sub_desc' => __('Number of portfolio posts per page.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '6',
			),
			
			array(
				'id' => 'portfolio-layout',
				'type' => 'radio_img',
				'title' => __('Layout', 'mfn-opts'), 
				'sub_desc' => __('Layout for portfolio items list.', 'mfn-opts'),
				'options' => array(
					'one-second' => array('title' => 'Two columns', 'img' => MFN_OPTIONS_URI.'img/one-second.png'),
					'one-third' => array('title' => 'Three columns', 'img' => MFN_OPTIONS_URI.'img/one-third.png'),
					'one-fourth' => array('title' => 'Four columns', 'img' => MFN_OPTIONS_URI.'img/one-fourth.png'),
				),
				'std' => 'one-fourth'																		
			),
			
			array(
				'id' => 'portfolio-page',
				'type' => 'pages_select',
				'title' => __('Portfolio Page', 'mfn-opts'), 
				'sub_desc' => __('Assign page for portfolio.', 'mfn-opts'),
				'args' => array()
			),
			
			array(
				'id' => 'portfolio-slug',
				'type' => 'text',
				'title' => __('Single item slug', 'mfn-opts'),
				'sub_desc' => __('Link to single item.', 'mfn-opts'),
				'desc' => __('<b>Important:</b> Do not use characters not allowed in links. <br /><br />Must be different from the Portfolio site title chosen above, eg. "portfolio-item". After change please go to "Settings > Permalinks" and click "Save changes" button.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => 'portfolio-item',
			),
			
			array(
				'id' => 'portfolio-orderby',
				'type' => 'select',
				'title' => __('Order by', 'mfn-opts'), 
				'sub_desc' => __('Portfolio items order by column.', 'mfn-opts'),
				'options' => array('date'=>'Date', 'menu_order' => 'Menu order', 'title'=>'Title'),
				'std' => 'menu_order'
			),
			
			array(
				'id' => 'portfolio-order',
				'type' => 'select',
				'title' => __('Order', 'mfn-opts'), 
				'sub_desc' => __('Portfolio items order.', 'mfn-opts'),
				'options' => array('ASC' => 'Ascending', 'DESC' => 'Descending'),
				'std' => 'ASC'
			),
			
			array(
				'id' => 'portfolio-isotope',
				'type' => 'switch',
				'title' => __('jQuery filtering', 'mfn-opts'),
				'desc' => __('When this option is enabled, portfolio looks great with all projects on single site, so please set "Posts per page" option to bigger number', 'mfn-opts'),  
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
				
		),
	);
	
	// Slider --------------------------------------------
	$sections['slider'] = array(
		'title' => __('Sliders', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
				
			array(
				'id' => 'slider-posts-auto',
				'type' => 'text',
				'title' => __('Latest Posts - Timeout', 'mfn-opts'),
				'sub_desc' => __('Milliseconds between slide transitions.', 'mfn-opts'),
				'desc' => __('<strong>0 to disable auto</strong> advance.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '0',
			),
			
			array(
				'id' => 'slider-offer-auto',
				'type' => 'text',
				'title' => __('What we offer - Timeout', 'mfn-opts'),
				'sub_desc' => __('Milliseconds between slide transitions.', 'mfn-opts'),
				'desc' => __('<strong>0 to disable auto</strong> advance.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '0',
			),
			
			array(
				'id' => 'slider-offer-visible',
				'type' => 'text',
				'title' => __('What we offer - Visible Items', 'mfn-opts'),
				'sub_desc' => __('Number of visible items.', 'mfn-opts'),
				'desc' => __('Recommended number: 2-4', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '3',
			),
			
			array(
				'id' => 'slider-clients-auto',
				'type' => 'text',
				'title' => __('Clients - Timeout', 'mfn-opts'),
				'sub_desc' => __('Milliseconds between slide transitions.', 'mfn-opts'),
				'desc' => __('<strong>0 to disable auto</strong> advance.', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '0',
			),
			
			array(
				'id' => 'slider-clients-visible',
				'type' => 'text',
				'title' => __('Clients - Visible Items', 'mfn-opts'),
				'sub_desc' => __('Number of visible items.', 'mfn-opts'),
				'desc' => __('Recommended number: 3-6', 'mfn-opts'),
				'class' => 'small-text',
				'std' => '5',
			),
								
		),
	);
	
	// Layout ----------------------------------------------------------------------------------------
	
	// General --------------------------------------------
	$sections['layout-general'] = array(
		'title' => __('General', 'mfn-opts'),
		'fields' => array(
				
			array(
				'id' => 'layout',
				'type' => 'radio_img',
				'title' => __('Layout', 'mfn-opts'),
				'sub_desc' => __('Layout type', 'mfn-opts'),
				'options' => array(
					'boxed' => array('title' => 'Boxed', 'img' => MFN_OPTIONS_URI.'img/boxed.png'),
					'full-width' => array('title' => 'Full width', 'img' => MFN_OPTIONS_URI.'img/1col.png'),
				),
				'std' => 'boxed'
			),
				
			array(
				'id' => 'overlay',
				'type' => 'radio_img',
				'title' => __('Body Overlay', 'mfn-opts'),
				'sub_desc' => __('Boxed Layout Body Overlay', 'mfn-opts'),
				'desc' => __('This option can be used <strong>only</strong> with Layout: Boxed.<br />Please note that not every overlay is transparent.', 'mfn-opts'),
				'options' => array(
					0 => array('title' => 'Without Overlay', 'img' => MFN_OPTIONS_URI.'img/overlays/0.png'),
					1 => array('title' => '1', 'img' => MFN_OPTIONS_URI.'img/overlays/1.png'),
					2 => array('title' => '2', 'img' => MFN_OPTIONS_URI.'img/overlays/2.png'),
					3 => array('title' => '3', 'img' => MFN_OPTIONS_URI.'img/overlays/3.png'),
					4 => array('title' => '4', 'img' => MFN_OPTIONS_URI.'img/overlays/4.png'),
					5 => array('title' => '5', 'img' => MFN_OPTIONS_URI.'img/overlays/5.png'),
					6 => array('title' => '6', 'img' => MFN_OPTIONS_URI.'img/overlays/6.png'),
					7 => array('title' => '7', 'img' => MFN_OPTIONS_URI.'img/overlays/7.png'),
					8 => array('title' => '8', 'img' => MFN_OPTIONS_URI.'img/overlays/8.png'),
					9 => array('title' => '9', 'img' => MFN_OPTIONS_URI.'img/overlays/9.png'),
					10 => array('title' => '10', 'img' => MFN_OPTIONS_URI.'img/overlays/10.png'),
					11 => array('title' => '11', 'img' => MFN_OPTIONS_URI.'img/overlays/11.png'),
					12 => array('title' => '12', 'img' => MFN_OPTIONS_URI.'img/overlays/12.png'),
					13 => array('title' => '13', 'img' => MFN_OPTIONS_URI.'img/overlays/13.png'),
					14 => array('title' => '14', 'img' => MFN_OPTIONS_URI.'img/overlays/14.png'),
					15 => array('title' => '15', 'img' => MFN_OPTIONS_URI.'img/overlays/15.png'),
					16 => array('title' => '16', 'img' => MFN_OPTIONS_URI.'img/overlays/16.png'),
					17 => array('title' => '17', 'img' => MFN_OPTIONS_URI.'img/overlays/17.png'),
					18 => array('title' => '18', 'img' => MFN_OPTIONS_URI.'img/overlays/18.png'),
					19 => array('title' => '19', 'img' => MFN_OPTIONS_URI.'img/overlays/19.png'),
				),
				'std' => '0'
			),
					
			array(
				'id' => 'img-page-bg',
				'type' => 'upload',
				'title' => __('Body Background image', 'mfn-opts'),
				'desc' => __('This option can be used <strong>only</strong> with Layout: Boxed.', 'mfn-opts'),
			),
					
			array(
				'id' => 'position-page-bg',
				'type' => 'select',
				'title' => __('Body Background image position', 'mfn-opts'),
				'desc' => __('This option can be used only with your custom image selected above.', 'mfn-opts'),
				'options' => array(
					'center top no-repeat' => 'Center Top No-Repeat',
					'center top repeat' => 'Center Top Repeat',
					'center center no-repeat' => 'Center No-Repeat',
					'center center repeat' => 'Center Repeat',
					'left top no-repeat' => 'Left Top No-Repeat',
					'left top repeat' => 'Left Top Repeat',
					'center top no-repeat fixed' => 'Center No-Repeat Fixed',
					'no-repeat fixed center center / cover' => 'Center No-Repeat Fixed Cover',
				),
				'std' => 'center top no-repeat',
			),

			array(
				'id' => 'content-overlay',
				'type' => 'radio_img',
				'title' => __('Content Overlay', 'mfn-opts'),
				'desc' => __('Please note that not every overlay is transparent.', 'mfn-opts'),
				'options' => array(
					0 => array('title' => 'Without Overlay', 'img' => MFN_OPTIONS_URI.'img/overlays/0.png'),
					1 => array('title' => '1', 'img' => MFN_OPTIONS_URI.'img/overlays/1.png'),
					2 => array('title' => '2', 'img' => MFN_OPTIONS_URI.'img/overlays/2.png'),
					3 => array('title' => '3', 'img' => MFN_OPTIONS_URI.'img/overlays/3.png'),
					4 => array('title' => '4', 'img' => MFN_OPTIONS_URI.'img/overlays/4.png'),
					5 => array('title' => '5', 'img' => MFN_OPTIONS_URI.'img/overlays/5.png'),
					6 => array('title' => '6', 'img' => MFN_OPTIONS_URI.'img/overlays/6.png'),
					7 => array('title' => '7', 'img' => MFN_OPTIONS_URI.'img/overlays/7.png'),
					8 => array('title' => '8', 'img' => MFN_OPTIONS_URI.'img/overlays/8.png'),
				),
				'std' => '0'
			),
			
		),
	);
	
	// Header --------------------------------------------
	$sections['layout-header'] = array(
		'title' => __('Header', 'mfn-opts'),
		'fields' => array(
	
			array(
				'id' => 'header-sticky',
				'type' => 'switch',
				'title' => __('Sticky Header', 'mfn-opts'),
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '0'
			),
				
			array(
				'id' => 'logo-img',
				'type' => 'upload',
				'title' => __('Custom Logo', 'mfn-opts'),
				'sub_desc' => __('Custom logo image', 'mfn-opts'),
			),
	
			array(
				'id' => 'retina-logo-img',
				'type' => 'upload',
				'title' => __('Retina Logo', 'mfn-opts'),
				'sub_desc' => __('2x larger logo image', 'mfn-opts'),
				'desc' => __('Retina Logo should be 2x larger than Custom Logo (field is optional).', 'mfn-opts'),
			),

			array(
				'id' => 'retina-logo-width',
				'type' => 'text',
				'title' => __('Custom Logo Width', 'mfn-opts'),
				'sub_desc' => __('for Retina Logo', 'mfn-opts'),
				'desc' => __('px. Please type width of Custom Logo image (<strong>not</strong> Retina Logo).', 'mfn-opts'),
				'class' => 'small-text',
			),

			array(
				'id' => 'retina-logo-height',
				'type' => 'text',
				'title' => __('Custom Logo Height', 'mfn-opts'),
				'sub_desc' => __('for Retina Logo', 'mfn-opts'),
				'desc' => __('px. Please type height of Custom Logo image (<strong>not</strong> Retina Logo).', 'mfn-opts'),
				'class' => 'small-text',
			),
	
			array(
				'id' => 'favicon-img',
				'type' => 'upload',
				'title' => __('Custom Favicon', 'mfn-opts'),
				'sub_desc' => __('Site favicon', 'mfn-opts'),
				'desc' => __('Please use ICO format only.', 'mfn-opts')
			),
	
			array(
				'id' => 'header-top-bar-text',
				'type' => 'text',
				'title' => __('Top Bar text', 'mfn-opts'),
			),
			
			array(
				'id' => 'telephone-number',
				'type' => 'text',
				'title' => __('Phone number', 'mfn-opts'),
			),
	
			array(
				'id' => 'header-email',
				'type' => 'text',
				'title' => __('Email address', 'mfn-opts'),
			),
				
		),
	);
	
	// Social Icons --------------------------------------------
	$sections['social'] = array(
		'title' => __('Social Icons', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
				
			array(
				'id' => 'social-facebook',
				'type' => 'text',
				'title' => __('Facebook', 'mfn-opts'),
				'sub_desc' => __('Type your Facebook link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-googleplus',
				'type' => 'text',
				'title' => __('Google +', 'mfn-opts'),
				'sub_desc' => __('Type your Google + link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-twitter',
				'type' => 'text',
				'title' => __('Twitter', 'mfn-opts'),
				'sub_desc' => __('Type your Twitter link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-vimeo',
				'type' => 'text',
				'title' => __('Vimeo', 'mfn-opts'),
				'sub_desc' => __('Type your Vimeo link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-youtube',
				'type' => 'text',
				'title' => __('YouTube', 'mfn-opts'),
				'sub_desc' => __('Type your YouTube link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-flickr',
				'type' => 'text',
				'title' => __('Flickr', 'mfn-opts'),
				'sub_desc' => __('Type your Flickr link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-linkedin',
				'type' => 'text',
				'title' => __('LinkedIn', 'mfn-opts'),
				'sub_desc' => __('Type your LinkedIn link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-pinterest',
				'type' => 'text',
				'title' => __('Pinterest', 'mfn-opts'),
				'sub_desc' => __('Type your Pinterest link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
			
			array(
				'id' => 'social-dribbble',
				'type' => 'text',
				'title' => __('Dribbble', 'mfn-opts'),
				'sub_desc' => __('Type your Dribbble link here', 'mfn-opts'),
				'desc' => __('Icon won`t show if you leave this field blank' , 'mfn-opts'),
			),
				
		),
	);
	
	// Custom CSS --------------------------------------------
	$sections['custom-css'] = array(
		'title' => __('Custom CSS', 'mfn-opts'),
		'fields' => array(

			array(
				'id' => 'custom-css',
				'type' => 'textarea',
				'title' => __('Custom CSS', 'mfn-opts'), 
				'sub_desc' => __('Paste your custom CSS code here.', 'mfn-opts'),
			),
				
		),
	);

	// Colors ----------------------------------------------------------------------------------------
	
	// General --------------------------------------------
	$sections['colors-general'] = array(
		'title' => __('General', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
							
			array(
				'id' => 'skin',
				'type' => 'select',
				'title' => __('Theme Skin', 'mfn-opts'), 
				'sub_desc' => __('Choose one of the predefined styles or set your own colors.', 'mfn-opts'), 
				'desc' => __('<b>Important:</b> Color options can be used only with the Custom Skin.', 'mfn-opts'), 
				'options' => array(
			
					'custom' => 'Custom',
					'blue' => 'Blue',
					'green' => 'Green',
					'orange' => 'Orange',
					'red' => 'Red',
			
				),
				'std' => 'custom',
			),
			
			array(
				'id' => 'background-body',
				'type' => 'color',
				'title' => __('Body background', 'mfn-opts'), 
				'desc' => __('This option can be used <strong>only</strong> with Layout: Boxed.', 'mfn-opts'),
				'std' => '#f8f8f8',
			),
				
			array(
				'id' => 'background-wrapper',
				'type' => 'color',
				'title' => __('Content background', 'mfn-opts'),
				'std' => '#fff',
			),
			
		),
	);
	
	// Boxes --------------------------------------------
	$sections['boxes'] = array(
		'title' => __('Theme colors', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
					
			array(
				'id' => 'mfn-color-info',
				'type' => 'info',
				'desc' => __('These colors are used in some Content Builder Items eg. Feature Box, Latest Posts, etc.', 'mfn-opts'),
			),
				
			array(
				'id' => 'mfn-color-1',
				'type' => 'color',
				'title' => __('Theme color 1', 'mfn-opts'),
				'std' => '#40c652'
			),
				
			array(
				'id' => 'mfn-color-2',
				'type' => 'color',
				'title' => __('Theme color 2', 'mfn-opts'),
				'std' => '#36ae46'
			),
				
			array(
				'id' => 'mfn-color-3',
				'type' => 'color',
				'title' => __('Theme color 3', 'mfn-opts'),
				'std' => '#2f963d'
			),
				
			array(
				'id' => 'mfn-color-4',
				'type' => 'color',
				'title' => __('Theme color 4', 'mfn-opts'),
				'std' => '#277e32'
			),
				
		),
	);
	
	// Main menu --------------------------------------------
	$sections['menu'] = array(
		'title' => __('Main menu', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
			
			array(
				'id' => 'color-menu-a',
				'type' => 'color',
				'title' => __('Menu Link color', 'mfn-opts'), 
				'std' => '#393939'
			),
				
			array(
				'id' => 'background-menu-a-active',
				'type' => 'color',
				'title' => __('Hover  Menu Link background', 'mfn-opts'),
				'desc' => __('This is also Active Menu Link background.', 'mfn-opts'),
				'std' => '#FCFCFC'
			),
			
			array(
				'id' => 'color-menu-a-active',
				'type' => 'color',
				'title' => __('Hover Menu Link color', 'mfn-opts'),
				'desc' => __('This is also Active Menu Link color and border.', 'mfn-opts'),
				'std' => '#39b54a'
			),
				
			array(
				'id' => 'background-submenu-a',
				'type' => 'color',
				'title' => __('Submenu background', 'mfn-opts'),
				'std' => '#FCFCFC'
			),

			array(
				'id' => 'color-submenu-a',
				'type' => 'color',
				'title' => __('Submenu Link color', 'mfn-opts'),
				'std' => '#3C3C3C'
			),
			
			array(
				'id' => 'background-submenu-a-hover',
				'type' => 'color',
				'title' => __('Hover Submenu Link background', 'mfn-opts'),
				'std' => '#fff'
			),
			
			array(
				'id' => 'color-submenu-a-active',
				'type' => 'color',
				'title' => __('Hover Submenu Link color', 'mfn-opts'),
				'desc' => __('This is also Active Submenu Link color and border.', 'mfn-opts'),
				'std' => '#39b54a'
			),
				
		),
	);
	
	// Header --------------------------------------------
	$sections['colors-header'] = array(
		'title' => __('Header', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(

			array(
				'id' => 'background-top-bar',
				'type' => 'color',
				'title' => __('Top bar background', 'mfn-opts'),
				'std' => '#3E3E3E',
			),
				
			array(
				'id' => 'color-top-bar-text',
				'type' => 'color',
				'title' => __('Top bar text color', 'mfn-opts'),
				'std' => '#fff',
			),
				
			array(
				'id' => 'color-phone-ico',
				'type' => 'color',
				'title' => __('Phone & Email Icons color', 'mfn-opts'),
				'std' => '#D3D3D3',
			),
				
			array(
				'id' => 'color-phone-email',
				'type' => 'color',
				'title' => __('Phone & Email color', 'mfn-opts'),
				'std' => '#DAFEB6',
			),
				
			array(
				'id' => 'color-social',
				'type' => 'color',
				'title' => __('Social Icon color', 'mfn-opts'),
				'std' => '#fff',
			),
			
			array(
				'id' => 'color-social-hover',
				'type' => 'color',
				'title' => __('Hover Social Icon color', 'mfn-opts'),
				'std' => '#d3d3d3',
			),

			array(
				'id' => 'background-subheader',
				'type' => 'color',
				'title' => __('Title Area background', 'mfn-opts'), 
				'desc' => __('To change overlay please edit <strong>images/subheader_overlay.png</strong> file.', 'mfn-opts'),
				'std' => '#39B54A',
			),
				
			array(
				'id' => 'color-subheader-title',
				'type' => 'color',
				'title' => __('Title Area Title color', 'mfn-opts'), 
				'std' => '#fff',
			),
			
			array(
				'id' => 'color-subheader-text',
				'type' => 'color',
				'title' => __('Title Area Link color', 'mfn-opts'), 
				'std' => '#fff',
			),
			
			array(
				'id' => 'color-subheader-arrow',
				'type' => 'color',
				'title' => __('Title Area Arrow color', 'mfn-opts'), 
				'std' => '#14441A',
			),
				
		),
	);
	
	// Content --------------------------------------------
	$sections['content'] = array(
		'title' => __('Content', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
		
			array(
				'id' => 'color-text',
				'type' => 'color',
				'title' => __('Text color', 'mfn-opts'), 
				'sub_desc' => __('Content text color.', 'mfn-opts'),
				'std' => '#666666'
			),
			
			array(
				'id' => 'color-a',
				'type' => 'color',
				'title' => __('Link color', 'mfn-opts'), 
				'std' => '#3BAA35'
			),
			
			array(
				'id' => 'color-a-hover',
				'type' => 'color',
				'title' => __('Hover Link color', 'mfn-opts'), 
				'std' => '#1D8F18'
			),
			
			array(
				'id' => 'color-bold-note',
				'type' => 'color',
				'title' => __('Bold Note text color', 'mfn-opts'), 
				'desc' => __('Bold Note, eg. latest post title, comment author, etc.', 'mfn-opts'), 
				'std' => '#31373c'
			),
			
			array(
				'id' => 'color-green-note',
				'type' => 'color',
				'title' => __('Green Note text color', 'mfn-opts'), 
				'desc' => __('Green Note, eg. blockquote author, , etc.', 'mfn-opts'), 
				'std' => '#22A23E'
			),
			
			array(
				'id' => 'color-note',
				'type' => 'color',
				'title' => __('Grey Note text color', 'mfn-opts'), 
				'desc' => __('Grey Note, eg. post date, etc.', 'mfn-opts'), 
				'std' => '#A3A3A3'
			),
			
			array(
				'id' => 'border-borders',
				'type' => 'color',
				'title' => __('Border color', 'mfn-opts'), 
				'std' => '#ebebeb'
			),

			array(
				'id' => 'background-button',
				'type' => 'color',
				'title' => __('Button background', 'mfn-opts'), 
				'std' => '#fff',
			),
			
			array(
				'id' => 'color-button',
				'type' => 'color',
				'title' => __('Button text color', 'mfn-opts'), 
				'std' => '#454444',
			),
			
			array(
				'id' => 'shadow-button',
				'type' => 'color',
				'title' => __('Button text shadow', 'mfn-opts'), 
				'std' => '#fff',
			),
			
			array(
				'id' => 'color-button-arrow',
				'type' => 'color',
				'title' => __('Button arrow color', 'mfn-opts'), 
				'std' => '#b6b6b6',
			),
	
		),
	);
	
	// Footer --------------------------------------------
	$sections['colors-footer'] = array(
		'title' => __('Footer', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'background-footer',
				'type' => 'color',
				'title' => __('Footer background', 'mfn-opts'),
				'std' => '#292C30',
			),
				
			array(
				'id' => 'border-footer',
				'type' => 'color',
				'title' => __('Footer border top color', 'mfn-opts'),
				'std' => '#39B54A',
			),

			array(
				'id' => 'color-footer-heading',
				'type' => 'color',
				'title' => __('Footer heading color', 'mfn-opts'), 
				'std' => '#fff',
			),
	
			array(
				'id' => 'color-footer-text',
				'type' => 'color',
				'title' => __('Footer text color', 'mfn-opts'), 
				'std' => '#E1E1E1',
			),
			
			array(
				'id' => 'color-footer-a',
				'type' => 'color',
				'title' => __('Footer Link color', 'mfn-opts'), 
				'desc' => __('This is also Footer Menu Link color.', 'mfn-opts'),
				'std' => '#3BAA35',
			),
			
			array(
				'id' => 'color-footer-a-hover',
				'type' => 'color',
				'title' => __('Hover Footer Link color', 'mfn-opts'), 
				'desc' => __('This is also Hover Footer Menu Link color.', 'mfn-opts'),
				'std' => '#74DC6F',
			),
			
			array(
				'id' => 'color-footer-menu-active',
				'type' => 'color',
				'title' => __('Active Footer Menu Link color', 'mfn-opts'),
				'std' => '#fff',
			),
			
			array(
				'id' => 'color-footer-bold-note',
				'type' => 'color',
				'title' => __('Bold Note text color', 'mfn-opts'),
				'std' => '#36BC54',
			),
				
			array(
				'id' => 'color-footer-note',
				'type' => 'color',
				'title' => __('Grey Note text color', 'mfn-opts'),
				'std' => '#A6A6A6',
			),
				
			array(
				'id' => 'border-footer-frame',
				'type' => 'color',
				'title' => __('Borders & frames', 'mfn-opts'),
				'std' => '#3A3A3A',
			),
			
			array(
				'id' => 'color-footer-icon',
				'type' => 'color',
				'title' => __('Footer Social Icon color', 'mfn-opts'),
				'std' => '#D3D3D3',
			),
			
			array(
				'id' => 'color-footer-icon-hover',
				'type' => 'color',
				'title' => __('Hover Footer Social Icon color', 'mfn-opts'),
				'std' => '#36BC54',
			),

			array(
				'id' => 'background-gototop',
				'type' => 'color',
				'title' => __('Go to top icon background', 'mfn-opts'),
				'std' => '#39B54A',
			),
				
			array(
				'id' => 'background-gototop-hover',
				'type' => 'color',
				'title' => __('Hover Go to top icon background', 'mfn-opts'),
				'std' => '#258831',
			),
	
		),
	);
	
	// Colors Blog --------------------------------------------
	$sections['colors-blog'] = array(
		'title' => __('Blog', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(	
			
			array(
				'id' => 'color-blog-icon',
				'type' => 'color',
				'title' => __('Calendar Icon color', 'mfn-opts'),
				'std' => '#a5a5a5'
			),
				
			array(
				'id' => 'color-blog-day',
				'type' => 'color',
				'title' => __('Day & Month text color', 'mfn-opts'),
				'std' => '#31373C'
			),
				
			array(
				'id' => 'color-blog-year',
				'type' => 'color',
				'title' => __('Year text color', 'mfn-opts'),
				'std' => '#3cb24f'
			),
				
			array(
				'id' => 'background-blog-post',
				'type' => 'color',
				'title' => __('Post background', 'mfn-opts'),
				'std' => '#fdfdfd'
			),
				
			array(
				'id' => 'border-blog-image',
				'type' => 'color',
				'title' => __('Image border', 'mfn-opts'),
				'std' => '#39B54A'
			),

		),
	);
	
	// Headings --------------------------------------------
	$sections['headings'] = array(
		'title' => __('Headings', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
	
			array(
				'id' => 'color-h1',
				'type' => 'color',
				'title' => __('Heading H1 color', 'mfn-opts'), 
				'std' => '#313131'
			),
			
			array(
				'id' => 'color-h2',
				'type' => 'color',
				'title' => __('Heading H2 color', 'mfn-opts'), 
				'std' => '#313131'
			),
			
			array(
				'id' => 'color-h3',
				'type' => 'color',
				'title' => __('Heading H3 color', 'mfn-opts'), 
				'std' => '#313131'
			),
			
			array(
				'id' => 'color-h4',
				'type' => 'color',
				'title' => __('Heading H4 color', 'mfn-opts'), 
				'std' => '#313131'
			),
			
			array(
				'id' => 'color-h5',
				'type' => 'color',
				'title' => __('Heading H5 color', 'mfn-opts'), 
				'std' => '#1E8B36'
			),
			
			array(
				'id' => 'color-h6',
				'type' => 'color',
				'title' => __('Heading H6 color', 'mfn-opts'), 
				'std' => '#31373c'
			),
			
			array(
				'id' => 'color-h-highlight',
				'type' => 'color',
				'title' => __('Heading highlight color', 'mfn-opts'), 
				'desc' => __('Wrap text into "span" tag to highlight it.', 'mfn-opts'),
				'std' => '#8e8787'
			),
				
		),
	);
	
	// Shortcodes --------------------------------------------
	$sections['colors-shortcodes'] = array(
		'title' => __('Shortcodes', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(
				
			array(
				'id' => 'background-accordion-content',
				'type' => 'color',
				'title' => __('Accordion & Tabs Content background', 'mfn-opts'),
				'std' => '#FCFCFC',
			),
				
			array(
				'id' => 'color-accordion-title',
				'type' => 'color',
				'title' => __('Accordion & Tabs Title color', 'mfn-opts'),
				'std' => '#393939',
			),
				
			array(
				'id' => 'color-tabs-title-active',
				'type' => 'color',
				'title' => __('Active Tab Title color', 'mfn-opts'),
				'std' => '#fff',
			),

			array(
				'id' => 'color-call-to-action-text',
				'type' => 'color',
				'title' => __('Call To Action Text color', 'mfn-opts'), 
				'std' => '#205426',
			),
			
			array(
				'id' => 'color-call-to-action-highlight',
				'type' => 'color',
				'title' => __('Call To Action Highlight color', 'mfn-opts'), 
				'std' => '#39B54A',
			),
			
			array(
				'id' => 'background-call-to-action-button',
				'type' => 'color',
				'title' => __('Call To Action Button background', 'mfn-opts'), 
				'std' => '#2A8F36',
			),
			
			array(
				'id' => 'color-call-to-action-button',
				'type' => 'color',
				'title' => __('Call To Action Button text color', 'mfn-opts'), 
				'std' => '#fff',
			),
			
			array(
				'id' => 'color-feature-box-title',
				'type' => 'color',
				'title' => __('Feature Box Title color', 'mfn-opts'), 
				'std' => '#fff',
			),
			
			array(
				'id' => 'color-our-team-title',
				'type' => 'color',
				'title' => __('Our Team Title color', 'mfn-opts'), 
				'std' => '#fff',
			),
			
			array(
				'id' => 'background-our-team-title',
				'type' => 'color',
				'title' => __('Our Team Title background', 'mfn-opts'), 
				'std' => '#39B54A',
			),
			
			array(
				'id' => 'color-our-team-subtitle',
				'type' => 'color',
				'title' => __('Our Team Subtitle color', 'mfn-opts'), 
				'std' => '#fff',
			),
			
			array(
				'id' => 'background-our-team-subtitle',
				'type' => 'color',
				'title' => __('Our Team Subtitle background', 'mfn-opts'), 
				'std' => '#2E7A39',
			),
	
		),
	);

	// Widgets --------------------------------------------
	$sections['colors-widgets'] = array(
		'title' => __('Widgets', 'mfn-opts'),
		'icon' => MFN_OPTIONS_URI. 'img/icons/sub.png',
		'fields' => array(

			array(
				'id' => 'color-mfn-menu-link',
				'type' => 'color',
				'title' => __('Muffin Menu link color', 'mfn-opts'),
				'std' => '#475363',
			),
				
			array(
				'id' => 'color-mfn-menu-link-active',
				'type' => 'color',
				'title' => __('Active Muffin Menu link color', 'mfn-opts'),
				'desc' => __('To change background please edit <strong>css/skins/../images/submenu_hover.png</strong> file.', 'mfn-opts'),	
				'std' => '#fff',
			),
				
			array(
				'id' => 'color-mfn-menu-arrow-active',
				'type' => 'color',
				'title' => __('Active Muffin Menu arrow color', 'mfn-opts'),
				'std' => '#349642',
			),
				
		),
	);

	// Font Family --------------------------------------------
	$sections['font-family'] = array(
		'title' => __('Font Family', 'mfn-opts'),
		'fields' => array(
			
			array(
				'id' => 'font-content',
				'type' => 'font_select',
				'title' => __('Content Font', 'mfn-opts'), 
				'sub_desc' => __('This font will be used for all theme texts except headings and menu.', 'mfn-opts'), 
				'std' => 'PT Sans'
			),
			
			array(
				'id' => 'font-menu',
				'type' => 'font_select',
				'title' => __('Main Menu Font', 'mfn-opts'), 
				'sub_desc' => __('This font will be used for header menu.', 'mfn-opts'), 
				'std' => 'Open Sans'
			),
			
			array(
				'id' => 'font-headings',
				'type' => 'font_select',
				'title' => __('Headings Font', 'mfn-opts'), 
				'sub_desc' => __('This font will be used for all headings.', 'mfn-opts'), 
				'std' => 'Open Sans'
			),
			
			array(
				'id' => 'font-subset',
				'type' => 'text',
				'title' => __('Google Font Subset', 'mfn-opts'),				
				'sub_desc' => __('Specify which subsets should be downloaded. Multiple subsets should be separated with coma (,)', 'mfn-opts'),
				'desc' => __('Some of the fonts in the Google Font Directory support multiple scripts (like Latin and Cyrillic for example). In order to specify which subsets should be downloaded the subset parameter should be appended to the URL. For a complete list of available fonts and font subsets please see <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts</a>.', 'mfn-opts'),
				'class' => 'small-text'
			),
				
		),
	);
	
	// Content Font Size --------------------------------------------
	$sections['font-size'] = array(
		'title' => __('Font Size', 'mfn-opts'),
		'fields' => array(

			array(
				'id' => 'font-size-content',
				'type' => 'sliderbar',
				'title' => __('Content', 'mfn-opts'),
				'sub_desc' => __('This font size will be used for all theme texts.', 'mfn-opts'),
				'std' => '14',
			),
				
			array(
				'id' => 'font-size-menu',
				'type' => 'sliderbar',
				'title' => __('Main menu', 'mfn-opts'),
				'sub_desc' => __('This font size will be used for top level only.', 'mfn-opts'),
				'std' => '15',
			),
			
			array(
				'id' => 'font-size-h1',
				'type' => 'sliderbar',
				'title' => __('Heading H1', 'mfn-opts'),
				'sub_desc' => __('Subpages header title.', 'mfn-opts'),
				'std' => '40',
			),
			
			array(
				'id' => 'font-size-h2',
				'type' => 'sliderbar',
				'title' => __('Heading H2', 'mfn-opts'),
				'std' => '36',
			),
			
			array(
				'id' => 'font-size-h3',
				'type' => 'sliderbar',
				'title' => __('Heading H3', 'mfn-opts'),
				'std' => '28',
			),
			
			array(
				'id' => 'font-size-h4',
				'type' => 'sliderbar',
				'title' => __('Heading H4', 'mfn-opts'),
				'std' => '19',
			),
			
			array(
				'id' => 'font-size-h5',
				'type' => 'sliderbar',
				'title' => __('Heading H5', 'mfn-opts'),
				'std' => '17',
			),
			
			array(
				'id' => 'font-size-h6',
				'type' => 'sliderbar',
				'title' => __('Heading H6', 'mfn-opts'),
				'std' => '16',
			),
	
		),
	);
	
	// Translate / General --------------------------------------------
	$sections['translate-general'] = array(
		'title' => __('General', 'mfn-opts'),
		'fields' => array(
	
			array(
				'id' => 'translate',
				'type' => 'switch',
				'title' => __('Enable Translate', 'mfn-opts'), 
				'desc' => __('Turn it off if you want to use .mo .po files for more complex translation.', 'mfn-opts'),
				'options' => array('1' => 'On','0' => 'Off'),
				'std' => '1'
			),
			
			array(
				'id' => 'translate-search-placeholder',
				'type' => 'text',
				'title' => __('Search Placeholder', 'mfn-opts'),
				'desc' => __('Widget Search', 'mfn-opts'),
				'std' => 'Enter your search',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-home',
				'type' => 'text',
				'title' => __('Home', 'mfn-opts'),
				'desc' => __('Breadcrumbs', 'mfn-opts'),
				'std' => 'Home',
				'class' => 'small-text',
			),

		),
	);
	
	// Translate / Blog & Portfolio --------------------------------------------
	$sections['translate-blog'] = array(
		'title' => __('Blog & Portfolio', 'mfn-opts'),
		'fields' => array(
	
			array(
				'id' => 'translate-next',
				'type' => 'text',
				'title' => __('Next page', 'mfn-opts'),
				'desc' => __('Blog, Portfolio', 'mfn-opts'),
				'std' => 'Next page &rsaquo;',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-prev',
				'type' => 'text',
				'title' => __('Previous page', 'mfn-opts'),
				'desc' => __('Blog, Portfolio', 'mfn-opts'),
				'std' => '&lsaquo; Prev page',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-select-category',
				'type' => 'text',
				'title' => __('Select category', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'Select category:',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-all',
				'type' => 'text',
				'title' => __('All', 'mfn-opts'),
				'desc' => __('Portfolio', 'mfn-opts'),
				'std' => 'All',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-category',
				'type' => 'text',
				'title' => __('Category', 'mfn-opts'),
				'desc' => __('Single Blog, Single Portfolio', 'mfn-opts'),
				'std' => 'Category:',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-comments',
				'type' => 'text',
				'title' => __('Comments', 'mfn-opts'),
				'desc' => __('Blog', 'mfn-opts'),
				'std' => 'Comments:',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-project-description',
				'type' => 'text',
				'title' => __('Project Description', 'mfn-opts'),
				'desc' => __('Single Portfolio', 'mfn-opts'),
				'std' => 'Project Description:',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-client',
				'type' => 'text',
				'title' => __('Client', 'mfn-opts'),
				'desc' => __('Single Portfolio', 'mfn-opts'),
				'std' => 'Client:',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-date',
				'type' => 'text',
				'title' => __('Date', 'mfn-opts'),
				'desc' => __('Single Portfolio', 'mfn-opts'),
				'std' => 'Date:',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-project-url',
				'type' => 'text',
				'title' => __('Project URL', 'mfn-opts'),
				'desc' => __('Single Portfolio', 'mfn-opts'),
				'std' => 'Project URL:',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-visit-online',
				'type' => 'text',
				'title' => __('Visit online', 'mfn-opts'),
				'desc' => __('Single Portfolio', 'mfn-opts'),
				'std' => 'Visit online &rarr;',
				'class' => 'small-text',
			),
			
			array(
				'id' => 'translate-back',
				'type' => 'text',
				'title' => __('Back to list', 'mfn-opts'),
				'desc' => __('Single Portfolio', 'mfn-opts'),
				'std' => 'Back to list',
				'class' => 'small-text',
			),
			
		),
	);
	
	// Translate Contact --------------------------------------------
	$sections['translate-contact'] = array(
		'title' => __('Contact', 'mfn-opts'),
		'fields' => array(
	
			array(
				'id' => 'translate-contact-name',
				'type' => 'text',
				'title' => __('Your name', 'mfn-opts'),
				'desc' => __('Contact Form', 'mfn-opts'),
				'std' => 'Your name',
				'class' => 'small-text',
			),
	
			array(
				'id' => 'translate-contact-email',
				'type' => 'text',
				'title' => __('Your e-mail', 'mfn-opts'),
				'desc' => __('Contact Form', 'mfn-opts'),
				'std' => 'Your e-mail',
				'class' => 'small-text',
			),
	
			array(
				'id' => 'translate-contact-subject',
				'type' => 'text',
				'title' => __('Subject', 'mfn-opts'),
				'desc' => __('Contact Form', 'mfn-opts'),
				'std' => 'Subject',
				'class' => 'small-text',
			),
				
			array(
				'id' => 'translate-contact-submit',
				'type' => 'text',
				'title' => __('Send message', 'mfn-opts'),
				'desc' => __('Contact Form', 'mfn-opts'),
				'std' => 'Send message',
				'class' => 'small-text',
			),
				
			array(
				'id' => 'translate-contact-message-success',
				'type' => 'text',
				'title' => __('Success message', 'mfn-opts'),
				'desc' => __('Contact Form', 'mfn-opts'),
				'std' => 'Thanks, your email was sent.',
			),
				
			array(
				'id' => 'translate-contact-message-error',
				'type' => 'text',
				'title' => __('Error message', 'mfn-opts'),
				'desc' => __('Contact Form', 'mfn-opts'),
				'std' => 'Error sending email. Please try again later.',
			),
	
		),
	);
	
	// Translate Error 404 --------------------------------------------
	$sections['translate-404'] = array(
		'title' => __('Error 404', 'mfn-opts'),
		'fields' => array(
	
			array(
				'id' => 'translate-404-title',
				'type' => 'text',
				'title' => __('Title', 'mfn-opts'),
				'desc' => __('Ooops... Error 404', 'mfn-opts'),
				'std' => 'Ooops... Error 404',
			),
			
			array(
				'id' => 'translate-404-subtitle',
				'type' => 'text',
				'title' => __('Subtitle', 'mfn-opts'),
				'desc' => __('We`re sorry, but the page you are looking for doesn`t exist.', 'mfn-opts'),
				'std' => 'We`re sorry, but the page you are looking for doesn`t exist.',
			),
			
			array(
				'id' => 'translate-404-text',
				'type' => 'text',
				'title' => __('Text', 'mfn-opts'),
				'desc' => __('Please check entered address and try again or', 'mfn-opts'),
				'std' => 'Please check entered address and try again <em>or</em>',
			),
			
			array(
				'id' => 'translate-404-btn',
				'type' => 'text',
				'title' => __('Button', 'mfn-opts'),
				'sub_desc' => __('Go To Homepage button', 'mfn-opts'),
				'std' => 'go to homepage',
				'class' => 'small-text',
			),
	
		),
	);
								
	global $MFN_Options;
	$MFN_Options = new MFN_Options( $menu, $sections );
}
//add_action('init', 'mfn_opts_setup', 0);
mfn_opts_setup();


/**
 * This is used to return and option value from the options array
 */
function mfn_opts_get($opt_name, $default = null){
	global $MFN_Options;
	return $MFN_Options->get( $opt_name, $default );
}


/**
 * This is used to echo and option value from the options array
 */
function mfn_opts_show($opt_name, $default = null){
	global $MFN_Options;
	$option = $MFN_Options->get( $opt_name, $default );
	if( ! is_array( $option ) ){
		echo $option;
	}	
}

?>