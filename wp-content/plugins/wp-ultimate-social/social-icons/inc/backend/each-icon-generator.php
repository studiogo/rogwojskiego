<?php
$icon_counter = 0;
foreach ($icon_details as $title => $icon) {
        $link_target = ($icon['link_target'] == 'New Window') ? 'target="_blank"' : '';

        if ($icon['link'] != '') {
            $icon_style = '<style class="aps-icon-front-style">';
            $icon_counter++;
                $icon_main_class = 'icon-' . $icon_set_id . '-' . $icon_counter;
                foreach ($icon as $key => $val) {
                    ${$key} = $val;
                }
                $link_target = ($icon['link_target'] == 'New Window') ? 'target="_blank"' : '';
                $tooltip_text = ($icon['tooltip_text'] == '') ? esc_attr($title) : esc_attr($icon['tooltip_text']);
                //global $icon_margin;
                ?>
                <div class="aps-each-icon <?php echo $icon_main_class; ?>" style='margin-bottom:<?php echo $icon_margin; ?>' data-aps-tooltip='<?php echo $tooltip_text ?>' data-aps-tooltip-enabled="<?php echo $icon_set->icon_tooltip; ?>" data-aps-tooltip-bg="<?php echo $tooltip_bg = ($icon_set->tooltip_background == '') ? '#000' : $icon_set->tooltip_background; ?>" data-aps-tooltip-color="<?php echo ($icon_set->tooltip_text_color == '') ? '#fff' : $icon_set->tooltip_text_color; ?>">
                    <a href="<?php echo $icon['link'] ?>" <?php echo $link_target; ?>  class="aps-icon-link animated <?php echo ($icon_set->icon_tooltip == 1) ? 'aps-tooltip' : ''; ?>" data-animation-class="<?php echo $icon_animation; ?>">
                        <?php
                        $border_thickness = str_replace('px', '', $icon['border_thickness']);
                        $border_thickness = ($border_thickness == '') ? '1' : $border_thickness;
                        $border_color = ($icon['border_color'] == '') ? '#000' : $icon['border_color'];
                        $border_type = $icon['border_type'];
                        $shadow_type = $icon['shadow'];
                        $offset_x = str_replace('px', '', $icon['shadow_offset_x']);
                        $offset_x = ($offset_x == '') ? '0px' : $offset_x;
                        $offset_y = str_replace('px', '', $icon['shadow_offset_y']);
                        $offset_y = ($offset_y == '') ? '0px' : $offset_y;
                        $blur = str_replace('px', '', $icon['shadow_blur']);
                        $blur = ($blur == '') ? '0px' : $blur;
                        $shadow_color = $icon['shadow_color'];
                        if ($shadow_type != 'no') {
                            $shadow = '-moz-box-shadow:' . $offset_x . 'px ' . $offset_y . 'px ' . $blur . 'px ' . '0' . ' ' . $shadow_color . ';';
                            $shadow .= '-webkit-box-shadow:' . $offset_x . 'px ' . $offset_y . 'px ' . $blur . 'px ' . '0' . ' ' . $shadow_color . ';';
                            $shadow .= 'box-shadow:' . $offset_x . 'px ' . $offset_y . 'px ' . $blur . 'px ' . '0' . ' ' . $shadow_color . ';';
                        } else {
                            $shadow = '';
                        }

                        $border = ($icon['border_type'] == 'none') ? '' : "border:{$border_thickness}px $border_type $border_color;";
                        if ($icon['icon_type'] == 'image-icons') {
                            ?>
                            <img src="<?php echo $icon['image']; ?>"/>
                            <?php
                            $opacity_hover = $icon_set->opacity_hover;
                            $icon_height = str_replace('px', '', $icon['icon_height']);
                        $icon_width = str_replace('px', '', $icon['icon_width']);
                        $padding = str_replace('px', '', $icon['border_spacing']);
                        $padding = "padding:{$padding}px;";
                        $icon_style .=".$icon_main_class img{height:{$icon_height}px;width:{$icon_width}px;opacity:{$opacity_hover};{$border}{$shadow}{$padding}}";
                        $icon_style .=".$icon_main_class .aps-icon-tooltip:before{border-color:$tooltip_bg}";
                            //if($icon[''])
                        } else {
                            //$this->print_array($icon);
                            $fa_class = $icon['font_icon'];
                            $fa_class_array = explode(' ', $fa_class);
                            $fa_class = $fa_class_array[1];

                            /*
                             * [title] => Twitter
                              [icon_type] => font-awesome
                              [image] =>
                              [icon_width] =>
                              [icon_height] =>
                              [link] => http://twitter.com
                              [link_target] => New Window
                              [tooltip_text] => Twitter Link
                              [font_icon] => fa fa-twitter
                              [icon_size] => 40px
                              [icon_bg] => 1
                              [icon_bg_color] => #c6c6c6
                              [icon_shape] => square
                              [radius_top_left] => 5px
                              [radius_top_right] => 5px
                              [radius_bottom_left] => 5px
                              [radius_bottom_right] => 5px
                              [icon_color] => #1e73be
                              [icon_bg_color_hover] => #b2b2b2
                              [icon_color_hover] => #2a20db
                              [icon_vertical_padding] => 10px
                              [icon_horizontal_padding] => 10px
                              [border_type] => none
                              [border_thickness] =>
                              [border_color] =>
                              [shadow] => undefined
                              [shadow_offset_x] => 5px
                              [shadow_offset_y] => 5px
                              [shadow_blur] => 5px
                              [shadow_color] => #333333
                             */
                            ?>
                            <i class="fa <?php echo $fa_class; ?>"></i>
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
                            $icon_style .=".$icon_main_class .aps-icon-tooltip:before{border-color:$tooltip_bg}";
                        }
                        ?>
                    </a>
                    <span class="aps-icon-tooltip aps-icon-tooltip-<?php echo $icon_extra['tooltip_position']; ?>" style="display: none;"></span>
                    <?php
                    $icon_style .='</style>';
                    echo $icon_style;
                    ?>
                </div>
               
            <?php
        }
    }//foreach close
?>
