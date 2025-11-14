<h2 class='apspp-main-title'>Pinterest pinit.js javascript loading</h2>
javascript files should be included only one time. So if you have already called the pinit.js from other source please disable the pinit.js button from this plugin or you can disable the loading of the pinit.js javascript file from other.
<h2 class='apspp-main-title'>Custom Pinit Buttons Settings help</h2>
<div class="apspp-sub-title">Enable Custom Pin It button over images</div>
 <p>You need to enable the custom pinit button to use the custom pinit button.</p>

 <div class="apspp-sub-title"> Pinit button Display options</div>
 <p>Pinit button display options for pages, posts, archives, front page and home page. If you have custom post types and taxonomies you can enable or disable the display of custom pinit buttons here.</p>

<div class="apspp-sub-title"> Container selector</div>
<p>This is the selector used to find the container that holds the entire single post. It looks for an element that is a parent of the content of the post. Usually it's a div or article element.</p>

<div class="apspp-sub-title"> image selector</div>
<p>jQuery selector for all the images that should have the "Pin it" button. Set the value to .apspp-container img if you want the "Pin it" button to appear only on class apspp-container. If you know about jQuery, you can use your own selector.</p>

<div class="apspp-sub-title"> Disabled classes</div>
<p>Images with these CSS classes won't show the "Pin it" button. Please separate multiple classes with comma.</p>
 	
<div class="apspp-sub-title"> Enabled classes</div>
<p>Only images with these CSS classes will show the "Pin it" button. Please separate multiple classes with commas. If this field is empty, images with any (besides disabled ones) classes will show the Pin It button.</p>

<div class="apspp-sub-title">Pin it button position</div>
<p>You can select the pin it button positions
Available options are:
<ol>
	<li>Top Left</li>
	<li>Top Right</li>
	<li>Bottom Left</li>
	<li>Bottom Right</li>
	<li>Middle</li>
</ol>
</p>

<div class="apspp-sub-title">Pin it button image description options</div>
<p>
You select these options for the image descritions
<ol>
	<li>Page Title</li>
	<li>Page Description</li>
	<li>Site Title</li>
	<li>Image alt tag</li>
	<li>Image title tag and if not image alt tag</li>
</ol>
</p>

<div class="apspp-sub-title">Minimum image size to show the pinit button</div>
<p>Please choose the minimum image dimension of the image to show the pinit button</p>

<div class="apspp-sub-title">Pin it button margin settings</div>
<p>Please setup the button margins here.</p>

<div class="apspp-sub-title">OverlayTransparancy values</div>
<p>Pin it buttons overlay transparancy level can be setup here.</p>

<div class="apspp-sub-title">Pin it button display options</div>
<p>You can setup the pin it button display in two ways either on image hover or always show.</p>

<div class="apspp-sub-title">Mobile device compactibility</div>
<p>Hover effect is not available for mobile devices, So please choose this option if you want to show the pinit button for mobile devices as well.</p>

<div class="apspp-sub-title">Optimize for high pixel density displays</div>
<p>When this option is checked the loading of the pinterest pinit button will be halfed of it's size, please make sure both width and height are even numbers (i.e. divisible by two) when using this option.</p>

<div class="apspp-sub-title">Pin it button selection</div>
<p>We have selected 40 pin it icon sets that you can use. But this pin it button will be discarded if you have enabled custom pinit button.</p>

<div class="apspp-sub-title">Enable/Disable Pinterest Custom Image</div>
<p>You can use your own custom pinit icon. You need to upload the custom pinit button using media library and setup the image height and width.</p>

<h2 class="apspp-main-title">Native Pinterest pin it button help.</h2>
<h2 class="apspp-title">Pinterest pin it hover Help</h2>
<p>You can disable the pinterest image hover effect for each images by adding these attributes to images. </p>
<p>1) data-pin-no-hover="true"</p>
<p>2) nopin="nopin"</p>

<h2 class="apspp-title">Shortcode Help</h2>
<h3 class="apspp-sub-title">Follow Button</h3>
<p>Use the shortcode <code>[us-pinterest-follow-button]</code> to display the Pinterest Follow Button within your content.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[us-pinterest-follow-button]'); ?&gt;</code>
				to display within template or theme files.</p>

<h4>Available Attributes</h4>
<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th>Attribute</th>
					<th>Description</th>
					<th>Default</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>name</td>
					<td>Pinterest username</td>
					<td>pinterest</td>
				</tr>
				<tr>
					<td>button_label</td>
					<td>Button label</td>
					<td>Follow Pinterest</td>
				</tr>
				</tbody>
			</table>


<h4>Examples</h4>
<ul class="ul-disc">
	<li><code>[us-pinterest-follow-button name='pinterest' button_label='Follow Pinterest']</code></li>
</ul>


<h3 class="apspp-sub-title">Pin Image Button</h3>
<p>Use the shortcode <code>[us-pinterest-pin-image]</code> to display the Pinterest pin image within your content.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[us-pinterest-pin-image]'); ?&gt;</code>
				to display within template or theme files.</p>

<h4>Available Attributes</h4>
<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th>Attribute</th>
					<th>Description</th>
					<th>Default</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>image_url</td>
					<td>Please enter the pinterest image url here</td>
					<td>https://www.pinterest.com/pin/434034482809764694/</td>
				</tr>
				</tbody>
			</table>


<h4>Examples</h4>
<ul class="ul-disc">
	<li><code>[us-pinterest-pin-image image_url='https://www.pinterest.com/pin/434034482809764694/']</code></li>
</ul>

<h3 class="apspp-sub-title">Profile Widget</h3>
<p>Use the shortcode <code>[us-pinterest-profile-widget]</code> to display the Pinterest pin image within your content.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[us-pinterest-profile-widget]'); ?&gt;</code>
				to display within template or theme files.</p>

<h4>Available Attributes</h4>
<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th>Attribute</th>
					<th>Description</th>
					<th>Default</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>profile</td>
					<td>Please enter the pinterest profile name.</td>
					<td>pinterest</td>
				</tr>
				<tr>
					<td>custom_size</td>
					<td>Please enter the widget sizes(square, sidebar, header, custom)</td>
					<td>square</td>
				</tr>
				<tr>
				<td colspan="4"><strong>The following options will take effect only when size is set to custom, otherwise they will be ignored.</strong></td>
				</tr>
				<tr>
					<td>image_width</td>
					<td>Please enter the image width here. Any number greater than 60.</td>
					<td>92</td>
				</tr>

				<tr>
					<td>board_height</td>
					<td>Please enter the widget height here. Any number greater than 60.</td>
					<td>172</td>
				</tr>

				<tr>
					<td>board_width</td>
					<td>Please enter the widget width here. Any number greater than 130.</td>
					<td>auto</td>
				</tr>
				
				</tbody>
			</table>


<h4>Examples</h4>
<ul class="ul-disc">
	<li><code>[us-pinterest-profile-widget profile="pinterest" custom_size='custom' image_width="100" board_height="540" board_width="800"]</code></li>
</ul>

<h3 class="apspp-sub-title">Board Widget</h3>
<p>Use the shortcode <code>[us-pinterest-board-widget]</code> to display the Pinterest pin image within your content.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[us-pinterest-board-widget]'); ?&gt;</code>
				to display within template or theme files.</p>

<h4>Available Attributes</h4>
<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th>Attribute</th>
					<th>Description</th>
					<th>Default</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>board_url</td>
					<td>Please enter the pinterest board url.</td>
					<td>pinterest</td>
				</tr>
				<tr>
					<td>custom_size</td>
					<td>Please enter the widget sizes(square, sidebar, header, custom)</td>
					<td>square</td>
				</tr>
				<tr>
				<td colspan="4"><strong>The following options will take effect only when size is set to custom, otherwise they will be ignored.</strong></td>
				</tr>
				<tr>
					<td>image_width</td>
					<td>Please enter the image width here. Any number greater than 60.</td>
					<td>92</td>
				</tr>

				<tr>
					<td>board_height</td>
					<td>Please enter the widget height here. Any number greater than 60.</td>
					<td>172</td>
				</tr>

				<tr>
					<td>board_width</td>
					<td>Please enter the widget width here. Any number greater than 130.</td>
					<td>auto</td>
				</tr>
				
				</tbody>
			</table>


<h4>Examples</h4>
<ul class="ul-disc">
	<li><code>[us-pinterest-board-widget board_url="http://www.pinterest.com/pinterest/pin-pets/" custom_size='custom' image_width="100" board_height="540" board_width="800"]</code></li>
</ul>


<h3 class="apspp-sub-title">Latest Pins Widget</h3>
<p>Use the shortcode <code>[us-pinterest-latest-pins]</code> to display the latest Pinterest pin images within your widget.</p>
<p>Use the function <code>&lt;?php echo do_shortcode('[us-pinterest-latest-pins]'); ?&gt;</code>
				to display within template or theme files.</p>

<h4>Available Attributes</h4>
<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th>Attribute</th>
					<th>Description</th>
					<th>Default</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>feed_url</td>
					<td>Please enter the pinterest url.</td>
					<td>https://www.pinterest.com/pinterest</td>
				</tr>
				<tr>
					<td>specific_board</td>
					<td>Please enter the specific board name here if you want to display for specific board.</td>
					<td>Default: none</td>
				</tr>
				<tr>
					<td>feed_count</td>
					<td>You can specify the feed counts from here.</td>
					<td>4</td>
				</tr>

				<tr>
					<td>caption</td>
					<td>You can enable or disable the image caption from here.</td>
					<td>No</td>
				</tr>
				<tr>
					<td>show_pinterest_link</td>
					<td>You can enable or disable the pinterest link from here.</td>
					<td>No</td>
				</tr>
				</tbody>
			</table>


<h4>Examples</h4>
<ul class="ul-disc">
	<li><code>[us-pinterest-latest-pins feed_url='https://www.pinterest.com/pinterest' specific_board='breakfast-favorites' feed_count='5' caption='1' show_pinterest_link='yes']</code></li>
</ul>