<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  if (!authorized($database)) { exit; }

  if (isset($_POST['cancel'])) { setVar($cancel,$_POST['cancel'],'cancel'); } else { unset($cancel); }
  if (isset($_POST['save'])) { setVar($save,$_POST['save'],'save'); } else { unset($save); }
  if (isset($_POST['sponsor_url'])) { setVar($sponsor_url,$_POST['sponsor_url'],'sponsor_url'); } else { unset($sponsor_url); }

  if (isset($cancel)) {
    redirect2URL("update.php");
    exit;
  }

  // read sponsor name from DB
  $result = DBQuery($database, "SELECT name FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 
  $sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);

  if (isset($save)) {
    $sponsor['url']=$sponsor_url;
    if (checkURL($sponsor['url'])) { // url is valid
      // save url to DB
      $result = DBQuery($database, "UPDATE vtcal_sponsor SET url='".sqlescape($sponsor_url)."' WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 

      // reroute to sponsormenu page
      redirect2URL("update.php?fbid=urlchangesuccess&fbparam=".urlencode(stripslashes($sponsor_url)));
      exit;
    }
  }
  else
  { // read the sponsor's url from the DB
    $result = DBQuery($database, "SELECT * FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($_SESSION["AUTH_SPONSORID"])."'" ); 
    $sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
  } // end else: if (isset($save))
  

  pageheader("VT Event Calendar, Change Homepage Address",
             "Change Homepage",
	           "","",$database);
  echo "<BR>";
  box_begin("inputbox","Change homepage address");
?>
<B>Please enter the address of your organization's homepage:</B><BR>
<I>(Make sure to enter the full URL including &quot;http://&quot;.)</I>
<FORM method="post" action="changehomepage.php">
<?php
  if (!checkURL($sponsor['url'])) {
    feedback("The URL is invalid. Please make sure that you enter: &quot;http://&quot; in front.",1);
?>
  <BR>
<?php
  } /* end: if ($checkURL($sponsor[url])) */
?>
  <INPUT type="text" name="sponsor_url" maxlength="<?php echo constUrlMaxLength; ?>" size="60" value="<?php echo HTMLSpecialChars($sponsor['url']); ?>">
  <BR>
  <BR>
  <INPUT type="submit" name="save" value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;">
  <INPUT type="submit" name="cancel" value="Cancel">
</FORM>
<?php
  box_end();
  echo "<BR>";
  require("footer.inc.php");
?>