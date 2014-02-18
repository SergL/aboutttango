<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'db_abouttango');

/** Имя пользователя MySQL */
define('DB_USER', 'u_abouttango');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'qmc3ZMCo');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_;6#GR9$d5|N8:REr9S;^&0((IMc]f5J2?7F?|s:rQ^DP_q9gd|/2CO}uv?dAm|n');
define('SECURE_AUTH_KEY',  'kG+kXNHj0}3;frA<hQ:/6?8+b}Ya3]wk(np-uI;6+{b]n*@uXJ~q3P?k=>ce=i~[');
define('LOGGED_IN_KEY',    '(*(&6J* 5)8h:AkeT)#;Az(.#(gPBvh|M<kVJ+(N{nB7Pim3.p9iA@e=MK.$DmNL');
define('NONCE_KEY',        'b?Sr{(C@+<ZZwO2-.x-tf/|zbS87;3bwvL~im[EY|7*9MWXr[Imz&o(ff/B5aLHr');
define('AUTH_SALT',        '1fy:^&mNP4DknCX{yAn5:U<k8<L.Xfffobukv<n%0mfisCL|3|ENU4Du,+ZSZg(.');
define('SECURE_AUTH_SALT', 'F#]D{&&FeN0%g23Fg@}-%(>qoz.4LU--Y?-I_<CHnvB^zcfIxO-%z+gMzYjA9uQv');
define('LOGGED_IN_SALT',   'D/1!f51ns,een;;:L[?pG`u((O 9C+#wO1n.i<P=M-$Djm}(V9Is=)5~G!AcNJh]');
define('NONCE_SALT',       'x_k6><qh+}wYGQZod*+sA`fc@?pEN AR,CcN6jz}@#rj`}.|c-y)t<j)dXLv>=p-');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
//$table_prefix  = 'wp_';
$table_prefix  = 'kora_';
/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
