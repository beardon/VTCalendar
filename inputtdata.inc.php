<?php
  if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
  require("inputedata.inc.php");

  function inputtemplatedata(&$event,$sponsorid,$check,$template_name,$database) {
?>
<TABLE border="0" cellpadding="2" cellspacing="0">
  <TR>
    <TD class="bodytext" valign="top">
      <strong>Template name:</strong> <font color="#FF0000">*</FONT>
    </TD>
    <TD class="bodytext" valign="top">
<?php
  if ($check && (empty($template_name))) {
    feedback("Please choose a template name.",1);
  }
?>
  <INPUT type="text" size="24" name="template_name" maxlength="<?php echo constTemplate_nameMaxLength; ?>" value="<?php

  if ($check) { $template_name=stripslashes($template_name); }
  echo HTMLSpecialChars($template_name);
?>">
      <I>(e.g. Guest speaker)</I>
    </td>
  <tr>
</table>
<hr align="left" size="1">
<?php
    inputeventdata($event,$sponsorid,0,$check,0,$repeat,$database);
  } // end: Function inputtemplatedata
?>