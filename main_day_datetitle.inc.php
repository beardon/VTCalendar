<?php
  if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

  echo Day_of_Week_to_Text(Day_of_Week($showdate['month'],$showdate['day'],$showdate['year'])),", ";
  echo Month_to_Text($showdate['month'])," ",$showdate['day'],", ",$showdate['year'];
	 
  if (!empty($_SESSION["AUTH_SPONSORID"])) { // display "add event" icon
    echo " <a href=\"addevent.php?timebegin_year=".$showdate['year']."&timebegin_month=".$showdate['month']."&timebegin_day=".$showdate['day']."\">";
    echo '<img src="images/addnewevent.gif" height="16" width="16" alt="add new event" border="0"></a>';
  }
?>