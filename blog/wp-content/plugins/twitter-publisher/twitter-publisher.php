<?php
/*
Plugin Name: Twitter Publisher
Plugin URI: http://wordpress.rebelic.nl/twitter-publisher/?utm_source=wordpress&utm_medium=plugin&utm_campaign=twitter-publisher
Description: Share a new blog post on Twitter using awe.sm shorten url service. Support for main blog account and per author twitter accounts. Main Twitter account can reference author's twitter/display name in the tweet.
Version: 2.5
Author: Timan Rebel
Author URI: http://wordpress.rebelic.nl/
*/

/**
 * Register WordPress admin hooks.
 */
function twitter_publisher_init() {
	$options = get_option('twitter_publisher_options');
	
    add_action('profile_update', 'twitter_publisher_profile_update');
    add_action('show_user_profile', 'twitter_publisher_user_profile');
    add_action('edit_user_profile', 'twitter_publisher_user_profile');
	
	add_action('publish_post', 'twitter_publisher_post_tweet');
		
	if ( is_admin() ) {
		//check if there is a need to upgrade
		$twitter_username = get_option('twipub_twitter_username');
		
		if( !empty($twitter_username) && $options['version'] != twitter_publisher_get_version() ) {
			twitter_publisher_upgrade();
		}
		
		//register Twitter Publisher options for Wordpress 2.7+
		twitter_publisher_register_settings();
	}

    //load gettextdomain with correct directory
    load_plugin_textdomain('twitter_publisher', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('admin_init', 'twitter_publisher_init');

function twitter_publisher_get_version() {
	return '2.5';
}

function twitter_publisher_upgrade() {
	//put all options in one array
	$twipub_options = array();
	
	$twipub_options['version'] 					= twitter_publisher_get_version();
	$twipub_options['title_prefix'] 			= get_option('twipub_title_prefix');
	$twipub_options['title_suffix'] 			= get_option('twipub_title_suffix');
	$twipub_options['drop_suffix'] 			 	= get_option('twipub_drop_suffix');
	$twipub_options['api_service'] 			 	= get_option('twipub_api_service');
	$twipub_options['twitter_incl_author']	 	= get_option('twipub_twitter_incl_author');
	$twipub_options['twitter_username'] 		= get_option('twipub_twitter_username');
	$twipub_options['twitter_password'] 		= get_option('twipub_twitter_password');
	$twipub_options['awesm_apikey'] 			= get_option('twipub_awesm_apikey');
	$twipub_options['bitly_apilogin'] 		 	= get_option('twipub_bitly_apilogin');
	$twipub_options['bitly_apikey'] 			= get_option('twipub_bitly_apikey');
	$twipub_options['bitly_use_campaginvars'] 	= get_option('twipub_bitly_use_campaginvars');
	
	//add array
	add_option('twitter_publisher_options', $twipub_options);
	
	//remove old settings (not yet, next version will delete them...)
	/*delete_option('twipub_title_prefix');
	delete_option('twipub_title_suffix');
	delete_option('twipub_drop_suffix');
	delete_option('twipub_api_service');
	delete_option('twipub_twitter_incl_author');
	delete_option('twipub_twitter_username');
	delete_option('twipub_twitter_password');
	delete_option('twipub_awesm_apikey');
	delete_option('twipub_bitly_apilogin');
	delete_option('twipub_bitly_apikey');
	delete_option('twipub_bitly_use_campaginvars');*/
}

/**
 * Register WordPress settings.
 */
function twitter_publisher_register_settings() {
	register_setting('twitter_publisher_options', 'twitter_publisher_options', 'twitter_publisher_validation');
}

/**
 * Unregister WordPress settings for uninstall.
 */
function twitter_publisher_unregister_settings() {
	unregister_setting('twitter_publisher_options', 'twitter_publisher_options', 'twitter_publisher_validation');
}
register_uninstall_hook(__FILE__, 'twitter_publisher_unregister_settings');

function twitter_publisher_validation($input) {
	//validate twitter credentials
	require_once(ABSPATH.WPINC.'/class-snoopy.php');
	
	$snoop = new Snoopy();
	$snoop->agent = 'Twitter Publisher';
	$snoop->user = $input['twitter_username'];
	$snoop->pass = $input['twitter_password'];
	$snoop->fetch('http://twitter.com/account/verify_credentials.xml');
	if( strpos($snoop->response_code, '401') !== false ) {
		
	}
	
	add_query_arg( 'error', 'true', wp_get_referer() );
	
	return $input;
}

/**
 * Save extended profile attributes.
 *
 * @param int $userid ID of user
 */
function twitter_publisher_profile_update($userid) {
    $twitter_username = $_POST['twitter_username'];

    //if the twitter username starts with an @, remove it.
    if(substr($twitter_username, 0, 1) == '@') {
        $twitter_username = substr($twitter_username, 1);
    }

    //check if checkbox has not been checked, then set value to 0
    if(!isset($_POST['twipub_share_on_twitter_too'])) {
        $twipub_share_on_twitter_too = 0;
    } else {
        $twipub_share_on_twitter_too = 1;
    }

    //now save those values
    update_usermeta($userid, 'twitter_username', $twitter_username);
    update_usermeta($userid, 'twitter_password', $_POST['twitter_password']);
    update_usermeta($userid, 'twipub_share_on_twitter_too', $twipub_share_on_twitter_too);
}

/**
 * Show extended profile attributes.
 */
function twitter_publisher_user_profile() {
    global $profileuser;

    echo '  <h3>'.__('Twitter credentials and sharing', 'twitter_publisher').'</h3>
            <table class="form-table">
            <tr>
                <th><label for="twitter_username">'.__('Twitter username:', 'twitter_publisher').'</label></th>
                <td>
                    <input type="text" name="twitter_username" id="twitter_username" value="' . $profileuser->twitter_username .'" />
                    <span class="setting-description">'.__('Do not include the <code>@</code> at the beginning.', 'twitter_publisher').'</span>
                </td>
            </tr>
            <tr>
                <th><label for="twitter_password">'.__('Twitter password:', 'twitter_publisher').'</label></th>
                <td>
                    <input type="password" name="twitter_password" id="twitter_password" value="' . $profileuser->twitter_password .'" />
                    <span class="setting-description">'.__('Only needed to share new blog posts on Twitter.', 'twitter_publisher').'</span>
                </td>
            </tr>
            <tr>
                <th><label for="twipub_share_on_twitter_too">'.__('Share new blog posts:', 'twitter_publisher').'</label></th>
                <td>
                    <input type="checkbox" name="twipub_share_on_twitter_too" id="twipub_share_on_twitter_too" value="1" ' . ($profileuser->twipub_share_on_twitter_too == 1 ? 'checked="checked"': '') .'" />
                    <span class="setting-description">'.__('Tweet the same Tweet as the main Twitter account under my account too.', 'twitter_publisher').'</span>
                </td>
            </tr>
            </table>';
}

/**
 * Tweet about a new blog post on publish
 */
function twitter_publisher_post_tweet($post_id = 0, $tweet_manual = false) {
	$options = get_option('twitter_publisher_options');
	
	//include Snoopy class
    require_once(ABSPATH.WPINC.'/class-snoopy.php');

    //get blog post object
    $post = get_post($post_id);
    
    //always tweet when manual
    if($tweet_manual !== true) {
    	//are we on auto tweet mode?
    	if( $options['no_auto_tweeting'] == 1)
    		return;
    	
	    //only Tweet once about a post
		$twipub_tweeted = get_post_meta($post_id, 'twipub_tweeted', true);
	    if( !empty($twipub_tweeted) ) {
	        return;
	    }
	
	    //do not Tweet when a post is edited
	    if ( strtotime($post->post_date) < strtotime($post->post_modified) ) {
	        return;
	    }
    }

    //get blog post title
    $title = $post->post_title;

    //get author
    $author = get_userdata($post->post_author);

    //get permalink
    $permalink = get_permalink($post_id);

    //get main Twitter account credentials
    $twitter_username = $options['twitter_username'];
    $twitter_password = $options['twitter_password'];

    //only try to Tweet to main account when both twitter username and password have been filled in
    if(!empty($twitter_username) && !empty($twitter_password)) {
        //check if twitter name has been filled in
        if(!empty($author->twitter_username)) {
            $author_name = '@'.$author->twitter_username;
        } else {
            //use display name instead
            $author_name = $author->display_name;
        }

        //generate short url
        $post_url = get_post_meta($post_id, 'twipub_short_url_main', true);
        if(empty($post_url)) {
        	$post_url = twitter_publisher_create_short_url($permalink, 'twitter', 'twitter-publisher-main');
        	add_post_meta($post_id, 'twipub_short_url_main', $post_url, true);
        }
		
        if($options['debug'])
        	add_post_meta($post_id, 'twipub_debug', 'Short url: '. $post_url, false);

        //concat the meta data of the tweet (= tweet without the title) when option is checked to add author's name
        if($options['twitter_incl_author'] == 1) {
            $tweet_meta = ' '. $post_url .' by '. $author_name;
        } else {
            //just concat the URL instead
            $tweet_meta = ' '. $post_url;
        }

        //get the Tweet prefix from the settings (if there is one)
        $tweet_prefix = $options['title_prefix'];
        if(!empty($tweet_prefix)) {
            $tweet_prefix .= ' ';
        }

        //get the Tweet suffix from the settings (if there is one)
        $tweet_suffix = $options['title_suffix'];
        if(!empty($tweet_suffix)) {
            $tweet_suffix = ' '. $tweet_suffix;
        }

        //if title + meta > 140 chars, shorten the title
        if(strlen($title) + strlen($tweet_meta) + strlen($tweet_prefix) + strlen($tweet_suffix) > 140) {
            if($options['drop_suffix'] == 1) {
                $tweet_suffix = '';
            }

            $title = substr($title, 0, 140-(strlen($tweet_prefix) + strlen($tweet_meta) + strlen($tweet_suffix) + 3)). '...';
        }

        //now concatinate the tweet
        $tweet = $tweet_prefix . $title . $tweet_meta . $tweet_suffix;

        //now let's Tweet about it!
        $snoop = new Snoopy();
        $snoop->agent = 'Twitter Publisher';
        $snoop->user = $twitter_username;
        $snoop->pass = $twitter_password;
        $snoop->submit(
            'http://twitter.com/statuses/update.json',
            array(
                'status' => $tweet,
                'source' => 'Twitter-Publisher'
            )
        );
		$twitter_result = $snoop->response_code;
		
		if($options['debug'])
        	add_post_meta($post_id, 'twipub_debug', 'Main twitter: '.$tweet.' - '. $twitter_result, false);
    }

    //when the author wants it, we Tweet the same tweet under his account too (but without the 'by author' part).
    if($author->twipub_share_on_twitter_too && !$tweet_manual &&
        !empty($author->twitter_username) && !empty($author->twitter_password)) {
            //generate short url
            $author_url = twitter_publisher_create_short_url($permalink, 'twitter', 'twitter-publisher-author');

            //if title + url > 140 chars, shorten the title
            if(strlen($tweet_prefix) + strlen($title) + strlen(' '.$author_url) + strlen($tweet_suffix) > 140) {
                if($options['drop_suffix'] == 1) {
                    $tweet_suffix = '';
                }

                $title = substr($title, 0, 140-(strlen($tweet_prefix) + strlen(' '.$author_url) + strlen($tweet_suffix) + 3)). '...';
            }

            //now concatinate the tweet
            $author_tweet = $tweet_prefix . $title .' '. $author_url . $tweet_suffix;

            $snoop = new Snoopy();
            $snoop->agent = 'Twitter Publisher';
            $snoop->user = $author->twitter_username;
            $snoop->pass = $author->twitter_password;
            $snoop->submit(
                'http://twitter.com/statuses/update.json',
                array(
                    'status' => $author_tweet,
                    'source' => 'Twitter-Publisher'
                )
            );
			$twitter_result = $snoop->response_code;
		
			if($options['debug'])
        		add_post_meta($post_id, 'twipub_debug', 'Author twitter: '.$author_tweet.' - '. $twitter_result, false);
    }

    //add a flag to this blog post, so we only Tweet once about it
    add_post_meta($post_id, 'twipub_tweeted', '1', true);
}

/**
 * Build settings page for Twitter Publisher
 */
function twitter_publisher_configpage() {
	$twitter_publisher_options = get_option('twitter_publisher_options');
    
    echo '<div class="wrap">
            '. screen_icon() .'
            <h2>'.__('Twitter Publisher Settings', 'twitter_publisher').'</h2>';

    if(!empty($_POST)) {
        echo '<div id="message" class="updated fade"><p><strong>'.__('Settings saved', 'twitter_publisher').'</strong></p></div>';
    }

    echo   '<form method="post" action="options.php">';
	
	settings_fields( 'twitter_publisher_options' );
	
	echo	'<table class="form-table">
            <tr>
                <th><label for="twipub_title_prefix">'.__('Tweet prefix:', 'twitter_publisher').'</label></th>
                <td>
                    <input type="text" name="twitter_publisher_options[title_prefix]" id="twipub_title_prefix" value="' . $twitter_publisher_options['title_prefix'] .'" />
                    <span class="description">'.__('You can prefix your automated tweets with something like <code>New blog post:</code>', 'twitter_publisher').'</span>
                </td>
            </tr>
            <tr>
                <th><label for="twipub_title_suffix">'.__('Tweet suffix:', 'twitter_publisher').'</label></th>
                <td>
                    <input type="text" name="twitter_publisher_options[title_suffix]" id="twipub_title_suffix" value="' . $twitter_publisher_options['title_suffix'] .'" />
                    <span class="description">'.__('You can suffix your automated tweets with extra hashtags, like <code>#hashtag</code>', 'twitter_publisher').'</span>
                </td>
            </tr>
            <tr>
                <th>'.__('Drop suffix:', 'twitter_publisher').'</th>
                <td>
                    <input type="checkbox" name="twitter_publisher_options[drop_suffix]" id="twipub_drop_suffix" value="1" ' . ($twitter_publisher_options['drop_suffix'] == 1 ? 'checked="checked"' : '') .'" />
                    <label for="twipub_drop_suffix">'.__('Drop the suffix if the tweet exceeds 140 characters.', 'twitter_publisher').'</label>
                </td>
            </tr>
            <tr>
                <th>'.__('Short URL service:', 'twitter_publisher').'</th>
                <td>
                    <input type="radio" name="twitter_publisher_options[api_service]" id="twipub_api_service_awesm" value="awe.sm"' . ($twitter_publisher_options['api_service'] == 'awe.sm' ? 'checked="checked"' : '') .' />
                        <label for="twipub_api_service_awesm">Awe.sm</label><br />
                    <input type="radio" name="twitter_publisher_options[api_service]" id="twipub_api_service_bitly" value="bit.ly"' . ($twitter_publisher_options['api_service'] == 'bit.ly' ? 'checked="checked"' : '') .' />
                        <label for="twipub_api_service_bitly">Bit.ly</label>
                </td>
            </tr>
            <tr>
                <th>'.__('Refer to author:', 'twitter_publisher').'</th>
                <td>
                    <input type="checkbox" name="twitter_publisher_options[twitter_incl_author]" id="twipub_twitter_incl_author" value="1" ' . ($twitter_publisher_options['twitter_incl_author'] == 1 ? 'checked="checked"' : '') .'" />
                    <label for="twipub_twitter_incl_author">'.__('Include the author\'s Twitter name (or display name when no twitter name is available) when sharing new blog posts.', 'twitter_publisher').'</label>
                </td>
            </tr>
            <tr>
                <th>'.__('Let authors tweet manual:', 'twitter_publisher').'</th>
                <td>
                    <input type="checkbox" name="twitter_publisher_options[manual_tweeting]" id="twipub_twitter_manual_tweeting" value="1" ' . ($twitter_publisher_options['manual_tweeting'] == 1 ? 'checked="checked"' : '') .'" />
                    <label for="twipub_twitter_manual_tweeting">'.__('Give authors the option to tweet a post manual to the main Twitter account.', 'twitter_publisher').'</label>
                </td>
            </tr>
            <tr>
                <th>'.__('No automatic tweeting:', 'twitter_publisher').'</th>
                <td>
                    <input type="checkbox" name="twitter_publisher_options[no_auto_tweeting]" id="twipub_twitter_no_auto_tweeting" value="1" ' . ($twitter_publisher_options['no_auto_tweeting'] == 1 ? 'checked="checked"' : '') .'" />
                    <label for="twipub_twitter_no_auto_tweeting">'.__('Do not tweet posts automatic on publishing.', 'twitter_publisher').'</label>
                </td>
            </tr>
            <tr>
                <th>'.__('Enable debugging:', 'twitter_publisher').'</th>
                <td>
                    <input type="checkbox" name="twitter_publisher_options[debug]" id="twipub_twitter_no_auto_tweeting" value="1" ' . ($twitter_publisher_options['debug'] == 1 ? 'checked="checked"' : '') .'" />
                    <label for="twipub_twitter_no_auto_tweeting">'.__('Store more data in meta data for debugging purposes.', 'twitter_publisher').'</label>
                </td>
            </tr>
            </table>

            <h3>'.__('Main Twitter account credentials', 'twitter_publisher').'</h3>
            <p>'.__('If you have a Twitter account for your blog, please fill in the username and password below. Author-specific accounts can be provided in their personal profile pages.', 'twitter_publisher').'</p>
            <table class="form-table">
            <tr>
                <th><label for="twipub_twitter_username">'.__('Twitter username:', 'twitter_publisher').'</label></th>
                <td>
                    <input type="text" name="twitter_publisher_options[twitter_username]" id="twipub_twitter_username" value="' . $twitter_publisher_options['twitter_username'] .'" />
                </td>
            </tr>
            <tr>
                <th><label for="twipub_twitter_password">'.__('Twitter password:', 'twitter_publisher').'</label></th>
                <td>
                    <input type="password" name="twitter_publisher_options[twitter_password]" id="twipub_twitter_password" value="' . $twitter_publisher_options['twitter_password'] .'" />
                </td>
            </tr>
            </table>

            <h3>'.__('Awe.sm credentials', 'twitter_publisher').'</h3>
            <table class="form-table">
            <tr>
                <th><label for="twipub_awesm_apikey">'.__('Awe.sm API key:', 'twitter_publisher').'</label></th>
                <td><input type="text" name="twitter_publisher_options[awesm_apikey]" id="twipub_awesm_apikey" value="' . $twitter_publisher_options['awesm_apikey'] .'"  class="regular-text" /></td>
            </tr>
            </table>

            <h3>'.__('Bit.ly credentials', 'twitter_publisher').'</h3>
            <table class="form-table">
            <tr>
                <th><label for="twipub_bitly_apilogin">'.__('Bit.ly Login name:', 'twitter_publisher').'</label></th>
                <td><input type="text" name="twitter_publisher_options[bitly_apilogin]" id="twipub_bitly_apilogin" value="' . $twitter_publisher_options['bitly_apilogin'] .'"  class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="twipub_bitly_apikey">'.__('Bit.ly API key:', 'twitter_publisher').'</label></th>
                <td><input type="text" name="twitter_publisher_options[bitly_apikey]" id="twipub_bitly_apikey" value="' . $twitter_publisher_options['bitly_apikey'] .'"  class="regular-text" /></td>
            </tr>
            <tr>
                <th>'.__('Campaign variables:', 'twitter_publisher').'</th>
                <td>
                    <input type="checkbox" name="twitter_publisher_options[bitly_use_campaginvars]" id="twipub_bitly_use_campaginvars" value="1" ' . ($twitter_publisher_options['bitly_use_campaginvars'] == 1 ? 'checked="checked"' : '') .'" />
                    <label for="twipub_bitly_use_campaginvars">'.__('Add Google Analytics campaign variables to the permalink for tracking.', 'twitter_publisher').'</label>
                </td>
            </tr>
            </table>
            <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="'.__('Save Changes', 'twitter_publisher').'" />
            </p>
            </form>
            <p>'.__('Do not forget to have your authors enter their Twitter name in their profiles. Otherwise their Wordpress display name will be mentioned in the tweets.', 'twitter_publisher').'</p>
            ';
}

function twitter_publisher_custom_box() {
	global $post;
	
	$options = get_option('twitter_publisher_options');
	
	//get blog post title
    $title = $post->post_title;

    //get author
    $author = get_userdata($post->post_author);

    //get permalink
    $permalink = get_permalink($post->ID);
    
    //generate short url
    $post_url = twitter_publisher_create_short_url($permalink, 'twitter', 'twitter-publisher-main');
	
	//check if twitter name has been filled in
    if(!empty($author->twitter_username)) {
    	$author_name = '@'.$author->twitter_username;
    } else {
    	//use display name instead
    	$author_name = $author->display_name;
    }
        
	//concat the meta data of the tweet (= tweet without the title) when option is checked to add author's name
        if($options['twitter_incl_author'] == 1) {
            $tweet_meta = ' '. $post_url .' by '. $author_name;
        } else {
            //just concat the URL instead
            $tweet_meta = ' '. $post_url;
        }

        //get the Tweet prefix from the settings (if there is one)
        $tweet_prefix = $options['title_prefix'];
        if(!empty($tweet_prefix)) {
            $tweet_prefix .= ' ';
        }

        //get the Tweet suffix from the settings (if there is one)
        $tweet_suffix = $options['title_suffix'];
        if(!empty($tweet_suffix)) {
            $tweet_suffix = ' '. $tweet_suffix;
        }

        //if title + meta > 140 chars, shorten the title
        if(strlen($title) + strlen($tweet_meta) + strlen($tweet_prefix) + strlen($tweet_suffix) > 140) {
            if($options['drop_suffix'] == 1) {
                $tweet_suffix = '';
            }

            $title = substr($title, 0, 140-(strlen($tweet_prefix) + strlen($tweet_meta) + strlen($tweet_suffix) + 3)). '...';
        }

        //now concatinate the tweet
        $tweet = $tweet_prefix . $title . $tweet_meta . $tweet_suffix;
	
	if( $post->post_status == 'publish') {
		echo '<style> 
					.inside { margin: 0px !important; } 
					#twitter_publisher_tweet { margin: 6px; }
			  </style>
				<div id="misc-publishing-actions">
					<div id="twitter_publisher_tweet">
						Tweet will be send through <a href="http://twitter.com/'.$options['twitter_username'].'" target="_blank">@'.$options['twitter_username'].'</a>:<br />
						<br />
						'.$tweet.'
					</div>
				</div>
				<div id="major-publishing-actions">
					<div id="publishing-action">
						<input type="button" name="button" onClick="twitter_publisher_post_tweet('. $post->ID .');" class="button-primary" value="'.__('Tweet this Post', 'twitter_publisher').'" />
					</div>
					<div class="clear"></div>
			  	</div>';
	
		//now call do_action for plugins which are using Post Play
		do_action('postplay_add_content');
	} else {
		echo '<style> 
					.inside { margin: 0px !important; } 
					#twitter_publisher_tweet { margin: 6px; }
			  </style>
				<div id="misc-publishing-actions">
					<div id="twitter_publisher_tweet">
						Post has not yet been published, so no Tweeting yet.
					</div>
					<div class="clear"></div>
			  	</div>';
	}
}

function twitter_publisher_add_meta_box_wrapper() {
	$options = get_option('twitter_publisher_options');
	
	if($options['manual_tweeting'] == 1) {
		add_meta_box('twitter_publisher_box_id', 'Twitter Publisher', 'twitter_publisher_custom_box', 'post', 'side', 'high');
	}
}
add_action('admin_menu', 'twitter_publisher_add_meta_box_wrapper');

function twitter_publisher_js_admin_header() {
	// use JavaScript SACK library for Ajax
	//wp_print_scripts( array( 'sack' ));
	
	// Define custom JavaScript function
?>
	<script type="text/javascript">
    //<![CDATA[
    function twitter_publisher_post_tweet(postID)
	{
    	var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';

    	var data = {
    		action: 'twitter_publisher_post_tweet',
    		post_id: postID
    	};

    	jQuery.post(ajax_url, data, function(response) {
    		alert('Got this from the server: ' + response);
    	});
	}
    //]]>
    </script>
<?php
} 
add_action('admin_print_scripts', 'twitter_publisher_js_admin_header' );

function twitter_publisher_ajax_post_tweet()
{
	$post_id = intval($_POST['post_id']);
  	twitter_publisher_post_tweet($post_id, true);
  	
  	// Compose JavaScript for return
  	die( "Tweet has been sent!" );
} 
add_action('wp_ajax_twitter_publisher_post_tweet', 'twitter_publisher_ajax_post_tweet' );

/**
 * Create a short url with the specified parameters and the service specified in the config
 *
 * @param string $permalink
 * @param string $sharetype
 * @param string $createtype
 * @return string
 */
function twitter_publisher_create_short_url($permalink, $sharetype, $createtype) {
	$options = get_option('twitter_publisher_options');
	
    //include Snoopy class
    require_once(ABSPATH.WPINC.'/class-snoopy.php');

    //which API are we going to use?
    if($options['api_service'] == 'bit.ly') {
        //use bit.ly
        $permalink = urlencode($permalink);

        //do we need to add Campaign tags to track with Google Analytics?
        if($options['bitly_use_campaginvars'] == 1) {

            //do we need to use a ? or a &?
            $delimiter = '?';
            if (strpos ( $permalink, $delimiter ) > 0)
                $delimiter = '&';

            $permalink .= urlencode( $delimiter . 'utm_source='.$sharetype.'&utm_medium='.$createtype.'&utm_campaign='.$sharetype);
        }

        //generate bit.ly url
        $snoop = new Snoopy();
        $snoop->agent = 'Twitter Publisher';
        $snoop->fetch('http://api.bit.ly/shorten?'.
                        'version=2.0.1&'.
                        'longUrl='.$permalink.'&'.
                        'login='.$options['bitly_apilogin'].'&'.
                        'apiKey='.$options['bitly_apikey'].'&'.
                        'format=xml&'.
                        'history=1'
        );
        if (strpos($snoop->response_code, '200')) {
            //get shortUrl from XML, without the use of a XML parser
            $post_url_match = null;
            preg_match('|<shortUrl>(.*?)</shortUrl>|is', $snoop->results, $post_url_match);
            $post_url = trim($post_url_match[1]);

            return $post_url;
        } else {
            return $permalink;
        }
    } else {
        //use awe.sm

        //get awe.sm API key
        $awesm_api_key = $options['awesm_apikey'];

        //only continue when API key is set
        if(empty($awesm_api_key)) {
            return $permalink;
        }

        // generate main awe.sm url
        $snoop = new Snoopy();
        $snoop->agent = 'Twitter Publisher';
        $snoop->submit(
           'http://create.awe.sm/url.txt',
            array(
                'target'        => $permalink,
                'version'       => 1,
                'share_type'    => $sharetype,
                'create_type'   => $createtype,
                'api_key'       => $awesm_api_key
            )
        );

        if (strpos($snoop->response_code, '200')) {
            $post_url = trim($snoop->results);

            return $post_url;
        } else {
            return $permalink;
        }
    }
}

/**
 * returns the short url for this post
 *
 * @param int $post_id
 * @return string
 */
function twitter_publisher_short_url($post_id) {
    //get post_url
    $short_url = get_post_meta($post_id, 'twipub_short_url', true);

    //is there already a short url?
    if(empty($short_url)) {
		//get permalink
    	$permalink = get_permalink($post_id);
	
        //generate short url
        $short_url = twitter_publisher_create_short_url($permalink, 'other', 'twitter-publisher-other');

        //save short url
        add_post_meta($post_id, 'twipub_short_url', $short_url, true);
    }

    return $short_url;
}

/**
 * Adds a link to the menu in Wordpress' admin
 */
function twitter_publisher_configpagelink() {
  add_options_page('Twitter Publisher', 'Twitter Publisher', 8, basename(__FILE__), 'twitter_publisher_configpage');
}
add_action('admin_menu', 'twitter_publisher_configpagelink');

/**
 * Adds a settings link to the plugin description row
 */
function twitter_publisher_filter_plugin_actions($links, $file) {
        //Static so we don't call plugin_basename on every plugin row.
        static $this_plugin;
    if ( ! $this_plugin ) $this_plugin = plugin_basename(__FILE__);

        if ( $file == $this_plugin ){
                $settings_link = '<a href="options-general.php?page=twitter-publisher.php">' . __('Settings', 'twitter_publisher') . '</a>';
                array_unshift( $links, $settings_link ); // before other links
        }
        return $links;
}
add_filter( 'plugin_action_links', 'twitter_publisher_filter_plugin_actions', 10, 2 );