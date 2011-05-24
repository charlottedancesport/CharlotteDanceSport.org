<?php
/**
 * @package WordPress
 * @subpackage Charlotte_DanceSport_Theme
 * Template Name: Coaches
 */

get_header(); ?>

	<div id="content" class="narrowcolumn" role="main">
        <div class="bio">
            <div class="coach_details">
                <div class="coach_details_wrapper">
                    <div>
                        <div class="coach_photo_wrapper"><div class="wayne_img"></div></div>
                    </div>
                </div>
            </div>
            <div class="white_left_arrow"></div>
            <div class="coach_bio">
                <div class="coach_bio_wrapper">
                <h2><? if (!isset($_SERVER['HTTPS'])) { ?><a href="http://www.crowderdancesport.com/">Wayne Crowder</a><? } else { echo "Wayne Crowder"; } ?></h2>
                <p>Wayne is a four time USA Dance Amateur Champion in Latin and a 3-time USA representative to the IDSF World Latin Championships which were held in Belgium, Spain and Italy.  Wayne has won numerous Regional Standard and Latin Championship titles and was a Standard finalist in the USA DanceSport National Championships.</p>
                
                <p>Wayne is a Championship Adjudicator and a proud member of the <a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.usistd.org/" target="_blank">Imperial Society of Teachers of Dancing</a> (ISTD), with the following degrees:</p>
                
                <p>
                    <ul>
                        <li>Licentiate International Standard</li>
                        <li>Licentiate International Latin</li>
                        <li>Licentiate American Smooth</li>
                        <li>Licentiate American Rhythm</li>
                    </ul>
                </p>
                
                <p>Wayne also serves on the National Committee of the United States Imperial Society of Teachers of Dancing, as well as a Dancesport Council member of USA Dance.</p>
                </div>
                
            </div>
        </div>
        
        <div class="bio">
            <div class="coach_details">
                <div class="coach_details_wrapper">
                    <div>
                        <div class="coach_photo_wrapper"><div class="marie_img"></div></div>
                    </div>
                </div>
            </div>
            <div class="white_left_arrow"></div>
            <div class="coach_bio">
                <div class="coach_bio_wrapper">
                <h2><? if (!isset($_SERVER['HTTPS'])) { ?><a href="http://www.crowderdancesport.com/">Marie Crowder</a><? } else { echo "Marie Crowder"; } ?></h2>
                <p>Marie is a four time USA Dance Amateur Champion in Latin and a 3-time USA representative to the IDSF World Latin Championships which were held in Belgium, Spain and Italy.  Marie has won numerous Regional Standard and Latin Championship titles and was a Standard finalist in the USA DanceSport National Championships.</p>
                
                <p>Marie is a proud member of the <a href="<? echo (isset($_SERVER['HTTPS'])) ? "https" : "http"; ?>://www.usistd.org/" target="_blank">Imperial Society of Teachers of Dancing</a> (ISTD), with the following degrees:</p>
                
                <p>
                    <ul>
                        <li>Associate International Standard</li>
                        <li>Licentiate International Latin</li>
                        <li>Licentiate American Smooth</li>
                        <li>Licentiate American Rhythm</li>
                    </ul>
                </p>
                
                <p>Marie also serves as Membership Services Director of the United States Imperial Society of Teachers of Dancing and is a Regional Coordinator for USA Dance.</p>
                </div>
                
            </div>
        </div>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
