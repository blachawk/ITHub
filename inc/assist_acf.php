<?php	
/**
 * MANAGE ALL AFC OBJECT LOGIC FOR ANY GIVEN PAGE.
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
				echo "<div class='row'>";
				echo "<div class='col-12 my-3'>";
				echo "<h3>".get_field('home_favicon_section_header')."</h3>";
				echo "</div>";

				$mcount = 1;
				foreach($field_group as $mfname => &$mfvalue) { 
					//ONLY GET CALL-TO-ACTION FIELDS 
					if ( (strpos($mfvalue['label'], 'Section Header') === false) && (strpos($mfvalue['label'], 'Section') !== false)  ) {
						//GROUP EVERY 2 ARRAY VALUES IN BS4 DIV COLUMNS
						if ($mcount%2 == 1){echo "<div class='col-md-3 my-3 px-5'>";}
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
				$out .= "<ul id='mTabs' class='nav nav-tabs my-4' role='tablist'>";
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
	
					//CONSTRUCT THE BS4 LAYOUT TAB CONTENT SECTIONS
					$out .= "<div id='mTabContent' class='tab-content'>";
					$tabcontentindex = 1;
					foreach($field_group as $mfname => &$mfvalue) { 
							if($mfvalue['label'] == "Wrike Iframe") {
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
							$out .= "<div id='tab{$tabcontentindex}content' class='tab-pane fade ".(($tabcontentindex==1)?'active show':"")."' role='tabpanel' aria-labelledby='tab{$tabcontentindex}'><div class='embed-responsive embed-responsive-16by9'{$mfvalue['value']}</div></div>";
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
				$sliced_array = array_slice($field_group, 1); 
				$mcount = 1;
				echo "<div class='row'>";
					foreach($sliced_array as $mfname => &$mfvalue) {
						//GET ALL CONTENT ASSOCIATED TO FIRST TAB
						//FILTER ARRAY KEY BY PART OF A STRING VALUE
						if (strpos($mfname, 'tab_01_') !== false) {
						//GROUP ARRAY VALUES IN DIV EVERY X TIME
						if ($mcount%2 == 1){  

							echo "<div class='col-6'>";
						}
					
						//DECOR SUBTITLES
						if ($mfvalue['label'] == "Sub Title") {
							echo "<h4 class='my-5'>".$mfvalue['value']. "</h4>";
						}
						//DECOR IFRAMES
						if ($mfvalue['label'] == "Box Iframe") {
							echo "<div class='embed-responsive embed-responsive-16by9'>".$mfvalue['value']. "</div>";
						}
						if ($mcount%2 == 0){echo "</div>";}
						$mcount++;
						}
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
