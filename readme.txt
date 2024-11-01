=== Hosting monitor by WebHostingSearch.com ===
Contributors: Webhostingsearch development team
Tags: hosting monitor system information php webhostingsearch 
Requires at least: 2.7.0
Stable tag: 0.9.1

Enables to display information on the system where your wordpress website is hosted

== Description ==

The plugin, that is adapted from the phpsysinfo library, is the
creation/development of the highly skilled dev-team at WebHostingSearch.com.
What the plugin does is to display information about the system on which
your blog is installed. The information that you get is presented in the
five following categories: Viral, Hardware, Network, Filesystems and Memory.
The plugin will show up on the homepage of your blog, using the widget
feature on the WordPress platform. An admin option page has been made
available in order to put you in control of which information that is to be
hidden and which that is to be shown.

Please contact the dev-team at [info (at) webhostingsearch.com] if you were
to encounter any problem or if you simply wish to propose any enhancement of
this plugin.

== Installation ==

	- Upload the plugin to the wp-content/plugins folder in your WordPress directory online. 
	- Activate the Plugin:

   		1. Access the Plugin Panel in your Administration Panels
   		2. Scroll down through the list of Plugins to find the newly installed Plugin (if not visible, start from the beginning to check to see if you followed the instructions properly and uploaded the file correctly).
   		3. Click on the Activate link to turn the Plugin on. Actually you have two plugin to set to on.
   		4. Access the Appearance Panel in your Administration Panels
   		5. Click on widget
   		6. Click on add Hosting monitor widget and save changes
        7. Set your widget options in the admin.
        8. Click on Settings and Hosting Monitor to choose what information you would like to display about your system.

   Note: If your wordpress installation does not have the widget sidebar feature u can insert the following hook in your template: '<?php get_phpsysinfo_html() ?>'

== Requirements ==
    PHP5.2 worked with 5.x but ot fully tested
    Please refer to phpsysinfo requirements ie readme file for more details. http://phpsysinfo.sourceforge.net/

== Future Enhancements ==
    - Multilanguage
    - Devices implementation

== Screenshots ==

1. Overview on the site: Show different type of information about your hosting machine.
2. Overview of the administration: Choose the information that you want to diaplay on your blog.

== Frequently Asked Questions ==

= How does this work? =
	The plugins provide you with a simple hook that you can attach anywhere in your web page and a widget that you can control directly from your administration area.

= How can I change what I want to be seen? =
	To modify the information displayed by the plugin you have to go to your administration area and click on the link oho system information. You will be redirected to a form page where you can select the infornation you want to show or hide.

= What does "unknown" mean? =
 	When you see unknown instead of the information that should be displayed this is because your hosting provider has decided not to allow this type of information to be public. Unfortunatly you can't do much about it. 

= Why are there three numbers for the Load Averages? =
	You can find more information about this on wikipedia http://en.wikipedia.org/wiki/Load_(computing)
= Does this plugin work with all hosting companies? =
	In theory this plugin works with all type of machine and all type of hosting companies. As explained above the hosting companies can decide to not give access to certain information about their machine and then the plugin cannot retrieve the information you want.
= Why do I have two plugins after installing it? Do I need to activate both? = 
	The plugin is made by two plugins, one plugin that handle the data, generate the administration interface and provide a hook to be inserted anywhre in your template and another that provides the widget functionnality.



