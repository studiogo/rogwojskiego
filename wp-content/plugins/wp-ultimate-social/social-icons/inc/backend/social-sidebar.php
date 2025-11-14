<?php
$social_sidebar_settings = get_option('aps_social_sidebar');
//$this->print_array($social_sidebar_settings);
if (!empty($social_sidebar_settings)) {
    $social_sidebar = $social_sidebar_settings['social_sidebar'];
    $social_sidebar_attachment = $social_sidebar_settings['social_sidebar_attachment'];
    $icon_set_id = $social_sidebar_settings['icon_set_id'];
    $social_sidebar_position = $social_sidebar_settings['social_sidebar_position'];
    $position = $social_sidebar_settings['social_sidebar_position'];
    $hidden = ($social_sidebar_settings['half_hidden'] == 'yes') ? 'aps-icon-sidebar-hidden' : '';
    $attachment = ($social_sidebar_settings['social_sidebar_attachment'] == 'fixed') ? 'aps-icon-sidebar-fixed' : '';
    $icon_margin = esc_attr($social_sidebar_settings['icon_margin']);
    $icon_margin = ($icon_margin == '') ? '0px' : str_replace('px', '', $icon_margin) . 'px';
    $icon_animation = $social_sidebar_settings['animation'];
} else {
    $social_sidebar = 0;
    $icon_set_id = '';
    $social_sidebar_position = 'aps-icon-sidebar-leftTop';
    $social_sidebar_attachment = 'fixed';
    $top = '';
    $position = $social_sidebar_position;
    $attachment = 'aps-icon-sidebar-fixed';
    $hidden = 'aps-icon-sidebar-hidden';
    $display_direction = 'horizontal';
    $icon_animation = '';
}
?>
<div class="wrap">
    <div class="aps-social-sidebar-wrapper">
        <div class="aps-panel">
            <!--Panel Head-->
            <?php include('panel-head.php');?>
            <!--Panel Head-->
            
                <h2><?php _e('Social Sidebar Settings',US_TD);?></h2>
                <?php
                if (isset($_SESSION['aps_message'])) {
                    ?><div class="aps-message">
                        <p>
                            <?php
                            echo $_SESSION['aps_message'];
                            unset($_SESSION['aps_message']);
                            ?>
                        </p>
                    </div>
                    <?php
                }
                ?>
                <div class="form-wrap">
                    <form method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
                        <input type="hidden" name="action" value="aps_social_sidebar_action"/>
                        <div class="aps-row">
                            <div class="aps-col-half">
                                <div class="aps-field-wrapper form-field">
                                    <div class="aps-field">
                                        <label><input type="checkbox" name="social_sidebar" value="1" <?php if ($social_sidebar == 1) { ?>checked="checked"<?php } ?>/>Social Sidebar</label>
                                    </div>
                                    <div class="aps-option-note">
                                        <p><?php _e('Please check to enable the social sidebar in the site', US_TD); ?></p>
                                    </div>
                                </div><!--aps-field-wrapper form-field-->


                                <div class="aps-row">
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label>Icon Set &nbsp;&nbsp;<img src="<?php echo APS_PRO_IMAGE_DIR . '/ajax-loader.gif' ?>" id="aps-icon-set-loader" style="display:none"/></label>
                                            <div class="aps-field">
                                                <select name="icon_set_id" class="aps-form-control" id="aps-sidebar-set-chooser">
                                                    <option value=""><?php _e('Choose Icon Set', US_TD); ?></option>
                                                    <?php
                                                    global $wpdb;
                                                    $table_name = $table_name = $wpdb->prefix . "aps_social_icons_pro";
                                                    $icon_sets = $wpdb->get_results("SELECT * FROM $table_name");
                                                    if (count($icon_sets) > 0) {
                                                        foreach ($icon_sets as $icon_set) {
                                                            ?>
                                                            <option value="<?php echo $icon_set->si_id ?>" <?php if ($icon_set_id == $icon_set->si_id) { ?>selected="selected"<?php } ?>><?php echo $icon_set->icon_set_name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>
                                    <?php $edit_nonce = wp_create_nonce('aps-edit-nonce'); ?>

                                    <div class="aps-col-half aps-set-edit-button" <?php echo ($icon_set_id == '') ? 'style="display:none"' : ''; ?>>
                                        <div class="aps-field-wrapper form-field">
                                            <label>&nbsp;</label>
                                            <div class="aps-field">
                                                <a href="<?php echo admin_url() . 'admin.php?page=us-social-icons&action=edit_si&_wpnonce=' . $edit_nonce  .'&si_id=' . $icon_set_id; ?>" target="_blank"><input type="button" class="button button-primary" value="<?php _e('Edit Set', US_TD); ?>"/></a>
                                                <input type="button" class="button button-primary aps-rebuild-sidebar-set" value="<?php _e('Rebuild Set', US_TD); ?>"/>
                                            </div>
                                        </div>
                                    </div>




                                </div>
                                <div class="aps-row">

                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Margin between each icon', US_TD); ?></label>
                                            <div class="aps-field">
                                                <input type="text" name="icon_margin" value="<?php echo (isset($social_sidebar_settings['icon_margin'])) ? $social_sidebar_settings['icon_margin'] : ''; ?>" placeholder="eg. 2px" id="aps-sidebar-icon-margin"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Social Sidebar Position', US_TD); ?></label>
                                            <div class="aps-field">
                                                <select name="social_sidebar_position" class="aps-form-control" id="aps-sidebar-position-select">
                                                    <option value="aps-icon-sidebar-leftTop" <?php if ($social_sidebar_position == 'aps-icon-sidebar-leftTop') { ?>selected="selected"<?php } ?>>Left Top</option>
                                                    <option value="aps-icon-sidebar-leftMiddle" <?php if ($social_sidebar_position == 'aps-icon-sidebar-leftMiddle') { ?>selected="selected"<?php } ?>>Left Middle</option>
                                                    <option value="aps-icon-sidebar-leftBottom" <?php if ($social_sidebar_position == 'aps-icon-sidebar-leftBottom') { ?>selected="selected"<?php } ?>>Left Bottom</option>
                                                    <option value="aps-icon-sidebar-rightTop" <?php if ($social_sidebar_position == 'aps-icon-sidebar-rightTop') { ?>selected="selected"<?php } ?>>Right Top</option>
                                                    <option value="aps-icon-sidebar-rightMiddle" <?php if ($social_sidebar_position == 'aps-icon-sidebar-rightMiddle') { ?>selected="selected"<?php } ?>>Right Middle</option>
                                                    <option value="aps-icon-sidebar-rightBottom" <?php if ($social_sidebar_position == 'aps-icon-sidebar-rightBottom') { ?>selected="selected"<?php } ?>>Right Bottom</option>
                                                </select>
                                            </div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>

                                </div>
                                <div class="aps-row">
                                    
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Social Sidebar Attachment', US_TD); ?></label>
                                            <div class="aps-field">
                                                <select name="social_sidebar_attachment" class="aps-form-control" id="aps-sidebar-attachment-select">
                                                    <option value="fixed" <?php if ($social_sidebar_attachment == 'fixed') { ?>selected="selected"<?php } ?>><?php _e('Fixed', US_TD); ?></option>
                                                    <option value="absolute" <?php if ($social_sidebar_attachment == 'absolute') { ?>selected="selected"<?php } ?>><?php _e('Absolute', US_TD); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Half Hidden', US_TD); ?></label>
                                            <div class="aps-field">
                                                <select name="half_hidden" class="aps-form-control" id="aps-sidebar-hidden-select">
                                                    <option value="yes" <?php if (isset($social_sidebar_settings['half_hidden']) && $social_sidebar_settings['half_hidden'] == 'yes') { ?>selected="selected"<?php } ?>><?php _e('Yes', US_TD); ?></option>
                                                    <option value="no" <?php if (isset($social_sidebar_settings['half_hidden']) && $social_sidebar_settings['half_hidden'] == 'no') { ?>selected="selected"<?php } ?>><?php _e('No', US_TD); ?></option>
                                                </select>
                                            </div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>
                                </div>

                                <div class="aps-row">
                                    

                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Display sidebar in: ', US_TD); ?></label>
                                            <div class="aps-field">
                                                <select name="display_sidebar" class="aps-form-control">
                                                    <option value="all" <?php echo (isset($social_sidebar_settings['display_sidebar']) && $social_sidebar_settings['display_sidebar']=='all')?'selected="selected"':'';?>><?php _e('All Pages', US_TD); ?></option>
                                                    <option value="home" <?php echo (isset($social_sidebar_settings['display_sidebar']) && $social_sidebar_settings['display_sidebar']=='home')?'selected="selected"':'';?>><?php _e('Only on home page', US_TD); ?></option>
                                                    <option value="except_home" <?php echo (isset($social_sidebar_settings['display_sidebar']) && $social_sidebar_settings['display_sidebar']=='except_home')?'selected="selected"':'';?>><?php _e('Except home page', US_TD); ?></option>
                                                </select>
                                            </div>
                                        </div><!--aps-field-wrapper form-field-->
                                    </div>
                                    <div class="aps-col-half">
                                        <div class="aps-field-wrapper form-field">
                                            <label><?php _e('Icons Hover Animation', US_TD); ?></label>
                                            <div class="aps-field">
                                                <select name="icon_animation" class="aps-form-control" id="aps-sidebar-icon-animation">
                                                    <option value=""><?php _e('No Animation', US_TD); ?></option>
                                                    <?php
                                                    $animation_array = array(
                                                        'Attention Seekers' => array('bounce', 'flash', 'pulse', 'shake', 'swing', 'tada'),
                                                        'Bouncing Entrances' => array('bounceIn'),
                                                        'Fading Entrances' => array('fadeIn', 'fadeInDown', 'fadeInUp'),
                                                        'Flippers' => array('flip', 'flipInX', 'flipInY'),
                                                        'Zoom Entrances' => array('zoomIn')
                                                    );
                                                    foreach ($animation_array as $animation_group => $animations) {
                                                        ?>
                                                        <optgroup label="<?php echo $animation_group; ?>">
                                                            <?php foreach ($animations as $animation) {
                                                                ?>
                                                                <option value="<?php echo $animation ?>" <?php echo ($icon_animation == $animation) ? 'selected="selected"' : ''; ?>><?php echo $animation ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </optgroup>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div><!--aps-field-wrapper-->
                                    </div>
                                </div>
                                <div class="aps-field-wrapper form-field">
                                    <div class="aps-field">
                                        <input type="submit" class="button button-primary" name="social_sidebar_submit" value="Save Changes"/>
                                        <?php wp_nonce_field('aps_social_sidebar_action', 'aps_social_sidebar_nonce'); ?>
                                    </div>
                                </div><!--aps-field-wrapper form-field-->

                            </div>
                            <div class="aps-col-half">
                                <label><?php _e('Preview: ', US_TD); ?></label>
                                <div class="aps-sidebar-preview-box">
                                    <div class="aps-sidebar-preview-wrap ">
                                        <div id="aps-sidebar-icon-preview" class="aps-sidebar-icon-preview aps-icon-sidebar <?php echo $position . ' ' . $attachment . ' ' . $hidden; ?>">
                                            <?php
                                            if (isset($social_sidebar_settings['icon_set_id']) && $social_sidebar_settings['icon_set_id']!='') {
                                                $icon_set_id = $social_sidebar_settings['icon_set_id'];
                                                US_Social_icons_class::build_sidebar_icon_set($icon_set_id, $icon_margin, $icon_animation);
                                            }
                                            ?>        
                                        </div>                            
                                        <div class="aps-sidebar-preview-inner">
                                            <?php include('dummy-content.php'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>       
    </div>
</div><!--extra div due to panel body div opened in panel-head.php -->
