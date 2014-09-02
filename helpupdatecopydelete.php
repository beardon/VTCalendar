<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Update/Copy/Delete event
</H3>
You have 2 options:
<OL>
  <LI>click on the <A href="helpupdatecopydeletepage.php">&quot;Update/Copy/Delete event&quot; link</A> in the update menu</LI> or
  <LI>in the weekly/monthly view use the icon <IMG src="images/edit.gif" width="16" height="16" alt="update event" border="0">
   to <A href="helpupdateevent.php">update</A>, <IMG src="images/copy.gif" width="17" height="16" alt="copy event" border="0"> to
   <A href="helpcopyevent.php">copy</A> or <IMG src="images/trashcan.gif" width="13" height="16" alt="delete event" border="0"> to <A href="helpdeleteevent.php">delete</A> an event</LI>
</OL>
<?php
  helpbox_end();
?>