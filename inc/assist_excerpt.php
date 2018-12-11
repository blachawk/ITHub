<?php

	/**
	 * NFFA - TAP INTO WP HOOKS | MANAGE EXCERPT
	 * https://wordpress.stackexchange.com/questions/47808/how-to-append-to-the-excerpt-function
	 */

    //MANAGE LENGTH ON SEARCH RESULT PAGES
    function custom_excerpt_length( $length ) {
        return 10;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
