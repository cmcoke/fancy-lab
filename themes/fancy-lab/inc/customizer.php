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
}

// Hooks the function into the Theme Customizer registration process
add_action('customize_register', 'fancy_lab_customizer');
