<?php
global $wpdb;
$wpdb->query($wpdb->prepare("DELETE FROM " . wpp_maxab_get_table_name() . " WHERE id = %d", $_GET['id']));
?>
<script type="text/javascript">
	window.location = "<?php bloginfo('wpurl') ?>/wp-admin/edit.php?post_type=page_selling&page=wpp_maxab-experiment&action=list";
</script>
