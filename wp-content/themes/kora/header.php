<?php
/**
 * The Header for our theme.
 *
 * @package Kora
 * @author Muffin group
 * @link http://muffingroup.com
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<!-- head -->
<head>

<!-- meta -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<?php if( mfn_opts_get('responsive') ) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">'; ?>

<title><?php
global $post;
if( mfn_opts_get('mfn-seo') && is_object($post) && get_post_meta( get_the_ID(), 'mfn-meta-seo-title', true ) ){
	echo stripslashes( get_post_meta( get_the_ID(), 'mfn-meta-seo-title', true ) );
} else {
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'kora' ), max( $paged, $page ) );
}
?></title>

<?php if( is_single() ): ?>
	<script>var switchTo5x=true;</script>
	<script src="http://w.sharethis.com/button/buttons.js"></script>
	<script>stLight.options({publisher: "ur-6568e777-919c-a5dd-ac31-98a6fa2e6b2d"}); </script>
<?php endif; ?>
<?php do_action('wp_seo'); ?>

<link rel="shortcut icon" href="<?php mfn_opts_show('favicon-img',THEME_URI .'/images/favicon.ico'); ?>" type="image/x-icon" />	

<!-- wp_head() -->
<?php wp_head();?>

<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?98"></script>

<script type="text/javascript">
  VK.init({apiId: 3088086, onlyWidgets: true});
</script>
<!-- Код авторизации администратора коментариев -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=191640991004184";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- начало google analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-27212996-1', 'chillidance.com');
  ga('send', 'pageview');

</script>
<!-- конец google analytics -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter21877765 = new Ya.Metrika({id:21877765,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/21877765" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>

<!-- body -->
<body <?php body_class(); ?>>	
	<div id="Wrapper">
	
		<?php 
			get_template_part( 'includes/header', 'top-area' );
	
			if( ! is_404() ){
				$slider = false;
				if( get_post_type()=='page' ) $slider = get_post_meta( get_the_ID(), 'mfn-post-slider', true );
				
				if( $slider && function_exists( 'putRevSlider' ) ){
					// Revolution Slider
					echo '<div id="mfn-rev-slider">';
						putRevSlider( $slider );
					echo '</div>';
				} elseif( trim( wp_title( '', false ) ) ){
					// Page title
					echo '<div id="Subheader">';
						echo '<div class="container">';
							echo '<div class="sixteen columns">';
								if( get_post_type()=='page' || is_single() ){
									echo '<h1>'. $post->post_title .'</h1>';
								} else {
									echo '<h1>'. trim( wp_title( '', false ) ) .'</h1>';
								}
								mfn_breadcrumbs();
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			}
		?>