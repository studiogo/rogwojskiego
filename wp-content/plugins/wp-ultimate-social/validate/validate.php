
<?php

if (!class_exists('AP_Validate')) {
	class AP_Validate {

        var $apsl_settings;

        function __construct() {
            $this->apsl_settings = get_option(APSL_SETTINGS);
            add_action('init', array($this, 'session_init')); //start the session if not started yet.
            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets')); //registers all the assets required for wp-admin
            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets')); // registers all the assets required for the frontend
            add_action('admin_post_apsl_save_options', array($this, 'save_settings')); //save settings of a plugin
        }

        //starts the session with the call of init hook
        function session_init() {
            if (!session_id()) {
                session_start();
            }
        }

        //called when plugin is activated
		function plugin_activation(){
			if( !get_option( APSS_SETTING_NAME ) ){
			include( 'inc/backend/activation.php' );
			}
		}

		//menu page
        function main_page() {
            include( 'inc/backend/main-page.php' );
        }
	}
}