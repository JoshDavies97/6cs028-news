<body>
	<div class="container">
		<p>Weather: <span id="weather"></span></p>
		<p>Wind Speed: <span id="wind"></span></p>
		<p>Temperature: <span id="temp"></span></p>
	</div>
</body>

<script>
// fetch weather data from api
fetch('https://api.openweathermap.org/data/2.5/weather?units=metric&q=Wolverhampton&appid=9a855a15f0592888fac525d75bd94a5b')

	// convert response string to json object
	.then(response => response.json())
	.then(response => {
		
		// display whole api in browser console
		console.log(response);
		
		// copy weather description
		document.getElementById("weather").innerHTML = response.weather[0].description;
		
		// copy wind speed
		document.getElementById("wind").innerHTML = response.wind.speed + ' meter/sec';
		
		// copy temperature
		document.getElementById("temp").innerHTML = response.main.temp + '°C';
	})
	.catch(err => {
		
		// display errors in the console
		console.log(err);	
});
</script>