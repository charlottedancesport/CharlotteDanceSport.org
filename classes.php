<?php
/**
 * Class Definitions
 * For CharlotteDanceSport.org
 */

/**
 * User class/blueprint for cds online members
 */
class cds_member {
	
	/**
	 * Properties 
	 */
	protected $ID;
	protected $member_id;
	protected $first_name;
	protected $last_name;
	protected $email_address;
	protected $dance_level;
	protected $is_admin;
	protected $is_officer;
	protected $is_student;
	protected $officer_title;
	protected $studio_name;
	protected $college_name;
	protected $introduction;
	protected $ten_words;
	protected $levels_competing_in;
	protected $comps_attended;
	protected $facebook_url;
	protected $personal_url;

	/**
	 * Constructor 
	 */
	
	function __construct($user_ID, $fname, $lname) {
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Get wordpress user data for current user */
		$wp_user = $wpdb->get_results("SELECT * FROM wp_users WHERE ID = {$user_ID}");
		
		/* Get cds member data for current user */
		$member = $wpdb->get_results("SELECT * FROM cds_member cm 
										LEFT JOIN cds_member_level cml on cml.level_id = cm.member_level_id
										LEFT JOIN cds_studios cs on cs.studio_id = cm.studio_id
										WHERE user_id = {$user_ID}");
										
		/* If user is officer get their title */
		$officer = $wpdb->get_results("SELECT officer_title FROM cds_officers WHERE member_id = {$member[0]->member_id}");
		
		/* Get profile data for current user */
		$profile = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$member[0]->member_id}");

		/* Get name of college user attends if applicable */
		if(isset($member[0]->college_id)) $college = $wpdb->get_results("SELECT * FROM cds_colleges WHERE college_id = {$member[0]->college_id}");
		
		/**
		 * Display MySQL errors:
		 * $wpdb->show_errors();
		 * $wpdb->print_error();
		 */
		
		/* initialize properties */
		$this->set_ID($user_ID);
		$this->set_member_id($member[0]->member_id);
		$this->first_name = $fname;
		$this->last_name = $lname;
		$this->email_address = $wp_user[0]->user_email;
		$this->dance_level = $member[0]->short_name;
		$this->is_admin = $member[0]->is_admin;
		$this->is_officer = $member[0]->is_officer;
		$this->is_student = $member[0]->is_student;
		foreach ($officer as $o) $otitle .= $o->officer_title . ", ";
			$this->officer_title = substr($otitle,0,-2);
		$this->studio_name = $member[0]->studio_name;
		if(isset($college)) $this->college_name = $college[0]->long_name;
		$this->introduction = $profile[0]->introduction;
		$this->ten_words = $profile[0]->ten_words;
		$this->levels_competing_in = $profile[0]->dance_levels;
		$this->comps_attended = $profile[0]->comps_attended;
		$this->facebook_url = $profile[0]->facebook_url;
		$this->personal_url = $profile[0]->personal_url;
	}
	
	/**
	 * Setter Methods 
	 */
	
	private function set_ID($input){ $this->ID = $input; }
	
	private function set_member_id($input){ $this->member_id = $input; }
	
	public function set_first_name($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members first name in MySQL database */
		$success = $wpdb->query("UPDATE wp_usermeta SET meta_value = '{$input}' WHERE user_id = {$this->ID} AND meta_key = 'first_name'");
		
		/* Set the objects first name */ 
		if($success !== FALSE ) $this->first_name = $input; 
	}
	
	public function set_last_name($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members last name in MySQL database */
		$success = $wpdb->query("UPDATE wp_usermeta SET meta_value = '{$input}' WHERE user_id = {$this->ID} AND meta_key = 'last_name'");
		
		/* Set the objects last name */ 
		if($success !== FALSE ) $this->last_name = $input; 
	}
	
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
		} else {
			$success = $wpdb->query("UPDATE cds_member SET member_level_id = '' WHERE user_id = {$this->ID}");	
		}
		
		/* Set the objects dance_level property */
		if($success !== FALSE) $this->dance_level = $input; 
	}
	
	private function set_is_admin($input){ $this->admin = $input; }
	
	public function set_is_officer($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members officer status in MySQL database */
		$wpdb->query("UPDATE cds_member SET is_officer = {$input} WHERE user_id = {$this->ID}");
		
		/* Set the object's officer status (0 or 1 for false or true respectively) */
		$this->is_officer = $input; 
	}
	
	public function set_is_student($input){
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members student status in MySQL database */
		$wpdb->query("UPDATE cds_member SET is_student = {$input} WHERE user_id = {$this->ID}");
		
		/* Set the object's student status (0 or 1 for false or true respectively) */
		$this->is_student = $input; 
	}
	
	public function set_officer_title($input){
		if(!isEmpty($input)){
			/* Get the globe Wordpress Database */
			global $wpdb;
			
			/* Update members officer title(s) in MySQL database */
			/* FIrst delete current title(s) */
			$wpdb->query("DELETE FROM cds_officers WHERE member_id = {$this->member_id}");
			
			$titles = explode("|", $input);

			foreach ($titles as $t) {
				$wpdb->query("INSERT INTO cds_officers (member_id, officer_title) VALUES ({$this->member_id}, '{$t}')");
				$this->set_is_officer(1);
			}
			
			/* Set the objects officer title */
			$this->officer_title = $input;
		}
	}
	
	public function set_studio_name($input){ $this->studio_name = $input; }
	
	public function set_college_name($input){ $this->college_name = $input; }
	
	public function set_introduction($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members introduction in MySQL database */
		$profile = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$this->member_id}");
		
		if($profile) {
			$success = $wpdb->query("UPDATE cds_member_profile SET introduction = '{$input}' WHERE member_id = {$this->member_id}");
			//$wpdb->show_errors();
			//$wpdb->print_error();
		} else {
			$success = $wpdb->query("INSERT INTO cds_member_profile (member_id, introduction) VALUES ({$this->member_id}, '{$input}')");
			//$wpdb->show_errors();
			//$wpdb->print_error();
		}
		
		/* Set the object's introduction */ 
		if($success !== FALSE ) $this->introduction = $input; 
	}
	
	public function set_ten_words($input){ $this->ten_words = $input; }
	
	public function set_levels_competing_in($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members  current levels danceing at in MySQL database */
		$profile = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$this->member_id}");
		
		if($profile) {
			$success = $wpdb->query("UPDATE cds_member_profile SET dance_levels = '{$input}' WHERE member_id = {$this->member_id}");
		} else {
			$success = $wpdb->query("INSERT INTO cds_member_profile (member_id, dance_levels) VALUES ({$this->member_id}, '{$input}')");
		}
		
		/* Set the objects personal url */ 
		if($success !== FALSE ) $this->levels_competing_in = $input; 
	}
	
	public function set_comps_attended($input){
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Append the attended competiton ID with delimiter to string of comp ID's */
		$profile = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$this->member_id}");
		
		if($profile) {
			if( empty($this->comps_attended) ) {
				$success = $wpdb->query("UPDATE cds_member_profile SET comps_attended = '{$input}' WHERE member_id = {$this->member_id}");
			} else {
				$success = $wpdb->query("UPDATE cds_member_profile SET comps_attended = CONCAT(comps_attended,'|{$input}') WHERE member_id = {$this->member_id}");
			}
		} else {
			$success = $wpdb->query("INSERT INTO cds_member_profile (member_id, comps_attended) VALUES ({$this->member_id}, '{$input}')");
		}
		
		/* Set the objects comps attended */ 
		if($success !== FALSE )
			$this->comps_attended .= ( empty($this->comps_attended) ) ? $input : "|".$input;
	}
	
	public function set_facebook_url($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members facebook url in MySQL database */
		$profile = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$this->member_id}");
		
		if($profile) {
			$success = $wpdb->query("UPDATE cds_member_profile SET facebook_url = '{$input}' WHERE member_id = {$this->member_id}");
		} else {
			$success = $wpdb->query("INSERT INTO cds_member_profile (member_id, facebook_url) VALUES ({$this->member_id}, '{$input}')");
		}
		
		/* Set the objects facebook url */ 
		if($success !== FALSE ) $this->facebook_url = $input; 
	}
	
	public function set_personal_url($input){ 
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		/* Update members personal url in MySQL database */
		$profile = $wpdb->get_results("SELECT * FROM cds_member_profile WHERE member_id = {$this->member_id}");
		
		if($profile) {
			$success = $wpdb->query("UPDATE cds_member_profile SET personal_url = '{$input}' WHERE member_id = {$this->member_id}");
		} else {
			$success = $wpdb->query("INSERT INTO cds_member_profile (member_id, personal_url) VALUES ({$this->member_id}, '{$input}')");
		}
		
		/* Set the objects personal url */ 
		if($success !== FALSE ) $this->personal_url = $input; 
	}
	
	/**
	 * Getter Methods
	 */
	 
	public function get_ID(){ return $this->ID; }
	public function get_member_id(){ return $this->member_id; }
	public function get_first_name(){ return $this->first_name; }
	public function get_last_name(){ return $this->last_name; }
	public function get_email_address(){ return $this->email_address; }
	public function get_dance_level(){ return $this->dance_level; }
	public function get_officer_title(){ return $this->officer_title; }
	public function get_studio_name(){ return $this->studio_name; }
	public function get_college_name(){ return $this->college_name; }
	public function get_introduction(){ return $this->introduction; }
	public function get_ten_words(){ return $this->ten_words; }
	public function get_levels_competing_in(){ return $this->levels_competing_in; }
	public function get_comps_attended(){
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		// initialize return variables
		$r = '';
		$r1 = '';
		$r2 = '';
		$r3 = '';
		
		if( !empty($this->comps_attended) ) {
			// Get the competition ID's
			$comp_id = explode("|", $this->comps_attended);
			
			
			// for each id get the competitions long name
			for ($i=0; $i < count($comp_id); $i++) {
				$competition = $wpdb->get_results("SELECT * FROM competitions WHERE comp_id = {$comp_id[$i]}");
				$c[$i] = array( "id"=>$competition[0]->comp_id, "name"=>$competition[0]->long_name, "organization"=>$competition[0]->organization, "website"=>$competition[0]->website );
			}
			
			// format return string
			foreach ($c as $comp) {
				switch( $comp["organization"] ){
					case "USA Dance":
					$r1 .= '<li>';
					if( !empty($comp['website']) ) {
						$r1 .= '<div class="b-f"><a class="b-d" href="';
						$r1 .= ( preg_match('/(ftp|http|https):\/\//i',$comp['website']) ) ? $comp['website'] : "http://".$comp['website'];
						$r1 .= '">'.$comp['name'].'</a></div>';
					} else {
						$r1 .= '<div class="b-f">'.$comp['name'].'</div>';
					}
					$r1 .= '<span class="id hidden">'.$comp['id'].'</span></li>';
					break;
					
					case "NDCA":
					$r2 .= '<li>';
					if( !empty($comp['website']) ) {
						$r2 .= '<div class="b-f"><a class="b-d" href="';
						$r2 .= ( preg_match('/(ftp|http|https):\/\//i',$comp['website']) ) ? $comp['website'] : "http://".$comp['website'];
						$r2 .= '">'.$comp['name'].'</a></div>';
					} else {
						$r2 .= '<div class="b-f">'.$comp['name'].'</div>';
					}
					$r2 .= '<span class="id hidden">'.$comp['id'].'</span></li>';
					break;
					
					case "College":
					$r3 .= '<li>';
					if( !empty($comp['website']) ) {
						$r3 .= '<div class="b-f"><a class="b-d" href="';
						$r3 .= ( preg_match('/(ftp|http|https):\/\//i',$comp['website']) ) ? $comp['website'] : "http://".$comp['website'];
						$r3 .= '">'.$comp['name'].'</a></div>';
					} else {
						$r3 .= '<div class="b-f">'.$comp['name'].'</div>';
					}
					$r3 .= '<span class="id hidden">'.$comp['id'].'</span><!--div class="b-e"></div--></li>';
					break;
					
					default:
					break;
				}
			}
			
			if( !empty($r1) && isset($r1) ) {
				$r .= '<div class="b-a b-b"><h3 class="b-c">USA Dance</h3><ul>'.$r1.'</ul></div>';
			}
			
			if( !empty($r2) && isset($r2) ) {
				$r .= '<div class="b-b"><h3 class="b-c">NDCA</h3><ul>'.$r2.'</ul></div>';
			}
			
			if( !empty($r3) && isset($r3) ) {
				$r .= '<div class="b-b"><h3 class="b-c">Collegiate</h3><ul>'.$r3.'</ul></div>';
			} 
		}
		
		return ( !empty($r) && isset($r) ) ? $r : '';
		
	}
	public function get_facebook_url(){ return $this->facebook_url; }
	public function get_personal_url(){ return $this->personal_url; }
	
	public function is_admin(){ return $this->is_admin; }
	public function is_officer(){ return $this->is_officer; }
	public function is_student(){ return $this->is_student; }
	
	// Untility methods
	public function delete_comp_attended($comp_id){
		/* Get the globe Wordpress Database */
		global $wpdb;
		
		//echo "comp_id = ".$comp_id."\n";
		
		//echo "comps_attended = ".$this->comps_attended."\n";
		
		/* Remove the requested comp_id from this objects string of comps attended */
		$needle = '/^'.$comp_id.'\|{0,1}|\|'.$comp_id.'$/';
		$new_comps_attended = preg_replace($needle, '', $this->comps_attended);
		
		//echo "new_comps_attended = " . $new_comps_attended . "\n";
		
		$needle = '/\|'.$comp_id.'\|/';
		$new_comps_attended = preg_replace($needle, '|', $new_comps_attended);
		
		//echo "new_comps_attended = " . $new_comps_attended . "\n";
		
		/* Update the members user_email in MySQL database */
		$success = $wpdb->query("UPDATE cds_member_profile SET comps_attended = '{$new_comps_attended}' WHERE member_id = {$this->member_id}");
		
		/* Set the objects conpetition attended property */
		if($success !== FALSE) $this->comps_attended = $new_comps_attended;
		
	}
}
?>