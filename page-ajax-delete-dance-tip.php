<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

	
	/*
	 * Remove request tip from database
	 *
	 */
	if( isset( $_GET['tip_id'] ) ){
		$query = "DELETE FROM cds_dance_tips WHERE tip_id = {$_GET[tip_id]}";
		mysql_query($query) or die("Delete from cds_dance_tips failed.");
	}
		//$wpdb->query("DELETE FROM banner_slides WHERE banner_slide_id = {$_GET[imageID]}");
		//$wpdb->print_error();

?>
