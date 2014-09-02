<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Approval of submitted events
</H3>
For security reasons, every update to the event calendar has to be <B>approved
by the calendar administrator.</B><BR>
<BR>
The administrator 
reviews submitted events and updates. Event information may be approved or rejected.<BR>
<BR>
If an update is rejected the information is not publicized; instead, the event is marked with a short comment
stating the reason for the rejection. By editing a rejected event you can re-submit the information which will
then be checked the following weekday.<BR>
<BR>
Because of the approval mechanism the <B>submitted updates are not immediately publicized</B>.<BR>
<BR>
If you delete an event from the calendar an approval is not necessary.
The event information will be instantly removed from the calendar.

<?php
  helpbox_end();
?>