<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

// determine today's date
$today = Decode_Date_US(date("m/d/Y", NOW));
//$today['dow_text'] = Day_of_Week_Abbreviation(Day_of_Week($today['month'],$today['day'],$today['year']));

// If a username and password was submitted via POST, then assign them to $userid and $password.
//--if (!isset($_POST['userid']) || !setVar($userid,$_POST['userid'],'userid')) unset($userid);
//--if (!isset($_POST['password']) || !setVar($password,$_POST['password'],'password')) unset($password);

// If the current view is set, then assign it to $view (also validates it).
// If it is not set, then attempt to assign the session variable 'view' to $view.
// Otherwise, unset $view.
if (!isset($_GET['view']) || !setVar($view,$_GET['view'],'view')) { 
	if (!empty($_SESSION['PREVIOUS_VIEW'])) { $view = $_SESSION['PREVIOUS_VIEW']; }
	elseif (SHOW_UPCOMING_TAB) { $view = "upcoming"; }
	else { $view = "day"; } 
}

// Store the view in a session variable.
$_SESSION['PREVIOUS_VIEW'] = $view;

// If any of the following GET variables are set, then assign them to their respective variables.
if (!isset($_GET['eventid']) || !setVar($eventid,$_GET['eventid'],'eventid')) unset($eventid);
if (!isset($_GET['timebegin']) || !setVar($timebegin,$_GET['timebegin'],'timebegin')) unset($timebegin);
if (!isset($_GET['timebegin_year']) || !setVar($timebegin_year,$_GET['timebegin_year'],'timebegin_year')) unset($timebegin_year);
if (!isset($_GET['timebegin_month']) || !setVar($timebegin_month,$_GET['timebegin_month'],'timebegin_month')) unset($timebegin_month);
if (!isset($_GET['timebegin_day']) || !setVar($timebegin_day,$_GET['timebegin_day'],'timebegin_day')) unset($timebegin_day);
if (!isset($_GET['timeend']) || !setVar($timeend,$_GET['timeend'],'timeend')) unset($timeend);
if (!isset($_GET['timeend_year']) || !setVar($timeend_year,$_GET['timeend_year'],'timeend_year')) unset($timeend_year);
if (!isset($_GET['timeend_month']) || !setVar($timeend_month,$_GET['timeend_month'],'timeend_month')) unset($timeend_month);
if (!isset($_GET['timeend_day']) || !setVar($timeend_day,$_GET['timeend_day'],'timeend_day')) unset($timeend_day);
if (!isset($_GET['categoryid']) || !setVar($categoryid,$_GET['categoryid'],'categoryid')) unset($categoryid);
if (!isset($_GET['sponsorid']) || !setVar($sponsorid,$_GET['sponsorid'],'sponsorid')) unset($sponsorid);
if (!isset($_GET['keyword']) || !setVar($keyword,$_GET['keyword'],'keyword')) unset($keyword);
if (!isset($_GET['categoryfilter']) || !setVar($CategoryFilter,$_GET['categoryfilter'],'categoryfilter')) unset($CategoryFilter);
if (!isset($_GET['littlecal']) || !setVar($littlecal,$_GET['littlecal'],'littlecal')) unset($littlecal);
if (!isset($_GET['oldview']) || !setVar($oldview,$_GET['oldview'],'view')) unset($oldview);
if (!isset($_GET['page']) || !setVar($page,$_GET['page'],'page')) unset($page);

// Make sure the current view is allowed or possible.
if ( $view == "month" && !$enableViewMonth ) { $view="week"; }
if ( $view == "event" && !isset($eventid) ) { $view="week"; }

// Use month/year overrides for timebegin if they were passed as arguments.
if (isset($timebegin_month) && isset($timebegin_year)) {
	$timebegin=datetime2timestamp($timebegin_year,$timebegin_month,1,DAY_BEG_H,0,"am");
}
// Set default to today's date if necessary.
elseif (!isset($timebegin) || $timebegin=="today") {
	// use today's date as default
	$timebegin=datetime2timestamp($today['year'],$today['month'],$today['day'],DAY_BEG_H,0,"am");
}

// Set defaults if necessary for categoryid/sponsorid/keyword.
if (!isset($categoryid)) { $categoryid=0; }
if (!isset($sponsorid)) { $sponsorid="all"; }
if (!isset($keyword)) { $keyword=""; }

// Create a query string to be used when passing the categoryid/sponsorid/keyword to other pages.
$queryStringExtension = "";
if (isset($categoryid) && $categoryid != 0) { $queryStringExtension .= "&categoryid=".urlencode($categoryid); }
if (isset($sponsorid) && $sponsorid != "all") { $queryStringExtension .= "&sponsorid=".urlencode($sponsorid); }
if (!empty($keyword)) { $queryStringExtension .= "&keyword=".urlencode($keyword); }

// the week is specified by a single day, the whole week this day belongs to is displayed
$showdate = timestamp2datetime($timebegin);
$showdate['text'] = Encode_Date_US($showdate['month'],$showdate['day'],$showdate['year']);
$showdate['timestamp_daybegin']=datetime2timestamp($showdate['year'],$showdate['month'],$showdate['day'],DAY_BEG_H,0,"am");
$showdate['timestamp_dayend']  =datetime2timestamp($showdate['year'],$showdate['month'],$showdate['day'],DAY_END_H,59,"pm");

// If an override for the current month being viewed is set...
if (isset($littlecal)) {
	$littlecal=timestamp2datetime($littlecal);
	// determine the month
	$month['year']  = $littlecal['year'];
	$month['month'] = $littlecal['month'];
	$month['day']   = 1;
}
else {
	// determine the month from the currently shown date.
	$month['year']  = $showdate['year'];
	$month['month'] = $showdate['month'];
	$month['day']   = 1;
}

$month['text']  = Month_to_Text($month['month']);

$minus_one_month['day']   = 1;
$minus_one_month['month'] = $month['month'] - 1;
$minus_one_month['year']  = $month['year'];
if ($minus_one_month['month'] == 0) {
	$minus_one_month['month'] = 12;
	$minus_one_month['year']--;
}

$plus_one_month['day']   = 1;
$plus_one_month['month'] = $month['month'] + 1;
$plus_one_month['year']  = $month['year'];
if ($plus_one_month['month'] == 13) {
	$plus_one_month['month'] = 1;
	$plus_one_month['year']++;
}

// date of first Sunday or Monday according to week beginning day in month1
$month['dow'] = Day_of_Week($month['month'],1,$month['year']);

// $week_correction - variable to make one week correction according to week's starting weekday
if(WEEK_STARTING_DAY == 1 && $month['dow'] == 0){
	$week_correction=7;
}else{
	$week_correction=0;
}

$monthstart = Add_Delta_Days($month['month'],1,$month['year'],-$month['dow']+WEEK_STARTING_DAY-$week_correction);
$monthstart['timestamp'] = datetime2timestamp($monthstart['year'],$monthstart['month'],$monthstart['day'],DAY_BEG_H,0,"am");
$monthlastday = Add_Delta_Days($plus_one_month['month'],1,$plus_one_month['year'],-1);
$monthlastday['dow'] = Day_of_Week($monthlastday['month'],$monthlastday['day'],$monthlastday['year']);
$monthlastday['timestamp'] = datetime2timestamp($monthlastday['year'],$monthlastday['month'],$monthlastday['day'],DAY_END_H,59,"pm");
$monthend = Add_Delta_Days($monthlastday['month'],$monthlastday['day'],$monthlastday['year'],+6-$monthlastday['dow']+WEEK_STARTING_DAY);
$monthend['timestamp'] = datetime2timestamp($monthend['year'],$monthend['month'],$monthend['day'],DAY_END_H,59,"pm");
$month['timestamp'] = datetime2timestamp($month['year'],$month['month'],$month['day'],DAY_BEG_H,0,"am");

// when does this particular week start and end?
$dow = Day_of_Week($showdate['month'],$showdate['day'],$showdate['year']);
$weekfrom = Add_Delta_Days($showdate['month'],$showdate['day'],$showdate['year'],-$dow+WEEK_STARTING_DAY); //if WEEK_STARTING_DAY is 1 we get Monday as week's start
$weekto = Add_Delta_Days($showdate['month'],$showdate['day'],$showdate['year'],6-$dow+WEEK_STARTING_DAY); //if WEEK_STARTING_DAY is 1 we get Sunday week's end

// determine the number of days since 4713 BC, needed for date arithmatic
$weekfrom['jd'] = JulianToJD($weekfrom['month'],$weekfrom['day'],$weekfrom['year']);
$weekto['jd']   = JulianToJD($weekto['month'],$weekto['day'],$weekto['year']);

// construct timestamp for weekfrom & weekto
$weekfrom['timestamp']=datetime2timestamp($weekfrom['year'],$weekfrom['month'],$weekfrom['day'],DAY_BEG_H,0,"am");
$weekto['timestamp']  =datetime2timestamp($weekto['year'],$weekto['month'],$weekto['day'],DAY_END_H,59,"pm");

// determine the date of today minus/plus one week/month (important for navig. arrows)
$minus_one_week = Add_Delta_Days($showdate['month'],$showdate['day'],$showdate['year'],-7);
$plus_one_week  = Add_Delta_Days($showdate['month'],$showdate['day'],$showdate['year'],7);
?>