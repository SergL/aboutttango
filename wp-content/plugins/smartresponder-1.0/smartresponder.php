<?php
/*
Plugin Name: Smartresponder
Plugin URI: http://smartresponder.ru
Description: Smartresponder plugin
Version: 1.0.0
Author: Smartresponder
Author URI: http://smartresponder.ru
*/

function smartresponder_wp_plugin_admin_menu(){
    if (function_exists('add_options_page')) {
        $admin_page = add_options_page('Smartresponder', 'Smartresponder', 8, 'smartresponder',  'smartresponder_wp_plugin_admin_menu_form' );
	add_action( "admin_print_scripts-$admin_page", 'smartresponder_wp_plugin_admin_menu_form_head' );
    }
}

function smartresponder_wp_plugin_admin_menu_form_head(){
    $plugindir = get_settings('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

    wp_deregister_script('jquery');
    wp_register_script('jquery', $plugindir . '/plugins/jquery-ui-1.8.24.custom/js/jquery-1.8.2.min.js');
    wp_enqueue_script('jquery');
    
    wp_deregister_script('jqueryUI');
    wp_register_script('jqueryUI', $plugindir . '/plugins/jquery-ui-1.8.24.custom/js/jquery-ui-1.8.24.custom.min.js');
    wp_enqueue_script('jqueryUI');

    wp_deregister_script('colorpicker');
    wp_register_script('colorpicker', $plugindir . '/plugins/miniColor/jquery.miniColors.js');
    wp_enqueue_script('colorpicker');

    wp_deregister_script('ui_widget');
    wp_register_script('ui_widget', $plugindir . '/plugins/fileUploader/js/vendor/jquery.ui.widget.js');
    wp_enqueue_script('ui_widget');

    wp_deregister_script('transport');
    wp_register_script('transport', $plugindir . '/plugins/fileUploader/js/jquery.iframe-transport.js');
    wp_enqueue_script('transport');

    wp_deregister_script('fileupload');
    wp_register_script('fileupload', $plugindir . '/plugins/fileUploader/js/jquery.fileupload.js');
    wp_enqueue_script('fileupload');
    
    wp_deregister_script('zclip');
    wp_register_script('zclip', $plugindir . '/plugins/zeroClipboard/jquery.zclip.js');
    wp_enqueue_script('zclip');
    
    wp_deregister_script('paginatetable');
    wp_register_script('paginatetable', $plugindir . '/plugins/mattpage-jquery.paginateTable-f2a087d/jquery.paginatetable.js');
    wp_enqueue_script('paginatetable');
    
    wp_enqueue_script('loadjs', $plugindir . '/smartresponder.js');

    echo '<link rel="stylesheet" href="'.$plugindir.'/plugins/jquery-ui-1.8.24.custom/css/smoothness/jquery-ui-1.8.24.custom.css" type="text/css" />';
    echo '<link rel="stylesheet" href="'.$plugindir.'/plugins/miniColor/jquery.miniColors.css" type="text/css" />';
    echo '<link rel="stylesheet" href="'.$plugindir.'/smartresponder.css" type="text/css" />';
}

//Login
function smartresponder_wp_plugin_login() {
    session_start();
    //Ключ доступа
    $api_key = htmlspecialchars($_GET['api_key']);
    // Создаём GET-запрос
    $api_url = 'http://api.smartresponder.ru/account.html?action=info&format=json&api_key='.$api_key;
    // Делаем запрос на API-сервер
    $result  = file_get_contents($api_url);
    $obj = json_decode($result);
    if($obj->result == '1') {
        // Создаём GET-запрос
        $deliveries_url = 'http://api.smartresponder.ru/deliveries.html?action=list&format=json&api_key='.$api_key;
        // Делаем запрос на API-сервер
        $deliveries_result  = file_get_contents($deliveries_url);
        $deliveries_obj = json_decode($deliveries_result);
        $deliveries_elements = $deliveries_obj->list->count;
        if($deliveries_elements == '0') {
            echo json_encode('error_d');
        }
        else {
            $_SESSION['login'] = $obj->login;
            $_SESSION['api_key'] = $api_key;
            echo $result;
        }
    }
    else {
        echo json_encode('error_u');    
    }
    
    die();
}

add_action('wp_ajax_login', 'smartresponder_wp_plugin_login');

//Log Out
function smartresponder_wp_plugin_logout() {
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['api_key']);
    session_destroy();
    
    die();
}

add_action('wp_ajax_logout', 'smartresponder_wp_plugin_logout');

//Check authentication
function smartresponder_wp_plugin_authentication() {
    session_start();
    if(isset($_SESSION['login']) && isset($_SESSION['api_key'])) {
        // Создаём GET-запрос
        $api_url = 'http://api.smartresponder.ru/account.html?action=info&format=json&api_key='.$_SESSION['api_key'];
        // Делаем запрос на API-сервер
        $result  = file_get_contents($api_url);

        echo $result;
    }
    
    die();
}

add_action('wp_ajax_authentication', 'smartresponder_wp_plugin_authentication');

//Get author ID
function smartresponder_wp_plugin_get_author_id() {
    // Создаём GET-запрос
    $api_url = 'http://api.smartresponder.ru/account.html?format=json&action=info&fields=id&api_key=syBiDXQiUDcHnqaXPvG1Kid6nEDyU4SC';
    // Делаем запрос на API-сервер
    $result  = file_get_contents($api_url);

    echo $result;
    
    die();
}

add_action('wp_ajax_get_author_id', 'smartresponder_wp_plugin_get_author_id');

//Get api key
function smartresponder_wp_plugin_get_api_key() {
    session_start();
    if(isset($_SESSION['api_key'])) {
        echo json_encode($_SESSION['api_key']);
    }
    else {
        echo json_encode('no');
    }
    
    die();
}

add_action('wp_ajax_get_api_key', 'smartresponder_wp_plugin_get_api_key');

//Get deliveries
function smartresponder_wp_plugin_get_deliveries() {
    //Ключ доступа
    $api_key = htmlspecialchars($_GET['api_key']);
    // Создаём GET-запрос
    $api_url   = 'http://api.smartresponder.ru/deliveries.html?format=json&action=list&api_key='.$api_key;
    // Делаем запрос на API-сервер
    $result  = file_get_contents($api_url);

    echo $result;
    
    die();
}

add_action('wp_ajax_get_deliveries', 'smartresponder_wp_plugin_get_deliveries');

//Get tracks
function smartresponder_wp_plugin_get_tracks() {
    //Ключ доступа
    $api_key = htmlspecialchars($_GET['api_key']);
    // Создаём GET-запрос
    $api_url   = 'http://api.smartresponder.ru/tracks.html?format=json&action=list&fields=id,title,code&sortorder=date_created&api_key='.$api_key;
    // Делаем запрос на API-сервер
    $result  = file_get_contents($api_url);

    echo $result; 
    
    die();
}

add_action('wp_ajax_get_tracks', 'smartresponder_wp_plugin_get_tracks');

//Get groups
function smartresponder_wp_plugin_get_groups() {
    //Ключ доступа
    $api_key = htmlspecialchars($_GET['api_key']);
    // Создаём GET-запрос
    $api_url   = 'http://api.smartresponder.ru/groups.html?format=json&fields=id,title&action=list&api_key='.$api_key;
    // Делаем запрос на API-сервер
    $result  = file_get_contents($api_url);

    echo $result; 
    
    die();
}

add_action('wp_ajax_get_groups', 'smartresponder_wp_plugin_get_groups');

//Get users
function smartresponder_wp_plugin_get_users() {
    global $wpdb;
    $from = htmlspecialchars($_REQUEST['from']);
    $to = htmlspecialchars($_REQUEST['to']);
    $data_mode = htmlspecialchars($_REQUEST['data_mode']);
    $email = htmlspecialchars($_REQUEST['email']);
    $send_users_ch = htmlspecialchars($_REQUEST['send_users_ch']);
    $check_exists_table = $wpdb->query('SELECT user_id FROM wp_sr_import');
    if($check_exists_table) {
        if($send_users_ch == '0') {
            $send_users_ch = 'AND wp_users.ID NOT IN (SELECT user_id FROM wp_sr_import)';
        }
        else {
            $send_users_ch = '';
        }   
    }
    else {
        $send_users_ch = '';
    }
    $query = "SELECT id, user_nicename, user_email, user_registered FROM $wpdb->users ";
    if(strlen($from) > 0 and strlen($to) > 0) {
        $query .= "WHERE user_registered >= '$from' AND user_registered <= '$to' AND user_email LIKE '%$email%' $send_users_ch ORDER BY id";
    }
    else {
        if(strlen($data_mode) > 0) {
            if($data_mode == 'TODAY') {
                $query .= "WHERE user_registered = date(now()) AND user_email LIKE '%$email%' $send_users_ch ORDER BY id";
            }
            if($data_mode == 'YESTERDAY') {
                $query .= "WHERE user_registered = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND user_email LIKE '%$email%' $send_users_ch ORDER BY id";
            }
            if($data_mode == 'WEEK') {
                $query .= "WHERE (user_registered >= NOW()-INTERVAL 7 DAY) AND user_email LIKE '%$email%' $send_users_ch ORDER BY id";
            }
        }
        else {
            $query .= "WHERE user_email LIKE '%$email%' $send_users_ch ORDER BY id";
        }
    }
    $posts = $wpdb->get_results($query, OBJECT);
    
    $posts_data = json_encode($posts);
    if(strlen($posts_data) > 0) {
        echo $posts_data;
    }
    
    die();
}

add_action('wp_ajax_get_users', 'smartresponder_wp_plugin_get_users');

//Import users
function smartresponder_wp_plugin_import() {
    $api_key = htmlspecialchars($_POST['api_key']);
    //Get destination
    $destination = htmlspecialchars($_POST['destination']);
    //Get nickname
    $nickname = htmlspecialchars($_POST['nickname']);
    $nickname_arr = explode(",",$nickname);
    //Get email
    $email = htmlspecialchars($_POST['email']);
    $email_arr = explode(",",$email);
    //Import
    $import_data = array();
    $import_data['service_key'] = '7Kq2kzooNS6hmaHuh7VCggzSvnpMmMUA';
    //$import_data['format'] = 'JSON';
    $import_data['format'] = 'xml';
    $import_data['api_key'] = $api_key;
    $import_data['action'] = 'import';
    $import_data['email_source'] = 'otherservice';
    $import_data['details'] = 'Импорт пользователей используя smartresponder plugin.';

    $subscribers = array();
    for($i = 0; $i < count($nickname_arr); $i++){
        for($i = 0; $i < count($email_arr); $i++) {
            $subscribers[] = $email_arr[$i].";".$nickname_arr[$i].";;;;;;;;;;";
        } 
    }

    $import_data['input_data'] = implode("\n", $subscribers);
    $import_data['destination'] = $destination;
    $import_data['description'] = 'Импорт пользователей используя smartresponder plugin.';
    $import_data['charset'] = 'utf-8';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://smartresponder.ru/api/import.html');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $import_data);
    $result = curl_exec($ch);
    $result = trim($result);
    //End import
    $tmp_result = simplexml_load_string($result);
    $result = json_encode($tmp_result);
    echo $result;
    
    die();
}

add_action('wp_ajax_import', 'smartresponder_wp_plugin_import');

function smartresponder_wp_plugin_result() {
    //Ключ доступа 
    $api_key = htmlspecialchars($_POST['api_key']);
    //import_key
    $import_key = htmlspecialchars($_POST['import_key']);
  
    //Import
    $import_data2 = array();
    $import_data2['service_key'] = '7Kq2kzooNS6hmaHuh7VCggzSvnpMmMUA';
    $import_data2['format'] = 'xml';
    $import_data2['import_key'] = $import_key;
    $import_data2['action'] = 'result';
    $import_data2['api_key'] = $api_key;

    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, 'http://smartresponder.ru/api/import.html');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch2, CURLOPT_POST, 1);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, $import_data2);
    $result2 = curl_exec($ch2);
    $result2 = trim($result2);
    $tmp_result = simplexml_load_string($result2);
    $result2 = json_encode($tmp_result);
    //End import
    
    echo $result2;
    
    die();
}

add_action('wp_ajax_result', 'smartresponder_wp_plugin_result');

//Save statistics data
function smartresponder_wp_plugin_save_statistics_data() {
    global $wpdb;
    //Get count of import users
    $selected_number_count = htmlspecialchars($_POST['selected_number_count']);
    //Get import users id
    $import_users_id = htmlspecialchars($_POST['import_users_id']);
    //Get ticketId
    $ticket_id = htmlspecialchars($_POST['ticket_id']);
        
    //Сохранение в базе импортированных пользователей
    $date = date('Y-m-d H-m-s');
    $create_table_sql = 'CREATE TABLE IF NOT EXISTS wp_sr_import (`id` int AUTO_INCREMENT PRIMARY KEY, `user_id` int NOT NULL, `import_date` datetime, `import_users_count` int, `ticket_id` VARCHAR(20) NOT NULL)';
    $wpdb->query($create_table_sql);
    $import_users_id = str_replace("wp_users_","",$import_users_id);
    $import_users_id = str_replace(",", ",".$date.",".$selected_number_count.",".$ticket_id.")", $import_users_id);
    $import_users_id = str_replace(")", "), (", $import_users_id);
    $import_users_id = "(".$import_users_id.",".$date.",".$selected_number_count.",".$ticket_id.")";
    $import_users_id = str_replace("(", "('", $import_users_id);
    $import_users_id = str_replace(")", "')", $import_users_id);
    $import_users_id = str_replace(",", "','", $import_users_id);
    $import_users_id = str_replace(")','", "),", $import_users_id);
    $insert_import_users_sql = "INSERT INTO `wp_sr_import`(`user_id`, `import_date`, `import_users_count`, `ticket_id`) VALUES $import_users_id";
    
    $result = $wpdb->query($insert_import_users_sql);
    
    if($result) {
        echo json_encode('ok');
    }
    else { 
        echo json_encode('bad');
    }
    
    die();
}

add_action('wp_ajax_save_statistics_data', 'smartresponder_wp_plugin_save_statistics_data');

//Create widget
function smartresponder_wp_plugin_widget() {
    global $wpdb;
    $html = $_POST['html'];
    if(strlen($html) > 0) {
        $create_table_sql = 'CREATE TABLE IF NOT EXISTS wp_sr_form (`id` int AUTO_INCREMENT PRIMARY KEY, `form_html` text) ENGINE=InnoDB DEFAULT CHARSET=utf8';
        $wpdb->query($create_table_sql);
        $insert_form_html = "INSERT INTO `wp_sr_form`(`form_html`) VALUES ('$html')";
        $wpdb->query($insert_form_html);
        smartresponder_init();
        echo json_encode('ok');
    }
    else {
        echo json_encode('bad');
    }

    die();
}

add_action('wp_ajax_widget', 'smartresponder_wp_plugin_widget');

function smartresponderOutput() {
    global $wpdb;
    $plugindir = get_settings('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
    $homepage = file_get_contents($plugindir.'/for_form.html');
    $sql = 'SELECT form_html FROM wp_sr_form WHERE id = (SELECT MAX(id) FROM wp_sr_form)';
    $result = $wpdb->get_var($sql);
    echo $homepage.$result;
}

function widget_smartresponderSubscribeForm() {
    smartresponderOutput();
}

function smartresponder_init()
{
    register_sidebar_widget(__('Smartresponder subscribe form',"smartresponder"), 'widget_smartresponderSubscribeForm');
}

add_action("plugins_loaded", "smartresponder_init");

//Get statistics data
function smartresponder_wp_plugin_get_statistics_data() {
    global $wpdb;
    //Get statistics data
    $import_users_data_sql = "SELECT user_id,import_date,import_users_count, ticket_id FROM wp_sr_import GROUP BY import_date";
    $import_users_data = $wpdb->get_results($import_users_data_sql, OBJECT);
    
    echo json_encode($import_users_data);
    
    die();
}

add_action('wp_ajax_get_statistics_data', 'smartresponder_wp_plugin_get_statistics_data');

function smartresponder_wp_plugin_admin_menu_form(){
    $plugindir = get_settings('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
?>
<div class='wrap'>
    <div class="section">
        <ul id="tabs" class="tabs-disabled">
            <li id="form_gen_li">Генератор форм подписки</li>
            <li id="subscribers_li">Импорт пользователей</li>
            <li id="statistics_li">Статистика</li>
            <li class="current">Установка</li>
        </ul>
        <div id="form_generator" class="box visible">
            <div class="leftCol">
                <div class="scene-editor">
                    <form class="sr-box" method="post" action="https://smartresponder.ru/subscribe.html" target="_blank" name="SR_form" style="z-index: 1;width: 250px; border: 1px solid rgb(188, 188, 188); margin: 0 auto; margin-top: 85px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                        <ul class="sr-box-list ui-sortable">
                            <li class="form-header" style="text-align: center; height: auto; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border: 0px solid rgb(0, 0, 0); ">
                                <label class="header_title" style="height: auto; line-height: 25px; margin-top: 10px; font-size: 16px; color: rgb(0, 0, 0); font-family: arial; font-weight: bold; font-style: normal; ">Подписка на рассылку</label>
                                <input type="hidden" name="element_header" value="" style="font-family: Arial; color: rgb(0, 0, 0); font-size: 12px; font-style: normal; font-weight: normal; border: none; " />
                            </li>
                            <li class="fields" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: 60px; text-align: center; background-position: initial initial; background-repeat: initial initial; ">																										 									
                                <label style="font-family: arial; color: rgb(0, 0, 0); font-size: 12px; font-style: normal; font-weight: normal; display: none; margin-top: 10px; " class="remove_labels">Ваше имя</label>
                                <input type="text" name="field_name_first" class="sr-required" value="Ваше имя" style="margin-top: 10px; background-image: none; font-family: arial; color: rgb(189, 189, 189); font-size: 13px; font-style: normal; font-weight: bold; border: 1px solid rgb(188, 188, 188); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: 40px; " />
                            </li>
                            <li class="fields" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: 60px; text-align: center; background-position: initial initial; background-repeat: initial initial; ">
                                <label style="font-family: arial; color: rgb(0, 0, 0); font-size: 12px; font-style: normal; font-weight: normal; display: none; margin-top: 10px; " class="remove_labels">Ваш email-адрес</label>
                                <input type="text" name="field_email" class="sr-required" value="Ваш email-адрес" style="margin-top: 10px; background-image: none; font-family: arial; color: rgb(189, 189, 189); font-size: 13px; font-style: normal; font-weight: bold; border: 1px solid rgb(188, 188, 188); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: 40px; " />
                            </li>
                            <li class="subscribe" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; text-align: center; background-color: none; border: 0px; height: 75px; background-position: initial initial; background-repeat: initial initial; ">			
                                <input type="submit" name="subscribe" disabled value="Подписаться" style="cursor: pointer; background-image: none; font-family: arial; color: rgb(255, 255, 255); font-size: 15px; font-style: normal; font-weight: bold; border: 1px solid rgb(99, 129, 18); margin-top: 10px; width: 150px; background-color: rgb(153, 192, 48); height: 40px; background-position: 0% 50%; background-repeat: repeat repeat; " />
                            </li>
                        </ul>
                    </form>
                </div>
                <div id="more-fields" class="settings">
                    <div class="separator-sr mtb" style="border: 0px; "></div>
                    <p style="margin-left: 180px; ">Поля данных для подписки:</p>
                    <div class="flds">
                        <input id="slyle_for_select" type="hidden" style="margin-top: 0px; background-image: none; font-family: arial; color: rgb(189, 189, 189); font-size: 13px; font-style: normal; font-weight: bold; background-color: rgb(255, 255, 255); border: 1px solid rgb(188, 188, 188); border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; height: 40px; padding: 12px; width: 32%; " />                            
                        <input id="style_for_p" type="hidden" style="display: block;font-family: 'times new roman'; color: rgb(189, 189, 189); font-size: 13px; font-style: normal; font-weight: bold;" />
                        <input id="field_email" type="button" value="Email" class="sr-disabled" />
                        <input id="field_name_last" type="button" value="Фамилия" class="not-added" />
                        <input id="field_name_first" type="button" value="Имя" class="sr-disabled" />
                        <input id="field_name_mid" type="button" value="Отчество" class="not-added" />
                        <input id="field_birth" type="button" value="Дата рождения" class="not-added" />
                        <input id="field_sex" type="button" value="Пол" class="not-added" />
                        <input id="field_charset_code" type="button" value="Кодировка писем" class="not-added" />
                        <input id="field_country_id" type="button" value="Страна" class="not-added" />
                        <input id="field_city" type="button" value="Город" class="not-added" />
                        <input id="field_address" type="button" value="Адрес" class="not-added" />
                        <input id="field_phones" type="button" value="Контактный телефон" class="not-added" />
                        <input id="field_company" type="button" value="Название компании" class="not-added" />  
                    </div>
                    <div class="separator-sr mtb"></div>
                    <div class="getHTMLbtn">
                        <input type="button" value="Создать Widget" name="widget" class="input-button" />
                        <input type="button" value="Получить html-код" name="get" class="input-button" />
                    </div>
                </div>
            </div>
            <div class="rightCol">
                <form method="post" id="formsForm" name="formsForm">
                    <div class="settings-header">
                        <p>Обязательные настройки формы</p>
                    </div>
                    <div class="settings" id="sub-form-settings">
                        <div class="separator-sr mtb" style="border-top: 0px; "></div>
                        <p><span class="red">1.</span> Форма подписывает на рассылки:</p>
                        <select id="sub-form" class="listbox listbox-multi wide" size="4" multiple="" name="deliveries[]" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; border: 1px solid rgb(149, 149, 149); width: 390px; margin-left: 20px; margin-top: 10px;"></select>
                        <div class="counter_key" style="display: none; "></div>
                        <div class="separator-sr mtb"></div>
                        <p><span class="red">2.</span> Элементы формы:</p>
                        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px; margin-left: 15px;">
                            <tbody>
                                <tr>
                                    <td style="width: 160px; ">
                                        <input type="checkbox" name="element_header" checked="checked" /> Хэдер 
                                        <input type="checkbox" name="element_counter" /> Счетчик 
					<input type="checkbox" name="element_delivery_variant" style="display: none;" />
                                    </td>
				</tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb"></div>
                        <p><span class="red">3.</span> Размеры и внешний вид формы:</p>
                        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="4">Ширина: <input type="text" name="form_width" maxlength="3" class="textbox" style="width: 50px; color: #2E3192;" value="250" /> в пикселях</td>
				</tr>
				<tr>
                                    <td width="65px">Граница:</td>
                                    <td style="width: 135px; ">
                                        <select name="fBorder" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="0">0</option>
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                        <input type="checkbox" name="f_dashed" value="1" style="margin-right: 5px;" />пунктир
                                    </td>
                                    <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Цвет:&nbsp;</td>
                                    <td align="left">
                                        <div class="colorBoxArea1" id="FormBorderColorArea1">
                                            <input type="hidden" name="css_form_border_color" value="C8C8C8" />
                                            <input type="text" name="color1" class="color-picker1" size="7" autocomplete="on" maxlength="10" value="#c8c8c8" style="color: #2E3192;" />
                                        </div>
                                    </td>
				</tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb"></div>
                        <p><span class="red">4.</span> Фон формы:</p>
                        <table border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td width="60px">
                                        <div class="inside" style="margin-top: 5px;">
                                            <input type="checkbox" name="bg_color" value="color" /> Цвет
                                        </div>
                                    </td>
                                    <td width="110px">
                                        <div class="colorBoxArea2" id="bgColorArea2" style="display: none;">
                                            <input type="hidden" name="css_bg_color" value="FFFFFF" />
                                            <input type="text" name="color2" class="color-picker2" size="7" autocomplete="on" maxlength="10" value="#FFFFFF" style="color: #2E3192;" />
					</div>
                                    </td>
                                    <td width="110px">
                                        <input type="checkbox" name="bg_picture" value="picture" /> Картинка
                                    </td>
                                    <td width="85px">
                                        <div id="upload" style="display: none; ">
                                            <div class="qq-uploader">
                                                <div class="qq-upload-drop-area" style="display: none; "></div>
                                                <div class="qq-upload-button upload-text" style="position: relative; overflow: hidden; direction: ltr; -webkit-border-radius: 3px; border: 1px solid #BBB; padding: 2px; text-align: center;">
                                                    Загрузить<input id="fileupload" type="file" name="files[]" data-url="<?php echo $plugindir . '/plugins/fileUploader/server/php/' ?>" multiple style="position: absolute; right: 0px; top: 0px; font-family: Arial; font-size: 118px; margin: 0px; padding: 0px; cursor: pointer; opacity: 0; text-align: center;" />
                                                </div>
                                                <ul class="qq-upload-list" style="display: none; "></ul>
                                            </div>
                                        </div>
                                        <div id="resize_img" style="display: none; ">
                                            <input id="resize_img_btn" type="button" name="res_btn" value="Изменить" />
                                        </div>
                                        <div id="ready_img" style="display: none; ">
                                            <input id="ready_img_btn" type="button" name="ready_btn" value="Готово" />
                                        </div>
					<div id="resize_btn" class="qq-upload-button" style="display: none; ">изменить</div>
					<span id="percent" style="display: none; "></span>
                                    </td>
				</tr>	
                            </tbody>
                        </table>
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                    </div>
                    <div class="settings-header" id="additional-settings-header">
                        <p>Дополнительные настройки формы</p>
                    </div>
                    <div class="settings" id="additional-settings-settings" style="height: 100%;">
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                        <p><span class="red">1.</span> Канал подписки, связанный с формой:</p>
                        <select name="trackId" class="listbox wide" style="width: 410px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 10px; margin-left: 20px;"></select>
                        <div class="separator-sr mtb"></div>
                        <p><span class="red">2.</span> Проверка заполнения полей формы:</p>
                        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="checksLevel" class="listbox wide" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="0">не проверять</option>
                                            <option value="1" selected>минимальная</option>
                                            <option value="2">максимальная</option>
                                        </select>
                                    </td>
				</tr>
				<tr>
                                    <td>Значения полей:</td>
				</tr>
				<tr>
                                    <td>
                                        <select name="meaning" class="listbox wide" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="ru_latin">Буквы русского и лат. алфавитов.</option>
                                            <option value="ru">Буквы русского алфавита.</option>
                                            <option value="latin">Буквы латинского алфавита.</option>
					</select>
                                    </td>
				</tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb"></div>
                        <p><span class="red">3.</span> Выравнивание формы:</p>
                        <select name="outer_alignment" class="listbox wide" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; margin-top: 10px; margin-left: 20px; ">
                            <option value="left" selected="selected">по левому краю</option>
                            <option value="center">по центру</option>
                            <option value="right">по правому краю</option>
                        </select>
                        <div class="separator-sr mtb" style="border: 0px; "></div>                        
                    </div>
                    <div class="settings-header" id="header-settings-header">
                        <p>Настройки шапки формы</p>
                    </div>
                    <div class="settings" id="header-settings" style="height: 100%;">
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                        <p style="display: block; margin-top: 15px; "><span class="red">1.</span> Шапка формы:</p>
                        <input type="text" id="title" name="unique_element_header_title" value="Подписка на рассылку" class="textbox wide" style="display: inline-block; margin-top: 10px; margin-left: 20px; width: 249px; color: #2E3192;" />
                        <div class="separator-sr mtb"></div>
                        <p style="display: block; "><span class="red">2.</span> Форматирование текста шапки:</p>
                        <table border="0" cellspacing="0" cellpadding="0" style="display: table; margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        Шрифт:
                                        <select id="font" name="unique_element_header_font" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="arial">Arial</option>
                                            <option value="courier">Courier</option>
                                            <option value="times new roman">Times New Roman</option>
                                            <option value="verdana">Verdana</option>    
                                        </select>
                                    </td>
                                    <td align="right" colspan="2">&nbsp;&nbsp;Цвет:</td>                        
                                    <td>
                                        <div class="colorBoxArea11" id="bgColorArea11" style="margin-left: 5px">
                                            <input type="text" name="color11" class="color-picker11" size="7" autocomplete="on" maxlength="10" value="#000000" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr style="display: table-row; ">
                                    <td colspan="6">
                                        Размер:
                                        <select id="size" name="unique_element_header_size" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="8px">8</option>
                                            <option value="9px">9</option>
                                            <option value="10px">10</option>
                                            <option value="11px">11</option>
                                            <option value="12px">12</option>
                                            <option value="13px">13</option>
                                            <option value="14px">14</option>
                                            <option value="15px">15</option>
                                            <option value="16px" selected>16</option>
                                            <option value="17px">17</option>
                                            <option value="18px">18</option>
                                            <option value="19px">19</option>
                                            <option value="20px">20</option>
                                            <option value="21px">21</option>
                                            <option value="22px">22</option>
                                            <option value="23px">23</option>
                                            <option value="24px">24</option>
                                        </select>
                                        &nbsp;&nbsp;Тип:
                                        <select id="type" name="unique_element_header_type" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="normal">Обычный</option>
                                            <option value="bold" selected>Жирный</option>
                                            <option value="italic">Курсив</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                    </div>
                    <div class="settings-header" id="field-settings-header">
                        <p>Настройки полей формы</p>
                    </div>
                    <div class="settings" id="field-settings" style="height: 100%;">
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                        <p style="display: block; "><span class="red">1.</span> Отображение названия поля:</p>
                        <div class="separator-sr mtb"></div>
                        <table cellspacing="0" cellpadding="0" border="0" style="display: table; margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td width="25px">
                                        <input type="radio" value="field" name="edit_type" class="over" />
                                    </td>
                                    <td>Над полем&nbsp;&nbsp;</td>
                                    <td></td>
                                    <td width="25px">
                                        <input type="radio" value="initial_field" name="edit_type" checked="checked" class="under" />
                                    </td>
                                    <td>Внутри поля</td>
                                </tr>
                            </tbody>
                        </table>
                    <div class="separator-sr mtb" id="separator-for-underF"></div>
                    <p style="display: block; " id="under_text_field"><span class="red">2.</span> Форматирование текста в поле:</p>
                        <table id="under_text-table" border="0" cellspacing="0" cellpadding="0" style="display: table; margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        Шрифт:
                                        <select id="under_initial_font" name="under_unique_field_initial_font" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="arial">Arial</option>
                                            <option value="courier">Courier</option>
                                            <option value="times new roman">Times New Roman</option>
                                            <option value="verdana">Verdana</option>    
                                        </select>
                                    </td>
                                    <td align="right" colspan="2">&nbsp;&nbsp;Цвет:</td>
                                    <td>
                                        <div class="colorBoxArea6" id="bgColorArea6" style="margin-left: 5px">
                                            <input type="text" name="color6" class="color-picker6" size="7" autocomplete="on" maxlength="10" value="#BDBDBD" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        Размер:
                                        <input type="hidden" name="under_field_initial_font" value="Arial" />
                                        <input type="hidden" name="under_field_initial_size" value="13px" />
                                        <input type="hidden" name="under_field_initial_type" value="bold" />
                                        <input type="hidden" name="under_field_initial_color" value="#BDBDBD" />
                                        <select id="under_initial_size" name="under_unique_field_initial_size" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="8px">8</option>
                                            <option value="9px">9</option>
                                            <option value="10px">10</option>
                                            <option value="11px">11</option>
                                            <option value="12px">12</option>
                                            <option value="13px" selected>13</option>
                                            <option value="14px">14</option>
                                            <option value="15px">15</option>
                                            <option value="16px">16</option>
                                            <option value="17px">17</option>
                                            <option value="18px">18</option>
                                            <option value="19px">19</option>
                                            <option value="20px">20</option>
                                            <option value="21px">21</option>
                                            <option value="22px">22</option>
                                            <option value="23px">23</option>
                                            <option value="24px">24</option>
                                        </select>
                                        &nbsp;&nbsp;
                                        Тип:
                                        <select id="under_initial_type" name="under_unique_field_initial_type" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="normal">Обычный</option>
                                            <option value="bold" selected>Жирный</option>
                                            <option value="italic">Курсив</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p style="display: none; " id="over_text_field"><span class="red">3.</span> Форматирование текста над полем:</p>
                        <table id="over_text-table" border="0" cellspacing="0" cellpadding="0" style="display: none; margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        Шрифт:
                                        <select id="over_initial_font" name="over_unique_field_initial_font" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="arial">Arial</option>
                                            <option value="courier">Courier</option>
                                            <option value="times new roman">Times New Roman</option>
                                            <option value="verdana">Verdana</option>    
                                        </select>
                                    </td>
                                    <td align="right" colspan="2">&nbsp;&nbsp;Цвет:</td>
                                    <td>
                                        <div class="colorBoxArea10" id="bgColorArea10" style="margin-left: 5px">
                                            <input type="text" name="color10" class="color-picker10" size="7" autocomplete="on" maxlength="10" value="#000000" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        Размер:
                                        <input type="hidden" name="over_field_initial_font_h" value="Arial" />
                                        <input type="hidden" name="over_field_initial_size_h" value="12px" />
                                        <input type="hidden" name="over_field_initial_type_h" value="normal" />
                                        <input type="hidden" name="over_field_initial_color_h" value="#000000" />
                                        <select id="initial_size" name="over_unique_field_initial_size" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="8px">8</option>
                                            <option value="9px">9</option>
                                            <option value="10px">10</option>
                                            <option value="11px">11</option>
                                            <option value="12px">12</option>
                                            <option value="13px" selected>12</option>
                                            <option value="14px">14</option>
                                            <option value="15px">15</option>
                                            <option value="16px">16</option>
                                            <option value="17px">17</option>
                                            <option value="18px">18</option>
                                            <option value="19px">19</option>
                                            <option value="20px">20</option>
                                            <option value="21px">21</option>
                                            <option value="22px">22</option>
                                            <option value="23px">23</option>
                                            <option value="24px">24</option>
                                        </select>
                                        &nbsp;&nbsp;
                                        Тип:
                                        <select id="initial_type" name="over_unique_field_initial_type" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="normal">Обычный</option>
                                            <option value="bold">Жирный</option>
                                            <option value="italic">Курсив</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb"></div>
                        <p style=""><span class="red" id="span_field">3.</span> Форматирование поля:</p>
                        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td>Граница:&nbsp;</td>
                                    <td>
                                        <select id="border_weight" name="unique_field_border_weight" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="0">0</option>
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="colorBoxArea7" id="bgColorArea7" style="margin-left: 10px">
                                            <input type="text" name="color7" class="color-picker7" size="7" autocomplete="on" maxlength="10" value="#BCBCBC" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                    <td width="75px" align="right">
                                        Фон: <input type="checkbox" id="bg_color" name="unique_field_bg_color" checked />
                                    </td>
                                    <td width="125px">
                                        <div class="colorBoxArea8" id="bgColorArea8" style="margin-left: 5px">
                                            <input type="text" name="color8" class="color-picker8" size="7" autocomplete="on" maxlength="10" value="#FFFFFF" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                    </div>
                    <div class="settings-header" id="button-settings-header">
                        <p>Настройки кнопки формы</p>
                    </div>
                    <div class="settings" id="button-settings" style="height: 100%;">
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                        <p><span class="red">1.</span> Изначальное значение кнопки:</p>
                        <input type="text" id="title" name="unique_subscribe_title" class="textbox wide" value="Подписатся" style="width: 294px; margin-top: 10px; margin-left: 20px; color: #2E3192;" />
                        <div class="separator-sr mtb"></div>
                        <p style=""><span class="red">2.</span> Форматирование текста кнопки:</p>
                        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        Шрифт:
                                        <select id="font" name="unique_subscribe_font" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="arial">Arial</option>
                                            <option value="courier">Courier</option>
                                            <option value="times new roman">Times New Roman</option>
                                            <option value="verdana">Verdana</option>    
                                        </select>
                                    </td>
                                    <td align="right" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;Цвет:&nbsp;</td>                      
                                    <td>
                                        <div class="colorBoxArea3" id="bgColorArea3" style="">
                                            <input type="text" name="color3" class="color-picker3" size="7" autocomplete="on" maxlength="10" value="#FFFFFF" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr style="display: table-row; ">
                                    <td colspan="6">
                                        Размер:
                                        <select id="size" name="unique_subscribe_size" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="8px">8</option>
                                            <option value="9px">9</option>
                                            <option value="10px">10</option>
                                            <option value="11px">11</option>
                                            <option value="12px">12</option>
                                            <option value="13px">13</option>
                                            <option value="14px">14</option>
                                            <option value="15px">15</option>
                                            <option value="16px">16</option>
                                            <option value="17px">17</option>
                                            <option value="18px">18</option>
                                            <option value="19px">19</option>
                                            <option value="20px">20</option>
                                            <option value="21px">21</option>
                                            <option value="22px">22</option>
                                            <option value="23px">23</option>
                                            <option value="24px">24</option>
                                        </select>
                                        &nbsp;&nbsp;Тип:
                                        <select id="type" name="unique_subscribe_type" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="normal">Обычный</option>
                                            <option value="bold" selected>Жирный</option>
                                            <option value="italic">Курсив</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb"></div>
                        <p style=""><span class="red">3.</span> Форматирование кнопки:</p>
                        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td>Граница:&nbsp;</td>
                                    <td>
                                        <select id="border_weight" name="unique_subscribe_border_weight" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="0">0</option>
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="colorBoxArea4" id="bgColorArea4" style="margin-left: 10px">
                                            <input type="text" name="color4" class="color-picker4" size="7" autocomplete="on" maxlength="10" value="#638112" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                    <td width="75px" align="right">Фон: <input type="checkbox" id="bg_color" name="unique_subscribe_bg_color" checked /></td>
                                    <td width="115px">
                                        <div class="colorBoxArea5" id="bgColorArea5" style="margin-left: 10px">
                                            <input type="hidden" name="btn_color" value="#99C030" />
                                            <input type="text" name="color5" class="color-picker5" size="7" autocomplete="on" maxlength="10" value="#99C030" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                    </div>
                    <div class="settings-header" id="counter-settings-header" style="display: none;">
                        <p>Настройки счетчика формы</p>
                    </div>
                    <div class="settings" id="counter-settings" style="height: 100%; display: none;">
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                        <p><span class="red">1.</span> Название счетчика подписчиков:</p>
                        <input type="text" id="title" name="unique_element_counter_title" class="textbox wide" value="Подписчиков" style="display: inline-block; margin-top: 10px; margin-left: 20px;" />
                        <div class="separator-sr mtb"></div>
                        <p style=""><span class="red">2.</span> Форматирование текста счетчика:</p>
                        <input type="hidden" name="element_counter_font" value="arial" />
                        <input type="hidden" name="element_counter_size" value="13px" />
                        <input type="hidden" name="element_counter_type" value="bold" />
                        <input type="hidden" name="element_counter_color" value="#ADA6AD" />
                        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        Шрифт:
                                        <select id="font" name="unique_element_counter_font" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="arial">Arial</option><option value="courier">Courier</option>
                                            <option value="times new roman">Times New Roman</option><option value="verdana">Verdana</option>
                                        </select>
                                    </td>
                                    <td align="right" colspan="2">&nbsp;&nbsp;Цвет:</td>                        
                                    <td>
                                        <div class="colorBoxArea9" id="bgColorArea9" style="margin-left: 5px">
                                            <input type="text" name="color9" class="color-picker9" size="7" autocomplete="on" maxlength="10" value="#BDBDBD" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr style="display: table-row; ">
                                    <td colspan="6">
                                        Размер:
                                        <select id="size" name="unique_element_counter_size" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="8px">8</option>
                                            <option value="9px">9</option>
                                            <option value="10px">10</option>
                                            <option value="11px">11</option>
                                            <option value="12px">12</option>
                                            <option value="13px" selected>13</option>
                                            <option value="14px">14</option>
                                            <option value="15px">15</option>
                                            <option value="16px">16</option>
                                            <option value="17px">17</option>
                                            <option value="18px">18</option>
                                            <option value="19px">19</option>
                                            <option value="20px">20</option>
                                            <option value="21px">21</option>
                                            <option value="22px">22</option>
                                            <option value="23px">23</option>
                                            <option value="24px">24</option>
                                        </select>
                                        &nbsp;&nbsp;Тип:
                                        <select id="type" name="unique_element_counter_type" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="normal">Обычный</option>
                                            <option value="bold" selected>Жирный</option>
                                            <option value="italic">Курсив</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb"></div>
                        <p id="counter" style="display: block; "><span class="red">3.</span> Счетчик подписчиков:</p>
                        <input type="hidden" name="counter_img_font" value="verdana" />
                        <input type="hidden" name="counter_img_size" value="10" />
                        <input type="hidden" name="counter_img_color" value="ada6ad" />
                        <input type="hidden" name="counter_img_bg" value="0ffffff" />
                        <input type="hidden" name="counter_img_alignment" value="right" />
                        <table border="0" cellspacing="0" cellpadding="0" style="display: table; margin-top: 10px; margin-left: 20px;">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        Шрифт:
                                        <select id="number_font" name="" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="arial">Arial</option>
                                            <option value="courier">Courier</option>
                                            <option value="timesnewroman">Times New Roman</option>
                                            <option value="verdana" selected>Verdana</option>
                                        </select>
                                    </td>
                                    <td align="right">Цвет:</td>                        
                                    <td colspan="2">
                                        <div class="colorBoxArea12" id="bgColorArea12" style="margin-left: 5px">
                                            <input type="text" name="color12" class="color-picker12" size="7" autocomplete="on" maxlength="10" value="#ADA6AD" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        Размер:
                                        <select id="number_size" name="" class="listbox" style="border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10" selected>10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                        </select>
                                    </td>
                                    <td style="width: 65px; ">&nbsp;Фон: <input type="checkbox" name="number_bg_color" id="number_bg_color" /></td>
                                    <td>
                                        <div class="colorBoxArea13" id="bgColorArea13" style="margin-left: 5px; display: none;">
                                            <input type="text" name="color13" class="color-picker13" size="7" autocomplete="on" maxlength="10" value="#FFFFFF" style="color: #2E3192;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        от надписи
                                        <select id="number_alignment" name="" class="listbox" style="width: 70px; border-top-left-radius: 0px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; ">
                                            <option value="top">сверху</option>
                                            <option value="right" selected>справа</option>
                                            <option value="bottom">снизу</option>
                                            <option value="left">слева</option> 
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="separator-sr mtb" style="border: 0px; "></div>
                    </div>
                </form>
            </div>
            <div id="modalWindowDefault_area">
                <textarea class="form_code"></textarea>
                <br />
                <p style="text-align: right;"></p>
            </div>
        </div>
        <form action="" name="subscribers_form">
            <div id="subscribers" class="box">
                <div id="users_list">
                    <div class="user-caption minus" style="background-image: url(https://smartresponder.ru/imgs/static/send_message/minus.png); ">
                        <span class="red">А)</span> Выбор пользователей
                    </div>
                    <div class="user-fields">
                        <div class="mega-table-filter">
                            <table class="mega-table-filter-table">
                                <tbody>
                                    <tr class="mega-table-title">
                                        <th colspan="2" style="background: transparent; ">Фильтр поиска</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" class="ready_period" name="search[date_mode]" checked="checked">&nbsp;&nbsp;готовые варианты:&nbsp;&nbsp;
                                            <select class="listbox" name="search[date_mode]">
                                                <option value="">За весь период</option>
                                                <option value="TODAY">За сегодня</option>
                                                <option value="YESTERDAY">За вчера</option>
                                                <option value="WEEK">За последнюю неделю</option>
                                            </select>
                                        </td>
                                        <td style="text-align: left; ">
                                            <input type="radio" class="period" name="search[date_mode]" value="PERIOD" style="margin-left: 40px;" />&nbsp;&nbsp;за период с:&nbsp;&nbsp;
                                            <input type="text" id="from" name="from" readonly />
                                            по:&nbsp;&nbsp;
                                            <input type="text" id="to" name="to" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Фильтр по емайлу:&nbsp;&nbsp;<input type="text" name="email_filter" />
                                        </td>
                                        <td>
                                            <input type="checkbox" name="send_users_ch" />&nbsp;&nbsp;Отображать пользователей, которые были ранее импортированы
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="button" name="sample" value="Отфильтровать" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="wp_users_count" style="text-align: left; font-weight: bold; ">
                            Общее количество пользователей: <span class="red" id="users_count">0</span>
                        </div>
                        <div class="mega-table-container">
                            <table class="mega-table">
                                <thead>
                                    <tr class="mega-table-title" id="users_result">
                                        <th style="width: 50px; background: transparent; ">ID</th>
                                        <th style="width: 160px; ">Nickname пользователя</th>
                                        <th style="width: 162px; ">Email пользователя</th>
                                        <th style="width: 160px; ">Дата регестрации</th>
                                        <th style="width: 30px; ">
                                            <input class="checkbox_all" type="checkbox" name="check_all_users" value="" />
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="wp_users_pagination" id="tablePagination">
                            Выводить по&nbsp;
                            <select name="records_on_page" class="listbox">
                                <option>10</option>
                                <option>20</option>
                                <option>30</option>
                                <option>50</option>
                                <option selected>100</option>
                            </select>
                            <div class='pager' style="float: right; ">
                                <a href='#' alt='First' class='firstPage'>First</a>&nbsp;
                                <a href='#' alt='Previous' class='prevPage'>Prev</a>&nbsp;
                                <span class='currentPage'></span> of 
                                <span class='totalPages'></span>&nbsp;
                                <a href='#' alt='Next' class='nextPage'>Next</a>&nbsp;
                                <a href='#' alt='Last' class='lastPage'>Last</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                        <div id="nextstep">
                            <input type="button" name="nextstep" value="Выбрать" />
                        </div>
                    </div>
                </div>
                <div id="place_order">
                    <div class="order-caption">
                        <span class="red">Б)</span> Импортирование пользователей
                    </div>
                    <div class="order-fields" style="display: none; ">
                        <div class="wp_users_count_ch">
                            Количество выбранных пользователей: <span class="red" id="selected_number_count">0</span>
                        </div>
                        <div class="import-request-options">
                            <div><input type="radio" class="get_deliveries" name="get_deliveries"> Выберите в какую рассылку вы хотите импортировать список:</div>
                            <br />
                            <div class="get_deliveries_select" style="display: none; ">
                                <select name="rDestinationId" id="rDestinationId_d" class="listbox" style="width:608px; padding-left:10px; margin-left:1px">
                                    <option value="0" class="chose">Выбрать →</option>
                                </select>
                                <div style="height: 10px;"></div>
                            </div>
                            <div><input type="radio" class="get_groups" name="get_groups"> Выберите в какую группу вы хотите импортировать список:</div>
                            <br />
                            <div class="get_groups_select" style="display: none; ">
                                <select name="rDestinationId" id="rDestinationId_g" class="listbox" style="width:608px; padding-left:10px; margin-left:1px">
                                    <option value="0" class="chose">Выбрать →</option>
                                </select>
                                <div style="height: 10px;"></div>
                            </div>
                        </div>
                        <div class="wp_users_message">
                            <p>ОБРАТИТЕ ВНИМАНИЕ!</p><br />Если не было выбрано ни одного пользователя, то будет добавлен весь список
                        </div>
                        <div class="subscribers_buttons" style="text-align: center; ">
                            <input type="button" name="send_request_btn" value="Импортировать" />
                        </div>
                        <img id="modalWindow_pixel2" style="z-index: 98; width: 100%; height: 100%; position: fixed; left: 0px; top: 0px; display: none; opacity: 0.5; " src="" />
                        <input type="hidden" name="selected_number_count" value="" />
                        <input type="hidden" name="import_users_id" value="" />
                        <div class="modal_import1">
                            <div class="import_step_1">
                                Запрос обрабатывается... <span class="import_progress"></span>
                            </div>
                            <div class="bad_import">
                                <p>Пользователи не были импортированы.</p>
                            </div>
                            <div class="close_import1">
                                <input type="button" name="close_import1" value="Закрыть" style="width: 80px; height: 22px;" />
                            </div>
                            <div id="progressbar">
                                <div class="progressbar_img"></div>
                            </div>
                        </div>
                        <div class="modal_import2">
                            <div class="import_step_2">
                                <p>Заявка была отправлена.</p>
                                <br />
                                <div class="application">ID заявки: <span class="red" id="ticketId"></span></div>
                                <div class="import_message">Пожалуйста дождитесь ответа нашего сотрудника.</div>
                            </div>
                            <div class="close_import2">
                                <input type="button" name="close_import2" value="Закрыть" style="width: 80px; height: 22px;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="statistics" class="box">
            <div class="wp_import_users_count">
                Общее количество импортированных пользователей: <span class="red" id="import_users_count">0</span>
            </div>
            <div class="mega-table-statistics">
                <table class="mega-table-subscribers-table">
                    <tbody>
                        <tr class="mega-table-title">
                            <th style="background: transparent; width: 230px; ">Дата импорта</th>
                            <th style="width: 518px; ">Количество импорированных пользователей</th>
                            <th>Ключ импорта</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="setup" class="box">
            <div class="login">
                <br />
                <h2>Установка Smartresponder</h2>
                <div class="error" style="display: none;">
                    <p class="red"></p>
                </div>
                <br />
                <p>Для того что-бы использовать Smartresponder Plugin - в первую очередь необходимо авторизоваться.</p>
                <br />
                <p>Если у вас нет аккаунта - <a href="https://smartresponder.ru/l_ru/user/reg.html" target="_blank">зарегистрируйтесь.</a></p>
                <br />
                <table>
                    <tr>
                        <td>Api ключ</td>
                        <td><input type="text" name="apikey" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style="text-align: right;"><a href="https://smartresponder.ru/l_ru/user/account_settings.html" target="_blank">Получить API ключ.</a></td>
                    </tr>
                    <tr>
                        <td><input type="button" name="login-sr" value="Сохранить/Проверить" />&nbsp;&nbsp;</td>
                        <td class="login_loading" style="vertical-align: middle; "></td>
                    </tr>
                </table>
            </div>
            <div class="logout" style="display: none;">
                <br />
                <h2>Установка Smartresponder</h2>
                <br />
                <table>
                    <tr>
                        <td>
                            <p class="author_stats"></p>
                            <input type="hidden" name="api_key" value="" />
                            <input type="hidden" name="author_id" value="" />
                            <input type="hidden" name="d_count" value="" />
                        </td>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="logout-sr" value="Выйти" /></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
}

/* ******************************* */
add_action('admin_menu',  'smartresponder_wp_plugin_admin_menu' );

?>