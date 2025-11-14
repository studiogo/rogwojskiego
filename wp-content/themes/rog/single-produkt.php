<?php get_header();?>
<?php 
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
$category = get_the_category();
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
?>
	<div id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-4 col-lg-5 col-xl-4 product-image">
            <img src="<?php echo $image[0];?>">
          </div>
          <div class="col-sm-6 col-md-8 col-lg-7 col-xl-8 product-details">
            <h1><?php the_title();?></h1>
            <div class="product-category">Kategoria: <a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) );?>"><?php echo $category[0]->cat_name;?></a></div>
            <h3><?php the_field('numer_tortu');?></h3>
            <?php the_content();?>
            <?php
            // Wyświetlanie ceny tortu
            $base_price = get_cake_base_price(get_the_ID());
            if( $base_price ): ?>
              <div class="product-price">
                <span class="price-label">Cena:</span>
                <span class="price-value">Od <?php echo number_format($base_price, 0, ',', ' '); ?> zł</span>
              </div>
            <?php endif; ?>
            <div class="product-tags">
              <?php the_tags();?>
            </div>
            <div class="product-share">
              <input id="copy" value="<?php the_permalink();?>">

              <div class="fb-like" data-href="<?php the_permalink();?>" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
              <!--
              <a href="fb-messenger://share/?link=<?php the_permalink();?>"><i class="fab fa-facebook-messenger"></i></a>
              <a href="#" class="social-share"><i class="fal fa-share-alt"></i> udostępnij</a>
              -->
              <a href="" class="social-send"><i class="fas fa-share-square"></i> wyślij</a>
              <a href="#" class="btn-copy" data-clipboard-text="<?php the_permalink();?>"><i class="far fa-link"></i> skopiuj link</a>
            </div>
            <div class="share">
              <?php echo do_shortcode("[us-share network='facebook, pinterest, twitter,email' theme='7' counter='1']");?>
            </div>
            <div class="product-action">
              <span>Też chcę taki tort!</span>
               <a class="button rezerwacjaBtn" href="#modalRezerwacja"
                  data-cake-name="<?php echo esc_attr(get_the_title()); ?>"
                  data-base-price="<?php echo esc_attr($base_price ? $base_price : 0); ?>"
                  data-has-pricing="<?php echo esc_attr($base_price ? '1' : '0'); ?>">
                   <div class="btn-czytaj-top-txt btn-zamow-txt">
                        <?php echo $base_price ? 'Zamów teraz' : 'Zapytaj o cenę'; ?>
                   </div>
               </a>
            </div>
          </div>
        </div>
        <?php
        $args = array(
          'post_type' => 'produkt',
          'posts_per_page' => 15,
          'cat' => $category[0]->term_id
        );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<div class="row" id="related-products"><div class="col-md-12"><h3><span>Inne torty z kategorii</span></h3><div class="carousel-wrap"><div class="owl-carousel owl-theme">';
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-product' );
                echo '<a href="'.get_the_permalink().'" class="item"><img src="'.$image[0].'" /></a>';
            }
            echo '</div></div></div>';
        }
        ?>
      </div>
    </div>
<?php endwhile; else : ?>
  <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>


<div id="modalRezerwacja">
            <div class="modal-content">
                <div class="bg-header-rezerwacja">
                    <div class="container noPadding">
                        <div class="row noMargin">
                           <div id="btn-close-modal" class="close-modalRezerwacja"> 
                              <img src="<?php echo THEME_PATH; ?>/img/zamknij.png">
                          </div>
                        
                    </div>
                </div>
                <div class="container noPadding" style="margin-bottom: 50px;">
                    <div class="row noMargin">
                        <div class="col-md-12 noPadding text-center">
                            <img style="margin-left: -19.5px;" src="<?php echo THEME_PATH; ?>/img/logo-zamowienie_2.png">
                        </div>
                    </div>
                </div>
                <section id="rezerwacja-online">
                    <div class="container width-con noPadding">
                        <div class="row noMargin">
                            <div class="col-md-12 formContact noPadding">
                                
                                        <?php echo do_shortcode('[contact-form-7 id="7496" title="Zamów tort"]'); ?>
                                 
                            </div>
                        </div>
                    </div>
                </section>
            </div>
    </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function($){
    //hide all inputs except the first one
    $('p.hide_this').not(':eq(0)').hide();
    //functionality for add-file link
    $('a.add_file').on('click', function(e){
      //show by click the first one from hidden inputs
      $('p.hide_this:not(:visible):first').show('slow');
      e.preventDefault();
    });
    //functionality for del-file link
    $('a.del_file').on('click', function(e){
      //var init
      var input_parent = $(this).parent();
      var input_wrap = input_parent.find('span');
      //reset field value
      input_wrap.html(input_wrap.html());
      //hide by click
      input_parent.hide('slow');
      e.preventDefault();
    });
  });
</script>

<script type="text/javascript">
  jQuery(".rezerwacjaBtn").animatedModal({
                modalTarget:'modalRezerwacja',
                animatedIn:'fadeInUp',
                animatedOut:'fadeOutDown',
                color:'#fff',
            });
</script>

<script type="text/javascript">
jQuery(function($){

  var array=[<?php if(have_rows('data_zajeta','option')):?><?php while(have_rows('data_zajeta','option')):the_row();?>"<?php the_sub_field('data_zajeta');?>",<?php endwhile;?><?php endif;?>
]
  var array2=[<?php if(have_rows('data_zajeta_2','option')):?><?php while(have_rows('data_zajeta_2','option')):the_row();?>"<?php the_sub_field('data_zajeta');?>",<?php endwhile;?><?php endif;?>
]

$('input[name="data-odbioru"]').datepicker({
  dateFormat: 'dd-mm-yy',
    beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('dd-mm-yy', date);
		console.log(string);
		if(array2.indexOf(string) != -1){
			console.log("true232___________________");
			return[true, 'wolny_z'];
		}
		if(array.indexOf(string) == -1){
			console.log("true");
		}
		return [ array.indexOf(string) == -1 ];
		return [ array2.indexOf(string) == -1 ];
    },
	onChangeMonthYear : function(){ //hide
		setTimeout(function(){
    jQuery("#ui-datepicker-div").append( "<div class='date_terminy'>" );
	jQuery("#ui-datepicker-div").append( "<div class='wolny_t'><span></span>termin wolny</div>" );
	jQuery("#ui-datepicker-div").append( "<div class='ograniczenia_t'><span></span>wolny z ograniczeniami (tylko fototorty i last minute)</div>" );
	jQuery("#ui-datepicker-div").append( "<div class='zajety_t'><span></span>termin zajęty</div>" );
	jQuery("#ui-datepicker-div").append( "</div>" );
		console.log('onSelect');
	}, 10);
    },
	onClose: function () {
    	window.flaga_widoczne=false;
		console.log('onClose '+flaga_widoczne);
 	}
});
	/*
	$('input[name="data-odbioru"]').datepicker({
  dateFormat: 'dd-mm-yy',
    beforeShowDay: highLight
});*/
	function highLight(date) {
        for (var i = 0; i < array2.length; i++) {
            if (new Date(array2[i]).toString() == date.toString()) {
                return [true, 'ui-state-holiday'];
            }
        }
        return [true];
    }
  $('input[name="data-dostawy"]').datepicker({
  dateFormat: 'dd-mm-yy'});
});

</script>

<script>

jQuery(document).ready(function() {
window.flaga_widoczne=false;
var flaga_widoczne_focus=false;
jQuery("input[name='data-odbioru']").on( "focus", function() {
	console.log('flaga_widoczne: '+flaga_widoczne);
	console.log('flaga_widoczne_focus '+flaga_widoczne_focus);
	if(flaga_widoczne==false && flaga_widoczne_focus==false)
		{
			setTimeout(function(){
			console.log('focus(wewnątrz ifa) '+flaga_widoczne);
			jQuery("#ui-datepicker-div").append( "<div class='date_terminy'>" );
			jQuery("#ui-datepicker-div").append( "<div class='wolny_t'><span></span>termin wolny</div>" );
			jQuery("#ui-datepicker-div").append( "<div class='ograniczenia_t'><span></span>wolny z ograniczeniami (tylko fototorty i last minute)</div>" );
			jQuery("#ui-datepicker-div").append( "<div class='zajety_t'><span></span>termin zajęty</div>" );
			jQuery("#ui-datepicker-div").append( "</div>" );
			window.flaga_widoczne=true;
			flaga_widoczne_focus=true;
			console.log('focus(wewnątrz ifa) '+window.flaga_widoczne);
			}, 10);
		}
	console.log('focus '+flaga_widoczne);
});
	
jQuery("input[name='data-odbioru']").focusout(function() {
	console.log('focusout');
	flaga_widoczne_focus=false;
});

	});
	
</script>

<?php get_footer();?>