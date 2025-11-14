jQuery(document).ready(function($) {

$(window).load(function(){	
var $container = $('.apspp-caption-disabled,.apspp-caption-enabled');
// init
$container.isotope({
  // options
  itemSelector: '.apspp-pinterest-latest-pin',
});
});









//EVENT HANDLING - ADDING EVERY NEEDED EVENT
            var index = 0;
			$('img').each(function(){
				$(this).hasClass('');
			 $(this).attr('data-app-indexer',index);
             index++;
			});
            
            $( 'body' ).on( 'mouseenter','img[data-app-indexer]', function() {
               	var $image = $( this );
                var indexer = $image.data( 'app-indexer' );
				var $button = $('.app-pinit-button[data-app-indexer="' + indexer + '"]');



				if ( $button.length == 0 ) {
					//button doesn't exist so we need to create it
					$button = '<a href="javascript:void(0);" class="app-pinit-button"  data-app-indexer="'+indexer+'" ></a>';
					var position = $image.offset();
					var imageDimensions = {
						width: $image.get(0).clientWidth,
						height: $image.get(0).clientHeight
					}

					var pinButtonDimensions = {
												height: parseInt( apspp_js_settings.pinImageHeight ),
												width: parseInt( apspp_js_settings.pinImageWidth )
											  }

					var pinButtonMargins = {
											top: parseInt( apspp_js_settings.buttonMarginTop ),
											right: parseInt( apspp_js_settings.buttonMarginRight ),
											bottom: parseInt( apspp_js_settings.buttonMarginBottom ),
											left: parseInt( apspp_js_settings.buttonMarginLeft )
										};

					var notSelector = "";
					var filterSelector = "*";
						// alert(position.top);
					switch( apspp_js_settings.buttonPosition ){
						case '1': //top-left
							position.left += pinButtonMargins.left;
							position.top += pinButtonMargins.top;
							break;
						case '2': //top-right
							position.top += pinButtonMargins.top;
							position.left = position.left + imageDimensions.width - pinButtonMargins.right - pinButtonDimensions.width;
							break;
						case '3': //bottom-left;
							position.left += pinButtonMargins.left;
							position.top = position.top + imageDimensions.height - pinButtonMargins.bottom - pinButtonDimensions.height;
							break;
						case '4': //bottom-right
							position.left = position.left + imageDimensions.width - pinButtonMargins.right - pinButtonDimensions.width;
							position.top = position.top + imageDimensions.height - pinButtonMargins.bottom - pinButtonDimensions.height;
							break;
						case '5': //middle
							position.left = Math.round( position.left + imageDimensions.width / 2 - pinButtonDimensions.width / 2 );
							position.top = Math.round( position.top + imageDimensions.height / 2 - pinButtonDimensions.height / 2 );
							break;
					}

                    $image.after( $button );
                    $('.app-pinit-button[data-app-indexer="'+indexer+'"]')
                        //.show()
						.offset({ left: position.left+10, top: position.top+10 });
					
				} else {
					//button exists, we need to clear the timeout that has to remove it
					clearTimeout( $button.data('app-timeoutId') );
				}
				$image.addClass( 'pinit-hover' );
			});
            
            	$( document).on(  'mouseleave','img[data-app-indexer]', function() {
				var indexer = $(this).data("app-indexer");
				var $button = $('a.app-pinit-button[data-app-indexer="' + indexer + '"]');

				var timeoutId = setTimeout(function(){
					$button.remove();
					$('img[data-app-indexer="' + $button.data( 'app-indexer' ) + '"]').removeClass( 'pinit-hover' );
				}, 100 );
				$button.data('app-timeoutId', timeoutId);
			});
            
            $( document ).on(  'mouseenter','a.app-pinit-button', function() {
				var $button = $( this );
                clearTimeout( $button.data('app-timeoutId') );
			});

			$( document ).on( 'mouseleave', 'a.app-pinit-button', function() {
				var $button = $( this );
				var timeoutId = setTimeout( function(){
					$button.remove();
					$('img[data-app-indexer="' + $button.data( 'app-indexer' ) + '"]').removeClass( 'pinit-hover' );
				}, 100 );
				$button.data('app-timeoutId', timeoutId);
			});
            
            $('body').on('click','.app-pinit-button',function(){
               var indexer = $(this).data('app-indexer');
               var url = $('img[data-app-indexer="'+indexer+'"]').attr('src');
               var pin_url = 'http://pinterest.com/pin/create/bookmarklet/?is_video=' + encodeURIComponent('false')+ "&url=" + encodeURIComponent( document.URL ) + "&media=" + encodeURIComponent(  url  )+ '&description=' + encodeURIComponent( document.title );
            window.open(pin_url,'Pinterest','width=800,height=800,status=0,toolbar=0,menubar=0,location=1,scrollbars=1');
            return false;
            });
   
});





//$(".entry-content").pinMe({pinButton: '<img src="'+apspp_options.custom_image_url+'" style="width: 50px; height: 50px;"', showOnHover: true});



