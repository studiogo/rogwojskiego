<div class="wrap">

<div class='apsl-outer-wrapper'>

<div class="apsl-setting-header clearfix">

   <div class="aps-col-title">
                <div class="us-title"><?php _e('Social Login Dashboard', US_TD); ?></div>
                <span class="us-version">V <?php echo US_VERSION; ?></span>
    </div>
    <div class='us-dashboard-link'><a href="<?php echo admin_url('admin.php?page=ultimate-social'); ?>"><?php _e('Dashboard', US_TD ); ?></a></div>
</div>
        <div class="apsl-right-header-block">
	        <div class="apsl-header-icons">
	            <p>Follow us for new updates</p>
	            <div class="apsl-social-bttns">
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
    <div class="clear"></div>
 

<?php $options = get_option( APSL_SETTINGS );
 //$this->print_array($options);
?>

<?php

if(isset($_SESSION['apsl_message'])){ ?>
<div class="apsl-message">
	<p><?php echo $_SESSION['apsl_message']; unset($_SESSION['apsl_message']);  ?></p>
</div>
<?php } ?>

	<div class='apsl-networks'>
		<div class='apsl-network-options'>
			<form method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
			<input type="hidden" name="action" value="apsl_save_options"/>
			<div class='apsl-settings-tabs-wrapper clearfix'>
				<ul class='apsl-tab-wrapper-fix clearfix'>
					<li><a href='javascript: void(0);' id='apsl-networks-settings' class='apsl-settings-tab apsl-active-tab' ><?php _e('Network settings', APSL_TEXT_DOMAIN ) ?></a></li>
					<li><a href='javascript: void(0);' id='apsl-theme-settings' class='apsl-settings-tab' ><?php _e('Other settings', APSL_TEXT_DOMAIN ) ?></a></li>
					<?php if(function_exists('bp_has_profile')){ ?>
					<li><a href='javascript: void(0);' id='apsl-buddypress-settings' class='apsl-settings-tab' ><?php _e('BuddyPress settings', APSL_TEXT_DOMAIN ) ?></a></li>
					<?php } ?>
					<li><a href='javascript: void(0);' id='apsl-how-to-use' class='apsl-settings-tab' ><?php _e('How to use', APSL_TEXT_DOMAIN ) ?></a></li>
					<?php /* ?>
					<li><a href='javascript: void(0);' id='apsl-about' class='apsl-settings-tab' ><?php _e('About', APSL_TEXT_DOMAIN ) ?></a></li>
					<?php */ ?>
				</ul>
			</div>
			<div class="clear"></div>
			<div class='apsl-setting-tabs-wrapper'>
				<div class='apsl-tab-contents' id='tab-apsl-networks-settings'>
					<?php include(APSL_PLUGIN_DIR.'inc/backend/networks-settings.php'); ?>
				</div>

				<div class='apsl-tab-contents' id='tab-apsl-theme-settings' style="display:none">
					<?php include(APSL_PLUGIN_DIR.'inc/backend/theme-settings.php'); ?>
				</div>

				<?php if(function_exists('bp_has_profile')){ ?>
				<div class='apsl-tab-contents' id='tab-apsl-buddypress-settings' style="display:none">
					<?php include(APSL_PLUGIN_DIR.'inc/backend/buddypress-settings.php'); ?>
				</div>
				<?php } ?>

				<!-- how to use section -->
				<div class='apsl-tab-contents' id='tab-apsl-how-to-use' style="display:none">
					<?php include(APSL_PLUGIN_DIR.'inc/backend/how-to-use.php'); ?>
				</div>

				<!-- about section -->
				<div class='apsl-tab-contents' id='tab-apsl-about' style="display:none">
					<?php include(APSL_PLUGIN_DIR.'inc/backend/about.php'); ?>
				</div>

				<!-- Save settings Button -->
				<div class='apsl-save-settings'>
					<?php wp_nonce_field( 'apsl_nonce_save_settings', 'apsl_settings_action' ); ?>
					<input type='submit' class='apsl-submit-settings primary-button' name='apsl_save_settings' value='<?php _e('Save settings', APSL_TEXT_DOMAIN ); ?>' />
				</div>

				<div class='apsl-restore-settings'>
					<?php $nonce = wp_create_nonce( 'apsl-restore-default-settings-nonce' ); ?>
					<a href="<?php echo admin_url().'admin-post.php?action=apsl_restore_default_settings&_wpnonce='.$nonce;?>" onclick="return confirm('<?php _e( 'Are you sure you want to restore default settings?',APSL_TEXT_DOMAIN ); ?>')"><input type="button" value="Restore Default Settings" class="apsl-reset-button button primary-button"/></a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>