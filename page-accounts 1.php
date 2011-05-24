<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

/* Visitors can not view the accounts page if they are not currently logged in */
if ( !is_user_logged_in() ) { header("Location: http://" . $_SERVER['HTTP_HOST']); }

/* For SSL sercurity for user account managment page */
if ( !isset($_SERVER['HTTPS']) ) { header( "Location: https://".$_SERVER['HTTP_HOST']."/accounts/" ); }

/* isEmpty - Check if value/variable/property is empty */
function isEmpty($value){
	return ($value === "" || $value === NULL);
}
/**
 * User class/blueprint for cds online members
 */
class cds_member {
	
	/* Properties */
	protected $ID;
	protected $member_id;
	protected $first_name;
	protected $last_name;
	protected $email_address;
	protected $dance_level;
	protected $is_admin;
	protected $is_officer;
	protected $officer_title;
	protected $is_student;
	protected $studio_name;
	protected $college_name;
	protected $introduction;
	protected $ten_words;
	protected $levels_competing_in;
	protected $comps_attended;
	protected $facebook_url;
	protected $personal_url;

	/* Constructor */
	function __construct($user_ID, $fname, $lname) {
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* initialize properties */
		/*$email_address = NULL;
		$dance_level = NULL ;
		$is_admin = NULL;
		$is_officer = NULL;
		$officer_title = NULL;
		$is_student = NULL;
		$studio_name = NULL;
		$college_name = NULL;
		$introduction = NULL;
		$ten_words = NULL;
		$levels_competing_in = NULL;
		*/

		$wp_user = $wpdb->get_results("SELECT * FROM wp_users WHERE ID = {$user_ID}");
		$member = $wpdb->get_results("SELECT * FROM cds_member cm 
										LEFT JOIN cds_member_level cml on cml.level_id = cm.member_level_id
										LEFT JOIN cds_studios cs on cs.studio_id = cm.studio_id
										WHERE user_id = {$user_ID}");
		$officer = $wpdb->get_results("SELECT officer_title FROM cds_officers WHERE member_id = {$member[0]->member_id}");
		$profile = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$member[0]->member_id}");

		//$wpdb->show_errors();
		
		if(isset($member[0]->college_id)) $college = $wpdb->get_results("SELECT * FROM cds_colleges WHERE college_id = {$member[0]->college_id}");
		

		//$wpdb->print_error();
		
		$this->set_ID($user_ID);
		$this->set_member_id($member[0]->member_id);
		$this->first_name = $fname;
		$this->last_name = $lname;
		$this->email_address = $wp_user[0]->user_email;
		$this->dance_level = $member[0]->short_name;
		$this->set_is_admin($member[0]->is_admin);
		$this->set_is_officer($member[0]->is_officer);
		$this->officer_title = $officer[0]->officer_title;
		$this->studio_name = $member[0]->studio_name;
		if(isset($college)) $this->college_name = $college[0]->long_name;
		$this->introduction = $profile[0]->introduction;
		$this->ten_words = $profile[0]->ten_words;
		$this->set_levels_competing_in($profile[0]->dances_levels);
		$this->set_comps_attended($profile[0]->comps_attended);
		$this->set_facebook_url($profile[0]->facebook_url);
		$this->set_personal_url($profile[0]->personal_url);
	}
	
	/* Setters */
	private function set_ID($input){ $this->ID = $input; }
	private function set_member_id($input){ $this->member_id = $input; }
	private function set_first_name($input){ $this->first_name = $input; }
	private function set_last_name($input){ $this->last_name = $input; }
	public function set_email_address($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update the members user_email in MySQL database */
		$success = $wpdb->query("UPDATE wp_users SET user_email = '{$input}' WHERE ID = {$this->ID}");
		
		/* Set the objects email address property */
		if($success !== FALSE) $this->email_address = $input; 
	}
	public function set_dance_level($input){
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Get the member level ID of the dance level which is being set */
		$level = $wpdb->get_results("SELECT level_id as ID FROM cds_member_level WHERE short_name = '{$input}'");
		
		/* As long as an level ID was found update the members level in MySQL database */
		if(isset($level[0]->ID)) { 
			$success = $wpdb->query("UPDATE cds_member SET member_level_id = {$level[0]->ID} WHERE user_id = {$this->ID}");
		
			/* Set the objects dance_level property */
			if($success !== FALSE) $this->dance_level = $input; 
		}
	}
	private function set_is_admin($input){ $this->admin = $input; }
	public function set_is_officer($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members officer status in MySQL database */
		$wpdb->query("UPDATE cds_member SET is_officer = {$input} WHERE user_id = {$this->ID}");
		
		/* Set the objects officer status (0 or 1 for false or true respectively) */
		$this->is_officer = $input; 
	}
	public function set_officer_title($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members officer title in MySQL database */
		if($this->is_officer) {
			$wpdb->query("UPDATE cds_officers SET officer_title = '{$input}' WHERE member_id = {$this->member_id}");
			//$wpdb->show_errors();
		//$wpdb->print_error();
		} else {
			$wpdb->query("INSERT INTO cds_officers (member_id, officer_title) VALUES ({$this->member_id}, '{$input}')");
			//$wpdb->show_errors();
		//$wpdb->print_error();
			$this->set_is_officer(1);
		}
		
		/* Set the objects officer title */
		$this->officer_title = $input; 
	}
	public function set_studio_name($input){ $this->studio_name = $input; }
	public function set_college_name($input){ $this->college_name = $input; }
	public function set_introduction($input){ $this->introduction = $input; }
	public function set_ten_words($input){ $this->ten_words = $input; }
	public function set_levels_competing_in($input){ $this->levels_competing_in = $input; }
	public function set_comps_attended($input){$this->comps_attended = $input; }
	public function set_facebook_url($input){ $this->facebook_url = $input; }
	public function set_personal_url($input){ $this->personal_url = $input; }
	/* Getters */
	public function get_ID(){ return $this->ID; }
	public function get_member_id(){ return $this->member_id; }
	public function get_first_name(){ return $this->first_name; }
	public function get_last_name(){ return $this->last_name; }
	public function get_email_address(){ return $this->email_address; }
	public function get_dance_level(){ return $this->dance_level; }
	public function get_officer_title(){ return $this->officer; }
	public function get_studio_name(){ return $this->studio_name; }
	public function get_college_name(){ return $this->college_name; }
	public function get_introduction(){ return $this->introduction; }
	public function get_ten_words(){ return $this->ten_words; }
	public function get_levels_competing_in(){ return $this->levels_competing_in; }
	public function get_comps_attended(){ return $this->comps_attended; }
	public function get_facebook_url(){ return $this->facebook_url; }
	public function get_personal_url(){ return $this->personal_url; }
	
	public function is_admin(){ return $this->is_admin; }
	public function is_officer(){ return $this->is_officer; }
}

if ( is_user_logged_in() ) { 
	global $current_user; 
	get_currentuserinfo();
}

$club_member = new cds_member($current_user->ID, $current_user->user_firstname, $current_user->user_lastname);

//get_header(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<style type="text/css">
/* Account Management page styles */
body {
	font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif;
	font-size:12px;
	color: #000;
	margin:0px;
	padding:0px;
}
.wrapper{
	margin: 0 auto 0 auto;
	width: 1024px;
}
.narrowcolumn{
	float: left;
	width: 945px;
}
.a-a{
	border-bottom: 1px solid #dedede;
	width:670px;
	height:auto;
	float: left;
	padding: 1.4em 0 1.4em 0;
	margin:0px;
}
.a-b{
	width:225px;
	font-weight:bold;
	position:relative;
	font-size: 12px;
	float:left;
	margin:0px 0px 0px 5px;
	padding:0px;
}
.a-c{
	width:440px;
	color: #ddd;
	position:relative;
	float:left;
	margin:0px;
	padding:0px;
}
.a-c-a{
	color: #000;

}
.a-d{
	width:630px;
	margin:0px;
	padding:0px;
}
.a-e{
	font-size:30px;
	font-weight:bold;
	margin-bottom:20px;
}
.a-f{
	margin-right:15px;
	color:#ddd;
}
.a-g{
	background: #ff9;
	width:100%;
	height:30px;
	line-height:30px;
	border: 1px solid #FFFF00;
	margin-bottom:50px;
	text-align:center;
	float:left;
}
.a-h{
	float:left;
	width:200px;
	margin-right:70px;
}
.a-i{
	background:#fff;
	border:1px solid #666;
	padding: 15px;
	position:absolute;
	width:670px;
	z-index:1001!important;
}
.a-k{
	font-size:12px;
	height:80px;
	text-align:left;
	width:430px;
	max-width:430px;
	vertical-align:top;
}
.a-l{
	float:left;
	margin: 5px 5px 0px 0px;
	width: 50px;
}
.a-m{
	float:left;
	width: 675px;
}
.a-n{

}
.a-p{
	float:left;
	margin: 5px;
	width:200px;
}
.a-q{
	clear:both;
}
.a-r{
	width:640px;
	color: #666;
	position:relative;
	float:left;
	clear:both;
	margin-top:10px;
	padding:0px;
}
.a-s{
	width:440px;
	color: #777;
	position:relative;
	float:left;
	margin:0px;
	padding:0px;
}
.a-t{
	width:300px;
}
.a-u{
	width:150px;
	margin-right:10px;
}
.footer{
	float:left;
	width:100%;
	margin:50px auto 20px 0px;
}
.hidden{
	display:none;
}
.light_dimmer{
	background: #666;
	left:0px;
	opacity: 0.6;
	position:absolute;
	top:0px;
	z-index:1000!important;
}
label{
	margin-left:5px;
}
#email{
	clear:right;
}
#first_name{
	margin-right: 10px;
}
.error{
	width:299px;
	height:20px;
	background: #F0D9D9;
	border: 1px solid #E0B4B4;
	color:#900; 
	text-align:left;
	line-height:20px;
	padding-left:5px;
	clear:both;
}
</style>
<!--[if gte IE 5]>
<style type="text/css">
.light_dimmer{
	background: transparent;
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#88000000,endColorstr=#88000000); /*AARRGGBB*/
	zoom: 1;
    z-index: 1000!important;
	}
</style>
<![endif]-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.5.0");
</script>

<script language="javascript" type="text/javascript">
/**
 * isEmpty - Check if variable is empty
 * param: inputStr - the string being evaluated
 * return: true, false respectively
 */
function isEmpty( inputStr ) { return ( null == inputStr || "" == inputStr ) ? true : false; }

/**
 * Validate URL
 * param: url - the url string being checked.
 * return true / false if url is valid / not valid respectively
 */
function isUrl(url) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
	return regexp.test(url);
}

/**
 * Get browser scroll width x height
 */
function get_scrollHeight() {
	return f_filterResults (
		window.scrollHeight ? window.scrollHeight : 0,
		document.documentElement ? document.documentElement.scrollHeight : 0,
		document.body ? document.body.scrollHeight : 0
	);
}
function get_viewportHeight() {
	return f_filterResults (
		window.innerHeight ? window.innerHeight : 0,
		document.documentElement ? document.documentElement.clientHeight : 0,
		document.body ? document.body.clientHeight : 0
	);	
}
function get_scrollWidth() {
	return f_filterResults (
		window.scrollWidth ? window.scrollWidth : 0,
		document.documentElement ? document.documentElement.scrollWidth : 0,
		document.body ? document.body.scrollWidth : 0
	);
}
function f_filterResults(n_win, n_docel, n_body) {
	var n_result = n_win ? n_win : 0;
	if (n_docel && (!n_result || (n_result > n_docel)))
		n_result = n_docel;
	return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;
}
/* End get browser scroll h x w */
$(document).ready(function() {
	$('.a-a').hover(
		function(){
			$(this).css('background','#EFFFEF').css('cursor','pointer');
		},
		function(){
			$(this).css('background','#fff');
		}
	);
	$('#full_name').hover(
		function(){
			$(this).css('background','#EFFFEF').css('cursor','pointer');
		},
		function(){
			$(this).css('background','#fff');
		}
	);

 	$('.a-a').click( function(){
		/**
		 * Get current left and top position of clicked profile update
		 * element and use it to place the update_form over top
		 */
		var offset = $(this).offset();
		
		/**
		 * Determine which profile feature is being updated
		 * set class and data to display in .update_form
		 */
		var theClass = '';
		var theHTML = '';
		var feature_to_update = $(this).find('.a-b:eq(0)').text().toLowerCase();
		
		switch (feature_to_update){
			case 'introduction':
				theClass = 'a-i';
				theHTML = '<h2 class="a-b">Introduction</h2><div class="a-c"><span><textarea id="intro" class="a-k"></textarea><div><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			case 'member status':
				theClass = 'a-i';
				theHTML = '<h2 class="a-b">Member status</h2><div class="a-r"><span>'+
'<div class="a-p"><input id="president" class="a-o" type="checkbox" value="President" /><label for="president">President</label></div>'+
'<div class="a-p"><input id="new_captain" class="a-o" type="checkbox" value="Newcomer Team Captain" /><label for="new_captain">Newcomer Team Captain</label></div>'+
'<div class="a-p"><input id="advisor" class="a-o" type="checkbox" value="Club Advisor" /><label for="advisor">Club Advisor</label></div>'+
'<div class="a-p"><input id="vice_president" class="a-o" type="checkbox" value="Vice President" /><label for="vice_president">Vice President</label></div>'+
'<div class="a-p"><input id="bronze_captain" class="a-o" type="checkbox" value="Bronze Team Captain" /><label for="bronze_captain">Bronze Team Captain</label></div>'+
'<div class="a-p"><input id="student" class="a-o" type="checkbox" value="Student" /><label for="student">Student</label></div>'+
'<div class="a-p"><input id="treasurer" class="a-o" type="checkbox" value="Treasurer" /><label for="treasurer">Treasurer</label></div>'+
'<div class="a-p"><input id="silver_captain" class="a-o" type="checkbox" value="Silver Team Captain" /><label for="silver_captain">Silver Team Captain</label></div>'+
'<div class="a-p"><input id="non_student" class="a-o" type="checkbox" value="Non student" /><label for="non_student">Non student</label></div>'+
'<div class="a-p"><input id="secretary" class="a-o" type="checkbox" value="Secretary" /><label for="secretary">Secretary</label></div>'+
'<div class="a-p"><input id="ad_member" class="a-o" type="checkbox" value="Advertising Team Member" /><label for="ad_member">Advertising Team Member</label></div>'+
'<div class="a-p"><input id="new_member" class="a-o" type="checkbox" value="Newcomer Team Member" /><label for="new_member">Newcomer Team Member</label></div>'+
'<div class="a-p"><input id="event_coordinator" class="a-o" type="checkbox" value="Event Coordinator" /><label for="event_coordinator">Event Coordinator</label></div>'+
'<div class="a-p"><input id="webmaster" class="a-o" type="checkbox" value="Webmaster" /><label for="webmaster">Webmaster</label></div>'+
'<div class="a-p"><input id="bronze_membern" class="a-o" type="checkbox" value="Bronze Team Member" /><label for="bronze_member">Bronze Team Member</label></div>'+
'<div class="a-p"><input id="graphics" class="a-o" type="checkbox" value="Graphics Designer" /><label for="graphics">Graphics Designer</label></div>'+
'<div class="a-p"><input id="public_relations" class="a-o" type="checkbox" value="Public Relations" /><label for="public_relations">Public Relations</label></div>'+
'<div class="a-p"><input id="silver_member" class="a-o" type="checkbox" value="Silver Team Member" /><label for="silver_member">Silver Team Member</label></div>'+
'<div class="a-p"><input id="volunteer_coordinator" class="a-o" type="checkbox" value="Volunteer Coordinator" /><label for="volunteer_coordinator">Volunter Coordinator</label></div>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			case 'dance level':
				theClass = 'a-i';
				theHTML = '<h2 class="a-b">Dance level</h2><div class="a-s"><span>'+
'<div class="a-p"><input id="social" class="a-o" type="checkbox" value="Social" /><label for="social">Social</label></div>'+
'<div class="a-p"><input id="novice" class="a-o" type="checkbox" value="Novice" /><label for="novice">Novice</label></div>'+
'<div class="a-p"><input id="newcomer" class="a-o" type="checkbox" value="Newcomer" /><label for="Newcomer">Newcomer</label></div>'+
'<div class="a-p"><input id="prechamp" class="a-o" type="checkbox" value="Pre Championship" /><label for="prechamp">Pre Championship</label></div>'+
'<div class="a-p"><input id="bronze" class="a-o" type="checkbox" value="Bronze" /><label for="bronze">Bronze</label></div>'+
'<div class="a-p"><input id="champ" class="a-o" type="checkbox" value="Championshiop" /><label for="champ">Championship</label></div>'+
'<div class="a-p"><input id="silver" class="a-o" type="checkbox" value="Silver" /><label for="silver">Silver</label></div>'+
'<div class="a-p"><input id="proam" class="a-o" type="checkbox" value="Pro Am" /><label for="proam">Pro Am</label></div>'+
'<div class="a-p"><input id="gold" class="a-o" type="checkbox" value="Gold" /><label for="gold">Gold</label></div>'+
'<div class="a-p"><input id="Professional" class="a-o" type="checkbox" value="pro" /><label for="pro">Professional</label></div>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			case "comps i've attended":
				theClass = 'a-i';
				theHTML = '<h2 class="a-b">Comps I\'ve attended</h2><div class="a-r"><span>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			case 'email':
				theClass = 'a-i';
				theHTML = '<h2 class="a-b">Email</h2><div class="a-c"><span>'+
'<input id="email" type="text" name="email" class="a-t" />'+
'<div class="hidden error">Error :(</div>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			case 'personal url':
				theClass = 'a-i';
				theHTML = '<h2 class="a-b">Personal URL</h2><div class="a-c"><span>'+
'<input id="p_url" type="text" name="p_url" class="a-t" />'+
'<div class="hidden error">Error :(</div>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			case 'facebook url':
				theClass = 'a-i';
				theHTML = '<h2 class="a-b">Facebook URL</h2><div class="a-c"><span>'+
'<input id="f_url" type="text" name="f_url" class="a-t" />'+
'<div class="hidden error">Error :(</div>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			default:
				break;
		}
		
		/**
		 * Show update from
		 */
		$('.update_form')
			.removeClass('hidden')
			.addClass(theClass)
			.css('top',offset.top)
			.css('left',offset.left)
			.html(theHTML);
		
		/**
		 * Attempt to focus on the first update field for usability
		 * and add any current profile values to form
		 */
		var theFocus = '';
		
		switch (feature_to_update){
			case 'introduction':
				theFocus = '.a-k';
				if( $('#introduction').hasClass('a-c-a') ) $('#intro').val($('#introduction').text());
				break;
			case 'member status':
				theFocus = '#president';
				break;
			case 'dance Level':
				theFocus = "#silver";
				break;
			case "comps i've attended":
				break;
			case 'email':
				theFocus = "#email";
				if( $('#email_address').hasClass('a-c-a') ) $('#email').val($('#email_address').text());
				break;
			case 'personal url':
				theFocus = "#p_url";
				if( $('#personal_url').hasClass('a-c-a') ) $('#p_url').val($('#personal_url').text());
				break;
			case 'facebook url':
				theFocus = "#f_url";
				if( $('#facebook_url').hasClass('a-c-a') ) $('#f_url').val($('#facebook_url').text());
				break;
			default:
				break;
		}
		$(theFocus).focus();
		
		/**
		 * Dim the background with a translucent grey
		 */
		$('.light_dimmer')
			.css('width',get_scrollWidth()/*$(window).width()*/+'px')
			.css('height',get_scrollHeight()/*$(window).height()*/+'px')
			.removeClass('hidden');
			
		/**
		 * Click cancel button to hide the update form & background dimmer
		 */
		$('#Cancel').click(function(){
			$('.update_form')
				.attr('style','')
				.addClass('hidden');
			$('.light_dimmer').addClass('hidden');
		});
		
		/**
		 * Clicking send button updates the appropriate profile 
		 * feature DB entry via ajax.
		 */
		$('#Send').click(function(){
			/**
			 * Format data for submission via Ajax
			 */
			var theData = '';
			var use;
			
			switch (feature_to_update){
				case 'introduction':
					theData = 'intro='+$('.a-k').val();
					
					// Ignore or use ajax call below this switch statement
					use = true;
					
					break;
				case 'member status':
				
					// Ignore or use ajax call below this switch statement
					use = false;
					
					break;
				case 'dance level':
					
					// Ignore or use ajax call below this switch statement
					use = false;
					
					break;
				case "comps i've attended":
					
					// Ignore or use ajax call below this switch statement
					use = false;
					
					break;
				case 'email':		
					/**
					 * Check if email entered is formatted correctly
					 * If not display error message to user using ajax :)
					 */
					
					$.ajax({
						url:'<?php bloginfo('stylesheet_directory'); ?>/ajax_helper/email_validator.php',
						type:'GET',
						data:'email='+$('#email').val(),
						dataType:"html",
						statusCode: {
							404: function(){
							}
						},
						success: function(responseText){
							if(!isEmpty(responseText)) {
								$('.error')
									.removeClass("hidden")
									.html(responseText);
								$('#email').focus();
							} else if( isEmpty($('#email').val()) ){
								$('.error')
									.removeClass("hidden")
									.html('<span class="invalid"><strong>ERROR</strong>: An invalid email address was entered!</span>');
								$('#email').focus();
							} else {
								theData = 'user_email='+$('#email').val();
								$('.error').addClass("hidden");
							}
							
							if(!isEmpty(theData)){
								$.ajax({
									url:'/edit_tools/ajax-update-member-profile/',
									type:'POST',
									data:theData+'&mid=<?php echo $club_member->get_member_id(); ?>',
									dataType:"html",
									statusCode: {
										404: function(){
										}
									},
									success: function(data){
										// Hide the update form & background dimmer
										$('.update_form')
											.attr('style','')
											.addClass('hidden');
										$('.light_dimmer').addClass('hidden');
										
										// Update the gravatar picture
										$.ajax({
											url:'/edit_tools/ajax-get-200x200-gravator/',
											type:'POST',
											data:theData,
											dataTupe:'html',
											statusCode: {
												404: function(){
												}
											},
											success: function(data){
												$('.post_author_gravatar_icon').html(data);
											},
											error: function(){
												alert('error');
											},
											complete: function(){
											}
										});
										
										// Update the user email address
										$.ajax({
											url:'/edit_tools/ajax-get-user-email/',
											type:'POST',
											data:'mid=<?php echo $club_member->get_member_id(); ?>',
											dataTupe:'html',
											statusCode: {
												404: function(){
												}
											},
											success: function(data){
												$('#email_address').html(data);
											},
											error: function(){
												alert('error');
											},
											complete: function(){
											}
										});
									},
									error: function(){
										alert('error');
									},
									complete: function(){
										
									}
								});
							}
						},
						error: function(){
							alert('error');
						},
						complete: function(){
							
						}
					});
					
					// Ignore or use ajax call below this switch statement
					use = false;
					
					break;
				case 'personal url':
					theData = 'p_url='+$('#p_url').val();
					
					if( isEmpty($('#p_url').val()) ){
						// Ignore or use ajax call below this switch statement
						use = true;
					} else {
						/**
						 * If entered URL is validate then update user's profile
						 * otherwise display error to the user
						 */
						 
						/**
						 * First format the url. Add protocol prefix if missing, i.e., http://
						 */
						$('#p_url').val( ($('#p_url').val().toString().search(new RegExp(/(ftp|http|https):\/\//i))) ? "http://"+$('#p_url').val() : $('#p_url').val() );
						
						if( isUrl( $('#p_url').val() ) ){				
							// Ignore or use ajax call below this switch statement
							use = true;
						} else {
							$('.error')
								.removeClass("hidden")
								.html('<span class="invalid"><strong>ERROR</strong>: An invalid url was entered!</span>');
							$('#p_url').focus();
							
							use = false;
						}
					}
					break;
				case 'facebook url':
					theData = 'f_url='+$('#f_url').val();
					
					if( isEmpty($('#f_url').val()) ){
						// Ignore or use ajax call below this switch statement
						use = true;
					} else {						
						/**
						 * If entered URL is validate then update user's profile
						 * otherwise display error to the user
						 */
						
						/**
						 * First format the url. Add protocol prefix if missing, i.e., http://
						 */
						$('#f_url').val( ($('#f_url').val().toString().search(new RegExp(/(ftp|http|https):\/\//i))) ? "http://"+$('#f_url').val() : $('#f_url').val() );
						
						if( isUrl( $('#f_url').val() ) ){				
							// Ignore or use ajax call below this switch statement
							use = true;
						} else {
							$('.error')
								.removeClass("hidden")
								.html('<span class="invalid"><strong>ERROR</strong>: An invalid url was entered!</span>');
							$('#f_url').focus();
							
							use = false;
						}
					}
					break;
				default:
					break;
			}
			
			if( use ){
				$.ajax({
					url:'/edit_tools/ajax-update-member-profile/',
					type:'POST',
					data:theData+'&mid=<?php echo $club_member->get_member_id(); ?>',
					dataType:"html",
					statusCode: {
						404: function(){
						}
					},
					success: function(data){
						// Hide the update form & background dimmer
						$('.update_form')
							.attr('style','')
							.addClass('hidden');
						$('.light_dimmer').addClass('hidden');
						
						switch(feature_to_update){
							case 'introduction':
								if( isEmpty($('#intro').val() ) ){
									$('#introduction')
										.text('Give a brief intro of yourself and your dance background')
										.removeClass('a-c-a');								
								} else {
									$('#introduction')
										.text($('#intro').val())
										.addClass('a-c-a');
								}
							break;
							/*case 'email':
								if( isEmpty($('#email').val() ) ){
									$('#email_address')
										.text('Enter your email address.')
										.removeClass('a-c-a');								
								} else {
									$('#email_address')
										.text($('#email').val())
										.addClass('a-c-a');
								}
							break;*/
							case 'personal url':
								if( isEmpty($('#p_url').val() ) ){
									$('#personal_url')
										.text('Have a personal portfolio website?')
										.removeClass('a-c-a');								
								} else {
									$('#personal_url')
										.text($('#p_url').val())
										.addClass('a-c-a');
								}
							break;
							case 'facebook url':
								if( isEmpty($('#f_url').val() ) ){
									$('#facebook_url')
										.text('Allow friends to connect with you via your Facebook profile page.')
										.removeClass('a-c-a');								
								} else {
									$('#facebook_url')
										.text($('#f_url').val())
										.addClass('a-c-a');
								}
							break;
						}
					},
					error: function(){
						alert('error');
					},
					complete: function(){
						
					}
				});
			}
		});
	});
	
	$('#full_name').click( function(){
		/**
		 * Get current left and top position of clicked profile update
		 * element and use it to place the update_form over top
		 */
		var offset = $(this).offset();
		
		/**
		 * Determine which profile feature is being updated
		 * set class and data to display in .update_form
		 */
		var theClass = 'a-i';
		var theHTML = '<h2 class="a-b">Name</h2><div class="a-c"><span>'+
'<input id="f_name" type="text" name="f_name" class="a-u" />'+
'<input id="l_name" type="text" name="l_name" class="a-u" />'+
'<div class="hidden error">Error :(</div>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';

		/**
		 * Show update from
		 */
		$('.update_form')
			.removeClass('hidden')
			.addClass(theClass)
			.css('top',offset.top)
			.css('left',offset.left)
			.html(theHTML);
		
		/**
		 * Pre-fill the forms first and last name fields with users name if applicable
		 */
		if( !$('#first_name').hasClass('a-f') ) $('#f_name').val($('#first_name').text());
		if( !$('#last_name').hasClass('a-f') ) $('#l_name').val($('#last_name').text());
			
		/**
		 * Attempt to focus on the first update field for usability
		 * and add any current profile values to form
		 */
		$('#f_name').focus();
		
		/**
		 * Dim the background with a translucent grey
		 */
		$('.light_dimmer')
			.css('width',get_scrollWidth()/*$(window).width()*/+'px')
			.css('height',get_scrollHeight()/*$(window).height()*/+'px')
			.removeClass('hidden');
			
		/**
		 * Click cancel button to hide the update form & background dimmer
		 */
		$('#Cancel').click(function(){
			$('.update_form')
				.attr('style','')
				.addClass('hidden');
			$('.light_dimmer').addClass('hidden');
		});
		
		/**
		 * Clicking send button updates the appropriate profile 
		 * feature DB entry via ajax.
		 */
		$('#Send').click(function(){
		});
		
	});
});

</script>
</head>

<body>
    <? 
/*		echo $club_member->get_ID() . "<br />";
	echo $club_member->get_member_id() . "<br />";
	echo $club_member->get_first_name() . "<br />";
	echo $club_member->get_last_name() . "<br />";
	echo $club_member->get_email_address() . "<br />";
	echo $club_member->get_dance_level() . "<br />";
	echo $club_member->get_officer_title() . "<br />";
	echo $club_member->get_studio_name() . "<br />";
	echo $club_member->get_college_name() . "<br />";
	echo $club_member->get_introduction() . "<br />";
	echo $club_member->get_ten_words() . "<br />";
	echo $club_member->get_levels_competing_in() . "<br />"; */ ?>
<div class="wrapper">
    
	<div id="content" class="narrowcolumn" role="main">
    
    	<div class="a-g">Click on the parts of your profile you want to edit.</div>
    
        <div class="a-h">
        
            <div class="a-e"><span>Profile</span></div>
            
            <div class="post_author_gravatar_icon">
                <?php echo get_avatar( $club_member->get_email_address(), '200' ); ?>
            </div>
         
            <div class="a-j"><p>We use Gravatars for profile photos. <a href="http://en.gravatar.com/site/signup/<?php echo urlencode($current_user->user_email); ?>" target="_blank">Setup your Gravatar today!</a></p></div>
        
        </div>
        
        <div class="a-m">
        
            <div class="a-e">
                <span id="full_name">
                <?php 
                    echo (!isEmpty( $club_member->get_first_name() )) ? '<span id="first_name">'.$club_member->get_first_name().'</span>' : '<span id="first_name" class="a-f">First</span>'; 
                    echo (!isEmpty( $club_member->get_last_name() )) ? '<span id="last_name">'.$club_member->get_last_name().'</span>' : '<span id="last_name" class="a-f">Last</span>'; 
                ?>
                </span>
            </div>
            
            <div class="a-d">
            
                <div class="a-a">
                    <h2 class="a-b">Introduction</h2>
                    <div class="a-c"><?php echo (!isEmpty( $club_member->get_introduction() )) ? '<span id="introduction" class="a-c-a">'.$club_member->get_introduction().'</span>' : '<span id="introduction">Give a brief intro of yourself and your dance background</span>';  ?></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Member status</h2>
                    <div class="a-c"><?php echo '<span id="member_status">For example: Club Teasurer, Bronse Team member, on student, etc.</span>'; ?></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Dance level</h2>
                    <div class="a-c"><span id="dance_level">What level(s) do you currently compete at?</span></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Comps I've attended</h2>
                    <div class="a-c"><span id="comps_attended">For example: CDC 2010, USA Dance Nationals 2009</span></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Email</h2>
                    <div class="a-c"><?php echo (!isEmpty( $club_member->get_email_address() )) ? '<span id="email_address" class="a-c-a">'.$club_member->get_email_address().'</span>' : '<span id="email_address">Enter your email address.</span>' ?></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Facebook URL</h2>
                    <div class="a-c"><?php echo (!isEmpty( $club_member->get_facebook_url() )) ? '<span id="facebook_url" class="a-c-a">'.$club_member->get_facebook_url().'</span>' : '<span id="facebook_url">Allow friends to connect with you via your Facebook profile page.</span>'; ?></div>
                </div>
                <div class="a-a">
                    <h2 class="a-b">Personal URL</h2>
                    <div class="a-c"><?php echo (!isEmpty( $club_member->get_personal_url() )) ? '<span id="personal_url" class="a-c-a">'.$club_member->get_personal_url().'</span>' : '<span id="personal_url">Have a personal portfolio website?</span>'; ?></div>
                </div>
        	</div>
        </div>
	</div>
    <div class="footer">
        <div id="credits">
            <p>&copy; 2010 <span class="notranslate">Charlotte DanceSport</span></p>
            <p>d/b/a/ 49er Social &amp; Ballroom Dance Club</p>
            <p><span class="notranslate">@ UNC-Charlotte</span></p>
            <p><a href="<?php bloginfo('stylesheet_directory'); ?>/privacy/" target="_blank">Privacy</a></p>
        </div>
    </div>
    
    <div class="light_dimmer hidden"></div>
    <div class="update_form hidden"></div>
</div>
</body>
</html>
<?php //get_sidebar(); ?>

<?php //get_footer(); ?>