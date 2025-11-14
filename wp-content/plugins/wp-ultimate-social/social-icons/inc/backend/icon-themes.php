
<div class="aps-theme-chooser" style="display: none;">
    <div class="aps-field-wrapper">
        <div class="aps-png-themes">
            <h3><?php _e('PNG Icon Themes', US_TD); ?></h3>
            <div class="aps-well">
                <div>
                    <?php for ($i = 1; $i <= 16; $i++) {
                        ?>
                        <label><input type="radio" id="aps-theme-<?php echo $i; ?>" value="<?php echo $i; ?>" class="aps-theme aps-png-theme" name="aps_icon_theme" <?php if (isset($_GET['action']) && $icon_extra['icon_set_type'] == 2 && $icon_extra['icon_theme_type']=='png' && $icon_extra['icon_theme_id'] == $i) { ?>checked="checked"<?php } ?>/>Theme <?php echo $i; ?></label>
                        <div class="aps-theme-previewbox">
                            <img src="<?php echo APS_PRO_IMAGE_DIR . '/preview/png/preview'.$i.'.jpg' ?>" alt="theme preview" />
                        </div>
                        <?php
                    }
                    ?>
                    
                </div>
            </div>
        </div>
        <div class="aps-svg-themes">
            <h3><?php _e('SVG Icon Themes (Retina Ready)', US_TD); ?></h3>
            <p class="aps-note"><?php _e('Note: Height and width won\'t effect the svg icons quality',US_TD);?></p>
            <div class="aps-well">
                <div>
                    <?php for($i = 1;$i<=14;$i++){
                        ?>
                            <label><input type="radio" value="<?php echo $i;?>"  name="aps_icon_theme" class="aps-theme aps-svg-theme" <?php if (isset($_GET['action']) && $icon_extra['icon_set_type'] == 2 && $icon_extra['icon_theme_type']=='svg' && $icon_extra['icon_theme_id'] == $i) { ?>checked="checked"<?php } ?>/>Theme <?php echo $i;?></label>
                            <div class="aps-theme-previewbox">
                            <img src="<?php echo APS_PRO_IMAGE_DIR . '/preview/svg/preview'.$i.'.svg' ?>" alt="theme preview" />
                        </div>
                            <?php 
                    }
?>
                    
                   
                </div>
            </div>
        </div>
    </div>
</div>