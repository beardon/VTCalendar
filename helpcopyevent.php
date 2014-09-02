<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Copy event
</H3>

When you choose to copy an existing event all the input fields for the new
event you are creating will be copied from the one you have chosen.<BR>
If you chose a recurring event the recurrence information will also be
copied.<BR>
<BR>
You can make changes or <A href="helpfillinevent.php">fill in</A> additional information.<BR>
<BR>
Please keep in mind that the event you create will have to be <A href="helpapproval.php">approved</A>.<BR>
Therefore, it will <B>not be immediately visible</B> in the calendar.<BR>
<?php
  helpbox_end();
?>