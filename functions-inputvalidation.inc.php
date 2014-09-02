<?php
// checks the input against regular expressions
function isValidInput($value, $type) {
	if (!isset($value)) { 
		return FALSE; 
	}
	
	if ($type=='approveall') {
		if ($value=='1') { return TRUE; }
	}
	elseif ($type=='approveallevents') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='approvethis') {
		if ($value=='1') { return TRUE; }
	}
	elseif ($type=='calendarFooter') { // needs refinement
		return TRUE;
	}
	elseif ($type=='calendarHeader') { // needs refinement
		return TRUE;
	}
	elseif ($type=='calendarHTMLHeader') { // needs refinement
		return TRUE;
	}
	elseif ($type=='calendarid') {
		if (preg_match('/^[A-Z0-9\-\.]{1,'.MAXLENGTH_CALENDARID.'}$/i',$value)) { return TRUE; }
	}
	elseif ($type=='calendarTitle') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_CALENDARTITLE.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='cancel') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='categoryid') {
		if (is_numeric($value) && $value>=0 && $value<=100000) { return TRUE; }
	}
	elseif ($type=='categoryidlist') {
		// TODO: is '== 1' correct? This was '== 0' but that didn't seem to make sense.
		return preg_match('/^[0-9]+(,[0-9]+)*$/', $value) == 1;
	}
	elseif ($type=='category_name') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_SPACES.']{1,'.MAXLENGTH_CATEGORY_NAME.'}$/i',$value)) { return TRUE; }
	}
	elseif ($type=='calendarname') {
		if (preg_match('/^[A-Z0-9\-\.\&\' ,]{1,'.MAXLENGTH_CALENDARNAME.'}$/i',$value)) { return TRUE; }
	}
	elseif ($type=='check') {
		if ($value=='1') { return TRUE; }
	}
	elseif ($type=='choosetemplate') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='chooseuser') {
		if ($value=='0' || $value=='1') { return TRUE; }
	}
	elseif ($type=='color') {
		if (preg_match('/^#[0-9a-fA-F]{6,6}$/',$value)) { return TRUE; }
	}
	elseif ($type=='background') {
		// TODO: Does this need improving?
		return true;
	}
	elseif ($type=='contact_name') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_CONTACT_NAME.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='contact_phone') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_CONTACT_PHONE.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='contact_email') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_EMAIL.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='copy') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='delete') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='deleteall') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='deleteconfirmed') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='deleteevents') {
		if ($value == '0' || $value == '1') { return TRUE; }
	}
	elseif ($type=='deletethis') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='deleteuser') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='description') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_DESCRIPTION.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='displayedsponsor') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_DISPLAYEDSPONSOR.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='duration') {
		if ($value=='1' || $value=='2' || $value=='3') { return TRUE; }
	}
	elseif ($type=='edit') { // 'Go back and make changes' button
		if (strlen($value) > 1) { return TRUE; }
	}
	elseif ($type=='email') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_EMAIL.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='eventid') { // e.g. "1064818293904-0017"
		if (preg_match('/^[0-9]{13}$/',$value) || preg_match('/^[0-9]{13}-[0-9]{4}$/',$value)) { return TRUE; }
	}
	elseif ($type=='eventidlist') { // e.g. "1064818293904,1064818293934-0002"
		if (!empty($value)) {
			$eventids=split(",",$value);
			for ($i=0; $i<count($eventids); $i++) {
				$eventid = $eventids[$i];
				if (!isValidInput($eventid, 'eventid')) { return FALSE; }
			}
			return TRUE;
		}
	}
	elseif ($type=='featuretext') { // needs refinement
		return TRUE;
	}
	elseif ($type=='categoryfilter') { // Array of category ids, e.g. [0]=>5, [1]=>7, [2]=>12
		if (is_string($value)) {
			if (strlen($value) > 1000) { return FALSE; }
			$categoryids = split(",",$value);
			if (count($categoryids)==0) { return TRUE; }
			foreach($categoryids as $categoryid) {
				if (!isValidInput($categoryid, 'categoryid')) { return FALSE; }
			}
			return TRUE;
		}
		
		elseif (is_array($value)) {
			if (count($value)==0) { return TRUE; }
			if (count($value) > 1000) { return FALSE; }
			foreach ($value as $categoryid) {
				if (!isValidInput($categoryid, 'categoryid')) { return FALSE; }
			}
			return TRUE;
		}
		
		else {
			return false;
		}
	}
	elseif ($type=='forwardeventdefault') {
		if ($value=='1') { return TRUE; }
	}
	elseif ($type=='frequency1') {
		if ($value=='day' || $value=='week' || $value=='month' || $value=='year' || $value=='monwedfri' || $value=='tuethu' || $value=='montuewedthufri' || $value=='satsun'
			|| $value=='sunday' || $value=='monday' || $value=='tuesday' || $value=='wednesday' || $value=='thursday' || $value=='friday' || $value=='saturday') { return TRUE; }
	}
	elseif ($type=='frequency2modifier1') {
		if ($value=='first' || $value=='second' || $value=='third' || $value=='fourth' || $value=='last') { return TRUE; }
	}
	elseif ($type=='frequency2modifier2') {
		if ($value=='sun' || $value=='mon' || $value=='tue' || $value=='wed' || $value=='thu' || $value=='fri' || $value=='sat') { return TRUE; }
	}
	elseif ($type=='httpreferer') { // note: need to design a better test
		if (strlen($value)<500) { return TRUE; }
	}
	elseif ($type=='importurl') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_IMPORTURL.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='interval1') {
		if ($value=='every' || $value=='everyother' || $value=='everythird' || $value=='everyfourth') { return TRUE; }
	}
	elseif ($type=='interval2') {
		if ($value=='month' || $value=='2months' || $value=='3months' || $value=='4months' || $value=='6months' || $value=='year') { return TRUE; }
	}
	elseif ($type=='keyword') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_KEYWORD.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='location') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_LOCATION.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='mode') { // repeat['mode']
		if (is_numeric($value) && $value>=0 && $value<=10) { return TRUE; }
	}
	elseif ($type=='password') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR.']{1,'.MAXLENGTH_PASSWORD.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='preview') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='price') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_PRICE.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='reject') {
		if ($value=='1') { return TRUE; }
	}
	elseif ($type=='rejectconfirmedall') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='rejectconfirmedthis') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='rejectreason') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,500}$/',$value)) { return TRUE; }
	}
	elseif ($type=='repeatid') { // e.g. "1064818293904"
		if (preg_match('/^[0-9]{13}$/',$value)) { return TRUE; }
	}
	elseif ($type=='repeatdef') { // e.g. "D1 20040629T235900"
		if (preg_match('/^[A-Z 0-9\+\-]{0,100}$/',$value)) { return TRUE; }
	}
	elseif ($type=='save') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='savetemplate') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='savethis') { // 'Save changes' button
		if (strlen($value) > 1) { return TRUE; }
	}
	elseif ($type=='searchkeywordid') {
		if (is_numeric($value) && $value>=0 && $value<=100000) { return TRUE; }
	}
	elseif ($type=='showondefaultcal') {
		if ($value=='0' || $value=='1') { return TRUE; }
	}
	elseif ($type=='sponsorid') {
		if ($value=='all' || (is_numeric($value) && $value>=1 && $value<=100000)) { return TRUE; }
	}
	elseif ($type=='sponsor_admins') { // needs refinement, allow newlines
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,500}$/',$value)) { return TRUE; }
	}
	elseif ($type=='sponsor_email') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,100}$/',$value)) { return TRUE; }
	}
	elseif ($type=='sponsor_name') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,100}$/',$value)) { return TRUE; }
	}
	elseif ($type=='sponsor_url') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_URL.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='startimport') {
		if (!empty($value)) { return TRUE; }
	}
	elseif ($type=='templateid') {
		if (is_numeric($value) && $value>=0 && $value<=100000) { return TRUE; }
	}
	elseif ($type=='template_name') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_TEMPLATE_NAME.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='timebegin' || $type=='timeend' || $type=='littlecal') { // e.g. "2004-05-26 00:00:00" or "today"
		if ($value=='today' || $value=='now') { return TRUE; }
		if (strlen($value)==19 && isDate(substr($value,0,10)) && $value{0} && isTime(substr($value,11,8))) { return TRUE; }
	}
	elseif ($type=='timebegin_year' || $type=='timeend_year') {
		if (is_numeric($value) && $value>=1900 && $value<=2100) { return TRUE; }
	}
	elseif ($type=='timebegin_month' || $type=='timeend_month') {
		if (is_numeric($value) && $value>=1 && $value<=12) { return TRUE; }
	}
	elseif ($type=='timebegin_day' || $type=='timeend_day') {
		if (is_numeric($value) && $value>=1 && $value<=31) { return TRUE; }
	}
	elseif ($type=='timebegin_hour' || $type=='timeend_hour') {
		if (is_numeric($value) && ( ($value>=1 && $value<=12 && USE_AMPM) || ($value>=0 && $value<=23 && !USE_AMPM) )) { return TRUE; }
	}
	elseif ($type=='timebegin_min' || $type=='timeend_min') {
		if (is_numeric($value) && $value>=0 && $value<=59) { return TRUE; }
	}
	elseif ($type=='timebegin_ampm' || $type=='timeend_ampm') {
		if ($value=='am' || $value=='pm') { return TRUE; }
	}
	elseif ($type=='title') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_TITLE.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='viewauthrequired') {
		if ($value=='0' || $value=='1' || $value=='2') { return TRUE; }
	}
	elseif ($type=='url') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_URL.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='userid') {
		if (preg_match(REGEXVALIDUSERID,$value)) { return TRUE; }
	}
	elseif ($type=='users') { // needs refinement, allow newlines
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,2000}$/',$value)) { return TRUE; }
	}
	elseif ($type=='view') {
		return ($value=='upcoming' || $value=='day' || $value=='week' || $value=='month' || $value=='search' || $value=='searchresults' || $value=='event' || $value=='subscribe' || $value=='filter' || $value=='export');
	}
	elseif ($type=='wholedayevent') {
		if ($value=='0' || $value=='1') { return TRUE; }
	}
	elseif ($type=='page') {
		if (is_numeric($value) && $value > 0) { return TRUE; }
	}
	
	/* =========================================================
	                      Generic Types
	========================================================= */
	
	// Used for two radio <input> where one is yes and the other is no.
	elseif ($type=='boolean') {
		if ($value === '1' || $value === '0') { return TRUE; }
	}
	
	// Used for a checkbox <input> where it does not submit a value if not checked.
	elseif ($type=='boolean_checkbox') {
		if ($value === '1') { return TRUE; }
	}
	
	elseif ($type=='int') {
		return preg_match("/^-?[0-9]+$/", $value) === 1;
	}
	
	elseif ($type=='int_gte1') {
		if (preg_match("/^[0-9]+$/", $value) && intval($value) >= 1) { return TRUE; }
	}
	
	/* =========================================================
	                   Export Page Validation
	========================================================= */
	
	elseif ($type=='type') {
		if ($value=="xml" || $value=="rss" || $value=="ical" || $value=="rss1_0" || $value=="vxml") { return TRUE; }
	}
	elseif ($type=='exportformat') {
		if ($value=="html" || $value=="js" || $value=="xml" || $value=="rss" || $value=="ical" || $value=="rss1_0" || $value=="rss2_0" || $value=="vxml") { return TRUE; }
	}
	elseif ($type=='rangedays') {
		if (is_numeric($value) && $value>=1 && $value<=100000) { return TRUE; }
	}
	elseif ($type=='sponsortype') {
		if ($value == 'all' || $value == 'self' || $value == 'specific') { return TRUE; }
	}
	elseif ($type=='specificsponsor') {
		if (preg_match('/^['.REGEX_VALIDTEXTCHAR_WITH_WHITESPACE.']{1,'.MAXLENGTH_SPECIFICSPONSOR.'}$/',$value)) { return TRUE; }
	}
	elseif ($type=='htmltype') {
		if ($value == 'table' || $value == 'paragraph' || $value == 'mainsite') { return TRUE; }
	}
	elseif ($type=='dateformat') {
		return preg_match("/^(huge|long|normal|short|tiny|micro)$/", $value) === 1;
	}
	elseif ($type=='timedisplay') {
		return preg_match("/^(start|startendlong|startendnormal|startendtiny|startdurationlong|startdurationnormal|startdurationshort)$/", $value) === 1;
	}
	elseif ($type=='timeformat') {
		return preg_match("/^(huge|long|normal|short)$/", $value) === 1;
	}
	elseif ($type=='durationformat') {
		return preg_match("/^(long|normal|short|tiny|micro)$/", $value) === 1;
	}
	
	return FALSE;
}

// returns TRUE if $value is of format e.g. "2004-05-26" otherwise FALSE
function isDate($value) {
	if (strlen($value)!=10) { return FALSE; }
	elseif ($value{4}!='-' || $value{7}!='-') { return FALSE; }
	else {
		return checkdate(substr($value,5,2),substr($value,8,2),substr($value,0,4));
	}
}

// returns TRUE if $value is of format e.g. "14:34:22" otherwise FALSE
function isTime($value) {
	if (strlen($value)!=8) { return FALSE; }
	elseif ($value{2}!=':' || $value{5}!=':') { return FALSE; }
	else {
		$hour = substr($value,0,2);
		$min = substr($value,3,2);
		$sec = substr($value,6,2);
		if (
			$hour{0}>='0' && $hour{0}<='2' &&
			$hour{1}>='0' && $hour{1}<='9' && 
			intval($hour)>=0 && intval($hour)<=24 &&
			$min{0}>='0' && $min{0}<='5' &&
			$min{1}>='0' && $min{1}<='9' && 
			$sec{0}>='0' && $sec{0}<='5' &&
			$sec{1}>='0' && $sec{1}<='9'
		) {
			return TRUE;
		}
	}
	return FALSE;
}
?>