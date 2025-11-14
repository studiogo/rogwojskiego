<?php 
defined('ABSPATH') or die("No script kiddies please!");

$apsc_settings = get_option('apsc_settings');
    //$this->print_array($apsc_settings);
?>
<div class="wrap">
    <div class="apsc-add-set-wrapper clearfix">
        <div class="apsc-panel">
            <div class="apsc-settings-header">
                <div class="apsc-logo">
                    <?php /*<img src="<?php echo SC_PRO_IMAGE_DIR; ?>/logo.png" alt="<?php esc_attr_e('Ultimate Social Counter Pro',  US_TD); ?>" /> */?>
                </div>

                <div class="apsc-socials">
                    <p><?php _e('Follow us for new updates', US_TD) ?></p>
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

                <div class="aps-col-title">

                <div class="apsc-title"><?php _e('Social Counter Dashboard', US_TD); ?></div>
                <span class="us-version">V <?php echo US_VERSION; ?></span></div>
                <div class='us-dashboard-link'><a href="<?php echo admin_url('admin.php?page=ultimate-social'); ?>"><?php _e('Dashboard', US_TD ); ?></a></div>

            </div>
            
            <?php if(isset($_SESSION['apsc_message'])){?><div class="apsc-success-message"><p><?php echo $_SESSION['apsc_message'];unset($_SESSION['apsc_message']);?></p></div><?php }?>
            <div class="apsc-boards-wrapper">
                <ul class="apsc-settings-tabs">
                    <li><a href="javascript:void(0)" id="social-profile-settings" class="apsc-tabs-trigger apsc-active-tab"><?php _e('Social Profiles', US_TD) ?></a></li>
                    <li><a href="javascript:void(0)" id="display-settings" class="apsc-tabs-trigger"><?php _e('Display Settings',  US_TD); ?></a></li>
                    <li><a href="javascript:void(0)" id="float-sidebar-settings" class="apsc-tabs-trigger"><?php _e('Floating Sidebar Settings', US_TD);?></a></li>
                    <li><a href="javascript:void(0)" id="cache-settings" class="apsc-tabs-trigger"><?php _e('Cache Settings',  US_TD); ?></a></li>
                    <li><a href="javascript:void(0)" id="how_to_use-settings" class="apsc-tabs-trigger"><?php _e('How to use',  US_TD); ?></a></li>
                    
                </ul>
                <div class="metabox-holder">
                    <div id="optionsframework" class="postbox" style="float: left;">
                        <form class="apsc-settings-form" method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
                            <input type="hidden" name="action" value="apsc_settings_action"/>
                            <?php
                                /**
                                 * Social Profiles
                                 * */
                                include_once('boards/social-profiles.php');
                            ?>

                    <?php
                    /**
                     * Display Settings
                     * */
                    include_once('boards/display-settings.php');
                    ?>

                    <?php
                    /**
                     * Floating Sidebar Settings
                     * */
                    include_once('boards/floating-sidebar.php');
                    ?>
                    
                    <?php
                    /**
                     * Cache Settings
                     * */
                    include_once('boards/cache-settings.php');
                    ?>
                    
                    

                    <?php
                    /**
                     * How to use 
                     * */
                    include_once('boards/how-to-use.php');
                    ?>


                   
                    <?php
                    /**
                     * Nonce field
                     * */
                    wp_nonce_field('apsc_settings_action', 'apsc_settings_nonce');
                    ?>
                    <div id="optionsframework-submit" class="ap-settings-submit">
                    <input type="submit" class="button button-primary" value="Save all changes" name="ap_settings_submit"/>
                        <?php
                        $nonce = wp_create_nonce('apsc-restore-default-nonce');
                        $cache_nonce = wp_create_nonce('apsc-cache-nonce');
                        ?>
                        <a href="<?php echo admin_url() . 'admin-post.php?action=apsc_restore_default&_wpnonce=' . $nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to restore default settings?',  US_TD); ?>')"><input type="button" value="<?php _e('Restore Default Settings', US_TD);?>" class="ap-reset-button button button-primary"/></a>
                        <a href="<?php echo admin_url() . 'admin-post.php?action=apsc_delete_cache&_wpnonce=' . $cache_nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to delete cache?',  US_TD); ?>')"><input type="button" value="<?php _e('Delete Cache', US_TD);?>" class="ap-reset-button button button-primary"/></a>
                    </div>
                </form>   
            </div><!--optionsframework-->

        </div>
    </div>
</div>
</div>
</div>