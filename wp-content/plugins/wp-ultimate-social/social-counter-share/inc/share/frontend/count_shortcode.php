<?php
defined('ABSPATH') or die("No script kiddies please!");
global $post;
$options = get_option( APSS_SETTING_NAME );

$counter_type_options = $options['counter_type_options'];

if(isset($attr['custom_url_link']) && $attr['custom_url_link'] !=''){
	$url = esc_url($attr['custom_url_link']);
}else{
	$url = (get_permalink() != FALSE) ? get_permalink() : APSS_Class:: curPageURL();
}

if( isset($attr['network']) ){
	$raw_array = explode( ',', $attr['network'] );
	$network_array=array_map('trim', $raw_array );
	$new_array = array();
	foreach( $network_array as $network )
	{
		$new_array[$network] = '1';
	}
	$options['social_networks'] = $new_array;
}


if(isset($attr['http_count'])){
	if ( $attr['http_count'] == '1' ) {
		$http_url_checked = 1;
	}else{
		$http_url_checked = 0;
	}
}else {
	// $http_url_checked = 0;
	if(isset($options['enable_http_count'])){
		if ( $options['enable_http_count'] == '1' ) {
			$http_url_checked = 1;
		}else{
			$http_url_checked = 0;
		}
	}else {
		$http_url_checked = 0;
	}
}


$total_count = 0;
$count = 0;
foreach( $options['social_networks'] as $key=>$value ){
	if( intval($value)=='1' ){
		$count = APSS_Class:: get_count($key, $url);
		////////////////////////////////////////
		if(isset($http_url_checked) && $http_url_checked=='1'){
			$url_check = parse_url($url);
			if($url_check['scheme'] == 'https'){
				$flag=TRUE;
			}else{
				$flag=FALSE;
			}

			if($flag == TRUE){
			    $url1 = APSS_Class:: get_http_url($url);
			    $http_count = APSS_Class:: get_count($key, $url1);
			    if($count != $http_count){
			    	$count += $http_count;
			    }else{
			    	$count = $count;
	    		}
			}
		}
		///////////////////////////////////////////
		$total_count += $count;
	}

}

$formatted_count = APSS_Class:: get_formatted_count($total_count , $counter_type_options);
echo $formatted_count;