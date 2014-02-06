<!-- #Top_area -->
<div id="Top_area">

	<!-- #Top_bar -->
	<div id="Top_bar">
		<div class="container">
			<div class="sixteen columns">
				<?php $social_class = mfn_opts_get('social-large') ? 'social-large' : ''; ?>
				<div class="social <?php echo $social_class; ?>">
					<ul>
						<?php if( mfn_opts_get('social-facebook') ): ?><li class="facebook"><a target="_blank" href="<?php mfn_opts_show('social-facebook'); ?>" title="Facebook">F</a></li><?php endif; ?>
						<?php if( mfn_opts_get('social-googleplus') ): ?><li class="googleplus"><a target="_blank" href="<?php mfn_opts_show('social-googleplus'); ?>" title="Google+">G</a></li><?php endif; ?>
						<?php if( mfn_opts_get('social-twitter') ): ?><li class="twitter"><a target="_blank" href="<?php mfn_opts_show('social-twitter'); ?>" title="Twitter">L</a></li><?php endif; ?>
						<?php if( mfn_opts_get('social-vimeo') ): ?><li class="vimeo"><a target="_blank" href="<?php mfn_opts_show('social-vimeo'); ?>" title="Vimeo">V</a></li><?php endif; ?>
						<?php if( mfn_opts_get('social-youtube') ): ?><li class="youtube"><a target="_blank" href="<?php mfn_opts_show('social-youtube'); ?>" title="YouTube">X</a></li><?php endif; ?>
						<?php if( mfn_opts_get('social-flickr') ): ?><li class="flickr"><a target="_blank" href="<?php mfn_opts_show('social-flickr'); ?>" title="Flickr">N</a></li><?php endif; ?>
						<?php if( mfn_opts_get('social-linkedin') ): ?><li class="linked_in"><a target="_blank" href="<?php mfn_opts_show('social-linkedin'); ?>" title="LinkedIn">I</a></li><?php endif; ?>
						<?php if( mfn_opts_get('social-pinterest') ): ?><li class="pinterest"><a target="_blank" href="<?php mfn_opts_show('social-pinterest'); ?>" title="Pinterest">:</a></li><?php endif; ?>
						<?php if( mfn_opts_get('social-dribbble') ): ?><li class="dribbble"><a target="_blank" href="<?php mfn_opts_show('social-dribbble'); ?>" title="Dribbble">D</a></li><?php endif; ?>
					</ul>
				</div>
				<div class="contact_info">
					<?php if( mfn_opts_get('telephone-number') || mfn_opts_get('header-top-bar-text') ): ?>
						<p class="phone">
							<?php if( mfn_opts_get('header-top-bar-text') ): ?><em class="t"><?php mfn_opts_show('header-top-bar-text'); ?></em> <?php endif; ?>
							<?php if( mfn_opts_get('telephone-number') ): ?><i class="icon-phone"></i><a href="tel:<?php mfn_opts_show('telephone-number') ?>"><?php mfn_opts_show('telephone-number') ?></a><?php endif; ?>
						</p>
					<?php endif; ?>
					<?php if( mfn_opts_get('header-email') ): ?><p class="mail"><i class="icon-envelope-alt"></i><a href="mailto:<?php mfn_opts_show('header-email') ?>"><?php mfn_opts_show('header-email') ?></a></p><?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	
	<!-- #Header -->
	<header id="Header">
		<div class="container">
			<div class="sixteen columns">
			
				<!-- #logo -->
				<?php if( is_front_page() ) echo '<h1>'; ?>
				<a id="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
					<img src="<?php mfn_opts_show('logo-img',THEME_URI .'/images/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
				</a>
				<?php if( is_front_page() ) echo '</h1>'; ?>
				
				<!-- main menu -->
				<?php mfn_wp_nav_menu(); ?>
				<?php if ( has_nav_menu( 'primary' ) ) dropdown_menu( array('dropdown_title' => '- - Main menu - -', 'indent_string' => '- - ', 'indent_after' => '','container' => 'nav', 'container_id' => 'menu_responsive', 'theme_location'=>'primary') ); ?>		
	
			</div>		
		</div>
	</header>

</div>