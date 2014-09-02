<?php // prohibits direct calling of include files
if (!defined("ALLOWINCLUDES")) { exit; } ?>

<!-- Start Body Column -->
<td id="CalRightCol" width="100%" valign="top" <?php if ($IsTodayBodyColor) echo 'class="TodayHighlighted"'; ?>>
	
	<!-- Start Filter and Search Keyword Notice -->
	<?php
		if (($view == "upcoming" || $view == "day" || $view == "week" || $view == "month" || $view == "search" || $view == "searchresults") && (isset($CategoryFilter) || (!empty($keyword) && $view != "search" && $view != "searchresults"))) {
			?><table id="FilterNotice" width="100%" border="0" cellpadding="4" cellspacing="0">
			<tr>
				<td><b><?php echo lang('showing_filtered_events'); ?>:</b><?php
				
				if (!empty($keyword)) {
					?> <a href="">&quot;<?php echo htmlentities($keyword); ?>&quot;</a><?php
				}
				
				if (!empty($keyword) && isset($CategoryFilter)) {
					echo " &amp; ";
				}
				
				if (isset($CategoryFilter)) {
					?> <a href="main.php?calendarid=<?php echo $_SESSION['CALENDAR_ID']; ?>&view=filter&oldview=<?php echo urlencode($view); ?>">(<?php 
					
					// The list of categories that will be outputted.
					$activecategories = "";
					
					// Create a lookup for getting the array index by category ID.
					$CategoryIdFlip = array_flip($categories_id);
					
					for ($i = 0; $i < count($CategoryFilter) && strlen($activecategories) <= 70; $i++) {
						if (isset($CategoryIdFlip[$CategoryFilter[$i]])) {
							if ($i > 0) $activecategories .= ", ";
							$activecategories .= $categories_name[$CategoryIdFlip[$CategoryFilter[$i]]];
						}
					}
					
					// Add an elipse if the output got too long.
					if (strlen($activecategories) > 70) $activecategories .= ", ...";
					
					// Output the list of categories.
					echo $activecategories;
					
					?>)</a><?php
				}
				
				?></td>
			</tr>
			</table><?php
		}
	?>
	<!-- End Filter and Search Keyword Notice -->
	
	<!-- Start Date/Title and Next/Prev Navi -->
	<div id="TitleAndNavi" <?php if ($IsTodayBodyColor) echo 'class="TodayHighlighted"'; ?>>
	<table border="0" cellpadding="4" cellspacing="0">
		<tr>
			<td id="DateOrTitle"><h2><?php require ( "main_".$view."_datetitle.inc.php" ); ?></h2></td>
			<td id="NavPreviousNext" align="right"><?php require ( "main_".$view."_navpreviousnext.inc.php" ); ?></td>
		</tr>
	</table>
	</div>
	<!-- End Date/Title and Next/Prev Navi -->
	
	<!-- Start Body -->
	<table width="100%" border="0" cellpadding="8" cellspacing="0">
		<tr>
			<td id="CalendarContent"><?php require ( "main_".$view."_body.inc.php" ); ?></td>
		</tr>
	</table>
	<!-- End Body -->

</td>
<!-- End Body Column -->