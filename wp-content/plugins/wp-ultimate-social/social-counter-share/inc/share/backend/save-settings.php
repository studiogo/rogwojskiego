<?php
defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
$apss_share_settings = array();
if ($_POST['action'] == 'apss_save_options') {

    // var_dump($_POST);
    // die();
    $share_options = array();
    if(isset($_POST['apss_share_settings']['share_options'])){
        foreach ($_POST['apss_share_settings']['share_options'] as $key => $value) {
            $share_options[] = $value;
        }
    }
    $apss_share_settings['share_options'] = $share_options;
    $apss_share_settings['social_icon_set'] = $_POST['apss_share_settings']['social_icon_set'];
    $apss_share_settings['share_positions'] = $_POST['apss_share_settings']['social_share_position_options'];
    $apss_share_settings['share_locations'] = $_POST['apss_share_settings']['social_share_location_options'];
    
    $floating_sidebar = array();
    foreach ($_POST['apss_share_settings']['floating_sidebar'] as $key => $value) {
        $floating_sidebar[$key] = $value;
    }
    
    $apss_share_settings['floating_sidebar'] = $floating_sidebar;
   
    $mobile_floating_sidebar = array();
    if(isset($_POST['apss_share_settings']['mobile_floating_sidebar'])){
        foreach ($_POST['apss_share_settings']['mobile_floating_sidebar'] as $key => $value) {
            $mobile_floating_sidebar[$key] = $value;
        }
    }
    
    $apss_share_settings['mobile_floating_sidebar'] = $mobile_floating_sidebar;

    $attr =array();
    foreach ($_POST['apss_share_settings']['social_share_sticky_share'] as $key => $value) {
        $attr[$key]=$value;
    }

    $apss_share_settings['social_share_sticky_share'] = $attr;


    $social_networks = array();
    $apss_social_newtwork_order = explode(',', $_POST['apss_social_newtwork_order']);
    $social_network_array = array();
    foreach ($apss_social_newtwork_order as $social_network) {
        $social_network_array[$social_network] = (isset($_POST['social_networks'][$social_network])) ? 1 : 0;
    }
    
    $apss_share_settings['social_networks'] = $social_network_array;

    //for floating social network ordering
    $floating_social_networks = array();
    $apss_floating_social_newtwork_order = explode(',', $_POST['apss_floating_social_newtwork_order']);
    $floating_social_network_array = array();
    foreach ($apss_floating_social_newtwork_order as $floating_social_network) {
        $floating_social_network_array[$floating_social_network] = (isset($_POST['floating_social_networks'][$floating_social_network])) ? 1 : 0;
    }

    $apss_share_settings['floating_social_networks'] = $floating_social_network_array;
    ////////////////////////

    $apss_share_settings['share_text'] = stripslashes_deep( $_POST['apss_share_settings']['share_text'] );
    // $apss_share_settings['share_text_position'] = $_POST['apss_share_settings']['share_text_position'];

    $popup_options=array();
    foreach ($_POST['apss_share_settings']['popup_options'] as $key => $value) {
        $popup_options[$key]=$value;
    }


    $apss_share_settings['popup_options']=$popup_options;

    $apss_share_settings['twitter_username'] = stripslashes_deep($_POST['apss_share_settings']['twitter_username']);
    $apss_share_settings['counter_enable_options']  = $_POST['apss_share_settings']['counter_enable_options'];
    $apss_share_settings['twitter_counter_api']     = $_POST['apss_share_settings']['twitter_counter_api'];

    $apss_share_settings['bitly']['enable']     = $_POST['apss_share_settings']['bitly']['enable'];
    $apss_share_settings['bitly']['username']   = stripslashes_deep( $_POST['apss_share_settings']['bitly']['username'] );
    $apss_share_settings['bitly']['api_key']    = stripslashes_deep( $_POST['apss_share_settings']['bitly']['api_key'] );


    $fb_app_id = isset( $_POST['apss_share_settings']['api_configuration']['facebook']['app_id'] ) ? $_POST['apss_share_settings']['api_configuration']['facebook']['app_id'] : '';
    $fb_app_secret = isset( $_POST['apss_share_settings']['api_configuration']['facebook']['app_secret'] ) ? $_POST['apss_share_settings']['api_configuration']['facebook']['app_secret'] : '';
    $apss_share_settings['api_configuration']['facebook'] =  array(
                                                        'app_id'=> stripslashes_deep($fb_app_id),
                                                        'app_secret'=>stripslashes_deep($fb_app_secret)
                                                        );

    $apss_share_settings['total_counter_enable_options'] = $_POST['apss_share_settings']['total_counter_enable_options'];
    $apss_share_settings['counter_type_options'] = $_POST['apss_share_settings']['counter_type_options'];
    $apss_share_settings['enable_http_count']               = $_POST['apss_share_settings']['enable_http_count'];

    $share_texts =array();
    foreach ($_POST['apss_share_settings']['share_texts'] as $key => $value) {
        $share_texts[$key]= stripslashes_deep($value);
    }

    $apss_share_settings['share_texts'] = $share_texts;

    $apss_social_networks_naming = array();
    foreach ($_POST['apss_share_settings']['apss_social_networks_naming'] as $key => $value) {
        $apss_social_networks_naming[$key] = stripslashes_deep($value);
    }

    $apss_share_settings['apss_social_networks_naming']     = $apss_social_networks_naming;
    $apss_share_settings['enable_cache']                    = isset($_POST['apss_share_settings']['enable_cache']) ? $_POST['apss_share_settings']['enable_cache'] : '1';
    $apss_share_settings['cache_period']                    = is_numeric($_POST['apss_share_settings']['cache_settings']) ? $_POST['apss_share_settings']['cache_settings'] : '24';
    $apss_share_settings['dialog_box_options']              = $_POST['apss_share_settings']['dialog_box_options'];

    $apss_share_settings['disable_whatsapp_in_desktop']     = isset($_POST['apss_share_settings']['disable_whatsapp_in_desktop']) ? $_POST['apss_share_settings']['disable_whatsapp_in_desktop'] : '0';
    $apss_share_settings['disable_viber_in_desktop']        = isset($_POST['apss_share_settings']['disable_viber_in_desktop']) ? $_POST['apss_share_settings']['disable_viber_in_desktop'] : '0';
    $apss_share_settings['disable_sms_in_desktop']          = isset($_POST['apss_share_settings']['disable_sms_in_desktop']) ? $_POST['apss_share_settings']['disable_sms_in_desktop'] : '0';
    $apss_share_settings['disable_messenger_in_desktop']    = isset($_POST['apss_share_settings']['disable_messenger_in_desktop']) ? $_POST['apss_share_settings']['disable_messenger_in_desktop'] : '0';

    $apss_share_settings['apss_email_share_popup_disable']  = isset($_POST['apss_share_settings']['apss_email_share_popup_disable']) ? $_POST['apss_share_settings']['apss_email_share_popup_disable'] : '0';
    $apss_share_settings['apss_email_subject']              = stripslashes_deep($_POST['apss_share_settings']['apss_email_subject']);
    $apss_share_settings['apss_email_body']                 = stripslashes_deep($_POST['apss_share_settings']['apss_email_body']);
    
    // The option already exists, so we just update it.
    update_option(APSS_SETTING_NAME, $apss_share_settings);
    $_SESSION['apss_message'] = __('Settings Saved Successfully.', APSS_TEXT_DOMAIN);
    wp_redirect(admin_url() . 'admin.php?page=us-social-share');
    exit;
}

