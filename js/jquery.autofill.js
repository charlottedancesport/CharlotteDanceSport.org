// Auto-Fill Plugin
(function($){$.fn.autofill=function(options){var defaults={value:"",defaultBackgroundImage:"../image/email.png",activeBackgroundImage:"../image/email.png"};var options=$.extend(defaults,options);return this.each(function(){var obj=$(this);obj.css('backgroundImage',options.defaultBackgroundImage).val(options.value).focus(function(){if(obj.val()==""){obj.css('backgroundImage',options.activeBackgroundImage);}}).blur(function(){if(obj.val()==""){obj.css('backgroundImage',options.defaultBackgroundImage).val(options.value);}});});};})(jQuery);