<html>
<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/style-mobile.css" rel="stylesheet" type="text/css" />
<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/homescreen.png"/>
<link href="<?php bloginfo('stylesheet_directory'); ?>/startup.png" rel="apple-touch-startup-image" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.4.2");
</script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/functions-mobile.js" type="text/javascript"></script>
</head>
<body>
<div id="header">
	<div>Charlotte DanceSport</div>
    <ul>
    	<li><a href="<?php thisURL(); ?>/m/news/">News</a></li>
        <li><span>Calendar</span></li>
        <li><a href="<?php thisURL(); ?>/m/photos/">Photos</a></li>
        <li><a href="#">more</a></li>
    </ul>
    <div><span><a href="<?php thisURL(); ?>/m/">Home</a></span></div>
</div>
<div id="content">
	<div id="calender-block">
    	<ul><li>Next Event:</li></ul>
        <ul>
            <li>
            <div id="google_calendar_container">
                <div id="calendarHeader"></div>
                <div>S M T W T F S</div>
                <div id="calendarBody"></div>
            </div>
            </li>
        </ul>
        <script type="text/javascript">
			// display sidebar calendar
			get_google_calendar_header();
			get_google_calendar_body();
			google.setOnLoadCallback(init_CDS_sideBarCalendarLinks);
		</script>
	</div>
	<div id="select-day-events"></div>
</div>
        <div id="footer">
	    <p>View CDS in <b>Mobile</b> | <a href="">Desktop</a></p>
            <p>&copy; 2010 Charlotte DanceSport</p>
            <p>d/b/a/ 49er Social &amp; Ballroom Dance Club</p>
            <p>@ UNC-Charlotte</p>
        </div>
</body>
</html>

<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 * Template Name: Calendar
 */
/*
get_header(); ?>
 
	<div id="content" class="narrowcolumn" role="main">
    	<div id="nextEvent">
        	<div id="nextEventHeader"><p>Next Event:</p></div>
            <div id="nextEventArrow"></div>
            <div id="nextEventDetails"></div>
        </div>
        
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
            	<li><p class="cal_name">Charlotte DanceSport Events Calendar</p>
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
        <div id="saveSingleEvent" style="display:none;"><a href="http://www.google.com/calendar/event?action=TEMPLATE&text=Brunch%20at%20Java%20Cafe&dates=20100512T143000Z/20100512T153000Z&details=Try%20our%20Saturday%20brunch%20special&location=Java%20Cafe%2C%20San%20Francisco%2C%20CA&trp=false&sprop=www.charlottedancesport.org&sprop=name:Charlotte%20DanceSport" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/techno1.png"></a></div>
        <div id="saveAllEvents-Bronze" style="display:none;"><a href="http://www.google.com/calendar/render?cid=http%3A%2F%2Fwww.google.com%2Fcalendar%2Ffeeds%2Fcph68k4e3qu3rj173u2ja5q4rs%2540group.calendar.google.com%2Fpublic%2Fbasic" target="_blank"><img src="http://www.google.com/calendar/images/ext/gc_button1.gif" border=0></a></div>

        <!-- General Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="gicalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="http://www.google.com/calendar/ical/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic.ics">http://www.google.com/calendar/ical/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="ghtmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="http://www.google.com/calendar/embed?src=qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com&ctz=America/New_York" target="_blank">http://www.google.com/calendar/embed?src=qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com&amp;ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="gxmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="http://www.google.com/calendar/feeds/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic" target="_blank">http://www.google.com/calendar/feeds/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        <!-- Social Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="sicalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="http://www.google.com/calendar/ical/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic.ics">http://www.google.com/calendar/ical/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="shtmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="http://www.google.com/calendar/embed?src=qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com&ctz=America/New_York" target="_blank">http://www.google.com/calendar/embed?src=qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com&amp;ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="sxmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="http://www.google.com/calendar/feeds/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic" target="_blank">http://www.google.com/calendar/feeds/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        <!-- Newcomer Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="nicalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="http://www.google.com/calendar/ical/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic.ics">http://www.google.com/calendar/ical/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="nhtmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="http://www.google.com/calendar/embed?src=qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com&ctz=America/New_York" target="_blank">http://www.google.com/calendar/embed?src=qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com&amp;ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="nxmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="http://www.google.com/calendar/feeds/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic" target="_blank">http://www.google.com/calendar/feeds/qd4u07691gh5c07jnuvbkmbgm4%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        <!-- Bronze Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="bicalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="http://www.google.com/calendar/ical/cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com/public/basic.ics">http://www.google.com/calendar/ical/cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="bhtmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="http://www.google.com/calendar/embed?src=cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com&ctz=America/New_York" target="_blank">http://www.google.com/calendar/embed?src=cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com&ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="bxmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="http://www.google.com/calendar/feeds/cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com/public/basic" target="_blank">http://www.google.com/calendar/feeds/cph68k4e3qu3rj173u2ja5q4rs%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
        
        <!-- Silver Charlotte DanceSport Calendar Links -->
        <div style="display:none;">
            <div id="icalCalendarAddress">
                <h4>iCal Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any calendar product that supports the iCal format.</p>
                <p><a href="http://www.google.com/calendar/ical/ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com/public/basic.ics">http://www.google.com/calendar/ical/ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com/public/basic.ics</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="htmlCalendarAddress">
                <h4>HTML Calendar Address</h4>
                <p>Please use the following address to access your calendar in any web browser. </p>
                <p><a href="http://www.google.com/calendar/embed?src=ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com&ctz=America/New_York" target="_blank">http://www.google.com/calendar/embed?src=ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com&ctz=America/New_York</a></p>
            </div>
        </div>
        <div style="display:none;">
            <div id="xmlCalendarAddress">
                <h4>XML Calendar Address</h4>
                <p>Please use the following address to access your calendar from other applications. You can copy and paste this into any feed reader.</p>
                <p><a href="http://www.google.com/calendar/feeds/ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com/public/basic">http://www.google.com/calendar/feeds/ptgo7vr09a178va9kn8gtqk9e0%40group.calendar.google.com/public/basic</a></p>
            </div>
        </div>
       
        
	</div>

<?php get_sidebar("w-google-calendar"); ?>

<?php get_footer(); ?>
 */?>
