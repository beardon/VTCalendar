<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
What is &uml;iCalendar&uml;?
</H3>
iCalendar is an exchange format for scheduling information.
It can be used to transport calendaring information between different
applications and devices like personal information managers (PalmPilot, Pocket
PC etc.).
<BR>
To use the iCalendar feature in Calendar just click on the iCalendar icon. <BR>
<BR>
For more information check: <a href="http://www.ietf.org/rfc/rfc2445.txt">http://www.ietf.org/rfc/rfc2445.txt</a><BR>
<?php
  helpbox_end();
?>