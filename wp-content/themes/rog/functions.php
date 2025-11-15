<?php


define('THEME_PATH', get_template_directory_uri());

require_once('bs4navwalker.php');
require_once('acf-fields-cake-pricing.php');

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'home-product', 326, 326, array( 'center', 'top' ) );

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Menu główne' ));
}
add_action( 'init', 'register_my_menu' );

function produkty() {

	$labels = array(
		'name'                  => _x( 'Produkty', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Produkt', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Produkty', 'text_domain' ),
		'name_admin_bar'        => __( 'Produkt', 'text_domain' ),
		'archives'              => __( 'Archiwum', 'text_domain' ),
		'attributes'            => __( 'Atrybuty', 'text_domain' ),
		'parent_item_colon'     => __( 'Nadrzędny produkt', 'text_domain' ),
		'all_items'             => __( 'Wszystkie produkty', 'text_domain' ),
		'add_new_item'          => __( 'Dodaj nowy produkt', 'text_domain' ),
		'add_new'               => __( 'Dodaj nowy', 'text_domain' ),
		'new_item'              => __( 'Nowy produkt', 'text_domain' ),
		'edit_item'             => __( 'Edytuj produkt', 'text_domain' ),
		'update_item'           => __( 'Zaktualizuj produkt', 'text_domain' ),
		'view_item'             => __( 'Zobacz produkt', 'text_domain' ),
		'view_items'            => __( 'Zobacz produkty', 'text_domain' ),
		'search_items'          => __( 'Szukaj produktu', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Produkt', 'text_domain' ),
		'description'           => __( 'Produkty', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-buddicons-community',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'produkt', $args );

}
add_action( 'init', 'produkty', 0 );


function get_product_by_cat(){
	 if ( isset($_REQUEST) ) {
		 
          $args = array(
            'post_type' => 'produkt',
            'posts_per_page' => 12,
            'post_status' => 'publish',
            'meta_key'    => 'dodaj_na_stronie_glownej',
            'meta_value'  =>  1,
            'cat' => $_REQUEST['id']
          );
          $the_query = new WP_Query( $args );

          $wynik = '';

          if ( $the_query->have_posts() ) {

            $i = 0;

            while ( $the_query->have_posts() ) {
              $the_query->the_post();

              if($i == 0) $wynik .= '<div class="row">';
              elseif($i % 4 == 0) $wynik .= '</div><div class="row">';

              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home-product' );

              $terms = get_the_terms( get_the_ID(), 'category' );
              $icon = get_term_meta( $terms['0']->term_id, 'nazwa_ikony', true);
              
              $wynik .='<div class="col-md-3 col-sm-6">';
                $wynik .='<div class="products_list_product">';
                  $wynik .='<a href="'.get_the_permalink().'"><img src="'.$image[0].'"></a>';
                  $wynik .='<div class="products_list_product_content">';
                    $wynik .='<div class="row">';
                      $wynik .='<div class="col-sm-6">';
                        $wynik .='<i class="'.$icon.'"></i>';
                      $wynik .='</div>';
                      $wynik .='<div class="col-sm-6">';
                        $wynik .='<p class="name">'.get_the_title().'</p>';
                        $wynik .='<p class="term">'.$terms['0']->name.'</p>';
                      $wynik .='</div>';
                   $wynik .='</div>';
                  $wynik .='</div>';
                $wynik .='</div>';
              $wynik .='</div>';
              

              $i++;

            }

             $wynik .= '</div>';

            wp_reset_postdata();
          }

          $link = esc_url( get_category_link($_REQUEST['id']) );



		echo json_encode(array('wynik' => $wynik,'link' => $link));
		wp_die();

	 }
	
}

add_action('wp_ajax_get_product_by_cat', 'get_product_by_cat');
add_action('wp_ajax_nopriv_get_product_by_cat', 'get_product_by_cat'); // not really needed

// AJAX endpoint dla pobierania danych o cenach tortu
function get_cake_pricing_data() {
	if ( isset($_REQUEST['post_id']) ) {
		$post_id = intval($_REQUEST['post_id']);

		$has_pricing = get_field('enable_pricing', $post_id);

		if ( !$has_pricing ) {
			echo json_encode(array(
				'has_pricing' => false,
			));
			wp_die();
		}

		$price_mode = get_field('price_mode', $post_id);
		$portions = get_portion_sizes();
		$all_prices = get_all_cake_prices($post_id);

		echo json_encode(array(
			'has_pricing' => true,
			'price_mode' => $price_mode,
			'portions' => $portions,
			'prices' => $all_prices,
		));
		wp_die();
	}
}

add_action('wp_ajax_get_cake_pricing_data', 'get_cake_pricing_data');
add_action('wp_ajax_nopriv_get_cake_pricing_data', 'get_cake_pricing_data');

add_action('wp_head', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {
	echo '<script type="text/javascript">
		   var ajaxurl = "' . admin_url('admin-ajax.php') . '";
		 </script>';
}

// Enqueue skryptu dla modułu cen tortów
function enqueue_cake_pricing_script() {
	if( is_singular('produkt') ) {
		wp_enqueue_script(
			'cake-pricing',
			get_template_directory_uri() . '/js/cake-pricing.js',
			array('jquery'),
			'1.0.0',
			true
		);

		// Przekazanie danych do JS
		wp_localize_script('cake-pricing', 'cakePricingData', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'postId' => get_the_ID(),
		));
	}
}
add_action('wp_enqueue_scripts', 'enqueue_cake_pricing_script');

// wyszukiwanie po tytule

add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
function title_like_posts_where( $where, $wp_query ) {
    global $wpdb;
    if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
    }
    return $where;
}

// dymki w formularzu 

if( function_exists('acf_add_options_page') ) {
	
        acf_add_options_page(array(
		'page_title' 	=> 'Dymki - formularz',
		'menu_title'	=> 'Dymki - formularz',
		'menu_slug' 	=> 'dymki',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'position'      => '3.2',
	));
}

if( function_exists('acf_add_options_page') ) {
	
        acf_add_options_page(array(
		'page_title' 	=> 'Zajęte daty',
		'menu_title'	=> 'Zajęte daty',
		'menu_slug' 	=> 'zajete-daty',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'position'      => '3.3',
	));
}

function pagination($pages = '', $range = 3)
{
    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged=1;

    if($pages == '')
    {
global $wp_query;

$pages=$wp_query->max_num_pages;
if(!$pages)
{
$pages = 1;
}
}

if(1 != $pages)
{

echo "<div class=\"pagination\">";
if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."' class='pagination_prev'>&lsaquo; poprzednia</a>";


for ($i=1; $i <= $pages; $i++)
{
  if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
{
  echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
}
}
if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\" class='pagination_next'>następna &rsaquo;</a>";
if($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
echo "</div>\n";
}
}

// ============================================
// MODUŁ CEN DLA TORTÓW
// ============================================

// ACF Options Page - Ustawienia wielkości tortów
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Ustawienia cen tortów',
		'menu_title'	=> 'Ceny tortów',
		'menu_slug' 	=> 'cake-pricing-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position'      => '3.4',
		'icon_url'      => 'dashicons-tag',
	));
}

/**
 * Inicjalizuje domyślne ustawienia cen
 */
function init_default_pricing_data() {
	// Ustawienia auto-generowania
	if( !get_field('base_group_price', 'option') ) {
		update_field('base_group_price', 120, 'option');
	}
	if( !get_field('price_step', 'option') ) {
		update_field('price_step', 10, 'option');
	}
	if( !get_field('number_of_groups', 'option') ) {
		update_field('number_of_groups', 21, 'option');
	}

	// GRUPY CENOWE - generuj tylko jeśli nie ma
	$existing_groups = get_field('price_groups', 'option');
	if( !is_array($existing_groups) || count($existing_groups) === 0 ) {
		generate_price_groups();
	}

	// WIELKOŚCI PORCJI
	$existing_portions = get_field('portion_sizes', 'option');
	if( !is_array($existing_portions) || count($existing_portions) === 0 ) {
		$default_portions = array(
			array('portions' => 12, 'surcharge' => 40),
			array('portions' => 15, 'surcharge' => 60),
			array('portions' => 20, 'surcharge' => 80),
			array('portions' => 25, 'surcharge' => 100),
			array('portions' => 30, 'surcharge' => 120),
		);
		update_field('portion_sizes', $default_portions, 'option');
	}
}
add_action('acf/init', 'init_default_pricing_data');

/**
 * Generuje grupy cenowe na podstawie ustawień
 */
function generate_price_groups() {
	$base_price = get_field('base_group_price', 'option') ?: 120;
	$step = get_field('price_step', 'option') ?: 10;
	$count = get_field('number_of_groups', 'option') ?: 21;

	$groups = array();
	for( $i = 0; $i < $count; $i++ ) {
		$price = $base_price + ($i * $step);
		$groups[] = array(
			'group_name' => 'Grupa ' . ($i + 1),
			'base_price' => $price,
		);
	}

	update_field('price_groups', $groups, 'option');
	return $groups;
}

/**
 * Auto-regeneruj grupy przy zapisywaniu opcji
 */
function auto_regenerate_price_groups( $value, $post_id, $field ) {
	// Tylko dla options page z cenami tortów
	if( $post_id !== 'option' ) {
		return $value;
	}

	// Jeśli zmieniono base_price, step lub number_of_groups
	$trigger_fields = array('base_group_price', 'price_step', 'number_of_groups');
	if( in_array($field['name'], $trigger_fields) ) {
		// Ustaw flagę do regeneracji (wykonamy po zapisaniu wszystkich pól)
		set_transient('regenerate_price_groups', true, 60);
	}

	return $value;
}
add_filter('acf/update_value', 'auto_regenerate_price_groups', 10, 3);

/**
 * Wykonaj regenerację po zapisaniu opcji
 */
function execute_price_groups_regeneration( $post_id ) {
	if( $post_id === 'option' && get_transient('regenerate_price_groups') ) {
		generate_price_groups();
		delete_transient('regenerate_price_groups');
	}
}
add_action('acf/save_post', 'execute_price_groups_regeneration', 20);

/**
 * Ręczne wymuszenie inicjalizacji domyślnych porcji
 * Użyj tego URL w przeglądarce: /wp-admin/?force_init_portions=1
 */
function force_init_default_portions() {
	if( isset($_GET['force_init_portions']) && $_GET['force_init_portions'] == '1' && current_user_can('manage_options') ) {
		$default_portions = array(
			array('portions' => 12, 'surcharge' => 40),
			array('portions' => 15, 'surcharge' => 60),
			array('portions' => 20, 'surcharge' => 80),
			array('portions' => 25, 'surcharge' => 100),
			array('portions' => 30, 'surcharge' => 120),
		);
		update_field('portion_sizes', $default_portions, 'option');
		wp_redirect(admin_url('admin.php?page=cake-pricing-settings&init=success'));
		exit;
	}
}
add_action('admin_init', 'force_init_default_portions');

/**
 * Pobiera wszystkie dostępne wielkości porcji z globalnych ustawień ACF
 * @return array Tablica z wielkościami i dopłatami
 */
function get_portion_sizes() {
	$portions = array();

	if( have_rows('portion_sizes', 'option') ) {
		while( have_rows('portion_sizes', 'option') ) {
			the_row();
			$portions[] = array(
				'portions' => get_sub_field('portions'),
				'surcharge' => get_sub_field('surcharge'),
			);
		}
	}

	return $portions;
}

/**
 * Pobiera cenę z grupy cenowej
 * @param int $group_index Indeks grupy (0, 1, 2...)
 * @return int|false Cena bazowa z grupy lub false
 */
function get_price_from_group($group_index) {
	if( have_rows('price_groups', 'option') ) {
		$index = 0;
		while( have_rows('price_groups', 'option') ) {
			the_row();
			if( $index == $group_index ) {
				return get_sub_field('base_price');
			}
			$index++;
		}
	}
	return false;
}

/**
 * Pobiera cenę bazową tortu
 * @param int $post_id ID posta produktu
 * @return int|false Cena bazowa lub false jeśli nie ustawiona
 */
function get_cake_base_price($post_id) {
	$has_price = get_field('enable_pricing', $post_id);

	if( !$has_price ) {
		return false;
	}

	$price_mode = get_field('price_mode', $post_id);

	// Tryb automatyczny - pobierz cenę z grupy
	if( $price_mode === 'automatic' ) {
		$group_index = get_field('price_group', $post_id);
		if( $group_index !== false && $group_index !== '' ) {
			return get_price_from_group($group_index);
		}
	}

	// Tryb ręczny - zwróć najniższą cenę
	if( $price_mode === 'manual' ) {
		$manual_prices = get_field('manual_prices', $post_id);
		if( $manual_prices && is_array($manual_prices) ) {
			$prices = array_column($manual_prices, 'price');
			return min($prices);
		}
	}

	return false;
}

/**
 * Kalkuluje finalną cenę tortu
 * @param int $post_id ID posta produktu
 * @param int $portion_index Indeks wielkości porcji
 * @return int|false Finalna cena lub false
 */
function calculate_final_price($post_id, $portion_index) {
	$price_mode = get_field('price_mode', $post_id);

	// Tryb automatyczny: cena z grupy + dopłata
	if( $price_mode === 'automatic' ) {
		$group_index = get_field('price_group', $post_id);
		$base_price = get_price_from_group($group_index);
		$portions = get_portion_sizes();

		if( $base_price && isset($portions[$portion_index]) ) {
			$surcharge = $portions[$portion_index]['surcharge'];
			return $base_price + $surcharge;
		}
	}

	// Tryb ręczny: zwróć ustawioną cenę
	if( $price_mode === 'manual' ) {
		$manual_prices = get_field('manual_prices', $post_id);
		if( $manual_prices && isset($manual_prices[$portion_index]) ) {
			return $manual_prices[$portion_index]['price'];
		}
	}

	return false;
}

/**
 * Pobiera wszystkie ceny dla tortu (wszystkie wielkości)
 * @param int $post_id ID posta produktu
 * @return array Tablica z cenami dla wszystkich wielkości
 */
function get_all_cake_prices($post_id) {
	$prices = array();
	$price_mode = get_field('price_mode', $post_id);
	$portions = get_portion_sizes();

	if( $price_mode === 'automatic' ) {
		$group_index = get_field('price_group', $post_id);
		$base_price = get_price_from_group($group_index);

		if( $base_price ) {
			foreach( $portions as $index => $portion ) {
				$prices[] = array(
					'portions' => $portion['portions'],
					'price' => $base_price + $portion['surcharge'],
				);
			}
		}
	} elseif( $price_mode === 'manual' ) {
		$manual_prices = get_field('manual_prices', $post_id);

		if( $manual_prices && is_array($manual_prices) ) {
			foreach( $manual_prices as $index => $manual_price ) {
				$prices[] = array(
					'portions' => $manual_price['portions'] ?? '',
					'price' => $manual_price['price'] ?? 0,
				);
			}
		}
	}

	return $prices;
}

?>