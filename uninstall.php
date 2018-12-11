<?php

//if uninstall/delete not called from WordPress exit
if(!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN'))
exit();

//Delete option from options table
//WORK ON THIS WHEN I ACTUALLY HAVE OPTIONS TO DELETE!
//delete_option('ithub_options_arr');

//Delete ny other options, custom tables/data, files, etc..
