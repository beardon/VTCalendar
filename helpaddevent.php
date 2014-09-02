<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Add event
</H3>
You have 4 options:
<OL>
  <LI>create a <A href="helpaddeventnew.php">new event</A>
  by clicking on the &quot;Add new event&quot; link in the update menu</LI>
  <LI>use the icon <IMG src="images/addnewevent.gif" width="16" height="16" alt="new event" border="0">
  in the weekly/monthly view to create a <A href="helpaddeventnew.php">new event</A></LI>
  <LI><A href="helpupdatecopydelete.php">copy from an existing event</A> by clicking on the link
  &quot;Update/Copy/Delete event&quot; in the update menu</LI>
  <LI>define a <A href="helptemplate.php">template</A> and use it to create a <A href="helpaddeventnew.php">new event</A></LI>
</OL>
<?php
  helpbox_end();
?>