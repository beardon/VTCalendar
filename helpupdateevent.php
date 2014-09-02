<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Update event
</H3>
When you choose to update an existing event you can make changes or
<A href="helpfillinevent.php">fill in</A> additional information.<BR>
<BR>
Please keep in mind that the changes you make will have to be <A href="helpapproval.php">approved</A> again.<BR>
Therefore, they will <B>not be immediately visible</B> in the calendar.<BR>
<BR>
If your event is a recurring event you will be presented with the option to
either save the changes just for that one date (button &quot;Save changes&quot;)
or for all recurrences (button &quot;Save changes for ALL recurrences&quot;).

<?php
  helpbox_end();
?>