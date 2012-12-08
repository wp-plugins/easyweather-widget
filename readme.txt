=== EasyWeather widget ===
Contributors: myselfko
Donate link: 
Tags: weather, underground, simple, lightweight, vreme, easy, simple, lightweight, forecast
Requires at least: 3.0.1
Tested up to: 3.4.2
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple and lightweight widget for displaying weather data and forecast from Weather Underground (www.wunderground.com).

== Description ==

Simple and lightweight widget for displaying weather data and forecast from Weather Underground (www.wunderground.com).

Plugin saves a local copy of data for faster and more optimal running.
You need a Wunderground API key, which you can get here http://www.wunderground.com/weather/api/.

Features:
 - simple and lightweight
 - multilanguage (currently supported: english, german, italian, slovene)
 - easy for translating
 - metric and imperial units
 - user can define own refreshing interval in minutes
 - no need for own weather icons, plugin automatically download them from Wunderground

== Installation ==

1. Upload folder `easyweather-widget` to the `/wp-content/plugins/` directory or install using WordPress' built-in 'Add New Plugin installer'
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place widget anywhere at sidebar in your templates
4. Edit settings
5. Save changes

== Frequently asked questions ==

= How can I translate EasyWeather widget? =
Just edit `weather-language.php` in `easyweather-widget` folder. You must add new array, edit languange settings and translate their values: 
$weather_language['en'] = array(
	"description" => "English",
	"refreshed" => "Refreshed at",
	"error" => "No cities match your search query.",
	"Monday" => "Mon",
	"Tuesday" => "Tue",
	"Wednesday" => "Wed",
	"Thursday" => "Thu",
	"Friday" => "Fri",
	"Saturday" => "Sat",
	"Sunday" => "Sun"
);

You can send me translation in your language to myselfko@gmail.com.

= Can I use my own weather icons? =
Yes, you can upload your icons in .gif format to the folder `easyweather-widget/icons`, but their names must be:

DAYTIME
 - chanceflurries.gif
 - chancerain.gif
 - chancesleet.gif
 - chancesnow.gif
 - chancetstorms.gif
 - clear.gif
 - cloudy.gif
 - flurries.gif
 - fog.gif
 - hazy.gif
 - mostlycloudy.gif
 - mostlysunny.gif
 - partlycloudy.gif
 - partlysunny.gif
 - rain.gif
 - sleet.gif
 - snow.gif
 - sunny.gif
 - tstorms.gif
 - unknown.gif

NIGHTIME
 - nt_chanceflurries.gif
 - nt_chancerain.gif
 - nt_chancesleet.gif
 - nt_chancesnow.gif
 - nt_chancetstorms.gif
 - nt_clear.gif
 - nt_cloudy.gif
 - nt_flurries.gif
 - nt_fog.gif
 - nt_hazy.gif
 - nt_mostlycloudy.gif
 - nt_mostlysunny.gif
 - nt_partlycloudy.gif
 - nt_partlysunny.gif
 - nt_rain.gif
 - nt_sleet.gif
 - nt_snow.gif
 - nt_sunny.gif
 - nt_tstorms.gif
 - nt_unknown.gif

You can find some of my iconsets at https://dl.dropbox.com/u/1351805/EasyWeather/index.html

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png
4. screenshot-4.png
5. screenshot-5.png

== Changelog ==

= 1.0 =
Initial stable release
 <li>add language support</li>
 <li>add setting for manually defining refresh interval</li>

== Upgrade notice ==

No need for upgrade, this is initial public release.