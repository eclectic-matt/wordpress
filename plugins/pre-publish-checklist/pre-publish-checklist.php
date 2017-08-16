<?php
/**
 * @package Pre-Publish Checklist
 * @version 0.1
 */
/*
Plugin Name: Pre-Publish Checklist
Plugin URI: http://wordpress.org/plugins/pre-publish-checklist/
Description: This plugin adds a checklist into the Wordpress post editor, and once the author has checked that the requirements for the post have been met, the publish button will become available.
Author: Matt Tiernan
Version: 0.1
Author URI: http://eclecticapp.xyz
*/
include_once('pre-publish-checklist-update.php');
//include_once('pre-publish-checklist-menu.php');

// Customising checklist
$check_defaults = ["Featured Image Set", "Longtail keyword set", "Yoast SEO - Green"];
if ( !isset( $GLOBALS['checklist_entries'] ) ){
	$GLOBALS['checklist_entries'] = $check_defaults;
}
add_action( 'admin_head', 'eclecticapp_pre_publish_checklist_hide_publish' );
add_action('post_submitbox_misc_actions', 'eclecticapp_pre_publish_checklist_generate');

//Testing menu page
add_action('admin_menu','eclecticapp_pre_publish_checklist_add_menu');

function eclecticapp_pre_publish_checklist_add_menu(){
	add_menu_page("Publish Checklist","Checklist", 4, "checklist", "eclecticapp_pre_publish_checklist_add_settings_menu");
}

function eclecticapp_pre_publish_checklist_add_settings_menu(){
	global $num_ppc_checks;
	$num_ppc_checks = count($GLOBALS['checklist_entries']);
	//echo $num_ppc_checks;
	echo "<h2>Checklist Editor (" . $num_ppc_checks . " checks)</h2>
			<ul>
			<form action='" . plugins_url() . "/pre-publish-checklist/pre-publish-checklist-update.php' method='post' id='cl_update'>
	";
	for ($i = 1; $i <= $num_ppc_checks; $i++){
		echo "<li>
				<input name='" . ($i - 1) . "' value='" . $GLOBALS['checklist_entries'][($i - 1)] . "' type='text'></input>
		</li>";
	}
	echo "</ul>";
	
	//echo "<input type='button' onclick='function(){document.getElementById('cl_update').submit()}' value='submit'>";
	echo "<input type='submit' value='submit'>";
	echo "
	</form>
	";
}


function eclecticapp_pre_publish_checklist_hide_publish(){
	echo "<style>
			#publishing-action{
				display: none;
			}
		</style>";
}

function eclecticapp_pre_publish_checklist_generate($post){
	
	$num_ppc_checks = count($GLOBALS['checklist_entries']);
	echo "<script type='text/javascript'>
			
			function ppc_check_ready(){
				var ready = true;
				var checks = $num_ppc_checks;
				for (var i = 1; i < checks + 1; i++){
					var box_id = 'ppc-check-' + i;
						//console.log('Checking ' + box_id);
					var this_box = document.getElementById(box_id);
					if (this_box.checked === false){
						var ready = false;
					}
				}
				if (ready === true){
					document.getElementById('publishing-action').style.display = 'block';
				}else{
					document.getElementById('publishing-action').style.display = 'none';
				}
			}
		</script>
	";
	
	echo "<form id='pre-publish-checklist-form'>
		<div class='postbox'>
		<h2>Pre-Publish Checks</h2>
		<em style='padding-left:10px'>All checks must be ticked before publishing!</em>
		<br>
		<div style='line-height: 2em;'>
	";

	for ($i = 1; $i <= $num_ppc_checks; $i++){
		echo "<label style='padding-left: 10px;' class='selectit' for='ppc-check-$i'>
				<input type='checkbox' id='ppc-check-$i' onchange='ppc_check_ready()'></input>";
				// Simple version
				//echo "Check $i ";
				
				//Customised text
				echo $i . ": " . $GLOBALS['checklist_entries'][$i - 1]; //$check_titles[$i - 1];
		
		echo "</label>
			<br>";
	}

	echo "</div>
		</div>
	</form>";
}


?>
