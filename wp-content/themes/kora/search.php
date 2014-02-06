<?php
/**
 * The search template file.
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header(); 
$sidebar = mfn_sidebar_classes(get_option( 'page_for_posts' ));
?>

<!-- #Content -->
<div id="Content">
	<div class="container">

		<!-- .content -->
		<div class="content" style="width:100% !important;">
			<div class="the_content the_content_wrapper">
			
				<?php
				while ( have_posts() )
				{
					the_post();
					?>
					<div class="post clearfix">
						<div class="desc no_meta no-post-thumbnail">
							<h3><?php the_title(); ?></h3>
							<?php the_excerpt(); ?>
							<div class="footer">
								<?php if( $blog_readmore = mfn_opts_get( 'blog-readmore' ) ) echo '<a href="'. get_permalink() .'" class="button">'. $blog_readmore .'&nbsp;<span>&rarr;</span></a>'; ?>
							</div>
						</div>
					</div>
					<?php
				}
				
				// pagination
				if(function_exists( 'mfn_pagination' )):
					mfn_pagination();
				else:
					?>
					<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'kora')) ?></div>
					<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'kora')) ?></div>
					<?php
				endif;
				?>
			
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>