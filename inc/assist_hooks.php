<?php

	/**
	 * NFFA - TAP INTO WP HOOKS | ADD CLASS TO MAIN NAVIGATION
	 * arg values - https://developer.wordpress.org/reference/functions/wp_nav_menu/
	 */
	add_filter('wp_nav_menu_args', 'ithub_nav_menu_args');
	if ( ! function_exists ( 'ithub_nav_menu_args' ) ) {
		function ithub_nav_menu_args( $args ) {
			if( 'primary' == $args['theme_location'] ) {
			$args['menu_class'] = 'navbar-nav ml-auto';
			}
		return $args;
		}
    }

   /**
	* NFFA - TAP INTO WP HOOKS | REGISTER FOOTER MENU
	* 4 EASY STEPS FOR MANAGING ADDITIONAL WP NAVIGATION MENUS FROM START TO FINISH
	* 1 - Below, always register a new navigation menu below with the a new 'Theme Location' name, first.
	* 2 - Then In WP Admin, create and assign menu the given 'Theme Location' name.
	* 3 - Then come back here to Add filter with wp_nav_menu_items for adding additional li's
	* 4 - Finally, add the menu to a custom page layout in the following code - wp_nav_menu( array( 'theme_location' => 'footer_nav' ) );
	*/
	add_action('init', 'ithub_register_wp_menus');
	if ( ! function_exists ( 'ithub_register_wp_menus' ) ) {
		function ithub_register_wp_menus() {
            register_nav_menus([
                'footer_nav' =>__('Footer Nav Menu')
            ]);
		}
	}

	/**
	 * NFFA - TAP INTO WP HOOKS | EXTEND FOOTER MENU WITH AN ADDITIONAL LI ELEMENT
	 */
	add_filter('wp_nav_menu_items','ithub_extend_footer_menu', 10, 2);
	if ( ! function_exists ( 'ithub_extend_footer_menu' ) ) {
		function ithub_extend_footer_menu( $items, $args ) {
            if( $args->theme_location == 'footer_nav')  {
            //append copy info to footer nav
            $items .=  '<li class="menu-item">&copy;2018 National FFA Organization</li>';
            }
            return $items;
		}
    }
    
    /**
	* NFFA - TAP INTO WP HOOKS | REMOVE POSTS FROM WP ADMIN MENU
	*/
	add_action('admin_menu', 'ithub_remove_wpadmin_menu');
	if ( ! function_exists ( 'ithub_remove_wpadmin_menu' ) ) {
		function ithub_remove_wpadmin_menu() {
			remove_menu_page('edit.php');
		}
	}
	
	/**
	 * NFFA - TAP INTO WP HOOKS | 301 REDIRECTS
	 */
	add_action( 'template_redirect', 'ithub_301_redirects' );
	if ( ! function_exists ( 'ithub_301_redirects' ) ) {
		function ithub_301_redirects() {
			global $wp; //we can read them, just don't create them.
			$url_part = add_query_arg(array(),$wp->request);
			//SET CONDITIONAL SCENARIOS HERE...
			if ($url_part == "it-list-of-projects") {
				wp_redirect( home_url( '/projects/'));
				exit();
			}
		}
    }



//HOME
//REMOVE TITLE
//APPEND CONTENT TO DO ACTION

//ABOUT IT


//SEND A REQUEST


//PROJECTS


//POLICIES AND PROCEDURES


//IT APPS


//IT CALENDAR


//KNOWLEDGE BASED ARTICLES


//SEARCH


//ATTACHMENTS
//ON ATTACHMENT PAGES, DYNAMICALLY REMOVE OR HIDE THE_TITLE AND THE_CONTENT LIKE SO
//the_title( '<h1 class=" text-center entry-title">', '</h1>' );
//the_content();
//https://wordpress.stackexchange.com/questions/17367/hide-page-visual-editor-if-certain-template-is-selected


