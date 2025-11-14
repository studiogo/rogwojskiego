<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Declartion of necessary constants for plugin
 * */
if (!defined('APS_PRO_IMAGE_DIR')) {
    define('APS_PRO_IMAGE_DIR', plugin_dir_url(__FILE__) . 'images');
}
if (!defined('APS_PRO_JS_DIR')) {
    define('APS_PRO_JS_DIR', plugin_dir_url(__FILE__) . 'js');
}
if (!defined('APS_PRO_CSS_DIR')) {
    define('APS_PRO_CSS_DIR', plugin_dir_url(__FILE__) . 'css');
}
if (!defined('APS_PRO_ICONS_DIR')) {
    define('APS_PRO_ICONS_DIR', plugin_dir_url(__FILE__) . 'icon-sets');
}
if (!defined('APS_PRO_LANG_DIR')) {
    define('APS_PRO_LANG_DIR', basename(dirname(__FILE__)) . '/languages');
}
/**
 * Register of widgets
 * */
include_once('inc/backend/widgets.php');
if (!class_exists('US_Social_icons_class')) {

    class US_Social_icons_class {

        /**
         * Attributes Declaration
         */
        var $icon_style;

        /**
         * Initialization of plugin from constructor
         * */
        function __construct() {

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets'));
            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets')); //registers all the assets required for wp-admin
            add_action('admin_init', array($this, 'admin_session_init')); //intializes session 
            add_action('admin_post_aps_add_new_set', array($this, 'aps_add_new_set')); //add new set action
            add_action('admin_post_aps_edit_action', array($this, 'aps_edit_action')); //icon set edit action
            add_action('admin_post_aps_delete_action', array($this, 'aps_delete_action')); //icon set edit action
            add_action('admin_post_aps_social_sidebar_action', array($this, 'aps_social_sidebar_action')); //action for saving the setting for social sidebar
            add_shortcode('us-social-icon', array($this, 'aps_social_shortcode')); //adds the aps-social shortcode
            $aps_social_sidebar = get_option('aps_social_sidebar');
            if (!empty($aps_social_sidebar) && $aps_social_sidebar['social_sidebar'] == 1 && $aps_social_sidebar['icon_set_id'] != '') {
                add_action('wp_footer', array($this, 'aps_social_sidebar_frontend'));
            }
            add_action('wp_ajax_aps_icon_list_action', array($this, 'aps_icon_list_action')); //admin ajax action for icon listing 
            add_action('wp_ajax_nopriv_aps_icon_list_action', array($this, 'no_permission')); //action for unauthenticate admin ajax call
            add_action('wp_ajax_get_theme_icons', array($this, 'get_theme_icons')); //admin ajax for getting theme icons
            add_action('wp_ajax_nopriv_get_theme_icons', array($this, 'no_permission')); //ajax action for unathenticate admin ajax call
            add_action('widgets_init', array($this, 'register_aps_widget')); //register aps widget
            add_action('wp_ajax_get_sidebar_icon_set', array($this, 'get_sidebar_icon_set')); //ajax function to get the icon sets in sidebar section
        }

        //called when plugin is activated
        function plugin_activation() {
            include_once('inc/backend/activation.php');
        }

        

        //plugin's main page
        public static function main_page() {
            if (isset($_GET['sub_page']) && $_GET['sub_page'] == 'social_sidebar') {
                include('inc/backend/social-sidebar.php');
            } else if (isset($_GET['sub_page']) && $_GET['sub_page'] == 'how_to_use') {
                include('inc/backend/how-to-use.php');
            } else if (isset($_GET['sub_page']) && $_GET['sub_page'] == 'add_new_set') {
               include_once('inc/backend/add-new-set.php');
            } else {

                include_once('inc/backend/main-page.php');
            }
        }

        //Add new set of social icons
        function add_new_set() {
            include_once('inc/backend/add-new-set.php');
        }

        //registers all the js and css in wp-admin
        function register_admin_assets() {
            //including the scripts in the plugins pages only
            if (isset($_GET['page']) && ($_GET['page'] == 'us-social-icons' || $_GET['page'] == 'aps-social-pro-add' || $_GET['page'] == 'aps-social-sidebar' || $_GET['page'] == 'aps-social-pro-about' || $_GET['page'] == 'aps-social-pro-how-to-use')) {
                $aps_script_variable = array('icon_preview' => __('Icon Preview', US_TD),
                    'icon_link' => __('Icon Link', US_TD),
                    'icon_link_target' => __('Icon Link Target'),
                    'icon_delete_confirm' => __('Are you sure you want to delete this icon from this list?', US_TD),
                    'set_name_required_message' => __('Please enter the name for the set', US_TD),
                    'min_icon_required_message' => __('Please add at least one icon in the set', US_TD),
                    'ajax_url' => admin_url() . 'admin-ajax.php',
                    'ajax_nonce' => wp_create_nonce('aps-ajax-nonce'),
                    'icon_warning' => __('Are you sure you want to discard the icons added previously?', US_TD),
                    'icon_collapse' => __('Collapse All', US_TD),
                    'icon_expand' => __('Expand All', US_TD));
                /**
                 * Backend CSS
                 * */
                wp_enqueue_style('aps-admin-css', APS_PRO_CSS_DIR . '/backend.css');
                wp_enqueue_style('aps-animate-css', APS_PRO_CSS_DIR . '/animate.css'); //animate.css library
                wp_enqueue_style('thickbox'); //for including wp thickbox css
                wp_enqueue_style('wp-color-picker'); //for including color picker css
                wp_enqueue_style('aps-font-awesome-css', APS_PRO_CSS_DIR . '/font-awesome/font-awesome.min.css'); //for including font awesome css

                /**
                 * Backend JS
                 * */
                wp_enqueue_script('jquery-ui-sortable');
                wp_enqueue_script('media-upload'); //for uploading image using wp native uploader
                wp_enqueue_script('thickbox'); //for uploading image using wp native uploader + thickbox 
                wp_enqueue_script('aps-admin-js', APS_PRO_JS_DIR . '/backend.js', array('jquery', 'jquery-ui-sortable', 'wp-color-picker'));
                wp_enqueue_script('aps-temp-admin-js', APS_PRO_JS_DIR . '/temp-backend.js', array('jquery', 'jquery-ui-sortable', 'wp-color-picker'));
                wp_localize_script('aps-admin-js', 'aps_script_variable', $aps_script_variable); //localization of php variable in aps-admin-js
            }
        }

        //registers all the assets for frontend
        function register_frontend_assets() {
            /**
             * Frontend Style
             * */
            wp_enqueue_style('aps-animate-css', APS_PRO_CSS_DIR . '/animate.css');
            //wp_enqueue_style('aps-font-awesome-css', APS_PRO_CSS_DIR . '/font-awesome/font-awesome.min.css'); //for including font awesome css
            wp_enqueue_style('aps-frontend-css', APS_PRO_CSS_DIR . '/frontend.css'); //for including font awesome css
            wp_enqueue_script('aps-frontend-js', APS_PRO_JS_DIR . '/frontend.js', array('jquery'));
        }

        //action to save the set in db
        function aps_add_new_set() {

            if (isset($_POST['aps_add_set_nonce'], $_POST['aps_icon_set_submit']) && wp_verify_nonce($_POST['aps_add_set_nonce'], 'aps_add_new_set')) {
                include_once('inc/backend/save-set.php');
            } else {
                die('No script kiddies please!');
            }
        }

        //prints the array in pre format
        function print_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

        //starts the session
        function admin_session_init() {
            if (!session_id()) {
                session_start();
            }
        }

        //Icon set delete section
        function aps_delete_action() {
            if (isset($_GET['action'], $_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'aps-delete-nonce')) {
                include_once('inc/backend/delete-icon-set.php');
            } else {
                die('No script kiddies please!');
            }
        }

        //Icon set edit action
        function aps_edit_action() {

            if (isset($_POST['aps_edit_set_nonce'], $_POST['aps_icon_set_submit']) && wp_verify_nonce($_POST['aps_edit_set_nonce'], 'aps_edit_action')) {
                include_once('inc/backend/save-set.php');
            } else {
                die('No script kiddies please!');
            }
        }

        //social sidebar section
        function social_sidebar() {
            include('inc/backend/social-sidebar.php');
        }

        //social sidebar action
        function aps_social_sidebar_action() {
            if (!empty($_POST) && wp_verify_nonce($_POST['aps_social_sidebar_nonce'], 'aps_social_sidebar_action')) {
                include_once('inc/backend/social-sidebar-action.php');
            } else {
                die('No script kiddies please!');
            }
        }

        //shortcode function
        function aps_social_shortcode($atts) {
            if (isset($atts['id'])) {
                //return (print_r($atts,true));
                ob_start();
                include('inc/frontend/shortcode.php');
                $html = ob_get_contents();
                ob_get_clean();
                return $html;
            }
        }

        //social sidebar frontend function
        function aps_social_sidebar_frontend() {
            $sidebar_settings = get_option('aps_social_sidebar');
            switch ($sidebar_settings['display_sidebar']) {
                case 'all':
                    include('inc/frontend/social-sidebar.php');
                    break;
                case 'home':
                    if (is_front_page()) {

                        include('inc/frontend/social-sidebar.php');
                    }
                    break;
                case 'except_home':
                    if (!is_front_page()) {
                        include('inc/frontend/social-sidebar.php');
                    }
                    break;
                default:
                    break;
            }
        }

        //lists the available icons 
        function aps_icon_list_action() {
            if (wp_verify_nonce($_POST['_wpnonce'], 'aps-ajax-nonce')) {
                $plugin_path = plugin_dir_path(__FILE__);
                //include_once('inc/backend/list-icon-sets.php');
                ?>
                <div class="aps-png-icons-wrapper">
                    <h2 class="aps-png-icon-set-heading"><?php _e('PNG Icon Sets', US_TD); ?></h2>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        ?>
                        <div class="aps-set-wrapper <?php echo $i; ?>-png aps-each-icon-set">
                            <h3>Set <?php echo $i; ?></h3>
                            <div class="aps-row">
                                <?php
                                $handle = opendir(dirname(realpath(__FILE__)) . '/icon-sets/png/set' . $i);
                                while ($file = readdir($handle)) {
                                    $filename_array = explode('.', $file);
                                    $ext = end($filename_array);
                                    if ($file !== '.' && $file !== '..' && ($ext == 'png' || $ext == 'svg')) {
                                        $filename = ucfirst($filename_array[0]);
                                        ?>
                                        <div class="aps-col-one-fourth">
                                            <div class="aps-set-image-wrapper">
                                                <a href='javascript:void(0);'>
                                                    <img src="<?php echo APS_PRO_ICONS_DIR . '/png/set' . $i . '/' . $file; ?>" alt="<?php echo $filename; ?>" title="<?php echo $filename; ?>"/>
                                                    <span class="aps-set-image-title"><?php echo $filename; ?></span>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div><!--aps-set-wrapper-->
                        <div class="clear"></div>
                        <?php
                    }
                    ?>
                </div>
                <div class="aps-svg-icons-wrapper">
                    <h2 class="aps-svg-icon-set-heading"><?php _e('SVG Icon Sets', US_TD); ?></h2>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        ?>
                        <div class="aps-set-wrapper <?php echo $i; ?>-svg aps-each-icon-set">
                            <h3>Set <?php echo $i; ?></h3>
                            <div class="aps-row">
                                <?php
                                $handle = opendir(dirname(realpath(__FILE__)) . '/icon-sets/svg/set' . $i);
                                while ($file = readdir($handle)) {
                                    $filename_array = explode('.', $file);
                                    $ext = end($filename_array);
                                    if ($file !== '.' && $file !== '..' && ($ext == 'png' || $ext == 'svg')) {
                                        $filename = ucfirst($filename_array[0]);
                                        ?>
                                        <div class="aps-col-one-fourth">
                                            <div class="aps-set-image-wrapper">
                                                <a href='javascript:void(0);'>
                                                    <img src="<?php echo APS_PRO_ICONS_DIR . '/svg/set' . $i . '/' . $file; ?>" alt="<?php echo $filename; ?>" title="<?php echo $filename; ?>"/>
                                                    <span class="aps-set-image-title"><?php echo $filename; ?></span>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div><!--aps-set-wrapper-->
                        <div class="clear"></div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                die();
            } else {
                die('No script kiddies please!');
            }
        }

        //lists the icons of specific theme
        function get_theme_icons() {
            if (wp_verify_nonce($_POST['_wpnonce'], 'aps-ajax-nonce')) {
                $plugin_path = plugin_dir_path(__FILE__);
                $sub_folder = $_POST['sub_folder'];
                $folder = $_POST['folder'];
                $handle = opendir(dirname(realpath(__FILE__)) . '/icon-sets/' . $sub_folder . '/' . $folder);
                $icon_counter = 0;
                $image_array = array();
                while ($file = readdir($handle)) {
                    $filename_array = explode('.', $file);
                    $ext = end($filename_array);
                    if ($file !== '.' && $file !== '..' && $ext == 'png' || $ext == 'svg') {
                        $icon_counter++;
                        $filename = ucfirst($filename_array[0]);
                        $image_array[] = $file;
                    }
                }
                natsort($image_array);
                if ($_POST['src_only'] == 'yes') {
                    $image_src_array = array();
                    foreach ($image_array as $image) {
                        $filename_array = explode('.', $image);
                        $filename = ucfirst($filename_array[0]);
                        $image_src_array[$filename] = APS_PRO_ICONS_DIR . '/' . $sub_folder . '/' . $folder . '/' . $image;
                    }
                    echo json_encode($image_src_array);
                } else {
                    foreach ($image_array as $file) {
                        $filename_array = explode('.', $file);
                        $filename = ucfirst($filename_array[0]);
                        include('inc/backend/theme-each-icon.php');
                    }
                }
            } else {
                die('No script kiddies please');
            }
            die();
        }

        //prevents unauthorized ajax call
        function no_permission() {
            die('No script kiddies please!');
        }

        //returns the current page url
        function curPageURL() {
            $pageURL = 'http';
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $pageURL .= "s";
            }
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            }
            return $pageURL;
        }

        //registers the APS widget
        function register_aps_widget() {
            register_widget('APS_PRO_Widget');
        }

        //how to use section
        function how_to_use() {
            include('inc/backend/how-to-use.php');
        }

        //about section
        function about() {
            include('inc/backend/about.php');
        }

        //returns total number of displaying icons
        function get_total_display_icons($icons) {
            $counter = 0;
            foreach ($icons as $icon) {
                if ($icon['link'] != '') {
                    $counter++;
                }
            }
            return $counter;
        }

        //builds icon set for sidebar preview
    public static function build_sidebar_icon_set($icon_set_id, $icon_margin, $icon_animation) {
            global $wpdb;
            $table_name = $table_name = $wpdb->prefix . "aps_social_icons_pro";
            $icon_sets = $wpdb->get_results("SELECT * FROM $table_name where si_id = $icon_set_id");
            if (!empty($icon_sets)) {
                $icon_set = $icon_sets[0];
                $icon_extra = unserialize($icon_set->icon_extra);
                $icon_details = unserialize($icon_set->icon_details);
                include('inc/backend/each-icon-generator.php');
            }
        }

        //returns the icon sets
        function get_sidebar_icon_set() {
            if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'aps-ajax-nonce')) {
                $icon_set_id = $_POST['icon_set_id'];
                if ($icon_set_id != '') {
                    $icon_margin = $_POST['icon_margin'];
                    $icon_margin = ($icon_margin == '') ? '0px' : str_replace('px', '', $icon_margin) . 'px';
                    $icon_animation = $_POST['icon_animation'];
                    $this->build_sidebar_icon_set($icon_set_id, $icon_margin, $icon_animation);
                }
            }
            die();
        }

    }

    //APS_Class termination
}// class exists condition check
 
 