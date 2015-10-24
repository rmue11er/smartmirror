function getTimeIcon(){
	var icon = null;
	var time = moment().format("HH");
	
	if(moment().endOf('day').fromNow() < 6){
		icon = '<i class="wi wi-day-haze"></i>';
	}
	
	if(moment().endOf('day').fromNow() < 4){
		icon = '<i class="wi wi-night-clear"></i>';
	}
	
	if(moment().endOf('day').fromNow() < 24){
		icon = '<i class="wi wi-sunrise"></i>';
	}
	
	if(moment().startOf('day').fromNow() > 0){
		icon = '<i class="wi wi-sunrise"></i>';
	}
	
	if(moment().endOf('day').fromNow() > 12){
		icon = '<i class="wi wi-day-sun"></i>';
	}
	
	alert(moment().endOf('day').fromNow());
	return icon;
}