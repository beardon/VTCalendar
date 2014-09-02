<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

/* Escape a string to be outputted in an XML document */
function xmlEscape($string) {
	return str_replace('"','&quot;',str_replace('>','&gt;',str_replace('<','&lt;',str_replace("'",'&apos;',str_replace('&','&amp;',$string)))));
}

/* Create a date/time formatted for XML */
function xmlSchemaDate($tick) {
	return date("Y-m-d",$tick)."T".date("H:i:s",$tick).substr(date("O",$tick),0,3).':'.substr(date("O",$tick),3,2);
}

/* Output an error message and set headers so that it is not cached. */
function outputErrorMessage($mesg) {
	header('HTTP/1.1 500 Internal Server Error');
	header('Expires: '.gmdate("D, d M Y H:i:s", mktime(0,0,0,1,1,1975)).' GMT');
	header('Cache-Control: no-store');
	header('Content-type: text/plain');
	echo "<!-- /* ERR\n\nError Message(s):\n\n". $mesg ."\n\n*/ -->";
	exit();
}

function dbtime2tick($dbtime) {
	$year = substr($dbtime, 0, 4);
	$month = substr($dbtime, 5, 2);
	$day = substr($dbtime, 8, 2);
	$hour = substr($dbtime, 11, 2);
	$min = substr($dbtime, 14, 2);
	$sec = substr($dbtime, 17, 2);
	return mktime($hour, $min, $sec, $month, $day, $year);
}

/*
Huge - Wednesday, October 25, 2006
Long - Wed, October 25, 2006
Normal - October 25, 2006
Short - Oct. 25, 2006
Tiny - Oct 25 '06
Micro - Oct 25 or "Today"
*/
function FormatDate($format, $tick) {
	if ($format == "huge") {
		return date("l, F j, Y", $tick);
	}
	elseif ($format == "long") {
		return date("D, F j, Y", $tick);
	}
	elseif ($format == "normal") {
		return date("F j, Y", $tick);
	}
	elseif ($format == "short") {
		return date("M. j, Y", $tick);
	}
	elseif ($format == "tiny") {
		return date("M j, 'y", $tick);
	}
	elseif ($format == "micro") {
		//if (date("F j, Y", NOW) == date("F j, Y", $tick)) {
		//	return "Today";
		//}
		//else {
			return date("M j", $tick);
		//}
	}
}

/*
Time Display:
========================
-- Default to "Start" if no end time.
-- Ignored if "all day" event.
Start = 12:00pm
StartEndLong = 12:00pm to 12:30pm
StartEndNormal = 12:00pm - 12:30pm
StartEndTiny = 12:00pm-12:30pm
StartDurationLong = 12:00pm for 2 hours
StartDurationNormal = 12:00pm (2 hours)
StartDurationShort = 12:00pm 2 hours
*/
function FormatTimeDisplay(&$event, &$FormData) {
	$starttick = dbtime2tick($event['timebegin']);
	$endtick = dbtime2tick($event['timeend']);
	
	if ($event['wholedayevent'] != 0) {
		return "All Day";
	}
	else {
		if ($FormData['timedisplay'] == "start" || substr($event['timeend'], 11, 5) == "23:59") {
			return FormatTime($FormData['timeformat'], $starttick);
		}
		elseif ($FormData['timedisplay'] == "startendlong") {
			return FormatTime($FormData['timeformat'], $starttick)." to ".FormatTime($FormData['timeformat'], $endtick);
		}
		elseif ($FormData['timedisplay'] == "startendnormal") {
			return FormatTime($FormData['timeformat'], $starttick)." - ".FormatTime($FormData['timeformat'], $endtick);
		}
		elseif ($FormData['timedisplay'] == "startendshort") {
			return FormatTime($FormData['timeformat'], $starttick)."-".FormatTime($FormData['timeformat'], $endtick);
		}
		elseif ($FormData['timedisplay'] == "startdurationlong") {
			return FormatTime($FormData['timeformat'], $starttick)." for ".FormatDuration($FormData['durationformat'], $endtick-$starttick);
		}
		elseif ($FormData['timedisplay'] == "startdurationnormal") {
			return FormatTime($FormData['timeformat'], $starttick)." (".FormatDuration($FormData['durationformat'], $endtick-$starttick).")";
		}
		elseif ($FormData['timedisplay'] == "startdurationshort") {
			return FormatTime($FormData['timeformat'], $starttick)." ".FormatDuration($FormData['durationformat'], $endtick-$starttick);
		}
	}
}

/*
Time Formats:
========================
-- Ignored if "all day" event.

If using AM/PM:
	Huge = 12:00 PM EST
	Long = 12:00 PM
	Normal = 12:00pm
	Short = 12:00p
	
If not using AM/PM:
	Long = 24:00 EST
	Normal = 24:00
*/
function FormatTime($format, $tick) {
	if (USE_AMPM) {
		if ($format == "huge") {
			return date("g:i A T", $tick);
		}
		elseif ($format == "long") {
			return date("g:i A", $tick);
		}
		elseif ($format == "normal") {
			return date("g:ia", $tick);
		}
		elseif ($format == "short") {
			return date("g:i", $tick).substr(date("a", $tick),0,1);
		}
	}
	else {
		if ($format == "long") {
			return date("H:i T", $tick);
		}
		elseif ($format == "normal") {
			return date("H:i", $tick);
		}
	}
}

/*
Duration Formats:
========================
-- Ignored if has no end time
Long = 2 hours 30 minutes
Normal = 2 hours 30 min
Short = 2 hrs 30 min
Tiny = 2hrs 30min
Micro = 2hr 30m
*/
function FormatDuration($format, $seconds) {
	$hours = floor($seconds / 60 / 60);
	$minutes = floor(($seconds - ($hours*60*60)) / 60);
	
	if ($format == "long") {
		if ($hours > 1) $hour_str = " hours";
		else            $hour_str = " hour";
		
		if ($minutes > 1) $minute_str = " minutes";
		else              $minute_str = " minute";
	}
	elseif ($format == "normal") {
		if ($hours > 1) $hour_str = " hours";
		else            $hour_str = " hour";
		
		$minute_str = " min";
	}
	elseif ($format == "short") {
		if ($hours > 1) $hour_str = " hrs";
		else            $hour_str = " hr";
		
		$minute_str = " min";
	}
	elseif ($format == "tiny") {
		if ($hours > 1) $hour_str = "hrs";
		else            $hour_str = "hr";
		
		$minute_str = "min";
	}
	elseif ($format == "micro") {
		$hour_str = "hr";
		$minute_str = "m";
	}
	
	if ($hours > 0 && $minutes > 0) {
		return $hours.$hour_str." ".$minutes.$minute_str;
	}
	elseif ($hours > 0) {
		return $hours.$hour_str;
	}
	elseif ($minutes > 0) {
		return $minutes.$minute_str;
	}
	else {
		return "";
	}
}
?>