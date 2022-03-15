<body>
	<div class="container">
		<input type="text" id="city_name"> <button id="search" class="btn btn-primary">Search</button>
		<p>City: <span id="city_p"></span></p>
		<p>Weather: <span id="weather"></span></p>
		<p>Wind Speed: <span id="wind"></span></p>
		<p>Temperature: <span id="temp"></span></p>
		<img id="img_icon" src="">
	</div>
</body>

<script>

// button is clicked
document.getElementById("search").addEventListener("click", fetch_weather);

function fetch_weather() {
	
	// read value from text box
	var city = document.getElementById("city_name").value;

	// fetch weather data from api
	fetch('https://api.openweathermap.org/data/2.5/weather?units=metric&q=' + city + '&appid=9a855a15f0592888fac525d75bd94a5b')

		// convert response string to json object
		.then(response => response.json())
		.then(response => {
			
			// display whole api in browser console
			console.log(response);
			
			// city confrim check
			document.getElementById("city_p").innerHTML = response.name;
			
			// copy weather description
			document.getElementById("weather").innerHTML = response.weather[0].description;
			
			// copy wind speed
			document.getElementById("wind").innerHTML = response.wind.speed + ' meter/sec';
			
			// copy temperature
			document.getElementById("temp").innerHTML = response.main.temp + '°C';
			
			// add icon
			var icon = response.weather[0].icon;
			var icon_url = 'http://openweathermap.org/img/wn/' + icon + '@4x.png'
			
			document.getElementById("img_icon").src = icon_url;
		})
		.catch(err => {
			
			// display errors in the console
			console.log(err);	
	});
}
</script>