<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 * Template Name: Calendar
 */

get_header(); ?>
 
	<div id="content" class="narrowcolumn" role="main">
    	<div id="nextEvent">
        	<div id="nextEventHeader"><p>Next Event:</p></div>
            <div id="nextEventArrow"></div>
            <div id="nextEventDetails"></div>
        </div>

<?php 
if ( is_user_logged_in() ) { 
	global $current_user; 
	get_currentuserinfo();
			
	$query = "SELECT * FROM cds_member WHERE user_id={$current_user->ID}";
	$select = mysql_query($query) or die("Select from cds_member failed.");
	$user = mysql_fetch_array($select, MYSQL_ASSOC);
}

if($user['is_admin']) {
?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$(".quick_view_row:odd").css("background-color", "#B9E887");
	$(".quick_view_col:even").addClass("transparent_green");
});
</script>
        <div id="lessons_quick_view">
        	<div class="calHeaders">Sunday Lessons</div>
            <div class="quick_view_header">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">Date</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Social Dance</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Newcomer</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Bronze</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Silver</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">9/26</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Waltz</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Swing</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Tango &amp; Samba</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Waltz &amp; Jive</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">10/3</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Cha Cha &amp; Rumba</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Waltz</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Tango &amp; Cha cha</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Samba &amp; Foxtrot</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">10/24</span></div>
                <div class="no_lessons_row"><span style="margin-left: 10px;">* No lessons - Carolina Fall Classic *</span></div>
            </div>
        </div>
        
<?php } else { ?>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	$(".quick_view_row:odd").css("background-color", "#B9E887");
	$(".quick_view_col:even").addClass("transparent_green");
});
</script>
        <div id="lessons_quick_view">
        	<div class="calHeaders">Sunday Lessons</div>
            <div class="quick_view_header">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">Date</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Social Dance</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Newcomer</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Bronze</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Silver</span></div>
            </div>
<!--
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">1/16</span></div>
                <div class="no_lessons_row"><span style="margin-left: 10px;">* Open Practice - Martin Luther King, Jr. holiday weekend.*</span></div>
            </div>

            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">1/23</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Rumba/Cha Cha</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Swing</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Waltz/Quickstep & Rumba/Cha Cha">Waltz/Q &amp; Rumba/C</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Foxtrot/Tango & Samba/Jive">Foxtrot/T &amp; Samba/J</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">1/30</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Rumba/Cha Cha</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Swing</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Foxtrot/Tango & Samba/Jive">Foxtrot/T &amp; Samba/J</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Waltz/Quickstep & Rumba/Cha Cha">Waltz/Q &amp; Rumba/C</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">2/06</span></div>
                <div class="no_lessons_row"><span style="margin-left: 10px;">* No Lessons - Super Bowl</span></div>
            </div>

            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">2/13</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Waltz</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Rumba/Cha Cha</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">Open Practice</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">Open Practice</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">2/20</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Waltz</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Comp Review</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">Open Practice</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">Open Practice</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">2/27</span></div>
                <div class="no_lessons_row"><span style="margin-left: 10px;">* No Lessons - <a href="<? //echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.triangleopen.org/" target="_blank">Triangle Open Championship 2011</a> *</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">3/06</span></div>
                <div class="no_lessons_row"><span style="margin-left: 10px;">* No Lessons - Spring Break</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">3/13</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Samba</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Waltz</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Waltz & Rumba/Cha Cha">Waltz &amp; Rumba/C</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Quickstep &amp; Jive</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">3/20</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Samba</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Waltz </span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Quickstep & Samba">Quickstep &amp; Samb</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Foxtrot & Rumba/Cha Cha">Fox &amp; Rumba/C</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">3/27</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Tango</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Samba</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Foxtrot/Tango & Jive">Fox/Tango &amp; Jive</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Waltz/Tango & Samba">Waltz/T &amp; Samb</span></div>
            </div>

            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">4/03</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Tango</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Samba</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">Open Practice</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">Open Practice</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">4/10</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Quickstep</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">Comp Review</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">Open Practice</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">Open Practice</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">4/17</span></div>
                <div class="no_lessons_row"><span style="margin-left: 10px;">* No Lessons - Charlotte DanceSport Challenge 2011 *</span></div>
            </div>
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">4/24</span></div>
                <div class="no_lessons_row"><span style="margin-left: 10px;">* Easter - Lessons TBD *</span></div>
            </div>
    
            <div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">5/01</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">No Lesson</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;">No Lesson</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">3-4pm w/ Marie</span></div>
                <div class="quick_view_col"><span style="margin-left: 10px;" title="Open Practice w/ Rounds">2-3pm w/ Wayne</span></div>
            </div>
      -->
      		<div class="quick_view_row">
            	<div class="quick_view_date_col"><span style="margin-left: 10px;">-/--</span></div>
                <div class="no_lessons_row"><span style="margin-left: 10px;">* NO LESSONS - Please check back for updates *</span></div>
            </div>
        </div>
        
<?php } ?>

        <div id="thisEvent">
            <div class="calHeaders">This Week</div>
            <div id="cds_weekListOfEvents"></div>
            <div class="week_days">
            	<p>sun</p>
                <p>mon</p>
                <p>tue</p>
                <p>wed</p>
                <p>thu</p>
                <p>fri</p>
                <p>sat</p>
            </div>
        </div>

        <div id="listOfEvents">
            <div class="calHeaders">List of Events</div>
            <div id="cds_listOfEvents"></div>
        </div>
        
        <script type="text/javascript">
			google.setOnLoadCallback(init_CDS_listOfEvents);
         </script>
         
        <div id="syncCalendars">
            <div class="calHeaders">Sync CDS Calendars</div>
            <div id="syncCalendar_wrapper">
            <ul class="calendar_link_list">
            	<li><p class="cal_name">CDS Events Calendar</p>
                	<p class="link"><a class="gicalAddress cboxElement" href="#" title="Download ICal format">ICAL</a></p>
                    <p class="link"><a class="ghtmlAddress cboxElement" href="#" title="View in your browser">HTML</a></p>
                    <p class="link"><a class="gxmlAddress cboxElement" href="#" title="For the dance nerds :)">XML</a></p>
                </li>
                <li><p class="cal_name">Social Lessons Calendar</p>
                	<p class="link"><a class="sicalAddress cboxElement" href="#" title="Download ICal format">ICAL</a></p>
                    <p class="link"><a class="shtmlAddress cboxElement" href="#" title="View in your browser">HTML</a></p>
                    <p class="link"><a class="sxmlAddress cboxElement" href="#" title="For the dance nerds :)">XML</a></p>
                </li>
                <li><p class="cal_name">Newcomer Lessons Calendar</p>
                	<p class="link"><a class="nicalAddress cboxElement" href="#" title="Download ICal format">ICAL</a></p>
                    <p class="link"><a class="nhtmlAddress cboxElement" href="#" title="View in your browser">HTML</a></p>
                    <p class="link"><a class="nxmlAddress cboxElement" href="#" title="For the dance nerds :)">XML</a></p>
                </li>
                <li><p class="cal_name">Bronze Lessons Calendar</p>
                	<p class="link"><a class="bicalAddress cboxElement" href="#" title="Download ICal format">ICAL</a></p>
                    <p class="link"><a class="bhtmlAddress cboxElement" href="#" title="View in your browser">HTML</a></p>
                    <p class="link"><a class="bxmlAddress cboxElement" href="#" title="For the dance nerds :)">XML</a></p>
                </li>
                <li><p class="cal_name">Silver Lessons Calendar</p>
                	<p class="link"><a class="icalAddress cboxElement" href="#" title="Download ICal format">ICAL</a></p>
                    <p class="link"><a class="htmlAddress cboxElement" href="#" title="View in your browser">HTML</a></p>
                    <p class="link"><a class="xmlAddress cboxElement" href="#" title="For the dance nerds :)">XML</a></p>
                </li>
            <ul>
            </div>
        </div>
        	
	<?php //comments_template(); ?>
        <!--div id="saveSingleEvent" style="display:none;"><a href="http://www.google.com/calendar/event?action=TEMPLATE&text=Brunch%20at%20Java%20Cafe&dates=20100512T143000Z/20100512T153000Z&details=Try%20our%20Saturday%20brunch%20special&location=Java%20Cafe%2C%20San%20Francisco%2C%20CA&trp=false&sprop=www.charlottedancesport.org&sprop=name:Charlotte%20DanceSport" target="_blank"><img src="<?php //bloginfo('stylesheet_directory'); ?>/img/techno1.png"></a></div>
        <div id="saveAllEvents-Bronze" style="display:none;"><a href="http://www.google.com/calendar/render?cid=http%3A%2F%2Fwww.google.com%2Fcalendar%2Ffeeds%2Fcph68k4e3qu3rj173u2ja5q4rs%2540group.calendar.google.com%2Fpublic%2Fbasic" target="_blank"><img src="http://www.google.com/calendar/images/ext/gc_button1.gif" border=0></a></div-->

        <!-- General Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="gicalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic.ics"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="ghtmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com&ctz=America/New_York" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com&amp;ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="gxmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        <!-- Social Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="sicalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/vncka13u8deglvneft7d75rl4k%40group.calendar.google.com/public/basic.ics"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/vncka13u8deglvneft7d75rl4k%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="shtmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=vncka13u8deglvneft7d75rl4k%40group.calendar.google.com&ctz=America/New_York" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=vncka13u8deglvneft7d75rl4k%40group.calendar.google.com&amp;ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="sxmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/vncka13u8deglvneft7d75rl4k%40group.calendar.google.com/public/basic" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/vncka13u8deglvneft7d75rl4k%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        <!-- Newcomer Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="nicalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/4m4glve0mv97iob6l5sv113ueo%40group.calendar.google.com/public/basic.ics"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/4m4glve0mv97iob6l5sv113ueo%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="nhtmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=4m4glve0mv97iob6l5sv113ueo%40group.calendar.google.com&ctz=America/New_York" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=4m4glve0mv97iob6l5sv113ueo%40group.calendar.google.com&amp;ctz=America/New_Yorkk</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="nxmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/4m4glve0mv97iob6l5sv113ueo%40group.calendar.google.com/public/basic" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/4m4glve0mv97iob6l5sv113ueo%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        <!-- Bronze Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="bicalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com/public/basic.ics"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="bhtmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com&ctz=America/New_York" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com&amp;ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="bxmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com/public/basic" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        <!-- Silver Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="icalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com/public/basic.ics"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/ical/ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="htmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com&ctz=America/New_York" target="_blank"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/embed?src=ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com&amp;ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="xmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com/public/basic"><? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.google.com/calendar/feeds/ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        
	</div>

<?php get_sidebar("w-google-calendar"); ?>

<?php get_footer(); ?>
