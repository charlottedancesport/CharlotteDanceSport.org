<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

// if user is not logged in redirect to homepage
if ( !is_user_logged_in() ) { header("Location: http://" . $_SERVER['HTTP_HOST']); }


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

// Get globel WordPress DB
global $wpdb;
$delimiter = "|+";
$delimiter2 = "+|";

// Return first 5 results from competitons table
if( isset($_POST['cs']) ) {
	// Explode the string on commons and place the result in an array
	$search_str = explode(',',$_POST['cs']);

	// Build the like query statement for the MySQL sel	ect to search for each word
	// foreach ($search_str as $s) $like_str .= "'^".trim(chop($s))."' OR ";
	
	for ($i=0; $i<sizeof($search_str); $i++){
		// If the string is complete search only for the exact word
		if($i<sizeof($search_str)-1 && !empty($search_str[$i])){
			$like_str .= "'[[:<:]]".trim(chop($search_str[$i]))."[[:>:]]' OR ";
		} else if(!empty($search_str[$i])) { 
			$like_str .= "'^".trim(chop($search_str[$i]))."' OR ";
		}
	}
	
	// Remove the last "OR" from the like query statement because we have one to many
	if(preg_match("/\bOR\b/",$like_str)) $like_str = trim(chop(substr($like_str,0,-4)));
	
	//$comps .= $like_str.$delimiter;
	
	$results = $wpdb->get_results("SELECT * FROM competitions WHERE long_name REGEXP {$like_str} ORDER BY long_name ASC");
	$wpdb->print_error();
	$wpdb->show_errors();
	
	$r1_size = sizeof($results);
	
	foreach ($results as $the_comp)	
		$comps .= $the_comp->long_name.$delimiter.$the_comp->comp_id.$delimiter2;
		
	/*if( $r1_size < 5 ){*/
		// compute limit size for the number of results return by MySQL
		$limit_size=5-$r1_size;
		
		// Get results by state
		$results = $wpdb->get_results("SELECT * FROM competitions WHERE state REGEXP {$like_str} ORDER BY state, long_name ASC");
		$r2_size = sizeof($results);
		
		foreach ($results as $the_comp)	
			$comps .= $the_comp->state.", ".$the_comp->long_name.$delimiter.$the_comp->comp_id.$delimiter2;
	//}
	
	/*if( $r1_size+$r2_size < 5 ){*/
		// computer the new limit size for the number of results returned by MySQL
		$limit_size = 5-$r1_size+$r2_size;
		
		// Get results by city
		$results = $wpdb->get_results("SELECT * FROM competitions WHERE city REGEXP {$like_str} ORDER BY city, long_name ASC");
	
		foreach ($results as $the_comp)	
			$comps .= $the_comp->city.", ".$the_comp->long_name.$delimiter.$the_comp->comp_id.$delimiter2;
	//}
}

if($comps !== "|+" || $comps !== "+|") echo substr($comps,0,-2);
?>