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

/******************* Background ********************/

	<?php		
		$aBackground = array();
		$aBackground['color'] = mfn_opts_get( 'background-body', '#f8f8f8' );
		$aBackground['image'] = mfn_opts_get( 'img-page-bg' ) ? 'url("'. mfn_opts_get( 'img-page-bg' ) .'")' : '' ;
		$aBackground['position'] = mfn_opts_get( 'position-page-bg' );
		$background = implode(' ',$aBackground);
	?>
	
	html { 
		background: <?php echo $background; ?>;
	}
	
	<?php if( mfn_opts_get( 'overlay' ) ): ?>
	body { 
		background-position: center top;
		background-repeat: repeat;
		background-image: url('<?php echo THEME_URI; ?>/images/overlays/<?php mfn_opts_show( 'overlay' ); ?>.png');
	}
	<?php endif; ?>
		
	#Wrapper, .widget-area-bottom {
		background-color: <?php mfn_opts_show( 'background-wrapper', '#fff' ) ?>;
	}
	
	<?php if( mfn_opts_get( 'content-overlay' ) ): ?>
	#Wrapper { 
		background-position: center top;
		background-repeat: repeat;
		background-image: url('<?php echo THEME_URI; ?>/images/overlays/<?php mfn_opts_show( 'content-overlay' ); ?>.png');
	}
	<?php endif; ?>


/********************** Fonts **********************/

 	body, button, input[type="submit"], input[type="reset"], input[type="button"],
	input[type="text"], input[type="password"], input[type="email"], textarea, select {
		font-family: <?php mfn_opts_show( 'font-content', 'PT Sans' ) ?>, Arial, Tahoma, sans-serif;
		font-weight: normal;
	}
	
	#menu > ul > li > a {
		font-family: <?php mfn_opts_show( 'font-menu', 'Open Sans' ) ?>, Arial, Tahoma, sans-serif;
		font-weight: normal;
	}
	
	h1 {
		font-family: <?php mfn_opts_show( 'font-headings', 'Open Sans' ) ?>, Arial, Tahoma, sans-serif;
		font-weight: 300;
	}
	
	h2 {
		font-family: <?php mfn_opts_show( 'font-headings', 'Open Sans' ) ?>, Arial, Tahoma, sans-serif;
		font-weight: 300;
	}
	
	h3 {
		font-family: <?php mfn_opts_show( 'font-headings', 'Open Sans' ) ?>, Arial, Tahoma, sans-serif;
		font-weight: 300;
	}
	
	h4 {
		font-family: <?php mfn_opts_show( 'font-headings', 'Open Sans' ) ?>, Arial, Tahoma, sans-serif;
		font-weight: 300;
	}
	
	h5 {
		font-family: <?php mfn_opts_show( 'font-headings', 'Open Sans' ) ?>, Arial, Tahoma, sans-serif;
		font-weight: 300;
	}
	
	h6 {
		font-family: <?php mfn_opts_show( 'font-headings', 'Open Sans' ) ?>, Arial, Tahoma, sans-serif;
		font-weight: 300;
	}


/********************** Font sizes **********************/

/* Body */

	body {
		font-size: <?php mfn_opts_show( 'font-size-content', '14' ) ?>px;
		<?php $line_height = mfn_opts_get( 'font-size-content', '14' ) + 7; ?>
		line-height: <?php echo $line_height; ?>px;		
	}
	
	#menu > ul > li > a {	
		font-size: <?php mfn_opts_show( 'font-size-menu', '15' ) ?>px;
	}
	
/* Headings */

	h1 { 
		font-size: <?php mfn_opts_show( 'font-size-h1', '40' ) ?>px;
		<?php $line_height = mfn_opts_get( 'font-size-h1', '40' ) + 0; ?>
		line-height: <?php echo $line_height; ?>px;
	}
	
	h2 { 
		font-size: <?php mfn_opts_show( 'font-size-h2', '36' ) ?>px;
		<?php $line_height = mfn_opts_get( 'font-size-h2', '36' ) + 0; ?>
		line-height: <?php echo $line_height; ?>px;
	}
	
	h3 {
		font-size: <?php mfn_opts_show( 'font-size-h3', '28' ) ?>px;
		<?php $line_height = mfn_opts_get( 'font-size-h3', '28' ) + 2; ?>
		line-height: <?php echo $line_height; ?>px;
	}
	
	h4 {
		font-size: <?php mfn_opts_show( 'font-size-h4', '19' ) ?>px;
		<?php $line_height = mfn_opts_get( 'font-size-h4', '19' ) + 4; ?>
		line-height: <?php echo $line_height; ?>px;
	}
	
	h5 {
		font-size: <?php mfn_opts_show( 'font-size-h5', '17' ) ?>px;
		<?php $line_height = mfn_opts_get( 'font-size-h5', '17' ) + 5; ?>
		line-height: <?php echo $line_height; ?>px;
	}
	
	h6 {
		font-size: <?php mfn_opts_show( 'font-size-h6', '16' ) ?>px;
		<?php $line_height = mfn_opts_get( 'font-size-h6', '16' ) + 2; ?>
		line-height: <?php echo $line_height; ?>px;
	}
