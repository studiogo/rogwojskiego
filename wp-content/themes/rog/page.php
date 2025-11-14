<?php 
/*
The template for displaying all single posts
*/
?>
<?php get_header();?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div id="content">
      <div class="container">

        <h1 class="page-title"><?php the_title();?></h1>

        <div class="page-text">
          <?php the_content();?>
        </div>

      </div>
    </div>
<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php get_footer();?>