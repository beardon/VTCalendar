<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  $calendarok = FALSE;

  if ($database) {
    if (!DB::isError( $result = DBQuery($database, "SELECT count(id) FROM vtcal_calendar" ) )) {
		  $calendarok = TRUE;
    }
    $database->disconnect();
  }
?><healthCheck version=".9">
<test importance="1">
  <name>Calendar</name>
  <status><?php if ($calendarok) { echo "OK"; } else { echo "ERROR: ".DB::errorMessage($result); } ?></status>
</test>
</healthCheck>