<?php if( is_front_page() ) echo '<h1>'; ?>
<a id="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
	<img src="<?php mfn_opts_show('logo-img',THEME_URI .'/images/logo.png'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
</a>
<?php if( is_front_page() ) echo '</h1>'; ?>