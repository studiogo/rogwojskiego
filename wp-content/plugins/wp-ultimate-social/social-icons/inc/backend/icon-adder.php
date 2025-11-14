<div class="aps-icon-adder" style="display: none;">
    <div class="aps-row">
        <div class="aps-col-half">
            <div class="aps-field-wrapper form-field">
                <label><?php _e('Icon Title', US_TD); ?></label>
                <div class="aps-field">
                    <input type="text" id="aps-icon-title" class="required" data-error-msg="<?php _e('Please enter the icon title', US_TD); ?>"/>
                </div>
                <div class="aps-error"></div>
            </div><!--aps-field-wrapper-->
        </div>
        <div class="aps-col-half">
            <div class="aps-field-wrapper form-field">
                <label><?php _e('Icon Type', US_TD); ?></label>
                <div class="aps-field">
                    <select id="aps-icon-type" class="aps-form-control">
                        <option value="image-icons"><?php _e('Image Icons', US_TD); ?></option>
                        <option value="font-awesome"><?php _e('Font Awesome Icons', US_TD); ?></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="aps-col-full">
            <div class="aps-row">
                <div class="aps-font-awesome-icon aps-clear" style="display: none;">
                    
                    <div class="aps-col-half">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Font Awesome Icon', US_TD); ?></label>
                            <div class="aps-field">
                                <input type="hidden" id="aps-font-awesome-icon" data-error-msg="<?php _e('Please choose any one font icon', US_TD) ?>"/>
                                <input type="button" id="aps-font-icon-chooser" class="button button-secondary" value="<?php _e('Select Icon', US_TD); ?>"/>
                            </div>
                            <div class="aps-error"></div>
                        </div><!--aps-field-wrapper-->
                    </div>
                    <div class="aps-col-half">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Icon Size', US_TD); ?></label>
                            <div class="aps-field">
                                <input type="text" id="aps-icon-size" placeholder="eg. 14px"/>
                            </div>
                        </div><!--aps-field-wrapper-->
                    </div>
                    
                    <div class="aps-clear"></div>
                    
                    <div class="aps-col-half">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Icon Color', US_TD); ?></label>
                            <div class="aps-field">
                                <input type="text" id="aps-icon-color"/>
                            </div>
                        </div><!--aps-field-wrapper-->
                    </div>

                    <div class="aps-col-half">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Color (Hover)', US_TD); ?></label>
                            <div class="aps-field">
                                <input type="text" id="icon-color-hover" class="aps-color-picker"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="aps-clear"></div>
                    
                    <div class="aps-col-one-third">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Icon Background', US_TD); ?></label>
                            <div class="aps-field">
                                <label class="label-inline"><input type="radio" class="aps-icon-background" value="1" name="aps_icon_background"/>Yes</label>
                                <label class="label-inline"><input type="radio" class="aps-icon-background" value="0"  name="aps_icon_background" checked="checked" />No</label>
                            </div>
                        </div><!--aps-field-wrapper-->
                    </div>
                    
                    <div class="aps-clear"></div>
                    
                    <div id="aps-bg-color-pickers" class="clearfix" style="display:none">
                        <div class="aps-col-half">
                            <div class="aps-field-wrapper form-field">
                                <label><?php _e('Bg Color', US_TD); ?></label>
                                <div class="aps-field"><input type="text" id="aps-icon-background-color"/></div>
                            </div><!--aps-field-wrapper-->
                        </div>

                        <div class="aps-col-half">
                            <div class="aps-field-wrapper form-field">
                                <label><?php _e('Bg Color (Hover)', US_TD); ?></label>
                                <div class="aps-field">
                                    <input type="text" id="bg-hover-color" class="aps-color-picker"/>
                                </div>
                            </div><!--aps-field-wrapper-->
                        </div>
                        <div class="aps-col-half">
                            <div class="aps-field-wrapper form-field">
                                <label><?php _e('Top/Bottom Space between Icon and Border', US_TD); ?></label>
                                <div class="aps-field"><input type="text" id="aps-vertical-padding" placeholder="eg. 14px"/></div>
                            </div><!--aps-field-wrapper-->
                        </div>

                        <div class="aps-col-half">
                            <div class="aps-field-wrapper form-field">
                                <label><?php _e('Left/Right Space between Icon and Border', US_TD); ?></label>
                                <div class="aps-field">
                                    <input type="text" id="aps-horizontal-padding" placeholder="eg. 14px"/>
                                </div>
                            </div><!--aps-field-wrapper-->
                        </div>
                    </div>
                    
                    <div class="aps-clear"></div>

                    <div class="aps-col-full">
                        <div class="aps-field-wrapper form-field icon-background-reference" style="display:none">
                            <label><?php _e('Icon Shape', US_TD); ?></label>
                            <div class="aps-field">
                                <label class="label-inline"><input type="radio" class="aps-icon-shape" value="square" name="aps_icon_shape" checked="checked" /><?php _e('Square', US_TD); ?></label>
                                <label class="label-inline"><input type="radio" class="aps-icon-shape" value="rounded_corner"  name="aps_icon_shape" /><?php _e('Rounded Corner', US_TD); ?></label>
                                <label class="label-inline"><input type="radio" class="aps-icon-shape" value="circular" name="aps_icon_shape" /><?php _e('Circular', US_TD); ?></label>
                            </div>
                        </div><!--aps-field-wrapper-->
                    </div>

                    <div class="aps-clear"></div>
                    
                    <div class="aps-field-wrapper form-field border-radius-reference" style="display: none;">
                        <div class="aps-col-full">
                            <label><?php _e('Border Radius', US_TD); ?></label>
                            <div class="aps-field">
                                <div class="aps-row">
                                    <div class="aps-col-one-fourth">
                                        <label><?php _e('Top Left', US_TD); ?></label><input type="text" id="radius-top-left" />
                                    </div>
                                    <div class="aps-col-one-fourth">
                                        <label><?php _e('Top Right', US_TD); ?></label><input type="text" id="radius-top-right" />
                                    </div>
                                    <div class="aps-col-one-fourth">
                                        <label><?php _e('Bottom Left', US_TD); ?></label><input type="text" id="radius-bottom-left"/>  
                                    </div>
                                    <div class="aps-col-one-fourth">
                                        <label><?php _e('Bottom Right', US_TD); ?></label><input type="text" id="radius-bottom-right"/>
                                    </div>
                                </div>
                            </div>
                            <div class="aps-option-note"><p><?php _e('Please enter the radius of the each border in px', US_TD); ?></p></div>
                        </div>
                    </div>

                    <div class="aps-clear"></div>
                </div><!--aps-font-awesome-icon-->  
            </div>
        </div>
        <div class="aps-col-full">
            <div class="aps-image-icon">
                <div class="aps-field-wrapper form-field">
                    <label><?php _e('Icon Image', US_TD); ?></label>
                    <div class="aps-field">
                        <input type="text" id="aps-icon-image" class="required" data-error-msg="<?php _e('Please upload the icon image', US_TD); ?>"/>
                        <input type="button" class="button button-secondary" id="aps-icon-chooser" value="<?php _e('Pre available icons', US_TD); ?>"/>
                        <input class="button button-primary" id="ap-icon-upload-button" type="button" value="Upload Icon"/>
                        <img src="<?php echo APS_PRO_IMAGE_DIR.'/ajax-loader.gif'?>" id="aps-icon-loader" style="display:none"/>
                    </div>
                    <div class="aps-error"></div>
                </div><!--aps-field-wrapper-->
                
                <div class="aps-row">
                    <div class="aps-col-half">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Icon Width', US_TD); ?></label>
                            <div class="aps-field">
                                <input type="text" id="aps-icon-width" placeholder="eg. 50px"/>
                            </div>
                        </div><!--aps-field-wrapper-->
                    </div>
                    <div class="aps-col-half">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Icon Height', US_TD); ?></label>
                            <div class="aps-field">
                                <input type="text" id="aps-icon-height" placeholder="eg. 50px"/>
                            </div>
                        </div><!--aps-field-wrapper-->
                    </div>
                </div>
            </div><!--aps-custom-icon-->
        </div>
        <div class="aps-clear"></div>

        <div class="aps-col-full">
            <div class="aps-row">
                <div class="aps-col-full">
                    <div class="aps-field-wrapper">
                        <label><?php _e('Border Style', US_TD); ?></label>                    
                        <div class="aps-field form-field">
                            <select id="aps-border-type" class="aps-form-control">
                                <option value="none">None</option>
                                <option value="dotted">Dotted</option>                            
                                <option value="dashed">Dashed</option>
                                <option value="solid">Solid</option>
                                <option value="double">Double</option>
                                <option value="groove">Groove</option>
                                <option value="ridge">Ridge</option>
                                <option value="inset">Inset</option>
                                <option value="inset">Outset</option>
                            </select>
                        </div>
                    </div>
                </div><!--aps-col-one-third-->
                <div class="aps-border-refernce" style="display:none">
                    <div class="aps-col-one-third aps-image-icon-reference">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Border Spacing', US_TD); ?></label>                    
                            <div class="aps-field">
                                <input type="text" id="aps-border-spacing" placeholder="<?php _e('eg. 2px', US_TD); ?>"/>
                            </div>
                        </div>
                    </div><!--aps-col-one-third-->
                    <div class="aps-col-one-third">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Border Thickness', US_TD); ?></label>                    
                            <div class="aps-field">
                                <input type="text" id="aps-border-thickness" placeholder="<?php _e('eg. 2px', US_TD); ?>"/>
                            </div>
                        </div>
                    </div><!--aps-col-one-third-->
                    <div class="aps-col-one-third">
                        <div class="aps-field-wrapper form-field">
                            <label><?php _e('Border Color', US_TD); ?></label>                    
                            <div class="aps-field">
                                <input type="text" id="aps-border-color"/>
                            </div>
                        </div>
                    </div><!--aps-col-one-third-->
                </div>
            </div>
        </div><!--aps-col-full-->
        <div class="aps-col-full">
            <div class="aps-field-wrapper form-field">
                <label><?php _e('Shadow', US_TD); ?></label>
                <div class="aps-field">
                    <label class="label-inline"><input type="radio" name="aps-icon-shadow" value="yes"/>Yes</label>
                    <label class="label-inline"><input type="radio" name="aps-icon-shadow" value="no" checked="checked"/>No</label>
                </div>
            </div>
        </div>
        <div class="aps-col-full aps-shadow-reference" style="display:none;">
            <div class="aps-row">
                <div class="aps-col-one-third">
                    <div class="aps-field-wrapper form-field">
                        <label><?php _e('Offset X', US_TD); ?></label>
                        <div class="aps-field">
                            <input type="text" id="aps-shadow-offset-x"/>                        
                        </div>
                    </div>
                </div>
                <div class="aps-col-one-third">
                    <div class="aps-field-wrapper form-field">
                        <label><?php _e('Offset Y', US_TD); ?></label>
                        <div class="aps-field">
                            <input type="text" id="aps-shadow-offset-y"/>                        
                        </div>
                    </div>
                </div>
                <div class="aps-col-one-third">
                    <div class="aps-field-wrapper form-field">
                        <label><?php _e('Blur', US_TD); ?></label>
                        <div class="aps-field">
                            <input type="text" id="aps-shadow-blur"/>                        
                        </div>
                    </div>
                </div>
                <div class="aps-col-half">
                    <div class="aps-field-wrapper form-field">
                        <label><?php _e('Shadow Color', US_TD); ?></label>
                        <div class="aps-field">
                            <input type="text" id="aps-shadow-color"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="aps-col-full">
            <div class="aps-field-wrapper form-field">
                <label><?php _e('Icon Link', US_TD); ?></label>
                <div class="aps-field">
                    <input type="text" id="aps-icon-link" class="required"  data-error-msg="<?php _e('Please enter the icon link', US_TD); ?>" placeholder="https://www.facebook.com/WP-Ultimate-Social-Plugin"/>
                </div>
                <div class="aps-error"></div>
            </div><!--aps-field-wrapper-->
        </div>
        <div class="aps-col-half">
            <div class="aps-field-wrapper aps-tooltip-reference form-field">
                <label><?php _e('Tooltip Text', US_TD); ?></label>
                <div class="aps-field">
                    <input type="text" id="aps-tooltip-text"/>
                </div>
            </div>
        </div>
        <div class="aps-col-half">
            <div class="aps-field-wrapper form-field">
                <label><?php _e('Icon Link Target', US_TD); ?></label>
                <div class="aps-field">
                    <select id="aps-icon-link-target" class="aps-form-control">
                        <option value="New Window">New Window</option>
                        <option value="Same Window">Same Window</option>
                    </select> 
                </div>
            </div><!--aps-field-wrapper-->
        </div>
        <div class="aps-col-full">
            <div class="aps-well">
                <div class="aps-field-wrapper form-field">
                    <div class="aps-field">
                        <input type="button" class="button button-secondary" id="aps-icon-add-trigger" value="Add Icon to List"/>
                    </div>
                </div><!--aps-field-wrapper-->
            </div>
        </div>
    </div>
</div>