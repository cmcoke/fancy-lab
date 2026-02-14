<?php

/**
 * Registers custom Theme Customizer options
 * for managing footer copyright text.
 */

function fancy_lab_customizer($wp_customize)
{

  // Copyright Section
  $wp_customize->add_section(
    'sec_copyright', // Unique ID used to reference this Customizer section
    array(
      'title'      => 'Copyright Settings', // Section title displayed in the Customizer panel
      'description'  => 'Copyright Section' // Description shown under the section title
    )
  );

  // Field 1 - Copyright Text Box
  $wp_customize->add_setting(
    'set_copyright', // Unique ID used to store and retrieve the copyright value
    array(
      'type'          => 'theme_mod', // Stores the value as a theme modification (saved in the database per theme)
      'default'        => '', // Default value if user has not entered copyright text
      'sanitize_callback'    => 'sanitize_text_field' // Sanitizes user input to prevent unsafe or invalid data
    )
  );

  // Adds a control (input field) to the Customizer UI
  $wp_customize->add_control(
    'set_copyright', // Links this control to the 'set_copyright' setting
    array(
      'label'      => 'Copyright', // Label displayed above the input field
      'description'  => 'Please, add your copyright information here', // Helper text displayed below the label
      'section'    => 'sec_copyright', // Assigns this control to the Copyright section
      'type'      => 'text' // Defines this control as a single-line text input field
    )
  );


  /*--------------------------------------------------------------------------------*/

  /**
   * Summary:
   *
   * This block of code registers a new "Slider Settings" section
   * in the WordPress Customizer.
   *
   * It allows the administrator to:
   * - Select up to 3 pages to display in a homepage slider
   * - Set custom button text for each slide
   * - Define a custom button URL for each slide
   *
   * All values are stored as theme_mods and properly sanitized
   * before being saved to the database.
   */


  // Creates a new section in the WordPress Customizer
  $wp_customize->add_section(
    'sec_slider', // Unique ID for the Slider section
    array(
      'title'      => 'Slider Settings', // Title displayed in the Customizer panel
      'description'  => 'Slider Section' // Description shown under the section title
    ) // End of section arguments
  );


  // Field 1 - Slider Page Number 1

  // Registers a setting to store the selected page ID for slide 1
  $wp_customize->add_setting(
    'set_slider_page1', // Unique ID used to retrieve this setting later
    array(
      'type'          => 'theme_mod', // Stores value as a theme modification
      'default'        => '', // Default value (empty if not set)
      'sanitize_callback'    => 'absint' // Ensures the value is saved as a positive integer (page ID)
    )
  );

  // Adds a dropdown control to select a page for slide 1
  $wp_customize->add_control(
    'set_slider_page1', // Links control to the above setting
    array(
      'label'      => 'Set slider page 1', // Label displayed above the field
      'description'  => 'Set slider page 1', // Helper text shown below the field
      'section'    => 'sec_slider', // Places this control inside the Slider section
      'type'      => 'dropdown-pages' // Creates a dropdown list of existing pages
    )
  );


  // Field 2 - Slider Button Text Number 1

  // Registers a setting to store button text for slide 1
  $wp_customize->add_setting(
    'set_slider_button_text1', // Unique setting ID
    array(
      'type'          => 'theme_mod', // Saved as a theme modification
      'default'        => '', // Default empty value
      'sanitize_callback'    => 'sanitize_text_field' // Cleans text input before saving
    )
  );

  // Adds a text input control for slide 1 button text
  $wp_customize->add_control(
    'set_slider_button_text1', // Associates control with setting
    array(
      'label'      => 'Button Text for Page 1', // Field label
      'description'  => 'Button Text for Page 1', // Field description
      'section'    => 'sec_slider', // Slider section
      'type'      => 'text' // Standard text input field
    )
  );


  // Field 3 - Slider Button URL Number 1

  // Registers a setting to store button URL for slide 1
  $wp_customize->add_setting(
    'set_slider_button_url1', // Unique setting ID
    array(
      'type'          => 'theme_mod', // Stored as theme modification
      'default'        => '', // Default empty value
      'sanitize_callback'    => 'esc_url_raw' // Sanitizes and validates URL before saving
    )
  );

  // Adds a URL input control for slide 1 button link
  $wp_customize->add_control(
    'set_slider_button_url1', // Connects control to setting
    array(
      'label'      => 'URL for Page 1', // Field label
      'description'  => 'URL for Page 1', // Field description
      'section'    => 'sec_slider', // Slider section
      'type'      => 'url' // URL input field (HTML5 validation)
    )
  );


  /*---------------------------------------*/


  // Field 4 - Slider Page Number 2

  // Registers setting for slide 2 page ID
  $wp_customize->add_setting(
    'set_slider_page2', // Unique setting ID
    array(
      'type'          => 'theme_mod', // Stored as theme modification
      'default'        => '', // Default empty value
      'sanitize_callback'    => 'absint' // Ensures value is an integer
    )
  );

  // Adds page dropdown for slide 2
  $wp_customize->add_control(
    'set_slider_page2', // Connects to setting
    array(
      'label'      => 'Set slider page 2', // Field label
      'description'  => 'Set slider page 2', // Field description
      'section'    => 'sec_slider', // Slider section
      'type'      => 'dropdown-pages' // Dropdown of pages
    )
  );


  // Field 5 - Slider Button Text Number 2

  // Registers button text setting for slide 2
  $wp_customize->add_setting(
    'set_slider_button_text2', // Unique ID
    array(
      'type'          => 'theme_mod', // Theme modification
      'default'        => '', // Default value
      'sanitize_callback'    => 'sanitize_text_field' // Sanitizes text input
    )
  );

  // Adds text control for slide 2 button text
  $wp_customize->add_control(
    'set_slider_button_text2', // Connects to setting
    array(
      'label'      => 'Button Text for Page 2', // Label
      'description'  => 'Button Text for Page 2', // Description
      'section'    => 'sec_slider', // Slider section
      'type'      => 'text' // Text input
    )
  );


  // Field 6 - Slider Button URL Number 2

  // Registers button URL setting for slide 2
  $wp_customize->add_setting(
    'set_slider_button_url2', // Unique ID
    array(
      'type'          => 'theme_mod', // Stored as theme mod
      'default'        => '', // Default empty value
      'sanitize_callback'    => 'esc_url_raw' // Validates URL before saving
    )
  );

  // Adds URL control for slide 2 button
  $wp_customize->add_control(
    'set_slider_button_url2', // Connects to setting
    array(
      'label'      => 'URL for Page 2', // Label
      'description'  => 'URL for Page 2', // Description
      'section'    => 'sec_slider', // Slider section
      'type'      => 'url' // URL field
    )
  );


  /*---------------------------------------*/


  // Field 7 - Slider Page Number 3

  // Registers setting for slide 3 page ID
  $wp_customize->add_setting(
    'set_slider_page3', // Unique ID
    array(
      'type'          => 'theme_mod', // Stored as theme mod
      'default'        => '', // Default value
      'sanitize_callback'    => 'absint' // Ensures value is an integer
    )
  );

  // Adds page dropdown for slide 3
  $wp_customize->add_control(
    'set_slider_page3', // Connects to setting
    array(
      'label'      => 'Set slider page 3', // Label
      'description'  => 'Set slider page 3', // Description
      'section'    => 'sec_slider', // Slider section
      'type'      => 'dropdown-pages' // Page dropdown
    )
  );


  // Field 8 - Slider Button Text Number 3

  // Registers button text setting for slide 3
  $wp_customize->add_setting(
    'set_slider_button_text3', // Unique ID
    array(
      'type'          => 'theme_mod', // Stored as theme mod
      'default'        => '', // Default empty value
      'sanitize_callback'    => 'sanitize_text_field' // Sanitizes text input
    )
  );

  // Adds text control for slide 3 button text
  $wp_customize->add_control(
    'set_slider_button_text3', // Connects to setting
    array(
      'label'      => 'Button Text for Page 3', // Label
      'description'  => 'Button Text for Page 3', // Description
      'section'    => 'sec_slider', // Slider section
      'type'      => 'text' // Text input
    )
  );


  // Field 9 - Slider Button URL Number 3

  // Registers button URL setting for slide 3
  $wp_customize->add_setting(
    'set_slider_button_url3', // Unique ID
    array(
      'type'          => 'theme_mod', // Stored as theme mod
      'default'        => '', // Default value
      'sanitize_callback'    => 'esc_url_raw' // Validates URL before saving
    )
  );

  // Adds URL control for slide 3 button
  $wp_customize->add_control(
    'set_slider_button_url3', // Connects to setting
    array(
      'label'      => 'URL for Page 3', // Label
      'description'  => 'URL for Page 3', // Description
      'section'    => 'sec_slider', // Slider section
      'type'      => 'url' // URL input field
    )
  );



  /*--------------------------------------------------------------------------------*/

  /**
   * -------------------------------------------------------------
   * Home Page Customizer Settings
   * -------------------------------------------------------------
   *
   * Registers Customizer options that allow the admin to control:
   *
   * - Popular Products (number of products + columns)
   * - New Arrivals (number of products + columns)
   * - Deal of the Week (toggle display + product ID)
   *
   * All values are stored as theme_mods and can be retrieved
   * using get_theme_mod() inside theme templates.
   * -------------------------------------------------------------
   */


  // Creates a new section in the Theme Customizer for homepage settings
  $wp_customize->add_section(
    'sec_home_page', // Unique section ID used internally
    array(
      'title'      => 'Home Page Products and Blog Settings', // Section title displayed in Customizer
      'description'  => 'Home Page Section' // Small description shown under section title
    )
  );


  // Popular Products - Maximum number of products to display
  $wp_customize->add_setting(
    'set_popular_max_num', // Setting ID used with get_theme_mod()
    array(
      'type'          => 'theme_mod', // Stores value in theme modifications table
      'default'        => '', // Default value if none is saved
      'sanitize_callback'    => 'absint' // Ensures value is saved as a positive integer
    )
  );

  // Adds number input field for Popular Products limit
  $wp_customize->add_control(
    'set_popular_max_num', // Links control to the above setting
    array(
      'label'      => 'Popular Products Max Number', // Label shown in Customizer
      'description'  => 'Popular Products Max Number', // Help text under field
      'section'    => 'sec_home_page', // Assigns control to homepage section
      'type'      => 'number' // Renders an HTML number input field
    )
  );


  // Popular Products - Number of columns to display
  $wp_customize->add_setting(
    'set_popular_max_col', // Setting ID for columns
    array(
      'type'          => 'theme_mod', // Stored as theme modification
      'default'        => '', // Default empty value
      'sanitize_callback'    => 'absint' // Forces integer value
    )
  );

  // Adds number input for Popular Product columns
  $wp_customize->add_control(
    'set_popular_max_col', // Associates control with column setting
    array(
      'label'      => 'Popular Products Max Columns', // Control label
      'description'  => 'Popular Products Max Columns', // Help text
      'section'    => 'sec_home_page', // Section placement
      'type'      => 'number' // Number input field
    )
  );


  // New Arrivals - Maximum number of products
  $wp_customize->add_setting(
    'set_new_arrivals_max_num', // Setting ID
    array(
      'type'          => 'theme_mod', // Stored in theme mods
      'default'        => '', // Default empty
      'sanitize_callback'    => 'absint' // Convert to positive integer
    )
  );

  // Adds number control for New Arrivals limit
  $wp_customize->add_control(
    'set_new_arrivals_max_num', // Connects to setting
    array(
      'label'      => 'New Arrivals Max Number', // Label
      'description'  => 'New Arrivals Max Number', // Help text
      'section'    => 'sec_home_page', // Customizer section
      'type'      => 'number' // Number input
    )
  );


  // New Arrivals - Number of columns
  $wp_customize->add_setting(
    'set_new_arrivals_max_col', // Setting ID
    array(
      'type'          => 'theme_mod', // Stored in theme mods
      'default'        => '', // Default empty
      'sanitize_callback'    => 'absint' // Ensure integer value
    )
  );

  // Adds number control for New Arrivals columns
  $wp_customize->add_control(
    'set_new_arrivals_max_col', // Connects to setting
    array(
      'label'      => 'New Arrivals Max Columns', // Label text
      'description'  => 'New Arrivals Max Columns', // Help description
      'section'    => 'sec_home_page', // Section placement
      'type'      => 'number' // Number input field
    )
  );


  // Deal of the Week - Toggle visibility (checkbox)
  $wp_customize->add_setting(
    'set_deal_show', // Setting ID for showing deal section
    array(
      'type'          => 'theme_mod', // Stored in theme mods
      'default'        => '', // Default empty (unchecked)
      'sanitize_callback'    => 'fancy_lab_sanitize_checkbox' // Custom sanitize function for checkbox
    )
  );

  // Adds checkbox control for Deal of the Week visibility
  $wp_customize->add_control(
    'set_deal_show', // Links control to checkbox setting
    array(
      'label'      => 'Show Deal of the Week?', // Checkbox label
      'section'    => 'sec_home_page', // Section placement
      'type'      => 'checkbox' // Renders checkbox input
    )
  );


  // Deal of the Week - Product ID to display
  $wp_customize->add_setting(
    'set_deal', // Setting ID for selected product
    array(
      'type'          => 'theme_mod', // Stored in theme mods
      'default'        => '', // Default empty
      'sanitize_callback'    => 'absint' // Ensures saved value is an integer (product ID)
    )
  );

  // Adds number control for entering Product ID
  $wp_customize->add_control(
    'set_deal', // Associates control with product ID setting
    array(
      'label'      => 'Deal of the Week Product ID', // Label text
      'description'  => 'Product ID to Display', // Help text
      'section'    => 'sec_home_page', // Section placement
      'type'      => 'number' // Number input field
    )
  );
}

// Hooks the function into the Theme Customizer registration process
add_action('customize_register', 'fancy_lab_customizer');


// Sanitizes checkbox values to ensure true or false is saved
function fancy_lab_sanitize_checkbox($checked)
{
  // Returns true only if checkbox is set and equals true; otherwise returns false
  return ((isset($checked) && true == $checked) ? true : false);
}