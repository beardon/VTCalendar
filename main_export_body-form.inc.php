<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files

if (count($FormErrors) > 0) {
	?><p style="padding: 8px;"><img src="install/failed32.png" class="png" width="32" height="32" alt="" align="left"> <b><?php echo lang('export_errorsfound'); ?></b></p><?php
}
?>

<input type="hidden" name="view" value="export">

<script language="JavaScript" type="text/javascript"><!-- //<![CDATA[
function checkAll(myForm, id, state) {
	// determine if ALL of the checkboxes is checked
	b = new Boolean( true );
	for (var cnt=0; cnt < myForm.elements.length; cnt++) {
		var ckb = myForm.elements[cnt];
		if (ckb.type == "checkbox" && ckb.name.indexOf(id) == 0) {
			if (ckb.checked == false) { b = false; }
		}
	}

	for (var cnt=0; cnt < myForm.elements.length; cnt++) {
		var ckb = myForm.elements[cnt];
		if (ckb.type == "checkbox" && ckb.name.indexOf(id) == 0) {
			if ( b == true ) { ckb.checked = false; }
			else { ckb.checked = true; };
		}
	}
}

function ToggleHTMLSections() {
	if (document.getElementById) {
		var oForm = document.getElementById("ExportForm");
		var oHTML = document.getElementById("format_html");
		if (oForm && oHTML) {
			if (oHTML.checked) {
				oForm.className = "";
			}
			else {
				oForm.className = "HideHTML";
			}
		}
	}
}
function SpecificSponsorChanged() {
	if (document.getElementById) {
		var oAll = document.getElementById("sponsor_all");
		var oSpecific = document.getElementById("sponsor_specific");
		var oText = document.getElementById("specificsponsor");
		
		if (oText.value.replace(/^\s+|\s+$/g,"") == "") {
			oAll.checked = true;
		}
		else {
			oSpecific.checked = true;
		}
	}
}
//]]> -->
</script>

<div class="FormSectionHeader"><h3><?php echo lang('export_settings'); ?>:</h3></div>

<div style="padding-left: 10px;">
	<p><b><?php echo lang('export_format'); ?></b></p>
	
	<blockquote>
		<?php if (isset($FormErrors['format'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['format'].'</p>'; ?>
		<table border="0" cellpadding="2" cellspacing="0">
	    	<tr>
	    		<td colspan="2"><b><?php echo lang('export_format_standard'); ?>:</b></td>
	   		</tr>
	    	<tr>
	    		<td><input name="format" type="radio" value="ical" id="format_ical" onclick="ToggleHTMLSections();" <?php if (isset($FormData['format']) && $FormData['format'] == "ical") echo "CHECKED"; ?>></td>
	    		<td><label for="format_ical">iCalendar (ICS)</label></td>
	   		</tr>
	    	<tr>
	    		<td><input name="format" type="radio" value="rss" id="format_rss" onclick="ToggleHTMLSections();" <?php if (isset($FormData['format']) && $FormData['format'] == "rss") echo "CHECKED"; ?>></td>
	    		<td><label for="format_rss">RSS 0.91 (XML)</label></td>
	   		</tr>
	    	<tr>
	    		<td><input name="format" type="radio" value="rss1_0" id="format_rss1_0" onclick="ToggleHTMLSections();" <?php if (isset($FormData['format']) && $FormData['format'] == "rss1_0") echo "CHECKED"; ?>></td>
	    		<td><label for="format_rss1_0">RSS 1.0 (XML)</label></td>
	   		</tr>
	    	<tr>
	    		<td><input name="format" type="radio" value="rss2_0" id="format_rss2_0" onclick="ToggleHTMLSections();" <?php if (isset($FormData['format']) && $FormData['format'] == "rss2_0") echo "CHECKED"; ?>></td>
	    		<td><label for="format_rss2_0">RSS 2.0 (XML)</label></td>
	   		</tr>
	    	<tr>
	    		<td><input name="format" type="radio" value="vxml" id="format_vxml" onclick="ToggleHTMLSections();" <?php if (isset($FormData['format']) && $FormData['format'] == "vxml") echo "CHECKED"; ?>></td>
	    		<td><label for="format_vxml">VoiceXML 2.0 (XML)</label></td>
	   		</tr>
	   		<?php if (PUBLIC_EXPORT_VTCALXML || ISCALADMIN) { ?>
	    	<tr>
	    		<td colspan="2" style="padding-top: 16px;"><b><?php echo lang('export_format_backup'); ?>:</b></td>
	   		</tr>
	    	<tr>
	    		<td valign="top"><input name="format" type="radio" value="xml" id="format_xml" onclick="ToggleHTMLSections();" <?php if (isset($FormData['format']) && $FormData['format'] == "xml") echo "CHECKED"; ?>></td>
	    		<td><label for="format_xml">VTCalendar (XML)</label><br/><?php echo lang('export_xml_description'); ?></td>
	   		</tr>
	   		<?php } ?>
	    	<tr>
	    		<td colspan="2" style="padding-top: 16px;"><b><?php echo lang('export_format_advanced'); ?>:</b></td>
	   		</tr>
	    	<tr>
	    		<td><input name="format" type="radio" value="html" id="format_html" onclick="ToggleHTMLSections();" <?php if (isset($FormData['format']) && $FormData['format'] == "html") echo "CHECKED"; ?>></td>
	    		<td><label for="format_html">HTML</label></td>
	    	</tr>
	    	<tr>
	    		<td><input name="format" type="radio" value="js" id="format_js" onclick="ToggleHTMLSections();" <?php if (isset($FormData['format']) && $FormData['format'] == "js") echo "CHECKED"; ?>></td>
		   		<td><label for="format_js">JavaScript Array (e.g. <code>vtcalevents[0]['date']</code>)</label></td>
	    	</tr>
	    </table>
	</blockquote>
	
	<p><b><?php echo lang('export_maxevents'); ?>: </b></p>
	
	<blockquote>
		<?php if (isset($FormErrors['maxevents'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['maxevents'].'</p>'; ?>
		<p><?php echo lang('export_maxevents_description'); ?></p>
		<p><input name="maxevents" type="text" id="maxevents" value="<?php if (isset($FormData['maxevents'])) echo $FormData['maxevents']; ?>">
			 <?php if (!ISCALADMIN) { ?>(<?php echo lang('export_maxevents_rangemessage'); ?>)<?php } ?></p>
	</blockquote>
	
	<p><b><?php echo lang('export_dates'); ?>:</b></p>
	
	<blockquote>
		<p><?php echo lang('export_dates_description'); ?></p>
		<?php if (isset($FormErrors['timebegin'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['timebegin'].'</p>'; ?>
		<?php if (isset($FormErrors['timeend'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['timeend'].'</p>'; ?>
		<table  border="0" cellspacing="0" cellpadding="4">
	    	<tr>
	    		<td style="padding-bottom: 2px;"><b><?php echo lang('export_dates_from'); ?>:</b></td>
	    		<td style="padding-bottom: 2px;"><input name="timebegin" type="text" id="timebegin" value="<?php if (isset($FormData['timebegin'])) echo $FormData['timebegin']; ?>"></td>
	    	</tr>
	    	<tr>
	    		<td style="padding-top: 0;">&nbsp;</td>
	    		<td style="padding-top: 0;"><?php echo lang('export_dates_from_description'); ?></td>
	    	</tr>
	    	<tr>
	    		<td style="padding-bottom: 2px;"><b><?php echo lang('export_dates_to'); ?>:</b></td>
	    		<td style="padding-bottom: 2px"><input name="timeend" type="text" id="timeend" value="<?php if (isset($FormData['timeend'])) echo $FormData['timeend']; ?>"></td>
	    	</tr>
	    	<tr>
	    		<td style="padding-top: 0;">&nbsp;</td>
	    		<td style="padding-top: 0;"><?php echo lang('export_dates_to_description'); ?></td>
	    	</tr>
	   	</table>
	</blockquote>
	
	<p><b><?php echo lang('export_categories'); ?>:</b></p>
	
	<blockquote>
		<p><?php echo lang('export_categories_description'); ?>:</p>
		<?php if (isset($FormErrors['categories'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['categories'].'</p>'; ?>
		<p><a href="javascript:checkAll(document.ExportForm,'c',true);"><?php echo lang('select_unselect'); ?></a></p>
		<table border="0" cellspacing="0" cellpadding="4"><tr><td valign="top">
		<table border="0" cellspacing="0" cellpadding="1">
		<?php
		
		// Create a list of category filter keys
		if (isset($FormData['categories'])) {
			$selectedCategoryKeys = array_flip($FormData['categories']);
		}
		
		// Determine how many categories are in each column.
		$percolumn = ceil($numcategories / 2);
		
		for ($c=0; $c<$numcategories; $c++) {
			$categoryselected = !isset($FormData['categories']) || count($FormData['categories']) == 0 || array_key_exists($categories_id[$c], $selectedCategoryKeys);
			
			// Go to the next column if we've reached the limit of categories per column.
			if ($c > 0 && $c % $percolumn == 0) {
				echo '</table></td><td valign="top"><table border="0" cellspacing="0" cellpadding="1">';
			}
			
			?>
	    	<tr>
	    		<td><input type="checkbox" name="c[]" value="<?php echo $categories_id[$c]; ?>" id="category<?php echo $categories_id[$c]; ?>" <?php if ($categoryselected) echo "CHECKED"; ?>></td>
	    		<td><label for="category<?php echo $categories_id[$c]; ?>"><?php echo htmlentities($categories_name[$c]); ?></label><?php if (PUBLIC_EXPORT_VTCALXML || ISCALADMIN) echo ' (<code>'.htmlentities($categories_id[$c]).'</code>)'; ?></td>
	    	</tr>
	    	<?php
		}
		?>
		</table>
		</td></tr></table>
		<?php if (PUBLIC_EXPORT_VTCALXML || ISCALADMIN) { ?>
	    <p><?php echo lang('export_categoryid_note'); ?></p>
	    <?php } ?>
	</blockquote>
	
	<p><b><?php echo lang('export_sponsor'); ?>:</b></p>
	
	<blockquote>
		<?php if (isset($FormErrors['sponsor'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['sponsor'].'</p>'; ?>
		<table border="0" cellspacing="0" cellpadding="2">
	    	<tr>
	    		<td><input name="sponsor" id="sponsor_all" type="radio" value="all" <?php if ($FormData['sponsor'] == "all") echo "CHECKED"; ?>></td>
	    		<td><?php echo lang('export_sponsor_all'); ?></td>
	    	</tr>
	    	<tr>
	    		<td valign="top"><input name="sponsor" id="sponsor_specific" type="radio" value="specific" <?php if ($FormData['sponsor'] == "specific") echo "CHECKED"; ?>></td>
	    		<td><?php echo lang('export_sponsor_specific'); ?>: 
	    			<input name="specificsponsor" type="text" id="specificsponsor" onchange="SpecificSponsorChanged()" onkeyup="SpecificSponsorChanged()" value="<?php if (!empty($FormData['specificsponsor'])) echo htmlentities($FormData['specificsponsor']); ?>"><br>
	    			(<?php echo lang('export_sponsor_specific_description'); ?>)</td>
	   		</tr>
	   	</table>
	</blockquote>

	<p><input type="Submit" name="createexport" value="<?php echo lang('export_submit'); ?>">
		<span class="HTMLOnly"><?php echo lang('export_keepscrolling'); ?></span></p>
</div>

<div class="HTMLOnly">

<div class="FormSectionHeader"><h3><?php echo lang('export_htmlsettings'); ?>:</h3></div>

<div style="padding-left: 10px;">
	<p><b><?php echo lang('export_keepcategoryfilter'); ?>:</b></p>
	
	<blockquote>
		<p><?php echo lang('export_keepcategoryfilter_description'); ?></p>
		<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="keepcategoryfilter" id="keepcategoryfilter_yes" type="radio" value="1" <?php if (isset($FormData['keepcategoryfilter']) && $FormData['keepcategoryfilter'] == '1') echo "checked"; ?>></td>
				<td><label for="keepcategoryfilter_yes"><?php echo lang('yes'); ?></label></td>
			</tr>
			<tr>
				<td><input name="keepcategoryfilter" id="keepcategoryfilter_no" type="radio" value="0" <?php if (isset($FormData['keepcategoryfilter']) && $FormData['keepcategoryfilter'] == '0') echo "checked"; ?>></td>
				<td><label for="keepcategoryfilter_no"><?php echo lang('no'); ?></label></td>
			</tr>
		</table>
	</blockquote>
	
	<p><b><?php echo lang('export_htmltype'); ?>:</b></p>
	
	<blockquote>
	    	<p><?php echo lang('export_htmltype_description'); ?></p>
	    	<p><select name="htmltype" id="htmltype">
	    			<option value="paragraph" <?php if (isset($FormData['htmltype']) && $FormData['htmltype'] == 'paragraph') echo "selected"; ?>><?php echo lang('export_htmltype_paragraph'); ?></option>
		    		<option value="table" <?php if (isset($FormData['htmltype']) && $FormData['htmltype'] == 'table') echo "selected"; ?>><?php echo lang('export_htmltype_table'); ?></option>
				</select></p>
	</blockquote>
	
	<p><b><?php echo lang('export_jsoutput'); ?>:</b></p>
	
	<blockquote>
		<p><?php echo lang('export_jsoutput_description'); ?></p>
		<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="jshtml" id="jshtml_yes" type="radio" value="1" <?php if (isset($FormData['jshtml']) && $FormData['jshtml'] == '1') echo "checked"; ?>></td>
				<td><label for="jshtml_yes"><?php echo lang('yes'); ?></label></td>
			</tr>
			<tr>
				<td><input name="jshtml" id="jshtml_no" type="radio" value="0" <?php if (isset($FormData['jshtml']) && $FormData['jshtml'] == '0') echo "checked"; ?>></td>
				<td><label for="jshtml_no"><?php echo lang('no'); ?></label></td>
			</tr>
		</table>
	</blockquote>
</div>

<div class="FormSectionHeader"><h3><?php echo lang('export_datetimesettings'); ?>:</h3></div>

<div style="padding-left: 10px;">
	<p><b><?php echo lang('export_dateformat'); ?>:</b></p>
	<blockquote>
		<select name="dateformat">
			<option value="huge" <?php if (isset($FormData['dateformat']) && $FormData['dateformat'] == 'huge') echo "selected"; ?>><?php echo lang('wednesday'); ?>, <?php echo lang('october'); ?> 25, 2006</option>
			<option value="long" <?php if (isset($FormData['dateformat']) && $FormData['dateformat'] == 'long') echo "selected"; ?>><?php echo lang('wed'); ?>, <?php echo lang('october'); ?> 25, 2006</option>
			<option value="normal" <?php if (isset($FormData['dateformat']) && $FormData['dateformat'] == 'normal') echo "selected"; ?>><?php echo lang('october'); ?> 25, 2006</option>
			<option value="short" <?php if (isset($FormData['dateformat']) && $FormData['dateformat'] == 'short') echo "selected"; ?>><?php echo lang('oct'); ?>. 25, 2006</option>
			<option value="tiny" <?php if (isset($FormData['dateformat']) && $FormData['dateformat'] == 'tiny') echo "selected"; ?>><?php echo lang('oct'); ?> 25 '06</option>
			<option value="micro" <?php if (isset($FormData['dateformat']) && $FormData['dateformat'] == 'micro') echo "selected"; ?>><?php echo lang('oct'); ?> 25</option>
		</select>
	</blockquote>
	
	<p><b><?php echo lang('export_timedisplay'); ?>:</b></p>
	<blockquote>
		<p><?php echo lang('export_timedisplay_description'); ?></p>
		<table border="0" cellpadding="4" cellspacing="0">
			<tr>
				<td style="border-bottom: 1px solid #999999; padding-right: 8px;"><b><?php echo lang('export_timedisplay_startonly'); ?>:</b></td>
				<td style="border-bottom: 1px solid #999999; padding-left: 8px; border-left: 1px solid #666666;"><b><?php echo lang('export_timedisplay_startend'); ?>:</b></td>
				<td style="border-bottom: 1px solid #999999; padding-left: 8px; border-left: 1px solid #666666;"><b><?php echo lang('export_timedisplay_startduration'); ?>:</b></td>
			</tr>
			<tr>
				<td style="padding-right: 8px;" valign="top">
					<table border="0" cellpadding="0" cellspacing="2">
						<tr><td><input type="radio" id="timedisplay_Start"  name="timedisplay" value="start" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'start') echo "checked"; ?>></td><td><label for="timedisplay_Start">12:00pm</label></td></tr>
					</table>
				</td>
				<td style="padding-left: 8px; border-left: 1px solid #666666;" valign="top">
					<table border="0" cellpadding="0" cellspacing="2">
						<tr>
							<td><input type="radio" id="timedisplay_StartEndLong" name="timedisplay" value="startendlong" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startendlong') echo "checked"; ?>></td>
							<td><label for="timedisplay_StartEndLong">12:00pm <?php echo lang('export_output_to'); ?> 12:30pm</label></td>
						</tr>
						<tr>
							<td><input type="radio" id="timedisplay_StartEndNormal" name="timedisplay" value="startendnormal" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startendnormal') echo "checked"; ?>></td>
							<td><label for="timedisplay_StartEndNormal">12:00pm - 12:30pm</label></td>
						</tr>
						<tr>
							<td><input type="radio" id="timedisplay_StartEndTiny" name="timedisplay" value="startendtiny" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startendtiny') echo "checked"; ?>></td>
							<td><label for="timedisplay_StartEndTiny">12:00pm-12:30pm</label></td>
						</tr>
					</table>
				</td>
				<td style="padding-left: 8px; border-left: 1px solid #666666;" valign="top">
					<table border="0" cellpadding="0" cellspacing="2">
						<tr>
							<td><input type="radio" id="timedisplay_StartDurationLong" name="timedisplay" value="startdurationlong" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startdurationlong') echo "checked"; ?>></td>
							<td><label for="timedisplay_StartDurationLong">12:00pm <?php echo lang('export_output_for'); ?> 2 <?php echo lang('export_output_hours'); ?></label></td>
						</tr>
						<tr>
							<td><input type="radio" id="timedisplay_StartDurationNormal" name="timedisplay" value="startdurationnormal" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startdurationnormal') echo "checked"; ?>></td>
							<td><label for="timedisplay_StartDurationNormal">12:00pm (2 <?php echo lang('export_output_hours'); ?>)</label></td>
						</tr>
						<tr>
							<td><input type="radio" id="timedisplay_StartDurationShort" name="timedisplay" value="startdurationshort" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startdurationshort') echo "checked"; ?>></td>
							<td><label for="timedisplay_StartDurationShort">12:00pm 2 <?php echo lang('export_output_hours'); ?></label></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<!--
		<select name="timedisplay">
			<option value="start" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'start') echo "selected"; ?>>12:00pm</option>
			<option value="startendlong" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startendlong') echo "selected"; ?>>12:00pm to 12:30pm</option>
			<option value="startendnormal" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startendnormal') echo "selected"; ?>>12:00pm - 12:30pm</option>
			<option value="startendtiny" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startendtiny') echo "selected"; ?>>12:00pm-12:30pm</option>
			<option value="startdurationlong" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startdurationlong') echo "selected"; ?>>12:00pm for 2 <?php echo lang('export_output_hours'); ?></option>
			<option value="startdurationnormal" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startdurationnormal') echo "selected"; ?>>12:00pm (2 <?php echo lang('export_output_hours'); ?>)</option>
			<option value="startdurationshort" <?php if (isset($FormData['timedisplay']) && $FormData['timedisplay'] == 'startdurationshort') echo "selected"; ?>>12:00pm 2 <?php echo lang('export_output_hours'); ?></option>
		</select>
		-->
	</blockquote>
	
	<p><b><?php echo lang('export_timeformat'); ?>:</b></p>
	
	<blockquote>
		<p><?php echo lang('export_timeformat_description'); ?></p>
		<select name="timeformat">
			<option value="huge" <?php if (isset($FormData['timeformat']) && $FormData['timeformat'] == 'huge') echo "selected"; ?>>12:00 PM EST</option>
			<option value="long" <?php if (isset($FormData['timeformat']) && $FormData['timeformat'] == 'long') echo "selected"; ?>>12:00 PM</option>
			<option value="normal" <?php if (isset($FormData['timeformat']) && $FormData['timeformat'] == 'normal') echo "selected"; ?>>12:00pm</option>
			<option value="short" <?php if (isset($FormData['timeformat']) && $FormData['timeformat'] == 'short') echo "selected"; ?>>12:00p</option>
		</select>
		<!-- If you are using 24-hour time, then remove the select and option tags above and uncomment the section below -->
		<!--<select name="timeformat">
			<option value="long" <?php if (isset($FormData['timeformat']) && $FormData['timeformat'] == 'long') echo "selected"; ?>>23:59 EST</option>
			<option value="normal" <?php if (isset($FormData['timeformat']) && $FormData['timeformat'] == 'normal') echo "selected"; ?>>23:59</option>
		</select>-->
	</blockquote>
	
	<p><b><?php echo lang('export_durationformat'); ?>:</b></p>
	
	<blockquote>
		<select name="durationformat">
			<option value="long" <?php if (isset($FormData['durationformat']) && $FormData['durationformat'] == 'long') echo "selected"; ?>>2 <?php echo lang('export_output_hours'); ?> 30 <?php echo lang('export_output_minutes'); ?></option>
			<option value="normal" <?php if (isset($FormData['durationformat']) && $FormData['durationformat'] == 'normal') echo "selected"; ?>>2 <?php echo lang('export_output_hours'); ?> 30 <?php echo lang('export_output_min'); ?></option>
			<option value="short" <?php if (isset($FormData['durationformat']) && $FormData['durationformat'] == 'short') echo "selected"; ?>>2 <?php echo lang('export_output_hrs'); ?> 30 <?php echo lang('export_output_min'); ?></option>
			<option value="tiny" <?php if (isset($FormData['durationformat']) && $FormData['durationformat'] == 'tiny') echo "selected"; ?>>2<?php echo lang('export_output_hrs'); ?> 30<?php echo lang('export_output_min'); ?></option>
			<option value="micro" <?php if (isset($FormData['durationformat']) && $FormData['durationformat'] == 'micro') echo "selected"; ?>>2<?php echo lang('export_output_hr'); ?> 30<?php echo lang('export_output_m'); ?></option>
		</select>
	</blockquote>
</div>

<div class="FormSectionHeader"><h3><?php echo lang('export_htmldisplaysettings'); ?>:</h3></div>

<div style="padding-left: 10px;">
	<p><b><?php echo lang('export_showdatetime'); ?>:</b></p>
	<blockquote>
		<p><?php echo lang('export_showdatetime_description'); ?></p>
		<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="showdatetime" id="showdatetime_yes" type="radio" value="1" <?php if (isset($FormData['showdatetime']) && $FormData['showdatetime'] == '1') echo "checked"; ?>></td>
				<td><label for="showdatetime_yes"><?php echo lang('export_show'); ?></label></td>
			</tr>
			<tr>
				<td><input name="showdatetime" id="showdatetime_no" type="radio" value="0" <?php if (isset($FormData['showdatetime']) && $FormData['showdatetime'] == '0') echo "checked"; ?>></td>
				<td><label for="showdatetime_no"><?php echo lang('export_hide'); ?></label></td>
			</tr>
		</table>
	</blockquote>
	
	<p><b><?php echo lang('export_showlocation'); ?>: </b></p>
	<blockquote>
		<p><?php echo lang('export_showlocation_description'); ?></p>
		<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="showlocation" id="showlocation_yes" type="radio" value="1" <?php if (isset($FormData['showlocation']) && $FormData['showlocation'] == '1') echo "checked"; ?>></td>
				<td><label for="showlocation_yes"><?php echo lang('export_show'); ?></label></td>
			</tr>
			<tr>
				<td><input name="showlocation" id="showlocation_no" type="radio" value="0" <?php if (isset($FormData['showlocation']) && $FormData['showlocation'] == '0') echo "checked"; ?>></td>
				<td><label for="showlocation_no"><?php echo lang('export_hide'); ?></label></td>
			</tr>
		</table>
	</blockquote>
	
	<p><b><?php echo lang('export_showallday'); ?>:</b></p>
	<blockquote>
		<p><?php echo lang('export_showallday_description'); ?></p>
		<table border="0" cellspacing="1" cellpadding="0">
			<tr>
				<td><input name="showallday" id="showallday_yes" type="radio" value="1" <?php if (isset($FormData['showallday']) && $FormData['showallday'] == '1') echo "checked"; ?>></td>
				<td><label for="showallday_yes"><?php echo lang('export_show'); ?></label></td>
			</tr>
			<tr>
				<td><input name="showallday" id="showallday_no" type="radio" value="0" <?php if (isset($FormData['showallday']) && $FormData['showallday'] == '0') echo "checked"; ?>></td>
				<td><label for="showallday_no"><?php echo lang('export_hide'); ?></label></td>
			</tr>
		</table>
	</blockquote>
	
	<p><b><?php echo lang('export_maxtitlechars'); ?>:</b></p>
	<blockquote>
		<?php if (isset($FormErrors['maxtitlecharacters'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['maxtitlecharacters'].'</p>'; ?>
		<p><?php echo lang('export_maxtitlechars_description'); ?></p>
		<p><input name="maxtitlecharacters" type="text" id="maxtitlecharacters" value=""> (<?php echo lang('export_leaveblank'); ?>)</p>
	</blockquote>
	
	<p><b><?php echo lang('export_maxlocationchars'); ?>:</b></p>
	<blockquote>
		<?php if (isset($FormErrors['maxlocationcharacters'])) echo '<p class="FormError"><img src="install/failed.png" class="png" width="16" height="16" alt="" align="left"> '.$FormErrors['maxlocationcharacters'].'</p>'; ?>
		<p><?php echo lang('export_maxlocationchars_description'); ?></p>
		<p><input name="maxlocationcharacters" type="text" id="maxlocationcharacters" value=""> (<?php echo lang('export_leaveblank'); ?>)</p>
	</blockquote>
	
	<p><input type="Submit" name="createexport" value="<?php echo lang('export_submit'); ?>"><?php echo lang('export_resetform'); ?></p>
</div>

<!-- end of <div class="HTMLOnly"> -->
</div>


<script type="text/javascript">
ToggleHTMLSections();
SpecificSponsorChanged();
</script>