<div class="apsc-boards-tabs" id="apsc-board-how_to_use-settings" style="display:none">
    <div class="apsc-tab-wrapper">
        <p>To display the social profiles with counter, you can either use [us-counter] <strong>Shortcode</strong> or you can use <strong>Ultimate Social Counter Widget</strong> from Appearance's widget section or the floating sidebar.</p>
        
        <h3>Shortcode Parameters</h3>
        <p>
            You can pass theme parameter to get the desired theme.By default, the theme that is configured in the display settings will be shown.
            theme="theme-1",theme="theme-2" .. to theme-20
        
        </p>
        <p>For example: [us-counter theme="theme-19"]</p>
        <p>You can use the parameter hide_count to disable the display of the counter. If you set hide_count='1' then the counter will not be displayed and if this parameter is not used then the settings will be carried from plugin settings. In the plugin settings if you have set hide counter to 1 then if you want to show the counter then you need to use hide_count='0' for specific shortcode where you want to show the counts.</p>
        <p>For example: [us-counter theme="theme-19" hide_count='1']</p>
        <p><strong>Other Parameters are :</strong></p>
        <ol>
            <li>animation="animation-1" to animation-5</li>
            <li>profiles="facebook,twitter,instagram,googlePlus,soundcloud,dribbble,youtube,steam,vimeo,pinterest,forrst,vk,flickr,behance,github,envato,posts,comments"</li>
            <li>counter_format="default" or short or comma</li>
        </ol>
        <br />
        <p><strong>To get the individual count, please use below shortcode</strong></p>
        [us-get-count social_media="facebook/twitter/googlePlus/instagram/youtube/soundcloud/dribbble/posts/comments" count_format="default/comma/short"]
        <p><strong>Note</strong>: Use any value separated by "/" . For example [us-get-count social_media="facebook" count_format="short"]</p>
        
    </div>
</div>