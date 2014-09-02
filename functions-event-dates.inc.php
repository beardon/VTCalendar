<?php
// display input fields for a date (month, day, year)
function inputdate($month,$monthvar,$day,$dayvar,$year,$yearvar) {
	$unknownvalue = "???"; // this is printed when the value of input field is unspecified
	echo "<select name=\"",$monthvar,"\" id=\"",$monthvar,"\">\n";

	//if ($month==0) {
	//  echo "<option selected value=\"0\">",$unknownvalue,"</option>\n";
	//}
	/* print list with months and select the one read from the DB */
	$currentmonth = date("n", NOW);
	for ($i=1; $i<=12; $i++) {
		print '<option ';
		if ($month==$i) { echo "selected "; }
		if ($currentmonth==$i && $month==0) { echo "selected "; }
		echo "value=\"$i\">",Month_to_Text($i),"</option>\n";
	}
	echo "</select>\n";
	echo "<select name=\"",$dayvar,"\" id=\"",$dayvar,"\">\n";

	// if ($day==0) {
	// echo "<option selected value=\"0\">",$unknownvalue,"</option>\n";
	//}

	// print list with days and select the one read from the DB
	$currentday = date("j", NOW);
	for ($i=1;$i<=31;$i++) {
		echo "<option ";
		if ($day==$i) { echo "selected "; }
		if ($currentday==$i && $day==0) { echo "selected "; }
		echo "value=\"",$i,"\">",$i,"</option>\n";
	}
	echo "</select>\n";
	echo "<select name=\"",$yearvar,"\" id=\"",$yearvar,"\">\n";

	// print list with years and select the one read from the DB
	$currentyear = date("Y", NOW);
	if (!empty($year) && $year < $currentyear) { echo "<option selected value=\"",$year,"\">",$year,"</option>\n"; }
	for ($i=$currentyear;$i<=$currentyear+ALLOWED_YEARS_AHEAD;$i++) {
		echo "<option ";
		if ($year==$i) { echo "selected "; }
		echo "value=\"",$i,"\">",$i,"</option>\n";
	}
	echo "</select>\n";
	
	if (!isset($GLOBALS['popupCalendarJavascriptIsLoaded'])) {
		 $calendarLanguageFile = 'scripts/jscalendar/lang/calendar-'.LANGUAGE.'.js';
	 if (!file_exists($calendarLanguageFile)) {
		$calendarLanguageFile = 'scripts/jscalendar/lang/calendar-en.js';
	 }
	 echo '
	<link rel="stylesheet" type="text/css" media="all" href="scripts/jscalendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<script type="text/javascript" src="scripts/jscalendar/calendar.js"></script>
	<script type="text/javascript" src="',$calendarLanguageFile,'"></script>
	<script type="text/javascript" src="scripts/jscalendar/calendar-setup.js"></script>
';
		$GLOBALS['popupCalendarJavascriptIsLoaded'] = TRUE;
	}
	
	$uniqueid = strtr($monthvar, '[]','__');
	
	$firstDay = WEEK_STARTING_DAY;
	echo <<<END
<input type="hidden" name="popupCalendarDate" id="popupCalendarDate_$uniqueid" value="$month/$day/$year">
<img src="images/date.gif" width="16" height="16" id="showPopupCalendarImage_$uniqueid" 
title="Date selector" border="0" align="baseline" style="cursor: pointer;" hspace="3">
<script type="text/javascript"><!--
function onSelectDate(cal) {
	var p = cal.params;
	if (cal.dateClicked) {
		cal.callCloseHandler();
		var month = document.getElementById("$monthvar");
		monthPerhapsWithLeadingZero = cal.date.print("%m");
		if (monthPerhapsWithLeadingZero.charAt(0) == "0") {
			month.value = monthPerhapsWithLeadingZero.substr(1);
		}
		else {
			month.value = monthPerhapsWithLeadingZero;
		}
		var date = document.getElementById("$dayvar");
		date.value = cal.date.print("%e");
		var year = document.getElementById("$yearvar");
		year.value = cal.date.print("%Y");
		
		document.getElementById("popupCalendarDate_$uniqueid").value = cal.date.print("%m/%e/%Y");
	}
};

Calendar.setup({
	inputField     :    "popupCalendarDate_$uniqueid",     // id of the input field
	ifFormat       :    "%m/%e/%Y",      // format of the input field
	button         :    "showPopupCalendarImage_$uniqueid",  // trigger for the calendar (button ID)
	align          :    "br",           // alignment (defaults to "Bl")
	weekNumbers    :    false,
	firstDay       :    $firstDay,
	onSelect       :    onSelectDate
});
//--></script>

END;
} // end: function inputdate

function readinrepeat($repeatid, &$event, &$repeat) {
	$query = "SELECT * FROM ".SCHEMANAME."vtcal_event_repeat WHERE id = '".sqlescape($repeatid)."'";
	if (is_string($result =& DBQuery($query))) return $result;
	$r =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);

	repeatdef2repeatinput($r['repeatdef'],$event,$repeat);

	$startdate = timestamp2datetime($r['startdate']);
	$event['timebegin_year']  = $startdate['year'];
	$event['timebegin_month'] = $startdate['month'];
	$event['timebegin_day']   = $startdate['day'];
	
	return true;
}

// takes the values from the inputfields on the form and constructs a
// repeat-definition string in vCalendar format, e.g. "MP2 3+ TH 20000211T235900"
function repeatinput2repeatdef(&$event,&$repeat) {
	if ($repeat['mode'] == 1) {
		 if ($repeat['interval1']=="every") { $interval = "1"; }
		 if ($repeat['interval1']=="everyother") { $interval = "2"; }
		 if ($repeat['interval1']=="everythird") { $interval = "3"; }
		 if ($repeat['interval1']=="everyfourth") { $interval = "4"; }

		 if ($repeat['frequency1']=="day") { $frequency = "D"; }
		 if ($repeat['frequency1']=="week") { $frequency = "W"; }
		 if ($repeat['frequency1']=="month") { $frequency = "M"; }
		 if ($repeat['frequency1']=="year") { $frequency = "YD"; }
		 if ($repeat['frequency1']=="monwedfri") { $frequency = "W"; $frequencymodifier="MO WE FR"; }
		 if ($repeat['frequency1']=="tuethu") { $frequency = "W"; $frequencymodifier="TU TH"; }
		 if ($repeat['frequency1']=="montuewedthufri") { $frequency = "W"; $frequencymodifier="MO TU WE TH FR"; }
		 if ($repeat['frequency1']=="satsun") { $frequency = "W"; $frequencymodifier="SA SU"; }
		 if ($repeat['frequency1']=="sunday") { $frequency = "W"; $frequencymodifier="SU"; }
		 if ($repeat['frequency1']=="monday") { $frequency = "W"; $frequencymodifier="MO"; }
		 if ($repeat['frequency1']=="tuesday") { $frequency = "W"; $frequencymodifier="TU"; }
		 if ($repeat['frequency1']=="wednesday") { $frequency = "W"; $frequencymodifier="WE"; }
		 if ($repeat['frequency1']=="thursday") { $frequency = "W"; $frequencymodifier="TH"; }
		 if ($repeat['frequency1']=="friday") { $frequency = "W"; $frequencymodifier="FR"; }
		 if ($repeat['frequency1']=="saturday") { $frequency = "W"; $frequencymodifier="SA"; }
	}
	elseif ($repeat['mode'] == 2) {
		 $frequency = "MP";

		 if ($repeat['frequency2modifier1']=="first") { $frequencymodifier = "1+"; }
		 if ($repeat['frequency2modifier1']=="second") { $frequencymodifier = "2+"; }
		 if ($repeat['frequency2modifier1']=="third") { $frequencymodifier = "3+"; }
		 if ($repeat['frequency2modifier1']=="fourth") { $frequencymodifier = "4+"; }
		 if ($repeat['frequency2modifier1']=="last") { $frequencymodifier = "1-"; }

		 if ($repeat['frequency2modifier2']=="sun") { $frequencymodifier.=" SU"; }
		 if ($repeat['frequency2modifier2']=="mon") { $frequencymodifier.=" MO"; }
		 if ($repeat['frequency2modifier2']=="tue") { $frequencymodifier.=" TU"; }
		 if ($repeat['frequency2modifier2']=="wed") { $frequencymodifier.=" WE"; }
		 if ($repeat['frequency2modifier2']=="thu") { $frequencymodifier.=" TH"; }
		 if ($repeat['frequency2modifier2']=="fri") { $frequencymodifier.=" FR"; }
		 if ($repeat['frequency2modifier2']=="sat") { $frequencymodifier.=" SA"; }

		 if ($repeat['interval2']=="month") { $interval="1"; }
		 if ($repeat['interval2']=="2months") { $interval="2"; }
		 if ($repeat['interval2']=="3months") { $interval="3"; }
		 if ($repeat['interval2']=="4months") { $interval="4"; }
		 if ($repeat['interval2']=="6months") { $interval="6"; }
		 if ($repeat['interval2']=="year") { $interval="12"; }
	} // end: elseif ($repeat[mode] == 2)

	// construct a repeat definition using the vCalendar standard
	$repeatdef = $frequency.$interval." ";
	if (!empty($frequencymodifier)) { $repeatdef.=$frequencymodifier." "; }
	$repeatdef .= datetime2ISO8601datetime(
		$event['timeend_year'],
		$event['timeend_month'],
		$event['timeend_day'],
		11,59,"pm");
	return $repeatdef;
} // end: function repeatinput2repeatdef(&$event,&$repeat)

// separate the string at the first space
function getfirstslice($s) {
	$spacepos = strpos($s," ");
	if ($spacepos==0) {
		$part1 = $s;
		$part2 = "";
	}
	else {
		$part1 = substr($s,0,$spacepos);
		$part2 = substr($s,$spacepos+1,strlen($s)-$spacepos-1);
	}

	return array($part1, $part2);
}

// splits a vcalendar-style repeatdef string like "MP2 3+ TH 20000211T235900" into
// its parts "frequency","interval","frequencymodifier" and enddatetime (year,month,day,hour,min,ampm)
// Attention!: it does not implement the whole vCalendar recurrence grammar, but rather
//             the subset used by the VTEC interface
function repeatdefdisassemble($repeatdef,&$frequency,&$interval,&$frequencymodifier,&$endyear,&$endmonth,&$endday) {
	$frequencymodifier = "";
	list($frequencyinterval,$remainder) = getfirstslice($repeatdef);

	if (substr($frequencyinterval,0,2)=="MP") {  // it's of the format: "MP2 3+ TH 19991224T135000"
		$frequency = "MP";
		$interval = substr($frequencyinterval,2,strlen($frequencyinterval)-2);
		list($frequencymodifier1,$frequencymodifier2,$enddatetimeISO8601) = explode(" ",$remainder);

		$frequencymodifier = $frequencymodifier1." ".$frequencymodifier2;
		$enddatetime = ISO8601datetime2datetime($enddatetimeISO8601);
	}
	elseif (substr($frequencyinterval,0,2)=="YD") {
		$frequency = "YD";
		$interval = $frequencyinterval[2];
		$enddatetime = ISO8601datetime2datetime($remainder);
	}
	elseif ($frequencyinterval[0]=="D" || $frequencyinterval[0]=="M") {
		$frequency = $frequencyinterval[0];
		$interval = $frequencyinterval[1];
		$enddatetime = ISO8601datetime2datetime($remainder);
	}
	elseif ($frequencyinterval[0]=="W") {
		$frequency = $frequencyinterval[0];
		$interval = $frequencyinterval[1];

		// parse the string and add all but the last component (which is the date) to the "modifier"
		do {
			list($part,$newremainder) = getfirstslice($remainder);

			if (!empty($newremainder)) {
			 if (!empty($frequencymodifier)) { $frequencymodifier.=" "; }
			 $frequencymodifier.=$part;
			 $remainder = $newremainder;
			}
			else {
			 $enddatetime = ISO8601datetime2datetime($part);
			}
		} while (!empty($newremainder));
	}

	$endyear = $enddatetime['year'];
	$endmonth = $enddatetime['month'];
	$endday = $enddatetime['day'];

	return 1;
} // end: Function repeatdefdisassemble

// prints the definition for a recurring event
function printrecurrence($startyear,$startmonth,$startday,$repeatdef) {
	if (!empty($repeatdef)) {
		repeatdefdisassemble($repeatdef,$frequency,$interval,$frequencymodifier,$endyear,$endmonth,$endday);
		
		echo lang('recurring')," ";
		if ($frequency=="MP") {
			list($frequencymodifiernumber,$frequencymodifierday) = getfirstslice($frequencymodifier);
			echo lang('on_the'),' ';

			if ($frequencymodifiernumber[1]=="-") { echo lang('last'); }
			else {
				if ($frequencymodifiernumber=="1+") { echo lang('first'); }
				elseif ($frequencymodifiernumber=="2+") { lang('second'); }
				elseif ($frequencymodifiernumber=="3+") { lang('third'); }
				elseif ($frequencymodifiernumber=="4+") { lang('fourth'); }
			}
			echo " ";
			if ($frequencymodifierday=="SU") { echo lang('sunday'); }
			elseif ($frequencymodifierday=="MO") { echo lang('monday'); }
			elseif ($frequencymodifierday=="TU") { echo lang('tuesday'); }
			elseif ($frequencymodifierday=="WE") { echo lang('wednesday'); }
			elseif ($frequencymodifierday=="TH") { echo lang('thursday'); }
			elseif ($frequencymodifierday=="FR") { echo lang('friday'); }
			elseif ($frequencymodifierday=="SA") { echo lang('saturday'); }

			echo ' ',lang('of_the_month_every'),' ';

			if ($interval==1) { echo lang('month'); }
			elseif ($interval==2) { echo lang('other_month'); }
			elseif ($interval>=3 && $interval<=6) { echo $interval,' ',lang('months'); }
			elseif ($interval==12) { echo lang('year'); }

		} // end: if ($frequency=="MP")
		else {
			if ($interval==1) { echo lang('every'); }
			elseif ($interval==2) { echo lang('every_other'); }
			elseif ($interval==3) { echo lang('every_third'); }
			elseif ($interval==4) { echo lang('every_fourth'); }
			echo ' ';

			if ($frequency=="D") { echo lang('day'); }
			elseif ($frequency=="M") { echo lang('month'); }
			elseif ($frequency=="Y") { echo lang('year'); }
			elseif ($frequency=="W") {
				echo " ";
				if (empty($frequencymodifier)) { echo lang('week'); }
				else {
					$frequencymodifier = " ".$frequencymodifier;

		$comma = 0;
		if (strpos($frequencymodifier,"SU")!=0) {
			if ($comma) { echo ", "; }
			echo lang('sunday');
						$comma=1;
		}
		if (strpos($frequencymodifier,"MO")!=0) {
			if ($comma) { echo ", "; }
			echo lang('monday');
						$comma=1;
		}
		if (strpos($frequencymodifier,"TU")!=0) {
			if ($comma) { echo ", "; }
			echo lang('tuesday');
						$comma=1;
		}
		if (strpos($frequencymodifier,"WE")!=0) {
			if ($comma) { echo ", "; }
			echo lang('wednesday');
						$comma=1;
		}
		if (strpos($frequencymodifier,"TH")!=0) {
			if ($comma) { echo ", "; }
			echo lang('thursday');
						$comma=1;
		}
		if (strpos($frequencymodifier,"FR")!=0) {
			if ($comma) { echo ", "; }
			echo lang('friday');
						$comma=1;
		}
		if (strpos($frequencymodifier,"SA")!=0) {
			if ($comma) { echo ", "; }
			echo lang('saturday');
						$comma=1;
		}
	} // end: else: if (empty($frequencymodifier))
			} // end: elseif ($frequency=="W")
		} // end: else: if ($frequency=="MP")

		echo '; ',lang('starting'),' ',Encode_Date_US($startmonth,$startday,$startyear);
		echo '; ',lang('ending'),' ',Encode_Date_US($endmonth,$endday,$endyear);

	} // end: if (!empty($repeatdef))
	else {
		echo lang('no_recurrences_defined');
	}
} // end: function printrecurrence

// transform a startdate and a repeat-definition in the vCalendar format,
// e.g. "MP2 3+ TH 20000211T235900" into an array of single dates
function repeatdefdisassembled2repeatlist(
	$startyear,
	$startmonth,
	$startday,
	$frequency,
	$interval,
	$frequencymodifier,
	$endyear,
	$endmonth,
	$endday) {

	$repeatlist = array();
	$startdateJD = JulianToJD($startmonth,$startday,$startyear);
	$enddateJD = JulianToJD($endmonth,$endday,$endyear);
	$ecount = 0;

	if ($frequency=="D") { // recurring daily
		$dateJD = $startdateJD + $ecount * $interval;
		while ($dateJD <= $enddateJD) {
			$repeatlist[$ecount]=$dateJD; // store this date in the list (array)
			$ecount++;
			$dateJD = $startdateJD + $ecount * $interval;
		}
	}
	elseif ($frequency=="M") { // recurring same date monthly
		$enddate = yearmonthday2timestamp($endyear,$endmonth,$endday);
		$year = $startyear;
		$month = $startmonth;
		$date=yearmonthday2timestamp($year,$month,$startday);
		while ($date <= $enddate) {
			// check if it is a valid date and not for example Feb, 30th,...
			if (checkdate($month,$startday,$year)) {
				$dateJD = JulianToJD($month,$startday,$year);
				$repeatlist[$ecount]=$dateJD; // store this date in the list (array)
				$ecount++;
			}
			$month+=$interval;
			if ($month>12) { $month -= 12; $year++; }
			$date=yearmonthday2timestamp($year,$month,$startday);
		}
	}
	elseif ($frequency=="YD") { // recurring same date yearly
		$enddate = yearmonthday2timestamp($endyear,$endmonth,$endday);
		$year = $startyear;
		$date=yearmonthday2timestamp($year,$startmonth,$startday);
		while ($date <= $enddate) {
			// check if it is a valid date
			if (checkdate($startmonth,$startday,$year)) {
				$dateJD = JulianToJD($startmonth,$startday,$year);
				$repeatlist[$ecount]=$dateJD; // store this date in the list (array)
				$ecount++;
			}
			$year+=$interval;
			$date=yearmonthday2timestamp($year,$startmonth,$startday);
		}
	}
	elseif ($frequency=="W") { // recurring in weekly cycles
		if (empty($frequencymodifier)) {
			$dateJD = $startdateJD + $ecount * $interval*7;
			while ($dateJD <= $enddateJD) {
				$repeatlist[$ecount]=$dateJD; // store this date in the list (array)
				$ecount++;
				$dateJD = $startdateJD + $ecount * $interval*7;
			}
		}
		else {
			// determine the Sunday of the week
			$dow = Day_of_Week($startmonth,$startday,$startyear);
			$weekfrom = Add_Delta_Days($startmonth,$startday,$startyear,-$dow);

			$weekfromJD = JulianToJD($weekfrom['month'],$weekfrom['day'],$weekfrom['year']);

			// prepend a space to allow searching the string by testing "strpos(..) != 0"
			$frequencymodifier = " ".$frequencymodifier;

			$i = 0;
			$dateJD = $weekfromJD + $i * $interval*7;

			while ($dateJD <= $enddateJD) {
				if (strpos($frequencymodifier,"MO")!=0) {
					if ($dateJD+1 >= $startdateJD && $dateJD+1 <= $enddateJD) { $repeatlist[$ecount]=$dateJD+1; $ecount++; }
				}
			 if (strpos($frequencymodifier,"TU")!=0) {
					if ($dateJD+2 >= $startdateJD && $dateJD+2 <= $enddateJD) { $repeatlist[$ecount]=$dateJD+2; $ecount++; }
				}
			 if (strpos($frequencymodifier,"WE")!=0) {
					if ($dateJD+3 >= $startdateJD && $dateJD+3 <= $enddateJD) { $repeatlist[$ecount]=$dateJD+3; $ecount++; }
				}
			 if (strpos($frequencymodifier,"TH")!=0) {
					if ($dateJD+4 >= $startdateJD && $dateJD+4 <= $enddateJD) { $repeatlist[$ecount]=$dateJD+4; $ecount++; }
				}
			 if (strpos($frequencymodifier,"FR")!=0) {
					if ($dateJD+5 >= $startdateJD && $dateJD+5 <= $enddateJD) { $repeatlist[$ecount]=$dateJD+5; $ecount++; }
				}
			 if (strpos($frequencymodifier,"SA")!=0) {
					if ($dateJD+6 >= $startdateJD && $dateJD+6 <= $enddateJD) { $repeatlist[$ecount]=$dateJD+6; $ecount++; }
				}
				if (strpos($frequencymodifier,"SU")!=0) {
					if ($dateJD+7 >= $startdateJD && $dateJD+7 <= $enddateJD) { $repeatlist[$ecount]=$dateJD+7; $ecount++; }
				}

				$i++;
				$dateJD = $weekfromJD + $i * $interval*7;
			}
		}
	}
	elseif ($frequency=="MP") { // recurring in monthly cycles like "MP2 3+ TH 20000512T..." or "MP12 1- FR 19990922T..."
		list($frequencymodifiernumber,$frequencymodifierday) = explode(" ",$frequencymodifier);

		if ($frequencymodifiernumber[1]=="-") { $last = 1; } else { $last = 0; }
		$frequencymodifiernumber = $frequencymodifiernumber[0];

		if ($frequencymodifierday=="SU") { $dow = 0; }
		elseif ($frequencymodifierday=="MO") { $dow = 1; }
		elseif ($frequencymodifierday=="TU") { $dow = 2; }
		elseif ($frequencymodifierday=="WE") { $dow = 3; }
		elseif ($frequencymodifierday=="TH") { $dow = 4; }
		elseif ($frequencymodifierday=="FR") { $dow = 5; }
		elseif ($frequencymodifierday=="SA") { $dow = 6; }

		$enddate = yearmonthday2timestamp($endyear,$endmonth,$endday);
		$year = $startyear;
		$month = $startmonth;
		$date=yearmonthday2timestamp($year,$month,1);
		while ($date <= $enddate) {

			$monthfromJD = JulianToJD($month,1,$year);
			$firstofmonth_dow = Day_of_Week($month,1,$year);

			// determine the date of the first occurrence of the specified weekday
			if ($firstofmonth_dow<=$dow) { $firstday = 1 + $dow-$firstofmonth_dow; }
			else { $firstday = 1 + (7-$firstofmonth_dow)+$dow; }
			$firstdayJD = $monthfromJD + $firstday-1;

			if ($last) {
				// determine if "last" means the 4th or the 5th weekday of the months
				// by testing whether the 5th weekday exist
	if (checkdate($month,$firstday+28,$year)) { $weeks=4; }
				else { $weeks=3; }
			}
			else {
				$weeks = $frequencymodifiernumber-1;
			}
			// e.g. we get the 3rd Thursday by adding 2 weeks to the first Thursday
			$dayJD = $firstdayJD + $weeks*7;

			if ($dayJD <= $enddateJD && $dayJD >= $startdateJD) {
				$repeatlist[$ecount]=$dayJD; // store this date in the list (array)
				$ecount++;
			}

			$month+=$interval;
			if ($month>12) { $month -= 12; $year++; }
			$date=yearmonthday2timestamp($year,$month,1);
		}

	} // end: elseif ($frequency=="MP")


	return $repeatlist;
} // end: function repeatdefdisassembled2repeatlist

// takes the values from the input form and outputs a list containing dates
// it uses the vCalendar specification to store repeating event information
function producerepeatlist(&$event,&$repeat) {
	$repeatdef = repeatinput2repeatdef($event,$repeat);

	repeatdefdisassemble($repeatdef,$frequency,$interval,$frequencymodifier,$endyear,$endmonth,$endday);

	$repeatlist = repeatdefdisassembled2repeatlist(
		$event['timebegin_year'],
		$event['timebegin_month'],
		$event['timebegin_day'],
		$frequency,
		$interval,
		$frequencymodifier,
		$endyear,
		$endmonth,
		$endday);

	return $repeatlist;
}

// prints out all the days contained in a recurrencelist (array)
function printrecurrencedetails(&$repeatlist) {
	if (sizeof($repeatlist)==0) {
		echo lang('recurrence_produces_no_dates');
	}
	else {
		echo "(",lang('resulting_dates_are');

		$comma = 0;
		while ($dateJD = each($repeatlist)) {
			if ($comma) { echo "; "; }
			$d = Decode_Date_US(JDToJulian($dateJD['value']));
			echo " ",Day_of_Week_Abbreviation(Day_of_Week($d['month'],$d['day'],$d['year'])),", ",JDToJulian($dateJD['value']);
			$comma = 1;
		}
		echo ")";
	}
}

// translates the contents of a repeat definition string in vCalendar format
// to the input variables required for the input form
function repeatdef2repeatinput($repeatdef,&$event,&$repeat) {
	repeatdefdisassemble($repeatdef,$frequency,$interval,$frequencymodifier,$endyear,$endmonth,$endday);

	if ($frequency=="MP") {
		$repeat['mode'] = 2;
		list($frequency2modifier1,$frequency2modifier2) = explode(" ",$frequencymodifier);

		if ($frequency2modifier1=="1+") { $repeat['frequency2modifier1']="first"; }
		if ($frequency2modifier1=="2+") { $repeat['frequency2modifier1']="second"; }
		if ($frequency2modifier1=="3+") { $repeat['frequency2modifier1']="third"; }
		if ($frequency2modifier1=="4+") { $repeat['frequency2modifier1']="fourth"; }
		if ($frequency2modifier1=="1-") { $repeat['frequency2modifier1']="last"; }

		if ($frequency2modifier2=="SU") { $repeat['frequency2modifier2']="sun"; }
		if ($frequency2modifier2=="MO") { $repeat['frequency2modifier2']="mon"; }
		if ($frequency2modifier2=="TU") { $repeat['frequency2modifier2']="tue"; }
		if ($frequency2modifier2=="WE") { $repeat['frequency2modifier2']="wed"; }
		if ($frequency2modifier2=="TH") { $repeat['frequency2modifier2']="thu"; }
		if ($frequency2modifier2=="FR") { $repeat['frequency2modifier2']="fri"; }
		if ($frequency2modifier2=="SA") { $repeat['frequency2modifier2']="sat"; }

		if ($interval=="1") { $repeat['interval2']="month"; }
		if ($interval=="2") { $repeat['interval2']="2months"; }
		if ($interval=="3") { $repeat['interval2']="3months"; }
		if ($interval=="4") { $repeat['interval2']="4months"; }
		if ($interval=="6") { $repeat['interval2']="6months"; }
		if ($interval=="12") { $repeat['interval2']="year"; }
	}
	else {
		$repeat['mode'] = 1;

		if ($interval=="1") { $repeat['interval1']="every"; }
		if ($interval=="2") { $repeat['interval1']="everyother"; }
		if ($interval=="3") { $repeat['interval1']="everythird"; }
		if ($interval=="4") { $repeat['interval1']="everyfourth"; }

		if ($frequency=="D") { $repeat['frequency1']="day"; }
		if ($frequency=="M") { $repeat['frequency1']="month"; }
		if ($frequency=="YD") { $repeat['frequency1']="year"; }
		if ($frequency=="W") {
			if (empty($frequencymodifier)) { $repeat['frequency1']="week"; }
			elseif ($frequencymodifier=="MO WE FR") { $repeat['frequency1']="monwedfri"; }
			elseif ($frequencymodifier=="TU TH") { $repeat['frequency1']="tuethu"; }
			elseif ($frequencymodifier=="MO TU WE TH FR") { $repeat['frequency1']="montuewedthufri"; }
			elseif ($frequencymodifier=="SA SU") { $repeat['frequency1']="satsun"; }
			elseif ($frequencymodifier=="SU") { $repeat['frequency1']="sunday"; }
			elseif ($frequencymodifier=="MO") { $repeat['frequency1']="monday"; }
			elseif ($frequencymodifier=="TU") { $repeat['frequency1']="tuesday"; }
			elseif ($frequencymodifier=="WE") { $repeat['frequency1']="wednesday"; }
			elseif ($frequencymodifier=="TH") { $repeat['frequency1']="thursday"; }
			elseif ($frequencymodifier=="FR") { $repeat['frequency1']="friday"; }
			elseif ($frequencymodifier=="SA") { $repeat['frequency1']="saturday"; }
		}
	} // end: else:   if ($frequency=="MP")

	$event['timeend_year'] = $endyear;
	$event['timeend_month'] = $endmonth;
	$event['timeend_day'] = $endday;

	return 1;
} // end: Function repeatdef2repeatinput($repeatdef,&$event,&$repeat)
?>