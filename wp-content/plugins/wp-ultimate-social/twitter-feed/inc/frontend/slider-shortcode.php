<?php
$aptf_pro_settings = get_option('aptf_pro_settings');
$username = isset( $atts['username'] ) ? $atts['username'] : $aptf_pro_settings['twitter_username'];
$total_feeds = isset($atts['total_feeds']) ? $atts['total_feeds'] : $aptf_pro_settings['total_feed'];
if ( isset( $atts['hashtag'] ) && $atts['hashtag'] != '' ) {
    $tweets = US_Twitter_Feed_Class:: get_twitter_hastag_tweets( $atts['hashtag'], $total_feeds );
} else {

    $username_array = explode(',',$username);
        if(count($username_array)>1){
            $tweets = US_Twitter_Feed_Class:: get_multiple_twitter_tweets($username,$total_feeds);
            
        }else{
             $tweets = US_Twitter_Feed_Class:: get_twitter_tweets( $username, $total_feeds );
        }
}
//var_dump($tweets);
$template = isset( $atts['template'] ) ? $atts['template'] : 'template-1';
$auto_slide = isset( $atts['auto_slide'] ) ? $atts['auto_slide'] : 'true';
$slide_controls = isset( $atts['controls'] ) ? $atts['controls'] : 'true';
$adaptive_height = (isset( $atts['adaptive_height'] ))? $atts['adaptive_height'] : 'true';
$slider_mode = isset( $atts['slider_mode'] ) ? $atts['slider_mode'] : 'horizontal';
$slide_duration = isset( $atts['slide_duration'] ) ? $atts['slide_duration'] : '3000';
if ( isset( $atts['follow_button'] ) ) {
    if ( $atts['follow_button'] == 'true' ) {
        $aptf_pro_settings['display_follow_button'] = 1;
    } else {
        $aptf_pro_settings['display_follow_button'] = 0;
    }
}
//$this->print_array($tweets);
if ( isset( $tweets->errors ) ) {
    $fallback_message = ($aptf_pro_settings['fallback_message'] == '') ? __( 'Something went wrong with the twitter.', APTF_TD_PRO ) : $aptf_pro_settings['fallback_message'];
    ?>
    <p><?php echo $fallback_message; ?></p>
    <?php
} else {
    ?>
    <div class="aptf-<?php echo $template; ?> aptf-slider-<?php echo $template; ?>" >
        <div class="aptf-tweets-slider-wrapper" data-auto-slide ="<?php echo $auto_slide; ?>" data-slide-controls = "<?php echo $slide_controls; ?>" data-slide-duration="<?php echo $slide_duration; ?>" data-adaptive="<?php echo $adaptive_height; ?>" data-mode="<?php echo $slider_mode; ?>">
            <?php
            if(  file_exists( APTF_PRO_PATH.'/inc/frontend/templates/default/' . $template . '.php' )){
                
            include(APTF_PRO_PATH.'/inc/frontend/templates/default/' . $template . '.php');
            }
            ?>
        </div><!--aptf-tweets-slider-wrapper-->
        <?php if ( isset( $aptf_pro_settings['display_follow_button'] ) && $aptf_pro_settings['display_follow_button'] == 1 ) {
            ?>
            <div class="aptf-seperator"></div>
            <?php
            include(plugin_dir_path( __FILE__ ) . 'templates/follow-btn.php');
        }
        ?>
    </div><!--aptf-template-1 -->
    <?php
//var_dump($tweets);
}
?>

