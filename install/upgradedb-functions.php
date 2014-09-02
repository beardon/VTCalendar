<?php
function GetTables() {
	global $Form_POSTGRESSCHEMA, $Form_DBTYPE;
	$TableData = array();
	
	// Use different SQL depending on the database
	if ($Form_DBTYPE == 'mysql') {
		$query = "SHOW TABLES";
	}
	elseif ($Form_DBTYPE == 'postgres') {
		$query = "SELECT tablename FROM pg_tables WHERE schemaname='" . sqlescape($Form_POSTGRESSCHEMA) . "'";
		$keyname = 'tablename';
	}
	
	$result =& DBquery($query);
	if (is_string($result)) {
		echo "<div class='Error'><b>Error:</b> Failed to get tables: " . $result . "</div>";
		return false;
	}
	else {
		$count = $result->numRows();
		
		for ($i = 0; $i < $count; $i++) {
			$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, $i);
			
			if (!isset($keyname)) {
				$keys = array_keys($record);
				$keyname = $keys[0];
			}
			
			GetTableData($TableData, $record[$keyname]);
			SetMaxLengths($TableData, $record[$keyname]);
		}
		$result->free();
	}
	
	return $TableData;
}

function GetTableData(&$TableData, $TableName) {
	global $Form_POSTGRESSCHEMA, $Form_DBTYPE;
	$TableData[$TableName] = array();
	$TableData[$TableName]['Fields'] = array();
	$TableData[$TableName]['Keys'] = array();
	
	// ====================================
	// Get the table columns
	// ====================================
	
	// Use different SQL depending on the database
	if ($Form_DBTYPE == 'mysql') {
		$query = "SHOW FIELDS FROM `" . $TableName . "`";
	}
	elseif ($Form_DBTYPE == 'postgres') {
		$query = "SELECT * from information_schema.columns WHERE table_schema='" . sqlescape($Form_POSTGRESSCHEMA) . "' AND table_name='" . sqlescape($TableName) . "'";
	}
	
	$result =& DBquery($query);
	
	if (is_string($result)) {
		echo "<div class='Error'><b>Error:</b> Failed to get fields for `<code>" . $TableName . "</code>`: " . $result . "</div>";
		return false;
	}
	else {
		
		$count = $result->numRows();
		for ($i = 0; $i < $count; $i++) {
			$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, $i);
			
			if ($Form_DBTYPE == 'mysql') {
				$type = preg_replace('/\([0-9]+\)/', '', $record['Type']);
				$length = preg_replace('/^.*\(([0-9]+)\).*$/', '$1', $record['Type']);
				$TableData[$TableName]['Fields'][$record['Field']]['Type'] = GetCommonType($type);
				$TableData[$TableName]['Fields'][$record['Field']]['Length'] = (GetCommonType($type) == "varchar" && !empty($length) ? $length : '');
				$TableData[$TableName]['Fields'][$record['Field']]['NotNull'] = strtolower($record['Null']) != "yes";
				$TableData[$TableName]['Fields'][$record['Field']]['AutoIncrement'] = strpos($record['Extra'],"auto_increment") !== false;
			}
			elseif ($Form_DBTYPE == 'postgres') {
				$TableData[$TableName]['Fields'][$record['column_name']]['Type'] = GetCommonType($record['data_type']);
				$TableData[$TableName]['Fields'][$record['column_name']]['Length'] = (!empty($record['character_maximum_length']) ? $record['character_maximum_length'].'' : '');
				$TableData[$TableName]['Fields'][$record['column_name']]['NotNull'] = strtolower($record['is_nullable']) != "yes";
				$TableData[$TableName]['Fields'][$record['column_name']]['AutoIncrement'] = strpos($record['column_default'],'nextval(') === 0;
			}
		}
		$result->free();
	}
	
	// ====================================
	// Get the table indexes
	// ====================================
	
	// Use different SQL depending on the database
	if ($Form_DBTYPE == 'mysql') {
		$query = "SHOW INDEXES FROM `" . $TableName . "`";
	}
	elseif ($Form_DBTYPE == 'postgres') {
		$query = "SELECT i.*, c.constraint_type"
			." FROM pg_indexes i LEFT JOIN information_schema.table_constraints c"
			." ON i.schemaname=c.table_schema AND i.tablename=c.table_name AND i.indexname = c.constraint_name AND c.table_catalog=current_database()"
			." WHERE i.schemaname='" . sqlescape($Form_POSTGRESSCHEMA) . "' AND i.tablename='" . sqlescape($TableName) . "'";
	}
	
	$result =& DBquery($query);
	
	if (is_string($result)) {
		echo "<div class='Error'><b>Error:</b> Failed to get indexes for `<code>" . $TableName . "</code>`: " . $result . "</div>";
		return false;
	}
	else {
		$count = $result->numRows();
		for ($i = 0; $i < $count; $i++) {
			$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, $i);
			
			if ($Form_DBTYPE == 'mysql') {
				$TableData[$TableName]['Keys'][$record['Key_name']]['Unique'] = !($record['Non_unique'] != 0);
				$TableData[$TableName]['Keys'][$record['Key_name']]['Fields'][intval($record['Seq_in_index'])] = $record['Column_name'];
			}
			elseif ($Form_DBTYPE == 'postgres') {
				if (!preg_match('/CREATE (UNIQUE )?INDEX ([^\s]+) ON ([^\s]+) (USING [^\s]+ )?\(([^)]+)\)/', $record['indexdef'], $matches)) {
					echo "<div class='Error'><b>Error:</b> Could not parse index def for ".htmlentities($TableName).": " . htmlentities($record['indexdef']) . "</div>";
				}
				else {
					// Set the key name to 'PRIMARY' if it is a primary key. Also save the primary key's actual name.
					if ($record['constraint_type'] == "PRIMARY KEY") {
						$keyName = 'PRIMARY';
						$TableData[$TableName]['Keys'][$keyName]['PKeyName'] = $record['indexname'];
					}
					
					// Otherwise just use the specified key name.
					else {
						$keyName = $record['indexname'];
					}
					
					// Mark if the key is unique.
					$TableData[$TableName]['Keys'][$keyName]['Unique'] = !empty($matches[1]);
					
					// Collect all the fields that make up the key.
					$fields = explode(", ", $matches[5]);
					for ($iField = 0; $iField < count($fields); $iField++) {
						$TableData[$TableName]['Keys'][$keyName]['Fields'][$iField+1] = $fields[$iField];
					}
				}
			}
		}
		$result->free();
	}
}

function SetMaxLengths(&$TableData, $TableName) {
	global $Form_DBTYPE;
	$Fields =& $TableData[$TableName]['Fields'];
	$FieldNames = array_keys($Fields);
	
	$query = "SELECT ";
	for ($i = 0; $i < count($FieldNames); $i++) {
		if ($i > 0) $query .= ", ";
		if (preg_match('/^(varchar|text)$/', $Fields[$FieldNames[$i]]['Type']) ||
			($Form_DBTYPE == 'mysql' && preg_match('/^(timestamp|datetime|date|time)$/', $Fields[$FieldNames[$i]]['Type']))) {
			$query .= "max(length(".$FieldNames[$i].")) as ".$FieldNames[$i]."_max";
		}
		elseif ($Form_DBTYPE == 'postgres' && preg_match('/^(timestamp|date|time)$/', $Fields[$FieldNames[$i]]['Type'])) {
			$query .= "max(length(cast(".$FieldNames[$i]." as varchar))) as ".$FieldNames[$i]."_max";
		}
		else {
			$query .= "max(".$FieldNames[$i].") as ".$FieldNames[$i]."_max";
		}
	}
	$query .= " FROM " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . $TableName . FIELDQUALIFIER;
	
	$result =& DBquery($query);
	
	if (is_string($result)) {
		echo "<div class='Error'><b>Error:</b> Failed to determine max field lengths for `<code>" . $TableName . "</code>`: " . $result . "</div>";
		return false;
	}
	else {
		$record =& $result->fetchRow(DB_FETCHMODE_ASSOC, 0);
		for ($i = 0; $i < count($FieldNames); $i++) {
			$value = $record[$FieldNames[$i].'_max'];
			$Fields[$FieldNames[$i]]['Max'] = !empty($value) ? intval($record[$FieldNames[$i].'_max']) : 0;
		}
		$result->free();
	}
}

function CheckTables() {
	global $CurrentTables, $FinalTables;
	
	$totalchanges = 0;
	
	$CurrentTableNames = array_keys($CurrentTables);
	$FinalTableNames = array_keys($FinalTables);
	
	// Loop through the current tables to see what can be dropped.
	for ($i = 0; $i < count($CurrentTableNames); $i++) {
		if (!array_key_exists($CurrentTableNames[$i], $FinalTables)) {
			echo "<h3 class='Table'>Table: " . $CurrentTableNames[$i] . "</h3><blockquote>";
			echo "<div class='Unused Table'><b>Unused Table Notice:</b> The `<code>" . $CurrentTableNames[$i] . "</code>` table is not used by VTCalendar (unless you've made moficiations). This field will not be touched, and will need to be removed manually.</div>";
			echo "</blockquote>";
			$totalchanges += 0.0001;
		}
	}
	
	// Loop through the final tables to see what is missing.
	for ($i = 0; $i < count($FinalTableNames); $i++) {
		echo "<h3 class='Table'>Table: " . $FinalTableNames[$i] . "</h3><blockquote>";
		
		if (!array_key_exists($FinalTableNames[$i], $CurrentTables)) {
			echo "<div class='Create Table'><b>Create Table:</b> The `<code>" . $FinalTableNames[$i] . "</code>` table is missing and will be created.</div>";
			CreateTable($FinalTableNames[$i]);
			$totalchanges++;
		}
		else {
			$changes = CheckTable($FinalTableNames[$i]);
			
			if ($changes < 1) {
			echo "<div class='Success'><b>OK:</b> The `<code>" . $FinalTableNames[$i] . "</code>` table does not require any changes.</div>";
			}
			
			$totalchanges += $changes;
		}
		
		echo "</blockquote>";
	}
	
	return $totalchanges;
}

function CreateTable($TableName) {
	global $FinalTables;

	$sql = "";
	
	$FieldNames = array_keys($FinalTables[$TableName]['Fields']);
	for ($i = 0; $i < count($FieldNames); $i++) {
		if ($sql != "") {
			$sql .= ",";
		}
		$sql .= "\n\t" . FIELDQUALIFIER . $FieldNames[$i] . FIELDQUALIFIER. " " . GetFieldSQL($FinalTables, $TableName, $FieldNames[$i]);
	}
		
	$KeyNames = array_keys($FinalTables[$TableName]['Keys']);
	for ($i = 0; $i < count($KeyNames); $i++) {
		if ($KeyNames[$i] == "PRIMARY") {
			if ($sql != "") {
				$sql .= ",";
			}
			$sql .= "\n\t" . GetIndexFieldSQL($FinalTables, $TableName, $KeyNames[$i]);
		}
	}
	
	$sql = "CREATE TABLE " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . $TableName . FIELDQUALIFIER . " (" . $sql . "\n);\n\n";
		
	$KeyNames = array_keys($FinalTables[$TableName]['Keys']);
	for ($i = 0; $i < count($KeyNames); $i++) {
		if ($KeyNames[$i] != "PRIMARY") {
			$sql .= "CREATE " . GetIndexFieldSQL($FinalTables, $TableName, $KeyNames[$i], true) . ";\n\n";
		}
	}

	$GLOBALS['FinalSQL'] .= $sql;
}

function CheckTable($TableName) {
	global $CurrentTables, $FinalTables, $Form_DBTYPE;
	
	$changes = 0;
	
	$CurrentTableFields = array_keys($CurrentTables[$TableName]['Fields']);
	$FinalTablesFields = array_keys($FinalTables[$TableName]['Fields']);
	
	$TableSQL = "";
	$IndexSQL = "";
	
	// Loop through the current table fields to see what can be dropped.
	for ($i = 0; $i < count($CurrentTableFields); $i++) {
		if (!array_key_exists($CurrentTableFields[$i], $FinalTables[$TableName]['Fields'])) {
			echo "<div class='Unused Field'><b>Unused Field Notice:</b> The `<code>" . $CurrentTableFields[$i] . "</code>` field in the `<code>" . $TableName . "</code>` table is not used by VTCalendar (unless you've made moficiations). This field will not be touched, and will need to be removed manually.</div>";
			$changes += 0.0001;
		}
	}
	
	// Loop through the final table fields to see what is missing.
	for ($i = 0; $i < count($FinalTablesFields); $i++) {
		if (!array_key_exists($FinalTablesFields[$i], $CurrentTables[$TableName]['Fields'])) {
			echo "<div class='Create Field'><b>New Field:</b> The `<code>" . $FinalTablesFields[$i] . "</code>` field in the `<code>" . $TableName . "</code>` table is missing and will be created as `<code>" . GetFieldSQL($FinalTables, $TableName, $FinalTablesFields[$i]) . "</code>`.</div>";
			$changes++;
			
			if (!empty($TableSQL)) {
				$TableSQL .= ", \n";
			}
			$TableSQL .= "\tADD COLUMN " . FIELDQUALIFIER . $FinalTablesFields[$i] . FIELDQUALIFIER . " " . GetFieldSQL($FinalTables, $TableName, $FinalTablesFields[$i]);
			//TODO: Add 'AFTER `abccolumn`'
		}
		else {
			
			if (($Diff = CheckField($TableName, $FinalTablesFields[$i])) !== true) {
				$changes++;
				
				if ($Form_DBTYPE == 'mysql') {
					if (!empty($TableSQL)) $TableSQL .= ", \n";
					$TableSQL .= "\tMODIFY COLUMN " . FIELDQUALIFIER . $FinalTablesFields[$i] . FIELDQUALIFIER . " " . GetFieldSQL($FinalTables, $TableName, $FinalTablesFields[$i]);
					CheckFieldLength($TableName, $FinalTablesFields[$i]);
				}
				elseif ($Form_DBTYPE == 'postgres') {
					CheckFieldLength($TableName, $FinalTablesFields[$i]);
					$Field = $FinalTables[$TableName]['Fields'][$FinalTablesFields[$i]];
					
					if ($Diff['Type']) {
						if (!empty($TableSQL)) $TableSQL .= ", \n";
						$TableSQL .= "\tALTER COLUMN " . FIELDQUALIFIER . $FinalTablesFields[$i] . FIELDQUALIFIER . " TYPE " . ($Field['AutoIncrement'] ? 'SERIAL' : $Field['Type'] . (!empty($Field['Length']) ? '('.$Field['Length'].')' : ''));
					}
					if ($Diff['NotNull']) {
						if (!empty($TableSQL)) $TableSQL .= ", \n";
						$TableSQL .= "\tALTER COLUMN " . FIELDQUALIFIER . $FinalTablesFields[$i] . FIELDQUALIFIER . " " . ($Field['NotNull'] ? 'SET' : 'DROP') . " NOT NULL";
					}
				}
			}
		}
	}
	
	$CurrentTableIndexes = array_keys($CurrentTables[$TableName]['Keys']);
	$FinalTablesIndexes = array_keys($FinalTables[$TableName]['Keys']);
	
	// Loop through the current table indexes to see what can be dropped.
	for ($i = 0; $i < count($CurrentTableIndexes); $i++) {
		if (!array_key_exists($CurrentTableIndexes[$i], $FinalTables[$TableName]['Keys'])) {
			echo "<div class='Unused Index'><b>Unused Index Notice:</b> The `<code>" . $CurrentTableIndexes[$i] . "</code>` index in the `<code>" . $TableName . "</code>` table is not specified by VTCalendar (unless you've made moficiations). This index will not be touched, and will need to be manually removed.</div>";
			$changes += 0.0001;
		}
	}
	
	// Loop through the final table indexes to see what is missing.
	for ($i = 0; $i < count($FinalTablesIndexes); $i++) {
		$addIndex = false;
		$modifyIndex = false;
		
		// The index does not exist.
		if (!array_key_exists($FinalTablesIndexes[$i], $CurrentTables[$TableName]['Keys'])) {
			echo "<div class='Create " . ($FinalTablesIndexes[$i] == "PRIMARY" ? "PrimaryKey" : "Index") . "'><b>New " . ($FinalTablesIndexes[$i] == "PRIMARY" ? "Primary Key" : "Index") . ":</b> The " . ($FinalTablesIndexes[$i] == "PRIMARY" ? "primary key" : "`<code>" . $FinalTablesIndexes[$i] . "</code>` index") . " in the `<code>" . $TableName . "</code>` table is missing and will be created as `<code>" . GetIndexFieldSQL($FinalTables, $TableName, $FinalTablesIndexes[$i]) . "</code>`.</div>";
			$changes++;
			$addIndex = true;
		}
		
		// The index exists and needs to be changed.
		elseif (!CheckIndex($TableName, $FinalTablesIndexes[$i])) {
			$changes++;
			$modifyIndex = true;
		}
		
		// Drop and add the recreate the index if it needs to be added/changed.
		if ($addIndex || $modifyIndex) {
			
			// Primary keys are dropped/added in the table SQL.
			if ($FinalTablesIndexes[$i] == 'PRIMARY') {
				if (!empty($TableSQL)) $TableSQL .= ", \n";
				
				$TableSQL .= "\t";
				
				// Drop the old key if it existed.
				if ($modifyIndex) {
					
					// In MySQL we can drop the key easily
					if ($Form_DBTYPE == 'mysql') {
						$TableSQL .= "DROP PRIMARY KEY, ";
						//$TableSQL .= "DROP INDEX " . FIELDQUALIFIER . $FinalTablesIndexes[$i] . FIELDQUALIFIER . ", ";
					}
					
					// For PostgreSQL we must drop the primary key by name.
					elseif ($Form_DBTYPE == 'postgres') {
						$TableSQL .= "DROP CONSTRAINT " . FIELDQUALIFIER
							 . ($FinalTablesIndexes[$i] == 'PRIMARY' ? $CurrentTables[$TableName]['Keys'][$CurrentTableIndexes[$i]]['PKeyName'] : $FinalTablesIndexes[$i])
							. FIELDQUALIFIER . ", ";
					}
				}
				
				// Add the primary key.
				$TableSQL .= "ADD " . GetIndexFieldSQL($FinalTables, $TableName, $FinalTablesIndexes[$i]);
			}
			
			// Indexes are handled separately.
			else {
				if (!empty($IndexSQL)) $IndexSQL .= "\n\n";
				
				if ($modifyIndex) {
					$IndexSQL .= "DROP INDEX " . FIELDQUALIFIER . $FinalTablesIndexes[$i] . FIELDQUALIFIER . " ON " . FIELDQUALIFIER . $TableName . FIELDQUALIFIER . ";";
				}
				
				// Add the index
				$IndexSQL .= "CREATE " . GetIndexFieldSQL($FinalTables, $TableName, $FinalTablesIndexes[$i], true) . ";";
			}
		}
	}
	
	// Add the ALTER TABLE header to the SQL for this table, if there were any changes.
	if ($TableSQL != "") {
		$GLOBALS['FinalSQL'] .= "ALTER TABLE " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . $TableName . FIELDQUALIFIER . " \n" . $TableSQL . ";\n\n";
	}
	
	// Add the ALTER TABLE header to the SQL for this table, if there were any changes.
	if ($IndexSQL != "") {
		$GLOBALS['FinalSQL'] .= $IndexSQL . "\n\n";
	}
	
	return $changes;
}

function CheckField($TableName, $FieldName) {
	global $CurrentTables, $FinalTables;
	
	$CurrentField = $CurrentTables[$TableName]['Fields'][$FieldName];
	$FinalField = $FinalTables[$TableName]['Fields'][$FieldName];
	
	$Diff = array();
	$Diff['Type'] = $CurrentField['Type'] != $FinalField['Type'] || $CurrentField['Length'] != $FinalField['Length'];
	$Diff['NotNull'] = $CurrentField['NotNull'] != $FinalField['NotNull'];
	$Diff['AutoIncrement'] = $CurrentField['AutoIncrement'] != $FinalField['AutoIncrement'];
	
	if ($Diff['Type'] || $Diff['NotNull'] || $Diff['AutoIncrement']) {
		echo "<div class='Alter Field'><b>Alter Field:</b> The `<code>" . $FieldName . "</code>` field in the `<code>" . $TableName . "</code>` table needs to be altered from `<code>" . GetFieldSQL($CurrentTables, $TableName, $FieldName) . "</code>` to `<code>" . GetFieldSQL($FinalTables, $TableName, $FieldName) . "</code>`.</div>";
		return $Diff;
	}
	
	return true;
}

function CheckFieldLength($TableName, $FieldName) {
	global $CurrentTables, $FinalTables;
	
	$CurrentField = $CurrentTables[$TableName]['Fields'][$FieldName];
	$FinalField = $FinalTables[$TableName]['Fields'][$FieldName];
	
	if (!empty($FinalField['Length']) && $CurrentField['Max'] > intval($FinalField['Length'])) {
		echo "<div class='Error Field'><b>Field Length Warning:</b> The `<code>" . $FieldName . "</code>` field in the `<code>" . $TableName . "</code>` contains data that is longer (".$CurrentField['Max']." characters) than the new length (".$FinalField['Length']." characters).</div>";
		return false;
	}
	
	return true;
}

function CheckIndex($TableName, $IndexName) {
	global $CurrentTables, $FinalTables;
	
	$CurrentIndex = $CurrentTables[$TableName]['Keys'][$IndexName];
	$FinalIndex = $FinalTables[$TableName]['Keys'][$IndexName];
	
	if (GetIndexFieldSQL($CurrentTables, $TableName, $IndexName) != GetIndexFieldSQL($FinalTables, $TableName, $IndexName)) {
		
		echo "<div class='Alter " . ($IndexName == "PRIMARY" ? "PrimaryKey" : "Index") . "'><b>Alter " . ($IndexName == "PRIMARY" ? "Primary Key" : "Index") . ":</b> The `<code>" . $IndexName . "</code>` index in the `<code>" . $TableName . "</code>` table needs to be altered from `<code>" . GetIndexFieldSQL($CurrentTables, $TableName, $IndexName) . "</code>` to `<code>" . GetIndexFieldSQL($FinalTables, $TableName, $IndexName) . "</code>`.</div>";
		return false;
	}
	return true;
}

function GetFieldSQL(&$TableData, $TableName, $FieldName) {
	global $Form_DBTYPE;
	$Field = $TableData[$TableName]['Fields'][$FieldName];
	
	if ($Form_DBTYPE == 'postgres' && $Field['AutoIncrement']) {
		return "SERIAL";
	}
	else {
		$sql = $Field['Type'] . (!empty($Field['Length']) ? '('.$Field['Length'].')' : '');
		if ($Field['NotNull']) $sql .= " NOT NULL";
		if ($Field['AutoIncrement']) $sql .= " auto_increment";
	}
	
	return $sql;
}

function GetIndexFieldSQL(&$TableData, $TableName, $IndexName, $UseOn=false) {
	$Index = $TableData[$TableName]['Keys'][$IndexName];
	
	$sql = "";
	for ($i = 1; $i <= count($Index['Fields']); $i++) {
		if ($i > 1) $sql .= ", ";
		$sql .= $Index['Fields'][$i];
	}
	
	if ($IndexName == 'PRIMARY') {
		return "PRIMARY KEY (" . $sql . ")";
	}
	else {
		if (!isset($Index['Unique'])) echo $IndexName;
		if ($Index['Unique']) {
			return "UNIQUE INDEX " . FIELDQUALIFIER . $IndexName . FIELDQUALIFIER . " ON " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . $TableName . FIELDQUALIFIER . " (" . $sql . ")";
		}
		else {
			return "INDEX " . FIELDQUALIFIER . $IndexName . FIELDQUALIFIER . " " . ($UseOn ? "ON " . FIELDQUALIFIER . SCHEMA . FIELDQUALIFIER . "." . FIELDQUALIFIER . $TableName . FIELDQUALIFIER : '') . " (" . $sql . ")";
		}
	}
}

function GetCommonType($type) {
	switch ($type) {
		case 'character varying': return 'varchar';
		case 'integer': return 'int';
		case 'int(11)': return 'int';
		case 'time with time zone': return 'time';
		case 'time without time zone': return 'time';
		case 'date with time zone': return 'date';
		case 'date without time zone': return 'date';
		case 'timestamp with time zone': return 'timestamp';
		case 'timestamp without time zone': return 'timestamp';
	}
	return $type;
}
?>