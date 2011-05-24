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

	if(isset($_GET['imageID'])) {
		$query = "UPDATE banner_slides SET title = {$_GET[photograher]}, start_date = {$_GET[start_date]}, end_date = {$_GET[end_date]}, forever = {$_GET[forever]} WHERE banner_slide_id = {$_GET[imageID]}";
		mysql_query($query) or die("Update for banner_slides details failed.");
	}

?>
