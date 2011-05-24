<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

add_cdc_news_feed($_GET['news_feed'], $_GET['submitter_id']);

$query = "SELECT * FROM cdsc_news_feed ORDER BY feed_id DESC";
$select = mysql_query($query) or die("SELECT for cdc news feeds failed");

while($row = mysql_fetch_array( $select )) {
	echo '<li><span><input type="checkbox" id="'.$row['feed_id'].'" /></span>'.$row['title'].'</li>';
}
?>