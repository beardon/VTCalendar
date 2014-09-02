<?php
if (AUTH_DB) {
	?>
	<h2>Create Account for Database Authentication</h2>
	<blockquote>
		<table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
			<tr>
				<td class="VariableName" nowrap="nowrap" valign="top"><b>Main Admin Username:</b> </td>
				<td class="VariableBody"><table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
						<tr>
							<td class="DataField"><div class="DataFieldInput">
									<input type="text" id="Input_CREATEADMIN_USERNAME" name="CREATEADMIN_USERNAME" value="<?php echo htmlentities($GLOBALS['Form_CREATEADMIN_USERNAME']); ?>" size="60"/>
									<span id="DataFieldInputExtra_CREATEADMIN_USERNAME"></span> </div>
									<div class="Example"> <i>Example: root</i> </div></td>
						</tr>
				</table></td>
			</tr>
			<tr>
				<td class="VariableName" nowrap="nowrap" valign="top"><b>Main Admin Password:</b> </td>
				<td class="VariableBody"><table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
						<tr>
							<td class="DataField"><div class="DataFieldInput">
									<input type="text" id="Input_CREATEADMIN_PASSWORD" name="CREATEADMIN_PASSWORD" value="<?php echo htmlentities($GLOBALS['Form_CREATEADMIN_PASSWORD']); ?>" size="60"/>
									<span id="DataFieldInputExtra_CREATEADMIN_PASSWORD"></span> </div></td>
						</tr>
				</table></td>
			</tr>
		</table>
	</blockquote>
	<?php
}

if (AUTH_LDAP || AUTH_HTTP) {
	?>
	<h2>Grant Access to LDAP or HTTP Accounts</h2>
	<blockquote>
		<table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
		
			<tr>
				<td class="VariableName" nowrap="nowrap" valign="top"><b>Accounts to Add as Main Admins:</b> </td>
				<td class="VariableBody"><table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
						<tr>
							<td class="DataField"><div class="DataFieldInput">
									<textarea id="Input_MAINADMINS" name="MAINADMINS" rows="15" cols="60"><?php echo htmlentities($GLOBALS['Form_MAINADMINS']); ?></textarea>
									<span id="DataFieldInputExtra_MAINADMINS"></span> </div>
									</td>
						</tr>
						<tr>
							<td class="Comment"><div class="CommentLine">A list of account names that will be added as main admins. Each account name must be on its own line.</div>
		    						<div class="CommentLine">Adding account names in this field will not be helpful unless you are using LDAP or HTTP Authentication.</div></td>
						</tr>
				</table></td>
			</tr>
		</table>
	</blockquote>
	<?php
}
?>