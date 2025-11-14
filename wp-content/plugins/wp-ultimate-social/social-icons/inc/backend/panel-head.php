<div class="aps-panel-head">
    <div class="aps-row">
        <div class="aps-col-logo">
            <div class="aps-logo">
                <?php /*<img src="<?php echo APS_PRO_IMAGE_DIR . '/logo.png'; ?>" alt="Ultimate Social"> */?>
            </div>
        </div>
        <div class="aps-col-socials">
            <div class="aps-socials">
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

          <div class="aps-col-title">

                <div class="us-title"><?php _e('Social Icons Dashboard', US_TD); ?></div>
                <span class="us-version">V <?php echo US_VERSION; ?></span>
               

            </div>
             <div class='us-dashboard-link'><a href="<?php echo admin_url('admin.php?page=ultimate-social'); ?>"><?php _e('Dashboard', US_TD ); ?></a></div>
     
    </div>
</div>
<?php $active_menu = isset($_GET['sub_page'])?$_GET['sub_page']:'icon_sets';?>
    <div class="aps-menu clearfix">
        <a href="<?php echo admin_url('admin.php?page=us-social-icons'); ?>" <?php echo ($active_menu=='icon_sets')?'class="aps-active-tab"':'';?>><?php _e('Icon Sets', US_TD); ?></a>
        <a href="<?php echo admin_url('admin.php?page=us-social-icons&sub_page=social_sidebar'); ?>" <?php echo ($active_menu=='social_sidebar')?'class="aps-active-tab"':'';?>><?php _e('Social Sidebar', US_TD); ?></a>
        <a href="<?php echo admin_url('admin.php?page=us-social-icons&sub_page=how_to_use'); ?>" <?php echo ($active_menu=='how_to_use')?'class="aps-active-tab"':'';?>><?php _e('How to use', US_TD); ?></a>
    </div>
<div class="aps-panel-body"><!--closing is on main pages-->
    