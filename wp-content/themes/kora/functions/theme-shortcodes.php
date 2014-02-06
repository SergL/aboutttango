<?php
/**
 * Shortcodes.
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */

// column shortcodes --------------------
add_shortcode( 'one', 'sc_one' );
add_shortcode( 'one_second', 'sc_one_second' );
add_shortcode( 'one_third', 'sc_one_third' );
add_shortcode( 'two_third', 'sc_two_third' );
add_shortcode( 'one_fourth', 'sc_one_fourth' );
add_shortcode( 'two_fourth', 'sc_two_fourth' );
add_shortcode( 'three_fourth', 'sc_three_fourth' );

// builder items --------------------
add_shortcode( 'blockquote', 'sc_blockquote' );
add_shortcode( 'call_to_action', 'sc_call_to_action' );
add_shortcode( 'code', 'sc_code' );
add_shortcode( 'contact_box', 'sc_contact_box' );
add_shortcode( 'divider', 'sc_divider' );
add_shortcode( 'map', 'sc_map' );
add_shortcode( 'our_team', 'sc_our_team' );

// content shortcodes -------------------
add_shortcode( 'button', 'sc_button' );
add_shortcode( 'ico', 'sc_ico' );
add_shortcode( 'image', 'sc_image' );
add_shortcode( 'vimeo', 'sc_vimeo' );
add_shortcode( 'youtube', 'sc_youtube' );


/* ---------------------------------------------------------------------------
 * Shortcode [one] [/one]
 * --------------------------------------------------------------------------- */
function sc_one( $attr, $content = null )
{
	$output  = '<div class="column one">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [one_second] [/one_second]
 * --------------------------------------------------------------------------- */
function sc_one_second( $attr, $content = null )
{
	$output  = '<div class="column one-second">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [one_third] [/one_third]
 * --------------------------------------------------------------------------- */
function sc_one_third( $attr, $content = null )
{
	$output  = '<div class="column one-third">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}

/* ---------------------------------------------------------------------------
 * Shortcode [two_third] [/two_third]
 * --------------------------------------------------------------------------- */
function sc_two_third( $attr, $content = null )
{
	$output  = '<div class="column two-third">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [one_fourth] [/one_fourth]
 * --------------------------------------------------------------------------- */
function sc_one_fourth( $attr, $content = null )
{
	$output  = '<div class="column one-fourth">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [two_fourth] [/two_fourth]
 * --------------------------------------------------------------------------- */
function sc_two_fourth( $attr, $content = null )
{
	$output  = '<div class="column two-fourth">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [three_fourth] [/three_fourth]
 * --------------------------------------------------------------------------- */
function sc_three_fourth( $attr, $content = null )
{
	$output  = '<div class="column three-fourth">';
	$output .= do_shortcode($content);
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [call_to_action]
 * --------------------------------------------------------------------------- */
function sc_call_to_action( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'text' => '',
		'btn_title' => '',
		'btn_link' => '',
		'class' => '',
	), $attr));
	
	$output = '<div class="call_to_action">';
		$output .= '<div class="inside">';
			$output .= '<h4>'. $text .'</h4>';
			if( $btn_link ) $output .= '<a href="'. $btn_link .'" class="button button_large '. $class .'">'. $btn_title .'</a>';
		$output .= '</div>';
	$output .= '</div>'."\n";
		
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [code] [/code]
 * --------------------------------------------------------------------------- */
function sc_code( $attr, $content = null )
{
	$output  = '<div class="inner-padding">';
		$output .= '<pre>';
			$output .= do_shortcode(htmlspecialchars($content));
		$output .= '</pre>'."\n";
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [article_box] [/article_box]
 * --------------------------------------------------------------------------- */
function sc_article_box( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'image' => '',
		'title' => '',
		'link_title' => '',
		'link' => '',
		'target' => '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"'; 
	} else { 
		$target = false;
	}
	
	$output = '<div class="article_box">';
		$output .= '<div class="photo">';
			$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
		$output .= '</div>';
		$output .= '<div class="desc">';
			$output .= '<h3>'. $title .'</h3>';
			$output .= '<p>'. do_shortcode($content) .'</p>';
			if( $link ) $output .= '<a class="button" href="'. $link .'" '. $target .'>'. $link_title .' <span>&rarr;</span></a>';
		$output .= '</div>';
	$output .= '</div>'."\n";
		
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [feature_box]
* --------------------------------------------------------------------------- */
function sc_feature_box( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'image' => '',
		'background' => '',
		'title' => '',
		'link' => '',
		'target' => '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}

	$output = '<div class="feature_box">';
		$output .= '<div class="photo">';
			if( $link )  $output .= '<a href="'. $link .'" '. $target .'>';
				$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
				$output .= '<div class="desc '. $background .'">';
					$output .= '<div class="desc_i">';
						$output .= '<h4>'. $title .'</h4>';
						$output .= '<span class="icon"><i class="icon-chevron-right"></i></span>';
					$output .= '</div>';
				$output .= '</div>';
			if( $link )  $output .= '</a>';
		$output .= '</div>';
	$output .= '</div>'."\n";
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [contact_box]
 * --------------------------------------------------------------------------- */
function sc_contact_box( $attr, $content = null )
{	
	extract(shortcode_atts(array(
		'title' => '',
		'address' => '',
		'telephone' => '',
		'fax' => '',
		'email' => '',
		'www' => '',
	), $attr));
	
	$output = '<div class="get_in_touch inner-padding">';
		$output .= '<h3>'. $title .'</h3>';
		$output .= '<ul>';
			if( $address ){
				$output .= '<li class="address">';
					$output .= '<i class="icon-map-marker"></i><p>'. $address .'</p>';
				$output .= '</li>';
			}
			if( $telephone ){
				$output .= '<li class="phone">';
					$output .= '<i class="icon-phone"></i><p>'. $telephone .'</p>';
				$output .= '</li>';
			}
			if( $fax ){
				$output .= '<li class="fax">';
					$output .= '<i class="icon-print"></i><p>'. $fax .'</p>';
				$output .= '</li>';
			}
			if( $email ){
				$output .= '<li class="mail">';
					$output .= '<i class="icon-envelope"></i><p><a href="mailto:'. $email .'">'. $email .'</a></p>';
				$output .= '</li>';
			}
			if( $www ){
				$output .= '<li class="www">';
					$output .= '<i class="icon-globe"></i><p><a href="http://'. $www .'">'. $www .'</a></p>';
				$output .= '</li>';
			}
		$output .= '</ul>';
	$output .= '</div>'."\n";
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [contact_form]
 * --------------------------------------------------------------------------- */
function sc_contact_form( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' => '',
		'email' => '',
	), $attr));
	
	$translate['contact-name'] = mfn_opts_get('translate') ? mfn_opts_get('translate-contact-name','Your name') : __('Your name','kora');
	$translate['contact-email'] = mfn_opts_get('translate') ? mfn_opts_get('translate-contact-email','Your e-mail') : __('Your e-mail','kora');
	$translate['contact-subject'] = mfn_opts_get('translate') ? mfn_opts_get('translate-contact-subject','Subject') : __('Subject','kora');
	$translate['contact-submit'] = mfn_opts_get('translate') ? mfn_opts_get('translate-contact-submit','Send message') : __('Send message','kora');
	$translate['contact-message-success'] = mfn_opts_get('translate') ? mfn_opts_get('translate-contact-message-success','Thanks, your email was sent.') : __('Thanks, your email was sent.','kora');
	$translate['contact-message-error'] = mfn_opts_get('translate') ? mfn_opts_get('translate-contact-message-error','Error sending email. Please try again later.') : __('Error sending email. Please try again later.','kora');

	$output = '<div class="inner-padding">';
		if( $title ) $output .= '<h3>'. $title .'</h3>';
		$output .= '<div class="contact_form">';
			$output .= '<form id="json_contact_form" method="POST" action="'. LIBS_URI .'/theme-mail.php">';
				$output .= '<input type="hidden" name="To" value="'. $email .'" />';
				$output .= '<fieldset>';
					$output .= '<input id="Name" class="nick required" name="Name" placeholder="'. $translate['contact-name'] .'" type="text" />';
					$output .= '<input id="Email" class="email required" name="Email" placeholder="'. $translate['contact-email'] .'" type="text" />';
					$output .= '<input id="Subject" class="subject" name="Subject" placeholder="'. $translate['contact-subject'] .'" type="text" />';
					$output .= '<textarea id="Message" name="Message" class="required"></textarea>';
					$output .= '<input type="submit" value="'. $translate['contact-submit'] .'" />';
				$output .= '</fieldset>';
			$output .= '</form>';
			$output .= '<div class="alert_success" style="display:none;">'. $translate['contact-message-success'] .'</div>';
			$output .= '<div class="alert_error" style="display:none;">'. $translate['contact-message-error'] .'</div>';
		$output .= '</div>';
	$output .= '</div>'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [divider]
 * --------------------------------------------------------------------------- */
function sc_divider( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'height' => '0',
		'line' => '',
	), $attr));
	
	$line = ( $line ) ? false : ' border:none; width:0; height:0;';		
	$output = '<hr style="margin: 0 0 '. intval($height) .'px;'. $line .'" />'."\n";
	
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [pricing_item] [/pricing_item]
 * --------------------------------------------------------------------------- */
function sc_pricing_item( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' => '',
		'price' => '',
		'currency' => '',
		'period' => '',
		'link_title' => '',
		'link' => '',
		'featured' => '',
	), $attr));
	
	$classes = '';
	
	// featured
	if( $featured ){
		$classes .= ' pricing-box-featured';
	}
	
	// no price
	if( ! $price ){
		$classes .= ' no-price';
	}

	$output = '<div class="pricing-box'. $classes .'">';
		$output .= '<div class="plan-header">';
			$output .= '<h3>'. $title .'</h3>';
			if( $price ) $output .= '<div class="price"><span><sup>'. $currency .'</sup>'. $price .'<sup class="period">'. $period .'</sup></span></div>';
		$output .= '</div>';
		$output .= '<div class="plan-inside">';
			$output .= do_shortcode($content);
		$output .= '</div>';
		if( $link ) $output .= '<div class="btn"><center><a class="button" href="'. $link .'">'. $link_title .'</a></center></div>';
	$output .= '</div>'."\n";
		
    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [ico]
 * --------------------------------------------------------------------------- */
function sc_ico( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'type' => '',
	), $attr));
	
	$output = '<i class="'. $type .'"></i>';

	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [image]
 * --------------------------------------------------------------------------- */
function sc_image( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'src' => '',
		'alt' => '',
		'caption' => '',
		'align' => '',
		'link' => '',
		'link_image' => '',
		'link_type' => '',
		'target' => '',
		'border' => '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}
	
	// border
	if( $border ){
		$border = ' border';
	} else {
		$border = ' no-border';
	}
	
	// align
	if( $align ) $align = ' align'. $align;
	
	// hoover icon
	if( $link_type == 'zoom' || $link_image )	{
		$class= 'fancybox';
		$link_type = 'icon-eye-open';
		$target = '';
	} else {
		$class = '';
		$link_type = 'icon-link';
	}
	
	// link
	if( $link_image ) $link = $link_image;
	
	if( $link )
	{
		$output  = '<div class="scale-with-grid wp-caption'. $align . $border .'">';
			$output .= '<div class="photo">';
				$output .= '<div class="photo_wrapper">';
					$output .= '<a href="'. $link .'" class="'. $class .'" '. $target .'>';
						$output .= '<img class="scale-with-grid" src="'. $src .'" alt="'. $alt .'" />';
						$output .= '<div class="mask"></div>';
    					$output .= '<i class="'. $link_type .'"></i>';
					$output .= '</a>';
				$output .= '</div>';
			$output .= '</div>';
			if( $caption ) $output .= '<p class="wp-caption-text">'. $caption .'</p>';
		$output .= '</div>'."\n";
	}
	else 
	{
		$output  = '<div class="scale-with-grid wp-caption no-hover'. $align . $border .'">';
			$output .= '<div class="photo">';
				$output .= '<div class="photo_wrapper">';
					$output .= '<img class="scale-with-grid" src="'. $src .'" alt="'. $alt .'" />';
				$output .= '</div>';
			$output .= '</div>';
			if( $caption ) $output .= '<p class="wp-caption-text">'. $caption .'</p>';
		$output .= '</div>'."\n";
	}

    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [latest_posts]
* --------------------------------------------------------------------------- */
function sc_latest_posts( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' => '',
		'category' => '',
		'pager' => '',
		'count' => 5,
	), $attr));
	
	$translate['comments'] = mfn_opts_get('translate') ? mfn_opts_get('translate-comments','Comments:') : __('Comments:','kora');
	
	// slider arrows
	if( $pager ){
		$pager = false;
	} else {
		$pager = ' no-pager';
	}
	
	$args = array(
		'posts_per_page' => $count ? intval($count) : 0,
		'no_found_rows' => true,
		'post_status' => 'publish',
		'ignore_sticky_posts' => true
	);
	if( $category ) $args['category_name'] = $category;

	$r = new WP_Query( apply_filters( 'widget_posts_args', $args ) );

	$output = '<div class="Latest_posts' . $pager .'">';
		$output .= '<div class="header">';
			$output .= '<h3>'. $title .'</h3>';
		$output .= '</div>';
			
		if ($r->have_posts()){
			$output .= '<ul class="latest-post-slider-wrapper jcarousel-skin-tango">';
			
				$color_number = 0;
			
				while ( $r->have_posts() ){
					$r->the_post();
					
					$color_name = 'mfn-border-'. ( ( $color_number % 4 ) + 1 );
					
					$output .= '<li class="column one-third">';
						$output .= '<div class="box">';
							$output .= '<div class="details">';
								$output .= '<div class="date"><i class="icon-time"></i> '. get_the_time('F j, Y') .'</div>';
								$output .= '<div class="comments">'. $translate['comments'] .' <a href="'. get_permalink() .'#comments">'. get_comments_number() .'</a></div>';			
							$output .= '</div>';
							$output .= '<div class="photo '. $color_name .'">';

								if( $video = get_post_meta(get_the_ID(), 'mfn-post-vimeo', true) )
									$output .= '<div class="image iframe"><iframe class="scale-with-grid" src="http://player.vimeo.com/video/'. $video .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'."\n";
								elseif( $video = get_post_meta(get_the_ID(), 'mfn-post-youtube', true) )
									$output .= '<iframe class="scale-with-grid" src="http://www.youtube.com/embed/'. $video .'?wmode=opaque&rel=0" frameborder="0" allowfullscreen></iframe>';
								elseif( has_post_thumbnail() )
									$output .= get_the_post_thumbnail( get_the_ID(), 'blog-slider', array('class'=>'scale-with-grid') );
	
							$output .= '</div>';
							$output .= '<div class="desc">';
								$output .= '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
								if( $blog_readmore = mfn_opts_get( 'blog-readmore' ) ) $output .= '<a href="'. get_permalink() .'" class="button">'. $blog_readmore .' <span>&rarr;</span></a>';
							$output .= '</div>';
						$output .= '</div>';
					$output .= '</li>';
					
					$color_number += 1;
				}
			wp_reset_postdata();
			$output .= '</ul>';
		}

	$output .= '</div>'."\n";
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [button]
 * --------------------------------------------------------------------------- */
function sc_button( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'size' => '',
		'color' => '',
		'title' => 'Read more',
		'link' => '',
		'target' => '',
		'class' => '',
	), $attr));
	
	// target
	if( $target ){
		$target = 'target="_blank"';
	} else {
		$target = false;
	}
						
	$output = '<a class="button button_'. $size .' button_'. $color .' '. $class .'" href="'. $link .'" '. $target .'>'. $title .'</a>'."\n";

    return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [blockquote] [/blockquote]
 * --------------------------------------------------------------------------- */
function sc_blockquote( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'author' => '',
		'link' => '',
		'link_title' => '',
		'target' => '',
	), $attr));
	
	$output = '<div class="inner-padding">';
	
		$output .= '<blockquote>';
			$output .= '<div class="inside">';
				$output .= '<div class="text">';
					$output .= '<p class="bq">'. do_shortcode($content) .'</p>';
				$output .= '</div>';
				$output .= '<p class="author">';
					$output .= '<strong><span>'. $author. '</span></strong>';
					if( $link ){
						if( $target ){
							$target = 'target="_blank"';
						} else {
							$target = false;
						}
						$output .= ', <i class="icon-external-link"></i> <a href="'. $link .'" '. $target .'>'. $link_title .'</a>';
					}
				$output .= '</p>';
			$output .= '</div>';
		$output .= '</blockquote>';
		
	$output .= '</div>'."\n";	

	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [offer_page]
* --------------------------------------------------------------------------- */
function sc_offer_page( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
	), $attr));

	$args = array(
			'post_type' => 'offer',
			'posts_per_page' => -1,
			'paged' => -1,
			'orderby' => $orderby,
			'order' => $order,
			'ignore_sticky_posts' =>1,
	);

	$offer_query = new WP_Query();
	$offer_query->query( $args );
	$post_count = $offer_query->post_count;
	
	$side = array(
		0 => 'left',
		1 => 'right'
	);

	if ($offer_query->have_posts())
	{
		$output  = '<div class="offer-page">';
			$i = 0;
			while ($offer_query->have_posts())
			{
				$offer_query->the_post();
				
				$class = $side[ $i % 2 ];
				$output .= '<div class="offer-item offer-'. $class .'">';
					$output .= '<div class="photo">';
						$output .= get_the_post_thumbnail( null, 'offer-list', array('class'=>'scale-with-grid' ) );
					$output .= '</div>';
					$output .= '<div class="desc">';
						$output .= '<h3>'. the_title(false, false, false) .'</h3>';
						$output .= do_shortcode( get_the_content(false) );
					$output .= '</div>';
				$output .= '</div>';
				
				if( $i % 2 == 1 ) $output .= '<br style="clear:both;" />';
				
				$i++;
			}
		$output .= '</div>'."\n";
	}
	wp_reset_query();

	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [offer]
 * --------------------------------------------------------------------------- */
function sc_offer( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'title' => '',
		'page' => '',
		'link_title' => 'Read more',
		'count' => '-1',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'pager' => '',
	), $attr));
	
	// page link
	if( $page ){
		$page_link = get_page_link( $page );
	} else {
		$page_link = false;
	}
	
	// slider arrows
	if( $pager ){
		$pager = false;
	} else {
		$pager = ' no-pager';
	}
	
	$args = array(
		'post_type' => 'offer',
		'posts_per_page' => intval($count),
		'paged' => -1,
		'orderby' => $orderby,
		'order' => $order,
		'ignore_sticky_posts' =>1,
	);
	
	$offer_query = new WP_Query();
	$offer_query->query( $args );
// 	$post_count = $offer_query->post_count;
	
	$output = '';
	if ($offer_query->have_posts())
	{
		$output .= '<div class="offer'. $pager .'">';
	
			$output .= '<div class="header">';
				$output .= '<h3>'. $title .'</h3>';
				$output .= '<a href="#" class="slider_control slider_control_prev"><i class="icon-chevron-left"></i></a>';
				$output .= '<a href="#" class="slider_control slider_control_next"><i class="icon-chevron-right"></i></a>';
			$output .= '</div>';
			
			$output .= '<div class="offer-slider-wrapper">';
				$output .= '<ul class="jcarousel-skin-tango">';
			
					while ($offer_query->have_posts())
					{
						$offer_query->the_post();
						
						// link to offer page or custom page
						if( get_post_meta( get_the_ID(), 'mfn-post-link', true ) ){
							// custom single offer page
							$link = get_post_meta( get_the_ID(), 'mfn-post-link', true );
						} else {
							// offer page
							$link = $page_link;
						}
						
						$output .= '<li class="column one-third">';
							$output .= '<div class="box">';
								$output .= '<div class="photo">';
									$output .= get_the_post_thumbnail( null, 'offer-item', array('class'=>'scale-with-grid' ) );
								$output .= '</div>';
								$output .= '<div class="desc">';
									$output .= '<h4>';
										if( $link ) $output .= '<a href="'. $link .'">';
											$output .= the_title(false, false, false);
										if( $link ) $output .= '</a>';
									$output .= '</h4>';
									if( $link )  $output .= '<a class="more" href="'. $link .'">'. $link_title .'</a> <span class="link_ico">&rarr;</span>';
								$output .= '</div>';
							$output .= '</div>';
						$output .= '</li>';
					}
					
				$output .= '</ul>';
			$output .= '</div>';

		$output .= '</div>'."\n";
	}
	wp_reset_query();
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [our_team]
 * --------------------------------------------------------------------------- */
function sc_our_team( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'image' => '',	
		'title' => '',
		'subtitle' => '',
		'email' => '',
		'facebook' => '',
		'twitter' => '',
		'linkedin' => '',
	), $attr));
	
	$skin = mfn_opts_get('skin','blue');
	if( $skin == 'custom' ){
		$skin = 'blue';
	}
	
	$output = '<div class="team">';
		$output .= '<div class="photo">';
			$output .= '<img class="scale-with-grid" src="'. $image .'" alt="'. $title .'" />';
			$output .= '<div class="info">';
				if( $title ) $output .= '<h4>'. $title .'</h4>';
				if( $subtitle ) $output .= '<p>'. $subtitle .'</p>';
			$output .= '</div>';
		$output .= '</div>';
		$output .= '<div class="desc">';
			$output .= '<div class="links">';
				if( $email ) $output .= '<a target="_blank" class="link link_1" href="mailto:'. $email .'"><i class="icon-envelope"></i></a>';
				if( $facebook ) $output .= '&nbsp;<a target="_blank" class="link link_2" href="'. $facebook .'"><i class="icon-facebook"></i></a>';
				if( $twitter ) $output .= '&nbsp;<a target="_blank" class="link link_3" href="'. $twitter .'"><i class="icon-twitter"></i></a>';
				if( $linkedin ) $output .= '&nbsp;<a target="_blank" class="link link_4" href="'. $linkedin .'"><i class="icon-linkedin"></i></a>';
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>'."\n";	

	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [map]
 * --------------------------------------------------------------------------- */
function sc_map( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'lat' => '',
		'lng' => '',
		'height' => 200,
		'zoom' => 13,
		'uid' => uniqid(),
	), $attr));
	
	$output  = '<script src="http://maps.google.com/maps/api/js?sensor=false"></script>'."\n";
	$output .= '<script>';
		//<![CDATA[
		$output .= 'function google_maps_'. $uid .'(){';
			$output .= 'var latlng = new google.maps.LatLng('. $lat .','. $lng .');';
			$output .= 'var myOptions = {';
				$output .= 'zoom: '. intval($zoom) .',';
				$output .= 'center: latlng,';
				$output .= 'zoomControl: true,';
				$output .= 'mapTypeControl: false,';
				$output .= 'streetViewControl: false,';
				$output .= 'scrollwheel: false,';       
				$output .= 'mapTypeId: google.maps.MapTypeId.ROADMAP';
			$output .= '};';
	
			$output .= 'var map = new google.maps.Map(document.getElementById("google-map-area-'. $uid .'"), myOptions);';
			$output .= 'var marker = new google.maps.Marker({';
				$output .= 'position: latlng,';
				$output .= 'map: map,';
			$output .= '});';
		$output .= '}';
	
		$output .= 'jQuery(document).ready(function($){';
			$output .= 'google_maps_'. $uid .'();';
		$output .= '});';	
		//]]>
	$output .= '</script>'."\n";

	$output .= '<div id="google-map-area-'. $uid .'" style="width:100%; height:'. intval($height) .'px;">&nbsp;</div>'."\n";	

	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [tabs] [/tabs]
 * --------------------------------------------------------------------------- */
global $tabs_array, $tabs_count;
function sc_tabs( $attr, $content = null )
{
	global $tabs_array, $tabs_count;
	
	extract(shortcode_atts(array(
		'uid' => uniqid(),
		'tabs' => '',
	), $attr));	
	do_shortcode( $content );
	
	// content builder
	if( $tabs ){
		$tabs_array = $tabs;
	}
	
	if( is_array( $tabs_array ) )
	{
		$output  = '<div class="jq-tabs">';
		$output .= '<ul>';
		
		$i = 1;
		$output_tabs = '';
		foreach( $tabs_array as $tab )
		{
			$output .= '<li><a href="#tab-'. $uid .'-'. $i .'">'. $tab['title'] .'</a></li>';
			$output_tabs .= '<div id="tab-'. $uid .'-'. $i .'">'. do_shortcode( $tab['content'] ) .'</div>';
			$i++;
		}
		
		$output .= '</ul>';
		$output .= $output_tabs;
		$output .= '</div>';
		
		$tabs_array = '';
		$tabs_count = 0;

		return $output;
	}
}


/* ---------------------------------------------------------------------------
 * Shortcode [tab] [/tab]
 * --------------------------------------------------------------------------- */
$tabs_count = 0;
function sc_tab( $attr, $content = null )
{
	global $tabs_array, $tabs_count;
	
	extract(shortcode_atts(array(
		'title' => 'Tab title',
	), $attr));
	
	$tabs_array[] = array(
		'title' => $title,
		'content' => do_shortcode( $content )
	);	
	$tabs_count++;

	return true;
}


/* ---------------------------------------------------------------------------
 * Shortcode [accordion] [/accordion]
 * --------------------------------------------------------------------------- */
function sc_accordion( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'count' => '',
		'tabs' => '',
	), $attr));
	
	$output  = '<div class="mfn-acc accordion">';
	
	if( is_array( $tabs ) ){
		// content builder
		foreach( $tabs as $tab ){
			$output .= '<div class="question">';
				$output .= '<h5>'. $tab['title'] .'</h5>';
				$output .= '<div class="answer">';
					$output .= do_shortcode($tab['content']);	
				$output .= '</div>';
			$output .= '</div>'."\n";
		}
	} else {
		// shortcode
		$output .= do_shortcode($content);	
	}
	
	$output .= '</div>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [faq] [/faq]
 * --------------------------------------------------------------------------- */
function sc_faq( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'count' => '',
		'tabs' => '',
	), $attr));
	
	$output  = '<div class="mfn-acc faq">';
	
	if( is_array( $tabs ) ){
		// content builder
		foreach( $tabs as $tab ){
			$output .= '<div class="question">';
				$output .= '<h5>'. $tab['title'] .'</h5>';
				$output .= '<div class="answer">';
					$output .= do_shortcode($tab['content']);	
				$output .= '</div>';
			$output .= '</div>'."\n";
		}
	} else {
		// shortcode
		$output .= do_shortcode($content);	
	}
	
	$output .= '</div>'."\n";

	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [testimonials]
* --------------------------------------------------------------------------- */
function sc_testimonials( $attr, $content = null )
{
	extract(shortcode_atts(array(
	'title' => '',
	'category' => '',
	'orderby' => 'menu_order',
	'order' => 'ASC',
	), $attr));
	
	$args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => -1,
		'orderby' => $orderby,
		'order' => $order,
		'ignore_sticky_posts' =>1,
	);
	if( $category ) $args['testimonial-types'] = $category;
	
	$query = new WP_Query();
	$query->query( $args );
	$post_count = $query->post_count;
	
	if ($query->have_posts())
	{
	
		$output = '<div class="testimonial inner-padding">';
			$output .= '<div class="header">';
				$output .= '<h3>'. $title .'</h3>';
			$output .= '</div>';
			$output .= '<ul class="slider">';
		
				while ($query->have_posts())
				{
					$query->the_post();
						
					$output .= '<li>';
						$output .= '<blockquote>';
							$output .= '<div class="inside">';
								$output .= '<div class="text">';
									$output .= '<p class="bq">'. get_the_content() .'</p>';
								$output .= '</div>';
								$output .= '<p class="author">';
									$output .= '<span>'. get_post_meta(get_the_ID(), 'mfn-post-author', true). '</span>';
									if( $link = get_post_meta(get_the_ID(), 'mfn-post-link', true) ){
										if( $target = get_post_meta(get_the_ID(), 'mfn-post-target', true) ){
											$target = 'target="_blank"';
										} else {
											$target = false;
										}
										$output .= ', <i class="icon-external-link"></i> <a href="'. $link .'" '. $target .'>'. get_post_meta(get_the_ID(), 'mfn-post-link_title', true) .'</a>';
									}
								$output .= '</p>';
							$output .= '</div>';					
						$output .= '</blockquote>';
					$output .= '</li>';
				}
		
			$output .= '</ul>';
		$output .= '</div>'."\n";
	}
	wp_reset_query();
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [vimeo]
 * --------------------------------------------------------------------------- */
function sc_vimeo( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'width' => '710',
		'height' => '426',
		'video' => '',
	), $attr));
	
	$output  = '<div class="article_video">';
	$output .= '<iframe class="scale-with-grid" width="'. $width .'" height="'. $height .'" src="http://player.vimeo.com/video/'. $video .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'."\n";
	$output .= '</div>';
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [youtube]
 * --------------------------------------------------------------------------- */
function sc_youtube( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'width' => '710',
		'height' => '426',
		'video' => '',
	), $attr));
	
	$output  = '<div class="article_video">';
	$output .= '<iframe class="scale-with-grid" width="'. $width .'" height="'. $height .'" src="http://www.youtube.com/embed/'. $video .'?wmode=opaque" frameborder="0" allowfullscreen></iframe>'."\n";
	$output .= '</div>';
	
	return $output;
}


/* ---------------------------------------------------------------------------
 * Shortcode [clients]
 * --------------------------------------------------------------------------- */
function sc_clients( $attr, $content = null )
{
	extract(shortcode_atts(array(
		'pager' => '',
		'count' => -1,
	), $attr));
	
	// slider arrows
	if( $pager ){
		$pager = false;
	} else {
		$pager = ' no-pager';
	}
	
	if( ! intval($count) ) $count = -1;
	$args = array( 
		'post_type' => 'client',
		'posts_per_page' => $count,
		'orderby' => 'menu_order',
		'order' => 'ASC',
	);
	
	$query = new WP_Query();
	$query->query( $args );

	$output  = '<div class="Our_clients_slider'. $pager .'">';
		$output .= '<a href="#" class="slider_control slider_control_prev"><i class="icon-chevron-left"></i></a>';
		$output .= '<a href="#" class="slider_control slider_control_next"><i class="icon-chevron-right"></i></a>';
		$output .= '<div class="inside">';
			if ($query->have_posts())
			{
				$output .= '<ul>';
				while ($query->have_posts())
				{
					$query->the_post();	
					$output .= '<li>';
						$output .= '<div class="slide-wrapper">';
							$link = get_post_meta(get_the_ID(), 'mfn-post-link', true);
							if( $link ) $output .= '<a target="_blank" href="'. $link .'" title="'. the_title(false, false, false) .'">';
								$output .= get_the_post_thumbnail( null, 'clients-slider', array('class'=>'scale-with-grid') );
							if( $link ) $output .= '</a>';
						$output .= '</div>';				
					$output .= '</li>';				
				}
				$output .= '</ul>'."\n";
			}
			wp_reset_query();
		$output .= '</div>';
	$output .= '</div>'."\n";

	return $output;
}


?>