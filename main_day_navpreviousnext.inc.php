<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

	$minus_one_day = Add_Delta_Days($showdate['month'],$showdate['day'],$showdate['year'],-1);
	$plus_one_day = Add_Delta_Days($showdate['month'],$showdate['day'],$showdate['year'],1);
	$previous_href = 'main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&timebegin='.urlencode(datetime2timestamp($minus_one_day['year'],$minus_one_day['month'],$minus_one_day['day'],12,0,"am")).$queryStringExtension; 
	$next_href = 'main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&timebegin='.urlencode(datetime2timestamp($plus_one_day['year'],$plus_one_day['month'],$plus_one_day['day'],12,0,"am")).$queryStringExtension;
?>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><b>&laquo;</b></td>
		<td style="padding-right: 8px;"><a href="<?php echo $previous_href; ?>" ><?php echo lang('previous_day'); ?></a></td>
		<td>|</td>
		<td style="padding-left: 8px;" align="right"><a href="<?php echo $next_href; ?>" ><?php echo lang('next_day'); ?></a></td>
		<td><b>&raquo;</b></td>
	</tr>
</table>