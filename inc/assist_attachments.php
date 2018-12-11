<?php

	 /**
	 * NFFA - WP QUERY LOGIC FOR ATTACHMENT PAGES
	 * DO ACTION
	 */
	 
	//ATTACHMENTS
	//I BELIEVE WE HAVE TO MANUALLY CREATE THIS CUSTOM PAGE LAYOUT! ITS SPECIAL
	//ON ATTACHMENT PAGES, DYNAMICALLY REMOVE OR HIDE THE_TITLE AND THE_CONTENT LIKE SO
	//the_title( '<h1 class=" text-center entry-title">', '</h1>' );
	//the_content();
	//https://wordpress.stackexchange.com/questions/17367/hide-page-visual-editor-if-certain-template-is-selected


    add_action('ithub_attachments', 'ithub_attachment_loop');
    if (!function_exists ('ithub_attachment_loop')) {
        function ithub_attachment_loop() {
            global $post;

            $unsupported_mimes  = array( 'image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/tiff', 'image/x-icon' );
            $all_mimes          = get_allowed_mime_types();
            $accepted_mimes     = array_diff( $all_mimes, $unsupported_mimes );

            //do loop stuff with pages
            $args = array(
                'post_type' => 'attachment',
                'post_id' => $post->ID,
                'exclude' => get_post_thumbnail_id(),
                'post_mime_type' => $accepted_mimes
            );

            $mattachments_array = get_posts($args);

            //used when needed, for visually dissecting array data
            /*highlight_string("<?php\n\$mattachments_array=\n" . var_export($mattachments_array, true) . ";\n?>");*/
            
            //parse array
            foreach($mattachments_array as $attachment) {
                //wp way fo handling non-absolute, schemeless and relative url’s 
                $parsed = wp_parse_url(wp_get_attachment_url($attachment->ID));
                $url = dirname( $parsed [ 'path' ] ) . '/' . rawurlencode( basename( $parsed[ 'path' ] ) );

                //get and set proper favicons based on mime type | switch case later for more types
                if ($attachment->post_mime_type == "application/pdf") {
                    $mfaicon = "<i class='far fa-file-pdf'></i>";
                }
                echo "<header class='entry-header'>";
                echo the_title( "<h1 class='entry-title'>{$mfaicon} ", "</h1>" );
                echo "</header>";
                echo "<div class='entry-content'>";
                echo "<p><a href='".$url."'>Document Link {$mfaicon}</a></p>";
                echo the_content();
                echo  "</div>";
            } 
        }
    }
