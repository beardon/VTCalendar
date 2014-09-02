<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  if (isset($_POST['userid'])) { setVar($userid,$_POST['userid'],'userid'); } else { unset($userid); }
  if (isset($_POST['password'])) { setVar($password,$_POST['password'],'password'); } else { unset($password); }
  if (isset($_GET['authsponsorid'])) { setVar($authsponsorid,$_GET['authsponsorid'],'sponsorid'); } else { unset($authsponsorid); }

  // the next if statement is just to avoid that it redirects when using in testing mode 
	if ( $_SERVER['HTTP_HOST'] != "localhost" ) {
		$protocol = "http";
		if ( isset($HTTPS)) { $protocol .= "s"; }
		if ( BASEURL != SECUREBASEURL && $protocol."://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"] != SECUREBASEURL."update.php" ) {
			redirect2URL(SECUREBASEURL."update.php?calendar=".$_SESSION["CALENDARID"]);
		}
  }

  $database = DBopen();
  if (!authorized($database)) { exit; }

	// read sponsor name from DB
	$result = DBQuery($database, "SELECT name FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 
	$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);

	pageheader("VT Event Calendar, Update Calendar",
						 "Update Calendar",
						 "Update","",$database);

	echo "<BR>";
  echo '<table cellspacing="0" cellpadding="0" border="0"><tr><td valign="top">'."\n";
	box_begin("inputbox","Sponsor's options");

  if ( isset($fbid) ) {
		if ($fbid=="eaddsuccess" && !$_SESSION["AUTH_ADMIN"]) {
			feedback(stripslashes(urldecode("The new event \"$fbparam\" has been submitted for approval.")),0);
			echo "<BR>";
		}
		elseif ($fbid=="eupdatesuccess" && !$_SESSION["AUTH_ADMIN"] ) {
			feedback(stripslashes(urldecode("The update for the event \"$fbparam\" has been submitted for approval.")),0);
			echo "<BR>";
		}
		elseif ($fbid=="urlchangesuccess") {
			feedback(stripslashes(urldecode("The address of your homepage was successfully changed to \"$fbparam\".")),0);
			echo "<BR>";
		}
		elseif ($fbid=="emailchangesuccess") {
			feedback(stripslashes(urldecode("Your email address was successfully changed to \"$fbparam\".")),0);
			echo "<BR>";
		}
  } // end: if ( isset($fbid) )
	  
  echo '<TABLE width="100%" border="0" cellspacing="1" cellpadding="3">';
?>
<TR>
  <TD class="inputbox">
    <A href="addevent.php">Add new event</A>
  </TD class="inputbox">
  <TD class="inputbox">
    &nbsp;&nbsp;&nbsp;<A target="newWindow" onclick="new_window(this.href); return false" href="helpaddevent.php"><IMG src="images/help.gif" width="16" height="16" alt="" border="0"></A>
  </TD>
</TR>
<TR>
  <TD class="inputbox">
    <A href="manageevents.php">Manage events</A>
  </TD>
  <TD class="inputbox">
    &nbsp;&nbsp;&nbsp;<A target="newWindow" onclick="new_window(this.href); return false" href="helpupdatecopydelete.php"><IMG src="images/help.gif" width="16" height="16" alt="" border="0"></A>
  </TD>
</TR>
<TR>
  <TD><br></TD>
  <TD><br></TD>
</TR>
<TR>
  <TD class="inputbox">
    <A href="managetemplates.php">Manage templates</A>
  </TD>
  <TD class="inputbox">
    &nbsp;&nbsp;&nbsp;<A target="newWindow" onclick="new_window(this.href); return false" href="helptemplate.php"><IMG src="images/help.gif" width="16" height="16" alt="" border="0"></A>
  </TD>
</TR>
<TR>
  <TD><br></TD>
  <TD><br></TD>
</TR>
<TR>
  <TD class="inputbox">
    <A href="export.php">Export events</A>
  </TD>
  <TD class="inputbox">
    &nbsp;&nbsp;&nbsp;<a target="newWindow" onclick="new_window(this.href); return false" href="helpexport.php"><img src="images/help.gif" width="16" height="16" alt="" border="0"></A>
  </TD>
</TR>
<TR>
  <TD class="inputbox">
    <A href="import.php">Import events</A>
  </TD>
  <TD class="inputbox">
    &nbsp;&nbsp;&nbsp;<A target="newWindow" onclick="new_window(this.href); return false" href="helpimport.php"><IMG src="images/help.gif" width="16" height="16" alt="" border="0"></A>
  </TD>
</TR>
<TR>
  <TD><br></TD>
  <TD><br></TD>
</TR>
<TR>
  <TD class="inputbox">
    <A href="changehomepage.php">Change homepage address</A>
  </TD>
</TR>
<TR>
  <TD class="inputbox">
    <A href="changeemail.php">Change email address</A>
  </TD>
</TR>
<TR>
  <TD class="inputbox">
<?php
	if ( AUTH_DB && strlen($_SESSION["AUTH_USERID"]) > strlen(AUTH_DB_USER_PREFIX) && substr($_SESSION["AUTH_USERID"],0,strlen(AUTH_DB_USER_PREFIX)) == AUTH_DB_USER_PREFIX ) {
?>
    <A href="changeuserpassword.php">Change password of user &quot;<?php echo $_SESSION["AUTH_USERID"]; ?>&quot;</A>
<?php
  } // end: if ( AUTH_DB ... )
?>&nbsp;
  </TD>
  <TD></TD>
</TR>
</TABLE>
<?php
 box_end();
?>
</td>
<?php
  if ($_SESSION["AUTH_ADMIN"]) {
		echo "<td valign=\"top\">\n";
		box_begin("inputbox","Administrator's options");
?>
<TABLE width="100%" border="0" cellspacing="1" cellpadding="3">
<TR>
  <TD class="inputbox">
    <A href="approval.php">Approve/reject event updates</A>
  </TD>
  <TD>&nbsp;</TD>
</TR>
<TR>
  <TD><br></TD>
  <TD><br></TD>
</TR>
<TR>
  <TD class="inputbox">
    <A href="managesponsors.php">Manage sponsors</A>
  </TD>
  <TD>&nbsp;</TD>
</TR>
<TR>
  <TD class="inputbox">
    <A href="deleteinactivesponsors.php">Delete inactive sponsors</A>
  </TD>
  <TD>&nbsp;</TD>
</TR>
<TR>
  <TD colspan="2"><br></TD>
</TR>
<TR>
  <TD class="inputbox">
    <a href="changecalendarsettings.php">Change header, footer, colors, authorization</a>
  </TD>
  <TD></TD>
</TR>
<TR>
  <TD class="inputbox">
    <a href="manageeventcategories.php">Manage event categories</a>
  </TD>
  <TD></TD>
</TR>
<TR>
  <TD class="inputbox">
    <a href="managesearchkeywords.php">Manage search keywords</a>
  </TD>
  <TD></TD>
</TR>
<TR>
  <TD class="inputbox">
    <a href="managefeaturedsearchkeywords.php">Manage featured search keywords</a>
  </TD>
  <TD></TD>
</TR>
<TR>
  <TD class="inputbox">
    <a href="viewsearchlog.php">View search log</a><br><br><br>
  </TD>
  <TD></TD>
</TR>
</table>
<?php
    box_end();
		echo "</td>\n";
  } // end: if ($_SESSION["AUTH_ADMIN"])
?>
<?php
  if ( $_SESSION["AUTH_MAINADMIN"] ) {
		echo "<td valign=\"top\">\n";
		box_begin("inputbox","Main Administrator's options");
?>
<TABLE width="100%" border="0" cellspacing="1" cellpadding="3">
<?php
	if ( AUTH_DB ) {
?>
<TR>
  <TD class="inputbox">
    <A href="manageusers.php">Manage users</A> <?php echo AUTH_DB_NOTICE; ?>
  </TD>
  <TD>&nbsp;</TD>
</TR>
<?php
  } // end: if ( AUTH_DB )
?>
<TR valign="top">
  <TD class="inputbox">
    <a href="managecalendars.php">Manage calendars</a>
  </TD>
  <TD>&nbsp;</TD>
</TR>
<TR valign="top">
  <TD class="inputbox">
    <a href="managemainadmins.php">Manage main admins</a>
  </TD>
  <TD>
	  &nbsp;<br><br><br><br><br><br><br><br><br><br><br><br><br>
	</TD>
</TR>
</table>
<?php
    box_end();
		echo "</td>\n";
  } // end: if ( $_SESSION["AUTH_MAINADMIN"] )
?>
</tr>
</table>
<BR>
<?php
  require("footer.inc.php");
?>