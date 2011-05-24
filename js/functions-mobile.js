var GLOBAL_DATE = new Date();

/*==================================
 * Google Calendar API functionality
 *==================================*/
 
/* Loads the Google data JavaScript client library */
google.load('visualization', '1', {packages:['table']}); // Load Visualization API for Google Charts
google.load("gdata", "2.x");

function init_CDS_sideBarCalendarLinks()  {
  // init the Google data JS client library with an error handler
  google.gdata.client.init(handleGDError);
  // load the code.google.com developer calendar
  load_CDS_Sidebar_Calendar();
}

function load_CDS_Sidebar_Calendar() {
	loadSidebarCalendarByAddress('qd4u07691gh5c07jnuvbkmbgm4@group.calendar.google.com');
  //loadSidebarCalendarByAddress('charlottedancesport@gmail.com');
}

/**
 * Adds a leading zero to a single-digit number.  Used for displaying dates.
 */
function padNumber(num) {
  if (num <= 9) {
    return "0" + num;
  }
  return num;
}

/**
 * Get weekday abbreviation 
 *
 * @param dayEnum is the enumeration value (0-6) associated with the days of the
 * week (Sun-Sat) respectively
 */
function getWeekdayAbbreviation(dayEnum) {	
	switch(dayEnum)
	{
	case 0:
	  return 'Sun';
	  break;
	case 1:
	  return 'Mon';
	  break;
	case 2:
	  return 'Tue';
	  break;
	case 3:
	  return 'Wed';
	  break;
	case 4:
	  return 'Thu';
	  break;
	case 5:
	  return 'Fri';
	  break;
	case 6:
	  return 'Sat';
	  break;
	default:
	  return null;
	}
}
/**
 * Get weekday string (Sunday-Saturday) 
 *
 * @param dayEnum is the enumeration value (0-6) associated with the days of the
 * week (Sun-Sat) respectively
 */
function getWeekday(dayEnum) {	
	switch(dayEnum)
	{
	case 0:
	  return 'Sunday';
	  break;
	case 1:
	  return 'Monday';
	  break;
	case 2:
	  return 'Tuesday';
	  break;
	case 3:
	  return 'Wednesday';
	  break;
	case 4:
	  return 'Thursday';
	  break;
	case 5:
	  return 'Friday';
	  break;
	case 6:
	  return 'Saturday';
	  break;
	default:
	  return null;
	}
}

/**
 * Get month name string (January-December) 
 *
 * @param monthEnum is the enumeration value (0-11) associated with the months of the
 * year (Janurary-December) respectively
 */
function getMonthName(monthEnum) {	
	switch(monthEnum)
	{
	case 0:
	  return 'January';
	  break;
	case 1:
	  return 'February';
	  break;
	case 2:
	  return 'March';
	  break;
	case 3:
	  return 'April';
	  break;
	case 4:
	  return 'May';
	  break;
	case 5:
	  return 'June';
	  break;
	case 6:
	  return 'July';
	  break;
	case 7:
	  return 'August';
	  break;
	case 8:
	  return 'September';
	  break;
	case 9:
	  return 'October';
	  break;
	case 10:
	  return 'November';
	  break;
	case 11:
	  return 'December';
	  break;
	default:
	  return null;
	}
}

/**
 * Get month abbreviation 
 *
 * @param monthEnum is the enumeration value (0-11) associated with the months of the
 * year (Jan-Dec) respectively
 */
function getMonthNameAbbreviation(monthEnum) {	
	switch(monthEnum)
	{
	case 0:
	  return 'Jan';
	  break;
	case 1:
	  return 'Feb';
	  break;
	case 2:
	  return 'Mar';
	  break;
	case 3:
	  return 'Apr';
	  break;
	case 4:
	  return 'May';
	  break;
	case 5:
	  return 'Jun';
	  break;
	case 6:
	  return 'Jul';
	  break;
	case 7:
	  return 'Aug';
	  break;
	case 8:
	  return 'Sept';
	  break;
	case 9:
	  return 'Octr';
	  break;
	case 10:
	  return 'Novr';
	  break;
	case 11:
	  return 'Dec';
	  break;
	default:
	  return null;
	}
}

/**
 * Convert from 24 to 12 hour clock 
 *
 * @param hour is the value (0-24)
 */
function convert24To12Clock(hour) {	
	return (hour>12) ? hour-12 :  hour;  
}

/**
 * Gets the date (DD) of the first day of the current week (i.e. Sunday)
 */
function getSunday() {
		var currentDay = new Date();
		// Get the day of the week for today
		var thisDay = currentDay.getDay();
		// Get Sundays date by subtracting the
		// current day of the week from todays date
		var sunDay = currentDay.getDate() - (thisDay);
		return sunDay;
}

/**
 * Returns the full Java Date() object for the first day of the current
 * week (i.e. Sunday)
 */
function getSundayDate() {
		var currentDay = new Date();
		currentDay.setDate(getSunday());
		
		return currentDay; //currentDay.getFullYear() + "-" + (currentDay.getMonth() + 1) + "-" + getSunday();
		
} 

/**
 * Gets the date (DD) of the last day of the current week (i.e. Saturday)
 */
function getSaturday() {
		var currentDay = new Date();
		// Get the day of the week for today
		var thisDay = currentDay.getDay();
		
		// Get Saturdays date by adding the
		// (6 minus the current day of the week)
		var satDay = currentDay.getDate() + (6-thisDay);
		
		return satDay;
}

/**
 * Returns the full Java Date() object for the last day of the current
 * week (i.e. Saturday)
 */
function getSaturdayDate() {
		var currentDay = new Date();
		currentDay.setDate(getSaturday());
						   
		return currentDay; //currentDay.getFullYear() + "-" + (currentDay.getMonth() + 1) + "-" + getSaturday();
} 


/**
 * Determines the full calendarUrl based upon the calendarAddress
 * argument and calls loadCalendar with the calendarUrl value.
 *
 * @param {string} calendarAddress is the email-style address for the calendar
 */ 
function loadSidebarCalendarByAddress(calendarAddress) {
  var calendarUrl = 'http://www.google.com/calendar/feeds/' + calendarAddress + '/public/full';
  loadCurrentMonth(calendarUrl);
}

/**
 * Uses Google data JS client library to retrieve a calendar feed from the specified
 * URL.  The feed is controlled by several query parameters and a callback 
 * function is called to process the feed results.
 *
 * @param {string} calendarUrl is the URL for a public calendar feed
 */  
function loadCalendar(calendarUrl) {
  var todaysDate = new Date();
  var startDateTime = new google.gdata.DateTime(new Date(todaysDate.getFullYear(), todaysDate.getMonth(), todaysDate.getDate()));
  var service = new google.gdata.calendar.CalendarService('CharlotteDanceSport-GoogleCals-1.0');
  var query = new google.gdata.calendar.CalendarEventQuery(calendarUrl);
  query.setOrderBy('starttime');
  query.setSortOrder('ascending');
  query.setMinimumStartTime(startDateTime);
  query.setFutureEvents(false);
  query.setSingleEvents(true);
  query.setMaxResults(7);

  service.getEventsFeed(query, listEvents, handleGDError);
}

/**
 * Retrieve the next upcoming event from Google API
 * Uses Google data JS client library to retrieve a calendar feed from the specified
 * URL.  The feed is controlled by several query parameters and a callback 
 * function is called to process the feed results.
 *
 * @param {string} calendarUrl is the URL for a public calendar feed
 */  
function loadNextEvent(calendarUrl) {
  var todaysDate = new Date();
  var startDateTime = new google.gdata.DateTime(new Date(todaysDate.getFullYear(), todaysDate.getMonth(), todaysDate.getDate()));
  var service = new google.gdata.calendar.CalendarService('CharlotteDanceSport-GoogleCals-1.0');
  var query = new google.gdata.calendar.CalendarEventQuery(calendarUrl);
  query.setOrderBy('starttime');
  query.setSortOrder('ascending');
  query.setMinimumStartTime(startDateTime);
  query.setFutureEvents(false);
  query.setSingleEvents(true);
  query.setMaxResults(1);

  service.getEventsFeed(query, nextEvent, handleGDError);
}

/*=====================
 * Retrieve Current Month of events from Google Calendar API
 * Uses Google data JS client library to retrieve a calendar feed from the specified
 * URL.  The feed is controlled by several query parameters and a callback 
 * function is called to process the feed results.
 *
 * @param {string} calendarUrl is the URL for a public calendar feed
 */
function loadCurrentMonth(calendarUrl) {
	//var d = new Date();
	var days_in_month = cal_days_in_month(GLOBAL_DATE.getMonth(), GLOBAL_DATE.getFullYear());
	var startDateTime = new google.gdata.DateTime(new Date(GLOBAL_DATE.getFullYear(), GLOBAL_DATE.getMonth(), 1));
	var endDateTime = new google.gdata.DateTime(new Date(GLOBAL_DATE.getFullYear(), GLOBAL_DATE.getMonth(), days_in_month+1));
	var service = new google.gdata.calendar.CalendarService('CharlotteDanceSport-GoogleCals-1.0');
	var query = new google.gdata.calendar.CalendarEventQuery(calendarUrl);
	query.setOrderBy('starttime');
	query.setSortOrder('ascending');
	query.setMinimumStartTime(startDateTime);
	query.setMaximumStartTime(endDateTime);
	query.setFutureEvents(false);
	query.setSingleEvents(true);
	query.setMaxResults(days_in_month);
	
	service.getEventsFeed(query, currentMonthsListEvents, handleGDError);
}

/**
 * Callback function for the Google data JS client library to call when an error
 * occurs during the retrieval of the feed.  Details available depend partly
 * on the web browser, but this shows a few basic examples. In the case of
 * a privileged environment using ClientLogin authentication, there may also
 * be an e.type attribute in some cases.
 *
 * @param {Error} e is an instance of an Error 
 */
function handleGDError(e) {
  document.getElementById('jsSourceFinal').setAttribute('style', 'display:none');
}

/**
 * Callback function for the Google data JS client library to call with a feed 
 * of the current months events retrieved.
 *
 * Adds hyperlinks to the sidebar calendar for days with google calendar events.
 *
 * @param {json} feedRoot is the root of the feed, containing all entries 
 */ 
function currentMonthsListEvents(feedRoot) {
  var entries = feedRoot.feed.getEntries();

  /* loop through each event in the feed */

  var len = entries.length;
  
  for (var i = 0; i < len; i++) {
    var entry = entries[i];
    var title = entry.getTitle().getText();
    var startDateTime = null;
    var startJSDate = null;
	var endDateTime = null;
	var endJSDate = null;
    var times = entry.getTimes();

    if (times.length > 0) {
      startDateTime = times[0].getStartTime();
      startJSDate = startDateTime.getDate();
	  endDateTime = times[0].getEndTime();
	  endJSDate = endDateTime.getDate();
    }
	
    if (entry.getHtmlLink() != null) {
	  // Get the calendar table cell for this date
	  var dateTD = document.getElementById('d'+(startJSDate.getDate()));
	  
	  // Clear the table cell of current text
	  if (dateTD.childNodes.length > 0) {
		dateTD.removeChild(dateTD.childNodes[0]);
	  }	
	  
	  // add <a> tag with hyperlink to Google Cal event on the days number.
	  var a = document.createElement('a');
	  a.setAttribute('href', entry.getHtmlLink().getHref());
	  a.setAttribute('target', "_blank");
	  a.appendChild(document.createTextNode(startJSDate.getDate()));
	  dateTD.appendChild(a);
    }
	
  }
  $(document).ready(function() {
	var today = new Date();
	if (today.getMonth() == GLOBAL_DATE.getMonth() && today.getFullYear() == GLOBAL_DATE.getFullYear()){
  		$('#d'+today.getDate()).addClass('current_day_bg');
	}
  });
}

/**
 * Callback function for the Google data JS client library to call with a feed 
 * of the current months events retrieved.
 *
 * Adds hyperlinks to the sidebar calendar for days with google calendar events.
 *
 * @param {json} feedRoot is the root of the feed, containing all entries 
 */ 
function nextEvent(feedRoot) {
	var entries = feedRoot.feed.getEntries();
	var div = document.getElementById('nextEventDetails');
	
	if(entries.length > 0) {
		var entry = entries[0];
		var title = entry.getTitle().getText();
		var startDateTime = null;
		var startJSDate = null;
		var times = entry.getTimes();
		
		if (times.length > 0) {
			startDateTime = times[0].getStartTime();
			startJSDate = startDateTime.getDate();
		}
		
		//get start time for event
		var startTime = convert24To12Clock(startJSDate.getHours()) + ":" + padNumber(startJSDate.getMinutes()) + ((startJSDate.getHours()>=12) ? "PM" : "AM");
		
		if(entry.getHtmlLink() != null) {
			var p = document.createElement('p');
			var a = document.createElement('a');
			a.setAttribute('href', entry.getHtmlLink().getHref());
			a.appendChild(document.createTextNode(title +" - "+ getWeekday(startJSDate.getDay()) +", "+ getMonthNameAbbreviation(startJSDate.getMonth()) +" "+ startJSDate.getDate() +" @ "+ startTime));
			p.appendChild(a);
			div.appendChild(p);
		} else {
			var p = document.createElement('p');
			p.appendChild(document.createTextNode(title +" - "+ getWeekday(startJSDate.getDay()) +", "+ getMonthNameAbbreviation(startJSDate.getMonth()) +" "+ startJSDate.getDate() +" @ "+ startTime));
			p.appendChild(a);
			div.appendChild(p);
		}
		
	} else {
		var p = document.createElement('p');
		p.appendChild(document.createTextNode("NO UPCOMING EVENTS - Updates coming soon!"));
		div.appendChild(p);
	}

}


function cal_days_in_month(iMonth, iYear)
{
	return 32 - new Date(iYear, iMonth, 32).getDate();
}

function get_google_calendar_body(m, d, y) {
	//This stores the past date in GLOBAL_DATE for future use
	if( !(m==null) && !(d==null) && !(y==null)){
		GLOBAL_DATE.setMonth(m);
		GLOBAL_DATE.setDate(d);
		GLOBAL_DATE.setFullYear(y);
	}
	
	//Here we generate the first day of the month
	var first_day = new Date(GLOBAL_DATE.getFullYear(), GLOBAL_DATE.getMonth(), 1) ; 
	
	//Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero
	var blank = first_day.getDay() ;
	
	//We then determine how many days are in the current month
	var days_in_month = cal_days_in_month(GLOBAL_DATE.getMonth(), GLOBAL_DATE.getFullYear()) ; 
	
	// Create and array for holding 5 <tr> objects representing the calendar weeks
	var row = new Array()
	for (var i=0; i<6; i++){
		row[i] = document.createElement('tr');
	}
	
	
	//Here we start building the calendars body 
	var bodyDiv = document.getElementById('calendarBody');

	//clear <div> first of prior calendar if need be
	if (bodyDiv.childNodes.length > 0) {
    	bodyDiv.removeChild(bodyDiv.childNodes[0]);
  	}
	
	var table = document.createElement('table');
	table.setAttribute('border', 0);
	bodyDiv.appendChild(table);
	
	
	var tr = document.createElement('tr');
	table.appendChild(tr);

	//This counts the days in the week, up to 7
	var day_count = 1;
	
	table.appendChild(row[0]);
	
	//first we take care of those blank days
	while ( blank > 0 ) 
	{ 
		row[0].appendChild(document.createElement('td')); 
		blank = blank-1; 
		day_count++;
	} 
	
	//sets the first day of the month to 1 
	var day_num = 1;
	
	// sets the current calendar row being generated
	var calendar_row = 0;
	//count up the days, until we've done all of them in the month
	while ( day_num <= days_in_month ) 
	{ 
		var td = document.createElement('td');
		td.appendChild(document.createTextNode(day_num));
		td.setAttribute('id', "d"+day_num);
		td.setAttribute('class', "single_day");
		row[calendar_row].appendChild(td); 
		day_num++; 
		day_count++;
		
		//Make sure we start a new row every week
		if (day_count > 7)
		{
			table.appendChild(row[++calendar_row]);
			day_count = 1;	
		}
	} 
	
	//Finaly we finish out the table with some blank details if needed
	while ( day_count >1 && day_count <=7 ) 
	{ 
		var td = document.createElement('td');
		row[calendar_row].appendChild(td); 
		day_count++; 
	} 
}

function get_google_calendar_header(){
	//This gets us the month name
	var title = getMonthName(GLOBAL_DATE.getMonth()) ;
	
	//Here we start building the calendars heads 
	var headerDiv = document.getElementById('calendarHeader');
	
	
	var table = document.createElement('table');
	headerDiv.appendChild(table);
	
	var tr = document.createElement('tr');
	table.appendChild(tr);
	
	var th = document.createElement('th');
	tr.appendChild(th);
	
	var a = document.createElement('a');
	a.setAttribute('class', "previousCalendarArrow");
	a.setAttribute('title', "Previous");
	a.setAttribute('href', "#");
	th.appendChild(a);
	
	var div = document.createElement('div');
	div.setAttribute('class', "previousCalendar");
	a.appendChild(div);
	
	var div2 = document.createElement('div');
	div2.setAttribute('id', "monthName");
	div2.appendChild(document.createTextNode(title + " " + GLOBAL_DATE.getFullYear()));
	th.appendChild(div2);
	
	var a1 = document.createElement('a');
	a1.setAttribute('class', 'nextCalendarArrow');
	a1.setAttribute('title', "Next");
	a1.setAttribute('href', "#");
	th.appendChild(a1);
	
	var div1 = document.createElement('div');
	div1.setAttribute('class', "nextCalendar");
	a1.appendChild(div1);
	
	var tr1 = document.createElement('tr');
	table.appendChild(tr1);
	
	// Display wekeday column headers
/*	for (var i = 0; i < 7; i++) {
		var td = document.createElement('td');
		td.setAttribute('width', "42");
		td.appendChild(document.createTextNode((getWeekday(i)).charAt(0)));
		tr1.appendChild(td);
	}
*/
}

