<?php	
/**
 * MANAGE ALL AFC OBJECT LOGIC FOR ANY GIVEN PAGE
 */
	//NFFA - TAP INTO WP HOOKS | ACF LOGIC FOR HOME
	add_filter('the_content','ithub_home');
	if (!function_exists ('ithub_home')){
		function ithub_home($content) {
			//GET THE SLUG
			 $mslug = get_post_field( 'post_name', get_post());
			//MODIFY THE CONTENT
			if ($mslug == "home") {
				//PREPEND THE AFC LOGIC TO THE CONTENT
				$content = ithub_home_acf() . $content;
			} 
			return $content;
		}
		//BUILD THE ACF LOGIC
		function ithub_home_acf(){

			//GET THE WP PAGE ID
			$pageid = get_page_by_path('home')->ID;
			//ASSOCIATE THE WP PAGE ID TO THE ACF FIELD GROUP
			$field_group = get_field_objects($pageid);
			//IF ACF FIELDS EXIST ON THIS PAGE...
			if($field_group): 

				//LOAD EACH AFC FIELD FOR THE CAROUSEL BANNER SLIDER
				echo "<div id='mCarousel' class='carousel slide' data-ride='carousel'>";
				$carouselindex = 0;
				foreach($field_group as $mfname => &$mfvalue) { 

					if ($mfvalue['label'] == "Banner Info") {
					?>
						<ul class="carousel-indicators">
							<li data-target="#mCarousel" data-slide-to="0" class="<?php (($carouselindex == 0)?'active':"") ?>"></li>
						</ul>
			
						<!-- The slideshow -->
						<div class="carousel-inner">
			
							<div class="carousel-item active">
								<div class="row justify-content-center my-5 py-3">
									<div class="col-9">
									<?php echo $mfvalue['value']; ?>
									</div>
								</div>
							</div>
			
						</div>
					<?php
					$carouselindex++;
					}
				}
				echo '<a class="carousel-control-prev" href="#mCarousel" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>';
				echo '<a class="carousel-control-next" href="#mCarousel" data-slide="next"><span class="carousel-control-next-icon"></span></a>';
				echo '</div>';
				unset($mfvalue);
				?>

				<?php
				//LOAD EACH ACF FIELD FOR CALL-TO-ACTION SECTIONS 
				echo "<div class='container ithub-main'>";
				echo "<div class='row justify-content-center ml-auto'>";
				echo "<div class='col-12 my-3 text-center'>";
				echo get_field('home_favicon_section_header');
				echo "</div>";

				$mcount = 1;
				foreach($field_group as $mfname => &$mfvalue) { 
					//ONLY GET CALL-TO-ACTION FIELDS 
					if ( (strpos($mfvalue['label'], 'Section Header') === false) && (strpos($mfvalue['label'], 'Section') !== false)  ) {
						//GROUP EVERY 2 ARRAY VALUES IN BS4 DIV COLUMNS
						if ($mcount%2 == 1){echo "<div class='col-md-3 my-3 px-5 text-center'>";}
						echo $mfvalue['value'];                   
						if ($mcount%2 == 0){echo "</div>";}
					$mcount++;
					}
				}
				echo "</div>";
				echo "</div>";
				unset($mfvalue);
				/*highlight_string("<?php\n\$field_group =\n" . var_export($field_group, true) . ";\n?>"); */
		
			endif;//END ACF FIELD GROUP CHECK
		} 
	}

	//NFFA - TAP INTO WP HOOKS | ACF LOGIC FOR SEND A REQUEST 
    add_filter('the_content', 'ithub_requests');
    if (!function_exists ('ithub_requests')) {

		function ithub_requests($content) {
			//GET THE SLUG
			$mslug = get_post_field( 'post_name', get_post());

		    //MODIFY THE CONTENT
			if ($mslug == "send-a-request") {
				//APPEND THE AFC LOGIC TO THE CONTENT
				$content .= ithub_requests_acf();
			} 
			return $content;
		}	
	
		//BUILD THE ACF LOGIC
		function ithub_requests_acf(){
			//GET THE WP PAGE ID
			$pageid = get_page_by_path('send-a-request')->ID;
				
			//ASSOCIATE THE PAGE ID TO THE ACF FIELD GROUP
			$field_group = get_field_objects($pageid);

			//IF ACF FIELDS EXIST ON THIS PAGE...
			if($field_group): 

				//CREATE THE OUTPUT VARIABLE TO BE RETURNED
				$out = '';

				//CONSTRUCT THE BS4 LAYOUT TABS
				$out .= "<ul id='mTabs' class='nav nav-tabs my-4 d-none' role='tablist'>";
				$tabindex = 1;

				foreach($field_group as $mfname => &$mfvalue) { 
					if($mfvalue['label'] == "Title") {
					$out .= "<li class='nav-item'><a id='tab{$tabindex}' class='nav-link ".(($tabindex==1)?'active':"")."' role='tab' href='#tab{$tabindex}content' data-toggle='tab' aria-controls='tab{$tabindex}content' aria-selected='true'>".$mfvalue['value']."</a></li>";       
					$tabindex++;
					}
				}
				$out .= "</ul>";
				unset($mfvalue);


			//CONSTRUCT THE BS4 LAYOUT TAB CONTENT SECTIONS
			$out .= "<div id='mTabContent' class='tab-content d-none'>";
			$tabcontentindex = 1;
			foreach($field_group as $mfname => &$mfvalue) { 
					if($mfvalue['label'] == "Content") {
						$out .= "<div id='tab{$tabcontentindex}content' class='tab-pane fade ".(($tabcontentindex==1)?'active show':"")."' role='tabpanel' aria-labelledby='tab{$tabcontentindex}'>{$mfvalue['value']}</div>";
						$tabcontentindex++;
					}
			}

			$out .= "</div>";
			unset($mfvalue);
			/*highlight_string("<?php\n\$field_group =\n" . var_export($field_group, true) . ";\n?>");*/

			endif;//END BS4 LAYOUT

			//now "return" the data. This causes the function to end its execution immediately and pass control back to the line from which it was called. 
			return $out;			
		}	
	}

	//NFFA - TAP INTO WP HOOKS | ACF LOGIC FOR PROJECTS
	add_filter('the_content', 'ithub_projects');
	if (!function_exists ('ithub_projects')) {
		function ithub_projects($content) {
			//GET THE SLUG
			$mslug = get_post_field( 'post_name', get_post());
			//MODIFY THE CONTENT
			if ($mslug == "projects") {
				//APPEND THE AFC LOGIC TO THE CONTENT
				$content =  $content . ithub_projects_acf();
			} 
			return $content;
		}
		//BUILD THE ACF LOGIC
		function ithub_projects_acf(){

			//GET THE WP PAGE ID
			$pageid = get_page_by_path('projects')->ID;  
			//ASSOCIATE THE PAGE ID TO THE ACF FIELD GROUP
			$field_group = get_field_objects($pageid);
			//IF ACF FIELDS EXIST ON THIS PAGE...
			if($field_group): 

				//DEFINE THE RETURNED VARIABLE
				$out = '';

				//CONSTRUCT THE BS4 LAYOUT TABS
				$out .= "<ul id='mTabs' class='nav nav-tabs my-5' role='tablist'>";
				$tabindex = 1;
				foreach($field_group as $mfname => &$mfvalue) { 
					if($mfvalue['label'] == "Title") {
					$out .= "<li class='nav-item'><a id='tab{$tabindex}' class='nav-link ".(($tabindex==1)?'active':"")."' role='tab' href='#tab{$tabindex}content' data-toggle='tab' aria-controls='tab{$tabindex}content' aria-selected='true'>".$mfvalue['value']."</a></li>";       
					$tabindex++;
					}
				}
				$out .= "</ul>";
				unset($mfvalue);

				//CREATE A WRAPPER FUNCTION FOR REPEATER CONTENT
				if (!function_exists ('mESContent')) {
					function mESContent($title,$link,$description) {

					$mout = '';
					$mtitle = get_sub_field($title);
					$mlink =  get_sub_field($link);
					$mout.= "<div class='ffa-repeater-group mt-3 d-flex flex-row'>";
					if ($mlink != null):
						$mout.= "<h3 class='mr-3'><a class='ext' href='{$mlink}'>{$mtitle} <i class='fas fa-external-link-alt'></i></a></h3>";
					endif;
					
					$mdescription = get_sub_field($description);
					if (get_sub_field($description)) {
						$mout.= $mdescription;
					}
					$mout .= "</div>";
						return $mout;
					}
				}

			//CONSTRUCT THE BS4 LAYOUT TAB CONTENT SECTIONS
			$out .= "<div id='mTabContent' class='tab-content'>";

			//OUTPUT REPEATER CONTENT FOR EACH TAB
			$tabsections = 2;
			foreach(range(1,$tabsections) as $index) {
				if( have_rows('exec_summary_tab01_repeater_content') ):
					$out.= "<div id='tab{$index}content' class='tab-pane fade ".(($index == 1)?'active show':"")."' role='tabpanel' aria-labelledby='tab{$index}'>";
						while ( have_rows('exec_summary_tab0'.$index.'_repeater_content') ) : the_row();
							$out.= mESContent('exec_tab0'.$index.'_title','exec_tab0'.$index.'_link','exec_tab0'.$index.'_description');
						endwhile;	
					$out.= "</div>";
				else :
					$out.= '';
				endif;
			}
			
			$out .= "</div>";

			unset($index);
			/*highlight_string("<?php\n\$field_group =\n" . var_export($field_group, true) . ";\n?>");*/
			endif;//END FIELD GROUP CHECK

			//RETURN OUTPUT
			return $out;
		}
	}

	//NFFA - TAP INTO WP HOOKS | ACF LOGIC FOR MINOR DEVELOPMENT
    add_filter('the_content', 'ithub_minor_dev');
    if (!function_exists ('ithub_minor_dev')) {
		function ithub_minor_dev($content) {
			//GET THE SLUG
			$mslug = get_post_field( 'post_name', get_post());
		    //MODIFY THE CONTENT
			if ($mslug == "minor-development") {
				//APPEND THE AFC LOGIC TO THE CONTENT
				$content =  $content . ithub_minor_dev_acf();
			} 
			return $content;
		}
		//BUILD THE ACF LOGIC
		function ithub_minor_dev_acf(){

			//GET THE WP PAGE ID
			$pageid = get_page_by_path('minor-development')->ID;  
			//ASSOCIATE THE PAGE ID TO THE ACF FIELD GROUP
			$field_group = get_field_objects($pageid);
			//IF ACF FIELDS EXIST ON THIS PAGE...
			if($field_group): 

				//DEFINE THE RETURNED VARIABLE
				$out = '';

				//CONSTRUCT THE BS4 LAYOUT TABS
				$out .= "<ul id='mTabs' class='nav nav-tabs my-5' role='tablist'>";
				$tabindex = 1;
				foreach($field_group as $mfname => &$mfvalue) { 
				
					if($mfvalue['label'] == "Tab Title") {
					$out .= "<li class='nav-item'><a id='tab{$tabindex}' class='nav-link ".(($tabindex==1)?'active':"")."' role='tab' href='#tab{$tabindex}content' data-toggle='tab' aria-controls='tab{$tabindex}content' aria-selected='true'>".$mfvalue['value']."</a></li>";       
					$tabindex++;
					}
				}
				$out .= "</ul>";
				unset($mfvalue);

				//CONSTRUCT THE BS4 LAYOUT TAB CONTENT SECTIONS
				$out .= "<div id='mTabContent' class='tab-content'>";
				$tabcontentindex = 1;
				foreach($field_group as $mfname => &$mfvalue) { 
					
						if($mfvalue['label'] == "Tab Content") {
							$out .= "<div id='tab{$tabcontentindex}content' class='tab-pane fade ".(($tabcontentindex==1)?'active show':"")."' role='tabpanel' aria-labelledby='tab{$tabcontentindex}'><div class='embed-responsive embed-responsive-16by9'>{$mfvalue['value']}</div></div>";
							$tabcontentindex++;
						}
				}
				$out .= "</div>";
				unset($mfvalue);
				/*highlight_string("<?php\n\$field_group =\n" . var_export($field_group, true) . ";\n?>");*/

				//RETURN OUTPUT
				return $out;

			endif;//END BS4 LAYOUT
		}
    }

	//NFFA - TAP INTO WP HOOKS | ACF LOGIC FOR POLICIES AND PROCEDURES | REVISIT RETURNING VARIABLE.
    add_filter('the_content', 'ithub_policies');
    if (!function_exists ('ithub_policies')) {
		function ithub_policies($content) {
			//GET THE SLUG
			$mslug = get_post_field( 'post_name', get_post());
			//MODIFY THE CONTENT
			if ($mslug == "policies-and-procedures") {
				//APPEND THE AFC LOGIC TO THE CONTENT
				$content =  $content . ithub_policies_acf();
			} 
			return $content;
		}
		//BUILD THE ACF LOGIC
		function ithub_policies_acf() {

			//GET THE WP PAGE ID
			$pageid = get_page_by_path('policies-and-procedures')->ID;
			//ASSOCIATE THE PAGE ID TO THE ACF FIELD GROUP
			$field_group = get_field_objects($pageid);
			//IF ACF FIELDS EXIST ON THIS PAGE...
			if($field_group): 

				//DEFINE THE RETURNED VARIABLE
				$out = '';

				//CONSTRUCT THE BS4 LAYOUT TABS
				echo "<ul id='mTabs' class='nav nav-tabs my-5' role='tablist'>";
				$tabindex = 1;
				foreach($field_group as $mfname => &$mfvalue) { 
				if($mfvalue['label'] == "Title") {
				echo "<li class='nav-item'><a id='tab{$tabindex}' class='nav-link ".(($tabindex==1)?'active':"")."' role='tab' href='#tab{$tabindex}content' data-toggle='tab' aria-controls='tab{$tabindex}content' aria-selected='true'>".$mfvalue['value']."</a></li>";       
				$tabindex++;
				}
			}
			echo "</ul>";
			unset($mfvalue);
			//////////////////////////////////////////////////

			//CONSTRUCT THE BS4 LAYOUT TAB CONTENT SECTIONS
			echo "<div id='mTabContent' class='tab-content'>";

			//GET AFC CONTENT FOR THE FIRST TAB ONLY
			$tabindex = 1;
			foreach($field_group as $mfname => &$mfvalue) { 
								
				echo "<div id='tab{$tabindex}content' class='tab-pane fade ".(($tabindex==1)?'active show':"")."' role='tabpanel' aria-labelledby='tab{$tabindex}'>";

				if ($tabindex == 1) {
				//EXCLUDE FIRST KEY FROM THE AFC ARRAY..WE DON'T NEED IT.
				echo "<div class='row'>";
					$columns = 3;
					foreach(range(1,$columns) as $index) {
					echo "<div class='col-6 p-3'>";
						echo "<h4 class='my-5'>".get_field('tab_01_subtitle_0'.$index)."</h4>";
						echo "<div class='embed-responsive embed-responsive-16by9'>".get_field('tab_01_boxiframe_0'.$index)."</div>";
					echo "</div>";
					}
				 echo "</div>";
				} 
				echo "</div>";   
				//BREAK LOOP AFTER FIRST ITERATION
				if($tabindex==1) {break;}                                     
			}
			
				unset($mfvalue);
				//////////////////////////////////////////

				//GET AFC CONTENT FOR THE REST OF THE TABS STARTING WITH TAB 2
				$tabindex = 2;
				foreach($field_group as $mfname => &$mfvalue) {
					//MAKE SURE TO EXCLUDE FIRST TAB CONTENT
					if (strpos($mfname, 'tab_01_') === false) {
						//ONLY TARGET THE IFRAME FIELDS SENSE THATS ALL WE NEED
						if ($mfvalue['label'] == "Box Iframe") {
							echo "<div id='tab{$tabindex}content' class='tab-pane fade' role='tabpanel' aria-labelledby='tab{$tabindex}'>";
							echo "<div class='embed-responsive embed-responsive-16by9'>{$mfvalue['value']}</div>";
							echo "</div>";
							//THEN RE-ITERATE
							$tabindex++;
						}
					}            
				}
				unset($mfvalue);
				echo "</div>";
				/*highlight_string("<?php\n\$field_group =\n" . var_export($field_group, true) . ";\n?>");*/
														
			endif;//END BS4 LAYOUT
		}
	}

	//NFFA - TAP INTO WP HOOKS | ACF LOGIC FOR IT APPS
    add_filter('the_content', 'ithub_it_apps');
    if (!function_exists ('ithub_it_apps')) {
		function ithub_it_apps($content) {
			//GET THE SLUG
			$mslug = get_post_field( 'post_name', get_post());
			//MODIFY THE CONTENT
			if ($mslug == "apps") {
			//APPEND THE AFC LOGIC TO THE CONTENT
			$content =  $content . ithub_it_apps_acf();
			} 
			return $content;
		}
		//BUILD THE ACF LOGIC
		function ithub_it_apps_acf(){
			//GET THE WP PAGE ID
			$pageid = get_page_by_path('apps')->ID;
			//ASSOCIATE THE PAGE ID TO THE ACF FIELD GROUP
			$field_group = get_field_objects($pageid);
			//IF ACF FIELDS EXIST ON THIS PAGE...
			if($field_group): 

			//DEFINE THE RETURNED VARIABLE
			$out = '';

			//CONSTRUCT THE BS4 LAYOUT TABS
			$out .= "<ul id='mTabs' class='nav nav-tabs my-5' role='tablist'>";
			$tabindex = 1;
			foreach($field_group as $mfname => &$mfvalue) { 
				if($mfvalue['label'] == "Title") {
				$out .= "<li class='nav-item'><a id='tab{$tabindex}' class='nav-link ".(($tabindex==1)?'active':"")."' role='tab' href='#tab{$tabindex}content' data-toggle='tab' aria-controls='tab{$tabindex}content' aria-selected='true'>".$mfvalue['value']."</a></li>";       
				$tabindex++;
				}
			}
			$out .= "</ul>";
			unset($mfvalue);

			//CONSTRUCT THE BS4 LAYOUT TAB CONTENT SECTIONS
			$out .= "<div id='mTabContent' class='tab-content'>";
			$tabcontentindex = 1;
			foreach($field_group as $mfname => &$mfvalue) { 
					if($mfvalue['label'] == "Content") {
						$out .= "<div id='tab{$tabcontentindex}content' class='tab-pane fade ".(($tabcontentindex==1)?'active show':"")."' role='tabpanel' aria-labelledby='tab{$tabcontentindex}'>{$mfvalue['value']}</div>";
						$tabcontentindex++;
					}
			}
			$out .= "</div>";
			unset($mfvalue);
			/*highlight_string("<?php\n\$field_group =\n" . var_export($field_group, true) . ";\n?>");*/   

			endif;//END BS4 LAYOUT

			//RETURN OUTPUT
			return $out;
		} 
	}
	
	//NFFA - TAP INTO WP HOOKS | ACF LOGIC FOR KNOWLEDGE BASED ARTICLES
    add_filter('the_content', 'ithub_knowledge');
    if (!function_exists ('ithub_knowledge')) {
		function ithub_knowledge($content) {
			//GET THE SLUG
			$mslug = get_post_field( 'post_name', get_post());
		    //MODIFY THE CONTENT
			if ($mslug == "knowledge-based-articles") {
				//APPEND THE AFC LOGIC TO THE CONTENT
				$content =  $content . ithub_knowledge_acf();
			} 
			return $content;
		}
		//BUILD THE ACF LOGIC
		function ithub_knowledge_acf(){

			//GET THE WP PAGE ID
			$pageid = get_page_by_path('knowledge-based-articles')->ID;
			//ASSOCIATE THE PAGE ID TO THE ACF FIELD GROUP
			$field_group = get_field_objects($pageid);
			//IF ACF FIELDS EXIST ON THIS PAGE...
			if($field_group): 

				//DEFINE THE RETURNED VARIABLE
				$out = '';

				//CONSTRUCT THE BS4 LAYOUT TABS
				$out .= "<ul id='mTabs' class='nav nav-tabs my-5' role='tablist'>";
				$tabindex = 1;
				foreach($field_group as $mfname => &$mfvalue) { 
						
						$out .= "<li class='nav-item'><a id='tab{$tabindex}' class='nav-link ".(($tabindex==1)?'active':"")."' role='tab' href='#tab{$tabindex}content' data-toggle='tab' aria-controls='tab{$tabindex}content' aria-selected='true'>".$mfvalue['label']."</a></li>";
					$tabindex++;					
				}
				$out .= "</ul>";
				unset($mfvalue);
				
				//CREATE A WRAPPER FUNCTION FOR REPEATER CONTENT
				if (!function_exists ('mKBAContent')) {
				 	function mKBAContent($title,$link,$description) {

						$mout = '';
						$mtitle = get_sub_field($title);
						$mlink =  get_sub_field($link);
						if ($mlink != null):
							$mout.= "<h3><a href='{$mlink}'>{$mtitle}</a> <i class='fas fa-external-link-alt'></i></h3>";
						endif;
						
						$mdescription = get_sub_field($description);
						$mout.= $mdescription;
				 		return $mout;
				 	}
				 }

				//CONSTRUCT THE BS4 LAYOUT TAB CONTENT SECTIONS
				$out .= "<div id='mTabContent' class='tab-content'>";

				//OUTPUT REPEATER CONTENT FOR EACH TAB
				$tabsections = 2;
				foreach(range(1,$tabsections) as $index) {
					if( have_rows('kba_tab01_repeater_content') ):
						$out.= "<div id='tab{$index}content' class='tab-pane fade ".(($index == 1)?'active show':"")."' role='tabpanel' aria-labelledby='tab{$index}'>";
							while ( have_rows('kba_tab0'.$index.'_repeater_content') ) : the_row();
								$out.= mKBAContent('kba_tab0'.$index.'_title','kba_tab0'.$index.'_link','kba_tab0'.$index.'_description');
							endwhile;	
						$out.= "</div>";
					else :
						$out.= '';
					endif;
				}
				$out .= "</div>";

				unset($index);
				/* highlight_string("<?php\n\$field_group =\n" . var_export($field_group, true) . ";\n?>");*/
			endif;//END FIELD GROUP CHECK
			//RETURN OUTPUT
			return $out;
		}
	}

	//NFFA - TAP INTO WP HOOKS | ACF LOGIC FOR EXECUTIVE SUMMARY (POSTS)
	add_filter('the_content', 'ithub_exec_summary');
	if (!function_exists ('ithub_exec_summary')) {
		function ithub_exec_summary($content) {
			//MODIFY THE CONTENT IF POST IS PART OF A SPECIFIC CATEGORY
			if ( in_category('Executive Summary') ) {
				$content =  $content . ithub_exec_summary_acf();
			}
			return $content;
		}
		//BUILD THE ACF LOGIC
		function ithub_exec_summary_acf() {

		$post_id = get_the_ID();
		$field_group = get_field_objects($post_id); //this gets the ACF fields associated to the given post!
		
			if($field_group): 
			?>

			<div id="executive-summary" class="px-3">

			    <div class="row">
					<div class="col text-center">
						<h5 class="text-muted text-center my-0 py-0">Executive Summary Report | <span class="text-muted"><?php echo get_the_time('l F jS, Y', get_the_ID()); ?></span></h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 offset-md-9 p-3 text-right">				
						<div class="dropdown">
						<button class="btn btn-secondary dropdown-toggle bg-info" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Preview Revisions
						</button>

						<?php
						//LOOP - PREVIEW REVISIONS
						$args = array(
						'numberposts' => -1,
						'orderby' => 'modified',
						'order'   => 'ASC' 
						);
						$mPreviewRevisions = get_posts($args);
						//REFERENCE LOOP FOR PREVIEWING REVISIONS
						if ($mPreviewRevisions) {

							echo "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>";
							foreach ($mPreviewRevisions as $post):
								setup_postdata($post);
								$currentTitle = get_the_title();	
								if ($currentTitle == $post->post_title):
								$publisheddate = get_the_time('Y-m-d', $post->ID);
								$formateddate =  date("l F jS, Y",  strtotime($publisheddate));
								$thispublisheddate = get_the_time('l F jS, Y', get_the_ID());
								$dstatus = '';
								if ($formateddate == $thispublisheddate){
									$dstatus = 'bg-info text-light';
								}
								echo "<a class='dropdown-item {$dstatus}' href='{$post->post_name}'>{$formateddate}</a>";	
								endif;
							endforeach;
							wp_reset_postdata();
							echo "</div>";	
						}
						?>				
						</div>
					</div>
				</div>

				<div class="row border-top border-right border-left">
					<?php
						//GET PURPOSE AND SCOPE
						$mobject = get_field_object("purpose_and_scope");
						$mvalue = get_field("purpose_and_scope");
						$mlabel = $mobject['label'];
					?>
					<div class="col-md-2 bg-peach">
						<h3 class="py-3 h4 text-secondary"><b><?php echo $mlabel ?></b></h3>
					</div>
					<div class="col-md-8 text-left p-3">
						<?php echo $mvalue ?>
					</div>


					<div class="col-sm-2 text-center border-left">
						<p>Status Date</p>
						<p class="border-top px-4">
							<?php 					
							$publisheddate = get_the_time('l F jS, Y', get_the_ID());
							echo "<b>".$publisheddate."</b>";
							?>
						</p>
					</div>
				</div>

				<div class="row bg-white border-right border-left border-top">
					<?php

						//HANDLE ALL PERSONNEL INVOLVED IN THS PROJECT

						if (!function_exists ('mpersonnel')) {
						function mpersonnel($mfield) {
							$field = get_field_object($mfield);
							$values = get_field($mfield);
							$mlabel = $field['label'];
							if($field && $values):
								echo '<div class="col-md-2 p-0">';
								echo '<h2 class="label-set m-0">'.$mlabel.'</h2>';
								foreach ($values as $value) {
									echo '<p class="text-center m-0 py-1">'.$field['choices'][ $value ].'</p>';	
								}
								echo '</div>';
							endif;
							unset($field,$values);
						} 
					}
					?>
					<?php 
					mpersonnel("product_owner");
					mpersonnel("it_developer_lead");
					mpersonnel("developer");
					mpersonnel("it_ops_lead");
				    mpersonnel("ba");
					mpersonnel("executive_leader");
					?>
				</div>

				<div class="row bg-white border-right border-left border-top">
					<div class="col-lg-6 p-0">

						<?php
							//GET THE CURRENT STATUS
							if (!function_exists ('mcurrentstatus')) {
							function mcurrentstatus($mfield) {
								$field = get_field_object($mfield);
								$value = get_field($mfield);
								$mlabel = $field['label'];
								$mgroup[] = $field['choices'][$value];
								$colorstatus = '';
								foreach ($mgroup as $value) {

									if ($value == 'G') {
										$colorstatus = 'bg-info';
									} elseif ($value == 'Y') {
										$colorstatus = 'bg-warning';
									} elseif ($value == 'R') {
										$colorstatus = 'bg-danger';
									}

									echo '<p class="my-0 p-0 box '.$colorstatus.'">'.$value;
									echo '<span class="py-2 bg-white">'.$mlabel.'</span>';
									echo '</p>';
								}
								unset($field,$value);
							}
						}
						?>

						<h2 class="m-0 label-set">Current Status</h2>

						<div class="row m-0 current-status">
							<div class="col-lg-12 py-3 text-center">
							<?php
								mcurrentstatus("overall_health");
								mcurrentstatus("schedule");
								mcurrentstatus("scope");
								mcurrentstatus("resources");
								mcurrentstatus("budget");
								mcurrentstatus("risks");
								mcurrentstatus("issues");
							?>
							</div>
						</div>

					</div>

					<div class="col-lg-6 p-0">
						<?php
							//GET THE EXECUTIVE STATUS SUMMARY
							$mobject = get_field_object("technical_environment");
							$mvalue = get_field("technical_environment");
							$mlabel = $mobject['label'];
						?>
						<h2 class="m-0 label-set"><?php echo $mlabel ?></h2>

						<div class="row m-0 content-set">
							<div class="col-12">
								<?php echo $mvalue ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row bg-white content-set border-right border-left border-bottom border-top">

					<div class="col-lg-6 p-0">
						<h2 class="m-0 label-set">Key Milestones / Deliverables</h2>

						<div class="row m-0 border-bottom">
							<div class="col-8 text-left"><p>Project Milestone</p></div>
							<div class="col-sm-2"><p>Planned:</p></div>
							<div class="col-sm-2"><p>Forecast:</p></div>
						</div>
						<?php

							//a repeater function for each key milestone line item
							if (!function_exists ('mKeyMilestones')) {
								function mKeyMilestones($desc,$pfrom,$pto,$ffrom,$fto) {

									$mdesc =  get_sub_field($desc);
									$mpfrom = get_sub_field($pfrom);
									$mpto = get_sub_field($pto);
									$mffrom = get_sub_field($ffrom);
									$mfto = get_sub_field($fto);

									$out = '';
									$out.="<div class='row m-0 border-bottom border-right'>";
										$out.="<div class='col-8 text-left'><p>{$mdesc}</p></div>";
										$out.="<div class='col-1 border-left border-right px-0 mx-0'>{$mpfrom}</div>";
										$out.="<div class='col-1 border-right px-0 mx-0'>{$mpto}</div>";
										$out.="<div class='col-1 border-right px-0 mx-0'>{$mffrom}</div>";
										$out.="<div class='col-1 px-0 mx-0'>{$mfto}</div>";
									$out.="</div>";
									echo $out;
								}
							}

							//KEY MILESTONE DELIVERABLES
							if( have_rows('key_milestones_deliverables_repeater') ):
								// loop through the rows of data
								while ( have_rows('key_milestones_deliverables_repeater') ) : the_row();
								mKeyMilestones('kmd_description','kmd_planned_from','kmd_planned_to','kmd_forecast_from','kmd_forecast_to');
								endwhile;
							else :
								$out.= 'No Key Milestones have been set';
							endif;
							?>
						
							<h2 class="m-0 label-set">Financials</h2>
							<div class="row ml-auto py-3 text-center">
								<div class="col">
									<?php 
										//FINANCIALS
										$mfinancials =  get_field('financials');
										echo "<p>{$mfinancials}</p>";
									?>
								</div>
							</div>

					</div>

					<div class="col-lg-3 p-0">

						<?php
							//KEY ACCOMPLISHMENTS AND NEXT STEPS
							$mobject = get_field_object("key_accomplishments_and_next_steps_content");
							$mvalue = get_field("key_accomplishments_and_next_steps_content");
							$mlabel = $mobject['label'];
						?>
						<h2 class="m-0 label-set"><?php echo $mlabel ?></h2>

						<div class="row p-4 content-set">
							<div class="col text-left">
								<?php echo $mvalue ?>
							</div>
						</div> 
					</div>

					<div class="col-lg-3 p-0">

						<?php
							//ISSUES, RISKS, CHANGES AND DEPENDENCIES
							$mobject = get_field_object("issues_risks_changes_dependencies_content");
							$mvalue = get_field("issues_risks_changes_dependencies_content");
							$mlabel = $mobject['label'];
						?>
						<h2 class="m-0 label-set"><?php echo $mlabel ?></h2>
						<div class="row p-3 content-set">
							<div class="col text-left">
								<?php echo $mvalue ?>
							</div>
						</div> 
					</div>

				</div>
			</div>

			<?php
			endif;	
		}
	}

	//NFFA - TAP INTO WP HOOKS | EXECUTIVE SUMMARY LANDING PAGE (SHOW FULL LISTING VIA GET POSTS LOOP)
	add_filter('the_content', 'ithub_exec_summary_landing');
	if (!function_exists ('ithub_exec_summary_landing')) {
		function ithub_exec_summary_landing($content) {
			//GET THE SLUG
			$mslug = get_post_field( 'post_name', get_post());
		    //MODIFY THE CONTENT
			if ($mslug == "executive-summary") {
				//APPEND THE AFC LOGIC TO THE CONTENT
				$content =  $content . ithub_exec_summary_landing_loop();
			} 
			return $content;
		}

		//BUILD THE LOOP AND LOAD THE POSTS
		function ithub_exec_summary_landing_loop() {

              

				//NFFA - GET ALL PRODUCT OWNERS VIA ACF KEY VALUE | NEED TO CHANGE IN EVERY SERVER LOCATION
				function mowners() {

					$field_key = '';
					$minstance = MY_INSTANCE;
					if($minstance == "ITHUBLOCAL") {
						$field_key = "field_5b648d8589d37"; //local
					} else {
						$field_key = "field_5b648d8589d37"; //live
					}
				    //field_key = "field_5b5b34f4ed085"; //uidev: field_5b5b34f4ed085 | ithub:field_5b648d8589d37
					$field = get_field_object($field_key);
						
					$mowners['relation'] = 'OR';

					foreach($field['choices'] as $mkey=>$mvalue){
						$mowners[] = array(
						 'key'=> 'product_owner',
						 'value'=> $mvalue,
						 'compare'=> 'LIKE'
						);
					}
				return $mowners;	
				}

                //SETUP ARGUMENT CRITERIA FOR GET_POSTS()
				$args = array(
					'numberposts' => -1,
					'orderby' => 'publish_date',
					'order'   => 'DESC',
					'category_name' => 'executive-summary',
					'meta_query' => array(mowners())
					);
				$mExecSumPosts = get_posts($args);

				//IF ANY POSTS MEET THE ARGUMENT CRITERIA...
				if ($mExecSumPosts) {

					//CREATE OUTPUT VAR
					$out = '';

					//...ADD A CUSTOM INPUT FIELD WITH BS4 CLASSES, THAT WE WILL THEN USE TO FILTER CONTENT VIA JQUERY
					//https://www.w3schools.com/bootstrap4/bootstrap_filters.asp
					$out.="<div class='form-group'>";
					$out.="<label for='filterProjects'>Filter Projects</label>";
					$out.="<input class='form-control' id='filterProjects' type='text' placeholder='Search..'>";
					$out.="</div>";



					//...OUTPUT THE DATA AND LIST RESULTS!
					
					$out.="<table class='table' id='listedProjects'>";
					$out.="<thead class='thead-light'>";
					$out.="<tr>";
					$out.="<th scope='col'>Week</th>";
					$out.="<th scope='col'>Projects</th>";
					$out.="<th scope='col'>Product Owner</th>";
					$out.="<th scope='col'>Lead Developer</th>";
					$out.="</tr>";
					$out.="</thead>";
					$out.="<tbody>";

					foreach ($mExecSumPosts as $post):
						setup_postdata($post);

						//DEFINE LOOP VARS
						$mtitle = $post->post_title;
						$mpublisheddate = get_the_time('Y-m-d', $post->ID);
						$mformateddate =  date("l F jS, Y",  strtotime($mpublisheddate));

						//PULL ACF DATA FROM THE GIVEN POST IN THIS LOOP!
						$mproductowners = get_post_meta($post->ID,'product_owner');
						$mitdevlead = get_post_meta($post->ID,'it_developer_lead');
						$mstartdate = get_post_meta($post->ID,'discovery_planned_from');
						$mduedate = get_post_meta($post->ID,'due_date');
				
						$out.="<tr>";
						$out.="<th scope='row'>{$mpublisheddate}</th>";
						$out.="<td><a href='{$post->post_name}'>{$mtitle}</a></td>";
						$out.="<td>";
						foreach($mproductowners as $mkey => $mvalue) {
							foreach($mvalue as $mname){
								$out.="<span class='d-block'>".$mname."</span>";
							}
						}
						$out.= "</td>";
						$out.="<td>";
						foreach($mitdevlead as $mkey => $mvalue) {
							foreach($mvalue as $mname){
							$out.="<span class='d-block'>".$mname."</span>";
							}
						    //endforeach;
						}
						$out.= "</td>";
						$out.="</tr>";		
					endforeach;
					
					$out.="</tbody>";
					$out.="</table>";

					
					wp_reset_postdata();
				}
			return $out;
		}
	}

    //NFFA - TAP INTO WP HOOKS | CUSTOMIZE THE ABOUT IT PAGE 
	add_filter('the_content', 'ithub_about_it');
	if (!function_exists('ithub_about_it')) {
		function ithub_about_it($content) {

		//GET THE SLUG
				$mslug = get_post_field( 'post_name', get_post());
				//MODIFY THE CONTENT
				if ($mslug == "about") {
					//APPEND THE AFC LOGIC TO THE CONTENT
					$content =  $content . ithub_about_it_personnel();
				} 
				return $content;
		}

		function ithub_about_it_personnel() {
			//DEFINE OUTPUT VAR
			$out = '';
			
			// check if the repeater field has rows of data
			//IT PERSONNEL
			if( have_rows('it_personnel_details') ):

				$out.="<div class='row text-center'>";

				$mvalue = get_field("about_it_content");

				$out.="<div class='col-sm-12'>";
				$out.= $mvalue;
				$out.="</div>";

				// loop through the rows of data
				while ( have_rows('it_personnel_details') ) : the_row();

				// display a sub field value
				$out.= "<div class='col-sm-3 py-2'>";
				$out.=  "<h4>".get_sub_field('it_member_name')."</h4>";
				$out.=  "<p>".get_sub_field('it_member_position')."</p>";
				$out.=  "</div>";
				
				endwhile;

				$out.="</div>";

			else :
			$out.= '';
			endif;

			//PRODUCT OWNERS
			if( have_rows('product_owner_details') ):

				$mpotitle = get_field("product_owners_title_bar");

				$out.="<div class='row text-center'>";
				$out.="<div class='col-sm-12'>";
				$out.="<ul class='list-group'>";
				$out.="<li class='list-group-item list-group-item-info p-0 my-4'><h2 class='text-center py-1 m-0'>{$mpotitle}</h2></li>";
				$out.="</ul>";
				$out.="</div>";

				// loop through the rows of data
				while ( have_rows('product_owner_details') ) : the_row();

				// display a sub field value
				$out.= "<div class='col-sm-3 py-2'>";
				$out.= "<h4>".get_sub_field('po_name')."</h4>";
				$out.= "<p>".get_sub_field('po_email_addy')."</p>";
				$out.= "<p>".get_sub_field('po_phone_number')."</p>";

				if(get_sub_field('po_owner_of')):
				$out.= "<div class='py-2'><p>Projects Owned:</p><b>".get_sub_field('po_owner_of')."</b></div>";
				endif;
				
				$out.=  "</div>";
				
				endwhile;

				$out.="</div>";

			else :
			$out.= '';
			
			endif;

			return $out;
		}
	}



