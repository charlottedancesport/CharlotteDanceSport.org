// JavaScript Document

/*
 * JQuery for all colorbox effects
 */
$(document).ready(function(){
	//$('.gallery a:has(img)').colorbox();
	//$(".colorbox").colorbox();
	
	$(".entry_wrapper a:has(img)").colorbox();
	$(".ajaxlogin").colorbox({
		width:425, 
		height:295, 
		scrolling:false, 
		/*inline:true, */
		title:"CDS Account Log In", 
		/*href:"#lightboxLogin",*/
		iframe:true
		/*onComplete:function(){try{document.getElementById('lwa_user_login').focus();}catch(e){}}*/
		});
	$("#LoginWithAjax_Links_Remember").colorbox({
		width:425, 
		height:400, 
		scrolling:false,
		iframe:true
		//inline:true, 
		//href:"#lightboxLogin"
		});
	$("#LoginWithAjax_Links_Remember_Cancel").colorbox({
		width:425, 
		height:285, 
		scrolling:false,
		iframe:true,
		//inline:true, 
		title:"CDS Account Log In" 
		//href:"#lightboxLogin"
		});
	// Membership Dues lightbox
//	$(".membership_dues").colorbox({width:"80%", height:"80%", iframe:true});
//	$(".buzz2").parent().colorbox({width:"80%", height:"80%", iframe:true});
//	$(".face2").parent().colorbox({width:"80%", height:"80%", iframe:true});
	$(".you2").parent().colorbox({width:"80%", height:"80%", iframe:true});
	$(".feed2").parent().colorbox({width:"80%", height:"80%", iframe:true});
//	$(".twit2").parent().colorbox({width:"80%", height:"80%", iframe:true});
	$(".reddit2").parent().colorbox({width:"80%", height:"80%", iframe:true});
//	$(".deli2").parent().colorbox({width:"80%", height:"80%", iframe:true});
	
	$(".donate_to_cds").colorbox({width:"80%", height:"80%", iframe:true});
	
	$("a[rel='locations']").colorbox({transition:"fade"});
	$("a[rel='member_dues']").colorbox({width:770, height:595, iframe:true});
	
	$(".contactus").colorbox({
		width:425, 
		height:510, 
		scrolling:false, 
		iframe:true
		});
	$(".suggest_a_tip_txt").colorbox({
		width:425, 
		height:450, 
		scrolling:false, 
		iframe:true
		});
	// Lightbox for syncing General CDS Google Calendar
	$(".gicalAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#gicalCalendarAddress"});
    $(".ghtmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#ghtmlCalendarAddress"});
    $(".gxmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#gxmlCalendarAddress"});
	// Lightbox for syncing Social Lessons Google Calendar
	$(".sicalAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#sicalCalendarAddress"});
    $(".shtmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#shtmlCalendarAddress"});
    $(".sxmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#sxmlCalendarAddress"});
	// Lightbox for syncing Newcomer Lessons Google Calendar
	$(".nicalAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#nicalCalendarAddress"});
    $(".nhtmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#nhtmlCalendarAddress"});
    $(".nxmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#nxmlCalendarAddress"});
	// Lightbox for syncing Bronze Lessons Google Calendar
	$(".bicalAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#bicalCalendarAddress"});
    $(".bhtmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#bhtmlCalendarAddress"});
    $(".bxmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#bxmlCalendarAddress"});
	// Lightbox for syncing Silver Lessons Google Calendar
	$(".icalAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#icalCalendarAddress"});
    $(".htmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#htmlCalendarAddress"});
    $(".xmlAddress").colorbox({width:"80%", height:150, inline:true, scrolling:false, href:"#xmlCalendarAddress"});
	
	
});

/*
 * JQuery for loading the top banner animator & top navigation bar
 */
$(window).load(function() {
	var total = $('#headerSlide img').length;
	var rand = Math.floor(Math.random()*total); // Randomly select a starting banner image
	$("#headerSlide").nivoSlider({
		startSlide:rand,
		effect:'fade',
		animSpeed:500,
		pauseTime:15000,
		captionOpacity:0.8
	});
	
	$(window).scroll(function () { 
		if ($(this).scrollTop() >= 218) {
			$("#top_navigation_wrapper").removeClass('top_nav_absolute').addClass('top_nav_fixed');
			$("#top_nav_extension").removeClass('top_nav_ext_absolute').addClass('top_nav_ext_fixed');
		}
		if ($(this).scrollTop() < 218) {
			$("#top_navigation_wrapper").removeClass('top_nav_fixed').addClass('top_nav_absolute');
			$("#top_nav_extension").removeClass('top_nav_ext_fixed').addClass('top_nav_ext_absolute');
		}
	});

});

/**
 * Handle some quirking issues with IE and Opera browers :(
 */
if ((navigator.appName.indexOf("Explorer") >= 0) ||
	(navigator.appName.indexOf("Opera") >=0)){
	
	// Handle sidebar search form for IE & Opera
	$(document).ready(function(){
		$('#sidebar #searchsubmit').addClass("png_search_icon")
		.hover(
			function () {
				$(this).removeClass("png_search_icon").addClass("png_search_icon_hover");
			}, 
			function () {
				$(this).removeClass("png_search_icon_hover").addClass("png_search_icon");
			}
		);

	});
} else {
	
	// Handle sidebar search styling for all other browers
	$(document).ready(function() {
		$('#sidebar #searchsubmit').addClass("jpg_search_icon")
		.hover(
			function () {
				$(this).removeClass("jpg_search_icon").addClass("jpg_search_icon_hover");
			}, 
			function () {
				$(this).removeClass("jpg_search_icon_hover").addClass("jpg_search_icon");
			}
		);
		$('#searchform #s').autofill({
			value: '',
			defaultBackgroundImage: 'url(http://'+document.domain+'/wp-content/themes/charlotte_dancesport/img/cds_search_placeholder.png)',
			activeBackgroundImage: 'url(http://'+document.domain+'/wp-content/themes/charlotte_dancesport/img/cds_search_placeholder_active_bg.png)'
		});
		
	});
}

/*
 * Preload images to the DOM tree that are used for rollovers/hover effects
 */
function PreloadImg(){
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/comments_bg.jpg");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/comments_bg.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/comments_long_bg.jpg");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/face2.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/gbuzz2.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/feed2.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/digg2.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/reddit2.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/deli2.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/youtube2.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/cds_search_placeholder_active_bg.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/cds_search_placeholder_active_bg.jpg");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/cds_search_button_icon_hover.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/cds_search_button_icon_hover.jpg");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/cds_bg.jpg");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/comments_bubbles.jpg");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/comments_bubbles.png");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/cds_comments_wrapper_bg.jpg");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/cds_gravatar_bg.jpg");
		$.ImagePreload("http://"+document.domain+"/wp-content/themes/charlotte_dancesport/green_alert_images/cds2010_alert1.jpg");
	}
$(document).ready(function () {
	PreloadImg();
});

/*
 * Extra login form check.  If the form is submitted empty return a message to the user
 */
$(document).ready(function (){
	$('#lwa_wp-submit').submit( function () {
		if ($('#lwa_user_login').val() === "" && $('#lwa_user_pass').val() === "") {
			$('#LoginWithAjax_Status').text("Please enter your e-mail and password.");
		}
	});
});

/*
 * JQuery for expandable sidebar menus & calendar sync links!
 */
$(document).ready(function () {
	$("ul.membership_submenu li:even").addClass("alt");
	$('li.membership_dues').click(function () {
		$('ul.membership_submenu').slideToggle('fast');
	});

	$("#syncCalendars div.calHeaders").click(function() {
		$('ul.calendar_link_list').slideToggle('fast');
	});
});

/*
 * JQuery for CDS sidebar menu
 */
$(document).ready( function() {
	$('#concise_schedule').click(function() {
	  $('.cds_info_wrapper')
	      .empty()
		  .animate({
			height: '630px'
		  }, 700, function() {
			// Animation complete.
			$.ajax({
			  url: 'http://'+document.domain+'/wp-content/themes/charlotte_dancesport/cdc2011/concise_schedule.html',
			  dataType: "html",
			  success: function(data) {
				$('.cds_info_wrapper').html(data);
				$('.time:odd').css("background","#99CC62");
				$('.event:odd').css("background","#dddddd");
			  }
			});
		  });
	});
	$('#detailed_schedule').click(function() {
	  $('.cds_info_wrapper')
	      .empty()
		  .animate({
			height: '3870px'
		  }, 700, function() {
			// Animation complete.
			$.ajax({
			  url: 'http://'+document.domain+'/wp-content/themes/charlotte_dancesport/cdc2011/detailed_schedule.html',
			  dataType: "html",
			  success: function(data) {
				$('.cds_info_wrapper').html(data);
				$('.time:odd').css("background","#99CC62");
				$('.event:odd').css("background","#dddddd");
				$('.is_link').click( function () {
					$.scrollTo($('#is'),1000);
				});
				$('.as_link').click( function () {
					$.scrollTo($('#as'),1000);
				});
				$('.il_link').click( function () {
					$.scrollTo($('#il'),1000);
				});
				$('.ar_link').click( function () {
					$.scrollTo($('#ar'),1000);
				});
				$('.oe_link').click( function () {
					$.scrollTo($('#oe'),1000);
				});
				$('.ws_link').click( function () {
					$.scrollTo($('#ws'),1000);
				});
				$('.top').click( function () {
					$.scrollTo($('#detailed_wrapper'),1000);
				});
				$('.sat_link').click( function () {
					$.scrollTo($('#sat'), 1000);
				});
				$('.sun_link').click( function () {
					$.scrollTo($('#sun'), 1000);
				});
			  }
			});
		  });
	});
/*	$('#registration').click(function() {
	  $('.cds_info_wrapper')
	  .empty()
	  .animate({
			height: '500px'
		  }, 700, function() {
			// Animation complete.
			$.ajax({
			  url: 'http://'+document.domain+'/wp-content/themes/charlotte_dancesport/cdc2011/registration.html',
			  dataType: "html",
			  success: function(data) {
				$('.cds_info_wrapper').html(data);
			  }
			});
		  });
	}); */
	$('#officials').click(function() {
	  // Adjust height for Firefox quirk
	  var firefox=/Firefox/i;
	  var ie=/MSIE/i;
	  var canvas_height = ( firefox.test(navigator.userAgent) || ie.test(navigator.userAgent) ) ? '5069px' : '4951px';
	  $('.cds_info_wrapper')
		  .empty()
		  .animate({
			height: canvas_height
		  }, 700, function() {
			// Animation complete.
			$.ajax({
			  url: 'http://'+document.domain+'/wp-content/themes/charlotte_dancesport/cdc2011/officials.html',
			  dataType: "html",
			  success: function(data) {
				$('.cds_info_wrapper').html(data);
			  }
			});
		  });
	});
	$('#rules_fees').click(function() {
      // Adjust height for Firefox quirk
      var firefox=/Firefox/i;
	  var ie=/MSIE/i;
	  var canvas_height = ( firefox.test(navigator.userAgent) || ie.test(navigator.userAgent) ) ? '3960px' : '3860px';
	  $('.cds_info_wrapper')
		  .empty()
		  .animate({
			height: canvas_height
		  }, 700, function() {
			// Animation complete.
			$.ajax({
			  url: 'http://'+document.domain+'/wp-content/themes/charlotte_dancesport/cdc2011/rules.html',
			  dataType: "html",
			  success: function(data) {
				$('.cds_info_wrapper').html(data);
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
			  }
			});
		  });

	});
	$('#housing').click(function() {
	  $('.cds_info_wrapper')
		  .empty()
		  .animate({
			height: '1110px'
		  }, 700, function() {
			// Animation complete.
			$.ajax({
			  url: 'http://'+document.domain+'/wp-content/themes/charlotte_dancesport/cdc2011/housing.html',
			  dataType: "html",
			  success: function(data) {
				$('.cds_info_wrapper').html(data);
				$('#free_housing')
				  .click( function() {
					window.open("https://spreadsheets.google.com/viewform?formkey=dDF6eXllcGlRaUVBUTIzVGxXdUZUdGc6MQ#gid=0",'_blank','menubar, toolbar, location, directories, status, scrollbars, resizable, dependent, left=0, top=0');
				  })
				  .hover( function() {$(this).css('background','#6699AA');},function() {$(this).css('background','#6699CC');});
				$('#housing_volunteer')
				  .click( function() {
					window.open("https://spreadsheets.google.com/viewform?formkey=dGpMd09CTXoyV0QxTEtWYWpCVkRRTFE6MQ",'_blank','menubar, toolbar, location, directories, status, scrollbars, resizable, dependent, left=0, top=0');
				  })
				  .hover( function() {$(this).css('background','#6699AA');},function() {$(this).css('background','#6699CC');});
			  }
			});
		  });
	});
	$('#sponsors').click(function() {
	  $('.cds_info_wrapper')
	  .empty()
	  .animate({
		height: '1350px'
	  }, 700, function() {
		// Animation complete.
			$.ajax({
			  url: 'http://'+document.domain+'/wp-content/themes/charlotte_dancesport/cdc2011/sponsors.html',
			  dataType: "html",
			  success: function(data) {
				$('.cds_info_wrapper').html(data);
				$(".contactus").colorbox({
					width:425, 
					height:510, 
					scrolling:false, 
					iframe:true
				});
			  }
			});
		});
	});
	$('#pictures').click(function() {
	  $('.cds_info_wrapper')
		  .empty()
		  .animate({
			height: '480px'
		  }, 700, function() {
			// Animation complete.

			});
	});
	$('#dance_locations').click(function() {
	  $('.cds_info_wrapper')
	  .empty()
	  .animate({
			height: '1020px'
		  }, 700, function() {
			// Animation complete.
			$('.cds_info_wrapper').append("<iframe src='http://"+document.domain+"/wp-content/themes/charlotte_dancesport/cdc2011/dance_location.html' frameborder='0' scrolling='yes' style='width:673px; height:1020px; border:0px;' >");
		});
	});
	
});

/*
 * JQuery for Admin Edit buttons
 */
$(document).ready(function () {
	/* JQuery for Admin Edit buttons opacity */
	$('.floating_edit_button').parent().hover(
		function () {
			$(this).children('.floating_edit_button').css('opacity', '1.0');
		},
		function () {
			$(this).children('.floating_edit_button').css('opacity', '0.4');
		}
	);
	
	$('.banner_image_editor').click(function(){
		window.open("http://"+document.domain+"/edit_tools/banner-photos-editor/", "banner_editor", "status=0,toolbar=0,location=0,menubar=0,resizable=1,scrollbars=1,height=530,width=768"); 
		return false;
	});
	
/*	$('.logo_editor').click(function(){
		window.open("http://www.google.com", "banner_editor", "status=0,toolbar=0,location=0,menubar=0,resizable=1,height=550,width=375"); 
		return false;
	});

	$('.logo_text_editor').click(function(){
		window.open("http://www.google.com", "banner_editor", "status=0,toolbar=0,location=0,menubar=0,resizable=1,height=550,width=375"); 
		return false;
	});
*/
	$('.top_nav_editor').click(function(){
		window.open("http://www.google.com", "banner_editor", "status=0,toolbar=0,location=0,menubar=0,resizable=1,height=550,width=375"); 
		return false;
	});
	
	$('.dance_tips_editor').click(function(){
		window.open("http://"+document.domain+"/edit_tools/dance-tips-editor/", "tip_editor", "status=0,toolbar=0,location=0,menubar=0,resizable=1,scrollbars=1,height=550,width=710"); 
		return false;
	});
	
	$('.cdsc_news_feed_editor').click(function(){
		window.open("http://"+document.domain+"/edit_tools/cdsc-news-feed-editor/", "tip_editor", "status=0,toolbar=0,location=0,menubar=0,resizable=1,scrollbars=1,height=550,width=710"); 
		return false;
	});
	
	$('.green_alerts_editor').click(function(){
		window.open("http://"+document.domain+"/edit_tools/green-alerts-editor/", "green_alert_editor", "status=0,toolbar=0,location=0,menubar=0,resizable=1,scrollbars=1,height=530,width=690"); 
		return false;
	});

});

/*
 * JQuery for top navigation hover arrows
 */
$(document).ready(function () {
	$('#cds_nav').hover(
		function () {
			$('#cds_nav div').removeClass('hidden').addClass('page_arrow');
		}, 
		function () {
			$('#cds_nav div').removeClass('page_arrow').addClass('hidden');
		}						 
	);
	$('#calendar_nav').hover(
		function () {
			$('#calendar_nav div').removeClass('hidden').addClass('page_arrow');
		}, 
		function () {
			$('#calendar_nav div').removeClass('page_arrow').addClass('hidden');
		}						 
	);
	$('#coaches_nav').hover(
		function () {
			$('#coaches_nav div').removeClass('hidden').addClass('page_arrow');
		}, 
		function () {
			$('#coaches_nav div').removeClass('page_arrow').addClass('hidden');
		}						 
	);
	$('#dances_nav').hover(
		function () {
			$('#dances_nav div').removeClass('hidden').addClass('page_arrow');
		}, 
		function () {
			$('#dances_nav div').removeClass('page_arrow').addClass('hidden');
		}						 
	);
	$('#scrapbook_nav').hover(
		function () {
			$('#scrapbook_nav div').removeClass('hidden').addClass('page_arrow');
		}, 
		function () {
			$('#scrapbook_nav div').removeClass('page_arrow').addClass('hidden');
		}						 
	);
	$('#competitions_nav').hover(
		function () {
			$('#competitions_nav div').removeClass('hidden').addClass('page_arrow');
		}, 
		function () {
			$('#competitions_nav div').removeClass('page_arrow').addClass('hidden');
		}						 
	);
	$('#cdc_nav').hover(
		function () {
			$('#cdc_nav div').removeClass('hidden').addClass('page_arrow');
		}, 
		function () {
			$('#cdc_nav div').removeClass('page_arrow').addClass('hidden');
		}						 
	);
});

/*
 * JQuery for Red and Yellow alert editors
 */
jQuery.extend(jQuery.expr[':'], {
    focus: function(element) { 
        return element === document.activeElement; 
    }
});
$(document).ready(function () {
	$('#yellow_alert_input').hover(
		function () {
			if ($(this).is(":focus") === false) {
				$(this).css('background', 'yellow');
				$(this).css('border', '1px');
				$(this).css('color', '#000');
			}
		},
		function () {
			if ($(this).is(":focus") === false && $(this).val() === "No yellow alert message currently - Click here to edit (e.g. CDSC 2011 - Competition registration is now open!)") {
				$(this).css('background', '#EAEA83');
				$(this).css('border', 'none');
				$(this).css('color', '#AAA');
			}
		}
	)
	.focusin( function() {
		// Clear input field if the default text is inside
		if( $(this).val() === "No yellow alert message currently - Click here to edit (e.g. CDSC 2011 - Competition registration is now open!)" ){
			$(this).val("");
		}
		// Add border and change color of the font
		$(this).css('border', '1px');
		$(this).css('color', '#000');
	})
	.focusout( function() {
		// Add border and change color of the font
		$(this).css('border', 'none');
		// if the input field is empty enter temporary/instrustional text
		if ($(this).val() === "") {
			$(this).css('color', '#AAA');
			$(this).css('background', '#EAEA83');
			$(this).css('border', 'none');
			$(this).val("No yellow alert message currently - Click here to edit (e.g. CDSC 2011 - Competition registration is now open!)");
			ajax_update_alert('yellow',null);
		} else {
			ajax_update_alert('yellow',$(this).val()); 
		}
	});
	
	$('#red_alert_input').hover(
		function () {
			if ($(this).is(":focus") === false) {
				$(this).css('background', 'red');
				$(this).css('border', '1px');
				$(this).css('color', '#000');
			}
		},
		function () {
			if ($(this).is(":focus") === false && $(this).val() === "No red alert message currently - Click here to edit (e.g. Thurs Dance Lessons Canceled)") {
				$(this).css('background', '#ED8383');
				$(this).css('border', 'none');
				$(this).css('color', '#777');
			}
		}
	)
	.focusin( function() {
		// Clear input field if the default text is inside
		if( $(this).val() === "No red alert message currently - Click here to edit (e.g. Thurs Dance Lessons Canceled)" ){
			$(this).val("");
		}
		// Add border and change color of the font
		$(this).css('border', '1px');
		$(this).css('color', '#000');
	})
	.focusout( function() {
		// Add border and change color of the font
		$(this).css('border', 'none');
		// if the input field is empty enter temporary/instrustional text
		if ($(this).val() === "") {
			$(this).css('color', '#777');
			$(this).css('background', '#ED8383');
			$(this).css('border', 'none');
			$(this).val("No red alert message currently - Click here to edit (e.g. Thurs Dance Lessons Canceled)");
			ajax_update_alert('red',null);
		} else {
			ajax_update_alert('red',$(this).val()); 
		}
	});
});

/*
 * Dance Tip suggestiom link
 */
$(document).ready( function() {
	$('#dance_tips_extension_1024').hover(
	  function(){ $('.suggest_a_tip_txt').css('opacity','1.0');},
	  function(){ $('.suggest_a_tip_txt').css('opacity','0.1');}
	);
});
/*
 * Admin Banner Image Uploader / Drag and Drop feature
 */
function select_banner_image(f) {
	//var a = f.length;
	//alert(a);
	var i=0;
	
	for (i = 0; i < f.length; i++) {  
		var file = f[i];  
		var imageType = /image.*/;  
		
		if (!file.type.match(imageType)) { 
		  alert("Not and images file.");  
		} else {	
			var img = document.createElement("img");  
			img.classList.add("obj");  
			img.file = file;  
			preview.appendChild(img);  
			
			var reader = new FileReader();  
			reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);  
			reader.readAsDataURL(file);
		}
 
	}  
}
/*
 * User settings and profile dropdown
 */
$(document).ready( function() {
	$('#name_dropdown dt').hover(
		function() {
			$(this).removeClass('name_dropdown_dt');
			$(this).addClass('a-a');
		},
		function() {
			$(this).removeClass('a-a');
			$(this).addClass('name_dropdown_dt');
		}
	)
	.click(function() {

		$("#name_dropdown dd").toggle();

	});



	$(document).bind('click', function(e) {

		var $clicked = $(e.target);

		if (! $clicked.parents().hasClass("name_dropdown")) {

			$("#name_dropdown dd").hide();
			
		}

	});
});

/*==================================
 * Google Calendar API functionality
 *==================================*/
 
/* Loads the Google data JavaScript client library */
google.load('visualization', '1', {packages:['table']}); // Load Visualization API for Google Charts
google.load("gdata", "2.x");

/**
 * Global Date Variable for current date
 */
var GLOBAL_DATE = new Date();

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
	case 1:
	  return 'Mon';
	case 2:
	  return 'Tue';
	case 3:
	  return 'Wed';
	case 4:
	  return 'Thu';
	case 5:
	  return 'Fri';
	case 6:
	  return 'Sat';
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
	case 1:
	  return 'Monday';
	case 2:
	  return 'Tuesday';
	case 3:
	  return 'Wednesday';
	case 4:
	  return 'Thursday';
	case 5:
	  return 'Friday';
	case 6:
	  return 'Saturday';
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
	case 1:
	  return 'February';
	case 2:
	  return 'March';
	case 3:
	  return 'April';
	case 4:
	  return 'May';
	case 5:
	  return 'June';
	case 6:
	  return 'July';
	case 7:
	  return 'August';
	case 8:
	  return 'September';
	case 9:
	  return 'October';
	case 10:
	  return 'November';
	case 11:
	  return 'December';
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
	case 1:
	  return 'Feb';
	case 2:
	  return 'Mar';
	case 3:
	  return 'Apr';
	case 4:
	  return 'May';
	case 5:
	  return 'Jun';
	case 6:
	  return 'Jul';
	case 7:
	  return 'Aug';
	case 8:
	  return 'Sept';
	case 9:
	  return 'Oct';
	case 10:
	  return 'Nov';
	case 11:
	  return 'Dec';
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
 * Returns the number of days within a specific Calendar month
 *
 * @params: iMouth (int) requested month, iYear (int) requested year.
 */
function cal_days_in_month(iMonth, iYear)
{
	return 32 - new Date(iYear, iMonth, 32).getDate();
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
 // if (e instanceof Error) {
    /* alert with the error line number, file and message */
 //   alert('Google Calendar API is used on this site. Google currently does not support Opera in this API. Continue at your own risk');
    /* if available, output HTTP error code and status text */
 /*   if (e.cause) {
      var status = e.cause.status;
      var statusText = e.cause.statusText;
      alert('Root cause: HTTP error ' + status + ' with status text of: ' + 
            statusText);
    }
  } else {
    alert(e.toString());
  }
 */
}

/**
 * Callback function for the Google data JS client library to call with a feed 
 * of events retrieved.
 *
 * Creates a Google Chart of events in a human-readable form.  This list of
 * events is added into a div called 'cds_listOfEvents'.
 *
 * @param {json} feedRoot is the root of the feed, containing all entries 
 */ 
function listEvents(feedRoot) {
  var cssClassNames = {
	'headerRow': 'chart__col_header',
	'tableRow': 'chart_future_events',
	'oddTableRow': 'odd_chart_rows',
	'selectedTableRow': '',
	'hoverTableRow': 'hover_chart_rows',
	'headerCell': 'chart_col_header',
	'tableCell': '',
	'rowNumberCell': ''};
	
  var data = new google.visualization.DataTable();
	data.addColumn('date', 'Date');
	data.addColumn('string', 'Title');
	data.addColumn('string', 'Duration');
	data.addColumn('string', 'Location');
  var formatter = new google.visualization.DateFormat({pattern: "E M/d/y"});
  var entries = feedRoot.feed.getEntries();
  var eventDiv = document.getElementById('cds_listOfEvents');
  if (eventDiv.childNodes.length > 0) {
    eventDiv.removeChild(eventDiv.childNodes[0]);
  }	
  
  /* loop through each event in the feed */

  var len = entries.length;
  data.addRows(len);
  var i=0;
  
  for (i = 0; i < len; i++) {
    var entry = entries[i];
    var title = entry.getTitle().getText();
    var startDateTime = null;
    var startJSDate = null;
	var endDateTime = null;
	var endJSDate = null;
	var location = "";
    var times = entry.getTimes();
	// get location of event
	locations = entry.getLocations();
	if (locations.length > 0) {
		location = locations[0].getValueString();
	}
	
	// store start and end time for event
    if (times.length > 0) {
      startDateTime = times[0].getStartTime();
      startJSDate = startDateTime.getDate();
	  endDateTime = times[0].getEndTime();
	  endJSDate = endDateTime.getDate();
    }
	
    var entryLinkHref = null;
	
    if (entry.getHtmlLink() !== null) {
      entryLinkHref = entry.getHtmlLink().getHref();
	  title = '<a href="'+entryLinkHref+'" target="_blank">'+title+'</a>';
    }
	
    //var dateString = getWeekdayAbbreviation(startJSDate.getDay()) + " " + (startJSDate.getMonth() + 1) + "/" + startJSDate.getDate() + "/" + startJSDate.getFullYear();
	
	var durationString = null;
	
    if (!startDateTime.isDateOnly()) {
      durationString = convert24To12Clock(startJSDate.getHours()) + ":" + 
      padNumber(startJSDate.getMinutes()) + ((startJSDate.getHours()>=12) ? "PM" : "AM") + "-" + convert24To12Clock(endJSDate.getHours()) +
	  ":" + padNumber(endJSDate.getMinutes()) + ((endJSDate.getHours()>=12) ? "PM" : "AM");
    }
	
	data.setCell(i, 0, new Date(startJSDate.getFullYear(),(startJSDate.getMonth()),startJSDate.getDate()));
	if (entry.getHtmlLink() !== null) {
		data.setCell(i, 1, title, null, {'className': 'chart_titles_w_links'});
	} else {
		data.setCell(i, 1, title);
	}
	data.setCell(i, 2, durationString);
	data.setCell(i, 3, location);

    /* if we have a link to the event, create an 'a' element */
    /*if (entryLinkHref != null) {
      entryLink = document.createElement('a');
      entryLink.setAttribute('href', entryLinkHref);
      entryLink.appendChild(document.createTextNode(title));
      li.appendChild(document.createTextNode(dateString + " "));
	  li.appendChild(entryLink);
	  li.appendChild(document.createTextNode(" " + durationString));
    }*/
  }

  formatter.format(data, 0);
  
  var table = new google.visualization.Table(document.getElementById('cds_listOfEvents'));
  table.draw(data, {allowHtml: true, showRowNumber: false, 'cssClassNames': cssClassNames});
}

/**
 * Callback function for the Google data JS client library to call with a feed 
 * of the current weeks events retrieved.
 *
 * Creates a CSS formatted group of events in a human-readable form.
 * This list of events is added into a div called 'cds_weekListOfEvents'.
 *
 * @param {json} feedRoot is the root of the feed, containing all entries 
 */ 
function currentWeeksListEvents(feedRoot) {
  var entries = feedRoot.feed.getEntries();
  var eventDiv = document.getElementById('cds_weekListOfEvents');
  
  if (eventDiv.childNodes.length > 0) {
    eventDiv.removeChild(eventDiv.childNodes[0]);
  }	
  
  /* Add CSS for tooltip
			  style = document.createElement('style');
			  style.setAttribute('type', "text/css");
			  style.appendChild( document.createTextNode(".tooltip {display:none;background:url(\'../img/black_arrow.png\');height:122px;padding:;width:209px;font-size:11px;color:#fff;z-index: 9999;}") );
			  eventDiv.appendChild(style);
			  */
  /* loop through each event in the feed */
  var tempDate = new Date();
  var len = entries.length;
  var entry_count = 0;
  var i=0;
  
  /* loop through each day of the week (sun-sat) */
  for (i = 0; i < 7; i++) {
	var dayDiv = document.createElement('div');
	eventDiv.appendChild(dayDiv);
	
	if(len !== 0){
		var entry = entries[entry_count];
		//var title = entry.getTitle().getText();
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
		
		var entryLinkHref = null;
		
		if(startJSDate.getDay() === i) {	 
			var dateString = getWeekdayAbbreviation(startJSDate.getDay()) + " " + (startJSDate.getMonth() + 1) + "/" + startJSDate.getDate() + "/" + startJSDate.getFullYear();
			
			var durationString = null;
			
			if (!startDateTime.isDateOnly()) {
			  durationString = convert24To12Clock(startJSDate.getHours()) + ":" + 
			  padNumber(startJSDate.getMinutes()) + ((startJSDate.getHours()>=12) ? "PM" : "AM") + "-" + convert24To12Clock(endJSDate.getHours()) +
			  ":" + padNumber(endJSDate.getMinutes()) + ((endJSDate.getHours()>=12) ? "PM" : "AM");
			}	
			
			/* if we have a link to the event, create an 'a' element */
			if (entry.getHtmlLink() !== null) {
				entryLinkHref = entry.getHtmlLink().getHref();
			}
			if (entryLinkHref !== null) {
			  entryLink = document.createElement('a');
			  entryLink.setAttribute('href', entryLinkHref);
			  entryLink.setAttribute('target', "_blank");
			  entryLink.appendChild(document.createTextNode(startJSDate.getDate()));
			  
			  dayDiv.setAttribute('class', "day_tooltip");
			  dayDiv.appendChild(entryLink);
			  var tooltipDiv = document.createElement('div');
			  tooltipDiv.className = "tooltip";
			  tooltipDiv.setAttribute('style', "display:none;background:url(\'http://"+document.domain+"/wp-content/themes/charlotte_dancesport/img/black_arrow.png\');height:122px;padding:0px;margin:10px 5px 10px 5px;border:0px;width:209px;font-size:11px;line-height:1.2em;color:#fff;z-index: 9999;");
			  var p = document.createElement('p');
			  p.appendChild(document.createTextNode(entry.getTitle().getText() + " " + dateString));
			  p.setAttribute('style', "margin: 15px 10px 15px 10px;");
			  tooltipDiv.appendChild(p);
			  eventDiv.appendChild(tooltipDiv);
			  
			  /*tscript.innerHTML = '$(document).ready( function () {$(\".day_tooltip\").tooltip({tip: \'.tooltip\',effect: \'fade\',fadeOutSpeed: 100,predelay: 400});});';*/
			  //tscript.appendChild(document.createTextNode("\$(document).ready( function () {\$(\".day_tooltip\").tooltip({tip: \'.tooltip\',effect: \'fade\',fadeOutSpeed: 100,predelay: 400})\;})\;"));
			  
			  
			} else {
			  dayDiv.appendChild(document.createTextNode(startJSDate.getDate()));
			  dayDiv.setAttribute('class', "gray_out");
			}
			
			// Make sure to move to the next calendar event for testing
			if(entry_count !== len-1) {entry_count++;}
		} else {
			tempDate.setDate(getSunday()+i);
			
			dayDiv.appendChild(document.createTextNode(tempDate.getDate()));
			dayDiv.setAttribute('class', "gray_out");
			/*var weekdaySpan = document.createElement('span');
			dayDiv.appendChild(weekdaySpan);
			weekdaySpan.appendChild(document.createTextNode(getWeekdayAbbreviation(i).toLowerCase()));
			*/
		}
	} else { /* If the week had no events */
		tempDate.setDate(getSunday()+i);
		dayDiv.appendChild(document.createTextNode(tempDate.getDate()));
		dayDiv.setAttribute('class', "gray_out");
	}
	
	// Add Tooltip script
	  var tscript = document.createElement('script');
	  tscript.type = "text/javascript";
	  tscript.src = "http://"+document.domain+"/wp-content/themes/charlotte_dancesport/js/tooltips.js";
	  eventDiv.appendChild(tscript);
  }

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
		
		if(entry.getHtmlLink() !== null) {
			var p0 = document.createElement('p');
			var a = document.createElement('a');
			a.setAttribute('href', entry.getHtmlLink().getHref());
			a.appendChild(document.createTextNode(title +" - "+ getWeekday(startJSDate.getDay()) +", "+ getMonthNameAbbreviation(startJSDate.getMonth()) +" "+ startJSDate.getDate() +" @ "+ startTime));
			p0.appendChild(a);
			div.appendChild(p0);
		} else {
			var p1 = document.createElement('p');
			p1.appendChild(document.createTextNode(title +" - "+ getWeekday(startJSDate.getDay()) +", "+ getMonthNameAbbreviation(startJSDate.getMonth()) +" "+ startJSDate.getDate() +" @ "+ startTime));
			div.appendChild(p1);
		}
		
	} else {
		var p2 = document.createElement('p');
		p2.appendChild(document.createTextNode("NO UPCOMING EVENTS - Updates coming soon!"));
		div.appendChild(p2);
	}

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
  var i=0;
  
  for (i = 0; i < len; i++) {
    var entry = entries[i];
    //var title = entry.getTitle().getText();
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
	
    if (entry.getHtmlLink() !== null) {
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
	if (today.getMonth() === GLOBAL_DATE.getMonth() && today.getFullYear() === GLOBAL_DATE.getFullYear()){
		$('#d'+today.getDate()).addClass('current_day_bg');
	}
  });
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
 * Retrieve Current week of events (Sun to Sat) from Google Calendar API
 * Uses Google data JS client library to retrieve a calendar feed from the specified
 * URL.  The feed is controlled by several query parameters and a callback 
 * function is called to process the feed results.
 *
 * @param {string} calendarUrl is the URL for a public calendar feed
 */
function loadCurrentWeek(calendarUrl) {
	//var d = new Date();
	var startDateTime = new google.gdata.DateTime(new Date(getSundayDate().getFullYear(), getSundayDate().getMonth(), getSundayDate().getDate()));
	var endDateTime = new google.gdata.DateTime(new Date(getSaturdayDate().getFullYear(), getSaturdayDate().getMonth(), getSaturdayDate().getDate()+1));
	var service = new google.gdata.calendar.CalendarService('CharlotteDanceSport-GoogleCals-1.0');
	var query = new google.gdata.calendar.CalendarEventQuery(calendarUrl);
	query.setOrderBy('starttime');
	query.setSortOrder('ascending');
	query.setMinimumStartTime(startDateTime);
	query.setMaximumStartTime(endDateTime);
	query.setFutureEvents(false);
	query.setSingleEvents(true);
	query.setMaxResults(7);
	
	service.getEventsFeed(query, currentWeeksListEvents, handleGDError);
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
 * Determines the full calendarUrl based upon the calendarAddress
 * argument and calls loadCalendar with the calendarUrl value.
 *
 * @param {string} calendarAddress is the email-style address for the calendar
 */ 
function loadCalendarByAddress(calendarAddress) {
  var calendarUrl = 'http://www.google.com/calendar/feeds/' + calendarAddress + '/public/full';
  loadNextEvent(calendarUrl);
  loadCalendar(calendarUrl);
  loadCurrentWeek(calendarUrl);
}


function loadSidebarCalendarByAddress(calendarAddress) {
  var calendarUrl = 'http://www.google.com/calendar/feeds/' + calendarAddress + '/public/full';
  loadCurrentMonth(calendarUrl);
}

/**
 * Loads the Charlotte DanceSport General Calendar
 */
function load_CDS_Calendar() {
  loadCalendarByAddress('qd4u07691gh5c07jnuvbkmbgm4@group.calendar.google.com');
  //loadCalendarByAddress('charlottedancesport@gmail.com');
}

function load_CDS_Sidebar_Calendar() {
	loadSidebarCalendarByAddress('qd4u07691gh5c07jnuvbkmbgm4@group.calendar.google.com');
  //loadSidebarCalendarByAddress('charlottedancesport@gmail.com');
}

function init_CDS_listOfEvents() {
  // init the Google data JS client library with an error handler
  google.gdata.client.init(handleGDError);
  // load the code.google.com developer calendar
  load_CDS_Calendar();
  
//  load_Bronze_Team_Calendar();
//  load_Sliver_Team_Calendar();
}

function init_CDS_sideBarCalendarLinks()  {
  // init the Google data JS client library with an error handler
  google.gdata.client.init(handleGDError);
  // load the code.google.com developer calendar
  load_CDS_Sidebar_Calendar();
}

/**
 * Loads the Charlotte DanceSport Bronze Team Event Calendar
 */
function load_Bronze_Team_Calendar() {
  loadCalendarByAddress('cph68k4e3qu3rj173u2ja5q4rs@group.calendar.google.com');
}

/**
 * Loads the Charlotte DanceSport Silver Team Event Calendar
 */
function load_Silver_Team_Calendar() {
  loadCalendarByAddress('ptgo7vr09a178va9kn8gtqk9e0@group.calendar.google.com');
}

function get_google_calendar_body(m, d, y) {
	//This stores the past date in GLOBAL_DATE for future use
	if( (m!==null && m!==undefined ) && (d!==null && d!==undefined ) && (y!==null && y!==undefined )){
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
	
	// Create and array for holding 6 <tr> objects representing the calendar weeks
	var row = [6];
	var i=0;
	
	for (i=0; i<6; i++){
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
		var td0 = document.createElement('td');
		td0.appendChild(document.createTextNode(day_num));
		td0.setAttribute('id', "d"+day_num);
		td0.setAttribute('class', "single_day");
		row[calendar_row].appendChild(td0); 
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
		var td1 = document.createElement('td');
		row[calendar_row].appendChild(td1); 
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
	//a.setAttribute('href', "");
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
	//a1.setAttribute('href', "");
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

/*
 * JQuery controls for sidebar calendar
 */
$(document).ready(function(){

	$(".previousCalendar").click(function(){
		get_google_calendar_body((GLOBAL_DATE.getMonth()===0) ? 11 : GLOBAL_DATE.getMonth()-1,
						 1,
						 (GLOBAL_DATE.getMonth()===0) ? GLOBAL_DATE.getFullYear()-1 : GLOBAL_DATE.getFullYear());
		
		init_CDS_sideBarCalendarLinks();
		
		$("#monthName").text(getMonthName(GLOBAL_DATE.getMonth()) + " " + GLOBAL_DATE.getFullYear());
	});
	
	$(".nextCalendar").click(function(){
		get_google_calendar_body((GLOBAL_DATE.getMonth()===11) ? 0 : GLOBAL_DATE.getMonth()+1,
						 1,
						 (GLOBAL_DATE.getMonth()===11) ? GLOBAL_DATE.getFullYear()+1 : GLOBAL_DATE.getFullYear());
		
		init_CDS_sideBarCalendarLinks();
		
		$("#monthName").text(getMonthName(GLOBAL_DATE.getMonth()) + " " + GLOBAL_DATE.getFullYear());
	});
});

function validEmail(email) {
	var filter = /^[a-zA-Z0-9._\-]+@[a-zA-Z0-9.\-]+.[a-zA-Z]{2,4}$/;
	if (!filter.test(email)) {
		return false;
	}
	return true;
}
/*
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    includedLanguages: 'zh-TW,ja,ru,es,tr'
  }, 'google_translate_element');
} */


/**
 * Function retrieves Wikipedia article summaries
 */
function getAreaMetaInfo_Wikipedia(page_id) {
  $.ajax({
    url: 'http://en.wikipedia.org/w/api.php',
    data: {
      action:'query',
      pageids:page_id,
      format:'json'
    },
    dataType:'jsonp',
    success: function(data) {
      title = page_id.replace(' ','_');
      $.ajax({
        url: 'http://en.wikipedia.org/w/api.php',
        data: {
          action:'parse',
          prop:'text',
          page:title,
          format:'json'
        },
        dataType:'jsonp',
        success: function(data) {
		  $("#wiki_container").append("<h2>"+title.replace(/_/gi,' ')+"</h2>");
		  
		  $("<div>"+data.parse.text['*']+"<div>").children('p').slice(0,5).each( function () {
			  $(this).find('sup').remove();
			  $(this).find('a').each(function() {
				$(this)
				  .attr('href', 'http://en.wikipedia.org'+$(this).attr('href'))
				  .attr('target','wikipedia');
			  });
			  $("#wiki_container").append(this);
		  });
		  
          $("#wiki_container").append("<a href='http://en.wikipedia.org/wiki/"+title+"' target='wikipedia'>Read more on Wikipedia</a>");
        }
      });
    }
  });
}

/**
 * JQuery controls for the Pick-a-dance banner on the dances taught page
 * click a dance name and the page uses Ajax to display a Wikipedia summary
 * This is temporary until someone else can write unique summaries
 */
$(document).ready( function() {
	$("#dances_banner li").click( function () {
		$("#wiki_container").empty();
		$("#dance_img").removeClass( ( $(this).parents('ul').hasClass("standard_list") ) ? "latin_dancers_img" : "standard_dancers_img");
		$("#dance_img").addClass( ( $(this).parents('ul').hasClass("standard_list") ) ? "standard_dancers_img" : "latin_dancers_img");
		getAreaMetaInfo_Wikipedia( $(this).find('span:first').text() );
	});
	$("#dances_banner li").hover( 
		function() {
			$(this).css("text-decoration", "underline");
		},
		function() {
			$(this).css("text-decoration", "none");
		}
	);
});