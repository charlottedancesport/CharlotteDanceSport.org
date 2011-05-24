<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

	
	/*
	 * Remove requested cdc news feed from database
	 *
	 */
	if( isset( $_GET['feed_id'] ) ){
		$query = "DELETE FROM cdsc_news_feed WHERE feed_id = {$_GET[feed_id]}";
		mysql_query($query) or die("Delete from cdsc_news_feed failed.");
	}
		//$wpdb->print_error();

?>
