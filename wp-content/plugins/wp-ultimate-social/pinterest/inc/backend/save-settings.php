<?php 
defined('ABSPATH') or die('No script kiddies please!');

$apspp_settings = array();
if ($_POST['action'] == 'apspp_save_options') {

  //for option to enable pinit.js from plugin
  $pinit_js_disable = isset($_POST['apspp-pinit-js-disable']) ? $_POST['apspp-pinit-js-disable'] : 'off';
  $apspp_settings['pinit_js_disable'] = $pinit_js_disable;
  //for option to enable pinit.js from plugin ends

  //for custom pinit buttons
  $apspp_settings['custom_pinit_enable'] = $_POST['apspp-custom-pinit-enable'];
  $display_options = array();
  foreach ( $_POST['apspp_display_settings']['display_options'] as $key=>$value ){
    $display_options[]=$value;
  }

  $apspp_settings['display_options'] =$display_options;
  $apspp_settings['container_selector']=$_POST['apspp-container-selector'];
  $apspp_settings['image_selector'] = $_POST['apspp-image-selector'];
  $apspp_settings['disabled_classes'] = $_POST['apspp-disabled-classes'];
  $apspp_settings['enabled_classes'] = $_POST['apspp-enabled-classes'];

  $min_image_size_width=$_POST['apspp-min-image']['width'];
  $min_image_size_height=$_POST['apspp-min-image']['height'];
  $min_image_size = array(
                    'width'=>$min_image_size_width,
                    'height'=>$min_image_size_height
                    );
  $apspp_settings['min_image_size'] =$min_image_size;

  $apspp_settings['description_source'] =$_POST['apspp-pinterest-button-description-source'];
  $apspp_settings['button_position']=$_POST['apspp-pinterest-button-position'];

  $apspp_settings['apspp_button_margin_top']      = $_POST['apspp_button_margin_top'];
  $apspp_settings['apspp_button_margin_bottom']   = $_POST['apspp_button_margin_bottom'];
  $apspp_settings['apspp_button_margin_left']     = $_POST['apspp_button_margin_left'];
  $apspp_settings['apspp_button_margin_right']    = $_POST['apspp_button_margin_right'];
  $apspp_settings['transparancy_value']           = $_POST['apspp-pinterest-transparancy-value'];
  $apspp_settings['button_display_option'] = $_POST['apspp-pinterest-display-option'];
  $apspp_settings['button_display_below_image'] = isset($_POST['apspp-enable-pinit-below-image']) ? $_POST['apspp-enable-pinit-below-image'] : 'off';
  $apspp_settings['retina_friendly'] = isset($_POST['apspp-enable-retina-ready']) ? $_POST['apspp-enable-retina-ready'] : 'off';
  $apspp_settings['custom_image_selection'] = $_POST['apspp-pinit-button-selection'];

  $custom_image_flag=isset($_POST['apspp-pinterest-custom_image']['status']) ? $_POST['apspp-pinterest-custom_image']['status'] :'off';
  $custom_image_url= $_POST['apspp-pinterest-custom_image']['url'];
  $custom_image_height= $_POST['apspp-pinterest-custom_image']['height'];
  $custom_image_width= $_POST['apspp-pinterest-custom_image']['width'];
  $custom_image_settings = array(
            'status'=>$custom_image_flag,
            'image_url'=>$custom_image_url,
            'image_width'=>$custom_image_width,
            'image_height'=>$custom_image_height,
            );
  $apspp_settings['custom_image'] = $custom_image_settings;
  //for custom pinit buttons ends 

  //for native pinit js functions
  $js_enable = isset($_POST['apspp-pinit-js']) ? $_POST['apspp-pinit-js'] : 'off';
  $apspp_settings['js_enabled'] = $js_enable;

  $native_display_options = array();
  foreach ( $_POST['apspp_display_settings']['native_display_options'] as $key=>$value ){
    $native_display_options[]=$value;
  }

  $apspp_settings['native_display_options'] =$native_display_options;
  
  $button_size  =   $_POST['apspp-pinterest-button-size'];
  $button_shape   =   $_POST['apspp-pinterest-button-shape'];
  $button_color =   $_POST['apspp-pinterest-rectangle-color'];
  $button_lang  = $_POST['apspp-pinterest-rectangle-lang'];
  $apspp_settings['size']=$button_size;
  $apspp_settings['shape']=$button_shape;
  $apspp_settings['color']=$button_color;
  $apspp_settings['language']=$button_lang;
  //for native pinit js functions ends here

  //variables not used(for future reserve)


  // var_dump($apspp_settings);
  // die();
	update_option( APSP_PRO_SETTINGS, $apspp_settings );
	$_SESSION['apspp_message'] = __('Settings Saved Successfully.', APSP_PRO_TEXT_DOMAIN);
  wp_redirect(admin_url() . 'admin.php?page=us-pinterest');
  exit;
}


 ?>