<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

/**
 * Make sessions variable available for use
 * for the currently logged in club member
 * object :) Passing objects are awesome!
 */
session_start();
unserialize("club_member");

echo $_SESSION['club_member']->get_email_address();

//$mid = $_SESSION['club_member']->get_member_id();

// Get globel WordPress DB
//global $wpdb;

//$email = $wpdb->get_results("SELECT wu.user_email FROM wp_users wu LEFT JOIN cds_member cm on cm.user_id = wu.ID WHERE cm.member_id = {$mid}");

//$wpdb->print_error();
//$wpdb->show_errors();

/*foreach ($email as $e){
	echo $e->user_email;
}*/
?>
