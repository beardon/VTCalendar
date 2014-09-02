<?php
require_once('application.inc.php');
require_once('changecolors-functions.inc.php');

if (!authorized()) { exit; }
if (!$_SESSION['AUTH_ISCALENDARADMIN']) { exit; } // additional security

if (!isset($_POST['cancel']) || !setVar($cancel,$_POST['cancel'],'cancel')) unset($cancel);
if (!isset($_POST['save']) || !setVar($save,$_POST['save'],'save')) unset($save);

if (isset($cancel)) {
	redirect2URL("update.php");
	exit;
};

// Load variables
$VariableErrors = array();
LoadVariables();

if (isset($save) && count($VariableErrors) == 0) {
	$result =& DBQuery("SELECT count(*) as reccount FROM ".SCHEMANAME."vtcal_colors WHERE calendarid='" . sqlescape($_SESSION['CALENDAR_ID']) . "'");
	if (is_string($result)) { DBErrorBox($result); exit; }
	
	$count =& $result->fetchRow(DB_FETCHMODE_ASSOC,0);
	if ($count['reccount'] == 0) {
		$sql = MakeColorUpdateSQL($_SESSION['CALENDAR_ID'], 'insert');
	}
	else {
		$sql = MakeColorUpdateSQL($_SESSION['CALENDAR_ID'], 'update');
	}
	
	$result =& DBQuery($sql);
	if (is_string($result)) { DBErrorBox($result); exit; }
	
	setCalendarPreferences();
	
	redirect2URL("update.php");
	exit;
}

pageheader(lang('change_colors'), "Update");
contentsection_begin(lang('change_colors'));
?>

<script type="text/javascript">
var pickerOpened = false;
document.ChangingColorID = null;
document.ColorChangeHandler = function(hex) {
	document.getElementById("Color_" + document.ChangingColorID).value = "#" + hex;
	ColorChanged(document.ChangingColorID);
	document.ChangingColorID = null;
}
function SetupColorPicker(idbase) {
	pickerOpened = false;
	document.ChangingColorID = idbase;
	PickColor('Swap_' + idbase, escape(document.getElementById("Color_" + idbase).value));
}
document.PickerOpenedHandler = function() {
	setTimeout("PickerFinishedOpening()", 500);
}
function PickerFinishedOpening() {
	pickerOpened = true;
}
document.body.onclick = function() {
	if (pickerOpened && ClosePicker) ClosePicker();
}
function ColorChanged(idbase) {
	document.getElementById("Swap_" + idbase).style.backgroundColor = document.getElementById("Color_" + idbase).value;
}
function ResetValue(idbase, defaultValue) {
	document.getElementById("Color_" + idbase).value = defaultValue;
	ColorChanged(idbase);
}
</script>

<form method="post" action="changecolors.php" name="colorSettings">

<p><input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>" class="button">&nbsp;&nbsp;<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>" class="button"></p>

<?php ShowForm(); ?>

<p><input type="submit" name="save" value="<?php echo lang('ok_button_text'); ?>" class="button">&nbsp;&nbsp;<input type="submit" name="cancel" value="<?php echo lang('cancel_button_text'); ?>" class="button"></p>
</form>

<iframe id="ColorPicker" style="background-color: #FFFFFF; border: 1px solid #666666; position: absolute; display: none;" src="scripts/colorpicker/blank.html" frameborder="0" width="440" height="308" style="border: 1px solid #FF0000" scrolling="no" marginheight="0" marginwidth="0">Cannot display color picker</iframe>

<?php 
contentsection_end();
pagefooter();
DBclose();
?>