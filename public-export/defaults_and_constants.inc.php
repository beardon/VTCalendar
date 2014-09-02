<?php
// The number of minutes until the information returned should expire.
// This is primarily used by caching servers to determine when a cached version expires.
define("CACHEMINUTES", 5);

// Set valid input values
define("constMaxEventsAllowed", 100);
define("constBool_Yes", "(Y|YES)");
define("constBool_YesNo", "(Y|YES|N|NO)");
define("constBool_No", "(N|NO)");
define("constDataTypeRegExp", "(HTML|XML|TEXT)");
define("constHTMLTemplateRegExp", "(PARAGRAPH|TABLE|MAINSITE)");
define("constDateFormatRegExp", "(HUGE|LONG|NORMAL|SHORT|TINY|MICRO)");
define("constTimeDisplayRegExp", "(START|STARTENDLONG|STARTENDNORMAL|STARTENDSHORT|STARTDURATIONLONG|STARTDURATIONNORMAL|STARTDURATIONSHORT)");
define("constTimeFormatRegExp", "(HUGE|LONG|NORMAL|SHORT)");
define("constDurationFormatRegExp", "(LONG|NORMAL|SHORT|TINY|MICRO)");
define("constFilterByRegExp", "[0-9]+(,[0-9]+)*");
define("constLinkFilterRegExp", "[0-9]+(,[0-9]+)*");

// Set default values
$config['MaxEvents'] = 25;
$config['DataType'] = "HTML";
$config['HTMLTemplate'] = "PARAGRAPH";
$config['DateFormat'] = "NORMAL";
$config['TimeDisplay'] = "STARTDURATIONNORMAL";
$config['TimeFormat'] = "NORMAL";
$config['DurationFormat'] = "NORMAL";
$config['LinkFilterQueryString'] = "";
$config['JavaScript'] = "Y";
$config['ShowDateTime'] = "Y";
$config['ShowLocation'] = "Y";
$config['ShowAllDay'] = "Y";
$config['CombineRepeating'] = "N";
$config['HTMLEncode'] = "N";
?>