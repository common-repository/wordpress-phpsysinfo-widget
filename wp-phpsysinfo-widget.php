<?php 
/*
Plugin Name: Hosting monitor widget
Plugin URI: http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php
Description: hosting monitor php system information wordpress plugin widget
Author: webhostingsearch development team
Version: 0.9.1
Author URI: http://www.webhostingsearch.com/
*/

function widget_phpsysinfo_init() {
	if (!function_exists('register_sidebar_widget')) {
		return;
	}

	### Function: wp-phpsysinfo-all
	function widget_phpsysinfo($args) {
		extract($args);
		$title = 'System information';
		if (function_exists('phpsysinfo_get_all')) {
			echo $before_widget.$before_title.get_option('widget_title').$after_title.get_option('widget_description');
			echo '<ul>'."\n";
				echo phpsysinfo_get_all();
			echo '</ul>'."\n";
			echo $after_widget;
			echo gf();
		}		
	}

	### Function: WP-PostViews Most Viewed Widget Options
	function widget_phpsysinfo_options() {
		
	}
	// Register Widgets
	register_sidebar_widget('System information', 'widget_phpsysinfo');
	register_widget_control('System information options', 'widget_phpsysinfo_options');
}






### Function: Load The wp-phpsysinfo Widget
add_action('plugins_loaded', 'widget_phpsysinfo_init')
?>
