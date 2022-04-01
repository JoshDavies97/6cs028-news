<body>
	<div class="container">
		<p><strong>City:</strong> <span id="city_p"></span>, <span id="country"></span></p>
		<p><strong>Weather:</strong> <span id="weather"></span></p>
		<p><strong>Wind Speed:</strong> <span id="wind"></span></p>
		<p><strong>Temperature:</strong> <span id="temp"></span></p>
		<img id="img_icon" src="">
	</div>
</body>

<script> 

// get user's current location from browser api 
navigator.geolocation.getCurrentPosition(fetch_weather);

function fetch_weather(position) {
	
	// get co-ordinate objects of user's position
	var lat = position.coords.latitude;
	var lon = position.coords.longitude;

	// fetch weather data from api
	fetch('https://api.openweathermap.org/data/2.5/weather?units=metric&lat=' + lat + '&lon=' + lon + '&appid=9a855a15f0592888fac525d75bd94a5b')

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
			
			// add icon
			var icon = response.weather[0].icon;
			var icon_url = 'https://openweathermap.org/img/wn/' + icon + '@4x.png'
			document.getElementById("img_icon").src = icon_url;
			
			// Let's check if the browser supports notifications
			if (!("Notification" in window)) {
				alert("This browser does not support notifications");
			}

			// Let's check whether notification permissions have already been granted
			else if (Notification.permission === "granted") {
				// notification created if location is found
				var notification = new Notification("Location found!");
			}

			// ask for permission to use notifications
			else if (Notification.permission !== "denied") {
				Notification.requestPermission().then(function (permission) {
					// create a notification if granted permission
					if (permission === "granted") {
					var notification = new Notification("Location found!");
				}
			});
		}
		})
		.catch(err => {
			
			// display errors in the console
			console.log(err);	
	});
}
</script>