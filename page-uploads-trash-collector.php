<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

	
	/*
	 * Remove request file from servers temporary '/uploads' directory
	 *
	 * Returns: true or false to the ajax responseText upon successfully
	 * removal or error respectively
	 */
	if( isset( $_GET['imageID'] ) && !isset( $_GET['green_alert'] ) ){
		$query = "DELETE FROM banner_slides WHERE banner_slide_id = {$_GET[imageID]}";
		mysql_query($query) or die("Delete from banner_slides failed.");
	} else if(isset($_GET['imageID']) && isset($_GET['green_alert'])) {
		$query = "DELETE FROM cds_green_alert_banners WHERE green_alert_banner_id = {$_GET[imageID]}";
		mysql_query($query) or die("Delete from cds_green_alert_banners failed.");
	}
		//$wpdb->query("DELETE FROM banner_slides WHERE banner_slide_id = {$_GET[imageID]}");
		//$wpdb->print_error();

?>
