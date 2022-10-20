=== Easy Auto Reload - Auto Refresh ===
Contributors: creativform, ivijanstefan
Donate link: 
Tags: refresh, reload, nonce, refresh nonce, clear cache, page control, custom post, update refresh
Requires at least: 5.4
Tested up to: 6.0
Requires PHP: 7.0
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Auto refresh WordPress pages if there is no site activity after any number of minutes.

== Description ==

Auto refresh and auto reload WordPress pages after any number of minutes.

This is a very simple and easy plugin that has no effect on any WordPress functionality except to refresh the page after a given interval if the user or visitor is not active on the website.

This is a particularly useful plugin if you have a problem with nonces and need to refresh them.

Simply enter the number of minutes between reloads and magic starts.

= You must know = 

As long as users/visitors move on the site, take any action, write, read, scroll, the page will not refresh. The only refresh that happens is if the site is completely abandoned or opened in a new tab.

== Installation ==

1. Go to `WP-Admin->Plugins->Add new`, search term "Auto Refresh" and click on the "install" button
2. OR, upload **autorefresh.zip** to `/wp-content/plugins` directory via WordPress admin panel or upload unzipped folder to your plugins folder via FTP
3. Activate the plugin through the "Plugins" menu in WordPress
4. Go to `Settings->Auto Refresh` to update options

== Changelog ==

=1.0.5=
* Added support for the browsers with no JavaScript
* Improved 

=1.0.4=
* Added support for the WordPress version 6.0

=1.0.3=
* Adding WP admin cache

=1.0.2=
* Fixed plugin initialization
* Added translations
* Fixed PHP bugs

=1.0.1=
* Added browser cache cleaning
* Fixed seconds instead of minutes

=1.0.0=
* First stable version
