<?php

//INITIATE SETTINGS PAGE CONTENT BUILT ON BS4
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
                            <p>
                            The IT Hub Assistant plugin easily ports custom code onto multiple development servers, reducing the need to manually touch each of these environments from the file level. Tested on WordPress 4.9.5 with the ACF plugin and UnderStrap Starter Theme.
                            </p>
                        </div>
                        <div class="tab-pane fade p-2 m-2" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <p>The IT Hub Assistant plugin also provides search suggestions on the IT Hub Search page. Additional options such as
                                color variants, filtering custom post types, and enabling/disabling assistance, are all on the way.</p>
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
                                    <p>This plugin is property of <strong>The NFFA IT Division</strong>.  If you have any questions or concerns please contact us.</p>
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
                    require_once( MY_PLUGIN_PATH .'/inc/setup_settings_options.php' );
                    ?>
                </div>
            </div>
        </div>

        <?php
}