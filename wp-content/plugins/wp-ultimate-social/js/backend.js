(function ($) {
    $(function () {
        $('.us-plugin-title,.us-view-detail').click(function(){
            $('.us-popup-overlay').fadeIn(300);
             $(this).parent().find('.us-popup-wrapper').fadeIn(500); 
        });
        
        $('.us-popup-close').click(function(){
           $(this).parent().fadeOut(300);
           $('.us-popup-overlay').fadeOut(300);
        });
        
         $('.us-popup-overlay').click(function(){
             $(this).fadeOut(300);
             $('.us-popup-wrapper').fadeOut(300);
         });
    });//document.ready close
}(jQuery));
