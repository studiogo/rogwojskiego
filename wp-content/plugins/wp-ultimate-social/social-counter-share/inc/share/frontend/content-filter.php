<div class='apss-share-wrapper-div'>
<?php
			$options = $this->apss_settings;
			$apss_link_open_option=($options['dialog_box_options']=='1') ? "_blank": "";
			$apss_link_open_option_value = intval($options['dialog_box_options']);
			$twitter_user=$options['twitter_username'];
			$counter_enable_options=$options['counter_enable_options'];
			if(isset($options['twitter_counter_api'])){
				$twitter_api_use = ($options['twitter_counter_api'] != '1') ? $options['twitter_counter_api'] : '1';
			}else{
				$twitter_api_use = '1';
			}

			$bitly_options = isset($options['bitly']) ? $options['bitly'] : array();
			$counter_type_options = $options['counter_type_options'];

			$icon_set_value=$options['social_icon_set'];
			$url= (get_permalink() != FALSE) ? get_permalink() : APSS_Class:: curPageURL();
			$title = $text = str_replace('+', '%20', urlencode($post->post_title));
			$cache_period = ($options['cache_period'] != '') ? $options['cache_period']*60*60 : 24 * 60 * 60 ;
			$content=trim(strip_shortcodes(strip_tags(get_the_content())));
			if(strlen($content) >= 100){
				$excerpt= substr($content, 0, 100).'...';
				$excerpt = str_replace('+', '%20', urlencode($excerpt));
			}else{
				$excerpt = $content;
				$excerpt = str_replace('+', '%20', urlencode($excerpt));
			}

			if(isset($options['total_counter_enable_options'])){
				if($options['total_counter_enable_options'] =='1'){
					$enable_counter = 1;
				}
			}else{
				$enable_counter = 0;
			}

			if(isset($options['enable_http_count'])){
				if ( $options['enable_http_count'] == '1' ) {
					$http_url_checked = 1;
				}else{
					$http_url_checked = 0;
				}
			}else {
				$http_url_checked = 0;
			}

			?>
			<?php if( isset( $options['share_text'] ) && $options['share_text'] !='' ){ ?>
				<div class='apss-share-text'><?php echo $options['share_text']; ?></div>
			<?php
			}

			$total_count = 0;

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

					switch($key){
						//counter available for facebook
						case 'facebook':
						$link = 'https://www.facebook.com/sharer/sharer.php?u='.$url;
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

						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>
						<div class='apss-facebook apss-single-icon'>
								<a rel='nofollow' <?php if($apss_link_open_option_value == '2'){ ?> 
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');" 
									<?php } ?>

								title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e('Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
										<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
												<i class='fa fa-facebook'></i>
												<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{  _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
												<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e( 'Share', APSS_TEXT_DOMAIN ); } ?></span>

										</div>
								<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
			                    <div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
			                    <?php } ?>
								</a>
						</div>
						<?php
						break;

						//counter available for twitter
						case 'twitter':
						$url_twitter = $url;
						if( isset( $bitly_options['enable'] ) && $bitly_options['enable']=='1' ){
							$url_twitter = self:: short_bitly($url_twitter);
						}
						$url_twitter = urlencode($url_twitter);
						if(isset( $twitter_user) && $twitter_user !='' ){
							$twitter_user = 'via='.$twitter_user;
						}
						// $shorten_url = APSS_Clss:: make_bitly_url($url, 'o_474f06bfg3', 'R_7e2c42a779a14eab9cdcb137dd87ea27');
						$link ="https://twitter.com/intent/tweet?text=$title&amp;url=$url_twitter&counturl=$url&amp;$twitter_user";
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>
						<div class='apss-twitter apss-single-icon'>
							<a rel='nofollow'
								<?php if($apss_link_open_option_value == '2'){ ?>
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
									<?php } ?>
							 title='<?php if(isset($options['share_texts']['twitter-long-text']) && $options['share_texts']['twitter-long-text'] !='' ){ echo $options['share_texts']['twitter-long-text']; }else{ _e('Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-twitter'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['twitter-long-text']) && $options['share_texts']['twitter-long-text'] !='' ){ echo $options['share_texts']['twitter-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['twitter-short-text']) && $options['share_texts']['twitter-short-text'] !='' ){ echo $options['share_texts']['twitter-short-text']; }else{ _e('Tweet', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
								<?php
								if(isset($counter_enable_options) && $counter_enable_options=='1' && $twitter_api_use !='1'){ ?>
								<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
								<?php }
								?>
							</a>
						</div>
						<?php
						break;

						//counter available for google plus
						case 'google-plus':
						$link = 'https://plus.google.com/share?url='.$url;
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>
						<div class='apss-google-plus apss-single-icon'>
							<a rel='nofollow' 
							<?php if($apss_link_open_option_value == '2'){ ?> 
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');" 
									<?php } ?>
							title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e('Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ _e('Google Plus', APSS_TEXT_DOMAIN ); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
							<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
								<i class='fa fa-google-plus'></i>
								<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ _e('Google Plus', APSS_TEXT_DOMAIN ); } ?></span>
								<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
							</div>
									<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
									<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
									<?php } ?>
							</a>
						</div>
						<?php
						break;

						//counter available for pinterest
						case 'pinterest':
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>

						<div class='apss-pinterest apss-single-icon'>
							<a rel='nofollow' title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' href='javascript:pinIt();'>
								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-pinterest'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
								</div>

									<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
									<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
									<?php } ?>

							</a>
						</div>
						<?php
						break;
						
						//couter available for linkedin
						case 'linkedin':
						$link = "http://www.linkedin.com/shareArticle?mini=true&amp;title=".$title."&amp;url=".urlencode($url)."&amp;summary=".$excerpt;
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>
						<div class='apss-linkedin apss-single-icon'>
							<a rel='nofollow' 
								<?php if($apss_link_open_option_value == '2'){ ?> 
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');" 
									<?php } ?>
							title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
							<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'><i class='fa fa-linkedin'></i>
								<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
								<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
							</div>

							<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
							<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
							<?php } ?>

						</a>
						</div>
						<?php
						break;

						//there is no counter available for digg
						case 'digg':
						$link = "http://digg.com/submit?phase=2%20&amp;url=".$url."&amp;title=".$title;
						?>
						<div class='apss-digg apss-single-icon'>
							<a rel='nofollow' 
								<?php if($apss_link_open_option_value == '2'){ ?> 
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');" 
									<?php } ?>

							 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
							<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
								<i class='fa fa-digg'></i>
								<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
								<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
							</div>
						</a>
						</div>

						<?php
						break;

						//counter available for delicious
						case 'delicious':
						$link = "https://del.icio.us/save?url=$url&title=".$title;
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>

						<div class='apss-delicious apss-single-icon'>
							<a rel='nofollow' 
							<?php if($apss_link_open_option_value == '2'){ ?> 
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');" 
									<?php } ?>
							 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-delicious'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
									<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
									<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
									<?php } ?>
							</a>
						</div>

						<?php
						break;

						//counter available for reddit
						case 'reddit':
						$link ="http://www.reddit.com/submit?url=$url&title=".$title;
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>

						<div class='apss-reddit apss-single-icon'>
							<a rel='nofollow'
							<?php if($apss_link_open_option_value == '2'){ ?>
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
									<?php } ?>
							title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>

								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-reddit'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
								<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
								<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
								<?php } ?>
							</a>
						</div>
						<?php
						break;

						//counter available for stumbleupon
						case 'stumbleupon':
						$link = "http://www.stumbleupon.com/badge/?url=".$url;
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>

						<div class='apss-stumbleupon apss-single-icon'>
							<a rel='nofollow'
							<?php if($apss_link_open_option_value == '2'){ ?>
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
									<?php } ?>
							title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>

								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-stumbleupon'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
									<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
									<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
									<?php } ?>
							</a>
						</div>
						<?php break;

						//counter not available for tumblr
						case 'tumblr':
						$link = "http://www.tumblr.com/share/link?url=$url&name=".urlencode($title);
						?>
						<div class='apss-tumblr apss-single-icon'>
							<a rel='nofollow'
							<?php if($apss_link_open_option_value == '2'){ ?>
										onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
									<?php } ?>
							 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
							<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
								<i class='fa fa-tumblr'></i>
								<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
								<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
							</div>
							</a>
						</div>
						<?php
						break;


						//counter available for vkontakte
						case 'vkontakte':
						$link = "http://vkontakte.ru/share.php?url=".$url;
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>

						<div class='apss-vk apss-single-icon'>
							<a rel='nofollow'
								<?php if($apss_link_open_option_value == '2'){ ?>
									onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
								<?php } ?>
							 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>

								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-vk'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
									<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
									<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
									<?php } ?>
							</a>
						</div>
						<?php
						break;


						//there is no counter available for xing
						case 'xing':
						$link = "https://www.xing.com/spi/shares/new?url=".$url;
						?>
						<div class='apss-xing apss-single-icon'>
							<a rel='nofollow'
							<?php if($apss_link_open_option_value == '2'){ ?>
								onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
							<?php } ?>
							title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>

								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-xing'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
							</a>
						</div>
						<?php 
						break;

						//counter not available for weibo
						case 'weibo':
						$image[0]='';
						if(has_post_thumbnail()){
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
						}
						$link = "http://service.weibo.com/share/share.php?url=$url&appkey=&title=".$title."&pic=".$image[0];
						?>
						<div class='apss-weibo apss-single-icon'>
							<a rel='nofollow'
							<?php if($apss_link_open_option_value == '2'){ ?> 
								onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');" 
							<?php } ?>
							 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-weibo'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
							</a>
						</div>
						<?php 
						break;

						//counter not available for buffer
						case "buffer":
						$link = "https://bufferapp.com/add?url=$url&text=".$title."&via=&picture=&count=horizontal&source=button";
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
						$formatted_count = APSS_Class:: get_formatted_count($count , $counter_type_options);
						?>

						<div class='apss-buffer apss-single-icon'>
							<a rel='nofollow'
							<?php if($apss_link_open_option_value == '2'){ ?>
								onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
							<?php } ?>
							 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-buffer'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e('Share', APSS_TEXT_DOMAIN ); } ?></span>
								</div>

								<?php if(isset($counter_enable_options) && $counter_enable_options=='1'){ ?>
									<div class='count apss-count' data-url='<?php echo $url;?>' data-social-network='<?php echo $key; ?>' data-social-detail="<?php echo $url.'_'.$key;?>"><?php echo $formatted_count; ?></div>
								<?php } ?>

							</a>
						</div>
						<?php
						break;

						//counter not available for whatsapp
						case 'whatsapp':
						$link = "whatsapp://send?text=Take%20a%20look%20at%20this%20awesome%20url: $url";
						?>
						<div class='apss-whatsapp apss-single-icon'>
								<a rel='nofollow'
								<?php if($apss_link_open_option_value == '2'){ ?>
									onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
								<?php } ?>
								 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e('Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
										<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
												<i class='fa fa-whatsapp'></i>
												<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{  _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
												<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e( 'Share', APSS_TEXT_DOMAIN ); } ?></span>
										</div>
								</a>
						</div>
						<?php
						break;

						//counter not available for viber
						case 'viber':
						$viber_title = $title;
						$encode_url = urlencode($url);
						// $link = "whatsapp://send?text=Take%20a%20look%20at%20this%20awesome%20url: $url";
						$link = "viber://forward?text=$viber_title $encode_url";
						?>
						<div class='apss-viber apss-single-icon'>
								<a rel='nofollow'
								<?php if($apss_link_open_option_value == '2'){ ?>
									onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
								<?php } ?>
								 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e('Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
										<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
												<i class='fa fa-viber'></i>
												<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{  _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
												<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e( 'Share', APSS_TEXT_DOMAIN ); } ?></span>
										</div>
								</a>
						</div>
						<?php
						break;

						//counter not available for sms
						case 'sms':
						$sms_title = $title;
						$encode_url = urlencode($url);
						// $link = "viber://forward?text=$sms_title $encode_url";
						$link = "sms:?body=$title $encode_url";
						?>
						<div class='apss-sms apss-single-icon'>
								<a rel='nofollow'
								<?php if($apss_link_open_option_value == '2'){ ?>
									onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
								<?php } ?>
								 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e('Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
										<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
												<i class='fa fa-comment-o'></i>
												<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{  _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
												<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e( 'Share', APSS_TEXT_DOMAIN ); } ?></span>
										</div>
								</a>
						</div>
						<?php
						break;

						//counter not available for fb messenger
						case 'messenger':
						$sms_title = $title;
						$encode_url = urlencode($url);
						$link = "fb-messenger://share/?link=$encode_url";
						?>
						<div class='apss-fb-messenger apss-single-icon'>
								<a rel='nofollow'
								<?php if($apss_link_open_option_value == '2'){ ?>
									onclick="apss_open_in_popup_window(event, '<?php echo $link; ?>');"
								<?php } ?>
								 title='<?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{ _e('Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
										<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
												<i class='fa fa-fb-messenger'></i>
												<span class='apss-social-text'><?php if(isset($options['share_texts']['common-long-text']) && $options['share_texts']['common-long-text'] !='' ){ echo $options['share_texts']['common-long-text']; }else{  _e( 'Share on', APSS_TEXT_DOMAIN ); } ?> <?php if(isset($options['apss_social_networks_naming'][$key]) && $options['apss_social_networks_naming'][$key] !='' ){ echo $options['apss_social_networks_naming'][$key]; }else{ echo ucfirst($key); } ?></span>
												<span class='apss-share'><?php if(isset($options['share_texts']['common-short-text']) && $options['share_texts']['common-short-text'] !='' ){ echo $options['share_texts']['common-short-text']; }else{ _e( 'Share', APSS_TEXT_DOMAIN ); } ?></span>
										</div>
								</a>
						</div>
						<?php
						break;

						case 'email':
								if ( strpos( $options['apss_email_body'], '%%' ) || strpos( $options['apss_email_subject'], '%%' ) ) {
									$link = 'mailto:?subject='.$options['apss_email_subject'].'&amp;body='.$options['apss_email_body'];
									$link = preg_replace( array( '#%%title%%#', '#%%siteurl%%#', '#%%permalink%%#', '#%%url%%#' ), array( get_the_title(), get_site_url(), get_permalink(), $url ), $link );
								}
								else {
									$link = 'mailto:?subject='.$options['apss_email_subject'].'&amp;body='.$options['apss_email_body'].": ".$url;
								}
								?>
						<div class='apss-email apss-single-icon'>
							<a <?php if(isset($options['apss_email_share_popup_disable']) && $options['apss_email_share_popup_disable'] !='1'){ echo "class='ashare-email-popup'"; } ?> title='<?php if(isset($options['share_texts']['email-long-text']) && $options['share_texts']['email-long-text'] !='' ){ echo $options['share_texts']['email-long-text']; }else{ _e('Send email', APSS_TEXT_DOMAIN ); } ?>' target='<?php echo $apss_link_open_option; ?>' href='<?php echo $link; ?>'>
								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa  fa-envelope'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['email-long-text']) && $options['share_texts']['email-long-text'] !='' ){ echo $options['share_texts']['email-long-text']; }else{ _e('Send email', APSS_TEXT_DOMAIN ); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['email-short-text']) && $options['share_texts']['email-short-text'] !='' ){ echo $options['share_texts']['email-short-text']; }else{ _e('Mail', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
							</a>
						</div>

						<?php
						break;

						case 'print':
						?>
						<div class='apss-print apss-single-icon'>
							<a title='<?php if(isset($options['share_texts']['print-long-text']) && $options['share_texts']['print-long-text'] !='' ){ echo $options['share_texts']['print-long-text']; }else{ _e('Print this', APSS_TEXT_DOMAIN ); } ?>' href='javascript:void(0);' onclick='window.print();return false;'>
								<div class='apss-icon-block<?php if($icon_set_value != '4'){ ?> clearfix<?php } ?>'>
									<i class='fa fa-print'></i>
									<span class='apss-social-text'><?php if(isset($options['share_texts']['print-long-text']) && $options['share_texts']['print-long-text'] !='' ){ echo $options['share_texts']['print-long-text']; }else{ _e( 'Print this', APSS_TEXT_DOMAIN ); } ?></span>
									<span class='apss-share'><?php if(isset($options['share_texts']['print-short-text']) && $options['share_texts']['print-short-text'] !='' ){ echo $options['share_texts']['print-short-text']; }else{ _e( 'Print', APSS_TEXT_DOMAIN ); } ?></span>
								</div>
							</a>
						</div>
						<?php
						break;

						}
				}

			}

do_action('apss_more_networks');

if( isset($enable_counter) && $enable_counter == '1' ){
?>
<div class='apss-total-share-count'>
	<?php $formatted_count = APSS_Class:: get_formatted_count($total_count , $counter_type_options); ?>
	<span class='apss-count-number'><?php echo $formatted_count; ?></span>
	<div class="apss-total-shares"><span class='apss-total-text'><?php echo _e( ' Total', APSS_TEXT_DOMAIN ); ?></span>
	<span class='apss-shares-text'><?php echo _e( ' Shares', APSS_TEXT_DOMAIN ); ?></span></div>
</div>
<?php } ?>
</div>