=== Client Testimonials ===
Contributors: sayful
Tags:  client testimonails, plugin, testimonials, Testimonials plugin, widget
Requires at least: 3.5
Tested up to: 4.2
Stable tag: 2.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Testimonials is a WordPress plugin that allows you to manage and display testimonials for your blog, product or service.

== Description ==

[Note: Version 2.0.0 is a major update from version 1.0. It has been changed in style on slider and widget]

Testimonials is a WordPress plugin that allows you to manage and display testimonials for your blog, product or service.


= Usage =

After installing and activating "Client Testimonials", go to `Admin Dashboard -> Testimonials` and create testimonials like creating a post. You can add "Client's Name", "Business/Site Name", "Business/Site Link" and "Featured Image" for client avatar
[Note: "Featured Image" has been introduced from version 2.0.0]


After creating testimonials, go to post or page where you want add testimonials.
<ul>
	<li>On Wordpress editor, you will get a TinyMce button for testimonials. Click on this button, a dropdown menu will be opened.</li>
	<li>Select "Client Testimonials Slide" if you want to add testimonials slide. or</li>
	<li>select "Client Testimonials No Slide" if you do not want to add slide. and</li>
	<li>Fill all fields as your need.</li>
</ul>

= TinyMce Buttons Usage =

Items Desktop
<ul>
	<li>Write how many item you want to show at 979px or higher browser widths for desktop. Default value is 1.</li>
	<li>Generate shortcode attribute <strong>items_desktop=""</strong></li>
</ul>

Items Tablet
<ul>
	<li>Write how many item you want to show at 768px or higher browser widths for tablet. Default value is 1.</li>
	<li>Generate shortcode attribute <strong>items_tablet=""</strong></li>
</ul>

Items Tablet Small
<ul>
	<li>Write how many item you want to show at 600px or higher browser widths for small tablet. Default value is 1.</li>
	<li>Generate shortcode attribute <strong>items_tablet_small=""</strong></li>
</ul>

Items Mobile
<ul>
	<li>Write how many item you want to show at 320px or higher browser widths for mobile. Default value is 1.</li>
	<li>Generate shortcode attribute <strong>items_mobile=""</strong></li>
</ul>

Total numbers of Testimonials to show
<ul>
	<li>Write how many testimonials you want to show. Write -1 to show all or any number that your want to show. Default value is -1.</li>
	<li>Generate shortcode attribute <strong>posts_per_page=""</strong></li>
</ul>

Order By
<ul>
	<li>Choose how you want to show testimonial order. Default value is 'none'. Others value is 'ID', 'date', 'modified' and 'rand'</li>
	<li>Generate shortcode attribute <strong>orderby=""</strong></li>
</ul>

Testimonial ID
<ul>
	<li>If you want to show a specific testimonial. you can add testimonial ID of that testimonial here.</li>
	<li>Generate shortcode attribute <strong>testimonial_id=""</strong></li>
</ul>


You can also write your code without using TinyMce button:

For Slide:
`[client-testimonials]`
`[client-testimonials items_desktop="" items_tablet="" items_tablet_small="" items_mobile="" posts_per_page="" orderby=""]`

For No Slide:
`[testimonial]`
`[testimonial testimonial_id="" posts_per_page="" orderby=""]`


= Widget Usage =

<ul>
	<li>On Admin Dashboard, go to <strong>Appearance -> Widgets</strong></li>
	<li>Find <strong>Client Testimonials</strong> and click on it.</li>
	<li>Select at which widget area yor want to show it. and click <strong>Add Widget</strong></li>
	<li>Give widget title and write number of testimonials you want to show and choose orderby and click <strong>Save</strong></li>
</ul>


== Installation ==

Installing the plugins is just like installing other WordPress plugins. If you don't know how to install plugins, please review the three options below:

Install by Search

* From your WordPress dashboard, choose 'Add New' under the 'Plugins' category.
* Search for 'Client Testimonials' a plugin will come called 'Client Testimonials by Sayful Islam' and Click 'Install Now' and confirm your installation by clicking 'ok'
* The plugin will download and install. Just click 'Activate Plugin' to activate it.

Install by ZIP File

* From your WordPress dashboard, choose 'Add New' under the 'Plugins' category.
* Select 'Upload' from the set of links at the top of the page (the second link)
* From here, browse for the zip file included in your plugin titled 'client-testimonials.zip' and click the 'Install Now' button
* Once installation is complete, activate the plugin to enable its features.

Install by FTP

* Find the directory titles 'client-testimonials' and upload it and all files within to the plugins directory of your WordPress install (WORDPRESS-DIRECTORY/wp-content/plugins/) [e.g. www.yourdomain.com/wp-content/plugins/]
* From your WordPress dashboard, choose 'Installed Plugins' option under the 'Plugins' category
* Locate the newly added plugin and click on the \'Activate\' link to enable its features.


== Frequently Asked Questions ==
Do you have questions or issues with Client Testimonials? [Ask for support here](http://wordpress.org/support/plugin/client-testimonials)

== Screenshots ==

1. Screenshot of testimonials custom post.
2. Screenshot of testimonials custom post list.
3. Screenshot of testimonials widget back-end.
4. Screenshot of testimonials widget front-end display.
5. Screenshot of testimonials front-end display.
6. Screenshot of testimonials front-end display as slider.

== Changelog ==

= version 2.0.0 =
 * Added new style in slider
 * Updated code with latest WordPress standard
 * Added TinyMce button for better user experience
 * Added Featured Image for upload client image

= version 1.0 =
 * Initial release

== Upgrade Notice ==
Version 2.0.0 is a major update from version 1.0. It has been changed in style on slider and widget