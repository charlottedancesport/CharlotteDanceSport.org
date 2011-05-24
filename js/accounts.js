/**
 * isEmpty - Check if variable is empty
 * param: inputStr - the string being evaluated
 * return: true, false respectively
 */
function isEmpty( inputStr ) { return ( null === inputStr || "" === inputStr ) ? true : false; }

/**
 * Validate URL
 * param: url - the url string being checked.
 * return true / false if url is valid / not valid respectively
 */
function isUrl(url) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	return regexp.test(url);
}

/**
 * Get browser scroll width x height
 */
function f_filterResults(n_win, n_docel, n_body) {
	var n_result = n_win ? n_win : 0;
	if (n_docel && (!n_result || (n_result > n_docel))) { n_result = n_docel; }
	return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;
}
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

/* End get browser scroll h x w */
$(document).ready(function() {
	$('.a-a').hover(
		function(){
			$(this).addClass('a-v');
		},
		function(){
			$(this).removeClass('a-v');
		}
	);
	$('#full_name').hover(
		function(){
			$(this).addClass('a-v');
		},
		function(){
			$(this).removeClass('a-v');
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
'<div class="a-p"><input id="president" class="a-o" type="checkbox" value="officer_President" /><label for="president">President</label></div>'+
'<div class="a-p"><input id="new_captain" class="a-o" type="checkbox" value="officer_Newcomer Team Captain" /><label for="new_captain">Newcomer Team Captain</label></div>'+
'<div class="a-p"><input id="advisor" class="a-o" type="checkbox" value="officer_Club Advisor" /><label for="advisor">Club Advisor</label></div>'+
'<div class="a-p"><input id="vice_president" class="a-o" type="checkbox" value="officer_Vice President" /><label for="vice_president">Vice President</label></div>'+
'<div class="a-p"><input id="bronze_captain" class="a-o" type="checkbox" value="officer_Bronze Team Captain" /><label for="bronze_captain">Bronze Team Captain</label></div>'+
'<div class="a-p"><input id="student" class="a-o" type="checkbox" value="Student" /><label for="student">Student</label></div>'+
'<div class="a-p"><input id="treasurer" class="a-o" type="checkbox" value="Treasurer" /><label for="treasurer">Treasurer</label></div>'+
'<div class="a-p"><input id="silver_captain" class="a-o" type="checkbox" value="officer_Silver Team Captain" /><label for="silver_captain">Silver Team Captain</label></div>'+

'<div class="a-p"><input id="secretary" class="a-o" type="checkbox" value="officer_Secretary" /><label for="secretary">Secretary</label></div>'+
'<div class="a-p"><input id="ad_member" class="a-o" type="checkbox" value="officer_Advertising Team Member" /><label for="ad_member">Advertising Team Member</label></div>'+
'<div class="a-p"><input id="new_member" class="a-o" type="checkbox" value="member_Newcomer Team Member" name="team" /><label for="new_member">Newcomer Team Member</label></div>'+
'<div class="a-p"><input id="event_coordinator" class="a-o" type="checkbox" value="officer_Event Coordinator" /><label for="event_coordinator">Event Coordinator</label></div>'+
'<div class="a-p"><input id="webmaster" class="a-o" type="checkbox" value="officer_Webmaster" /><label for="webmaster">Webmaster</label></div>'+
'<div class="a-p"><input id="bronze_membern" class="a-o" type="checkbox" value="member_Bronze Team Member" name="team" /><label for="bronze_member">Bronze Team Member</label></div>'+
'<div class="a-p"><input id="graphics" class="a-o" type="checkbox" value="officer_Graphics Designer" /><label for="graphics">Graphics Designer</label></div>'+
'<div class="a-p"><input id="public_relations" class="a-o" type="checkbox" value="officer_Public Relations" /><label for="public_relations">Public Relations</label></div>'+
'<div class="a-p"><input id="silver_member" class="a-o" type="checkbox" value="member_Silver Team Member" name="team" /><label for="silver_member">Silver Team Member</label></div>'+
'<div class="a-p"><input id="volunteer_coordinator" class="a-o" type="checkbox" value="officer_Volunteer Coordinator" /><label for="volunteer_coordinator">Volunter Coordinator</label></div>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			case 'dance level(s)':
				theClass = 'a-i';
				theHTML = '<h2 class="a-b">Dance level(s)</h2><div class="a-s"><span>'+
'<div class="a-p"><input id="social" class="a-o" type="checkbox" value="Social" /><label for="social">Social</label></div>'+
'<div class="a-p"><input id="novice" class="a-o" type="checkbox" value="Novice" /><label for="novice">Novice</label></div>'+
'<div class="a-p"><input id="newcomer" class="a-o" type="checkbox" value="Newcomer" /><label for="Newcomer">Newcomer</label></div>'+
'<div class="a-p"><input id="prechamp" class="a-o" type="checkbox" value="Pre-Championship" /><label for="prechamp">Pre-Championship</label></div>'+
'<div class="a-p"><input id="bronze" class="a-o" type="checkbox" value="Bronze" /><label for="bronze">Bronze</label></div>'+
'<div class="a-p"><input id="champ" class="a-o" type="checkbox" value="Championship" /><label for="champ">Championship</label></div>'+
'<div class="a-p"><input id="silver" class="a-o" type="checkbox" value="Silver" /><label for="silver">Silver</label></div>'+
'<div class="a-p"><input id="proam" class="a-o" type="checkbox" value="Pro-Am" /><label for="proam">Pro-Am</label></div>'+
'<div class="a-p"><input id="gold" class="a-o" type="checkbox" value="Gold" /><label for="gold">Gold</label></div>'+
'<div class="a-p"><input id="Professional" class="a-o" type="checkbox" value="Professional" /><label for="pro">Professional</label></div>'+
'<div class="a-q"><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></span></div>';
				break;
			case "comps i've attended":
				theClass = 'a-i';
				theHTML = '<div class="a-z"><input autocomplete="off" id="comp_search" type="text" title="search" spellcheck="false" />'+
'<div class="a-x hidden"></div>'+
'<span class="hidden" id="comp_id"></span>'+
'<div class="c_results hidden"></div></div>'+
'<div class="a-r">'+
'<h2 class="a-b">Comps I\'ve attended</h2>'+
'<div id="my_comp_list"></div>'+
'<div class="a-q"><input id="Add" type="button" name="add" value="Add" class="a-l" /><input id="Send" type="button" name="Send" value="Send" class="a-l" /></div><div><input id="Cancel" type="button" name="Cancel" value="Cancel" class="a-l" /></div></div>';
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
		var orig_exp;
		var theFocus = '';
		var i,len;
		
		switch (feature_to_update){
			case 'introduction':
				theFocus = '.a-k';
				if( $('#introduction').hasClass('a-c-a') ){ $('#intro').val($('#introduction').text()); }
				break;
			case 'member status':
				theFocus = '#president';
				if( $('#member_status').hasClass('a-c-a') ) {
					// Place the users current member status in an array
					var stat = $('#member_status').text().split(", ");
					
					/** 
					 * Iterate over the array of status types and check corresponding
					 * checkbox for each dance level in the update format
					 */
					for ( i=0, len=stat.length; i<len; ++i ){
						$('.update_form input[value*="'+stat[i]+'"]').attr('checked',true);
					}
				}
				
				// Allow users to only be a member of one dance team
				$('input[name="team"]').click( function(){
					if($(this).attr("checked")){
						$('input[name="team"]').attr("checked", false);
						$(this).attr("checked", true);
					}
				});
				break;
			case 'dance level(s)':
				theFocus = "#social";
				if( $('#dance_level').hasClass('a-c-a') ) {
					// Place the users current dance levels in an array
					var levels = $('#dance_level').text().split(", ");
					
					/** 
					 * Iterate over the array of levels and check corresponding
					 * checkbox for each dance level in the update format
					 */
					for ( i=0, len=levels.length; i<len; ++i ){
						$('.update_form input[value^="'+levels[i]+'"]').attr('checked',true);
					}
				}
				break;
			case "comps i've attended":
				theFocus = "#comp_search";
				
				/**
				 * Make search suggestions for every key pressed which adds characters
				 * to the input field
				 */
				$('#comp_search').keyup( function(event){
					// alert( event.which );
					// place input text into suggestion div overlay
					//$('.a-x').html($(this).val());
					
					// if the arrows keys are pressed do nothing
					if (event.keyCode != '13' && event.keyCode != '37' && event.keyCode != '38' && event.keyCode != '39' && event.keyCode != '40') {

						// Find location of the input field and place div overlay
						var pos = $(this).position();
						
						$('.a-x')
							.css('top',pos.top)
							.css('left',pos.left)
							.css('width',$(this).width());
								
						/**
						 * Use ajax to populate the search field
						 */
						$.ajax({
							url:'/edit_tools/ajax-comp-search/',
							type:'POST',
							data:'cs='+$('#comp_search').val(),
							dataType:"html",
							statusCode: {
								404: function(){
								}
							},
							success: function(responseText){
								if( !isEmpty(responseText) && !isEmpty($('#comp_search').val()) ) {
									var cs_input = $('#comp_search').val().toString();
									var result = responseText.split("+|");
									var str = '<ul>';
									
									for ( i=0, len=result.length; i<len; ++i ){
										// Create a regexp for making the search string bold in the returned results
										orig_exp = new RegExp(cs_input,'i');
										
										// Format all returned search results
										if(i!=0) {
											r_parts = result[i].split("|+");
											str += '<li>'+r_parts[0].replace(orig_exp,'<span class="a-w">'+cs_input+'</span><span class="comp_id hidden" id="'+r_parts[1]+'"></span>');
										}
										else if(i==0) { 
											orig_exp = new RegExp(cs_input,'i');
											r_parts = result[i].split("|+");
											
											$('.a-x').html('<span class="a-y">'+r_parts[0].replace(orig_exp, cs_input)+'</span>');
											// Add highlight to first search result returned
											str += '<li class="s_highlighted">'+r_parts[0].replace(orig_exp,'<span class="a-w">'+cs_input+'</span><span class="comp_id hidden" id="'+r_parts[1]+'"></span>');
										}
									}
									
									str += '</ul>';
									
									// show the dropdown of suggestions from the database of competitions
									$('div.c_results')
										.empty()
										.append(str)
										.removeClass("hidden")
										/**
										 * Hover handler for search suggestion list items.
										 */
										.find("li").hover(
											function(){
												$("li.s_highlighted").removeClass("s_highlighted");
												$(this).addClass("s_highlighted");
											},
											function(){}
										)
										.click( function(){
											// hide grey search suggestion text in search field
											// place the selected search result in the search field
											// hide the search result list
											$('.a-x').addClass("hidden");
											$('#comp_search').val( $('li.s_highlighted').text() ); 
											$('div.c_results').addClass("hidden");
											$('#comp_id').html( $('li.s_highlighted .comp_id').attr("id") );
										});
				
									// Show the grey suggestion text in search field
									$('.a-x').removeClass("hidden");
								} else {
									// hide the dropdown of suggestions from the database of competitions
									$('div.c_results')
										.empty()
										.addClass("hidden");
									// hide the grey suggestion text in search field
									$('.a-x').addClass("hidden");
								}
							},
							error: function(){
								alert('error');
							},
							complete: function(){
								
							}
						});
					
					} // end if
				});
				
				/**
				 * Make search suggestions for every key pressed which adds characters
				 * to the input field
				 */
				$('#comp_search').keydown( function(event){
													
					// if up arrow key is pressed do..							
					if (event.keyCode == '38') {
						event.preventDefault();
						if( $('div.c_results').is(":visible") ){
							
							// Else if a list item is hightlighted move highlight to the previous
							// item in the list.
							// If the top of list reached do nothing.
							$("li.s_highlighted").prev("li").addClass("s_highlighted");
							
							$(".s_highlighted").eq(-1).removeClass("s_highlighted");
						}
					}
					
					// If down arrow key is pressed do..
					if (event.keyCode == '40') {
						event.preventDefault();
						if( $('div.c_results').is(":visible") ){
							
							// If no list item is already highlight the first list item.
							// Else if a list item is hightlighted move highlight to the next
							// item in the list.
							// If the botton of list reached do nothing.
							$("li.s_highlighted + li").addClass("s_highlighted");
							
							$(".s_highlighted:eq(0)").removeClass("s_highlighted");
						}
					}
					
					// If the Enter key is pressed do..
					if(event.keyCode == '13'){
						// hide grey search suggestion text in search field
						// place the selected search result in the search field
						// hide the search result list
						$('.a-x').addClass("hidden");
						$('#comp_search').val( $('li.s_highlighted').text() ); 
						$('div.c_results').addClass("hidden");
						$('#comp_id').html( $('li.s_highlighted .comp_id').attr("id") );
					}
				});
				
				/**
				 * Click handler for adding comps attended to user profile.
				 */
				$('#Add').click(function(){
					
					$.ajax({
						url:'/edit_tools/ajax-update-member-profile/',
						type:'POST',
						data:'comp_id='+$('#comp_id').text(),
						dataType:'html',
						statusCode: {
							404: function() {
							}
						},
						success: function() {
							$.ajax({
								url:'/edit_tools/ajax-get-comps-attended/',
								type:'POST',
								data:'sid='+Math.random(),
								dataType:'html',
								statusCode: {
									404: function() {
									}
								},
								success: function(responseText) {
									//alert (responseText);
									$('#my_comp_list').html(responseText);
									
									// Add delete button
									$('#my_comp_list span.id').parent('li').append('<div class="b-e"></div>');
									
									$('div.b-e').click( function() {
										$.ajax({
											url:'/edit_tools/ajax-delete-comp-attended/',
											type:'POST',
											data:'comp_id='+$(this).prev('span').text()+'&sid='+Math.random(),
											dataType:'html',
											statusCode: {
												404: function() {
												}
											},
											success: function() {
												
												$.ajax({
													url:'/edit_tools/ajax-get-comps-attended/',
													type:'POST',
													data:'sid='+Math.random(),
													dataType:'html',
													statusCode: {
														404: function() {
														}
													},
													success: function(responseText) {
														// Append formatted list of comps attended
														$('#my_comp_list').html(responseText);
														
														// Add delete button
														$('#my_comp_list span.id').parent('li').append('<div class="b-e"></div>');
													},
													error: function() {
													},
													complete: function() {
													}
												});
												
											},
											error: function() {
											},
											complete: function() {
											}
										});
									})
									.hover(
										function(){
											$(this).parent().find("div.b-f").addClass('pink_highlight');
										},
										function(){
											$(this).parent().find("div.b-f").removeClass('pink_highlight');
										}
									);
								},
								error: function() {
								},
								complete: function() {
								}
							});
						},
						error: function() {
							alert("error");
						},
						complete: function() {
						}
					});
				})
				
				$.ajax({
					url:'/edit_tools/ajax-get-comps-attended/',
					type:'POST',
					data:'sid='+Math.random(),
					dataType:'html',
					statusCode: {
						404: function() {
						}
					},
					success: function(responseText) {
						// Append formatted list of comps attended
						$('#my_comp_list').html(responseText);
						
						// Add delete button
						$('#my_comp_list span.id').parent('li').append('<div class="b-e"></div>');
						
						$('div.b-e').click( function() {
							$.ajax({
								url:'/edit_tools/ajax-delete-comp-attended/',
								type:'POST',
								data:'comp_id='+$(this).prev('span').text()+'&sid='+Math.random(),
								dataType:'html',
								statusCode: {
									404: function() {
									}
								},
								success: function() {
									
									$.ajax({
										url:'/edit_tools/ajax-get-comps-attended/',
										type:'POST',
										data:'sid='+Math.random(),
										dataType:'html',
										statusCode: {
											404: function() {
											}
										},
										success: function(responseText) {
											// Append formatted list of comps attended
											$('#my_comp_list').html(responseText);
											
											// Add delete button
											$('#my_comp_list span.id').parent('li').append('<div class="b-e"></div>');
										},
										error: function() {
										},
										complete: function() {
										}
									});
									
								},
								error: function() {
								},
								complete: function() {
								}
							});
						})
						.hover(
							function(){
								$(this).parent().find("div.b-f").addClass('pink_highlight');
							},
							function(){
								$(this).parent().find("div.b-f").removeClass('pink_highlight');
							}
						);
					},
					error: function() {
					},
					complete: function() {
					}
				});
				break;
			case 'email':
				theFocus = "#email";
				if( $('#email_address').hasClass('a-c-a') ){ $('#email').val($('#email_address').text()); }
				break;
			case 'personal url':
				theFocus = "#p_url";
				if( $('#personal_url').hasClass('a-c-a') ){ $('#p_url').val($('#personal_url').text()); }
				break;
			case 'facebook url':
				theFocus = "#f_url";
				if( $('#facebook_url').hasClass('a-c-a') ){ $('#f_url').val($('#facebook_url').text()); }
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
			.css('height',get_viewportHeight()/*$(window).height()*/+'px')
			.removeClass('hidden');
			
		/**
		 * Click cancel button to hide the update form & background dimmer
		 */
		$('#Cancel').click(function(){
			$('.update_form')
				.attr('style','')
				.addClass('hidden');
			$('.light_dimmer').addClass('hidden');
			
			if(feature_to_update = "comps i've attended") {
				$.ajax({
					url:'/edit_tools/ajax-get-comps-attended/',
					type:'POST',
					data:'sid='+Math.random(),
					dataType:'html',
					statusCode: {
						404: function() {
						}
					},
					success: function(responseText) {
						// Append formatted list of comps attended
						$('div#ca').html(responseText);
					},
					error: function() {
					},
					complete: function() {
					}
				});
			}
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
					var status = '';
					$('input:checked').each( function() {
						status += $(this).val() + "|";
					});
				
					theData = 'status='+status.substring(0, status.length-1);
					
					// Ignore or use ajax call below this switch statement
					use = true;
					
					break;
				case 'dance level(s)':
					var levels ='';
					$('input:checked').each( function() {
						levels += $(this).val() + "|";
					});
					
					theData = 'levels='+levels.substring(0, levels.length-1);
					
					// Ignore or use ajax call below this switch statement
					use = true;
					
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
						url:'/wp-content/themes/charlotte_dancesport/ajax_helper/email_validator.php',
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
									data:theData,
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
											data:'sid='+Math.random(),
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
					data:theData,
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
							case 'member status':
								if( $('input:checked').size() === 0 ){
									$('#member_status')
										.text('For example: Club Teasurer, Bronse Team member, non student, etc.')
										.removeClass('a-c-a');
								} else {
									$('#member_status')
										.text( ( ( (theData.replace("status=", "")).replace(/\|/g,", ") ).replace(/officer_/g,"") ).replace(/member_/g,"") )
										.addClass('a-c-a');
								}
							break;
							case 'dance level(s)':
								if( $('input:checked').size() === 0 ){
									$('#dance_level')
										.text('What level(s) do you currently compete at?')
										.removeClass('a-c-a');
								} else {
									$('#dance_level')
										.text( (theData.replace("levels=", "")).replace(/\|/g,", ") )
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
		if( !$('#first_name').hasClass('a-f') ){ $('#f_name').val($('#first_name').text()); }
		if( !$('#last_name').hasClass('a-f') ){ $('#l_name').val($('#last_name').text()); }
			
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
			
			$.ajax({
				url:'/edit_tools/ajax-update-member-profile/',
				type:'POST',
				data:'f_name='+$('#f_name').val()+'&l_name='+$('#l_name').val(),
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
					
					// Update the users first name on profile page
					if( isEmpty($('#f_name').val() ) ){
						$('#first_name')
							.text('First')
							.addClass('a-f');								
					} else {
						$('#first_name')
							.text($('#f_name').val())
							.removeClass('a-f');
					}
					
					// Update the users last name on profile page
					if( isEmpty($('#l_name').val() ) ){
						$('#last_name')
							.text('Last')
							.addClass('a-f');								
					} else {
						$('#last_name')
							.text($('#l_name').val())
							.removeClass('a-f');
					}	
				},
				error: function(){
					alert('error');
				},
				complete: function(){
					
				}
			});
		});
		
	});
});