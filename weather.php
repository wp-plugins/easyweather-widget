<?php
/*
Plugin Name: EasyWeather widget
Plugin URI: http://wordpress.org/extend/plugins/easyweather-widget
Description: Simple and lightweight widget for displaying weather data and forecast from Weather Underground (www.wunderground.com)
Author: myselfko
Version: 1.0
Author URI: mailto:myselfko@gmail.com
*/

add_action('widgets_init', create_function('', 'register_widget("EasyWeather_Widget");'));

class EasyWeather_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct('EasyWeather_Widget', 'EasyWeather Widget', array('description' => __('Simple and lightweight widget for displaying weather data from Weather Underground (www.wunderground.com)', 'text_domain')));
	}
	
	private function get_icon($url) {
		$icon_name = explode("/", $url);
		$icon_name = $icon_name[count($icon_name)-1];
		if (!file_exists(WP_PLUGIN_DIR ."/easyweather-widget/icons/". $icon_name)) {
			$icon = file_get_contents($url);
			file_put_contents(WP_PLUGIN_DIR ."/easyweather-widget/icons/". $icon_name, $icon);
		}
		
		return WP_PLUGIN_URL ."/easyweather-widget/icons/". $icon_name;
	}
	
	function EasyWeather_Parse($instance) {
		include "weather-language.php";
		$api_key = $instance["weather_api_key"];
		$weather_station = $instance["weather_station"];
		$units = $instance["weather_units"];
		$language = $instance["weather_language"];
				
		$json = file_get_contents("http://api.wunderground.com/api/". $api_key ."/conditions/q/zmw:". $weather_station .".json");
		$data = json_decode($json);
		$display = "";			
	
		if ($data->response->error->description != "") {	
			$display .= '<p><b>'. $weather_language[$language]['error'] .'</b></p>';
		} else {
			$city = $data->current_observation->display_location->city;
			$date = $weather_language[$language]['refreshed'] . date(" G:i", $data->current_observation->observation_epoch + 3600*($data->current_observation->local_tz_offset/100));
					
			if ($units == "metric") {
				$temperature = $data->current_observation->temp_c ."&#8451;";
			} else if ($units == "imperial") {
				$temperature = $data->current_observation->temp_f ."&#8457;";
			}
			$icon = $this->get_icon($data->current_observation->icon_url);
					
			$json = file_get_contents("http://api.wunderground.com/api/". $api_key ."/forecast/q/zmw:". $weather_station .".json");
			$data = json_decode($json);
					
			$day = array();
			$day[] = $weather_language[$language][$data->forecast->simpleforecast->forecastday[1]->date->weekday];
			$day[] = $weather_language[$language][$data->forecast->simpleforecast->forecastday[2]->date->weekday];
			$day[] = $weather_language[$language][$data->forecast->simpleforecast->forecastday[3]->date->weekday];
					
			$temperature_morning = array();
			$temperature_afternoon = array();
			if ($units == "metric") {
				$temperature_morning[] = $data->forecast->simpleforecast->forecastday[1]->low->celsius ." &#8451;";
				$temperature_morning[] = $data->forecast->simpleforecast->forecastday[2]->low->celsius ." &#8451;";
				$temperature_morning[] = $data->forecast->simpleforecast->forecastday[3]->low->celsius ." &#8451;";
						
				$temperature_afternoon[] = $data->forecast->simpleforecast->forecastday[1]->high->celsius ." &#8451;";
				$temperature_afternoon[] = $data->forecast->simpleforecast->forecastday[2]->high->celsius ." &#8451;";
				$temperature_afternoon[] = $data->forecast->simpleforecast->forecastday[3]->high->celsius ." &#8451;";
			} else if ($units == "imperial") {
				$temperature_morning[] = $data->forecast->simpleforecast->forecastday[1]->low->fahrenheit ." &#8457;";
				$temperature_morning[] = $data->forecast->simpleforecast->forecastday[2]->low->fahrenheit ." &#8457;";
				$temperature_morning[] = $data->forecast->simpleforecast->forecastday[3]->low->fahrenheit ." &#8457;";
				
				$temperature_afternoon[] = $data->forecast->simpleforecast->forecastday[1]->high->fahrenheit ." &#8457;";
				$temperature_afternoon[] = $data->forecast->simpleforecast->forecastday[2]->high->fahrenheit ." &#8457;";
				$temperature_afternoon[] = $data->forecast->simpleforecast->forecastday[3]->high->fahrenheit ." &#8457;";
			}
					
			$forecast_icon = array();
			$forecast_icon[] = $this->get_icon($data->forecast->simpleforecast->forecastday[1]->icon_url);
			$forecast_icon[] = $this->get_icon($data->forecast->simpleforecast->forecastday[2]->icon_url);
			$forecast_icon[] = $this->get_icon($data->forecast->simpleforecast->forecastday[3]->icon_url);
					
			$display .= '
				<table style="border-width: 0px" width="100%">
				<tr>
					<td colspan="3" style="text-align: center; font-size:20px"><b>'. $city .'</b></td>
				</tr>
				<tr>
					<td colspan="3" style="font-size:10px; text-align: center">' . $date . '</td>
				</tr>
				<tr>
					<td style="text-align: center; vertical-align: middle; font-size: 25px; font-weight: bold">' . $temperature . '</td>
					<td colspan="2"><center><img src="' . $icon . '" /></center></td>
				</tr>
				<tr>
						<td style="text-align: center;"><b>' . $day[0] . '</b></td>
						<td style="text-align: center;"><b>' . $day[1] . '</b></td>
						<td style="text-align: center;"><b>' . $day[2] . '</b></td>
				</tr>
				<tr>
						<td><center><img src="' . $forecast_icon[0] . '" /></center></td>
						<td><center><img src="' . $forecast_icon[1] . '" /></center></td>
						<td><center><img src="' . $forecast_icon[2] . '" /></center></td>
				</tr>
				<tr>
						<td style="text-align: center; font-size: 12px;">' . $temperature_morning[0] . '</td>
						<td style="text-align: center; font-size: 12px;">' . $temperature_morning[1] . '</td>
						<td style="text-align: center; font-size: 12px;">' . $temperature_morning[2] . '</td>
				</tr>
				<tr>
						<td style="text-align: center; font-size: 12px;">' . $temperature_afternoon[0] . ' </td>
						<td style="text-align: center; font-size: 12px;">' . $temperature_afternoon[1] . ' </td>
						<td style="text-align: center; font-size: 12px;">' . $temperature_afternoon[2] . ' </td>
				</tr>
				</table>';
		}
		
		file_put_contents(WP_PLUGIN_DIR ."/easyweather-widget/weather-data-". $weather_station .".php", '<?php $time_generated='. time() .'; $widget_data = \''. $display .'\'; ?>');
		return $display;
	}	

	public function widget($args, $instance) {
		extract($args);
		
		if (file_exists(WP_PLUGIN_DIR ."/easyweather-widget/weather-data-". $instance['weather_station'] .".php")) {
			include "weather-data-". $instance['weather_station'] .".php";
			$file_old = time() - $time_generated;
			if ($file_old > $instance['weather_refresh']*60) {
				$widget_data = $this->EasyWeather_Parse($instance);
			}
		} else {
			$widget_data = $this->EasyWeather_Parse($instance);
		}
		
		$title = apply_filters('widget_title', $instance['weather_title']);
		if (!empty($title)) $display = $before_title . $title . $after_title;
		echo $display . $before_widget . $widget_data . $after_widget;
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['weather_title'] = strip_tags($new_instance['weather_title']);
		$instance['weather_api_key'] = strip_tags($new_instance['weather_api_key']);
		$instance['weather_station'] = strip_tags($new_instance['weather_station']);
		$instance['weather_units'] = strip_tags($new_instance['weather_units']);
		$instance['weather_language'] = strip_tags($new_instance['weather_language']);
		$instance['weather_refresh'] = strip_tags($new_instance['weather_refresh']);
		
		if (file_exists(WP_PLUGIN_DIR ."/easyweather-widget/weather-data-". $instance['weather_station'] .".php")) {
			unlink(WP_PLUGIN_DIR ."/easyweather-widget/weather-data-". $instance['weather_station'] .".php");
		}

		return $instance;
	}

	public function form($instance) {
		include "weather-language.php";
		$weather_available_language = array_keys($weather_language);
		$weather_language_array = $weather_language;
		
		if (isset($instance['weather_title'])) $weather_title = $instance['weather_title'];
		else $weather_title = __('Weather', 'text_domain');
		if (isset($instance['weather_api_key'])) $weather_api_key = $instance['weather_api_key'];
		if (isset($instance['weather_station'])) $weather_station = $instance['weather_station'];
		if (isset($instance['weather_units'])) $weather_units = $instance['weather_units'];
		else $weather_units = "metric";
		if (isset($instance['weather_language'])) $weather_language = $instance['weather_language'];
		else $weather_language = $weather_available_language[0];
		if (isset($instance['weather_refresh'])) $weather_refresh = $instance['weather_refresh'];
		else $weather_refresh = 10;
		
		$weather_language_options = "";
		foreach ($weather_available_language as $language) {
			$weather_language_options .= '<option value="'. $language .'"';
			if ($weather_language == $language) $weather_language_options .= 'selected="selected"';
			$weather_language_options .= '>'. $weather_language_array[$language]['description'] .'</option>';
		}
		?>
		<p><label for="<?php echo $this->get_field_id('weather_title'); ?>"><?php _e('Title:'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('weather_title'); ?>" name="<?php echo $this->get_field_name('weather_title'); ?>" type="text" value="<?php echo esc_attr($weather_title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('weather_api_key'); ?>"><?php _e('Weather Underground API key (<a href="http://www.wunderground.com/weather/api/" title="Get Weather Underground API key" target="_blank">help</a>):'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('weather_api_key'); ?>" name="<?php echo $this->get_field_name('weather_api_key'); ?>" type="text" value="<?php echo esc_attr($weather_api_key); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('weather_station'); ?>"><?php _e('Weather station ID (<a href="#" title="http://www.wunderground.com/q/zmw:STATION_ID">help</a>):'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('weather_station'); ?>" name="<?php echo $this->get_field_name('weather_station'); ?>" type="text" value="<?php echo esc_attr($weather_station); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('weather_units'); ?>"><?php _e('Units:'); ?></label><select class="widefat" id="<?php echo $this->get_field_id('weather_units'); ?>" name="<?php echo $this->get_field_name('weather_units'); ?>"><option value="metric" <?php if ($weather_units == "metric") echo "selected='selected'"; ?>>Metric (&#8451;)</option><option value="imperial" <?php if ($weather_units == "imperial") echo "selected='selected'"; ?>>Imperial (&#8457;)</option></select></p>
		<p><label for="<?php echo $this->get_field_id('weather_language'); ?>"><?php _e('Language:'); ?></label><select class="widefat" id="<?php echo $this->get_field_id('weather_language'); ?>" name="<?php echo $this->get_field_name('weather_language'); ?>"><?php echo $weather_language_options; ?></select></p>
		<p><label for="<?php echo $this->get_field_id('weather_refresh'); ?>"><?php _e('Refresh (minutes):'); ?></label><input class="widefat" id="<?php echo $this->get_field_id('weather_refresh'); ?>" name="<?php echo $this->get_field_name('weather_refresh'); ?>" type="text" value="<?php echo esc_attr($weather_refresh); ?>" /></p>
		<?php 
	}

}