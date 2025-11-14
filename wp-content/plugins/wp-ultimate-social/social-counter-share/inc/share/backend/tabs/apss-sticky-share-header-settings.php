<!-- for sticy header -->
<h2><?php _e('Sticky header share settings:', APSS_TEXT_DOMAIN); ?></h2>
<div class="apss-row">
<label class='apss-label-control apss-sticky-share-yes'><?php _e("Enable Sticky share buttons at top?", APSS_TEXT_DOMAIN ); ?></label>

<input type="checkbox" class='apss-sticky-header-share-enable' name="apss_share_settings[social_share_sticky_share][enable]" value='1' <?php if(isset($options['social_share_sticky_share']['enable'])){ checked( $options['social_share_sticky_share']['enable'], 1 ); } ?> />
</div>
<div class='apss-sticky-header-share-settings-wrapper' <?php if(isset($options['social_share_sticky_share']['enable']) && $options['social_share_sticky_share']['enable'] == '1'){ ?> style='display:block;' <?php }else{ ?> style='display:none;' <?php  } ?> >
        <?php ///////////////////////////////// ?>
  <div class="apss-row">
    <label class='apss-label-control apss-sticky-share-upload-site-logo'><?php _e( 'Upload your site logo', APSS_TEXT_DOMAIN ); ?></label>
    <button id="apss-custom-image-upload"><?php _e('Upload an image using media library', APSS_TEXT_DOMAIN ); ?></button>
  </div>
    <div class="apss-custom-address apss-row">
        <label class='apss-label-control' for="apss_custom_image_url"><?php _e('URL address of site logo', APSS_TEXT_DOMAIN ); ?></label>
        <input type="url" id="apss_custom_image_url" name="apss_share_settings[social_share_sticky_share][image_url]" value="<?php if(isset($options['social_share_sticky_share']['image_url'])){ echo $options['social_share_sticky_share']['image_url']; } ?>">
    </div>

    <div class="apss-custom-image"  style="display:none;">
        <label for="apss_custom_image_height"><?php _e('Height', APSS_TEXT_DOMAIN ); ?></label>
        <input type="number" min="0" step="1" id="apss_custom_image_height" name="apss_share_settings[social_share_sticky_share][image_height]" value="<?php if(isset($options['social_share_sticky_share']['image_height'])){ echo $options['social_share_sticky_share']['image_height']; } ?>" class="small-text"> px
    </div>

    <div class="apss-custom-image" style="display:none;">
        <label for="apss_custom_image_width"><?php _e('Width', APSS_TEXT_DOMAIN ); ?></label>
        <input type="number" min="0" step="1" id="apss_custom_image_width" name="apss_share_settings[social_share_sticky_share][image_width]" value="<?php if(isset($options['social_share_sticky_share']['image_width'])){ echo $options['social_share_sticky_share']['image_width']; } ?>" class="small-text"> px
    </div>
  <div class="apss-row">
    <b class="custom-bold"><?php _e('Sticky header share site logo preview', APSS_TEXT_DOMAIN ); ?></b>
     </div>
    <?php
    if(isset($options['social_share_sticky_share'])){
        foreach ($options['social_share_sticky_share'] as $key => $value) {
        $$key = $value;
        }
    }else{
        $image_width='0';
        $image_height='0';
        $image_url = '';
    }
    ?>
    <span id="apss_custom_button_preview" class="custom-preview" <?php /* ?> style="display: block; width: <?php echo $image_width.'px'; ?>; height: <?php echo $image_height.'px'; ?>; background-image: url('<?php echo $image_url; ?>'); " <?php */ ?>>
    <img class='apss_custom_button_image_preview' src='<?php echo $image_url; ?>' />
    </span>
 <div class="apss-row">
        <button id="apss_refresh_custom_button_preview" class="preview-btn">Refresh preview</button>
    </div>
<?php /////////////////////////////////////////////////////////// ?>

</div>



<!-- for sticy header ends -->