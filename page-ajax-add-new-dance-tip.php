<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

add_dance_tip($_GET['dance_tip'],'','','', $_GET['submitter_id']);

$query = "SELECT * FROM cds_dance_tips ORDER BY tip_id DESC";
$select = mysql_query($query) or die("SELECT for dance tips failed");

while($row = mysql_fetch_array( $select )) {
	echo '<li><span><input type="checkbox" id="'.$row['tip_id'].'" /></span>'.$row['title'].'</li>';
}
?>