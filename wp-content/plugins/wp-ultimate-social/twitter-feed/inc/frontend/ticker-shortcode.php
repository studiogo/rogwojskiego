<?php
$aptf_pro_settings = get_option('aptf_pro_settings');
if ( isset( $atts['username'] ) ) {
    $aptf_pro_settings['twitter_username'] = $atts['username'];
}
if ( isset( $atts['total_feeds'] ) && $atts['total_feeds'] != '' ) {
    $aptf_pro_settings['total_feed'] = $atts['total_feeds'];
}

//$this->print_array( $atts );
$username = $aptf_pro_settings['twitter_username'];
$total_feeds = $aptf_pro_settings['total_feed'];
if ( isset( $atts['hashtag'] ) && $atts['hashtag'] != '' ) {
    $tweets = US_Twitter_Feed_Class:: get_twitter_hastag_tweets( $atts['hashtag'], $total_feeds );
} else {

    $username_array = explode( ',', $username );
    if ( count( $username_array ) > 1 ) {
        $tweets = US_Twitter_Feed_Class:: get_multiple_twitter_tweets( $username, $total_feeds );
    } else {
        $tweets = US_Twitter_Feed_Class:: get_twitter_tweets( $username, $total_feeds );
    }
}
$template = isset( $atts['template'] ) ? $atts['template'] : 'template-1';
$mouse_pause = isset( $atts['mouse_pause'] ) ? $atts['mouse_pause'] : 'false';
$slide_controls = isset( $atts['controls'] ) ? $atts['controls'] : 'true';
$ticker_speed = isset( $atts['ticker_speed'] ) ? $atts['ticker_speed'] : '6000';
$transition_speed = (isset( $atts['transition_speed'] ) && $atts['transition_speed'] !='')? esc_attr($atts['transition_speed']) : 'slow';
$visible_tweets = isset( $atts['visible_tweets'] ) ? $atts['visible_tweets'] : '1';
$ticker_direction = isset( $atts['ticker_direction'] ) ? $atts['ticker_direction'] : 'up';
$controls = isset( $atts['controls'] ) ? $atts['controls'] : 0;
if ( isset( $atts['follow_button'] ) ) {
    if ( $atts['follow_button'] == 'true' ) {
        $aptf_pro_settings['display_follow_button'] = 1;
    } else {
        $aptf_pro_settings['display_follow_button'] = 0;
    }
}
if ( isset( $tweets->errors ) ) {
    $fallback_message = ($aptf_pro_settings['fallback_message'] == '') ? __( 'Something went wrong with the twitter.', APTF_TD_PRO ) : $aptf_pro_settings['fallback_message'];
    ?>
    <p><?php echo $fallback_message; ?></p>
    <?php
} else {
    ?>

    <div class="aptf-tweets-ticker-wrapper aptf-<?php echo $template; ?> aptf-ticker-<?php echo $template; ?>">
        <div class="aptf-ticker-controls">
            <a href="javascript:void(0);" class="aptf-ticker-up" id="aptf-ticker-up-<?php echo rand( 111111111, 999999999 ); ?>"><i class="fa fa-chevron-up"></i></a>
            <a href="javascript:void(0);" class="aptf-ticker-down" id="aptf-ticker-down-<?php echo rand( 111111111, 999999999 ); ?>"><i class="fa fa-chevron-down"></i></a>
        </div>
        <div class="aptf-pro-ticker-main-wrapper" data-ticker-speed ="<?php echo $ticker_speed; ?>" data-transition-speed ="<?php echo $transition_speed; ?>" data-mouse-pause = "<?php echo $mouse_pause; ?>" data-direction="<?php echo $ticker_direction; ?>" data-controls="<?php echo $controls; ?>" data-visible="<?php echo $visible_tweets;?>">
            <div class="aptf-ticker-inner-wrap">
                <?php
                if ( file_exists( APTF_PRO_PATH.'/inc/frontend/templates/default/' . $template . '.php' ) ) {

                    include(APTF_PRO_PATH.'/inc/frontend/templates/default/' . $template . '.php');
                }

                ?>
            </div>
        </div>
        <?php if ( isset( $aptf_pro_settings['display_follow_button'] ) && $aptf_pro_settings['display_follow_button'] == 1 ) {
            ?>
            <div class="aptf-seperator"></div>
            <?php
            include(plugin_dir_path( __FILE__ ) . 'templates/follow-btn.php');
        }
        ?>
    </div>
    <?php
}
?>

