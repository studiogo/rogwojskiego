<?php get_header(); ?>

    <?php echo do_shortcode('[rev_slider alias="slider-1"][/rev_slider]');?>

    <div class="products_list_cont">
      <div class="container">
        <div class="product_list_title">
          <div class="row">
            <div class="col-md-6">
              <p class="tytul">Polecamy torty:</p>
            </div>
            <div class="col-md-6">
              <div class="select_home_product_cat">
                <div class="row">
                  <div class="col-md-6">Wybierz kategorię polecanych tortów</div>
                  <div class="col-md-6"><p class="wybrany_tort">Wszystkie <i class="fas fa-sort-down"></i></p></div>
                </div>
                <ul id="select_home_product_cats">
                  <?php 
                    $categories = get_categories( array(
                      'orderby' => 'ID',
                      'order'   => 'DESC',
                      'hide_empty' => 0
                    ) );

                     foreach( $categories as $category ) {
                      ?>
                      <li data-id="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></li>
                      <?php
                     }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div id="products_list">
          <?php

            $args = array(
              'post_type' => 'produkt',
              'posts_per_page' => 12,
              'post_status' => 'publish',
              'meta_key'    => 'dodaj_na_stronie_glownej',
              'meta_value'  =>  1
            );
            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) {

              $i = 0;

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

              echo '</div>';

              wp_reset_postdata();
            }
          ?>
        </div>

        <div class="pozostałe_torty">
          <a href="<?php echo get_the_permalink(7490); ?>">zobacz pozostałe torty <i class="fas fa-caret-right"></i></a>
        </div>

      </div>
    </div>


<?php get_footer(); ?>