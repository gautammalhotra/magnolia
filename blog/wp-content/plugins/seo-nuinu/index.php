<?php
/*
Plugin Name: SEO nuinu
Plugin URI: http://wordpress.org/extend/plugins/seo-nuinu/
Description: Adds the ability to add a custom meta title, description, and keywords to pages. 
Version: 1.4.1
Author: Studio nuinu
Author URI: http://www.nui.nu
*/
if (!class_exists('SEOnuinu')) {
	class SEOnuinu {
		var $name = 'SEO nuinu';
		var $tag = 'seonuinu';
		var $options = array();
		function SEOnuinu()
		{
			if ($options = get_option($this->tag)) {
				$this->options = $options;
			}			
			add_action('wp_head', array(&$this, 'meta'));
			if (is_admin()) {
				add_action('admin_menu', array(&$this, 'panels'));
				add_action('save_post', array(&$this, 'save'));
				add_action('admin_init', array(&$this, 'settings_init'));
				add_filter('plugin_row_meta', array(&$this, 'settings_meta'), 10, 2);
			}
			add_filter('meta_title', array(&$this, 'title'), 1);
		}
		function activate()
		{
			if (!$this->options) {
				update_option($this->tag, array(
					'posts' => 1
				));
			}
		}
		function deactivate()
		{
			if ($this->options['tidy']) {
				$posts = get_posts('numberposts=-1&post_type=any');
				foreach ($posts as $post) {
					$values = array('title', 'description', 'keywords');
					foreach ($values AS $name) {
						delete_post_meta($post->ID, '_'.$this->tag.'_'.$name);
					}
				}
				update_option($this->tag, null);
			}
		}
		function panels()
		{
			add_submenu_page(
				'plugins.php',
				'Manage '.$this->name,
				$this->name,
				'administrator',
				$this->tag,
				array(&$this, 'settings_page')
			);
			add_meta_box($this->tag.'_postbox', $this->name, array(&$this, 'panel'), 'page', 'normal', 'high');
			if (isset($this->options['posts'])) {
				add_meta_box($this->tag.'_postbox', $this->name, array(&$this, 'panel'), 'post', 'normal', 'high');
			}
		}
		function panel()
		{
			include_once('panel.php');
		}
		function field($field)
		{
			global $post;
			return get_post_meta($post->ID, '_'.$this->tag.'_'.$field, true);
		}
		function save($post_id)
		{
			if (!isset($_POST[$this->tag.'nonce']) || !wp_verify_nonce($_POST[$this->tag.'nonce'], 'wp_'.$this->tag)) {
				return $post_id;
			}
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
			foreach ($_POST[$this->tag] AS $key => $value) {
				$field = '_'.$this->tag.'_'.$key;
				$value = wp_filter_kses($value);
				if (empty($value)) {
					delete_post_meta($post_id, $field, $value);
				} else if (!update_post_meta($post_id, $field, $value)) {
					add_post_meta($post_id, $field, $value);
				}
			}
		}
		function title($args)
		{
			extract($args);
			global $wppm_title;
			$title = isset($wppm_title) ? $wppm_title : $this->value('title');
			if ($title) {
				$title = $title.' '.$sep;
				if ($echo) { 
					echo $title;
				} else {
					return $title;
				}
			} else {
				wp_title($sep, $echo, $seplocation);
			}
		}
		function value($type)
		{
			global $wpdb;
			$p = get_query_var('p');
			$name = get_query_var('name');
			if (intval($p) || !empty($name)) {
				if (!$p) {
					$p = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s", $name));
				}
				$post = &get_post($p);
				return get_post_meta($p, '_'.$this->tag.'_'.$type, true);
			}
		}
		function meta()
		{
			$values = array('description', 'keywords');
			foreach ($values AS $name) {
				if ($content = $this->value($name)) {
					echo "<meta name='".$name."' content='".esc_attr($content)."' />\r\n";
				}
			}
		}
		function settings_init()
		{
			register_setting($this->tag.'_options', $this->tag, array(&$this, 'settings_validate'));
		}
		function settings_validate($inputs)
		{
			if (is_array($inputs)) {
				foreach ($inputs AS $key => $input) {
					$inputs[$key] = ($inputs[$key] == 1 ? 1 : 0);
				}
				return $inputs;
			}
		}
		function settings_page()
		{
			include_once('settings.php');
		}
		function settings_meta($links, $file)
		{
			$plugin = plugin_basename(__FILE__);
			if ($file == $plugin) {
				return array_merge(
					$links,
					array(sprintf(
						'<a href="plugins.php?page=%s">%s</a>',
						$this->tag, __('settings')
					))
				);
			}
			return $links;
		}
	}
	$seonuinu = new SEOnuinu();
	if (isset($seonuinu)) {
		register_activation_hook(__FILE__, array(&$seonuinu, 'activate'));
		register_deactivation_hook(__FILE__, array(&$seonuinu, 'deactivate'));
		function meta_title($s='',$e=true,$l=null){
			return apply_filters('meta_title', array('sep'=>$s,'echo'=>$e,'seplocation'=>$l));
		}
	}
}