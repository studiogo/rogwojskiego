<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Adds Ultimate Social Share Widget
 */
class APSS_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'apss_widget', // Base ID
                __('Ultimate Social Share', APSS_TEXT_DOMAIN), // Name
                array('description' => __('Ultimate Social Share Widget', APSS_TEXT_DOMAIN)) // Args
        );
    }

    //returns the current page url
    function curPageURL() {
        $pageURL = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

/**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = '';
        }

        if (isset($instance['theme'])) {
            $theme = $instance['theme'];
        } else {
            $theme = '';
        }

        if (isset($instance['counter'])) {
            $counter = $instance['counter'];
        } else {
            $counter = '0';
        }

        if (isset($instance['total_counter'])) {
            $total_counter = $instance['total_counter'];
        } else {
            $total_counter = '0';
        }


        if (isset($instance['networks'])) {
            $networks = $instance['networks'];
        } else {
            $networks = 'facebook, twitter, google-plus, linkedin';
        }

        if (isset($instance['share_text'])) {
            $share_text = $instance['share_text'];
        } else {
            $share_text = '';
        }

        if (isset($instance['custom_share_link'])) {
            $custom_share_link = $instance['custom_share_link'];
        } else {
            $custom_share_link = '';
        }

        if (isset($instance['widget_color'])) {
            $widget_color = $instance['widget_color'];
        } else {
            $widget_color = '0';
        }

        if (isset($instance['alignment'])) {
            $alignment = $instance['alignment'];
        } else {
            $alignment = 'left';
        }

        ?>

        <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.apss_widget_color_picker').wpColorPicker();
        });
        </script>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', APSS_TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('theme'); ?>"><?php _e('Theme: ', APSS_TEXT_DOMAIN ); ?></label>
            <select name="<?php echo $this->get_field_name('theme'); ?>">
                <?php for($i=1; $i<=15; $i++){ ?>
                <option value="<?php echo $i; ?>" <?php selected( $theme, $i ); ?>><?php _e( 'Theme '.$i, APSS_TEXT_DOMAIN ); ?></option>
                <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('counter'); ?>"><?php _e('Counter Enable ?', APSS_TEXT_DOMAIN); ?></label>
            <input type="radio" name="<?php echo $this->get_field_name('counter'); ?>" <?php if($counter =='1'){echo "checked='checked'"; } ?> value="1">Yes
            <input type="radio" name="<?php echo $this->get_field_name('counter'); ?>" <?php if($counter =='0'){echo "checked='checked'"; } ?> value="0">No
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('total_counter'); ?>"><?php _e('Total Counter Enable ?', APSS_TEXT_DOMAIN); ?></label>
            <input type="radio" name="<?php echo $this->get_field_name('total_counter'); ?>" <?php if($total_counter =='1'){echo "checked='checked'"; } ?> value="1">Yes
            <input type="radio" name="<?php echo $this->get_field_name('total_counter'); ?>" <?php if($total_counter =='0'){echo "checked='checked'"; } ?> value="0">No
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('networks'); ?>"><?php _e('Networks: ', APSS_TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('networks'); ?>" name="<?php echo $this->get_field_name('networks'); ?>" type="text" value="<?php echo esc_attr($networks); ?>">
            <div class='apss-note'><strong>Available parameters are </strong>: facebook, twitter, google-plus, pinterest, linkedin, digg, delicious, reddit, stumbleupon, tumblr, vkontakte, xing, weibo, buffer, whatsapp, viber, sms, messenger, email, print</div>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('share_text'); ?>"><?php _e('Share Text: ', APSS_TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('share_text'); ?>" name="<?php echo $this->get_field_name('share_text'); ?>" type="text" value="<?php echo esc_attr($share_text); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('custom_share_link'); ?>"><?php _e('Custom Share Link: ', APSS_TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('custom_share_link'); ?>" name="<?php echo $this->get_field_name('custom_share_link'); ?>" type="text" value="<?php echo esc_attr($custom_share_link); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('alignment'); ?>"><?php _e('Alignment :', APSS_TEXT_DOMAIN); ?></label>
            <input type="radio" name="<?php echo $this->get_field_name('alignment'); ?>" <?php if($alignment =='left'){echo "checked='checked'"; } ?> value="left">Left
            <input type="radio" name="<?php echo $this->get_field_name('alignment'); ?>" <?php if($alignment =='right'){echo "checked='checked'"; } ?> value="right">Right
            <input type="radio" name="<?php echo $this->get_field_name('alignment'); ?>" <?php if($alignment =='center'){echo "checked='checked'"; } ?> value="center">Center

        </p>

        <p>
            <label for="<?php echo $this->get_field_id('widget_color'); ?>"><?php _e('Widget Background Color: ', APSS_TEXT_DOMAIN); ?></label>
                      <input class="apss_widget_color_picker" id="<?php echo $this->get_field_id('widget_color'); ?>" name="<?php echo $this->get_field_name('widget_color'); ?>" type="text" value="<?php echo esc_attr($widget_color); ?>" />
        </p>

        <?php
    }


     /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {

        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        global $post;
        if(have_posts()){
            $widget_flag = get_post_meta($post->ID, 'apss_widget_flag', true);
        }else{
            $widget_flag=0;
        }
        // var_dump($post);
        // echo $widget_flag;
        // die();
        if($widget_flag !='1'){
        $color=$instance['widget_color'];
        $theme = $instance['theme'];
        $counter= $instance['counter'];
        $total_counter= $instance['total_counter'];
        $networks = $instance['networks'];
        $share_text = $instance['share_text'];
        $custom_share_link = $instance['custom_share_link'];
        $alignment = $instance['alignment'];

        echo "<div class='apss-widget' style='background-color: $color'>";
        // echo do_shortcode("[apss_share theme='{$instance['theme']}' counter='{$instance['counter']}' total_counter='1' ]");
        echo do_shortcode("[us-share theme='$theme' counter='$counter' total_counter='$total_counter' networks='$networks' share_text='$share_text' custom_share_link='$custom_share_link' alignment='$alignment']");

?>

<?php
        }
        echo $args['after_widget'];
    }


    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['theme'] = (!empty($new_instance['theme']) ) ? strip_tags($new_instance['theme']) : '';
        $instance['counter'] = (!empty($new_instance['counter']) ) ? strip_tags($new_instance['counter']) : '0';
        $instance['total_counter'] = (!empty($new_instance['total_counter']) ) ? strip_tags($new_instance['total_counter']) : '0';
        $instance['networks'] = (!empty($new_instance['networks']) ) ? strip_tags($new_instance['networks']) : '';
        $instance['share_text'] = (!empty($new_instance['share_text']) ) ? strip_tags($new_instance['share_text']) : '';
        $instance['custom_share_link'] = (!empty($new_instance['custom_share_link']) ) ? strip_tags($new_instance['custom_share_link']) : '';
        $instance['alignment'] = (!empty($new_instance['alignment']) ) ? strip_tags($new_instance['alignment']) : '';
        $instance['widget_color'] =(!empty($new_instance['widget_color'])) ? strip_tags($new_instance['widget_color']) : '';
        return $instance;
    }

}
