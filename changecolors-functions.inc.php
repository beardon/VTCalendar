<?php

function LoadVariables() {
	global $VariableErrors;
	if (!isset($_POST['bg']) || !setVar($GLOBALS['Color_bg'], $_POST['bg'],'color')) { if (isset($_POST['bg'])) $VariableErrors['bg'] = $_POST['bg']; $GLOBALS['Color_bg'] = $_SESSION['COLOR_BG']; };
	if (!isset($_POST['text']) || !setVar($GLOBALS['Color_text'], $_POST['text'],'color')) { if (isset($_POST['text'])) $VariableErrors['text'] = $_POST['text']; $GLOBALS['Color_text'] = $_SESSION['COLOR_TEXT']; };
	if (!isset($_POST['text_faded']) || !setVar($GLOBALS['Color_text_faded'], $_POST['text_faded'],'color')) { if (isset($_POST['text_faded'])) $VariableErrors['text_faded'] = $_POST['text_faded']; $GLOBALS['Color_text_faded'] = $_SESSION['COLOR_TEXT_FADED']; };
	if (!isset($_POST['text_warning']) || !setVar($GLOBALS['Color_text_warning'], $_POST['text_warning'],'color')) { if (isset($_POST['text_warning'])) $VariableErrors['text_warning'] = $_POST['text_warning']; $GLOBALS['Color_text_warning'] = $_SESSION['COLOR_TEXT_WARNING']; };
	if (!isset($_POST['link']) || !setVar($GLOBALS['Color_link'], $_POST['link'],'color')) { if (isset($_POST['link'])) $VariableErrors['link'] = $_POST['link']; $GLOBALS['Color_link'] = $_SESSION['COLOR_LINK']; };
	if (!isset($_POST['body']) || !setVar($GLOBALS['Color_body'], $_POST['body'],'color')) { if (isset($_POST['body'])) $VariableErrors['body'] = $_POST['body']; $GLOBALS['Color_body'] = $_SESSION['COLOR_BODY']; };
	if (!isset($_POST['today']) || !setVar($GLOBALS['Color_today'], $_POST['today'],'color')) { if (isset($_POST['today'])) $VariableErrors['today'] = $_POST['today']; $GLOBALS['Color_today'] = $_SESSION['COLOR_TODAY']; };
	if (!isset($_POST['todaylight']) || !setVar($GLOBALS['Color_todaylight'], $_POST['todaylight'],'color')) { if (isset($_POST['todaylight'])) $VariableErrors['todaylight'] = $_POST['todaylight']; $GLOBALS['Color_todaylight'] = $_SESSION['COLOR_TODAYLIGHT']; };
	if (!isset($_POST['light_cell_bg']) || !setVar($GLOBALS['Color_light_cell_bg'], $_POST['light_cell_bg'],'color')) { if (isset($_POST['light_cell_bg'])) $VariableErrors['light_cell_bg'] = $_POST['light_cell_bg']; $GLOBALS['Color_light_cell_bg'] = $_SESSION['COLOR_LIGHT_CELL_BG']; };
	if (!isset($_POST['table_header_text']) || !setVar($GLOBALS['Color_table_header_text'], $_POST['table_header_text'],'color')) { if (isset($_POST['table_header_text'])) $VariableErrors['table_header_text'] = $_POST['table_header_text']; $GLOBALS['Color_table_header_text'] = $_SESSION['COLOR_TABLE_HEADER_TEXT']; };
	if (!isset($_POST['table_header_bg']) || !setVar($GLOBALS['Color_table_header_bg'], $_POST['table_header_bg'],'color')) { if (isset($_POST['table_header_bg'])) $VariableErrors['table_header_bg'] = $_POST['table_header_bg']; $GLOBALS['Color_table_header_bg'] = $_SESSION['COLOR_TABLE_HEADER_BG']; };
	if (!isset($_POST['border']) || !setVar($GLOBALS['Color_border'], $_POST['border'],'color')) { if (isset($_POST['border'])) $VariableErrors['border'] = $_POST['border']; $GLOBALS['Color_border'] = $_SESSION['COLOR_BORDER']; };
	if (!isset($_POST['keyword_highlight']) || !setVar($GLOBALS['Color_keyword_highlight'], $_POST['keyword_highlight'],'color')) { if (isset($_POST['keyword_highlight'])) $VariableErrors['keyword_highlight'] = $_POST['keyword_highlight']; $GLOBALS['Color_keyword_highlight'] = $_SESSION['COLOR_KEYWORD_HIGHLIGHT']; };
	if (!isset($_POST['h2']) || !setVar($GLOBALS['Color_h2'], $_POST['h2'],'color')) { if (isset($_POST['h2'])) $VariableErrors['h2'] = $_POST['h2']; $GLOBALS['Color_h2'] = $_SESSION['COLOR_H2']; };
	if (!isset($_POST['h3']) || !setVar($GLOBALS['Color_h3'], $_POST['h3'],'color')) { if (isset($_POST['h3'])) $VariableErrors['h3'] = $_POST['h3']; $GLOBALS['Color_h3'] = $_SESSION['COLOR_H3']; };
	if (!isset($_POST['title']) || !setVar($GLOBALS['Color_title'], $_POST['title'],'color')) { if (isset($_POST['title'])) $VariableErrors['title'] = $_POST['title']; $GLOBALS['Color_title'] = $_SESSION['COLOR_TITLE']; };
	if (!isset($_POST['tabgrayed_text']) || !setVar($GLOBALS['Color_tabgrayed_text'], $_POST['tabgrayed_text'],'color')) { if (isset($_POST['tabgrayed_text'])) $VariableErrors['tabgrayed_text'] = $_POST['tabgrayed_text']; $GLOBALS['Color_tabgrayed_text'] = $_SESSION['COLOR_TABGRAYED_TEXT']; };
	if (!isset($_POST['tabgrayed_bg']) || !setVar($GLOBALS['Color_tabgrayed_bg'], $_POST['tabgrayed_bg'],'color')) { if (isset($_POST['tabgrayed_bg'])) $VariableErrors['tabgrayed_bg'] = $_POST['tabgrayed_bg']; $GLOBALS['Color_tabgrayed_bg'] = $_SESSION['COLOR_TABGRAYED_BG']; };
	if (!isset($_POST['filternotice_bg']) || !setVar($GLOBALS['Color_filternotice_bg'], $_POST['filternotice_bg'],'color')) { if (isset($_POST['filternotice_bg'])) $VariableErrors['filternotice_bg'] = $_POST['filternotice_bg']; $GLOBALS['Color_filternotice_bg'] = $_SESSION['COLOR_FILTERNOTICE_BG']; };
	if (!isset($_POST['filternotice_font']) || !setVar($GLOBALS['Color_filternotice_font'], $_POST['filternotice_font'],'color')) { if (isset($_POST['filternotice_font'])) $VariableErrors['filternotice_font'] = $_POST['filternotice_font']; $GLOBALS['Color_filternotice_font'] = $_SESSION['COLOR_FILTERNOTICE_FONT']; };
	if (!isset($_POST['filternotice_fontfaded']) || !setVar($GLOBALS['Color_filternotice_fontfaded'], $_POST['filternotice_fontfaded'],'color')) { if (isset($_POST['filternotice_fontfaded'])) $VariableErrors['filternotice_fontfaded'] = $_POST['filternotice_fontfaded']; $GLOBALS['Color_filternotice_fontfaded'] = $_SESSION['COLOR_FILTERNOTICE_FONTFADED']; };
	if (!isset($_POST['filternotice_bgimage']) || !setVar($GLOBALS['Color_filternotice_bgimage'], $_POST['filternotice_bgimage'],'background')) { if (isset($_POST['filternotice_bgimage'])) $VariableErrors['filternotice_bgimage'] = $_POST['filternotice_bgimage']; $GLOBALS['Color_filternotice_bgimage'] = $_SESSION['COLOR_FILTERNOTICE_BGIMAGE']; };
	if (!isset($_POST['eventbar_past']) || !setVar($GLOBALS['Color_eventbar_past'], $_POST['eventbar_past'],'color')) { if (isset($_POST['eventbar_past'])) $VariableErrors['eventbar_past'] = $_POST['eventbar_past']; $GLOBALS['Color_eventbar_past'] = $_SESSION['COLOR_EVENTBAR_PAST']; };
	if (!isset($_POST['eventbar_current']) || !setVar($GLOBALS['Color_eventbar_current'], $_POST['eventbar_current'],'color')) { if (isset($_POST['eventbar_current'])) $VariableErrors['eventbar_current'] = $_POST['eventbar_current']; $GLOBALS['Color_eventbar_current'] = $_SESSION['COLOR_EVENTBAR_CURRENT']; };
	if (!isset($_POST['eventbar_future']) || !setVar($GLOBALS['Color_eventbar_future'], $_POST['eventbar_future'],'color')) { if (isset($_POST['eventbar_future'])) $VariableErrors['eventbar_future'] = $_POST['eventbar_future']; $GLOBALS['Color_eventbar_future'] = $_SESSION['COLOR_EVENTBAR_FUTURE']; };
	if (!isset($_POST['monthdaylabels_past']) || !setVar($GLOBALS['Color_monthdaylabels_past'], $_POST['monthdaylabels_past'],'color')) { if (isset($_POST['monthdaylabels_past'])) $VariableErrors['monthdaylabels_past'] = $_POST['monthdaylabels_past']; $GLOBALS['Color_monthdaylabels_past'] = $_SESSION['COLOR_MONTHDAYLABELS_PAST']; };
	if (!isset($_POST['monthdaylabels_current']) || !setVar($GLOBALS['Color_monthdaylabels_current'], $_POST['monthdaylabels_current'],'color')) { if (isset($_POST['monthdaylabels_current'])) $VariableErrors['monthdaylabels_current'] = $_POST['monthdaylabels_current']; $GLOBALS['Color_monthdaylabels_current'] = $_SESSION['COLOR_MONTHDAYLABELS_CURRENT']; };
	if (!isset($_POST['monthdaylabels_future']) || !setVar($GLOBALS['Color_monthdaylabels_future'], $_POST['monthdaylabels_future'],'color')) { if (isset($_POST['monthdaylabels_future'])) $VariableErrors['monthdaylabels_future'] = $_POST['monthdaylabels_future']; $GLOBALS['Color_monthdaylabels_future'] = $_SESSION['COLOR_MONTHDAYLABELS_FUTURE']; };
	if (!isset($_POST['othermonth']) || !setVar($GLOBALS['Color_othermonth'], $_POST['othermonth'],'color')) { if (isset($_POST['othermonth'])) $VariableErrors['othermonth'] = $_POST['othermonth']; $GLOBALS['Color_othermonth'] = $_SESSION['COLOR_OTHERMONTH']; };
	if (!isset($_POST['littlecal_today']) || !setVar($GLOBALS['Color_littlecal_today'], $_POST['littlecal_today'],'color')) { if (isset($_POST['littlecal_today'])) $VariableErrors['littlecal_today'] = $_POST['littlecal_today']; $GLOBALS['Color_littlecal_today'] = $_SESSION['COLOR_LITTLECAL_TODAY']; };
	if (!isset($_POST['littlecal_highlight']) || !setVar($GLOBALS['Color_littlecal_highlight'], $_POST['littlecal_highlight'],'color')) { if (isset($_POST['littlecal_highlight'])) $VariableErrors['littlecal_highlight'] = $_POST['littlecal_highlight']; $GLOBALS['Color_littlecal_highlight'] = $_SESSION['COLOR_LITTLECAL_HIGHLIGHT']; };
	if (!isset($_POST['littlecal_fontfaded']) || !setVar($GLOBALS['Color_littlecal_fontfaded'], $_POST['littlecal_fontfaded'],'color')) { if (isset($_POST['littlecal_fontfaded'])) $VariableErrors['littlecal_fontfaded'] = $_POST['littlecal_fontfaded']; $GLOBALS['Color_littlecal_fontfaded'] = $_SESSION['COLOR_LITTLECAL_FONTFADED']; };
	if (!isset($_POST['littlecal_line']) || !setVar($GLOBALS['Color_littlecal_line'], $_POST['littlecal_line'],'color')) { if (isset($_POST['littlecal_line'])) $VariableErrors['littlecal_line'] = $_POST['littlecal_line']; $GLOBALS['Color_littlecal_line'] = $_SESSION['COLOR_LITTLECAL_LINE']; };
	if (!isset($_POST['gobtn_bg']) || !setVar($GLOBALS['Color_gobtn_bg'], $_POST['gobtn_bg'],'color')) { if (isset($_POST['gobtn_bg'])) $VariableErrors['gobtn_bg'] = $_POST['gobtn_bg']; $GLOBALS['Color_gobtn_bg'] = $_SESSION['COLOR_GOBTN_BG']; };
	if (!isset($_POST['gobtn_border']) || !setVar($GLOBALS['Color_gobtn_border'], $_POST['gobtn_border'],'color')) { if (isset($_POST['gobtn_border'])) $VariableErrors['gobtn_border'] = $_POST['gobtn_border']; $GLOBALS['Color_gobtn_border'] = $_SESSION['COLOR_GOBTN_BORDER']; };
	if (!isset($_POST['newborder']) || !setVar($GLOBALS['Color_newborder'], $_POST['newborder'],'color')) { if (isset($_POST['newborder'])) $VariableErrors['newborder'] = $_POST['newborder']; $GLOBALS['Color_newborder'] = $_SESSION['COLOR_NEWBORDER']; };
	if (!isset($_POST['newbg']) || !setVar($GLOBALS['Color_newbg'], $_POST['newbg'],'color')) { if (isset($_POST['newbg'])) $VariableErrors['newbg'] = $_POST['newbg']; $GLOBALS['Color_newbg'] = $_SESSION['COLOR_NEWBG']; };
	if (!isset($_POST['approveborder']) || !setVar($GLOBALS['Color_approveborder'], $_POST['approveborder'],'color')) { if (isset($_POST['approveborder'])) $VariableErrors['approveborder'] = $_POST['approveborder']; $GLOBALS['Color_approveborder'] = $_SESSION['COLOR_APPROVEBORDER']; };
	if (!isset($_POST['approvebg']) || !setVar($GLOBALS['Color_approvebg'], $_POST['approvebg'],'color')) { if (isset($_POST['approvebg'])) $VariableErrors['approvebg'] = $_POST['approvebg']; $GLOBALS['Color_approvebg'] = $_SESSION['COLOR_APPROVEBG']; };
	if (!isset($_POST['copyborder']) || !setVar($GLOBALS['Color_copyborder'], $_POST['copyborder'],'color')) { if (isset($_POST['copyborder'])) $VariableErrors['copyborder'] = $_POST['copyborder']; $GLOBALS['Color_copyborder'] = $_SESSION['COLOR_COPYBORDER']; };
	if (!isset($_POST['copybg']) || !setVar($GLOBALS['Color_copybg'], $_POST['copybg'],'color')) { if (isset($_POST['copybg'])) $VariableErrors['copybg'] = $_POST['copybg']; $GLOBALS['Color_copybg'] = $_SESSION['COLOR_COPYBG']; };
	if (!isset($_POST['deleteborder']) || !setVar($GLOBALS['Color_deleteborder'], $_POST['deleteborder'],'color')) { if (isset($_POST['deleteborder'])) $VariableErrors['deleteborder'] = $_POST['deleteborder']; $GLOBALS['Color_deleteborder'] = $_SESSION['COLOR_DELETEBORDER']; };
	if (!isset($_POST['deletebg']) || !setVar($GLOBALS['Color_deletebg'], $_POST['deletebg'],'color')) { if (isset($_POST['deletebg'])) $VariableErrors['deletebg'] = $_POST['deletebg']; $GLOBALS['Color_deletebg'] = $_SESSION['COLOR_DELETEBG']; };
}

function MakeColorUpdateSQL($calendarid, $type) {
	if ($type == 'insert') {
		return "INSERT INTO ".SCHEMANAME."vtcal_colors (calendarid"
			. ", bg, text, text_faded, text_warning, link, body, today, todaylight, light_cell_bg, table_header_text, table_header_bg, border, keyword_highlight, h2, h3, title, tabgrayed_text, tabgrayed_bg, filternotice_bg, filternotice_font, filternotice_fontfaded, filternotice_bgimage, eventbar_past, eventbar_current, eventbar_future, monthdaylabels_past, monthdaylabels_current, monthdaylabels_future, othermonth, littlecal_today, littlecal_highlight, littlecal_fontfaded, littlecal_line, gobtn_bg, gobtn_border, newborder, newbg, approveborder, approvebg, copyborder, copybg, deleteborder, deletebg"
		. ") VALUES ('" . sqlescape($calendarid) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_bg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_text'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_text_faded'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_text_warning'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_link'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_body'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_today'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_todaylight'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_light_cell_bg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_table_header_text'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_table_header_bg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_border'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_keyword_highlight'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_h2'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_h3'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_title'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_tabgrayed_text'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_tabgrayed_bg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_filternotice_bg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_filternotice_font'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_filternotice_fontfaded'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_filternotice_bgimage'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_eventbar_past'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_eventbar_current'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_eventbar_future'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_monthdaylabels_past'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_monthdaylabels_current'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_monthdaylabels_future'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_othermonth'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_littlecal_today'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_littlecal_highlight'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_littlecal_fontfaded'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_littlecal_line'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_gobtn_bg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_gobtn_border'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_newborder'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_newbg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_approveborder'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_approvebg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_copyborder'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_copybg'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_deleteborder'])) . "'"
			. ",'" . sqlescape(strtoupper($GLOBALS['Color_deletebg'])) . "'"
		. ")";
	}
	else {
		return "UPDATE ".SCHEMANAME."vtcal_colors SET "
			. "bg = '" . sqlescape(strtoupper($GLOBALS['Color_bg'])) . "'"
			. ",text = '" . sqlescape(strtoupper($GLOBALS['Color_text'])) . "'"
			. ",text_faded = '" . sqlescape(strtoupper($GLOBALS['Color_text_faded'])) . "'"
			. ",text_warning = '" . sqlescape(strtoupper($GLOBALS['Color_text_warning'])) . "'"
			. ",link = '" . sqlescape(strtoupper($GLOBALS['Color_link'])) . "'"
			. ",body = '" . sqlescape(strtoupper($GLOBALS['Color_body'])) . "'"
			. ",today = '" . sqlescape(strtoupper($GLOBALS['Color_today'])) . "'"
			. ",todaylight = '" . sqlescape(strtoupper($GLOBALS['Color_todaylight'])) . "'"
			. ",light_cell_bg = '" . sqlescape(strtoupper($GLOBALS['Color_light_cell_bg'])) . "'"
			. ",table_header_text = '" . sqlescape(strtoupper($GLOBALS['Color_table_header_text'])) . "'"
			. ",table_header_bg = '" . sqlescape(strtoupper($GLOBALS['Color_table_header_bg'])) . "'"
			. ",border = '" . sqlescape(strtoupper($GLOBALS['Color_border'])) . "'"
			. ",keyword_highlight = '" . sqlescape(strtoupper($GLOBALS['Color_keyword_highlight'])) . "'"
			. ",h2 = '" . sqlescape(strtoupper($GLOBALS['Color_h2'])) . "'"
			. ",h3 = '" . sqlescape(strtoupper($GLOBALS['Color_h3'])) . "'"
			. ",title = '" . sqlescape(strtoupper($GLOBALS['Color_title'])) . "'"
			. ",tabgrayed_text = '" . sqlescape(strtoupper($GLOBALS['Color_tabgrayed_text'])) . "'"
			. ",tabgrayed_bg = '" . sqlescape(strtoupper($GLOBALS['Color_tabgrayed_bg'])) . "'"
			. ",filternotice_bg = '" . sqlescape(strtoupper($GLOBALS['Color_filternotice_bg'])) . "'"
			. ",filternotice_font = '" . sqlescape(strtoupper($GLOBALS['Color_filternotice_font'])) . "'"
			. ",filternotice_fontfaded = '" . sqlescape(strtoupper($GLOBALS['Color_filternotice_fontfaded'])) . "'"
			. ",filternotice_bgimage = '" . sqlescape(strtoupper($GLOBALS['Color_filternotice_bgimage'])) . "'"
			. ",eventbar_past = '" . sqlescape(strtoupper($GLOBALS['Color_eventbar_past'])) . "'"
			. ",eventbar_current = '" . sqlescape(strtoupper($GLOBALS['Color_eventbar_current'])) . "'"
			. ",eventbar_future = '" . sqlescape(strtoupper($GLOBALS['Color_eventbar_future'])) . "'"
			. ",monthdaylabels_past = '" . sqlescape(strtoupper($GLOBALS['Color_monthdaylabels_past'])) . "'"
			. ",monthdaylabels_current = '" . sqlescape(strtoupper($GLOBALS['Color_monthdaylabels_current'])) . "'"
			. ",monthdaylabels_future = '" . sqlescape(strtoupper($GLOBALS['Color_monthdaylabels_future'])) . "'"
			. ",othermonth = '" . sqlescape(strtoupper($GLOBALS['Color_othermonth'])) . "'"
			. ",littlecal_today = '" . sqlescape(strtoupper($GLOBALS['Color_littlecal_today'])) . "'"
			. ",littlecal_highlight = '" . sqlescape(strtoupper($GLOBALS['Color_littlecal_highlight'])) . "'"
			. ",littlecal_fontfaded = '" . sqlescape(strtoupper($GLOBALS['Color_littlecal_fontfaded'])) . "'"
			. ",littlecal_line = '" . sqlescape(strtoupper($GLOBALS['Color_littlecal_line'])) . "'"
			. ",gobtn_bg = '" . sqlescape(strtoupper($GLOBALS['Color_gobtn_bg'])) . "'"
			. ",gobtn_border = '" . sqlescape(strtoupper($GLOBALS['Color_gobtn_border'])) . "'"
			. ",newborder = '" . sqlescape(strtoupper($GLOBALS['Color_newborder'])) . "'"
			. ",newbg = '" . sqlescape(strtoupper($GLOBALS['Color_newbg'])) . "'"
			. ",approveborder = '" . sqlescape(strtoupper($GLOBALS['Color_approveborder'])) . "'"
			. ",approvebg = '" . sqlescape(strtoupper($GLOBALS['Color_approvebg'])) . "'"
			. ",copyborder = '" . sqlescape(strtoupper($GLOBALS['Color_copyborder'])) . "'"
			. ",copybg = '" . sqlescape(strtoupper($GLOBALS['Color_copybg'])) . "'"
			. ",deleteborder = '" . sqlescape(strtoupper($GLOBALS['Color_deleteborder'])) . "'"
			. ",deletebg = '" . sqlescape(strtoupper($GLOBALS['Color_deletebg'])) . "'"
			." WHERE calendarid='" . sqlescape($calendarid) . "'";
	}
}


function ShowForm() {
	global $VariableErrors; ?>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_genericcolors'); ?>:</h3>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_bg'); ?>:</b></td>
         <td><span id="Swap_bg" onClick="SetupColorPicker('bg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_bg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_bg" name="bg" value="<?php echo $GLOBALS['Color_bg']; ?>" onKeyUp="ColorChanged('bg')">  <?php echo lang('color_description_bg'); ?> (Reset to <span onClick="ResetValue('bg', '<?php echo DEFAULTCOLOR_BG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_BG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['bg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['bg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_text'); ?>:</b></td>
         <td><span id="Swap_text" onClick="SetupColorPicker('text')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_text']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_text" name="text" value="<?php echo $GLOBALS['Color_text']; ?>" onKeyUp="ColorChanged('text')">  <?php echo lang('color_description_text'); ?> (Reset to <span onClick="ResetValue('text', '<?php echo DEFAULTCOLOR_TEXT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TEXT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['text'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['text'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_text_faded'); ?>:</b></td>
         <td><span id="Swap_text_faded" onClick="SetupColorPicker('text_faded')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_text_faded']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_text_faded" name="text_faded" value="<?php echo $GLOBALS['Color_text_faded']; ?>" onKeyUp="ColorChanged('text_faded')">  <?php echo lang('color_description_text_faded'); ?> (Reset to <span onClick="ResetValue('text_faded', '<?php echo DEFAULTCOLOR_TEXT_FADED; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TEXT_FADED; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['text_faded'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['text_faded'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_text_warning'); ?>:</b></td>
         <td><span id="Swap_text_warning" onClick="SetupColorPicker('text_warning')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_text_warning']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_text_warning" name="text_warning" value="<?php echo $GLOBALS['Color_text_warning']; ?>" onKeyUp="ColorChanged('text_warning')">  <?php echo lang('color_description_text_warning'); ?> (Reset to <span onClick="ResetValue('text_warning', '<?php echo DEFAULTCOLOR_TEXT_WARNING; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TEXT_WARNING; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['text_warning'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['text_warning'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_link'); ?>:</b></td>
         <td><span id="Swap_link" onClick="SetupColorPicker('link')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_link']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_link" name="link" value="<?php echo $GLOBALS['Color_link']; ?>" onKeyUp="ColorChanged('link')">  <?php echo lang('color_description_link'); ?> (Reset to <span onClick="ResetValue('link', '<?php echo DEFAULTCOLOR_LINK; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_LINK; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['link'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['link'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_body'); ?>:</b></td>
         <td><span id="Swap_body" onClick="SetupColorPicker('body')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_body']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_body" name="body" value="<?php echo $GLOBALS['Color_body']; ?>" onKeyUp="ColorChanged('body')">  <?php echo lang('color_description_body'); ?> (Reset to <span onClick="ResetValue('body', '<?php echo DEFAULTCOLOR_BODY; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_BODY; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['body'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['body'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_today'); ?>:</b></td>
         <td><span id="Swap_today" onClick="SetupColorPicker('today')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_today']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_today" name="today" value="<?php echo $GLOBALS['Color_today']; ?>" onKeyUp="ColorChanged('today')">  <?php echo lang('color_description_today'); ?> (Reset to <span onClick="ResetValue('today', '<?php echo DEFAULTCOLOR_TODAY; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TODAY; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['today'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['today'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_todaylight'); ?>:</b></td>
         <td><span id="Swap_todaylight" onClick="SetupColorPicker('todaylight')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_todaylight']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_todaylight" name="todaylight" value="<?php echo $GLOBALS['Color_todaylight']; ?>" onKeyUp="ColorChanged('todaylight')">  <?php echo lang('color_description_todaylight'); ?> (Reset to <span onClick="ResetValue('todaylight', '<?php echo DEFAULTCOLOR_TODAYLIGHT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TODAYLIGHT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['todaylight'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['todaylight'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_light_cell_bg'); ?>:</b></td>
         <td><span id="Swap_light_cell_bg" onClick="SetupColorPicker('light_cell_bg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_light_cell_bg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_light_cell_bg" name="light_cell_bg" value="<?php echo $GLOBALS['Color_light_cell_bg']; ?>" onKeyUp="ColorChanged('light_cell_bg')">  <?php echo lang('color_description_light_cell_bg'); ?> (Reset to <span onClick="ResetValue('light_cell_bg', '<?php echo DEFAULTCOLOR_LIGHT_CELL_BG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_LIGHT_CELL_BG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['light_cell_bg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['light_cell_bg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_table_header_text'); ?>:</b></td>
         <td><span id="Swap_table_header_text" onClick="SetupColorPicker('table_header_text')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_table_header_text']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_table_header_text" name="table_header_text" value="<?php echo $GLOBALS['Color_table_header_text']; ?>" onKeyUp="ColorChanged('table_header_text')">  <?php echo lang('color_description_table_header_text'); ?> (Reset to <span onClick="ResetValue('table_header_text', '<?php echo DEFAULTCOLOR_TABLE_HEADER_TEXT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TABLE_HEADER_TEXT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['table_header_text'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['table_header_text'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_table_header_bg'); ?>:</b></td>
         <td><span id="Swap_table_header_bg" onClick="SetupColorPicker('table_header_bg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_table_header_bg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_table_header_bg" name="table_header_bg" value="<?php echo $GLOBALS['Color_table_header_bg']; ?>" onKeyUp="ColorChanged('table_header_bg')">  <?php echo lang('color_description_table_header_bg'); ?> (Reset to <span onClick="ResetValue('table_header_bg', '<?php echo DEFAULTCOLOR_TABLE_HEADER_BG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TABLE_HEADER_BG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['table_header_bg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['table_header_bg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_border'); ?>:</b></td>
         <td><span id="Swap_border" onClick="SetupColorPicker('border')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_border']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_border" name="border" value="<?php echo $GLOBALS['Color_border']; ?>" onKeyUp="ColorChanged('border')">  <?php echo lang('color_description_border'); ?> (Reset to <span onClick="ResetValue('border', '<?php echo DEFAULTCOLOR_BORDER; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_BORDER; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['border'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['border'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_keyword_highlight'); ?>:</b></td>
         <td><span id="Swap_keyword_highlight" onClick="SetupColorPicker('keyword_highlight')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_keyword_highlight']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_keyword_highlight" name="keyword_highlight" value="<?php echo $GLOBALS['Color_keyword_highlight']; ?>" onKeyUp="ColorChanged('keyword_highlight')">  <?php echo lang('color_description_keyword_highlight'); ?> (Reset to <span onClick="ResetValue('keyword_highlight', '<?php echo DEFAULTCOLOR_KEYWORD_HIGHLIGHT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_KEYWORD_HIGHLIGHT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['keyword_highlight'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['keyword_highlight'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_h2'); ?>:</b></td>
         <td><span id="Swap_h2" onClick="SetupColorPicker('h2')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_h2']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_h2" name="h2" value="<?php echo $GLOBALS['Color_h2']; ?>" onKeyUp="ColorChanged('h2')">  <?php echo lang('color_description_h2'); ?> (Reset to <span onClick="ResetValue('h2', '<?php echo DEFAULTCOLOR_H2; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_H2; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['h2'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['h2'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_h3'); ?>:</b></td>
         <td><span id="Swap_h3" onClick="SetupColorPicker('h3')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_h3']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_h3" name="h3" value="<?php echo $GLOBALS['Color_h3']; ?>" onKeyUp="ColorChanged('h3')">  <?php echo lang('color_description_h3'); ?> (Reset to <span onClick="ResetValue('h3', '<?php echo DEFAULTCOLOR_H3; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_H3; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['h3'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['h3'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_titletabs'); ?>:</h3>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_title'); ?>:</b></td>
         <td><span id="Swap_title" onClick="SetupColorPicker('title')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_title']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_title" name="title" value="<?php echo $GLOBALS['Color_title']; ?>" onKeyUp="ColorChanged('title')">  <?php echo lang('color_description_title'); ?> (Reset to <span onClick="ResetValue('title', '<?php echo DEFAULTCOLOR_TITLE; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TITLE; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['title'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['title'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_tabgrayed_text'); ?>:</b></td>
         <td><span id="Swap_tabgrayed_text" onClick="SetupColorPicker('tabgrayed_text')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_tabgrayed_text']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_tabgrayed_text" name="tabgrayed_text" value="<?php echo $GLOBALS['Color_tabgrayed_text']; ?>" onKeyUp="ColorChanged('tabgrayed_text')">  <?php echo lang('color_description_tabgrayed_text'); ?> (Reset to <span onClick="ResetValue('tabgrayed_text', '<?php echo DEFAULTCOLOR_TABGRAYED_TEXT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TABGRAYED_TEXT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['tabgrayed_text'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['tabgrayed_text'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_tabgrayed_bg'); ?>:</b></td>
         <td><span id="Swap_tabgrayed_bg" onClick="SetupColorPicker('tabgrayed_bg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_tabgrayed_bg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_tabgrayed_bg" name="tabgrayed_bg" value="<?php echo $GLOBALS['Color_tabgrayed_bg']; ?>" onKeyUp="ColorChanged('tabgrayed_bg')">  <?php echo lang('color_description_tabgrayed_bg'); ?> (Reset to <span onClick="ResetValue('tabgrayed_bg', '<?php echo DEFAULTCOLOR_TABGRAYED_BG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_TABGRAYED_BG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['tabgrayed_bg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['tabgrayed_bg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_filternotice'); ?>:</h3>
   <div style="padding: 2px; padding-left: 15px;"><?php echo lang('color_section_description_filternotice'); ?></div>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_filternotice_bg'); ?>:</b></td>
         <td><span id="Swap_filternotice_bg" onClick="SetupColorPicker('filternotice_bg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_filternotice_bg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_filternotice_bg" name="filternotice_bg" value="<?php echo $GLOBALS['Color_filternotice_bg']; ?>" onKeyUp="ColorChanged('filternotice_bg')">  <?php echo lang('color_description_filternotice_bg'); ?> (Reset to <span onClick="ResetValue('filternotice_bg', '<?php echo DEFAULTCOLOR_FILTERNOTICE_BG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_FILTERNOTICE_BG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['filternotice_bg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['filternotice_bg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_filternotice_font'); ?>:</b></td>
         <td><span id="Swap_filternotice_font" onClick="SetupColorPicker('filternotice_font')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_filternotice_font']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_filternotice_font" name="filternotice_font" value="<?php echo $GLOBALS['Color_filternotice_font']; ?>" onKeyUp="ColorChanged('filternotice_font')">  <?php echo lang('color_description_filternotice_font'); ?> (Reset to <span onClick="ResetValue('filternotice_font', '<?php echo DEFAULTCOLOR_FILTERNOTICE_FONT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_FILTERNOTICE_FONT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['filternotice_font'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['filternotice_font'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_filternotice_fontfaded'); ?>:</b></td>
         <td><span id="Swap_filternotice_fontfaded" onClick="SetupColorPicker('filternotice_fontfaded')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_filternotice_fontfaded']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_filternotice_fontfaded" name="filternotice_fontfaded" value="<?php echo $GLOBALS['Color_filternotice_fontfaded']; ?>" onKeyUp="ColorChanged('filternotice_fontfaded')">  <?php echo lang('color_description_filternotice_fontfaded'); ?> (Reset to <span onClick="ResetValue('filternotice_fontfaded', '<?php echo DEFAULTCOLOR_FILTERNOTICE_FONTFADED; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_FILTERNOTICE_FONTFADED; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['filternotice_fontfaded'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['filternotice_fontfaded'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_filternotice_bgimage'); ?>:</b></td>
         <td><input type="text" id="Color_filternotice_bgimage" name="filternotice_bgimage" value="<?php echo $GLOBALS['Color_filternotice_bgimage']; ?>" onKeyUp="ColorChanged('filternotice_bgimage')">  <?php echo lang('color_description_filternotice_bgimage'); ?><?php if (isset($VariableErrors['filternotice_bgimage'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['filternotice_bgimage'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_eventbar'); ?>:</h3>
   <div style="padding: 2px; padding-left: 15px;"><?php echo lang('color_section_description_eventbar'); ?></div>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_eventbar_past'); ?>:</b></td>
         <td><span id="Swap_eventbar_past" onClick="SetupColorPicker('eventbar_past')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_eventbar_past']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_eventbar_past" name="eventbar_past" value="<?php echo $GLOBALS['Color_eventbar_past']; ?>" onKeyUp="ColorChanged('eventbar_past')">  <?php echo lang('color_description_eventbar_past'); ?> (Reset to <span onClick="ResetValue('eventbar_past', '<?php echo DEFAULTCOLOR_EVENTBAR_PAST; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_EVENTBAR_PAST; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['eventbar_past'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['eventbar_past'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_eventbar_current'); ?>:</b></td>
         <td><span id="Swap_eventbar_current" onClick="SetupColorPicker('eventbar_current')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_eventbar_current']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_eventbar_current" name="eventbar_current" value="<?php echo $GLOBALS['Color_eventbar_current']; ?>" onKeyUp="ColorChanged('eventbar_current')">  <?php echo lang('color_description_eventbar_current'); ?> (Reset to <span onClick="ResetValue('eventbar_current', '<?php echo DEFAULTCOLOR_EVENTBAR_CURRENT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_EVENTBAR_CURRENT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['eventbar_current'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['eventbar_current'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_eventbar_future'); ?>:</b></td>
         <td><span id="Swap_eventbar_future" onClick="SetupColorPicker('eventbar_future')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_eventbar_future']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_eventbar_future" name="eventbar_future" value="<?php echo $GLOBALS['Color_eventbar_future']; ?>" onKeyUp="ColorChanged('eventbar_future')">  <?php echo lang('color_description_eventbar_future'); ?> (Reset to <span onClick="ResetValue('eventbar_future', '<?php echo DEFAULTCOLOR_EVENTBAR_FUTURE; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_EVENTBAR_FUTURE; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['eventbar_future'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['eventbar_future'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_monthdaylabels'); ?>:</h3>
   <div style="padding: 2px; padding-left: 15px;"><?php echo lang('color_section_description_monthdaylabels'); ?></div>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_monthdaylabels_past'); ?>:</b></td>
         <td><span id="Swap_monthdaylabels_past" onClick="SetupColorPicker('monthdaylabels_past')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_monthdaylabels_past']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_monthdaylabels_past" name="monthdaylabels_past" value="<?php echo $GLOBALS['Color_monthdaylabels_past']; ?>" onKeyUp="ColorChanged('monthdaylabels_past')">  <?php echo lang('color_description_monthdaylabels_past'); ?> (Reset to <span onClick="ResetValue('monthdaylabels_past', '<?php echo DEFAULTCOLOR_MONTHDAYLABELS_PAST; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_MONTHDAYLABELS_PAST; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['monthdaylabels_past'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['monthdaylabels_past'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_monthdaylabels_current'); ?>:</b></td>
         <td><span id="Swap_monthdaylabels_current" onClick="SetupColorPicker('monthdaylabels_current')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_monthdaylabels_current']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_monthdaylabels_current" name="monthdaylabels_current" value="<?php echo $GLOBALS['Color_monthdaylabels_current']; ?>" onKeyUp="ColorChanged('monthdaylabels_current')">  <?php echo lang('color_description_monthdaylabels_current'); ?> (Reset to <span onClick="ResetValue('monthdaylabels_current', '<?php echo DEFAULTCOLOR_MONTHDAYLABELS_CURRENT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_MONTHDAYLABELS_CURRENT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['monthdaylabels_current'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['monthdaylabels_current'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_monthdaylabels_future'); ?>:</b></td>
         <td><span id="Swap_monthdaylabels_future" onClick="SetupColorPicker('monthdaylabels_future')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_monthdaylabels_future']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_monthdaylabels_future" name="monthdaylabels_future" value="<?php echo $GLOBALS['Color_monthdaylabels_future']; ?>" onKeyUp="ColorChanged('monthdaylabels_future')">  <?php echo lang('color_description_monthdaylabels_future'); ?> (Reset to <span onClick="ResetValue('monthdaylabels_future', '<?php echo DEFAULTCOLOR_MONTHDAYLABELS_FUTURE; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_MONTHDAYLABELS_FUTURE; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['monthdaylabels_future'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['monthdaylabels_future'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_monthspecific'); ?>:</h3>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_othermonth'); ?>:</b></td>
         <td><span id="Swap_othermonth" onClick="SetupColorPicker('othermonth')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_othermonth']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_othermonth" name="othermonth" value="<?php echo $GLOBALS['Color_othermonth']; ?>" onKeyUp="ColorChanged('othermonth')">  <?php echo lang('color_description_othermonth'); ?> (Reset to <span onClick="ResetValue('othermonth', '<?php echo DEFAULTCOLOR_OTHERMONTH; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_OTHERMONTH; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['othermonth'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['othermonth'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_littlecalendar'); ?>:</h3>
   <div style="padding: 2px; padding-left: 15px;"><?php echo lang('color_section_description_littlecalendar'); ?></div>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_littlecal_today'); ?>:</b></td>
         <td><span id="Swap_littlecal_today" onClick="SetupColorPicker('littlecal_today')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_littlecal_today']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_littlecal_today" name="littlecal_today" value="<?php echo $GLOBALS['Color_littlecal_today']; ?>" onKeyUp="ColorChanged('littlecal_today')">  <?php echo lang('color_description_littlecal_today'); ?> (Reset to <span onClick="ResetValue('littlecal_today', '<?php echo DEFAULTCOLOR_LITTLECAL_TODAY; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_LITTLECAL_TODAY; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['littlecal_today'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['littlecal_today'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_littlecal_highlight'); ?>:</b></td>
         <td><span id="Swap_littlecal_highlight" onClick="SetupColorPicker('littlecal_highlight')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_littlecal_highlight']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_littlecal_highlight" name="littlecal_highlight" value="<?php echo $GLOBALS['Color_littlecal_highlight']; ?>" onKeyUp="ColorChanged('littlecal_highlight')">  <?php echo lang('color_description_littlecal_highlight'); ?> (Reset to <span onClick="ResetValue('littlecal_highlight', '<?php echo DEFAULTCOLOR_LITTLECAL_HIGHLIGHT; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_LITTLECAL_HIGHLIGHT; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['littlecal_highlight'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['littlecal_highlight'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_littlecal_fontfaded'); ?>:</b></td>
         <td><span id="Swap_littlecal_fontfaded" onClick="SetupColorPicker('littlecal_fontfaded')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_littlecal_fontfaded']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_littlecal_fontfaded" name="littlecal_fontfaded" value="<?php echo $GLOBALS['Color_littlecal_fontfaded']; ?>" onKeyUp="ColorChanged('littlecal_fontfaded')">  <?php echo lang('color_description_littlecal_fontfaded'); ?> (Reset to <span onClick="ResetValue('littlecal_fontfaded', '<?php echo DEFAULTCOLOR_LITTLECAL_FONTFADED; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_LITTLECAL_FONTFADED; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['littlecal_fontfaded'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['littlecal_fontfaded'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_littlecal_line'); ?>:</b></td>
         <td><span id="Swap_littlecal_line" onClick="SetupColorPicker('littlecal_line')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_littlecal_line']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_littlecal_line" name="littlecal_line" value="<?php echo $GLOBALS['Color_littlecal_line']; ?>" onKeyUp="ColorChanged('littlecal_line')">  <?php echo lang('color_description_littlecal_line'); ?> (Reset to <span onClick="ResetValue('littlecal_line', '<?php echo DEFAULTCOLOR_LITTLECAL_LINE; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_LITTLECAL_LINE; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['littlecal_line'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['littlecal_line'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_dateselector'); ?>:</h3>
   <div style="padding: 2px; padding-left: 15px;"><?php echo lang('color_section_description_dateselector'); ?></div>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_gobtn_bg'); ?>:</b></td>
         <td><span id="Swap_gobtn_bg" onClick="SetupColorPicker('gobtn_bg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_gobtn_bg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_gobtn_bg" name="gobtn_bg" value="<?php echo $GLOBALS['Color_gobtn_bg']; ?>" onKeyUp="ColorChanged('gobtn_bg')">  <?php echo lang('color_description_gobtn_bg'); ?> (Reset to <span onClick="ResetValue('gobtn_bg', '<?php echo DEFAULTCOLOR_GOBTN_BG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_GOBTN_BG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['gobtn_bg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['gobtn_bg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_gobtn_border'); ?>:</b></td>
         <td><span id="Swap_gobtn_border" onClick="SetupColorPicker('gobtn_border')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_gobtn_border']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_gobtn_border" name="gobtn_border" value="<?php echo $GLOBALS['Color_gobtn_border']; ?>" onKeyUp="ColorChanged('gobtn_border')">  <?php echo lang('color_description_gobtn_border'); ?> (Reset to <span onClick="ResetValue('gobtn_border', '<?php echo DEFAULTCOLOR_GOBTN_BORDER; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_GOBTN_BORDER; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['gobtn_border'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['gobtn_border'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<div class="FormSectionHeader">
   <h3 style="margin: 0; padding: 0;"><?php echo lang('color_section_title_adminbuttons'); ?>:</h3>
</div>
<div style="padding-left: 18px;">
   <table border="0" cellpadding="2" cellspacing="0">
      <tr>
         <td><b><?php echo lang('color_label_newborder'); ?>:</b></td>
         <td><span id="Swap_newborder" onClick="SetupColorPicker('newborder')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_newborder']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_newborder" name="newborder" value="<?php echo $GLOBALS['Color_newborder']; ?>" onKeyUp="ColorChanged('newborder')">  <?php echo lang('color_description_newborder'); ?> (Reset to <span onClick="ResetValue('newborder', '<?php echo DEFAULTCOLOR_NEWBORDER; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_NEWBORDER; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['newborder'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['newborder'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_newbg'); ?>:</b></td>
         <td><span id="Swap_newbg" onClick="SetupColorPicker('newbg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_newbg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_newbg" name="newbg" value="<?php echo $GLOBALS['Color_newbg']; ?>" onKeyUp="ColorChanged('newbg')">  <?php echo lang('color_description_newbg'); ?> (Reset to <span onClick="ResetValue('newbg', '<?php echo DEFAULTCOLOR_NEWBG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_NEWBG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['newbg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['newbg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_approveborder'); ?>:</b></td>
         <td><span id="Swap_approveborder" onClick="SetupColorPicker('approveborder')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_approveborder']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_approveborder" name="approveborder" value="<?php echo $GLOBALS['Color_approveborder']; ?>" onKeyUp="ColorChanged('approveborder')">  <?php echo lang('color_description_approveborder'); ?> (Reset to <span onClick="ResetValue('approveborder', '<?php echo DEFAULTCOLOR_APPROVEBORDER; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_APPROVEBORDER; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['approveborder'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['approveborder'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_approvebg'); ?>:</b></td>
         <td><span id="Swap_approvebg" onClick="SetupColorPicker('approvebg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_approvebg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_approvebg" name="approvebg" value="<?php echo $GLOBALS['Color_approvebg']; ?>" onKeyUp="ColorChanged('approvebg')">  <?php echo lang('color_description_approvebg'); ?> (Reset to <span onClick="ResetValue('approvebg', '<?php echo DEFAULTCOLOR_APPROVEBG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_APPROVEBG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['approvebg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['approvebg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_copyborder'); ?>:</b></td>
         <td><span id="Swap_copyborder" onClick="SetupColorPicker('copyborder')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_copyborder']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_copyborder" name="copyborder" value="<?php echo $GLOBALS['Color_copyborder']; ?>" onKeyUp="ColorChanged('copyborder')">  <?php echo lang('color_description_copyborder'); ?> (Reset to <span onClick="ResetValue('copyborder', '<?php echo DEFAULTCOLOR_COPYBORDER; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_COPYBORDER; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['copyborder'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['copyborder'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_copybg'); ?>:</b></td>
         <td><span id="Swap_copybg" onClick="SetupColorPicker('copybg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_copybg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_copybg" name="copybg" value="<?php echo $GLOBALS['Color_copybg']; ?>" onKeyUp="ColorChanged('copybg')">  <?php echo lang('color_description_copybg'); ?> (Reset to <span onClick="ResetValue('copybg', '<?php echo DEFAULTCOLOR_COPYBG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_COPYBG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['copybg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['copybg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_deleteborder'); ?>:</b></td>
         <td><span id="Swap_deleteborder" onClick="SetupColorPicker('deleteborder')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_deleteborder']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_deleteborder" name="deleteborder" value="<?php echo $GLOBALS['Color_deleteborder']; ?>" onKeyUp="ColorChanged('deleteborder')">  <?php echo lang('color_description_deleteborder'); ?> (Reset to <span onClick="ResetValue('deleteborder', '<?php echo DEFAULTCOLOR_DELETEBORDER; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_DELETEBORDER; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['deleteborder'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['deleteborder'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
      <tr>
         <td><b><?php echo lang('color_label_deletebg'); ?>:</b></td>
         <td><span id="Swap_deletebg" onClick="SetupColorPicker('deletebg')" title="<?php echo lang('click_for_color_picker'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo $GLOBALS['Color_deletebg']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <input type="text" id="Color_deletebg" name="deletebg" value="<?php echo $GLOBALS['Color_deletebg']; ?>" onKeyUp="ColorChanged('deletebg')">  <?php echo lang('color_description_deletebg'); ?> (Reset to <span onClick="ResetValue('deletebg', '<?php echo DEFAULTCOLOR_DELETEBG; ?>')" title="<?php echo lang('reset_to_default_color'); ?>" style="cursor: pointer; border: 1px solid <?php echo $GLOBALS['Color_border'];
            ?>; padding: 2px; background-color: <?php echo DEFAULTCOLOR_DELETEBG; ?>">&nbsp;</span>) <?php if (isset($VariableErrors['deletebg'])) { ?><span class="WarningText"><br> <?php echo htmlentities('"'.$VariableErrors['deletebg'] .'" '. lang('invalid_color')); ?></span><?php } ?>
         </td>
      </tr>
   </table>
</div>
<?php } ?>
