<?php
$us_settings = array();
	$serial_key 	= 	'';
	$uuid 			=	'';
	$sku 			=	'';
	$us_settings['us_settings']['plugin_validate']['serial_key'] 	= $serial_key;
	$us_settings['us_settings']['plugin_validate']['uuid'] 			= $uuid;
	$us_settings['us_settings']['plugin_validate']['sku'] 			= $sku;
	$us_settings['us_settings']['plugin_validate']['flag'] = '0';
	$us_settings['us_settings']['plugin_validate']['msg'] = 'serial key empty';
	$us_settings['us_settings']['plugin_validate']['first_time'] = 'true';
	$us_settings['us_settings']['plugin_validate']['activation_date'] = '';
	$us_settings['us_settings']['plugin_validate']['expire_date'] = '';

	 // The option already exists, so we just update it.
	if (!get_option(US_SETTINGS)) {
    		update_option( US_SETTINGS, $us_settings );
    }