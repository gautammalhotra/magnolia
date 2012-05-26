<style type="text/css">
#seo_nuinu { font-size: 12px; }
#seo_nuinu th { width: 100px; }
#seo_nuinu input { width: 100%; }
</style>
<?=wp_nonce_field('wp_'.$this->tag, $this->tag.'nonce')?>
<table id="seo_nuinu" class="form-table">
	<tr>
		<th><label><?php _e('title'); ?></label></th>
		<td><input type="text" name="<?php echo $this->tag; ?>[title]" value="<?=$this->field('title')?>" /></td>
	</tr>
	<tr>
		<th><label><?php _e('description'); ?></label></th>
		<td><input type="text" name="<?php echo $this->tag; ?>[description]" value="<?=$this->field('description')?>" /></td>
	</tr>
	<tr>
		<th><label><?php _e('keywords'); ?></label></th>
		<td><input type="text" name="<?php echo $this->tag; ?>[keywords]" value="<?=$this->field('keywords')?>" /></td>
	</tr>
</table>