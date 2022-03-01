<?php

namespace App\Controllers;

use App\Models\NewsModel;

class Apis extends BaseController {
	
	public function wikipedia() {
		
		// since 2010 a user agent is required
		ini_set('user_agent', 'University of Wolverhampton');
		
		$website = "www.bdtehque.com";
		
		$url = "http://en.wikipedia.org/w/api.php?"
				."action=query&"
				."list=exturlusage&"
				."eulimit=5&"
				."format=xml&"
				."euquery=".$website;
		
		// get data from url and store in object
		$data['links'] = simplexml_load_file($url);
		$data['title'] = "Wikipedia API";
		
		echo view('templates/header', $data);
		echo view('apis/wikipedia', $data);
		echo view('templates/footer', $data);
	}
	
	public function weather() {
		
		// since 2010 a user agent is required
		ini_set('user_agent', 'University of Wolverhampton');
		
		$apiKey = "9a855a15f0592888fac525d75bd94a5b";
		$cityName = "Wolverhampton";
		$url = "http://api.openweather.org/data/2.5/weather?id=" . $cityName . "&lang=en&units=metric&APPID=" . $apiKey;
		// api.openweathermap.org/data/2.5/weather?lat={lat}&lon={lon}&appid={9a855a15f0592888fac525d75bd94a5b};
		
		$json = file_get_contents($url);
		$obj = json_decode($json);
		
		$data['title'] = "Weather API";
		$data['weather'] = $obj;
		
		//echo view('templates/header', $data);
		//echo view('apis/weather', $data);
		//echo view('templates/footer', $data);
		print_r($data);
	}
}
?>