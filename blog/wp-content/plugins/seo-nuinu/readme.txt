=== SEO nuinu ===
Contributors: Studio nuinu
Tags: seo, meta, post, page, edit, description, keywords, title, nuninu
Requires at least: 2.8.2
Tested up to: 2.9.1
Stable tag: 1.4.2

Customize pages and posts meta title, descriptions and keywords directly in post or page edit window in wordpress. 

== Description ==

This plugin uses custom fields to allow the page title tag to be different from the actual page title.

Both meta descriptions and keywords can also be added to pages.

== Screenshots ==
1. Screenshot of SEO nuinu panel displayed below the post and page content editor.
2. Screenshot of SEO nuinu settings.

== Installation ==

1. Upload the `seonuinu` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place `<?php meta_title(); ?>` with `<?php if (function_exists('meta_title')) { meta_title(); } else { wp_title(); } ?>` in your header template.

SEO nuinu can be disabled for posts by unchecking the `Enable for posts as well as pages.` option on the settings page.

You can override the page title within your templates by setting `$wppm_title = 'Newly defined title';` before the call to `get_header();`.

== Frequently Asked Questions ==

= What custom field names does it use? =

The field names used are `_seonuinu_title`, `_seonuinu_description` and `_pagemeta_keywords`.

The underscore prefix prevents it from being displayed in the list of custom fields.

== Changelog ==

= 1.4 =
* Tested for wordpress 2.9.1
