<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="profile" href="https://gmpg.org/xfn/11" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="page" class="site">
    <header>

      <section class="search">
        <div class="container">
          <div class="text-center d-md-flex align-items-center">
            <!-- outputs the search form from the searchform.php file -->
            <?php get_search_form(); ?>
          </div>
        </div>
      </section>

      <section class="top-bar">
        <div class="container">
          <div class="row d-flex align-items-center">
            <div class="col-12 col-md-3 col-lg-2 brand text-center text-md-left">
              <a href="<?php echo home_url('/') ?>">
                <!-- if the theme has a custom logo display it -->
                <?php if (has_custom_logo()): ?>
                <?php the_custom_logo(); ?>
                <!-- else display the theme's title and description -->
                <?php else: ?>
                <p class="site-title"><?php bloginfo('title'); ?></p>
                <span><?php bloginfo('description'); ?></span>
                <?php endif; ?>
              </a>
            </div>
            <div class="col-12 col-md-9 col-lg-10 second-column">
              <div class="row">
                <!-- Check if the WooCommerce plugin is active before displaying account and cart features -->
                <?php if (class_exists('WooCommerce')): ?>
                <div class="acount col-12">
                  <div class="navbar-expand">
                    <ul class="navbar-nav float-left">
                      <!-- If the user is logged in, show My Account and Logout links -->
                      <?php if (is_user_logged_in()) : ?>
                      <li>
                        <!-- echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) -- Retrieves the My Account page ID from WooCommerce settings, gets its permalink, and escapes the URL for safe output -->
                        <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                          class="nav-link">My Account</a>
                      </li>
                      <li>
                        <!-- echo esc_url(wp_logout_url(get_permalink(get_option('woocommerce_myaccount_page_id')))) -- Generates a secure logout URL and redirects the user to the My Account page after logging out -->
                        <a href="<?php echo esc_url(wp_logout_url(get_permalink(get_option('woocommerce_myaccount_page_id')))) ?>"
                          class="nav-link">Logout</a>
                      </li>
                      <!-- If the user is not logged in, show Login / Register link -->
                      <?php else: ?>
                      <li>
                        <!-- echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) -- Retrieves and safely outputs the URL of the WooCommerce My Account page -->
                        <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"
                          class="nav-link">Login / Register</a>
                      </li>
                      <?php endif; ?>
                    </ul>
                  </div>
                  <div class="cart text-right">
                    <!--  echo wc_get_cart_url() -- returns a link to the Cart page -->
                    <a href="<?php echo wc_get_cart_url(); ?>"><span class="cart-icon"></span></a>

                    <!-- echo WC()->cart->get_cart_contents_count() -- retrieve the total number of items in the cart, including their quantities. -->
                    <span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                  </div>
                </div>
                <?php endif; ?>
                <div class="col-12">
                  <nav class="main-menu navbar navbar-expand-md navbar-light" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse"
                      data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1"
                      aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Outputs the registered WordPress navigation menu using Bootstrap-compatible markup -->
                    <?php
                    wp_nav_menu(array(
                      'theme_location'  => 'fancy_lab_main_menu', // The registered menu location in functions.php
                      'depth'           => 3, // Allows up to 3 levels of dropdown menu items
                      'container'       => 'div', // Wraps the menu in a <div> element
                      'container_class' => 'collapse navbar-collapse', // Adds Bootstrap collapse classes for responsive behavior
                      'container_id'    => 'bs-example-navbar-collapse-1', // ID used by the navbar toggler button to control collapse
                      'menu_class'      => 'nav navbar-nav', // CSS classes applied to the <ul> element
                      'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback', // Fallback method if no menu is assigned
                      'walker'          => new WP_Bootstrap_Navwalker(), // Custom walker to output Bootstrap-compatible menu markup
                    ));

                    ?>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </header>