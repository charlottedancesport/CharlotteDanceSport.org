<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
 
	$email=$_GET['email'];
	if($email != ''){
		if(!eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,3}$", $email)) {
			echo '<span class="invalid"><strong>ERROR</strong>: An invalid email address was entered!</span>';
		}
	}
?>
