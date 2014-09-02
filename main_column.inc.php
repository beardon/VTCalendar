<?php // prohibits direct calling of include files
			if (!defined("ALLOWINCLUDES")) { exit; } ?>

<!-- Start Left Column -->
<td id="CalLeftCol" valign="top" style="padding-<?php echo strtolower(COLUMNSIDE); ?>: 7px;">
	<div id="LittleCalendarContainer">
	<?php require("main_littlecalendar.php"); ?>
	</div>
	
	<!-- Start Jump To Date -->
	<form id="JumpToDateSelectorForm" action="main.php" method="get">
	<input type="hidden" name="view" value="<?php echo htmlspecialchars($view); ?>">
	<input type="hidden" name="timebegin_day" value="1">
	<?php
	if (isset($categoryid) && $categoryid != 0) { echo '<input type="hidden" name="categoryid" value="' . htmlspecialchars($categoryid) . '">'; }
	if (isset($sponsorid) && $sponsorid != "all") { echo '<input type="hidden" name="sponsorid" value="' . htmlspecialchars($sponsorid) . '">'; }
	if (isset($keyword) && $keyword != "") { echo '<input type="hidden" name="keyword" value="' . htmlspecialchars($keyword) . '">'; }
	?>
	<table id="JumpToDateSelector" border="0" cellpadding="2" cellspacing="0" align="center" style="padding-top: 5px; padding-bottom: 5px;">
	<tr>
		<td><select name="timebegin_month"><?php
		for ($iMonth = 1; $iMonth <= 12; $iMonth++) {
			echo '<option value="'.$iMonth.'"';
			if ($iMonth == $month['month']) { echo ' SELECTED'; }
			echo '>'.substr(Month_to_Text($iMonth),0,3).'</option>';
		}
		?></select></td>
		<td><select name="timebegin_year"><?php
		$currentyear = date("Y", NOW);
		for ($iYear = 1990; $iYear <= $currentyear+ALLOWED_YEARS_AHEAD; $iYear++) {
			echo '<option';
			if ($iYear == $month['year']) { echo ' SELECTED'; }
			echo '>'.$iYear.'</option>';
		}
		?></select></td>
		<td><input id="JumpToDateSelector-Button" type="image" title="Go" src="images/go.gif" width="23" height="20" border="0" align="Go"></td>
	</tr>
	</table>
	</form>
	<!-- End Jump To Date -->
	
	<!-- Start Today's Date -->
	<table id="TodaysDate" width="100%" border="0" cellpadding="3" cellspacing="0">
	<tr>
		<td><?php echo lang('today_is'); ?><br>
			<?php
				$showtodaylink = 0;
				if ( !($view=="day" && 
							 $showdate['year']==$today['year'] &&
							 $showdate['month']==$today['month'] &&
							 $showdate['day']==$today['day'] 
							 ) ) {
					$showtodaylink = 1;
				}
				if ($showtodaylink) {
					echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&amp;timebegin=today" >';	
				}
				echo "<b>";
			
			echo today_is_date_format($today['day'], Day_of_Week_to_Text(Day_of_Week($today['month'],$today['day'],$today['year'])),Month_to_Text($today['month']),$today['year']);
				echo "</b>";
				if ($showtodaylink) {
					echo "</a>";
				}
		?></td>
	</tr>
	</table>
	<!-- End Today's Date -->
	
	<!-- Start Subscribe -->
	<table id="SubscribeLink" width="100%" border="0" cellpadding="3" cellspacing="0">
	<tr>
		<td><?php
			if ($view!='subscribe') {
				echo'<a style="font-weight:bold"  href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=subscribe"><b>',lang('subscribe_download'),'</b></a>';
			}
			else {
				echo '<b>',lang('subscribe_download'),'</b>';
			}
		?></td>
	</tr>
	</table>
	<!-- End Subscribe -->
	
	<!-- Start Filter -->
	<table id="CategoryFilterLink" width="100%" border="0" cellpadding="3" cellspacing="0">
	<tr>
	 	<td><?php
			if ($view!='filter') {
				echo'    <b><a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=filter&oldview=' . urlencode($view) . '">',lang('filter_events'),'</a></b>';
			}
			else {
				echo '<b>',lang('filter_events'),'</b>';
			}
		?></td>
 	</tr>
	</table>
	<!-- End Filter -->

</td>
<!-- End Left Column -->