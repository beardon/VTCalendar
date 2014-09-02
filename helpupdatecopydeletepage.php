<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Update/Copy/Delete event page
</H3>
You are presented with a list of all the events you have entered.<BR>
You can determine the order in which the events appear by clicking on one of
the three links on top of the list.<BR>
<BR>
Below the detailed event information you will see the current status of the
event. An event can be:
<UL>
  <LI>&quot;<FONT color="blue"><B>SUBMITTED</B></FONT>&quot; (waiting for <A href="helpapproval.php">approval</A> from
    the
calendar administrator),</LI>
  <LI>&quot;<FONT color="green"><B>APPROVED</B></FONT>&quot; (the event was approved and is displayed
in the calendar) or</LI>
  <LI>&quot;<FONT color="red"><B>REJECTED</B></FONT>&quot; (the reason for the rejection will
be indicated, so that you can make the appropriate changes and resubmit the event).</LI>
</UL>
For each event all the detailed information is displayed and you can choose
to either <A href="helpupdateevent.php">update</A>, <A href="helpcopyevent.php">copy</A>
or <A href="helpdeleteevent.php">delete</A> it.
<?php
  helpbox_end();
?>