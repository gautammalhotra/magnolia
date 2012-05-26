<?php
/*
Copyright (C) 2009 NetWebLogic LLC
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

class MetaTagManagerAdmin {
	
	/** loads the plugin */
	function init() {
		// i18n
		load_plugin_textdomain ( 'meta-tag-manager', '', basename ( dirname ( __FILE__ ) ) );		
		// add plugin page to admin menu
		add_action ( 'admin_menu', array ( __CLASS__, 'menus' ) );
	}
	
	/** adds plugin page to admin menu; put it under 'Settings' */
	function menus() {
		$page = add_options_page ( __ ( 'Meta Tag Manager', 'meta-tag-manager' ), __ ( 'Meta Tag Manager', 'meta-tag-manager' ), 8, 'mtmverification', array ( __CLASS__, 'options' ) );
		// add javascript
		add_action ( "admin_print_scripts-$page", array ( __CLASS__, 'scripts' ) );
	}
	
	/** loads javascript on plugin admin page */
	function scripts() {
		wp_enqueue_script ( 'meta-tag-manager', path_join ( WP_PLUGIN_URL, basename ( dirname ( __FILE__ ) ) . '/mtm_script.js' ), array ('jquery' ) );
	}
	
	/** the plugin page and all the admin code – old php style spaghetti code */
	function options() {
		add_option ( 'mtm_data' );
		$mtm_data = array ();
		if (is_admin () and 1 == $_POST ['mtm_submitted']) {
			check_admin_referer ( 'mtmverification' );
			for($i = 1; isset ( $_POST ["mtm_{$i}_ref"] ); $i ++) {
				$name = trim ( $_POST ["mtm_{$i}_name"] );
				$content = trim ( $_POST ["mtm_{$i}_content"] );
				$ref = trim ( $_POST ["mtm_{$i}_ref"] );
				
				if ( !get_magic_quotes_gpc() ) {
					$name = stripslashes ( $name );
					$content = stripslashes ( $content );
					$ref = stripslashes ( $ref );
				}
				
				if ('' != $name and '' != $content) {
					$meta = array ($name, $content, $ref );
					if (isset ( $_POST ["mtm_{$i}_homepageonly"] ))
						$meta [3] = 1;
					$mtm_data [] = $meta;
				}
			}
			update_option ( 'mtm_data', $mtm_data );
			echo '<div id="message" class="updated fade"><p><strong>' . __ ( 'Settings saved.' ) . '</strong></p></div>'; // No textdomain: phrase used in core, too
		} else {
			$mtm_data = get_option ( 'mtm_data' );
		}
		?>
		<div class="wrap nwl-plugin">
			<h2><?php _e ( 'Meta Tag Manager', 'meta-tag-manager' ); ?></h2>
			<div id="poststuff" class="metabox-holder has-right-sidebar">
				<div id="side-info-column" class="inner-sidebar">
					<div id="categorydiv" class="postbox ">
						<div class="handlediv" title="Click to toggle"></div>
						<h3 class="hndle">Plugin Information</h3>
						<div class="inside">
							<p>This plugin was developed by <a href="http://twitter.com/marcussykes">Marcus Sykes</a> @ <a href="http://netweblogic.com">NetWebLogic</a></p>
							<p>Please visit <a href="http://netweblogic.com/forums/">our forum</a> for plugin support.</p>
						</div>
					</div>
					<div id="categorydiv" class="postbox ">
						<div class="handlediv" title="Click to toggle"></div>
						<h3 class="hndle">Special Thanks</h3>
						<div class="inside">
							<p><a href="http://ten-fingers-and-a-brain.com">Martin Lormes</a> for his contribution.</p>
						</div>
					</div>
				</div>
				<div id="post-body">
					<div id="post-body-content">
				      <p><?php _e ( 'Enter a reference name (something to help you remember the meta tag) and then enter the values that you want the meta tag to hold.', 'meta-tag-manager' ); ?></p>
				      <form method="post" action="">
				        <?php wp_nonce_field ( 'mtmverification' ); ?>
				        <table class="form-table">
				          <thead>
				            <tr valign="top">
				              <td><strong><?php _e ( 'Reference Name', 'meta-tag-manager' ); ?></strong></td>
				              <td><strong><?php _e ( 'Meta Tag', 'meta-tag-manager' ); ?></strong></td>
				              <td><strong><?php _e ( 'Homepage only', 'meta-tag-manager' ); ?></strong></td>
				            </tr>
				          </thead>
				          <tbody id="mtm_body">
				            <?php if ( is_array ( $mtm_data ) AND count ( $mtm_data ) > 0 ) : ?>
				              <?php foreach ( $mtm_data as $name => $meta ) : $count++; ?>
				                <tr valign="top" id="mtm_<?php echo $count; ?>">
				                  <td scope="row">
				                    <input type="text" name="mtm_<?php echo $count; ?>_ref" value="<?php echo ( isset ( $meta[2] ) ) ? htmlspecialchars ( $meta[2] ) : $name; // $name is for backward compatibility of mtm_data ?>" />
				                    <a href="#" rel="<?php echo $count; ?>"><?php _e ( 'Remove', 'meta-tag-manager' ); ?></a></td>
				                  <td>&lt;meta name="<input type="text" name="mtm_<?php echo $count; ?>_name" value="<?php echo htmlspecialchars ( $meta[0] ); ?>" />" content="<input type="text" name="mtm_<?php echo $count; ?>_content" value="<?php echo htmlspecialchars ( $meta[1] ); ?>" class="regular-text" />" /&gt;</td>
				                  <td><input type="checkbox" name="mtm_<?php echo $count; ?>_homepageonly" value="1"<?php echo ( isset ( $meta[3] ) ) ? ' checked="checked"' : ''; ?> /></td>
				                </tr>
				              <?php endforeach; ?>
				            <?php else : ?>
				              <tr valign="top" id="mtm_1">
				                <td scope="row">
				                  <input type="text" name="mtm_1_ref" value="" />
				                  <a href="#" rel="1"><?php _e ( 'Remove', 'meta-tag-manager' ); ?></a></td>
				                <td>&lt;meta name="<input type="text" name="mtm_1_name" value="" />" content="<input type="text" name="mtm_1_content" value="" class="regular-text" />" /&gt;</td>
				                <td><input type="checkbox" name="mtm_1_homepageonly" value="1" /></td>
				              </tr>
				            <?php endif; ?>
				          </tbody>
				          <tfoot>
				            <tr valign="top">
				              <td colspan="2"><a href="#" id="mtm_add_tag"><?php _e ( 'Add new tag', 'meta-tag-manager' ); ?></a></td>
				            </tr>
				          </tfoot>
				        </table>
				        <input type="hidden" name="mtm_submitted" value="1" />
				        <p class="submit">
				          <input type="submit" class="button-primary" value="<?php _e('Save Changes'); // No textdomain: phrase used in core, too ?>" />
				        </p>
				      </form>
				    </div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

}

// Start this plugin once all other plugins are fully loaded
add_action( 'init', array('MetaTagManagerAdmin', 'init') );
