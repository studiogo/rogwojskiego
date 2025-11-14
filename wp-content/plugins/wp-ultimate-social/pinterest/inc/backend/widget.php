<?php
defined('ABSPATH') or die("No script kiddies please!");
/**
 * Adds Pinterest Follow button Widget
 */

//decleration of constants

if( !defined('APSP_PRO_WIDGET_CONSTANT') ){
	define( 'APSP_PRO_WIDGET_CONSTANT', 'apspp-pinterest' );
}

class APSP_PRO_Follow_Widget extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'apspp_follow_widget_free', // Base ID
                __('Ultimate Social Pinterest follow widget', APSP_PRO_WIDGET_CONSTANT ), // Name
                array('description' => __('Ultimate Social Pinterest follow widget', APSP_PRO_WIDGET_CONSTANT ) ) // Args
        );
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

        if (isset($instance['pinterest_name'])) {
            $pinterest_name = $instance['pinterest_name'];
        } else {
            $pinterest_name = '';
        }

        if (isset($instance['button_label'])) {
            $button_label = $instance['button_label'];
        } else {
            $button_label = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', APSP_PRO_WIDGET_CONSTANT ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder='Title(optional)'>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('pinterest_name'); ?>"><?php _e('Pinterest Name: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('pinterest_name'); ?>" name="<?php echo $this->get_field_name('pinterest_name'); ?>" type="text" value="<?php echo esc_attr($pinterest_name); ?>" placeholder='pinterest'>
        </p>
         <p>
        <label for="<?php echo $this->get_field_id('button_label'); ?>"><?php _e('Button Label: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('button_label'); ?>" name="<?php echo $this->get_field_name('button_label'); ?>" type="text" value="<?php echo esc_attr($button_label); ?>" placeholder='Follow'>
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
        
        $color=$instance['pinterest_name'];
        echo "<div class='apspp-widget-free'>";
        echo do_shortcode("[us-pinterest-follow-button name='{$instance['pinterest_name']}' button_label='{$instance['button_label']}']");
        echo "</div>";
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
        $instance['pinterest_name'] = (!empty($new_instance['pinterest_name']) ) ? strip_tags($new_instance['pinterest_name']) : '';
        $instance['button_label'] = (!empty($new_instance['button_label']) ) ? strip_tags($new_instance['button_label']) : '';
        return $instance;
    }



}

class APSP_PRO_Single_Pin_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'apspp_single_image_pin_widget_free', // Base ID
                __('Ultimate Social Pinterest Single Pin Image widget', APSP_PRO_WIDGET_CONSTANT ), // Name
                array('description' => __('Ultimate Social Pinterest Single Pin Image widget', APSP_PRO_WIDGET_CONSTANT ) ) // Args
        );
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

        if (isset($instance['pin_image_url'])) {
            $pin_image_url = $instance['pin_image_url'];
        } else {
            $pin_image_url = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', APSP_PRO_WIDGET_CONSTANT ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder='Title(optional)'>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('pin_image_url'); ?>"><?php _e('Image URL: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('pin_image_url'); ?>" name="<?php echo $this->get_field_name('pin_image_url'); ?>" type="text" value="<?php echo esc_attr($pin_image_url); ?>" placeholder='https://www.pinterest.com/pin/434034482809764665/'>
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
        
        if(empty($instance['pin_image_url'])){
        _e("Please enter the pinterest pin image url in widget to make the pin widget appear here.", APSP_PRO_WIDGET_CONSTANT );
        }else{
        echo "<div class='apspp-widget-free'>";
        echo do_shortcode("[us-pinterest-pin-image image_url='{$instance['pin_image_url']}']");
        echo "</div>";
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
        //die(print_r($new_instance));
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['pin_image_url'] = (!empty($new_instance['pin_image_url']) ) ? strip_tags($new_instance['pin_image_url']) : '';
        return $instance;
    }



}

//Decleration of the Pinterest class for the pinterest profile widget
class APSP_PRO_Profile_Widget extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'apspp_profile_widget_free', // Base ID
                __('Ultimate Social Pinterest Profile widget', APSP_PRO_WIDGET_CONSTANT ), // Name
                array('description' => __('Ultimate Social Pinterest Profile widget', APSP_PRO_WIDGET_CONSTANT ) ) // Args
        );
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

        if (isset($instance['profile_name'])) {
            $profile_name = $instance['profile_name'];
        } else {
            $profile_name = '';
        }

        if (isset($instance['image_width'])) {
            $image_width = $instance['image_width'];
        } else {
            $image_width = '';
        }

        if (isset($instance['board_height'])) {
            $board_height = $instance['board_height'];
        } else {
            $board_height = '';
        }

         if (isset($instance['board_width'])) {
            $board_width = $instance['board_width'];
        } else {
            $board_width = '';
        }

        if (isset($instance['custom_sizes'])) {
            $custom_sizes = $instance['custom_sizes'];
        } else {
            $custom_sizes = '';
        }

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', APSP_PRO_WIDGET_CONSTANT ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder='Title(optional)'>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('profile_name'); ?>"><?php _e('Profile Name: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('profile_name'); ?>" name="<?php echo $this->get_field_name('profile_name'); ?>" type="text" value="<?php echo esc_attr($profile_name); ?>" placeholder='pinterest'>
        </p>

        <p>
         <label for="<?php echo $this->get_field_id('custom_sizes'); ?>"><?php _e('Widget Size: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <select name="<?php echo $this->get_field_name('custom_sizes'); ?>" class='apspp-profile-custom-sizes-selection'>
                <option value="square"          <?php selected( $custom_sizes, 'square' ); ?>><?php _e('Square', APSP_PRO_WIDGET_CONSTANT); ?></option>
                <option value="sidebar"         <?php selected( $custom_sizes, 'sidebar' ); ?>><?php _e('Sidebar', APSP_PRO_WIDGET_CONSTANT); ?></option>
                <option value="header"          <?php selected( $custom_sizes, 'header' ); ?>><?php _e('Header', APSP_PRO_WIDGET_CONSTANT); ?></option>
                <option value="custom"          <?php selected( $custom_sizes, 'custom' ); ?>><?php _e('Custom', APSP_PRO_WIDGET_CONSTANT); ?></option>
            </select>
        </p>

        <div class='apspp-profile-custom-size-values' <?php if($custom_sizes == 'custom'){ ?> style="display:block;" <?php }else{ ?>style='display:none;' <?php } ?>>
            <p>Please use these values only for custom size widget selection.</p>
            <p>
            <label for="<?php echo $this->get_field_id('image_width'); ?>"><?php _e('Image Width: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('image_width'); ?>" name="<?php echo $this->get_field_name('image_width'); ?>" type="text" value="<?php echo esc_attr($image_width); ?>" placeholder='Please enter numbers only.'>
            </p>

            <p>
             <label for="<?php echo $this->get_field_id('board_height'); ?>"><?php _e('Board Height: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('board_height'); ?>" name="<?php echo $this->get_field_name('board_height'); ?>" type="text" value="<?php echo esc_attr($board_height); ?>" placeholder='Please enter numbers only.'>
            </p>

            <p>
             <label for="<?php echo $this->get_field_id('board_width'); ?>"><?php _e('Board Width: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('board_width'); ?>" name="<?php echo $this->get_field_name('board_width'); ?>" type="text" value="<?php echo esc_attr($board_width); ?>" placeholder='Please enter numbers only.'>
            </p>
        </div>
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
        
        $color=$instance['profile_name'];
        echo "<div class='apspp-widget-free'>";
        if($instance['profile_name'] == ''){
        	_e("Please enter the pinterest profile name in widget to make the profile widget appear here", APSP_PRO_WIDGET_CONSTANT );
        }else{
            switch ($instance['custom_sizes']) {
                case 'square':
                    $instance['image_width']    = '80';
                    $instance['board_height']   = '320';
                    $instance['board_width']    = '400';
                    break;
                
                case 'sidebar':
                    $instance['image_width']    = '60';
                    $instance['board_height']   = '800';
                    $instance['board_width']    = '150';
                    break;

                case 'header':
                    $instance['image_width']    = '115';
                    $instance['board_height']   = '120';
                    $instance['board_width']    = '900';
                    break;

                default:
                    # code...
                    break;
            }

        echo do_shortcode("[us-pinterest-profile-widget profile='{$instance['profile_name']}' custom_size='{$instance['custom_sizes']}' image_width='{$instance['image_width']}' board_height='{$instance['board_height']}' board_width='{$instance['board_width']}']");
    	}
        echo "</div>";
       
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
        //die(print_r($new_instance));
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['profile_name'] = (!empty($new_instance['profile_name']) ) ? strip_tags($new_instance['profile_name']) : '';
        $instance['image_width'] = (!empty($new_instance['image_width']) ) ? strip_tags($new_instance['image_width']) : '';
        $instance['board_height'] = (!empty($new_instance['board_height']) ) ? strip_tags($new_instance['board_height']) : '';
        $instance['board_width'] = (!empty($new_instance['board_width']) ) ? strip_tags($new_instance['board_width']) : '';
        $instance['custom_sizes'] = (!empty($new_instance['custom_sizes']) ) ? strip_tags($new_instance['custom_sizes']) : '';
        return $instance;
    }



}

//Decleration of the Pinterest class for the pinterest board widget
class APSP_PRO_Board_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'apspp_board_widget_free', // Base ID
                __('Ultimate Social Pinterest Board widget', APSP_PRO_WIDGET_CONSTANT ), // Name
                array('description' => __('Ultimate Social Pinterest Board widget', APSP_PRO_WIDGET_CONSTANT ) ) // Args
        );
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

        if (isset($instance['pinterest_board_url'])) {
            $pinterest_board_url = $instance['pinterest_board_url'];
        } else {
            $pinterest_board_url = '';
        }

        if (isset($instance['custom_sizes'])) {
            $custom_sizes = $instance['custom_sizes'];
        } else {
            $custom_sizes = '';
        }

        if (isset($instance['image_width'])) {
            $image_width = $instance['image_width'];
        } else {
            $image_width = '';
        }

        if (isset($instance['board_height'])) {
            $board_height = $instance['board_height'];
        } else {
            $board_height = '';
        }

         if (isset($instance['board_width'])) {
            $board_width = $instance['board_width'];
        } else {
            $board_width = '';
        }


        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', APSP_PRO_WIDGET_CONSTANT ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder='Title(Optional)'>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('pinterest_board_url'); ?>"><?php _e('Board URL: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('pinterest_board_url'); ?>" name="<?php echo $this->get_field_name('pinterest_board_url'); ?>" type="text" value="<?php echo esc_attr($pinterest_board_url); ?>" placeholder='http://www.pinterest.com/pinterest/pin-pets/' >
        </p>

        <p>
         <label for="<?php echo $this->get_field_id('custom_sizes'); ?>"><?php _e('Widget Size: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <select name="<?php echo $this->get_field_name('custom_sizes'); ?>" class='apspp-board-custom-sizes-options'>
                <option value="square"          <?php selected( $custom_sizes, 'square' ); ?>><?php _e('Square', APSP_PRO_WIDGET_CONSTANT ); ?></option>
                <option value="sidebar"         <?php selected( $custom_sizes, 'sidebar' ); ?>><?php _e('Sidebar', APSP_PRO_WIDGET_CONSTANT ); ?></option>
                <option value="header"          <?php selected( $custom_sizes, 'header' ); ?>><?php _e('Header', APSP_PRO_WIDGET_CONSTANT ); ?></option>
                <option value="custom"   <?php selected( $custom_sizes, 'custom' ); ?>><?php _e('Custom', APSP_PRO_WIDGET_CONSTANT ); ?></option>
            </select>
        </p>
        <div class='apspp-board-custom-size-values' <?php if($custom_sizes == 'custom'){ ?> style="display:block;" <?php }else{ ?>style='display:none;' <?php } ?>>
            <p><?php _e('Please use these values only for custom size widget selection.', APSP_PRO_WIDGET_CONSTANT ); ?></p>
            <p>
            <label for="<?php echo $this->get_field_id('image_width'); ?>"><?php _e('Image Width: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('image_width'); ?>" name="<?php echo $this->get_field_name('image_width'); ?>" type="text" value="<?php echo esc_attr($image_width); ?>" placeholder='Please enter numbers only.'>
            </p>

            <p>
             <label for="<?php echo $this->get_field_id('board_height'); ?>"><?php _e('Board Height: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('board_height'); ?>" name="<?php echo $this->get_field_name('board_height'); ?>" type="text" value="<?php echo esc_attr($board_height); ?>" placeholder='Please enter numbers only.'>
            </p>

            <p>
             <label for="<?php echo $this->get_field_id('board_width'); ?>"><?php _e('Board Width: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('board_width'); ?>" name="<?php echo $this->get_field_name('board_width'); ?>" type="text" value="<?php echo esc_attr($board_width); ?>" placeholder='Please enter numbers only.'>
            </p>
        </div>
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

        echo "<div class='apspp-widget-free'>";
        if($instance['pinterest_board_url'] == ''){
            _e("Please enter the pinterest board url in widget to make the board widget appear here", APSP_PRO_WIDGET_CONSTANT );
        }else{
            switch ($instance['custom_sizes']) {
                case 'square':
                    $instance['image_width']    = '80';
                    $instance['board_height']   = '320';
                    $instance['board_width']    = '400';
                    break;
                
                case 'sidebar':
                    $instance['image_width']    = '60';
                    $instance['board_height']   = '800';
                    $instance['board_width']    = '150';
                    break;

                case 'header':
                    $instance['image_width']    = '115';
                    $instance['board_height']   = '120';
                    $instance['board_width']    = '900';
                    break;

                default:
                    # code...
                    break;
            }

        echo do_shortcode("[us-pinterest-board-widget board_url='{$instance['pinterest_board_url']}' custom_size='{$instance['custom_sizes']}' image_width='{$instance['image_width']}' board_height='{$instance['board_height']}' board_width='{$instance['board_width']}']");
        }
        echo "</div>";
       
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
        //die(print_r($new_instance));
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['pinterest_board_url'] = (!empty($new_instance['pinterest_board_url']) ) ? strip_tags($new_instance['pinterest_board_url']) : '';
        $instance['custom_sizes'] = (!empty($new_instance['custom_sizes']) ) ? strip_tags($new_instance['custom_sizes']) : '';
        $instance['image_width'] = (!empty($new_instance['image_width']) ) ? strip_tags($new_instance['image_width']) : '';
        $instance['board_height'] = (!empty($new_instance['board_height']) ) ? strip_tags($new_instance['board_height']) : '';
        $instance['board_width'] = (!empty($new_instance['board_width']) ) ? strip_tags($new_instance['board_width']) : '';
        return $instance;
    }



}

//Decleration of the Pinterest class for the pinterest latest user/board pins widget
class APSP_PRO_Latest_Pins_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'apspp_latest_pins_widget_free', // Base ID
                __('Ultimate Social Pinterest Latest Pins Widget', APSP_PRO_WIDGET_CONSTANT ), // Name
                array('description' => __('Ultimate Social Pinterest Latest Pins Widget', APSP_PRO_WIDGET_CONSTANT ) ) // Args
        );
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

        if (isset($instance['pinterest_feed_url'])) {
            $pinterest_feed_url = $instance['pinterest_feed_url'];
        } else {
            $pinterest_feed_url = '';
        }

        if (isset($instance['number_of_feeds'])) {
            $number_of_feeds = $instance['number_of_feeds'];
        } else {
            $number_of_feeds = '';
        }

        if (isset($instance['caption_enabled'])) {
            $caption_enabled = $instance['caption_enabled'];
        } else {
            $caption_enabled = '';
        }

        if (isset($instance['specific_board'])) {
            $specific_board = $instance['specific_board'];
        } else {
            $specific_board = '';
        }

         if (isset($instance['show_pinterest_link'])) {
            $show_pinterest_link = $instance['show_pinterest_link'];
        } else {
            $show_pinterest_link = '0';
        } 

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', APSP_PRO_WIDGET_CONSTANT ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" placeholder='Title(Optional)'>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pinterest_feed_url'); ?>"><?php _e('Profile URL: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('pinterest_feed_url'); ?>" name="<?php echo $this->get_field_name('pinterest_feed_url'); ?>" type="text" value="<?php echo esc_attr($pinterest_feed_url); ?>" placeholder='http://www.pinterest.com/pinterest' >
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('specific_board'); ?>"><?php _e('Specific Board(optional): ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('specific_board'); ?>" name="<?php echo $this->get_field_name('specific_board'); ?>" type="text" value="<?php echo esc_attr($specific_board); ?>" placeholder='official-news' >
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('number_of_feeds'); ?>"><?php _e('Number of Items: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
            <select name="<?php echo $this->get_field_name('number_of_feeds'); ?>">
                <?php for($i=1; $i<=25; $i++){ ?>
                <option value="<?php echo $i; ?>" <?php selected( $number_of_feeds, $i ); ?>><?php _e( $i, APSP_PRO_WIDGET_CONSTANT ); ?></option>
                <?php } ?>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('caption_enabled'); ?>"><?php _e('Image captions?: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
             <select name="<?php echo $this->get_field_name('caption_enabled'); ?>">
                <option value="1" <?php selected( $caption_enabled, '1' ); ?>><?php     _e('Yes', APSP_PRO_WIDGET_CONSTANT ); ?></option>
                <option value="0"  <?php selected( $caption_enabled, '0' ); ?>><?php    _e('No', APSP_PRO_WIDGET_CONSTANT ); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('show_pinterest_link'); ?>"><?php _e('Show Pinterest Link?: ', APSP_PRO_WIDGET_CONSTANT ); ?></label> 
             <select name="<?php echo $this->get_field_name('show_pinterest_link'); ?>">
                <option value="yes" <?php selected( $show_pinterest_link, 'yes' ); ?>><?php     _e('Yes', APSP_PRO_WIDGET_CONSTANT ); ?></option>
                <option value="no"  <?php selected( $show_pinterest_link, 'no' ); ?>><?php    _e('No', APSP_PRO_WIDGET_CONSTANT ); ?></option>
            </select>
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

        echo "<div class='apspp-widget-free'>";
        echo do_shortcode("[us-pinterest-latest-pins feed_url='{$instance['pinterest_feed_url']}' specific_board='{$instance['specific_board']}' feed_count='{$instance['number_of_feeds']}' caption='{$instance['caption_enabled']}' show_pinterest_link='{$instance['show_pinterest_link']}']");
        echo "</div>";
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
        //die(print_r($new_instance));
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['pinterest_feed_url'] = (!empty($new_instance['pinterest_feed_url']) ) ? strip_tags($new_instance['pinterest_feed_url']) : '';
        $instance['specific_board'] = (!empty($new_instance['specific_board']) ) ? strip_tags($new_instance['specific_board']) : '';
        $instance['number_of_feeds'] = (!empty($new_instance['number_of_feeds']) ) ? strip_tags($new_instance['number_of_feeds']) : '4';
        $instance['caption_enabled'] = (!empty($new_instance['caption_enabled']) ) ? strip_tags($new_instance['caption_enabled']) : '0';
        $instance['show_pinterest_link'] = (!empty($new_instance['show_pinterest_link']) ) ? strip_tags($new_instance['show_pinterest_link']) : 'no';
        return $instance;
    }

}



?>