<?php
defined('ABSPATH') or die("No script kiddies please!");

//Decleration of the necessary constants for plugin
if (!defined('APSP_PRO_VERSION')) {
    define('APSP_PRO_VERSION', '1.0.2');
}

if (!defined('APSP_PRO_IMAGE_DIR')) {
    define('APSP_PRO_IMAGE_DIR', plugin_dir_url(__FILE__) . 'images');
}

if (!defined('APSP_PRO_JS_DIR')) {
    define('APSP_PRO_JS_DIR', plugin_dir_url(__FILE__) . 'js');
}

if (!defined('APSP_PRO_CSS_DIR')) {
    define('APSP_PRO_CSS_DIR', plugin_dir_url(__FILE__) . 'css');
}

if (!defined('APSP_PRO_LANG_DIR')) {
    define('APSP_PRO_LANG_DIR', basename(dirname(__FILE__)) . '/languages/');
}

if (!defined('APSP_PRO_TEXT_DOMAIN')) {
    define('APSP_PRO_TEXT_DOMAIN', 'ultimate-social');
}

if (!defined('APSP_PRO_SETTINGS')) {
    define('APSP_PRO_SETTINGS', 'apspp-pinterest');
}

/**
 * Register of widgets
 * */
include_once('inc/backend/widget.php');

//Decleration of the class for necessary configuration of a plugin

if (!class_exists('APSP_PRO_Class_free')) {

    class APSP_PRO_Class_free {

        var $apspp_settings;

        /*
          Constructor for the plugins functions
         */

        function __construct() {
            $this->apspp_settings = get_option(APSP_PRO_SETTINGS);
            add_action('init', array($this, 'session_init')); //start the session if not started yet.
            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets')); //registers all the assets required for wp-admin
            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets')); // registers all the assets required for the frontend
            add_action('wp_head', array($this, 'apspp_add_header_styles'));
            add_action('widgets_init', array($this, 'add_apspp_widget'));
            add_filter("the_content", array($this, 'prepare_the_content'), 100);
            add_shortcode('us-pinterest-follow-button', array($this, 'apspp_follow_button_shortcode'));
            add_shortcode('us-pinterest-profile-widget', array($this, 'apspp_profile_widget_shortcode'));
            add_shortcode('us-pinterest-board-widget', array($this, 'apspp_board_widget_shortcode'));
            add_shortcode('us-pinterest-pin-image', array($this, 'apspp_pin_widget_shortcode'));
            add_shortcode('us-pinterest-latest-pins', array($this, 'apspp_latest_pins_widget_shortcode'));
            add_action('admin_post_apspp_save_options', array($this, 'apspp_save_options')); //save the options in the wordpress options table.
            add_action('admin_post_apspp_restore_default_settings', array($this, 'apspp_restore_default_settings')); //restores default settings.
            add_action('add_meta_boxes', array($this, 'pinterest_meta_box')); //for providing the option to disable the social share option in each frontend page
            add_action('save_post', array($this, 'save_meta_values')); //function to save the post meta values of a plugin.
        }

        /*
         * Prepare the hidden field for container selector
         */

        public function prepare_the_content($content) {
            global $post;
            $input_html = '<input class="apspp" type="hidden" />';
            $content = $input_html . $content;
            return $content;
        }

        /*
          starts the session with the call of init hook
         */

        function session_init() {
            if (!session_id()) {
                session_start();
            }
        }

        /* True if plugin should be added to the current post/page */

        function add_pinterest_buttons() {
            global $post;
            $options = get_option( APSP_PRO_SETTINGS );

            if (empty($options['display_options']) || $options['custom_pinit_enable'] != 'on') {
                return false;
            } else {
                if (isset($post->ID)) {

                    $content_flag = get_post_meta($post->ID, 'apspp_content_flag', true);
                } else {
                    $content_flag = false;
                }

                if (is_home()) {
                    $home_page = in_array('home_page', $options['display_options']);
                    $is_home = (is_home() && $content_flag != '1') && $home_page ? true : false;
                    return $home_page;
                } else if (is_front_page()) {
                    $front_page = in_array('front_page', $options['display_options']);
                    $is_front_page = (is_front_page() && $content_flag != '1' ) && $front_page ? true : false;
                    return $is_front_page;
                } else if (is_singular()) {
                    $is_single = is_singular($options['display_options']) && !is_front_page() && $content_flag != '1' ? true : false;
                    return $is_single;
                } else if (is_tax()) {
                    $taxonomies = self::get_registered_taxonomies();
                    $content_flag = false;
                    if (!empty($taxonomies)) {
                        foreach ($taxonomies as $key => $value) {
                            $required_tax_objects = $value->labels;
                            $name = $required_tax_objects->name;
                            // echo $value->name;
                            if (is_tax($value->name)) {
                                if (in_array($value->name, $options['display_options'])) {
                                    $content_flag = true;
                                    $custom_tax = (is_tax() && $content_flag == true ) ? true : false;
                                    return $custom_tax;
                                }
                            }
                        }
                    }
                } else if (is_archive() && !is_category() || is_search() || is_tag()) {
                    $is_default_archive = in_array('archives', $options['display_options']);
                    $default_archives = ( (is_archive() && !is_tax() ) && !is_category() ) && $is_default_archive ? true : false;
                    return $default_archives;
                } else if (is_category()) {
                    $is_default_categories = in_array('categories', $options['display_options']);
                    $default_categories = (is_category() && !is_tax() && is_archive()) && $is_default_categories ? true : false;
                    return $default_categories;
                }
            }
        }

        /* function copied from https://gist.github.com/wesbos/1189639 */

        private static function is_blog_page() {
            global $post;

            $post_type = get_post_type($post);

            return ( ( is_home() || is_archive() || is_single() ) && ( $post_type == 'post' ) );
        }

        //load the default settings of the plugin
        function plugin_activation() {
            if (!get_option(APSP_PRO_SETTINGS)) {
                include('inc/backend/activation.php');
            }
        }

        /*
         * Registration of the backend assets of a plugin 
         */

        function register_admin_assets() {
            if(isset($_GET['page']) && $_GET['page'] == 'us-pinterest'){
                wp_enqueue_style('apspp-backend-css', APSP_PRO_CSS_DIR . '/backend.css', '', APSP_PRO_VERSION);
                wp_enqueue_script('apspp-backend-js', APSP_PRO_JS_DIR . '/backend.js', array('jquery', 'jquery-ui-sortable', 'wp-color-picker'), APSP_PRO_VERSION, true);
                wp_enqueue_media(); //added this for image upload options
                wp_enqueue_style('apspp-fontawesome-css', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', '', APSP_PRO_VERSION);
            }
        }

        /*
         * Registration of the frontend assets of a plugin
         */

        function register_frontend_assets() {
            global $post;
            if (isset($post->ID)) {

                $post_url = get_permalink($post->ID);
            } else {
                $post_url = '';
            }
            $apspp_options = $this->apspp_settings;
            /*
             * Frontend css
             */
            wp_enqueue_style('apspp-font-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans', array(), false);
            wp_enqueue_style('apspp-frontend-css', APSP_PRO_CSS_DIR . '/frontend.css', '', APSP_PRO_VERSION);

            /*
             * Frontend scripts
             */
            wp_enqueue_script('masionary-js', APSP_PRO_JS_DIR . '/jquery-masionary.js', array('jquery'), APSP_PRO_VERSION, true);
            wp_enqueue_script('frontend-js', APSP_PRO_JS_DIR . '/frontend.js', array('jquery', 'masionary-js'), APSP_PRO_VERSION, true);

            /*
             * Localization of the php variables in js
             */
            $use_custom_image = isset($apspp_options['custom_image']['status']) && $apspp_options['custom_image']['status'] == "on";

            $preavailable_image_selection = APSP_PRO_IMAGE_DIR . '/icons/pin-' . $apspp_options['custom_image_selection'] . '.png';
            $size = getimagesize($preavailable_image_selection);

            $parameters_array = array(
                'enableCustomPinit' => $apspp_options['custom_pinit_enable'],
                'containerSelector' => $apspp_options['container_selector'],
                'imageSelector' => $apspp_options['image_selector'],
                'disabledClasses' => $apspp_options['disabled_classes'],
                'enabledClasses' => $apspp_options['enabled_classes'],
                'minImageHeight' => $apspp_options['min_image_size']['height'],
                'minImageWidth' => $apspp_options['min_image_size']['width'],
                'descriptionOption' => $apspp_options['description_source'],
                'post_page_url' => $post_url,
                'customImageUrl' => $use_custom_image ? $apspp_options['custom_image']['image_url'] : '',
                'siteTitle' => get_bloginfo('name', 'display'),
                'buttonPosition' => $apspp_options['button_position'],
                'buttonDisplayOption' => $apspp_options['button_display_option'],
                'buttonDisplayBelowImage' => $apspp_options['button_display_below_image'],
                'retinaFriendly' => ( isset($apspp_options['retina_friendly']) && $apspp_options['retina_friendly'] == 'on' ) ? 'on' : 'off',
                'pinImageHeight' => $use_custom_image ? $apspp_options['custom_image']['image_height'] : $size[1],
                'pinImageWidth' => $use_custom_image ? $apspp_options['custom_image']['image_width'] : $size[0],
                'buttonMarginTop' => $apspp_options['apspp_button_margin_top'],
                'buttonMarginBottom' => $apspp_options['apspp_button_margin_bottom'],
                'buttonMarginLeft' => $apspp_options['apspp_button_margin_left'],
                'buttonMarginRight' => $apspp_options['apspp_button_margin_right'],
            );

            $check = $this->add_pinterest_buttons();
            if (isset($check) && $check == '1') {
                wp_localize_script('frontend-js', 'apspp_js_settings', apply_filters('apspp_javascript_parameters', $parameters_array));
            }

            if ($this->apspp_settings['js_enabled'] == 'on') {
                if(!isset($this->apspp_settings['native_display_options'])){
                    // echo "need to show the pinterest icon in all";
                     if ($this->apspp_settings['pinit_js_disable'] == 'off') {
                       wp_enqueue_script('pinit-js', '//assets.pinterest.com/js/pinit.js', false, null, true);
                    }
                    add_filter('clean_url', array($this, 'pinit_js_config'));
                }
                $check = self:: add_native_pinterest_buttons();
                if(isset($check) && $check=='1'){
                    if ($this->apspp_settings['pinit_js_disable'] == 'off') {
                        wp_enqueue_script('pinit-js', '//assets.pinterest.com/js/pinit.js', false, null, true);
                    }
                    add_filter('clean_url', array($this, 'pinit_js_config'));
                }
            } else {
                if ($this->apspp_settings['pinit_js_disable'] == 'off') {
                    wp_enqueue_script('pinit-js', '//assets.pinterest.com/js/pinit.js', false, null, true);
                }
            }
        }


        /*
         * function to add the header styles by plugin
         */

        function apspp_add_header_styles() {
            $options = get_option(APSP_PRO_SETTINGS);

            $use_custom_image = isset($options['custom_image']['status']) && $options['custom_image']['status'] == "on";

            $preavailable_image_selection = APSP_PRO_IMAGE_DIR . '/icons/pin-' . $options['custom_image_selection'] . '.png';
            $size = getimagesize($preavailable_image_selection);
            $width = $use_custom_image ? $options['custom_image']['image_width'] : $size[0];
            $height = $use_custom_image ? $options['custom_image']['image_height'] : $size[1];

            $url = $use_custom_image ? $options['custom_image']['image_url'] : $preavailable_image_selection;

            if (isset($options['retina_friendly']) && $options['retina_friendly'] == 'on') {
                $width = floor($width / 2);
                $height = floor($height / 2);
            }
            ?>
            <!--[if lt IE 9]>
            <style type="text/css">
                    .pinit-overlay {
                            background-image: url( '<?php echo APSP_PRO_IMAGE_DIR . '/images/white.png'; ?>' ) !important;
                    }
            </style>
            <![endif]-->

            <style type="text/css">
                a.app-pinit-button {
                    width: <?php echo $width; ?>px !important;
                    height: <?php echo $height; ?>px !important;
                    background: transparent url('<?php echo $url; ?>') no-repeat 0 0 !important;
                    background-size: <?php echo $width; ?>px <?php echo $height; ?>px !important;
                    display: inline-block;
                    position: absolute;

                }

                img.pinit-hover {
                    opacity: <?php echo (1 - $options['transparancy_value']); ?> !important;
                }
            </style>
            <?php
        }

        /*
         * registration of plugin's widget
         */

        function add_apspp_widget() {
            register_widget('APSP_PRO_Follow_Widget');
            register_widget('APSP_PRO_Profile_Widget');
            register_widget('APSP_PRO_Board_Widget');
            register_widget('APSP_PRO_Single_Pin_Widget');
            register_widget('APSP_PRO_Latest_Pins_Widget');
        }

        /*
         * Follow pin shortcode
         */

        function apspp_follow_button_shortcode($attr) {
            ob_start();
            include( 'inc/frontend/follow-shortcode.php' );
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /*
         * Profile shortcode
         */

        function apspp_profile_widget_shortcode($profile_attr) {
            ob_start();
            include( 'inc/frontend/profile-shortcode.php' );
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /*
         * Board shortcode
         */

        function apspp_board_widget_shortcode($board_attr) {
            ob_start();
            include( 'inc/frontend/board-shortcode.php' );
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /*
         * Pin widget shortcode
         */

        function apspp_pin_widget_shortcode($atts) {
            ob_start();
            include( 'inc/frontend/pin-widget-shortcode.php' );
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /*
         * Latest pins shortcode
         */

        function apspp_latest_pins_widget_shortcode($attr) {
            ob_start();
            include( 'inc/frontend/latest-pins-shortcode.php' );
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        /*
         * function to save the settings of a plugin
         */

        function apspp_save_options() {
            if (isset($_POST['apspp_add_nonce_save_settings']) && isset($_POST['apspp_save_settings']) && wp_verify_nonce($_POST['apspp_add_nonce_save_settings'], 'apspp_nonce_save_settings'))
                include( 'inc/backend/save-settings.php' );
        }

        /*
         * plugins backend admin page
         */

        public static function main_page() {
            include('inc/backend/main-page.php');
        }

        function return_cache_period($seconds) {
            //please set the integer value in seconds
            return 2;
        }

        /*
         * Get the latest pins of board or profile
         */

        function apspp_pinterest_get_rss_feed($feed_url, $number_of_pins_to_show) {
            // Get a SimplePie feed object from the specified feed source.
            add_filter('wp_feed_cache_transient_lifetime', array($this, 'return_cache_period'));
            $rss = fetch_feed($feed_url);
            remove_filter('wp_feed_cache_transient_lifetime', array($this, 'return_cache_period'));
            if (!is_wp_error($rss)) {
                // Figure out how many total items there are, but limit it to number specified
                $maxitems = $rss->get_item_quantity($number_of_pins_to_show);
                $rss_items = $rss->get_items(0, $maxitems);
                return $rss_items;
            } else {
                return false;
            }
        }

        /*
         * Trim function
         */

        function trim_text($text, $length) {
            //strip html
            $text = strip_tags($text);
            //no need to trim if its shorter than length
            if (strlen($text) <= $length) {
                return $text;
            }
            $last_space = strrpos(substr($text, 0, $length), ' ');
            $trimmed_text = substr($text, 0, $last_space);
            $trimmed_text .= '...';
            return $trimmed_text;
        }

        /*
         * Pinterest pins configuration
         */

        function pinit_js_config($url) {
            if (FALSE === strpos($url, 'pinit') || FALSE === strpos($url, '.js') || FALSE === strpos($url, 'pinterest.com')) {
                // this isn't a Pinterest URL, ignore it
                return $url;
            }
            $return_string = "' async defer";
            $hover_op = $this->apspp_settings['js_enabled'];
            $color_op = $this->apspp_settings['color'];
            $size_op = $this->apspp_settings['size'];
            $lang_op = $this->apspp_settings['language'];
            $shape_op = $this->apspp_settings['shape'];

            // if image hover is enabled, append the data-pin-hover attribute
            if (isset($hover_op) && $hover_op == "on") {
                $return_string = "$return_string data-pin-hover='true";
            }

            // add the shape
            if (isset($shape_op) && $shape_op == 'round') {
                $return_string = "$return_string' data-pin-shape='$shape_op";
            }

            // add the size only if it's set to something besides small
            if (isset($size_op)) {
                if ($size_op == "28" && $shape_op == 'rectangular') {
                    $return_string = "$return_string' data-pin-tall='true";
                } else if ($size_op == "28" && $shape_op == 'round') {
                   
                    $return_string = "$return_string' data-pin-tall='true";
                }
            }

            // if shape is not round, add the color and language
            if ($shape_op != "round") {
                // add the color
                if (isset($color_op)) {
                    $return_string = "$return_string' data-pin-color='$color_op";
                }
                // add the language (EN or JP)
                if (isset($lang_op)) {
                    $return_string = "$return_string' data-pin-lang='$lang_op";
                }
            }
            if ($return_string == "") {
                return $url;
            }
            return $url . $return_string;
        }

        /*
         * Function to restore the default setting of a plugin
         */

        function apspp_restore_default_settings() {
            $nonce = $_REQUEST['_wpnonce'];
            if (!empty($_GET) && wp_verify_nonce($nonce, 'apspp-restore-default-settings-nonce')) {
                //restore the default plugin activation settings from the activation page.
                include( 'inc/backend/activation.php' );
                $_SESSION['apspp_message'] = __('Settings restored Successfully.', APSS_TEXT_DOMAIN);
                wp_redirect(admin_url() . 'admin.php?page=' . APSP_PRO_TEXT_DOMAIN);
                exit;
            } else {
                die('No script kiddies please!');
            }
        }

        function add_native_pinterest_buttons() {
            global $post;
            $options = get_option( APSP_PRO_SETTINGS );
            if(empty($options['native_display_options'])){
                return false;
            }else{
                if(isset($post->ID)){
                    if( is_home() ){
                        $home_page=in_array( 'home_page', $options['native_display_options'] );
                        $is_home=(is_home()) && $home_page ? true : false;
                        return $home_page;
                    }else if ( is_front_page() ){
                        $front_page = in_array('front_page', $options['native_display_options']);
                        $is_front_page = ( is_front_page() ) && $front_page ? true : false;
                        return $is_front_page;

                    }else if ( is_singular() ){
                        $is_single = ( is_singular($options['native_display_options']) && !is_front_page() ) ? true : false;
                        return $is_single;

                    }else if(is_tax()){
                        $taxonomies = self::get_registered_taxonomies();
                        $content_flag = false;
                        if (!empty($taxonomies)) {
                            foreach ($taxonomies as $key => $value) {
                                $required_tax_objects = $value->labels;
                                $name = $required_tax_objects->name;
                                //echo $value->name;
                                if(is_tax($value->name)){
                                    if (in_array($value->name, $options['native_display_options'])) {
                                         $content_flag = true;
                                         $custom_tax = (is_tax() ) ? true : false;
                                         return $custom_tax;
                                    }
                                }
                            }
                        }
                    }else if ( is_archive() && !is_category()|| is_search() || is_tag() ){
                        $is_default_archive = in_array( 'archives', $options['native_display_options'] );
                        $default_archives = ( (is_archive() && !is_tax() ) && !is_category() ) && $is_default_archive ? true : false;
                        return $default_archives;

                    }else if( is_category() ){
                        $is_default_categories = in_array( 'categories', $options['native_display_options'] );
                        $default_categories =(is_category() && !is_tax() && is_archive()) && $is_default_categories ? true : false;
                        return $default_categories;

                    }
                }
            }
        }

        //returns all the registered post types only
        public static function get_registered_post_types() {
            $post_types = get_post_types();
            unset($post_types['post']);
            unset($post_types['page']);
            unset($post_types['attachment']);
            unset($post_types['revision']);
            unset($post_types['nav_menu_item']);
            return $post_types;
        }

        // returns all the registered taxonomies
        public static function get_registered_taxonomies() {
            $output = 'objects';
            $args = '';
            $taxonomies = get_taxonomies($args, $output);
            unset($taxonomies['category']);
            unset($taxonomies['post_tag']);
            unset($taxonomies['nav_menu']);
            unset($taxonomies['link_category']);
            unset($taxonomies['post_format']);
            return $taxonomies;
        }

        ///////////////////////////for post meta options//////////////////////////////////
        /**
         * Adds a section in all the post and page section to disable the share options in frontend pages
         */
        function pinterest_meta_box() {
            add_meta_box('ap-share-box', 'Ultimate Social Pinterest', array($this, 'metabox_callback'), '', 'side', 'core');
        }

        function metabox_callback($post) {
            wp_nonce_field('save_meta_values', 'apspp_share_meta_nonce');
            $content_flag = get_post_meta($post->ID, 'apspp_content_flag', true);
            ?>
            <label><input type="checkbox" value="1" name="apspp_content_flag" <?php checked($content_flag, true) ?>/><?php _e('Hide pinterest pin in content', APSP_PRO_TEXT_DOMAIN); ?></label><br>

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
            if (!isset($_POST['apspp_share_meta_nonce'])) {
                return;
            }

            // Verify that the nonce is valid.
            if (!wp_verify_nonce($_POST['apspp_share_meta_nonce'], 'save_meta_values')) {
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
            //$this->print_array($_POST);die();
            $content_flag = (isset($_POST['apspp_content_flag']) && $_POST['apspp_content_flag'] == 1) ? 1 : 0;

            // Update the meta field in the database.
            update_post_meta($post_id, 'apspp_content_flag', $content_flag);
        }

        ////////////////////////////////////////////////////////////
    }

}


