<body>
	<div class="container">
		<input type="text" id="city_name"> <button id="search" class="btn btn-primary">Search</button>
		<p><strong>City:</strong> <span id="city_p"></span>, <span id="country"></span></p>
		<p><strong>Weather:</strong> <span id="weather"></span></p>
		<p><strong>Wind Speed:</strong> <span id="wind"></span></p>
		<p><strong>Temperature:</strong> <span id="temp"></span></p>
		<img id="img_icon" src="">
	</div>
</body>

<script>

// get user's current location
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
			
			// city and country confirm check
			// copy city and country name
			document.getElementById("city_p").innerHTML = response.name;
			document.getElementById("country").innerHTML = response.sys.country;
			
			// copy weather description
			document.getElementById("weather").innerHTML = response.weather[0].description;
			
			// copy wind speed
			document.getElementById("wind").innerHTML = response.wind.speed + ' meter/sec';
			
			// copy temperature
			document.getElementById("temp").innerHTML = response.main.temp + '°C';
			
			// add weather icon
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