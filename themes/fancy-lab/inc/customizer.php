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
}

// Hooks the function into the Theme Customizer registration process
add_action('customize_register', 'fancy_lab_customizer');