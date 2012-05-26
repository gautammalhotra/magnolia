=== Meta Tag Manager ===
Contributors: netweblogic
Tags: Google, SEO, Yahoo, Webmaster Tools, Meta, Meta Tags
Requires at least: 2.5
Tested up to: 3.0
Stable tag: 1.1

This plugin will allow you to easily add and manage special meta tags to your whole site, such as Yahoo and Google verification tags.

== Description ==

Simple plugin which allows you to add custom meta tags that will show across all pages on your blog or on the homepage only.

Just upload, activate, and immediately start adding meta tags.

This can be used for adding Google and Yahoo site verification tags along with any other meta tags you may want to add.

If you have any problems with the plugins, please visit our [http://netweblogic.com/forums/](support forums) for further information and provide some feedback first, we may be able to help. It's considered rude to just give low ratings and nothing reason for doing so.

If you find this plugin useful and would like to say thanks, a link, digg, or some other form of recognition to the plugin page on our blog would be appreciated.

Special thanks to Martin Lormes for help with some crucial updates.

= Translated Languages Available =

Here's a list of currently translated languages. Translations that have been submitted are greatly appreciated and hopefully make this plugin a better one. If you'd like to contribute, please have a look at the POT file in the langs folder and send us your translations.

* Danish - Christian B.
* German - Martin Lormes

== Installation ==

1. Download and unzip the plugin, then upload the entire `meta-tag-manager` directory to the `/wp-content/plugins` directory; or simply upload the zip file if you use WordPress 2.7 or newer
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to *Settings > Meta Tag Manager*
1. Enter the values in the text boxes. The first text box is so you can give your meta tag a memorable name and is not displayed on the website
1. Add tags by clicking on the add tag link under the meta rows, and remove tags by clicking on the links next to the meta in question
1. Save your changes

== Frequently Asked Questions ==

Please see our [http://netweblogic.com/forums/](support forums).

== Screenshots ==

1. Once the plugin is activated you can add/edit/delete tags from the menu in *Settings > Meta Tag Manager*

== Changelog ==

= 1.0 =
* code styling: code now wrapped in classes
* bug fixed: magic quotes
* bug fixed: character escaping using wp_specialchars on the site and htmlspecialchars on the admin page
* separated the code into two .php files
  * meta-tag-manager.php the main plugin file, always loaded, contains minimal code to reduce loading time
  * meta-tag-manager-admin.php contains the admin backend parts of the plugin and is only loaded in the backend
* i18n
* l10n for: de_DE (language file by [Martin Lormes](http://ten-fingers-and-a-brain.com))
* meta tags can be flagged to appear on the homepage only
* fixed bug which threw a Notice error when no meta tags were defined
* fixed the bug where the rss feeds kept breaking

= 1.1 =
* Added danish translation
* Fixed added slashes for apostrophe values
