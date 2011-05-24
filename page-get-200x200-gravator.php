<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

if( isset($_POST['user_email']) ) echo get_avatar( $club_member->get_email_address(), '200' );
?>
