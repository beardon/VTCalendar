<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
?><table width="100%" border="0" cellpadding="0" cellspacing="5">
				<tr valign="top">
				<td>
<?php
	// check if some input params are set, and if not set them to default
	if (!isset($timebegin_year))  { $timebegin_year = $today['year']; }
	if (!isset($timebegin_month)) { $timebegin_month = $today['month']; }
	if (!isset($timebegin_day))   { $timebegin_day = $today['day']; }

	if (!isset($timeend_year)) { $timeend_year = $timebegin_year; }
	if (!isset($timeend_month)) {
		$timeend_month = $timebegin_month+6;
		if ($timeend_month >= 13) {
			$timeend_month = $timeend_month-12;
			$timeend_year++;
		}
	}
	if (!isset($timeend_day)) {
		$timeend_day = $timebegin_day;
		while (!checkdate($timeend_month,$timeend_day,$timeend_year)) { $timeend_day--; };
	}
?>
<br>
<form method="get" action="main.php" name="searchform">
	<input type="hidden" name="calendarid" value="<?php echo urlencode($_SESSION['CALENDAR_ID']); ?>">
	<input type="hidden" name="view" value="searchresults">
	<table border="0" cellpadding="3" cellspacing="2">
		<tr>
			<td class="bodytext" valign="baseline">
				<strong><?php echo lang('keyword'); ?>:&nbsp;&nbsp;&nbsp;</strong>
			</td>
			<td class="bodytext" valign="baseline">
				<input type="text" size="40" name="keyword" value="<?php echo $keyword; ?>" maxlength="<?php echo MAXLENGTH_KEYWORD; ?>"><br>
				<?php echo lang('case_insensit'); ?><br>
				<br>
			</td>
		</tr>
		<tr>
			<td class="bodytext" valign="baseline">
				<strong><?php echo lang('starting_from'); ?></strong>
			</td>
			<td class="bodytext" valign="baseline">

<?php
inputdate($timebegin_month,"timebegin_month",
	$timebegin_day,"timebegin_day",
	$timebegin_year,"timebegin_year");
?>

					</td></tr>
						<tr>
							<td>&nbsp;</td>
							<td><br><input type="submit" name="search" value="&nbsp;&nbsp;&nbsp;<?php echo lang('search'); ?>&nbsp;&nbsp;&nbsp;"></td>
						</tr>
					
				</table>
	<br>
</form>				
				</td>
				</tr>
			</table>
<script language="JavaScript1.2"><!--
	document.searchform.keyword.focus();
//--></script>