<li class="aps-sortable-icons">
                            <div class="aps-drag-icon"></div>  
                            <div class="aps-icon-head">
                                <span class="aps-icon-name"><?php echo esc_attr($filename); ?></span>
                                <span class="aps-icon-list-controls"><span class="aps-arrow-down aps-arrow button button-secondary" aria-label="expand icons"><i class="dashicons dashicons-arrow-down"></i></span></span>
                            </div>
                            <div class="aps-icon-body" style="display: none;">
                                <div class="aps-row">
                                    <div class="aps-col-full">
                                        <div class="aps-icon-preview form-field">
                                            <label><?php _e('Icon Preview', US_TD); ?></label>
                                            <img src="<?php echo APS_PRO_ICONS_DIR . '/' . $sub_folder . '/' . $folder . '/' . $file; ?>" data-image-name="<?php echo $filename?>"/>
                                        </div>

                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Icon Title', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="icons[<?php echo $filename; ?>][title]"/>
                                            </div>
                                        </div><!--aps-field-wrapper-->
                                        <?php if ($sub_folder == 'svg') { ?>
                                            <div class="aps-field-wrapper form-field">
                                                <label><?php _e('Icon Background Color', US_TD); ?></label>
                                                <div class="aps-field">
                                                    <input type="text" name="icons[<?php echo $filename; ?>][icon_bg_color]" class="aps-color-picker"/>
                                                </div>
                                            </div><!--aps-field-wrapper-->
                                        <?php } ?>
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Icon Width', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="icons[<?php echo $filename; ?>][icon_width]" class="aps_theme_icon_width"/>
                                            </div>
                                            <div class="aps-option-note">
                                                <p><?php _e('Please enter the width for the icon in px.', US_TD); ?></p>
                                            </div>
                                        </div><!--aps-field-wrapper-->
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Icon Height', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="icons[<?php echo $filename; ?>][icon_height]" class="aps_theme_icon_height"/>
                                            </div>
                                            <div class="aps-option-note"><p><?php _e('Please enter the height for the icon in px.', US_TD); ?></p></div>
                                        </div><!--aps-field-wrapper-->
                                    </div>
                                    <div class="aps-col-full">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Icon Link', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="icons[<?php echo $filename; ?>][link]" placeholder="eg. http://facebook.com/social_ultimate"/>
                                            </div>
                                        </div><!--aps-field-wrapper-->
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Tooltip Text', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="icons[<?php echo $filename; ?>][tooltip_text]"/>
                                            </div>
                                        </div><!--aps-field-wrapper-->
                                    </div>
                                    
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Icon Link Target', US_TD); ?></label>
                                            <div class="aps-field">
                                                <select name="icons[<?php echo $filename; ?>][link_target]" class="aps-form-control">
                                                    <option value="New Window">New Window</option>
                                                    <option value="Same Window">Same Window</option>
                                                </select>
                                            </div>
                                        </div><!--aps-field-wrapper-->  
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][image_name]" value="<?php echo $filename?>" />
                            <input type="hidden" name="icons[<?php echo $filename; ?>][title]" value="<?php echo $filename; ?>"/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][icon_type]" value="image-icons"/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][image]" value="<?php echo APS_PRO_ICONS_DIR . '/' . $sub_folder . '/' . $folder . '/' . $file; ?>" class="set_image_reference" data-image-name="<?php echo $filename;?>"/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][font_icon]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][icon_size]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][icon_bg]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][icon_bg_color]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][icon_shape]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][radius_top_left]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][radius_top_right]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][radius_bottom_left]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][radius_bottom_right]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][icon_color]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][icon_bg_color_hover]" value=""/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][border_type]" value="none"/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][border_spacing]" value="0"/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][border_thickness]" value="0"/> 
                            <input type="hidden" name="icons[<?php echo $filename; ?>][border_color]" value="#FFF"/> 
                            <input type="hidden" name="icons[<?php echo $filename; ?>][shadow]" value="no"/> 
                            <input type="hidden" name="icons[<?php echo $filename; ?>][shadow_offset_x]" value="0"/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][shadow_offset_y]" value="0"/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][shadow_blur]" value="0"/>
                            <input type="hidden" name="icons[<?php echo $filename; ?>][shadow_color]" value="#FFF"/>

                        </li>