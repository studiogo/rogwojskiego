function removeMe(args){
jQuery('.'+args).html('');
}

(function ($) {
    $(function () {
        //all backend js goes here

        //sortable initialization
        $('.apps-opt-wrap').sortable({
            containment: "parent",
            update:function(event,ui){ 
                        var profile_array = [];
                        $('.apss-option-wrapper input[type="checkbox"]').each(function(){
                        profile_array.push($(this).attr('data-key')) ;
                        });
                        var social_networks_orders = profile_array.join(',');
                        $('#apss_social_newtwork_order').val(social_networks_orders);
                    }
        });

        $('.apps-opt-wrap1').sortable({
            containment: "parent",
            update:function(event,ui){ 
                        var profile_array = [];
                        $('.apss-option-wrapper1 input[type="checkbox"]').each(function(){
                        profile_array.push($(this).attr('data-key')) ;
                        });
                        var social_networks_orders = profile_array.join(',');
                        $('#apss_floating_social_newtwork_order').val(social_networks_orders);
                    }
        });


        $( '.apss-tabs-trigger' ).click(function(){ 
          $( '.apss-tabs-trigger' ).removeClass( 'apss-active-tab' );
          $(this).addClass( 'apss-active-tab' );
          var board_id = 'tab-'+$(this).attr('id');
          $('.apss-tab-contents').hide();
          $('#'+board_id).show();
        });

       $('#apss_submit_settings').click(function(){
        var cache_period_val=$('#apss_cache_period').val();
        if($.isNumeric(cache_period_val)===true){ 
       }else{
        $('.invalid_cache_period').html("Please enter the integer value only.");
        $('.apss_cache_period').focus();
        return false;
       }
       }); 

       $('.floating_positions_enable_disable').click(function(){
       if($(this).val()==='1') {
           $('.apss_floating_sidebar_options').show();
                
        }else{
            $('.apss_floating_sidebar_options').hide();
        }
        
       });


       $('.floating_count_enabler').click(function(){
          if($(this).val()==='1') {
           $('.apss_floating_count_type').show();
                
          }else{
            $('.apss_floating_count_type').hide();
        }
       });

        $('.select_all_media').click(function(){

          if($(this).is(':checked')){
            $('.social_networks_class').attr('checked','checked');
          }
          else
          {
            $('.social_networks_class').removeAttr('checked');
          }
       });

        $('.select_all_floating_media').click(function(){
          //alert('check');
          if($(this).is(':checked')){
            $('.social_floating_networks_class').attr('checked','checked');
          }
          else
          {
            $('.social_floating_networks_class').removeAttr('checked');
          }
        });

        $('#counter_enable_options_y').click(function(){
            $('.apss-counter-api-options').show();
        });

        $('#counter_enable_options_n').click(function(){
          $('.apss-counter-api-options').hide();
        });

        // Uploading media using new media uploader (Wordpress 3.5+)
        var file_frame;
        $('#apss-custom-image-upload').click(function(e) {
          e.preventDefault();

          // If the media frame already exists, reopen it.
          if ( file_frame ) {
            file_frame.open();
            return;
          }

          // Create the media frame.
          file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select your stick header share site logo',
            button: {
              text: 'Use as sticky header share site logo'
            },
            multiple: false  // Set to true to allow multiple files to be selected
          });

          // When an image is selected, run a callback.
          file_frame.on( 'select', function() {
            // We set multiple to false so only get one image from the uploader
            var image = file_frame.state().get('selection').first().toJSON();

            $("#apss_custom_image_url").val(image.url);
            $("#apss_custom_image_width").val(image.width);
            $("#apss_custom_image_height").val(image.height);
          });

          file_frame.open();
        });

        $("#apss_refresh_custom_button_preview").click( function(e) {
          e.preventDefault();
          var customWidth = $('#apss_custom_image_width').val();
          var customHeight = $('#apss_custom_image_height').val();
          var customUrl = $('#apss_custom_image_url').val();

          // $('#apss_custom_button_preview')
          //     .css(
          //       {
          //         width: customWidth,
          //         height: customHeight,
          //         "display": "block",
          //         "background-image": "url('" +  customUrl + "')"
          //       }
          //     );
          $('.apss_custom_button_image_preview').attr('src', customUrl);
          return false;
        });

        /////////////////////////////////////////////////////////////////////////

        $('.apss-sticky-header-share-enable').click(function(){
          if($(this).is(':checked')){
            //show the content
            $('.apss-sticky-header-share-settings-wrapper').show();
          }else{
            // hide the content
            $('.apss-sticky-header-share-settings-wrapper').hide();
          }
        });
    });//document.ready close

}(jQuery));