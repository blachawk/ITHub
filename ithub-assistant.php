<?php

/*
Plugin Name: ITHub Assistant
Plugin URI: ithub.ffa.org
Description: Custom PHP and JavaScript support for the ITHub web site
Version: 1.0
Author: National FFA Organization
Author URI: https://www.ffa.org
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

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

//I NEED TO GET ON GIT TO UPLOAD MY PLUGIN AND PUSH IT TO OTHER PLACES THAT NEED IT (i.e. my development servers)
//https://github.com/afragen/github-updater
//https://youtu.be/4kUTyNgsqUA


//CONSTANTS
define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ));

//VERIFY
require_once( MY_PLUGIN_PATH .'/inc/verify.php' );

//INITIATE MENU PAGE(S) AND NAV MENU LINK
require_once( MY_PLUGIN_PATH .'/inc/setup_menu_page.php' );

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

//MANAGE SEARCH AND SEARCH HELPER NEEDS
require_once( MY_PLUGIN_PATH .'/inc/assist_search.php' );

//ADMIN SETTINGS PAGE CONTENT BUILT ON BS4
function ithub_main_plugin_page(){
    ?>

        <div class="container" id="ithub-plugin">
            <div class="row">
                <div class="col-md-10">

                    <!--TITLE-->
                    <h2>
                        <strong>IT Hub</strong> Assistant
                        <span class="badge badge-secondary">New</span>
                    </h2>

                    <!--NAV TABS-->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Welcome</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Search Assistant</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">FAQ</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active p-2 m-2" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <p>IT Hub Assistant is a plugin that was created to help speed up the content update process on external
                                servers. Think of it as
                                <strong>a helper for dynamically displaying content right away</strong>. This requires
                                <strong>ACF</strong> to be activated. It also requires
                                <strong>UnderStrap</strong> to be the main theme. At the moment there no option fields to manage.  Please check back later for option updates.
                            </p>
                        </div>
                        <div class="tab-pane fade p-2 m-2" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <p>IT Hub Assistant also provides search suggestions on the IT Hub Search page. Options such as
                                color variants, filtering custom post types, and enabling assistance, are all on the way.</p>
                        </div>
                        <div class="tab-pane fade p-2 m-2" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <p>Some concrete examples of what this plugin is doing will be listed here shortly.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 my-3">
                    <!--MODAL POPUP NOTIFICATIONS-->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ithubModalCenter">
                        About this Plugin
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="ithubModalCenter" tabindex="-1" role="dialog" aria-labelledby="ithubModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">About This Plugin</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>This plugin is property of <strong>The National FFA Organization</strong>. For additional information, contact Kensley O. Lewis at <a href="mailto:klewis@ffa.org">klewis@ffa.org</a></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Return</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-none">
                <div class="col-md-12 p-3 mb-2 bg-white text-dark">
                    <?php
                    //REGISTER, SANITIZE AND SET FORM OPTIONS FOR THE GIVEN SETTINGS PAGE | ENABLE THIS WHEN READY
                    require_once( MY_PLUGIN_PATH .'/inc/setup_settings-options.php' );
                    ?>
                </div>
            </div>
        </div>

        <?php
}