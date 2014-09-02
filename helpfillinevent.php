<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Fill in event information
</H3>
Every event is described by a number of parameters.
Only the fields <B>Date, Time, Category and Title are required</B>.<BR>
None of the other <A href="helpinputfields.php">input fields</A> is mandatory.<BR>
<BR>
After you have entered all your information press the &quot;Preview event&quot; button
at the bottom of the page. This will take you to a new page showing how your event
will look in the different views.<BR>
<BR>
Then you have the options to either save or go back to make changes. If you press
the &quot;Cancel&quot; button all your input will be discarded.<BR>
If you press <B>&quot;Save changes&quot;</B> your <B>event will be submitted
for <A href="helpapproval.php">approval</A></B> by the calendar administrator.<BR>
It might take <B>up to 24 hours until the changes are
reflected in the calendar</B>.<BR>
<?php
  helpbox_end();
?>