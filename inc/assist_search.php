<?php


    /**
	 * NFFA - CUSTOM HOOK | WP QUERY LOGIC FOR SEARCH INPUT FIELD (SEARCHFORM.PHP)
	 * DO ACTION
	 */
    add_action('ithub_search_helper', 'ithub_search_loop');
    if (!function_exists ('ithub_search_loop')) {
        function ithub_search_loop() {
          
            global $post;

            $unsupported_mimes  = array( 'image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/tiff', 'image/x-icon' );
            $all_mimes          = get_allowed_mime_types();
            $accepted_mimes     = array_diff( $all_mimes, $unsupported_mimes );

            //GET ATTACHMENTS
            $args_attachments = array(
                'offset'    => 0,
                'posts_per_page' => -1,
                'post_type' => 'attachment',
                'post_mime_type' => $accepted_mimes
            );
            $mdata_array_attachments = get_posts($args_attachments);
            /*highlight_string("<?php\n\$mdata_array_attachments=\n" . var_export($mdata_array_attachments, true) . ";\n?>");*/

            //GET PAGES
            $args_pages = array(
                'offset'    => 0,
                'posts_per_page' => -1,
                'post_type' => 'page'
            );
            $mdata_array_pages = get_posts($args_pages);
            /*highlight_string("<?php\n\$mdata_array_pages=\n" . var_export($mdata_array_pages, true) . ";\n?>");*/

            //GET POSTS
            // $args_posts = array(
            //     'offset'    => 0,
            //     'posts_per_page' => -1,
            //     'post_type' => 'post'
            // );
            // $mdata_array_posts = get_posts($args_posts);

            //GET CALENDAR EVENTS
            // $args_cal_events = array(
            //     'offset'    => 0,
            //     'posts_per_page' => -1,
            //     'post_type' => 'ai1ec_event'
            // );
            // $mdata_array_cal_events = get_posts($args_cal_events);
            /*highlight_string("<?php\n\$mdata_array_cal_events=\n" . var_export($mdata_array_cal_events, true) . ";\n?>");*/

            //DISPLAY PAGE AND ATTACHMENT DATA VALUES | INCLUDE META DATA HERE AT SOME POINT AS WELL
            echo "<ul class='list-group ithub-initial-hide border-0' id='mSearchList'>";
            foreach($mdata_array_attachments as $item) {
                $permalink = get_permalink($item->ID);
                $mcontent = wp_filter_nohtml_kses($item->post_content);
                
                echo "<li class='list-group-item border-0 m-0 p-0'><a href='".$permalink."' class='alert alert-ithub-dark m-0 py-3' data-meta='".$item->post_title.",".$mcontent."'>".$item->post_title."</a></li>";
            }
            foreach($mdata_array_pages as $item) {
                $permalink = get_permalink($item->ID);
                $mcontent = wp_filter_nohtml_kses($item->post_content);
                echo "<li class='list-group-item border-0 m-0 p-0'><a class='alert alert-ithub-dark m-0 py-3' href='".$permalink."' class='p-3' data-meta='".$item->post_title.",".$mcontent."'>".$item->post_title."</a></li>";
            } 

            // foreach($mdata_array_posts as $item) {
            //     $permalink = get_permalink($item->ID);
            //     $mcontent = wp_filter_nohtml_kses($item->post_content);
            //     $mexcerpt = wp_specialchars_decode(get_the_excerpt($item->ID)); 
            //     $mpubdate = get_the_date('Y-m-d', $item->ID);
            //     echo "<li class='list-group-item border-0 m-0 p-0'><a class='alert alert-ithub-dark m-0 py-3' href='".$permalink."' class='p-3' data-meta='".$item->post_title.",".$mexcerpt.",".$mpubdate."'>".$item->post_title." - ".get_the_time('Y-m-d', $item->ID)."</a></li>";
            // } 

            // foreach($mdata_array_cal_events as $item) {
            //     $permalink = get_permalink($item->ID);
            //     $mcontent = wp_filter_nohtml_kses($item->post_content);
            //     echo "<li class='list-group-item border-0 m-0 p-0'><a href='".$permalink."' class='alert alert-ithub-dark m-0 py-3' data-meta='".$item->post_title.",".$mcontent."'>".$item->post_title."</a></li>";
            // } 
            echo "</ul>";
        }
    }
