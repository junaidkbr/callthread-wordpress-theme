<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package create-ape-theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'create-ape-theme' ); ?></a>

    <header id="masthead" class="navbar">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand" rel="home"><?php bloginfo( 'name' ); ?></a>

      <nav>
        <a href="#" class="mr-45">Features</a>
        <a href="#" class="mr-45">Pricing</a>
        <a href="#" class="btn btn--signin btn--blue">Sign in</a>
        <a href="#" class="btn">Become a Publisher</a>
      </nav>

      <!-- <?php
        wp_nav_menu(
          array(
            'theme_location' => 'primary'
          )
        );
      ?> -->

      <button class="navbar-menu-open">
        <img src="<?php echo get_template_directory_uri() . '/assets/images/hamburger.png'; ?>" alt="<?php _e( 'Hamburger toggle', 'create-ape-theme' ) ?>" class="w-full">
      </button>
    </header>
