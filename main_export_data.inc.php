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
$FormData['keepcategoryfilter'] = '0';
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
if (isset($_GET['categories']) && is_string($_GET['categories'])) $FormData['categories'] = explode(",", $_GET['categories']);
if (DOPREVIEW && !isset($FormData['categories'])) $FormErrors['categories'] = lang('export_categories_error');

if (isset($_GET['sponsor'])) setVar($FormData['sponsor'],$_GET['sponsor'],'sponsortype');
if (isset($_GET['specificsponsor'])) setVar($FormData['specificsponsor'],trim($_GET['specificsponsor']),'specificsponsor');
if ($FormData['sponsor'] == "all") $FormData['specificsponsor'] = '';
if ($FormData['sponsor'] == "specific" && empty($FormData['specificsponsor'])) $FormErrors['sponsor'] = lang('export_sponsor_error');

if (isset($FormData['format']) && $FormData['format'] == "html") {
	if (isset($_GET['keepcategoryfilter'])) setVar($FormData['keepcategoryfilter'],$_GET['keepcategoryfilter'],'boolean');
	if (isset($_GET['htmltype'])) setVar($FormData['htmltype'],$_GET['htmltype'],'htmltype');
	if (isset($_GET['jshtml'])) setVar($FormData['jshtml'],$_GET['jshtml'],'boolean');
	
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