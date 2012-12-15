=== EasyWeather widget ===
Contributors: myselfko
Donate link: 
Tags: weather, underground, simple, lightweight, vreme, easy, simple, lightweight, forecast
Requires at least: 3.0.1
Tested up to: 3.5
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple and lightweight widget for displaying weather data and forecast from Weather Underground (www.wunderground.com).

== Description ==

Simple and lightweight widget for displaying weather data and forecast from Weather Underground (www.wunderground.com).

Plugin saves a local copy of data for faster and more optimal running.
You need a Wunderground API key, which you can get here http://www.wunderground.com/weather/api/.

Features:
<li>simple and lightweight</li>
<li>multilanguage (currently supported: english, german, italian, slovene)</li>
<li>easy for translating</li>
<li>metric and imperial units</li>
<li>user can define own refreshing interval in minutes</li>
<li>no need for own weather icons, plugin automatically download them from Wunderground</li>

== Installation ==

1. Upload folder `easyweather-widget` to the `/wp-content/plugins/` directory or install using WordPress' built-in 'Add New Plugin installer'
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place widget anywhere at sidebar in your templates
4. Edit settings
5. Save changes

== Frequently asked questions ==

= How can I translate EasyWeather widget? =
Just edit `weather-language.php` in `easyweather-widget` folder. You must add new array, edit languange settings and translate their values:<br>
$weather_language['en'] = array(<br>
	"description" => "English",<br>
	"refreshed" => "Refreshed at",<br>
	"error" => "No cities match your search query.",<br>
	"Monday" => "Mon",<br>
	"Tuesday" => "Tue",<br>
	"Wednesday" => "Wed",<br>
	"Thursday" => "Thu",<br>
	"Friday" => "Fri",<br>
	"Saturday" => "Sat",<br>
	"Sunday" => "Sun"<br>
);

You can send me translation in your language to myselfko@gmail.com.

= Can I use my own weather icons? =
Yes, you can upload your icons in .gif format to the folder `easyweather-widget/icons`, but their names must be:

DAYTIME<br>
chanceflurries.gif<br>
chancerain.gif<br>
chancesleet.gif<br>
chancesnow.gif<br>
chancetstorms.gif<br>
clear.gif<br>
cloudy.gif<br>
flurries.gif<br>
fog.gif<br>
hazy.gif<br>
mostlycloudy.gif<br>
mostlysunny.gif<br>
partlycloudy.gif<br>
partlysunny.gif<br>
rain.gif<br>
sleet.gif<br>
snow.gif<br>
sunny.gif<br>
tstorms.gif<br>
unknown.gif<br>
<br>
NIGHTIME<br>
nt_chanceflurries.gif<br>
nt_chancerain.gif<br>
nt_chancesleet.gif<br>
nt_chancesnow.gif<br>
nt_chancetstorms.gif<br>
nt_clear.gif<br>
nt_cloudy.gif<br>
nt_flurries.gif<br>
nt_fog.gif<br>
nt_hazy.gif<br>
nt_mostlycloudy.gif<br>
nt_mostlysunny.gif<br>
nt_partlycloudy.gif<br>
nt_partlysunny.gif<br>
nt_rain.gif<br>
nt_sleet.gif<br>
nt_snow.gif<br>
nt_sunny.gif<br>
nt_tstorms.gif<br>
nt_unknown.gif<br>

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