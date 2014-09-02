<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>                      
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Delete event
</H3>

Before the event is deleted from the calendar you will have to confirm your
deletion.<BR>
If your event is a recurring event you will be presented with the option to
either delete the event on just that specific date (button &quot;Delete this event&quot;)
or delete all recurrences (button &quot;Delete ALL recurrences of this event&quot;).<BR>
<BR>
The event will be immediately removed from the calendar.
<?php
  helpbox_end();
?>