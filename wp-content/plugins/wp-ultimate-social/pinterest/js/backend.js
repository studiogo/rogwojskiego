jQuery(document).ready(function($){

	//Uploading media using new media uploader (Wordpress 3.5+)

	var file_frame;

	$('#apspp-custom-image-upload').click(function(e) {
		e.preventDefault();

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select your custom "Pin It" button',
			button: {
				text: 'Use as "Pin It" button'
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// alert('Tango');
			// We set multiple to false so only get one image from the uploader
			var image = file_frame.state().get('selection').first().toJSON();

			$("#apspp_custom_image_url").val(image.url);
			$("#apspp_custom_image_width").val(image.width);
			$("#apspp_custom_image_height").val(image.height);
		});

		file_frame.open();
	});


	$( '.apspp-tabs-trigger' ).click(function(){
        $( '.apspp-tabs-trigger' ).removeClass( 'apspp-active-tab' );
        $(this).addClass( 'apspp-active-tab' );
        var board_id = 'tab-'+$(this).attr('id');
        $('.apspp-tab-contents').hide();
        $('#'+board_id).show();
       });

	$('.widget-liquid-right').on('change', '.apspp-board-custom-sizes-options', function(){
		var changed_value= $(this).val();
		if(changed_value == 'custom'){
			$('.apspp-board-custom-size-values').fadeIn();
		}else{
			$('.apspp-board-custom-size-values').fadeOut();
		}
	});


	$('.widget-liquid-right'). on('change', '.apspp-profile-custom-sizes-selection', function(){
		var changed_value= $(this).val();
		if(changed_value == 'custom'){
			$('.apspp-profile-custom-size-values').fadeIn();
		}else{
			$('.apspp-profile-custom-size-values').fadeOut();
		}
	});

	$('#apspp-pinterest-button-shape').change(function(){
		var changed_value= $(this).val();
		if(changed_value == 'rectangular'){
			$('.apspp-rectangular-options').fadeIn();
		}else{
			$('.apspp-rectangular-options').fadeOut();
		}
	});

	$("#refresh_custom_button_preview").click( function(e) {
		e.preventDefault();
		var customWidth = $('#apspp_custom_image_width').val();
		var customHeight = $('#apspp_custom_image_height').val();
		var customUrl = $('#apspp_custom_image_url').val();

		$('#custom_button_preview')
				.css(
					{
						width: customWidth,
						height: customHeight,
						"display": "block",
						"background-image": "url('" +  customUrl + "')"
					}
				);
		return false;
	});

	$('#apspp_js_enabled').click(function(){
		if($('#apspp_js_enabled').is(':checked')){
			$('.apspp-display-settings').fadeIn('fast', function() {
				// alert('done');
			});
		}else{
			$('.apspp-display-settings').fadeOut('fast', function() {
				// alert('done');
			});
		}
		// alert('ck');
	});



});