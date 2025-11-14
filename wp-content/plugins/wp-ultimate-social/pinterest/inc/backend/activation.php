<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>
<?php
$apspp_settings = array();
$apspp_settings['pinit_js_disable'] = 'off';

//for custom pinit button
$apspp_settings['custom_pinit_enable'] ='on';
$apspp_settings['display_options'] = array('post', 'page');
$apspp_settings['container_selector']='div';
$apspp_settings['image_selector'] = '.apspp-container img';
$apspp_settings['disabled_classes'] = '';
$apspp_settings['enabled_classes'] = '';

$min_image_size = array(
                    'width'=>'0',
                    'height'=>'0'
                    );
$apspp_settings['min_image_size'] =$min_image_size;

$apspp_settings['description_source'] ='1';
$apspp_settings['button_position']='1';

$apspp_settings['apspp_button_margin_top']      = '10';
$apspp_settings['apspp_button_margin_bottom']   = '10';
$apspp_settings['apspp_button_margin_left']     = '10';
$apspp_settings['apspp_button_margin_right']    = '10';
$apspp_settings['transparancy_value']           = '0.50';

$apspp_settings['button_display_option'] = '2';
$apspp_settings['button_display_below_image'] = '';
$apspp_settings['retina_friendly'] = '';
$apspp_settings['custom_image_selection'] = '1';

$custom_image_settings = array(
            'status'=>'',
            'image_url'=>'',
            'image_width'=>'80',
            'image_height'=>'80',
            );
$apspp_settings['custom_image'] = $custom_image_settings;
//for custom pinit button ends here

//for native pinit buttons
$apspp_settings['js_enabled'] = 'off';
$apspp_settings['size']='small';
$apspp_settings['shape']='rectangular';
$apspp_settings['color']='gray';
$apspp_settings['language']='eng';
//for native pinit buttons ends here

//variables not used(for future reserve)
$apspp_settings['description_source'] ='';


update_option( APSP_PRO_SETTINGS, $apspp_settings);
?>