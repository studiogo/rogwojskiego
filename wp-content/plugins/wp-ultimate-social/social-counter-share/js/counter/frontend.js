jQuery(document).ready(function($){
	$('.apsc-floating-bar-show-hide').toggle(function(){
        $('.apsc-floating-sidebar').addClass('floatingbar-hidden');
        $('.apsc-floating-bar-show-hide').addClass('apsc-hidden');
    }, function(){
        $('.apsc-floating-sidebar').removeClass('floatingbar-hidden');
        $('.apsc-floating-bar-show-hide').removeClass('apsc-hidden');
    });
	
});