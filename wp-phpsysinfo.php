<?php
/*
Plugin Name: Hosting monitor
Plugin URI: http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php
Description: php system information wordpress plugin hosting monitor
Author: webhostingsearch development team
Version: 0.9.1
Author URI: http://www.webhostingsearch.com/
*/

add_action ( 'plugins_loaded', 'phpsysinfo_init_configuration' );
function phpsysinfo_init_configuration ()
{
	global $xml_root_node;
	
	$pluginFolderName = substr(dirname(__FILE__), strrpos(dirname(__FILE__), DIRECTORY_SEPARATOR) +1);
	
	define( 'PLUGIN_NAME_SYS', $pluginFolderName );
	define( 'APP_ROOT', WP_CONTENT_DIR . DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$pluginFolderName );
	
	define( 'IN_PHPSYSINFO', true );
	if ( file_exists( APP_ROOT . DIRECTORY_SEPARATOR.'wp-phpsysinfo-config.php' ) ) 
	{
		require_once ( APP_ROOT . DIRECTORY_SEPARATOR.'wp-phpsysinfo-config.php' );
	}
}

add_action('wp_head', 'phpsysinfo_include_css'); 
function phpsysinfo_include_css()
{
	$path = substr(WP_CONTENT_DIR, strrpos(WP_CONTENT_DIR, DIRECTORY_SEPARATOR) +1). '/plugins/'. PLUGIN_NAME_SYS.'/web/css/wp-phpsysinfo.css';
   
   	echo '<link rel="stylesheet" type="text/css" href="' . $path . '" />';
}

function get_phpsysinfo_html()
{
	echo '<ul>'."\n";
		echo phpsysinfo_get_all();
	echo '</ul>'."\n";
}

function phpsysinfo_get_all()
{
	global $xml_root_node;
	
	if (get_option('vital')) 
	{
		include( APP_ROOT . DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.'vital.tpl.php');	
	}
	
	if (get_option('hardware')) 
	{
		include( APP_ROOT . DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.'hardware.tpl.php');	
	}
	
	if (get_option('memory')) 
	{
		include( APP_ROOT . DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.'memory.tpl.php');	
	}
	
	if (get_option('network')) 
	{
		include( APP_ROOT . DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.'network.tpl.php');	
	}
	
	if (get_option('filesystems')) 
	{
		include( APP_ROOT . DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.'filesystems.tpl.php');	
	}
}

add_action('admin_menu', 'phpsysinfo_menu');

function phpsysinfo_menu() {
  add_options_page('System information Options', 'Hosting Monitor', 8, __FILE__, 'phpsysinfo_options');
}

function phpsysinfo_options() {
  global $xml_root_node;
  
  include ( APP_ROOT . DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.'options.tpl.php');
}

function gf()
{
	$a = array();
	$a[] = array (1, 2, 3, 4, 5);
	$a[] = array (6, 7, 8, 9, 0);
	$a[] = array ('a', 'b', 'c', 'd', 'e');
	$a[] = array ('f', 'g', 'h', 'i', 'j');
	$a[] = array ('k', 'l', 'm', 'n', 'o');
	$a[] = array ('p', 'q', 'r', 's', 't');
	$a[] = array ('u', 'v', 'w', 'x', 'y');
	$a[] = array ('z');
	
	$t = array();
	$t[] = '<span class="wp-phpsysinfo-footer"><a href="http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php" title="Hosting Monitor Plugin">Hosting Monitor Plugin</a> by <a href="http://www.webhostingsearch.com/" title="Web Hosting Search">WHS</a></span>';
	$t[] = '<span class="wp-phpsysinfo-footer"><a href="http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php" title="Hosting Statistics Plugin">Hosting Statistics</a> provided by <a href="http://www.webhostingsearch.com/" title="Web Hosting Search">WHS</a></span>';
	$t[] = '<span class="wp-phpsysinfo-footer"><a href="http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php" title="Server Statistics Plugin">Server Statistics</a> plugin by <a href="http://www.webhostingsearch.com/" title="Web Hosting Search">WHS</a></span>';
	$t[] = '<span class="wp-phpsysinfo-footer"><a href="http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php" title="Hosting Statistics">Host Stats</a> by <a href="http://www.webhostingsearch.com/" title="Web Hosting Search">Web Hosting Search</a></span>';
	$t[] = '<span class="wp-phpsysinfo-footer">This <a href="http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php" title="Hosting Monitor Plugin">plugin</a> is developed by <a href="http://www.webhostingsearch.com/" title="Web Hosting Search">WHS</a></span>';
	$t[] = '<span class="wp-phpsysinfo-footer"><a href="http://www.webhostingsearch.com/" title="Web Hosting Search">WHS</a> developed this <a href="http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php" title="Hosting Monitor Plugin">plugin</a></span>';
	$t[] = '<span class="wp-phpsysinfo-footer"><a href="http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php" title="Hosting Monitor Plugin">Plugin</a> powered by <a href="http://www.webhostingsearch.com/" title="Web Hosting Search">WebHostingSearch</a></span>';
	$t[] = '<span class="wp-phpsysinfo-footer">Get your own <a href="http://www.webhostingsearch.com/articles/cool-plugin-giving-you-system-information.php" title="Hosting Monitor Plugin">Hosting Monitor</a></span>';
	
	$fl = substr ( str_replace("www.","",$_SERVER['HTTP_HOST']), 0, 1 );
	
	include( APP_ROOT . DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.'footer.tpl.php'); 
}
?>