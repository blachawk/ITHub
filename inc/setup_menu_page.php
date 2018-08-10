<?php

//CREATE SETTINGS MENU PAGE AND NAV LINK
add_action('admin_menu','ithub_admin_menus');
function ithub_admin_menus() {
    //DASHICONS ARE APPLIED FROM THEME.SCSS
    $ithub_menu_page = add_menu_page('ITHub data Assistant', 'IT Hub Assist', 'manage_options','ithub_main_menu','ithub_main_plugin_page','',20);
    //CREATE MULTIPLE SUB LEVEL MENU PAGES
    //$ithub_submenu_page01 = add_submenu_page('ithub_main_menu','IT Hub Page Settings','Assist Pages','manage_options','ithub_pages','ithub_assist_pages');
    //$ithub_submenu_page02 = add_submenu_page('ithub_main_menu','IT Hub Search Settings','Assist Search','manage_options','ithub_search','ithub_assist_search');
}
