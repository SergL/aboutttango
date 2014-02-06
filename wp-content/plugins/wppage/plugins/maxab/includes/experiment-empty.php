<?php
global $wpdb;

$wpdb->update(
	wpp_maxab_get_table_name(),
	array(
		'conversion_visitors_from_original' => '0', // string
		'conversion_visitors_from_variation1' => '0', // string
		'conversion_visitors_from_variation2' => '0', // string
		'conversion_visitors_from_variation3' => '0', // string
		'total_visitors' => '0',
		'original_visitors' => '0',
		'variation1_visitors' => '0',
		'variation2_visitors' => '0',
		'variation3_visitors' => '0',
	),
	array( 'id' => $_GET['id'] ) //, // where
	//array( '%s', '%d' ), // format (optional)
	//array( '%d' ) // where_format (optional)
);
?>
<script type="text/javascript">
	window.location = "<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=details&id=<?php echo $_GET['id']; ?>";
</script>
