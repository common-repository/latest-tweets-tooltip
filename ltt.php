<?php
/*
Plugin Name: Latest Tweets Tooltip
Plugin URI: http://www.cmscrate.com/wordpress/wordpress-plugin-latest-tweets-tooltip
Description: A wordpress plugin which will allow you to show the latest tweets about a certain word or phrase in a draggable and resizable jQuery tooltip window.
Author: Adrian Apan
Version: 1.0.0
Author URI: http://www.cmscrate.com
Text Domain: LTT
*/


/**
 * Latest Tweets Tooltip is a plugin for WordPress 3.1
 * Free for personal use. Any distribution, copy, resell, rent or related action is allowed only you use a backlink to http://www.cmscrate.com
**/


/**
 * 1. WP path definitions ----------------------------------------------------->
**/

if(!defined('WP_CONTENT_URL'))
	define('WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
if(!defined('WP_CONTENT_DIR'))
	define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
if(!defined('WP_PLUGIN_URL'))
	define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
if(!defined('WP_PLUGIN_DIR'))
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');


/**
 * 2. CSS and JS definitions --------------------------------------------------->
**/
class LTT {
   function addHeaderCode() {
			$LTTPath = WP_CONTENT_URL.'/plugins/'.plugin_basename(dirname(__FILE__)).'/';
			echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $LTTPath . 'css/style.css" />'."\n";
			echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $LTTPath . 'css/jquery.ui.theme.css" />'."\n";
			echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $LTTPath . 'css/jquery.ui.core.css" />'."\n";
			echo '<link rel="stylesheet" type="text/css" media="screen" href="' . $LTTPath . 'css/jquery.ui.resizable.css" />'."\n";
			echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>'."\n";
			echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>'."\n";
			echo '<script type="text/javascript" src="' . $LTTPath . 'jquery.twitterpopup.js"></script>'."\n";
			echo '<script type="text/javascript" src="' . $LTTPath . 'jquery.twitter.search.js"></script>'."\n";
	?>
		<style>
			#content p{float:left !important;}
			.search_results {width: 400px; position:absolute; display:none;}
		</style>
		<script>
			$(function() {
				$('#content').find('.twitter_search').twitterpopup();
			});
		</script>
	<?php
	}
}

/**
 * 3. Functions ----------------------------------------------------------------->
**/


/* Shortcode Implementation */
function LTTShortCode($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
	return '<span class="twitter_search">'.$content.'</span>';
}



/**
 * 4. Actions ----------------------------------------------------------------->
**/

if (class_exists("LTT")) {
	$dl_plugin = new LTT();
}

if (isset($dl_plugin)) {
	add_action('wp_head', array(&$dl_plugin, 'addHeaderCode'));
	add_shortcode('ltt', 'LTTShortCode');
}
?>