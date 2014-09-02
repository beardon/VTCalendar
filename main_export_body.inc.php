<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

// Unset the selected categories if they are all selected.
// This prevents a huge query string in the export URL.
if (isset($FormData['categories']) && count($FormData['categories']) == $numcategories) unset($FormData['categories']);

if (!DOPREVIEW || count($FormErrors) != 0) {
	echo '<div style="padding: 10px; padding-bottom: 0;">' . lang('export_form_description') .'</div>';
}

?><form id="ExportForm" name="ExportForm" method="get" action="main.php" class="HideHTML">
<input type="hidden" name="view" value="export"><?php

if (DOPREVIEW && count($FormErrors) == 0) {

	echo '<table border="0" cellspacing="0" cellpadding="10" width="100%"><tr><td>';
	
	// Create the query string and output hidden <input> so that we can return to the form.
	$URL = BASEURL.EXPORT_PATH."?calendarid=" . $_SESSION['CALENDAR_ID'];
	foreach($FormData as $key => $val) {
		// Output separate <input> if the value is an array.
		if (is_array($val)) {
			$URL .= '&' .urlencode($key) . '=' . urlencode(implode(',', $val));
			foreach ($val as $arrayval) {
				echo "\n".'<input type="hidden" name="'.($key == 'categories' ? "c" : htmlentities($key)).'[]" value="'.htmlentities($arrayval).'">';
			}
		}
		else {
			if (!isset($FormDataDefaults[$key]) || $val != $FormDataDefaults[$key]) {
				$URL .= '&' . urlencode($key) . '=' . urlencode($val);
			}
			echo "\n".'<input type="hidden" name="'.htmlentities($key).'" value="'.htmlentities($val).'">';
		}
	}
	if (ISCALADMIN) {
		$URL .= "&adminexport=1";
	}
	?>
	
	<div><input type="submit" value="&lt;&lt; <?php echo lang('export_preview_return'); ?>"></div>
	
	<p><b><?php echo lang('export_preview_download'); ?>:</b><br>
	<?php echo str_replace('%URL%', htmlentities($URL), lang('export_preview_download_text')); ?></p>
	
	<p><b><?php echo lang('export_preview_url'); ?>:</b><br>
	<?php echo lang('export_preview_url_text'); ?><br>
	<input type="text" readonly="readonly" value="<?php echo htmlentities($URL); ?>" style="width: 100%" onfocus="this.select();" onclick="this.select(); this.focus();"></p>
	
	<?php if ($FormData['format'] == 'js' || ($FormData['format'] == 'html' && $FormData['jshtml'] == '1')) { ?>
	<p><b><?php echo lang('export_preview_js'); ?>:</b><br>
	<?php echo lang('export_preview_js_text'); ?><br>
	<input type="text" readonly="readonly" value="<?php echo htmlentities('<script type="text/javascript" src="'.htmlentities($URL).'"></script>'); ?>" style="width: 100%" onfocus="this.select();" onclick="this.select(); this.focus();"></p>
	<?php } ?>
	
	<p><b><?php echo lang('export_preview_raw'); ?>:</b><br>
	<?php echo lang('export_preview_raw_text'); ?><br>
	<iframe style="margin-top: 4px; background-color: #FFFFFF;" src="<?php echo $URL; ?>&raw=1" width="99%" height="400" framebordder="1"><p><a href="<?php echo $URL; ?>&raw=1" target="_blank">Test the URL</a></p></iframe></p>

	<?php
	
	echo '</td></tr></table>';

}
else {
	require('main_export_body-form.inc.php');
}

?>
</form>