<?php
global $wpdb;
$si_id = $_GET['si_id'];
$table_name = $table_name = $wpdb->prefix . "aps_social_icons_pro";
$wpdb->delete( $table_name, array( 'si_id' => $si_id ), array( '%d' ) );
$_SESSION['aps_message'] = __('Icon set deleted successfully.',US_TD);
wp_redirect(admin_url().'admin.php?page=us-social-icons');
exit;