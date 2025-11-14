<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="apspp-backend-wrapper clearfix">

<div class="apspp-setting-header clearfix">
        <div class="apspp-headerlogo">
            <div class="apspp-logo"><?php /*<img src='<?php echo APSP_PRO_IMAGE_DIR.'/logo.png'; ?>'/>*/?></div> 
        </div>
        <div class="apspp-right-header-block">
        <div class="apspp-header-icons">
            <p>Follow us for new updates</p>
            <div class="apspp-social-bttns">
                <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FWP-Ultimate-Social-Plugin%2F944763738878842&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=1411139805828592" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px; width:50px " allowtransparency="true"></iframe>
                &nbsp;&nbsp;
                <a href="https://twitter.com/social_ultimate" class="twitter-follow-button" data-show-screen-name='true' data-show-count="false" data-lang="en">Follow @social_ultimate</a>
                <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");</script>

            </div>
        </div>

         <div class="aps-col-title">

                <div class="us-title"><?php _e('Pinterest Dashboard', US_TD); ?></div>
                <span class="us-version">V <?php echo US_VERSION; ?></span> 
               

            </div>
             <div class='us-dashboard-link'><a href="<?php echo admin_url('admin.php?page=ultimate-social'); ?>"><?php _e('Dashboard', US_TD ); ?></a></div>

      
    </div>
    </div>


<?php
    $options = get_option( APSP_PRO_SETTINGS );
    if (isset($_SESSION['apspp_message'])) {
        ?>
        <div class="apspp-message">
            <p><?php
                echo $_SESSION['apspp_message'];
                unset($_SESSION['apspp_message']);
                ?></p>
        </div>
    <?php } ?>
    
<ul class="apspp-setting-tabs clearfix">
    <li><a href="javascript:void(0)" id="apspp-pinit-settings" class="apspp-tabs-trigger apspp-active-tab	"><i class="fa fa-pinterest-square"></i><?php _e('Pinterest pin it  settings', APSP_PRO_TEXT_DOMAIN); ?></a></li>
    <li><a href="javascript:void(0)" id="apspp-how-to-use" class="apspp-tabs-trigger"><i class="fa fa-cog"></i><?php _e('How To Use', APSP_PRO_TEXT_DOMAIN); ?></a></li>
    <?php /* ?>
    <li><a href="javascript:void(0)" id="apspp-about" class="apspp-tabs-trigger"><i class="fa fa-key"></i><?php _e('About', APSP_PRO_TEXT_DOMAIN); ?></a></li>
    <?php */ ?>
</ul>


<div class="apspp-form-wrap">
<form action="<?php echo admin_url() . 'admin-post.php' ?>" method='post'>
	<input type="hidden" name="action" value="apspp_save_options" />

    <!-- This is the first tab of the pinit settings tab -->
    <div class='apspp-tab-contents apspp-active-tab' id='tab-apspp-pinit-settings'>

        <!-- Pinit js loading enable disable options setting tab -->
        <h2 class="apspp-main-title"><?php _e('Pinterest pinit.js Loading settings', APSP_PRO_TEXT_DOMAIN ); ?></h2>
        <div class="disable-wrap clearfix">
            <label for='apspp-pinterest-button-size' class='apspp-disable-pinit-js'><?php _e('Disable pinit.js?', APSP_PRO_TEXT_DOMAIN ); ?> </label>
            <div class="check-box-disable">
                <input type='checkbox' id='apspp-pinterest-js-disable' name='apspp-pinit-js-disable' <?php if(isset($options['pinit_js_disable']) && $options['pinit_js_disable'] =='on'){ ?> checked='checked'; <?php } ?>/> <label for='apspp-pinterest-js-disable' ><?php _e('Disable output of pinit.js, the JavaScript file from this plugin.', APSP_PRO_TEXT_DOMAIN ); ?></label>
                <div class='apspp-info'><?php _e('Check this option if you have pinit.js already called in another plugin or theme. Multiple insertion of pinit.js on a page can cause conflicts.', APSP_PRO_TEXT_DOMAIN ); ?></div>
            </div>
        </div>
        <h2 class='apspp-main-title'><?php _e('Custom Pin it Buttons Settings', APSP_PRO_TEXT_DOMAIN ); ?></h2>
         <input type='checkbox' id='apspp-custom-pinit-enable' name='apspp-custom-pinit-enable' <?php if(isset($options['custom_pinit_enable']) && $options['custom_pinit_enable'] =='on'){ ?> checked='checked'; <?php } ?>/> <label for='apspp-custom-pinit-enable'> <?php _e('Enable Custom Pin It button over images', APSP_PRO_TEXT_DOMAIN ); ?></label>
         <div class='apspp-info'>Please disable the native pin it button below to use this custom pin it button.</div>
        
        <!-- Pinterest Custom Image Settings -->
        <h3 class="apspp-sub-title"><?php _e('On which pages the pinterest button should be displayed?', APSP_PRO_TEXT_DOMAIN ); ?></h3>
        <!-- Custom pinterest button dispaly settings in wordpress pages and posts -->
        <p><input type="checkbox" id="apspp_home_page" value="home_page" name="apspp_display_settings[display_options][]" <?php if (in_array("home_page", $options['display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_home_page"><?php _e('Home page(latest blog posts)', APSP_PRO_TEXT_DOMAIN ); ?></label></p>     
        <p><input type="checkbox" id="apspp_front_page" value="front_page" name="apspp_display_settings[display_options][]" <?php if (in_array("front_page", $options['display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_front_page"><?php _e('Front page(static home page assigned from settings->reading)', APSP_PRO_TEXT_DOMAIN ); ?></label></p>     
        <p><input type="checkbox" id="apspp_posts" value="post" name="apspp_display_settings[display_options][]" <?php if (in_array("post", $options['display_options']) || in_array("posts", $options['display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_posts"><?php _e( 'Posts', APSP_PRO_TEXT_DOMAIN ); ?> </label></p>
        <p><input type="checkbox" id="apspp_pages" value="page" name="apspp_display_settings[display_options][]" <?php if (in_array("page", $options['display_options']) || in_array("pages", $options['display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_pages"><?php _e( 'Pages', APSP_PRO_TEXT_DOMAIN ); ?> </label></p>
        <p><input type="checkbox" id="apspp_categories" value="categories" name="apspp_display_settings[display_options][]" <?php if (in_array("categories", $options['display_options']) || in_array("categories", $options['display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_categories"><?php _e( 'Categories', APSP_PRO_TEXT_DOMAIN ); ?> </label></p>
        <p><input type="checkbox" id="apspp_archives" value="archives" name="apspp_display_settings[display_options][]" <?php if (in_array("archives", $options['display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_archives"><?php _e('Archives', APSP_PRO_TEXT_DOMAIN ); ?></label></p>
         <?php $post_types = self::get_registered_post_types(); ?>
                    <?php if (!empty($post_types)) { ?>
                        <label><?php _e('Available Custom Post types:', APSP_PRO_TEXT_DOMAIN); ?></label>
                        <?php foreach ($post_types as $key => $value) { ?>
                            <?php
                            $objects = get_post_type_object($value);
                            ?>
                            <p><input type="checkbox" id="apspp_<?php echo $key; ?>" value="<?php echo $value; ?>" name="apspp_display_settings[display_options][]" <?php
                                if (in_array($key, $options['display_options'])) {
                                    echo "checked='checked'";
                                }
                                ?> ><label for="apspp_<?php echo $key; ?>"><?php _e($objects->labels->name, APSP_PRO_TEXT_DOMAIN); ?></label></p>
                            <?php } ?>
                        <?php } ?>

                    <?php $taxonomies = self::get_registered_taxonomies(); ?>

                    <?php if (!empty($taxonomies)) { ?>
                        <label><?php _e('Available Taxonomies:', APSP_PRO_TEXT_DOMAIN); ?></label>
                        <?php foreach ($taxonomies as $key => $value) { ?>      
                            <?php $required_tax_objects = $value->labels; ?>
                            <?php $name = $required_tax_objects->name; ?>

                            <p><input type="checkbox" id="apspp_<?php echo $value->name; ?>" value="<?php echo $value->name; ?>" name="apspp_display_settings[display_options][]" <?php
                                if (in_array($value->name, $options['display_options'])) {
                                    echo "checked='checked'";
                                }
                                ?> ><label for="apspp_<?php echo $value->name; ?>"><?php _e($name, APSP_PRO_TEXT_DOMAIN); ?></label></p>
                            <?php } ?>
                        <?php } ?>
                        
        <!-- Custom pinterest button display settings in wordpress pages and posts ends -->
        <div class="selector-wrapper">
            <div class="image-selector">
            <label for="apspp_container_selector">Container selector</label>
            <input type="text" id="apspp_container_selector" name="apspp-container-selector" value="<?php if(isset($options['container_selector']) && $options['container_selector'] !=''){ echo $options['container_selector']; } ?>" class="apspp_small_text">
            <div class='apspp-info'>This is the selector used to find the container that holds the entire single post. It looks for an element that is a parent of the content of the post. Usually it's a div or article element. </div>
            </div>

            <div class="image-selector">
            <label for="apspp_image_selector">Image selector</label>
            <input type="text" id="apspp_image_selector" name="apspp-image-selector" value="<?php if(isset($options['image_selector']) && $options['image_selector'] !=''){ echo $options['image_selector']; } ?>" class="apspp_small_text">
            <div class='apspp-info'>jQuery selector for all the images that should have the "Pin it" button. Set the value to .apspp-container img if you want the "Pin it" button to appear only on class apspp-container. If you know about jQuery, you can use your own selector. Click <a href='http://api.jquery.com/category/selectors/' target="_blank">here</a> to read about jQuery selectors.</div>
            </div>

             <div class="image-selector">
            <label for="apspp_disabled_classes">Disabled classes</label>
            <input type="text" id="apspp_disabled_classes" name="apspp-disabled-classes" placeholder='Comma separated values' value="<?php if(isset($options['disabled_classes']) && $options['disabled_classes'] !=''){ echo $options['disabled_classes']; } ?>" class="apspp_small_text">
            <div class='apspp-info'>Images with these CSS classes won't show the "Pin it" button. Please separate multiple classes with comma.</div>
            </div>

            <div class="image-selector">
            <label for="apspp_enabled_classes">Enabled classes</label>
            <input type="text" id="apspp_enabled_classes" name="apspp-enabled-classes" placeholder='Comma separated values' value="<?php if(isset($options['enabled_classes']) && $options['enabled_classes'] !=''){ echo $options['enabled_classes']; } ?>" class="apspp_small_text">
            <div class='apspp-info'>Only images with these CSS classes will show the "Pin it" button. Please separate multiple classes with commas. If this field is empty, images with any (besides disabled ones) classes will show the Pin It button.</div>
            </div>
        </div>
        <!-- Pinit button postion settings -->
        <div class="apspp-button-position-settings image-selector"> 
            <label for="apspp_button_position"><?php _e('"Pin it" button position', APSP_PRO_TEXT_DOMAIN ); ?></label>
            <select name='apspp-pinterest-button-position' id='apspp_button_position'>
                <option value='1' <?php selected( $options['button_position'], '1' ); ?>><?php _e('Top Left', APSP_PRO_TEXT_DOMAIN ); ?></option>
                <option value='2' <?php selected( $options['button_position'], '2' ); ?>><?php _e('Top Right', APSP_PRO_TEXT_DOMAIN ); ?></option>
                <option value='3' <?php selected( $options['button_position'], '3' ); ?>><?php _e('Bottom Left', APSP_PRO_TEXT_DOMAIN ); ?></option>
                <option value='4' <?php selected( $options['button_position'], '4' ); ?>><?php _e('Bottom Right', APSP_PRO_TEXT_DOMAIN ); ?></option>
                <option value='5' <?php selected( $options['button_position'], '5' ); ?>><?php _e('Middle', APSP_PRO_TEXT_DOMAIN ); ?></option>
            </select>
        </div>
        <!-- Pinit button postion settings ends-->

        <!-- Pinit source description settings -->
        <div class="apspp-button-description-source image-selector"> 
            <label for="apspp_sorce_description"><?php _e('"Pin it" Description Source', APSP_PRO_TEXT_DOMAIN ); ?></label>
            <select name='apspp-pinterest-button-description-source' id='apspp_sorce_description'>
                <option value='1' <?php selected( $options['description_source'], '1' ); ?>><?php _e('Page title', APSP_PRO_TEXT_DOMAIN ); ?></option>
                <option value='2' <?php selected( $options['description_source'], '2' ); ?>><?php _e('page description', APSP_PRO_TEXT_DOMAIN ); ?></option>
                <option value='3' <?php selected( $options['description_source'], '3' ); ?>><?php _e('Site title', APSP_PRO_TEXT_DOMAIN ); ?></option>
                <option value='4' <?php selected( $options['description_source'], '4' ); ?>><?php _e('Image alt tag', APSP_PRO_TEXT_DOMAIN ); ?></option>
                <option value='5' <?php selected( $options['description_source'], '5' ); ?>><?php _e('Image title or (if title not available) alt attribute', APSP_PRO_TEXT_DOMAIN ); ?></option>
            </select>
        </div>
        <!-- Pinit source description settings ends-->

        <!-- min image size selection -->
        <h3 class="apspp-sub-title"><?php _e('Minimum image size to show "Pin it" button', APSP_PRO_TEXT_DOMAIN ); ?></h3>
        <div class="image-selector">
        <label for="apspp_min_image_width">Width</label>
        <input type="text" id="apspp_min_image_width" name="apspp-min-image[width]" value="<?php if(isset($options['min_image_size']['width']) && $options['min_image_size']['width'] !=''){ echo $options['min_image_size']['width']; } ?>" class="apspp_small_text">px<br>
        <label for="apspp_min_image_height">Height</label>
        <input type="text" id="apspp_min_image_height" name="apspp-min-image[height]" value="<?php if(isset($options['min_image_size']['height']) && $options['min_image_size']['height'] !=''){ echo $options['min_image_size']['height']; } ?>" class="apspp_small_text">px<br>
        </div>
        <!-- min image size selection ends -->


        <!-- Pinit button margins settings -->
        <div class='apspp-button-margin-settings'>
        <h3 class="apspp-sub-title"><?php _e('Pin it button margins settings', APSP_PRO_TEXT_DOMAIN ); ?></h2>
            <div class="button-margin">
            <label for="button_margin_top">Top</label>
            <input type="number" min="-1000" max="1000" step="1" id="apspp_button_margin_top" name="apspp_button_margin_top" value="<?php if(isset($options['apspp_button_margin_top']) && $options['apspp_button_margin_top'] !=''){ echo $options['apspp_button_margin_top']; } ?>" class="apspp_small_text">px<br>
            </div>

            <div class="button-margin">
            <label for="button_margin_bottom">Bottom</label>
            <input type="number" min="-1000" max="1000" step="1" id="apspp_button_margin_bottom" name="apspp_button_margin_bottom" value="<?php if(isset($options['apspp_button_margin_bottom']) && $options['apspp_button_margin_bottom'] !=''){ echo $options['apspp_button_margin_bottom']; } ?>" class="apspp_small_text">px<br>
            </div>
            <div class="button-margin">
            <label for="button_margin_left">Left</label>
            <input type="number" min="-1000" max="1000" step="1" id="apspp_button_margin_left" name="apspp_button_margin_left" value="<?php if(isset($options['apspp_button_margin_left']) && $options['apspp_button_margin_left'] !=''){ echo $options['apspp_button_margin_left']; } ?>" class="apspp_small_text">px<br>
            </div>
            <div class="button-margin">
            <label for="button_margin_right">Right</label>
            <input type="number" min="-1000" max="1000" step="1" id="apspp_button_margin_right" name="apspp_button_margin_right" value="<?php if(isset($options['apspp_button_margin_right']) && $options['apspp_button_margin_right'] !=''){ echo $options['apspp_button_margin_right']; } ?>" class="apspp_small_text">px<br>
            </div>
            <p class="apspp-info">Margins are used to adjust the position of the "Pin it" button, but not all margins are used on all button positions. Here is an example. If you're using the "Top left" position, the button's position will be affected only by top and left margins. Bottom and right margins affect "Bottom right" position, etc. The "Middle" position does not use any margins at all.</p>
        </div>
        <!-- Pinit button margins settings -->

        <!-- Transparancy level settings -->
        <div class='apspp-transparancy-value'>
        <label for="apspp-transparancy-value">Transparancy Value</label>
        <input type="text" id="apspp-transparancy-value" name="apspp-pinterest-transparancy-value" value="<?php if(isset($options['transparancy_value'])){ echo $options['transparancy_value']; } ?>">
        <div class='apspp-info'><?php _e('Choose transparency (between 0.00 and 1.00)', APSP_PRO_TEXT_DOMAIN ); ?></div>
        </div>
        <!-- Transparancy level settings ends -->

        <!-- Display positions -->
        <div class='apspp-display-positions'>
        <label for="apspp_display_option">"Pin it" button display options</label>
        <select name='apspp-pinterest-display-option' id='apspp_display_option'>
            <option value='1' <?php selected( $options['button_display_option'], '1' ); ?>><?php _e('Always show', APSP_PRO_TEXT_DOMAIN ); ?></option>
            <option value='2' <?php selected( $options['button_display_option'], '2' ); ?>><?php _e('On hover', APSP_PRO_TEXT_DOMAIN ); ?></option>
        </select>
        </div>
        <!-- Display positions -->
        
        <!-- Enable pinit button below image for mobile devices -->
        <div class='apspp-pinit-mobile'>
        <input type='checkbox' id='apspp-pinit-mobile' name='apspp-enable-pinit-below-image' <?php if(isset($options['button_display_below_image']) && $options['button_display_below_image'] =='on'){ ?> checked='checked'; <?php } ?>/> 
        <label for="apspp-pinit-mobile"><?php _e('Mobile devices compactibility.', APSP_PRO_TEXT_DOMAIN ); ?></label>
        <div class='apspp-info'><?php _e('Hover effect is not available for mobile devices, So please choose this option if you want to show the pinit button for mobile devices as well.', APSP_PRO_TEXT_DOMAIN ); ?></div>
        </div>
        <!-- Enable pinit button below image for mobile devices -->
        <br />

        <!-- Enable pinit button below image for mobile devices -->
        <div class='apspp-ratina-ready'>
        <input type='checkbox' id='apspp-pinit-retina-ready' name='apspp-enable-retina-ready' <?php if(isset($options['retina_friendly']) && $options['retina_friendly'] =='on'){ ?> checked='checked'; <?php } ?>/> 
        <label for="apspp-pinit-retina-ready"><?php _e('Optimize for high pixel density display', APSP_PRO_TEXT_DOMAIN ); ?></label>
        <div class='apspp-info'><?php _e("When this option is checked the loading of the pinterest pin it button will be halfed of it's size, please make sure both width and height are even numbers (i.e. divisible by two) when using this option.", APSP_PRO_TEXT_DOMAIN ); ?></div>

        </div>
        <!-- Enable pinit button below image for mobile devices -->

        <!-- Listing of the available pinit buttons for selection -->
        <h3 class="apspp-sub-title"><?php _e('Please choose pin it button from available Pin it buttons', APSP_PRO_TEXT_DOMAIN ); ?></h2>
        <?php for($i=1; $i<=40; $i++){ ?>
        <div class="apspp-pinit-button-selection">
        <input type='radio' id='apspp-pinit-button-selection-<?php echo $i; ?>' name='apspp-pinit-button-selection' value='<?php echo $i; ?>' <?php checked( $options['custom_image_selection'], $i, 'true' ); ?> /> <label for='apspp-pinit-button-selection-<?php echo $i; ?>'><img src='<?php echo APSP_PRO_IMAGE_DIR."/icons/pin-$i.png"; ?>' /></label>
        </div>
        <?php } ?>
        <!-- Listing of the available pinit buttons for selection ends-->

        <!-- Enable/Disable options for the custom image settings -->
        <div class="enable-disable-options-selection">
        <h3 class='apspp-sub-title'><?php _e('Enable/Disable Pinterest Custom Image', APSP_PRO_TEXT_DOMAIN ); ?></h3>
        <input type='checkbox' name='apspp-pinterest-custom_image[status]' <?php if(isset($options['custom_image']['status']) && $options['custom_image']['status'] =='on'){ ?> checked='checked'; <?php } ?>/> <?php _e('Enable Custom Image', APSP_PRO_TEXT_DOMAIN ); ?>
            <div class='apspp-info'><?php _e('The button selected above will be discarded if you enable the custom image', APSP_PRO_TEXT_DOMAIN ); ?></div>
        <br />

        <button id="apspp-custom-image-upload"><?php _e('Upload an image using media library', APSP_PRO_TEXT_DOMAIN ); ?></button>
        <br />
        <div class="apspp-custom-address">
        <label for="apspp_custom_image_url"><?php _e('URL address of the image', APSP_PRO_TEXT_DOMAIN ); ?></label>
        <input type="url" id="apspp_custom_image_url" name="apspp-pinterest-custom_image[url]" value="<?php if(isset($options['custom_image']['image_url'])){ echo $options['custom_image']['image_url']; } ?>">
        </div>

        <div class="apspp-custom">
        <label for="apspp_custom_image_height">Height</label>
        <input type="number" min="0" step="1" id="apspp_custom_image_height" name="apspp-pinterest-custom_image[height]" value="<?php if(isset($options['custom_image']['image_height'])){ echo $options['custom_image']['image_height']; } ?>" class="small-text"> px
        </div>

        <div class="apspp-custom">
        <label for="apspp_custom_image_width">Width</label>
        <input type="number" min="0" step="1" id="apspp_custom_image_width" name="apspp-pinterest-custom_image[width]" value="<?php if(isset($options['custom_image']['image_width'])){ echo $options['custom_image']['image_width']; } ?>" class="small-text"> px
        </div>
        <b class="custom-bold">Custom Pin It button preview</b><br>
        <?php
        foreach ($options['custom_image'] as $key => $value) {
            $$key = $value;
        }
        ?>
        <span id="custom_button_preview" class="custom-preview" style="display: block; width: <?php echo $image_width.'px'; ?>; height: <?php echo $image_height.'px'; ?>; background-image: url('<?php echo $image_url; ?>'); ">
        
        </span><br>
            <button id="refresh_custom_button_preview" class="preview-btn">Refresh preview</button>
        <br />
        </div>  
        <!-- Enable/Disable options for the custom image settings ends -->

        <!-- Native pinterest settings -->
        <h2 class="apspp-main-title"><?php _e('Native Pinterest Pin it Hover Settings', APSP_PRO_TEXT_DOMAIN ); ?></h2>
        <input type='checkbox' name='apspp-pinit-js' id='apspp_js_enabled' <?php if(isset($options['js_enabled']) && $options['js_enabled'] =='on'){ ?> checked='checked'; <?php } ?>/> <?php _e('Enable the Pin It hover button over images', APSP_PRO_TEXT_DOMAIN ); ?>
        <div class='apspp-info'><?php _e('Please disable the custom pin it button to use this native pin it button above.', APSP_PRO_TEXT_DOMAIN ); ?></div>

        <div class="apspp-display-settings" <?php if(isset($options['js_enabled']) && $options['js_enabled'] == 'on'){ ?> style='display:block;' <?php }else{ ?> style='display:none;' <?php } ?>>
            <!-- Pinterest Custom Image Settings -->
            <h3 class="apspp-sub-title"><?php _e('On which pages the pinterest button should be displayed?', APSP_PRO_TEXT_DOMAIN ); ?></h3>
            <!-- Custom Pinterest button display settings in WordPress pages and posts -->
            <p><input type="checkbox" id="apspp_home_page" value="home_page" name="apspp_display_settings[native_display_options][]"    <?php if (isset($options['native_display_options']) && in_array("home_page", $options['native_display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_home_page"><?php _e('Home page(latest blog posts)', APSP_PRO_TEXT_DOMAIN ); ?></label></p>
            <p><input type="checkbox" id="apspp_front_page" value="front_page" name="apspp_display_settings[native_display_options][]"  <?php if (isset($options['native_display_options']) && in_array("front_page", $options['native_display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_front_page"><?php _e('Front page(static home page assigned from settings->reading)', APSP_PRO_TEXT_DOMAIN ); ?></label></p>
            <p><input type="checkbox" id="apspp_posts" value="post" name="apspp_display_settings[native_display_options][]"             <?php if (isset($options['native_display_options']) && (in_array("post", $options['native_display_options']) || in_array("posts", $options['native_display_options']))) { echo "checked='checked'"; } ?> ><label for="apspp_posts"><?php _e( 'Posts', APSP_PRO_TEXT_DOMAIN ); ?> </label></p>
            <p><input type="checkbox" id="apspp_pages" value="page" name="apspp_display_settings[native_display_options][]"             <?php if (isset($options['native_display_options']) && (in_array("page", $options['native_display_options']) || in_array("pages", $options['native_display_options']))) { echo "checked='checked'"; } ?> ><label for="apspp_pages"><?php _e( 'Pages', APSP_PRO_TEXT_DOMAIN ); ?> </label></p>
            <p><input type="checkbox" id="apspp_categories" value="categories" name="apspp_display_settings[native_display_options][]"  <?php if (isset($options['native_display_options']) && (in_array("categories", $options['native_display_options']) || in_array("categories", $options['native_display_options']))) { echo "checked='checked'"; } ?> ><label for="apspp_categories"><?php _e( 'Categories', APSP_PRO_TEXT_DOMAIN ); ?> </label></p>
            <p><input type="checkbox" id="apspp_archives" value="archives" name="apspp_display_settings[native_display_options][]"      <?php if (isset($options['native_display_options']) && in_array("archives", $options['native_display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_archives"><?php _e('Archives', APSP_PRO_TEXT_DOMAIN ); ?></label></p>
            <?php
            $post_types = self::get_registered_post_types();

            if (!empty($post_types)) { ?>
                <label><?php _e('Available Custom Post types:', APSP_PRO_TEXT_DOMAIN); ?></label>
                <?php
                foreach ($post_types as $key => $value) {
                    $objects = get_post_type_object($value);
                    ?>
                    <p><input type="checkbox" id="apspp_<?php echo $key; ?>" value="<?php echo $value; ?>" name="apspp_display_settings[native_display_options][]" <?php if (isset($options['native_display_options']) && in_array($key, $options['native_display_options'])) { echo "checked='checked'"; } ?> ><label for="apspp_<?php echo $key; ?>"><?php _e($objects->labels->name, APSP_PRO_TEXT_DOMAIN); ?></label></p>
                    <?php
                }
            }

            $taxonomies = self::get_registered_taxonomies();
            if (!empty($taxonomies)) { ?>
                <label><?php _e('Available Taxonomies:', APSP_PRO_TEXT_DOMAIN); ?></label>
                <?php
                foreach ($taxonomies as $key => $value) { ?>
                    <?php $required_tax_objects = $value->labels; ?>
                    <?php $name = $required_tax_objects->name; ?>

                    <p><input type="checkbox" id="apspp_<?php echo $value->name; ?>" value="<?php echo $value->name; ?>" name="apspp_display_settings[native_display_options][]" <?php
                        if (isset($options['native_display_options']) && in_array($value->name, $options['native_display_options'])) {
                            echo "checked='checked'";
                        }
                        ?> ><label for="apspp_<?php echo $value->name; ?>"><?php _e($name, APSP_PRO_TEXT_DOMAIN); ?></label></p>
                    <?php
                }
            } ?>
        </div>
    	<h3 class="apspp-sub-title"><?php _e('Button apperance settings</h3>', APSP_PRO_TEXT_DOMAIN ); ?>
    	<div class="apspp-select-wrapper">
        	<label for='apspp-pinterest-button-size'><?php _e('size:', APSP_PRO_TEXT_DOMAIN ); ?> </label>
        	<select name='apspp-pinterest-button-size' id='apspp-pinterest-button-size'>
        		<option value='small' <?php selected( $options['size'], 'small' ); ?>><?php _e('Small', APSP_PRO_TEXT_DOMAIN ); ?></option>
        		<option value='28' <?php selected( $options['size'], '28' ); ?>><?php _e('Large', APSP_PRO_TEXT_DOMAIN ); ?></option>
        	</select>
    	</div>

    	<div class="apspp-select-wrapper">
        	<label for='apspp-pinterest-button-shape'><?php _e('shape:', APSP_PRO_TEXT_DOMAIN ); ?> </label>
        	<select name='apspp-pinterest-button-shape' id='apspp-pinterest-button-shape'>
        		<option value='rectangular' <?php selected( $options['shape'], 'rectangular' ); ?> ><?php _e('Rectangular', APSP_PRO_TEXT_DOMAIN ); ?></option>
        		<option value='round' <?php selected( $options['shape'], 'round' ); ?> ><?php _e('Circular', APSP_PRO_TEXT_DOMAIN ); ?></option>
        	</select>
    	</div>

    	<div class="apspp-rectangular-options" <?php if($options['shape'] == 'rectangular'){ ?> style="display:block;" <?php }else{ ?>style='display:none;' <?php } ?>>
        	<h3 class="apspp-sub-title"> <?php _e('Options for Rectangular buttons', APSP_PRO_TEXT_DOMAIN ); ?></h3>
        	<?php /* ?>
            <div class="apspp-select-wrapper">
                <label for='apspp-pinterest-rectangle-color'><?php _e('Color:</label> ', APSP_PRO_TEXT_DOMAIN ); ?>
                <select name='apspp-pinterest-rectangle-color' id='apspp-pinterest-rectangle-color'>
                    <option value='red' <?php selected( $options['color'], 'red' ); ?>><?php _e('Red', APSP_PRO_TEXT_DOMAIN ); ?></option>
                    <option value='gray' <?php selected( $options['color'], 'gray' ); ?>><?php _e('Gray', APSP_PRO_TEXT_DOMAIN ); ?></option>
                    <option value='white' <?php selected( $options['color'], 'white' ); ?>><?php _e('White', APSP_PRO_TEXT_DOMAIN ); ?></option>
                </select>
            </div>
            <?php */ ?>

            <?php /* ?>
        	<div class="apspp-select-wrapper">
            <label for='apspp-pinterest-rectangle-lang'><?php _e('Language:</label>', APSP_PRO_TEXT_DOMAIN ); ?>
            	<select name='apspp-pinterest-rectangle-lang' id='apspp-pinterest-rectangle-lang'>
            		<option value='english' <?php selected( $options['language'], 'english' ); ?> ><?php _e('English</option>', APSP_PRO_TEXT_DOMAIN ); ?>
            		<option value='ja' <?php selected( $options['language'], 'ja' ); ?> ><?php _e('Japanese</option>', APSP_PRO_TEXT_DOMAIN ); ?>
            	</select>
            </div>
            <?php */ ?>
            <div class="apspp-select-wrapper">
                <label for='apspp-pinterest-rectangle-lang'><?php _e('Language:</label>', APSP_PRO_TEXT_DOMAIN ); ?>
                <select name='apspp-pinterest-rectangle-lang' id='apspp-pinterest-rectangle-lang'>
                    <option value='cs' <?php selected($options['language'], 'cs'); ?> ><?php _e('Czech', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='da' <?php selected($options['language'], 'da'); ?> ><?php _e('Danish', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='de' <?php selected($options['language'], 'de'); ?> ><?php _e('German', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='el' <?php selected($options['language'], 'el'); ?> ><?php _e('Greek', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='es' <?php selected($options['language'], 'es'); ?> ><?php _e('Spanish', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='fi' <?php selected($options['language'], 'fi'); ?> ><?php _e('Finnish', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='fr' <?php selected($options['language'], 'fr'); ?> ><?php _e('French', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='hi' <?php selected($options['language'], 'hi'); ?> ><?php _e('Hindu', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='hu' <?php selected($options['language'], 'hu'); ?> ><?php _e('Hungarian', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='id' <?php selected($options['language'], 'id'); ?> ><?php _e('Indonesian', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='it' <?php selected($options['language'], 'it'); ?> ><?php _e('Italian', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='ja' <?php selected($options['language'], 'ja'); ?> ><?php _e('Japanese', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='ko' <?php selected($options['language'], 'ko'); ?> ><?php _e('Korean', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='ms' <?php selected($options['language'], 'ms'); ?> ><?php _e('Malaysian', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='nb' <?php selected($options['language'], 'nb'); ?> ><?php _e('Norwegian', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='nl' <?php selected($options['language'], 'nl'); ?> ><?php _e('Dutch', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='pl' <?php selected($options['language'], 'pl'); ?> ><?php _e('Polish', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='pt' <?php selected($options['language'], 'pt'); ?> ><?php _e('Portuguese', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='pt-br' <?php selected($options['language'], 'pt-br'); ?> ><?php _e('Portuguese (Brazil)', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='ro' <?php selected($options['language'], 'ro'); ?> ><?php _e('Romanian', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='ru' <?php selected($options['language'], 'ru'); ?> ><?php _e('Russian', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='sk' <?php selected($options['language'], 'sk'); ?> ><?php _e('Slovak', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='sv' <?php selected($options['language'], 'sv'); ?> ><?php _e('Swedish', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='tl' <?php selected($options['language'], 'tl'); ?> ><?php _e('Tagalog', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='th' <?php selected($options['language'], 'th'); ?> ><?php _e('Thai', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='tr' <?php selected($options['language'], 'tr'); ?> ><?php _e('Turkish', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='uk' <?php selected($options['language'], 'uk'); ?> ><?php _e('Ukrainian', APSP_PRO_TEXT_DOMAIN); ?></option>
                    <option value='vi' <?php selected($options['language'], 'vi'); ?> ><?php _e('Vietnamese', APSP_PRO_TEXT_DOMAIN); ?></option>
                </select>
            </div>
	    </div>
        <!-- native pinterest settings -->
    </div>
<div class='apspp-tab-contents' id='tab-apspp-how-to-use' style="display:none">
	<?php include('how-to-use.php'); ?>
</div>

<?php /* ?>
<div class='apspp-tab-contents' id='tab-apspp-about' style="display:none">
    <?php include('apspp-about.php'); ?>
</div>
<?php */ ?>

 <?php wp_nonce_field('apspp_nonce_save_settings', 'apspp_add_nonce_save_settings'); ?>
<input type='submit' name='apspp_save_settings' value='Save Settings' class="apspp-save-btn" />

<?php $nonce = wp_create_nonce('apspp-restore-default-settings-nonce'); ?>
<a class="apspp-btn-wrap" href="<?php echo admin_url() . 'admin-post.php?action=apspp_restore_default_settings&_wpnonce=' . $nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to restore default settings?', APSP_PRO_TEXT_DOMAIN ); ?>')"><input type="button" value="Restore Default Settings" class="apspp-reset-button"/></a>
</form>
</div> <!-- apspp form wrapper -->
</div> <!-- apspp backend wrapper -->
