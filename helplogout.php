<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Login/Logout security issues
</H3>
Make sure you always logout after you are done entering or updating events.<BR>
<BR>
Alternatively to clicking on the &quot;logout&quot; link you can also close
<B>all</B> windows of your web browser.<BR>
Be aware that if there is at least one window open
(even if it displays a different web page) you are still logged in.
<?php
  helpbox_end();
?>