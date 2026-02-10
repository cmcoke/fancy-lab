<?php

/**
 * -------------------------------------------------------------
 * WordPress / WooCommerce Hooks Reference
 * -------------------------------------------------------------
 *
 * add_action()
 * -----------
 * Registers a callback function to run when a specific action hook fires.
 *
 * Syntax:
 *   add_action( $hook_name, $callback, $priority, $accepted_args );
 *
 * Parameters:
 *   $hook_name     (string)   The name of the action hook to attach to.
 *   $callback      (callable) The function (or class method) to execute.
 *   $priority      (int)      Determines execution order.
 *                             Lower numbers run earlier.
 *                             Default: 10.
 *   $accepted_args (int)      Maximum number of arguments the callback
 *                             can accept from do_action().
 *                             Default: 1.
 *
 * Example:
 *   add_action( 'woocommerce_before_main_content', 'my_function', 5 );
 *
 * -------------------------------------------------------------
 *
 * remove_action()
 * ---------------
 * Removes a previously registered callback from an action hook.
 *
 * Syntax:
 *   remove_action( $hook_name, $callback, $priority );
 *
 * Parameters:
 *   $hook_name (string)   The name of the action hook.
 *   $callback  (callable) The same callback used in add_action().
 *   $priority  (int)      MUST match the priority used when the action
 *                         was originally added.
 *                         Default: 10.
 *
 * Example:
 *   remove_action(
 *     'woocommerce_single_product_summary',
 *     'woocommerce_template_single_price',
 *     10
 *   );
 *
 * Notes:
 * - The hook name, callback, and priority must match exactly.
 * - remove_action() does NOT care about accepted arguments.
 * - The removal must run AFTER the action has been added.
 *
 * -------------------------------------------------------------
 */



// Hook into WooCommerce BEFORE the main shop content is output
// Priority 5 ensures this runs early, before most WooCommerce markup
add_action('woocommerce_before_main_content', 'fancy_lab_open_container_row', 5);

function fancy_lab_open_container_row()
{
  // Outputs opening HTML wrappers for the shop layout
  // "container shop-content" is likely a Bootstrap container
  // "row" sets up a grid row for sidebar + main content
  echo '<div class="container shop-content"><div class="row">';
}


// Hook into WooCommerce AFTER the main shop content is output
// Priority 5 ensures this closes wrappers after content finishes
add_action('woocommerce_after_main_content', 'fancy_lab_close_container_row', 5);

function fancy_lab_close_container_row()
{
  // Closes the ".row" and ".container" divs opened earlier
  echo '</div></div>';
}


// Hook before main content again, but slightly later (priority 6)
// This ensures it runs AFTER the container/row is opened
add_action('woocommerce_before_main_content', 'fancy_lab_add_sidebar_tags', 6);

function fancy_lab_add_sidebar_tags()
{
  // Outputs opening markup for the shop sidebar
  // Uses Bootstrap column classes for responsive layout
  // "order-2 order-md-1" changes sidebar position on mobile vs desktop
  echo '<div class="sidebar-shop col-lg-3 col-md-4 order-2 order-md-1">';
}


// Removes WooCommerce's default sidebar output
// This prevents WooCommerce from rendering the sidebar in its default location
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');

// Re-adds the WooCommerce sidebar manually
// Hooked into "woocommerce_before_main_content" at priority 7
// This places the sidebar INSIDE your custom wrapper markup
add_action('woocommerce_before_main_content', 'woocommerce_get_sidebar', 7);


// Closes the sidebar wrapper after the sidebar is output
// Priority 8 ensures this runs AFTER woocommerce_get_sidebar (priority 7)
add_action('woocommerce_before_main_content', 'fancy_lab_close_sidebar_tags', 8);

function fancy_lab_close_sidebar_tags()
{
  // Closes the sidebar <div>
  echo '</div>';
}


// Opens the main shop content column
// Priority 9 ensures this runs AFTER the sidebar is closed
add_action('woocommerce_before_main_content', 'fancy_lab_add_shop_tags', 9);

function fancy_lab_add_shop_tags()
{
  // Outputs opening markup for the main shop content area
  // Bootstrap grid classes define width and responsive ordering
  echo '<div class="col-lg-9 col-md-8 order-1 order-md-2">';
}


// Closes the main shop content column
// Hooked into "woocommerce_after_main_content"
// Priority 4 ensures this runs BEFORE the container/row closes (priority 5)
add_action('woocommerce_after_main_content', 'fancy_lab_close_shop_tags', 4);

function fancy_lab_close_shop_tags()
{
  // Closes the main content <div>
  echo '</div>';
}


// Hooks into WooCommerce AFTER the product title is displayed in the shop loop
// Priority 1 ensures this runs very early, before most other callbacks
add_action('woocommerce_after_shop_loop_item_title', 'the_excerpt', 1);



/**
 * -------------------------------------------------------------
 * WordPress / WooCommerce Filters Reference
 * -------------------------------------------------------------
 *
 * add_filter()
 * -----------
 * Registers a callback function to modify a value before it is
 * used or returned by WordPress or WooCommerce.
 *
 * Syntax:
 *   add_filter( $hook_name, $callback, $priority, $accepted_args );
 *
 * Parameters:
 *   $hook_name     (string)   The name of the filter hook to attach to.
 *   $callback      (callable) The function (or class method) that
 *                             modifies the value.
 *   $priority      (int)      Determines execution order.
 *                             Lower numbers run earlier.
 *                             Default: 10.
 *   $accepted_args (int)      Maximum number of arguments the callback
 *                             can accept from apply_filters().
 *                             Default: 1.
 *
 * Notes:
 * - The callback MUST return a value.
 * - Filters are used to MODIFY data, not output HTML.
 * - Each filter receives the value returned by the previous filter.
 *
 * Example:
 *   add_filter( 'woocommerce_show_page_title', 'my_filter' );
 *
 * -------------------------------------------------------------
 *
 * remove_filter()
 * ---------------
 * Removes a previously registered callback from a filter hook.
 *
 * Syntax:
 *   remove_filter( $hook_name, $callback, $priority );
 *
 * Parameters:
 *   $hook_name (string)   The name of the filter hook.
 *   $callback  (callable) The same callback used in add_filter().
 *   $priority  (int)      MUST match the priority used when the filter
 *                         was originally added.
 *                         Default: 10.
 *
 * Example:
 *   remove_filter(
 *     'woocommerce_show_page_title',
 *     'my_filter',
 *     10
 *   );
 *
 * Notes:
 * - The hook name, callback, and priority must match exactly.
 * - remove_filter() does NOT care about accepted arguments.
 * - The removal must run AFTER the filter has been added.
 *
 * -------------------------------------------------------------
 */


// Hooks into the 'woocommerce_show_page_title' filter
// This filter controls whether the shop page title is displayed

/* 
add_filter('woocommerce_show_page_title', 'fancy_lab_remove_shop_title');

function fancy_lab_remove_shop_title($val)
{
  // $val contains the current value passed by WooCommerce
  // By default, this is true (meaning: show the title)

  // Override the value to false to hide the shop page title
  $val = false;

  // Return the modified value back to WooCommerce
  return $val;
}
*/