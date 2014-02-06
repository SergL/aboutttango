<?php
$rows_affected = 0;
$conversion_location = 'here';
$args = array(
    'post_type' => 'page_selling',
    'orderby' => 'title',
    'order' => 'ASC',
    'posts_per_page' => '-1'
);
$pages = get_pages($args);

if ($_POST) {	
	$experiment_name = $_POST['name'];
	$end_criteria = $_POST['end_criteria'];
	$traffic_threshold = $_POST['traffic_threshold'];
	$page_threshold = $_POST['page_threshold'];
	$conversion_location = 'here';//$_POST['conversion_location']

	
	$original = explode('|', $_POST['original']);
	$original_id = $original[0];
	$original_url = $original[1];
	
	$variation1 = explode('|', $_POST['variation1']);
	$variation1_id = $variation1[0];
	$variation1_url = $variation1[1];

	$variation2 = explode('|', $_POST['variation2']);
	$variation2_id = $variation2[0];
	$variation2_url = $variation2[1];

	$variation3 = explode('|', $_POST['variation3']);
	$variation3_id = $variation3[0];
	$variation3_url = $variation3[1];
	
	if ($conversion_location == 'here') {
		$conversion = explode('|', $_POST['conversion_here']);
		$conversion_id = $conversion[0];
		$conversion_url = $conversion[1];
	}
	else {
		$conversion_id = -1; // Tells us the conversion page is on another site (I know, I know, magic numbers, arg!)
		$conversion_url = $_POST['conversion_elsewhere'];
	}

	if (empty($traffic_threshold)) {
		$traffic_threshold = 0;
	}

	if (empty($page_threshold)) {
		$page_threshold = 0;
	}
	
	if (empty($variation2_id)) {
		$variation2_id = 0;
	}

	if (empty($variation3_id)) {
		$variation3_id = 0;
	}
	
	global $wpdb;
	$rows_affected = $wpdb->insert(wpp_maxab_get_table_name(), array(
		'name' => $wpdb->escape($experiment_name),
		'status' => 'running',
		'end_criteria' => $end_criteria,
		'traffic_threshold' => $traffic_threshold,
		'page_threshold' => $page_threshold,
		'original_id' => $original_id,
		'original_url' => $original_url,
		'variation1_id' => $variation1_id,
		'variation1_url' => $variation1_url,
		'variation2_id' => $variation2_id,
		'variation2_url' => $variation2_url,
		'variation3_id' => $variation3_id,
		'variation3_url' => $variation3_url,
		'conversion_id' => $conversion_id,
		'conversion_url' => $conversion_url,
		'date_created' => date('Y-m-d H:i:s')
	));
}

function wpp_maxab_write_pages_dropdown($pages) {
	foreach ($pages as $p) {
		echo '<option value="' . $p->ID . '|' . get_permalink($p->ID) . '">' . $p->post_title . '</option>';
	}
}
?>
<script type="text/javascript">
	<?php if (($conversion_location == 'here') && ($rows_affected == 1)) { ?>
		window.location = "<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=list";
	<?php } ?>
	
	jQuery(document).ready(function() {
		<?php if (($conversion_location == 'elsewhere') && ($rows_affected == 1)) { ?>
			jQuery("#new-experiment-form-container").hide();
		<?php } ?>
		
		jQuery("#new-experiment-form").validate({
			messages: {
				name: "",
				original: "",
				variation1: "",
				conversion_here: "",
				conversion_elsewhere: "",
				traffic_threshold: "",
				page_threshold: ""
			},
			rules: {
				conversion_here: {
					required : function() {
						return jQuery("input:radio[name=conversion_location]:checked").val() == 'here';
					}
				},
				conversion_elsewhere: {
					required : function() {
						return jQuery("input:radio[name=conversion_location]:checked").val() == 'elsewhere';
					}
				},
				traffic_threshold: {
					required: function() {
						return jQuery("input:radio[name=end_criteria]:checked").val() == 'traffic_threshold';
					},
					digits: function() {
						return jQuery("input:radio[name=end_criteria]:checked").val() == 'traffic_threshold';
					}
				},
				page_threshold: {
					required: function() {
						return jQuery("input:radio[name=end_criteria]:checked").val() == 'page_threshold';
					},
					digits: function() {
						return jQuery("input:radio[name=end_criteria]:checked").val() == 'page_threshold';
					}
				}
			}
		});

		jQuery("#create-experiment-button").click(function() {			
			jQuery("#unique-pages-required").css("display", "none");
			
			if (jQuery("#new-experiment-form").valid()) {
				if (pagesAreUnique()) {
					jQuery("#new-experiment-form").submit();
				}
				else {
					jQuery("#unique-pages-required").css("display", "block");
				}
			}
			
			return false;
		});
		
		jQuery("#original-select").change(function() {
			var original = jQuery("#original-select").val();
			if (original != '') {
				var arr = original.split("|");
				jQuery("#original-span").html(decodeURIComponent(arr[1])); // Index 0 is the id, index 1 is the url
			} else {
				jQuery("#original-span").html("");
			}
		});
		
		jQuery("#variation1-select").change(function() {
			var variation1 = jQuery("#variation1-select").val();
			if (variation1 != '') {
				var arr = variation1.split("|");
				jQuery("#variation1-span").html(decodeURIComponent(arr[1])); // Index 0 is the id, index 1 is the url
				jQuery("#variation2-select").removeAttr("disabled");
			}
			else {
				jQuery("#variation1-span").html("");
				jQuery("#variation2-select").val("");
				jQuery("#variation2-select").attr("disabled", "disabled");
				jQuery("#variation2-span").html("");
				jQuery("#variation3-select").val("");
				jQuery("#variation3-select").attr("disabled", "disabled");
				jQuery("#variation3-span").html("");
			}
		});
		
		jQuery("#variation2-select").change(function() {
			var variation2 = jQuery("#variation2-select").val();
			if (variation2 != '') {
				var arr = variation2.split("|");
				jQuery("#variation2-span").html(decodeURIComponent(arr[1])); // Index 0 is the id, index 1 is the url
				jQuery("#variation3-select").removeAttr("disabled");
			}
			else {
				jQuery("#variation2-span").html("");
				jQuery("#variation3-select").val("");
				jQuery("#variation3-select").attr("disabled", "disabled");
				jQuery("#variation3-span").html("");
			}
		});
		
		jQuery("#variation3-select").change(function() {
			var variation3 = jQuery("#variation3-select").val();
			if (variation3 != '') {
				var arr = variation3.split("|");
				jQuery("#variation3-span").html(decodeURIComponent(arr[1])); // Index 0 is the id, index 1 is the url
			}
			else {
				jQuery("#variation3-span").html("");
			}
		});
		
		jQuery("#conversion-here-select").change(function() {
			var conversion = jQuery("#conversion-here-select").val();
			if (conversion != '') {
				var arr = conversion.split("|");
				jQuery("#conversion-here-span").html(decodeURIComponent(arr[1])); // Index 0 is the id, index 1 is the url
			}
			else {
				jQuery("#conversion-here-span").html("");
			}
		});
	});
	
	function pagesAreUnique() {
		var original = jQuery("#original-select").val();
		var variation1 = jQuery("#variation1-select").val();
		var variation2 = jQuery("#variation2-select").val();
		var variation3 = jQuery("#variation3-select").val();
		var conversion = jQuery("#conversion-here-select").val();
		
		if ((variation2 == '') && (variation3 == '')) {
			if ((original != variation1) && (original != conversion) && (variation1 != conversion)) {
				return true;
			}
			else {
				return false;
			}
		}
		
		if ((variation2 != '') && (variation3 == '')) {
			if ((original != variation1) && (original != variation2) && (original != conversion) && (variation1 != variation2) && (variation1 != conversion) && (variation2 != conversion)) {
				return true;
			}
			else {
				return false;
			}
		}
		
		if ((variation2 == '') && (variation3 != '')) {
			if ((original != variation1) && (original != variation3) && (original != conversion) && (variation1 != variation3) && (variation1 != conversion) && (variation3 != conversion)) {
				return true;
			}
			else {
				return false;
			}
		}
		
		if ((variation2 != '') && (variation3 != '')) {
			if ((original != variation1) && (original != variation2) && (original != variation3) && (original != conversion) && (variation1 != variation2) && (variation1 != variation3) && (variation1 != conversion) && (variation2 != variation3) && (variation2 != conversion) && (variation3 != conversion)) {
				return true;
			}
			else {
				return false;
			}
		}
	}
	
	function selectConversionHere() {
		jQuery("#conversion-here-radio").attr("checked", "checked");
		jQuery("#conversion-elsewhere").val("");
		return false;
	}
	
	function selectConversionElsewhere() {
		jQuery("#conversion-elsewhere-radio").attr("checked", "checked");
		jQuery("#conversion-here-select").val("");
		jQuery("#conversion-here-span").html("");
		return false;
	}
	
	function selectTrafficThreshold() {
		jQuery("#traffic-threshold-end-radio").attr("checked", "checked");
		jQuery("#page-threshold").val("");
		return false;
	}
	
	function selectPageThreshold() {
		jQuery("#page-threshold-end-radio").attr("checked", "checked");
		jQuery("#traffic-threshold").val("");
		return false;
	}
</script>
<div id="wpp_maxab">
    <div class="page_head">
        <ul class="h_tabs wppage_innter_tab_nav">
            <li>
                <a href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=list">Эксперименты</a>
            </li>
            <li class="ui-tabs-active">
                <a href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=new">Добавить</a>
            </li>
        </ul>
    </div>
	
	<?php if (($conversion_location == 'elsewhere') && ($rows_affected == 1)) { ?>
		<div class="conversion-tracking">
			<p><strong>Важно!</strong></p>
			<p>Before conversions can be captured for this experiment, you must add the following tracking script to the conversion page on the other site.</p>
			<p>This tracking script should be placed just before the closing &lt;/head&gt; tag in the conversion page.</p>
			<textarea rows="3" wrap="off"><?php echo wpp_maxab_build_conversion_tracking_script($conversion_url) ?></textarea>
			<p>The conversion page for this experiment is <strong><?php echo $conversion_url ?></strong>.</p>
			<br />
			<a class="button-primary" href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=list">Continue</a>
		</div>
	<?php } ?>
	
	<div id="unique-pages-required" class="red">Оригинальная страница, страницы вариантов и страница конверсии, должны быть разные.</div>
	
	<div id="new-experiment-form-container">
		<form id="new-experiment-form" method="post">

			<div class="group">
				<div class="label">Название</div>
				<div>
					<input type="text" name="name" maxlength="250" class="required" />
				</div>
			</div>
			<div class="group">
				<div class="label">Оригинальная страница</div>
				<div>
					<select id="original-select" name="original" class="required">
						<option value=''>-- Выбрать --</option>
						<?php wpp_maxab_write_pages_dropdown($pages); ?>
					</select>
					<span id="original-span"></span>
				</div>
			</div>
			<div class="group">
				<div class="label">Вариант 1</div>
				<div>
					<select id="variation1-select" name="variation1" class="required">
						<option value=''>-- Выбрать --</option>
						<?php wpp_maxab_write_pages_dropdown($pages); ?>
					</select>
					<span id="variation1-span"></span>
				</div>
			</div>
			<div class="group">
				<div class="label">Вариант 2</div>
				<div>
					<select id="variation2-select" name="variation2" disabled="disabled">
						<option value=''>-- Выбрать --</option>
						<?php wpp_maxab_write_pages_dropdown($pages); ?>
					</select>
					<span id="variation2-span"></span>
				</div>
			</div>
			<div class="group">
				<div class="label">Вариант 3</div>
				<div>
					<select id="variation3-select" name="variation3" disabled="disabled">
						<option value=''>-- Выбрать --</option>
						<?php wpp_maxab_write_pages_dropdown($pages); ?>
					</select>
					<span id="variation3-span"></span>
				</div>
			</div>
			<div class="group">
				<div class="label">Страница конверсии</div>
				<div>
					<input type="hidden" name="conversion_location" id="conversion-here-radio" value="here"/>
					<select id="conversion-here-select" name="conversion_here">
						<option value=''>-- Выбрать --</option>
						<?php wpp_maxab_write_pages_dropdown($pages); ?>
					</select>
					<span id="conversion-here-span"></span>
				</div>
			</div>
            <input type="hidden" name="end_criteria" id="manual-end-radio" value="manual"/>
			<div class="buttons">
				<a id="create-experiment-button" class="button-primary">Создать</a>
				<a class="button" href="<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=list">Отменить</a>
			</div>
		</form>
        <div class="wpp_helper_box"><a href="#" onclick="open_win('http://www.youtube.com/watch?v=R8NqlOpHCI4&list=PLI8Gq0WzVWvJ60avoe8rMyfoV5qZr3Atm&index=19')">Видео урок</a></div>
	</div>
</div>
