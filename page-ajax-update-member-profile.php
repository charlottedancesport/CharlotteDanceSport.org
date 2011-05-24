<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

// if user is not logged in redirect to homepage
if ( !is_user_logged_in() ) { header("Location: http://" . $_SERVER['HTTP_HOST']); }


/**
 * Include Classes
 */
include('classes.php');

/**
 * Make sessions variable available for use
 * for the currently logged in club member
 * object :) Passing objects are awesome!
 */
session_start();
unserialize("club_member");

$mid = $_SESSION['club_member']->get_member_id();

// Get globel WordPress DB
global $wpdb;

if (isset($mid)){
	// Update member first name
	if( isset($_POST['f_name']) ) $_SESSION['club_member']->set_first_name( $_POST['f_name'] );
	
	// Update member last name
	if( isset($_POST['l_name']) ) $_SESSION['club_member']->set_last_name( $_POST['l_name'] );
	
	// Update member introduction
	if( isset($_POST['intro']) ) $_SESSION['club_member']->set_introduction( $_POST['intro'] );
	
	// Update member status
	if( isset($_POST['status']) ) {
		$member_status = explode("|", $_POST['status']);
		// Keep track if use is officer or student or dance team member
		$officer = false;
		$student = false;
		$team = false;
		
		foreach ($member_status as $ms){
			// Update the users officer status if need be
			if(preg_match("/officer_/i",$ms)) {
				$officer_titles .= str_replace("officer_","",$ms) . "|";
				$officer = true;
			}
			// Update the users student status if need be
			if(preg_match("/Student/",$ms)){
				$_SESSION['club_member']->set_is_student(1);
				$student = true;
			}
			// Update the users Team Member if need be
			if(preg_match("/member_/i",$ms)) {
				$s = explode(" ",str_replace("member_","",$ms));
				$_SESSION['club_member']->set_dance_level( $s[0] );
				$team = true;
			}
		}
		
		if($officer){
			$_SESSION['club_member']->set_is_officer(1);
			$_SESSION['club_member']->set_officer_title( substr($officer_titles, 0, -1) );
		}
		
		// if user is not an officer or student or a team member
		if(!$officer) $_SESSION['club_member']->set_is_officer(0);
		if(!$student) $_SESSION['club_member']->set_is_student(0);
		if(!$team) $_SESSION['club_member']->set_dance_level('');
	}
	
	// Update member dance level(s)
	if( isset($_POST['levels']) ) $_SESSION['club_member']->set_levels_competing_in( $_POST['levels'] );
	
	// Update member email address
	if( isset($_POST['user_email']) ) $_SESSION['club_member']->set_email_address( $_POST['user_email'] );
	
	// Update member personal url
	if( isset($_POST['p_url']) ) $_SESSION['club_member']->set_personal_url( $_POST['p_url'] );
	
	// Update member personal url
	if( isset($_POST['f_url']) ) $_SESSION['club_member']->set_facebook_url( $_POST['f_url'] );
	
	// Update mmbers competitions attended
	if( isset($_POST['comp_id']) ) $_SESSION['club_member']->set_comps_attended( $_POST['comp_id'] );
}
?>
<div><p>
</p></div>