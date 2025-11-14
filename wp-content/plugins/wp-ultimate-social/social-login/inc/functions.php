<?php

if(!function_exists('siteUrl')){
	function siteUrl(){
		return site_url();
	}
}


if(!function_exists('callBackUrl')){
	function callBackUrl(){
		$connection = !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
		$url = $connection . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"];
		if(strpos($url, '?')===false){
			$url .= '?';
		}else{
			$url .= '&';
		}
		return $url;
	}
}

//function to return json values from social media urls
if(!function_exists('get_json_values')){
	function get_json_values( $url ){
	    $response = wp_remote_get( $url);
	    $json_response = wp_remote_retrieve_body( $response );
	    return $json_response;
	}
}

if(!function_exists('apsl_redirect')){
	function apsl_redirect($redirect){
		if (headers_sent()){ // Use JavaScript to redirect if content has been previously sent (not recommended, but safe)
			echo '<script language="JavaScript" type="text/javascript">window.location=\'';
			echo $redirect;
			echo '\';</script>';
		}else{	// Default Header Redirect
			header('Location: ' . $redirect);
		}
		exit;
	}
}

if(!function_exists('updateUser')){
	function updateUser($username, $email){
		$row = $this->getUserByUsername ($username);
		if($row && $email!='' && $row->user_email!=$email){
			$row = (array) $row;
			$row['user_email']  = $email;
			wp_update_user($row);
		}
	}
}

if(!function_exists('getUserByMail')){
	function getUserByMail($email){
		global $wpdb;
		$row = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE user_email = '$email'");
		if($row){
			return $row;
		}
		return false;
	}

}

if(!function_exists('getUserByUsername')){
	function getUserByUsername ($username){
		global $wpdb;
		$row = $wpdb->get_row("SELECT * FROM $wpdb->users WHERE user_login = '$username'");
		if($row){
			return $row;
		}
		return false;
	}
}

if(!function_exists('creatUser')){
	function creatUser($user_name, $user_email){
		$random_password = wp_generate_password(12, false);
		$user_id = wp_create_user( $user_name, $random_password, $user_email );
		$options = get_option( APSL_SETTINGS );
		if($options['apsl_send_email_notification_options'] == 'yes'){
			wp_new_user_notification( $user_id, $random_password );
		}
		return $user_id;
	}
}

if(!function_exists('set_cookies')){
	function set_cookies($user_id = 0, $remember = true) {
		if (!function_exists('wp_set_auth_cookie')){
		  return false;
		}
		if (!$user_id){
		  return false;
		}
		wp_clear_auth_cookie();
		wp_set_auth_cookie($user_id, $remember);
		wp_set_current_user($user_id);
		return true;
		}
}

if(!function_exists('loginUser')){
	function loginUser($user_id){
		$reauth = empty($_REQUEST['reauth']) ? false : true;
		if ( $reauth )
			wp_clear_auth_cookie();

		if ( isset( $_REQUEST['redirect_to'] ) ) {
			$redirect_to = $_REQUEST['redirect_to'];
			// Redirect to https if user wants ssl
			if ( isset($secure_cookie) && false !== strpos($redirect_to, 'wp-admin') )
				$redirect_to = preg_replace('|^http://|', 'https://', $redirect_to);
		} else {
			$redirect_to = admin_url();
		}
		
		if ( !isset($secure_cookie) && is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )
		$secure_cookie = false;

		// If cookies are disabled we can't log in even with a valid user+pass
		if ( isset($_POST['testcookie']) && empty($_COOKIE[TEST_COOKIE]) )
			$user = new WP_Error('test_cookie', __("<strong>ERROR</strong>: Cookies are blocked or not supported by your browser. You must <a href='http://www.google.com/cookies.html'>enable cookies</a> to use WordPress."));
		else
			$user = wp_signon('', isset($secure_cookie));
		
		if(!set_cookies($user_id)){
			return false;
		}
		
		$requested_redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : site_url();
		$user_login_url = apply_filters( 'login_redirect', $redirect_to, $requested_redirect_to, $user );

		$options = get_option( APSL_SETTINGS );
		if(isset($options['apsl_custom_login_redirect_options']) && $options['apsl_custom_login_redirect_options'] !=''){
				if($options['apsl_custom_login_redirect_options'] =='home'){
					$user_login_url =  home_url();
				
				}else if($options['apsl_custom_login_redirect_options'] =='current_page'){
					if ( isset( $_REQUEST['redirect_to'] ) ) {
						$redirect_to = $_REQUEST['redirect_to'];
						// Redirect to https if user wants ssl
						if ( isset($secure_cookie) && false !== strpos($redirect_to, 'wp-admin') )
							$user_login_url = preg_replace('|^http://|', 'https://', $redirect_to);
					} else {
						$user_login_url = home_url();
					}

				}else if( $options['apsl_custom_login_redirect_options'] == 'custom_page' ){
					if( $options['apsl_custom_login_redirect_link'] !='' ){
						$login_page = $options['apsl_custom_login_redirect_link'];
						$user_login_url = $login_page;
					}else{
						$user_login_url = home_url();
					}
				}
		}else{
			$user_login_url = home_url();
		}

		$redirect_to = $user_login_url;
		wp_safe_redirect( $redirect_to );
		exit();
	}
}

    //returns the current page url
if(!function_exists('curPageURL')){
	function curPageURL() {
	    $pageURL = 'http';
	    if ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) {
	        $pageURL .= "s";
	    }
	    $pageURL .= "://";
	    if ( $_SERVER["SERVER_PORT"] != "80" ) {
	        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
	    } else {
	        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	    }
	    return $pageURL;
	}
}

    //function to access the protected object properties
if(!function_exists('accessProtected')){
	function accessProtected($obj, $prop) { 
		$reflection = new ReflectionClass($obj); 
		$property = $reflection->getProperty($prop); 
		$property->setAccessible(true); 
		return $property->getValue($obj); 
	}    
} 
?>