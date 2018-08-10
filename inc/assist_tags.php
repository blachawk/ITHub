<?php

/**
 * NFFA - create a custom meta box that displays a list of wp tags, and trigger tags based on dropdown selection
 */

//creata a custom meta box for posts
add_action('add_meta_boxes','nffa_meta_box_tags');
function nffa_meta_box_tags() {
	add_meta_box('nffa_meta', 'Project Status','nffa_meta_box','post','side','high');
}

//set a string id for tags | used in multiple functions | alternative for creating a global
function mmetaid() {
	return 'NFFA_meta_tags';
}

//setup custom meta box logic
function nffa_meta_box($post) {

    //set wp argument properties for categories
	$args = array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => 0,
		'taxonomy'   => 'post_tag'
		);
		
	//through get_categories we can fetch wp tags
	$categories=get_categories($args);
		foreach($categories as $category) { 
		$tags[] =  $category->name ;
		}

	//create an array of properties to manage tag data
	$mmetaid = mmetaid();
	$mtags = array(
		'name' => 'tags',
		'desc' => 'Confirm Status:',
		'subdesc' => 'Please set the status of this project',
		'id' => $mmetaid,
		'type' => 'select',
		'options' => $tags
	);

	//display meta box data
	$nffa_meta_value = get_post_meta($post->ID,$mtags['id'], true);
	//set nonce for security
	wp_nonce_field(plugin_basename(__FILE__),'nffa_save_meta_box');
    //custom meta box form elements via select
	echo '<p>'.$mtags['desc'].' <select name="'. $mtags['id'].'" id="'.$mtags['id'].'">';
	foreach ($mtags['options'] as $vtag) {
		echo '<option', $nffa_meta_value == $vtag ? ' selected="selected"' : '', '>', $vtag, '</option>';
	}
	echo '</select>';
	echo '</p>';
	echo '<p class="howto" id="new-tag-post_tag-desc">'.$mtags['subdesc'].'</p>';
}

//save meta box data selection
add_action ('save_post','nffa_save_meta_box_tags');
function nffa_save_meta_box_tags($post_id) {

	$mmetaid = mmetaid();

	//process form data if $_POST is set
	if (isset($_POST[$mmetaid])) {

		//if auto saving skip saving our meta box data
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

		//check nonce for security
		check_admin_referer(plugin_basename(__FILE__),'nffa_save_meta_box');
		//save the metabox data as post meta using the post ID as a unqiue prefix
		update_post_meta($post_id,$mmetaid, sanitize_text_field($_POST[$mmetaid]));
		//dynamically set the WP tag to the selected value
		wp_set_post_tags($post_id, sanitize_text_field($_POST[$mmetaid]) , false);
	}
}