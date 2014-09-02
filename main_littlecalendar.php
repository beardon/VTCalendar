<?php
require_once('application.inc.php');
require_once('main_globalsettings.inc.php');

displayMonthSelector();
displayLittleCalendar($month, $view, $showdate, $queryStringExtension);

function displayLittleCalendar($month, $view, $showdate, $queryStringExtension) {
	global $week_start;
	global $day_beg_h, $day_end_h;
	
	$today = Decode_Date_US(date("m/d/Y", NOW));
	
	/*$plus_one_month['day']   = 1;
	$plus_one_month['month'] = $month['month'] + 1;
	$plus_one_month['year']  = $month['year'];
	if ($plus_one_month['month'] == 13) {
		$plus_one_month['month'] = 1;
		$plus_one_month['year']++;
	}*/

	// date of first Sunday or Monday according to week beginning day in month1
	$month['dow'] = Day_of_Week($month['month'],1,$month['year']);

	// $week_correction - variable to make one week correction according to week's starting weekday
	if ($week_start == 1 && $month['dow'] == 0){
		$week_correction=7;
	} else {
		$week_correction=0;
	}

	$monthstart = Add_Delta_Days($month['month'],1,$month['year'],-$month['dow']+$week_start-$week_correction);

	// when does this particular week start and end?
	$dow = Day_of_Week($showdate['month'],$showdate['day'],$showdate['year']);
	$weekfrom = Add_Delta_Days($showdate['month'],$showdate['day'],$showdate['year'],-$dow+$week_start); //if $week_start is 1 we get Monday as week's start
	$weekto = Add_Delta_Days($showdate['month'],$showdate['day'],$showdate['year'],6-$dow+$week_start); //if $week_start is 1 we get Sunday week's end

	?>
	<!-- Start Little Calendar -->
	<div id="LittleCalendar-Padding">
	<table id="LittleCalendar" border="0" cellpadding="3" cellspacing="0">
		<!-- Start Calendar Column Titles (Names of the day of the week) -->
		<thead>
		<tr>
			<td align="center" width="16%" nowrap>&nbsp;</td>
			<?php if($week_start == 0){?>
				<td align="center" width="12%" nowrap><?php echo lang('lit_cal_sun'); ?></td>
			<?php } ?>
			<td align="center" width="12%" nowrap><?php echo lang('lit_cal_mon');?></td>
			<td align="center" width="12%" nowrap><?php echo lang('lit_cal_tue');?></td>
			<td align="center" width="12%" nowrap><?php echo lang('lit_cal_wed');?></td>
			<td align="center" width="12%" nowrap><?php echo lang('lit_cal_thu');?></td>
			<td align="center" width="12%" nowrap><?php echo lang('lit_cal_fri');?></td>
			<td align="center" width="12%" nowrap><?php echo lang('lit_cal_sat');?></td>
			<?php if($week_start == 1){?>
				<td align="center" width="12%" nowrap><?php echo lang('lit_cal_sun');?></td>
			<?php } ?>
		</tr>
		</thead>
		<!-- End Calendar Column Titles -->
		
		<!-- Start Calendar Body -->
		<tbody>
		<?php 
		// print 6 lines for the weeks
		for ($iweek=1; $iweek<=6; $iweek++) {
			// first day of the week
			$weekstart = Add_Delta_Days($monthstart['month'],$monthstart['day'],$monthstart['year'],($iweek-1)*7);
			$weekstart['timestamp'] = datetime2timestamp($weekstart['year'],$weekstart['month'],$weekstart['day'],12,0,"am");
			
			// print the 5th and the 6th week only if the days are still in this month
			if (($iweek < 5) || ($weekstart['month'] == $month['month'])) {
				echo "<tr>\n";
				
				// output the link to the week
				echo '<td class="LittleCalendar-Week" nowrap valign="top" align="left">';
				echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=week&amp;timebegin='.urlencode($weekstart['timestamp']).'">'.lang('lit_cal_week')."&gt;</a></td>\n";
				
				// output event info for every day
				for ($weekday = 0; $weekday <= 6; $weekday++) {
					// calculate the appropriate day for the cell of the calendar
					$iday = Add_Delta_Days($monthstart['month'],$monthstart['day'],$monthstart['year'],($iweek-1)*7+$weekday);
					//$iday['timebegin'] = datetime2timestamp($iday['year'],$iday['month'],$iday['day'],0,0,"am");
					//$iday['timeend']   = datetime2timestamp($iday['year'],$iday['month'],$iday['day'],11,59,"pm");
					
					echo '<td nowrap ';
					
					if ( $view == "day" || $view == "event" ) { 
						if ( $iday['day']==$showdate['day'] && $iday['month']==$showdate['month'] && $iday['year']==$showdate['year']) {
							echo 'class="SelectedDay" ';
						}
					} 
					else if ( $view == "week" ) { 
						$datediff1 = Delta_Days($weekfrom['month'],$weekfrom['day'],$weekfrom['year'],$iday['month'],$iday['day'],$iday['year']);				
						$datediff2 = Delta_Days($iday['month'],$iday['day'],$iday['year'],$weekto['month'],$weekto['day'],$weekto['year']);
						if ( $datediff1 >= 0 && $datediff2 >= 0 ) {
							echo 'class="SelectedDay" ';
						}
					}
					else if ( $view == "month" ) { 
						if ($iday['month']==$showdate['month'] && $iday['year']==$showdate['year']) {
							echo 'class="SelectedDay" ';
						}
					}
					
					echo 'valign="top" align="center">';
					
					echo '<a ';
					if ( $iday['day']==$today['day'] && $iday['month']==$today['month'] && $iday['year']==$today['year']) {
						$DayLinkClass = "Today";
					}
					else {
						$DayLinkClass = "";
					}
					if ( $iday['month']!=$month['month'] ) {
						$DayLinkClass .= "GrayedOut";
					}
					if (isset($DayLinkClass)) {
						echo 'class="LittleCal-'.$DayLinkClass.'" ';
					}
					// "&timeend=",urlencode(datetime2timestamp($iday['year'],$iday['month'],$iday['day'],11,59,"pm")),
					echo 'href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&amp;timebegin=', urlencode(datetime2timestamp($iday['year'],$iday['month'],$iday['day'],12,0,"am")) . $queryStringExtension . '">';
					echo $iday['day'];
					echo '</a>';
					
					echo "</td>\n";
				} // end: for ($weekday = 0; $weekday <= 6; $weekday++)
				echo "</tr>\n";
			} // end: if (($iweek < 5) || ($weekstart[month] == $month[month])
		} // end: for ($iweek=1; $iweek<=6; $iweek++)
		?>
		</tbody>
		<!-- End Calendar Body -->
	</table>
	</div>
	<!-- End Little Calendar -->
	<?php
}

/**
 * Outputs the content for the "Month Selector" in the left column.
 */
function displayMonthSelector() {
	global $view, $minus_one_month, $plus_one_month, $enableViewMonth, $month, $queryStringExtension, $timebegin, $showdate;
	?>
	<!-- Start Month Selector -->
	<table id="MonthSelector" width="100%" border="0" cellpadding="3" cellspacing="0">
		<tr>
			<!-- Left Arrow Button -->
			<td align="left" valign="middle" width="17"><div id="LeftArrowButton"><a title="<?php echo lang('previous_month'); ?>" href="<?php
			echo 'main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view='.$view."&timebegin=".urlencode(datetime2timestamp($minus_one_month['year'],$minus_one_month['month'],$minus_one_month['day'],12,0,"am"));
			echo $queryStringExtension;
			?>" onclick="return ChangeCalendar('Left','<?php
			echo "main_littlecalendar.php?view=".$view;
			echo "&littlecal=".urlencode(datetime2timestamp($minus_one_month['year'],$minus_one_month['month'],$minus_one_month['day'],12,0,"am"));
			echo "&timebegin=".urlencode($timebegin);
			echo $queryStringExtension;
			?>');"><b>&laquo;</b></a></div><div id="LeftArrowButtonDisabled" style="display: none;"><b>&laquo;</b></div></td>
			<!-- Date Label -->
			<td align="center" nowrap valign="middle"><b><?php
					if ( ($view == "month" && $showdate['month'] == $month['month'] && $showdate['year'] == $month['year'] ) || !$enableViewMonth ) {
						echo above_lit_cal_date_format (Month_to_Text($month['month']), $month['year']);
					}
					else {
						echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=month&amp;timebegin=' . urlencode(datetime2timestamp($month['year'],$month['month'],$month['day'],12,0,"am"));
						echo $queryStringExtension;
						echo '">';
						echo above_lit_cal_date_format( Month_to_Text($month['month']), $month['year'] );
						echo "</a>";
					}
				?></b></td>
			<!-- Right Arrow Button -->
			<td align="right" valign="middle" width="17"><div id="RightArrowButton"><a title="<?php echo lang('next_month'); ?>" href="<?php
			echo 'main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view='.$view."&timebegin=".urlencode(datetime2timestamp($plus_one_month['year'],$plus_one_month['month'],$plus_one_month['day'],12,0,"am"));
			echo $queryStringExtension;
			?>" onclick="return ChangeCalendar('Right','<?php
			echo "main_littlecalendar.php?view=".$view;
			echo "&littlecal=".urlencode(datetime2timestamp($plus_one_month['year'],$plus_one_month['month'],$plus_one_month['day'],12,0,"am"));
			echo "&timebegin=".urlencode($timebegin);
			echo $queryStringExtension;
			?>');"><b>&raquo;</b></a></div><div id="RightArrowButtonDisabled" style="display: none;"><b>&raquo;</b></div></td>
		</tr>
	</table>
	<!-- End Month Selector -->
	<?php
}
?>