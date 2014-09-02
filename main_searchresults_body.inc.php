<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
?>
<form method="get" action="main.php" style="margin: 0; padding: 0;">
<input type="hidden" name="calendarid" value="<?php echo htmlentities($_SESSION['CALENDAR_ID']) ?>">
<input type="hidden" name="view" value="search">
<p><input type="submit" value="&laquo; <?php echo lang('back_to_prev_page'); ?>"></p>
<table id="DayTable" width="100%" cellpadding="6" cellspacing="0" border="0">
<?php
if (isset($timebegin_year)) { // details was called from the searchform
	$timebegin = datetime2timestamp($timebegin_year,$timebegin_month,$timebegin_day,12,0,"am");
}
else { // details is called without any time limits, use "today" as default
	$timebegin = datetime2timestamp($today['year'],$today['month'],$today['day'],12,0,"am");
}
if (!isset($timeend) || $timeend=="today") {
	if (isset($timeend_year)) {
		$timeend = datetime2timestamp($timeend_year,$timeend_month,$timeend_day,11,59,"pm");
	}
	if (isset($timeend) && $timeend=="today") {
		$timeend = datetime2timestamp($today['year'],$today['month'],$today['day'],11,59,"pm");
	}
}

$ievent = 0;

$query = "SELECT e.id AS eventid,e.timebegin,e.timeend,e.sponsorid,e.title,e.location,e.description,e.wholedayevent,e.categoryid,c.id,c.name AS category_name FROM ".TABLEPREFIX."vtcal_event_public e, ".TABLEPREFIX."vtcal_category c ";
$query.= "WHERE e.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND c.calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND e.categoryid = c.id";

if (!empty($timebegin)) { $query.= " AND e.timebegin >= '".sqlescape($timebegin)."'"; }
if (!empty($timeend)) { $query.= " AND e.timeend <= '".sqlescape($timeend)."'"; }

if ( isset($CategoryFilter) && count($CategoryFilter) > 0 ) {
	$query.= " AND (";
	for($c=0; $c < count($CategoryFilter); $c++) {
		if ($c > 0) { $query.=" OR "; }
		$query.= "(e.categoryid='".sqlescape($CategoryFilter[$c])."')";
		}
	$query.= ")";
}
else {
	 if (isset($categoryid) && $categoryid != 0) { $query.= " AND (e.categoryid='".sqlescape($categoryid)."')"; }
}

if (!empty($keyword)) {
	$keywords = split ( " ", $keyword );
		
	// read alternative keywords from database
	$r =& DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_searchkeyword WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."'" );
	
	for ($i=0; $i < $r->numRows(); $i++) {
		$searchkeyword = $r->fetchRow(DB_FETCHMODE_ASSOC,$i);
		$search_keyword[$i]=$searchkeyword['keyword'];
		$search_alternative[$i]=$searchkeyword['alternative'];
	}

	// read featured keywords from database
	$featuredresult = DBQuery("SELECT * FROM ".TABLEPREFIX."vtcal_searchfeatured WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."'" );
		for ($i=0; $i < $featuredresult->numRows(); $i++) {
			$feature = $featuredresult->fetchRow(DB_FETCHMODE_ASSOC,$i);
		$search_featured[$feature['keyword']]=$feature['featuretext'];
	}
		 		
	for ($i=0; $i<count($keywords); $i++) {
		$kw = strtolower($keywords[$i]);
		if ( !empty($kw) ) {
			// print featured text if exists
			if ( isset($search_featured) && array_key_exists ($kw, $search_featured) ) {
					echo "<tr valign=\"top\">\n  <td colspan=\"3\">\n";
				echo '<table border="1" cellspacing="0" cellpadding="0" width="100%"><tr><td >';
				echo '<table border="1" cellspacing="2" cellpadding="5" width="100%"><tr><td>';
				echo str_replace("\r", "<br>", make_clickable(htmlentities($search_featured[$kw])));
				echo '</td></tr></table>';
				echo '</td></tr></table>';
					echo "<br></td>\n</tr>\n";
			}
			
			$query.= " and (";
			$query.="(e.location LIKE '%".sqlescape($kw)."%') or (e.title LIKE '%".sqlescape($kw)."%') or (e.description LIKE '%".sqlescape($kw)."%') or (e.displayedsponsor LIKE '%".sqlescape($kw)."%') or (c.name LIKE '%".sqlescape($kw)."%')";
		
			// check if there is a matching keyword in the database
			if (!empty($search_keyword)) {
				for ($j=0; $j<count($search_keyword); $j++) {
					if ($kw==$search_keyword[$j]) {
						$kwalt = $search_alternative[$j];
						$query.=" or (e.location LIKE '%".sqlescape($kw)."%') or (e.title LIKE '%".sqlescape($kwalt)."%') or (e.description LIKE '%".sqlescape($kwalt)."%') or (e.displayedsponsor LIKE '%".sqlescape($kwalt)."%') or (c.name LIKE '%".sqlescape($kwalt)."%')";
					}
				}
				}
			$query.=")"; 
		}
	}
}
	
$query.= " ORDER BY e.timebegin ASC, e.wholedayevent DESC";
$result = DBQuery($query );
// read first event if one exists
if ($ievent < $result->numRows()) {
	$event = $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
	$event_timebegin  = timestamp2datetime($event['timebegin']);
	$event_timeend    = timestamp2datetime($event['timeend']);
}
else {
?>
				<tr valign="top">
					<td colspan="3"><span class="announcement">&nbsp;&nbsp;<?php echo lang('no_events_found'); ?>.</span></td>
				</tr>
<?php	
} // end: else: if ($ievent < $result->numRows())

// print all events of one day
while ($ievent < $result->numRows()) {
 	  disassemble_timestamp($event);	
		$event_timebegin_num = timestamp2timenumber($event['timebegin']);
		$event_timeend_num = timestamp2timenumber($event['timeend']);
		$datediff = Delta_Days($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year'],date("m", NOW),date("d", NOW),date("Y", NOW));
		$timediff = $event_timeend_num - $event_timebegin_num;
		$begintimediff = NOW_AS_TIMENUM - $event_timebegin_num;
		$endtimediff = NOW_AS_TIMENUM - $event_timeend_num;
		$EventHasPassed = ( $datediff > 0 || ( $datediff == 0 && $endtimediff > 0 ) );

	// print event
	echo '        <tr valign="top" class="BorderTop">',"\n";
	echo '          <td width="1%" align="right" valign="top" nowrap';
	if ( $EventHasPassed ) {
		echo ' class="TimeColumn-Past"'; }
	else {
		echo ' class="TimeColumn"'; }
	echo '>',"\n";
	echo '          	';
		echo searchresult_date_format($event_timebegin['day'],Day_of_Week_to_Text(Day_of_Week($event_timebegin['month'],$event_timebegin['day'],$event_timebegin['year'])),Month_to_Text($event_timebegin['month']),$event_timebegin['year']);

		//echo Day_of_Week_Abbreviation(Day_of_Week($event_timebegin['month'],$event_timebegin['day'],$event_timebegin['year'])),", ";
		//echo Month_to_Text_Abbreviation($event_timebegin['month'])," ",$event_timebegin['day'],", ",$event_timebegin['year'];
		echo "<br>";
		if ($event['wholedayevent']==0) {
			disassemble_timestamp($event);	
			echo timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']);
		}
		else {
				if (isset($previousWholeDay) && !$previousWholeDay ) { echo 'All day'; }
				$previousWholeDay = true;
	}
	echo '</td>',"\n";
	echo '<td width="98%"';
	if ( $EventHasPassed ) {
		echo ' class="DataColumn-Past"'; }
	else {
		echo ' class="DataColumn"'; }
	echo '><div class="EventLeftBar"><b><a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=event&eventid=',$event['eventid'],'&timebegin=';
	echo urlencode(datetime2timestamp($event_timebegin['year'],$event_timebegin['month'],$event_timebegin['day'],12,0,"am"));
	echo '">',highlight_keyword($keyword,$event['title']),"</a></b> - ";
	if ( !empty($event['location']) ) { echo highlight_keyword($keyword,htmlentities($event['location'])); }
	/*echo " -- <i>".highlight_keyword($keyword,htmlentities($event['category_name']))."</i>";*/

	echo "<br>\n";
	if (!empty($event['description'])) {
		echo highlight_keyword($keyword,$event['description']);
		echo " \n";
	}
	else {
		echo "<br>\n";
	}
	echo "</div></td>\n";
	echo '        </tr>',"\n";

	// read next event if one exists
	$ievent++;
	if ($ievent < $result->numRows()) {
		$event = $result->fetchRow(DB_FETCHMODE_ASSOC,$ievent);
		$event_timebegin  = timestamp2datetime($event['timebegin']);
		$event_timeend    = timestamp2datetime($event['timeend']);
	}
} // end: while (...)
	

// keep search log of keywords
DBQuery("INSERT INTO ".TABLEPREFIX."vtcal_searchlog (calendarid,time,ip,numresults,keyword) VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."','".sqlescape(date("Y-m-d H:i:s", time()))."','".sqlescape($_SERVER['REMOTE_ADDR'])."','".sqlescape($result->numRows())."','".sqlescape($keyword)."')" );

/*if (!empty($keyword)) {
	$keywords = split (" ", $keyword);
	for ($x = 0; $x < count($keywords); $x++) {
		if (strlen($keywords[$x]) <= 25) {
			DBquery(
				"INSERT INTO ".TABLEPREFIX."vtcal_searchedkeywords (calendarid, keyword, searchdate, count)"
				. " VALUES ('".sqlescape($_SESSION['CALENDAR_ID'])."', '".sqlescape($keywords[$x])."', '" . date("Y-m-d", NOW) . "', 1)"
				. " ON DUPLICATE KEY UPDATE count = count + 1");
		}
	}
}*/
?>
</table>
</form>