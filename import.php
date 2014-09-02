<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');
  require_once("xmlparser.inc.php");

  if (isset($_GET['cancel'])) { setVar($cancel,$_GET['cancel'],'cancel'); } else { unset($cancel); }
  if (isset($_GET['importurl'])) { setVar($importurl,$_GET['importurl'],'importurl'); } else { unset($importurl); }
  if (isset($_GET['startimport'])) { setVar($startimport,$_GET['startimport'],'startimport'); } else { unset($startimport); }


  $database = DBopen();
  if (!authorized($database)) { exit; }
  
	if (isset($cancel)) {
    redirect2URL("update.php");
    exit;
  }
// check that the time adheres to the standard "2000-03-22 15:00:00" 
function eventtimestampvalid($timestamp) {
  return strlen($timestamp) == 19 &&
         ereg("^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$",$timestamp) &&
         checkdate(substr($timestamp,5,2),substr($timestamp,8,2),substr($timestamp,0,4)) &&
         substr($timestamp,11,2) >= 0 && substr($timestamp,11,2) <= 23 &&
         substr($timestamp,14,2) >= 0 && substr($timestamp,14,2) <= 59 &&
         substr($timestamp,17,2) >= 0 && substr($timestamp,17,2) <= 59;
} // end: function eventtimevalid

// check that the timestamp for the starting time is valid
function eventtimebeginvalid($timebeginstamp) {
  return eventtimestampvalid($timebeginstamp);
} // end: function eventtimebeginvalid

// check that the timestamp for the ending time is valid
function eventtimeendvalid($timeendstamp) {
  return eventtimestampvalid($timeendstamp);
} // end: function eventtimeendvalid

function saveevent() {
global $eventlist,$event,$eventnr,
       $date,$timebegin,$timeend,$error,$validcategory;

  // construct timestamps from the info $date, $timebegin, $timeend
  $event['sponsorid'] = $_SESSION['AUTH_SPONSORID'];
	if ($_SESSION["AUTH_ADMIN"]) { $event['approved'] = 1; }
	else { $event['approved'] = 0; }
  $event['rejectreason'] = "";
  $event['repeatid'] = "";
  $event['timebegin'] = $date." ".$timebegin.":00";
  if (empty($timeend)) { $timeend = "23:59"; }
  $event['timeend'] = $date." ".$timeend.":00";
  $event['wholedayevent'] = ($timebegin == "00:00") && ($timeend == "23:59");
/*
  $event['displayedsponsor'] = addslashes($event['displayedsponsor']);
  $event['displayedsponsorurl'] = addslashes($event['displayedsponsorurl']);
  $event['title'] = addslashes($event['title']);
  $event['description'] = addslashes($event['description']);
  $event['location'] = addslashes($event['location']);
  $event['price'] = addslashes($event['price']);
  $event['contact_name'] = addslashes($event['contact_name']);
  $event['contact_phone'] = addslashes($event['contact_phone']);
  $event['contact_email'] = addslashes($event['contact_email']);
  $event['url'] = addslashes($event['url']);
*/

  // make sure that the previous event got all the input fields
  if (!(strlen($event['displayedsponsor']) <= MAXLENGTH_SPONSOR)) { feedback("Error!: &lt;displayedsponsor&gt; is too long.",FEEDBACKNEG); $error = true; }
  if (!(strlen($event['displayedsponsorurl']) <= MAXLENGTH_URL && checkurl($event['displayedsponsorurl']))) { feedback("Error!: &lt;displayedsponsorurl&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(eventtimebeginvalid($event['timebegin']))) { feedback("Error!: &lt;date&gt; and/or &lt;timebegin&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(eventtimeendvalid($event['timeend']))) { feedback("Error!: &lt;date&gt; and/or &lt;timeend&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(array_key_exists($event['categoryid'],$validcategory))) { feedback("Error!: &lt;categoryid&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(!empty($event['title']) && strlen($event['title']) <= MAXLENGTH_TITLE)) { feedback("Error!: &lt;title&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(strlen($event['description']) <= MAXLENGTH_DESCRIPTION)) { feedback("Error!: &lt;description&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(strlen($event['location']) <= MAXLENGTH_LOCATION)) { feedback("Error!: &lt;location&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(strlen($event['price']) <= MAXLENGTH_PRICE)) { feedback("Error!: &lt;price&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(strlen($event['contact_name']) <= MAXLENGTH_CONTACT_NAME)) { feedback("Error!: &lt;contact_name&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(strlen($event['contact_phone']) <= MAXLENGTH_CONTACT_PHONE)) { feedback("Error!: &lt;contact_phone&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(strlen($event['contact_email']) <= MAXLENGTH_CONTACT_EMAIL)) { feedback("Error!: &lt;contact_email&gt; is invalid.",FEEDBACKNEG); $error = true; }
  if (!(strlen($event['url']) <= MAXLENGTH_URL && checkurl($event['url']))) { feedback("Error!: &lt;url&gt; is invalid.",FEEDBACKNEG); $error = true; }

  // save all the data of the previous event in the array
	if (!$error) {
	  $eventnr++;
    $eventlist[$eventnr] = $event;
  }
} // end: function saveevent

// XML parser element handler for start element
function xmlstartelement_importevent($parser, $element, $attrs) {
  global $xmlcurrentelement,$xmlelementattrs,
         $firstelement,$event,$eventnr,
         $date,$timebegin,$timeend,$error;

  $xmlcurrentelement = $element;
  $xmlelementattrs = $attrs;

  if (strtolower($xmlcurrentelement)=="events") {
    if (!$firstelement) { feedback("Error!: &lt;events&gt; must be the first element.",FEEDBACKNEG); } // <events> must always be the first element
  }
  elseif (strtolower($xmlcurrentelement)=="event") {
    // start new element
    $date = "";
    $timebegin = "";
    $timeend = "";
		$event['displayedsponsor']="";
		$event['displayedsponsorurl']="";
		$event['categoryid']="";
		$event['title']="";
		$event['description']="";
		$event['location']="";
		$event['price']="";
		$event['contact_name']="";
		$event['contact_phone']="";
		$event['contact_email']="";
		$event['url']="";
  }
  
  $firstelement = 0;
}

// XML parser element handler for end element
function xmlendelement_importevent($parser, $element) {
  global $xmlcurrentelement,$xmlelementattrs,$event,$error;

  $xmlcurrentelement = "";
  $xmlelementattrs = "";

  if (strtolower($element)=="event") { saveevent(); }
}

function xmlcharacterdata_importevent($parser, $data) {
  global $xmlcurrentelement,$xmlelementattrs,
         $firstelement,$eventlist,$event,$eventnr,
         $date,$timebegin,$timeend,$error;
  
  if (strtolower($xmlcurrentelement)=="displayedsponsor") {
    $event['displayedsponsor'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="displayedsponsorurl") {
    $event['displayedsponsorurl'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="date") {
    $date = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="timebegin") {
    $timebegin = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="timeend") {
    $timeend = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="categoryid") {
    $event['categoryid'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="title") {
    $event['title'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="description") {
    $event['description'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="location") {
    $event['location'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="price") {
    $event['price'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="contact_name") {
    $event['contact_name'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="contact_phone") {
    $event['contact_phone'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="contact_email") {
    $event['contact_email'] = $data;
  }
  elseif (strtolower($xmlcurrentelement)=="url") {
    $event['url'] = $data;
  }
} // end: function characterdata_importevents

// default error handler
function xmlerror_importevent($xml_parser) {
  echo "<br>\n";
  feedback("XML error: ".xml_error_string(xml_get_error_code($xml_parser))." at line ".xml_get_current_line_number($xml_parser),FEEDBACKNEG);
} // end: function xmlerror

  pageheader("VT Event Calendar, Import Events from a remote location",
             "Import Events from a remote location",
             "","",$database);
  echo "<BR>";
  box_begin("inputbox","Import events");
  
  $showinputbox = 1;
  if (isset($importurl)) {
    if (checkurl($importurl)) {
      // get list of valid category-IDs
			$result = DBQuery($database, "SELECT * FROM vtcal_category WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."'" ); 
			for($i=0; $i<$result->numRows(); $i++) {
  			$category = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			  $validcategory[$category['id']] = true;
			}
			
      // open remote file and parse it
      $firstelement = 1;
      $eventnr = 0;
			$error = false;
      $parsexmlerror = parsexml("$importurl", "xmlstartelement_importevent", 
                                 "xmlendelement_importevent", 
                                 "xmlcharacterdata_importevent",
                                 "xmlerror_importevent");
      if ($parsexmlerror == FILEOPENERROR) {
        feedback("Error: Cannot open import file. Please check the URL.<br>",FEEDBACKNEG);
      }
      if ($error) {
        feedback("<br>No events were imported.<br>",FEEDBACKNEG);
      }
      if (!$parsexmlerror) {
			  if (!$error) {
					if ($eventnr > 0) {
						// determine sponsor name & URL
						$result = DBQuery($database, "SELECT * FROM vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' AND id='".sqlescape($event['sponsorid'])."'" ); 
						$sponsor = $result->fetchRow(DB_FETCHMODE_ASSOC,0);
					
						$id = getNewEventId();
						$id1 = substr($id,0,10);
						for ($i=1; $i<=$eventnr; $i++) {
							$event = $eventlist[$i];
							if (empty($event['displayedsponsor'])) { $event['displayedsponsor']=$sponsor['name']; }
							if (empty($event['displayedsponsorurl'])) { $event['displayedsponsorurl']=$sponsor['url'];	}
							$id1++;
							$eventid = $id1."000";
							$event['id'] = $eventid;
							insertintoevent($eventid,$event,$database);
							if ($_SESSION["AUTH_ADMIN"]) {
								publicizeevent($eventid,$event,$database);
							}
						}
						$showinputbox = 0;
						echo "<br>\n";
						feedback("$eventnr events were successfully imported.",FEEDBACKPOS);
						echo "<br>\n";
						echo "<form method=\"post\" action=\"update.php\">\n";
						echo '  <input type="submit" name="back" value="Back to sponsor\'s options">',"\n";
						echo "</form>\n";
					}
					else {
						feedback("The import file does not contain any events.",FEEDBACKNEG);
					}
        } // end: if (!$error) 
			} // end: if (!$parsexmlerror
    } // end: if (checkurl($importurl))
  }
  if ($showinputbox) {
?>
<a target="main" href="helpimport.php"><img src="images/help.gif" width="16" height="16" alt="" border="0"> How do I import events?</a>
<form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<b>Please enter the full URL of the XML file containing the events you want to add.</b><br>
<br>
<input type="text" name="importurl" value="<?php 
if (isset($importurl)) { echo $importurl; } ?>" size="60" maxlength="<?php echo constImporturlMaxLength; ?>"><br>
(e.g. &quot;http://www.vtmc.vt.edu/rec/newevents.xml&quot;)<br>
<br>
<input type="submit" name="startimport" value="&nbsp;&nbsp;&nbsp;&nbsp;OK&nbsp;&nbsp;&nbsp;&nbsp;">
<INPUT type="submit" name="cancel" value="Cancel">
</form>
<?php
  } // end: if ($showinputbox)
  box_end();
  echo "<BR>";

  require("footer.inc.php");
?>