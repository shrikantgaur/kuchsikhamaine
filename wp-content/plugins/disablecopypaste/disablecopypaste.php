<?php
/*
Plugin Name: Disabled Copy Paste Text
Plugin URI: #
Description: This plugin for disabled selecting and copy text from pages.
Version: 1.0.0
Author: Shri Kant Gaur
Author URI: https://shrikantgaur.com/
License: GPL2
Icon URL: https://img.icons8.com/material-two-tone/24/null/cancel-2.png
*/
/*
function my_custom_plugin_menu() {
    add_menu_page(
        'Disabled Copy Paste Text',
        'Disabled Copy Paste Text',
        'manage_options',
        'disabled-copy-text',
        'my_custom_plugin_page',
        'dashicons-admin-plugins',
        30
    );
}
add_action( 'admin_menu', 'my_custom_plugin_menu' );

function my_custom_plugin_page() {
    echo '<h1>My Custom Plugin</h1>';
    my_custom_plugin_display_html_option();
}*/
// Register the plugin settings page
function my_custom_plugin_register_settings_page() {
    add_menu_page(
        'My Custom Plugin Settings', // Page title
        'Custom Plugin', // Menu title
        'manage_options', // Capability required to access the page
        'my-custom-plugin', // Menu slug
        'my_custom_plugin_render_settings_page', // Callback function to render the page
    );
}
add_action( 'admin_menu', 'my_custom_plugin_register_settings_page' );

// Render the plugin settings page
function my_custom_plugin_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>My Custom Plugin Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'my-custom-plugin-settings-group' );
            do_settings_sections( 'my-custom-plugin' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register the plugin settings
function my_custom_plugin_register_settings() {
    // Register the settings group
    register_setting(
        'my-custom-plugin-settings-group', // Option group
        'my_custom_plugin_settings', // Option name
        'my_custom_plugin_settings_validation' // Sanitization callback
    );

    // Add the settings section
    add_settings_section(
        'my_custom_plugin_section_1', // ID of the section
        'Disabled Select Text', // Title of the section
        'my_custom_plugin_section_1_callback', // Callback function to render the section
        'my-custom-plugin' // Page on which to display the section
    );

    // Add the settings field for Feature 1
    add_settings_field(
        'my_custom_plugin_feature_1', // ID of the field
        'Disable', // Title of the field
        'my_custom_plugin_feature_1_callback', // Callback function to render the field
        'my-custom-plugin', // Page on which to display the field
        'my_custom_plugin_section_1' // ID of the section to which the field belongs
    );

    // Add the settings section for Feature 2
    add_settings_section(
        'my_custom_plugin_section_2', // ID of the section
        'Disabled Copy Text', // Title of the section
        'my_custom_plugin_section_2_callback', // Callback function to render the section
        'my-custom-plugin' // Page on which to display the section
    );

    // Add the settings field for Feature 2
    add_settings_field(
        'my_custom_plugin_feature_2', // ID of the field
        'Disable', // Title of the field
        'my_custom_plugin_feature_2_callback', // Callback function to render the field
        'my-custom-plugin', // Page on which to display the field
        'my_custom_plugin_section_2' // ID of the section to which the field belongs
    );
}
add_action( 'admin_init', 'my_custom_plugin_register_settings' );

// Render the settings field for Feature 1
function my_custom_plugin_feature_1_callback() {
    $options = get_option( 'my_custom_plugin_settings' );
    $feature_1_enabled = isset( $options['feature_1_enabled'] ) ? $options['feature_1_enabled'] : false;
    ?>
    <input type="checkbox" name="my_custom_plugin_settings[feature_1_enabled]" <?php checked( $feature_1_enabled, true ); ?>>
    <?php
}

// Render the settings field for Feature 2
function my_custom_plugin_feature_2_callback() {
    $options = get_option( 'my_custom_plugin_settings' );
    $feature_2_enabled = isset( $options['feature_2_enabled'] ) ? $options['feature_2_enabled'] : false;
    ?>
    <input type="checkbox" name="my_custom_plugin_settings[feature_2_enabled]" <?php checked( $feature_2_enabled, true ); ?>>
    <?php

}
// Sanitize the plugin settings
function my_custom_plugin_settings_validation( $input ) {
    
    $output = [];
    // Sanitize the enable/disable settings for Feature 1
    if ( isset( $input['feature_1_enabled'] ) ) {
        $output['feature_1_enabled'] = true;
    } else {
        $output['feature_1_enabled'] = false;
    }

    // Sanitize the enable/disable settings for Feature 2
    if ( isset( $input['feature_2_enabled'] ) ) {
        $output['feature_2_enabled'] = true;
    } else {
        $output['feature_2_enabled'] = false;
    }

    return $output;

}

// add Javascript
function my_custom_plugin_enqueue_scripts() {
    wp_enqueue_script( 'my-custom-plugin-script', plugins_url( '/js/my-custom-plugin.js', __FILE__ ), array( 'jquery' ), '1.0', true );
    $options = get_option( 'my_custom_plugin_settings' );
    wp_localize_script( 'my-custom-plugin-script', 'my_custom_plugin_settings', $options );
}
add_action( 'wp_enqueue_scripts', 'my_custom_plugin_enqueue_scripts' );

// add CSS
function my_custom_plugin_enqueue_styles() {
    wp_enqueue_style( 'my-custom-plugin-style', plugins_url( '/css/my-custom-plugin.css', __FILE__ ), array(), '1.0', 'all' );
}
add_action( 'wp_enqueue_scripts', 'my_custom_plugin_enqueue_styles' );
