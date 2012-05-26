/*
Plugin Name: Meta Tag Manager
Plugin URI: http://netweblogic.com/wordpress/plugins/meta-tag-manager/
Description: A simple plugin to manage meta tags that appear on all your pages. This can be used for verifiying google, yahoo, and more.
Author: Marcus Sykes
Version: 0.5.2
Author URI: http://netweblogic.com/
License : GNU General Public License
Copyright (C) 2008 NetWebLogic LLC
Copyright (C) 2009 Martin Lormes
*/
jQuery(document).ready( function($) {
	jQuery('#mtm_add_tag').click( function() {
		// Get All meta rows
			var metas = jQuery('#mtm_body').children();
		// Copy first row and change values
			var metaCopy = jQuery(metas[0]).clone(true);
			newId = metas.length + 1;
			metaCopy.attr('id', 'mtm_'+newId);
			metaCopy.find('a').attr('rel', newId);
			metaCopy.find('[name=mtm_1_ref]').attr({
				name:'mtm_'+newId+'_ref' ,
				value:''
			});
			metaCopy.find('[name=mtm_1_content]').attr( {
				name:'mtm_'+newId+'_content' ,
				value:''
			});
			metaCopy.find('[name=mtm_1_name]').attr( {
				name:'mtm_'+newId+'_name' ,
				value:''
			});
			metaCopy.find('[name=mtm_1_homepageonly]').attr( {
				name:'mtm_'+newId+'_homepageonly' ,
				checked:false
			});
		// Insert into end of file
			jQuery('#mtm_body').append(metaCopy);
		// Duplicate the last entry, remove values and rename id
	});
	
	jQuery('#mtm_body a').click( function() {
		// Only remove if there's more than 1 meta tag
		if(jQuery('#mtm_body').children().length > 1) {
			// Remove the item
			jQuery(jQuery(this).parent().parent().get(0)).remove();
			//Renumber all the items
			jQuery('#mtm_body').children().each( function(i) {
				metaCopy = jQuery(this);
				oldId = metaCopy.attr('id').replace('mtm_','');
				newId = i+1;
				metaCopy.attr('id', 'mtm_'+newId);
				metaCopy.find('a').attr('rel', newId);
				metaCopy.find('[name=mtm_'+ oldId +'_ref]').attr('name', 'mtm_'+newId+'_ref');
				metaCopy.find('[name=mtm_'+ oldId +'_content]').attr('name', 'mtm_'+newId+'_content');
				metaCopy.find('[name=mtm_'+ oldId +'_name]').attr( 'name', 'mtm_'+newId+'_name');
				metaCopy.find('[name=mtm_'+ oldId +'_homepageonly]').attr( 'name', 'mtm_'+newId+'_homepageonly');
			});
		} else {
			metaCopy = jQuery(jQuery(this).parent().parent().get(0));
			metaCopy.find('[name=mtm_1_ref]').attr( 'value', '' );
			metaCopy.find('[name=mtm_1_content]').attr( 'value', '' );
			metaCopy.find('[name=mtm_1_name]').attr( 'value', '' );
			metaCopy.find('[name=mtm_1_homepageonly]').attr( 'checked', false );
			alert("If you don't want any meta tags, just leave the text boxes blank and submit");
		}
	});
});
