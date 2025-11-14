<?php


define('THEME_PATH', get_template_directory_uri());

require_once('bs4navwalker.php');

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

add_action('wp_head', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {
	echo '<script type="text/javascript">
		   var ajaxurl = "' . admin_url('admin-ajax.php') . '";
		 </script>';
}

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

?>