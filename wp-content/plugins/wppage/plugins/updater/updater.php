<?php


function wppage_update_plugin( $url = 'http://static.wppage.ru/wppage.zip' ) { // http://webolab.org.ua/wppage-dev.zip http://webolab.org.ua/wppage.zip   http://webolab.org.ua/wppage-lite.zip   http://static.wppage.ru/wppage.zip http://webolab.org.ua/wppage_update/wppage.zip
	$return = '';
	//global $wp_filesystem;

	//$target_url = plugin_dir_path( __FILE__ );
	//$target_url = plugins_url( '/wppage/' );
	$target_url = ABSPATH . 'wp-content/plugins/wppage/';

	//echo ' plugins_url='.plugins_url( '/wppage/' );
	//echo ' plugin_dir_path='.plugin_dir_path( __FILE__ );

	$download_file = download_url( $url ); // download target file
	if ( is_wp_error($download_file) ) {
		//return new WP_Error('download_failed', $this->strings['download_failed'], $download_file->get_error_message());
		$return .= ' <p>Ошибка: скачивание файла не удалось.</p> '; /*. $download_file*/
		//print_r( $download_file );
		return $return;
	}

	//$return .= ' <br> download url= ' . $download_file;


	$dir = $target_url; // delete all files and folders in target folder
	if( is_dir( $dir ) ) { // Open a known directory, and proceed to read its contents
		if( $dh = opendir( $dir ) ) {
			while( ( $file = readdir( $dh ) ) !== false ) {
				if ($file != "." && $file != "..") {
					//cozy_delete_folder( $target_url.$file );
					if( is_dir( $target_url.$file ) ){
						cozy_delete_folder( $target_url.$file );
					}
					if( is_file( $target_url.$file ) ){
						//cozy_delete_folder( $target_url.$file );
						unlink( $target_url.$file ); // delete file
					}
				}
			}
			//closedir( $dh );
		}
	}


	//$upload_url = content_url();

	//WP_Filesystem(); // give direct access instead of ftp

	//function _return_direct() { return 'direct'; }
	//add_filter('filesystem_method', '_return_direct');
	WP_Filesystem();
	//remove_filter('filesystem_method', '_return_direct');
	//global $wp_filesystem;
	//unzip_file( $_FILES['premium']['tmp_name'],''.ABSPATH.'wp-content/plugins/sp-client-document-manager/' );

	//$target_url = ABSPATH.'wp-content/plugins/cozy-updater/';

	$result = unzip_file( $download_file, $target_url );

	$return .= ' <br>target_url= ' . $target_url.' <br> ';

	if ( is_wp_error( $result ) ) {
		if ( 'incompatible_archive' == $result->get_error_code() ) {
			//$return .= new WP_Error( 'incompatible_archive', $this->strings['incompatible_archive'], $result->get_error_data() );
			$return .= ' <p>Ошибка: разархивация не удалась.</p> ';
			return $return;
		}
		//$return .= $result;
	}

	//$cozy_updater_plugin = plugin_basename( __FILE__ );
	//echo plugin_basename( __FILE__ );
	$cozy_updater_plugin = 'wppage/wppage.php';
	deactivate_plugins( $cozy_updater_plugin );
	activate_plugins( $cozy_updater_plugin );

	unlink( $download_file ); // delete downloaded file
	$return = '<h2>Обновление прошло успешно.</h2>';

	

	//echo ' old_url = '. $old_url;
	//echo $update_sql;


	return $return;

}

//----------------------

function cozy_delete_folder_new( $targ ){ // recursively delete folders and files
    if(is_dir($targ)){
        $files = glob( $targ . '*', GLOB_MARK ); // GLOB_MARK adds a slash to directories returned
        foreach( $files as $file ){
            //if ( $file != '.' && $file != '..' ) {
            cozy_delete_folder( $file ); // recursive
            //}
        }
        rmdir( $targ );
        echo '<p><strong>remove dir</strong>: '.$targ.'</p>';
    }else{
        unlink( $targ );
        echo '<p>remove file: '.$targ.'</p>';
    }
}

//-------------------------------

function cozy_delete_folder($dirname) {
    if (is_dir($dirname)){
        $dir_handle = opendir($dirname);
    }
    if (!$dir_handle){
        return false;
    }
    while($file = readdir($dir_handle)) {
        if ($file != "." && $file != "..") {
            if (!is_dir($dirname."/".$file)){
                unlink($dirname."/".$file);
                //echo '<p>remove file: '.$dirname."/".$file.'</p>';
            }else{
                cozy_delete_folder($dirname.'/'.$file);
            }
        }
    }
    closedir($dir_handle);
    rmdir($dirname);
    //echo '<p><strong>remove dir</strong>: '.$dirname.'</p>';
    return true;
}


function wppage_get_latest_version() {
	$fw_url = 'http://static.wppage.ru/readme.txt'; //http://static.wppage.ru/readme.txt http://webolab.org.ua/wppage_update/readme.txt
	$temp_file_addr = download_url( $fw_url );
	$latest_version = '0';
	if( ! is_wp_error( $temp_file_addr ) && $file_contents = file( $temp_file_addr ) ) {
		foreach ( $file_contents as $line_num => $line ) {
			$current_line =  $line;
			if ( strpos($line, 'version') !== false ) { // preg_match( '/^[0-9]/', $line )
				$current_line = stristr( $current_line, 'version' ); // search for the first word 'version' in the file line y line
				$current_line = preg_replace( '~[^0-9,.]~','',$current_line );
				$output['version'] = $current_line;
				$latest_version = $current_line;
				break;
			}
		}
		unlink( $temp_file_addr );

	} else {
		//$output['version'] = get_option( 'woo_framework_version' );
	}
	return $latest_version;
}


add_action('admin_head', 'wppage_update_check'); // check wppage update in 'admin_head' hook
function wppage_update_check() {
	if( !get_option( 'wppage_latest_version' ) ) { // option does not exist
		$wppage_latest_version = wppage_get_latest_version(); // check latest version
		update_option( 'wppage_latest_version', $wppage_latest_version );
		update_option( 'wppage_update_check', date( 'Y-m-d H:i:s' ) );
	} else {
		if( strtotime( get_option( 'wppage_update_check' ) ) < strtotime( '-1 days' ) ) { // check if it is passed 1 day since last update check
			$wppage_latest_version = wppage_get_latest_version(); // check latest version
			update_option( 'wppage_latest_version', $wppage_latest_version );
            update_option( 'wppage_update_check', date( 'Y-m-d H:i:s' ) );
		}
	}

	$wppage_latest_version = get_option( 'wppage_latest_version' );
	$wppage_version = get_option( 'wppage_version' );
	if( version_compare( $wppage_version, $wppage_latest_version ) < 0) { // we need to update

    }
	return version_compare( $wppage_version, $wppage_latest_version );
}



function wppage_update_info() {
	$return_html = '';
	//if( !get_option( 'wppage_update_check' ) ) {
		//$wppage_latest_version = wppage_get_latest_version();
		//update_option( 'wppage_latest_version', $wppage_latest_version );
		//update_option( 'wppage_update_check', date( 'Y-m-d H:i:s' ) );
	//}

	$wppage_latest_version = get_option( 'wppage_latest_version' );
	$wppage_version = get_option( 'wppage_version' );
	$wppage_update_check = get_option( 'wppage_update_check' );

    if( version_compare( $wppage_version, $wppage_latest_version ) < 0 ) { // we need to update
        $return_html .= '<p><strong>Появилась новая версия wppage!.</strong></p>';
    } else {
        $return_html .= '<p><strong>У вас установлена последняя версия.</strong></p>';
    }

	$return_html .= '<p>Ваша версия: '.$wppage_version.'</p>';
	$return_html .= '<p>Последняя версия: '.$wppage_latest_version.'</p>';
	$return_html .= '<p>Время проверки обновления: '.$wppage_update_check.'</p>';



	return $return_html;
}



//---------------------------

function wppage_updater() {

?>
<div class="wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h2>Обновление</h2>
    <hr class="h_line">
    <br>
	<div id="tab_container" class="tab_container">


		<?php
		if( isset($_GET['do']) && $_GET['do'] == 'update' ){
            $wppage_latest_version = get_option('wppage_latest_version');
            echo wppage_update_plugin();
            update_option( 'wppage_version', $wppage_latest_version );
        }

		wppage_update_check();

		echo wppage_update_info();

		$wppage_latest_version = get_option( 'wppage_latest_version' );
		$wppage_version = get_option( 'wppage_version' );

		//echo 'vers='.version_compare( $wppage_version, $wppage_latest_version );

		if( version_compare( $wppage_version, $wppage_latest_version ) < 0) : // we need to update

			?>

			<form action="edit.php" method="get">
				<input type="hidden" name="page" value="wppage-updater">
				<input type="hidden" name="post_type" value="page_selling">
				<input type="hidden" name="do" value="update">
				<p class="submit ">
					<input type="submit" class="button-primary button-hero" value="Обновить" />
				</p>

			</form>

			<?php
		endif;
		?>



	</div> <!-- /#tab_container -->

</div> <!-- /.wrap -->
<?php

}
