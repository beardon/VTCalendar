<?php
/* =======================================
WARNING: This file should not use anything
exclusive to main.php or main_body.inc.php
since it is included in export/export.php.
======================================= */

define("DOPREVIEW", isset($_GET['createexport']));

define("ISCALADMIN", isset($_SESSION['AUTH_ISCALENDARADMIN']) && $_SESSION['AUTH_ISCALENDARADMIN']);

// Defaults
$FormData['timebegin'] = 'upcoming';
$FormData['maxevents'] = '25';
$FormData['sponsor'] = 'all';
$FormData['htmltype'] = 'table';
$FormData['jshtml'] = '1';
$FormData['dateformat'] = 'normal';
$FormData['timedisplay'] = 'startdurationnormal';
$FormData['timeformat'] = 'normal';
$FormData['durationformat'] = 'normal';
$FormData['showdatetime'] = '1';
$FormData['showlocation'] = '1';
$FormData['showallday'] = '1';
$FormData['specificsponsor'] = '';

// Make a copy of the defaults so they can be removed from the query string to make things simpler.
$FormDataDefaults = $FormData;

// An aray of error messages.
$FormErrors = array();

$lang['export_page_header'] = 'Export Events';

// TODO: Improve this description.
$lang['export_form_description'] = 'Export events to a file you can save on your computer as a backup, or to transfer to another calendar.';

// Generic messages
$lang['export_leaveblank'] = 'Leave blank for no maximum';
$lang['export_show'] = 'Show';
$lang['export_hide'] = 'Hide';

// Output text
$lang['export_output_for'] = 'for';
$lang['export_output_to'] = 'to';
$lang['export_output_hours'] = 'hours';
$lang['export_output_hrs'] = 'hrs';
$lang['export_output_hr'] = 'hr';
$lang['export_output_minutes'] = 'minutes';
$lang['export_output_min'] = 'min';
$lang['export_output_m'] = 'm';

// Submit button for export
$lang['export_submit'] = 'Preview the Export';

$lang['export_errorsfound'] = 'Some errors were found with the information you submited.<br>Scroll down to view the errors.';

// Message after the first submit button (only if HTML was selected)
$lang['export_keepscrolling'] = ' or keep scrolling down for more HTML settings.';

// Message after the second submit button (only if HTML was selected).
$lang['export_resetform'] = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>- or -</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="export-new.php">Reset the Form</a>';

// Header for first section of export
$lang['export_settings'] = 'Export Settings';

$lang['export_format'] = 'Export Format';
$lang['export_format_standard'] = 'Standard';
$lang['export_format_advanced'] = 'Advanced';
$lang['export_format_error'] = 'You must select an &quot;'.$lang['export_format'].'&quot;.';

$lang['export_id_error'] = 'The event ID specified is not in the valid format.';

$lang['export_maxevents'] = 'Maximum Events Returned';
$lang['export_maxevents_description'] = 'To avoid excessively large output, you can specify the maximum number of events.';
$lang['export_maxevents_error'] = 'You must enter a number between 1 and '.MAX_EXPORT_EVENTS.'.';
$lang['export_maxevents_rangemessage'] = 'Must be a number from 1 to '.MAX_EXPORT_EVENTS;

$lang['export_dates'] = 'Dates';
$lang['export_dates_description'] = 'The start and end date for which you want events.';

$lang['export_dates_from'] = 'From';
$lang['export_dates_from_description'] = 'Leave blank for no start date, enter a date in <code>YYYY-MM-DD</code> format,<br>enter &quot;today&quot; to use today\'s date, or enter &quot;upcoming&quot; to only show upcoming events.';
$lang['export_dates_from_error'] = 'You must either a &quot;'. $lang['export_dates_from'] .'&quot; date in <code>yyyy-mm-dd</code> format, leave it blank for no &quot;'.$lang['export_dates_from'].'&quot; date, enter &quot;today&quot; to use today\'s date, or enter &quot;upcoming&quot; to only show upcoming events.';

$lang['export_dates_to'] = 'To';
$lang['export_dates_to_description'] = 'Leave blank for no end date, enter a date in <code>YYYY-MM-DD</code> format,<br>or enter a number to represent the number of days after the &quot;'.$lang['export_dates_from'].'&quot; date.';
$lang['export_dates_to_error'] = 'You must a &quot;'. $lang['export_dates_to'] .'&quot; date in <code>yyyy-mm-dd</code> format, leave it blank for no &quot;'.$lang['export_dates_to'].'&quot; date, or enter a number to represent the number of days after the &quot;'.$lang['export_dates_from'].'&quot; date.';

$lang['export_dates_missingfrom'] = 'If you enter a &quot;'. $lang['export_dates_to'] .'&quot; date you must also enter a &quot;'. $lang['export_dates_from'] .'&quot; date.';

$lang['export_categories'] = 'Categories';
$lang['export_categories_description'] = 'Choose the event categories you would like to export events for';
$lang['export_categories_error'] = 'You must select one or more categories.';

$lang['export_sponsor'] = 'Sponsor';
$lang['export_sponsor_all'] = 'All sponsors';
$lang['export_sponsor_specific'] = 'Specific sponsor';
$lang['export_sponsor_specific_description'] = 'case-insensitive substring search, e.g. school of the arts';
$lang['export_sponsor_error'] = 'You must either select &quot;'.$lang['export_sponsor_all'].'&quot; or enter the specific sponsor to search for.';

// Header of second section of export
$lang['export_htmlsettings'] = 'General HTML Settings';

$lang['export_keepcategoryfilter'] = 'Keep Category Filter in VTCalendar';
$lang['export_keepcategoryfilter_description'] = 'When events are clicked, and users go to the full VTCalendar screen, the category filter is not maintained. Check the box below if you would like to pass the category filter to VTCalendar so the day, week, month, etc. views are also filtered. This will be ignored if you did selected &quot;All categories&quot; in the previous section.';

$lang['export_htmltype'] = 'HTML Type';
$lang['export_htmltype_description'] = 'For the HTML export formats (including HTML via JavaScript), the output can either be a series of paragraphs or rows in a single table.';
$lang['export_htmltype_paragraph'] = 'Paragraph';
$lang['export_htmltype_table'] = 'Table';

$lang['export_jsoutput'] = 'Output via JavaScript';
$lang['export_jsoutput_description'] = 'Wrap the HTML in <code>document.write</code> calls so that it can be displayed easily on other pages.';

// Header of third  section of export
$lang['export_datetimesettings'] = 'HTML Date/Time Settings';

$lang['export_dateformat'] = 'Date Format';
$lang['export_timedisplay'] = 'Time Display';
$lang['export_timedisplay_description'] = 'The time can only display the starting time, display the start and end time, or display the start time and how long the event will last (aka: duration).';
$lang['export_timedisplay_startonly'] = 'Start Only';
$lang['export_timedisplay_startend'] = 'Start and End';
$lang['export_timedisplay_startduration'] = 'Start and Duration';

$lang['export_timeformat'] = 'Time Format';
$lang['export_timeformat_description'] = 'You can change how much information is included when a time is displayed (this effects both start and end times).';

$lang['export_durationformat'] = 'Duration Format';

// Header of fourth section of export
$lang['export_htmldisplaysettings'] = 'HTML Display Settings';

$lang['export_showdatetime'] = 'Show Date/Time';
$lang['export_showdatetime_description'] = 'You may show or hide the date and time in the returned events.<br>This can be done if you have a limited amount of space on your web site.<br>&nbsp;<br><i>Note:</i> It is recommended to show the date and time.';

$lang['export_showlocation'] = 'Show Location';
$lang['export_showlocation_description'] = 'You may show or hide the location in the returned events.<br>This can be done if you have a limited amount of space on your web site.';

$lang['export_showallday'] = 'Show &quot;All Day&quot;';
$lang['export_showallday_description'] = 'If an event is all day (aka: it does not have a start time) you may show or hide the &quot;All Day&quot; text.<br>This helps to keep the event listing clean if you have a lot of events that are all day.<br>&nbsp;<br>Note: It is recommended to show &quot;All Day&quot;.';

$lang['export_maxtitlechars'] = 'Maximum Characters for the Title';
$lang['export_maxtitlechars_description'] = 'If you have a limited amount of space on your Web site, you may limit the length of the event title.<br>Any titles that are beyond this length will be truncated and an ellipse (...) will be added to the end.';
$lang['export_maxtitlechars_error'] = 'You must enter either a number below or leave it blank.';

$lang['export_maxlocationchars'] = 'Maximum Characters for the Location';
$lang['export_maxlocationchars_description'] = 'If you have a limited amount of space on your Web site, you may limit the length of the event location.<br>Any locations that are beyond this length will be truncated and an ellipse (...) will be added to the end.';
$lang['export_maxlocationchars_error'] = 'You must enter either a number below or leave it blank.';

$lang['export_preview_return'] = 'Return to the Form';

$lang['export_preview_download'] = 'Download Exported Events';
$lang['export_preview_download_text'] = 'To save the exported events, <a href="%URL%" onclick="return false;">right-click this link</a> (CTRL-click on a Mac) and select &quot;Save Target As...&quot; or &quot;Save Link As...&quot;';

$lang['export_preview_url'] = 'Export URL';
$lang['export_preview_url_text'] = 'The URL below will export events based on the settings you provided.';

$lang['export_preview_js'] = 'JavaScript Code';
$lang['export_preview_js_text'] = 'The HTML code below can be copy/pasted into your Web site to automatically load event data or display events based on the settings you provided.';

$lang['export_preview_raw'] = 'Raw Export Preview';
$lang['export_preview_raw_text'] = 'The window below shows the raw output for the exported events.';

if (isset($_GET['format'])) setVar($FormData['format'],$_GET['format'],'exportformat');
if (isset($FormData['format']) && $FormData['format'] == "xml" && (!PUBLIC_EXPORT_VTCALXML && !ISCALADMIN)) unset($FormData['format']);
if ((DOPREVIEW || defined("DOEXPORT")) && !isset($FormData['format'])) $FormErrors['format'] = lang('export_format_error');

if (isset($_GET['id']) && !setVar($FormData['id'],$_GET['id'],'eventid')) $FormErrors['id'] = lang('export_id_error');

// Output an error message if:
// 1. Max Events is set but not a number greater than 1.
// 2. Max events is set, the user is not an admin, and the value is greater than what is allowed.
// 3. Max events is not set, and either the user is not an admin.
if ((isset($_GET['maxevents']) && !setVar($FormData['maxevents'],$_GET['maxevents'],'int_gte1'))
	|| (isset($_GET['maxevents']) && !ISCALADMIN && intval($FormData['maxevents']) > MAX_EXPORT_EVENTS)
	|| (!isset($_GET['maxevents']) && !ISCALADMIN && DOPREVIEW)) {
	
	$FormErrors['maxevents'] = lang('export_maxevents_error');
	$FormData['maxevents'] = $FormDataDefaults['maxevents'];
}

if (isset($_GET['timebegin'])) { if (preg_match('/^(today|upcoming)?$/', $_GET['timebegin']) == 1 || isValidInput($_GET['timebegin'] . " 00:00:00", 'timebegin')) $FormData['timebegin'] = strtolower($_GET['timebegin']); else $FormErrors['timebegin'] = lang('export_dates_from_error'); }
if (!empty($_GET['timeend'])) if (isValidInput($_GET['timeend'], 'int_gte1') || isValidInput($_GET['timeend'] . " 23:59:59", 'timeend')) $FormData['timeend'] = $_GET['timeend']; else $FormErrors['timeend'] = lang('export_dates_to_error');
if (empty($_GET['timebegin']) && !empty($_GET['timeend'])) $FormErrors['timeend'] = lang('export_dates_missingfrom');

if (isset($_GET['c']) && !setVar($FormData['categories'],$_GET['c'],'categoryfilter')) $FormErrors['categories'] = lang('export_categories_error');
if (DOPREVIEW && !isset($FormData['categories'])) $FormErrors['categories'] = lang('export_categories_error');
if (isset($FormData['categories']) && is_string($FormData['categories'])) $FormData['categories'] = explode(",", $FormData['categories']);

if (isset($_GET['sponsor'])) setVar($FormData['sponsor'],$_GET['sponsor'],'sponsortype');
if (isset($_GET['specificsponsor'])) setVar($FormData['specificsponsor'],trim($_GET['specificsponsor']),'specificsponsor');
if ($FormData['sponsor'] == "all") $FormData['specificsponsor'] = '';
if ($FormData['sponsor'] == "specific" && empty($FormData['specificsponsor'])) $FormErrors['sponsor'] = lang('export_sponsor_error');

if (isset($FormData['format']) && $FormData['format'] == "html") {
	if (isset($_GET['keepcategoryfilter'])) setVar($FormData['keepcategoryfilter'],$_GET['keepcategoryfilter'],'boolean_checkbox');
	if (isset($_GET['htmltype'])) setVar($FormData['htmltype'],$_GET['htmltype'],'htmltype');
	if (isset($_GET['jshtml']) && !setVar($FormData['jshtml'],$_GET['jshtml'],'boolean_checkbox')) unset($FormData['jshtml']);
	
	if (isset($_GET['dateformat'])) setVar($FormData['dateformat'],$_GET['dateformat'],'dateformat');
	if (isset($_GET['timedisplay'])) setVar($FormData['timedisplay'],$_GET['timedisplay'],'timedisplay');
	if (isset($_GET['timeformat'])) setVar($FormData['timeformat'],$_GET['timeformat'],'timeformat');
	if (isset($_GET['durationformat'])) setVar($FormData['durationformat'],$_GET['durationformat'],'durationformat');
	
	if (isset($_GET['showdatetime'])) setVar($FormData['showdatetime'],$_GET['showdatetime'],'boolean');
	if (isset($_GET['showlocation'])) setVar($FormData['showlocation'],$_GET['showlocation'],'boolean');
	if (isset($_GET['showallday'])) setVar($FormData['showallday'],$_GET['showallday'],'boolean');
	if (!empty($_GET['maxtitlecharacters'])) if (!setVar($FormData['maxtitlecharacters'],$_GET['maxtitlecharacters'],'int_gte1')) $FormErrors['maxtitlecharacters'] = lang('export_maxtitlechars_error');
	if (!empty($_GET['maxlocationcharacters'])) if (!setVar($FormData['maxlocationcharacters'],$_GET['maxlocationcharacters'],'int_gte1')) $FormErrors['maxlocationcharacters'] = lang('export_maxlocationchars_error');
}
?>