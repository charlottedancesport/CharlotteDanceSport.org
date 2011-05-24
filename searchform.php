<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */
?>

<div id="searchform" > 
    <div>
      <label class="screen-reader-text" for="s">Search for:</label> 
      <div id="s"></div>
      <div id="searchsubmit"></div> 
    </div> 
</div>
			
<script type="text/javascript" language="javascript">
/**
 * Creates the website Search form
 * Uses JQuery -A Better Form- library to convert hardcorded <div>'s to form elements.
 * Purpose: Fullproof agent to deter form submission SPAM generators
 */
jQuery(document).ready(function () {
    $("#searchform").abform({
        attributes :'name="searchform" id="searchform" action="<?php thisURL(); ?>/" method="get"',
        convert :'{s|text|class="blurred"}{searchsubmit|submit|class="absubmit jpg_search_icon"}'
    });

	/**
	 * Handle some quirking issues with IE and Opera browers :(
	 */
	if ((navigator.appName.indexOf("Explorer") >= 0) ||
		(navigator.appName.indexOf("Opera") >=0)){
		
		// Handle sidebar search form for IE & Opera
		
		$('#sidebar #searchsubmit').addClass("png_search_icon")
		.hover(
			function () {
				$(this).removeClass("png_search_icon").addClass("png_search_icon_hover");
			}, 
			function () {
				$(this).removeClass("png_search_icon_hover").addClass("png_search_icon");
			}
		);
		
		// Place the words 'What are you seeking?' in the search input box
		
		$('#searchform #s').autofill({
			value: '',
			defaultBackgroundImage: 'url(<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://'+document.domain+'/wp-content/themes/charlotte_dancesport/img/cds_search_placeholder.png)',
			activeBackgroundImage: 'url(<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://'+document.domain+'/wp-content/themes/charlotte_dancesport/img/cds_search_placeholder_active_bg.png)'
		});
	
	
	} else {
		
		// Handle sidebar search styling for all other browers
		
		$('#sidebar #searchsubmit').addClass("jpg_search_icon")
		.hover(
			function () {
				$(this).removeClass("jpg_search_icon").addClass("jpg_search_icon_hover");
			}, 
			function () {
				$(this).removeClass("jpg_search_icon_hover").addClass("jpg_search_icon");
			}
		);
		
		// Place the words 'What are you seeking?' in the search input box
		
		$('#searchform #s').autofill({
			value: '',
			defaultBackgroundImage: 'url(<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://'+document.domain+'/wp-content/themes/charlotte_dancesport/img/cds_search_placeholder.png)',
			activeBackgroundImage: 'url(<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://'+document.domain+'/wp-content/themes/charlotte_dancesport/img/cds_search_placeholder_active_bg.png)'
		});
			
	
	}

	$('#searchform #s').keypress( function (event) {
		var char_Code = (event.which) ? event.which : event.keyCode;
		
		if(char_Code === 13) {
			$('#searchform #searchsubmit').click();
		} else {	
			return true;
		}
	});

});
</script>
