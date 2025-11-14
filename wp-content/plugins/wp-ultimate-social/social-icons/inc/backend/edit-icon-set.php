<?php
global $wpdb;
$si_id = $_GET['si_id'];
$table_name = $table_name = $wpdb->prefix . "aps_social_icons_pro";
$icon_sets = $wpdb->get_results("SELECT * FROM $table_name where si_id = $si_id");
$icon_set = $icon_sets[0];
$icon_extra = unserialize($icon_set->icon_extra);
//$this->print_array($icon_extra);
?>
<div class="aps-add-set-wrapper">
    <?php if (isset($_SESSION['aps_message'])) { ?>
        <div class="aps-message aps-message-success updated">
            <p>
                <?php
                echo $_SESSION['aps_message'];
                unset($_SESSION['aps_message']);
                ?>
            </p>
        </div>
    <?php } ?>
    <div class="aps-list-wrapper">
        <div class="aps-panel">
            <!--Panel Head-->
            <?php include('panel-head.php'); ?>
            <!--Panel Head-->
            <div class="aps-panel-body">
                <h2><?php _e('Edit Social Icons Set', US_TD); ?>&nbsp;&nbsp;<input type="button" class="button button-primary aps-submit-clone" value="<?php _e('Save Icon Set',US_TD);?>"/></h2>

                <div class="form-wrap">
                    <form method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
                        <input type="hidden" name="action" value="aps_edit_action"/>
                        <div class="aps-row">
                            <div class="aps-col-half">
                                <div class="aps-row">
                                    <div class="aps-col-full">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Name of Set', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="set_name" value="<?php echo esc_attr($icon_set->icon_set_name); ?>"/>
                                            </div>
                                            <div class="aps-error"></div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>
                                    <div class="aps-col-full">
                                        <div class="aps-group-chooser">
                                            <div class="aps-field-wrapper form-field">
                                                <label><?php _e('Choose Icon Set type', US_TD); ?></label>
                                                <div class="aps-field">
                                                    <label class="label-inline"><input type="radio" name="icon_set_type" value="1" <?php if ($icon_extra['icon_set_type'] == 1) { ?>checked="checked"<?php } ?>/><?php _e('Choose icon indiviually', US_TD); ?></label>
                                                    <label class="label-inline"><input type="radio" name="icon_set_type" value="2" <?php if ($icon_extra['icon_set_type'] == 2) { ?>checked="checked"<?php } ?>/><?php _e('Choose from available themes', US_TD); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="aps-col-full">
                                        <!--Icon Themes-->
                                        <?php include_once('icon-themes.php'); ?>
                                        <!--Icon Themes-->
                                    </div>
                                    <div class="aps-col-full">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Display', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="radio" name="display" value="horizontal" <?php if ($icon_set->icon_display == 'horizontal') { ?>checked="checked"<?php } ?>/><span><?php _e('Horizontal', US_TD); ?></span>
                                                <input type="radio" name="display" value="vertical" <?php if ($icon_set->icon_display == 'vertical') { ?>checked="checked"<?php } ?>/><span><?php _e('Vertical', US_TD); ?></span>
                                            </div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>
                                </div>
                                <div class="aps-row">
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field display-horizontal-reference">
                                            <label><?php _e('Number of Rows', US_TD) ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="num_rows" value="<?php echo esc_attr($icon_set->num_rows); ?>"/>
                                            </div>
                                            <div class="aps-option-note">
                                                <p><?php _e('Please enter the number of rows in number.Default is 1.', US_TD); ?></p>
                                            </div>
                                        </div><!--aps-field-wrapper-->
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper display-vertical-reference form-field" style="display: none">
                                            <label><?php _e('Number of Columns', US_TD) ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="num_columns" value="<?php echo esc_attr($icon_extra['num_columns']); ?>"/>
                                            </div>
                                            <div class="aps-option-note">
                                                <p><?php _e('Please enter the number of columns in number.Default is 1.', US_TD); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Margin Between Each Icon', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="margins" value="<?php echo esc_attr($icon_set->icon_margin); ?>"/>
                                            </div>
                                            <div class="aps-field-note">
                                                <p>
                                                    <?php _e('Please enter the margin for each icon in px.', US_TD); ?>
                                                </p>
                                            </div>
                                        </div><!--aps-field-wrapper-->
                                    </div>
                                    <div class="aps-clear"></div>
                                    <div class="aps-col-two-third">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Tooltip', US_TD); ?></label>
                                            <div class="aps-field">
                                                <label class="label-inline"><input type="radio" name="tooltip" value="1" <?php if ($icon_set->icon_tooltip == 1) { ?>checked="checked"<?php } ?>/><?php _e('Show', US_TD); ?></label>
                                                <label class="label-inline"><input type="radio" name="tooltip" value="0" <?php if ($icon_set->icon_tooltip == 0) { ?>checked="checked"<?php } ?>/><?php _e('Don\'t show', US_TD); ?></label>
                                            </div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>
                                    <div class="aps-clear"></div>
                                    <div class="aps-tooltip-options">
                                        <div class="aps-col-one-third">
                                            <div class="aps-field-wrapper form-field aps-tooltip-reference">
                                                <label><?php _e('Tooltip BG Color', US_TD) ?></label>
                                                <div class="aps-field">
                                                    <input type="text" name="tooltip_bg" class="aps-color-picker" value="<?php echo esc_attr($icon_set->tooltip_background); ?>"/>
                                                </div>
                                            </div><!--aps-field-wrapper form-field-->
                                        </div>
                                        <div class="aps-col-one-third">
                                            <div class="aps-field-wrapper form-field aps-tooltip-reference">
                                                <label><?php _e('Tooltip Text Color', US_TD); ?></label>
                                                <div class="aps-field">
                                                    <input type="text" name="tooltip_text_color" class="aps-color-picker" value="<?php echo esc_attr($icon_set->tooltip_text_color); ?>"/>
                                                </div>
                                            </div><!--aps-field-wrapper form-field-->
                                        </div>
                                        <div class="aps-col-one-third">
                                            <div class="aps-field-wrapper aps-tooltip-reference form-field">
                                                <label><?php _e('Tooltip Position', US_TD); ?></label>
                                                <div class="aps-field">
                                                    <select name="tooltip_position" class="aps-form-control">
                                                        <option value="top" <?php if (isset($icon_extra['tooltip_position']) && $icon_extra['tooltip_position'] == 'top') { ?>selected="selected"<?php } ?>><?php _e('Top', US_TD); ?></option>
                                                        <option value="right" <?php if (isset($icon_extra['tooltip_position']) && $icon_extra['tooltip_position'] == 'right') { ?>selected="selected"<?php } ?>><?php _e('Right', US_TD); ?></option>
                                                        <option value="bottom" <?php if (isset($icon_extra['tooltip_position']) && $icon_extra['tooltip_position'] == 'bottom') { ?>selected="selected"<?php } ?>><?php _e('Bottom', US_TD); ?></option>
                                                        <option value="left" <?php if (isset($icon_extra['tooltip_position']) && $icon_extra['tooltip_position'] == 'left') { ?>selected="selected"<?php } ?>><?php _e('Left', US_TD); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="aps-clear"></div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Icons Animation', US_TD); ?></label>
                                            <div class="aps-field">
                                                <select name="icon_animation" class="aps-form-control" id="aps-icon-animation">
                                                    <option value=""><?php _e('No Animation', US_TD); ?></option>
                                                    <optgroup label="Attention Seekers">
                                                        <option value="bounce" <?php if ($icon_set->icon_animation == 'bounce') { ?>selected="selected"<?php } ?>>bounce</option>
                                                        <option value="flash" <?php if ($icon_set->icon_animation == 'flash') { ?>selected="selected"<?php } ?>>flash</option>
                                                        <option value="pulse" <?php if ($icon_set->icon_animation == 'pulse') { ?>selected="selected"<?php } ?>>pulse</option>
                                                        <option value="shake" <?php if ($icon_set->icon_animation == 'shake') { ?>selected="selected"<?php } ?>>shake</option>
                                                        <option value="swing" <?php if ($icon_set->icon_animation == 'swing') { ?>selected="selected"<?php } ?>>swing</option>
                                                        <option value="tada" <?php if ($icon_set->icon_animation == 'tada') { ?>selected="selected"<?php } ?>>tada</option>
                                                    </optgroup>
                                                    <optgroup label="Bouncing Entrances">
                                                        <option value="bounceIn" <?php if ($icon_set->icon_animation == 'bounceIn') { ?>selected="selected"<?php } ?>>bounceIn</option>
                                                    </optgroup>
                                                    <optgroup label="Fading Entrances">
                                                        <option value="fadeIn" <?php if ($icon_set->icon_animation == 'fadeIn') { ?>selected="selected"<?php } ?>>fadeIn</option>
                                                        <option value="fadeInDown" <?php if ($icon_set->icon_animation == 'fadeInDown') { ?>selected="selected"<?php } ?>>fadeInDown</option>
                                                        <option value="fadeInUp" <?php if ($icon_set->icon_animation == 'fadeInUp') { ?>selected="selected"<?php } ?>>fadeInUp</option>
                                                    </optgroup>
                                                    <optgroup label="Flippers">
                                                        <option value="flip" <?php if ($icon_set->icon_animation == 'flip') { ?>selected="selected"<?php } ?>>flip</option>
                                                        <option value="flipInX" <?php if ($icon_set->icon_animation == 'flipInX') { ?>selected="selected"<?php } ?>>flipInX</option>
                                                        <option value="flipInY" <?php if ($icon_set->icon_animation == 'flipInY') { ?>selected="selected"<?php } ?>>flipInY</option>
                                                    </optgroup>
                                                    <optgroup label="Zoom Entrances">
                                                        <option value="zoomIn" <?php if ($icon_set->icon_animation == 'zoomIn') { ?>selected="selected"<?php } ?>>zoomIn</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Opacity on Non Hover', US_TD); ?></label>
                                            <div class="aps-field">
                                                <select name="opacity_hover" class="aps-form-control">
                                                    <option value="1" <?php if ($icon_set->opacity_hover == 1) { ?>selected="selected"<?php } ?>>1</option>
                                                    <option value="0.75" <?php if ($icon_set->opacity_hover == 0.75) { ?>selected="selected"<?php } ?>>0.75</option>
                                                    <option value="0.5" <?php if ($icon_set->opacity_hover == 0.5) { ?>selected="selected"<?php } ?>>0.5</option>
                                                    <option value="0.25" <?php if ($icon_set->opacity_hover == 0.25) { ?>selected="selected"<?php } ?>>0.25</option>
                                                </select>
                                            </div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>

                                </div>

                            </div>

                            <div class="aps-col-half">
                                <div class="aps-field-wrapper">
                                    <div class="aps-field">
                                        <div class="aps-preview-holder">
                                            <div class="aps-font-icon-preview" style="display: none">
                                                <?php _e('Icon Preview', US_TD); ?><!--font-awesome selected icon-->
                                            </div>
                                            <div class="aps-image-icon-preview">
                                                <?php _e(' Icon Preview   ', US_TD); ?>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <h3><?php _e('Icon Lists', US_TD); ?></h3>
                                <div class="aps-expander-controls">
                                    <a href="javascript:void(0);" class="aps-icon-theme-expand button button-secondary button-small"><?php _e('Expand All', US_TD); ?></a>
                                </div>
                                <div class="aps-icon-list-wrapper">
                                    <p class="aps-empty-icon-note" style="display: none">Empty List</p>
                                    <div class="aps-icon-note" style="display: none"><?php _e('Each Icon will only show up in the frontend if icon link is not empty', US_TD); ?></div>
                                    <ul class="aps-icon-list">
                                        <?php
                                        $icon_details = unserialize($icon_set->icon_details);
                                        //$this->print_array($icon_details);
                                        $icon_counter = 0;

                                        foreach ($icon_details as $title => $icon_detail) {
                                            foreach ($icon_detail as $key => $val) {
                                                ${$key} = $val;
                                            }
                                            //$this->print_array($icon_detail);
                                            $icon_style = '<style>';
                                            $icon_counter++;
                                            $icon_main_class = 'icon-' . $icon_counter;
                                            $border_thickness = str_replace('px', '', $icon_detail['border_thickness']);
                                            $border_thickness = ($border_thickness == '') ? '1' : $border_thickness;
                                            $border_color = ($icon_detail['border_color'] == '') ? '#000' : $icon_detail['border_color'];
                                            $border_type = $icon_detail['border_type'];
                                            $shadow_type = $icon_detail['shadow'];
                                            $offset_x = str_replace('px', '', $icon_detail['shadow_offset_x']);
                                            $offset_x = ($offset_x == '') ? '0px' : $offset_x;
                                            $offset_y = str_replace('px', '', $icon_detail['shadow_offset_y']);
                                            $offset_y = ($offset_y == '') ? '0px' : $offset_y;
                                            $blur = str_replace('px', '', $icon_detail['shadow_blur']);
                                            $blur = ($blur == '') ? '0px' : $blur;
                                            $shadow_color = $icon_detail['shadow_color'];
                                            if ($shadow_type != 'no') {
                                                $shadow = '-moz-box-shadow:' . $offset_x . 'px ' . $offset_y . 'px ' . $blur . 'px ' . '0' . ' ' . $shadow_color . ';';
                                                $shadow .= '-webkit-box-shadow:' . $offset_x . 'px ' . $offset_y . 'px ' . $blur . 'px ' . '0' . ' ' . $shadow_color . ';';
                                                $shadow .= 'box-shadow:' . $offset_x . 'px ' . $offset_y . 'px ' . $blur . 'px ' . '0' . ' ' . $shadow_color . ';';
                                            } else {
                                                $shadow = '';
                                            }
                                            $border = ($icon_detail['border_type'] == 'none') ? '' : "border:{$border_thickness}px $border_type $border_color;";
                                            ?>
                                            <li class="aps-sortable-icons <?php echo $icon_main_class; ?>">
                                                <div class="aps-drag-icon"></div>  
                                                <div class="aps-icon-head">
                                                    <span class="aps-icon-name"><?php echo esc_attr($title); ?></span>
                                                    <span class="aps-icon-list-controls">
                                                        <span class="aps-arrow-down aps-arrow button button-secondary" aria-label="expand icons"><i class="dashicons dashicons-arrow-down"></i></span>&nbsp;&nbsp;
                                                        <?php if ($icon_extra['icon_set_type'] == 1) { ?><span class="aps-delete-icon button button-secondary" aria-label="delete icon"><i class="dashicons dashicons-trash"></i></span><?php } ?>
                                                    </span>
                                                </div>
                                                <div class="aps-icon-body" style="display: none;">
                                                    <div class="aps-icon-preview">
                                                        <label><?php _e('Icon Preview', US_TD); ?></label>
                                                        <?php if ($icon_detail['icon_type'] == 'image-icons') { ?>
                                                            <img src="<?php echo esc_url_raw($icon_detail['image']); ?>" data-image-name="<?php echo (isset($icons[$title]['image_name']))?$icons[$title]['image_name']:$title;?>"/>
                                                            <?php
                                                            $padding = str_replace('px', '', $icon_detail['border_spacing']);
                                                            $padding = ($padding == '') ? '' : 'padding:' . $padding . 'px';
                                                            $icon_height = str_replace('px', '', $icon_detail['icon_height']);
                                                            $icon_width = str_replace('px', '', $icon_detail['icon_width']);
                                                            $icon_style .=".$icon_main_class img{height:{$icon_height}px;width:{$icon_width}px;{$border}{$shadow}{$padding};}";
                                                            $icon_style .=".$icon_main_class img:hover{opacity:1}";
                                                        } else {
                                                            $font_icon = $icon_detail['font_icon'];
                                                            $font_icon_array = explode(' ', $font_icon);
                                                            $fa_class = $font_icon_array[1];
                                                            ?>
                                                            <i class="fa <?php echo $fa_class ?>"></i>
                                                            <?php
                                                            $fontSize = ($icon_size !== "") ? "font-size:" . $icon_size . ";" : "";
                                                            $fontColor = ($icon_color !== "") ? "color:" . $icon_color . ";" : "";
                                                            $fontHoverColor = ($icon_color_hover !== "") ? "color:" . $icon_color_hover . ";" : "";
                                                            $fontBgColor = ($icon_bg_color !== "") ? "background:" . $icon_bg_color . ";" : "";
                                                            $fontBgColorHover = ($icon_bg_color_hover !== "") ? "background:" . $icon_bg_color_hover . ";" : "";
                                                            $verticalPadding = ($icon_vertical_padding === '') ? '5px' : $icon_vertical_padding;
                                                            $horizontalPadding = ($icon_horizontal_padding === '') ? '5px' : $icon_horizontal_padding;
                                                            $padding = "padding:" . $verticalPadding . ' ' . $horizontalPadding . ';';
                                                            if ($icon_shape == 'circular') {
                                                                $fontShape = "border-radius:50%;";
                                                            } else {
                                                                if ($icon_shape === 'rounded_corner') {

                                                                    $fontShape = "border-radius:" . $radius_top_left . " " . $radius_top_right . " " . $radius_top_right . " " . $radius_bottom_left . ';';
                                                                } else {
                                                                    $fontShape = '';
                                                                }
                                                            }

                                                            $icon_style .= ".$icon_main_class .fa{";
                                                            $icon_style .= $fontSize;
                                                            $icon_style .= $fontColor;
                                                            $icon_style .= "}";
                                                            $icon_style .= ".$icon_main_class .fa:hover{";
                                                            $icon_style .= $fontHoverColor;
                                                            $icon_style .= "}";
                                                            $icon_style .= ".$icon_main_class .fa:before{";
                                                            $icon_style .= $fontBgColor;
                                                            $icon_style .= $fontShape;
                                                            $icon_style .= $padding;
                                                            $icon_style .= $border;
                                                            $icon_style .= $shadow;
                                                            $icon_style .= "}";
                                                            $icon_style .= ".$icon_main_class .fa:hover:before{";
                                                            $icon_style .= $fontBgColorHover;
                                                            $icon_style .= "}";
                                                        }
                                                        ?>

                                                    </div>
                                                    <?php if ($icon_detail['icon_type'] == 'image-icons') { ?>
                                                        <div class="aps-row">
                                                            <div class="aps-col-full">
                                                                <div class="aps-field-wrapper form-field">
                                                                    <label><?php _e('Icon Title', US_TD); ?></label>
                                                                    <div class="aps-field">
                                                                        <input type="text" name="icons[<?php echo esc_attr($title); ?>][title]" value="<?php echo esc_attr($icon_detail['title']); ?>"/>
                                                                    </div>
                                                                </div><!--aps-field-wrapper form-field-->
                                                            </div>
                                                        </div>
                                                        <div class="aps-row">
                                                            <div class="aps-col-half">
                                                                <div class="aps-field-wrapper form-field">
                                                                    <label><?php _e('Icon Width', US_TD); ?></label>
                                                                    <div class="aps-field">
                                                                        <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_width]" value="<?php echo esc_attr($icon_detail['icon_width']) ?>" class="aps_theme_icon_width"/>
                                                                    </div>
                                                                    <div class="aps-option-note"><?php _e('Please enter the width for the icon in px.', US_TD); ?></div>
                                                                </div><!--aps-field-wrapper form-field-->
                                                            </div>
                                                            <div class="aps-col-half">
                                                                <div class="aps-field-wrapper form-field">
                                                                    <label><?php _e('Icon Height', US_TD); ?></label>
                                                                    <div class="aps-field">
                                                                        <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_height]" value="<?php echo esc_attr($icon_detail['icon_height']) ?>" class="aps_theme_icon_height"/>
                                                                    </div>
                                                                    <?php _e('Please enter the height for the icon in px.', US_TD); ?>
                                                                </div><!--aps-field-wrapper form-field-->
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_bg_color]" value=""/>

                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][image_name]" value="<?php echo (isset($icons[$title]['image_name']))?$icons[$title]['image_name']:$title;?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_type]" value="image-icons"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][image]" value="<?php echo $icon_detail['image']; ?>" class="set_image_reference" data-image-name="<?php echo (isset($icons[$title]['image_name']))?$icons[$title]['image_name']:$title;?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][font_icon]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_size]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_bg]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_shape]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][radius_top_left]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][radius_top_right]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][radius_bottom_left]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][radius_bottom_right]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_color]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_bg_color_hover]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_color_hover]" value=""/> 
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="aps-field-wrapper form-field">
                                                            <label><?php _e('Icon Title', US_TD); ?></label>
                                                            <div class="aps-field">
                                                                <input type="text" name="icons[<?php echo esc_attr($title); ?>][title]" value="<?php echo esc_attr($icon_detail['title']); ?>"/>
                                                            </div>
                                                        </div><!--aps-field-wrapper form-field-->
                                                        <div class="aps-field-wrapper form-field">
                                                            <label><?php _e('Icon Size', US_TD); ?></label>
                                                            <div class="aps-field">
                                                                <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_size]" value="<?php echo esc_attr($icon_detail['icon_size']); ?>"/>
                                                            </div>
                                                        </div><!--aps-field-wrapper form-field-->
                                                        <div class="aps-row">
                                                            <div class="aps-col-half">
                                                                <div class="aps-field-wrapper form-field">
                                                                    <label><?php _e('Icon Color', US_TD); ?></label>
                                                                    <div class="aps-field">
                                                                        <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_color]" value="<?php echo esc_attr($icon_detail['icon_color']); ?>" class="aps-color-picker"/>
                                                                    </div>
                                                                </div><!--aps-field-wrapper form-field-->  
                                                            </div>
                                                            <div class="aps-col-half">
                                                                <div class="aps-field-wrapper form-field">
                                                                    <label><?php _e('Icon Color Hover', US_TD); ?></label>
                                                                    <div class="aps-field">
                                                                        <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_color_hover]" value="<?php echo esc_attr($icon_detail['icon_color_hover']); ?>" class="aps-color-picker"/>
                                                                    </div>
                                                                </div><!--aps-field-wrapper form-field-->
                                                            </div>
                                                        </div>
                                                        <?php if ($icon_detail['icon_bg'] == 1) { ?>
                                                            <div class="aps-row">
                                                                <div class="aps-col-half">
                                                                    <div class="aps-field-wrapper form-field">
                                                                        <label><?php _e('Icon BG Color', US_TD); ?></label>
                                                                        <div class="aps-field">
                                                                            <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_bg_color]" value="<?php echo esc_attr($icon_detail['icon_bg_color']); ?>" class="aps-color-picker"/>
                                                                        </div>
                                                                    </div><!--aps-field-wrapper form-field-->
                                                                </div>
                                                                <div class="aps-col-half">
                                                                    <div class="aps-field-wrapper form-field">
                                                                        <label><?php _e('Icon BG Color Hover', US_TD); ?></label>
                                                                        <div class="aps-field">
                                                                            <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_bg_color_hover]" value="<?php echo esc_attr($icon_detail['icon_bg_color_hover']); ?>" class="aps-color-picker"/>
                                                                        </div>
                                                                    </div><!--aps-field-wrapper form-field-->
                                                                </div>
                                                            </div>
                                                            <div class="aps-row">
                                                                <div class="aps-col-half">
                                                                    <div class="aps-field-wrapper form-field">
                                                                        <label><?php _e('Top/Bottom Space between Icon and Border', US_TD); ?></label>
                                                                        <div class="aps-field">
                                                                            <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_vertical_padding]" value="<?php echo esc_attr($icon_detail['icon_vertical_padding']); ?>"/>
                                                                        </div>
                                                                    </div><!--aps-field-wrapper form-field-->
                                                                </div>
                                                                <div class="aps-col-half">
                                                                    <div class="aps-field-wrapper form-field">
                                                                        <label><?php _e('Left/Right Space between Icon and Border', US_TD); ?></label>
                                                                        <div class="aps-field">
                                                                            <input type="text" name="icons[<?php echo esc_attr($title); ?>][icon_horizontal_padding]" value="<?php echo esc_attr($icon_detail['icon_horizontal_padding']); ?>"/>
                                                                        </div>
                                                                    </div><!--aps-field-wrapper form-field-->
                                                                </div>
                                                            </div>
                                                        <?php } ?>


        <!--<input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_size]" value="<?php echo $icon_detail['icon_size']; ?>"/>-->
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_bg]" value="<?php echo $icon_detail['icon_bg']; ?>" />
                                                        <!--<input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_bg_color]" value="<?php echo esc_attr($icon_detail['icon_bg_color']); ?>"/>-->
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_shape]" value="<?php echo $icon_detail['icon_shape']; ?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][radius_top_left]" value="<?php echo esc_attr($icon_detail['radius_top_left']); ?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][radius_top_right]" value="<?php echo esc_attr($icon_detail['radius_top_right']); ?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][radius_bottom_left]" value="<?php echo esc_attr($icon_detail['radius_bottom_left']); ?>"/>
                                                        <input type="hidden"  name="icons[<?php echo esc_attr($title); ?>][radius_bottom_right]" value="<?php echo esc_attr($icon_detail['radius_bottom_right']); ?>"/>
                                                        <!--<input type="hidden"name="icons[<?php echo esc_attr($title); ?>][icon_color]" value="<?php echo esc_attr($icon_detail['icon_color']); ?>" />
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_bg_color_hover]" value="<?php echo esc_attr($icon_detail['icon_bg_color_hover']); ?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_color_hover]" value="<?php echo esc_attr($icon_detail['icon_color_hover']); ?>"/>-->
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][title]" value="<?php echo esc_attr($icon_detail['title']); ?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_type]" value="<?php echo esc_attr($icon_detail['icon_type']); ?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][font_icon]" value="<?php echo esc_attr($icon_detail['font_icon']); ?>"/>
                                                        <!--<input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_vertical_padding]" value="<?php echo esc_attr($icon_detail['icon_vertical_padding']); ?>"/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_horizontal_padding]" value="<?php echo esc_attr($icon_detail['icon_horizontal_padding']); ?>"/>-->
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][image]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_width]" value=""/>
                                                        <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][icon_height]" value=""/>
                                                    <?php }
                                                    ?>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][border_thickness]" value="<?php echo esc_attr($icon_detail['border_thickness']); ?>"/>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][border_color]" value="<?php echo esc_attr($icon_detail['border_color']); ?>"/>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][border_type]" value="<?php echo esc_attr($icon_detail['border_type']); ?>"/>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][shadow]" value="<?php echo esc_attr($icon_detail['shadow']); ?>"/>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][shadow_offset_x]" value="<?php echo esc_attr($icon_detail['shadow_offset_x']); ?>"/>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][shadow_offset_y]" value="<?php echo esc_attr($icon_detail['shadow_offset_y']); ?>"/>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][shadow_blur]" value="<?php echo esc_attr($icon_detail['shadow_blur']); ?>"/>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][shadow_color]" value="<?php echo esc_attr($icon_detail['shadow_color']); ?>"/>
                                                    <input type="hidden" name="icons[<?php echo esc_attr($title); ?>][border_spacing]" value="<?php echo esc_attr($icon_detail['border_spacing']); ?>"/>
                                                    <div class="aps-row">
                                                        <div class="aps-col-full">
                                                            <div class="aps-field-wrapper form-field">
                                                                <label><?php _e('Icon Link', US_TD); ?></label>
                                                                <div class="aps-field">
                                                                    <input type="text" name="icons[<?php echo esc_attr($title); ?>][link]" value="<?php echo $icon_detail['link'] ?>" placeholder="eg. https://www.facebook.com/WP-Ultimate-Social-Plugin"/>
                                                                </div>
                                                            </div><!--aps-field-wrapper form-field-->
                                                        </div>

                                                    </div>
                                                    <div class="aps-row">
                                                        <div class="aps-col-half">
                                                            <div class="aps-field-wrapper form-field">
                                                                <label><?php _e('Tooltip Text', US_TD); ?></label>
                                                                <div class="aps-field">
                                                                    <input type="text" name="icons[<?php echo esc_attr($title); ?>][tooltip_text]" value="<?php echo esc_attr($icon_detail['tooltip_text']) ?>"/>
                                                                </div>
                                                            </div><!--aps-field-wrapper form-field-->
                                                        </div>
                                                        <div class="aps-col-half">
                                                            <div class="aps-field-wrapper form-field">
                                                                <label><?php _e('Icon Link Target', US_TD); ?></label>
                                                                <div class="aps-field">
                                                                    <select name="icons[<?php echo esc_attr($title); ?>][link_target]">
                                                                        <option value="New Window">New Window</option>
                                                                        <option value="Same Window">Same Window</option>
                                                                    </select>
                                                                </div>
                                                            </div><!--aps-field-wrapper form-field--> 
                                                        </div>
                                                    </div>



                                                </div>
                                                <?php
                                                $icon_style .='</style>';
                                                echo $icon_style;
                                                ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <!--aps-icon-adder-->
                                <?php include('icon-adder.php') ?>
                                <!--aps-icon-adder-->
                            </div>
                        </div>

                        <div class="aps-field-wrapper form-field">
                            <div class="aps-error aps-main-error"></div>
                            <input type="submit" class="button button-primary" value="<?php _e('Save icon set', US_TD); ?>" name="aps_icon_set_submit" id="aps_icon_set_submit"/>
                            <input type="hidden" id="aps-icon-counter" value="<?php echo count($icon_details); ?>"/>
                            <input type="hidden" name="si_id" value="<?php echo $si_id; ?>"/>
                            <input type="hidden" name="current_page" value="<?php echo US_Social_icons_class::curPageURL(); ?>"/>
                            <input type="hidden" name="icon_theme_id" id="icon_theme_id" value="<?php echo $icon_extra['icon_theme_id']; ?>"/>
                            <input type="hidden" name="icon_theme_type" value="<?php echo $icon_extra['icon_theme_type']; ?>" id="icon_theme_type"/>
                        </div>
                        <?php wp_nonce_field('aps_edit_action', 'aps_edit_set_nonce'); ?>
                    </form>
                </div>
                <div class="aps-pre-available-icons" style="display: none;">
                </div>
                <div class="aps-font-awesome-icons" style="display:none">
                    <?php include_once('font-awesome-icons.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>