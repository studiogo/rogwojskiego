<?php
/**
 * [action] => aps_social_sidebar_action
    [social_sidebar] => 1
    [icon_set_id] => 
    [set_display_type] => direct_display
    [set_display_trigger] => hover
    [set_display_direction] => horizontal
    [set_display_animation] => 
    [social_sidebar_position] => left-bottom
    [social_sidebar_attachment] => absolute
    [half_hidden] => yes
    [display_sidebar] => all
    [social_sidebar_submit] => Save Changes
    **/
$posted_array = array_map('sanitize_text_field',$_POST);
//$this->print_array($posted_array);die();
foreach($posted_array as $key=>$val)
{
    $$key = $val;
}
$aps_social_sidebar_option = array();
$aps_social_sidebar_option['social_sidebar'] = (isset($social_sidebar))?1:0;
$aps_social_sidebar_option['icon_set_id'] = $icon_set_id;
$aps_social_sidebar_option['icon_margin'] = $icon_margin;
$aps_social_sidebar_option['half_hidden'] = $half_hidden;
$aps_social_sidebar_option['social_sidebar_position'] = $social_sidebar_position;
$aps_social_sidebar_option['social_sidebar_attachment'] = $social_sidebar_attachment;
$aps_social_sidebar_option['animation'] = $icon_animation;
$aps_social_sidebar_option['display_sidebar'] = $display_sidebar;
update_option('aps_social_sidebar',$aps_social_sidebar_option);
$_SESSION['aps_message'] = __('Social Sidebar Settings Saved Successfully');
wp_redirect(admin_url('admin.php?page=us-social-icons&sub_page=social_sidebar'));
exit;


