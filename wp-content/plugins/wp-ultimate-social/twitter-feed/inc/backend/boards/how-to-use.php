<div class="aptf-single-board-wrapper" id="aptf-how_to_use-board" style="display:none">
    <h3><?php _e('How to use', APTF_TD_PRO); ?></h3>
    <p>There are two methods to display your Twitter Feeds in your site using Ultimate Social plugin.</p>
    <h4>Normal Feeds</h4>
    <p>For displaying Twitter Feeds in normal manner, you can use <br><br/>[us-twitter-feed]<br/><br/> shortcode or Ultimate Social Twitter Feed Widget in any registered widget area from Appearance Widget Section.You can also pass template parameter in the shortcode such as <br/>
        [us-twitter-feed template="template-1/template-2/template-3/template-4/template-5... template-12" total_feeds="3" username="Place your twitter username here"]</p>
    
    <h4>Feeds In Slider</h4>
    <p>To display the twitter feeds, you can either use <br/><br />
        [us-twitter-feed-slider] <br/><br/> <strong>Shortcode</strong> or <strong>Ultimate Social Twitter Feed  Widget</strong> in any registered widget area from Appearance Widget Section.You can use template parameter in this shortcode too.</p>
    <p>Extra parameters that you can pass in slider shortcode are auto_slide="true/false" slide_duration="any duration in milliseconds:e.g: 1000" and controls="true/false" </p>
    <p>
        [us-twitter-feed-slider controls="true" slide_duration="2000" auto_slide="true" slider_mode="horizontal/fade" adaptive_height="true/false" total_feeds="any number greater than 1 and less than or equals to 20" username="Place your twitter username here"]
    </p>
    
    <h4>Feeds in ticker</h4>
    <p>To display the twitter feeds, you can either use <br/><br />
        [us-twitter-feed-ticker] <br/><br/> <strong>Shortcode</strong> or <strong>Ultimate Social Twitter Feed Ticker Widget</strong> in any registered widget area from Appearance Widget Section.You can use template parameter in this shortcode too.</p>
    <p>Extra parameters that you can pass in ticker shortcode are controls="true" mouse_pause="true/false" ticker_speed="any duration in milliseconds:e.g: 1000" ticker_direction="up/down" visible_tweets="Any number greater than 1 and less than total tweets" total_feeds="any number greater than 1 and less than or equals to 20" </p>
    <p>
        [us-twitter-feed-ticker controls="true/false" mouse_pause="true/false" ticker_speed="any duration in milliseconds:e.g: 1000" ticker_direction="up/down" visible_tweets="Any number greater than 1 and less than total tweets" total_feeds="any number greater than 1 and less than or equals to 20"]
    </p>
    <p>To display feeds from any specific hashtags, please use hashtag="#any_required_hashtag_here" for example <br/> [us-twitter-feed hashtag="#movie"]</p>
    <p>To use multiple accounts within single feed, please use comma separated username without any space( ) in the username parameter. For example [us-twitter-feed username="facebook,twitter,instagram"]</p>
    
</div>