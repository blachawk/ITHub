<?php

/**
 * NFFA - Set custom permissions for editors
 */
$roleEditor = get_role( 'editor' );

//if the role does not have this privalge by default, give them the capability
if (!$roleEditor->has_cap( 'edit_theme_options' ) ) {
	$roleEditor->add_cap( 'edit_theme_options' );
}

//add special capabilities to this given role
//$roleEditor->add_cap('manage_categories');
$roleEditor->add_cap('edit_others_pages');
//$roleEditor->remove_cap('edit_posts');
//$roleEditor->remove_cap('edit_others_posts');

