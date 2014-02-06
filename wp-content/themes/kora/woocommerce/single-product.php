<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header( 'shop' );
?>

<!-- Content -->
<div id="Content">
	<div class="container">
		
		<!-- .content -->
		<div class="content">

			<div class="column one woocommerce_main_content">

		        <?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action('woocommerce_before_main_content');
				?>
			
					<?php while ( have_posts() ) : the_post(); ?>
			
						<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
			
					<?php endwhile; // end of the loop. ?>
			
				<?php
					/**
					 * woocommerce_after_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
					 */
					do_action('woocommerce_after_main_content');
				?>

    		</div>
    		
    	</div>
    		
   		<!-- Sidebar -->
		<div class="four columns">
			<div class="widget-area clearfix">
				<?php do_action('woocommerce_sidebar'); ?>
				<div class="widget-area-bottom"></div>
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>