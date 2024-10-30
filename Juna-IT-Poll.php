<?php
/*
	Plugin name: Juna IT Poll
	Plugin URI: http://juna-it.com/index.php/features/elements/juna-it-plugin/
	Description: Juna IT Poll - Wordpress Plugin is an instrument for understanding visitor's opinions.
	Version: 1.4.33
	Author: Juna-IT
	Author URI: http://juna-it.com/
	License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/	
 	require_once('Juna-IT-Poll-Widget.php');
 	require_once('Juna-IT-Poll-Ajax.php');
 	require_once('Juna-IT-Poll-Shortcode.php');
 	add_action('wp_enqueue_scripts',function() {

 		wp_register_style('poll-wp', plugins_url('/Styles/Juna-IT-PollWidget.css',__FILE__ ));
		wp_enqueue_style('poll-wp');	
		wp_register_script('poll-wp',plugins_url('/Scripts/Juna-IT-Poll-Widget.js',__FILE__),array('jquery','jquery-ui-core'));
		wp_localize_script('poll-wp', 'object', array('ajaxurl' => admin_url('admin-ajax.php')));
		wp_enqueue_script('poll-wp');
		wp_enqueue_script("jquery");
 	});

 	add_action('widgets_init', function() {
 		register_widget('Juna_IT_Poll');
 	} );

	add_action("admin_menu", function() {

		add_menu_page('poll-wp_Admin_Menu','Juna IT Poll', 'manage_options','Juna_IT_Poll', 'Add_Poll',plugins_url('/Images/admin.png',__FILE__));
 		add_submenu_page('Juna_IT_Poll', 'poll-wp_Admin_Menu', 'Add Poll', 'manage_options', 'Juna_IT_Poll', 'Add_Poll');
		add_submenu_page('Juna_IT_Poll', 'poll-wp_Admin_Menu_Settings', 'Poll Settings', 'manage_options', 'Poll-Settings', 'Poll_Settings');		
		add_submenu_page('Juna_IT_Poll', 'poll-wp_Admin_Menu_Resultsget', 'Results', 'manage_options', 'Admin_Menu_Results', 'See_Results');
		add_submenu_page('Juna_IT_Poll', 'Juna-IT Products', 'Juna-IT Products', 'manage_options', 'Juna_IT_Products', 'Manage_Juna_IT_Products_Poll');		
	});

	add_action('admin_init', function() {
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');

		wp_register_style( 'poll-wp', plugins_url('/Styles/Juna-IT-Poll-Admin.css',__FILE__ ));
		wp_enqueue_style( 'poll-wp' );	
		wp_register_script('poll-wp', plugins_url('/Scripts/Juna-IT-Poll-Admin.js',__FILE__),array('jquery','jquery-ui-core'));
		wp_localize_script('poll-wp','object', array('ajaxurl'=>admin_url('admin-ajax.php')));
		wp_enqueue_script('poll-wp');

		wp_register_style('fontawesome-css', plugins_url('/Styles/junaiticons.css', __FILE__)); 
  		wp_enqueue_style('fontawesome-css');	
	});

	function Add_Poll()
	{
		require_once('Juna-IT-Poll-Add.php');
		require_once('Styles/Juna-IT-Poll-Add.css.php');
		require_once('Scripts/Juna-IT-Poll-Add.js.php');
	}
	function Poll_Settings()
	{
		require_once('Juna-IT-Poll-Settings.php');
		require_once('Styles/Juna-IT-Poll-Settings.css.php');
		require_once('Scripts/Juna-IT-Poll-Settings.js.php');
	}
	function See_Results()
	{
		require_once('Juna-IT-Poll-Results.php');
	}
	function Manage_Juna_IT_Products_Poll()
	{
		require_once('Juna-IT-Products.php');
	}	

	function poll_wp_activate()
	{
		require_once('Juna-IT-Poll-Install.php');
	}
	register_activation_hook(__FILE__,'poll_wp_activate');
?>