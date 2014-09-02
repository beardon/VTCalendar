<?php
	if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

	echo day_view_date_format($showdate['day'], Day_of_Week_to_Text(Day_of_Week($showdate['month'],$showdate['day'],$showdate['year'])),Month_to_Text($showdate['month']),$showdate['year']);
?>