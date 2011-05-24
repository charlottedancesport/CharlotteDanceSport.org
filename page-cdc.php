<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 */

get_header(); ?>

	<div id="content" class="narrowcolumn" role="main">

	<? switch ($_GET['p']) { 
		case "concise":
			$filename = 'concise_schedule.html';
			$height='630px';
			break;
		case "detailed":
			$filename = 'detailed_schedule.html';
			$height='4270px';
			break;
		case "officials":
			$filename = 'officials.html';
			$height='100%';//'3490px';
			break;
		case "rules_fees":
			$filename = 'rules.html';
			$height='100%';
			break;
		case "housing":
			$filename = 'housing.html';
			$height='1110px';
			break;
		case "sponsors":
			$filename = 'sponsors.html';
			$height='1350px';
			break;
		case "pictures":
			$filename = 'pictures.html';
			$height='480px';
			break;
		case "dance_locations":
			$filename = 'dance_locations.html';
			$height='1020px';
			break;
		default:
			$height='100%';//'1085px';
	    	break; ?>
	<? } ?>
    
		<div class="cds_info_wrapper" style="height:<? echo $height; ?>;">
        
    <? if( isset($filename) ) {
			if($filename != "dance_locations.html") {
				include 'cdc2011/'.$filename;
			} else { ?>
	<script>
	$(document).ready( function() {
		$('.cds_info_wrapper').append("<iframe src='http://"+document.domain+"/wp-content/themes/charlotte_dancesport/cdc2011/dance_location.html' frameborder='0' scrolling='yes' style='width:673px; height:1020px; border:0px;' >");
	});
	</script>
	<?		}
	
			if($filename == "rules.html") { ?>

	<script type="text/javascript" language="javascript">
	$(function(){
        $('.fees_link').click( function () {
            $.scrollTo($('#fees'),1000);
        });
        $('.pm_link').click( function () {
            $.scrollTo($('#pm'),1000);
        });
        $('.rp_link').click( function () {
            $.scrollTo($('#rp'),1000);
        });
        $('.rules_link').click( function () {
            $.scrollTo($('#rules'),1000);
        });
        $('.r_link').click( function () {
            $.scrollTo($('#r'),1000);
        });
        $('.l_link').click( function () {
            $.scrollTo($('#l'),1000);
        });
        $('.cp_link').click( function () {
            $.scrollTo($('#cp'),1000);
        });
        $('.sy_link').click( function () {
            $.scrollTo($('#sy'),1000);
        });$('.c_link').click( function () {
            $.scrollTo($('#c'),1000);
        });
        $('.dc_link').click( function () {
            $.scrollTo($('#dc'),1000);
        });
        $('.sva_link').click( function () {
            $.scrollTo($('#sva'),1000);
        });
        $('.seva_link').click( function () {
            $.scrollTo($('#seva'),1000);
        });
        $('.mi_link').click( function () {
            $.scrollTo($('#mi'),1000);
        });
        $('.top').click( function () {
            $.scrollTo($('#detailed_wrapper'),1000);
        });
	});
    </script>
    
<?			}
			if($filename == "concise_schedule.html") { ?>
	<script language="javascript" type="text/javascript">
	$(document).ready(function() {
		$('.time:odd').css("background","#99CC62");
		$('.event:odd').css("background","#dddddd");
	});
	</script>
<?			}
			if($filename == "housing.html") { ?>
	<script language="javascript" type="text/javascript">
	$(document).ready(function() {
		$('#free_housing')
		  .click( function() {
			window.open("https://spreadsheets.google.com/viewform?formkey=dDF6eXllcGlRaUVBUTIzVGxXdUZUdGc6MQ#gid=0",'_blank','menubar, toolbar, location, directories, status, scrollbars, resizable, dependent, left=0, top=0');
		  })
		  .hover( function() {$(this).css('background','#6699AA')},function() {$(this).css('background','#6699CC')});
		$('#housing_volunteer')
		  .click( function() {
			window.open("https://spreadsheets.google.com/viewform?formkey=dGpMd09CTXoyV0QxTEtWYWpCVkRRTFE6MQ",'_blank','menubar, toolbar, location, directories, status, scrollbars, resizable, dependent, left=0, top=0');
		  })
		  .hover( function() {$(this).css('background','#6699AA')},function() {$(this).css('background','#6699CC')});
	});
	</script>
<?			}
		} else { include "cdc2011/main.php"; } ?>

        </div>
    
	</div>

<?php get_sidebar('cdc'); ?>

<?php get_footer(); ?>
