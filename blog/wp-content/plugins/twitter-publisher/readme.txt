=== Twitter Publisher ===
Contributors: timanrebel
Tags: twitter, tweet, share, awe.sm, bit.ly
Requires at least: 2.7.1
Tested up to: 2.9.1
Stable tag: 2.5

Share a new blog post on Twitter using awe.sm or bit.ly url shorteners. 

== Description ==

Share a new blog post on Twitter using awe.sm or bit.ly url shorteners. awe.sm gives you the option to use your own domain for shortening, like tnw.to (TheNextWeb.com) or tcrn.ch (Techcrunch), who are also using this plugin.

Supports both a main blog Twitter account as well as per author Twitter accounts. So, both the blog owner and the author can automatically share a new blog post at the same time.

Support for Google Analytics campaign variables to track clicks coming from your tweet using bit.ly. Tweets from both the main and author accounts can be tracked independently in Google Analytics and awe.sm.

The main Twitter account can reference the author's twitter/display name in the tweet.

== Installation ==

1. Upload the `twitter-publisher` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the Twitter Publisher tab in the Settings menu to fill in your Twitter credentials. Authors can enter their credentials in their user profile

== Changelog ==

= 2.5 =
* Debug options
* Manual tweeting
* Better and more secure options handling

= 2.0.1 =
* Added some missing translation strings
* The credits for the development of the #hashtag option in version 2.0 are for Jean-Paul of iPhoneclub.nl. I forgot to add them in the previous version, my apologies!

= 2.0 =
* Made Twitter Publisher translatable and included a Dutch translation
* Added the option to delay a tweet, so you have can add some modifications to the post/title before the post is tweeted.
* Added the option to suffix tweets, for example with a #hashtag
* Added a function called `twitter_publisher_short_url` to return the short URL of a post, for use in your theme
* Removed some typo's

= 1.3.1 =
* Bugfix: Only new posts will be Tweeted. Editing a post will not result in a new Tweet, even when there hasn't been sent a Tweet about it before

= 1.3 =
* Using a different awe.sm URL for the tweet coming from the author's account, so both the main and author's account can be tracked in Google Analytics
* Removed some references to TheNextWeb.com blog for whom this plugin was originally written.

== Frequently Asked Questions ==

= Why aren't you using OAuth for Twitter authentication and do I have to provide my password? =

The problem with using OAuth is that you would have to register your blog as a new application with Twitter. As would every other blog using this plugin. At this time, we don't believe the advantages of Twitter OAuth outweigh this major cost. The plugin only requires you to enter your Twitter password into your own WordPress database and never sends it to any service other than Twitter.