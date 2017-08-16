<?php
/**
 * @package Pre-Publish Checklist
 * @version 0.2
 */
/*
Plugin Name: Pre-Publish Checklist
Plugin URI: http://wordpress.org/plugins/pre-publish-checklist/
Description: This plugin adds a checklist into the Wordpress post editor, and once the author has checked that the requirements for the post have been met, the publish button will become available.
Author: Matt Tiernan, Christien Guy
Version: 0.2
Author URI: http://eclecticapp.xyz
*/

$check_defaults = ["Featured image is 740 x 240","Keyword has been set","Tags and categories set"];
add_option('checklist-item', $check_defaults);

// Initialisation function which loads stylesheets and scripts separately.
add_action('admin_menu', 'eclecticapp_checklist_settings_create');
add_action('admin_init', 'eclecticapp_init');
add_action('post_submitbox_misc_actions', 'eclecticapp_pre_publish_checklist_generate');

function eclecticapp_init() {
	wp_register_style( 'eclecticapp-list-styles', plugins_url('public/css/checklist.css', __FILE__) );
	wp_enqueue_style('eclecticapp-list-styles');

	wp_register_script( 'eclecticapp-list-js', plugins_url('public/js/checklist-watch.js', __FILE__) );
	$vars = array(
		'totalChecklistItems' => count(get_option('checklist-item',FALSE) )
	);
	wp_localize_script( 'eclecticapp-list-js', 'vars', $vars );
	wp_enqueue_script('eclecticapp-list-js');
	
	wp_register_script( 'eclecticapp-edit-list-js', plugins_url('public/js/edit-checklist.js', __FILE__), [], '', true );
	wp_enqueue_script('eclecticapp-edit-list-js');
}

// Sets up the form using separated parameters
function eclecticapp_checklist_settings_create() {
    $page_title = 'Checklist Admin';
    $menu_title = 'Checklist Admin';
    $capability = 'manage_options';
    $menu_slug = 'checklist_settings';
    $function = 'eclecticapp_checklist_settings_display';
    $icon_url = '';
    $position = 20;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

// Displays the form page
function eclecticapp_checklist_settings_display() {
	
	// If the user is not able to manage options, they cannot see the settings form
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized user');
    }
	
	// If the form nonce is invalid, quit the form as well - not working
    /*if (!wp_verify_nonce( '_wp_nonce', 'ea_checklist_settings_action' )) {
        wp_die('Nonce verification failed');
    }*/
	
	// If there is POST data with updated entries, use these
    if (isset($_POST['checklist-item'])) {
        update_option('checklist-item', $_POST['checklist-item']);
        $value = $_POST['checklist-item']; 
    }
	
    $value = get_option('checklist-item', $check_defaults);
    $num_ppc_checks = count($value);
    
	include 'public/partials/edit-checklist.php';
}


function eclecticapp_pre_publish_checklist_generate($post) {
	$num_ppc_checks = count(get_option('checklist-item',FALSE));
	$value = get_option('checklist-item', $check_defaults);
	include 'public/partials/post-edit-checklist.php';
}

?>
