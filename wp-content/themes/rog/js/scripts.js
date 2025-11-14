jQuery(document).ready(function() {
    // if ($(window).width() < 992) {
    //     var $grid = jQuery('.grid').masonry({
    //       itemSelector: '.grid-item',
    //       columnWidth: '.grid-sizer',
    //       percentPosition: true,
    //       stamp: '.stamp'
    //     });
    // } else {
    //     var $grid = jQuery('.grid').masonry({
    //       itemSelector: '.grid-item',
    //       columnWidth: '.grid-sizer',
    //       percentPosition: true,
    //     });
    // }

    // $grid.imagesLoaded().progress( function() {
    //   $grid.masonry('layout');
    // });

	// nazwa tortu
	
	jQuery('.single input[name="nazwa_tortu"]').val(jQuery('.single h1').html());
	console.log(jQuery('.single h1').html());
	
    jQuery('.wybrany_tort').click(function(){
        jQuery('#select_home_product_cats').toggle();
    })

    jQuery('.product_list_title #select_home_product_cats li').click(function(){
        id = jQuery(this).attr('data-id');
        nazwa = jQuery(this).html();

        jQuery('#select_home_product_cats').toggle();

        jQuery.ajax({
            url: ajaxurl,
            data: {

                'action':'get_product_by_cat',
                id: id 
            },
            success:function(data) {

                jQuery('.wybrany_tort').html(nazwa+' <i class="fas fa-sort-down"></i>');

                var data = jQuery.parseJSON(data);
                jQuery('#products_list').html(data.wynik);

            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        }); 


    })

    if (jQuery(window).width() < 992) {
        var $container = jQuery('.grid');
        if ($container.length) {
            $container.imagesLoaded(function(){
              $container.masonry({
                itemSelector: '.grid-item',
                  columnWidth: '.grid-sizer',
                  percentPosition: true,
                  stamp: '.stamp'
              });
            });
        }
    } else {
        var $container = jQuery('.grid');
        if ($container.length) {
            $container.imagesLoaded(function(){
              $container.masonry({
                itemSelector: '.grid-item',
                  columnWidth: '.grid-sizer',
                  percentPosition: true,
              });
            });
        }
    }

    jQuery('.owl-carousel').owlCarousel({
        margin: 40,
        nav: true,
        dots: false,
        navText:['<i class="fal fa-chevron-left"></i>','<i class="fal fa-chevron-right"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    });

    jQuery('.social-send').click(function(e) {
        e.preventDefault();

        jQuery('.apss-popup-overlay').show();
        jQuery('.apss_email_share_popup').show();
        jQuery('.apss-social-share-popup').hide();
        jQuery('.apss-social-share-popup-all-shares').hide();
        jQuery('#apss-popup-overlay-start').hide();
        return false;
    });

    jQuery('.social-share').click(function(e) {
        e.preventDefault();

        jQuery('.share').fadeToggle();
    });
});

(function($) {
    $(window).on('load resize', function() {
        $('.carousel').each(function() {
            et_fullscreen_slider($(this));
        });
    });

    function et_fullscreen_slider(et_slider) {
        var et_viewport_height = $(window).height(),
            et_slider_height = $(et_slider).find('.carousel-inner').innerHeight(),
            $navabr = $('.navbar'),
            $categories = $('#categories');

        if ($navabr.length) {
            et_viewport_height = et_viewport_height - $navabr.innerHeight();
        }

        if ($categories.length) {
            et_viewport_height = et_viewport_height - $categories.innerHeight();
        }

        $(et_slider).height(et_viewport_height);
    }

   var clipboardDemos=new ClipboardJS('.btn-copy');

   jQuery('.btn-copy').click(function(e) {
    e.preventDefault();
   })
})(jQuery);

// var btns=document.querySelectorAll('.btn-copy');for(var i=0;i<btns.length;i++){btns[i].addEventListener('mouseleave',clearTooltip);btns[i].addEventListener('blur',clearTooltip);}
// function clearTooltip(e){e.currentTarget.setAttribute('class','btn-copy');e.currentTarget.removeAttribute('aria-label');}
// function showTooltip(elem,msg){elem.setAttribute('class','btn-copy tooltipped tooltipped-s');elem.setAttribute('aria-label',msg);}
// function fallbackMessage(action){var actionMsg='';var actionKey=(action==='cut'?'X':'C');if(/iPhone|iPad/i.test(navigator.userAgent)){actionMsg='No support :(';}
// else if(/Mac/i.test(navigator.userAgent)){actionMsg='Press ⌘-'+actionKey+' to '+action;}
// else{actionMsg='Press Ctrl-'+actionKey+' to '+action;}
// return actionMsg;}
// hljs.initHighlightingOnLoad();