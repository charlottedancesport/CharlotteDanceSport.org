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

	if (!unlink($_GET['path']."/".$_GET['fileName'])){
		echo "The file ".$_GET['fileName']." could not be found";
	}
?>
