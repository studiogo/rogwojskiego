<div class="us-popup-overlay" style="display: none"></div>
<div class="wrap">
    <div class="us-wrap">
        <div class="us-header clearfix">
            <div class="us-title-wrap">
                <h1><?php _e('Ultimate Social', US_TD); ?></h1>
                <span class="us-version">V <?php echo US_VERSION; ?></span>
            </div>
            <div class="us-socials">
                <p>Follow us for new updates</p>
                <div class="ap-social-bttns">

                    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FWP-Ultimate-Social-Plugin%2F944763738878842&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=1411139805828592" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px; width:50px " allowtransparency="true"></iframe>
                        &nbsp;&nbsp;
                    <a href="https://twitter.com/social_ultimate" class="twitter-follow-button" data-show-screen-name='true' data-show-count="false" data-lang="en">Follow @apthemes</a>
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
        <div class="us-plugin-list">
            <div class="us-each-plugin">
               <div class="us-plugin-img-wrap"> <div class='us-plugin-image'><img src='<?php echo US_IMAGE_DIR; ?>/icons/banner.jpg' alt='Ultimate social icons' title="Ultimate Social Icons" /></div>
                </div>
                <div class="us-plugin-title">Social Icons</div>
                <p class="us-height-p"><?php _e('Link-up your social profiles right from your website, in an easy and fun way.', US_TD); ?></p>

                <div class='us-plugin-usage'><img src='<?php echo US_IMAGE_DIR; ?>/icons/usage.jpg' alt='Ultimate social icons' title="Ultimate Social Icons" /></div>

                <a href="<?php echo admin_url('admin.php?page=us-social-icons'); ?>" class="button-primary">Dashboard</a>
                <a href="http://wpultimatesocial.com/documentation/social-icons/" class="button-primary us-doc-link" target="_blank">Documentation</a>
                <input type="button" class="button-primary us-view-detail" value="<?php _e('View Details', US_TD); ?>"/>
                <?php include('social-icons-details.php'); ?>
            </div>
            <div class="us-each-plugin">
                  <div class="us-plugin-img-wrap"> <div class='us-plugin-image'><img src='<?php echo US_IMAGE_DIR; ?>/counter/counter-banner.jpg' alt='Ultimate social Counter' title="Ultimate Social Counter" /></div>
                </div>
                <div class="us-plugin-title">Social Counter</div>
                <p class="us-height-p"><?php _e('Display your social accounts fans, subscribers and followers number on your website.', US_TD); ?></p>

                <div class='us-plugin-usage'><img src='<?php echo US_IMAGE_DIR; ?>/counter/social-counter.jpg' alt='Ultimate social Counter' title="Ultimate social Counter" /></div>
                
                <a href="<?php echo admin_url('admin.php?page=us-social-counter'); ?>" class="button-primary">Dashboard</a>
                <a href="http://wpultimatesocial.com/documentation/social-counter/" class="button-primary us-doc-link" target="_blank">Documentation</a>
                <input type="button" class="button-primary us-view-detail" value="<?php _e('View Details', US_TD); ?>"/>
                <?php include('social-counter-details.php'); ?>
            </div>
            <div class="us-each-plugin us-plugin-right">
                  <div class="us-plugin-img-wrap"> <div class='us-plugin-image'><img src='<?php echo US_IMAGE_DIR; ?>/share/social-share-banner.jpg' alt='Ultimate social Shares' title="Ultimate social Shares" /></div>
                </div>
                <div class="us-plugin-title">Social Share</div>
                <p class="us-height-p"><?php _e('Allow anyone easily share website content (page, posts, image, media) on major social media (Facebook, Twitter, Linkedin, GooglePlus, Pinterest, Digg, Buffer, Reddit, Tumblr, StumbleUpon, Xing, Weibo, VK, Delicious).', US_TD); ?></p>
                <div class='us-plugin-usage'><img src='<?php echo US_IMAGE_DIR; ?>/share/social-share.jpg' alt='Ultimate social Shares' title="Ultimate social Shares" /></div>
                
                <a href="<?php echo admin_url('admin.php?page=us-social-share', US_TD); ?>" class="button-primary">Dashboard</a>
                <a href="http://wpultimatesocial.com/documentation/social-share/" class="button-primary us-doc-link" target="_blank">Documentation</a>
                <input type="button" class="button-primary us-view-detail" value="<?php _e('View Details', US_TD); ?>"/>
                <?php include('social-share-details.php'); ?>
            </div>
            <div class="us-each-plugin">
                  <div class="us-plugin-img-wrap"> <div class='us-plugin-image'><img src='<?php echo US_IMAGE_DIR; ?>/twitter/twitter-banner.jpg' alt='Ultimate social Twitter Feeds' title="Ultimate Social Twitter Feeds" /></div>
                  </div>
                <div class="us-plugin-title">Twitter Feeds</div>
                <p class="us-height-p"><?php _e('Start strong Twitter integration right on your website and increase your social reach to next level.', US_TD); ?></p>
                <div class='us-plugin-usage'><img src='<?php echo US_IMAGE_DIR; ?>/twitter/twitter.jpg' alt='Ultimate social Twitter Feeds' title="Ultimate Social Twitter Feeds" /></div>
                
                <a href="<?php echo admin_url('admin.php?page=us-twitter-feed'); ?>" class="button-primary">Dashboard</a>
                <a href="http://wpultimatesocial.com/documentation/twitter-feeds/" class="button-primary us-doc-link" target="_blank">Documentation</a>
                <input type="button" class="button-primary us-view-detail" value="<?php _e('View Details', US_TD); ?>"/>
                <?php include('twitter-feeds-details.php'); ?>

            </div>
            <div class="us-each-plugin">
                  <div class="us-plugin-img-wrap"> <div class='us-plugin-image'><img src='<?php echo US_IMAGE_DIR; ?>/pinterest/pinterest-banner.jpg' alt='Ultimate social Pinterest' title="Ultimate Social Pinterest" /></div>
                  </div>
                <div class="us-plugin-title">Pinterest</div>
                <p class="us-height-p"><?php _e('Manage all your pinterest to wordpress tasks', US_TD); ?></p>
                <div class='us-plugin-usage'><img src='<?php echo US_IMAGE_DIR; ?>/pinterest/pinterest.jpg' alt='Ultimate social Pinterest' title="Ultimate Social Pinterest" /></div>

                <a href="<?php echo admin_url('admin.php?page=us-pinterest'); ?>" class="button-primary">Dashboard</a>
                <a href="http://wpultimatesocial.com/documentation/pinterest/" class="button-primary us-doc-link" target="_blank">Documentation</a>
                <input type="button" class="button-primary us-view-detail" value="<?php _e('View Details', US_TD); ?>"/>
                <?php include('pinterest-details.php'); ?>
            </div>
            <div class="us-each-plugin us-plugin-right">
                 <div class="us-plugin-img-wrap">  <div class='us-plugin-image'><img src='<?php echo US_IMAGE_DIR; ?>/auto-post/social-autoPost-banner.jpg' alt='Ultimate social Auto Posts' title="Ultimate Social Auto Posts" /></div>
                 </div>
                <div class="us-plugin-title">Social Auto Post</div>
                <p class="us-height-p"><?php _e('Auto post all your website content to social media (Facebook, Twitter, LinkedIn, Tumblr) with proper,easy and fully automated way.', US_TD); ?></p>
                <div class='us-plugin-usage'><img src='<?php echo US_IMAGE_DIR; ?>/auto-post/social-auto-post.jpg' alt='Ultimate social Auto Posts' title="Ultimate Social Auto Posts" /></div>
                
                <a href="<?php echo admin_url('admin.php?page=us-auto-post'); ?>" class="button-primary">Dashboard</a>
                <a href="http://wpultimatesocial.com/documentation/social-auto-post/" class="button-primary us-doc-link" target="_blank">Documentation</a>
                <input type="button" class="button-primary us-view-detail" value="<?php _e('View Details', US_TD); ?>"/>
                <?php include('social-auto-post-details.php'); ?>
            </div>
            <div class="us-each-plugin">
                <div class="us-plugin-img-wrap">   <div class='us-plugin-image'><img src='<?php echo US_IMAGE_DIR; ?>/login/social-login-banner.jpg' alt='Ultimate social Login' title="Ultimate Social Login" /></div>
                </div>
                <div class="us-plugin-title">Social Login</div>
                <p class="us-height-p"><?php _e('Allow your website users to register/login to the website using one of their favorite social website accounts.', US_TD); ?></p>
                <div class='us-plugin-usage'><img src='<?php echo US_IMAGE_DIR; ?>/login/social-login.jpg' alt='Ultimate social Login' title="Ultimate Social Login" /></div>
                
                <a href="<?php echo admin_url('admin.php?page=us-social-login'); ?>" class="button-primary">Dashboard</a>
                <a href="http://wpultimatesocial.com/documentation/social-login/" class="button-primary us-doc-link" target="_blank">Documentation</a>
                <input type="button" class="button-primary us-view-detail" value="<?php _e('View Details', US_TD); ?>"/>
                <?php include('social-login-details.php'); ?>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
