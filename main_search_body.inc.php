<?php
  if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
?><table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#FFFFFF">
        <tr valign="top">
				<td>
<?php
  // check if some input params are set, and if not set them to default
  if (!isset($timebegin_year))  { $timebegin_year = $today['year']; }
  if (!isset($timebegin_month)) { $timebegin_month = $today['month']; }
  if (!isset($timebegin_day))   { $timebegin_day = $today['day']; }

  if (!isset($timeend_year)) { $timeend_year = $timebegin_year; }
  if (!isset($timeend_month)) {
    $timeend_month = $timebegin_month+6;
    if ($timeend_month >= 13) {
      $timeend_month = $timeend_month-12;
      $timeend_year++;
    }
  }
  if (!isset($timeend_day)) {
    $timeend_day = $timebegin_day;
    while (!checkdate($timeend_month,$timeend_day,$timeend_year)) { $timeend_day--; };
  }
?>				
<form method="get" action="main.php" name="searchform">
  <input type="hidden" name="view" value="searchresults">
  <TABLE border="0" cellpadding="3" cellspacing="2">
    <TR>
      <TD class="bodytext" valign="top">
        <strong>Keyword:&nbsp;&nbsp;&nbsp;</strong>
      </TD>
      <TD class="bodytext" valign="top">
        <INPUT type="text" size="40" name="keyword" value="<?php echo $keyword; ?>" maxlength="<?php echo constKeywordMaxLength; ?>"><br>
        (case-insensitive; e.g. reading day)<br>
        <br>
      </TD>
    </TR>
    <tr>
		  <TD class="bodytext" valign="top">
        <strong>Starting from:</strong>
      </TD>
      <TD class="bodytext" valign="top">
        <TABLE border="0">
          <TR>
            <TD class="bodytext" valign="top">
              <SELECT name="timebegin_month" size="1">
<?php
  // print list with months
  for ($i=1; $i<=12; $i++) {
    print '<OPTION ';
    if ($timebegin_month==$i) { echo "selected "; }
    echo "value=\"$i\">",Month_to_Text($i),"</OPTION>\n";
  }
?>
              </SELECT>
            </TD>
            <TD class="bodytext" valign="top">
              <SELECT name="timebegin_day" size="1">
<?php
  // print list with days
  for ($i=1; $i<=31; $i++) {
    echo "<OPTION ";
    if ($timebegin_day==$i) { echo "selected "; }
    echo "value=\"$i\">$i</OPTION>\n";
  }
?>
              </SELECT>
            </TD>
            <TD class="bodytext" valign="top">
              <SELECT name="timebegin_year" size="1">
<?php
  // print list with years
  for ($i=date("Y")-1; $i<=date("Y")+3; $i++) {
    echo "<OPTION ";
    if ($timebegin_year==$i) { echo "selected "; }
    echo "value=\"$i\">$i</OPTION>\n";
  }
?>
              </SELECT>
            </TD>
      	  </TR>
          </TABLE>
					</td></tr>
						<tr>
						  <td>&nbsp;</td>
						  <td><br><INPUT type="submit" name="search" value="&nbsp;&nbsp;&nbsp;Search&nbsp;&nbsp;&nbsp;"></td>
						</tr>
					
        </TABLE>
  <BR>
</FORM>				
				</td>
        </tr>
      </table>
<script language="JavaScript1.2"><!--
  document.searchform.keyword.focus();
//--></script>