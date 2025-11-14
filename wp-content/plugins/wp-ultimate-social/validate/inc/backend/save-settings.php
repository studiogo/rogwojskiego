<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
 $options = get_option( US_SETTINGS );
 $us_settings = array();

if ($_POST['action'] == 'us_save_validation_settings') {
	$serial_key 	=	$_POST['us_settings']['plugin_validate']['serial_key'];
	$uuid 			=	$_POST['us_settings']['plugin_validate']['uuid'];
	$sku 			=	$_POST['us_settings']['plugin_validate']['sku'];
	
	$us_settings['us_settings']['plugin_validate']['serial_key'] 	= $serial_key;
	$us_settings['us_settings']['plugin_validate']['uuid'] 			= $uuid;
	$us_settings['us_settings']['plugin_validate']['sku'] 			= $sku;
	
    $json = Ultimate_Social:: us_validate_plugin($serial_key, $sku, $uuid);

    if($json['success'] =='false') {
    	$_SESSION['us_message'] = $json['message'];
    	$us_settings['us_settings']['plugin_validate']['flag'] = '0';
    	$us_settings['us_settings']['plugin_validate']['msg'] = $json['message'];
    	/*
		* 	While activating the plugin the first_time variable will be true(it is default. So firt of all it will check if its true or not
		* and if its true plugin is not activated it's license key yet. Else the plugin is already activated previously.
		*/
    	if($options['us_settings']['plugin_validate']['first_time'] =='true'){
    		$us_settings['us_settings']['plugin_validate']['first_time'] 		= 'true';
    		$us_settings['us_settings']['plugin_validate']['activation_date'] 	= '';
    		$us_settings['us_settings']['plugin_validate']['expire_date'] 		= '';

    	}else if($options['us_settings']['plugin_validate']['first_time'] =='false'){
    		$us_settings['us_settings']['plugin_validate']['first_time'] 		= 'false';
    		$us_settings['us_settings']['plugin_validate']['activation_date'] 	= $options['us_settings']['plugin_validate']['activation_date'];
    		$us_settings['us_settings']['plugin_validate']['expire_date'] 		= $options['us_settings']['plugin_validate']['expire_date'];
    	}else{
    		$us_settings['us_settings']['plugin_validate']['first_time'] 		='true';
    		$us_settings['us_settings']['plugin_validate']['activation_date'] 	= ''	;
    	}

    	// The option already exists, so we just update it.
    	$us_settings['us_settings']['plugin_validate']['first_time'] ='true';
    	update_option( US_SETTINGS, $us_settings );

    }else if($json['success'] =='true') {
		$_SESSION['us_message'] 								= $json['message'];
		$us_settings['us_settings']['plugin_validate']['flag'] 	= '1';
		$us_settings['us_settings']['plugin_validate']['msg']  	= $json['message'];
		//$us_settings['us_settings']['plugin_validate']['first_time'] ='true';
		/*
		* 	While activating the plugin the first_time variable will be true(it is default). So first of all it will check if its true or not
		* 	and if its true plugin is not activated it's license key yet. Else the plugin is already activated previously.
		*/
    	if($options['us_settings']['plugin_validate']['first_time'] =='true'){
    		$us_settings['us_settings']['plugin_validate']['first_time'] 			='false';   //now reset the first time value to false so that it will not be firet time
    		$us_settings['us_settings']['plugin_validate']['activation_date'] 		= date('Y-m-d');  //set the activation date
    		$us_settings['us_settings']['plugin_validate']['expire_date'] 			= (date('Y')+1).date('-m-d');
    	
    	}else if($options['us_settings']['plugin_validate']['first_time'] =='false'){
    		
    		if($options['us_settings']['plugin_validate']['serial_key'] != $serial_key ){ // if not same it means we are doing the renew of the license
    			$us_settings['us_settings']['plugin_validate']['first_time'] 		='false';   //now reset the first time value to false so that it will not be firet time
    			$us_settings['us_settings']['plugin_validate']['activation_date'] 	= date('Y-m-d');  //set the activation date
    			$us_settings['us_settings']['plugin_validate']['expire_date'] 		= (date('Y')+1).date('-m-d');
    		}else{ // nothing have changes so save the previous values as it is
	    		$us_settings['us_settings']['plugin_validate']['first_time'] 		= 'false';
	    		$us_settings['us_settings']['plugin_validate']['activation_date'] 	= $options['us_settings']['plugin_validate']['activation_date'];
	    		$us_settings['us_settings']['plugin_validate']['expire_date'] 		= $options['us_settings']['plugin_validate']['expire_date'];
    		}

    	}else{
    		$us_settings['us_settings']['plugin_validate']['first_time'] 		='true';
    		$us_settings['us_settings']['plugin_validate']['activation_date'] 	= '';
    	}
    	

    	update_option( US_SETTINGS, $us_settings );
	}
    wp_redirect( admin_url() . 'admin.php?page=us-validate' );
    exit;

}
?>