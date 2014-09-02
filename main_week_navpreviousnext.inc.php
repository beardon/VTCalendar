<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

	$previous_href = 'main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=week&timebegin='.urlencode(datetime2timestamp($minus_one_week['year'],$minus_one_week['month'],$minus_one_week['day'],12,0,"am")).$queryStringExtension;
	$next_href = 'main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=week&timebegin='.urlencode(datetime2timestamp($plus_one_week['year'],$plus_one_week['month'],$plus_one_week['day'],12,0,"am")).$queryStringExtension;
?>
<table border="0" cellspacing="0" cellpadding="1">
	<tr>
		<td><b>&laquo;</b></td>
		<td style="padding-right: 8px;"><a href="<?php echo $previous_href; ?>" ><?php echo lang('previous_week'); ?></a></td>
		<td>|</td>
		<td style="padding-left: 8px;" align="right"><a href="<?php echo $next_href; ?>" ><?php echo lang('next_week'); ?></a></td>
		<td><b>&raquo;</b></td>
	</tr>
</table>