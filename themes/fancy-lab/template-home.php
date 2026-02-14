<?php

/*
Template Name: Home Page
*/

get_header(); ?>

<div class="content-area">
  <main>
    <section class="slider">
      <div class="flexslider">
        <ul class="slides">
          <?php
          // Loop 3 times to retrieve Customizer values for slides 1–3
          for ($i = 1; $i < 4; $i++) :
            $slider_page[$i] = get_theme_mod('set_slider_page' . $i); // Retrieves selected page ID for slide $i from Customizer
            $slider_button_text[$i] = get_theme_mod('set_slider_button_text' . $i); // Retrieves button text for slide $i
            $slider_button_url[$i] = get_theme_mod('set_slider_button_url' . $i); // Retrieves button URL for slide $i
          endfor;

          // Prepare custom query arguments to retrieve selected slider pages
          $args = array(
            'post_type'      => 'page', // Only query WordPress pages
            'posts_per_page'  => 3, // Limit results to 3 pages
            'post__in'      => $slider_page, // Only include the selected page IDs
            'orderby'      => 'post__in', // Preserve the order defined in the $slider_page array
          );

          // Create a new custom WP_Query instance for the slider
          $slider_loop = new WP_Query($args);

          // Counter variable used to match button text and URL to each slide
          $j = 1;

          // Check if the custom slider query has posts
          if ($slider_loop->have_posts()):
            // Start looping through the slider pages
            while ($slider_loop->have_posts()):
              // Set up post data for each slide
              $slider_loop->the_post();
          ?>
          <li>
            <!-- the_post_thumbnail('fancy-lab-slider', array('class' => 'img-fluid')); -- 
                     Displays the featured image of the current page using the
                     custom image size 'fancy-lab-slider' and adds the Bootstrap
                     class 'img-fluid' for responsive styling -->
            <?php the_post_thumbnail('fancy-lab-slider', array('class' => 'img-fluid')); ?>

            <div class="container">
              <div class="slider-details-container">
                <div class="slider-title">
                  <h1><?php the_title(); ?></h1> <!-- Outputs the page title -->
                </div>
                <div class="slider-description">
                  <div class="subtitle"><?php the_content(); ?></div> <!-- Outputs the page content -->

                  <!-- echo $slider_button_url[$j]; -- 
                           Outputs the Customizer-defined button URL for the current slide -->

                  <!-- echo $slider_button_text[$j]; -- 
                           Outputs the Customizer-defined button text for the current slide -->

                  <a class="link" href="<?php echo $slider_button_url[$j]; ?>">
                    <?php echo $slider_button_text[$j]; ?>
                  </a>
                </div>
              </div>
            </div>
          </li>
          <?php
              $j++; // Increment counter to move to next slide's button text and URL
            endwhile;

            // Reset global post data back to the main query
            wp_reset_postdata();
          endif;
          ?>
        </ul>
      </div>
    </section>

    <!-- Check if the WooCommerce plugin is active before displaying shop sections -->
    <?php if (class_exists('WooCommerce')): ?>

    <section class="popular-products">
      <?php
        $popular_limit    = get_theme_mod('set_popular_max_num', 4); // Retrieves the maximum number of popular products to display (default is 4)
        $popular_col     = get_theme_mod('set_popular_max_col', 4); // Retrieves the number of columns for popular products (default is 4)
        $arrivals_limit    = get_theme_mod('set_new_arrivals_max_num', 4); // Retrieves the maximum number of new arrival products to display (default is 4)
        $arrivals_col    = get_theme_mod('set_new_arrivals_max_col', 4); // Retrieves the number of columns for new arrivals (default is 4)
        ?>
      <div class="container">
        <h2>Popular Products</h2>
        <!-- Executes the WooCommerce [products] shortcode to display popular products using the selected limit and column settings -->
        <?php echo do_shortcode('[products limit=" ' . $popular_limit . ' " columns=" ' . $popular_col . ' " orderby="popularity"]'); ?>
      </div>
    </section>

    <section class="new-arrivals">
      <div class="container">
        <h2>New Arrivals</h2>
        <!-- Executes the WooCommerce [products] shortcode to display newest products ordered by date -->
        <?php echo do_shortcode('[products limit=" ' . $arrivals_limit . ' " columns=" ' . $arrivals_col . ' " orderby="date"]'); ?>
      </div>
    </section>

    <?php

      $showdeal      = get_theme_mod('set_deal_show', 0); // Retrieves setting to determine whether the Deal of the Week section should be displayed (default is hidden)
      $deal         = get_theme_mod('set_deal'); // Retrieves the selected product ID for the Deal of the Week
      $currency      = get_woocommerce_currency_symbol(); // Gets the store’s currency symbol (e.g., $, €, etc.)
      $regular      = get_post_meta($deal, '_regular_price', true); // Retrieves the product’s regular price
      $sale         = get_post_meta($deal, '_sale_price', true); // Retrieves the product’s sale price

      // Checks that the deal section is enabled and that a product has been selected
      if ($showdeal == 1 && (!empty($deal))):
        // Calculates the discount percentage based on regular and sale prices
        $discount_percentage = absint(100 - (($sale / $regular) * 100));

      ?>

    <section class="deal-of-the-week">
      <div class="container">
        <h2>Deal of the Week</h2>
        <div class="row d-flex align-items-center">
          <div class="deal-img col-md-6 col-12 ml-auto text-center">
            <!-- Displays the featured image (thumbnail) of the selected deal product -->
            <?php echo get_the_post_thumbnail($deal, 'large', array('class' => 'img-fluid')); ?>
          </div>
          <div class="deal-desc col-md-4 col-12 mr-auto text-center">
            <!-- Checks if the product has a sale price before showing the discount badge -->
            <?php if (!empty($sale)): ?>
            <span class="discount">
              <!-- Outputs the calculated discount percentage -->
              <?php echo $discount_percentage . '% OFF'; ?>
            </span>
            <?php endif; ?>
            <h3>
              <!-- Displays the product title as a clickable link to the single product page -->
              <a href="<?php echo get_permalink($deal); ?>"><?php echo get_the_title($deal); ?></a>
            </h3>
            <!-- Displays the product short description (excerpt) -->
            <p><?php echo get_the_excerpt($deal); ?></p>
            <div class="prices">
              <span class="regular">
                <?php
                    echo $currency; // Outputs the store currency symbol
                    echo $regular; // Outputs the product’s regular price
                    ?>
              </span>
              <!-- Checks if a sale price exists before displaying it -->
              <?php if (!empty($sale)): ?>
              <span class="sale">
                <?php
                      echo $currency; // Outputs the store currency symbol
                      echo $sale; // Outputs the product’s sale price
                      ?>
              </span>
              <?php endif; ?>
            </div>
            <!-- Generates an Add to Cart link for the selected deal product -->
            <a href="<?php echo esc_url('?add-to-cart=' . $deal); ?>" class="add-to-cart">Add to Cart</a>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <?php endif; ?>


    <section class="lab-blog">
      <div class="container">
        <div class="row">
          <?php
          // Check if there are posts available in the main WordPress query
          if (have_posts()):

            // Start the main WordPress loop
            while (have_posts()):
              the_post(); // Sets up post data for template tags
          ?>
          <article>
            <h2><?php the_title(); ?></h2> <!-- Outputs post title -->
            <div><?php the_content(); ?></div> <!-- Outputs full post content -->
          </article>
          <?php
            endwhile;

          else:
            ?>
          <p>Nothing to display.</p> <!-- Displayed if no posts are found -->
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>
</div>

<?php get_footer(); ?>