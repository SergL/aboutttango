<?php
/**
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */

header( 'Content-type: text/css;' );
	
$url = dirname( __FILE__ );
$strpos = strpos( $url, 'wp-content' );
$base = substr( $url, 0, $strpos );

require_once( $base .'wp-load.php' );
?>

/********************** Theme colors **********************/

	.mfn-color-1 { background-color: <?php hex2rgba( mfn_opts_get( 'mfn-color-1', '#40c652' ), 0.9, true ) ?>; }
	.mfn-color-2 { background-color: <?php hex2rgba( mfn_opts_get( 'mfn-color-2', '#36ae46' ), 0.9, true ) ?>; }
	.mfn-color-3 { background-color: <?php hex2rgba( mfn_opts_get( 'mfn-color-3', '#2f963d' ), 0.9, true ) ?>; }
	.mfn-color-4 { background-color: <?php hex2rgba( mfn_opts_get( 'mfn-color-4', '#277e32' ), 0.9, true ) ?>; }
	
	.mfn-border-1 { border-color: <?php mfn_opts_show( 'mfn-color-1', '#40c652' ) ?>; }
	.mfn-border-2 { border-color: <?php mfn_opts_show( 'mfn-color-2', '#36ae46' ) ?>; }
	.mfn-border-3 { border-color: <?php mfn_opts_show( 'mfn-color-3', '#2f963d' ) ?>; }
	.mfn-border-4 { border-color: <?php mfn_opts_show( 'mfn-color-4', '#277e32' ) ?>; }
	
	
/********************** Backgrounds **********************/
	
	#Top_bar {
		background-color: <?php mfn_opts_show( 'background-top-bar', '#3E3E3E' ) ?>;	
	}
	
	#Footer {
		background-color: <?php mfn_opts_show( 'background-footer', '#292C30' ) ?>;		
	}

	
/********************* Colors *********************/

/* Content font */

	body,
	.ui-tabs .ui-tabs-nav li a, .ui-accordion h3 a,
	.widget ul.menu li a, .widget_links ul li a, .widget_meta ul li a {
		color: <?php mfn_opts_show( 'color-text', '#666666' ) ?>;
	}
	
/* Links color */

	a {
		color: <?php mfn_opts_show( 'color-a', '#3BAA35' ) ?>;
	}
	
	a:hover {
		color: <?php mfn_opts_show( 'color-a-hover', '#1D8F18' ) ?>;
	}
	
/* Strong (dark) */

	.Recent_comments ul li strong, #Content .Recent_posts ul li a.title, 
	#Content .Recent_posts ul li p i, .Recent_comments ul li p strong, .Recent_comments ul li p i,
	.Twitter ul li span {
		color: <?php mfn_opts_show( 'color-bold-note', '#31373c' ) ?>;
	}
	
/* Dark green */

	.get_in_touch li.phone p, .pricing-box .plan-inside ul li strong,
	.error h4, .team p, blockquote p.author span, .Recent_comments li span.date .day {
		color: <?php mfn_opts_show( 'color-green-note', '#22A23E' ) ?>;
	}
	
/* Grey notes */

	.Twitter ul li > a, .Recent_posts span.date,
	.wp-caption .wp-caption-text, .post .meta, .pager a,
	.post .meta .comments, .post .desc .r_meta, .single-post .tag-cat .category a, .single-post .tag-cat .category { 
		color: <?php mfn_opts_show( 'color-note', '#A3A3A3' ) ?>;
	}

/* Headings font */

	h1, h1 a, h1 a:hover { color: <?php mfn_opts_show( 'color-h1', '#313131' ) ?>; }
	h2, h2 a, h2 a:hover { color: <?php mfn_opts_show( 'color-h2', '#313131' ) ?>; }
	h3, h3 a, h3 a:hover { color: <?php mfn_opts_show( 'color-h3', '#313131' ) ?>; }
	h4, h4 a, h4 a:hover { color: <?php mfn_opts_show( 'color-h4', '#313131' ) ?>; }
	h5, h5 a, h5 a:hover { color: <?php mfn_opts_show( 'color-h5', '#1E8B36' ) ?>; }
	h6, h6 a, h6 a:hover { color: <?php mfn_opts_show( 'color-h6', '#31373c' ) ?>; }
	
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span { color: <?php mfn_opts_show( 'color-h-highlight', '#8e8787' ) ?>; }
	
/* Menu color */

	#Header #menu > ul > li > a {
		color: <?php mfn_opts_show( 'color-menu-a', '#393939' ) ?>;
	}
	
	#Header #menu > ul > li.current-menu-item,
	#Header #menu > ul > li.current_page_item,
	#Header #menu > ul > li.current-menu-ancestor,
	#Header #menu > ul > li.current_page_ancestor,
	#Header #menu > ul > li:hover,
	#Header #menu > ul > li.hover {
		background: <?php mfn_opts_show( 'background-menu-a-active', '#FCFCFC' ) ?>;
	}

	#Header #menu > ul > li.current-menu-item > a,
	#Header #menu > ul > li.current_page_item > a,
	#Header #menu > ul > li.current-menu-ancestor > a,
	#Header #menu > ul > li.current_page_ancestor > a,
	#Header #menu > ul > li > a:hover,
	#Header #menu > ul > li.hover > a {
		color: <?php mfn_opts_show( 'color-menu-a-active', '#39b54a' ) ?>;
		border-top-color: <?php mfn_opts_show( 'color-menu-a-active', '#39b54a' ) ?>;
	}
	
	#Header #menu > ul > li ul {
		background: <?php mfn_opts_show( 'background-submenu-a', '#FCFCFC' ) ?>;
	}
		
	#Header #menu > ul > li ul li a {
		color: <?php mfn_opts_show( 'color-submenu-a', '#3C3C3C' ) ?>;
	}
	
	#Header #menu > ul > li ul li a:hover, 
	#Header #menu > ul > li ul li.hover > a {
		background: <?php mfn_opts_show( 'background-submenu-a-hover', '#fff' ) ?>;
		color: <?php mfn_opts_show( 'color-submenu-a-active', '#39b54a' ) ?>;
	} 
	
	#Header #menu > ul > li ul li:hover,
	#Header #menu > ul > li ul li.hover {
		border-left-color: <?php mfn_opts_show( 'color-submenu-a-active', '#39b54a' ) ?>;
	}
	
/* Header addons */

	#Top_bar p.phone {
		color: <?php mfn_opts_show( 'color-top-bar-text', '#fff' ) ?>;
	}
	
	#Top_bar p.phone i,
	#Top_bar p.mail i {
		color: <?php mfn_opts_show( 'color-phone-ico', '#D3D3D3' ) ?>;
	}
	
	#Top_bar p.mail a, #Top_bar p.phone a {
		color: <?php mfn_opts_show( 'color-phone-email', '#DAFEB6' ) ?>;
	}
	
	#Top_bar .social li a {
		color: <?php mfn_opts_show( 'color-social', '#fff' ) ?> !important;
	}
	
	#Top_bar .social li a:hover {
		color: <?php mfn_opts_show( 'color-social-hover', '#d3d3d3' ) ?> !important;
	}
	
/* Subheader */
	#Subheader {
		background-color: <?php mfn_opts_show( 'background-subheader', '#39B54A' ) ?>;
	}

	#Subheader h1 { 
		color: <?php mfn_opts_show( 'color-subheader-title', '#fff' ) ?>;
	}
	
	#Subheader ul.breadcrumbs li,
	#Subheader ul.breadcrumbs li a { 
		color: <?php mfn_opts_show( 'color-subheader-text', '#FFFFFF' ) ?>;
	}
	
	#Subheader ul.breadcrumbs li span {
		color: <?php mfn_opts_show( 'color-subheader-arrow', '#14441A' ) ?>;
	}
	
/* Frames and borders color */
	.Recent_comments li, .Recent_posts li, .get_in_touch li.label, .pricing-box .plan-inside ul li, 
	.pricing-box, .ui-widget-header, #Content .ui-tabs .ui-tabs-nav, .ui-tabs .ui-tabs-panel,
	.ui-tabs .ui-tabs-nav li, .ui-accordion .ui-accordion-header, .ui-accordion .ui-accordion-content, 
	.gallery .gallery-item .gallery-icon, .post .footer,
	#comments .commentlist > li .photo, #comments .commentlist > li, 
	#comments .commentlist li .comment-body, .Twitter ul li, .Flickr .flickr_badge_image a,
	.single-post .post .date, .pager, .single-portfolio .photo,
	.single-portfolio .sp-inside .sp-inside-right, table thead th, table td, .widget ul.menu li a,
	.widget_links ul li a, .widget_meta ul li a, .our-offer .boxes .box.first, .our-offer .boxes .box.last, .testimonial .rslides_tabs li a,
	.pager a.page, .team .links a.link, .offer .header, .offer .box, 
	blockquote div.text, .single-post .tag-cat, .get_in_touch p, .offer-page .offer-right {
		border-color: <?php mfn_opts_show( 'border-borders', '#ebebeb' ) ?>;
	}

/* Go to top */
	#Footer a#back_to_top {
		background: <?php mfn_opts_show( 'background-gototop', '#39B54A' ) ?>;
	}
	#Footer a:hover#back_to_top {
		background: <?php mfn_opts_show( 'background-gototop-hover', '#258831' ) ?>;
	}
	
/* Blog */
	.post .date {
		color: <?php mfn_opts_show( 'color-blog-icon', '#a5a5a5' ) ?>;
	}
	.post .meta .day,
	.post .meta .month {
		color: <?php mfn_opts_show( 'color-blog-day', '#31373C' ) ?>;
	}
	.post  .meta .year {
		color: <?php mfn_opts_show( 'color-blog-year', '#3cb24f' ) ?>;
	}
	.post .desc_w {
		border-color: <?php mfn_opts_show( 'border-borders', '#ebebeb' ) ?>;
	}
	.post .desc {
		background: <?php mfn_opts_show( 'background-blog-post', '#fdfdfd' ) ?>;
	}
	.post .desc .image {
		border-color: <?php mfn_opts_show( 'border-blog-image', '#39B54A' ) ?>;
	}
	
/* Footer headers and text */

	#Footer {
		border-color: <?php mfn_opts_show( 'border-footer', '#39B54A' ) ?>;
	}
	
	#Footer h1,
	#Footer h2,
	#Footer h3,
	#Footer h4,
	#Footer h5,
	#Footer h6  {
		color: <?php mfn_opts_show( 'color-footer-heading', '#fff' ) ?>;
	}
	
	#Footer, #Footer .Recent_comments ul li p i, #Footer .Recent_comments ul li p strong { 
		color: <?php mfn_opts_show( 'color-footer-text', '#E1E1E1' ) ?> !important;
	}
	
	#Footer a, #Footer .copyrights .menu_bottom > ul > li > a { 
		color: <?php mfn_opts_show( 'color-footer-a', '#3BAA35' ) ?>;
	}

	#Footer a:hover, #Footer .copyrights .menu_bottom > ul > li > a:hover { 
		color: <?php mfn_opts_show( 'color-footer-a-hover', '#74DC6F' ) ?>;
	}
	
	#Footer .copyrights .menu_bottom > ul > li.current_page_item > a {
		color: <?php mfn_opts_show( 'color-footer-menu-active', '#fff' ) ?>;
	}
	
	#Footer .social li a,
	#Footer .get_in_touch li i {
		color: <?php mfn_opts_show( 'color-footer-icon', '#D3D3D3' ) ?> !important;
	}
	#Footer .social li a:hover {
		color: <?php mfn_opts_show( 'color-footer-icon-hover', '#36BC54' ) ?> !important;
	}

/* Footer strong */
	#Footer .Twitter li span, #Footer .copy strong, #Footer .Recent_posts ul li a.title, 
	#Footer .Recent_posts ul li p i, #Footer .Recent_comments ul li p strong, #Footer .Recent_comments li span.date .day,
	#Footer .Recent_comments ul li p i, #Footer .widget_calendar caption, #Footer strong, #Footer .get_in_touch li.phone p {
		color: <?php mfn_opts_show( 'color-footer-bold-note', '#36BC54' ) ?>;
	}	
	
/* Footer grey notes */
	#Footer .Twitter ul li > a, #Footer .Recent_comments li span.date, #Footer .Recent_posts span.date {
		color: <?php mfn_opts_show( 'color-footer-note', '#A6A6A6' ) ?>;
	}
		
/* Footer frames, background & border color */	
	#Footer .Twitter li, #Footer .Flickr .flickr_badge_image a, #Footer .Recent_comments ul li, 
	#Footer .Recent_posts ul li, #Footer .widget ul.menu li a, #Footer .widget_meta ul li a, 
	#Footer table thead th, #Footer table td,
	.footer-included #Footer .container:first-child, .footer-included #Footer .container .column .widget, #Footer .get_in_touch p {
		border-color: <?php mfn_opts_show( 'border-footer-frame', '#3A3A3A' ) ?>;
	}
	
/* Call to action */
	.call_to_action h4 {
		color: <?php mfn_opts_show( 'color-call-to-action-text', '#205426' ) ?>;
	}
	
	.call_to_action h4 span {
		color: <?php mfn_opts_show( 'color-call-to-action-highlight', '#39B54A' ) ?>;
	}
	
	.call_to_action a.button {
		background-color: <?php mfn_opts_show( 'background-call-to-action-button', '#2A8F36' ) ?>;
		color: <?php mfn_opts_show( 'color-call-to-action-button', '#fff' ) ?>;	
	}
	
/* Faq & Accordion */
	.accordion .question h5, .faq .question h5 { 
		color: <?php mfn_opts_show( 'color-accordion-title', '#393939' ) ?>;
	}
	.accordion .question .answer, .faq .question .answer { 
		background-color: <?php mfn_opts_show( 'background-accordion-content', '#FCFCFC' ) ?> !important; 
	}	

/* Tabs */
	.ui-tabs .ui-tabs-nav li a {
		color: <?php mfn_opts_show( 'color-accordion-title', '#393939' ) ?>;
	}
	.ui-tabs .ui-tabs-nav li.ui-tabs-selected a, .ui-tabs .ui-tabs-nav li.ui-state-active a {
		color: <?php mfn_opts_show( 'color-tabs-title-active', '#fff' ) ?>;
	}
	.ui-tabs .ui-tabs-panel { 
		background-color: <?php mfn_opts_show( 'background-accordion-content', '#FCFCFC' ) ?> !important; 
	}
	
/* Submenu */
	.widget ul.menu li a { 
		color: <?php mfn_opts_show( 'color-mfn-menu-link', '#475363' ) ?> !important;
	}
	.widget ul.menu li.current_page_item a, 
	.widget ul.menu li a:hover {
		color: <?php mfn_opts_show( 'color-mfn-menu-link-active', '#fff' ) ?> !important; 
	}
	.widget ul.menu li a i.icon-caret-right, .widget ul.menu li a i.icon-caret-left {
		color: <?php mfn_opts_show( 'color-mfn-menu-arrow-active', '#349642' ) ?>;
	}

/* Feature box */
	.feature_box .photo .desc .desc_i h4,
	.feature_box .photo .desc .desc_i span.icon {
		color: <?php mfn_opts_show( 'color-feature-box-title', '#fff' ) ?>;
	}
	
/* Our team */
	.team .photo .info h4 {
		color: <?php mfn_opts_show( 'color-our-team-title', '#fff' ) ?>;
		background: <?php mfn_opts_show( 'background-our-team-title', '#39B54A' ) ?>;
	}
	.team .photo .info p {
		color: <?php mfn_opts_show( 'color-our-team-subtitle', '#fff' ) ?>;
		background: <?php mfn_opts_show( 'background-our-team-subtitle', '#2E7A39' ) ?>;
	}
	
/* Buttons */
	a.button, input[type="submit"], input[type="reset"], input[type="button"],
	.widget_mfn_clients a.rslides_nav {
		background-color: <?php mfn_opts_show( 'background-button', '#fff' ) ?>;
		color: <?php mfn_opts_show( 'color-button', '#454444' ) ?>;
		text-shadow: 1px 1px 0 <?php mfn_opts_show( 'shadow-button', '#fff' ) ?>;
	}
	
	a.button span, input[type="submit"] span, input[type="reset"] span, input[type="button"] span {
		color: <?php mfn_opts_show( 'color-button-arrow', '#b6b6b6' ) ?>;
	}
	
/* Slider */
	#mfn-offer-slider ul.slider-wrapper > li .slide-desc h2 {
		color: <?php mfn_opts_show( 'color-slider-title', '#fff' ) ?>;
		background: <?php hex2rgba( mfn_opts_get( 'background-slider-title', '#39B54A' ), 0.9, true ) ?>; 
	}
	#mfn-offer-slider ul.slider-wrapper > li .slide-desc p {
		color: <?php mfn_opts_show( 'color-slider-subtitle', '#fff' ) ?>;
		background: <?php hex2rgba( mfn_opts_get( 'background-slider-subtitle', '#2E7A39' ), 0.9, true ) ?>;
	}
