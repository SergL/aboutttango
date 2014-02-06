<?php
global $wpdb;
$experiment = $wpdb->get_row($wpdb->prepare("SELECT * FROM " . wpp_maxab_get_table_name() . " WHERE id = %d", $_GET['id']));

function wpp_maxab_display_end_criteria($end_criteria, $traffic_threshold, $page_threshold) {
	switch ($end_criteria) {
		case 'manual':
			return 'It is manually stopped';
			break;
		case 'traffic_threshold':
			return 'Total traffic reaches ' . $traffic_threshold . ' visitors';
			break;
		case 'page_threshold':
			return 'Each page reaches at least ' . $page_threshold . ' visitors';
			break;
	}
}

function wpp_maxab_color_variation1_improvement($experiment) {
	// No need to check variation1_url because we should always have at least 1 variation
	$improvement = wpp_maxab_calculate_variation1_improvement($experiment);
	return wpp_maxab_display_red_or_green_improvement($improvement);
}

function wpp_maxab_color_variation2_improvement($experiment) {
	if ($experiment->variation2_url != '') {
		$improvement = wpp_maxab_calculate_variation2_improvement($experiment);
		return wpp_maxab_display_red_or_green_improvement($improvement);
	}
}

function wpp_maxab_color_variation3_improvement($experiment) {
	if ($experiment->variation3_url != '') {
		$improvement = wpp_maxab_calculate_variation3_improvement($experiment);
		return wpp_maxab_display_red_or_green_improvement($improvement);
	}
}

function wpp_maxab_display_red_or_green_improvement($improvement) {
	if ($improvement < 0) {
		return 'red';
	}
	
	if ($improvement > 0) {
		return 'green';
	}
}

// commented because it was breaking the code
// if convention rate is more than 100% than the details are not shown at all
//$variation1_z_score = wpp_maxab_calculate_variation1_z_score($experiment);
//$variation2_z_score = wpp_maxab_calculate_variation2_z_score($experiment);
//$variation3_z_score = wpp_maxab_calculate_variation3_z_score($experiment);

//$variation1_p_value = wpp_maxab_calculate_normal_distribution($variation1_z_score, 0, 1, true);
//$variation2_p_value = wpp_maxab_calculate_normal_distribution($variation2_z_score, 0, 1, true);
//$variation3_p_value = wpp_maxab_calculate_normal_distribution($variation3_z_score, 0, 1, true);


function wpp_maxab_display_95_percent_confidence_icon($p_value) {
	$is_95_pct_confident = wpp_maxab_has_p_value_reached_95_percent_confidence($p_value);
	return wpp_maxab_display_confidence_icon($is_95_pct_confident);
}

function wpp_maxab_display_99_percent_confidence_icon($p_value) {
	$is_99_pct_confident = wpp_maxab_has_p_value_reached_99_percent_confidence($p_value);
	return wpp_maxab_display_confidence_icon($is_99_pct_confident);
}

function wpp_maxab_display_confidence_icon($is_confident) {
	if ($is_confident) {
		return '<img src="' . WPPMAXAB_PLUGIN_URL . '/images/green-check.png" alt="" />';
	}
	else {
		return '<img src="' . WPPMAXAB_PLUGIN_URL . '/images/red-minus.png" alt="" />';
	}
}



function wpp_maxab_display_statistically_significant_icon($p_value) {
	$is_significant = wpp_maxab_is_p_value_statistically_significant($p_value);
	
	if ($is_significant) {
		return '<img src="' . WPPMAXAB_PLUGIN_URL . '/images/green-check.png" alt="" />';
	}
	else {
		return '<img src="' . WPPMAXAB_PLUGIN_URL . '/images/red-minus.png" alt="" />';
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
	
	<?php if( ! isset( $experiment->id ) ) { ?>
		<p>There is no experiment with that ID.</p>
		<p><a href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=list">Back to List</a></p>
	<?php } else { ?>
		<script type="text/javascript">
			jQuery(function($) {
                $('#edit-button').click(function() {
                    $('#edit-experiment-modal').modal();
                    $('#simplemodal-container').css('height', '360px');
                    $('#simplemodal-container').css('width', '450px');
					return false;
				});
				
				$('#delete-button').click(function() {
					$('#delete-experiment-modal').modal();
					$('#simplemodal-container').css('height', '200px');
					$('#simplemodal-container').css('width', '450px');
					return false;
				});


				$('#empty-button').click(function() {
					$('#empty-experiment-modal').modal();
					$('#simplemodal-container').css('height', '200px');
					$('#simplemodal-container').css('width', '450px');
					return false;
				});
				
				$('#tracking-script-button').click(function() {
					$('#tracking-script-modal').modal();
					$('#simplemodal-container').css('height', '240px');
					$('#simplemodal-container').css('width', '520px');
					return false;
				});
				
				$('#save-cancel-button').click(function() {
					$.modal.close();
				});

				$('#delete-no-button').click(function() {
					$.modal.close();
				});

				$('#empty-no-button').click(function() {
					$.modal.close();
				});
				
				$('#tracking-script-close-button').click(function() {
					$.modal.close();
				});
				
				$("#edit-experiment-form").validate({
					messages: {
						name: "",
						status: "",
						traffic_threshold: "",
						page_threshold: ""
					},
					rules: {
						traffic_threshold: {
							required: function() {
								return $("input:radio[name=end_criteria]:checked").val() == 'traffic_threshold';
							},
							digits: function() {
								return $("input:radio[name=end_criteria]:checked").val() == 'traffic_threshold';
							}
						},
						page_threshold: {
							required: function() {
								return $("input:radio[name=end_criteria]:checked").val() == 'page_threshold';
							},
							digits: function() {
								return $("input:radio[name=end_criteria]:checked").val() == 'page_threshold';
							}
						}
					}
				});
				
				$("#save-experiment-button").click(function() {
					if ($("#edit-experiment-form").valid()) {
						$("#edit-experiment-form").submit();
					}
					
					return false;
				});

                function selectTrafficThreshold() {
                    $("#traffic-threshold-end-radio").attr("checked", "checked");
                    $("#page-threshold").val("");
                    return false;
                }

                function selectPageThreshold() {
                    $("#page-threshold-end-radio").attr("checked", "checked");
                    $("#traffic-threshold").val("");
                    return false;
                }
			});

		</script>
		

		
		<div class="details">

            <h3 class="experiment_title"><?php echo $experiment->name ?></h3>
            <div class="actions">
                <form id="edit-experiment-form" action="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=edit" method="post">
                    <input type="hidden" name="status" value="<?php echo ($experiment->status == 'running')? 'paused' : 'running'; ?>">
                    <input type="hidden" name="name" value="<?php echo $experiment->name; ?>">
                    <input type="hidden" name="id" value="<?php echo $experiment->id ?>" />
                    <input type="hidden" name="end_criteria" value="<?php echo $experiment->end_criteria ?>" />
                    <input type="hidden" name="traffic_threshold" value="<?php echo $experiment->traffic_threshold ?>" />
                    <input type="hidden" name="page_threshold" value="<?php echo $experiment->page_threshold ?>" />
                    <input type="submit" value="<?php echo ($experiment->status == 'running')? 'Остановить' : 'Запустить'; ?>" class="button <?php echo ($experiment->status == 'running')? 'red' : 'green'; ?>">
                    <div class="delete-action submitbox">
	                    &nbsp;&nbsp;&nbsp; <a id="delete-button" class="submitdelete deletion" href="#">Удалить</a>
	                    &nbsp;&nbsp;&nbsp; <a id="empty-button" class="submitdelete deletion" href="#">Обнулить</a>
                    </div>
                </form>
            </div>
            <div class="wpp_experiment_info">
				<div class="m_box"><span class="label">Статус:</span> <?php echo ($experiment->status == 'running')? '<span class="value status green">Активный</span>' : '<span class="value status red">Остановлен</span>'; ?></div>
				<div class="clear"></div>
				<div class="m_box"><span class="label">Созданный:</span> <span class="value"><?php echo date('d/m/Y', strtotime($experiment->date_created)) ?></span></div>
				<div class="clear"></div>
			</div>
			<div class="wpp_experiment_info">
				<div class="m_box"><span class="label">Оригинал:</span> <span class="value"><a href="<?php echo $experiment->original_url ?>" target="_blank"><?php echo $experiment->original_url ?></a></span></div>
				<div class="clear"></div>
				<div class="m_box"><span class="label">Вариант 1:</span> <span class="value"><a href="<?php echo $experiment->variation1_url ?>" target="_blank"><?php echo $experiment->variation1_url ?></a></span></div>
				<div class="clear"></div>
				<div class="m_box"><span class="label">Вариант 2:</span> <span class="value"><?php echo ($experiment->variation2_url != '') ? '<a href="' . $experiment->variation2_url . '" target="_blank">' . $experiment->variation2_url . '</a>' : 'Нет' ?></span></div>
				<div class="clear"></div>
				<div class="m_box"><span class="label">Вариант 3:</span> <div class="value"><?php echo ($experiment->variation3_url != '') ? '<a href="' . $experiment->variation3_url . '" target="_blank">' . $experiment->variation3_url . '</a>' : 'Нет' ?></div></div>
				<div class="clear"></div>
				<div class="m_box"> <span class="label">Страница конверсии:</span> <span class="value"><a href="<?php echo $experiment->conversion_url ?>" target="_blank"><?php echo $experiment->conversion_url ?></a></span></div>
				<div class="clear"></div>
                <div class="m_box">
                    <span class="label">Всего посетителей: </span><span class="value-total-visitors"><?php echo $experiment->total_visitors ?></span>
                    <div class="clear"></div>
                </div>
			</div>


			<div class="wpp_experiment_compare">
				<table cellpadding="0" cellspacing="0" class="experiments-table">
					<tr>
						<td align="center" class="details-header">&nbsp;</td>
						<td align="center" class="details-header">Оригинал</td>
						<td align="center" class="details-header">Вариант 1</td>
						<td align="center" class="details-header">Вариант 2</td>
						<td align="center" class="details-header">Вариант 3</td>
						</td>
					</tr>
					<tr>
						<td class="details-label">Посетители</td>
						<td align="center" class="details-value"><?php echo $experiment->original_visitors ?></td>
						<td align="center" class="details-value"><?php echo $experiment->variation1_visitors ?></td>
						<td align="center" class="details-value"><?php echo ($experiment->variation2_url != '') ? $experiment->variation2_visitors : 'Нет' ?></td>
						<td align="center" class="details-value"><?php echo ($experiment->variation3_url != '') ? $experiment->variation3_visitors : 'Нет' ?></td>
					</tr>
					<tr>
						<td class="details-label">Конверсия</td>
						<td align="center" class="details-value"><?php echo $experiment->conversion_visitors_from_original ?></td>
						<td align="center" class="details-value"><?php echo $experiment->conversion_visitors_from_variation1 ?></td>
						<td align="center" class="details-value"><?php echo ($experiment->variation2_url != '') ? $experiment->conversion_visitors_from_variation2 : 'Нет' ?></td>
						<td align="center" class="details-value"><?php echo ($experiment->variation3_url != '') ? $experiment->conversion_visitors_from_variation3 : 'Нет' ?></td>
					</tr>
					<tr>
						<td class="details-label">Процент конверсии</td>
						<td align="center" class="details-value"><?php echo wpp_maxab_display_original_conversion_rate($experiment) ?></td>
						<td align="center" class="details-value"><?php echo wpp_maxab_display_variation1_conversion_rate($experiment) ?></td>
						<td align="center" class="details-value"><?php echo wpp_maxab_display_variation2_conversion_rate($experiment) ?></td>
						<td align="center" class="details-value"><?php echo wpp_maxab_display_variation3_conversion_rate($experiment) ?></td>
					</tr>

				</table>
			</div>
		</div>

		<div id="delete-experiment-modal">
			<div class="title">Удаление эксперимента</div>
			<div class="info_box">
                <p>Вы уверены, что хотите удалить этот эксперимент?</p>
                <p>Удалив, вы безвозвратно удалите всю информацию об этом эксперименте из базы данных.</p>
			</div>

			<div class="button-group">
				<span style="margin-right: 10px;"><a href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=delete&id=<?php echo $experiment->id ?>" class="button-primary">Удалить</a></span>
				<a id="delete-no-button" href="#" class="button">Отмена</a>
			</div>
		</div>

		<div id="empty-experiment-modal">
			<div class="title">Обнуление эксперимента</div>
			<div class="info_box">
				<p>Вы уверены, что хотите обнулить этот эксперимент?</p>
				<p>Обнулив, вы безвозвратно удалите всю информацию об этом эксперименте из базы данных.</p>
			</div>

			<div class="button-group">
				<span style="margin-right: 10px;"><a href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=empty&id=<?php echo $experiment->id ?>" class="button-primary">Обнулить</a></span>
				<a id="empty-no-button" href="#" class="button">Отмена</a>
			</div>
		</div>

	<?php } ?>
    <div class="wpp_helper_box"><a href="#" onclick="open_win('http://www.youtube.com/watch?v=R8NqlOpHCI4&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=19')">Видео урок</a></div>
</div>

