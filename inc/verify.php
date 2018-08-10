<?php

//VERIFY THIS PLUGIN IS COMPLIANT WITH WORDPRESS SETTINGS 

register_activation_hook(__FILE__,'ithub_assistant_install');
function ithub_assistant_install() {

    //VERIFY THAT THE CURRENT WP VERSION IS COMPATIBLE    
    if ( get_bloginfo( 'version' )  < '4.9.5' ) {
    wp_die('This plugin requires WordPress version 4.9.5 or higher. Sorry!');
    }
    //VERIFY THAT UNDERSTRAP IS INSTALLED
    if ( function_exists( 'understrap_setup' ) ) {
    // UnderStrap is the current theme or the active theme's parent.
    } else {
        wp_die('This plugin requires UnderStrap theme to be installed and active.'); 
    }
    //VERIFY THAT ADVANCED CUSTOM FIELDS IS INSTALLED
    if ( function_exists('acf_form_wp_head' ) ) {
    // ACF is installed as a plugin
    } else {
    wp_die('This plugin requires Advanced Custom Fields to be installed and active.');
    }
}

//DISPLAY ADMIN NOTIFICATIONS FOR THIS PLUGIN
//add_action( 'admin_notices', 'ithub_notices' );
function ithub_notices() {
    ?>
    <div class="updated notice">
        <p>
            <?php 
        _e( 'IT Hub Assistant is now active', 'ithub_textdomain' ); 
        // echo '<br>';
        // echo plugin_dir_path(__FILE__);
        // echo '<br>';
        // echo plugin_dir_path(__FILE__ . '/js/scripts.js');
        // echo '<br>';
        // echo admin_url();
        ?>
        </p>
    </div>
    <?php
}
