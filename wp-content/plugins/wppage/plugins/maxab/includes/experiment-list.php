<?php
global $wpdb;
$experiments = $wpdb->get_results("SELECT * FROM " . wpp_maxab_get_table_name());
$experiments_count = $wpdb->get_var("SELECT COUNT(*) FROM " . wpp_maxab_get_table_name());

function wpp_maxab_color_variation1_conversion_rate($experiment)
{
    if (wpp_maxab_display_variation1_conversion_rate($experiment) != 'N/A') {
        $original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
        $variation1_rate = wpp_maxab_calculate_variation1_conversion_rate($experiment);
        return wpp_maxab_display_red_or_green_conversion_rate($original_rate, $variation1_rate);
    }
}

function wpp_maxab_color_variation2_conversion_rate($experiment)
{
    if (wpp_maxab_display_variation2_conversion_rate($experiment) != 'N/A') {
        $original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
        $variation2_rate = wpp_maxab_calculate_variation2_conversion_rate($experiment);
        return wpp_maxab_display_red_or_green_conversion_rate($original_rate, $variation2_rate);
    }
}

function wpp_maxab_color_variation3_conversion_rate($experiment)
{
    if (wpp_maxab_display_variation3_conversion_rate($experiment) != 'N/A') {
        $original_rate = wpp_maxab_calculate_original_conversion_rate($experiment);
        $variation3_rate = wpp_maxab_calculate_variation3_conversion_rate($experiment);
        return wpp_maxab_display_red_or_green_conversion_rate($original_rate, $variation3_rate);
    }
}

function wpp_maxab_display_red_or_green_conversion_rate($original_rate, $variation_rate)
{
    if ($variation_rate < $original_rate) {
        return 'red';
    }

    if ($variation_rate > $original_rate) {
        return 'green';
    }
}

function wpp_maxab_alt_background($count)
{
    if ($count % 2 == 0) {
        return 'alt-background';
    }
}

?>
<div id="wpp_maxab">
    <div class="page_head">
        <ul class="h_tabs wppage_innter_tab_nav">
            <li class="ui-tabs-active">
                <a href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=list">Эксперименты</a>
            </li>
            <li>
                <a href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=new">Добавить</a>
            </li>
        </ul>
    </div>


    <!--<div class="actions">
        <a class="button" href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=new">Добавить</a>
    </div>-->

    <table class="experiments-table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="column-header-left" valign="bottom">Название</td>
            <td class="column-header" align="center" valign="bottom">Оригинал</td>
            <td class="column-header" align="center" valign="bottom">Вариант 1</td>
            <td class="column-header" align="center" valign="bottom">Вариант 2</td>
            <td class="column-header" align="center" valign="bottom">Вариант 3</td>
            <td class="column-header" align="center" valign="bottom">Всего посетителей</td>
            <td class="column-header-right" align="center" valign="bottom">Статус</td>
        </tr>
        <?php if ($experiments_count < 1) { ?>
        <tr>
            <td colspan="7" class="column-data-none-found">Экспериментов не найдено</td>
        </tr>
        <?php } else { ?>
        <?php $count = 1; ?>
        <?php foreach ($experiments as $e) { ?>
            <?php
            $original_conv_rate = ($e->original_visitors == 0) ? 0.0 : ($e->conversion_visitors_from_original / $e->original_visitors) * 100;
            ?>
            <tr>
                <td class="column-data-left <?php echo wpp_maxab_alt_background($count) ?>"><a
                        href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=details&id=<?php echo $e->id ?>"><?php echo $e->name ?></a>
                </td>
                <td class="column-data <?php echo wpp_maxab_alt_background($count) ?>"
                    align="center"><?php echo wpp_maxab_display_original_conversion_rate($e) ?></td>
                <td class="column-data <?php echo wpp_maxab_alt_background($count) ?> <?php echo wpp_maxab_color_variation1_conversion_rate($e) ?>"
                    align="center"><?php echo wpp_maxab_display_variation1_conversion_rate($e) ?></td>
                <td class="column-data <?php echo wpp_maxab_alt_background($count) ?> <?php echo wpp_maxab_color_variation2_conversion_rate($e) ?>"
                    align="center"><?php echo wpp_maxab_display_variation2_conversion_rate($e) ?></td>
                <td class="column-data <?php echo wpp_maxab_alt_background($count) ?> <?php echo wpp_maxab_color_variation3_conversion_rate($e) ?>"
                    align="center"><?php echo wpp_maxab_display_variation3_conversion_rate($e) ?></td>
                <td class="column-data <?php echo wpp_maxab_alt_background($count) ?>"
                    align="center"><?php echo $e->total_visitors ?></td>
                <td class="column-data-right status <?php echo wpp_maxab_alt_background($count) ?>"
                    align="center"><?php echo ($e->status == 'running')? '<span class="value status green">Активный</span>' : '<span class="value status red">Остановлен</span>'; ?></td>
            </tr>
            <?php $count++; ?>
            <?php } ?>
        <?php } ?>
    </table>
    <div class="wpp_helper_box"><a href="#" onclick="open_win('http://www.youtube.com/watch?v=R8NqlOpHCI4&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=19')">Видео урок</a></div>
</div>
