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

	if(isset($_GET['imageID']) && !isset($_GET['green_alert'])) {
		$query = "UPDATE banner_slides SET archived = 1 WHERE banner_slide_id = {$_GET[imageID]}";
		mysql_query($query) or die("Update for banner_slides archive failed.");
	} else if(isset($_GET['imageID']) && isset($_GET['green_alert'])) {
		$query = "UPDATE cds_green_alert_banners SET archived = 1 WHERE green_alert_banner_id = {$_GET[imageID]}";
		mysql_query($query) or die("Update for green_alert_banner archive failed.");
	}

?>
