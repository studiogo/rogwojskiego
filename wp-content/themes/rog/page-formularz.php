<?php 
/* 
* Template name: Formularz
*/
?>

<?php get_header();?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div id="content">
      <div class="container">

        <div class="page-text">

            <div id="modalRezerwacja" class="page_formularz">
                        <div class="modal-content">
                            <div class="bg-header-rezerwacja">

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


        </div>

      </div>
    </div>
<?php endwhile; else : ?>
    <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>


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