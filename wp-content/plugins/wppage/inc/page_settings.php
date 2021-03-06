<?php
function wppage_settings_page()
{
    $package = wpp_package();
    $user_serial = get_option('wppage_serial_number');
    $wppage_base_slug = (get_option('wppage_base_slug'))? get_option('wppage_base_slug'): 'wppage';
    update_option('wppage_base_slug', wppage_sanitize_option($wppage_base_slug));

    $wppage_base_slug = get_option('wppage_base_slug');

    ?>
    <script type="text/javascript">
        jQuery(function ($) {
            $('#settings_tabs').tabs({
                autoHeight: false,
                collapsible: false,
                fx: {
                    opacity: 'toggle',
                    duration: 'fast'
                }
            });

            $('#update_base_slug').click(function () {
                $.post( ajaxurl, {
                    action: 'ajax_action',
                    wppage_slug: $('#wppage_base_slug').val()
                }, function (data) {
                    $('#wppage_base_slug').val(data);
                    alert('Базовая ссылка сохранена'); // alerts 'ajax submitted'
                }).done(function(data){

                    });
            });

        });
    </script>
<div class="wrap">
    <div id="icon-options-general" class="icon32"></div>
    <h2>Параметры</h2>
    <br>
    <form method="post" action="options.php">
        <?php settings_fields('coach-settings-group'); ?>
        <p>Вы используете <strong> <?php echo ($package == 'TRIAL')? 'Пробную версию': 'Пакет '.$package; ?></strong>
            <?php if ($package != 'GURU' && $package != 'START' && $package != 'PRO') { ?>
           . <a target="_blank" href="http://wppage.ru/buy">Подробнее о полной версии <span style="font-size:18px">&#8658;</span></a>
                <?php } ?>
        </p>
        <br>
        <label>Ваш серийный номер</label>
        <input type="text" style="width:400px;" value="<?php echo $user_serial; ?>" name="wppage_serial_number">
        <br><br>
        <hr class="h_line">
        <br style="clear: both">
        <div class="tabs_wrap options_wrap">
            <div id="settings_tabs">
                <ul class="wppage_tabs_nav">
                    <li><a href="#div_1">Главная</a></li>
                    <li><a href="#div_2">Facebook</a></li>
                    <li><a href="#div_3">вКонтакте</a></li>
                    <li><a href="#div_4">Twitter</a></li>
                    <li><a href="#div_5">Скрипты</a></li>
                    <li><a href="#div_6">Ссылки</a></li>
                </ul>

                <div id="div_1" class="tab_content_box">
                    <div class="triangle"></div>
                    <div class="wppage_content_round">

                            <?php
                            $use_as_home = get_option('use_as_home_page');
                            $args = array(
                                'post_type'      => 'page_selling',
                                'posts_per_page' => '-1'
                            );
                            query_posts($args);
                            ?>
                            <label>Сделать главной</label>
                            <select name="use_as_home_page">
                                <option value="no_page" <?php if ($use_as_home == 'no_page') echo 'selected="selected"';  ?>>-- Не использовать --</option>

                                <?php if (have_posts()): ?>
                                <?php
                                while (have_posts()): the_post();
                                    ?>
                                    <option value="<?php the_ID(); ?>" <?php if ($use_as_home == get_the_ID()) echo 'selected="selected"'; ?>><?php the_title(); ?></option>
                                    <?php endwhile; ?>

                                <?php endif; wp_reset_query(); ?>
                            </select>
                        <br style="clear: both">
                        <br style="clear: both">
                        <div style="width:500px;">
                            <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=2FNODxiDI9w&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=23')">Видео урок</a></div>
                        </div>
                    </div>

                </div>
                <div id="div_2" class="tab_content_box">
                    <div class="triangle"></div>
                    <div class="wppage_content_round">
                        <table class="wpp_settings_form-table">
                        <tr valign="top">
                            <th scope="row">facebook App ID</th>
                            <td><input type="text" name="facebook_app_id"
                                       value="<?php echo get_option('facebook_app_id'); ?>"/></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">facebook admin</th>
                            <td><input type="text" name="facebook_admin"
                                       value="<?php echo get_option('facebook_admin'); ?>"/></td>
                        </tr>
                        </table>
                        <br style="clear: both">
                        <div style="width:500px;">
                            <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=vwjw0LHJzYc&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=20')">Видео урок</a></div>
                        </div>
                    </div>

                </div>
                <div id="div_3" class="tab_content_box">
                    <div class="triangle"></div>
                    <div class="wppage_content_round">
                        <table class="wpp_settings_form-table">
                            <tr valign="top">
                                <th scope="row">ID приложения:</th>
                                <td><input type="text" name="vkontakte_apiId"
                                           value="<?php echo get_option('vkontakte_apiId'); ?>"/></td>
                            </tr>
                        </table>
                        <br style="clear: both">
                        <div style="width:500px;">
                            <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=z-N-FFUKvVY&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=21')">Видео урок</a></div>
                        </div>
                    </div>

                </div>
                <div id="div_4" class="tab_content_box">
                    <div class="triangle"></div>
                    <div class="wppage_content_round">
                        <table class="wpp_settings_form-table">
                            <tr valign="top">
                                <th scope="row">twitter nickname</th>
                                <td><input type="text" name="twetter_nickname"
                                           value="<?php echo get_option('twetter_nickname'); ?>"/></td>
                            </tr>
                        </table>
                        <br style="clear: both">
                        <div style="width:500px;">
                            <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=EsIlI7y5wZU&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=22')">Видео урок</a></div>
                        </div>
                    </div>

                </div>
                <div id="div_5" class="tab_content_box">
                    <div class="triangle"></div>
                    <div class="wppage_content_round">
                        <table class="wpp_settings_form-table">
                            <tr valign="top">
                                <th scope="row"><p>Коды статистик или другие скрипты.<br><br>Код добавляется перед закрывающим тегом <span class="text_green">&lt;/body&gt;</span></p>
                                </th>
                                <td><textarea name="coach_analytics" class="wpp_textarea"
                                              style="width:400px; height:200px;"><?php echo get_option('coach_analytics'); ?></textarea>
                                    <p><strong class="text_red" style="font-size: 16px">*</strong> Применяется ко всем страницам wppage</p>
                                </td>
                            </tr>
                        </table>
                        <br style="clear: both">
                        <div style="width:500px;">
                            <div class="wpp_helper_box"><a onclick="open_win('http://www.youtube.com/watch?v=WSG9ewb93dY&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=24')">Видео урок</a></div>
                        </div>
                    </div>


                </div>
                <div id="div_6" class="tab_content_box">
                    <div class="triangle"></div>
                    <div class="wppage_content_round">
                        <table class="wpp_settings_form-table">
                            <tr valign="top">
                                <th scope="row">
                                    Базовая ссылка
                                </th>
                                <td> <input type="text" name="wppage_base_slug" id="wppage_base_slug" value="<?php echo $wppage_base_slug; ?>"> <input type="button" id="update_base_slug" name="update_base_slug" class="button-primary" value="Применить"/>
                                    <p>Базовая ссылка для продающих страниц.
                                        <br>www.ваш-сайт.ru/<span class="bold text_green"> <strong>Базовая ссылка</strong> </span>/page1</p>
                                    <p><strong class="text_red" style="font-size: 16px">*</strong> Применяется ко всем страницам wppage</p>
                                </td>
                            </tr>
                        </table>

                        <br style="clear: both">

                    </div>


                </div>

            </div>
            <br style="clear: both">
            <p class="submit settings_submit_box ">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"/>
            </p>
        </div>


    </form>

</div>
<?php
}