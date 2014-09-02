<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Templates
</H3>
Are you entering <B>events with similar information</B> over and over?
Than <B>templates</B> are what you need to <B>save time</B>.<BR>
With templates you can <B>predefine input fields</B>
of the <A href="helpfillinevent.php">form you have to fill in when entering a new event</A>.
As an <B>example</B> suppose, that it is common for your organization
to host guest speakers.<BR>
<BR>
Here is what you can do:
<OL>
  <LI>
    <B>add a new template</B> with the name &quot;Guest speaker&quot;,
    <B>set the fields which usually do not change </B>like category, location,
    price and contact information
  </LI>
  <LI>
    <B>add new event</B> and <B>choose the template</B> you have just
    created from the list that will appear
  </LI>
  <LI>
    <B>fill out the remaining fields</B> of the form like data, title,
    description etc. and save the event.
  </LI>
</OL>
<?php
  helpbox_end();
?>