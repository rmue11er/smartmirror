function getTimeIcon(){
	var icon = null;
	var hour = moment().hours();
	
	
	if(hour >= 0) icon = '<i class="wi wi-night-clear"></i>';
	if(hour > 2) icon = '<i class="wi wi-moonset"></i>';
	if(hour > 4) icon = '<i class="wi wi-sunrise"></i>';
	if(hour > 11) icon = '<i class="wi wi-day-cloudy-high"></i>';  //@TODO check current weather
	if(hour > 18) icon = '<i class="wi wi-day-haze"></i>';
	if(hour > 20) icon = '<i class="wi wi-moonrise"></i>'; 
	if(hour > 22) icon = '<i class="wi wi-night-clear"></i>';
	
	return icon;
}