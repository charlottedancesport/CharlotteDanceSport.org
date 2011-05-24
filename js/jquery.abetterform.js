<!-- 

/**
 * A Better Form
 * Version 1.0.7
 * A plugin for jQuery ©2010 Jason Lau - http://JasonLau.biz
 * Based on a work at http://jasonlau.biz/ .
 * This program is free software licensed under the CC-GNU GPL version 2.0 or later.
 * The CC-GNU GPL can be found at http://creativecommons.org/licenses/GPL/2.0/.
 * The GNU General Public License is a Free Software license. Like any Free Software license, it grants to you the four following freedoms:

   1. The freedom to run the program for any purpose.
   2. The freedom to study how the program works and adapt it to your needs.
   3. The freedom to redistribute copies so you can help your neighbor.
   4. The freedom to improve the program and release your improvements to the public, so that the whole community benefits.

 * You may exercise the freedoms specified here provided that you comply with the express conditions of this license. The principal conditions are:
 
   1. You must conspicuously and appropriately publish on each copy distributed an appropriate copyright notice and disclaimer of          warranty and keep intact all the notices that refer to this License and to the absence of any warranty; and give any other           recipients of the Program a copy of the GNU General Public License along with the Program. Any translation of the GNU General        Public License must be accompanied by the GNU General Public License.
   2. If you modify your copy or copies of the program or any portion of it, or develop a program based upon it, you may distribute        the resulting work provided you do so under the GNU General Public License. Any translation of the GNU General Public License        must be accompanied by the GNU General Public License.
   3. If you copy or distribute the program, you must accompany it with the complete corresponding machine-readable source code or         with a written offer, valid for at least three years, to furnish the complete corresponding machine-readable source code.
   
 * Permissions beyond the scope of this license may be requested at http://jasonlau.biz/home/contact-me.
 *
 */

(function($){
    
 	$.fn.extend({ 
 	  
 		abform: function(options){
 		 
                var defaults = {
                attributes : 'id="my-form" action="#" method="post"',
                sequential_disable : true,
                pluggable : false,
                serialized : true,
                multipart : false,
                clickonce : true,
                filtertext : true,
                textfilters : 'url=,link=,http:,www.,href,<a',
                convert : false,
                obj :  $(this)                    
			}
            				
			var options =  $.extend(defaults, options);
            var obj = $(this); 
                      
    		return this.each(function(){
    		  
				var o = options,
                attributes = o.attributes,
                sequential_disable = o.sequential_disable,
                pluggable = o.pluggable,
                serialized = o.serialized,
                multipart = o.multipart,
                clickonce = o.clickonce,
                filtertext = o.filtertext,
                textfilters = o.textfilters,
                convert = o.convert,
                all_ids = [];
                var id = obj.attr('id');
                
                if(convert){
                    
                    var elements = convert.split('{');
                    
                    for(var i in elements){
                      if(i > 0){
                        var element = elements[i].split('}');
                      element = element[0];
                      
                      var e = element.split('|');
                      var e_id = (!e[0]) ? alert('Error! Code misconfiguration. Disable A Better Form convert option or check the documentation to learn how to properly code the convert option. You are missing the element id option.') : e[0];
                      var e_type = (!e[1]) ? alert('Error! Code misconfiguration. Disable A Better Form convert option or check the documentation to learn how to properly code the convert option. You are missing the element type option.') : e[1];    
                      var e_attributes = (e[2]) ? ' ' + e[2] : '';
                      var e_value = $("#" + e_id).html();
                      
                      var newElement = '';
                      
                      switch(e_type){
                        
                        case 'text':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        case 'textarea':                        
                        newElement = '<textarea id="' + e_id + '" name="' + e_id + '"' + e_attributes + '>' + e_value + '</textarea>';
                        break;
                        
                        case 'password':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        case 'file':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        case 'button':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        case 'submit':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        case 'reset':                   
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        case 'image':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" src="' + e_value + '"' + e_attributes + ' />';
                        break;
                                                
                        case 'radio':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        case 'checkbox':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        case 'select':                        
                        newElement = '<select id="' + e_id + '" name="' + e_id + '"' + e_attributes + '>';
                        $("#" + e_id + " ul").each(function(){
                            if($(this).attr('title')){
                              newElement += '<optgroup label="' + $(this).attr('title') + '">';  
                            }                       
                            
                        $("li").each(function(){
                            newElement += '<option value="' + $(this).attr('id') + '">' + $(this).html() + '</option>'; 
                        });
                        
                        if($(this).attr('title')){
                              newElement += '</optgroup>';  
                            }
                        });
                        newElement += '</select>'; 
                        
                        break;
                        
                        case 'hidden':                        
                        newElement = '<input id="' + e_id + '" name="' + e_id + '" type="' + e_type + '" value="' + e_value + '"' + e_attributes + ' />';
                        break;
                        
                        
                      }
                      
                      $("#" + e_id).replaceWith(newElement);
                                            
                      }                    
                  }
                }
                
                var all_fields = $('#'+id+' input, #'+id+' textarea, #'+id+' select');
                $('#'+id+' input, #'+id+' textarea, #'+id+' select').each(function(){
                    
                all_ids.push($(this).attr('id'));
                
                if($(this).is('input') && ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox')){
                    
                    $(this).attr('name',$(this).attr('id'));
                    
                    }
                
                });
                
                if(sequential_disable){
                    
                   all_fields.attr('disabled', 'disabled');
                   all_fields.first().attr('disabled', '');
                   seq_dis(id, all_ids);
                    
                }
                                
                $('#'+id+' input, #'+id+' textarea, #'+id+' select').each(function(a){
                    
                    var next_item = a+1;
                    var next_id = $('#'+all_ids[next_item]).attr('id'); 
  
                    if($(this).is('select') || ($(this).is('input') && ($(this).attr('type') == 'file' || $(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox'))){
                        
                        $(this).bind('change',function(){
                                                       
                            if($(this).val() != ''){
                                
                                $(this).attr('name',$(this).attr('id'));
                                $('#'+all_ids[next_item]).attr('disabled', '');
                                                                            
                            } else {
                                
                                if($(this).attr('type') != 'radio' || $(this).attr('type') != 'checkbox'){
                                    
                                $(this).attr('name','');  
                                
                                }                              
                             
                            }
                            
                            if(sequential_disable){ seq_dis(id, all_ids); }
                                                    
                        });
                    }
                    
                    if($(this).is('input, textarea') && $(this).attr('type') != 'file' && $(this).attr('type') != 'radio' && $(this).attr('type') != 'checkbox'){
                        
                        $(this).bind('keyup change',function(){
                            
                            if($(this).val() != ''){
                                
                                if(filtertext){
                                    
                                  var t_filters = textfilters.split(',');
                                  
                                  for(var i in t_filters){
                                    
                                    var checkit = $(this).val().split(t_filters[i]);
                                    
                                    if(checkit.length > 1){
                                        
                                        $(this).val(checkit[0]);
                                        
                                    }
                                  }  
                                    
                                }
                                                                
                                $('#'+all_ids[next_item]).attr('disabled', '');
                                $(this).attr('name',$(this).attr('id')); 
                                
                            } else {
                                
                                $(this).attr('name','');
                                                                 
                            }
                            
                            if(sequential_disable){ seq_dis(id, all_ids); } 
                                                   
                        });
                    } 
                                       
                });
                
                $('#'+id+' optgroup').each(function(i){
                    
                    if($(this).hasClass('aboptgroup')){
                        
                        var this_html = $(this).html();
                        $(this).replaceWith('\n<optgroup label="' + $(this).attr('id') +'">\n'
                                            + this_html
                                            + '\n</optgroup>\n');  
                        $(this).attr('label',$(this).attr('id'));
                        
                    } else {
                        
                        $(this).attr('name',$(this).attr('id'));
                                               
                    }
                });
                                
                $('.absubmit').bind('click',function(){ 
                    
                    if($(this).attr('disabled') != 'disabled'){
                        $('#'+id+' input').each(function(){
                            if($(this).attr('type') == 'hidden'){
                              $(this).attr({
                                disabled : '',
                                name : $(this).attr('id')
                                });  
                            }
                        });
                        var innerWrap = (multipart) ? "<form " + attributes + " enctype=\"multipart/form-data\"></form>" : "<form " + attributes + "></form>" ;
                        
                        obj.wrapInner(innerWrap);
                        
                        if(pluggable && $.isFunction(pluggable)){
                            
                            if(serialized){
                                
                                pluggable($(':parent').serialize()); 
                                 
                            } else {
                                
                                pluggable();
                                
                            }                      
                            
                        } else {
                            
                           $(':parent').submit(); 
                           
                        }
                    }
                    
                    if(clickonce){
                        
                       $(this).attr('disabled','disabled'); 
                        
                    }
                     
                });
    		});
            
            function seq_dis(id, all_ids){
                $('#'+id+' input, #'+id+' textarea, #'+id+' select').each(function(b){
                    
                    var sd = false;
                    
                    for(var c in all_ids){
                        
                        if(c < b){
                            
                            if($('#'+all_ids[c]).val() == ''){
                                
                                sd = true;
                                
                            }
                        }
                    }
                    
                    if(sd){
                        
                        $('#'+all_ids[b]).attr('disabled', 'disabled');
                        
                    } else {
                        
                        if($(this).is('input') && ($(this).attr('type') == 'radio' || $(this).attr('type') == 'checkbox')){
                            
                          $('[id=' + $(this).attr('id') + ']').each(function(){
                            
                            $(this).attr('disabled', '');
                            
                          }); 
                           
                        } else {
                            
                          $('#'+all_ids[b]).attr('disabled', '');  
                          
                        }
                        
                    } 
                                          
                });
            };
                                        
 		}
	});	
})(jQuery);

 -->