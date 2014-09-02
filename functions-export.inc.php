<?php
// translates text into XML text, writing entity names like "&amp;" instead of "&"
function text2xmltext($text) {
	return htmlspecialchars(ereg_replace("\'","&apos;",$text));
}

function GenerateRSS(&$result, $calendarID, $calendarTitle, $calendarurl, $timebegin = NULL) {
	$resultString = "";
	
	if ($timebegin === NULL) $timebegin = date("Y-m-d 00:00:00", NOW);
	
	$resultString .= '<?xml version="1.0"?>'."\n";
	$resultString .= '<rss version="0.91">'."\n";
	$resultString .= "<channel>\n";
	$resultString .= "<title>".text2xmltext($calendarTitle)."</title>\n";
	
	if (substr($timebegin,8,1) == "0") { $day = substr($timebegin,9,1); } 
	else { $day = substr($timebegin,8,2); }
	if (substr($timebegin,5,1) == "0") { $month = substr($timebegin,6,1); } 
	else { $month = substr($timebegin,5,2); }
	$date = $month."/".$day."/".substr($timebegin,0,4);
	
	$resultString .= "<description>".text2xmltext($date)."</description>\n";

	$resultString .= "<link>".text2xmltext($calendarurl)."?calendarid=".text2xmltext($calendarID)."</link>\n\n";
		
	if (!is_string($result)) {
		for ($i=0; $i < $result->numRows(); $i++) {
			$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			disassemble_timestamp($event);
			
			$resultString .= "<item>\n";
			$resultString .= "<title>".Month_to_Text_Abbreviation($event['timebegin_month'])." ".$event['timebegin_day'].": ".text2xmltext($event['title'])."</title>\n";
			$resultString .= "<link>".text2xmltext($calendarurl)."main.php?view=event&amp;calendarid=".text2xmltext($calendarID)."&amp;eventid=".text2xmltext($event['id'])."</link>\n";
			$resultString .= "<description>";
			if ($event['wholedayevent']==0) {
				$resultString .= text2xmltext(timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']). ": ");
			}
			else {
				$resultString .= "All day: ";
			}
			$resultString .= text2xmltext($event['category_name']);
			
			$resultString .= "</description>\n";
			$resultString .= "</item>\n";
		}
		$result->free();
	}
	
	$resultString .= "</channel>\n";
	$resultString .= "</rss>\n";
	
	return $resultString;
}

function GenerateRSS1_0(&$result, $calendarID, $calendarTitle, $calendarurl, $timebegin = NULL) {
	$resultString = "";
	
	if ($timebegin === NULL) $timebegin = date("Y-m-d 00:00:00", NOW);
	
	if (substr($timebegin,8,1) == "0") { $day = substr($timebegin,9,1); } 
	else { $day = substr($timebegin,8,2); }
	if (substr($timebegin,5,1) == "0") { $month = substr($timebegin,6,1); } 
	else { $month = substr($timebegin,5,2); }
	$date = $month."/".$day."/".substr($timebegin,0,4);
	
	// Header
	$resultString .= '<?xml version="1.0"?>' . "\n"
		. '<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"'
		. ' xmlns:rss091="http://purl.org/rss/1.0/modules/rss091#"'
		. ' xmlns:syn="http://purl.org/rss/1.0/modules/syndication/"'
		. ' xmlns:dc="http://purl.org/dc/elements/1.1/"'
		. ' xmlns="http://purl.org/rss/1.0/">' . "\n"
		. '<channel rdf:about="'. text2xmltext($calendarurl) . '?calendarid=' . text2xmltext($calendarID) . "\">\n"
		. '<link>'.  text2xmltext($calendarurl) . '?calendarid='.  text2xmltext($calendarID) . "</link>\n"

		. '<description>'. text2xmltext($date) . "</description>\n"
		. '<title>'. text2xmltext($calendarTitle) . "</title>\n"
		. "<items>\n"
		. "<rdf:Seq>\n";
	
	if (!is_string($result)) {
		for ($i=0; $i < $result->numRows(); $i++) {
			$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			$resultString .= '<rdf:li resource="'.text2xmltext($calendarurl)."main.php?view=event&amp;calendarid=".text2xmltext($calendarID)."&amp;eventid=".text2xmltext($event['id'])."\"/>\n";
		}
	}
	
	$resultString .= "</rdf:Seq>\n"
		. "</items>\n"
		. "</channel>\n";
	
	if (!is_string($result)) {
		for ($i=0; $i < $result->numRows(); $i++) {
			$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			disassemble_timestamp($event);
			$resultString .= "<item rdf:about=\"".text2xmltext($calendarurl)."main.php?view=event&amp;calendarid=".text2xmltext($calendarID)."&amp;eventid=".text2xmltext($event['id'])."\">\n";
			$resultString .= "<link>".text2xmltext($calendarurl)."main.php?view=event&amp;calendarid=".text2xmltext($calendarID)."&amp;eventid=".text2xmltext($event['id'])."</link>\n";
			$resultString .= "<title>".Month_to_Text_Abbreviation($event['timebegin_month'])." ".$event['timebegin_day'].": ".text2xmltext($event['title'])."</title>\n";
			$resultString .= "<description>";
			if ($event['wholedayevent']==0) {
				$resultString .= text2xmltext(timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']). ": ");
			}
			else {
				$resultString .= "All day: ";
			}
			$resultString .= text2xmltext($event['category_name'])."</description>\n";
			$resultString .= "</item>\n";
		}
		
		$result->free();
	}

	$resultString .= "</rdf:RDF>\n";
	
	return $resultString;
}

function GenerateRSS2_0(&$result, $calendarID, $calendarTitle, $calendarurl, $selfurl = "", $timebegin = NULL) {
	$resultString = "";
	
	if ($timebegin === NULL) $timebegin = date("Y-m-d 00:00:00", NOW);
	
	$resultString .= '<?xml version="1.0"?>'."\n";
	$resultString .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">'."\n";
	$resultString .= "<channel>\n";
	$resultString .= "<title>".text2xmltext($calendarTitle)."</title>\n";
	$resultString .= "<link>".text2xmltext($calendarurl)."?calendarid=".text2xmltext($calendarID)."</link>\n";
	$resultString .= "<pubDate>".gmdate("r", NOW)."</pubDate>\n";
	$resultString .= "<lastBuildDate>".gmdate("r", NOW)."</lastBuildDate>\n";
	$resultString .= "<generator>VTCalendar".(defined("VERSION") ? " ".VERSION : "")."</generator>\n";
	$resultString .= '<atom:link href="'.text2xmltext($selfurl).'" rel="self" type="application/rss+xml" />'."\n";
	
	if (substr($timebegin,8,1) == "0") { $day = substr($timebegin,9,1); } 
	else { $day = substr($timebegin,8,2); }
	if (substr($timebegin,5,1) == "0") { $month = substr($timebegin,6,1); } 
	else { $month = substr($timebegin,5,2); }
	$date = $month."/".$day."/".substr($timebegin,0,4);
	
	$resultString .= "<description>".text2xmltext($date)."</description>\n";
	
	if (defined("CACHEMINUTES"))
		$resultString .= "<ttl>".CACHEMINUTES."</ttl>\n";
		
	if (!is_string($result)) {
		for ($i=0; $i < $result->numRows(); $i++) {
			$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			disassemble_timestamp($event);
			
			$resultString .= "<item>\n";
			$resultString .= "<title>".Month_to_Text_Abbreviation($event['timebegin_month'])." ".$event['timebegin_day'].": ".text2xmltext($event['title'])."</title>\n";
			$resultString .= "<link>".text2xmltext($calendarurl)."main.php?view=event&amp;calendarid=".text2xmltext($calendarID)."&amp;eventid=".text2xmltext($event['id'])."</link>\n";
			$resultString .= "<guid>".text2xmltext($calendarurl)."main.php?view=event&amp;calendarid=".text2xmltext($calendarID)."&amp;eventid=".text2xmltext($event['id'])."</guid>\n";
			$resultString .= "<category>".text2xmltext($event['category_name'])."</category>\n";
			$resultString .= "<description>&lt;em&gt;";
			if ($event['wholedayevent']==0) {
				$resultString .= text2xmltext(timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']). ": ");
			}
			else {
				$resultString .= "All day: ";
			}
			$resultString .= text2xmltext($event['category_name']).'&lt;/em&gt;';
	
			if ($event['description'] != "") {
				$resultString .= text2xmltext('<br/>' . preg_replace("/((\r\n)|[\r\n])/", "<br/>", make_clickable($event['description'])));
			}
			
			$resultString .= "</description>\n";
			$resultString .= "</item>\n";
		}
		$result->free();
	}
	
	$resultString .= "</channel>\n";
	$resultString .= "</rss>\n";
	return $resultString;
}

function GenerateXML(&$result, $calendarID, $calendarTitle, $calendarurl) {
	$resultString = "";
	
	$resultString .= '<?xml version="1.0"?>'."\n";
	$resultString .= "<events>\n";
	for ($i=0; $i < $result->numRows(); $i++) {
		$event = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);

		unset($repeat);
		// read in repeatid if necessary
		if (!empty($event['repeatid'])) {
			//$queryRepeat = "SELECT * FROM ".SCHEMANAME."vtcal_event_repeat WHERE calendarid='".sqlescape($calendarID)."' AND id='".sqlescape($event['repeatid'])."'";
			$queryRepeat = "SELECT * FROM ".SCHEMANAME."vtcal_event_repeat WHERE id='".sqlescape($event['repeatid'])."'";
			if (is_string($repeatresult =& DBQuery($queryRepeat))) { return ""; }
			if ( $repeatresult->numRows () > 0 ) {
				$repeat =& $repeatresult->fetchRow(DB_FETCHMODE_ASSOC,0);
			}
		}

		// convert some data fields
		$date = substr($event['timebegin'],0,10);
		$timebegin = substr($event['timebegin'],11,5);
		$timeend = substr($event['timeend'],11,5);
		
		// output XML code
		$resultString .= "<event>\n";
		$resultString .= "<eventid>".$event['id']."</eventid>\n";
		$resultString .= "<sponsorid>".$event['sponsorid']."</sponsorid>\n";
		$resultString .= "<inputsponsor>".text2xmltext($event['sponsor_name'])."</inputsponsor>\n";
		$resultString .= "<displayedsponsor>".text2xmltext($event['displayedsponsor'])."</displayedsponsor>\n";
		$resultString .= "<displayedsponsorurl>".text2xmltext($event['displayedsponsorurl'])."</displayedsponsorurl>\n";
		$resultString .= "<date>".$date."</date>\n";
		$resultString .= "<timebegin>".$timebegin."</timebegin>\n";
		$resultString .= "<timeend>".$timeend."</timeend>\n";
		$resultString .= "<repeat_vcaldef>";
		if (!empty($repeat['repeatdef'])) { $resultString .= $repeat['repeatdef']; }
		$resultString .= "</repeat_vcaldef>\n";
		$resultString .= "<repeat_startdate>";
		if (!empty($repeat['startdate'])) { $resultString .= substr($repeat['startdate'],0,10); }
		$resultString .= "</repeat_startdate>\n";
		$resultString .= "<repeat_enddate>";
		if (!empty($repeat['enddate'])) { $resultString .= substr($repeat['enddate'],0,10); }
		$resultString .= "</repeat_enddate>\n";
		$resultString .= "<categoryid>".$event['categoryid']."</categoryid>\n";
		$resultString .= "<category>".text2xmltext($event['category_name'])."</category>\n";
		$resultString .= "<title>".text2xmltext($event['title'])."</title>\n";
		$resultString .= "<description>".text2xmltext($event['description'])."</description>\n";
		$resultString .= "<location>".text2xmltext($event['location'])."</location>\n";
		$resultString .= "<price>".text2xmltext($event['price'])."</price>\n";
		$resultString .= "<contact_name>".text2xmltext($event['contact_name'])."</contact_name>\n";
		$resultString .= "<contact_phone>".text2xmltext($event['contact_phone'])."</contact_phone>\n";
		$resultString .= "<contact_email>".text2xmltext($event['contact_email'])."</contact_email>\n";
		$resultString .= "<url></url>\n";
		$resultString .= "<recordchangedtime>".substr($event['recordchangedtime'],0,19)."</recordchangedtime>\n";
		$resultString .= "<recordchangeduser>".$event['recordchangeduser']."</recordchangeduser>\n";
		$resultString .= "</event>\n";
	}
	$resultString .= "</events>\n";
	
	return $resultString;
}

function GenerateICal(&$result, $calendarName, $calendarURL) {
	$resultString = "";
	
	$icalname = "calendar";
	$icalname = preg_replace("/[^A-Za-z0-9_]/", "_", $calendarName);
	
	$resultString .= "BEGIN:VCALENDAR".CRLF;
	$resultString .= "VERSION:2.0".CRLF;
	$resultString .= "METHOD:PUBLISH".CRLF;
	$resultString .= "PRODID:-//Virginia Tech//VTCalendar//EN".CRLF;
	
	if (!is_string($result)) {

		// this is for Apple iCal since it does not take the calendar name from the .ics file name
		if ($result->numRows() > 0) {
			$resultString .= "X-WR-CALNAME;VALUE=TEXT:".$icalname.CRLF;	
		}
		
		for ($i=0; $i < $result->numRows(); $i++) {
			$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			$resultString .= GenerateICal4Event($event, $calendarURL);
		}
		$result->free();
	}
	
	$resultString .= "END:VCALENDAR".CRLF;
	
	return $resultString;
}

function GenerateVXML(&$result) {
	$resultString = "";
	
	$resultString .= '<?xml version="1.0"?>'."\n";
	$resultString .= '<vxml version="2.0">'."\n<form>\n<block>\n<prompt>\n";
	$resultString .= text2xmltext(lang('vxml_welcome'))." ";
	$resultString .= '<break size="medium"/>'."\n";
	$iNumEvents = $result->numRows();
	if ($iNumEvents > 0) {
		$resultString .= text2xmltext(lang('vxml_there_are')).' '.$iNumEvents.' '.text2xmltext(lang('vxml_events_for_today')).' '.text2xmltext(date("F j", NOW));
	}
	else {
		$resultString .= text2xmltext(lang('vxml_no_more_events')).' '.text2xmltext(date("F j", NOW));
	}
	
	if (date("j", NOW) == "1") { $resultString .= "st"; }
	elseif (date("j", NOW) == "2") { $resultString .= "nd"; }
	elseif (date("j", NOW) == "3") { $resultString .= "rd"; }
	else { $resultString .= "th"; }
	$resultString .= ".\n";
	
	$resultString .= '<break size="medium"/>'."\n";

	for ($i=0; $i < $iNumEvents; $i++) {
		$event = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
	
		if ($event['wholedayevent'] == '1') {
			$resultString .= text2xmltext(lang('all_day'));
		}
		else {
			$aTimeBegin = timestamp2datetime($event['timebegin']);
			$resultString .= $aTimeBegin['hour'];
			if ($aTimeBegin['min'] != "00") {
				$resultString .= " ".$aTimeBegin['min'];
			}
			$resultString .= strtoupper($aTimeBegin['ampm'])."\n";
		}
		$resultString .= '<break size="small"/>'."\n";
			
		$resultString .= text2xmltext($event['title'])."\n";
		
		$resultString .= '<break size="large"/>'."\n";
	}

	$resultString .= '<break size="large"/>'."\n";
	$resultString .= text2xmltext(lang('vxml_goodbye'))."\n";

	$resultString .= "\n</prompt>\n</block>\n</form>\n</vxml>\n";
	
	return $resultString;
}

function GenerateJSArray(&$result, $calendarID, $calendarurl) {
	$resultString = "";
	
	$fields = explode(' ', 'title link timebegin timeend wholedayevent location sponsorid sponsor_name displayedsponsor categoryid category_name description');
	$resultString .= "document.VTCal_EventFields = ['".implode("','", $fields)."'];\n";
	
	$resultString .= 'function VTCal_GetFieldIndex(field) {'."\n";
	$resultString .= "\t".'switch (field) {'."\n";
	for ($i=0; $i < count($fields); $i++) {
		$resultString .= "\t\tcase '".$fields[$i]."': return " . $i . ";\n";
	}
	$resultString .= "\t\tdefault: return -1;\n";
	$resultString .= "\t}\n";
	$resultString .= "}\n";
	
	$resultString .= "document.VTCal_EventData = [];\n";
	
	if (!is_string($result)) {
		for ($i=0; $i < $result->numRows(); $i++) {
			$event =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			
			$resultString .= "document.VTCal_EventData[".$i."] = ["
				."'".escapeJavaScriptString($event['title'])."'"
				.",'".escapeJavaScriptString($calendarurl."main.php?view=event&amp;calendarid=".text2xmltext($calendarID)."&amp;eventid=".text2xmltext($event['id']))."'"
				.",'".escapeJavaScriptString($event['timebegin'])."'"
				.",'".escapeJavaScriptString($event['timeend'])."'"
				.",".($event['wholedayevent'] == '1' ? 'true' : 'false')
				.",'".escapeJavaScriptString($event['location'])."'"
				.",'".escapeJavaScriptString($event['sponsorid'])."'"
				.",'".escapeJavaScriptString($event['sponsor_name'])."'"
				.",'".escapeJavaScriptString($event['displayedsponsor'])."'"
				.",'".escapeJavaScriptString($event['categoryid'])."'"
				.",'".escapeJavaScriptString($event['category_name'])."'"
				.",'".escapeJavaScriptString($event['description'])."'];\n";
		}
	}
	
	return $resultString;
}

function GenerateHTML(&$result, $calendarID, $calendarurl, &$FormData) {
	$resultString = "";
	$linkCategoryFilter = isset($FormData['categories']) && isset($FormData['keepcategoryfilter']) ? "&categoryfilter=" . urlencode(implode(',', $FormData['categories'])) : '';
	
	if ($FormData['htmltype'] == "paragraph") {
		if ($result->numRows() == 0) {
			$resultString = '<p class="VTCAL_NoEvents"><i>There are no upcoming events.</i></p>';
		}
		else {
			$ievent = 0;
			while ($ievent < $result->numRows()) {
				$event = $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
				
				$resultString = $resultString.'<p><b><a href="'.BASEURL.'main.php?calendarid='.urlencode($calendarID).'&view=event&eventid='.urlencode($event['id']).'&timebegin='.urlencode($event['timebegin']).$linkCategoryFilter.'"';
				
				if (isset($FormData['maxtitlecharacters']) && ($FormData['maxtitlecharacters'] < strlen($event['title']))) {
					$resultString = $resultString.' title="'.htmlentities($event['title']).'">'.htmlentities(trim(substr($event['title'],0,$FormData['maxtitlecharacters']))).'</a>...</b>';
				}
				else {
					$resultString = $resultString.'>'.htmlentities($event['title']).'</a></b>';
				}
				
				if ($FormData['showdatetime'] == '1') {
					$resultString = $resultString."<br>\n";
					$resultString = $resultString.htmlentities(FormatDate($FormData['dateformat'], dbtime2tick($event['timebegin'])));
					
					$ReturnTime = FormatTimeDisplay($event, $FormData);
					if ($FormData['showallday'] == '1' || ($FormData['showallday'] == '0' && $ReturnTime != "All Day")) {
						$resultString = $resultString.' - '.htmlentities($ReturnTime);
					}
				}
				
				if ($event['location'] != "" && $FormData['showlocation'] == '1') {
					$resultString = $resultString."<br>\n<i";
					if (isset($FormData['maxlocationcharacters']) && ($FormData['maxlocationcharacters'] < strlen($event['location']))) {
						$resultString = $resultString.' title="'.htmlentities($event['location']).'">'.htmlentities(trim(substr($event['location'],0,$FormData['maxlocationcharacters']))).'...';
					}
					else {
						$resultString = $resultString.'>'.htmlentities($event['location']);
					}
					$resultString = $resultString.'</i>';
				}
				$resultString = $resultString."</p>\n\n";
				
				$ievent++;
			}
		}
	}
	elseif ($FormData['htmltype'] == "table") {
		$resultString = $resultString.'<table class="VTCAL" border="0" cellspacing="0" cellpadding="4">'."\n\n";
		
		if ($result->numRows() == 0) {
			$resultString = $resultString.'<tr><td class="VTCAL_NoEvents" colspan="2">There are no upcoming events.</td></tr>';
		}
		else {
			$ievent = 0;
			while ($ievent < $result->numRows()) {
				$event = $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
				
				$resultString = $resultString."<tr>\n";
				
				if ($FormData['showdatetime'] == '1') {
					$resultString = $resultString.'<td class="VTCAL_DateTime" valign="top">'.htmlentities(FormatDate($FormData['dateformat'], dbtime2tick($event['timebegin'])));
					
					$ReturnTime = FormatTimeDisplay($event, $FormData);
					if ($FormData['showallday'] == '1' || ($FormData['showallday'] == '0' && $ReturnTime != "All Day")) {
						$resultString = $resultString.'<br><span>'.htmlentities($ReturnTime)."</span>";
					}
					
					$resultString = $resultString."</td>\n";
				}
				
				$resultString = $resultString.'<td class="VTCAL_TitleLocation" valign="top"><b><a href="'.BASEURL.'main.php?calendarid='.urlencode($calendarID).'&view=event&eventid='.urlencode($event['id']).'&timebegin='.urlencode($event['timebegin']).$linkCategoryFilter.'"';
				
				if (isset($FormData['maxtitlecharacters']) && ($FormData['maxtitlecharacters'] < strlen($event['title']))) {
					$resultString = $resultString.' title="'.htmlentities($event['title']).'">'.htmlentities(trim(substr($event['title'],0,$FormData['maxtitlecharacters']))).'</a>...</b>';
				}
				else {
					$resultString = $resultString.'>'.htmlentities($event['title']).'</a></b>';
				}
					
				if ($event['location'] != "" && $FormData['showlocation'] == '1') {
					$resultString = $resultString."<br>\n<i";
					if (isset($FormData['maxlocationcharacters']) && ($FormData['maxlocationcharacters'] < strlen($event['location']))) {
						$resultString = $resultString.' title="'.htmlentities($event['location']).'">'.htmlentities(trim(substr($event['location'],0,$FormData['maxlocationcharacters']))).'...';
					}
					else {
						$resultString = $resultString.'>'.htmlentities($event['location']);
					}
					$resultString = $resultString.'</i>';
				}
				
				$resultString = $resultString."</td>\n</tr>\n\n";
				
				$ievent++;
			}
		}
		
		$resultString = $resultString."</table>\n\n";
	}
	elseif ($FormData['htmltype'] == "MAINSITE") {
		if ($result->numRows() == 0) {
			$resultString = '<p align="center"><i>No upcoming events.</i></p>';
		}
		else {
			$ievent = 0;
			while ($ievent < $result->numRows()) {
				$event = $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
				
				$resultString = $resultString.'<p id="VTCAL_EventNum'.($ievent+1).'"><a href="'.BASEURL.'main.php?calendarid='.urlencode($calendarID).'&view=event&eventid='.urlencode($event['id']).'&timebegin='.urlencode($event['timebegin']).$$linkCategoryFilter.'">';
				$resultString = $resultString.'<b>'.htmlentities(FormatDate($FormData['dateformat'], dbtime2tick($event['timebegin']))).
					'<br>'.htmlentities(FormatTimeDisplay($event, $FormData))."<b><br></b></b>\n";
				
				$resultString = $resultString.'<span><u';
				if (isset($FormData['maxtitlecharacters']) && ($FormData['maxtitlecharacters'] < strlen($event['title']))) {
					$resultString = $resultString.' title="'.htmlentities($event['title']).'">'.htmlentities(trim(substr($event['title'],0,$FormData['maxtitlecharacters']))).'...';
				}
				else {
					$resultString = $resultString.'>'.htmlentities($event['title']);
				}
				$resultString = $resultString."</u><br>\n";
				
				if ($event['location'] != "" && $FormData['showlocation'] == '1') {
					$resultString = $resultString."<i";
					if (isset($FormData['maxlocationcharacters']) && ($FormData['maxlocationcharacters'] < strlen($event['location']))) {
						$resultString = $resultString.' title="'.htmlentities($event['location']).'">'.htmlentities(trim(substr($event['location'],0,$FormData['maxlocationcharacters']))).'...';
					}
					else {
						$resultString = $resultString.'>'.htmlentities($event['location']);
					}
					$resultString = $resultString.'</i>';
				}
				else {
					$resultString = $resultString.'<i>&nbsp;</i>';
				}
				
				$resultString = $resultString."</span></a></p>\n\n";
				
				$ievent++;
			}
		}
	}
	
	return $resultString;
}

function FormatICalText($text) {
	$ical = "";
	$nl_at_nextspace = 0;
	for ($i=0; $i < strlen($text); $i++) {
		$c = substr($text, $i, 1);
		if ($i>0 && $i/45==floor($i/45)) { $nl_at_nextspace = 1; }
		if ($c==" " && $nl_at_nextspace) { $ical .= " ".CRLF." "; $nl_at_nextspace = 0; }
		elseif ($c==chr(13)) { $ical .= "\\n".CRLF." "; $i++; }
		else { $ical .= $c; }
	}
	
	return $ical;
} // end: FormatICalText

function GenerateICal4Event(&$event, $calendarURL) {
	disassemble_timestamp($event);

	$dtstart = date("Ymd\\THis", GetUTCTime(mktime(
		intval($event['timebegin_ampm'] == "am" ? ($event['timebegin_hour'] == 12 ? 0 : $event['timebegin_hour']) : ($event['timebegin_hour'] == 12 ? $event['timebegin_hour'] : $event['timebegin_hour']+12)),
		intval($event['timebegin_min']),
		0,
		intval($event['timebegin_month']),
		intval($event['timebegin_day']),
		intval($event['timebegin_year']))));

	$dtend = date("Ymd\\THis", GetUTCTime(mktime(
		intval($event['timeend_ampm'] == "am" ? ($event['timeend_hour'] == 12 ? 0 : $event['timeend_hour']) : ($event['timeend_hour'] == 12 ? $event['timeend_hour'] : $event['timeend_hour']+12)),
		intval($event['timeend_min']),
		0,
		intval($event['timeend_month']),
		intval($event['timeend_day']),
		intval($event['timeend_year']))));

	$ical = "BEGIN:VEVENT".CRLF;
	$ical.= "DTSTAMP:".$dtstart."Z".CRLF;
	$ical.= "UID:".$event['id']."@".$calendarURL.CRLF;
	$ical.= "CATEGORIES:".$event['category_name'].CRLF;
	if ($event['wholedayevent']==1) {
		$ical.= "DTSTART;VALUE=DATE:".substr($dtstart,0,8).CRLF;
		$ical.= "DTEND;VALUE=DATE:".substr($dtend,0,8).CRLF;
	}
	else {
		$ical.= "DTSTART:".$dtstart."Z".CRLF;
		$ical.= "DTEND:".$dtend."Z".CRLF;
	}
	$ical.= "SUMMARY:".$event['title'].CRLF;

	$ical.= "DESCRIPTION:".CRLF." ";
	if (!empty($event['description'])) {
		$ical.= FormatICalText($event['description']);
		$ical.= "\\n\\n".CRLF;
	}
	if (!empty($event['price'])) {
		$ical.= " ".lang('price').": ";
		$ical.= FormatICalText($event['price']);
		$ical.= "\\n".CRLF;
	}
	if (!empty($event['sponsor_name'])) {
		$ical.= " ".lang('sponsor').": ";
		$ical.= FormatICalText($event['sponsor_name']);
		$ical.= "\\n".CRLF;
	}
	if (!(empty($event['sponsor_url']) || $event['sponsor_url']=="http://")) {
		$ical.= " ".lang('homepage').": ";
		$ical.= FormatICalText($event['sponsor_url']);
		$ical.= "\\n".CRLF;
	}
	if (!empty($event['contact_name'])) {
		$ical.= " ".lang('contact').": ";
		$ical.= FormatICalText($event['contact_name']);
		$ical.= "\\n".CRLF;
	}
	if (!empty($event['contact_phone'])) {
		$ical.= " ".lang('phone').": ";
		$ical.= FormatICalText($event['contact_phone']);
		$ical.= "\\n".CRLF;
	}
	if (!empty($event['contact_email'])) {
		$ical.= " ".lang('email').": ";
		$ical.= FormatICalText($event['contact_email']);
		$ical.= "\\n".CRLF;
	}

	if (!empty($event['location'])) {
		$ical.= "LOCATION:".$event['location'].CRLF;
	}
	$ical.= "END:VEVENT".CRLF;
	
	return $ical;
} // end: function GenerateICal4Event
?>