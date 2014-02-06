<?php
/**
 * The template for displaying content in the index.php template
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */

$translate['comments'] = mfn_opts_get('translate') ? mfn_opts_get('translate-comments','Comments:') : __('Comments:','kora');
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( array('clearfix','post') ); ?>>
	
	<?php 
		$posts_meta = array();
		$posts_meta['comments'] = mfn_opts_get( 'blog-comments' );
		$posts_meta['time'] = mfn_opts_get( 'blog-time' );
		$posts_meta['tags'] = mfn_opts_get( 'blog-tags' );
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
						echo '<a href="'. get_permalink() .'">';
							the_post_thumbnail( 'blog', array('class'=>'scale-with-grid' ));
						echo '</a>';
					}
				?>
			</div>
			
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			
			<?php the_excerpt(); ?>
			
			<div class="footer">
				<?php 
					if( $posts_meta['tags'] && ( $terms = get_the_terms( false, 'post_tag' ) ) ){
						echo '<p class="tags">';
						foreach( $terms as $term ){
							$link = get_term_link( $term, 'post_tag' );
							echo '<a href="' . esc_url( $link ) . '" rel="tag"><span>' . $term->name . '</span></a> ';
						}
						echo '</p>';
					}
		
					if( $blog_readmore = mfn_opts_get( 'blog-readmore' ) ) echo '<a href="'. get_permalink() .'" class="button">'. $blog_readmore .'<span>&rarr;</span></a>';				
				?>
			</div>
			
		</div>
	</div>
	
</div>