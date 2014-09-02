<?php
require_once('application.inc.php');

if (!isset($_GET['cancel']) || !setVar($cancel,$_GET['cancel'],'cancel')) unset($cancel);
if (!isset($_GET['importurl']) || !setVar($importurl,$_GET['importurl'],'importurl')) unset($importurl);
if (!isset($_GET['startimport']) || !setVar($startimport,$_GET['startimport'],'startimport')) unset($startimport);

if (!authorized()) { exit; }

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
	global $eventlist,$event,$eventnr,$date,$timebegin,$timeend,$error,$validcategory;

	// construct timestamps from the info $date, $timebegin, $timeend
	$event['sponsorid'] = $_SESSION['AUTH_SPONSORID'];
	if ($_SESSION['AUTH_ISCALENDARADMIN']) { $event['approved'] = 1; }
	else { $event['approved'] = 0; }
	$event['rejectreason'] = "";
	$event['repeatid'] = "";
	$event['timebegin'] = $date." ".$timebegin.":00";
	if (empty($timeend)) { $timeend = "23:59"; }
	$event['timeend'] = $date." ".$timeend.":00";
	$event['wholedayevent'] = ($timebegin == "00:00") && ($timeend == "23:59");

	// make sure that the previous event got all the input fields
	if (!(strlen($event['displayedsponsor']) <= MAXLENGTH_DISPLAYEDSPONSOR)) { feedback(lang('import_error_displayedsponsor').": ".htmlentities($event['displayedsponsor']),FEEDBACKNEG); $error = true; }
	if (!(strlen($event['displayedsponsorurl']) <= MAXLENGTH_URL && checkurl($event['displayedsponsorurl']))) { feedback(lang('import_error_displayedsponsorurl').": ".htmlentities($event['displayedsponsorurl']),FEEDBACKNEG); $error = true; }
	if (!(eventtimebeginvalid($event['timebegin']))) { feedback(lang('import_error_timebegin').": ".htmlentities($event['timebegin']),FEEDBACKNEG); $error = true; }
	if (!(eventtimeendvalid($event['timeend']))) { feedback(lang('import_error_timeend').": ".htmlentities($event['timeend']),FEEDBACKNEG); $error = true; }
	if (!(array_key_exists($event['categoryid'],$validcategory))) { feedback(lang('import_error_categoryid').": ".htmlentities($event['categoryid']),FEEDBACKNEG); $error = true; }
	if (!(!empty($event['title']) && strlen($event['title']) <= MAXLENGTH_TITLE)) { feedback(lang('import_error_title').": ".htmlentities($event['']),FEEDBACKNEG); $error = true; }
	if (!(strlen($event['description']) <= MAXLENGTH_DESCRIPTION)) { feedback(lang('import_error_description').": ".htmlentities($event['description']),FEEDBACKNEG); $error = true; }
	if (!(strlen($event['location']) <= MAXLENGTH_LOCATION)) { feedback(lang('import_error_location').": ".htmlentities($event['location']),FEEDBACKNEG); $error = true; }
	if (!(strlen($event['price']) <= MAXLENGTH_PRICE)) { feedback(lang('import_error_price').": ".htmlentities($event['price']),FEEDBACKNEG); $error = true; }
	if (!(strlen($event['contact_name']) <= MAXLENGTH_CONTACT_NAME)) { feedback(lang('import_error_contact_name').": ".htmlentities($event['contact_name']),FEEDBACKNEG); $error = true; }
	if (!(strlen($event['contact_phone']) <= MAXLENGTH_CONTACT_PHONE)) { feedback(lang('import_error_contact_phone').": ".htmlentities($event['contact_phone']),FEEDBACKNEG); $error = true; }
	if (!(strlen($event['contact_email']) <= MAXLENGTH_EMAIL)) { feedback(lang('import_error_contact_email').": ".htmlentities($event['contact_email']),FEEDBACKNEG); $error = true; }

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
		if (!$firstelement) { feedback(lang('import_error_events'),FEEDBACKNEG); } // <events> must always be the first element
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
		$event['displayedsponsor'] .= $data;
	}
	elseif (strtolower($xmlcurrentelement)=="displayedsponsorurl") {
		$event['displayedsponsorurl'] .= $data;
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
		$event['title'] .= $data;
	}
	elseif (strtolower($xmlcurrentelement)=="description") {
		$event['description'] .= $data;
	}
	elseif (strtolower($xmlcurrentelement)=="location") {
		$event['location'] .= $data;
	}
	elseif (strtolower($xmlcurrentelement)=="price") {
		$event['price'] .= $data;
	}
	elseif (strtolower($xmlcurrentelement)=="contact_name") {
		$event['contact_name'] .= $data;
	}
	elseif (strtolower($xmlcurrentelement)=="contact_phone") {
		$event['contact_phone'] .= $data;
	}
	elseif (strtolower($xmlcurrentelement)=="contact_email") {
		$event['contact_email'] .= $data;
	}
	
	// Append the URL to the end of the description.
	elseif (strtolower($xmlcurrentelement)=="url") {
		$event['description'] .= "\n\n".lang('more_information').': '.$data;
	}
} // end: function characterdata_importevents

// default error handler
function xmlerror_importevent($xml_parser) {
	echo "<br>\n";
	feedback("XML error: ".xml_error_string(xml_get_error_code($xml_parser))." at line ".xml_get_current_line_number($xml_parser),FEEDBACKNEG);
} // end: function xmlerror

pageheader(lang('import_events'), "Update");
contentsection_begin(lang('import_events'));

$showinputbox = 1;
if (isset($importurl)) {
	if (checkurl($importurl)) {
		// get list of valid category-IDs
		$result = DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."'" ); 
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
			feedback(lang('import_error_open_url')."<br>",FEEDBACKNEG);
		}
		if ($error) {
			feedback("<br>".lang('no_events_imported')."<br>",FEEDBACKNEG);
		}
		if (!$parsexmlerror) {
			if (!$error) {
				if ($eventnr > 0) {
					// determine sponsor name & URL
					$result = DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_sponsor WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' AND id='".sqlescape($event['sponsorid'])."'" ); 
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
						insertintoevent($eventid,$event);
						if ($_SESSION['AUTH_ISCALENDARADMIN']) {
							publicizeevent($eventid,$event);
						}
					}
					$showinputbox = 0;
					echo "<br>\n";
					feedback($eventnr." ".lang('events_successfully_imported'),FEEDBACKPOS);
				}
				else {
					feedback(lang('import_file_contains_no_events'),FEEDBACKNEG);
				}
			} // end: if (!$error) 
		} // end: if (!$parsexmlerror
	} // end: if (checkurl($importurl))
}
if ($showinputbox) {
	?>
	<form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
	<p><b><?php echo lang('enter_import_url_message'); ?></b></p>
	<p><input type="text" name="importurl" value="<?php 
	if (isset($importurl)) { echo $importurl; } ?>" size="60" maxlength="<?php echo MAXLENGTH_IMPORTURL; ?>"><br>
	<?php echo lang('enter_import_url_example'); ?></p>
	
	<p><input type="submit" name="startimport" value="<?php echo lang('ok_button_text'); ?>">
	<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>"></p>
	</form>
	
	<div style="background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>; padding: 4px;">
	<h2><?php echo lang('how_to_import'); ?></h2>
	<p><?php echo lang('help_import_intro'); ?></p>
	
<hr size="1">

<pre style="font-size:10pt">
&lt;events&gt;
	&lt;event&gt;
		&lt;displayedsponsor&gt;Athletics Department&lt;/displayedsponsor&gt;
		&lt;displayedsponsorurl&gt;http://www.hokiesports.com/&lt;/displayedsponsorurl&gt;
		&lt;date&gt;2000-03-15&lt;/date&gt;
		&lt;timebegin&gt;15:00&lt;/timebegin&gt;
		&lt;timeend&gt;&lt;/timeend&gt;
		&lt;categoryid&gt;9&lt;/categoryid&gt;
		&lt;title&gt;Baseball vs. Kent&lt;/title&gt;
		&lt;description&gt;VT is playing vs. Kent...&lt;/description&gt;
		&lt;location&gt;English Field&lt;/location&gt;
		&lt;price&gt;free&lt;/price&gt;
		&lt;contact_name&gt;Jennifer Meyers&lt;/contact_name&gt;
		&lt;contact_phone&gt;231-4933&lt;/contact_phone&gt;
		&lt;contact_email&gt;jmeyer@vt.edu&lt;/contact_email&gt;
		&lt;url&gt;http://www.hokiesportsinfo.com/baseball/&lt;/url&gt;
	&lt;/event&gt;
	&lt;event&gt;
		&lt;displayedsponsor&gt;Indian Student Association&lt;/displayedsponsor&gt;
		&lt;displayedsponsorurl&gt;http://fbox.vt.edu:10021/org/isa/&lt;/displayedsponsorurl&gt;
		&lt;date&gt;1999-11-06&lt;/date&gt;
		&lt;timebegin&gt;17:00&lt;/timebegin&gt;
		&lt;timeend&gt;21:00&lt;/timeend&gt;
		&lt;categoryid&gt;9&lt;/categoryid&gt;
		&lt;title&gt;Diwali '99&lt;/title&gt;
		&lt;description&gt;A two and half hour cultural show at Buruss Auditorium. 
		The show includes traditional Indian dance, a fashion show featuring traditional 
		clothes from different parts of India, a live orchestra playing popular hindi songs, 
		a tickle-your-belly skit based on the recent elections in India, a jam of guitar and 
		Indian classical musical instruments, children's show among others events.
		&lt;/description&gt;
		&lt;location&gt;Buruss Auditorium&lt;/location&gt;
		&lt;price&gt;free&lt;/price&gt;
		&lt;contact_name&gt;Akash Rai&lt;/contact_name&gt;
		&lt;contact_phone&gt;540-951-7764&lt;/contact_phone&gt;
		&lt;contact_email&gt;arai@vt.edu&lt;/contact_email&gt;
		&lt;url&gt;http://fbox.vt.edu:10021/org/isa/diwali99/&lt;/url&gt;
	&lt;/event&gt;
	&lt;event&gt;
		...
	&lt;/event&gt;
	...  
&lt;/events&gt;
</pre>

<hr size="1">

<p><?php echo lang('help_import_data_format_intro'); ?></p>

<?php
// read event categories from DB
$result =& DBQuery("SELECT * FROM ".SCHEMANAME."vtcal_category WHERE calendarid='".sqlescape($_SESSION['CALENDAR_ID'])."' ORDER BY name ASC" );
if (is_string($result)) {
	DBErrorBox($result); 
}
else {
	?>
	<table border="1" cellspacing="0" cellpadding="5">
		<tr>
			<th><?php echo lang('help_categoryid_index'); ?></th>
			<th><?php echo lang('help_categoryid_name'); ?></th>
		</tr>
	<?php
	
		// print list with categories and select the one read from the DB
		for ($i=0;$i<$result->numRows();$i++) {
			$category =& $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
			echo "  <tr>\n";
			echo "    <td>",$category['id'],"</td>";
			echo "    <td>",$category['name'],"</td>";
			echo "  </tr>";
		}
	?>
	</table>
	<?php
}
?>
</li>            
</ul>

<p><?php echo lang('help_import_data_format'); ?></p>
	
	
	</div>
	<?php
} // end: if ($showinputbox)

contentsection_end();
pagefooter();
DBclose();
?>