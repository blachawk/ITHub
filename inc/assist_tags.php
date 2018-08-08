<?php

/**
 * NFFA - Set up tags to be a dropdown of options, rather than random text input on admin pages & posts
 */

//meta box functions for adding the meta box and saving the data
add_action('add_meta_boxes','nffa_meta_box_tags');
function nffa_meta_box_tags() {

add_meta_box('nffa_meta', 'Project Tag Status','nffa_meta_box','post','side','high');
}


function mmetaid() {
	return 'NFFA_meta_tags';
}

function nffa_meta_box($post) {

	$mmetaid = mmetaid();

    //GET TAGS
	$args = array(

		'orderby'                  => 'name',
		'order'                    => 'ASC',
		'hide_empty'               => 0,
		'taxonomy'                 => 'post_tag'
		);
		
	$categories=get_categories($args);
		foreach($categories as $category) { 
		$tags[] =  $category->name ;  
		}
	$mtags = array(
		'name' => 'tags',
		'desc' => 'Project Status:',
		'subdesc' => 'Please set the status of this project',
		'id' => $mmetaid,
		'type' => 'select',
		'options' => $tags
	);

	// print "<pre>";
	// print_r($mtags);
	// print "</pre>";

	//retrieve the custom meta box values
	$nffa_meta_value = get_post_meta($post->ID,$mtags['id'], true);
	//nonce for security
	wp_nonce_field(plugin_basename(__FILE__),'nffa_save_meta_box');
    //custom meta box form elements via select
	echo '<p>'.$mtags['desc'].' <select name="'. $mtags['id'].'" id="'.$mtags['id'].'">';
	foreach ($mtags['options'] as $vtag) {
		echo '<p>my nffa_meta_value is : '. $nffa_meta_value.'</p>';
		echo '<p>my vtag value is : '.$vtag.'</p>';
		echo '<option', $nffa_meta_value == $vtag ? ' selected="selected"' : '', '>', $vtag, '</option>';
	}
	echo '</select>';
	echo '</p>';
	echo '<p class="howto" id="new-tag-post_tag-desc">'.$mtags['subdesc'].'</p>';
}


//save our meta data
add_action ('save_post','nffa_save_meta_box_tags');
function nffa_save_meta_box_tags($post_id) {

	$mmetaid = mmetaid();

	//process form data if $_POST is set
	if (isset($_POST[$mmetaid])) {
		//if auto saving skip saving our meta box data
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

		//check nonce for security
		check_admin_referer(
			plugin_basename(__FILE__),'nffa_save_meta_box');
			//save the metabox data as post meta using the post ID as a  unqiue prefix
			update_post_meta($post_id,$mmetaid, sanitize_text_field($_POST[$mmetaid]));

			//dynamically set WP tag to this value!
			wp_set_post_tags($post_id, sanitize_text_field($_POST[$mmetaid]) , false);
	}
}