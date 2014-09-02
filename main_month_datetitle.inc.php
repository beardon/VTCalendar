<?php
  if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

  echo Month_to_Text($showdate['month'])," ",$showdate['year'];
?>