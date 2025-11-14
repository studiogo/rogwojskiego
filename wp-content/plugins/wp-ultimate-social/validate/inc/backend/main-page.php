    <?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
        <div class="wrap">
            <div class="us-wrap">
                <div class="us-header clearfix">
                    <div class="us-title-wrap">
                    <h1>Ultimate Social</h1>
                    <span class="us-version">V <?php echo US_VERSION; ?></span>
                    </div>
                    <div class='us-dashboard-link'><a href="<?php echo admin_url('admin.php?page=ultimate-social'); ?>"><?php _e('Dashboard', US_TD ); ?></a></div>
                    <div class="us-socials">
                        <p>Follow us for new updates</p>
                        <div class="ap-social-bttns">
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
                </div>
        <?php 
        $options = get_option( US_SETTINGS );
        //var_dump($options);
        
        $serial_key = $options['us_settings']['plugin_validate']['serial_key'];
        $sku        = $options['us_settings']['plugin_validate']['sku'];
        $uuid       = $options['us_settings']['plugin_validate']['uuid'];
        $flag       = $options['us_settings']['plugin_validate']['flag'];
        $msg       = $options['us_settings']['plugin_validate']['msg'];
        $expire_date = strtotime($options['us_settings']['plugin_validate']['expire_date']);
        $today =  strtotime(date('Y-m-d')); //strtotime('2016-07-15');
        ?>

    <div class="utsc-form-wrap">
            <?php if($flag =='0'){ ?>
            <div class="us-message error-message">
            <?php echo _e( $msg, US_TD ); ?>
            </div>
            <?php }else if($flag =='1') {
                if($expire_date < $today){ ?>
                <div class="us-message error-message">
                <?php echo _e('license expired. Please Renew your license.', US_TD ); ?>
                </div>
                <?php }else{ ?>
                        <div class="us-message success-message">
                            <?php echo _e($msg, US_TD ); ?>
                        </div>
            <?php    }
            } ?>
        <div class="us-plugin-validate" id="us-plugin-validate" >
            <form method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
                    <input type="hidden" name="action" value="us_save_validation_settings"/>
                    <input type='hidden' name='us_settings[plugin_validate][uuid]' value="<?php echo site_url(); ?>"/>
                    <input type='hidden' name='us_settings[plugin_validate][sku]' id="sku" value="us-agency">
                    <div class="validate_serial_key">
                        <label for="us_serial_key"><?php _e( 'Serial Key:', US_TD ); ?></label>
                        <input type='text' id="us_serial_key" name='us_settings[plugin_validate][serial_key]' value="<?php if(isset($options['us_settings']['plugin_validate']['serial_key'])){ echo $options['us_settings']['plugin_validate']['serial_key']; } ?>" />
                        <span class="error invalid_serial_key"></span>
                        <?php wp_nonce_field( 'us-validate-plugin-nonce', 'us-validate-plugin-nonce' ); ?>
                        <input type="submit" class="submit_settings button button-primary" value="<?php _e('Validate', US_TD); ?>" name="us_submit_license" id="us_submit_license"/>
                    </div>
            </form>
        </div>
        <div class='us-info'>Enter the License Key you got when bought this product. If you lost the key, you can always retrieve it from <a href='http://wpultimatesocial.com/beta/my-account/my_serial_keys/' target='_blank'>My Account</a></div>
    </div>
    </div>
    </div>