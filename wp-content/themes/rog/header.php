<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/fa.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/owl.theme.default.min.css">
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>
	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/style.css">
  <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/rwd.css">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap&subset=latin-ext" rel="stylesheet">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives(array('type' => 'monthly', 'format' => 'link')); ?>
	<?php wp_head(); ?>

  <script src="<?php echo THEME_PATH; ?>/js/animatedModal.min.js" type="text/javascript"></script>
</head>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v8.0&appId=790448257792034&autoLogAppEvents=1" nonce="Uaw3laxs"></script>
<body <?php body_class(); ?>>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-123136617-27"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-123136617-27');
</script>
	
	
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v6.0&appId=426325798038740&autoLogAppEvents=1"></script>
<div id="rap">
	<nav class="navbar navbar-expand-lg">
      <div class="container">
        <ul class="navbar-nav d-lg-none mobile-top">
          <li class="nav-item">
            <i class="fas fa-map-marker-alt"></i> ul. Wojskiego 11c , 80-119 Gdańsk
          </li>
          <li class="nav-item">
            <i class="fas fa-phone-alt"></i> 58 302 50 18
          </li>
        </ul>
        <a class="navbar-brand d-lg-none" href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_directory');?>/img/logo.svg"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between align-items-start flex-wrap" id="navbarToggle">
          <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item">
              <i class="fas fa-map-marker-alt"></i> ul. Wojskiego 11c , 80-119 Gdańsk
            </li>
            <li class="nav-item">
              <i class="fas fa-phone-alt"></i> 58 302 50 18
            </li>
          </ul>
          <a class="navbar-brand d-none d-lg-block" href="<?php bloginfo('url');?>"><img src="<?php bloginfo('template_directory');?>/img/logo.svg"></a>

          <?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'menu_class' => 'navbar-nav', 'container' => '', 'walker' => new bs4navwalker(), 'fallback_cb' => 'bs4navwalker::fallback' ) ); ?>
          <div id="searchForm" class="d-none d-lg-flex">
            <form method="get" action="<?php echo home_url('/'); ?>">
              <input type="text" id="s" name="s">
              <button type="submit"><i class="far fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <div id="mobileSearch" class="d-lg-none">
       <form method="get" action="<?php echo home_url('/'); ?>">
        <input type="text" id="s" name="s">
        <button type="submit"><i class="far fa-search"></i></button>
      </form>
    </div>

    <div id="categories">
      <div class="container">
        <div class="row">
          <?php
            global $post;

            if( is_singular('produkt') ) {
              $category = get_the_category( $post->ID );
              $current_cat = $category[0]->term_id;
            }

            $categories = get_categories( array(
              'orderby' => 'ID',
              'order'   => 'DESC',
              'hide_empty' => 0
            ) );

            foreach($categories as $category) {
              echo '<div class="col">';
              echo '<a href="'.esc_url( get_category_link( $category->term_id ) ).'" '.(( isset($current_cat) && $current_cat == $category->term_id )?'class="active"':"").'>';
              echo '<i class="'.get_term_meta($category->term_id, 'nazwa_ikony', true).'"></i> '.$category->name;
              echo '</a></div>';
            }
          ?>
        </div>
      </div>
    </div>