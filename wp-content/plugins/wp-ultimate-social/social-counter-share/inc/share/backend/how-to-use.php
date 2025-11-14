
<p>Basically there are five main settings tabs that will help you to setup the plugin to work properly.</p>
<dl>
  <dt><strong>Social Networks</strong></dt>
  <dd><p>In this tab you can choose which social media icons you want to show in the frontend. Here you can order the apperance of the social icons simply by drag and drop of each social media icons.</p></dd>
    
  <dt><strong>Share options</strong></dt>
  <dd><p>In this tab you can select the options where you want to display these social media shares. Supports custom post types as well as custom taxonomies. Pinterest pinit button for each images can be enabled from here as well.</p></dd>
  
  <dt><strong>Display settings</strong></dt>
  <dd><p>In this tab you can choose the options to display the share icons below the content, above the content or you can choose an options to display in both below and above content. Also you can choose the theme from the pre available 10 themes. You can enable or disable the popup share at page load from this section.</p></dd>
  
  <dt><strong>Floating options</strong></dt>
  <dd><p>In this tab you can set the options for display of the floating sidebar. You can choose the theme from pre available 4 themes. You can choose the floating options from available options - Left Middle, Right Middle, Bottom Left, Bottom Right. You can enable or disable the share count specifically for floating sidebar from here.</p></dd>
  
  <dt><strong>Miscellaneous settings</strong></dt>
  <dd><p>In this tab you can do the additions settings for the plugin.
    <ul class="how-list">
      <li><i class="fa fa-check"></i>You can setup the twitter username.</li>
      <li><i class="fa fa-check"></i>You can enable/disable the social counter.</li>
      <li><i class="fa fa-check"></i>Share link - You can enable the share options either in new tab/window or in same widow.</li>
      <li><i class="fa fa-check"></i>Cache settings- Here you can set the cache settings in hours.</li>
      <li><i class="fa fa-check"></i>Email settings - If you have enabled the email settings you can setup the email header and body part.</li>
    </ul>
  </p></dd>

  <dt><strong>Other:</strong></dt>
  <dd><strong>Shortcode</strong>
    <p>You can use shortcode for the display of the social share in the contents. Optionally You can enter the name of the networks you want to display. The networks will be displayed in the order of entered networks.
      <ul class="how-list">
        <li><i class="fa fa-check"></i>Example 1: <code>[us-share]</code></li>
        <li><i class="fa fa-check"></i>Available shortcode parameters:
          <ul>
            <li><i class="fa fa-check"></i>theme : You can define the theme of the social share to use for this specific shortcode. You can use the theme number as theme parameter for eg theme='1' for selecting theme 1.</li>
            <li><i class="fa fa-check"></i>counter : You can enable or disable the share counter. To enable the share count use counter='1' and to disable it simply don't use counter parameter or use parameter counter='0'.</li>
            <li><i class="fa fa-check"></i>total_counter : You can enable or disable the total share counter. To enable the total share count use total_counter='1' and to disable it simply don't use total_counter parameter or use parameter total_counter='0'.</li>
            <li><i class="fa fa-check"></i>networks : You can define which social medias to show in the shortcode. You need to enter the networks name in string in comma separated values. If you don't want to choose which social medias to appear in shortcode, you can discard this option. </li>
            <li>Available Network parameters are: facebook, twitter, google-plus, pinterest, linkedin, digg, delicious, reddit, stumbleupon, tumblr, vkontakte, xing, weibo, buffer, whatsapp, viber, sms, messenger, email, print</li>
            <li><i class="fa fa-check"></i>share_text : You can define the share text at the top of social icons.If you don't want to appear this in shortcode, you can discard this option. </li>
            <li><i class="fa fa-check"></i>custom_share_link : You can enter the custom share link in case if the link provided by shortcode is not as per your need. To enable the custom share link use custom_share_link='custom link as per your need.'</li>
            <li><i class="fa fa-check"></i>alignment: You can select the alignment of the social icons. Available paramenter - left/center/middle</li>
            <li><i class="fa fa-check"></i>http_count: Now you can use attribute "http_count" to fetch the share counts for http url as well if you site is HTTPs. http_count='1' for http count and http_count='0' for disabling http count.</li>
            <li><i class="fa fa-check"></i> eg.<code>[us-share theme='2' counter='1' total_counter='1' networks='facebook, twitter, linkedin' share_text='share it' custom_share_link='https://www.google.com' alignment='center']</code> </li>
            <li><i class="fa fa-check"></i>Example 1.1: <code>[us-share networks='facebook, twitter, pinterest' share_text='Share it' counter='1' total_counter='1' http_count='1']</code></li>
          </ul>
        </li>
      </ul>
    </p>
  </dd>
  <dd>
    <p>You can use <code>[us-count]</code> shortcode to display the share counts number only in the content using shortcode. You can wrap that number in your reqired html tags and use it as per your need. The share count displayed will be the sum of entered network attributes.
    <ul class="how-list">
        <li><i class="fa fa-check"></i>Example 2: <code>[us-count]</code></li>
        <li><i class="fa fa-check"></i>Available shortcode Parameters
            <ul>
                <li><i class="fa fa-check"></i>network : You can define which social medias to show total share counts. You need to enter the networks name in string in comma separated values. You need to enter at least one network attribute.</li>
                <li>Available network parameters are: facebook, twitter, google-plus, pinterest, linkedin, delicious, reddit, stumbleupon, vkontakte, buffer</li>
                <li>Example 2.1: <code>[us-count network='facebook, pinterest']</code></li>
                <li>This will show the sum of share counts from facebook and pinterest.</li>
            </ul>
            <ul>
                <li><i class="fa fa-check"></i>custom_url_link</li>
                <li>Now you can use attribute "custom_url_link" to fetch the share counts for custom url as well.</li>
                <li>Example 2.2: <code>[us-count network='facebook, pinterest' custom_url_link='<?php echo site_url('sample-page'); ?>']</code></li>
                <li>This attribute is useful in case if the shortcode is not fetching the share counts for shortcode placed url and force the shortcode to use the url from the attribute defined in  custom_url_link.</li>
            </ul>
             <ul>
                <li><i class="fa fa-check"></i>http_count</li>
                <li>Now you can use attribute "http_count" to fetch the share counts for http url as well if you site is HTTPs.</li>
                <li>Example 2.2: <code>[us-count network='facebook, pinterest' custom_url_link='<?php echo site_url('sample-page'); ?>' http_count='1']</code></li>
                <li>This attribute is useful if you have moved your site from HTTP to HTTPs and need to fetch the share counts of both HTTP and HTTPs url.</li>
            </ul>
        </li>
    </ul>
    </p>
  </dd> 

  <dd><p>Widget
    <ul class="how-list">
      <li><i class="fa fa-check"></i>You can use the social share in widget as well.</li>
      <li><i class="fa fa-check"></i>The shortcode contains various option parameters as well.</li>
      <li><i class="fa fa-check"></i>Title : You can give the name for the widget.</li>
      <li><i class="fa fa-check"></i>Theme : You can input the theme number as theme for using the theme specified in this field.</li>
      <li><i class="fa fa-check"></i>Counter enable option: You can enable or disable the share counter for widget form here.</li>
    </ul>
  </p></dd>
</dl>



