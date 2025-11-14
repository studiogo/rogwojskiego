<?php get_header(); ?>


    <div class="products_list_cont"  style="padding-top:50px;">

     <div class="container">

      <h1><?php the_search_query(); ?></h1>

      <div id="products_list">
        <?php

          // select by tag name 

          $args = array(
            'post_type' => 'produkt',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_tag',
                    'field'    => 'name',
                    'terms'    => get_search_query(),
                ),
                
            ),
            
          );
          $the_query = new WP_Query( $args );


          $i = 0;


          if ( $the_query->have_posts() ) {

            

            while ( $the_query->have_posts() ) {
              $the_query->the_post();

              if($i == 0) echo '<div class="row">';
              elseif($i % 4 == 0) echo '</div><div class="row">';

              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-product' );

              $terms = get_the_terms( get_the_ID(), 'category' );
              $icon = get_term_meta( $terms['0']->term_id, 'nazwa_ikony', true);
              ?>
              <div class="col-md-3 col-sm-6">
                <div class="products_list_product">
                  <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>"></a>
                  <div class="products_list_product_content">
                    <div class="row">
                      <div class="col-sm-6">
                        <i class="<?php echo $icon; ?>"></i>
                      </div>
                      <div class="col-sm-6">
                        <p class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <p class="term"><a href="<?php echo esc_url( get_category_link($terms['0']->term_id) ); ?>"><?php echo $terms['0']->name; ?></a></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php

              $i++;

            }

           

            wp_reset_postdata();
          }

          // select by product name 

          $args_name = array(
            'post_type' => 'produkt',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'post_title_like' => get_search_query(),
            
          );
          
          $the_query_name = new WP_Query( $args_name );

          if ( $the_query_name->have_posts() ) {

            

            while ( $the_query_name->have_posts() ) {
              $the_query_name->the_post();

              if($i == 0) echo '<div class="row">';
              elseif($i % 4 == 0) echo '</div><div class="row">';

              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-product' );

              $terms = get_the_terms( get_the_ID(), 'category' );
              $icon = get_term_meta( $terms['0']->term_id, 'nazwa_ikony', true);
              ?>
              <div class="col-md-3 col-sm-6">
                <div class="products_list_product">
                  <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>"></a>
                  <div class="products_list_product_content">
                    <div class="row">
                      <div class="col-sm-6">
                        <i class="<?php echo $icon; ?>"></i>
                      </div>
                      <div class="col-sm-6">
                        <p class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <p class="term"><a href="<?php echo esc_url( get_category_link($terms['0']->term_id) ); ?>"><?php echo $terms['0']->name; ?></a></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php

              $i++;

            }

           

            wp_reset_postdata();
          }



           echo '</div>';
        ?>
      </div>
    </div>
  </div>


<?php get_footer(); ?>