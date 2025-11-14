<?php 
/*
Template name: FAQ
*/
?>
<?php get_header();?>
	<div id="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="page-title">Najczęściej zadawane pytania</h1>

            <?php 
            	$pytania = get_field('najczesciej_zadawane_pytania');
            	$i = 1;

            	if( $pytania ) {
            		echo '<div id="accordion">';
            		foreach($pytania as $pytanie) {
            			echo '<div class="card">';
            			echo '<div class="card-header" id="heading-'.$i.'">';
            			echo '<h5 class="mb-0">';
            			echo '<button class="btn btn-link '.(($i>1)?'collapsed':"").'" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="true" aria-controls="collapse'.$i.'">';
            			echo $pytanie['pytanie'];
            			echo '</button>';
            			echo '</h5>';
            			echo '<div id="collapse'.$i.'" class="collapse '.(($i==1)?'show':"").'" aria-labelledby="heading'.$i.'" data-parent="#accordion">';
            			echo '<div class="card-body">';
            			echo $pytanie['odpowiedz'];
            			echo '</div>';
            			echo '</div>';
            			echo '</div>';

            			$i++;
            		}
            		echo '</div>';
            	}
            ?>
          </div>
        </div>
      </div>
    </div>
<?php get_footer();?>