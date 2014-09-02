<?php
if (!defined("ALLOWINCLUDES")) { exit; } // prohibits direct calling of include files
	
/*
1. Outputs the body for the filter view.

2. Defines javascript functions used by only this file.
		function checkAll(myForm, id, state)
		function validate ( myForm, id )
*/
	
?>
<script language="JavaScript" type="text/javascript"><!--
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

function validate ( myForm, id ) {
	b = new Boolean( false );
	for (var cnt=0; cnt < myForm.elements.length; cnt++) {
		var ckb = myForm.elements[cnt];
		if (ckb.type == "checkbox" && ckb.name.indexOf(id) == 0) {
			if (ckb.checked == true) { b = true; break; }
		}
	}
	if ( b == false ) {
		alert ( "Please select one or more categories before clicking the button." );
		return false;
	}
	return true;
}
//--></script>
	<form method="get" action="main.php" name="categorylist">
	<table border="0" cellpadding="0" cellspacing="10">
			<tr align="left" valign="top">
			<td colspan="4" valign="top">
				<strong><?php echo lang('select_categories'); ?></strong>
			</td>
		</tr>
		<tr valign="top">
			<td colspan="4" align="left" nowrap>
				<a href="javascript:checkAll(document.categorylist,'categoryfilter',true);"><?php echo lang('select_unselect'); ?></a>
			</td>
			</tr>
			<tr valign="top">
				<td align="left" nowrap>
<?php
	if (isset($CategoryFilter)) {
		// Create a list of category filter keys
		$CategoryFilterKeys = array_flip($CategoryFilter);
	}
	
	$percolumn = ceil($numcategories / 3);
	for ($c=0; $c<$numcategories; $c++) {
		// determine if the current category has been selected previously
		$categoryselected = !isset($CategoryFilterKeys) || array_key_exists($categories_id[$c], $CategoryFilterKeys);
		
		if ($c > 0 && $c % $percolumn == 0) {
			echo "</td>\n";
			echo "<td align=\"left\" nowrap>\n";
		}
		echo '<input type="checkbox" name="categoryfilter[]" id="category',$c,'" value="'.$categories_id[$c].'"';
			if ( $categoryselected || count($CategoryFilter)==0 ) {
				echo " checked";
			}
			echo ">\n";
		echo '<label for="category',$c,'">',htmlentities($categories_name[$c]),"</label><br>\n";
	} // end: for ($c=0; $c<$numcategories; $c++)
?>    
				</td>
			</tr>
			<tr valign="top">
				<td colspan="3" align="left" valign="top">
					<br>
					<input type="submit" value="&nbsp;&nbsp;<?php echo lang('apply_filter'); ?>&nbsp;&nbsp;">&nbsp;
				</td>
			</tr>
			<input type="hidden" name="view" value="<?php
			
			if (isset($oldview) && $oldview != "filter") {
				echo htmlentities($oldview);
			}
			elseif (isset($_SESSION['PREVIOUS_VIEW'])) {
				echo $_SESSION['PREVIOUS_VIEW'];
			}
			else {
				echo "week";
			}
			
			?>">
			<input type="hidden" name="calendar" value="<?php echo htmlentities($_SESSION['CALENDAR_ID']); ?>">
		</table>
		</form>
