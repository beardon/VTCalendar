<?php

// ##############################################
// WARNING: If you want to override the defaults below, define them in config.inc.php.
// Any changes to this file may be overwritten when you upgrade to a newer version of VTCalendar.
// ##############################################

/* ==============================================
Generic Colors
============================================== */

// The default color of backgrounds inside the calendar.
if (!defined("DEFAULTCOLOR_BG")) define("DEFAULTCOLOR_BG", "#FFFFFF");

// Default color for text inside the calendar.
if (!defined("DEFAULTCOLOR_TEXT")) define("DEFAULTCOLOR_TEXT", "#000000");

// Faded color for events that have passed.
if (!defined("DEFAULTCOLOR_TEXT_FADED")) define("DEFAULTCOLOR_TEXT_FADED", "#666666");

// Text that is an urgent message.
if (!defined("DEFAULTCOLOR_TEXT_WARNING")) define("DEFAULTCOLOR_TEXT_WARNING", "#FF0000");

// Default link color.
if (!defined("DEFAULTCOLOR_LINK")) define("DEFAULTCOLOR_LINK", "#0000FF");

// General body color of the calendar.
if (!defined("DEFAULTCOLOR_BODY")) define("DEFAULTCOLOR_BODY", "#C3D9FF");

// Color that shows which day is today.
if (!defined("DEFAULTCOLOR_TODAY")) define("DEFAULTCOLOR_TODAY", "#FFE993");

// Lighter color that shows which day is today.
if (!defined("DEFAULTCOLOR_TODAYLIGHT")) define("DEFAULTCOLOR_TODAYLIGHT", "#FFFFCC");

// Background color for table cells that have a decent amount of content.
if (!defined("DEFAULTCOLOR_LIGHT_CELL_BG")) define("DEFAULTCOLOR_LIGHT_CELL_BG", "#EEEEEE");

// Background color for table headers.
if (!defined("DEFAULTCOLOR_TABLE_HEADER_TEXT")) define("DEFAULTCOLOR_TABLE_HEADER_TEXT", "#000000");

// Background color for table headers.
if (!defined("DEFAULTCOLOR_TABLE_HEADER_BG")) define("DEFAULTCOLOR_TABLE_HEADER_BG", "#DDDDDD");

// Faded color for past events.
if (!defined("DEFAULTCOLOR_BORDER")) define("DEFAULTCOLOR_BORDER", "#666666");

// Color used to highlight keywords in search results.
if (!defined("DEFAULTCOLOR_KEYWORD_HIGHLIGHT")) define("DEFAULTCOLOR_KEYWORD_HIGHLIGHT", "#FFFF99");

// Second level header used primarily on update.php.
if (!defined("DEFAULTCOLOR_H2")) define("DEFAULTCOLOR_H2", "#000000");

// Third level header used primarily on the changeeevent.php form.
if (!defined("DEFAULTCOLOR_H3")) define("DEFAULTCOLOR_H3", "#0066CC");

/* ==============================================
Title and Tabs
============================================== */

// Calendar title displayed to the left of the tabs.
if (!defined("DEFAULTCOLOR_TITLE")) define("DEFAULTCOLOR_TITLE", "#000000");

// Text color for the navigation tabs that are not selected.
if (!defined("DEFAULTCOLOR_TABGRAYED_TEXT")) define("DEFAULTCOLOR_TABGRAYED_TEXT", "#0000FF");

// Background color for navigation tabs that are not selected.
if (!defined("DEFAULTCOLOR_TABGRAYED_BG")) define("DEFAULTCOLOR_TABGRAYED_BG", "#CCCCCC");

/* ==============================================
Filter Notice
============================================== */

// Background color for the filter and search keyword notice box.
if (!defined("DEFAULTCOLOR_FILTERNOTICE_BG")) define("DEFAULTCOLOR_FILTERNOTICE_BG", "#AD2525");

// Font color for the filter and search keyword notice box.
if (!defined("DEFAULTCOLOR_FILTERNOTICE_FONT")) define("DEFAULTCOLOR_FILTERNOTICE_FONT", "#FFFFFF");

// Faded font color for the filter and search keyword notice box.
if (!defined("DEFAULTCOLOR_FILTERNOTICE_FONTFADED")) define("DEFAULTCOLOR_FILTERNOTICE_FONTFADED", "#FFBEBE");

// Background image for the filter and search keyword notice box (leave blank for no background image).
if (!defined("DEFAULTCOLOR_FILTERNOTICE_BGIMAGE")) define("DEFAULTCOLOR_FILTERNOTICE_BGIMAGE", "images/background-filter.gif");

/* ==============================================
Event Bar
============================================== */

// Colored bar displayed to the left of past event summaries
if (!defined("DEFAULTCOLOR_EVENTBAR_PAST")) define("DEFAULTCOLOR_EVENTBAR_PAST", "#CCCCCC");

// Colored bar displayed to the left of current event summaries
if (!defined("DEFAULTCOLOR_EVENTBAR_CURRENT")) define("DEFAULTCOLOR_EVENTBAR_CURRENT", "#9292FB");

// Colored bar displayed to the left of future event summaries
if (!defined("DEFAULTCOLOR_EVENTBAR_FUTURE")) define("DEFAULTCOLOR_EVENTBAR_FUTURE", "#A7A7FB");

/* ==============================================
Month Day Labels
============================================== */

// Background colors that appear when the mouse hovers over the day number in month view.
if (!defined("DEFAULTCOLOR_MONTHDAYLABELS_PAST")) define("DEFAULTCOLOR_MONTHDAYLABELS_PAST", "#DDDDDD");

// Background colors that appear when the mouse hovers over the day number in month view.
if (!defined("DEFAULTCOLOR_MONTHDAYLABELS_CURRENT")) define("DEFAULTCOLOR_MONTHDAYLABELS_CURRENT", "#FFD839");

// Background colors that appear when the mouse hovers over the day number in month view.
if (!defined("DEFAULTCOLOR_MONTHDAYLABELS_FUTURE")) define("DEFAULTCOLOR_MONTHDAYLABELS_FUTURE", "#DDDDFF");

/* ==============================================
Specific to Month View
============================================== */

// Background color for cells in month view that are not for the month currently being viewed.
if (!defined("DEFAULTCOLOR_OTHERMONTH")) define("DEFAULTCOLOR_OTHERMONTH", "#EEEEEE");

/* ==============================================
Little Calendar
============================================== */

// Color of the border around the current day in the little calendar
if (!defined("DEFAULTCOLOR_LITTLECAL_TODAY")) define("DEFAULTCOLOR_LITTLECAL_TODAY", "#004A80");

// Background color for days in the little calendar that are being displayed in the main calendar
if (!defined("DEFAULTCOLOR_LITTLECAL_HIGHLIGHT")) define("DEFAULTCOLOR_LITTLECAL_HIGHLIGHT", "#CCCCCC");

// Font color for days that are not part of the current month being displayed in the little calendar.
if (!defined("DEFAULTCOLOR_LITTLECAL_FONTFADED")) define("DEFAULTCOLOR_LITTLECAL_FONTFADED", "#999999");

// A small line below the S/M/T/W/T/F/S row in the little calendar
if (!defined("DEFAULTCOLOR_LITTLECAL_LINE")) define("DEFAULTCOLOR_LITTLECAL_LINE", "#999999");

/* ==============================================
Date Selector
============================================== */

// Background color for the date selector's GO button in the column
if (!defined("DEFAULTCOLOR_GOBTN_BG")) define("DEFAULTCOLOR_GOBTN_BG", "#FFCC66");

// Border color for the date selector's GO button in the column
if (!defined("DEFAULTCOLOR_GOBTN_BORDER")) define("DEFAULTCOLOR_GOBTN_BORDER", "#FFFFFF");

/* ==============================================
Admin Buttons
============================================== */

// Border color for 'New Event' Admin Buttons
if (!defined("DEFAULTCOLOR_NEWBORDER")) define("DEFAULTCOLOR_NEWBORDER", "#999933");

// Background color for 'New Event' Admin Buttons
if (!defined("DEFAULTCOLOR_NEWBG")) define("DEFAULTCOLOR_NEWBG", "#FFFFCC");

// Border color for 'Approve' Admin Buttons
if (!defined("DEFAULTCOLOR_APPROVEBORDER")) define("DEFAULTCOLOR_APPROVEBORDER", "#339933");

// Background color for 'Approve' Admin Buttons
if (!defined("DEFAULTCOLOR_APPROVEBG")) define("DEFAULTCOLOR_APPROVEBG", "#CCFFCC");

// Border color for 'Copy Event' Admin Buttons
if (!defined("DEFAULTCOLOR_COPYBORDER")) define("DEFAULTCOLOR_COPYBORDER", "#555599");

// Background color for 'Copy Event' Admin Buttons
if (!defined("DEFAULTCOLOR_COPYBG")) define("DEFAULTCOLOR_COPYBG", "#DDDDFF");

// Background color for 'Delete Event' Admin Buttons
if (!defined("DEFAULTCOLOR_DELETEBORDER")) define("DEFAULTCOLOR_DELETEBORDER", "#995555");

// Border color for 'Delete Event' Admin Buttons
if (!defined("DEFAULTCOLOR_DELETEBG")) define("DEFAULTCOLOR_DELETEBG", "#FFDDDD");

?>
