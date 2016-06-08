/* 
 * Masonry settings to organize footer widgets
 */

jQuery(document).ready(function($){
    var $container = $('#footer-widgets');
    var $masonryOn;
    var $columnWidth = 400;
    
    if ($(document).width() > 879) {;
        $masonryOn = true;
        runMasonry();
    };

    $(window).resize( function() {
        if ($(document).width() < 879) {
            if ($masonryOn){
                $container.masonry('destroy');
                $masonryOn = false;
            }

        } else {
            $masonryOn = true;
            runMasonry();
        }
    });
    
    function runMasonry() {
        // initialize
        $container.masonry({
            columnWidth: $columnWidth,
            itemSelector: '.widget',
            isFitWidth: true,
            isAnimated: true
        });
    };
    
});