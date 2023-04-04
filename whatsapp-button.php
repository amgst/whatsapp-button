<?php
/*
Plugin Name: WhatsApp Button
Plugin URI: https://wbify.com/
Description: Adds a WhatsApp button to your website
Version: 1.0
Author: Azam Munir
Author URI: https://wbify.com/
*/


function add_whatsapp_button() {
    $whatsapp_number = get_option('whatsapp_number');
    $output = '<a href="https://web.whatsapp.com/send?phone=' . $whatsapp_number . '" target="_blank"><i class="fab fa-whatsapp"></i></a>';
    echo '<div class="whatsapp-button">' . $output . '</div>';
    wp_enqueue_style( 'whatsapp-button-style', plugins_url( '/whatsapp-button.css', __FILE__ ) );
}

// Add link to readme file in plugin header
function add_readme_link_to_plugin_header( $links, $file ) {
    if ( $file == plugin_basename( __FILE__ ) ) {
        $links[] = '<a href="' . plugin_dir_url( __FILE__ ) . 'readme.txt" target="_blank">' . __( 'Readme', 'whatsapp-button' ) . '</a>';
    }
    return $links;
}
add_filter( 'plugin_row_meta', 'add_readme_link_to_plugin_header', 10, 2 );


add_action('wp_footer', 'add_whatsapp_button');

function add_whatsapp_number_settings() {
    add_option('whatsapp_number', '3347507666');
    register_setting('general', 'whatsapp_number');
}

add_action('admin_init', 'add_whatsapp_number_settings');

function add_whatsapp_number_field() {
    $whatsapp_number = get_option('whatsapp_number');
    echo '<input type="text" id="whatsapp_number" name="whatsapp_number" value="' . $whatsapp_number . '">';
}

function add_whatsapp_number_field_to_general_settings() {
    add_settings_field('whatsapp_number', 'WhatsApp Number', 'add_whatsapp_number_field', 'general');
}

add_action('admin_init', 'add_whatsapp_number_field_to_general_settings');
