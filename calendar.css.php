<?php
require_once('application.inc.php');
header("Content-Type: text/css");
?>

/*===================================
        Calendar-Wide Styles
===================================*/

/* Default calendar font family, size and color */
#CalendarBlock, #CalendarBlock td, #CalendarBlock p, #CalendarBlock h2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: <?php echo $_SESSION['COLOR_TEXT']; ?>;
}

/* Default link color */
#CalendarBlock a {
	color: <?php echo $_SESSION['COLOR_LINK']; ?>;
}

/* Background color for table headers (may be column or row headers) */
tr.TableHeaderBG td, td.TableHeaderBG {
	color: <?php echo $_SESSION['COLOR_TABLE_HEADER_TEXT']; ?>;
	background-color: <?php echo $_SESSION['COLOR_TABLE_HEADER_BG']; ?>;
}

/* Color for the text that notifies users of an error or warning */
#CalendarBlock .WarningText {
	color: <?php echo $_SESSION['COLOR_TEXT_WARNING']; ?>;
}

/* Color for text that notififies the user of a normal or success message */
#CalendarBlock .NotificationText {
	color: #008800;
}

/* Background behind messages on update.php */
#CalendarBlock .NotificationTextBG {
	background-color: #FFFFCC;
}

/* Second level header used primarily on update.php */
#CalendarBlock h2 {
	color: <?php echo $_SESSION['COLOR_H2']; ?>;
}

/* Third level header used primarily on the changeeevent.php form */
#CalendarBlock h3 {
	color: <?php echo $_SESSION['COLOR_H3']; ?>;
	font-size: 16px;
}

/* Color used to highlight keywords in search results */
#CalendarBlock .KeywordHighlight {
	background-color: <?php echo $_SESSION['COLOR_KEYWORD_HIGHLIGHT']; ?>;
}

/* Section headers used on various forms */
#CalendarBlock div.FormSectionHeader {
	margin-top: 16px;
	padding: 4px;
	margin-bottom: 6px;
	border-top: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>;
	background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>;
}
#CalendarBlock div.FormSectionHeader h3 {
	margin: 0;
	padding: 0;
}

#CalendarBlock label {
	cursor: pointer;
}

/*===================================
             Top Navi Bar
===================================*/

table#TopNaviTable {
	border-bottom: 6px solid <?php echo $_SESSION['COLOR_BODY']; ?>;
}
table#TopNaviTable td {
	padding: 0;
}
td.TopNavi-ColorPadding {
	border-bottom: 8px solid <?php echo $_SESSION['COLOR_BODY']; ?>;
}
table#TopNaviTable td.TopNavi-ColorPadding td {
	padding-top: 8px;
}

/* The font style for the calendar title */
table#TopNaviTable td#NaviBar-CalendarTitle {
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 18px;
	padding-bottom: 2px;
	padding-left: 4px;
	padding-right: 8px;
}
/* The color for the calendar title link */
table#TopNaviTable td#NaviBar-CalendarTitle a {
	color: <?php echo $_SESSION['COLOR_TITLE']; ?>;
	text-decoration: none;
}
.NaviBar-Tab div {
	margin-left: 2px;
	margin-right: 2px;
	font-weight: bold;
	padding: 4px;
	padding-left: 12px;
	padding-right: 12px;
	background-color: <?php echo $_SESSION['COLOR_TABGRAYED_BG']; ?>;
}
#CalendarBlock .NaviBar-Tab a {
	color: <?php echo $_SESSION['COLOR_TABGRAYED_TEXT']; ?>;
}
#CalendarBlock #NaviBar-Selected div {
	background-color: <?php echo $_SESSION['COLOR_BODY']; ?>;
}
#CalendarBlock #NaviBar-Selected a {
	color: <?php echo $_SESSION['COLOR_LINK']; ?>;
}

/*===================================
             Page Body
===================================*/

#CalendarTable {
	background-color: <?php echo $_SESSION['COLOR_BODY']; ?>;
}

#CalLeftCol {
	padding: 0;
}

/*     Month Selector
--------------------------*/

#MonthSelector td {
	padding: 4px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
}
#MonthSelector a {
	text-decoration: none;
}
#MonthSelector a:hover, #MonthSelector a:focus {
	text-decoration: underline;
}

#MonthSelector div#LeftArrowButton, #MonthSelector div#RightArrowButton,
#MonthSelector div#LeftArrowButtonDisabled, #MonthSelector div#RightArrowButtonDisabled {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
}

#MonthSelector div#LeftArrowButtonDisabled,
#MonthSelector div#RightArrowButtonDisabled {
	color: <?php echo $_SESSION['COLOR_TEXT_FADED']; ?>;
}

/*    Little Calendar
--------------------------*/

div#LittleCalendar-Padding {
	padding: 3px;
	background-color: <?php echo $_SESSION['COLOR_BG']; ?>;
}

table#LittleCalendar {
	background-color: <?php echo $_SESSION['COLOR_BG']; ?>;
}

table#LittleCalendar td {
	padding: 0;
	font-family:  Arial, Helvetica, sans-serif;
	font-size: 11px;
}
table#LittleCalendar a {
	text-decoration: none;
	display: block;
	padding: 3px;
}

/* A small line below the S/M/T/W/T/F/S row in the little calendar */
table#LittleCalendar thead td {
	border-bottom: 1px solid <?php echo $_SESSION['COLOR_LITTLECAL_LINE']; ?>;
	padding: 3px;
}

/* The background color behind the days currently being displayed */
table#LittleCalendar td.SelectedDay {
	background-color: <?php echo $_SESSION['COLOR_LITTLECAL_HIGHLIGHT']; ?>;
}

/* A border around today on the little calendar */
a.LittleCal-Today, a.LittleCal-TodayGrayedOut {
	padding: 1px !important;
	border: 2px solid <?php echo $_SESSION['COLOR_LITTLECAL_TODAY']; ?>;
}

/* Grayed out days that are not part of the current month */
a.LittleCal-GrayedOut, a.LittleCal-TodayGrayedOut {
	color: <?php echo $_SESSION['COLOR_LITTLECAL_FONTFADED']; ?> !important;
}

/* Other Left Column Stuff
--------------------------*/

table#JumpToDateSelector td {
	padding-top: 6px;
	padding-bottom: 14px;
}
input#JumpToDateSelector-Button {
	background-color: <?php echo $_SESSION['COLOR_GOBTN_BG']; ?>;
	border: 1px solid <?php echo $_SESSION['COLOR_GOBTN_BORDER']; ?>;
}
form#JumpToDateSelectorForm {
	margin: 0; padding: 0;
}

td#CalLeftCol table#TodaysDate td {
	background-color: <?php echo $_SESSION['COLOR_TODAY']; ?>;
	padding: 6px;
}

td#CalLeftCol table#SubscribeLink td {
	padding-top: 12px;
}

td#CalLeftCol table#CategoryFilterLink td {
	padding-top: 8px;
}

td#CalRightCol {
	padding: 0;
	border-color: <?php echo $_SESSION['COLOR_BODY']; ?>;
	border-left-style: solid;
	border-left-width: 7px;
	border-right-style: solid;
	border-right-width: 7px;
	background-color: <?php echo $_SESSION['COLOR_BG']; ?>;
}

td#CalRightCol.TodayHighlighted {
	border-color: <?php echo $_SESSION['COLOR_TODAY']; ?> !important;
	border-bottom-style: solid;
	border-bottom-width: 7px;
}

/*     Filter Notice
--------------------------*/

table#FilterNotice td {
	padding: 4px;
	background-image: <?php echo (empty($_SESSION['COLOR_FILTERNOTICE_BGIMAGE']) ? "transparent" : $_SESSION['COLOR_FILTERNOTICE_BGIMAGE']); ?>;
	background-color: <?php echo $_SESSION['COLOR_FILTERNOTICE_BG']; ?>;
	color: <?php echo $_SESSION['COLOR_FILTERNOTICE_FONT']; ?>;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
table#FilterNotice a {
	color: <?php echo $_SESSION['COLOR_FILTERNOTICE_FONTFADED']; ?>;
}
table#FilterNotice a:hover {
	color: <?php echo $_SESSION['COLOR_FILTERNOTICE_FONT']; ?>;
}

/*     Title & Navi
--------------------------*/

div#TitleAndNavi {
	background-color: <?php echo $_SESSION['COLOR_BODY']; ?>;
}

div#TitleAndNavi.TodayHighlighted {
	background-color: <?php echo $_SESSION['COLOR_TODAY']; ?>;
}

div#TitleAndNavi td {
	padding: 4px;
}

div#TitleAndNavi a {
	text-decoration: none;
}
div#TitleAndNavi a:hover, div#TitleAndNavi a:focus {
	text-decoration: underline;
}

td#DateOrTitle {
	padding-left: 8px;
}
td#DateOrTitle h2 {
	padding: 0 !important;
	margin: 0 !important;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
}

td#NavPreviousNext {
	padding-left: 18px !important;
}
td#NavPreviousNext td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	padding: 2px;
	padding-top: 0;
	padding-bottom: 0;
}
td#NavPreviousNext b {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
}

/*        Content
--------------------------*/

td#CalendarContent {
	padding: 3px;
}

/*===================================
             Event Table
===================================*/

#EventTable {
	background-color: <?php echo $_SESSION['COLOR_BG']; ?>;
}

#EventTable #EventLeftColumn {
	padding: 6px;
	font-size: 16px;
}
#EventTable #EventRightColumn {
	padding: 6px;
	border-left: 4px solid <?php echo $_SESSION['COLOR_EVENTBAR_CURRENT']; ?>;
}
div#EventTitle {
	font-size: 18px;
}
p#EventDescription, div#EventDetailPadding, div#iCalendarLink {
	padding: 0;
	margin: 0;
	padding-top: 14px;
}
table#EventDetail {
	border-collapse: collapse;
}
table#EventDetail td {
	border: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>;
	padding: 4px;
	padding-right: 8px;
}
td.EventDetail-Label {
	color: <?php echo $_SESSION['COLOR_TABLE_HEADER_TEXT']; ?> !important;
	background-color: <?php echo $_SESSION['COLOR_TABLE_HEADER_BG']; ?>;
}

/*===================================
              Day Table
===================================*/

#DayTable td.NoAnnouncement {
	padding: 10px;
	font-size: 15px;
}

#DayTable td {
	padding: 4px;
}

#DayTable tr.BorderTop td {
	border-top: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>;
}
#DayTable div.EventLeftBar {
	padding-left: 5px;
	border-left: 5px solid <?php echo $_SESSION['COLOR_EVENTBAR_CURRENT']; ?>;
}

#DayTable tr#FirstDateRow td.DateRow {
	padding: 0;
}

#DayTable td.DateRow div#TodayDateRow {
	background-color: <?php echo $_SESSION['COLOR_TODAY']; ?>;
}

#DayTable td.DateRow {
	font-size: 14px;
	font-weight: bold;
	padding: 0;
	padding-top: 8px;
}

#DayTable td.DateRow a {
	text-decoration: none;
}

#DayTable td.DateRow a:hover {
	text-decoration: underline;
}

#DayTable td.DateRow div {
	padding: 8px;
	background-color: <?php echo $_SESSION['COLOR_BODY']; ?>;
}

#DayTable td.TimeColumn i, #DayTable td.TimeColumn-Past i {
	font-style: normal;
	font-size: 11px;
}

/* Cell used to display the time and duration of the event in 'day' view for events that have passed. */
#DayTable td.TimeColumn, #DayTable td.TimeColumn-Past { }

/* Cell used to display the event title and description in 'day' view for events that have passed */
#DayTable td.DataColumn, #DayTable td.DataColumn-Past { }

#DayTable td.TimeColumn-Past, #DayTable td.DataColumn-Past {
	color: <?php echo $_SESSION['COLOR_TEXT_FADED']; ?>;
}
#DayTable td.DataColumn-Past a {
	color: <?php echo $_SESSION['COLOR_TEXT_FADED']; ?>;
}
#DayTable td.DataColumn-Past div.EventLeftBar {
	border-left-color: <?php echo $_SESSION['COLOR_EVENTBAR_PAST']; ?>;
}

/*===================================
           Weekday Table
===================================*/

#WeekdayTable {
	border-collapse: collapse;
}

#WeekdayTable td {
	padding: 4px;
	border: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>;
}

#WeekdayTable td td {
	padding: 0;
	border: 0 none #000000;
	background-color: transparent !important;
}

/*  Weekday Header Styles
--------------------------*/

#WeekdayTable thead td {
	color: <?php echo $_SESSION['COLOR_TABLE_HEADER_TEXT']; ?> !important;
	background-color: <?php echo $_SESSION['COLOR_TABLE_HEADER_BG']; ?>;
}

#WeekdayTable thead td.Weekday-Today {
	background-color: <?php echo $_SESSION['COLOR_TODAY']; ?> !important;
}

/*   Weekday Body Styles
--------------------------*/

#WeekdayTable tbody td.Weekday-Today {
	background-color: <?php echo $_SESSION['COLOR_TODAYLIGHT']; ?>;
}

#WeekdayTable tbody div.WeekEvent,
#WeekdayTable tbody div.WeekEvent-Past {
	padding-top: 2px;
	padding-bottom: 9px;
}
#WeekdayTable tbody div.WeekEvent-Past {
	color: <?php echo $_SESSION['COLOR_TEXT_FADED']; ?>;
}
#WeekdayTable tbody div.WeekEvent-Past a {
	color: <?php echo $_SESSION['COLOR_TEXT_FADED']; ?>;
}
#WeekdayTable tbody div.WeekEvent-Time {
	font-size: 11px;
}
#WeekdayTable tbody div.WeekEvent-Title,
#WeekdayTable tbody div.WeekEvent-Category {
	border-left: 3px solid <?php echo $_SESSION['COLOR_EVENTBAR_FUTURE']; ?>;
	padding-left: 3px;
}
#WeekdayTable tbody td.Weekday-Today div.WeekEvent-Title,
#WeekdayTable tbody td.Weekday-Today div.WeekEvent-Category {
	border-left-color: <?php echo $_SESSION['COLOR_EVENTBAR_CURRENT']; ?>;
}
#WeekdayTable tbody div.WeekEvent-Past div.WeekEvent-Title,
#WeekdayTable tbody div.WeekEvent-Past div.WeekEvent-Category {
	border-left-color: <?php echo $_SESSION['COLOR_EVENTBAR_PAST']; ?>;
}
#WeekdayTable tbody div.WeekEvent-Title a {
	text-decoration: none;
}
#WeekdayTable tbody div.WeekEvent-Title a:hover,
#WeekdayTable tbody div.WeekEvent-Title a:focus {
	text-decoration: underline;
}
#WeekdayTable tbody div.WeekEvent-Category {
	font-size: 11px;
	font-style: italic;
}

/*===================================
             Month Table
===================================*/

#MonthTable {
	border-collapse: collapse;
	background-color: <?php echo $_SESSION['COLOR_BG']; ?>;
}
#MonthTable td {
	border: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>;
	padding: 0;
}
#MonthTable thead td {
	color: <?php echo $_SESSION['COLOR_TABLE_HEADER_TEXT']; ?> !important;
	background-color: <?php echo $_SESSION['COLOR_TABLE_HEADER_BG']; ?>;
	padding: 5px;
}
#MonthTable tbody td {
	padding-bottom: 8px;
}
#MonthTable tbody td td {
	padding: 0 !important;
	margin: 0 !important;
	border: 0 !important;
}

#MonthTable div.DayNumber a {
	text-decoration: none !important;
	padding: 3px;
	padding-left: 4px;
	padding-bottom: 5px;
	line-height: 1;
	display: block;
}

#MonthTable p.EventItem,
#MonthTable p.EventItem-Past {
	padding: 0;
	margin: 0;
	margin-left: 3px;
	margin-right: 3px;
	padding-top: 2px;
	padding-bottom: 5px;
	padding-left: 8px;
	background-image: url("images/bullet.gif");
	background-repeat: no-repeat;
	background-position: 0 8px;
}

/* Hover color for the 'day number'. */
#MonthTable div.DayNumber a:hover,
#MonthTable div.DayNumber a:focus {
	background-color: <?php echo $_SESSION['COLOR_MONTHDAYLABELS_FUTURE']; ?>;
}

/* Background color for today. */
#MonthTable tbody td.MonthDay-Today {
	background-color: <?php echo $_SESSION['COLOR_TODAYLIGHT']; ?>;
}
/* Background color for the 'day number' for today. */
#MonthTable tbody td.MonthDay-Today div.DayNumber {
	background-color: <?php echo $_SESSION['COLOR_TODAY']; ?> !important;
}

/* Link color for the 'day number' and events of past days. */
#MonthTable td.MonthDay-Past div.DayNumber a,
#MonthTable p.EventItem-Past a {
	color: <?php echo $_SESSION['COLOR_TEXT_FADED']; ?>;
}

/* Hover color for the 'day number' for past days. */
#MonthTable td.MonthDay-Past div.DayNumber a:hover,
#MonthTable td.MonthDay-Past div.DayNumber a:focus {
	background-color: <?php echo $_SESSION['COLOR_MONTHDAYLABELS_PAST']; ?>;
}

/* Hover color for the 'day number' for today. */
#MonthTable td.MonthDay-Today div.DayNumber a:hover,
#MonthTable td.MonthDay-Today div.DayNumber a:focus {
	background-color: <?php echo $_SESSION['COLOR_MONTHDAYLABELS_CURRENT']; ?>;
}

#MonthTable td.MonthDay-OtherMonth {
	background-color: <?php echo $_SESSION['COLOR_OTHERMONTH']; ?> !important;
}

#MonthTable a {
	text-decoration: none;
}
#MonthTable a:hover, #MonthTable a:focus {
	text-decoration: underline
}

/*===================================
             Export View
===================================*/

#ExportForm.HideHTML .HTMLOnly {
	display: none;
}

#ExportForm p.FormError {
	padding: 4px;
	background-color: #EEEEEE;
	border-top: 2px solid <?php echo $_SESSION['COLOR_TEXT_WARNING']; ?>;
}

/*===================================
            Misc Styles
===================================*/

#PoweredBy td {
	background-color: <?php echo $_SESSION['COLOR_BODY']; ?>;
	font-size: 11px;
	padding-right: 16px;
}
#PoweredBy td a {
	text-decoration: none;
}

#UpdateMainMenu h2 {
	font-size: 15px;
}

div#AdminButtons-Padding {
	padding: 5px;
}
table#AdminButtons td {
	border-style: none;
	border-width: 0;
	padding: 0;
}
div#AdminButtons-Padding td, div#AdminButtons-RightPadding td {
	padding-right: 8px;
}
table#AdminButtons a {
	text-align: center;
	display: block;
	padding: 5px;
	color: <?php echo $_SESSION['COLOR_TEXT']; ?>;
	font-weight: bold;
	font-size: 13px;
	text-decoration: none;
	border: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>;
	background-color: <?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>;
	background-repeat: no-repeat;
	background-position: center left;
}
div#AdminButtons-Small table#AdminButtons a {
	padding: 2px;
	padding-left: 20px !important;
	font-weight: normal;
	font-size: 11px;
}
table#AdminButtons a#AdminButtons-New {
	text-align: left;
	padding-left: 25px;
	background-color: <?php echo $_SESSION['COLOR_NEWBG']; ?>;
	border-color: <?php echo $_SESSION['COLOR_NEWBORDER']; ?>;
	background-image: url("images/new-button.gif");
}
div#AdminButtons-Small table#AdminButtons a#AdminButtons-New {
	background-image: url("images/new-small-button.gif");
}
table#AdminButtons a#AdminButtons-Edit {
	text-align: left;
	padding-left: 25px;
	background-color: <?php echo $_SESSION['COLOR_NEWBG'] ?>;
	border-color: <?php echo $_SESSION['COLOR_NEWBORDER'] ?>;
	background-image: url("images/edit-button.gif");
}
div#AdminButtons-Small table#AdminButtons a#AdminButtons-Edit {
	background-image: url("images/edit-small-button.gif");
}
table#AdminButtons #AdminButtons-Copy {
	text-align: left;
	padding-left: 25px;
	background-color: <?php echo $_SESSION['COLOR_COPYBG'] ?>;
	border-color: <?php echo $_SESSION['COLOR_COPYBORDER'] ?>;
	background-image: url("images/copy-button.gif");
}
div#AdminButtons-Small table#AdminButtons a#AdminButtons-Copy {
	background-image: url("images/copy-small-button.gif");
}
table#AdminButtons #AdminButtons-Delete, table#AdminButtons #AdminButtons-Reject {
	text-align: left;
	padding-left: 25px;
	background-color: <?php echo $_SESSION['COLOR_DELETEBG'] ?>;
	border-color: <?php echo $_SESSION['COLOR_DELETEBORDER'] ?>;
	background-image: url("images/delete-button.gif");
}
div#AdminButtons-Small table#AdminButtons a#AdminButtons-Delete, div#AdminButtons-Small table#AdminButtons a#AdminButtons-Reject {
	background-image: url("images/delete-small-button.gif");
}
table#AdminButtons a#AdminButtons-Approve {
	text-align: left;
	padding-left: 25px;
	background-color: <?php echo $_SESSION['COLOR_APPROVEBG'] ?>;
	border-color: <?php echo $_SESSION['COLOR_APPROVEBORDER'] ?>;
	background-image: url("images/ok-button.gif");
}
div#AdminButtons-Small table#AdminButtons a#AdminButtons-Approve {
	background-image: url("images/ok-small-button.gif");
}

dd {
	margin-left: 20px;
}

div#UpdateBlock {
	background-color: <?php echo $_SESSION['COLOR_BG']; ?>;
	border-top-style: none;
	border-top-width: 0;
}
div#UpdateBlock h2 {
	padding: 0;
	margin: 0;
	font-size: 18px;
	font-weight: normal;
}

div#MenuButton {
	background-color: <?php echo $_SESSION['COLOR_BODY']; ?>;
	padding-left: 8px;
}
div#MenuButton td {
	padding: 0;
}
div#MenuButton a {
	text-decoration: none;
	font-weight: bold;
	padding: 6px;
	display: block;
	padding-left: 28px;
	background-color: <?php echo $_SESSION['COLOR_BODY']; ?>;
	background-repeat: no-repeat;
	background-position: center left;
	background-image: url("images/arrow-doubleback.gif");
}
div#MenuButton a:hover, div#MenuButton a:focus {
	background-color: <?php echo $_SESSION['COLOR_TODAY']; ?>;
}

/* The following two styles are for manageevents.php */
.DefaultCalendarEvent {
	padding-left: 8px;
}
.DefaultCalendarEvent div {
	padding-left: 15px;
	background-image: url("images/subeventdoublearrow.gif");
	background-repeat: no-repeat;
	background-position: 0 3px;
}

