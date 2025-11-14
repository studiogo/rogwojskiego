<?php
/**
 * Declartion of necessary constants for plugin
 * */
if (!defined('SC_IMAGE_DIR')) {
    define('SC_PRO_IMAGE_DIR', plugin_dir_url(__FILE__) . 'images/counter');
}
if (!defined('SC_JS_DIR')) {
    define('SC_PRO_JS_DIR', plugin_dir_url(__FILE__) . 'js/counter');
}
if (!defined('SC_CSS_DIR')) {
    define('SC_PRO_CSS_DIR', plugin_dir_url(__FILE__) . 'css/counter');
}
if (!defined('SC_VERSION')) {
    define('SC_PRO_VERSION', '1.0.0');
}

if (!defined('APSC_TD')) {
    define('APSC_TD', 'ultimate-social');
}

/**
 * Register of widgets
 * */
include_once('inc/counter/backend/widget.php');
if (!class_exists('SC_PRO_Class')) {

    class SC_PRO_Class {

        var $apsc_settings;

        /**
         * Initializes the plugin functions 
         */
        function __construct() {
            $this->apsc_settings = get_option('apsc_settings');
            //register_activation_hook(__FILE__, array($this, 'load_default_settings')); //loads default settings for the plugin while activating the plugin
            
            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets')); //registers admin assests such as js and css
            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets')); //registers js and css for frontend
            add_action('admin_post_apsc_settings_action', array($this, 'apsc_settings_action')); //recieves the posted values from settings form
            add_action('admin_post_apsc_restore_default', array($this, 'apsc_restore_default')); //restores default settings;
            add_action('widgets_init', array($this, 'register_apsc_widget')); //registers the widget
            add_action('add_meta_boxes', array($this, 'social_counter_meta_box')); //for providing the option to disable the social counter option in each frontend page
            add_action('save_post', array($this, 'save_meta_values')); //function to save the post meta values of a plugin.
            
            add_shortcode('us-counter', array($this, 'apsc_shortcode')); //adds a shortcode
            add_shortcode('us-get-count',array($this,'apsc_count_shortcode')); //adds a shortcode to get single social profile counter.

            add_action('admin_post_apsc_delete_cache', array($this, 'apsc_delete_cache')); //deletes the counter values from cache
            add_action('wp_footer', array($this, 'social_counter_floatbar')); //appends the floating sidebar in the body
            add_action('wp_head',array($this,'head_hook'));
        }

        
        /**
         * Load Default Settings
         * */
        function load_default_settings() {
            if (!get_option('apsc_settings')) {
                $apsc_settings = self::get_default_settings();
                update_option('apsc_settings', $apsc_settings);
            }
        }

        

        /**
         * Plugin Main Settings Page
         */
        public static function sc_settings() {
            include('inc/counter/backend/settings.php');
        }

        /**
         * Registering of backend js and css
         */
        function register_admin_assets() {
            $screen = get_current_screen();
            if ((isset($_GET['page']) && $_GET['page'] == 'us-social-counter') || $screen->id == 'widgets') {
                wp_enqueue_style('wp-color-picker');
                wp_enqueue_script('wp-color-picker');
                wp_enqueue_style('sc-admin-css', SC_PRO_CSS_DIR . '/backend.css', array(), SC_PRO_VERSION);
                wp_enqueue_script('sc-admin-js', SC_PRO_JS_DIR . '/backend.js', array('jquery', 'jquery-ui-sortable', 'wp-color-picker'), SC_PRO_VERSION);
                wp_enqueue_style('fontawesome-css', SC_PRO_CSS_DIR . '/font-awesome/font-awesome.min.css', false, SC_PRO_VERSION);
            }
        }

        /**
         * Registers Frontend Assets
         * */
        function register_frontend_assets() {
            // wp_enqueue_style('apsc-font-awesome', SC_PRO_CSS_DIR . '/font-awesome/font-awesome.css', array(), SC_PRO_VERSION);
            wp_enqueue_style('apsc-social-pro-font', SC_PRO_CSS_DIR . '/social-pro-fonts/social-pro-custom-icons.css', array(), SC_PRO_VERSION);
            wp_enqueue_style('apsc-font-awesome', SC_PRO_CSS_DIR.'/font-awesome/css/font-awesome.min.css', array(), SC_PRO_VERSION);

            wp_enqueue_style('apsc-googlefont-roboto', 'http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900,100', array(), false);
            wp_enqueue_style('apsc-frontend-css', SC_PRO_CSS_DIR . '/frontend.css', array(), SC_PRO_VERSION);
            wp_enqueue_script('apsc-frontend-script', SC_PRO_JS_DIR . '/frontend.js', array('jquery'), SC_PRO_VERSION, true );
            
        }

        /**
         * Saves settings to database
         */
        function apsc_settings_action() {
            if (!empty($_POST) && wp_verify_nonce($_POST['apsc_settings_nonce'], 'apsc_settings_action')) {
                include('inc/counter/backend/save-settings.php');
            }
        }

        /**
         * Prints array in pre format
         */
        function print_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

       

        /**
         * Restores the default 
         */
        function apsc_restore_default() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'apsc-restore-default-nonce')) {
                $apsc_settings = $this->get_default_settings();
                update_option('apsc_settings', $apsc_settings);
                $_SESSION['apsc_message'] = __('Default Settings Restored Successfully',  US_TD);
                wp_redirect(admin_url() . 'admin.php?page=us-social-counter');
            }
        }

        /**
         * Returns Default Settings
         */
        function get_default_settings() {
            $apsc_settings = array('social_profile' => array('facebook' => array('page_id' => ''),
                    'twitter' => array('username' => '', 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '', 'default_count' => ''),
                    'googlePlus' => array('page_id' => '', 'api_key' => '', 'default_count' => ''),
                    'instagram' => array('username' => '', 'access_token' => '', 'default_count' => ''),
                    'youtube' => array('username' => '', 'channel_url' => '', 'default_count' => ''),
                    'soundcloud' => array('username' => '', 'client_id' => '', 'default_count' => ''),
                    'dribbble' => array('username' => '', 'default_count' => ''),
                    'steam' => array('group_name' => '', 'default_count' => ''),
                    'vimeo' => array('username' => '', 'default_count' => ''),
                    'pinterest' => array('profile_url' => '', 'default_count' => ''),
                    'forrst' => array('username' => '', 'default_count' => ''),
                    'vk' => array('group_id' => '', 'default_count' => ''),
                    'flickr' => array('group_id' => '', 'api_key' => '', 'default_count' => ''),
                    'behance' => array('username' => '', 'api_key' => '', 'default_count' => ''),
                    'github' => array('username' => '', 'default_count' => ''),
                    'envato' => array('username' => '', 'profile_url' => '', 'default_count' => ''),
                    'linkedin' => array('company_name' => '', 'default_count' => ''),
                    'rss' => array('rss_url' => '', 'default_count' => '')
                ),
                'profile_order' => array('facebook', 'twitter', 'googlePlus', 'instagram', 'youtube', 'soundcloud', 'dribbble', 'steam', 'vimeo', 'pinterest', 'forrst', 'vk', 'flickr', 'behance', 'github', 'envato', 'linkedin', 'rss', 'posts', 'comments'),
                'icon_hover_animation' => '',
                'counter_format' => 'default',
                'hide_count' => 0,
                'total_count' => 0,
                'floating_sidebar' => array('active' => 0, 'show' => 'only_homepage', 'theme' => 'theme-1','icon_hover'=>''),
                'social_profile_theme' => 'theme-1',
                'cache_period' => ''
            );
            return $apsc_settings;
        }

        /**
         * Ultimate Social Counter Widget
         */
        function register_apsc_widget() {
            register_widget('APSC_PRO_Widget');
        }

        ///////////////////////////for post meta options//////////////////////////////////
        /**
         * Adds a section in all the post and page section to disable the share options in frontend pages
         */
        function social_counter_meta_box() {
            add_meta_box('apsc-floating-counter-box', 'AccessPress Social Counter Pro options', array($this, 'metabox_callback'), '', 'side', 'core');
        }

        function metabox_callback($post) {
            wp_nonce_field('save_meta_values', 'apsc_meta_nonce');
            $sidebar_flag = get_post_meta($post->ID, 'apsc_sidebar_flag', true);
            ?>
            <label><input type="checkbox" value="1" name="apsc_sidebar_flag" <?php checked($sidebar_flag, true) ?>/><?php _e('Hide floating sidebar',  'ap-social-pro'); ?></label>
            <?php
        }

        /**
         * Save Share Flags on post save
         */
        function save_meta_values($post_id) {

            /*
             * We need to verify this came from our screen and with proper authorization,
             * because the save_post action can be triggered at other times.
             */

            // Check if our nonce is set.
            if (!isset($_POST['apsc_meta_nonce'])) {
                return;
            }

            // Verify that the nonce is valid.
            if (!wp_verify_nonce($_POST['apsc_meta_nonce'], 'save_meta_values')) {
                return;
            }

            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            // Check the user's permissions.
            if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

                if (!current_user_can('edit_page', $post_id)) {
                    return;
                }
            } else {

                if (!current_user_can('edit_post', $post_id)) {
                    return;
                }
            }

            /* OK, it's safe for us to save the data now. */
            // Make sure that it is set.
            // $this->print_array($_POST);die();
            $sidebar_flag = (isset($_POST['apsc_sidebar_flag']) && $_POST['apsc_sidebar_flag'] == 1) ? 1 : 0;

            // Update the meta field in the database.
            update_post_meta($post_id, 'apsc_sidebar_flag', $sidebar_flag);
        }

        ////////////////////////////////////////////////////////////

        /**
         * Adds Shortcode
         */
        function apsc_shortcode($atts) {
            ob_start();
            include('inc/counter/frontend/shortcode.php');
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /**
         *
         * Counter Only Shortcode
         * */
         function apsc_count_shortcode($atts){
            if(isset($atts['social_media'])){
                $count = $this->get_count($atts['social_media']);
                if(isset($atts['count_format']) && $count!=''){
                    $count = $this->get_formatted_count($count,$atts['count_format']);
                }
                return $count;
            }
         }

        /**
         * Clears the counter cache
         */
        function apsc_delete_cache() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'apsc-cache-nonce')) {
                $transient_array = array('apsc_facebook',
                    'apsc_twitter',
                    'apsc_youtube',
                    'apsc_instagram',
                    'apsc_googlePlus',
                    'apsc_soundcloud',
                    'apsc_dribbble',
                    'apsc_github',
                    'apsc_envato',
                    'apsc_forrst',
                    'apsc_vimeo',
                    'apsc_pinterest',
                    'apsc_vk',
                    'apsc_behance',
                    'apsc_flickr',
                    'apsc_envato',
                    'apsc_posts',
                    'apsc_comments',
                    'apsc_linkedin',
                    'apsc_rss');
                foreach ($transient_array as $transient) {
                    delete_transient($transient);
                }
                $_SESSION['apsc_message'] = __('Cache Deleted Successfully',  US_TD);
                wp_redirect(admin_url() . 'admin.php?page=us-social-counter');
            }
        }

        /**
         * 
         * @param type $user
         * @param type $consumer_key
         * @param type $consumer_secret
         * @param type $oauth_access_token
         * @param type $oauth_access_token_secret
         * @return string
         */
        function authorization($user, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret) {
            $query = 'screen_name=' . $user;
            $signature = $this->signature($query, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret);

            return $this->header($signature);
        }

        /**
         * 
         * @param type $url
         * @param type $query
         * @param type $method
         * @param type $params
         * @return type string
         */
        function signature_base_string($url, $query, $method, $params) {
            $return = array();
            ksort($params);

            foreach ($params as $key => $value) {
                $return[] = $key . '=' . $value;
            }

            return $method . "&" . rawurlencode($url) . '&' . rawurlencode(implode('&', $return)) . '%26' . rawurlencode($query);
        }

        /**
         * 
         * @param type $query
         * @param type $consumer_key
         * @param type $consumer_secret
         * @param type $oauth_access_token
         * @param type $oauth_access_token_secret
         * @return type array
         */
        function signature($query, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret) {
            $oauth = array(
                'oauth_consumer_key' => $consumer_key,
                'oauth_nonce' => hash_hmac('sha1', time(), true),
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_token' => $oauth_access_token,
                'oauth_timestamp' => time(),
                'oauth_version' => '1.0'
            );
            $api_url = 'https://api.twitter.com/1.1/users/show.json';
            $base_info = $this->signature_base_string($api_url, $query, 'GET', $oauth);
            $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
            $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
            $oauth['oauth_signature'] = $oauth_signature;

            return $oauth;
        }

        /**
         * Build the header.
         *
         * @param  array $signature OAuth signature.
         *
         * @return string           OAuth Authorization.
         */
        public function header($signature) {
            $return = 'OAuth ';
            $values = array();

            foreach ($signature as $key => $value) {
                $values[] = $key . '="' . rawurlencode($value) . '"';
            }

            $return .= implode(', ', $values);

            return $return;
        }

        /**
         * Returns twitter count
         */
        function get_twitter_count() {
            $apsc_settings = $this->apsc_settings;
            $user = $apsc_settings['social_profile']['twitter']['username'];
            $api_url = 'https://api.twitter.com/1.1/users/show.json';
            $params = array(
                'method' => 'GET',
                'sslverify' => false,
                'timeout' => 60,
                'headers' => array(
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => $this->authorization(
                            $user, $apsc_settings['social_profile']['twitter']['consumer_key'], $apsc_settings['social_profile']['twitter']['consumer_secret'], $apsc_settings['social_profile']['twitter']['access_token'], $apsc_settings['social_profile']['twitter']['access_token_secret']
                    )
                )
            );

            $connection = wp_remote_get($api_url . '?screen_name=' . $user, $params);

            if (is_wp_error($connection)) {
                $count = 0;
            } else {
                $_data = json_decode($connection['body'], true);
                if (isset($_data['followers_count'])) {
                    $count = intval($_data['followers_count']);
                } else {
                    $count = 0;
                }
            }
            return $count;
        }

        /**
         * Social Counter Floating Sidebar
         */
        function social_counter_floatbar() {
            $apsc_settings = $this->apsc_settings;
            if (isset($apsc_settings['floating_sidebar']['active']) && $apsc_settings['floating_sidebar']['active'] == 1) {


                switch ($apsc_settings['floating_sidebar']['show']) {
                    case 'all':
                        global $post;
                        if (isset($post->ID)) {
                            $sidebar_flag = get_post_meta( $post->ID, 'apsc_sidebar_flag', true );
                        } else {
                            $sidebar_flag = 0;
                        }

                        if ($sidebar_flag != '1') {
                            include('inc/counter/frontend/floating-sidebar.php');
                        }
                        break;
                    case 'only_homepage':
                        if (is_front_page()) {
                            global $post;
                            if (isset($post->ID)) {
                                $sidebar_flag = get_post_meta( $post->ID, 'apsc_sidebar_flag', true );
                            } else {
                                $sidebar_flag = 0;
                            }

                            if ($sidebar_flag != '1') {
                                include('inc/counter/frontend/floating-sidebar.php');
                            }
                        }
                        break;
                    case 'except_homepage':
                        if (!is_front_page()) {
                            global $post;
                            if (isset($post->ID)) {
                                $sidebar_flag = get_post_meta( $post->ID, 'apsc_sidebar_flag', true );
                            } else {
                                $sidebar_flag = 0;
                            }

                            if ($sidebar_flag != '1') {
                                include('inc/counter/frontend/floating-sidebar.php');
                            }
                        }
                        break;
                    default:
                        break;
                }
            }
        }

        function get_count($profile) {
            include('inc/counter/frontend/api.php');
            return $count;
        }

        /**
         * 
         * @param int $count
         * @param string $format
         */
        function get_formatted_count($count, $format) {
            switch ($format) {
                case 'comma':
                    $count = number_format($count);
                    break;
                case 'short':
                    $count = $this->abreviateTotalCount($count);
                    break;
                default:
                    break;
            }
            return $count;
        }

        /**
         * 
         * @param integer $value
         * @return string
         */
        function abreviateTotalCount($value) {

            $abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

            foreach ($abbreviations as $exponent => $abbreviation) {

                if ($value >= pow(10, $exponent)) {

                    return round(floatval($value / pow(10, $exponent)), 1) . $abbreviation;
                }
            }
        }
        
        function head_hook(){
            $apsc_settings = $this->apsc_settings;
            if(isset($apsc_settings['mobile_hide']) && $apsc_settings['mobile_hide']==1){
                ?>
                <style>
                 @media (max-width:768px){
                    .apsc-floating-sidebar{
                    display:none;
                    }
                    
                    }
                </style>
                <?php 
            }
        }
        
    function facebook_count($url){
        // Query in FQL
        $fql  = "SELECT like_count ";
        $fql .= " FROM link_stat WHERE url = '$url'";
     
        $fqlURL = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql);
     
        // Facebook Response is in JSON
        $response = file_get_contents($fqlURL);
        $response = json_decode($response);
        if(is_array($response) && isset($response[0]->like_count)){
            return $response[0]->like_count;
        }else{
            $count  = 0;
            return $count;
        }
     
    }

    /**
    * Get Facebook Access Token
    * */
    function get_fb_access_token(){
        $apsc_settings = $this->apsc_settings;
        $api_url = 'https://graph.facebook.com/';
        $url = sprintf(
            '%soauth/access_token?client_id=%s&client_secret=%s&grant_type=client_credentials',
            $api_url,
            $apsc_settings['social_profile']['facebook']['app_id'] ,
            $apsc_settings['social_profile']['facebook']['app_secret']
        );
        $access_token = wp_remote_get( $url, array( 'timeout' => 60 ) );

        if ( is_wp_error( $access_token ) || ( isset( $access_token['response']['code'] ) && 200 != $access_token['response']['code'] ) ) {
            return '';
        } else {
            return sanitize_text_field( $access_token['body'] );
        }
    }

    /**
    * Get New Facebook Count
    * */
    function new_fb_count(){
        $apsc_settings = $this->apsc_settings;
        $access_token = $this->get_fb_access_token();
        $access_token = json_decode($access_token);
        $access_token = $access_token->access_token;
        $api_url = 'https://graph.facebook.com/v2.6/';
        $url = sprintf(
            '%s%s?fields=fan_count&access_token=%s',
            $api_url,
            $apsc_settings['social_profile']['facebook']['page_id'] ,
            $access_token
        );

        $connection = wp_remote_get( $url, array( 'timeout' => 60 ) );
       

        if ( is_wp_error( $connection ) || ( isset( $connection['response']['code'] ) && 200 != $connection['response']['code'] ) ) {
            $total = 0;
        } else {
            $_data = json_decode( $connection['body'], true );
            if ( isset( $_data['fan_count'] ) ) {
                $count = intval( $_data['fan_count'] );

                $total = $count;
            } else {
                $total = 0;
            }
        }
        return $total;
    }

    }

    
}