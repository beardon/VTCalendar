<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Overview
</H3>
All new events and event updates have to be <A href="helpapproval.php">approved</A> before they are publicized.<BR>
<BR>
<A href="helpaddevent.php">How do I add an event?</A><BR>
<BR>
<A href="helpupdatecopydelete.php">How do I update/copy/delete?</A><BR>
<BR>
<A href="helptemplate.php">What is a template?</A><BR>
<BR>
<A href="helplogout.php">Login/Logout security issues</A>
<?php
  helpbox_end();
?>