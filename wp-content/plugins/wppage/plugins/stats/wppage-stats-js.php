<?php
// print this via php like js

//echo dirname(__FILE__) . '/wp-blog-header.php';

//require( dirname(__FILE__) . '/../../../wp-blog-header.php'); // include WordPress
require( dirname(__FILE__) . '/../../../../../wp-blog-header.php'); // include WordPress

global $post;
/*if(!isset($_SERVER['REQUEST_URI'])){
    $serverrequri = $_SERVER['PHP_SELF'];
}else{
    $serverrequri = $_SERVER['REQUEST_URI'];
}*/
//$current_page_url = "http://".$_SERVER['SERVER_NAME'].$serverrequri;
if( isset( $_SERVER['HTTP_REFERER'] ) ) {
    $referer = $_SERVER['HTTP_REFERER'];
}else{
    $referer = '';
}

//$page_id = $post->ID;

header('Content-Type: text/javascript');

if ( is_user_logged_in() ) {
	echo '// user is logged in and stats will not be collected';
} else {
	echo '
jQuery(function($){
    var ajaxurl = "'.admin_url("admin-ajax.php").'"
    $.post( ajaxurl, {
        action: "wppage_stats_ajax_action",
        page_id: wpp_page_id,
        page_title: wpp_page_title, // $(document).attr("title")
        page_url: $(location).attr("href"),
        ip: "'.$_SERVER['REMOTE_ADDR'].'",
        referer: document.referrer, // document.referrer // $referer
        language: "'.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'",
        user_agent: "'.$_SERVER['HTTP_USER_AGENT'].'"
    }, function(data) {
        //alert(data); // alerts "ajax submitted"
        //console.log( data );
    });
});
';
}

