<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

/**
 * Include Classes
 */
include('classes.php');

/**
 * Make sessions variable available for use
 * for the currently logged in club member
 * object :) Passing objects are awesome!
 */
session_start();
unserialize("club_member");

echo $_SESSION['club_member']->delete_comp_attended($_POST['comp_id']);


?>
