/* 
 * Custom Responsive Superfish configuration
 * 
 * version 0.1
 * date 01 june 2016
 * 
 */

jQuery(document).ready(function($){
    var breakpoint = 600;
    var navigation = $('ul.nav-menu');
	
    if($(document).width() >= breakpoint){
        navigation.superfish({
            delay: 50,
            speed: 'fast'
        });
    }
	
    $(window).resize(function(){
        if($(document).width() >= breakpoint & !navigation.hasClass('sf-js-enabled')){
            navigation.superfish({
                delay: 200,
                speed: 'fast'
            });
        } else if($(document).width() < breakpoint) {
            navigation.superfish('destroy');
        }
    });
});