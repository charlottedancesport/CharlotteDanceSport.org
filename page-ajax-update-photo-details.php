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
	function convert_date($d) {
	  list($day, $month, $year) = explode("/", $d);
	  return $year . "-" . $day . "-" . $month . " " . date("h:i:s");
	}

	if(isset($_GET['imageID']) && !isset($_GET['green_alert'])) {
		$query = "UPDATE banner_slides SET title = '{$_GET[photographer]}', start_date = ";
		$query .= (isset($_GET['start_date']) && $_GET['start_date']!='' && $_GET['start_date']!=null) ? "'".convert_date($_GET['start_date'])."'" : "NOW()";
		$query .= ", end_date = ";
		$query .= (isset($_GET['end_date']) && $_GET['end_date']!='' && $_GET['end_date']!=null) ? "'".convert_date($_GET['end_date'])."'" : "NOW()"; 		
		$query .= ", forever = {$_GET['forever']}";
		$query .= " WHERE banner_slide_id = {$_GET[imageID]}";
		mysql_query($query) or die("Update for banner_slides details failed.");
	} else if(isset($_GET['imageID']) && isset($_GET['green_alert'])){
		$query = "UPDATE cds_green_alert_banners SET title = '{$_GET[title]}', start_date = ";
		$query .= (isset($_GET['start_date']) && $_GET['start_date']!='' && $_GET['start_date']!=null) ? "'".convert_date($_GET['start_date'])."'" : "NOW()";
		$query .= ", end_date = ";
		$query .= (isset($_GET['end_date']) && $_GET['end_date']!='' && $_GET['end_date']!=null) ? "'".convert_date($_GET['end_date'])."'" : "NOW()"; 		
		$query .= ", forever = {$_GET['forever']}";
		$query .= " WHERE green_alert_banner_id = {$_GET[imageID]}";
		mysql_query($query) or die("Update for green_alert_banner details failed.");
	}

?>
