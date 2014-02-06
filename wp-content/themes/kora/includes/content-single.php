<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */

$translate['category'] = mfn_opts_get('translate') ? mfn_opts_get('translate-category','Category:') : __('Category:','kora');
$translate['comments'] = mfn_opts_get('translate') ? mfn_opts_get('translate-comments','Comments:') : __('Comments:','kora');
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	
	<?php 
		$posts_meta = array();
		$posts_meta['categories'] = get_post_meta($post->ID, 'mfn-post-categories', true);
		$posts_meta['comments'] = get_post_meta($post->ID, 'mfn-post-comments', true);
		$posts_meta['time'] = get_post_meta($post->ID, 'mfn-post-time', true);
		$posts_meta['tags'] = get_post_meta($post->ID, 'mfn-post-tags', true);
	?>
	
	<div class="meta">
		
		<?php if( $posts_meta['time'] ): ?>
			<div class="date">
				<i class="icon-calendar"></i>
				<span class="day"><?php printf( '%1$s', get_the_time('j') ); ?></span>
				<span class="month"><?php printf('%1$s', get_the_time('F') ); ?></span>
				<span class="year"><?php printf( '%1$s', get_the_time('Y') ); ?></span>
			</div>
		<?php endif; ?>
		
		<?php if( $posts_meta['comments'] ): ?>
			<div class="comments">
				<p><?php echo $translate['comments']; ?></p>
				<span>
					<i class="icon-comment-alt"></i> 
					<?php comments_popup_link( 0, _x( '1', 'comments number', 'kora' ), _x( '%', 'comments number', 'kora' ), false, __('Off','kora') ); ?>
				</span>
			</div>
		<?php endif; ?>
		
	</div>
	
	<div class="desc_w">
		<div class="post_type post_type_article"></div>
		<div class="desc">
			
			<div class="r_meta">
				<?php if( $posts_meta['time'] ): ?>
					<i class="icon-calendar"></i>&nbsp;<?php printf( '%1$s', get_the_time('F j, Y') ); ?>
				<?php endif; ?>
				<?php if( $posts_meta['comments'] ): ?>
					<div class="comments">
						<i class="icon-comment-alt"></i>&nbsp;<?php comments_popup_link( 0, _x( '1', 'comments number', 'kora' ), _x( '%', 'comments number', 'kora' ), false, __('Off','kora') ); ?>
					</div>
				<?php endif; ?>
			</div>
			
			<div class="image">
				<?php 
					if( $blog_slider = get_post_meta( get_the_ID(), 'mfn-post-slider', true ) ){
						putRevSlider( $blog_slider );
					} elseif( $video = get_post_meta($post->ID, 'mfn-post-vimeo', true) ){
						echo '<iframe class="scale-with-grid" src="http://player.vimeo.com/video/'. $video .'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'."\n";
					} elseif( $video = get_post_meta($post->ID, 'mfn-post-youtube', true) ){
						echo '<iframe class="scale-with-grid" src="http://www.youtube.com/embed/'. $video .'" frameborder="0" allowfullscreen></iframe>'."\n";
					} elseif( has_post_thumbnail() ){
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
						echo '<a class="fancybox" href="'. $large_image_url[0] .'">';
							the_post_thumbnail( 'blog', array('class'=>'scale-with-grid' ));
						echo '</a>';
					}
				?>			
			</div>
			
			<?php if( $posts_meta['tags'] || $posts_meta['categories'] ) echo '<div class="tag-cat">'; ?>	
				<?php
					if( $posts_meta['tags'] && ( $terms = get_the_terms( false, 'post_tag' ) ) ){
						echo '<p class="tags">';
						foreach( $terms as $term ){
							$link = get_term_link( $term, 'post_tag' );
							echo '<a href="' . esc_url( $link ) . '" rel="tag"><span>' . $term->name . '</span></a> ';
						}
						echo '</p>';
					}
				?>
				<?php if( $posts_meta['categories'] ): ?>
					<div class="category">
						<span class="label"><?php echo $translate['category']; ?></span>
						<?php echo( get_the_category_list(', ') ); ?>
					</div>
				<?php endif; ?>
			<?php if( $posts_meta['tags'] || $posts_meta['categories'] ) echo '</div>'; ?>

			
			<?php the_content( false ); ?>

			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'kora').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>	
		
			<?php if( get_post_meta($post->ID, 'mfn-post-social', true) ): ?>
				<div class="share">
					<span class='st_sharethis_hcount' displayText='ShareThis'></span>
					<span class='st_facebook_hcount' displayText='Facebook'></span>
					<span class='st_twitter_hcount' displayText='Tweet'></span>
					<span class='st_email_hcount' displayText='Email'></span>
				</div>
			<?php endif; ?>
			
		</div>
	</div>
	
</div>

<?php comments_template( '', true ); ?>