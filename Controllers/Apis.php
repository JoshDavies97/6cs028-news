<?php

namespace App\Controllers;

use App\Models\WorldModel;

class Apis extends BaseController {
		
	public function worldweather() {
		
		$url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=Wolverhampton&appid=9a855a15f0592888fac525d75bd94a5b";
		
		$json = file_get_contents($url);
		$obj = json_decode($json);
		
		$data['title'] = "World Weather Forecast";
		$data['weather'] = $obj;
		
		echo view('templates/worldWeatherHeader', $data);
		echo view('apis/worldweather', $data);
		echo view('templates/footer', $data);
	}
	
	public function localweather() {
		
		$url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=Wolverhampton&appid=9a855a15f0592888fac525d75bd94a5b";
		
		$json = file_get_contents($url);
		$obj = json_decode($json);
		
		$data['title'] = "Local Weather Forecast";
		$data['weather'] = $obj;
		
		echo view('templates/localWeatherHeader', $data);
		echo view('apis/localweather', $data);
		echo view('templates/footer', $data);
	}
}
?>