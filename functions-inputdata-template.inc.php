<?php
function inputtemplatedata(&$event,$sponsorid,$check,$template_name) {
	?>
	<table border="0" cellpadding="2" cellspacing="0">
		<tr>
			<td class="bodytext" valign="top">
				<strong><?php echo lang('template_name'); ?>:</strong> <span class="WarningText">*</span>
			</td>
			<td class="bodytext" valign="top">
	<?php
		if ($check && (empty($template_name))) {
			feedback(lang('choose_template_name'),FEEDBACKNEG);
		}
	?>
		<input type="text" size="24" name="template_name" maxlength="<?php echo MAXLENGTH_TEMPLATE_NAME; ?>" value="<?php
	
		if ($check) { $template_name=stripslashes($template_name); }
		echo HTMLSpecialChars($template_name);
	?>">
				<i><?php echo lang('template_name_example'); ?></i>
			</td>
		<tr>
	</table>
	<?php
	inputeventdata($event,$sponsorid,0,$check,0,$repeat,0);
} // end: Function inputtemplatedata
?>