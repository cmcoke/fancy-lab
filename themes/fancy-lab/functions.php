<?php

// Register Custom Navigation Walker
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';


function fancy_lab_scripts()
{

  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js', array('jquery'), '4.6.2', true);
  wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', array(), '4.6.2', 'all');

  /**
   * Enqueue the main theme stylesheet.
   *
   * - 'fancy-lab-style' is the unique handle for this stylesheet.
   * 
   * - get_stylesheet_uri() returns the URL to style.css of the active theme
   *   (child theme if one is active, otherwise the parent theme).
   * 
   * - array() specifies dependencies; empty means this stylesheet has none.
   * 
   * - filemtime( get_template_directory() . '/style.css' ) uses the last
   *   modified timestamp of the parent theme’s style.css as the version number.
   *   This is mainly intended for development to automatically bust browser
   *   caches when the CSS file changes. In production, a static version number
   *   should be used instead to avoid unnecessary filesystem checks and to
   *   improve performance.
   * 
   * - 'all' sets the media attribute, meaning the stylesheet applies to all
   *   media types (screen, print, etc.).
   */
  wp_enqueue_style('fancy-lab-style', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'), 'all');
}
add_action('wp_enqueue_scripts', 'fancy_lab_scripts');



function fancy_lab_config()
{
  // registers the main and footer menu
  register_nav_menus(
    array(
      'fancy_lab_main_menu'   => 'Fancy Lab Main Menu',
      'fancy_lab_footer_menu' => 'Fancy Lab Footer Menu',
    )
  );

  // Declare WooCommerce support for this theme and configure WooCommerce-specific settings
  add_theme_support('woocommerce', array(
    'thumbnail_image_width' => 255, // Sets the width (in pixels) for product thumbnail images (e.g., shop and archive pages)
    'single_image_width'    => 255, // Sets the width (in pixels) for the main product image on single product pages

    // Configure the default layout behavior for the WooCommerce product grid
    'product_grid' => array(
      'default_rows'    => 10, // Defines the default number of product rows displayed per page
      'min_rows'        => 5,  // Sets the minimum number of rows allowed in the product grid
      'max_rows'        => 10, // Sets the maximum number of rows allowed in the product grid
      'default_columns' => 1,  // Defines the default number of product columns in the grid
      'min_columns'     => 1,  // Sets the minimum number of columns allowed
      'max_columns'     => 1,  // Sets the maximum number of columns allowed
    )
  ));

  // Enables zoom functionality on the main product image in the product gallery
  add_theme_support('wc-product-gallery-zoom');

  // Enables a lightbox (modal overlay) when clicking product gallery images
  add_theme_support('wc-product-gallery-lightbox');

  // Enables a slider/carousel for navigating between product gallery images
  add_theme_support('wc-product-gallery-slider');

  // Define the maximum allowed width for content (in pixels) if it hasn’t already been set by the theme
  if (! isset($content_width)) {
    $content_width = 600;
  }
}
add_action('after_setup_theme', 'fancy_lab_config', 0);



// If WooCommerce is installed and activated, load the theme's WooCommerce customizations
if (class_exists('WooCommerce')) {
  // Include the file that contains WooCommerce-specific modifications
  require get_template_directory() . '/inc/wc-modifications.php';
}