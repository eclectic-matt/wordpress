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

// Initialisation function which loads stylesheets and scripts separately.
add_action( 'admin_init', 'eclecticapp_init' );

function eclecticapp_init() {
	wp_register_style( 'eclecticapp-list-styles', plugins_url('public/css/checklist.css', __FILE__) );
	wp_enqueue_style('eclecticapp-list-styles');

	wp_register_script( 'eclecticapp-list-js', plugins_url('public/js/checklist-watch.js', __FILE__) );
	$vars = array(
		'totalChecklistItems' => count($GLOBALS['checklist_entries'])
	);
	wp_localize_script( 'eclecticapp-list-js', 'vars', $vars );
	wp_enqueue_script('eclecticapp-list-js');
	
	wp_register_script( 'eclecticapp-edit-list-js', plugins_url('public/js/edit-checklist.js', __FILE__), [], '', true );
	wp_enqueue_script('eclecticapp-edit-list-js');
}


include_once('pre-publish-checklist-update.php');
//include_once('pre-publish-checklist-menu.php');

// Customising checklist
$check_defaults = ["Featured Image Set", "Longtail keyword set", "Yoast SEO - Green"];
if ( !isset( $GLOBALS['checklist_entries'] ) ){
	$GLOBALS['checklist_entries'] = $check_defaults;
}
add_action('post_submitbox_misc_actions', 'eclecticapp_pre_publish_checklist_generate');

//Testing menu page
add_action('admin_menu','eclecticapp_pre_publish_checklist_add_menu');

function eclecticapp_pre_publish_checklist_add_menu(){
	add_menu_page("Publish Checklist","Checklist", 4, "checklist", "eclecticapp_pre_publish_checklist_add_settings_menu");
}

function eclecticapp_pre_publish_checklist_add_settings_menu(){
	global $num_ppc_checks;
	$num_ppc_checks = count($GLOBALS['checklist_entries']);
	
	include 'public/partials/edit-checklist.php';
}

function eclecticapp_pre_publish_checklist_generate($post) {
	$num_ppc_checks = count($GLOBALS['checklist_entries']);
	include 'public/partials/post-edit-checklist.php';
}

?>
