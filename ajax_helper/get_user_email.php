<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

global $wpdb;

$email = $wpdb->get_results("SELECT wu.user_email FROM wp_users wu LEFT JOIN cds_member cm on cm.user_id = wu.ID WHERE cm.member_id = {$_POST[mid]}");

//$wpdb->print_error();
//$wpdb->show_errors();

foreach ($email as $e){
	echo $e->user_email;
}
?>
