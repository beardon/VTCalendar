<?php
require_once('application.inc.php');

if (!authorized()) { exit; }

if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
if (!isset($_POST['check']) || !setVar($check,$_POST['check'],'check')) unset($check);
if (!isset($_POST['template_name']) || !setVar($template_name,$_POST['template_name'],'template_name')) unset($template_name);
if (!isset($_POST['savetemplate']) || !setVar($savetemplate,$_POST['savetemplate'],'savetemplate')) unset($savetemplate);
if (isset($_POST['event'])) {
	if (!isset($_POST['event']['categoryid']) || !setVar($event['categoryid'],$_POST['event']['categoryid'],'categoryid')) unset($event['categoryid']);
	if (!isset($_POST['event']['title']) || !setVar($event['title'],$_POST['event']['title'],'title')) unset($event['title']);
	if (!isset($_POST['event']['location']) || !setVar($event['location'],$_POST['event']['location'],'location')) unset($event['location']);
	if (!isset($_POST['event']['price']) || !setVar($event['price'],$_POST['event']['price'],'price')) unset($event['price']);
	if (!isset($_POST['event']['description']) || !setVar($event['description'],$_POST['event']['description'],'description')) unset($event['description']);
	if (!isset($_POST['event']['displayedsponsor']) || !setVar($event['displayedsponsor'],$_POST['event']['displayedsponsor'],'displayedsponsor')) unset($event['displayedsponsor']);
	if (!isset($_POST['event']['displayedsponsorurl']) || !setVar($event['displayedsponsorurl'],$_POST['event']['displayedsponsorurl'],'url')) unset($event['displayedsponsorurl']);
	if (!isset($_POST['event']['showondefaultcal']) || !setVar($event['showondefaultcal'],$_POST['event']['showondefaultcal'],'showondefaultcal')) unset($event['showondefaultcal']);
	if (!isset($_POST['event']['contact_name']) || !setVar($event['contact_name'],$_POST['event']['contact_name'],'contact_name')) unset($event['contact_name']);
	if (!isset($_POST['event']['contact_phone']) || !setVar($event['contact_phone'],$_POST['event']['contact_phone'],'contact_phone')) unset($event['contact_phone']);
	if (!isset($_POST['event']['contact_email']) || !setVar($event['contact_email'],$_POST['event']['contact_email'],'contact_email')) unset($event['contact_email']);
}
else {
	unset ($event);
}

if (isset($cancel)) {
	redirect2URL("managetemplates.php");
	exit;
}

$event['sponsorid'] = $_SESSION["AUTH_SPONSORID"];
if (isset($check)) { // check all the parameter passed for validity and save into DB
	if (!empty($template_name)) { // parameter is ok
		// save template into DB
		insertintotemplate($template_name,$event);

		// reroute to sponsormenu page
		redirect2URL("managetemplates.php");
		exit;
	} // end: if (!empty($template_name))
} // end: if (isset($check))
else {
	$template_name = "";
	defaultevent($event,$_SESSION["AUTH_SPONSORID"]); // empty template
} // end else: if (isset($check))

pageheader(lang('add_new_template'), "Update");
contentsection_begin(lang('add_new_template'));
?>
<br>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php
	if (!isset($check)) { $check=0; }
	inputtemplatedata($event,$_SESSION["AUTH_SPONSORID"],$check,$template_name);
?>
 <br>
 <input type="submit" name="savetemplate" value="<?php echo lang('ok_button_text'); ?>">
 <input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>">
</form>
<?php
contentsection_end();
pagefooter();
DBclose();
?>