<?php

// converts a year/month/day-pair to a timestamp in the format "1999-09-17"
function yearmonthday2timestamp($year, $month, $day) {
	$timestamp="$year-";
	if (strlen($month)==1) { $timestamp.="0"; }
	$timestamp.="$month";
	if (strlen($day)==1) { $timestamp.="0"; }
	$timestamp.="$day";

	return $timestamp;
}

/* converts a date/time to a timestamp in the format "1999-09-16 18:57:00" */
function datetime2timestamp($year, $month, $day, $hour, $min, $ampm) {
	$timestamp="$year-";
	if (strlen($month)==1) { $timestamp.="0$month-"; } else { $timestamp.="$month-"; }
	if (strlen($day)==1) { $timestamp.="0$day "; } else { $timestamp.="$day "; }
	if(USE_AMPM){  // if am, pm format is used
	 if (($ampm=="pm") && ($hour!=12)) { $hour+=12; }; /* 12pm is noon */
		 if (($ampm=="am") && ($hour==12)) { $hour=0; }; /* 12am is midnight */
	}
	if (strlen($hour)==1) { $timestamp.="0$hour:"; } else { $timestamp.="$hour:"; }
	if (strlen($min)==1) { $timestamp.="0$min:00"; } else { $timestamp.="$min:00"; }

	return $timestamp;
}

/* converts a timestamp "1999-09-16 18:57:00" to a date/time format */
function timestamp2datetime($timestamp) {
	/* split the date/time field-info into its parts */
	/* format returned by postgres is "1999-09-10 07:30:00" */
	$datetime['year']  = substr($timestamp,0,4);
	$datetime['month'] = substr($timestamp,5,2);
	if (substr($datetime['month'],0,1)=="0") { /* remove leading "0" */
		$datetime['month'] = substr($datetime['month'],1,1);
	}
	$datetime['day']   = substr($timestamp,8,2);
	if (substr($datetime['day'],0,1)=="0") { /* remove leading "0" */
		$datetime['day'] = substr($datetime['day'],1,1);
	}

	$datetime['hour']  = substr($timestamp,11,2);

	/* convert 24 hour into 1-12am/pm  if am, pm in data format is used*/
	if(USE_AMPM){  
		 $datetime['ampm'] = "pm";
		 if ($datetime['hour'] < 12) {
			 if ($datetime['hour'] == 0) { $datetime['hour'] = 12; }
			 $datetime['ampm'] = "am";
		 } else {
			 if ($datetime['hour'] > 12) { $datetime['hour'] -= 12; }
		 }
	}
	
	if (substr($datetime['hour'],0,1)=="0") { /* remove leading "0" */
		$datetime['hour'] = substr($datetime['hour'],1,1);
	}
	$datetime['min']=substr($timestamp,14,2);

	return $datetime;
}

/* converts the time from a timestamp "1999-09-16 18:57:00" to a number representing the number of seconds that have passed in that day. */
function timestamp2timenumber($timestamp) {
	$hour  = substr($timestamp,11,2);
	$minute = substr($timestamp,14,2);
	return ($hour * 60) + $minute;
}

// converts the number of minutes from 00:00:00 to a label for output.
function timenumber2timelabel($timenum) {
	//$hoursText = "";
	//$minutesText = "";
	
	if ($timenum > 59) {
		$hours = floor($timenum / 60);
		$timenum -= $hours * 60;
		//$hoursText = $hours . "hr";
	}

	if ($timenum > 0) {
		$minutes = $timenum;
		//$minutesText = $timenum . "m";
	}
	
	if (isset($hours) && isset($minutes)) {
		return $hours . 'hr ' . $minutes . 'm';
	}
	elseif (isset($hours) && !isset($minutes)) {
		if ($hours > 1) { return $hours . ' hours'; }
		else { return $hours . ' hour'; }
	}
	elseif (!isset($hours) && isset($minutes)) {
		return $minutes . ' min';
	}
	else {
		return "";
	}
}

// Returns a ISO 8601 date based on the passed year/month/day/hour/min/ampm.
// This is primarily used by the vCalendar format.
function datetime2ISO8601datetime($year,$month,$day,$hour,$min,$ampm) {
	$datetime = strtr(datetime2timestamp($year,$month,$day,$hour,$min,$ampm)," ","T");
	$datetime = str_replace("-","",$datetime);
	$datetime = str_replace(":","",$datetime);

	return $datetime;
}

// Returns the year/month/day/hour/min/ampm for a ISO 8601 date
// This is primarily used by the vCalendar format.
function ISO8601datetime2datetime($ISO8601datetime) {
	$datetime['year']  = substr($ISO8601datetime,0,4);
	$datetime['month'] = substr($ISO8601datetime,4,2);
	if (substr($datetime['month'],0,1)=="0") { // remove leading "0"
		$datetime['month'] = substr($datetime['month'],1,1);
	}
	$datetime['day']   = substr($ISO8601datetime,6,2);
	if (substr($datetime['day'],0,1)=="0") { // remove leading "0"
		$datetime['day'] = substr($datetime['day'],1,1);
	}

	$datetime['hour']  = substr($ISO8601datetime,9,2);

	// convert 24 hour into 1-12am/pm
	$datetime['ampm'] = "pm";
	if ($datetime['hour'] < 12) {
		if ($datetime['hour'] == 0) { $datetime['hour'] = 12; }
		$datetime['ampm'] = "am";
	} else {
		if ($datetime['hour'] > 12) { $datetime['hour'] -= 12; }
	}
	if (substr($datetime['hour'],0,1)=="0") { // remove leading "0"
		$datetime['hour'] = substr($datetime['hour'],1,1);
	}
	$datetime['min']=substr($ISO8601datetime,11,2);

	return $datetime;
}

// Assign the year/month/day/hour/min/ampm based on the events begin/end timestamps.
function disassemble_timestamp(&$event) {
	$timebegin = timestamp2datetime($event['timebegin']);
	$event['timebegin_year']  = $timebegin['year'];
	$event['timebegin_month'] = $timebegin['month'];
	$event['timebegin_day']   = $timebegin['day'];
	$event['timebegin_hour']  = $timebegin['hour'];
	$event['timebegin_min']   = $timebegin['min'];
	$event['timebegin_ampm']  = $timebegin['ampm'];

	$timeend = timestamp2datetime($event['timeend']);
	$event['timeend_year']  = $timeend['year'];
	$event['timeend_month'] = $timeend['month'];
	$event['timeend_day']   = $timeend['day'];
	$event['timeend_hour']  = $timeend['hour'];
	$event['timeend_min']   = $timeend['min'];
	$event['timeend_ampm']  = $timeend['ampm'];

	return 0;
}

// for non-recurring events the ending time equals the starting time
function settimeenddate2timebegindate(&$event) {
	$event['timeend_year'] = $event['timebegin_year'];
	$event['timeend_month'] = $event['timebegin_month'];
	$event['timeend_day'] = $event['timebegin_day'];
}

// Assign timestamps (YYYY-MM-DD HH-MM-SS AMPM) for the events begin/end times
function assemble_timestamp(&$event) {
	// Assign the begin timestamp.
	$event['timebegin'] = datetime2timestamp(
		$event['timebegin_year'],
		$event['timebegin_month'],
		$event['timebegin_day'],
		$event['timebegin_hour'],
		$event['timebegin_min'],
		$event['timebegin_ampm']);

	// If event doesn't have an ending time, set it to the end of the day.
	if (!isset($event['timeend_hour']) || $event['timeend_hour']==0) {
		$event['timeend_hour']=DAY_END_H;
		$event['timeend_min']=59;
		if(USE_AMPM)
			 $event['timeend_ampm']="pm";
	}

	// Assign the end timestamp.
	$event['timeend'] = datetime2timestamp(
		$event['timeend_year'],
		$event['timeend_month'],
		$event['timeend_day'],
		$event['timeend_hour'],
		$event['timeend_min'],
		$event['timeend_ampm']);
}

// returns a string like "5:00pm" from the input "5", "0", "pm"
function timestring($hour,$min,$ampm) {
	if (strlen($min)==1) { $min = "0".$min; }

	return $hour.":".$min.$ampm;
}

// returns true if the ending time is not 11:59pm (meaning: not specified)
function endingtime_specified(&$event) {
	return !(isset($event['timeend_hour']) &&
		isset($event['timeend_min']) &&
		isset($event['timeend_ampm']) && 
		$event['timeend_hour']==11 &&
		$event['timeend_min']==59 &&
		$event['timeend_ampm']=="pm");
}
?>