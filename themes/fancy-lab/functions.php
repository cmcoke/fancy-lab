<?php

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