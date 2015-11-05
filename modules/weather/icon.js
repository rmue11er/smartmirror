function getIcon($icon_string){
	var s = $icon_string;
	
	if(s == "Rain"){
		return 'wi-rain';
	}
	
	if(s == "Clear"){
		return 'wi-cloud';
	}
	
	if(s == "Drizzle"){
		return 'wi-sprinkle';
	}
	
	if(s == "Snow"){
		return 'wi-snow';
	}
	
	if(s == "Clouds"){
		return 'wi-cloudy';
	}
	
	if(s == "Extreme"){
		return 'wi-storm-showers';
	}
}