<?php

function allstore_child_scripts_styles() {
    wp_enqueue_style( 'allstore-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'allstore_child_scripts_styles' );
 