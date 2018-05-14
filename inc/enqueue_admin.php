<?php

//ENQUEUE STYLES AND SCRIPTS FOR SETTINGS PAGE
add_action('admin_enqueue_scripts', 'ithub_enqueue_admin');
function ithub_enqueue_admin($hook_suffix) {
    if ($hook_suffix == "toplevel_page_ithub_main_menu"){
    //THEME CSS
    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );    
    $css_version = $theme_version . '.' . filemtime(get_template_directory() . '/css/theme.min.css');
    wp_enqueue_style( 'ithub-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $css_version );
    //PLUGIN JS
    wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), $theme_version, true); 
    $js_version = $theme_version . '.' . filemtime(get_template_directory() . '/js/theme.min.js');
    wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
    wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'ithub-scripts', plugin_dir_url( __FILE__ ).'js/ithub_assist_admin.js',false,'1.0.0',true);
    }
}
