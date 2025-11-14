// for latest pins jquery ends
	jQuery(window).load(function(){
		var $container = jQuery('.apspp-caption-disabled,.apspp-caption-enabled');
		// init
		if ($container.length) {
			$container.isotope({
			  // options
			  itemSelector: '.apspp-pinterest-latest-pin',
			});
		}
	});
// for latest pins jquery ends

jQuery(document).ready(function($) {
	/*
	* Click method 
	*/
	 $('body').on('click','.app-pinit-button',function(){
       	var indexer = $(this).data('app-indexer');
       	var url = $('img[data-app-indexer="'+indexer+'"]').attr('src');

       	apspp_js_settings.description_source_settings = {
				pageUrl        		: document.URL,
				pageTitle      		: document.title,
				pageDescription		: $('meta[name="description"]').attr('content') || "",
			}
       	//Bookmark description is created on click because sometimes it's lazy loaded
       	var bookmarkDescription = "";

       	if ( apspp_js_settings.descriptionOption == '1' ) //for page title
       		bookmarkDescription = apspp_js_settings.description_source_settings.pageTitle;

       	if(apspp_js_settings.descriptionOption == '2') // for page description
       		bookmarkDescription = apspp_js_settings.description_source_settings.pageDescription;

   		if(apspp_js_settings.descriptionOption == '3') // for site title
   			bookmarkDescription = apspp_js_settings.siteTitle;

   		if(apspp_js_settings.descriptionOption == '4') // for image alt tag
   			bookmarkDescription = $('img[data-app-indexer="'+indexer+'"]').attr('alt');
   		
   		if(apspp_js_settings.descriptionOption == '5') // for image title tag and if not alt tag
   			bookmarkDescription = $('img[data-app-indexer="'+indexer+'"]').attr('title') || $('img[data-app-indexer="'+indexer+'"]').attr('alt');

       	bookmarkDescription = bookmarkDescription || apspp_js_settings.pageTitle;

       	var pin_url = 'http://pinterest.com/pin/create/bookmarklet/?is_video=' + encodeURIComponent('false')+ "&url=" + encodeURIComponent( apspp_js_settings.description_source_settings.pageUrl ) + "&media=" + encodeURIComponent(  url  )+ '&description=' + encodeURIComponent( bookmarkDescription );
        window.open(pin_url,'Pinterest','width=800,height=600,status=0,toolbar=0,menubar=0,location=1,scrollbars=1');
        return false;
    });



	/* function to check the image size  */
	function CheckImageSize( $image ) {
			if ( $image[0].clientWidth < apspp_js_settings.minImageWidth || $image[0].clientHeight < apspp_js_settings.minImageHeight )
				return false;
			return true;
	}


	/* function to add images for pinit buttons */
	function addImages( selector ) {
		var imageMaxIndex = 0;
		var notSelector='';
		notSelector = createSelectorFromList( apspp_js_settings.disabledClasses );
		var filterSelector='';
		filterSelector=createSelectorFromList( apspp_js_settings.enabledClasses ) || "*";
		var $elements = $(selector)
				.not( notSelector )
				.not( '[data-app-indexer]' )
				.filter( filterSelector );

		$elements.each( function () {
			$( this ).attr('data-app-indexer', imageMaxIndex);
			imageMaxIndex++;
		});
		return $elements;
	};

	//function creates a selector from a list of semicolon separated classes
	function createSelectorFromList(classes) {
		var arrayOfClasses = classes.split( ',' );
		var selector = "";
		for (var i = 0; i < arrayOfClasses.length; i++) {
			if ( arrayOfClasses[i] )
				selector += '.' + arrayOfClasses[i].trim() + ',';
		}

		if (selector)
			selector = selector.substr(0, selector.length - 1);
			return selector;
	}
    /*
	*	function for creating pinit button
    */
	function create_pinit_button($image){
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
									  };

			//adjust button size if retina active
			if (apspp_js_settings.retinaFriendly == 'on'){
				pinButtonDimensions.height = pinButtonDimensions.height/2;
				pinButtonDimensions.width = pinButtonDimensions.width/2;
			}
									  
			var pinButtonMargins = {
									top: parseInt( apspp_js_settings.buttonMarginTop ),
									right: parseInt( apspp_js_settings.buttonMarginRight ),
									bottom: parseInt( apspp_js_settings.buttonMarginBottom ),
									left: parseInt( apspp_js_settings.buttonMarginLeft )
									};

			var notSelector = "";
			var filterSelector = "*";
				//alert(pinButtonMargins.bottom);
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
                .show()
				.offset({ left: position.left, top: position.top });
			
		} else {
			//button exists, we need to clear the timeout that has to remove it
			clearTimeout( $button.data('app-timeoutId') );
		}
		$image.addClass( 'pinit-hover' );
	}


	if(typeof(apspp_js_settings) != "undefined" && apspp_js_settings !== null) {
		$('.apspp').closest(apspp_js_settings.containerSelector).addClass('apspp-container');
		var img = addImages(apspp_js_settings.imageSelector);
		/**
		 * Mobile devices detection
		 **/
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		  // tasks to do if it is a Mobile Device
		  if( apspp_js_settings.buttonDisplayOption !='1' && apspp_js_settings.buttonDisplayBelowImage=='on'){
		  	$(window).load(function(){
		  		$('img[data-app-indexer]').each(function(){
					var $image = $( this );
						create_pinit_button($image);
				});
		  	});
		  }
		}
	}

	//show the pinterest button according to the selected options
	if(typeof(apspp_js_settings) != "undefined" && apspp_js_settings !== null) {
		if( apspp_js_settings.buttonDisplayOption =='1'){
			$(window).load(function(){
				$('img[data-app-indexer]').each(function(){
					var $image = $( this );
							create_pinit_button($image);
				});
			});

		}else{

			$( 'body' ).on( 'mouseenter','img[data-app-indexer]', function() {
			   	var $image = $( this );
			   	if (CheckImageSize ( $image) == false ){
					$image.removeAttr( 'data-app-indexer' );
					return;
				}
				create_pinit_button($image);
				
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

		} // end else
	}
});