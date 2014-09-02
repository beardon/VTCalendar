<?php
// Defines a single function that outputs the page header:
function pageheader($title, $navbaractive) {
	global $enableViewMonth, $timebegin, $queryStringExtension, $view;
	
	?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
		<head>
		<title><?php echo TITLEPREFIX; ?><?php echo $title; ?><?php echo TITLESUFFIX; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo lang('encoding'); ?>">
		<meta content="en-us" http-equiv=language>
		<?php if ($view == "event") { ?>
			<meta name="robots" content="index,follow">
		<?php } else { ?>
			<meta name="robots" content="noindex,follow">
		<?php } ?>
		<link rel="alternate" type="application/rss+xml" title="<?php lang('rss_feed_title'); ?>" href="export/export.php?calendarid=<?php echo urlencode($_SESSION['CALENDAR_ID']); ?>&format=rss2_0">
		<script type="text/javascript" src="scripts/browsersniffer.js"></script>
		<script type="text/javascript" src="scripts/general.js"></script>
		<script type="text/javascript" src="scripts/update.js"></script>
		<script type="text/javascript" src="scripts/colorpicker/colorpicker.js"></script>
		<script type="text/javascript"><!--
		// If the browser does not support try/catch, then do not let it run the ChangeCalendar() scripts.
		if (is_ie3 || is_ie4 || is_js < 1.3) {
			document.write("<s"+"cript type=\"text/javascript\">function ChangeCalendar() { return true; }</s"+"cript>");
		}
		else {
			document.write("<s"+"cript type=\"text/javascript\" src=\"scripts/http.js\"></s"+"cript>");
			document.write("<s"+"cript type=\"text/javascript\" src=\"scripts/main.js\"></s"+"cript>");
		}
		//--></script>
		<!--[if lt IE 7]><style type="text/css">img, .png { behavior: url(scripts/iepngfix.htc); }</style><![endif]-->
		<!--<link href="stylesheet.php" rel="stylesheet" type="text/css">-->
		<link href="calendar.css.php" rel="stylesheet" type="text/css" media="screen">
		<link href="print.css" rel="stylesheet" type="text/css" media="print">
		<!--[if lte IE 6]><style>
		#RightColumn #MonthTable div.DayNumber a { height: 1em; }
		</style><![endif]-->
	</head>
	<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">
	
	<?php if (INCLUDE_STATIC_PRE_HEADER && $_SESSION['CALENDAR_ID'] != 'default') @(readfile('static-includes/subcalendar-pre-header.txt')); ?>
	
	<!-- Start Calendar Header --><?php echo $_SESSION['CALENDAR_HEADER']; ?><!-- End Calendar Header -->

	<?php if (INCLUDE_STATIC_POST_HEADER && $_SESSION['CALENDAR_ID'] != 'default') @(readfile('static-includes/subcalendar-post-header.txt')); ?>
	
	<div id="CalendarBlock">
	
	<!-- Start of Top Navi Table -->
	<table id="TopNaviTable" width="100%" border="0" cellpadding="3" cellspacing="0">
		<tr>
			<td class="TopNavi-ColorPadding">&nbsp;&nbsp;&nbsp;</td>
			<td id="TopNavi-Logo" valign="bottom"><a href="main.php?calendarid=<?php echo urlencode($_SESSION['CALENDAR_ID']);?>&view=<?php if (SHOW_UPCOMING_TAB) echo "upcoming"; else echo "day"; echo $queryStringExtension; ?>"><img src="images/logo.gif" alt="" width="34" height="34" border="0"></a></td>
			<td class="TopNavi-ColorPadding" width="100%" valign="bottom">
				<table width="100%" border="0" cellpadding="6" cellspacing="0">
					<tr>
						<td id="NaviBar-CalendarTitle" valign="bottom" nowrap><a href="main.php?calendarid=<?php echo urlencode($_SESSION['CALENDAR_ID']);?>&view=<?php if (SHOW_UPCOMING_TAB) echo "upcoming"; else echo "day"; echo $queryStringExtension; ?>"><?php if (isset($_SESSION['CALENDAR_TITLE'])) { echo $_SESSION['CALENDAR_TITLE']; } else { echo lang('calendar'); } ?></a></td>
						<?php if (SHOW_UPCOMING_TAB) { ?>
							<td valign="bottom" <?php if ($navbaractive=="Upcoming") { echo 'id="NaviBar-Selected"'; }  ?> class="NaviBar-Tab"><div><?php if ($navbaractive=="Upcoming") echo lang('upcoming'); else { echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=upcoming" >',lang('upcoming'),'</a>'; } ?></div></td>
						<?php } ?>
						<td valign="bottom" <?php if ($navbaractive=="Day") { echo 'id="NaviBar-Selected"'; }  ?> class="NaviBar-Tab"><div><?php if ($navbaractive=="Day") echo lang('day'); else { echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=day&timebegin='.urlencode($timebegin).$queryStringExtension.'" >',lang('day'),'</a>'; } ?></div></td>
						<td valign="bottom" <?php if ($navbaractive=="Week") { echo 'id="NaviBar-Selected"'; }  ?> class="NaviBar-Tab"><div><?php if ($navbaractive=="Week") echo lang('week'); else { echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=week&timebegin='.urlencode($timebegin).$queryStringExtension.'" >',lang('week'),'</a>'; } ?></div></td>
						<?php if ($enableViewMonth) { ?>
							<td valign="bottom" <?php if ($navbaractive=="Month") { echo 'id="NaviBar-Selected"'; }  ?> class="NaviBar-Tab"><div><?php if ($navbaractive=="Month") echo lang('month'); else { echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=month&timebegin='.urlencode($timebegin).$queryStringExtension.'">',lang('month'),'</a>'; } ?></div></td>
						<?php } ?>
						<td valign="bottom" <?php if ($navbaractive=="Search" || $navbaractive=="SearchResults") { echo 'id="NaviBar-Selected"'; }  ?> class="NaviBar-Tab"><div><?php if ($navbaractive=="Search") echo lang('search'); else { echo '<a href="main.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&view=search">',lang('search'),'</a>'; } ?></div></td>
						<?php 
						
							if (!empty($_SESSION["AUTH_USERID"])) {
								?><td width="100%" align="right"><b><?php echo htmlentities($_SESSION["AUTH_USERID"]); ?></b> 
								<?php
								if (!empty($_SESSION["AUTH_SPONSORNAME"])) {
									echo "(";
									
									if (isset($_SESSION["AUTH_SPONSORCOUNT"]) && $_SESSION["AUTH_SPONSORCOUNT"] > 1) {
										echo '<a href="update.php?authsponsorid=" title="Change Sponsor">',htmlentities($_SESSION["AUTH_SPONSORNAME"]),"</a>";
									} else {
										echo htmlentities($_SESSION["AUTH_SPONSORNAME"]);
									}
									
									echo ")";
								}
								?>&nbsp;<?php //echo lang('is_logged_on'); ?></td>
							<td valign="bottom" class="NaviBar-Tab"><div><a href="logout.php"><?php echo lang('logout'); ?></a></div></td>
								<?php
							}
							else {
								?><td width="100%">&nbsp;</td><?php
							}
						
						?></td>
						<td valign="bottom" <?php if ($navbaractive=="Update") { echo 'id="NaviBar-Selected"'; }  ?> class="NaviBar-Tab"><div><a href="<?php echo SECUREBASEURL; ?>update.php"><?php echo lang('update'); ?></a></div></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<!-- End of Top Navi Table -->
	<?php
}

function pagefooter() {
	// End of <div id="CalendarBlock">
	?></div>

	<?php if (INCLUDE_STATIC_PRE_FOOTER && $_SESSION['CALENDAR_ID'] != 'default') @(readfile('static-includes/subcalendar-pre-footer.txt')); ?>

	<!-- Start Calendar Footer -->
	<?php echo $_SESSION['CALENDAR_FOOTER']; ?>
	<!-- End Calendar Footer -->

	<?php if (INCLUDE_STATIC_POST_FOOTER && $_SESSION['CALENDAR_ID'] != 'default') @(readfile('static-includes/subcalendar-post-footer.txt')); ?>

	</body>
	</html>
	<?php
}

// Output the beginning of a section where content can be displayed.
// Normally, the background is colored and the background of the calendar cells are colored white.
// When any other content needs to be displayed, it should be enclosed by contentsection_begin and contentsection_end.
function contentsection_begin($headertext="", $showBackToMenuButton=false) {
	
	if ($showBackToMenuButton) {
		?><div id="MenuButton"><table border="0" cellpadding="3" cellspacing="0"><tr><td><b><a href="update.php"><?php echo lang('back_to_menu'); ?></a></b></td></tr></table></div><?php
	}
	
	?><div id="UpdateBlock"><div style="border: 1px solid <?php echo $_SESSION['COLOR_BORDER']; ?>; padding: 8px;"><?php
	
	if (!empty($headertext)) {
		echo "<h2>".htmlentities($headertext).":</h2>";
	}
}

// Output the end of a section where content can be displayed.
// Normally, the background is colored and the background of the calendar cells are colored white.
// When any other content needs to be displayed, it should be enclosed by contentsection_begin and contentsection_end.
function contentsection_end() {
	?></div></div><?php
}

// Outputs the header HTML code for a pop-up help window. See helpwindow_footer() as well.
function helpwindow_header() {
	?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
	<head>
		<title><?php echo lang('help'); ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta content="en-us" http-equiv=language>
		<link href="calendar.css.php" rel="stylesheet" type="text/css">
		<!--<link href="stylesheet.php" rel="stylesheet" type="text/css">-->
	</head>
	<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0" onLoad="this.window.focus()">
		<br>
		<table border="0" cellPadding="5" cellSpacing="0">
			<tr>
			<td>&nbsp;</td>
			<td bgcolor="<?php echo $_SESSION['COLOR_LIGHT_CELL_BG']; ?>"><?php
} // end: function helpwindow_header
	
// Outputs the footer HTML code for a pop-up help window. See helpwindow_header() as well.
function helpwindow_footer() {
	?></td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<br>
	</body>
	</html>
	<?php
} // end: function helpwindow_footer
?>