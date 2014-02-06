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
define('AUTH_KEY',         '|eodvQZ(zE7}Tj:V2%Me;-W}e:%.z.mI{*4G&|`09yj-*O/;;z@E,T.+D+rnAf:5');
define('SECURE_AUTH_KEY',  '`(36vPP,{1k8XanB-I&/ehT^f>Mm|:+Sfj;Mv/sGoS@6fTSzhuyRX@r5$Ce|e}s,');
define('LOGGED_IN_KEY',    ' */QgAoZ!-dRfwUiT6&`YZ^*-<xbRE+^|x2( S Y!NlIweB=w=)q-d3]T+o;XKS?');
define('NONCE_KEY',        'ad>&1,4e/-x)YRw|Y_C,2MpHF98C<Lnp}o1(Yn+`f(Puk~xx.Y(*|-4*L{R2CP-M');
define('AUTH_SALT',        ']}1u-G-dz.Kc4w42vL3P7?.Ko@|lB3rl&+w?(p)9E3L@GV:418-=>M?U-}_Oq;*-');
define('SECURE_AUTH_SALT', 'BpS{E7UxQ>r#A`=Ry~ZFB5h/$K}V7 54!.NMLh`{j=9)ql?xw+u$F=e~Nr| M9|U');
define('LOGGED_IN_SALT',   '^C,yZN-n+J7]q:nwz*RYTMH9J-,Y&gz]}pZQ`v3K)U7z+Ss{/Pub;YdW6MOt>}ow');
define('NONCE_SALT',       '=tMI+E~7#(Nl@`jMua;|J2H)1@3re%+]<4iz[Z3RgS3{t]J-:&9weB4)?/ZXr](1');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

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
