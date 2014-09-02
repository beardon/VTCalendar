<?php

// ##############################################
// WARNING: If you want to override the defaults below, define them in config.inc.php.
// Any changes to this file may be overwritten when you upgrade to a newer version of VTCalendar.
// ##############################################

// START GENERATED

// =====================================
// General
// =====================================

// Config: Title Prefix
// Added at the beginning of the <title> tag.
if (!defined("TITLEPREFIX")) define("TITLEPREFIX", "");

// Config: Title Suffix
// Example: " - My University"
// Added at the end of the <title> tag.
if (!defined("TITLESUFFIX")) define("TITLESUFFIX", "");

// Config: Language
// Example: en, de
// Language used (refers to language file in directory /languages)
if (!defined("LANGUAGE")) define("LANGUAGE", 'en');

// =====================================
// Database
// =====================================

// Config: Database Connection String
// Example: mysql://vtcal:abc123@localhost/vtcalendar
// This is the database connection string used by the PEAR library.
// It has the format: "mysql://user:password@host/databasename" or "postgres://user:password@host/databasename"
if (!defined("DATABASE")) define("DATABASE", "");

// Config: SQL Log File
// Example: /var/log/vtcalendarsql.log
// Put a name of a (folder and) file where the calendar logs every SQL query to the database.
// This is good for debugging but make sure you write into a file that's not readable by the webserver or else you may expose private information.
// If left blank ("") no log will be kept. That's the default.
if (!defined("SQLLOGFILE")) define("SQLLOGFILE", "");

// =====================================
// Authentication
// =====================================

// Config: User ID Regular Expression
// This regular expression defines what is considered a valid user-ID.
if (!defined("REGEXVALIDUSERID")) define("REGEXVALIDUSERID", '/^[A-Za-z][\\._A-Za-z0-9\\-\\\\]{1,49}$/');

// Config: Database Authentication
// Authenticate users against the database.
// If enabled, this is always performed before any other authentication.
if (!defined("AUTH_DB")) define("AUTH_DB", true);

// Config: Prefix for Database Usernames
// Example: db_
// This prefix is used when creating/editing a local user-ID (in the DB "user" table), e.g. "calendar."
// If you only use auth_db just leave it an empty string.
// Its purpose is to avoid name-space conflicts with the users authenticated via LDAP or HTTP.
if (!defined("AUTH_DB_USER_PREFIX")) define("AUTH_DB_USER_PREFIX", "");

// Config: Database Authentication Notice
// This displays a text (or nothing) on the Update tab behind the user user management options.
// It could be used if you employ both, AUTH_DB and AUTH_LDAP at the same time to let users know that they should create local users only if they are not in the LDAP.
if (!defined("AUTH_DB_NOTICE")) define("AUTH_DB_NOTICE", "");

// Config: LDAP Authentication
// Authenticate users against a LDAP server.
// If enabled, HTTP authenticate will be ignored.
if (!defined("AUTH_LDAP")) define("AUTH_LDAP", false);

// Config: LDAP Host Name
// Example: directory.myuniversity.edu or ldap://directory.myuniversity.edu/ or ldaps://secure-directory.myuniversity.edu/
// If you are using OpenLDAP 2.x.x you can specify a URL ('ldap://host/') instead of the hostname ('host').
if (!defined("LDAP_HOST")) define("LDAP_HOST", "");

// Config: LDAP Port
// The port to connect to. Ignored if LDAP Host Name is a URL.
if (!defined("LDAP_PORT")) define("LDAP_PORT", 389);

// Config: LDAP Username Attribute
// Example: sAMAccountName
// The attribute which contains the username.
if (!defined("LDAP_USERFIELD")) define("LDAP_USERFIELD", "");

// Config: LDAP Base DN
// Example: DC=myuniversity,DC=edu
if (!defined("LDAP_BASE_DN")) define("LDAP_BASE_DN", "");

// Config: Additional LDAP Search Filter
// Example: (objectClass=person)
// An optional filter to add to the LDAP search.
if (!defined("LDAP_SEARCH_FILTER")) define("LDAP_SEARCH_FILTER", "");

// Config: LDAP Search Bind Username.
// Before authenticating the user, we first check if the username exists.
// If your LDAP server does not allow anonymous connections, specific a username here.
// Leave this blank to connect anonymously.
if (!defined("LDAP_BIND_USER")) define("LDAP_BIND_USER", "");

// Config: LDAP Search Bind Password
// Before authenticating the user, we first check if the username exists.
// If your LDAP server does not allow anonymous connections, specific a password here.
// Leave this blank to connect anonymously.
if (!defined("LDAP_BIND_PASSWORD")) define("LDAP_BIND_PASSWORD", "");

// Config: HTTP Authentication
// Authenticate users by sending an HTTP request to a server.
// A HTTP status code of 200 will authorize the user. Otherwise, they will not be authorized.
// If LDAP authentication is enabled, this will be ignored.
if (!defined("AUTH_HTTP")) define("AUTH_HTTP", false);

// Config: HTTP Authorizaton URL
// Example: http://localhost/customauth.php
// The URL to use for the BASIC HTTP Authentication.
if (!defined("AUTH_HTTP_URL")) define("AUTH_HTTP_URL", "");

// =====================================
// Cookies
// =====================================

// Config: Cookie Base URL
// Example: /calendar/
// If you are hosting more than one VTCalendar on your server, you may want to set this to this calendar's base URL.
// Otherwise, the cookie will be submitted with a default path.
// This must start and end with a forward slash (/), unless the it is exactly "/".
if (!defined("BASEPATH")) define("BASEPATH", "");

// Config: Cookie Host Name
// Example: localhost
// If you are hosting more than one VTCalendar on your server, you may want to set this to your server's host name.
// Otherwise, the cookie will be submitted with a default host name.
if (!defined("BASEDOMAIN")) define("BASEDOMAIN", "");

// =====================================
// URL
// =====================================

// Config: Calendar Base URL
// Example: http://localhost/calendar/
// This is the absolute URL where your calendar software is located.
// This MUST end with a slash "/"
if (!defined("BASEURL")) define("BASEURL", "");

// Config: Secure Calendar Base URL
// Example: https://localhost/calendar/
// This is the absolute path where the secure version of the calendar is located.
// If you are not using URL, set this to the same address as BASEURL.
// This MUST end with a slash "/"
if (!defined("SECUREBASEURL")) define("SECUREBASEURL", BASEURL);

// =====================================
// Date/Time
// =====================================

// Config: Timezone Offset
// Example: -5
// Defines the offset to GMT, can be positive or negative
if (!defined("TIMEZONE_OFFSET")) define("TIMEZONE_OFFSET", 5);

// Config: Week Starting Day
// defines the week starting day - allowable values - 0 for "Sunday" or 1 for "Monday"
if (!defined("WEEK_STARTING_DAY")) define("WEEK_STARTING_DAY", 0);

// Config: Use AM/PM
// defines time format e.g. 1am-11pm (true) or 1:00-23:00 (false)
if (!defined("USE_AMPM")) define("USE_AMPM", true);

// =====================================
// Display
// =====================================

// Config: Column Position
// Which side the little calendar, 'jump to', 'today is', etc. will be on.
// Values must be LEFT or RIGHT.
if (!defined("COLUMNSIDE")) define("COLUMNSIDE", 'LEFT');

// Config: Show Upcoming Tab
// Whether or not the upcoming tab will be shown.
if (!defined("SHOW_UPCOMING_TAB")) define("SHOW_UPCOMING_TAB", true);

// Config: Max Upcoming Events
// Whether or not the upcoming tab will be shown.
if (!defined("MAX_UPCOMING_EVENTS")) define("MAX_UPCOMING_EVENTS", 75);

// Config: Show Month Overlap
// Whether or not events in month view on days that are not actually part of the current month should be shown.
// For example, if the first day of the month starts on a Wednesday, then Sunday-Tuesday are from the previous month.
// Values must be true or false.
if (!defined("SHOW_MONTH_OVERLAP")) define("SHOW_MONTH_OVERLAP", true);

// =====================================
// Cache
// =====================================

// Config: HTTP Authentication Cache
// Cache successful HTTP authentication attempts as hashes in DB.
// This acts as a failover if the HTTP authentication fails due to a server error.
if (!defined("AUTH_HTTP_CACHE")) define("AUTH_HTTP_CACHE", false);

// Config: HTTP Authentication Cache Expiration
// The number of days in which data in the HTTP authentication cache is valid.
if (!defined("AUTH_HTTP_CACHE_EXPIRATIONDAYS")) define("AUTH_HTTP_CACHE_EXPIRATIONDAYS", 4);

// Config: Max Category Name Cache Size
// Cache the list of category names in memory if the calendar has less than or equal to this number.
if (!defined("MAX_CACHESIZE_CATEGORYNAME")) define("MAX_CACHESIZE_CATEGORYNAME", 100);

// END GENERATED

// ---------- The following functions allow you to customize processing based on your database -------

/*// escapes a value to make it safe for a SQL query
if (!function_exists('sqlescape')) {
	function sqlescape($value) {
	  if (preg_match("/^pgsql/",DATABASE)) {
		  return pg_escape_string($value);
		}
		else {
			return mysql_escape_string($value);
		}
	}
}*/

// --------------- The following functions allow you to customize the date format display ------------
 
// formats date output for date title in day and event view
if (!function_exists('day_view_date_format')) {
	function day_view_date_format($date,$dow,$month, $year) {
	  // US format
	  return $dow.", ".$month." ".$date.", ".$year;
	  // Latvian format
	  // return $dow.", ".$date.". ".$month.", ".$year;
	}
}

// formats date output for datetitle in week view
if (!function_exists('week_view_date_format')) {
	function week_view_date_format($date_from, $month_from, $year_from, $date_to, $month_to, $year_to) {
	  // US format
	  $date_str = $month_from . " " . $date_from; 
	  if ($year_from != $year_to) {
	     $date_str.=", ".$year_from;
	  }
	  $date_str.=" - ";
	  if($month_from != $month_to){
	     $date_str .= $month_to . " ";
	  }
	  $date_str .= $date_to . ", " . $year_to; 
	  return  $date_str;
	
	  // Latvian format
	/*
	  $date_str=$date_from.". "; // "13. "
	  if($month_from != $month_to){
	     $date_str.=strtolower($month_from);   //"13. janvaris"
	  }
	  if( $year_from != $year_to){
	     $date_str.=", ".$year_from; //  "13. janvaris, 2003"
	  }
	  $date_str.=" - ";
	  $date_str.=$date_to.". ".strtolower($month_to).", ".$year_to;   
	  return  $date_str;
	*/  
	}
}

// formats date output for date title in month view
if (!function_exists('month_view_date_format')) {
	function month_view_date_format($month, $year) {
	  // US format
	  return $month." ".$year;
	  
	  // Latvian format
	  // return $month.", ".$year;
	}
}

// formats date output for date above little calendar (month browsing link)
if (!function_exists('above_lit_cal_date_format')) {
	function above_lit_cal_date_format($month, $year) {
	  // US format
	  return substr($month,0,3)." ".$year;
	
	  // Latvian format
	  // return substr($month,0,3).", ".$year;
	}
}

// formats date output for todays date under little calendar
if (!function_exists('today_is_date_format')) {
	function today_is_date_format($date, $dow, $month, $year) {
	  // US format
	  return substr($dow,0,3).", ".substr($month,0,3)." ".ltrim($date,"0").", ".$year;
	
	  // Latvian format
	  // return $dow.", ".$date.". ".strtolower($month).", ".$year;
	}
}

// formats date for weeks view day's header
if (!function_exists('week_header_date_format')) {
	function week_header_date_format($date, $month){
	  // US format
	  return substr($month,0,3)." ".$date;
	  
	  // Latvian format
	  // return $date.". ".strtolower(substr($month,0,3));
	}
}

// formats date for searchresult in found items list
if (!function_exists('searchresult_date_format')) {
	function searchresult_date_format($date, $dow, $month, $year) {
	  // US format
	  return substr($dow,0,3).", ".substr($month,0,3)." ".$date.", ".$year;
	
	  // Latvian format
	  // return $dow.", ".$date.". ".strtolower(substr($month,0,3)).", ".$year;
	}
}

?>