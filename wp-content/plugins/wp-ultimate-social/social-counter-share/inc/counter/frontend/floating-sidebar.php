<?php
$apsc_settings = $this->apsc_settings;
$floating_sidebar = $apsc_settings['floating_sidebar'];
if (isset($floating_sidebar['show']) && $floating_sidebar['active'] == 1) {
    $counter_format = $apsc_settings['sidebar_counter_format'];
    if(isset($apsc_settings['floatbar_profiles']) && $apsc_settings['floatbar_profiles']!=''){
        $floatbar_profiles = strtolower($apsc_settings['floatbar_profiles']);
        $floatbar_profiles = str_replace(' ','',$floatbar_profiles);
        $floatbar_profiles = str_replace('googleplus','googlePlus',$floatbar_profiles);
        $apsc_settings['profile_order'] = explode(',',$floatbar_profiles);

        if(isset($apsc_settings['hide_count']) && $apsc_settings['hide_count'] == '1'){
            $hide_count = 1;
        }else{
            $hide_count = 0;
        }
    }
    ?>
    <div class="apsc-floating-sidebar apsc-sidebar-<?php echo $floating_sidebar['theme']; ?> apsc-sidebar-<?php echo $apsc_settings['floating_sidebar']['position'];?><?php if( isset($floating_sidebar['semi_transparent']) && $floating_sidebar['semi_transparent'] =='1' ){ ?> apsc-semi-transparent <?php } ?>">
        <?php
        $total_count = 0;
        foreach ($apsc_settings['profile_order'] as $social_profile) {
            if (isset($apsc_settings['social_profile'][$social_profile]['active']) && $apsc_settings['social_profile'][$social_profile]['active'] == 1) {
                $profile_count = $this->get_count($social_profile);
                $total_count = $total_count + $profile_count;
                $count = $this->get_formatted_count($profile_count, $counter_format);
                
                ?>
                <div class="apsc-each-profile <?php if($hide_count=='1'){ echo "apsc-hide-count"; } ?>">
                    <?php
                    switch ($social_profile) {
                        case 'facebook':
                            $facebook_page_id = $apsc_settings['social_profile']['facebook']['page_id'];
                            ?>
                            <a  class="apsc-facebook-icon clearfix" href="<?php echo "http://facebook.com/" . $facebook_page_id; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="fa fa-facebook apsc-facebook"></i><span class="media-name"><?php echo _e('Facebook', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Fans', APSC_TD ); ?> </span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'twitter':
                            
                            ?>
                            <a  class="apsc-twitter-icon clearfix"  href="<?php echo 'http://twitter.com/' . $apsc_settings['social_profile']['twitter']['username']; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="fa fa-twitter apsc-twitter"></i><span class="media-name"><?php echo _e( 'Twitter', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        case 'googlePlus':
                            $social_profile_url = 'https://plus.google.com/' . $apsc_settings['social_profile']['googlePlus']['page_id'];
                            
                            ?>
                            <a  class="apsc-google-plus-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block"><span class="social-icon">
                                    <i class="apsc-googlePlus fa fa-google-plus"></i><span class="media-name"><?php _e('google+', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php _e('Followers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        case 'instagram':
                            $username = $apsc_settings['social_profile']['instagram']['username'];
                            $social_profile_url = 'https://instagram.com/' . $username;
                            ?>
                            <a  class="apsc-instagram-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block"><span class="social-icon"><i class="apsc-instagram fa fa-instagram"></i><span class="media-name"><?php _e('Instagram', APSC_TD ); ?></span></span>                
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e( 'Followers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'youtube':
                            $social_profile_url = esc_url($apsc_settings['social_profile']['youtube']['channel_url']);
                            ?>
                            <a class="apsc-youtube-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-youtube fa fa-youtube"></i><span class="media-name"><?php echo _e( 'Youtube', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e( 'Subscribers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        case 'soundcloud':
                            $username = $apsc_settings['social_profile']['soundcloud']['username'];
                            $social_profile_url = 'https://soundcloud.com/' . $username;
                            ?>
                            <a class="apsc-soundcloud-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-soundcloud fa fa-soundcloud"></i><span class="media-name"><?php echo _e( 'Soundcloud', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type">Followers</span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        case 'dribbble':
                            $social_profile_url = 'http://dribbble.com/' . $apsc_settings['social_profile']['dribbble']['username'];
                            ?>
                            <a class="apsc-dribble-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-dribbble fa fa-dribbble"></i><span class="media-name"><?php echo _e('dribble', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Followers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        case 'steam':
                            $profile_url = 'http://steamcommunity.com/groups/' . $apsc_settings['social_profile']['steam']['group_name'];
                            ?>
                            <a class="apsc-edit-icon clearfix" href="<?php echo $profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-steam fa fa-steam"></i><span class="media-name"><?php echo _e('Steam', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Members', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        case 'vimeo':
                            $username = $apsc_settings['social_profile']['vimeo']['username'];
                            $social_profile_url = 'https://vimeo.com/' . $username;
                            ?>
                            <a class="apsc-vimeo-icon clearfix" href="<?php echo $social_profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-vimeo fa fa-vimeo-square"></i><span class="media-name"><?php echo _e('Vimeo', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Subscribers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        case 'pinterest':
                            $profile_url = $apsc_settings['social_profile']['pinterest']['profile_url'];
                            ?>
                            <a class="apsc-pinterest-icon clearfix" href="<?php echo $profile_url; ?>" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-pinterest fa fa-pinterest-square"></i><span class="media-name"><?php echo _e( 'Pinterest', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e( 'Subscribers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'forrst':
                            $forrst_username = $apsc_settings['social_profile']['forrst']['username'];
                            $forrst_url = 'https://forrst.com/people/' . $forrst_username;
                            ?>
                            <a href="<?php echo $forrst_url ?>" class="apsc-forrst-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="akfa-forrst apsc-forrst fa fa-forrst"></i><span class="media-name"><?php echo _e('Forrst', APSC_TD); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Followers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'vk':
                            $group_id = $apsc_settings['social_profile']['vk']['group_id'];
                            $vk_url = 'http://vk.com/' . $group_id;
                            ?>
                            <a href="<?php echo $vk_url ?>" class="apsc-vk-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-vk fa fa-vk"></i><span class="media-name"><?php echo _e('VK', APSC_TD); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Followers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'flickr':
                            $flickr_group_id = $apsc_settings['social_profile']['flickr']['group_id'];
                            $flickr_group_url = 'https://www.flickr.com/groups/' . $flickr_group_id;
                            ?>
                            <a href="<?php echo $flickr_group_url ?>" class="apsc-flickr-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-flickr fa fa-flickr"></i><span class="media-name"><?php echo _e('Flickr', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Members', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'behance':
                            $behance_username = $apsc_settings['social_profile']['behance']['username'];
                            $behance_url = 'https://www.behance.net/' . $behance_username;
                            ?>
                            <a href="<?php echo $behance_url ?>" class="apsc-behance-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-behance fa fa-behance"></i><span class="media-name"><?php echo _e('Behance', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Members', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'github':
                            $git_username = $apsc_settings['social_profile']['github']['username'];
                            $git_url = 'https://github.com/' . $git_username;
                            ?>
                            <a href="<?php echo $git_url ?>" class="apsc-behance-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-github fa fa-github"></i><span class="media-name"><?php echo _e('Github', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Followers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;
                        case 'envato':
                            $envato_profile_url = $apsc_settings['social_profile']['envato']['profile_url'];
                            ?>
                            <a href="<?php echo $envato_profile_url ?>" class="apsc-envato-icon clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="akfa-envato apsc-envato fa fa-envato"></i><span class="media-name"><?php echo _e('Envato', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Followers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;

                        case 'linkedin':
                            $linkedin_profile_url = $apsc_settings['social_profile']['linkedin']['profile_url'];
                            $linkedin_counter_type = $apsc_settings['social_profile']['linkedin']['linkedin_counter_type'];
                            if($linkedin_counter_type == 'followers'){
                                $linkedin_counter_type = __( 'Followers', APSC_TD );
                                $linkedin_counter_label = __( 'Follows', APSC_TD );
                            }else if($linkedin_counter_type == 'connections'){
                                $linkedin_counter_type = __( 'Connections', APSC_TD );
                                $linkedin_counter_label = __( 'Connect', APSC_TD );
                            }
                            ?>
                            <a href="<?php echo $linkedin_profile_url ?>" class="apsc-linkedin-icon apsc-icon-soc clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon">
                                        <i class="apsc-linkedin fa fa-linkedin"></i>
                                        <span class="media-name"><?php echo _e('LinkedIn', APSC_TD ); ?></span>
                                    </span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span>
                                    <span class="apsc-media-type"><?php echo $linkedin_counter_type; ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <?php
                            break;

                        case 'rss':
                            $rss_url = $apsc_settings['social_profile']['rss']['rss_url'];
                            ?>
                            <a href="<?php echo $rss_url ?>" class="apsc-rss-icon apsc-icon-soc clearfix" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><span class="apsc-fa-icon"><i class="apsc-rss fa fa-rss"></i></span><span class="media-name"><span class="apsc-social-name"><?php echo _e('rss', APSC_TD ); ?></span></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Subscribers', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a>
                            <a class="apsc-bttn-bg" href="<?php echo $rss_url ?>" target="_blank"><div class="apsc_bttn"><?php echo _e('Subscribe', APSC_TD ); ?></div></a>
                            <?php
                            break;
                           
                        case 'posts':
                            ?>
                            <a class="apsc-edit-icon clearfix" href="javascript:void(0);" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-posts fa fa-edit"></i><span class="media-name"><?php echo _e('Post', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Posts', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        case 'comments':
                            ?>
                    <a class="apsc-comment-icon clearfix" href="javascript:void(0);" target="_blank">
                                <div class="apsc-inner-block">
                                    <span class="social-icon"><i class="apsc-comments fa fa-comments"></i><span class="media-name"><?php echo _e('Comment', APSC_TD ); ?></span></span>
                                    <?php if( $hide_count!='1' ){ ?>
                                    <span class="apsc-count"><?php echo $count; ?></span><span class="apsc-media-type"><?php echo _e('Comments', APSC_TD ); ?></span>
                                    <?php } ?>
                                </div>
                            </a><?php
                            break;
                        default:
                            break;
                    }
                    ?>
                </div><?php
            }
        }
        if (isset($apsc_settings['total_count']) && $apsc_settings['total_count'] == 1) {
        ?>
        <?php if( $hide_count!='1' ){ ?>
        <div class="apsc-each-profile">
            <a href="javascript:void(0)" class="apsc-total-icon apsc-icon-soc clearfix" target="_blank">
                <div class="apsc-inner-block">
                    <span class="social-icon"><span class="apsc-fa-icon"><span class="apsc-total-text"><?php echo _e('Total', APSC_TD ); ?></span></span><span class="media-name"><span class="apsc-social-name"><?php echo _e('Total', APSC_TD ); ?></span></span></span>
                    <span class="apsc-count"><?php echo $this->get_formatted_count($total_count, $apsc_settings['counter_format']); ?></span><span class="apsc-media-type"></span>
                </div>
            </a>
        </div>
        <?php } ?>
        <?php
        }

        if(isset($apsc_settings['floating_sidebar']['hover_color']) && $apsc_settings['floating_sidebar']['hover_color']!=''){
            ?>
        <style>
            .apsc-floating-sidebar .apsc-each-profile a:hover{background:<?php echo $apsc_settings['floating_sidebar']['hover_color'];?> !important;}
        </style>
                <?php
        }
        ?>
            <div class='apsc-floating-bar-show-hide'></div>
    </div>

    <?php
}

