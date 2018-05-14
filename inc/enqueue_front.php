<?php

//ENQUEUE STYLES AND SCRIPTS FOR CUSTOMER-SIDE
add_action('wp_enqueue_scripts', 'ithub_enqueue', 11);
function ithub_enqueue() {
    wp_enqueue_script( 'ithub-scripts', plugin_dir_url( __FILE__ ).'../js/ithub_assist.js',false,'1.0.0',true); 
}

//REMOVE UNNECESSARY SCRIPTS LOADING FROM CUSTOMER-SIDE
add_action( 'wp_footer', 'my_deregister_scripts' );
function my_deregister_scripts(){
	wp_deregister_script( 'wp-embed' );
}
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');