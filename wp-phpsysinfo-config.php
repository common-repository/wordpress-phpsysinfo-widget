<?php
	ini_set('error_reporting', E_ALL ^ E_NOTICE);
	ini_set('display_errors','On');
		
/*	if ( PHP_VERSION < 5.2 ) 
	{
		die( "PHP 5.2 or greater is required." );
	} */

	
	
	if ( file_exists ( APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'common_functions.php' ) ) 
	{
		require_once ( APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'common_functions.php' );
	}
	else 
	{
		die( "common_functions.php is required." );
	}
	
	checkForExtensions();
	
	$error = Error::singleton();
	
	if ( !is_readable ( WP_CONTENT_DIR . DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$pluginFolderName.DIRECTORY_SEPARATOR.'config.php' ) ) 
	{
		$error->addError('file_exists(config.php)', 'config.php does not exist or is not readable by the webserver in the phpsysinfo directory.');
	} 
	else
	{
		require_once ( WP_CONTENT_DIR . DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$pluginFolderName.DIRECTORY_SEPARATOR.'config.php' );	
	}
	
	if ( $error->ErrorsExist() ) 
	{
  		echo $error->ErrorsAsHTML();
  		exit;
	}
	
	if ( !defined('lang') ) 
	{
  		define( 'lang', 'en' );
	}
	
	$lang = lang . ".xml";
	
	if ( !file_exists( WP_CONTENT_DIR . DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.''.$pluginFolderName.DIRECTORY_SEPARATOR.'language'.DIRECTORY_SEPARATOR.'' . $lang ) ) 
	{
	  $lang = 'en.xml';
	}
	
	if ( file_exists( APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'os'.DIRECTORY_SEPARATOR.'class.' . PHP_OS . '.inc.php' ) ) 
	{
    	require_once ( APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'os'.DIRECTORY_SEPARATOR.'class.' . PHP_OS . '.inc.php' );
  	}
	else 
	{
    	$error->addError( 'include(class.' . PHP_OS . '.php.inc)', PHP_OS . ' is not currently supported' );
  	}
	
	if ( !extension_loaded( 'pcre' ) ) 
	{
    	$error->addError('extension_loaded(pcre)', 'phpsysinfo requires the pcre module for php to work');
  	}
  	if ( sensorProgram !== false ) 
	{
    	$sensor_program = basename(sensorProgram);
    	if (!file_exists(APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'mb'.DIRECTORY_SEPARATOR.'class.' . sensorProgram . '.inc.php')) 
		{
      		define('PSI_MBINFO', false);
      		$error->addError('include(class.' . htmlspecialchars(sensorProgram, ENT_QUOTES) . '.inc.php)', 'specified sensor program is not supported');
    	} 
		else 
		{
      		require_once (APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'mb'.DIRECTORY_SEPARATOR.'class.' . sensorProgram . '.inc.php');
      		define('PSI_MBINFO', true);
    	}
  	} 
	else 
	{
    	define('PSI_MBINFO', false);
  	}
  	if (hddTemp !== false) 
	{
    	if (hddTemp != "tcp" && hddTemp != "suid") 
		{
      		$error->addError('include(class.hddtemp.inc.php)', 'bad configuration in config.php for $hddtemp_avail');
      		define('PSI_HDDTEMP', false);
    	} 
		else 
		{
      		require_once (APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'mb'.DIRECTORY_SEPARATOR.'class.hddtemp.inc.php');
      		define('PSI_HDDTEMP', true);
    	}
	} 
	else 
	{
		define('PSI_HDDTEMP', false);
	}
	if (upsProgram !== false) 
	{
		$ups_program = basename(upsProgram);
		if (!file_exists(APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'ups'.DIRECTORY_SEPARATOR.'class.' . upsProgram . '.inc.php')) 
		{
		  define('PSI_UPSINFO', false);
		  $error->addError('include(class.' . htmlspecialchars(upsProgram, ENT_QUOTES) . '.inc.php)', 'specified UPS program is not supported');
		} 
		else 
		{
		  require_once (APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'ups'.DIRECTORY_SEPARATOR.'class.' . upsProgram . '.inc.php');
		  define('PSI_UPSINFO', true);
		  define('PSI_UPSINFO_APCUPSD_UPS_LIST', apcupsdUpsList);
		}
	} 
	else 
	{
		define('PSI_UPSINFO', false);
	}
  
	if ($error->ErrorsExist()) 
	{
		header("Content-Type: text/xml\n\n");
		echo $error->ErrorsAsXML();
		exit;
	}
  
  // Create the XML file
	require_once (	APP_ROOT . DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'xml.class.php' );

	($plugin_request) ? $phpsysinfo_xml = new xml($plugin, $completexml) : $phpsysinfo_xml = new xml("", $completexml);
	
	$phpsysinfo_xml->buildXml();
	$xml_root_node = simplexml_load_string( $phpsysinfo_xml->getXml() );
	