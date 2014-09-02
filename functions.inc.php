<?php
/* Misc functions:
----------------------------------------------------
function getNewEventId()
function feedback($msg,$type)
function verifyCancelURL($httpreferer)
function redirect2URL($url)
function getFullCalendarURL($calendarid)
function sendemail2sponsor($sponsorname,$sponsoremail,$subject,$body)
function sendemail2user($useremail,$subject,$body)
function highlight_keyword($keyword, $text)
function make_clickable($text)
function removeslashes(&$event)
function checkURL($url)
function checkemail($email)
function setVar(&$var,$value,$type)
function lang($sTextKey)
function escapeJavaScriptString($string) */
require_once("functions-misc.inc.php");


/* IO functions:
----------------------------------------------------
function file_get_contents($filename, $flags = false, $resource_context = null, $offset = 0, $maxlen = 0)
function file_put_contents($filename, $content, $flags = null, $resource_context = null) */
require_once("functions-io.inc.php");


/* Generic database functions:
----------------------------------------------------
function DBopen()
function DBclose()
function DBQuery($query) */
require_once("functions-db-generic.inc.php");


/* Functions that handle authentication:
----------------------------------------------------
function checknewpassword(&$user)
function checkoldpassword(&$user,$userid)
function displaylogin($errormsg="")
function displaymultiplelogin($errorMessage="")
function displaynotauthorized()
function userauthenticated($userid,$password)
function authorized()
function viewauthorized()
function logout() */
require_once("functions-authentication.inc.php");


/* Get various information from the database:
----------------------------------------------------
function getCalendarData($calendarid)
function calendar_exists($calendarid)
function setCalendarPreferences()
function getNumCategories()
function getCategoryName($categoryid)
function getCalendarName($calendarid)
function getSponsorCalendarName($sponsorid)
function getSponsorName($sponsorid)
function getSponsorURL($sponsorid)
function num_unapprovedevents($repeatid)
function userExistsInDB($userid)
function isValidUser($userid) */
require_once("functions-db-gets.inc.php");


/* Set various information to the database:
----------------------------------------------------
function AddMainAdmin($username)
function AddUser($username, $password) */
require_once("functions-db-sets.inc.php");


/* VTCalendar specific date/time conversions and formatting:
----------------------------------------------------
function printeventdate(&$event)
function printeventtime(&$event)
function yearmonth2timestamp($year,$month)
function yearmonthday2timestamp($year,$month,$day)
function datetime2timestamp($year,$month,$day,$hour,$min,$ampm)
function timestamp2datetime($timestamp)
function timestamp2timenumber($timestamp)
function timenumber2timelabel($timenum)
function datetime2ISO8601datetime($year,$month,$day,$hour,$min,$ampm)
function ISO8601datetime2datetime($ISO8601datetime)
function disassemble_timestamp(&$event)
function settimeenddate2timebegindate(&$event)
function assemble_timestamp(&$event)
function timestring($hour,$min,$ampm)
function endingtime_specified(&$event) */
require_once("functions-dates.inc.php");


/* Functions for generic date encoding/decoding, and formatting:
----------------------------------------------------
function JulianToJD($month, $day, $year)
function JDToJulian($jd)
function Day_of_Week($month,$day,$year)
function Day_of_Week_Abbreviation($dow)
function Delta_Days($m1,$d1,$y1,$m2,$d2,$y2)
function Decode_Date_US($datestr)
function Encode_Date_US($month,$day,$year)
function Add_Delta_Days($month,$day,$year,$delta)
function Month_to_Text($month)
function Month_to_Text_Abbreviation($month)
Function Day_of_Week_to_Text($dow)
function isDST($timestamp)
function EST2UTC($year, $month, $day, $hour, $min, $ampm)
function Timezone2UTC($offset, $year, $month, $day, $hour, $min, $ampm) */
require_once("functions-dates-generic.inc.php");


/* Functions that output the HTML for events:
----------------------------------------------------
function print_event($event, $linkfeatures=true)
function adminButtons($eventORshowdate, $buttons, $size, $orientation) */
require_once("functions-event-content.inc.php");


/* Functions that modify events in the DB:
----------------------------------------------------
function deletefromevent($eventid)
function deletefromevent_public($eventid)
function repeatdeletefromevent($repeatid)
function repeatdeletefromevent_public($repeatid)
function deletefromrepeat($repeatid)
function insertintoevent($eventid,&$event)
function insertintoeventsql($calendarid,$eventid,&$event)
function insertintoevent_public(&$event)
function updateevent($eventid,&$event)
function updateevent_public($eventid,&$event)
function insertintotemplate($template_name,&$event)
function updatetemplate($templateid,$template_name,&$event)
function insertintorepeat($repeatid,&$event,&$repeat)
function updaterepeat($repeatid,&$event,&$repeat)
function publicizeevent($eventid,&$event)
function repeatpublicizeevent($eventid,&$event) */
require_once("functions-event-dates.inc.php");


/* Functions that deal with event-specific date processing/handling:
----------------------------------------------------
function inputdate($month,$monthvar,$day,$dayvar,$year,$yearvar)
function readinrepeat($repeatid,&$event,&$repeat)
function repeatinput2repeatdef(&$event,&$repeat)
function getfirstslice($s)
function repeatdefdisassemble($repeatdef,&$frequency,&$interval,&$frequencymodifier,&$endyear,&$endmonth,&$endday)
function printrecurrence($startyear,$startmonth,$startday,$repeatdef)
function repeatdefdisassembled2repeatlist($startyear,$startmonth,$startday,$frequency,$interval,$frequencymodifier,$endyear,$endmonth,$endday) {
function producerepeatlist(&$event,&$repeat)
function printrecurrencedetails(&$repeatlist)
function repeatdef2repeatinput($repeatdef,&$event,&$repeat) */
require_once("functions-event-db.inc.php");


/* Functions that output HTML for header/footer/sections:
----------------------------------------------------
function pageheader($title, $navbaractive) {
function contentsection_begin($headertext="", $showBackToMenuButton=false)
function contentsection_end()
function helpwindow_header()
function helpwindow_footer() */
require_once("functions-content.inc.php");


/* Functions to verify and send e-mail:
----------------------------------------------------
function emailaddressok($email)
function sendemail($toName,$toAddress,$fromName,$fromAddress,$subject,$body) */
require_once("functions-email.inc.php");


/* Functions for validating input:
----------------------------------------------------
function isValidInput($value, $type)
function isDate($value)
function isTime($value) */
require_once("functions-inputvalidation.inc.php");


/* Functions used to output the event input form and process data related to it.
----------------------------------------------------
function defaultevent(&$event,$sponsorid)
function checktime($hour,$min)
function checkeventdate(&$event,&$repeat)
function checkstartenddate($startdate_month,$startdate_day,$startdate_year,$enddate_month,$enddate_day,$enddate_year)
function checkeventtime(&$event)
function checkevent(&$event,&$repeat)
function inputrecurrences(&$event,&$repeat,$check)
function inputeventdata(&$event,$sponsorid,$inputrequired,$check,$displaydatetime,&$repeat,$copy) */
require("functions-inputdata-event.inc.php");


/* Functions used to output the event template form and process data related to it.
----------------------------------------------------
function inputtemplatedata(&$event,$sponsorid,$check,$template_name) */
require("functions-inputdata-template.inc.php");


/* Functions used to process XML
----------------------------------------------------
function parsexml($xmlfile, $xmlstartelementhandler, $xmlendelementhandler, $xmldatahandler, $xmlerrorhandler)
function xmlerror($xml_parser)
function xmlstartelement($parser, $element, $attrs)
function xmlendelement($parser, $element) */
require("functions-xml.inc.php");
?>