<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

	$previous_href = 'main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=month&timebegin='.urlencode(datetime2timestamp($minus_one_month['year'],$minus_one_month['month'],$minus_one_month['day'],12,0,"am")).$queryStringExtension; 
	$next_href = 'main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=month&timebegin='.urlencode(datetime2timestamp($plus_one_month['year'],$plus_one_month['month'],$plus_one_month['day'],12,0,"am")).$queryStringExtension;
?>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><b>&laquo;</b></td>
		<td style="padding-right: 8px;"><a href="<?php echo $previous_href; ?>" ><?php echo lang('previous_month'); ?></a></td>
		<td>|</td>
		<td style="padding-left: 8px;" align="right"><a href="<?php echo $next_href; ?>" ><?php echo lang('next_month'); ?></a></td>
		<td><b>&raquo;</b></td>
	</tr>
</table>