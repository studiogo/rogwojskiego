(function ($) {
    $(function () {
//all backend js goes here

//For uploading icon image
        $('#ap-icon-upload-button').click(function () {
            $(this).closest('.aps-field-wrapper').find('.aps-error').html('');
            formfield = jQuery('#aps-icon-image').attr('name');
            tb_show('', 'media-upload.php?type=image&TB_iframe=true');
            return false;
        });
        window.send_to_editor = function (html) {
            imgurl = jQuery('img', html).attr('src');
            jQuery('#aps-icon-image').val(imgurl);
            jQuery('.aps-image-icon-preview').html('<img src="' + imgurl + '"/>');
            tb_remove();
        }

//Adding icon to list 
        $('#aps-icon-add-trigger').click(function () {
            error_flag = 0;
            if ($('#aps-icon-title').val() == '')
            {
                error_flag = 1;
                var error_html = $('#aps-icon-title').attr('data-error-msg');
                $('#aps-icon-title').closest('.aps-field-wrapper').find('.aps-error').html(error_html);
            }
            if ($('#aps-icon-link').val() == '')
            {
                error_flag = 1;
                var error_html = $('#aps-icon-link').attr('data-error-msg');
                $('#aps-icon-link').closest('.aps-field-wrapper').find('.aps-error').html(error_html);
            }
            if ($('#aps-icon-type').val() == 'image-icons' && $('#aps-icon-image').val() == '')
            {
                error_flag = 1;
                var error_html = $('#aps-icon-image').attr('data-error-msg');
                $('#aps-icon-image').closest('.aps-field-wrapper').find('.aps-error').html(error_html);
            }

            if ($('#aps-icon-type').val() == 'font-awesome' && $('#aps-font-awesome-icon').val() == '')
            {
                error_flag = 1;
                var error_html = $('#aps-font-awesome-icon').attr('data-error-msg');
                $('#aps-font-awesome-icon').closest('.aps-field-wrapper').find('.aps-error').html(error_html);
            }



            if (error_flag == 0)
            {
                var icon_counter = $('#aps-icon-counter').val();
                icon_counter++;
                $('#aps-icon-counter').val(icon_counter);
                var icon_title = $('#aps-icon-title').val();
                var icon_type = $('#aps-icon-type').val();
                var icon_image = $('#aps-icon-image').val();
                var icon_width = $('#aps-icon-width').val();
                var icon_height = $('#aps-icon-height').val();
                var icon_link = $('#aps-icon-link').val();
                var icon_link_target = $('#aps-icon-link-target').val();
                var icon_tooltip_text = $('#aps-tooltip-text').val();
                var font_icon = $('#aps-font-awesome-icon').val();
                var icon_size = $('#aps-icon-size').val();
                var icon_bg = $('input[name="aps_icon_background"]:checked').val();
                var icon_bg_color = $('#aps-icon-background-color').val();
                var icon_shape = $('input[name="aps_icon_shape"]:checked').val();
                var icon_radius_top_left = $('#radius-top-left').val();
                var icon_radius_top_right = $('#radius-top-right').val();
                var icon_radius_bottom_right = $('#radius-bottom-right').val();
                var icon_radius_bottom_left = $('#radius-bottom-left').val();
                var icon_color = $('#aps-icon-color').val();
                var icon_bg_color_hover = $('#bg-hover-color').val();
                var icon_color_hover = $('#icon-color-hover').val();
                var vertical_padding = $('#aps-vertical-padding').val();
                var horizontal_padding = $('#aps-horizontal-padding').val();
                var border_type = $('#aps-border-type').val();
                var border_spacing = $('#aps-border-spacing').val();
                var border_thickness = $('#aps-border-thickness').val();
                var border_color = $('#aps-border-color').val();
                var shadow = $('input[name="aps-icon-shadow"]:checked').val();
                var shadow_offset_x = $('#aps-shadow-offset-x').val();
                var shadow_offset_y = $('#aps-shadow-offset-y').val();
                var shadow_blur = $('#aps-shadow-blur').val();
                var shadow_color = $('#aps-shadow-color').val();
                var append_html =
                        '<li class="aps-sortable-icons">' +
                        '<div class="aps-drag-icon"></div>' +
                        '<div class="aps-icon-head"><span class="aps-icon-name">' + icon_title + '</span><span class="aps-icon-list-controls"><span class="aps-arrow-down aps-arrow button button-secondary"><i class="dashicons dashicons-arrow-down"></i></span>&nbsp;&nbsp;<span class="aps-delete-icon button button-secondary" aria-label="delete icon"><i class="dashicons dashicons-trash"></i></span></span></div>' +
                        '<div class="aps-icon-body" style="display: none;">' +
                        '<div class="aps-icon-preview">' +
                        '<label>' + aps_script_variable.icon_preview + '</label>';
                if (icon_type === 'image-icons')
                {
                    append_html += $('.aps-image-icon-preview').html(); //'<img src="' + icon_image + '"/>';
                }
                else
                {
                    apsFontIconReference++;
                    append_html += '<i class="' + font_icon + '" id="aps-font-icon-' + apsFontIconReference + '"></i>';
                }


                append_html += '</div>' +
                        '<div class="aps-icon-detail-wrapper">' +
                        '<div class="aps-icon-each-detail">' +
                        '<label>' + aps_script_variable.icon_link + '</label>' +
                        '<div class="aps-icon-detail-text">' + icon_link + '</div>' +
                        '</div>' +
                        '<div class="aps-icon-each-detail">' +
                        '<label>' + aps_script_variable.icon_link_target + '</label>' +
                        '<div class="aps-icon-detail-text">' + icon_link_target + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<input type="hidden" name="icons[' + icon_title + '][title]" value="' + icon_title + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_type]" value="' + icon_type + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][image]" value="' + icon_image + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_width]" value="' + icon_width + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_height]" value="' + icon_height + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][link]" value="' + icon_link + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][link_target]" value="' + icon_link_target + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][tooltip_text]" value="' + icon_tooltip_text + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][font_icon]" value="' + font_icon + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_size]" value="' + icon_size + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_bg]" value="' + icon_bg + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_bg_color]" value="' + icon_bg_color + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_shape]" value="' + icon_shape + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][radius_top_left]" value="' + icon_radius_top_left + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][radius_top_right]" value="' + icon_radius_top_right + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][radius_bottom_left]" value="' + icon_radius_bottom_left + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][radius_bottom_right]" value="' + icon_radius_bottom_right + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_color]" value="' + icon_color + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_bg_color_hover]" value="' + icon_bg_color_hover + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_color_hover]" value="' + icon_color_hover + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_vertical_padding]" value="' + vertical_padding + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][icon_horizontal_padding]" value="' + horizontal_padding + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][border_type]" value="' + border_type + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][border_spacing]" value="' + border_spacing + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][border_thickness]" value="' + border_thickness + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][border_color]" value="' + border_color + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][shadow]" value="' + shadow + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][shadow_offset_x]" value="' + shadow_offset_x + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][shadow_offset_y]" value="' + shadow_offset_y + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][shadow_blur]" value="' + shadow_blur + '"/>' +
                        '<input type="hidden" name="icons[' + icon_title + '][shadow_color]" value="' + shadow_color + '"/>' +
                        '</li>';
                //alert(append_html);
                $('.aps-icon-list').append(append_html);
                $('.aps-icon-adder input[type="text"]').each(function () {
                    $(this).val('');
                });
                append_style('aps-font-icon-' + apsFontIconReference);
                reset_styles();
                $('.aps-font-icon-preview').html('Icon Preview');
                $('.aps-image-icon-preview').html('Icon Preview');
            }
        });
        $('.aps-icon-adder input').keyup(function () {
            $(this).closest('.aps-field-wrapper').find('.aps-error').html('');
        });
        $('.aps-icon-list').on('click', '.aps-icon-head', function (e) {
            if ($(this).parent().find('.aps-arrow i').hasClass('dashicons-arrow-down'))
            {
                $(this).parent().find('i.dashicons-arrow-down').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
            }
            else
            {
                $(this).parent().find('i.dashicons-arrow-up').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
            }
            $(this).closest('.aps-sortable-icons').find('.aps-icon-body').slideToggle(500);
            //e.stopPropagation();
        });
        $('.aps-icon-list').on('click', '.aps-delete-icon', function () {
            if (confirm(aps_script_variable.icon_delete_confirm))
            {
                var icon_counter = $('#aps-icon-counter').val();
                icon_counter--;
                $('#aps-icon-counter').val(icon_counter);
                var selector = $(this);
                $(this).closest('.aps-sortable-icons').fadeOut(800, function () {
                    selector.closest('.aps-sortable-icons').remove();
                });
                return false;
            }
        });
        //sortable initialization
        $('.aps-icon-list').sortable({containment: "parent"});
        $('#aps_icon_set_submit').click(function () {
            var error_flag = 0;
            if ($('input[name="set_name"]').val() == '')
            {
                error_flag = 1;
                $('input[name="set_name"]').closest('.aps-field-wrapper').find('.aps-error').html(aps_script_variable.set_name_required_message);
            }
            if ($('#aps-icon-counter').val() <= 0)
            {
                error_flag = 1;
                $(this).parent().find('.aps-main-error').html(aps_script_variable.min_icon_required_message)
            }
            if (error_flag == 1)
            {
                return false;
            }
            else
            {
                return true;
            }
        });
        //icon select switcher
        $('#aps-icon-type').change(function () {
            if ($(this).val() == 'font-awesome')
            {
                $('.aps-font-icon-preview').show();
                $('.aps-image-icon-preview').hide();
                $('.aps-font-awesome-icon').show();
                $('.aps-image-icon').hide();
                $('.aps-image-icon-reference').hide();
            }
            else
            {
                $('.aps-font-icon-preview').hide();
                $('.aps-image-icon-preview').show();
                $('.aps-font-awesome-icon').hide();
                $('.aps-image-icon').show();
                $('.aps-image-icon-reference').show();
            }
        });
        //Pre available icon selector
        $('#aps-icon-chooser').click(function () {
            var inner_html = $.trim($('.aps-pre-available-icons').html());
            if (inner_html == '')
            {
                $('#aps-icon-loader').show();
                $.ajax({
                    url: aps_script_variable.ajax_url,
                    type: 'post',
                    data: 'action=aps_icon_list_action&_wpnonce=' + aps_script_variable.ajax_nonce,
                    success: function (res)
                    {
                        var html = '<div class="aps-lightbox">\
                        <div class="aps-lightbox-inner-wrap">\
                        <div class="aps-lightbox-inner-content">\
                        <div class="aps-icon-set-filter-wrap"><label>\
                        <label>Filter Set</label>\
                        <select id="aps-icon-set-filter">\
                        <option value="">All</option>\n\
                        <optgroup label="PNG Icon Sets">';
                        var i;
                        for (i = 1; i <= 12; i++)
                        {
                            html += '<option value="' + i + '-png">Set ' + i + '</option>';
                        }
                        html += '</optgroup><optgroup label="SVG Icon Sets">';
                        for (i = 1; i <= 10; i++) {
                            html += '<option value="' + i + '-svg">Set ' + i + '</option>';
                        }
                        html = html + '</optgroup></select></div>\
                        <a href = "javascript:void(0)" class = "aps-close-font aps-close-pre" aria - label = "font close button"> <span class = "dashicons dashicons-no-alt"> </span></a> <div class = "aps-icon-preview-wrap"> ' + res + ' </div></div> </div>';
                        $('.aps-pre-available-icons').show().html(html);
                        $('#aps-icon-loader').hide();
                    }
                });
            }
            else
            {
                $('.aps-pre-available-icons').show();
            }

        });
        //pre available icons wrapper close
        $('.aps-pre-available-icons').on('click', '.aps-close-pre', function () {
            $('.aps-pre-available-icons').fadeOut(500);
        });
        $('.aps-pre-available-icons').on('click', '.aps-set-image-wrapper', function () {
            var src = $(this).find('img').attr('src');
            $('#aps-icon-image').val(src);
            $('.aps-image-icon-preview').html('<img src="' + src + '"/>');
            $('.aps-pre-available-icons').fadeOut(500);
        });
        $('#aps-icon-color').wpColorPicker({
            change: function (event, ui) {
                apsIconColor = ui.color.toString();
                addStyle();
            }
        });
        //font awesome icons chooser
        $('#aps-font-icon-chooser').click(function () {
            $('.aps-font-awesome-icons').show();
        });
        //fontawesome icon chooser close
        $('.aps-close-font').click(function () {
            $('.aps-font-awesome-icons').hide();
        });
        $('.fontawesome-icon-list a').click(function (e) {
            e.preventDefault();
            var attr_class = $(this).find('i').attr('class').replace('fa-3x', '');
            var append_html = '<i class="' + attr_class + '"></i>';
            $('.aps-font-icon-preview').html(append_html);
            $('#aps-font-awesome-icon').val(attr_class);
            $('.aps-font-awesome-icons').hide();
        });
        $('.aps-color-picker').wpColorPicker();
        $('#aps-icon-background-color').wpColorPicker({
            change: function (event, ui) {
                apsBgColor = ui.color.toString();
                addStyle();
            }
        });
        $('#bg-hover-color').wpColorPicker({
            change: function (event, ui) {
                apsBgColorHover = ui.color.toString();
                addStyle();
            }
        });
        $('#icon-color-hover').wpColorPicker({
            change: function (event, ui) {
                apsIconColorHover = ui.color.toString();
                addStyle();
            }
        });
        $('input.aps-icon-background').click(function () {
            if ($(this).val() == 1) {
                $('#aps-bg-color-pickers').show();
                $('.icon-background-reference').show();
                if ($('input[name="aps_icon_shape"]:checked').val() === 'rounded_corner')
                {
                    $('.border-radius-reference').show();
                }
            } else {
                $('.border-radius-reference').hide();
                $('#aps-bg-color-pickers').hide();
                $('.icon-background-reference').hide();
            }
        });
        //tooltip reference fields show hide
        $('input[name="tooltip"]').click(function () {
            if ($(this).val() == 0)
            {
                $('.aps-tooltip-options').hide();
            }
            else
            {
                $('.aps-tooltip-options').show();
            }
        });
        //tooltip refernce show hide on document.ready
        if ($('input[name="tooltip"]').length > 0) {
            if ($('input[name="tooltip"]:checked').val() == 0)
            {
                $('.aps-tooltip-reference').hide();
            }
            else
            {
                $('.aps-tooltip-reference').show();
            }
        }

//border radius show or hide
        $('.aps-icon-shape').click(function () {
            if ($(this).val() == 'rounded_corner')
            {
                $('.border-radius-reference').show();
            }
            else
            {
                $('.border-radius-reference').hide();
            }
        });
        if ($('.aps-icon-shape').length > 0)
        {
            if ($('.aps-icon-shape:checked').val() == 'rounded_corner')
            {
                $('.border-radius-reference').show();
            }
            else
            {
                $('.border-radius-reference').hide();
            }
        }

//Number of rows show hide
        $('input[name="display"]').click(function () {
            if ($(this).val() == 'horizontal')
            {
                $('.display-horizontal-reference').show();
                $('.display-vertical-reference').hide();
            }
            else
            {
                $('.display-horizontal-reference').hide();
                $('.display-vertical-reference').show();
            }
        });
        if ($('input[name="display"]').length > 0)
        {
            if ($('input[name="display"]:checked').val() == 'horizontal')
            {
                $('.display-horizontal-reference').show();
                $('.display-vertical-reference').hide();
            }
            else
            {
                $('.display-horizontal-reference').hide();
                $('.display-vertical-reference').show();
            }
        }
        $('input[name="icon_set_type"]').click(function () {
            var pre_set_type = $('#aps-icon-group-type').val();
            if (pre_set_type != $(this).val())
            {
                if ($('.aps-icon-list li').length > 0)
                {
                    if (confirm('Are you sure you want to discard the icons added previously?'))
                    {
                        $('.aps-icon-list').html('');
                        $('.aps-empty-icon-note').show();
                        $('.aps-icon-note').hide();
                        if ($(this).val() == 1)
                        {
                            $('.aps-theme-chooser').hide();
                            $('.aps-icon-adder').show();
                        }
                        else
                        {
                            $('.aps-theme-chooser .aps-theme').removeAttr('checked');
                            $('.aps-theme-chooser').show();
                            $('.aps-icon-adder').hide();
                        }
                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    if ($(this).val() == 1)
                    {
                        $('.aps-theme-chooser').hide();
                        $('.aps-icon-adder').show();
                    }
                    else
                    {
                        $('.aps-theme-chooser .aps-theme').removeAttr('checked');
                        $('.aps-theme-chooser').show();
                        $('.aps-icon-adder').hide();
                    }
                }
                $('#aps-icon-group-type').val($(this).val());
            }
            else
            {
                return false;
            }

        });
        $('.aps-theme').change(function () {
            $('.aps-icon-loader').show();
            var icons_length = $('.aps-icon-list-wrapper li').length;
            if ($(this).hasClass('aps-svg-theme'))
            {
                var sub_folder = 'svg';
            }
            else
            {
                var sub_folder = 'png';
            }
            var src_only = (icons_length == 20) ? 'yes' : 'no';
            var folder = $(this).val();
            $('#icon_theme_type').val(sub_folder);
            $('#icon_theme_id').val(folder);
            $.ajax({
                type: 'post',
                url: aps_script_variable.ajax_url,
                data: 'sub_folder=' + sub_folder + '&folder=set' + folder + '&_wpnonce=' + aps_script_variable.ajax_nonce + '&action=get_theme_icons&src_only=' + src_only,
                success: function (res)
                {

                    if (src_only == 'yes')
                    {
                        var image_array = $.parseJSON(res);
                        var image_name;
                        for(image_name in image_array)
                        {
                            $('img[data-image-name="'+image_name+'"]').attr('src',image_array[image_name]);
                            $('input[data-image-name="'+image_name+'"]').attr('value',image_array[image_name]);
                        }
//                        $('.aps-icon-preview img').each(function () {
//                            $(this).attr('src', image_array[array_reference]);
//                            array_reference++;
//                        });
//                        var array_reference = 0;
//                        $('.set_image_reference').each(function () {
//                            $(this).val(image_array[array_reference]);
//                            array_reference++;
//                        });
                    }
                    else
                    {
                        $('.aps-icon-list').html(res);
                        $('.aps-icon-list .aps-icon-note').appendTo('.aps-icon-list-wrapper');
                        var total_icons = $('.aps-icon-list li').length;
                        $('#aps-icon-counter').val(total_icons);
                        $('.aps-color-picker').wpColorPicker();
                    }
                    $('.aps-icon-loader').hide();
                    $('.aps-empty-icon-note').hide();
                    $('.aps-icon-note').show();
                }
            });
        });
        if ($('input[name="icon_set_type"]').length > 0)
        {
            if ($('input[name="icon_set_type"]:checked').val() == 1)
            {
                $('.aps-theme-chooser').hide();
                $('.aps-icon-adder').show();
            }
            if ($('input[name="icon_set_type"]:checked').val() == 2)
            {

                $('.aps-theme-chooser').show();
                $('.aps-icon-adder').hide();
            }

        }

        /*generate preview based on user selections*/
        var apsIconSize = "",
                apsBgColor = "",
                apsBgColorHover = "",
                apsBgShape = "",
                apsBgCircle = "",
                apsIconColor = "",
                apsIconColorHover = "",
                apsIconBorderTL = "",
                apsIconBorderTR = "",
                apsIconBorderBR = "",
                apsIconBorderBL = "",
                apsPaddingVertical = "",
                apsPaddingHorizontal = "",
                apsBorder = "",
                apsShadow = "",
                apsFontIconReference = 0;
        //lists all the id that need to increment on key press up and decrement on key press down
        var
                incrementorIdArray = "#aps-icon-size"; //font-awesome icon size
        incrementorIdArray += ",#aps-border-thickness,#radius-top-left,#radius-top-right,#radius-bottom-left,#radius-bottom-right"; //border-radius
        incrementorIdArray += ",#aps-vertical-padding,#aps-horizontal-padding"; //space inside icons
        incrementorIdArray += ",#aps-shadow-offset-x,#aps-shadow-offset-y,#aps-shadow-blur"; //icon shadow
        incrementorIdArray += ",#aps-icon-width,#aps-icon-height,.aps_theme_icon_width,.aps_theme_icon_height,#aps-border-spacing,#aps-sidebar-icon-margin";
        //adds event to increment value by on if keup is pressed and decrement if kedown is pressed
        $('body').on('keyup', incrementorIdArray, function (e) {
            var keyCode = e.keyCode, temp;
            if (keyCode === 38) {
                temp = $(this).val().replace('px', '');
                ++temp;
                //apsIconSize=temp+"px";
                $(this).val(temp + "px");
            } else if (keyCode === 40) {
                temp = $(this).val().replace('px', '');
                --temp;
                //apsIconSize=temp+"px";
                $(this).val(temp + "px");
            }
        });
        $('.aps-font-awesome-icon').on('keyup', '#aps-icon-size', function (e) {
            apsIconSize = $(this).val();
            addStyle();
        });
        //Border references show hide
        $('#aps-border-type').change(function () {
            var border_type = $(this).val();
            if ($('#aps-icon-type').val() === 'image-icons')
            {
                if ($(this).val() !== 'none')
                {
                    $('.aps-border-refernce').show();
                    var border_thickness = ($('#aps-border-thickness').val() === '') ? '1px' : $('#aps-border-thickness').val();
                    var border_color = ($('#aps-border-color').val() === '') ? '#000' : $('#aps-border-color').val();
                    var border_css = border_thickness + ' ' + border_type + ' ' + border_color;
                    $('.aps-image-icon-preview img').css({
                        'border': border_css
                    });
                }
                else
                {
                    $('.aps-border-refernce').hide();
                    $('.aps-image-icon-preview img').css('border', '');
                }
            }
            else
            {

                if ($(this).val() !== 'none')
                {
                    $('.aps-border-refernce').show();
                    var border_thickness = ($('#aps-border-thickness').val() === '') ? '1px' : $('#aps-border-thickness').val();
                    var border_color = ($('#aps-border-color').val() === '') ? '#000' : $('#aps-border-color').val();
                    var border_css = border_thickness + ' ' + border_type + ' ' + border_color;
                    apsBorder = border_css;
                    addStyle();
                }
                else
                {
                    $('.aps-border-refernce').hide();
                    apsBorder = "";
                    addStyle();
                }
            }

        });

        $('#aps-border-spacing').keyup(function () {
            var padding = $(this).val();
            padding = padding.replace('px', '');
            padding = padding + 'px';
            $('.aps-image-icon-preview img').css('padding', padding);
        });
        //shadow reference
        $('input[name="aps-icon-shadow"]').click(function () {
            if ($(this).val() === 'yes')
            {
                $('.aps-shadow-reference').show();
            }
            else
            {
                $('.aps-shadow-reference').hide();
                $('#aps-shadow-offset-x,#aps-shadow-offset-y,#aps-shadow-blur,#aps-shadow-color').val('');
                $('#aps-shadow-color').closest('.wp-picker-container').find('.wp-color-result').css({'background-color': ''});
                if ($('#aps-icon-type').val() == 'image-icons')
                {
                    $('.aps-image-icon-preview img').css({
                        '-moz-box-shadow': '',
                        '-webkit-box-shadow': '',
                        'box-shadow': ''
                    });
                }
                else
                {
                        apsShadow = '';
                        addStyle();
                }

            }
        });
        //border color wpColorPicker initialization
        $('#aps-border-color').wpColorPicker({
            change: function (event, ui) {
                var border_type = $('#aps-border-type').val();
                var border_thickness = $('#aps-border-thickness').val();
                if (border_type !== 'none')
                {
                    var border_color = ui.color.toString();
                    var border_css = border_thickness + ' ' + border_type + ' ' + border_color;
                    if ($('#aps-icon-type').val() === 'image-icons')
                    {
                        $('.aps-image-icon-preview img').css({
                            'border': border_css
                        });
                    }
                    else
                    {
                        apsBorder = border_css;
                        addStyle();
                    }
                }
            }
        });
        //icon width preview
        $('#aps-icon-width').keyup(function () {
            $('.aps-image-icon-preview img').css({
                'width': $(this).val()
            });
        });
        //border style preview
        $('#aps-icon-height').keyup(function () {
            $('.aps-image-icon-preview img').css({
                'height': $(this).val()
            });
        });
        $('#aps-border-thickness').keyup(function () {
            var border_type = $('#aps-border-type').val();
            var border_thickness = $(this).val();
            if (border_type !== 'none')
            {
                var border_color = ($('#aps-border-color').val() === '') ? '#000' : $('#aps-border-color').val();
                var border_css = border_thickness + ' ' + border_type + ' ' + border_color;
                if ($('#aps-icon-type').val() === 'image-icons')
                {
                    $('.aps-image-icon-preview img').css({
                        'border': border_css
                    });
                }
                else
                {
                    apsBorder = border_css;
                    addStyle();
                }

            }
        });
        //border style preview ends

        //shadow style preview
        $('#aps-shadow-offset-x,#aps-shadow-offset-y,#aps-shadow-blur').keyup(function () {
            var offset_x = ($('#aps-shadow-offset-x').val() === '') ? '0px' : $('#aps-shadow-offset-x').val();
            var offset_y = ($('#aps-shadow-offset-y').val() === '') ? '0px' : $('#aps-shadow-offset-y').val();
            var blur = ($('#aps-shadow-blur').val() === '') ? '1px' : $('#aps-shadow-blur').val();
            var color = $('#aps-shadow-color').val();
            if ($('#aps-icon-type').val() === 'image-icons')
            {
                $('.aps-image-icon-preview img').css({
                    '-moz-box-shadow': offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color,
                    '-webkit-box-shadow': offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color,
                    'box-shadow': offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color
                });
            }
            else
            {
                apsShadow = '-moz-box-shadow:' + offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color + ';';
                apsShadow += '-webkit-box-shadow:' + offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color + ';';
                apsShadow += 'box-shadow:' + offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color + ';';
                console.log(apsShadow);
                addStyle();
            }

        });
        $('#aps-shadow-color').wpColorPicker({
            change: function (event, ui) {
                var offset_x = ($('#aps-shadow-offset-x').val() === '') ? '0px' : $('#aps-shadow-offset-x').val();
                var offset_y = ($('#aps-shadow-offset-y').val() === '') ? '0px' : $('#aps-shadow-offset-y').val();
                var blur = ($('#aps-shadow-blur').val() === '') ? '1px' : $('#aps-shadow-blur').val();
                var color = ui.color.toString();
                if ($('#aps-icon-type').val() === 'image-icons')
                {
                    $('.aps-image-icon-preview img').css({
                        '-moz-box-shadow': offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color,
                        '-webkit-box-shadow': offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color,
                        'box-shadow': offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color
                    });
                }
                else
                {
                    apsShadow = '-moz-box-shadow:' + offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color + ';';
                    apsShadow += '-webkit-box-shadow:' + offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color + ';';
                    apsShadow += 'box-shadow:' + offset_x + ' ' + offset_y + ' ' + blur + ' ' + '0' + ' ' + color + ';';
                    addStyle();
                }

            }
        });
        //shadow style preview ends

        //Icon Background Shape change
        $('.aps-icon-shape').click(function () {
            var shape = $(this).val();
            apsBgShape = shape;
            if (shape === 'circular')
            {
                apsBgCircle = true;
                apsIconBorderTL = "";
                apsIconBorderTR = "";
                apsIconBorderBR = "";
                apsIconBorderBL = "";
            }
            if (shape === 'rounded_corner')
            {
                apsBgCircle = false;
                apsIconBorderTL = $('#radius-top-left').val();
                apsIconBorderTR = $('#radius-top-right').val();
                apsIconBorderBR = $('#radius-bottom-right').val();
                apsIconBorderBL = $('#radius-bottom-left').val();
            }
            if (shape === 'square')
            {
                apsBgCircle = false;
                apsIconBorderTL = "";
                apsIconBorderTR = "";
                apsIconBorderBR = "";
                apsIconBorderBL = "";
            }
            addStyle();
        });
        $('#radius-top-left,#radius-top-right,#radius-bottom-left,#radius-bottom-right').keyup(function () {
            apsIconBorderTL = $('#radius-top-left').val();
            apsIconBorderTR = $('#radius-top-right').val();
            apsIconBorderBR = $('#radius-bottom-right').val();
            apsIconBorderBL = $('#radius-bottom-left').val();
            addStyle();
        });
        $('#aps-vertical-padding,#aps-horizontal-padding').keyup(function () {
            apsPaddingHorizontal = $('#aps-horizontal-padding').val();
            apsPaddingVertical = $('#aps-vertical-padding').val();
            addStyle();
            //console.log(apsPaddingHorizontal+apsPaddingVertical);

        });
        //Theme Icon Height Width Preview
        $('.aps-icon-list ').on('keyup', '.aps_theme_icon_width', function () {
            $(this).closest('.aps-icon-body').find('.aps-icon-preview img').css('width', $(this).val());
        });
        $('.aps-icon-list ').on('keyup', '.aps_theme_icon_height', function () {
            $(this).closest('.aps-icon-body').find('.aps-icon-preview img').css('height', $(this).val());
        });
        //add style placeholder
        apsAddStyles();
        //appends style placeholder in the head for generating preview for the selected icon
        function apsAddStyles() {
            $('<style id="aps-font-preview-style"></style>').appendTo('head');
            $('<style id="aps-icon-list-preview"></style>').appendTo('head');
        }

        //adds style selected
        function addStyle() {
            var fontSize, fontColor, fontHoverColor, fontBgColor, fontBgColorHover, fontShape, verticalPadding, horizontalPadding, padding, border, shadow;
            fontSize = (apsIconSize !== "") ? "font-size:" + apsIconSize + ";" : "";
            fontColor = (apsIconColor !== "") ? "color:" + apsIconColor + ";" : "";
            fontHoverColor = (apsIconColorHover !== "") ? "color:" + apsIconColorHover + ";" : "";
            fontBgColor = (apsBgColor !== "") ? "background:" + apsBgColor + ";" : "";
            fontBgColorHover = (apsBgColorHover !== "") ? "background:" + apsBgColorHover + ";" : "";
            verticalPadding = (apsPaddingVertical === '') ? '5px' : apsPaddingVertical;
            horizontalPadding = (apsPaddingHorizontal === '') ? '5px' : apsPaddingHorizontal;
            padding = "padding:" + verticalPadding + ' ' + horizontalPadding + ';';
            border = (apsBorder !== "") ? "border:" + apsBorder + ';' : "";
            if (apsBgCircle) {
                fontShape = "border-radius:50%;";
            }
            else
            {
                if (apsBgShape === 'rounded_corner')
                {

                    fontShape = "border-radius:" + apsIconBorderTL + " " + apsIconBorderTR + " " + apsIconBorderBR + " " + apsIconBorderBL + ';';
                }
                else
                {
                    fontShape = '';
                }
            }

            //sets style to write on head
            var style = ".aps-font-icon-preview .fa{";
            style += fontSize;
            style += fontColor;
            style += "}";
            style += ".aps-font-icon-preview .fa:hover{";
            style += fontHoverColor;
            style += "}";
            style += ".aps-font-icon-preview .fa:before{";
            style += fontBgColor;
            style += fontShape;
            style += padding;
            style += border;
            style += apsShadow;
            style += "}";
            style += ".aps-font-icon-preview .fa:hover:before{";
            style += fontBgColorHover;
            style += "}";
            $('#aps-font-preview-style').text(style);
        }

        function reset_styles()
        {
            apsIconSize = "",
                    apsBgColor = "",
                    apsBgColorHover = "",
                    apsBgShape = "",
                    apsBgCircle = "",
                    apsIconColor = "",
                    apsIconColorHover = "",
                    apsIconBorderTL = "",
                    apsIconBorderTR = "",
                    apsIconBorderBR = "",
                    apsIconBorderBL = "",
                    apsPaddingVertical = "",
                    apsPaddingHorizontal = "",
                    apsBorder = "",
                    apsShadow = "";
            $('#aps-font-preview-style').html('');
            $('.aps-icon-adder .wp-color-result').css('background', '');
            $('#aps-border-type option').removeAttr('selected');
            $('.aps-icon-shape').removeAttr('checked');
            $('.aps-icon-shape').first().attr('checked', 'checked');
        }

        function append_style(icon_id)
        {
            var fontSize, fontColor, fontHoverColor, fontBgColor, fontBgColorHover, fontShape, verticalPadding, horizontalPadding, padding, border, shadow;
            fontSize = (apsIconSize !== "") ? "font-size:" + apsIconSize + ";" : "";
            fontColor = (apsIconColor !== "") ? "color:" + apsIconColor + ";" : "";
            fontHoverColor = (apsIconColorHover !== "") ? "color:" + apsIconColorHover + ";" : "";
            fontBgColor = (apsBgColor !== "") ? "background:" + apsBgColor + ";" : "";
            fontBgColorHover = (apsBgColorHover !== "") ? "background:" + apsBgColorHover + ";" : "";
            verticalPadding = (apsPaddingVertical === '') ? '5px' : apsPaddingVertical;
            horizontalPadding = (apsPaddingHorizontal === '') ? '5px' : apsPaddingHorizontal;
            padding = "padding:" + verticalPadding + ' ' + horizontalPadding + ';';
            border = (apsBorder !== "") ? "border:" + apsBorder + ';' : "";
            if (apsBgCircle) {
                fontShape = "border-radius:50%;";
            }
            else
            {
                if (apsBgShape === 'rounded_corner')
                {

                    fontShape = "border-radius:" + apsIconBorderTL + " " + apsIconBorderTR + " " + apsIconBorderBR + " " + apsIconBorderBL + ';';
                }
                else
                {
                    fontShape = '';
                }
            }

            //sets style to write on head
            var style = ".aps-icon-preview #" + icon_id + "{";
            style += fontSize;
            style += fontColor;
            style += "}";
            style += ".aps-icon-preview #" + icon_id + ":hover{";
            style += fontHoverColor;
            style += "}";
            style += ".aps-icon-preview #" + icon_id + ":before{";
            style += fontBgColor;
            style += fontShape;
            style += padding;
            style += border;
            style += apsShadow;
            style += "}";
            style += ".aps-icon-preview #" + icon_id + ":hover:before{";
            style += fontBgColorHover;
            style += "}";
            $('#aps-icon-list-preview').append(style);
        }

        //add animation on icon hover inside preview box
        $('.aps-preview-holder').on('hover', '.aps-image-icon-preview,.aps-font-icon-preview', function (e) {
            var animationType = $('#aps-icon-animation').val();
            if (animationType !== "") {
                if (!$(this).find('img,.fa').hasClass('animated')) {
                    $(this).find('img,.fa').addClass('animated');
                }
                $(this).find('img,.fa').toggleClass(animationType);
            }
            e.stopPropagation();
            e.preventDefault();
        });
        //social sidebar display type toggle
        $('select[name="set_display_type"]').change(function () {
            var display_type = $(this).val();
            if (display_type == 'button_display')
            {
                $('.aps-set-display-reference').show();
            }
            else
            {
                $('.aps-set-display-reference').hide();
            }
        });


        //icon type change
        $('body').on('change', '#icon-theme-type-chooser', function () {
            if ($(this).val() == 'png')
            {
                $('.aps-png-icon-chooser-wrap').show();
                $('.aps-svg-icon-chooser-wrap').hide();
                $('.aps-png-icons-wrapper').show();
                $('.aps-svg-icons-wrapper').hide();
            }
            else if ($(this).val() == 'svg')
            {
                $('.aps-png-icon-chooser-wrap').hide();
                $('.aps-svg-icon-chooser-wrap').show();
                $('.aps-png-icons-wrapper').hide();
                $('.aps-svg-icons-wrapper').show();

            }
            else
            {
                $('.aps-png-icon-chooser-wrap').show();
                $('.aps-svg-icon-chooser-wrap').show();
                $('.aps-png-icons-wrapper').show();
                $('.aps-svg-icons-wrapper').show();
            }
        });

        $('body').on('change', '#aps-icon-set-filter', function () {
            var set_class = $(this).val();
            if (set_class != '')
            {
                var set_class_array = set_class.split('-');
                var theme_type = set_class_array[1];
                $('.aps-each-icon-set').hide();
                $('.' + set_class).show();
                if (theme_type == 'svg')
                {
                    $('.aps-svg-icon-set-heading').show();
                    $('.aps-png-icon-set-heading').hide();
                }
                else
                {
                    $('.aps-svg-icon-set-heading').hide();
                    $('.aps-png-icon-set-heading').show();
                }
            }
            else
            {
                $('.aps-each-icon-set').show();
                $('.aps-svg-icon-set-heading').show();
                $('.aps-png-icon-set-heading').show();
            }

            //alert($(this).val()); 
        });

        //Expand Collpase Trigger
        $('.aps-icon-theme-expand').click(function () {
            if ($(this).html() === aps_script_variable.icon_expand)
            {
                $('.aps-icon-body').slideDown(500)
                $(this).html(aps_script_variable.icon_collapse)
                $('i.dashicons-arrow-down').removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up');
            }
            else
            {
                $('.aps-icon-body').slideUp(500)
                $('i.dashicons-arrow-up').removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down');
                $(this).html(aps_script_variable.icon_expand);
            }
        });

        //plugin to relatively fix the elements in a container with scroll
        $.fn.relativeFixed = function (options) {
            if (this.length == 0)
                return this;

            var defaults = {
                parentDiv: ''
            }
            var plugin = {};
            var el = this;
            var init = function () {
                //add class to the parent div
                el.parent().addClass('aps-relativeFixed-parent');
                plugin.settings = $.extend(defaults, options);
                if (plugin.settings.parentDiv == '') {
                    //store the parent div object
                    plugin.settings.parentDiv = el.parent('.aps-relativeFixed-parent');
                }
                else {
                    plugin.settings.parentDiv = $(plugin.settings.parentDiv);//create a jquery object for parentDiv
                }
                el.css({
                    'position': 'absolute'
                });

                //get the element current offset
                plugin.currentOffsetTop = el.offset().top - plugin.settings.parentDiv.offset().top;
                //attach event of scroll on the parent div
                $(plugin.settings.parentDiv).on('scroll', function () {
                    var newOffset = plugin.currentOffsetTop + plugin.settings.parentDiv.scrollTop();
                    el.css({
                        'top': 0,
                        'bottom': 'auto',
                        'transform': 'translate3d(0,' + newOffset + 'px,0)',
                        '-webkit-transform': 'translate3d(0,' + newOffset + 'px,0)',
                        '-moz-transform': 'translate3d(0,' + newOffset + 'px,0)',
                    });
                }).scroll();
            }
            el.destroy = function () {
                el.removeAttr('style');
                plugin.settings.parentDiv.removeClass('aps-relativeFixed-parent');
                plugin.settings.parentDiv.off('scroll');
            }
            init();
            return this;
        }

        var relativeFixed = $('.aps-sidebar-icon-preview.aps-icon-sidebar-fixed').relativeFixed({
            parentDiv: '.aps-sidebar-preview-box'
        });

        //scripts for social sidebar settings preview
        $sidebarPreview = $('#aps-sidebar-icon-preview');
        var sidebarPositionClass = 'aps-icon-sidebar-leftTop aps-icon-sidebar-leftMiddle aps-icon-sidebar-leftBottom aps-icon-sidebar-rightTop aps-icon-sidebar-rightMiddle aps-icon-sidebar-rightBottom';
        var sidebarHiddenClass = 'aps-icon-sidebar-hidden';
        var sidebarFixedClass = 'aps-icon-sidebar-fixed';


        $('#aps-sidebar-position-select').change(function () {
            //resetting the scroll postion;
            $('.aps-sidebar-preview-box').scrollTop(0);

            if (relativeFixed.length != 0) {
                relativeFixed.destroy();
            }
            $sidebarPreview.removeClass(sidebarPositionClass);
            $sidebarPreview.addClass($(this).val());
            $('.aps-sidebar-icon-preview.aps-icon-sidebar-fixed').relativeFixed({
                parentDiv: '.aps-sidebar-preview-box'
            });
        });
        $('#aps-sidebar-hidden-select').change(function () {
            if ($(this).val() == 'yes') {
                $sidebarPreview.addClass(sidebarHiddenClass);
            } else {
                $sidebarPreview.removeClass(sidebarHiddenClass);
            }
        });
        $('#aps-sidebar-attachment-select').change(function () {
            //resetting the scroll postion;
            $('.aps-sidebar-preview-box').scrollTop(0);

            if ($(this).val() == 'fixed') {
                if (relativeFixed.length != 0) {
                    relativeFixed.destroy();
                }
                $sidebarPreview.parent('.aps-sidebar-preview-wrap').removeClass('aps-sidebar-preview-wrap-relative');
                $sidebarPreview.addClass(sidebarFixedClass);
                $('.aps-sidebar-icon-preview.aps-icon-sidebar-fixed').relativeFixed({
                    parentDiv: '.aps-sidebar-preview-box'
                });
            } else {
                if (relativeFixed.length != 0) {
                    relativeFixed.destroy();
                }
                $sidebarPreview.parent('.aps-sidebar-preview-wrap').addClass('aps-sidebar-preview-wrap-relative');
                $sidebarPreview.removeClass(sidebarFixedClass);
            }
        });

        //sidebar icon hover animation
        $('.aps-sidebar-preview-box').on('mouseenter','.aps-each-icon',function () {
            var animation_class = $(this).find('.animated').attr('data-animation-class');
            if (animation_class !== 'none')
            {
                $(this).find('.animated').addClass(animation_class);
            }
        }).on('mouseleave','.aps-each-icon', function () {
            var animation_class = $(this).find('.animated').attr('data-animation-class');
            if (animation_class !== 'none')
            {
                $(this).find('.animated').removeClass(animation_class);
            }
        });

        //sidebar icon tooltip
        $('.aps-sidebar-preview-wrap .aps-each-icon[data-aps-tooltip-enabled="1"]').each(function (i, el) {
            var $this = $(el);
            var toolTipText = $this.attr("data-aps-tooltip");
            var toolTipBg = $this.attr("data-aps-tooltip-bg");
            var toolTipTextColor = $this.attr("data-aps-tooltip-color");
            var $toolTipHolder = $this.find('.aps-icon-tooltip');
            $toolTipHolder.text(toolTipText).css({'background-color': toolTipBg, 'color': toolTipTextColor, 'margin-top': '-' + ($toolTipHolder.outerHeight() / 2) + 'px', 'margin-left': '-' + ($toolTipHolder.outerWidth() / 2) + 'px'});
            $this.hover(function () {
                $toolTipHolder.stop().fadeIn();
            }, function () {
                $toolTipHolder.stop().fadeOut();
            });
        });

        $('#aps-sidebar-set-chooser').change(function () {
            $('#aps-icon-set-loader').show();
            var icon_set_id = $(this).val();
            if (icon_set_id != '')
            {
                var edit_url = $('.aps-set-edit-button a').attr('href');
                var edit_url_array = edit_url.split('si_id=');
                edit_url_array[1] = icon_set_id;
                var new_edit_url = edit_url_array[0] + 'si_id=' + edit_url_array[1];
                $('.aps-set-edit-button').show();
                $('.aps-set-edit-button a').attr('href', new_edit_url);
            }
            else
            {
                $('.aps-set-edit-button').hide();
            }
            var icon_margin = $('#aps-sidebar-icon-margin').val();
            var icon_animation = $('#aps-sidebar-icon-animation').val();
            $.ajax({
                'url': aps_script_variable.ajax_url,
                'type': 'post',
                'data': 'icon_set_id=' + icon_set_id + '&action=get_sidebar_icon_set&_wpnonce=' + aps_script_variable.ajax_nonce + '&icon_margin=' + icon_margin + '&icon_animation=' + icon_animation,
                'success': function (res)
                {
                    $('#aps-sidebar-icon-preview').html(res);
                    $('#aps-icon-set-loader').hide();
                    $('.aps-sidebar-preview-wrap .aps-each-icon[data-aps-tooltip-enabled="1"]').each(function (i, el) {
                        var $this = $(el);
                        var toolTipText = $this.attr("data-aps-tooltip");
                        var toolTipBg = $this.attr("data-aps-tooltip-bg");
                        var toolTipTextColor = $this.attr("data-aps-tooltip-color");
                        var $toolTipHolder = $this.find('.aps-icon-tooltip');
                        $toolTipHolder.text(toolTipText).css({'background-color': toolTipBg, 'color': toolTipTextColor, 'margin-top': '-' + ($toolTipHolder.outerHeight() / 2) + 'px', 'margin-left': '-' + ($toolTipHolder.outerWidth() / 2) + 'px'});
                        $this.hover(function () {
                            $toolTipHolder.stop().fadeIn();
                        }, function () {
                            $toolTipHolder.stop().fadeOut();
                        });

                    });

                }
            });
        });

        //Sidebar icons margin change
        $('#aps-sidebar-icon-margin').keyup(function () {
            var margin = $(this).val();
            margin = margin.replace('px', '') + 'px';
            $('.aps-sidebar-preview-box .aps-each-icon').css('margin-bottom', margin);
        });

        //sidebar animation change
        $('#aps-sidebar-icon-animation').change(function () {
            var animation = $('#aps-sidebar-icon-animation').val();
            $('.aps-sidebar-preview-wrap .aps-each-icon .aps-icon-link').attr('data-animation-class', animation);
        });
        
        $('.aps-rebuild-sidebar-set').click(function(){
            $('#aps-icon-set-loader').show();
            var icon_set_id = $('#aps-sidebar-set-chooser').val();
            if (icon_set_id != '')
            {
                var edit_url = $('.aps-set-edit-button a').attr('href');
                var edit_url_array = edit_url.split('si_id=');
                edit_url_array[1] = icon_set_id;
                var new_edit_url = edit_url_array[0] + 'si_id=' + edit_url_array[1];
                $('.aps-set-edit-button').show();
                $('.aps-set-edit-button a').attr('href', new_edit_url);
            }
            else
            {
                $('.aps-set-edit-button').hide();
            }
            var icon_margin = $('#aps-sidebar-icon-margin').val();
            var icon_animation = $('#aps-sidebar-icon-animation').val();
            $.ajax({
                'url': aps_script_variable.ajax_url,
                'type': 'post',
                'data': 'icon_set_id=' + icon_set_id + '&action=get_sidebar_icon_set&_wpnonce=' + aps_script_variable.ajax_nonce + '&icon_margin=' + icon_margin + '&icon_animation=' + icon_animation,
                'success': function (res)
                {
                    $('#aps-sidebar-icon-preview').html(res);
                    $('#aps-icon-set-loader').hide();
                    $('.aps-sidebar-preview-wrap .aps-each-icon[data-aps-tooltip-enabled="1"]').each(function (i, el) {
                        var $this = $(el);
                        var toolTipText = $this.attr("data-aps-tooltip");
                        var toolTipBg = $this.attr("data-aps-tooltip-bg");
                        var toolTipTextColor = $this.attr("data-aps-tooltip-color");
                        var $toolTipHolder = $this.find('.aps-icon-tooltip');
                        $toolTipHolder.text(toolTipText).css({'background-color': toolTipBg, 'color': toolTipTextColor, 'margin-top': '-' + ($toolTipHolder.outerHeight() / 2) + 'px', 'margin-left': '-' + ($toolTipHolder.outerWidth() / 2) + 'px'});
                        $this.hover(function () {
                            $toolTipHolder.stop().fadeIn();
                        }, function () {
                            $toolTipHolder.stop().fadeOut();
                        });

                    });

                }
            });
        });
        
        $('.aps-submit-clone').click(function(){
           $('input[name="aps_icon_set_submit"]').click();
        });

    }); //document.ready close
}(jQuery));