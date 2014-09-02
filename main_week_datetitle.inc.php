<?php
  if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

	echo Month_to_Text($weekfrom['month'])," ",$weekfrom['day'];
	if ($weekfrom['year'] != $weekto['year']) {
	 echo ", ".$weekfrom['year'];
	}
	echo " - ";
	if ($weekfrom['month'] != $weekto['month']) {
	 echo Month_to_Text($weekto['month'])," ";
	}
	echo $weekto['day'].", ".$weekto['year'];
?>