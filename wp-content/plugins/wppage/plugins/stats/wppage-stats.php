<?php

//register_activation_hook(__FILE__, 'wppage_stats_activation');
function wppage_stats_activation() {
	require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
	global $wpdb;
	$db_table_name = $wpdb->prefix . 'wppage_stats';
    $db_table_name_conv = $wpdb->prefix . 'wppage_conversion';
    $db_table_name_conv_log = $wpdb->prefix . 'wppage_conversion_log';

    if( $wpdb->get_var( "SHOW TABLES LIKE '$db_table_name'" ) != $db_table_name ) {
		if ( ! empty( $wpdb->charset ) )
			$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
		if ( ! empty( $wpdb->collate ) )
			$charset_collate .= " COLLATE $wpdb->collate";

		$sql = "CREATE TABLE " . $db_table_name . " (
			`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			`page_id` varchar(200) NOT NULL DEFAULT '',
			`page_title` varchar(200) NOT NULL DEFAULT '',
			`page_url` longtext NOT NULL,
			`ip` varchar(100) NOT NULL DEFAULT '',
			`country` varchar(100) NOT NULL DEFAULT '',
			`user_agent` longtext NOT NULL,
			`browser` longtext NOT NULL,
			`browser_version` longtext NOT NULL,
			`language` longtext NOT NULL,
			`language_2` longtext NOT NULL,
			`type` varchar(100) NOT NULL DEFAULT '',
			`referer` longtext NOT NULL,
			`referer_site` longtext NOT NULL,
			`date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			PRIMARY KEY (`id`)
		) $charset_collate;";
		dbDelta( $sql );

        $sql2 = "CREATE TABLE " . $db_table_name_conv . " (
			`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			`page_from` varchar(200) NOT NULL DEFAULT '',
			`page_to` varchar(200) NOT NULL DEFAULT '',
			`date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			PRIMARY KEY (`id`)
		) $charset_collate;";
        dbDelta( $sql2 );

        $sql3 = "CREATE TABLE " . $db_table_name_conv_log . " (
			`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			`page_from` varchar(200) NOT NULL DEFAULT '',
			`page_to` varchar(200) NOT NULL DEFAULT '',
			`date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
			PRIMARY KEY (`id`)
		) $charset_collate;";
        dbDelta( $sql3 );
	}
}


add_action('init', 'wppage_stats_scripts_styles_init');
function wppage_stats_scripts_styles_init() {
    if ( !is_admin() ) { // && is_singular() && comments_open() && get_option( 'thread_comments' )
        wp_enqueue_script('jquery');
        //wp_enqueue_script( 'ajax-script', plugins_url( '/js/wppage-stats.js', __FILE__ ), array('jquery'), 1.0 ); // jQuery will be included automatically
        //wp_localize_script( 'ajax-script', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); // setting ajaxurl

        //wp_enqueue_script( 'ajax-script-data', plugins_url( '/wppage-stats-js.php', __FILE__ ), array('jquery'), 1.0 ); // jQuery will be included automatically
        //wp_localize_script( 'ajax-script-data', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); // setting ajaxurl

    } else {
        wp_enqueue_style('wppage_stat_style', plugins_url('stat.css', __FILE__));

        wp_enqueue_script( 'wppage-stats-script-admin', plugins_url( '/js/wppage-stats-admin.js', __FILE__ ), array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'), '1.0' );
        //wp_enqueue_style( 'wppage-stats-style-admin', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/smoothness/jquery-ui.css');
    }
}


//add_action('wppage_head', 'wppage_stats_custom_post_type_script');
function wppage_stats_custom_post_type_script() {
	echo ' <script type="text/javascript" src="'.plugins_url( '/wppage-stats-js.php', __FILE__ ).'"></script> ';
}




add_action('wp_head', 'wppage_stats_head_html'); // moved to js or js-php file
function wppage_stats_head_html(){ // does not good for cache (code moved to php-js file)
	//$return = '';
	global $post;
	if(!isset($_SERVER['REQUEST_URI'])){
		$serverrequri = $_SERVER['PHP_SELF'];
	}else{
		$serverrequri = $_SERVER['REQUEST_URI'];
	}
	$current_page_url = "http://".$_SERVER['SERVER_NAME'].$serverrequri;
	if( isset( $_SERVER['HTTP_REFERER'] ) ){
		$referer = $_SERVER['HTTP_REFERER'];
	}else{
		$referer = '';
	}
	$page_id = $post->ID;

	$return = '
<script>
var wpp_page_id = "'.$post->ID.'";
var wpp_page_title = "'.addslashes($post->post_title).'";
</script>';
	echo $return;
}



add_action('wppage_head', 'wppage_stats_custom_post_type_head'); // wppage custom post type head
// add_action('wp_head', 'wppage_stats_custom_post_type_head'); // wp_head function
function wppage_stats_custom_post_type_head() {
    global $post;
	if ( is_user_logged_in() ) {
		echo '
		<!-- user is logged in and stats will not be collected -->
		';
	} else {
		echo '
	    <script>
	    /* <![CDATA[ */
	    var ajax_object = {"ajaxurl":"'.admin_url( 'admin-ajax.php' ).'"};
	    var wpp_page_id = "'.$post->ID.'";
	    var wpp_page_title = "'.addslashes($post->post_title).'";
	    /* ]]> */
	    </script>
	    <script type="text/javascript">
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
	});</script>';
	}
}


//function wppage_stats_admin_enqueue_scripts(){
    // wp_enqueue_script('jquery');
    //wp_enqueue_script( 'wppage-stats-script', plugins_url( '/js/wppage-stats.js', __FILE__ ), array('jquery', 'jquery-core', 'jquery-ui-datepicker'), '1.0' );
    //wp_enqueue_style( 'wppage-stats-style', plugins_url( '/css/wppage-stats.css', __FILE__ ), false, '1.0', 'all' );
//}
//add_action('admin_enqueue_scripts', 'wppage_stats_admin_enqueue_scripts'); // add styles and scripts to admin

//function wppage_stats_admin_enqueue_scripts(){
    // wp_enqueue_script('jquery');
    //wp_register_script( 'wppage-stats-script', plugins_url( '/js/wppage-stats.js', __FILE__ ), array('jquery', 'jquery-core', 'jquery-ui-datepicker'), '1.0' );
    //wp_enqueue_script( 'wppage-stats-admin-script', plugins_url( '/js/wppage-stats-admin.js', __FILE__ ), array('jquery', 'jquery-core', 'jquery-ui-datepicker'), '1.0' );
    //wp_enqueue_script( 'wppage-stats-script' );
//}
//add_action('admin_enqueue_scripts', 'wppage_stats_admin_enqueue_scripts'); // add styles and scripts to admin



add_action( 'wp_ajax_wppage_stats_ajax_action', 'wppage_stats_ajax_action' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_wppage_stats_ajax_action', 'wppage_stats_ajax_action' ); // ajax for not logged in users
function wppage_stats_ajax_action() {
    global $wpdb, $post;

    $ip = $_POST['ip']; // getting variables from ajax post
    $page_id = $_POST['page_id'];
    $page_title = $_POST['page_title'];
    $page_url = $_POST['page_url'];
    $referer = $_POST['referer'];
    $user_agent = $_POST['user_agent'];
    $language = $_POST['language'];

    $db_table_name = $wpdb->prefix . 'wppage_stats';
    $wpdb->insert(
        $db_table_name,
        array(
            'page_id' => $page_id,
            'page_title' => $page_title,
            'page_url' => $page_url,
            'ip' => $ip, // $_SERVER['REMOTE_ADDR']
            'user_agent' => $user_agent, // $_SERVER['HTTP_USER_AGENT'],
            'browser' => wppage_stats_useragent_to_browser( $user_agent ),
            'language' => $language, //$_SERVER['HTTP_ACCEPT_LANGUAGE']
            'language_2' => wppage_stats_language_to_short( $language ), //$_SERVER['HTTP_ACCEPT_LANGUAGE']
	        'type' => wppage_stats_referer_to_type( $referer ),
            'referer' => $referer, // $_SERVER['HTTP_REFERER']
            'referer_site' => wppage_stats_referer_to_site( $referer ), // $_SERVER['HTTP_REFERER']
            'date_time' => date('Y-m-d H:i:s') // 2012-11-18 18:45:58
        )
        //,
        //array( '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) // format (optional) (string type by default)

    );
    $last_insert_id = $wpdb->insert_id;

    //$wpdb->show_errors();

    if( !empty( $referer ) ) {
        if( wppage_stats_referer_to_type( $referer ) == 'inner' ) {
            //$page_from = url_to_postid( $referer );
            //$page_from_obj = wppage_stats_url_to_custom_post_id( $referer );
            //$page_from = $page_from_obj->ID;
            $page_from = wppage_stats_url_to_custom_post_id( $referer );
            $db_table_name_conv = $wpdb->prefix . 'wppage_conversion';
            $db_table_name_conv_log = $wpdb->prefix . 'wppage_conversion_log';

            $options = $wpdb->get_results( "select * from ".$db_table_name_conv." where page_from = ".$page_from." and page_to = ".$page_id );
            if( count( $options ) > 0 ){ // if we have to save options
                if( $page_from != 0 ) { // if we have id of prev page
                    $wpdb->insert(
                        $db_table_name_conv_log,
                        array(
                            'page_from' => $page_from,
                            'page_to' => $page_id,
                            'date_time' => date('Y-m-d H:i:s') // 2012-11-18 18:45:58
                        )
                    //,
                    //array( '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) // format (optional) (string type by default)
                    );
                }

            }

            //$last_insert_id = $wpdb->insert_id;
            //echo ' $page_from='.$page_from.' $referer='.$referer;
            //$wpdb->print_error();
        }
    }

    echo 'url='.$referer.' prev_post_id='.$page_from. ' count_opt='.count( $options ).' ajax stats submitted successfully; last_inserted_id='.$last_insert_id;

    die(); // stop executing script
}




function wppage_stats_url_to_custom_post_id( $url = '' ) { // return id from url
    /*$url_split = explode('#', $url);
    $url = $url_split[0];

    $url_split = explode('?', $url);
    $url = $url_split[0];

    $url = trim($url, '/'); // remove last '/'

    $url_split = explode('/', $url);
    $count = count( $url_split );
    $url = $url_split[$count];

    $post_id = get_page_by_path( $url, OBJECT, 'page_selling' );
    //$my_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$slug'");

    global $wpdb;
    $row = $wpdb->get_row("select * from $wpdb->links where link_id = 25");
    echo $row->link_id; // prints "25"
*/

    $url = trim($url, '/'); // remove last '/'

    $url_split = explode('/', $url);
    $count = count( $url_split );
    $url = $url_split[ $count-1 ];

    global $wpdb;
    $row = $wpdb->get_row( "select * from $wpdb->posts where post_name = '".$url."'" );
    $prev_post_id = $row->ID;
    if( !empty( $prev_post_id ) ) {
        $post_id = $prev_post_id;
    } else {
        $post_id = 0;
    }
    //echo 'url='.$url.' count='.$count.' prev_post_id='.$prev_post_id.' ajax stats submitted successfully; last_inserted_id='.$last_insert_id;
    return $post_id;
    //return $url;
}






function wppage_stats_content() {
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'index';
	ob_start(); ?>
<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h2>Статист</h2>
	<!-- <h2 class="nav-tab-wrapper">
		<a href="<?php echo add_query_arg('tab', 'index', remove_query_arg( array('settings-updated', 'search', 'page_id') )); ?>" class="nav-tab <?php echo $active_tab == 'index' ? 'nav-tab-active' : ''; ?>">Статист</a>
		<a href="<?php echo add_query_arg('tab', 'list', remove_query_arg( array('settings-updated', 'search', 'page_id') )); ?>" class="nav-tab <?php echo $active_tab == 'list' ? 'nav-tab-active' : ''; ?>">Детальнее</a>
	</h2> -->
	<div id="tab_container">
			<?php
			if( $active_tab == 'index' ) {
				echo wppage_stats_index();
			} elseif( $active_tab == 'list' ) {
				echo wppage_stats_list();
			} elseif( $active_tab == 'more' ) {
				echo wppage_stats_more();
			} else {
			}
			?>
	</div> <!-- /#tab_container -->

</div> <!-- /.wrap -->
<?php
	echo ob_get_clean();
}


function wppage_stats_index() {  // showing stats log actions ordered by count
    global $wpdb;
    $index_content = '';
    $rows_limit = 20; // items per page

    $db_table_name = $wpdb->prefix . 'wppage_stats';


    if( isset( $_GET[ 'date_from' ] ) && isset( $_GET[ 'date_to' ] ) ){
        $date_from = $_GET[ 'date_from' ];
        $date_to = $_GET[ 'date_to' ];
        //$date_sql = " WHERE date_time > '".$date_from."' AND date_time <= '".$date_to."' ";
    }else{
	    $date_from = date('Y-m-d', strtotime( '- 1 months' )); // from '1 month before' if not set
	    $date_to = date('Y-m-d'); // to 'today' if not set
        //$date_sql = '';
    }
    $date_sql = " AND ( ( date_time >= '".$date_from." 00:00:00' AND date_time <= '".$date_to." 23:59:59' ) OR ( date_time IS NULL ) ) "; // time added for get all posts from that day


    $db_rows_all = $wpdb->get_results( "SELECT * FROM " .$wpdb->posts. " LEFT JOIN " .$db_table_name . " ON " .$wpdb->posts . ".ID = " .$db_table_name . ".page_id  WHERE 1=1 " . $date_sql . " AND post_type = 'page_selling' AND post_status = 'publish' GROUP BY " .$wpdb->posts . ".ID "  ); // sql for count all items
    $rows_total = count( $db_rows_all );
    $paged_total = ceil( $rows_total / $rows_limit );
    if( isset( $_GET[ 'paged' ] ) && is_numeric( $_GET[ 'paged' ] ) ){
        $paged = $_GET[ 'paged' ];
        if( $paged > $paged_total || $paged < 1 ){
            $paged = 1;
        }
    }else{
        $paged = 1;
    }
    $rows_offset = ( $paged - 1 ) * $rows_limit;


    //$db_rows_sql = "SELECT page_id,page_url,page_title,COUNT(page_id) as count FROM " .$db_table_name . " GROUP BY page_id ORDER BY count DESC LIMIT ".$rows_limit." OFFSET ".$rows_offset." ";
    //$db_rows_sql = "SELECT page_id,page_url,page_title,COUNT(page_id) as count FROM " .$db_table_name . " WHERE 1=1 " . $date_sql . " GROUP BY page_id ORDER BY count DESC LIMIT ".$rows_limit." OFFSET ".$rows_offset." "; // old, we took all rows from stats table, but it will not show posts with empty stats and it is impossible to set conversion
	$db_rows_sql = "SELECT * FROM " .$wpdb->posts . " LEFT JOIN " .$db_table_name . " ON " .$wpdb->posts . ".ID = " .$db_table_name . ".page_id " . " WHERE 1=1 AND post_type = 'page_selling' AND post_status = 'publish' " . $date_sql . " GROUP BY " .$wpdb->posts . ".ID ORDER BY post_date DESC LIMIT ".$rows_limit." OFFSET ".$rows_offset." "; // new, we take all rows from wp_opsts table (if the post is deleted, then we will not show stat for it)

	//echo '<pre>'.$db_rows_sql.'</pre>';

	//SELECT * FROM wp_posts JOIN wp_wppage_stats ON wp_posts.ID = wp_wppage_stats.page_id WHERE 1=1 AND post_type = 'page_selling' AND post_status = 'publish'  LIMIT 30 OFFSET 0

	$db_rows = $wpdb->get_results( $db_rows_sql ); // $wpdb->prepare() was removed because it did not pass sql

    //$index_content .= '<pre>'.$db_rows_sql.'</pre> ';


	$action_date_form = remove_query_arg( 'paged' );
	$list_content_date = '<form action="'.$action_date_form.'" method="get" style="display:inline;"><p class="wppage_date_box">
			<input type="text" class="date_from" name="date_from" value="'.$date_from.'">
			<input type="text" class="date_to" name="date_to" value="'.$date_to.'">
			<input type="submit" name="" id="search-submit" class="button" value="Фильтровать">
			<input type="hidden" name="page" value="wppage_stats">
			<input type="hidden" name="post_type" value="page_selling">
			<input type="hidden" name="tab" value="index">
			</p></form>';

	$index_content .= $list_content_date;

	$action_search_form = remove_query_arg( 'paged' );
	$index_content_search = '<form action="'.$action_search_form.'" method="get" style="display:inline;"><p class="wppage_search_box">
			<input type="search" id="post-search-input" name="search" value="">
			<input type="submit" name="" id="search-submit" class="button" value="Поиск">
			<input type="hidden" name="page" value="wppage_stats">
			<input type="hidden" name="post_type" value="page_selling">
			<input type="hidden" name="tab" value="list">
			</p></form>';

	//$index_content .= $index_content_search;


    if( !empty( $db_rows ) ) { // if database is not empty

        $index_content .= '<div class="tablenav"><div class="tablenav-pages">';
        //$index_content .= '<div class="alignleft actions"></div>';
        $index_content .= '<div class="alignright actions">';
        $index_content .= wppage_stats_num( $rows_limit, $rows_total );
        $index_content .= wppage_stats_pagination( $paged, $paged_total, 'index' );
        $index_content .= '</div>';
        $index_content .= '</div></div>'; // /.tablenav /.tablenav-pages

        $index_content_table_head = '';
        $index_content_table_head .= '<tr>';
        $index_content_table_head .= '<th>Страница</th>';
        $index_content_table_head .= '<th>Просмотры</th>';
        $index_content_table_head .= '<th>Уникальные</th>';
        $index_content_table_head .= '<th>Статус</th>';
        $index_content_table_head .= '</tr>';


        $index_content .= '<table class="wp-list-table widefat wppage_table_stat">';
        $index_content .= '<thead>';
        $index_content .= $index_content_table_head;
        $index_content .= '</thead>' . "\r\n";
        $index_content .= '<tbody>' . "\r\n";
        $i = 0;
        foreach ( $db_rows as $db_row ) {
            if ($i % 2) {
                $index_content .= '<tr>';
            } else {
                $index_content .= '<tr class="alternate">';
            }
            $i++;

            $link_detailed = add_query_arg('page_id', $db_row->ID, remove_query_arg( array('tab', 'index') ));
            $link_detailed = add_query_arg('tab', 'more', $link_detailed );

	        $post_title = $db_row->post_title;
	        if( empty( $post_title ) ){
		        $post_title = 'Без названия';
	        }
            $index_content .= '<td>'. '<a href="'.$link_detailed.'" title="Смотреть статистику"><span class="wpp_stat_ico">&nbsp;</span>' . $post_title . '</a>' . ' <a class="wpp_stat_page_link" href="'.get_permalink( $db_row->ID ) .'" target="_blank" title="Перейти на страницу">' . '&nbsp;</a>' . '</td>';

	        $db_rows_sql_visits = "SELECT page_id as count FROM " .$db_table_name . " WHERE page_id='" .$db_row->ID. "' ".$date_sql." ";
	        $db_rows_visits = $wpdb->get_results( $db_rows_sql_visits ); // $wpdb->prepare() was removed because it did not pass sql
	        $count_visits = count($db_rows_visits);

            $index_content .= '<td>'. $count_visits . '</td>';

            $db_rows_sql_unique = "SELECT page_id,COUNT(ip) as count FROM " .$db_table_name . " WHERE page_id='" .$db_row->ID. "' ".$date_sql." GROUP BY ip ";
            $db_rows_unique = $wpdb->get_results( $db_rows_sql_unique ); // $wpdb->prepare() was removed because it did not pass sql
            $count_unique = count($db_rows_unique);

            $index_content .= '<td>'. $count_unique . '</td>';

            $index_content .= '<td>'. $db_row->post_status . '</td>';
            $index_content .= '</tr>' . "\r\n";
        }
        $index_content .= '</tbody>' . "\r\n";
        $index_content .= '<tfoot>';
        $index_content .= $index_content_table_head;
        $index_content .= '</tfoot>' . "\r\n";
        $index_content .= '</table>' . "\r\n";

        $index_content .= '<div class="tablenav"><div class="tablenav-pages">';
        $index_content .= '<div class="alignright actions">';
        // $index_content .= wppage_stats_num( $rows_limit, $rows_total );
        $index_content .= wppage_stats_pagination( $paged, $paged_total, 'index' );
        $index_content .= '</div>';
        $index_content .= '</div></div>'; // /.tablenav /.tablenav-pages


    } else {
        $index_content .= '<br class="wppage_clear"><p>Статистики нет.</p>';
    }
    return $index_content;



}


function wppage_stats_more() { // showing different stats for one page
	global $wpdb;
	$list_content = '';
	$rows_limit = 500; // items per page

	$db_table_name = $wpdb->prefix . 'wppage_stats';

	if( isset( $_GET[ 'page_id' ] ) ){
		$page_id = $_GET[ 'page_id' ];
		$page_id_sql = " AND ( page_id = '".$page_id."' ) ";
	}else{
		$page_id = '';
		$page_id_sql = '';
	}


	if( isset( $_GET[ 'date_from' ] ) && isset( $_GET[ 'date_to' ] ) ){
		$date_from = $_GET[ 'date_from' ];
		$date_to = $_GET[ 'date_to' ];
		//$date_sql = " WHERE date_time > '".$date_from."' AND date_time <= '".$date_to."' ";
	}else{
		$date_from = date('Y-m-d', strtotime( '- 1 months' )); // from '1 month before' if not set
		$date_to = date('Y-m-d'); // to 'today' if not set
		//$date_sql = '';
	}
	$date_sql = " AND ( date_time >= '".$date_from." 00:00:00' AND date_time <= '".$date_to." 23:59:59' ) "; // time added for get all posts from that day


	$db_rows_sql = "SELECT browser,count(browser) as count FROM " .$db_table_name . " WHERE 1=1 " . $date_sql . $page_id_sql . " GROUP BY browser ORDER BY count DESC LIMIT ".$rows_limit." ";
	$db_rows = $wpdb->get_results( $db_rows_sql ); // $wpdb->prepare() was removed because it did not pass sql



	$action_date_form = remove_query_arg( 'paged' );
	$list_content_date = '<form action="'.$action_date_form.'" method="get" style="display:inline;"><p class="wppage_date_box">
			<input type="text" class="date_from" name="date_from" value="'.$date_from.'">
			<input type="text" class="date_to" name="date_to" value="'.$date_to.'">
			<input type="submit" name="" id="search-submit" class="button" value="Фильтровать">
			<input type="hidden" name="page" value="wppage_stats">
			<input type="hidden" name="post_type" value="page_selling">
			<input type="hidden" name="tab" value="more">
			<input type="hidden" name="page_id" value="'.$page_id.'">
			</p></form>';

	$list_content_date;



	if( !empty( $page_id ) ){
		$page_title = get_the_title( $page_id );
        $page_url = get_permalink($page_id);
		$stat_header = '<br class="wppage_clear"><h2 class="single_stats_title"><span class="stats_icon_big"></span>Статистика для страницы: <a target="_blank" href="'.$page_url.'" title="Перейти на страницу">' . $page_title . '<span class="external_link_big"></span></a></h2>';

	}


	//$list_content .= '<pre>'.$db_rows_sql.'</pre> ';


	$db_rows_sql_browsers = "SELECT browser,count(browser) as count FROM " .$db_table_name . " WHERE 1=1 " . $date_sql . $page_id_sql . " GROUP BY browser ORDER BY count DESC LIMIT ".$rows_limit." ";
	$db_rows_browsers = $wpdb->get_results( $db_rows_sql_browsers ); // $wpdb->prepare() was removed because it did not pass sql

	if( !empty( $db_rows_browsers ) ) { // if database is not empty

		$list_content .= '<table class="wp-list-table widefat wpp_stat_table">';
		$list_content .= '<thead>';
		$list_content .= '<tr>';
		$list_content .= '<th colspan="2">Браузеры</th>';
		$list_content .= '</tr>';
		$list_content .= '</thead>' . "\r\n";
		$list_content .= '<tbody>' . "\r\n";
		$i = 0;
		foreach ( $db_rows_browsers as $db_row ) {
			if ($i % 2) {
				$list_content .= '<tr>';
			} else {
				$list_content .= '<tr class="alternate">';
			}
			$i++;

			$list_content .= '<td>'. $db_row->browser . '</td>';
			$list_content .= '<td class="wpp_col_num">'. $db_row->count . '</td>';
			$list_content .= '</tr>' . "\r\n";
		}
		$list_content .= '</tbody>' . "\r\n";
		$list_content .= '</table>' . "\r\n";


	} else {
		$list_content .= '<p>Статистики нет.</p>';
	}

    $browsers = $list_content;
    $list_content = '';







	$db_rows_sql_type = "SELECT type,count(browser) as count FROM " .$db_table_name . " WHERE 1=1 " . $date_sql . $page_id_sql . " GROUP BY type ORDER BY count DESC LIMIT ".$rows_limit." ";
	$db_rows_type = $wpdb->get_results( $db_rows_sql_type ); // $wpdb->prepare() was removed because it did not pass sql

	if( !empty( $db_rows_type ) ) { // if database is not empty


        $list_content .= '<table class="wp-list-table widefat wpp_stat_table">';
        $list_content .= '<thead>';
        $list_content .= '<tr>';
        $list_content .= '<th colspan="2">Переходы</th>';
        $list_content .= '</tr>';
        $list_content .= '</thead>' . "\r\n";
        $list_content .= '<tbody>' . "\r\n";

		//$list_content .= '<div id="accordion" style="margin-bottom: 30px;">';
		foreach ( $db_rows_type as $db_row ) {

			// direct, referral, search, inner
			if( $db_row->type == 'direct' ) {
				$type = 'Прямые';
                $list_content .= '<tr class="wpp_stat_type"><td><span>'.$type. '</span></td><td><span class="wpp_stat_count">'. $db_row->count.'</span></td></tr>' . "\r\n";

			} elseif( $db_row->type == 'referral' ) {
				$type = 'Внешние';
                $list_content .= '<tr class="wpp_stat_type"><td>'.$type. '</td><td><span class="wpp_stat_count">'. $db_row->count.'</span></td></tr>' . "\r\n";


                $type_sql = " AND type = '".$db_row->type."' "; // get by type
                $db_rows_sql_refsite = "SELECT referer_site,type,count(referer_site) as count FROM " .$db_table_name . " WHERE 1=1 " . $date_sql . $page_id_sql . $type_sql . " GROUP BY referer_site ORDER BY count DESC LIMIT ".$rows_limit." ";
                $db_rows_refsite = $wpdb->get_results( $db_rows_sql_refsite ); // $wpdb->prepare() was removed because it did not pass sql

                if( !empty( $db_rows_refsite ) ) { // if database is not empty

                    foreach ( $db_rows_refsite as $db_row ) {
                        $list_content .= '<tr><td><span>'. $db_row->referer_site . '</span></td>'.'<td><span class="wpp_stat_count">'. $db_row->count . '</span></td></tr>' . "\r\n";
                    }

                } else {
                    $list_content .= '<tr><td colspan="2"><p>Статистики нет.</p></td></tr>';
                }

			} elseif( $db_row->type == 'search' ) {
				$type = 'Поисковики';
                $list_content .= '<tr class="wpp_stat_type"><td>'.$type. '</td><td><span class="wpp_stat_count">'. $db_row->count.'</span></td></tr>' . "\r\n";


                $type_sql = " AND type = '".$db_row->type."' "; // get by type
                $db_rows_sql_refsite = "SELECT referer_site,type,count(referer_site) as count FROM " .$db_table_name . " WHERE 1=1 " . $date_sql . $page_id_sql . $type_sql . " GROUP BY referer_site ORDER BY count DESC LIMIT ".$rows_limit." ";
                $db_rows_refsite = $wpdb->get_results( $db_rows_sql_refsite ); // $wpdb->prepare() was removed because it did not pass sql

                if( !empty( $db_rows_refsite ) ) { // if database is not empty

                    foreach ( $db_rows_refsite as $db_row ) {
                        $list_content .= '<tr><td><span>'. $db_row->referer_site . '</span></td>'.'<td><span class="wpp_stat_count">'. $db_row->count . '</span></td></tr>' . "\r\n";
                    }

                } else {
                    $list_content .= '<tr><td colspan="2"><p>Статистики нет.</p></td></tr>';
                }

			} else { // inner
				$type = 'Внутренние';
                $list_content .= '<tr class="wpp_stat_type"><td><span>'.$type. '</span></td><td><span class="wpp_stat_count">'. $db_row->count.'</span></td></tr>' . "\r\n";

			}


		}
        $list_content .= '</tbody>' . "\r\n";
        $list_content .= '</table>' . "\r\n";

	} else {
		$list_content .= '<p>Статистики нет.</p>';
	}


    $referrals = $list_content;
    $list_content = '';


	// showing visitors of the page
	$visits_html = '';
	$db_rows_visits_sql = "SELECT page_id,page_title,COUNT(page_id) as count FROM " .$db_table_name . " WHERE 1=1 " . $page_id_sql . $date_sql . " GROUP BY page_id ORDER BY count DESC ";
	$db_rows_visits = $wpdb->get_results( $db_rows_visits_sql );

	if( !empty( $db_rows_visits ) ) { // if database is not empty
		$visits_html .= '<table class="wp-list-table widefat wpp_stat_table">';
		$visits_html .= '<thead>';
		$visits_html .= '<tr>';
		$visits_html .= '<th colspan="2">Просмотры</th>';
		$visits_html .= '</tr>';
		$visits_html .= '</thead>' . "\r\n";
		$visits_html .= '<tbody>' . "\r\n";

		foreach ( $db_rows_visits as $db_row_visits ) {
			$visits_html .= '<tr><td>Просмотры</td><td>'. $db_row_visits->count . '</td></tr>';

			$db_rows_sql_unique = "SELECT page_id,COUNT(ip) as count FROM " .$db_table_name . " WHERE 1=1 " .$page_id_sql. $date_sql." GROUP BY ip DESC ";
			$db_rows_unique = $wpdb->get_results( $db_rows_sql_unique ); // $wpdb->prepare() was removed because it did not pass sql
			$count_unique = count($db_rows_unique);
			$visits_html .= '<tr class="alternate"><td>Уникальные</td><td>'. $count_unique . '</td></tr>';
		}
		$visits_html .= '</tbody>' . "\r\n";
		$visits_html .= '</table>' . "\r\n";
	} else {
		$visits_html .= '<p>Статистики нет.</p>';
	}
	/*
	$db_rows_sql_refsite = "SELECT referer_site,count(referer_site) as count FROM " .$db_table_name . " WHERE 1=1 " . $date_sql . $page_id_sql . " GROUP BY referer_site ORDER BY count DESC LIMIT ".$rows_limit." ";
	$db_rows_refsite = $wpdb->get_results( $db_rows_sql_refsite ); // $wpdb->prepare() was removed because it did not pass sql

	if( !empty( $db_rows_refsite ) ) { // if database is not empty

		$list_content .= '<table class="wp-list-table widefat" style="margin:30px 0;">';
		$list_content .= '<thead>';
		$list_content .= '<tr>';
		$list_content .= '<th>сайт перехода</th>';
		$list_content .= '<th>количество</th>';
		$list_content .= '</tr>';
		$list_content .= '</thead>' . "\r\n";
		$list_content .= '<tbody>' . "\r\n";
		$i = 0;
		foreach ( $db_rows_refsite as $db_row ) {
			if ($i % 2) {
				$list_content .= '<tr>';
			} else {
				$list_content .= '<tr class="alternate">';
			}
			$i++;

			$list_content .= '<td>'. $db_row->referer_site . '</td>';
			$list_content .= '<td>'. $db_row->count . '</td>';
			$list_content .= '</tr>' . "\r\n";
		}
		$list_content .= '</tbody>' . "\r\n";
		$list_content .= '</table>' . "\r\n";


	} else {
		$list_content .= '<p>Статистики нет.</p>';
	}
*/

    $conversion_message = '';
    $db_table_name_conv = $wpdb->prefix . 'wppage_conversion';
    if( isset( $_GET[ 'add_conversion_page_id' ] ) ) { // save conversion page
        $conversion_message = '<h3>Связь конверсии добавлена.</h3>';
        $page_to = $_GET[ 'add_conversion_page_id' ];
        $wpdb->query( $wpdb->prepare( "delete from ".$db_table_name_conv." where page_from=%s and page_to=%s", $page_id, $page_to ) ); // delete all
        if( isset( $_GET[ 'add_conversion_page_id' ] ) && $_GET[ 'add_conversion_page_id' ] != 0 && $_GET[ 'add_conversion_page_id' ] != '0' ) { // save conversion page
            $wpdb->insert(
                $db_table_name_conv,
                array(
                    'page_from' => $page_id,
                    'page_to' => $page_to,
                    'date_time' => date('Y-m-d H:i:s') // 2012-11-18 18:45:58
                )
                //,
                //array( '%s', '%s', '%s', '%s', '%s', '%s', '%s' ) // format (optional) (string type by default)
            );
        }
    }

	if( isset( $_GET[ 'delete_conversion_page_id' ] ) ) { // delete conversion page
		$conversion_message = '<h3>Связь конверсии удалена.</h3>';
		$page_to = $_GET[ 'delete_conversion_page_id' ];
		$wpdb->query( $wpdb->prepare( "delete from ".$db_table_name_conv." where page_from=%s and page_to=%s", $page_id, $page_to ) ); // delete all (just in case)
	}



	$args = array(
        'post_type' => 'page_selling',
        'posts_per_page' => '-1'
    );
    query_posts($args);


    $list_of_cpt = '';
    $action_conversion_form = remove_query_arg( 'paged' );
    if (have_posts()):

        $page_from_row = $wpdb->get_row("select * from ".$db_table_name_conv." where page_to = ".$page_id);
        $page_from_option = $page_from_row->page_from;

        $list_of_cpt .= '<form action="'.$action_conversion_form.'" method="get"><p>Страница конверсии ';
        $list_of_cpt .= '<select name="add_conversion_page_id">';
        $list_of_cpt .= '<option value="0">-- не выбрано --</option>';
        while (have_posts()): the_post();
            if( $page_id != get_the_ID() ) { // exclude self page
                $list_of_cpt .= '<option value="'.get_the_ID().'">'. get_the_title(). ' ['.get_the_ID().']'.'</option>';
            }
        endwhile;
        $list_of_cpt .= '</select>';
        $list_of_cpt .= '<input type="submit" name="" id="save-submit" class="button" value="добавить">';
        $list_of_cpt .= '<input type="hidden" name="page" value="wppage_stats"><input type="hidden" name="post_type" value="page_selling"><input type="hidden" name="tab" value="more"><input type="hidden" name="page_id" value="'.$page_id.'">';
        $list_of_cpt .= '</p></form>';
    endif;
    wp_reset_query();



	// show list of active conversions ===============================================================
	$list_conv_active = '';
	$db_table_name_conv = $wpdb->prefix . 'wppage_conversion';
	$db_rows_conv_active_sql = "SELECT page_to FROM " .$db_table_name_conv . " WHERE page_from='".$page_id."' ORDER BY date_time DESC ";
	$db_conv_active_rows = $wpdb->get_results( $db_rows_conv_active_sql );

	$i_row = 1;
	if( count( $db_conv_active_rows ) ):
		$list_conv_active .= '<table class="wp-list-table widefat wpp_stat_table"><thead><tr><th colspan="2">Связи конверсии</th></tr></thead>';
		foreach ( $db_conv_active_rows as $db_conv_active_row ) {
            if ($i_row % 2) {
                $list_conv_active .= '<tr>';
            } else {
                $list_conv_active .= '<tr class="alternate">';
            }
            $i_row++;

			$link_conversion_delete = add_query_arg( 'delete_conversion_page_id', $db_conv_active_row->page_to, remove_query_arg( array('add_conversion_page_id', 'paged') ) );
			$list_conv_active .= '<td><a href="'.get_permalink($db_conv_active_row->page_to).'" target="_blank" title="Перейти на страницу">' . get_the_title( $db_conv_active_row->page_to ) . '<span class="wpp_stat_page_link"></span></a></td>';
			$list_conv_active .= '<td><a class="button" href="'.$link_conversion_delete.'">удалить</a></td>';
			$list_conv_active .= '</tr>';
		}
		$list_conv_active .= '</tbody></table>';
	endif;



    // show list of convensions ===============================================================
    $list_conv_stats = '';
    $db_table_name_conv_log = $wpdb->prefix . 'wppage_conversion_log';
    $db_rows_conv_sql = "SELECT page_to,COUNT(page_to) as count FROM " .$db_table_name_conv_log . " WHERE page_from='".$page_id."' ".$date_sql." GROUP BY page_to ORDER BY count DESC ";
    $db_conv_rows = $wpdb->get_results( $db_rows_conv_sql ); // $wpdb->prepare() was removed because it did not pass sql

    //$list_conv_stats .= $db_rows_conv_sql;

	if( count( $db_conv_rows ) ):
	    $i_row = 1;
		$list_conv_stats .= '<table class="wp-list-table widefat wpp_stat_table"><thead><tr><th>Страница конверсии</th><th>Переходы</th><th>Статус</th></tr></thead>';
	    foreach ( $db_conv_rows as $db_conv_row ) {
	        if ($i_row % 2) {
	            $list_conv_stats .= '<tr>';
	        } else {
	            $list_conv_stats .= '<tr class="alternate">';
	        }
	        $i_row++;

	        //$link_detailed = add_query_arg('page_id', $db_row->page_id, remove_query_arg( array('tab', 'index') ));
	        //$link_detailed = add_query_arg('tab', 'more', $link_detailed );

	        $list_conv_stats .= '<td><a href="'.get_permalink($db_conv_row->page_to).'" target="_blank" title="Перейти на страницу">' . get_the_title( $db_conv_row->page_to ) . '<span class="wpp_stat_page_link"></span></a></td>';
	        $list_conv_stats .= '<td>'. $db_conv_row->count . '</td>';

	        //$db_rows_sql_unique = "SELECT page_id,COUNT(ip) as count FROM " .$db_table_name . " WHERE page_id='" .$db_row->page_id. "' GROUP BY ip DESC ";
	        //$db_rows_unique = $wpdb->get_results( $db_rows_sql_unique ); // $wpdb->prepare() was removed because it did not pass sql
	        //$count_unique = count($db_rows_unique);



	        $list_conv_stats .= '<td>';
	        $options = $wpdb->get_results( "select * from ".$db_table_name_conv." where page_from = ".$page_id." and page_to = ".$db_conv_row->page_to );
	        if( count( $options ) > 0 ){ // if we have this connect in options
	            $list_conv_stats .=  '<span class="text_green">активно</span>';
	        } else {
	            $list_conv_stats .=  '<span class="text_red">не активно</span>';
	        }
	        $list_conv_stats .= '</td>';
	        $list_conv_stats .= '</tr>' . "\r\n";
	    }
	    $list_conv_stats .= '</table>';
	endif;

	$return_html = '';
	$return_html .= $list_content_date;
	$return_html .= $stat_header;
	$return_html .= '<div class="stats_box_350">'.$referrals.'</div>';
	$return_html .= '<div class="stats_box_350">'.$browsers. '<div style="margin:20px 0 0 0;">'. $visits_html . '</div>' .'</div>';
	//$return_html.= '<div class="stats_box_350">'.$visits_html.'</div>';
    /*$return_html .= '<br class="wppage_clear">';
  /*$return_html .= '<h2 class="single_stats_title"><span class="conversion_icon_big"></span>Конверсия</h2>';
    //echo $conversion_message;
    $return_html .= $list_of_cpt;
    $return_html .= $conversion_message;
    $return_html .= '<div class="stats_box_720">'.$list_conv_active.'</div><br class="wppage_clear">';
    $return_html .= '<div class="stats_box_720">'.$list_conv_stats.'</div>';*/

	return $return_html;

}


function wppage_stats_list() {  // showing list of log actions
	global $wpdb;
	$list_content = '';
	$rows_limit = 20; // items per page

    $db_table_name = $wpdb->prefix . 'wppage_stats';


    if( isset( $_GET[ 'page_id' ] ) ){
        $page_id = $_GET[ 'page_id' ];
        $page_id_sql = " AND ( page_id = '".$page_id."' ) ";
    }else{
        $page_id = '';
        $page_id_sql = '';
    }

	if( isset( $_GET[ 'search' ] ) ){
		$search = $_GET[ 'search' ];
		//$search_sql = " WHERE `type` LIKE '%login%' AND `username` LIKE '%admin%' ";
		$search_sql = " AND ( page_title LIKE '%".$search."%' OR page_url LIKE '%".$search."%'
			OR ip LIKE '%".$search."%' OR user_agent LIKE '%".$search."%' OR browser LIKE '%".$search."%'
			OR referer LIKE '%".$search."%'	OR date_time LIKE '%".$search."%' ) ";
	}else{
		$search = '';
		$search_sql = '';
	}



    if( isset( $_GET[ 'date_from' ] ) && isset( $_GET[ 'date_to' ] ) ){
        $date_from = $_GET[ 'date_from' ];
        $date_to = $_GET[ 'date_to' ];
        //$date_sql = " WHERE date_time > '".$date_from."' AND date_time <= '".$date_to."' ";
    }else{
	    $date_from = date('Y-m-d', strtotime( '- 1 months' )); // from '1 month before' if not set
	    $date_to = date('Y-m-d'); // to 'today' if not set
        //$date_sql = '';
    }
    $date_sql = " AND ( date_time >= '".$date_from." 00:00:00' AND date_time <= '".$date_to." 23:59:59' ) "; // time added for get all posts from that day

	$db_rows_all = $wpdb->get_results( "SELECT * FROM " .$db_table_name. " WHERE 1=1 " . $search_sql . $date_sql . $page_id_sql . " " ); // sql for count all items
	$rows_total = count( $db_rows_all );
	$paged_total = ceil( $rows_total / $rows_limit );
	if( isset( $_GET[ 'paged' ] ) && is_numeric( $_GET[ 'paged' ] ) ){
		$paged = $_GET[ 'paged' ];
		if( $paged > $paged_total || $paged < 1 ){
			$paged = 1;
		}
	}else{
		$paged = 1;
	}
	$rows_offset = ( $paged - 1 ) * $rows_limit;


	$db_rows_sql = "SELECT * FROM " .$db_table_name . " WHERE 1=1 " . $search_sql . $date_sql . $page_id_sql . " ORDER BY date_time DESC LIMIT ".$rows_limit." OFFSET ".$rows_offset." ";
	$db_rows = $wpdb->get_results( $db_rows_sql ); // $wpdb->prepare() was removed because it did not pass sql

	$subtitle = '';
	if( !empty( $search ) ){
		$subtitle = 'Результаты поиска для: <strong>' . $search . '</strong>';
	}

    if( !empty( $page_id ) ){
        $page_title = get_the_title( $page_id );
        $subtitle = 'Статистика для страницы: <strong>' . $page_title . '</strong>';
    }

	//$list_content .= '<pre>'.$db_rows_sql.'</pre> ';

	$list_content .= '<h2>Статистика детальнее <span class="subtitle">'.$subtitle.'</span> </h2>';

	if( !empty( $db_rows ) ) { // if database is not empty

        $action_date_form = remove_query_arg( 'paged' );
        $list_content_date = '<form action="'.$action_date_form.'" method="get" style="display:inline;"><p class="wppage_date_box">
			<input type="text" class="date_from" name="date_from" value="'.$date_from.'">
			<input type="text" class="date_to" name="date_to" value="'.$date_to.'">
			<input type="submit" name="" id="search-submit" class="button" value="фильтровать">
			<input type="hidden" name="page" value="wppage_stats">
			<input type="hidden" name="post_type" value="page_selling">
			<input type="hidden" name="tab" value="list">
			</p></form>';

        $list_content .= $list_content_date;


		$action_search_form = remove_query_arg( 'paged' );
		$list_content_search = '<form action="'.$action_search_form.'" method="get" style="display:inline;"><p class="wppage_search_box">
			<input type="search" id="post-search-input" name="search" value="'.$search.'">
			<input type="submit" name="" id="search-submit" class="button" value="Поиск">
			<input type="hidden" name="page" value="wppage_stats">
			<input type="hidden" name="post_type" value="page_selling">
			<input type="hidden" name="tab" value="list">
			</p></form>';

		//$list_content .= $list_content_search;

		$list_content .= '<div class="tablenav"><div class="tablenav-pages">';
		//$list_content .= '<div class="alignleft actions"></div>';
		$list_content .= '<div class="alignright actions">';
		$list_content .= wppage_stats_num( $rows_limit, $rows_total );
		$list_content .= wppage_stats_pagination( $paged, $paged_total, 'list' );
		$list_content .= '</div>';
		$list_content .= '</div></div>'; // /.tablenav /.tablenav-pages

		$list_content_table_head = '';
		$list_content_table_head .= '<tr>';
		$list_content_table_head .= '<th>страница</th>';
		$list_content_table_head .= '<th>IP</th>';
		$list_content_table_head .= '<th>браузер</th>';
        $list_content_table_head .= '<th>язык</th>';
		$list_content_table_head .= '<th>referer</th>';
		$list_content_table_head .= '<th>дата и время</th>';
		$list_content_table_head .= '</tr>';


		$list_content .= '<table class="wp-list-table widefat">';
		$list_content .= '<thead>';
		$list_content .= $list_content_table_head;
		$list_content .= '</thead>' . "\r\n";
		$list_content .= '<tbody>' . "\r\n";
		$i = 0;
		foreach ( $db_rows as $db_row ) {
			if ($i % 2) {
				$list_content .= '<tr>';
			} else {
				$list_content .= '<tr class="alternate">';
			}
			$i++;

			$list_content .= '<td>'. '<a href="'.$db_row->page_url.'">' . get_the_title($db_row->page_id) . ' ['.$db_row->page_id.']' . '</a>' . '</td>';
			$list_content .= '<td>'. $db_row->ip . '</td>';
			$list_content .= '<td>'. '<span title="'.$db_row->user_agent.'">' . $db_row->browser . '</span>' . '</td>';
			$list_content .= '<td>'. '<img src="'. plugins_url( '/img/flags/', __FILE__ ) .$db_row->language_2.'.png" title="'.$db_row->language.'" />' . '</td>';
			$list_content .= '<td>'. $db_row->referer . '</td>';
			$list_content .= '<td>'. $db_row->date_time . '</td>';
			$list_content .= '</tr>' . "\r\n";
		}
		$list_content .= '</tbody>' . "\r\n";
		$list_content .= '<tfoot>';
		$list_content .= $list_content_table_head;
		$list_content .= '</tfoot>' . "\r\n";
		$list_content .= '</table>' . "\r\n";

		$list_content .= '<div class="tablenav"><div class="tablenav-pages">';
		$list_content .= '<div class="alignright actions">';
		// $list_content .= wppage_stats_num( $rows_limit, $rows_total );
		$list_content .= wppage_stats_pagination( $paged, $paged_total, 'list' );
		$list_content .= '</div>';
		$list_content .= '</div></div>'; // /.tablenav /.tablenav-pages


	} else {
		$list_content .= '<p>Статистики нет.</p>';
	}
	return $list_content;
}


function wppage_stats_pagination( $paged, $paged_total=1, $tab = 'list' ) {
	$pagination_content = '';
	$pagination_content .= '<span class="pagination-links">';
	if( $paged_total > 1) { // show pager if we have 2 or more pages
		if( $paged != 1 ) { // show 'prev-link' if not first page
			$paged_prev = $paged - 1;
			$link_prev = add_query_arg( 'paged', $paged_prev, remove_query_arg( 'paged' ) );
			$pagination_content .= '<a class="prev-page" title="Go to the previous page" href="'.$link_prev.'">&lt; '.$paged_prev.'</a>'; // 'prev-input'


		}
		$link_form = remove_query_arg( 'paged' );
		$pagination_content .= '<span class="paging-input"><form action="'.$link_form.'" method="get" style="display:inline;">
			<input class="current-page" title="Current page" type="text" name="paged" value="'.$paged.'" size="1"> of <span class="total-pages">'.$paged_total.'</span>
			<input type="hidden" name="page" value="wppage_stats">
			<input type="hidden" name="post_type" value="page_selling">
			<input type="hidden" name="tab" value="'.$tab.'">';
		if( isset( $_GET[ 'search' ] ) ){
			$pagination_content .= '<input type="hidden" name="search" value="'.$_GET[ 'search' ].'">';
		}
		$pagination_content .= '</form></span>'; // 'paging-input'
		if( $paged != $paged_total ) { // show 'next-link' if not last page

			$paged_next = $paged + 1;
			$link_next = add_query_arg( 'paged', $paged_next, remove_query_arg( 'paged' ) );
			$pagination_content .= '<a class="next-page" title="Go to the next page" href="'.$link_next.'">'.$paged_next.' &gt;</a>';
		}
	}
	$pagination_content .= '</span>';
	return $pagination_content;
}

function wppage_stats_useragent_to_browser( $user_agent ) {
    if ( strripos( $user_agent, 'Opera' ) !== false ):
        $version = wppage_stats_useragent_to_browser_version( $user_agent, strripos( $user_agent, 'Opera' ), 5 );
        $browser = 'Opera';
    elseif ( strripos( $user_agent, 'Chrome' ) !== false ):
        $version = wppage_stats_useragent_to_browser_version( $user_agent, strripos( $user_agent, 'Chrome' ), 6 );
        $browser = 'Chrome';
    elseif ( strripos( $user_agent, 'Firefox' ) !== false ):
        $version = wppage_stats_useragent_to_browser_version( $user_agent, strripos( $user_agent, 'Firefox' ), 7 );
        $browser = 'Firefox';
    elseif ( strripos( $user_agent, 'MSIE' ) !== false ):
        $version = wppage_stats_useragent_to_browser_version( $user_agent, strripos( $user_agent, 'MSIE' ), 5 );
        $browser = 'Internet Explorer'; // 'IE' is not good, because of better search
    else:
        $browser = $user_agent;
    endif;

    return $browser;
}


function wppage_stats_useragent_to_browser_version( $user_agent, $offset, $offset_browser_name ) {
    // does not work good with Opera and Firefox
    $user_agent .= ' ';
    $str_end = strripos( $user_agent, ' ', $offset );
    $str_start = $offset + $offset_browser_name;
    $length = $str_end - $str_start;
    $version = substr( $user_agent, $str_start, $length );
    return $version.'start='.$str_start.'end='.$str_end;
}


function wppage_stats_language_to_short( $langcode ) { // return 2 letters ('en') from long var (en-US,en;q=0.8,uk;q=0.6,ru;q=0.4)
    $langcode = (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
    $langcode = (!empty($langcode)) ? explode(";", $langcode) : $langcode;
    $langcode = (!empty($langcode['0'])) ? explode(",", $langcode['0']) : $langcode;
    $langcode = (!empty($langcode['0'])) ? explode("-", $langcode['0']) : $langcode;
    return $langcode['0'];
}


function wppage_stats_referer_to_site( $referer='' ) { // return site from referer
	if( !empty( $referer ) ){
		//$site = $referer;
		$site = wppage_stats_link_to_site( $referer );
		/*$pos_slash = strpos( $referer, '/', 9 ); // 9 - to pass 'http://'
		$site = substr( $referer, 0, $pos_slash );
		$site = str_replace( '//www.', '', $site );
		$site = str_replace( '//', '', $site );
		$site = str_replace( 'http:', '', $site );
		$site = str_replace( 'https:', '', $site ); */
	} else {
		$site = '';
	}
	return $site;
}

function wppage_stats_referer_to_type( $referer='' ) { // return type from referer (direct, referral, search, inner)

	$home_url = get_bloginfo( 'siteurl' );

	$home_url = wppage_stats_link_to_site( $home_url );

	if( empty( $referer ) ){
		$type = 'direct';
	} else {
		$site = wppage_stats_referer_to_site( $referer );
		if( $site == 'google.com' || $site == 'google.com.ua' || $site == 'google.ru' || $site == 'google.by'
				|| $site == 'yandex.ru' || $site == 'yandex.ua' || $site == 'yandex.by' || $site == 'bing.com'
				|| $site == 'yahoo.com' || $site == 'search.yahoo.com' || $site == 'mail.ru' || $site == 'go.mail.ru' ) {
			$type = 'search';
		} elseif ( $site == $home_url ) {
			$type = 'inner';
		} else {
			$type = 'referral';
		}
	}
	return $type;
}


function wppage_stats_link_to_site( $site='' ) { // 'http://site.com/' => 'site.com'
	$site = $site.'/'; // just in case for wp_home
	$pos_slash = strpos( $site, '/', 9 ); // 9 - to pass 'http://'
	$site_new = substr( $site, 0, $pos_slash );
	$site_new = str_replace( '//www.', '', $site_new );
	$site_new = str_replace( '//', '', $site_new );
	$site_new = str_replace( 'http:', '', $site_new );
	$site_new = str_replace( 'https:', '', $site_new );

	return $site_new;
}


function wppage_stats_num( $rows_limit, $rows_total ) {
	$num_content = '';
	$num_content .= '<span class="displaying-num">';
	if( $rows_limit >= $rows_total ){
		$num_content .= $rows_total.' всего';
	}else{
		$num_content .= $rows_limit.' из '.$rows_total.' всего';
	}
	$num_content .= '</span>';
	return $num_content;
}


