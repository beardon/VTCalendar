<?php
//require_once('config.inc.php');
//require_once('session_start.inc.php');

header("Content-Type: text/css");	
if (strpos(" ".$_SERVER["HTTP_USER_AGENT"],"MSIE") > 0) { $ie = 1; }
else { $ie = 0; }  
?>

.feedbackpos {
	FONT-WEIGHT: bold; 
	FONT-SIZE: <?php if ($ie) { echo "x-"; } ?>small; 
	COLOR: #008800;
}
.feedbackneg {
	FONT-WEIGHT: bold; 
	FONT-SIZE: <?php if ($ie) { echo "x-"; } ?>small; 
	COLOR: #CC0000;
}
code, pre {
	 font-size: 10pt;
}