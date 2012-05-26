<?php
if (array_key_exists('updated', $_GET)) :
?>
<div id="message" class="updated fade">
	<p><?php _e('settings saved'); ?>.</p>
</div>
<?php endif; ?>
<div class="wrap">
	<div id="icon-plugins" class="icon32"><br /></div>
	<h2><?=$this->name?> <?php _e('settings'); ?></h2>
	<form method="post" action="options.php">
		<?php settings_fields($this->tag.'_options'); ?>
		<table class="form-table">
			<tr valign="top">
				<td>
					<label for="<?php echo $this->tag; ?>[posts]">
						<input name="<?php echo $this->tag; ?>[posts]" type="checkbox" id="<?php echo $this->tag; ?>[posts]" value="1" <?php if (array_key_exists('posts', $this->options)) { checked('1', $this->options['posts']); } ?> />
						Enable for posts as well as pages.
					</label>
				</td>
			</tr>
			<tr valign="top">
				<td>
					<label for="<?php echo $this->tag; ?>[tidy]">
						<input name="<?php echo $this->tag; ?>[tidy]" type="checkbox" id="<?php echo $this->tag; ?>[tidy]" value="1" <?php if (array_key_exists('tidy', $this->options)) { checked('1', $this->options['tidy']); } ?> />
						Remove all traces of plugin on deactivation.
					</label>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="<?php _e('save changes'); ?>" />
		</p>
	</form>
</div>