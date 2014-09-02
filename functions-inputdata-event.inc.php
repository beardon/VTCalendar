<?php
function defaultevent(&$event,$sponsorid) {

	// Set the default date.
	$event['timebegin_year']=date("Y", NOW);
	$event['timebegin_month']=0;
	$event['timebegin_day']=0;
	
	// Set the default begin/end time.
	$event['timebegin_hour']=0;
	$event['timebegin_min']=0;
	$event['timebegin_ampm']="pm";
	$event['timeend_hour']=0;
	$event['timeend_min']=0;
	$event['timeend_ampm']="pm";

	// find sponsor name
	$result = DBQuery("SELECT name,url FROM ".SCHEMANAME."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($sponsorid)."'" ); 
	$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);

	$event['sponsorid']=$sponsorid;
	$event['title']="";
	$event['wholedayevent']=0;
	$event['categoryid']=0;
	$event['description']="";
	$event['location']="";
	$event['price']="";
	$event['contact_name']="";
	$event['contact_phone']="";
	$event['contact_email']="";
	$event['displayedsponsor'] = "";
	$event['displayedsponsorurl'] = ""; //$sponsor['url'];

	return 1;
} /* function defaultevent */

/* checks the validity of the time 1am-12pm or 0:00-23:00 */
function checktime(&$hour,&$min) {
	if (!isset($hour) || !isset($min)) return false;
	
	if (USE_AMPM) {
		return
			(($hour>0) && ($hour<=12)) &&
			(($min>=0) && ($min<=59));
	}
	else {
		return
				(($hour>=0) && ($hour<23)) &&
				(($min>=0) && ($min<=59));
	}
}

function checkeventdate(&$event,&$repeat) {
	if ($repeat['mode']==0) { // it's a one-time event (no recurrences)
		return (checkdate($event['timebegin_month'],
			$event['timebegin_day'],
			$event['timebegin_year']));
	}
	else { // it's a recurring event
		return (
			checkdate($event['timebegin_month'], $event['timebegin_day'], $event['timebegin_year'])
			&& !empty($event['timeend_month']) && !empty($event['timeend_day']) && !empty($event['timeend_year'])
			&& checkdate($event['timeend_month'], $event['timeend_day'], $event['timeend_year'])
			&& checkstartenddate($event['timebegin_month'],
				$event['timebegin_day'],
				$event['timebegin_year'],
				$event['timeend_month'],
				$event['timeend_day'],
				$event['timeend_year'])
		);
	}
}

function checkstartenddate($startdate_month, $startdate_day, $startdate_year, $enddate_month, $enddate_day, $enddate_year) {
	if (strlen($startdate_month) == 1) { $startdate_month = "0".$startdate_month; }
	if (strlen($startdate_day) == 1) { $startdate_day = "0".$startdate_day; }
	if (strlen($enddate_month) == 1) { $enddate_month = "0".$enddate_month; }
	if (strlen($enddate_day) == 1) { $enddate_day = "0".$enddate_day; }

	$startdate = $startdate_year.$startdate_month.$startdate_day;
	$enddate = $enddate_year.$enddate_month.$enddate_day;

	return $startdate <= $enddate;
} // end: function checkstartenddate

function checkeventtime(&$event) {
	// Times are ignored for whole day events.
	if ($event['wholedayevent']==1) return true;
	
	if (isset($event['timeend_hour'])) {
		// Fail if the end time is not valid.
		if (!checktime($event['timeend_hour'],$event['timeend_min'])) return false;

		// Create two temporary variables to compare times.
		$timebegin = sprintf("%s%02s%02s", $event['timebegin_ampm'], $event['timebegin_hour'], $event['timebegin_min']);
		$timeend = sprintf("%s%02s%02s", $event['timeend_ampm'], $event['timeend_hour'], $event['timeend_min']);

		// Fail if the beginning time is the same as or after the ending time.
		if (strtolower($timebegin) >= strtolower($timeend)) return false;
	}
	
	// Return if the beginning time is valid.
	return(checktime($event['timebegin_hour'],$event['timebegin_min']));
}

function checkevent(&$event,&$repeat) {
	return
		(!empty($event['title'])) &&
		checkeventdate($event, $repeat) &&
		checkeventtime($event) &&
		($event['categoryid']>=1) &&
		(empty($event['displayedsponsorurl']) || checkURL(urldecode($event['displayedsponsorurl']))) &&
		($_SESSION['CALENDAR_ID'] == "default" || !isset($event['showondefaultcal']) || $event['showondefaultcal']==0 || $event['showincategory']!=0);
}

// shows the inputfields for the recurrence information
function inputrecurrences(&$event,&$repeat,$check) {
	?>
	<input type="radio" name="repeat[mode]" id="repeatmode1" value="1"<?php if ($repeat['mode']==1) { echo " checked"; } ?>><label for="repeatmode1"> 
	<?php echo lang('repeat'); ?></label>
	<select name="repeat[interval1]" size="1">
		<option value="every"<?php if (isset($repeat['interval1']) && $repeat['interval1']=="every") { echo " selected"; } ?>><?php echo lang('every'); ?></option>
		<option value="everyother"<?php if (isset($repeat['interval1']) && $repeat['interval1']=="everyother") { echo " selected"; } ?>><?php echo lang('every_other'); ?></option>
		<option value="everythird"<?php if (isset($repeat['interval1']) && $repeat['interval1']=="everythird") { echo " selected"; } ?>><?php echo lang('every_third'); ?></option>
		<option value="everyfourth"<?php if (isset($repeat['interval1']) && $repeat['interval1']=="everyfourth") { echo " selected"; } ?>><?php echo lang('every_fourth'); ?></option>
	</select>
	<select name="repeat[frequency1]" size="1">
		<option value="day"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="day") { echo " selected"; } ?>><?php echo lang('day'); ?></option>
		<option value="week"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="week") { echo " selected"; } ?>><?php echo lang('week'); ?></option>
		<option value="month">Month<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="month") { echo " selected"; } ?></option>
		<option value="year"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="year") { echo " selected"; } ?>><?php echo lang('year'); ?></option>
		<option value="sunday"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="sunday") { echo " selected"; } ?>><?php echo lang('sun'); ?></option>
		<option value="monday"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="monday") { echo " selected"; } ?>><?php echo lang('mon'); ?></option>
		<option value="tuesday"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="tuesday") { echo " selected"; } ?>><?php echo lang('tue'); ?></option>
		<option value="wednesday"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="wednesday") { echo " selected"; } ?>><?php echo lang('wed'); ?></option>
		<option value="thursday"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="thursday") { echo " selected"; } ?>><?php echo lang('thu'); ?></option>
		<option value="friday"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="friday") { echo " selected"; } ?>><?php echo lang('fri'); ?></option>
		<option value="saturday"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="saturday") { echo " selected"; } ?>><?php echo lang('sat'); ?></option>
		<option value="monwedfri"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="monwedfri") { echo " selected"; } ?>><?php echo lang('mon'); ?>, <?php echo lang('wed'); ?>, <?php echo lang('fri'); ?></option>
		<option value="tuethu"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="tuethu") { echo " selected"; } ?>><?php echo lang('tue'); ?> &amp; <?php echo lang('thu'); ?></option>
		<option value="montuewedthufri"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="montuewedthufri") { echo " selected"; } ?>><?php echo lang('mon'); ?> - <?php echo lang('fri'); ?></option>
		<option value="satsun"<?php if (isset($repeat['frequency1']) && $repeat['frequency1']=="satsun") { echo " selected"; } ?>><?php echo lang('sat'); ?> &amp; <?php echo lang('sun'); ?></option>
	</select>
	<br>
	<input type="radio" name="repeat[mode]" id="repeatmode2" value="2"<?php if ($repeat['mode']==2) { echo " checked"; } ?>> <label for="repeatmode2"><?php echo lang('repeat_on_the'); ?></label>
	<select name="repeat[frequency2modifier1]" size="1">
		<option value="first"<?php if (isset($repeat['frequency2modifier1']) && $repeat['frequency2modifier1']=="first") { echo " selected"; } ?>><?php echo lang('first'); ?></option>
		<option value="second"<?php if (isset($repeat['frequency2modifier1']) && $repeat['frequency2modifier1']=="second") { echo " selected"; } ?>><?php echo lang('second'); ?></option>
		<option value="third"<?php if (isset($repeat['frequency2modifier1']) && $repeat['frequency2modifier1']=="third") { echo " selected"; } ?>><?php echo lang('third'); ?></option>
		<option value="fourth"<?php if (isset($repeat['frequency2modifier1']) && $repeat['frequency2modifier1']=="fourth") { echo " selected"; } ?>><?php echo lang('fourth'); ?></option>
		<option value="last"<?php if (isset($repeat['frequency2modifier1']) && $repeat['frequency2modifier1']=="last") { echo " selected"; } ?>><?php echo lang('last'); ?></option>
	</select>
	<select name="repeat[frequency2modifier2]" size="1">
		<option value="sun"<?php if (isset($repeat['frequency2modifier2']) && $repeat['frequency2modifier2']=="sun") { echo " selected"; } ?>><?php echo lang('sun'); ?></option>
		<option value="mon"<?php if (isset($repeat['frequency2modifier2']) && $repeat['frequency2modifier2']=="mon") { echo " selected"; } ?>><?php echo lang('mon'); ?></option>
		<option value="tue"<?php if (isset($repeat['frequency2modifier2']) && $repeat['frequency2modifier2']=="tue") { echo " selected"; } ?>><?php echo lang('tue'); ?></option>
		<option value="wed"<?php if (isset($repeat['frequency2modifier2']) && $repeat['frequency2modifier2']=="wed") { echo " selected"; } ?>><?php echo lang('wed'); ?></option>
		<option value="thu"<?php if (isset($repeat['frequency2modifier2']) && $repeat['frequency2modifier2']=="thu") { echo " selected"; } ?>><?php echo lang('thu'); ?></option>
		<option value="fri"<?php if (isset($repeat['frequency2modifier2']) && $repeat['frequency2modifier2']=="fri") { echo " selected"; } ?>><?php echo lang('fri'); ?></option>
		<option value="sat"<?php if (isset($repeat['frequency2modifier2']) && $repeat['frequency2modifier2']=="sat") { echo " selected"; } ?>><?php echo lang('sat'); ?></option>
	</select>
	of the month every
	<select name="repeat[interval2]" size="1">
		<option value="month"<?php if (isset($repeat['interval2']) && $repeat['interval2']=="month") { echo " selected"; } ?>><?php echo lang('month'); ?></option>
		<option value="2months"<?php if (isset($repeat['interval2']) && $repeat['interval2']=="2months") { echo " selected"; } ?>><?php echo lang('other_month'); ?></option>
		<option value="3months"<?php if (isset($repeat['interval2']) && $repeat['interval2']=="3months") { echo " selected"; } ?>>3 <?php echo lang('months'); ?></option>
		<option value="4months"<?php if (isset($repeat['interval2']) && $repeat['interval2']=="4months") { echo " selected"; } ?>>4 <?php echo lang('months'); ?></option>
		<option value="6months"<?php if (isset($repeat['interval2']) && $repeat['interval2']=="6months") { echo " selected"; } ?>>6 <?php echo lang('months'); ?></option>
		<option value="year"<?php if (isset($repeat['interval2']) && $repeat['interval2']=="year") { echo " selected"; } ?>><?php echo lang('year'); ?></option>
	</select>
	<br>
	<br>
	<?php
	if (isset($check) && $repeat['mode'] > 0) {

		if (!isset($event['timeend_month']) || !isset($event['timeend_day']) || !isset($event['timeend_year'])) {
			feedback(lang('specify_valid_ending_date'),FEEDBACKNEG);
		}
		elseif (!checkdate($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year']) &&
			!checkdate($event['timeend_month'],$event['timeend_day'],$event['timeend_year'])) {
			feedback(lang('specify_valid_dates'),FEEDBACKNEG);
		}
		elseif (!checkdate($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year'])) {
			feedback(lang('specify_valid_starting_date'),FEEDBACKNEG);
		}
		elseif (!checkdate($event['timeend_month'],$event['timeend_day'],$event['timeend_year'])) {
			feedback(lang('specify_valid_ending_date'),FEEDBACKNEG);
		}
		elseif (!checkstartenddate($event['timebegin_month'],
			$event['timebegin_day'],
			$event['timebegin_year'],
			$event['timeend_month'],
			$event['timeend_day'],
			$event['timeend_year'])) {
			feedback(lang('ending_date_after_starting_date'),FEEDBACKNEG);
		}
	} // end: if (isset($check) && repeat[mode] > 0)
	
	?> from <?php
	inputdate($event['timebegin_month'],"event[timebegin_month]",
		$event['timebegin_day'],"event[timebegin_day]",
		$event['timebegin_year'],"event[timebegin_year]");
	
	echo " ",lang('to')," ";
	if (!isset($event['timeend_month']) || !isset($event['timeend_day']) || !isset($event['timeend_year'])) {
		inputdate(0,"event[timeend_month]",
		0,"event[timeend_day]",
		$event['timebegin_year'],"event[timeend_year]");
	}
	else {
		inputdate($event['timeend_month'],"event[timeend_month]",
			$event['timeend_day'],"event[timeend_day]",
			$event['timeend_year'],"event[timeend_year]");
	}
	
	?><br><?php
} // end: function inputrecurrences

/* print out the event input form and use the provided parameter as preset */
function inputeventdata(&$event,$sponsorid,$inputrequired,$check,$displaydatetime,&$repeat,$copy) {
	/* now printing the HTML code for the input form */
	$unknownvalue = "???"; /* this is printed when the value of input field is unspecified */

	// the value of the radio box when user chooses recurring event
	$recurring = 10;
	
	$defaultButtonPressed = isset($event['defaultdisplayedsponsor']) || isset($event['defaultdisplayedsponsorurl']) || isset($event['defaultallsponsor']);

	// read sponsor name from DB
	//$result = DBQuery("SELECT name,url FROM ".SCHEMANAME."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($sponsorid)."'" ); 
	//$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	
	// switch from "recurring event" to "repeat ..."
	if ($repeat['mode']==$recurring) { $repeat['mode'] = 1; }
	
	if ($displaydatetime) {
		?>
		<div style="padding: 4px; margin-bottom: 6px; border-top: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>; background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>;"><h3 style="margin: 0; padding: 0;"><?php echo lang('date_and_time_header'); ?>:</h3></div>
		
		<div style="padding-left: 18px;">
		
		<?php
		// Do not allow the date/time to be changed if we are logged into the default calendar and the current event is from a different calendar.
		if ($_SESSION['CALENDAR_ID'] == "default" && isset($event['showondefaultcal']) && $event['showondefaultcal'] == '1' && (!isset($copy) || $copy != 1)) {
			passeventtimevalues($event, $repeat);
			
			// Output the basic date/time information.
			echo Day_of_Week_to_Text(Day_of_Week($event['timebegin_month'],$event['timebegin_day'],$event['timebegin_year']));
			echo ", ";
			echo substr(Month_to_Text($event['timebegin_month']),0,3)," ",$event['timebegin_day'],", ",$event['timebegin_year'];
			echo " -- ";
			if ($event['wholedayevent']==0) {
				echo timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']);
				if (endingtime_specified($event)) { // event has an explicit ending time
					echo " - ",timestring($event['timeend_hour'],$event['timeend_min'],$event['timeend_ampm']);
				}
			}
			else {
				echo lang('all_day');
			}
		
			// Output additional re-occurring event information.
			if (!empty($event['repeatid'])) {
				echo "<br>\n";
				echo '<span class="NotificationText">';
				readinrepeat($event['repeatid'],$event,$repeat);
				$repeatdef = repeatinput2repeatdef($event,$repeat);
				printrecurrence($event['timebegin_year'],
					$event['timebegin_month'],
					$event['timebegin_day'],
					$repeatdef);
				echo '</span>';
			}
		}
		
		// Otherwise, allow the date/time to be edited.
		else {
			?>
			<table border="0" cellpadding="2" cellspacing="0">
			<tr><td valign="top"><strong><?php echo lang('date'); ?>:</strong><?php
			
			if ($inputrequired) {
				?><span class="WarningText">*</span><?php
			}
			
			?></td><td valign="top"><?php
			
			if ($inputrequired && $check && $repeat['mode'] == 0 && !checkeventdate($event,$repeat) && !$defaultButtonPressed) {
				feedback(lang('date_invalid'),FEEDBACKNEG);
			}
	
			echo '<input type="radio" name="repeat[mode]" value="0" id="onetime"';
			if (!isset($repeat['mode']) || $repeat['mode']==0) { echo " checked"; }
			echo ' onClick="this.form.submit()">';
			echo "\n<label for=\"onetime\">",lang('one_time_event'),"</label> ";
	
			if ($repeat['mode']==0) {
				if (!isset($event['timebegin_month'])) { $event['timebegin_month'] = 0; }
				if (!isset($event['timebegin_day'])) { $event['timebegin_day'] = 0; }
				if (!isset($event['timebegin_year'])) { $event['timebegin_year'] = 0; }
				
				inputdate($event['timebegin_month'],"event[timebegin_month]",
					$event['timebegin_day'],"event[timebegin_day]",
					$event['timebegin_year'],"event[timebegin_year]");
			}
			
			// Why is "$repeat['mode'] == $recurring" in this expression?! It's impossible for that to be true.
			if ($repeat['mode'] == 0 || $repeat['mode'] == $recurring) {
				echo "<br>\n";
				echo "<input type=\"radio\" name=\"repeat[mode]\" id=\"recurringevent\" value=\"$recurring\"";
				if ($repeat['mode']>=1) { echo " checked"; }
				echo ' onClick="this.form.submit()"><label for="recurringevent"> ',lang('recurring_event'),'</label>';
				echo "<br>\n";
			}
			elseif ($repeat['mode']>=1 && $repeat['mode']<=2) {
				echo "<br>\n";
				inputrecurrences($event,$repeat,$check);
			}
			echo "<br>\n";
			
			?></td></tr>
			
			<tr><td valign="top"><strong><?php echo lang('time'); ?>:</strong><?php
			
			if ($inputrequired) {
					?><span class="WarningText">*</span><?php
			}
			
			?></td><td valign="top"><?php
			
			if ($inputrequired && $check && $event['wholedayevent']==0 && (!isset($event['timebegin_hour']) || $event['timebegin_hour']==0) && !$defaultButtonPressed) {
				feedback(lang('specify_all_day_or_starting_time'),FEEDBACKNEG);
			}
			
			?>
			<input type="radio" name="event[wholedayevent]" id="alldayevent" value="1"<?php if ($event['wholedayevent']==1) { echo " checked "; } ?>>
			<label for="alldayevent"><?php echo lang('all_day_event'); ?></label><br>
			
			<input type="radio" name="event[wholedayevent]" id="timedevent" value="0"<?php if ($event['wholedayevent']==0) { echo " checked "; } ?>>
			<label for="timedevent"><?php echo lang('timed_event'); ?>: <?php echo lang('from'); ?></label>
			<select name="event[timebegin_hour]" size="1" onclick="setRadioButton('timedevent',true);">
			<?php
			
			if ($event['timebegin_hour']==0) {
				echo "<option selected value=\"0\">",$unknownvalue,"</option>\n";
			}
			// print list with hours and select the one read from the DB
			if(USE_AMPM){
				$start_hour=1;
				$end_hour=12;
			}else{
				$start_hour=0;
				$end_hour=23;
			}
			for ($i=$start_hour; $i<=$end_hour; $i++) {
				echo "<option ";
				if (isset($event['timebegin_hour']) && $event['timebegin_hour']==$i) { echo "selected "; }
				echo "value=\"$i\">$i</option>\n";
			}
			
			?>
			</select>
			<b>:</b>
			<select name="event[timebegin_min]" size="1" onclick="setRadioButton('timedevent',true);">
			<?php
			
			// print list with minutes and select the one read from the DB
			for ($i=0; $i<=55; $i+=5) {
				echo "<option ";
				if (isset($event['timebegin_min']) && $event['timebegin_min']==$i) { echo "selected "; }
				if ($i < 10) { $j="0"; } else { $j=""; } // "0","5" to "00", "05"
				echo "value=\"$i\">$j$i</option>\n";
			}
			
			?>
			</select>
			<?php 
	
			if(USE_AMPM){
				?><select name="event[timebegin_ampm]" size="1" onclick="setRadioButton('timedevent',true);">
					<option value="am"<?php if (isset($event['timebegin_ampm']) && $event['timebegin_ampm']=="am") {echo "selected"; } ?>>am</option>
					<option value="pm"<?php if (isset($event['timebegin_ampm']) && $event['timebegin_ampm']=="pm") {echo "selected "; } ?>>pm</option>
				 </select><?php
			}
		
			echo ' ' . lang('to') . ' ';
		
			?><select name="event[timeend_hour]" size="1" onclick="setRadioButton('timedevent',true);"><?php
		
			if (!endingtime_specified($event)) {
				$event['timeend_hour']=0;
			}
	
			echo "<option ";
			if (isset($event['timeend_hour']) && $event['timeend_hour']==0) { echo "selected "; }
			echo "value=\"0\">$unknownvalue</option>\n";
			
			// print list with hours and select the one read from the DB
			if(USE_AMPM){
				$start_hour=1;
				$end_hour=12;
			}else{
				$start_hour=0;
				$end_hour=23;
			}
			for ($i=$start_hour; $i<=$end_hour; $i++) {
				echo "<option ";
				if (isset($event['timeend_hour']) && $event['timeend_hour']==$i) { echo "selected "; }
				echo "value=\"$i\">$i</option>\n";
			}
			
			?>
			</select>
			<b>:</b>
			<select name="event[timeend_min]" size="1" onclick="setRadioButton('timedevent',true);">
			<?php
			
			// print list with minutes and select the one read from the DB
			for ($i=0; $i<=55; $i+=5) {
				echo "<option ";
				if (isset($event['timeend_min']) && $event['timeend_min']==$i) { echo "selected "; }
				if ($i < 10) { $j="0"; } else { $j=""; } // "0","5" to "00", "05"
				echo "value=\"$i\">$j$i</option>\n";
			}
			?>
			</select>
			<?php
			
			if(USE_AMPM){
				?><select name="event[timeend_ampm]" size="1" onclick="setRadioButton('timedevent',true);">
				<option value="am" <?php if (isset ($event['timeend_ampm']) && $event['timeend_ampm']=="am") {echo "selected "; } ?>>am</option>
				<option value="pm" <?php if (isset($event['timeend_ampm']) && $event['timeend_ampm']=="pm") {echo "selected "; } ?>>pm</option>
				</select>
				<?php
			}
			?>
			&nbsp;<i><?php echo lang('ending_time_not_required'); ?></i>
			</td>
			</tr>
			</table>
			<?php
		}
		
		?></div><?php
		
	} // End of date/time block.
	?>
	
	<div style="margin-top: 16px; padding: 4px; margin-bottom: 6px; border-top: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>; background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>;"><h3 style="margin: 0; padding: 0;"><?php echo lang('basic_event_info_header'); ?>:</h3></div>
	<div style="padding-left: 18px;">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr>
	<td valign="top" nowrap="nowrap">
	<strong><?php echo lang('category'); ?>:</strong>
	<?php
	if ($inputrequired) {
		?><span class="WarningText">*</span><?php
	}
	?>
	</td>
	<td valign="top">
	<?php
	if ($inputrequired && $check && ($event['categoryid']==0) && !$defaultButtonPressed) {
		feedback(lang('choose_category'),FEEDBACKNEG);
	}
	?>
	<select name="event[categoryid]" size="1">
	<?php
	
	// read event categories from DB
	$result = DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY name ASC" ); 

	// print list with categories and select the one read from the DB

	if ($event['categoryid']==0) {
		echo "<option selected value=\"0\">$unknownvalue</option>\n";
	}
	for ($i=0;$i<$result->numRows();$i++) {
		$category = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);

		echo "<option ";
		if (isset($event['categoryid']) && $event['categoryid']==$category['id']) { echo "selected "; }
		echo "value=\"".htmlentities($category['id'])."\">".htmlentities($category['name'])."</option>\n";
	}
?>
			</select><br/><?php echo lang('category_description'); ?></td>
	</tr>
	<tr>
		<td valign="top">
			<strong><?php echo lang('title'); ?>:</strong><?php
	if ($inputrequired) {
		?><span class="WarningText">*</span><?php
	}
	?></td>
		<td valign="top"><?php
	if ($inputrequired && $check && (empty($event['title'])) && !$defaultButtonPressed) {
		feedback(lang('choose_title'),FEEDBACKNEG);
	}
?>
			<input type="text" size="24" name="event[title]" maxlength=<?php echo MAXLENGTH_TITLE; ?> value="<?php
	if (isset($event['title'])) {
		if ($check) { $event['title']=$event['title']; }
		echo HTMLSpecialChars($event['title']);
	}
?>"><br/><?php echo lang('title_description'); ?>
			<br>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<strong><?php echo lang('description'); ?>:</strong>
		</td>
		<td valign="top">
			<textarea id="Description_Box" name="event[description]" rows="10" cols="60" wrap="virtual" onkeyup="UpdateDescriptionLength()" onchange="UpdateDescriptionLength()"><?php
	if (isset($event['description'])) {
		if ($check) { $event['description']=$event['description']; }
		echo HTMLSpecialChars($event['description']);
	}
?></textarea>
			<br/>
			<?php echo lang('description_description'); ?>
			<script type="text/javascript">
			function UpdateDescriptionLength() {
				if (document.getElementById) {
					var textbox = document.getElementById("Description_Box");
					var current = document.getElementById("Description_CurrentChars");
					if (textbox && current) {
						current.innerHTML = textbox.value.length;
					}
				}
			}
			if (document.getElementById) {
				var container = document.getElementById("Description_CharLine");
				var max = document.getElementById("Description_MaxChars");
				if (container&& max) {
					container.style.display = "";
					max.innerHTML = "<?php echo MAXLENGTH_DESCRIPTION; ?>";
				}
			}
			UpdateDescriptionLength();
			</script>
		</td>
	</tr>
	</table>
	</div>
	
	<div style="margin-top: 16px; padding: 4px; margin-bottom: 6px; border-top: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>; background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>;">
		<h3 style="margin: 0; padding: 0;"><?php echo lang('additional_event_info_header'); ?>:</h3>
	</div>
	<div style="padding-left: 18px;">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr>
		<td valign="top" nowrap="nowrap"><strong><?php echo lang('location'); ?>:</strong></td>
		<td valign="top">
			<input type="text" size="24" name="event[location]" maxlength=<?php echo MAXLENGTH_LOCATION; ?> value="<?php
	if (isset($event['location'])) {
		if ($check) { $event['location']=$event['location']; }
		echo HTMLSpecialChars($event['location']);
	}
?>"><br>
<?php echo lang('location_description'); ?>
		</td>
	</tr>
	<tr>
		<td valign="top" nowrap="nowrap"><strong><?php echo lang('price'); ?>:</strong></td>
		<td valign="top">
			<input type="text" size="24" name="event[price]" maxlength=<?php echo MAXLENGTH_PRICE; ?>  value="<?php
	if (isset($event['price'])) {
		if ($check) { $event['price']=$event['price']; }
		echo HTMLSpecialChars($event['price']);
	}
?>"><br/><?php echo lang('price_description'); ?>
		</td>
	</tr>
	<tr>
		<td valign="top" nowrap="nowrap"><strong><?php echo lang('contact_name'); ?>:</strong></td>
		<td valign="top">
			<input type="text" size="24" name="event[contact_name]" maxlength=<?php echo MAXLENGTH_CONTACT_NAME; ?> value="<?php
	if (isset($event['contact_name'])) {
		if ($check) { $event['contact_name']=$event['contact_name']; }
		echo HTMLSpecialChars($event['contact_name']);
	}
?>"><br/><?php echo lang('contact_name_description'); ?></td>
	</tr>
	<tr>
		<td valign="top" nowrap="nowrap"><strong><?php echo lang('contact_phone'); ?>:</strong></td>
		<td valign="top">
			<input type="text" size="24" name="event[contact_phone]" maxlength=<?php echo MAXLENGTH_CONTACT_PHONE; ?> value="<?php
	if (isset($event['contact_phone'])) {
		if ($check) { $event['contact_phone']=$event['contact_phone']; }
		echo HTMLSpecialChars($event['contact_phone']);
	}
?>"><br/><?php echo lang('contact_phone_description'); ?></td>
	</tr>
	<tr>
		<td valign="top">
			 <strong><?php echo lang('contact_email'); ?>:</strong>
		</td>
		<td valign="top">
			<input type="text" size="24" name="event[contact_email]" maxlength=<?php echo MAXLENGTH_EMAIL; ?> value="<?php
	if (isset($event['contact_email'])) {
		if ($check) { $event['contact_email']=$event['contact_email']; }
		echo HTMLSpecialChars(urldecode($event['contact_email']));
	}
?>"><br/><?php echo lang('contact_email_description'); ?></td>
	</tr>
	</table>
	</div>
	<?php
	if (!$_SESSION['AUTH_ISCALENDARADMIN']) {
		// Not actually submitted since it has no "name" attribute. The point of this is to allow the "Restore default" buttons to work properly.
		?><input type="hidden" id="selectedsponsorid" value="<?php echo $event['sponsorid']; ?>"><?php
	}
	else {
		?>
		<div style="margin-top: 16px; padding: 4px; margin-bottom: 6px; border-top: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>; background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>;">
			<h3 style="margin: 0; padding: 0;"><?php echo lang('event_owner_info_header'); ?>:</h3>
			<div style="padding: 2px; padding-left: 15px;"><?php echo lang('event_owner_info_description'); ?></div>
			</div>
		<div style="padding-left: 18px;">
		<table border="0" cellpadding="3" cellspacing="0">
		<tr>
			<td>
				<strong><?php echo lang('sponsor'); ?>:</strong>
			</td>
			<td><?php
				if ($_SESSION['CALENDAR_ID'] == "default" && isset($event['showondefaultcal']) && $event['showondefaultcal'] == '1' && (!isset($copy) || $copy != 1)) {
					?><input type="hidden" id="selectedsponsorid" name="event[sponsorid]" value="<?php echo $event['sponsorid']; ?>">
					<input type="hidden" name="event[showondefaultcal]" value="<?php echo $event['showondefaultcal']; ?>">
					<input type="hidden" name="event[showincategory]" value="<?php echo $event['showincategory']; ?>"><?php
					echo htmlentities(getSponsorName($event['sponsorid']));
					echo ' (from the &quot;'.htmlentities(getSponsorCalendarName($event['sponsorid'])).'&quot; calendar)';
				}
				else {
					?>
					<select id="selectedsponsorid" name="event[sponsorid]" size="1">
						<?php
						// read sponsors from DB
						$result = DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY name ASC" ); 
						
						// print list with sponsors and select the one read from the DB
						for ($i=0;$i<$result->numRows();$i++) {
							$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
							
							echo "<option ";
							if ($event['sponsorid']==$sponsor['id']) { echo "selected "; }
							echo "value=\"".htmlentities($sponsor['id'])."\">".htmlentities($sponsor['name'])."</option>\n";
						}
						?>
					</select>
				 <?php
				}
				?>
			</td>
		</tr>
		</table>
		</div>
		<?php
	}
	?>
	
	<div style="margin-top: 16px; padding: 4px; margin-bottom: 6px; border-top: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>; background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>;">
		<h3 style="margin: 0; padding: 0;"><?php echo lang('event_sponsor_info_header'); ?>:</h3>
		<div style="padding: 2px; padding-left: 15px;"><?php echo lang('event_sponsor_info_description'); ?></div>
		</div>
	<div style="padding-left: 18px;">
	<table border="0" cellpadding="3" cellspacing="0">
	<tr>
		<td valign="top">
			<strong><?php echo lang('displayed_sponsor_name'); ?>:</strong>
		</td>
		<td valign="top">
			<input type="text" id="defaultsponsornametext" size="50" name="event[displayedsponsor]" maxlength=<?php echo MAXLENGTH_DISPLAYEDSPONSOR; ?> value="<?php
	if (isset($event['displayedsponsor'])) {
		if ($check) { $event['displayedsponsor']=$event['displayedsponsor']; }
		echo HTMLSpecialChars($event['displayedsponsor']);
	}
?>">
			<input type="submit" id="defaultsponsornamebutton" name="event[defaultdisplayedsponsor]" value="<?php echo lang('button_restore_default'); ?>" onclick="return SetSponsorDefault(1);">
		</td>
	</tr>
	<tr>
		<td valign="top">
			<strong><?php echo lang('sponsor_page_web_address'); ?>:</strong>
		</td>
		<td valign="top">
<?php
	if ($check && isset($event['displayedsponsorurl']) && !checkURL($event['displayedsponsorurl']) && !$defaultButtonPressed) {
		feedback(lang('url_invalid'),FEEDBACKNEG);
	}
?>
			<input type="text" id="defaultsponsorurltext" size="50" name="event[displayedsponsorurl]" maxlength=<?php echo MAXLENGTH_DISPLAYEDSPONSORURL; ?> value="<?php
	if (isset($event['displayedsponsorurl'])) {
		if ($check) { $event['displayedsponsorurl']=$event['displayedsponsorurl']; }
		echo HTMLSpecialChars($event['displayedsponsorurl']);
	}
?>">
			<input type="submit" id="defaultsponsorurlbutton" name="event[defaultdisplayedsponsorurl]" value="<?php echo lang('button_restore_default'); ?>" onclick="return SetSponsorDefault(2);">
			<br>
		</td>
	</tr>
	</table>
	</div>
<?php
	if ( $_SESSION['CALENDAR_ID'] != "default" && $inputrequired ) {
		$defaultcalendarname = getCalendarName('default');
		?>
		<div style="margin-top: 16px; padding: 4px; margin-bottom: 6px; border-top: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>; background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>;">
			<h3 style="margin: 0; padding: 0;"><?php echo str_replace('DEFAULTCALENDARNAME', $defaultcalendarname, lang('submit_to_default_calendar_header')); ?>:</h3>
			<div style="padding: 2px; padding-left: 15px;"><?php echo str_replace('DEFAULTCALENDARNAME', $defaultcalendarname, lang('submit_to_default_calendar_description')); ?></div>
		</div>
		<div style="padding-left: 18px;">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top"><input type="checkbox" name="event[showondefaultcal]" value="1"<?php 
				if ( (isset($event['showondefaultcal']) && $event['showondefaultcal']=="1") ||
						 (!isset($event['showondefaultcal']) && $_SESSION['CALENDAR_FORWARD_EVENT_BY_DEFAULT']=="1")
				) { echo " checked"; }
				?>></td>
			<td>
				<table border="0" cellpadding="2" cellspacing="0">
					<tr><td><?php echo lang('submit_to_default_calendar_text'); ?>:</td></tr>
					<tr>
						<td>
							<select name="event[showincategory]" size="1">
								<?php
									// read event categories from DB
									$result = DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_category WHERE calendarid='default' ORDER BY name ASC" );
								
									// print list with categories and select the one read from the DB
									if (empty($event['showincategory'])) {
										echo "<option selected value=\"0\">$unknownvalue</option>\n";
									}
									for ($i=0;$i<$result->numRows();$i++) {
										$category = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
								
										echo "<option ";
										if (!empty($event['showincategory']) && $event['showincategory']==$category['id']) { echo "selected "; }
										echo "value=\"".htmlentities($category['id'])."\">".htmlentities($category['name'])."</option>\n";
									}
								?>
							</select>
						</td>
					</tr>
				<?php
				if ($check && !empty($event['showondefaultcal']) && $event['showondefaultcal']==1 && (empty($event['showincategory']) || $event['showincategory']==0) && !$defaultButtonPressed) {
					echo "<tr><td>";
					feedback(lang('choose_category'),FEEDBACKNEG);
					echo "</td></tr>";
				}
				?>
				</table>
			</td>
		</tr>
		</table>
		</div>
		<?php
	} // end: if ( $_SESSION['CALENDAR_ID'] != "default" )
?>
<input type="hidden" name="check" value="1">
<?php
	return 1;
} // end of function: "inputeventdata"
?>