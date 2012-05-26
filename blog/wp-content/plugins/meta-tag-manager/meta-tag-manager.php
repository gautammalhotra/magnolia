<?php
/*
Plugin Name: Meta Tag Manager
Plugin URI: http://netweblogic.com/wordpress/plugins/meta-tag-manager/
Description: A simple plugin to manage meta tags that appear on all your pages. This can be used for verifiying google, yahoo, and more. &mdash; <a href="options-general.php?page=mtmverification">Settings page</a> &mdash; edited by <a href="http://ten-fingers-and-a-brain.com/">Martin Lormes</a>
Author: NetWebLogic LLC
Version: 1.1
Author URI: http://netweblogic.com/
Text Domain: meta-tag-manager
*/
/*
Copyright (C) 2010 NetWebLogic LLC
Copyright (C) 2009 Martin Lormes

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class MetaTagManager {
	/** loads the plugin */
	function init() {
		add_action ( 'wp_head', array ( __CLASS__, 'head' ) );
	}
	
	/** puts the meta tags in the head */
	function head() {
		//If options form has been submitted, create a $_POST value that will be saved on databse
		$mtm_data = get_option('mtm_data');
		?>
		<!-- Meta Manager Start -->
		<?php
		if(is_array($mtm_data)){
			foreach( $mtm_data as $meta){
				if (! isset ( $meta [3] ) or (1 != $meta [3]) or (is_home () and 'posts' == get_option ( 'show_on_front' )) or is_front_page ()) {
					$name = wp_specialchars ( $meta [0], 1 );
					$content = wp_specialchars ( $meta [1], 1 );
					echo "<meta name=\"$name\" content=\"$content\" />\n";
				}
			}
		}
		?>
		<!-- Meta Manager End -->
		<?php
	}
}

// Include admin backend if needed
if ( is_admin() ) {
	require_once ( 'meta-tag-manager-admin.php' );
}

// Start this plugin once all other plugins are fully loaded
add_action( 'init', array('MetaTagManager', 'init') );
