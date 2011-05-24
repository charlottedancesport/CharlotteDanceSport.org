<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 * Template Name: Dances
 */

get_header(); ?>

	<div id="content" class="narrowcolumn" role="main">
        <div class="bio">
            <div class="coach_details">
                <div class="coach_details_wrapper">
                    <div>
                        <div class="coach_photo_wrapper"><div id="dance_img"></div></div>
                    </div>
                </div>
            </div>
            <div class="white_left_arrow"></div>
            <div class="coach_bio">
            
                <div class="coach_bio_wrapper">
                	<div class="a-b">Referenced from <a href="http://www.wikipedia.com">Wikipedia.com</a></div>
                	<div id="wiki_container"></div>
                </div>
                
            </div>
        </div>
	</div>
	
    <script type="text/javascript">
		$(document).ready( function () {
			var randomDance = $("#dances_banner li").get(Math.floor(Math.random()*$("#dances_banner li").size()));
			
			$("#dance_img").removeClass( ( $(this).parents('ul').hasClass("standard_list") ) ? "latin_dancers_img" : "standard_dancers_img");
			$("#dance_img").addClass( ( $(randomDance).parents('ul').hasClass("standard_list") ) ? "standard_dancers_img" : "latin_dancers_img");
			
			getAreaMetaInfo_Wikipedia( $(randomDance).find('span:first').text() );
		});
    </script>
    
<?php get_sidebar(); ?>

<?php get_footer(); ?>
