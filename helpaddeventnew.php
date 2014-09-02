<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Add new event
</H3>
If you don't have any <A href="helptemplate.php">templates</A> predefined,
just go ahead and <A href="helpfillinevent.php">fill in the event information</A>.
<BR>
<BR>
In case you do have templates they will be shown to you so that you can pick
one.<BR>
You can also choose &quot;blank&quot;, meaning that you don't wish any fields
to be preset.
<?php
  helpbox_end();
?>