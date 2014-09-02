<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
How to post events
</H3>
Authorization can be obtained by contacting the calendar coordinator
 at <a href="mailto:<?php echo $_SESSION["ADMINEMAIL"]; ?>"><?php echo $_SESSION["ADMINEMAIL"]; ?></a>.
Please send an email containing:<br>
1) The name of your organization/club<BR>
2) The user-ID (the ID used to check e-mail) of the person(s) who will be entering information<br>
<BR>
<BR>
All event submissions will be reviewed by the calendar coordinator before
they are posted. Consequently, it is important to submit items at
least two days in advance of the event.
During the review process, submissions will be checked to see if they are
appropriate for posting and edited for clarity and conciseness.<BR>
<BR>
<?php
  helpbox_end();
?>