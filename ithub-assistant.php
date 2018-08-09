<?php

/*
Plugin Name: ITHub Assistant
Plugin URI: ithub.ffa.org
Description: A WP Plugin that provides PHP and JavaScript support for IT Hub.
Version: 1.2
Author: NFFA IT Staff
Author URI: https://www.ffa.org
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/blachawk/ITHub

  Copyright 2018  National FFA Organization (email : klewis@ffa.org)
  
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

//CONSTANTS
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

//VERIFY
require_once( MY_PLUGIN_PATH .'/inc/verify.php' );

//INITIATE MENU PAGE(S) AND NAV MENU LINK
require_once( MY_PLUGIN_PATH .'/inc/setup_menu_page.php' );

//INITIATE SETTINGS PAGE CONTENT BUILT ON BS4
require_once( MY_PLUGIN_PATH .'/inc/setup_settings_page.php' );

//ENQUEUE STYLES AND SCRIPTS FOR SETTINGS PAGE
require_once( MY_PLUGIN_PATH .'/inc/enqueue_admin.php' );

//ENQUEUE STYLES AND SCRIPTS FOR CUSTOMER-SIDE
require_once( MY_PLUGIN_PATH .'/inc/enqueue_front.php' );

//MANAGE EDITOR PERMISSIONS
require_once( MY_PLUGIN_PATH .'/inc/assist_editors.php' );

//MANAGE ALL WP AND CUSTOM HOOKS
require_once( MY_PLUGIN_PATH .'/inc/assist_hooks.php' );

//MANAGE THE ATTACHMENTS POST TYPE
require_once( MY_PLUGIN_PATH .'/inc/assist_attachments.php' );

//MANAGE ALL ACF OBJECTS USED
require_once( MY_PLUGIN_PATH .'/inc/assist_acf.php' );

//MANAGE EXCERPT
require_once( MY_PLUGIN_PATH .'/inc/assist_excerpt.php' );

//MANAGE SEARCH AND SEARCH HELPER NEEDS
require_once( MY_PLUGIN_PATH .'/inc/assist_search.php' );

//MANAGE TAGS
require_once( MY_PLUGIN_PATH .'/inc/assist_tags.php' );


//MANAGE ALL WP AND CUSTOM HOOKS
//require_once( MY_PLUGIN_PATH .'/inc/assist_revisions.php' );

