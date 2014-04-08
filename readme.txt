=== Plugin Name ===
Contributors:  DR_BVT123
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6GLU2ZTKHSF2W
Tags: auto blog, auto post, auto content poster, autoposter,auto poster,commission junction
Requires at least: 3.0
Tested up to: 3.8.1
Stable tag: 1.0
License: GPLv2, Please see attached license.txt
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically post products from commission junction api

== Description ==

This plugin allow you to get product/link from your commission junction account and post it into your blog automatically.

* plugin first tries to get product, if its not found for any advertiser then it will get a text link for that advertiser and post it
* Uses your api key and website id to get only joined and approved advertisers. So you have to provide your API KEY and Website ID (PID), You can get them from <a href="https://api.cj.com/sign_up.cj">Here</a>


**Informations about auto poster**

Please note that this plugin will enables link manager function in wordpress also.

**Additional informations**

Plugin supports i18n. If you would like to translate it grab a .po file, translate it and send it to me for plugin update. I'll be thankful :)

== Installation ==
1. Download autoposter.zip and extract it to autoposter folder
2. Upload autoposter folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Enter your api key and site id in autoposter setting page
5. That's all.

OR

You can directly install it from add new plugin page in admin dashboard.

Plugin's page sits under settings menu item.

== Frequently Asked Questions ==

= In which category post will be assigned ? =

Category will be created based on advertiser's category in commission junction, if it is not exits.

= how frequently products will be posted ? =

Default time is 24 hour, Plugin uses wordpress's cron function to archive that so your blog needs to have enough traffic for automatic posting.

== Screenshots ==

1. Plugin control panel

== Changelog ==

= 1.0 =
* Plugin relase

== Upgrade Notice ==

= 1.0 =
Plugin relase