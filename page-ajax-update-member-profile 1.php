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

$mid = $_SESSION['club_member']->get_member_id();

// if user is not logged in redirect to homepage
if ( !is_user_logged_in() ) { header("Location: http://" . $_SERVER['HTTP_HOST']); }

// Get globel WordPress DB
global $wpdb;

// Update member introduction
if( isset($_POST['intro']) && isset($mid) ){

	$_SESSION['club_member']->set_introduction( $_POST['intro'] );
	/*
	$r = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$mid}");

	if($r) {
		
		//$success = $wpdb->query("UPDATE cds_member_profile SET introduction = '{$_POST[intro]}' WHERE member_id = {$mid}");	
		//$wpdb->print_error();
		//$wpdb->show_errors();
	} else {
		$success = $wpdb->insert( 'cds_member_profile', array( 'member_id' => $mid, 'introduction' => $_POST['intro']) );
	}*/
}

// Update member email address
if( isset($_POST['user_email']) && isset($mid) ){
	
	$_SESSION['club_member']->set_email_address( $_POST['user_email'] );
	
	/*$r = $wpdb->get_results("SELECT user_id FROM cds_member WHERE member_id = {$mid}");

	if($r) {
		
		//$success = $wpdb->query("UPDATE wp_users SET user_email = '{$_POST[user_email]}' WHERE ID = {$r[0]->user_id}");	
		
		//$wpdb->print_error();
		//$wpdb->show_errors();
	}*/
}

// Update member personal url
if( isset($_POST['p_url']) && isset($mid) ){
	$r = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$mid}");

	if($r) {
		$success = $wpdb->query("UPDATE cds_member_profile SET personal_url = '{$_POST[p_url]}' WHERE member_id = {$mid}");	
		//$wpdb->print_error();
		//$wpdb->show_errors();
	} else {
		$success = $wpdb->insert( 'cds_member_profile', array( 'member_id' => $mid, 'personal_url' => $_POST['p_url']) );
	}
}

// Update member personal url
if( isset($_POST['f_url']) && isset($mid) ){
	$r = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$mid}");

	if($r) {
		$success = $wpdb->query("UPDATE cds_member_profile SET facebook_url = '{$_POST[f_url]}' WHERE member_id = {$mid}");	
		//$wpdb->print_error();
		//$wpdb->show_errors();
	} else {
		$success = $wpdb->insert( 'cds_member_profile', array( 'member_id' => $mid, 'facebook_url' => $_POST['f_url']) );
	}
}
?>
<div><p>
</p></div>