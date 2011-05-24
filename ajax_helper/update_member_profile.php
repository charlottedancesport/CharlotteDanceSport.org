<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

global $wpdb;

$level = $wpdb->get_results("SELECT * FROM cds_member_level");

$wpdb->print_error();
$wpdb->show_errors();

?>
<div><p>
<? foreach ($level as $l){
	echo "sn - ".$l->short_name."<br />ln - ". $l->long_name;
	}
?>
</p></div>