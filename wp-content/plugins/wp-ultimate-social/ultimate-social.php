<?php

defined('ABSPATH') or die('No script kiddies please!!');

/*
  Plugin Name: Ultimate Social
  Plugin URI:  http://wpultimatesocial.com/
  Description: A packaged plugin for all your social media aspects
  Version:     1.1.0
  Author:      wpultimatesocial.com
  Author URI:  http://wpultimatesocial.com/
  Domain Path: /languages
  Text Domain: ultimate-social
 */

if (!defined('US_IMAGE_DIR')) {
    define('US_IMAGE_DIR', plugin_dir_url(__FILE__) . '/images');
}
if (!defined('US_JS_DIR')) {
    define('US_JS_DIR', plugin_dir_url(__FILE__) . '/js');
}

if (!defined('US_PLUGIN_DIR')) {
    define('US_PLUGIN_DIR', plugin_dir_url(__FILE__) );
}

if (!defined('US_CSS_DIR')) {
    define('US_CSS_DIR', plugin_dir_url(__FILE__) . '/css');
}
if (!defined('US_VERSION')) {
    define('US_VERSION', '1.1.0');
}
if (!defined('US_TD')) {
    define('US_TD', 'ultimate-social');
}

if (!defined('US_SETTINGS')) {
    define('US_SETTINGS', 'us-options');
}

/**
 * Necessary file includes
 */
include('social-icons/social-icons.php');
include('social-counter-share/social-counter.php');
include('social-counter-share/social-share.php');
include('twitter-feed/twitter-feed.php');
include('pinterest/pinterest.php');
include('social-auto-post/social-auto-post.php');
include('social-login/social-login.php');


if (!class_exists('Ultimate_Social')) {

    class Ultimate_Social {

        var $aptf_pro_settings;

        function __construct() {
            /**
             * Activation Hooks
             */
            register_activation_hook(__FILE__, array('US_Social_icons_class', 'plugin_activation')); //plugin activation hook for social icons
            register_activation_hook(__FILE__, array('SC_PRO_Class', 'load_default_settings')); // plugin activation hook for social counter
            register_activation_hook(__FILE__, array('APSS_Class', 'plugin_activation')); //plugin activation hook for social share
            register_activation_hook(__FILE__, array('US_Twitter_Feed_Class', 'load_default_settings')); //loads default settings for the plugin while activating the plugin
            register_activation_hook(__FILE__, array('APSP_PRO_Class_free', 'plugin_activation')); //plugin activation hook for pinterest
            register_activation_hook(__FILE__, array('ASAP_Class', 'plugin_activation')); //On plugin activation tasks for social auto post
            register_activation_hook(__FILE__, array('APSL_Class', 'plugin_activation')); //plugin activation hook for social login
            //register_activation_hook(__FILE__, array($this, 'plugin_activation')); //plugin activation hook for plugin validation

            //die();


            /**
             * Plugin Initiation
             */
            $aps_object = new US_Social_icons_class(); //social icons initiation
            $sc_object = new SC_PRO_Class(); //social counter initiation
            $apss_object = new APSS_Class(); //social share initiation
            $aptf_obj = new US_Twitter_Feed_Class(); //twitter feed initiation
            $apspp_object = new APSP_PRO_Class_free(); //pinterest initiation
            $asap_Obj = new ASAP_Class(); //social auto post initiation
            $apsl_object = new APSL_Class(); //social login initiation

            /**
             * Other necessary hooks
             */
            add_action('init', array($this, 'ultimate_social_init'));

             /**
            * plugin activation checker
            */

            //$options    = get_option( US_SETTINGS );
            //var_dump($options);
            // die();
            // $flag       = $options['us_settings']['plugin_validate']['flag'];
            // $expire_date = strtotime($options['us_settings']['plugin_validate']['expire_date']);
            // $today = strtotime(date('Y-m-d'));
            // if($flag =='0'){
            //   add_action('admin_menu', array($this, 'ultimate_social_license'));
            // }else if($flag =='1') {
            //   if($expire_date < $today){
            //     add_action('admin_menu', array($this, 'ultimate_social_license'));
            //   }else{
                add_action('admin_menu', array($this, 'ultimate_social_menu'));
            //   }
            // }

            /*
            * Plugin activation checker ends here
            */

            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets'));
            //add_action('admin_post_us_save_validation_settings', array( $this, 'us_save_validation_settings')); //save the options in the wordpress options table.

        }

        function ultimate_social_init() {
            load_plugin_textdomain(US_TD, false, dirname(plugin_basename(__FILE__)) . '/languages');
            if ( !session_id() && !headers_sent() ) {
                session_start();
            }
        }

        function ultimate_social_menu() {
            add_menu_page(__('Ultimate Social', US_TD), __('Ultimate Social', US_TD), 'manage_options', 'ultimate-social', array($this, 'plugin_dashboard'), US_IMAGE_DIR . '/us-icon.png');
            add_submenu_page('ultimate-social', __('Ultimate Social Dashboard', US_TD), __('Dashboard', US_TD), 'manage_options', 'ultimate-social', array($this, 'plugin_dashboard'));
            /**
             * Social Icons
             * 
             */
            add_submenu_page('ultimate-social', __('Social Icons', 'aps-social'), __('Social Icons', 'aps-social'), 'manage_options', 'us-social-icons', array('US_Social_icons_class', 'main_page'));

            /**
             * Social Counter and share
             */
            add_submenu_page('ultimate-social', __('Social Counter', 'ap-social-pro'), __('Social Counter', 'ap-social-pro'), 'manage_options', 'us-social-counter', array('SC_PRO_Class', 'sc_settings'), SC_PRO_IMAGE_DIR . '/sc-icon.png');
            add_submenu_page('ultimate-social', __('Social Share', 'ap-social-pro'), __('Social Share', 'ap-social-pro'), 'manage_options', 'us-social-share', array('APSS_Class', 'main_page'), APSS_IMAGE_DIR . '/apss-icon.png');
            /**
             * Twitter Feed
             */
            add_submenu_page('ultimate-social', __('Twitter Feeds', US_TD), __('Twitter Feed', US_TD), 'manage_options', 'us-twitter-feed', array('US_Twitter_Feed_Class', 'main_setting_page'));

            /**
             * Pinterest
             */
            add_submenu_page('ultimate-social', 'Pinterest', 'Pinterest', 'manage_options', 'us-pinterest', array('APSP_PRO_Class_free', 'main_page'));

            /**
             * Social Auto Post
             */
            add_submenu_page('ultimate-social', __('Social Auto Post', ASAP_TD), __('Social Auto Post', ASAP_TD), 'manage_options', 'us-auto-post', array('ASAP_Class', 'plugin_main_page'));

            /**
             * Social Login 
             */
            add_submenu_page('ultimate-social', 'Social Login', 'Social Login', 'manage_options', 'us-social-login', array('APSL_Class', 'main_page'));

             /**
             * Plugin validate
             */
           // add_submenu_page('ultimate-social', 'Validate Plugin', 'Validate Plugin', 'manage_options', 'us-validate', array( $this, 'validate_page' ) );
        }

        
        function ultimate_social_license(){
          add_menu_page(__('Ultimate Social', US_TD), __('Ultimate Social', US_TD), 'manage_options', 'us-validate', array($this, 'validate_page'), US_IMAGE_DIR . '/us-icon.png');
          add_submenu_page('ultimate-social', __('Validate Plugin', US_TD), __('Validate Plugin', US_TD), 'manage_options', 'us-validate', array($this, 'validate_page'));
        }

        function plugin_dashboard() {
            include_once('inc/ultimate-social/dashboard.php');
        }

        function register_admin_assets() {
            if (isset($_GET['page']) && ($_GET['page'] == 'ultimate-social'  ) ) {

                wp_enqueue_style('us-admin-style', US_CSS_DIR . '/backend-style.css', array(), US_VERSION);
                wp_enqueue_script('us-admin-script', US_JS_DIR . '/backend.js', array('jquery'), US_VERSION);
            }

            //added for the validation of a plugin
            if (isset($_GET['page']) && $_GET['page'] == 'us-validate') {
                wp_enqueue_style('us-validate-style', US_PLUGIN_DIR . 'validate/css/backend.css', array(), US_VERSION);
                wp_enqueue_script('us-validate-script', US_PLUGIN_DIR . 'validate/js/backend.js', array('jquery'), US_VERSION);
            }
            //added for the validation of a plugin ends

            wp_enqueue_style('us-admin-default-style', US_CSS_DIR . '/default-style.css', array(), US_VERSION);
        }

        // function plugin_activation(){
        //    include( 'validate/inc/backend/activation.php' );
        // }

        // function validate_page(){
        //     include( 'validate/inc/backend/main-page.php' );

        // }

        // function us_save_validation_settings(){
        //     //var_dump($_POST);
        //     if ( isset( $_POST['us-validate-plugin-nonce'] ) && isset( $_POST['us_submit_license'] ) && wp_verify_nonce( $_POST['us-validate-plugin-nonce'], 'us-validate-plugin-nonce') ){
        //          include( 'validate/inc/backend/save-settings.php' );
        //     }
        //     else
        //     {
        //         die('No script kiddies please!');
        //     }
        // }

        //function to return json values from social media urls
        private function get_json_values( $url ){
            $args = array( 'timeout' => 10 );
            $response = wp_remote_get( $url, $args );
            $json_response = wp_remote_retrieve_body( $response );
            return $json_response;
        }

        function us_validate_plugin($serial_key, $sku, $uuid){
          $json_string = $this->get_json_values( 'http://wpultimatesocial.com/beta/?wc-api=validate_serial_key&serial='.$serial_key.'&sku='.$sku.'&uuid='.$uuid );
          $json = json_decode( $json_string, true );
          return $json;
        }

    }

    //class termination

    $ultimate_social_obj = new Ultimate_Social();
}// class not exists check





