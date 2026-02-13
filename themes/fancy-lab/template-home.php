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

    <section class="popular-products">
      <div class="container">
        <div class="row">Popular Products</div>
      </div>
    </section>

    <section class="new-arrivals">
      <div class="container">
        <div class="row">New Arrivals</div>
      </div>
    </section>

    <section class="deal-of-the-week">
      <div class="container">
        <div class="row">Deal of the Week</div>
      </div>
    </section>

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