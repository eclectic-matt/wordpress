<?php
/**
 * @package LLC Pre-Publish Checklist
 * @version 1.0
 */
/*
Plugin Name: Pre-Publish Checklist (LLC)
Plugin URI: http://wordpress.org/plugins/pre-publish-checklist/
Description: This plugin adds a checklist into the Wordpress post editor, and once the author has checked that the requirements for the post have been met, the publish button will become available.
Author: Matt Tiernan
Version: 1.0
Author URI: http://eclecticapp.xyz
*/


// Customising checklist
$check_defaults = ["Featured image is 740 x 240","Gaming Terminology + Nouns are in Italic","Release dates are in Bold","Keyword has been set","Keyword light is green","Categories set with correct PRIMARY","Tags completed"];

$GLOBALS['checklist_entries'] = $check_defaults;

$num_ppc_checks = count($GLOBALS['checklist_entries']);

add_action( 'admin_head', 'eclecticapp_pre_publish_checklist_hide_publish' );
add_action('post_submitbox_misc_actions', 'eclecticapp_pre_publish_checklist_generate');

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
		<h2>Pre-Publish Checks ($num_ppc_checks in total)</h2>
		<em style='padding-left:10px'>All checks must be ticked before publishing!</em>
		<br>
		<div style='line-height: 2em;'>
	";

	for ($i = 1; $i <= $num_ppc_checks; $i++){
		echo "<label style='padding-left: 10px;' class='selectit' for='ppc-check-$i'>
				<input type='checkbox' id='ppc-check-$i' onchange='ppc_check_ready()'></input>";
			
				echo $i . ": " . $GLOBALS['checklist_entries'][$i - 1];
		
		echo "</label>
			<br>";
	}

	echo "</div>
		</div>
	</form>";
}


?>
