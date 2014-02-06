<?php
/**
 * The template used for displaying page content in page.php and Page Templates
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */
?>

<?php 
	
	$classes = array(
		'1/4' => 'one-fourth',
		'1/3' => 'one-third',
		'1/2' => 'one-second',
		'2/3' => 'two-third',
		'3/4' => 'three-fourth',
		'1/1' => 'one'
	);
	
	$mfn_items = get_post_meta($post->ID, 'mfn-page-items', true);
	$mfn_tmp_fn = 'base'.'64_decode';
	$mfn_items = unserialize(call_user_func($mfn_tmp_fn, $mfn_items));	
//	print_r($mfn_items);

	if( is_array( $mfn_items ) )
	{
		foreach( $mfn_items as $item )
		{
			if( function_exists( 'mfn_print_'. $item['type'] ) )
			{
				
				if( $item['type']=='content' ){
					$mb = intval( $item['fields']['margin'] );
					$style = ' style="margin-bottom:'. $mb .'px;"';
				} elseif( $item['type']=='divider' ){
					$style = ' style="margin-top:0px; margin-bottom:0px;"';
				} else {
					$style = false;
				}
				
				echo '<div class="column '. $classes[$item['size']] .'"'. $style .'>';
					call_user_func( 'mfn_print_'. $item['type'], $item );
				echo '</div>';
				
			}
		}
	}
?>

<?php if( ! get_post_meta( $post->ID, 'mfn-post-hide-content', true ) && get_the_content() ): ?>
	<div class="the_content the_content_wrapper">
		<?php the_content(); ?>
	</div>
<?php endif; ?>	