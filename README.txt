=== TukuToi Maintenance ===
Contributors: bedas
Donate link: https://www.tukutoi.com/
Tags: maintenance, under development, coming soon
Requires at least: 4.9
Tested up to: 5.8.1
Stable tag: 2.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Enable and Control a Custom Maintenance Mode for your WordPress Website.

== Description ==

TukuToi Maintenance allows you to setup and control a Custom "Under Maintenance" or "Coming Soon" Screen for your WordPress Website.

The Plugin is lightweight and has a Settings Screen allowing you to control all aspects of the Maintenance Screen from the WordPress backend.

You will be able to control the image (or color) of the Maintenance Screen, add a CountDown and a Custom Heading, as well as a Custom message to the screen.
You can control the request status (defaults to 401 temporarily unavailable) and the time for when the site will be back.
This is useful to tell Crawling bots when to start re-crawling your website.

== Installation ==

1. Upload the Plugin files to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Setup and control the Settings in the native WordPress Settings > Reading screen, under the newly added TukuToi Maintenance Section

== Frequently Asked Questions ==

= How big should the Image used for the Maintenance Screen be? =

The optimal (website) background image size is 1920 x 1080 pixels with a 16:9 ratio, the dpi (dots per inch) should be at least 72.
However you are free to upload bigger or smaller sizes, as you wish.

= How big should the Logo Image used for the Maintenance Screen be? =

It should ideally be at least 300px square.

= Can I still access the WP Admin when activating the Maintenance Mode? =

Of course! You will have to navigate to the native `/wp-login.php` URL of your website and will be able to login.
For Administrators, the Front End will not show the Maintenance Mode. It will continue to show your website, in order to allow you to control your development.

= Can I Fully Customize the Maintenance Mode Template? =

Of course! You can either use the Plugin settings to customize the template, or, you can also load your 100% custom PHP template, if you wish. To do so, just pass your Custom PHP template to the `tkt_mtn_template_path` filter which the plugin provides.

Example (assuming you store the template in your Theme's `template-parts/post/` folder):
<pre><code>
add_filter( 'tkt_mtn_template_path', 'load_my_own_template', 10, 1 );
function load_my_own_template( $template_path ){

	$template_path = get_template_directory() .'/template-parts/post/custm_template.php';//Load your own template.

	return $template_path;

}
</code></pre>

You can take a look at the Plugin's Template in `tkt-maintenance/public/partials/tkt-maintenance-public-display.php` file to get a kickstart for your own Template.

== Screenshots ==

1. Custom Error Code and Message Settings
2. Custom Error Code and Message
3. Customized Maintenance Mode Template
4. Plugin Settings filled in
5. Plugin Settings on Install

== Changelog ==

= 2.0.4 =

* [Fixed] Added Image Alt attribute
* [Fixed] Added fallback Font


= 2.0.3 =

* [Changed] Removed options class completly as obsolete.
* [Changed] Refactored code to be WPCS compliant.

= 2.0.2 =

* [Security] Updated Sanitize callbacks for register settings
* [Changed]  Refactored get_options method of plugin
* [Removed]  Removed set_options method as not used (non-breaking change even if removed, since access was private).


= 2.0.0 =

* Breaking change: Removed JS and CSS options. Previously saved CSS and JS won't work anymore.
* BReaking change: Changed Classnames of HTML in plugin.
* Using WP Enqueue functions instead of inline script.
* Security: Escape all $variables that are echo'd.
* Removed HTML Title tag as provided by WP already.
* Removed inline style and added to CSS File instead.
* Added viewport and charset langauge metatags, added language attributes to HTML tag

= 1.0.10 =
* Adjusted Readme Typos and Wordings
* Remove empty, unused, or non-enqueued code and files + references
* Best practice checking of user capability instead of user roles
* Some CSS improvements
* Remove instances of word "core" and replace with "main"

= 1.0.0 =
* Initial release.
