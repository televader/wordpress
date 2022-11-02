<?php

function thim_child_enqueue_styles() {
	wp_enqueue_style( 'thim-parent-style', get_template_directory_uri() . '/style.css', array(), THIM_THEME_VERSION  );
}

add_action( 'wp_enqueue_scripts', 'thim_child_enqueue_styles', 1000 );

if ( ! current_user_can( 'manage_options' ) ) {
add_filter('show_admin_bar', '__return_false', 1000);
}