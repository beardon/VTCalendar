<?php
// Create an ID for an event that is as unique as possible.
function getNewEventId() {
	return sprintf('%010s%03s', time(), rand(0,999));
}

// Used by the calendar admin scripts (e.g. update.php) to output small error messages.
function feedback($msg,$type) {
	echo '<b class="';
	if ($type==0) { echo "NotificationText"; } // positive feedback
	if ($type==1) { echo "WarningText"; } // error message
	echo '">';
	echo $msg;
	echo '</b><br>';
}

// NOT USED
function verifyCancelURL($httpreferer) {
	if (empty($httpreferer)) {
		$httpreferer = "update.php";
	}
	return $httpreferer;
}

// Used by the calendar admin scripts (e.g. update.php)
// to fully redirect a visitor from one page to another
function redirect2URL($url) {
	if (empty($url)) {
		$url = "update.php";
	}
	if (preg_match("/^[a-z]+:\/\//i", $url) == 0)
	{
		$url = SECUREBASEURL . $url;
	}
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $url");
	return TRUE;
}

// Get the complete URL that points to the current calendar.
function getFullCalendarURL($calendarid) {
	return BASEURL."main.php?calendarid=" . urlencode($calendarid);
}

// Sends an email to a sponsor.
function sendemail2sponsor($sponsorname,$sponsoremail,$subject,$body) {
	$body.= "\n\n";
	$body.= "----------------------------------------\n";
	$body.= $_SESSION['CALENDAR_NAME']." \n";
	$body.= getFullCalendarURL($_SESSION['CALENDAR_ID'])."\n";
	$body.= $_SESSION['CALENDAR_ADMINEMAIL']."\n";
	
	sendemail($sponsorname,$sponsoremail,lang('calendar_administration'),$_SESSION['CALENDAR_ADMINEMAIL'],$subject,$body);
}

function sendemail2user($useremail,$subject,$body) {
	$body.= "\n\n";
	$body.= "----------------------------------------\n";
	$body.= $_SESSION['CALENDAR_NAME']."\n";
	$body.= getFullCalendarURL($_SESSION['CALENDAR_ID'])."\n";
	$body.= $_SESSION['CALENDAR_ADMINEMAIL']."\n";
	
	sendemail($useremail,$useremail,lang('calendar_administration'),$_SESSION['CALENDAR_ADMINEMAIL'],$subject,$body);
}

// highlights all occurrences of the keyword in the text
// case-insensitive
function highlight_keyword($keyword, $text) {
	$keyword = preg_quote($keyword, '/');
	$newtext = preg_replace('/'.$keyword.'/Usi','<span class="KeywordHighlight">\\0</span>',$text);
	return $newtext;
}

/**
 * Taken from phpBB 2.0.19 (from phpBB2/includes/bbcode.php)
 *
 * Rewritten by Nathan Codding - Feb 6, 2001.
 * - Goes through the given string, and replaces xxxx://yyyy with an HTML <a> tag linking
 *   to that URL
 * - Goes through the given string, and replaces www.xxxx.yyyy[zzzz] with an HTML <a> tag linking
 *   to http://www.xxxx.yyyy[/zzzz]
 * - Goes through the given string, and replaces xxxx@yyyy with an HTML mailto: tag linking
 *   to that email address
 * - Only matches these 2 patterns either after a space, or at the beginning of a line
 *
 * Notes: the email one might get annoying - it's easy to make it more restrictive, though.. maybe
 * have it require something like xxxx@yyyy.zzzz or such. We'll see.
 */
function make_clickable($text)
{
	$text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1&#058;", $text);

	// pad it with a space so we can match things at the start of the 1st line.
	$ret = ' ' . $text;

	// matches an "xxxx://yyyy" URL at the start of a line, or after a space.
	// xxxx can only be alpha characters.
	// yyyy is anything up to the first space, newline, comma, double quote or <
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);

	// matches a "www|ftp.xxxx.yyyy[/zzzz]" kinda lazy URL thing
	// Must contain at least 2 dots. xxxx contains either alphanum, or "-"
	// zzzz is optional.. will contain everything up to the first space, newline, 
	// comma, double quote or <.
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);

	// matches an email@domain type address at the start of a line, or after a space.
	// Note: Only the followed chars are valid; alphanums, "-", "_" and or ".".
	$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);

	// Remove our padding..
	$ret = substr($ret, 1);

	return($ret);
}

// remove slashes from event fields
function removeslashes(&$event) {
	if (get_magic_quotes_gpc()) {
		$event['title']=stripslashes($event['title']);
		if (isset($event['description'])) $event['description']=stripslashes($event['description']);
		if (isset($event['location'])) $event['location']=stripslashes($event['location']);
		if (isset($event['price'])) $event['price']=stripslashes($event['price']);
		if (isset($event['contact_name'])) $event['contact_name']=stripslashes($event['contact_name']);
		if (isset($event['contact_phone'])) $event['contact_phone']=stripslashes($event['contact_phone']);
		if (isset($event['contact_email'])) $event['contact_email']=stripslashes($event['contact_email']);
		if (isset($event['displayedsponsor'])) $event['displayedsponsor']=stripslashes($event['displayedsponsor']);
		if (isset($event['displayedsponsorurl'])) $event['displayedsponsorurl']=stripslashes($event['displayedsponsorurl']);
	}
}

/* Make sure a URL starts with a protocol */
function checkURL($url) {
	return
		(empty($url) || 
		 strtolower(substr($url,0,7))=="http://" ||
		 strtolower(substr($url,0,8))=="https://"
		 );
}

/* Check that a e-mail address is valid */
function checkemail($email) {
	return
		((!empty($email)) && (eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$",$email)));
}

// Run a sanity check on incoming request variables and set particular variables if checks are passed
function setVar(&$var,$value,$type=NULL,$default=NULL) {
	// Since we are using the ISO-8859-1 we must handle characters from 127 to 159, which are invalid.
	// These typically come from Microsoft word or from other Web sites.
	$badchars = array(
		chr(133), // ...
		chr(145), // left single quote
		chr(146), // right single quote
		chr(147), // left double quote
		chr(148), // right double quote
		chr(149), // bullet
		chr(150), // ndash
		chr(151), // mdash
		chr(153)  // trademark
	);
	$goodchar = array(
		'...',    // ...
		"'",      // left single quote
		"'",      // right single quote
		'"',      // left double quote
		'"',      // right double quote
		chr(183), // bullet (converted to middle dot)
		'-',      // ndash
		'-',      // mdash
		'(TM)'    // trademark
	);
	$value = str_replace($badchars, $goodchar, $value);
	
	// Remove all other characters from 127 to 159
	$value = preg_replace("/[\x7F-\x9F]/","",$value);
	
	if (isset($value)) {
		// first, remove any escaping that may have happened if magic_quotes_gpc is set to ON in php.ini
		if (get_magic_quotes_gpc()) {
			if (is_array($value)) {
				foreach ($value as $key=>$v) {
					$value[$key] = stripslashes($v);
				}
			}
			else {
				$value = stripslashes($value);
			}
		}
		
		if ($type === NULL || isValidInput($value, $type)) {
			$var = $value;
			return true;
		}
	}
	
	// Set the var to the default if the value was invalid and a default was set.
	if ($default !== NULL) {
		$var = $default;
	}
	
	return false;
}

// returns a string in a particular language
function lang($sTextKey) {
	global $lang;
	
	if (!isset($lang[$sTextKey])) {
		trigger_error("Lang key '".$sTextKey."' not found", E_USER_WARNING);
		return "";
	}
	else {
		// Debug code that reverses case so inline text (aka: text not using lang()) can easily be located.
		/*$finalstr = "";
		for ($i=0; $i < strlen($lang[$sTextKey]); $i++) {
			if (strtolower(substr($lang[$sTextKey], $i, 1)) === substr($lang[$sTextKey], $i, 1)) {
				$finalstr .= strtoupper(substr($lang[$sTextKey], $i, 1));
			}
			else {
				$finalstr .= strtolower(substr($lang[$sTextKey], $i, 1));
			}
		}
		return $finalstr;*/
		
		$text = $lang[$sTextKey];
		
		if (strpos($text, '@FILE:') === 0) {
			return file_get_contents(substr($text, 6));
		}
		else {
			return $text;
		}
	}
}

// Formats a string so that it can be placed inside of a JavaScript string (e.g. document.write('');)
function escapeJavaScriptString($string) {
	return str_replace("\t", "\\t", str_replace("\r", "\\r", str_replace("\n", "\\n", str_replace("\"", "\\\"", str_replace("'", "\\'", str_replace("\\", "\\\\", $string))))));
}

if (!function_exists("html_entity_decode")) {
	function html_entity_decode($string, $quote_style=NULL, $charset=NULL) {
		return str_replace("&amp;", "&", str_replace("&lt;", "<", str_replace("&gt;", ">", str_replace("&quot;", '"', $string))));
	}
}

// PHP < 5 Compatibility Function
// By mqchen at http://us3.php.net/manual/en/function.http-build-query.php#72911
if(!function_exists('http_build_query')) {
	function http_build_query($data, $prefix=null, $sep='', $key='') {
		$ret = array();
		foreach((array)$data as $k => $v) {
			$k = urlencode($k);
			if(is_int($k) && $prefix != null) {
				$k = $prefix . $k;
			};
			if(!empty($key)) {
				$k = $key . "[" . $k . "]";
			};
			
			if(is_array($v) || is_object($v)) {
				array_push($ret, http_build_query($v, "", $sep, $k));
			}
			else {
				array_push($ret, $k."=".urlencode($v));
			};
		};
		
		if(empty($sep)) {
			$sep = ini_get("arg_separator.output");
		};
		
		return implode($sep, $ret);
	};
};
?>