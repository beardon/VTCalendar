<?php if (!defined("ALLOWINCLUDES")) exit; ?>

<h2>General:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Title Prefix:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_TITLEPREFIX" name="TITLEPREFIX" value="<?php echo htmlentities($GLOBALS['Form_TITLEPREFIX']); ?>" size="60"/> <span id="DataFieldInputExtra_TITLEPREFIX"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">OPTIONAL. Added at the beginning of the &lt;title&gt; tag.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Title Suffix:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_TITLESUFFIX" name="TITLESUFFIX" value="<?php echo htmlentities($GLOBALS['Form_TITLESUFFIX']); ?>" size="60"/> <span id="DataFieldInputExtra_TITLESUFFIX"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: " - My University"</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">OPTIONAL. Added at the end of the &lt;title&gt; tag.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Language:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_LANGUAGE" name="LANGUAGE" value="<?php echo htmlentities($GLOBALS['Form_LANGUAGE']); ?>" size="60"/> <span id="DataFieldInputExtra_LANGUAGE"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: en (English), de (German), sv (Swedish)</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Language used (refers to language file in directory /languages)</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Max Year Ahead for New Events:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_ALLOWED_YEARS_AHEAD" name="ALLOWED_YEARS_AHEAD" value="<?php echo htmlentities($GLOBALS['Form_ALLOWED_YEARS_AHEAD']); ?>" size="60"/> <span id="DataFieldInputExtra_ALLOWED_YEARS_AHEAD"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">The number of years into the future that the calendar will allow users to create events for.</div>
                     <div class="CommentLine">For example, if the current year is 2000 then a value of '3' will allow users to create events up to 2003.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>Database:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Database Connection String:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_DATABASE" name="DATABASE" value="<?php echo htmlentities($GLOBALS['Form_DATABASE']); ?>" size="60"/> <span id="DataFieldInputExtra_DATABASE"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: mysql://vtcal:abc123@localhost/vtcalendar</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">This is the database connection string used by the PEAR library.</div>
                     <div class="CommentLine">It has the format: "mysql://user:password@host/databasename" or "pgsql://user:password@host/databasename"</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Table Prefix:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_TABLEPREFIX" name="TABLEPREFIX" value="<?php echo htmlentities($GLOBALS['Form_TABLEPREFIX']); ?>" size="60"/> <span id="DataFieldInputExtra_TABLEPREFIX"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: public</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">In some databases (such as PostgreSQL) you may have multiple sets of VTCalendar tables within the same database, but in different schemas.</div>
                     <div class="CommentLine">If this is the case for you, enter the name of the schema here.</div>
                     <div class="CommentLine">It will be prefixed to the table name like so: TABLEPREFIX.vtcal_calendars.</div>
                     <div class="CommentLine">If necessary include quotes. Use a backtick (`) for MySQL or double quotes (") for PostgreSQL.</div>
                     <div class="CommentLine">Note: If specified, the table prefix MUST end with a period.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>SQL Log File:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_SQLLOGFILE" name="SQLLOGFILE" value="<?php echo htmlentities($GLOBALS['Form_SQLLOGFILE']); ?>" size="60"/> <span id="DataFieldInputExtra_SQLLOGFILE"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: /var/log/vtcalendarsql.log</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">OPTIONAL. Put a name of a (folder and) file where the calendar logs every SQL query to the database.</div>
                     <div class="CommentLine">This is good for debugging but make sure you write into a file that's not readable by the webserver or else you may expose private information.</div>
                     <div class="CommentLine">If left blank ("") no log will be kept. That's the default.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>Authentication:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>User ID Regular Expression:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_REGEXVALIDUSERID" name="REGEXVALIDUSERID" value="<?php echo htmlentities($GLOBALS['Form_REGEXVALIDUSERID']); ?>" size="60"/> <span id="DataFieldInputExtra_REGEXVALIDUSERID"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">This regular expression defines what is considered a valid user-ID.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Database Authentication:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_AUTH_DB" name="AUTH_DB" value="true"
										onclick="ToggleDependant('AUTH_DB');" onchange="ToggleDependant('AUTH_DB');"<?php if ($GLOBALS['Form_AUTH_DB'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_AUTH_DB"> Yes</label>
                        <span id="DataFieldInputExtra_AUTH_DB"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Authenticate users against the database.</div>
                     <div class="CommentLine">If enabled, this is always performed before any other authentication.</div>
                  </td>
               </tr>
               <tr id="Dependants_AUTH_DB">
                  <td>
                     <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>Prefix for Database Usernames:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_AUTH_DB_USER_PREFIX" name="AUTH_DB_USER_PREFIX" value="<?php echo htmlentities($GLOBALS['Form_AUTH_DB_USER_PREFIX']); ?>" size="60"/> <span id="DataFieldInputExtra_AUTH_DB_USER_PREFIX"> </span>
                                       </div>
                                       <div class="Example">
                                          <i>Example: db_</i>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">OPTIONAL. This prefix is used when creating/editing a local user-ID (in the DB "user" table), e.g. "calendar."</div>
                                       <div class="CommentLine">If you only use auth_db just leave it an empty string.</div>
                                       <div class="CommentLine">Its purpose is to avoid name-space conflicts with the users authenticated via LDAP or HTTP.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>Database Authentication Notice:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_AUTH_DB_NOTICE" name="AUTH_DB_NOTICE" value="<?php echo htmlentities($GLOBALS['Form_AUTH_DB_NOTICE']); ?>" size="60"/> <span id="DataFieldInputExtra_AUTH_DB_NOTICE"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">OPTIONAL. This displays a text (or nothing) on the Update tab behind the user user management options.</div>
                                       <div class="CommentLine">It could be used if you employ both, AUTH_DB and AUTH_LDAP at the same time to let users know that they should create local users only if they are not in the LDAP.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                     <script type="text/javascript">ToggleDependant('AUTH_DB');</script>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>LDAP Authentication:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_AUTH_LDAP" name="AUTH_LDAP" value="true"
										onclick="ToggleDependant('AUTH_LDAP');" onchange="ToggleDependant('AUTH_LDAP');"<?php if ($GLOBALS['Form_AUTH_LDAP'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_AUTH_LDAP"> Yes</label>
                        <span id="DataFieldInputExtra_AUTH_LDAP"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Authenticate users against a LDAP server.</div>
                     <div class="CommentLine">If enabled, HTTP authenticate will be ignored.</div>
                  </td>
               </tr>
               <tr id="Dependants_AUTH_LDAP">
                  <td>
                     <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>Verify LDAP Settings:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="checkbox" id="CheckBox_LDAP_CHECK" name="LDAP_CHECK" value="true"
										<?php if ($GLOBALS['Form_LDAP_CHECK'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_LDAP_CHECK"> Yes</label>
                                          <span id="DataFieldInputExtra_LDAP_CHECK"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">Check this box if you would like to verify the LDAP settings when submitting this form.</div>
                                       <div class="CommentLine">Uncheck this box if you know the settings are correct, but your LDAP server is currently unavailable.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>LDAP Host Name:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_LDAP_HOST" name="LDAP_HOST" value="<?php echo htmlentities($GLOBALS['Form_LDAP_HOST']); ?>" size="60"/> <span id="DataFieldInputExtra_LDAP_HOST"> </span>
                                       </div>
                                       <div class="Example">
                                          <i>Example: directory.myuniversity.edu or ldap://directory.myuniversity.edu/ or ldaps://secure-directory.myuniversity.edu/</i>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">If you are using OpenLDAP 2.x.x you can specify a URL ('ldap://host/') instead of the hostname ('host').</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>LDAP Port:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_LDAP_PORT" name="LDAP_PORT" value="<?php echo htmlentities($GLOBALS['Form_LDAP_PORT']); ?>" size="60"/> <span id="DataFieldInputExtra_LDAP_PORT"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">The port to connect to. Ignored if LDAP Host Name is a URL.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>LDAP Username Attribute:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_LDAP_USERFIELD" name="LDAP_USERFIELD" value="<?php echo htmlentities($GLOBALS['Form_LDAP_USERFIELD']); ?>" size="60"/> <span id="DataFieldInputExtra_LDAP_USERFIELD"> </span>
                                       </div>
                                       <div class="Example">
                                          <i>Example: sAMAccountName</i>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">The attribute which contains the username.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>LDAP Base DN:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_LDAP_BASE_DN" name="LDAP_BASE_DN" value="<?php echo htmlentities($GLOBALS['Form_LDAP_BASE_DN']); ?>" size="60"/> <span id="DataFieldInputExtra_LDAP_BASE_DN"> </span>
                                       </div>
                                       <div class="Example">
                                          <i>Example: DC=myuniversity,DC=edu</i>
                                       </div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>Additional LDAP Search Filter:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_LDAP_SEARCH_FILTER" name="LDAP_SEARCH_FILTER" value="<?php echo htmlentities($GLOBALS['Form_LDAP_SEARCH_FILTER']); ?>" size="60"/> <span id="DataFieldInputExtra_LDAP_SEARCH_FILTER"> </span>
                                       </div>
                                       <div class="Example">
                                          <i>Example: (objectClass=person)</i>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">OPTIONAL. A filter to add to the LDAP search.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>Authenticate When Connecting to LDAP:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="checkbox" id="CheckBox_LDAP_BIND" name="LDAP_BIND" value="true"
										onclick="ToggleDependant('LDAP_BIND');" onchange="ToggleDependant('LDAP_BIND');"<?php if ($GLOBALS['Form_LDAP_BIND'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_LDAP_BIND"> Yes</label>
                                          <span id="DataFieldInputExtra_LDAP_BIND"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">Before authenticating the user, we first check if the username exists.</div>
                                       <div class="CommentLine">If your LDAP server does not allow anonymous searches, you will need to specify a username and password to bind as.</div>
                                    </td>
                                 </tr>
                                 <tr id="Dependants_LDAP_BIND">
                                    <td>
                                       <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
                                          <tr>
                                             <td class="VariableName" nowrap="nowrap" valign="top">
                                                <b>LDAP Username:</b>
                                             </td>
                                             <td class="VariableBody">
                                                <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                                   <tr>
                                                      <td class="DataField">
                                                         <div class="DataFieldInput"><input type="text" id="Input_LDAP_BIND_USER" name="LDAP_BIND_USER" value="<?php echo htmlentities($GLOBALS['Form_LDAP_BIND_USER']); ?>" size="60"/> <span id="DataFieldInputExtra_LDAP_BIND_USER"> </span>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="VariableName" nowrap="nowrap" valign="top">
                                                <b>LDAP Password:</b>
                                             </td>
                                             <td class="VariableBody">
                                                <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                                   <tr>
                                                      <td class="DataField">
                                                         <div class="DataFieldInput"><input type="text" id="Input_LDAP_BIND_PASSWORD" name="LDAP_BIND_PASSWORD" value="<?php echo htmlentities($GLOBALS['Form_LDAP_BIND_PASSWORD']); ?>" size="60"/> <span id="DataFieldInputExtra_LDAP_BIND_PASSWORD"> </span>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </table>
                                       <script type="text/javascript">ToggleDependant('LDAP_BIND');</script>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                     <script type="text/javascript">ToggleDependant('AUTH_LDAP');</script>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>HTTP Authentication:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_AUTH_HTTP" name="AUTH_HTTP" value="true"
										onclick="ToggleDependant('AUTH_HTTP');" onchange="ToggleDependant('AUTH_HTTP');"<?php if ($GLOBALS['Form_AUTH_HTTP'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_AUTH_HTTP"> Yes</label>
                        <span id="DataFieldInputExtra_AUTH_HTTP"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Authenticate users by sending an HTTP request to a server.</div>
                     <div class="CommentLine">A HTTP status code of 200 will authorize the user. Otherwise, they will not be authorized.</div>
                     <div class="CommentLine">If LDAP authentication is enabled, this will be ignored.</div>
                  </td>
               </tr>
               <tr id="Dependants_AUTH_HTTP">
                  <td>
                     <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>HTTP Authorizaton URL:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_AUTH_HTTP_URL" name="AUTH_HTTP_URL" value="<?php echo htmlentities($GLOBALS['Form_AUTH_HTTP_URL']); ?>" size="60"/> <span id="DataFieldInputExtra_AUTH_HTTP_URL"> </span>
                                       </div>
                                       <div class="Example">
                                          <i>Example: http://localhost/customauth.php</i>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">The URL to use for the BASIC HTTP Authentication.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                     <script type="text/javascript">ToggleDependant('AUTH_HTTP');</script>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>Cookies:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Cookie Path:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_BASEPATH" name="BASEPATH" value="<?php echo htmlentities($GLOBALS['Form_BASEPATH']); ?>" size="60"/> <span id="DataFieldInputExtra_BASEPATH"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: /calendar/</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">OPTIONAL. If you are hosting more than one VTCalendar on your server, you may want to set this to this calendar's path.</div>
                     <div class="CommentLine">Otherwise, the cookie will be submitted with a default path.</div>
                     <div class="CommentLine">This must start and end with a forward slash (/), unless the it is exactly "/".</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Cookie Host Name:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_BASEDOMAIN" name="BASEDOMAIN" value="<?php echo htmlentities($GLOBALS['Form_BASEDOMAIN']); ?>" size="60"/> <span id="DataFieldInputExtra_BASEDOMAIN"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: localhost</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">OPTIONAL. If you are hosting more than one VTCalendar on your server, you may want to set this to your server's host name.</div>
                     <div class="CommentLine">Otherwise, the cookie will be submitted with a default host name.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>URL:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Calendar Base URL:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_BASEURL" name="BASEURL" value="<?php echo htmlentities($GLOBALS['Form_BASEURL']); ?>" size="60"/> <span id="DataFieldInputExtra_BASEURL"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: http://localhost/calendar/</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">This is the absolute URL where your calendar software is located.</div>
                     <div class="CommentLine">This MUST end with a slash "/"</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Secure Calendar Base URL:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_SECUREBASEURL" name="SECUREBASEURL" value="<?php echo htmlentities($GLOBALS['Form_SECUREBASEURL']); ?>" size="60"/> <span id="DataFieldInputExtra_SECUREBASEURL"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: https://localhost/calendar/</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">This is the absolute path where the secure version of the calendar is located.</div>
                     <div class="CommentLine">If you are not using URL, set this to the same address as BASEURL.</div>
                     <div class="CommentLine">This MUST end with a slash "/"</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>Date/Time:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Timezone:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput">
                        <select name="TIMEZONE" id="Input_TIMEZONE">
<option value="" <?php if ($GLOBALS['Form_TIMEZONE'] == '') echo 'selected="selected"'; ?>>(Use the server's local time)</option>
<option value="Africa/Abidjan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Abidjan') echo 'selected="selected"'; ?>>Africa/Abidjan</option>
<option value="Africa/Accra" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Accra') echo 'selected="selected"'; ?>>Africa/Accra</option>
<option value="Africa/Addis_Ababa" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Addis_Ababa') echo 'selected="selected"'; ?>>Africa/Addis_Ababa</option>
<option value="Africa/Algiers" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Algiers') echo 'selected="selected"'; ?>>Africa/Algiers</option>
<option value="Africa/Asmara" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Asmara') echo 'selected="selected"'; ?>>Africa/Asmara</option>
<option value="Africa/Asmera" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Asmera') echo 'selected="selected"'; ?>>Africa/Asmera</option>
<option value="Africa/Bamako" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Bamako') echo 'selected="selected"'; ?>>Africa/Bamako</option>
<option value="Africa/Bangui" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Bangui') echo 'selected="selected"'; ?>>Africa/Bangui</option>
<option value="Africa/Banjul" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Banjul') echo 'selected="selected"'; ?>>Africa/Banjul</option>
<option value="Africa/Bissau" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Bissau') echo 'selected="selected"'; ?>>Africa/Bissau</option>
<option value="Africa/Blantyre" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Blantyre') echo 'selected="selected"'; ?>>Africa/Blantyre</option>
<option value="Africa/Brazzaville" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Brazzaville') echo 'selected="selected"'; ?>>Africa/Brazzaville</option>
<option value="Africa/Bujumbura" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Bujumbura') echo 'selected="selected"'; ?>>Africa/Bujumbura</option>
<option value="Africa/Cairo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Cairo') echo 'selected="selected"'; ?>>Africa/Cairo</option>
<option value="Africa/Casablanca" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Casablanca') echo 'selected="selected"'; ?>>Africa/Casablanca</option>
<option value="Africa/Ceuta" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Ceuta') echo 'selected="selected"'; ?>>Africa/Ceuta</option>
<option value="Africa/Conakry" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Conakry') echo 'selected="selected"'; ?>>Africa/Conakry</option>
<option value="Africa/Dakar" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Dakar') echo 'selected="selected"'; ?>>Africa/Dakar</option>
<option value="Africa/Dar_es_Salaam" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Dar_es_Salaam') echo 'selected="selected"'; ?>>Africa/Dar_es_Salaam</option>
<option value="Africa/Djibouti" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Djibouti') echo 'selected="selected"'; ?>>Africa/Djibouti</option>
<option value="Africa/Douala" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Douala') echo 'selected="selected"'; ?>>Africa/Douala</option>
<option value="Africa/El_Aaiun" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/El_Aaiun') echo 'selected="selected"'; ?>>Africa/El_Aaiun</option>
<option value="Africa/Freetown" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Freetown') echo 'selected="selected"'; ?>>Africa/Freetown</option>
<option value="Africa/Gaborone" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Gaborone') echo 'selected="selected"'; ?>>Africa/Gaborone</option>
<option value="Africa/Harare" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Harare') echo 'selected="selected"'; ?>>Africa/Harare</option>
<option value="Africa/Johannesburg" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Johannesburg') echo 'selected="selected"'; ?>>Africa/Johannesburg</option>
<option value="Africa/Kampala" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Kampala') echo 'selected="selected"'; ?>>Africa/Kampala</option>
<option value="Africa/Khartoum" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Khartoum') echo 'selected="selected"'; ?>>Africa/Khartoum</option>
<option value="Africa/Kigali" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Kigali') echo 'selected="selected"'; ?>>Africa/Kigali</option>
<option value="Africa/Kinshasa" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Kinshasa') echo 'selected="selected"'; ?>>Africa/Kinshasa</option>
<option value="Africa/Lagos" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Lagos') echo 'selected="selected"'; ?>>Africa/Lagos</option>
<option value="Africa/Libreville" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Libreville') echo 'selected="selected"'; ?>>Africa/Libreville</option>
<option value="Africa/Lome" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Lome') echo 'selected="selected"'; ?>>Africa/Lome</option>
<option value="Africa/Luanda" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Luanda') echo 'selected="selected"'; ?>>Africa/Luanda</option>
<option value="Africa/Lubumbashi" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Lubumbashi') echo 'selected="selected"'; ?>>Africa/Lubumbashi</option>
<option value="Africa/Lusaka" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Lusaka') echo 'selected="selected"'; ?>>Africa/Lusaka</option>
<option value="Africa/Malabo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Malabo') echo 'selected="selected"'; ?>>Africa/Malabo</option>
<option value="Africa/Maputo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Maputo') echo 'selected="selected"'; ?>>Africa/Maputo</option>
<option value="Africa/Maseru" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Maseru') echo 'selected="selected"'; ?>>Africa/Maseru</option>
<option value="Africa/Mbabane" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Mbabane') echo 'selected="selected"'; ?>>Africa/Mbabane</option>
<option value="Africa/Mogadishu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Mogadishu') echo 'selected="selected"'; ?>>Africa/Mogadishu</option>
<option value="Africa/Monrovia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Monrovia') echo 'selected="selected"'; ?>>Africa/Monrovia</option>
<option value="Africa/Nairobi" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Nairobi') echo 'selected="selected"'; ?>>Africa/Nairobi</option>
<option value="Africa/Ndjamena" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Ndjamena') echo 'selected="selected"'; ?>>Africa/Ndjamena</option>
<option value="Africa/Niamey" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Niamey') echo 'selected="selected"'; ?>>Africa/Niamey</option>
<option value="Africa/Nouakchott" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Nouakchott') echo 'selected="selected"'; ?>>Africa/Nouakchott</option>
<option value="Africa/Ouagadougou" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Ouagadougou') echo 'selected="selected"'; ?>>Africa/Ouagadougou</option>
<option value="Africa/Porto-Novo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Porto-Novo') echo 'selected="selected"'; ?>>Africa/Porto-Novo</option>
<option value="Africa/Sao_Tome" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Sao_Tome') echo 'selected="selected"'; ?>>Africa/Sao_Tome</option>
<option value="Africa/Timbuktu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Timbuktu') echo 'selected="selected"'; ?>>Africa/Timbuktu</option>
<option value="Africa/Tripoli" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Tripoli') echo 'selected="selected"'; ?>>Africa/Tripoli</option>
<option value="Africa/Tunis" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Tunis') echo 'selected="selected"'; ?>>Africa/Tunis</option>
<option value="Africa/Windhoek" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Africa/Windhoek') echo 'selected="selected"'; ?>>Africa/Windhoek</option>
<option value="America/Adak" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Adak') echo 'selected="selected"'; ?>>America/Adak</option>
<option value="America/Anchorage" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Anchorage') echo 'selected="selected"'; ?>>America/Anchorage</option>
<option value="America/Anguilla" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Anguilla') echo 'selected="selected"'; ?>>America/Anguilla</option>
<option value="America/Antigua" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Antigua') echo 'selected="selected"'; ?>>America/Antigua</option>
<option value="America/Araguaina" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Araguaina') echo 'selected="selected"'; ?>>America/Araguaina</option>
<option value="America/Argentina/Buenos_Aires" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/Buenos_Aires') echo 'selected="selected"'; ?>>America/Argentina/Buenos_Aires</option>
<option value="America/Argentina/Catamarca" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/Catamarca') echo 'selected="selected"'; ?>>America/Argentina/Catamarca</option>
<option value="America/Argentina/ComodRivadavia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/ComodRivadavia') echo 'selected="selected"'; ?>>America/Argentina/ComodRivadavia</option>
<option value="America/Argentina/Cordoba" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/Cordoba') echo 'selected="selected"'; ?>>America/Argentina/Cordoba</option>
<option value="America/Argentina/Jujuy" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/Jujuy') echo 'selected="selected"'; ?>>America/Argentina/Jujuy</option>
<option value="America/Argentina/La_Rioja" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/La_Rioja') echo 'selected="selected"'; ?>>America/Argentina/La_Rioja</option>
<option value="America/Argentina/Mendoza" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/Mendoza') echo 'selected="selected"'; ?>>America/Argentina/Mendoza</option>
<option value="America/Argentina/Rio_Gallegos" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/Rio_Gallegos') echo 'selected="selected"'; ?>>America/Argentina/Rio_Gallegos</option>
<option value="America/Argentina/San_Juan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/San_Juan') echo 'selected="selected"'; ?>>America/Argentina/San_Juan</option>
<option value="America/Argentina/San_Luis" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/San_Luis') echo 'selected="selected"'; ?>>America/Argentina/San_Luis</option>
<option value="America/Argentina/Tucuman" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/Tucuman') echo 'selected="selected"'; ?>>America/Argentina/Tucuman</option>
<option value="America/Argentina/Ushuaia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Argentina/Ushuaia') echo 'selected="selected"'; ?>>America/Argentina/Ushuaia</option>
<option value="America/Aruba" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Aruba') echo 'selected="selected"'; ?>>America/Aruba</option>
<option value="America/Asuncion" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Asuncion') echo 'selected="selected"'; ?>>America/Asuncion</option>
<option value="America/Atikokan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Atikokan') echo 'selected="selected"'; ?>>America/Atikokan</option>
<option value="America/Atka" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Atka') echo 'selected="selected"'; ?>>America/Atka</option>
<option value="America/Bahia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Bahia') echo 'selected="selected"'; ?>>America/Bahia</option>
<option value="America/Barbados" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Barbados') echo 'selected="selected"'; ?>>America/Barbados</option>
<option value="America/Belem" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Belem') echo 'selected="selected"'; ?>>America/Belem</option>
<option value="America/Belize" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Belize') echo 'selected="selected"'; ?>>America/Belize</option>
<option value="America/Blanc-Sablon" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Blanc-Sablon') echo 'selected="selected"'; ?>>America/Blanc-Sablon</option>
<option value="America/Boa_Vista" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Boa_Vista') echo 'selected="selected"'; ?>>America/Boa_Vista</option>
<option value="America/Bogota" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Bogota') echo 'selected="selected"'; ?>>America/Bogota</option>
<option value="America/Boise" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Boise') echo 'selected="selected"'; ?>>America/Boise</option>
<option value="America/Buenos_Aires" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Buenos_Aires') echo 'selected="selected"'; ?>>America/Buenos_Aires</option>
<option value="America/Cambridge_Bay" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Cambridge_Bay') echo 'selected="selected"'; ?>>America/Cambridge_Bay</option>
<option value="America/Campo_Grande" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Campo_Grande') echo 'selected="selected"'; ?>>America/Campo_Grande</option>
<option value="America/Cancun" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Cancun') echo 'selected="selected"'; ?>>America/Cancun</option>
<option value="America/Caracas" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Caracas') echo 'selected="selected"'; ?>>America/Caracas</option>
<option value="America/Catamarca" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Catamarca') echo 'selected="selected"'; ?>>America/Catamarca</option>
<option value="America/Cayenne" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Cayenne') echo 'selected="selected"'; ?>>America/Cayenne</option>
<option value="America/Cayman" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Cayman') echo 'selected="selected"'; ?>>America/Cayman</option>
<option value="America/Chicago" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Chicago') echo 'selected="selected"'; ?>>America/Chicago</option>
<option value="America/Chihuahua" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Chihuahua') echo 'selected="selected"'; ?>>America/Chihuahua</option>
<option value="America/Coral_Harbour" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Coral_Harbour') echo 'selected="selected"'; ?>>America/Coral_Harbour</option>
<option value="America/Cordoba" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Cordoba') echo 'selected="selected"'; ?>>America/Cordoba</option>
<option value="America/Costa_Rica" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Costa_Rica') echo 'selected="selected"'; ?>>America/Costa_Rica</option>
<option value="America/Cuiaba" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Cuiaba') echo 'selected="selected"'; ?>>America/Cuiaba</option>
<option value="America/Curacao" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Curacao') echo 'selected="selected"'; ?>>America/Curacao</option>
<option value="America/Danmarkshavn" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Danmarkshavn') echo 'selected="selected"'; ?>>America/Danmarkshavn</option>
<option value="America/Dawson" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Dawson') echo 'selected="selected"'; ?>>America/Dawson</option>
<option value="America/Dawson_Creek" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Dawson_Creek') echo 'selected="selected"'; ?>>America/Dawson_Creek</option>
<option value="America/Denver" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Denver') echo 'selected="selected"'; ?>>America/Denver</option>
<option value="America/Detroit" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Detroit') echo 'selected="selected"'; ?>>America/Detroit</option>
<option value="America/Dominica" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Dominica') echo 'selected="selected"'; ?>>America/Dominica</option>
<option value="America/Edmonton" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Edmonton') echo 'selected="selected"'; ?>>America/Edmonton</option>
<option value="America/Eirunepe" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Eirunepe') echo 'selected="selected"'; ?>>America/Eirunepe</option>
<option value="America/El_Salvador" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/El_Salvador') echo 'selected="selected"'; ?>>America/El_Salvador</option>
<option value="America/Ensenada" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Ensenada') echo 'selected="selected"'; ?>>America/Ensenada</option>
<option value="America/Fort_Wayne" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Fort_Wayne') echo 'selected="selected"'; ?>>America/Fort_Wayne</option>
<option value="America/Fortaleza" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Fortaleza') echo 'selected="selected"'; ?>>America/Fortaleza</option>
<option value="America/Glace_Bay" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Glace_Bay') echo 'selected="selected"'; ?>>America/Glace_Bay</option>
<option value="America/Godthab" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Godthab') echo 'selected="selected"'; ?>>America/Godthab</option>
<option value="America/Goose_Bay" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Goose_Bay') echo 'selected="selected"'; ?>>America/Goose_Bay</option>
<option value="America/Grand_Turk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Grand_Turk') echo 'selected="selected"'; ?>>America/Grand_Turk</option>
<option value="America/Grenada" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Grenada') echo 'selected="selected"'; ?>>America/Grenada</option>
<option value="America/Guadeloupe" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Guadeloupe') echo 'selected="selected"'; ?>>America/Guadeloupe</option>
<option value="America/Guatemala" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Guatemala') echo 'selected="selected"'; ?>>America/Guatemala</option>
<option value="America/Guayaquil" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Guayaquil') echo 'selected="selected"'; ?>>America/Guayaquil</option>
<option value="America/Guyana" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Guyana') echo 'selected="selected"'; ?>>America/Guyana</option>
<option value="America/Halifax" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Halifax') echo 'selected="selected"'; ?>>America/Halifax</option>
<option value="America/Havana" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Havana') echo 'selected="selected"'; ?>>America/Havana</option>
<option value="America/Hermosillo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Hermosillo') echo 'selected="selected"'; ?>>America/Hermosillo</option>
<option value="America/Indiana/Indianapolis" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indiana/Indianapolis') echo 'selected="selected"'; ?>>America/Indiana/Indianapolis</option>
<option value="America/Indiana/Knox" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indiana/Knox') echo 'selected="selected"'; ?>>America/Indiana/Knox</option>
<option value="America/Indiana/Marengo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indiana/Marengo') echo 'selected="selected"'; ?>>America/Indiana/Marengo</option>
<option value="America/Indiana/Petersburg" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indiana/Petersburg') echo 'selected="selected"'; ?>>America/Indiana/Petersburg</option>
<option value="America/Indiana/Tell_City" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indiana/Tell_City') echo 'selected="selected"'; ?>>America/Indiana/Tell_City</option>
<option value="America/Indiana/Vevay" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indiana/Vevay') echo 'selected="selected"'; ?>>America/Indiana/Vevay</option>
<option value="America/Indiana/Vincennes" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indiana/Vincennes') echo 'selected="selected"'; ?>>America/Indiana/Vincennes</option>
<option value="America/Indiana/Winamac" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indiana/Winamac') echo 'selected="selected"'; ?>>America/Indiana/Winamac</option>
<option value="America/Indianapolis" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Indianapolis') echo 'selected="selected"'; ?>>America/Indianapolis</option>
<option value="America/Inuvik" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Inuvik') echo 'selected="selected"'; ?>>America/Inuvik</option>
<option value="America/Iqaluit" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Iqaluit') echo 'selected="selected"'; ?>>America/Iqaluit</option>
<option value="America/Jamaica" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Jamaica') echo 'selected="selected"'; ?>>America/Jamaica</option>
<option value="America/Jujuy" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Jujuy') echo 'selected="selected"'; ?>>America/Jujuy</option>
<option value="America/Juneau" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Juneau') echo 'selected="selected"'; ?>>America/Juneau</option>
<option value="America/Kentucky/Louisville" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Kentucky/Louisville') echo 'selected="selected"'; ?>>America/Kentucky/Louisville</option>
<option value="America/Kentucky/Monticello" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Kentucky/Monticello') echo 'selected="selected"'; ?>>America/Kentucky/Monticello</option>
<option value="America/Knox_IN" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Knox_IN') echo 'selected="selected"'; ?>>America/Knox_IN</option>
<option value="America/La_Paz" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/La_Paz') echo 'selected="selected"'; ?>>America/La_Paz</option>
<option value="America/Lima" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Lima') echo 'selected="selected"'; ?>>America/Lima</option>
<option value="America/Los_Angeles" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Los_Angeles') echo 'selected="selected"'; ?>>America/Los_Angeles</option>
<option value="America/Louisville" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Louisville') echo 'selected="selected"'; ?>>America/Louisville</option>
<option value="America/Maceio" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Maceio') echo 'selected="selected"'; ?>>America/Maceio</option>
<option value="America/Managua" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Managua') echo 'selected="selected"'; ?>>America/Managua</option>
<option value="America/Manaus" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Manaus') echo 'selected="selected"'; ?>>America/Manaus</option>
<option value="America/Marigot" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Marigot') echo 'selected="selected"'; ?>>America/Marigot</option>
<option value="America/Martinique" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Martinique') echo 'selected="selected"'; ?>>America/Martinique</option>
<option value="America/Mazatlan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Mazatlan') echo 'selected="selected"'; ?>>America/Mazatlan</option>
<option value="America/Mendoza" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Mendoza') echo 'selected="selected"'; ?>>America/Mendoza</option>
<option value="America/Menominee" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Menominee') echo 'selected="selected"'; ?>>America/Menominee</option>
<option value="America/Merida" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Merida') echo 'selected="selected"'; ?>>America/Merida</option>
<option value="America/Mexico_City" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Mexico_City') echo 'selected="selected"'; ?>>America/Mexico_City</option>
<option value="America/Miquelon" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Miquelon') echo 'selected="selected"'; ?>>America/Miquelon</option>
<option value="America/Moncton" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Moncton') echo 'selected="selected"'; ?>>America/Moncton</option>
<option value="America/Monterrey" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Monterrey') echo 'selected="selected"'; ?>>America/Monterrey</option>
<option value="America/Montevideo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Montevideo') echo 'selected="selected"'; ?>>America/Montevideo</option>
<option value="America/Montreal" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Montreal') echo 'selected="selected"'; ?>>America/Montreal</option>
<option value="America/Montserrat" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Montserrat') echo 'selected="selected"'; ?>>America/Montserrat</option>
<option value="America/Nassau" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Nassau') echo 'selected="selected"'; ?>>America/Nassau</option>
<option value="America/New_York" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/New_York') echo 'selected="selected"'; ?>>America/New_York</option>
<option value="America/Nipigon" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Nipigon') echo 'selected="selected"'; ?>>America/Nipigon</option>
<option value="America/Nome" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Nome') echo 'selected="selected"'; ?>>America/Nome</option>
<option value="America/Noronha" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Noronha') echo 'selected="selected"'; ?>>America/Noronha</option>
<option value="America/North_Dakota/Center" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/North_Dakota/Center') echo 'selected="selected"'; ?>>America/North_Dakota/Center</option>
<option value="America/North_Dakota/New_Salem" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/North_Dakota/New_Salem') echo 'selected="selected"'; ?>>America/North_Dakota/New_Salem</option>
<option value="America/Panama" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Panama') echo 'selected="selected"'; ?>>America/Panama</option>
<option value="America/Pangnirtung" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Pangnirtung') echo 'selected="selected"'; ?>>America/Pangnirtung</option>
<option value="America/Paramaribo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Paramaribo') echo 'selected="selected"'; ?>>America/Paramaribo</option>
<option value="America/Phoenix" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Phoenix') echo 'selected="selected"'; ?>>America/Phoenix</option>
<option value="America/Port-au-Prince" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Port-au-Prince') echo 'selected="selected"'; ?>>America/Port-au-Prince</option>
<option value="America/Port_of_Spain" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Port_of_Spain') echo 'selected="selected"'; ?>>America/Port_of_Spain</option>
<option value="America/Porto_Acre" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Porto_Acre') echo 'selected="selected"'; ?>>America/Porto_Acre</option>
<option value="America/Porto_Velho" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Porto_Velho') echo 'selected="selected"'; ?>>America/Porto_Velho</option>
<option value="America/Puerto_Rico" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Puerto_Rico') echo 'selected="selected"'; ?>>America/Puerto_Rico</option>
<option value="America/Rainy_River" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Rainy_River') echo 'selected="selected"'; ?>>America/Rainy_River</option>
<option value="America/Rankin_Inlet" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Rankin_Inlet') echo 'selected="selected"'; ?>>America/Rankin_Inlet</option>
<option value="America/Recife" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Recife') echo 'selected="selected"'; ?>>America/Recife</option>
<option value="America/Regina" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Regina') echo 'selected="selected"'; ?>>America/Regina</option>
<option value="America/Resolute" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Resolute') echo 'selected="selected"'; ?>>America/Resolute</option>
<option value="America/Rio_Branco" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Rio_Branco') echo 'selected="selected"'; ?>>America/Rio_Branco</option>
<option value="America/Rosario" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Rosario') echo 'selected="selected"'; ?>>America/Rosario</option>
<option value="America/Santiago" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Santiago') echo 'selected="selected"'; ?>>America/Santiago</option>
<option value="America/Santo_Domingo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Santo_Domingo') echo 'selected="selected"'; ?>>America/Santo_Domingo</option>
<option value="America/Sao_Paulo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Sao_Paulo') echo 'selected="selected"'; ?>>America/Sao_Paulo</option>
<option value="America/Scoresbysund" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Scoresbysund') echo 'selected="selected"'; ?>>America/Scoresbysund</option>
<option value="America/Shiprock" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Shiprock') echo 'selected="selected"'; ?>>America/Shiprock</option>
<option value="America/St_Barthelemy" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/St_Barthelemy') echo 'selected="selected"'; ?>>America/St_Barthelemy</option>
<option value="America/St_Johns" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/St_Johns') echo 'selected="selected"'; ?>>America/St_Johns</option>
<option value="America/St_Kitts" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/St_Kitts') echo 'selected="selected"'; ?>>America/St_Kitts</option>
<option value="America/St_Lucia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/St_Lucia') echo 'selected="selected"'; ?>>America/St_Lucia</option>
<option value="America/St_Thomas" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/St_Thomas') echo 'selected="selected"'; ?>>America/St_Thomas</option>
<option value="America/St_Vincent" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/St_Vincent') echo 'selected="selected"'; ?>>America/St_Vincent</option>
<option value="America/Swift_Current" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Swift_Current') echo 'selected="selected"'; ?>>America/Swift_Current</option>
<option value="America/Tegucigalpa" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Tegucigalpa') echo 'selected="selected"'; ?>>America/Tegucigalpa</option>
<option value="America/Thule" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Thule') echo 'selected="selected"'; ?>>America/Thule</option>
<option value="America/Thunder_Bay" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Thunder_Bay') echo 'selected="selected"'; ?>>America/Thunder_Bay</option>
<option value="America/Tijuana" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Tijuana') echo 'selected="selected"'; ?>>America/Tijuana</option>
<option value="America/Toronto" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Toronto') echo 'selected="selected"'; ?>>America/Toronto</option>
<option value="America/Tortola" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Tortola') echo 'selected="selected"'; ?>>America/Tortola</option>
<option value="America/Vancouver" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Vancouver') echo 'selected="selected"'; ?>>America/Vancouver</option>
<option value="America/Virgin" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Virgin') echo 'selected="selected"'; ?>>America/Virgin</option>
<option value="America/Whitehorse" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Whitehorse') echo 'selected="selected"'; ?>>America/Whitehorse</option>
<option value="America/Winnipeg" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Winnipeg') echo 'selected="selected"'; ?>>America/Winnipeg</option>
<option value="America/Yakutat" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Yakutat') echo 'selected="selected"'; ?>>America/Yakutat</option>
<option value="America/Yellowknife" <?php if ($GLOBALS['Form_TIMEZONE'] == 'America/Yellowknife') echo 'selected="selected"'; ?>>America/Yellowknife</option>
<option value="Antarctica/Casey" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/Casey') echo 'selected="selected"'; ?>>Antarctica/Casey</option>
<option value="Antarctica/Davis" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/Davis') echo 'selected="selected"'; ?>>Antarctica/Davis</option>
<option value="Antarctica/DumontDUrville" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/DumontDUrville') echo 'selected="selected"'; ?>>Antarctica/DumontDUrville</option>
<option value="Antarctica/Mawson" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/Mawson') echo 'selected="selected"'; ?>>Antarctica/Mawson</option>
<option value="Antarctica/McMurdo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/McMurdo') echo 'selected="selected"'; ?>>Antarctica/McMurdo</option>
<option value="Antarctica/Palmer" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/Palmer') echo 'selected="selected"'; ?>>Antarctica/Palmer</option>
<option value="Antarctica/Rothera" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/Rothera') echo 'selected="selected"'; ?>>Antarctica/Rothera</option>
<option value="Antarctica/South_Pole" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/South_Pole') echo 'selected="selected"'; ?>>Antarctica/South_Pole</option>
<option value="Antarctica/Syowa" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/Syowa') echo 'selected="selected"'; ?>>Antarctica/Syowa</option>
<option value="Antarctica/Vostok" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Antarctica/Vostok') echo 'selected="selected"'; ?>>Antarctica/Vostok</option>
<option value="Arctic/Longyearbyen" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Arctic/Longyearbyen') echo 'selected="selected"'; ?>>Arctic/Longyearbyen</option>
<option value="Asia/Aden" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Aden') echo 'selected="selected"'; ?>>Asia/Aden</option>
<option value="Asia/Almaty" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Almaty') echo 'selected="selected"'; ?>>Asia/Almaty</option>
<option value="Asia/Amman" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Amman') echo 'selected="selected"'; ?>>Asia/Amman</option>
<option value="Asia/Anadyr" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Anadyr') echo 'selected="selected"'; ?>>Asia/Anadyr</option>
<option value="Asia/Aqtau" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Aqtau') echo 'selected="selected"'; ?>>Asia/Aqtau</option>
<option value="Asia/Aqtobe" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Aqtobe') echo 'selected="selected"'; ?>>Asia/Aqtobe</option>
<option value="Asia/Ashgabat" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Ashgabat') echo 'selected="selected"'; ?>>Asia/Ashgabat</option>
<option value="Asia/Ashkhabad" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Ashkhabad') echo 'selected="selected"'; ?>>Asia/Ashkhabad</option>
<option value="Asia/Baghdad" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Baghdad') echo 'selected="selected"'; ?>>Asia/Baghdad</option>
<option value="Asia/Bahrain" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Bahrain') echo 'selected="selected"'; ?>>Asia/Bahrain</option>
<option value="Asia/Baku" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Baku') echo 'selected="selected"'; ?>>Asia/Baku</option>
<option value="Asia/Bangkok" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Bangkok') echo 'selected="selected"'; ?>>Asia/Bangkok</option>
<option value="Asia/Beirut" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Beirut') echo 'selected="selected"'; ?>>Asia/Beirut</option>
<option value="Asia/Bishkek" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Bishkek') echo 'selected="selected"'; ?>>Asia/Bishkek</option>
<option value="Asia/Brunei" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Brunei') echo 'selected="selected"'; ?>>Asia/Brunei</option>
<option value="Asia/Calcutta" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Calcutta') echo 'selected="selected"'; ?>>Asia/Calcutta</option>
<option value="Asia/Choibalsan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Choibalsan') echo 'selected="selected"'; ?>>Asia/Choibalsan</option>
<option value="Asia/Chongqing" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Chongqing') echo 'selected="selected"'; ?>>Asia/Chongqing</option>
<option value="Asia/Chungking" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Chungking') echo 'selected="selected"'; ?>>Asia/Chungking</option>
<option value="Asia/Colombo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Colombo') echo 'selected="selected"'; ?>>Asia/Colombo</option>
<option value="Asia/Dacca" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Dacca') echo 'selected="selected"'; ?>>Asia/Dacca</option>
<option value="Asia/Damascus" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Damascus') echo 'selected="selected"'; ?>>Asia/Damascus</option>
<option value="Asia/Dhaka" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Dhaka') echo 'selected="selected"'; ?>>Asia/Dhaka</option>
<option value="Asia/Dili" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Dili') echo 'selected="selected"'; ?>>Asia/Dili</option>
<option value="Asia/Dubai" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Dubai') echo 'selected="selected"'; ?>>Asia/Dubai</option>
<option value="Asia/Dushanbe" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Dushanbe') echo 'selected="selected"'; ?>>Asia/Dushanbe</option>
<option value="Asia/Gaza" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Gaza') echo 'selected="selected"'; ?>>Asia/Gaza</option>
<option value="Asia/Harbin" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Harbin') echo 'selected="selected"'; ?>>Asia/Harbin</option>
<option value="Asia/Ho_Chi_Minh" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Ho_Chi_Minh') echo 'selected="selected"'; ?>>Asia/Ho_Chi_Minh</option>
<option value="Asia/Hong_Kong" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Hong_Kong') echo 'selected="selected"'; ?>>Asia/Hong_Kong</option>
<option value="Asia/Hovd" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Hovd') echo 'selected="selected"'; ?>>Asia/Hovd</option>
<option value="Asia/Irkutsk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Irkutsk') echo 'selected="selected"'; ?>>Asia/Irkutsk</option>
<option value="Asia/Istanbul" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Istanbul') echo 'selected="selected"'; ?>>Asia/Istanbul</option>
<option value="Asia/Jakarta" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Jakarta') echo 'selected="selected"'; ?>>Asia/Jakarta</option>
<option value="Asia/Jayapura" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Jayapura') echo 'selected="selected"'; ?>>Asia/Jayapura</option>
<option value="Asia/Jerusalem" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Jerusalem') echo 'selected="selected"'; ?>>Asia/Jerusalem</option>
<option value="Asia/Kabul" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Kabul') echo 'selected="selected"'; ?>>Asia/Kabul</option>
<option value="Asia/Kamchatka" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Kamchatka') echo 'selected="selected"'; ?>>Asia/Kamchatka</option>
<option value="Asia/Karachi" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Karachi') echo 'selected="selected"'; ?>>Asia/Karachi</option>
<option value="Asia/Kashgar" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Kashgar') echo 'selected="selected"'; ?>>Asia/Kashgar</option>
<option value="Asia/Katmandu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Katmandu') echo 'selected="selected"'; ?>>Asia/Katmandu</option>
<option value="Asia/Kolkata" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Kolkata') echo 'selected="selected"'; ?>>Asia/Kolkata</option>
<option value="Asia/Krasnoyarsk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Krasnoyarsk') echo 'selected="selected"'; ?>>Asia/Krasnoyarsk</option>
<option value="Asia/Kuala_Lumpur" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Kuala_Lumpur') echo 'selected="selected"'; ?>>Asia/Kuala_Lumpur</option>
<option value="Asia/Kuching" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Kuching') echo 'selected="selected"'; ?>>Asia/Kuching</option>
<option value="Asia/Kuwait" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Kuwait') echo 'selected="selected"'; ?>>Asia/Kuwait</option>
<option value="Asia/Macao" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Macao') echo 'selected="selected"'; ?>>Asia/Macao</option>
<option value="Asia/Macau" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Macau') echo 'selected="selected"'; ?>>Asia/Macau</option>
<option value="Asia/Magadan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Magadan') echo 'selected="selected"'; ?>>Asia/Magadan</option>
<option value="Asia/Makassar" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Makassar') echo 'selected="selected"'; ?>>Asia/Makassar</option>
<option value="Asia/Manila" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Manila') echo 'selected="selected"'; ?>>Asia/Manila</option>
<option value="Asia/Muscat" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Muscat') echo 'selected="selected"'; ?>>Asia/Muscat</option>
<option value="Asia/Nicosia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Nicosia') echo 'selected="selected"'; ?>>Asia/Nicosia</option>
<option value="Asia/Novosibirsk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Novosibirsk') echo 'selected="selected"'; ?>>Asia/Novosibirsk</option>
<option value="Asia/Omsk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Omsk') echo 'selected="selected"'; ?>>Asia/Omsk</option>
<option value="Asia/Oral" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Oral') echo 'selected="selected"'; ?>>Asia/Oral</option>
<option value="Asia/Phnom_Penh" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Phnom_Penh') echo 'selected="selected"'; ?>>Asia/Phnom_Penh</option>
<option value="Asia/Pontianak" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Pontianak') echo 'selected="selected"'; ?>>Asia/Pontianak</option>
<option value="Asia/Pyongyang" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Pyongyang') echo 'selected="selected"'; ?>>Asia/Pyongyang</option>
<option value="Asia/Qatar" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Qatar') echo 'selected="selected"'; ?>>Asia/Qatar</option>
<option value="Asia/Qyzylorda" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Qyzylorda') echo 'selected="selected"'; ?>>Asia/Qyzylorda</option>
<option value="Asia/Rangoon" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Rangoon') echo 'selected="selected"'; ?>>Asia/Rangoon</option>
<option value="Asia/Riyadh" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Riyadh') echo 'selected="selected"'; ?>>Asia/Riyadh</option>
<option value="Asia/Saigon" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Saigon') echo 'selected="selected"'; ?>>Asia/Saigon</option>
<option value="Asia/Sakhalin" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Sakhalin') echo 'selected="selected"'; ?>>Asia/Sakhalin</option>
<option value="Asia/Samarkand" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Samarkand') echo 'selected="selected"'; ?>>Asia/Samarkand</option>
<option value="Asia/Seoul" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Seoul') echo 'selected="selected"'; ?>>Asia/Seoul</option>
<option value="Asia/Shanghai" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Shanghai') echo 'selected="selected"'; ?>>Asia/Shanghai</option>
<option value="Asia/Singapore" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Singapore') echo 'selected="selected"'; ?>>Asia/Singapore</option>
<option value="Asia/Taipei" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Taipei') echo 'selected="selected"'; ?>>Asia/Taipei</option>
<option value="Asia/Tashkent" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Tashkent') echo 'selected="selected"'; ?>>Asia/Tashkent</option>
<option value="Asia/Tbilisi" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Tbilisi') echo 'selected="selected"'; ?>>Asia/Tbilisi</option>
<option value="Asia/Tehran" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Tehran') echo 'selected="selected"'; ?>>Asia/Tehran</option>
<option value="Asia/Tel_Aviv" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Tel_Aviv') echo 'selected="selected"'; ?>>Asia/Tel_Aviv</option>
<option value="Asia/Thimbu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Thimbu') echo 'selected="selected"'; ?>>Asia/Thimbu</option>
<option value="Asia/Thimphu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Thimphu') echo 'selected="selected"'; ?>>Asia/Thimphu</option>
<option value="Asia/Tokyo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Tokyo') echo 'selected="selected"'; ?>>Asia/Tokyo</option>
<option value="Asia/Ujung_Pandang" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Ujung_Pandang') echo 'selected="selected"'; ?>>Asia/Ujung_Pandang</option>
<option value="Asia/Ulaanbaatar" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Ulaanbaatar') echo 'selected="selected"'; ?>>Asia/Ulaanbaatar</option>
<option value="Asia/Ulan_Bator" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Ulan_Bator') echo 'selected="selected"'; ?>>Asia/Ulan_Bator</option>
<option value="Asia/Urumqi" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Urumqi') echo 'selected="selected"'; ?>>Asia/Urumqi</option>
<option value="Asia/Vientiane" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Vientiane') echo 'selected="selected"'; ?>>Asia/Vientiane</option>
<option value="Asia/Vladivostok" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Vladivostok') echo 'selected="selected"'; ?>>Asia/Vladivostok</option>
<option value="Asia/Yakutsk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Yakutsk') echo 'selected="selected"'; ?>>Asia/Yakutsk</option>
<option value="Asia/Yekaterinburg" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Yekaterinburg') echo 'selected="selected"'; ?>>Asia/Yekaterinburg</option>
<option value="Asia/Yerevan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Asia/Yerevan') echo 'selected="selected"'; ?>>Asia/Yerevan</option>
<option value="Atlantic/Azores" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Azores') echo 'selected="selected"'; ?>>Atlantic/Azores</option>
<option value="Atlantic/Bermuda" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Bermuda') echo 'selected="selected"'; ?>>Atlantic/Bermuda</option>
<option value="Atlantic/Canary" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Canary') echo 'selected="selected"'; ?>>Atlantic/Canary</option>
<option value="Atlantic/Cape_Verde" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Cape_Verde') echo 'selected="selected"'; ?>>Atlantic/Cape_Verde</option>
<option value="Atlantic/Faeroe" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Faeroe') echo 'selected="selected"'; ?>>Atlantic/Faeroe</option>
<option value="Atlantic/Faroe" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Faroe') echo 'selected="selected"'; ?>>Atlantic/Faroe</option>
<option value="Atlantic/Jan_Mayen" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Jan_Mayen') echo 'selected="selected"'; ?>>Atlantic/Jan_Mayen</option>
<option value="Atlantic/Madeira" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Madeira') echo 'selected="selected"'; ?>>Atlantic/Madeira</option>
<option value="Atlantic/Reykjavik" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Reykjavik') echo 'selected="selected"'; ?>>Atlantic/Reykjavik</option>
<option value="Atlantic/South_Georgia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/South_Georgia') echo 'selected="selected"'; ?>>Atlantic/South_Georgia</option>
<option value="Atlantic/St_Helena" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/St_Helena') echo 'selected="selected"'; ?>>Atlantic/St_Helena</option>
<option value="Atlantic/Stanley" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Atlantic/Stanley') echo 'selected="selected"'; ?>>Atlantic/Stanley</option>
<option value="Australia/ACT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/ACT') echo 'selected="selected"'; ?>>Australia/ACT</option>
<option value="Australia/Adelaide" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Adelaide') echo 'selected="selected"'; ?>>Australia/Adelaide</option>
<option value="Australia/Brisbane" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Brisbane') echo 'selected="selected"'; ?>>Australia/Brisbane</option>
<option value="Australia/Broken_Hill" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Broken_Hill') echo 'selected="selected"'; ?>>Australia/Broken_Hill</option>
<option value="Australia/Canberra" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Canberra') echo 'selected="selected"'; ?>>Australia/Canberra</option>
<option value="Australia/Currie" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Currie') echo 'selected="selected"'; ?>>Australia/Currie</option>
<option value="Australia/Darwin" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Darwin') echo 'selected="selected"'; ?>>Australia/Darwin</option>
<option value="Australia/Eucla" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Eucla') echo 'selected="selected"'; ?>>Australia/Eucla</option>
<option value="Australia/Hobart" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Hobart') echo 'selected="selected"'; ?>>Australia/Hobart</option>
<option value="Australia/LHI" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/LHI') echo 'selected="selected"'; ?>>Australia/LHI</option>
<option value="Australia/Lindeman" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Lindeman') echo 'selected="selected"'; ?>>Australia/Lindeman</option>
<option value="Australia/Lord_Howe" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Lord_Howe') echo 'selected="selected"'; ?>>Australia/Lord_Howe</option>
<option value="Australia/Melbourne" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Melbourne') echo 'selected="selected"'; ?>>Australia/Melbourne</option>
<option value="Australia/North" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/North') echo 'selected="selected"'; ?>>Australia/North</option>
<option value="Australia/NSW" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/NSW') echo 'selected="selected"'; ?>>Australia/NSW</option>
<option value="Australia/Perth" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Perth') echo 'selected="selected"'; ?>>Australia/Perth</option>
<option value="Australia/Queensland" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Queensland') echo 'selected="selected"'; ?>>Australia/Queensland</option>
<option value="Australia/South" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/South') echo 'selected="selected"'; ?>>Australia/South</option>
<option value="Australia/Sydney" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Sydney') echo 'selected="selected"'; ?>>Australia/Sydney</option>
<option value="Australia/Tasmania" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Tasmania') echo 'selected="selected"'; ?>>Australia/Tasmania</option>
<option value="Australia/Victoria" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Victoria') echo 'selected="selected"'; ?>>Australia/Victoria</option>
<option value="Australia/West" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/West') echo 'selected="selected"'; ?>>Australia/West</option>
<option value="Australia/Yancowinna" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Australia/Yancowinna') echo 'selected="selected"'; ?>>Australia/Yancowinna</option>
<option value="Brazil/Acre" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Brazil/Acre') echo 'selected="selected"'; ?>>Brazil/Acre</option>
<option value="Brazil/DeNoronha" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Brazil/DeNoronha') echo 'selected="selected"'; ?>>Brazil/DeNoronha</option>
<option value="Brazil/East" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Brazil/East') echo 'selected="selected"'; ?>>Brazil/East</option>
<option value="Brazil/West" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Brazil/West') echo 'selected="selected"'; ?>>Brazil/West</option>
<option value="Canada/Atlantic" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/Atlantic') echo 'selected="selected"'; ?>>Canada/Atlantic</option>
<option value="Canada/Central" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/Central') echo 'selected="selected"'; ?>>Canada/Central</option>
<option value="Canada/East-Saskatchewan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/East-Saskatchewan') echo 'selected="selected"'; ?>>Canada/East-Saskatchewan</option>
<option value="Canada/Eastern" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/Eastern') echo 'selected="selected"'; ?>>Canada/Eastern</option>
<option value="Canada/Mountain" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/Mountain') echo 'selected="selected"'; ?>>Canada/Mountain</option>
<option value="Canada/Newfoundland" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/Newfoundland') echo 'selected="selected"'; ?>>Canada/Newfoundland</option>
<option value="Canada/Pacific" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/Pacific') echo 'selected="selected"'; ?>>Canada/Pacific</option>
<option value="Canada/Saskatchewan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/Saskatchewan') echo 'selected="selected"'; ?>>Canada/Saskatchewan</option>
<option value="Canada/Yukon" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Canada/Yukon') echo 'selected="selected"'; ?>>Canada/Yukon</option>
<option value="CET" <?php if ($GLOBALS['Form_TIMEZONE'] == 'CET') echo 'selected="selected"'; ?>>CET</option>
<option value="Chile/Continental" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Chile/Continental') echo 'selected="selected"'; ?>>Chile/Continental</option>
<option value="Chile/EasterIsland" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Chile/EasterIsland') echo 'selected="selected"'; ?>>Chile/EasterIsland</option>
<option value="CST6CDT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'CST6CDT') echo 'selected="selected"'; ?>>CST6CDT</option>
<option value="Cuba" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Cuba') echo 'selected="selected"'; ?>>Cuba</option>
<option value="EET" <?php if ($GLOBALS['Form_TIMEZONE'] == 'EET') echo 'selected="selected"'; ?>>EET</option>
<option value="Egypt" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Egypt') echo 'selected="selected"'; ?>>Egypt</option>
<option value="Eire" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Eire') echo 'selected="selected"'; ?>>Eire</option>
<option value="EST" <?php if ($GLOBALS['Form_TIMEZONE'] == 'EST') echo 'selected="selected"'; ?>>EST</option>
<option value="EST5EDT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'EST5EDT') echo 'selected="selected"'; ?>>EST5EDT</option>
<option value="Etc/GMT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT') echo 'selected="selected"'; ?>>Etc/GMT</option>
<option value="Etc/GMT+0" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+0') echo 'selected="selected"'; ?>>Etc/GMT+0</option>
<option value="Etc/GMT+1" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+1') echo 'selected="selected"'; ?>>Etc/GMT+1</option>
<option value="Etc/GMT+10" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+10') echo 'selected="selected"'; ?>>Etc/GMT+10</option>
<option value="Etc/GMT+11" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+11') echo 'selected="selected"'; ?>>Etc/GMT+11</option>
<option value="Etc/GMT+12" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+12') echo 'selected="selected"'; ?>>Etc/GMT+12</option>
<option value="Etc/GMT+2" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+2') echo 'selected="selected"'; ?>>Etc/GMT+2</option>
<option value="Etc/GMT+3" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+3') echo 'selected="selected"'; ?>>Etc/GMT+3</option>
<option value="Etc/GMT+4" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+4') echo 'selected="selected"'; ?>>Etc/GMT+4</option>
<option value="Etc/GMT+5" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+5') echo 'selected="selected"'; ?>>Etc/GMT+5</option>
<option value="Etc/GMT+6" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+6') echo 'selected="selected"'; ?>>Etc/GMT+6</option>
<option value="Etc/GMT+7" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+7') echo 'selected="selected"'; ?>>Etc/GMT+7</option>
<option value="Etc/GMT+8" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+8') echo 'selected="selected"'; ?>>Etc/GMT+8</option>
<option value="Etc/GMT+9" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT+9') echo 'selected="selected"'; ?>>Etc/GMT+9</option>
<option value="Etc/GMT-0" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-0') echo 'selected="selected"'; ?>>Etc/GMT-0</option>
<option value="Etc/GMT-1" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-1') echo 'selected="selected"'; ?>>Etc/GMT-1</option>
<option value="Etc/GMT-10" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-10') echo 'selected="selected"'; ?>>Etc/GMT-10</option>
<option value="Etc/GMT-11" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-11') echo 'selected="selected"'; ?>>Etc/GMT-11</option>
<option value="Etc/GMT-12" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-12') echo 'selected="selected"'; ?>>Etc/GMT-12</option>
<option value="Etc/GMT-13" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-13') echo 'selected="selected"'; ?>>Etc/GMT-13</option>
<option value="Etc/GMT-14" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-14') echo 'selected="selected"'; ?>>Etc/GMT-14</option>
<option value="Etc/GMT-2" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-2') echo 'selected="selected"'; ?>>Etc/GMT-2</option>
<option value="Etc/GMT-3" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-3') echo 'selected="selected"'; ?>>Etc/GMT-3</option>
<option value="Etc/GMT-4" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-4') echo 'selected="selected"'; ?>>Etc/GMT-4</option>
<option value="Etc/GMT-5" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-5') echo 'selected="selected"'; ?>>Etc/GMT-5</option>
<option value="Etc/GMT-6" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-6') echo 'selected="selected"'; ?>>Etc/GMT-6</option>
<option value="Etc/GMT-7" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-7') echo 'selected="selected"'; ?>>Etc/GMT-7</option>
<option value="Etc/GMT-8" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-8') echo 'selected="selected"'; ?>>Etc/GMT-8</option>
<option value="Etc/GMT-9" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT-9') echo 'selected="selected"'; ?>>Etc/GMT-9</option>
<option value="Etc/GMT0" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/GMT0') echo 'selected="selected"'; ?>>Etc/GMT0</option>
<option value="Etc/Greenwich" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/Greenwich') echo 'selected="selected"'; ?>>Etc/Greenwich</option>
<option value="Etc/UCT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/UCT') echo 'selected="selected"'; ?>>Etc/UCT</option>
<option value="Etc/Universal" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/Universal') echo 'selected="selected"'; ?>>Etc/Universal</option>
<option value="Etc/UTC" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/UTC') echo 'selected="selected"'; ?>>Etc/UTC</option>
<option value="Etc/Zulu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Etc/Zulu') echo 'selected="selected"'; ?>>Etc/Zulu</option>
<option value="Europe/Amsterdam" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Amsterdam') echo 'selected="selected"'; ?>>Europe/Amsterdam</option>
<option value="Europe/Andorra" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Andorra') echo 'selected="selected"'; ?>>Europe/Andorra</option>
<option value="Europe/Athens" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Athens') echo 'selected="selected"'; ?>>Europe/Athens</option>
<option value="Europe/Belfast" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Belfast') echo 'selected="selected"'; ?>>Europe/Belfast</option>
<option value="Europe/Belgrade" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Belgrade') echo 'selected="selected"'; ?>>Europe/Belgrade</option>
<option value="Europe/Berlin" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Berlin') echo 'selected="selected"'; ?>>Europe/Berlin</option>
<option value="Europe/Bratislava" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Bratislava') echo 'selected="selected"'; ?>>Europe/Bratislava</option>
<option value="Europe/Brussels" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Brussels') echo 'selected="selected"'; ?>>Europe/Brussels</option>
<option value="Europe/Bucharest" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Bucharest') echo 'selected="selected"'; ?>>Europe/Bucharest</option>
<option value="Europe/Budapest" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Budapest') echo 'selected="selected"'; ?>>Europe/Budapest</option>
<option value="Europe/Chisinau" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Chisinau') echo 'selected="selected"'; ?>>Europe/Chisinau</option>
<option value="Europe/Copenhagen" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Copenhagen') echo 'selected="selected"'; ?>>Europe/Copenhagen</option>
<option value="Europe/Dublin" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Dublin') echo 'selected="selected"'; ?>>Europe/Dublin</option>
<option value="Europe/Gibraltar" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Gibraltar') echo 'selected="selected"'; ?>>Europe/Gibraltar</option>
<option value="Europe/Guernsey" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Guernsey') echo 'selected="selected"'; ?>>Europe/Guernsey</option>
<option value="Europe/Helsinki" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Helsinki') echo 'selected="selected"'; ?>>Europe/Helsinki</option>
<option value="Europe/Isle_of_Man" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Isle_of_Man') echo 'selected="selected"'; ?>>Europe/Isle_of_Man</option>
<option value="Europe/Istanbul" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Istanbul') echo 'selected="selected"'; ?>>Europe/Istanbul</option>
<option value="Europe/Jersey" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Jersey') echo 'selected="selected"'; ?>>Europe/Jersey</option>
<option value="Europe/Kaliningrad" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Kaliningrad') echo 'selected="selected"'; ?>>Europe/Kaliningrad</option>
<option value="Europe/Kiev" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Kiev') echo 'selected="selected"'; ?>>Europe/Kiev</option>
<option value="Europe/Lisbon" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Lisbon') echo 'selected="selected"'; ?>>Europe/Lisbon</option>
<option value="Europe/Ljubljana" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Ljubljana') echo 'selected="selected"'; ?>>Europe/Ljubljana</option>
<option value="Europe/London" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/London') echo 'selected="selected"'; ?>>Europe/London</option>
<option value="Europe/Luxembourg" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Luxembourg') echo 'selected="selected"'; ?>>Europe/Luxembourg</option>
<option value="Europe/Madrid" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Madrid') echo 'selected="selected"'; ?>>Europe/Madrid</option>
<option value="Europe/Malta" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Malta') echo 'selected="selected"'; ?>>Europe/Malta</option>
<option value="Europe/Mariehamn" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Mariehamn') echo 'selected="selected"'; ?>>Europe/Mariehamn</option>
<option value="Europe/Minsk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Minsk') echo 'selected="selected"'; ?>>Europe/Minsk</option>
<option value="Europe/Monaco" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Monaco') echo 'selected="selected"'; ?>>Europe/Monaco</option>
<option value="Europe/Moscow" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Moscow') echo 'selected="selected"'; ?>>Europe/Moscow</option>
<option value="Europe/Nicosia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Nicosia') echo 'selected="selected"'; ?>>Europe/Nicosia</option>
<option value="Europe/Oslo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Oslo') echo 'selected="selected"'; ?>>Europe/Oslo</option>
<option value="Europe/Paris" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Paris') echo 'selected="selected"'; ?>>Europe/Paris</option>
<option value="Europe/Podgorica" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Podgorica') echo 'selected="selected"'; ?>>Europe/Podgorica</option>
<option value="Europe/Prague" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Prague') echo 'selected="selected"'; ?>>Europe/Prague</option>
<option value="Europe/Riga" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Riga') echo 'selected="selected"'; ?>>Europe/Riga</option>
<option value="Europe/Rome" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Rome') echo 'selected="selected"'; ?>>Europe/Rome</option>
<option value="Europe/Samara" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Samara') echo 'selected="selected"'; ?>>Europe/Samara</option>
<option value="Europe/San_Marino" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/San_Marino') echo 'selected="selected"'; ?>>Europe/San_Marino</option>
<option value="Europe/Sarajevo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Sarajevo') echo 'selected="selected"'; ?>>Europe/Sarajevo</option>
<option value="Europe/Simferopol" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Simferopol') echo 'selected="selected"'; ?>>Europe/Simferopol</option>
<option value="Europe/Skopje" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Skopje') echo 'selected="selected"'; ?>>Europe/Skopje</option>
<option value="Europe/Sofia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Sofia') echo 'selected="selected"'; ?>>Europe/Sofia</option>
<option value="Europe/Stockholm" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Stockholm') echo 'selected="selected"'; ?>>Europe/Stockholm</option>
<option value="Europe/Tallinn" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Tallinn') echo 'selected="selected"'; ?>>Europe/Tallinn</option>
<option value="Europe/Tirane" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Tirane') echo 'selected="selected"'; ?>>Europe/Tirane</option>
<option value="Europe/Tiraspol" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Tiraspol') echo 'selected="selected"'; ?>>Europe/Tiraspol</option>
<option value="Europe/Uzhgorod" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Uzhgorod') echo 'selected="selected"'; ?>>Europe/Uzhgorod</option>
<option value="Europe/Vaduz" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Vaduz') echo 'selected="selected"'; ?>>Europe/Vaduz</option>
<option value="Europe/Vatican" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Vatican') echo 'selected="selected"'; ?>>Europe/Vatican</option>
<option value="Europe/Vienna" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Vienna') echo 'selected="selected"'; ?>>Europe/Vienna</option>
<option value="Europe/Vilnius" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Vilnius') echo 'selected="selected"'; ?>>Europe/Vilnius</option>
<option value="Europe/Volgograd" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Volgograd') echo 'selected="selected"'; ?>>Europe/Volgograd</option>
<option value="Europe/Warsaw" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Warsaw') echo 'selected="selected"'; ?>>Europe/Warsaw</option>
<option value="Europe/Zagreb" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Zagreb') echo 'selected="selected"'; ?>>Europe/Zagreb</option>
<option value="Europe/Zaporozhye" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Zaporozhye') echo 'selected="selected"'; ?>>Europe/Zaporozhye</option>
<option value="Europe/Zurich" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Europe/Zurich') echo 'selected="selected"'; ?>>Europe/Zurich</option>
<option value="Factory" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Factory') echo 'selected="selected"'; ?>>Factory</option>
<option value="GB" <?php if ($GLOBALS['Form_TIMEZONE'] == 'GB') echo 'selected="selected"'; ?>>GB</option>
<option value="GB-Eire" <?php if ($GLOBALS['Form_TIMEZONE'] == 'GB-Eire') echo 'selected="selected"'; ?>>GB-Eire</option>
<option value="GMT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'GMT') echo 'selected="selected"'; ?>>GMT</option>
<option value="GMT+0" <?php if ($GLOBALS['Form_TIMEZONE'] == 'GMT+0') echo 'selected="selected"'; ?>>GMT+0</option>
<option value="GMT-0" <?php if ($GLOBALS['Form_TIMEZONE'] == 'GMT-0') echo 'selected="selected"'; ?>>GMT-0</option>
<option value="GMT0" <?php if ($GLOBALS['Form_TIMEZONE'] == 'GMT0') echo 'selected="selected"'; ?>>GMT0</option>
<option value="Greenwich" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Greenwich') echo 'selected="selected"'; ?>>Greenwich</option>
<option value="Hongkong" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Hongkong') echo 'selected="selected"'; ?>>Hongkong</option>
<option value="HST" <?php if ($GLOBALS['Form_TIMEZONE'] == 'HST') echo 'selected="selected"'; ?>>HST</option>
<option value="Iceland" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Iceland') echo 'selected="selected"'; ?>>Iceland</option>
<option value="Indian/Antananarivo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Antananarivo') echo 'selected="selected"'; ?>>Indian/Antananarivo</option>
<option value="Indian/Chagos" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Chagos') echo 'selected="selected"'; ?>>Indian/Chagos</option>
<option value="Indian/Christmas" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Christmas') echo 'selected="selected"'; ?>>Indian/Christmas</option>
<option value="Indian/Cocos" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Cocos') echo 'selected="selected"'; ?>>Indian/Cocos</option>
<option value="Indian/Comoro" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Comoro') echo 'selected="selected"'; ?>>Indian/Comoro</option>
<option value="Indian/Kerguelen" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Kerguelen') echo 'selected="selected"'; ?>>Indian/Kerguelen</option>
<option value="Indian/Mahe" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Mahe') echo 'selected="selected"'; ?>>Indian/Mahe</option>
<option value="Indian/Maldives" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Maldives') echo 'selected="selected"'; ?>>Indian/Maldives</option>
<option value="Indian/Mauritius" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Mauritius') echo 'selected="selected"'; ?>>Indian/Mauritius</option>
<option value="Indian/Mayotte" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Mayotte') echo 'selected="selected"'; ?>>Indian/Mayotte</option>
<option value="Indian/Reunion" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Indian/Reunion') echo 'selected="selected"'; ?>>Indian/Reunion</option>
<option value="Iran" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Iran') echo 'selected="selected"'; ?>>Iran</option>
<option value="Israel" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Israel') echo 'selected="selected"'; ?>>Israel</option>
<option value="Jamaica" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Jamaica') echo 'selected="selected"'; ?>>Jamaica</option>
<option value="Japan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Japan') echo 'selected="selected"'; ?>>Japan</option>
<option value="Kwajalein" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Kwajalein') echo 'selected="selected"'; ?>>Kwajalein</option>
<option value="Libya" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Libya') echo 'selected="selected"'; ?>>Libya</option>
<option value="MET" <?php if ($GLOBALS['Form_TIMEZONE'] == 'MET') echo 'selected="selected"'; ?>>MET</option>
<option value="Mexico/BajaNorte" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Mexico/BajaNorte') echo 'selected="selected"'; ?>>Mexico/BajaNorte</option>
<option value="Mexico/BajaSur" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Mexico/BajaSur') echo 'selected="selected"'; ?>>Mexico/BajaSur</option>
<option value="Mexico/General" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Mexico/General') echo 'selected="selected"'; ?>>Mexico/General</option>
<option value="MST" <?php if ($GLOBALS['Form_TIMEZONE'] == 'MST') echo 'selected="selected"'; ?>>MST</option>
<option value="MST7MDT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'MST7MDT') echo 'selected="selected"'; ?>>MST7MDT</option>
<option value="Navajo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Navajo') echo 'selected="selected"'; ?>>Navajo</option>
<option value="NZ" <?php if ($GLOBALS['Form_TIMEZONE'] == 'NZ') echo 'selected="selected"'; ?>>NZ</option>
<option value="NZ-CHAT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'NZ-CHAT') echo 'selected="selected"'; ?>>NZ-CHAT</option>
<option value="Pacific/Apia" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Apia') echo 'selected="selected"'; ?>>Pacific/Apia</option>
<option value="Pacific/Auckland" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Auckland') echo 'selected="selected"'; ?>>Pacific/Auckland</option>
<option value="Pacific/Chatham" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Chatham') echo 'selected="selected"'; ?>>Pacific/Chatham</option>
<option value="Pacific/Easter" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Easter') echo 'selected="selected"'; ?>>Pacific/Easter</option>
<option value="Pacific/Efate" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Efate') echo 'selected="selected"'; ?>>Pacific/Efate</option>
<option value="Pacific/Enderbury" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Enderbury') echo 'selected="selected"'; ?>>Pacific/Enderbury</option>
<option value="Pacific/Fakaofo" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Fakaofo') echo 'selected="selected"'; ?>>Pacific/Fakaofo</option>
<option value="Pacific/Fiji" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Fiji') echo 'selected="selected"'; ?>>Pacific/Fiji</option>
<option value="Pacific/Funafuti" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Funafuti') echo 'selected="selected"'; ?>>Pacific/Funafuti</option>
<option value="Pacific/Galapagos" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Galapagos') echo 'selected="selected"'; ?>>Pacific/Galapagos</option>
<option value="Pacific/Gambier" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Gambier') echo 'selected="selected"'; ?>>Pacific/Gambier</option>
<option value="Pacific/Guadalcanal" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Guadalcanal') echo 'selected="selected"'; ?>>Pacific/Guadalcanal</option>
<option value="Pacific/Guam" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Guam') echo 'selected="selected"'; ?>>Pacific/Guam</option>
<option value="Pacific/Honolulu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Honolulu') echo 'selected="selected"'; ?>>Pacific/Honolulu</option>
<option value="Pacific/Johnston" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Johnston') echo 'selected="selected"'; ?>>Pacific/Johnston</option>
<option value="Pacific/Kiritimati" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Kiritimati') echo 'selected="selected"'; ?>>Pacific/Kiritimati</option>
<option value="Pacific/Kosrae" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Kosrae') echo 'selected="selected"'; ?>>Pacific/Kosrae</option>
<option value="Pacific/Kwajalein" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Kwajalein') echo 'selected="selected"'; ?>>Pacific/Kwajalein</option>
<option value="Pacific/Majuro" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Majuro') echo 'selected="selected"'; ?>>Pacific/Majuro</option>
<option value="Pacific/Marquesas" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Marquesas') echo 'selected="selected"'; ?>>Pacific/Marquesas</option>
<option value="Pacific/Midway" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Midway') echo 'selected="selected"'; ?>>Pacific/Midway</option>
<option value="Pacific/Nauru" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Nauru') echo 'selected="selected"'; ?>>Pacific/Nauru</option>
<option value="Pacific/Niue" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Niue') echo 'selected="selected"'; ?>>Pacific/Niue</option>
<option value="Pacific/Norfolk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Norfolk') echo 'selected="selected"'; ?>>Pacific/Norfolk</option>
<option value="Pacific/Noumea" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Noumea') echo 'selected="selected"'; ?>>Pacific/Noumea</option>
<option value="Pacific/Pago_Pago" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Pago_Pago') echo 'selected="selected"'; ?>>Pacific/Pago_Pago</option>
<option value="Pacific/Palau" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Palau') echo 'selected="selected"'; ?>>Pacific/Palau</option>
<option value="Pacific/Pitcairn" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Pitcairn') echo 'selected="selected"'; ?>>Pacific/Pitcairn</option>
<option value="Pacific/Ponape" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Ponape') echo 'selected="selected"'; ?>>Pacific/Ponape</option>
<option value="Pacific/Port_Moresby" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Port_Moresby') echo 'selected="selected"'; ?>>Pacific/Port_Moresby</option>
<option value="Pacific/Rarotonga" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Rarotonga') echo 'selected="selected"'; ?>>Pacific/Rarotonga</option>
<option value="Pacific/Saipan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Saipan') echo 'selected="selected"'; ?>>Pacific/Saipan</option>
<option value="Pacific/Samoa" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Samoa') echo 'selected="selected"'; ?>>Pacific/Samoa</option>
<option value="Pacific/Tahiti" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Tahiti') echo 'selected="selected"'; ?>>Pacific/Tahiti</option>
<option value="Pacific/Tarawa" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Tarawa') echo 'selected="selected"'; ?>>Pacific/Tarawa</option>
<option value="Pacific/Tongatapu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Tongatapu') echo 'selected="selected"'; ?>>Pacific/Tongatapu</option>
<option value="Pacific/Truk" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Truk') echo 'selected="selected"'; ?>>Pacific/Truk</option>
<option value="Pacific/Wake" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Wake') echo 'selected="selected"'; ?>>Pacific/Wake</option>
<option value="Pacific/Wallis" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Wallis') echo 'selected="selected"'; ?>>Pacific/Wallis</option>
<option value="Pacific/Yap" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Pacific/Yap') echo 'selected="selected"'; ?>>Pacific/Yap</option>
<option value="Poland" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Poland') echo 'selected="selected"'; ?>>Poland</option>
<option value="Portugal" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Portugal') echo 'selected="selected"'; ?>>Portugal</option>
<option value="PRC" <?php if ($GLOBALS['Form_TIMEZONE'] == 'PRC') echo 'selected="selected"'; ?>>PRC</option>
<option value="PST8PDT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'PST8PDT') echo 'selected="selected"'; ?>>PST8PDT</option>
<option value="ROC" <?php if ($GLOBALS['Form_TIMEZONE'] == 'ROC') echo 'selected="selected"'; ?>>ROC</option>
<option value="ROK" <?php if ($GLOBALS['Form_TIMEZONE'] == 'ROK') echo 'selected="selected"'; ?>>ROK</option>
<option value="Singapore" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Singapore') echo 'selected="selected"'; ?>>Singapore</option>
<option value="Turkey" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Turkey') echo 'selected="selected"'; ?>>Turkey</option>
<option value="UCT" <?php if ($GLOBALS['Form_TIMEZONE'] == 'UCT') echo 'selected="selected"'; ?>>UCT</option>
<option value="Universal" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Universal') echo 'selected="selected"'; ?>>Universal</option>
<option value="US/Alaska" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Alaska') echo 'selected="selected"'; ?>>US/Alaska</option>
<option value="US/Aleutian" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Aleutian') echo 'selected="selected"'; ?>>US/Aleutian</option>
<option value="US/Arizona" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Arizona') echo 'selected="selected"'; ?>>US/Arizona</option>
<option value="US/Central" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Central') echo 'selected="selected"'; ?>>US/Central</option>
<option value="US/East-Indiana" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/East-Indiana') echo 'selected="selected"'; ?>>US/East-Indiana</option>
<option value="US/Eastern" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Eastern') echo 'selected="selected"'; ?>>US/Eastern</option>
<option value="US/Hawaii" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Hawaii') echo 'selected="selected"'; ?>>US/Hawaii</option>
<option value="US/Indiana-Starke" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Indiana-Starke') echo 'selected="selected"'; ?>>US/Indiana-Starke</option>
<option value="US/Michigan" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Michigan') echo 'selected="selected"'; ?>>US/Michigan</option>
<option value="US/Mountain" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Mountain') echo 'selected="selected"'; ?>>US/Mountain</option>
<option value="US/Pacific" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Pacific') echo 'selected="selected"'; ?>>US/Pacific</option>
<option value="US/Pacific-New" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Pacific-New') echo 'selected="selected"'; ?>>US/Pacific-New</option>
<option value="US/Samoa" <?php if ($GLOBALS['Form_TIMEZONE'] == 'US/Samoa') echo 'selected="selected"'; ?>>US/Samoa</option>
<option value="UTC" <?php if ($GLOBALS['Form_TIMEZONE'] == 'UTC') echo 'selected="selected"'; ?>>UTC</option>
<option value="W-SU" <?php if ($GLOBALS['Form_TIMEZONE'] == 'W-SU') echo 'selected="selected"'; ?>>W-SU</option>
<option value="WET" <?php if ($GLOBALS['Form_TIMEZONE'] == 'WET') echo 'selected="selected"'; ?>>WET</option>
<option value="Zulu" <?php if ($GLOBALS['Form_TIMEZONE'] == 'Zulu') echo 'selected="selected"'; ?>>Zulu</option></select>
                        <span id="DataFieldInputExtra_TIMEZONE"> </span>
                     </div>
                     <div class="Example">
                        <i>Example: America/New_York</i>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">The timezone in which the calendar will set the local time for. All new events, logs, etc will be affected by this setting.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Week Starting Day:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput">
                        <select name="WEEK_STARTING_DAY" id="Input_WEEK_STARTING_DAY">
<option value="0" <?php if ($GLOBALS['Form_WEEK_STARTING_DAY'] == '0') echo 'selected="selected"'; ?>>Sunday (0)</option>
<option value="1" <?php if ($GLOBALS['Form_WEEK_STARTING_DAY'] == '1') echo 'selected="selected"'; ?>>Monday (1)</option></select>
                        <span id="DataFieldInputExtra_WEEK_STARTING_DAY"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Defines the week starting day</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Use AM/PM:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_USE_AMPM" name="USE_AMPM" value="true"
										<?php if ($GLOBALS['Form_USE_AMPM'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_USE_AMPM"> Yes</label>
                        <span id="DataFieldInputExtra_USE_AMPM"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Defines time format e.g. 1am-11pm (true) or 1:00-23:00 (false)</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>Display:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Column Position:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput">
                        <select name="COLUMNSIDE" id="Input_COLUMNSIDE">
<option value="LEFT" <?php if ($GLOBALS['Form_COLUMNSIDE'] == 'LEFT') echo 'selected="selected"'; ?>>LEFT</option>
<option value="RIGHT" <?php if ($GLOBALS['Form_COLUMNSIDE'] == 'RIGHT') echo 'selected="selected"'; ?>>RIGHT</option></select>
                        <span id="DataFieldInputExtra_COLUMNSIDE"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Which side the little calendar, 'jump to', 'today is', etc. will be on.</div>
                     <div class="CommentLine">RIGHT is more user friendly for users with low resolutions.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Show Upcoming Tab:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_SHOW_UPCOMING_TAB" name="SHOW_UPCOMING_TAB" value="true"
										onclick="ToggleDependant('SHOW_UPCOMING_TAB');" onchange="ToggleDependant('SHOW_UPCOMING_TAB');"<?php if ($GLOBALS['Form_SHOW_UPCOMING_TAB'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_SHOW_UPCOMING_TAB"> Yes</label>
                        <span id="DataFieldInputExtra_SHOW_UPCOMING_TAB"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Whether or not the upcoming tab will be shown.</div>
                  </td>
               </tr>
               <tr id="Dependants_SHOW_UPCOMING_TAB">
                  <td>
                     <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>Max Upcoming Events:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_MAX_UPCOMING_EVENTS" name="MAX_UPCOMING_EVENTS" value="<?php echo htmlentities($GLOBALS['Form_MAX_UPCOMING_EVENTS']); ?>" size="60"/> <span id="DataFieldInputExtra_MAX_UPCOMING_EVENTS"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">The maximum number of upcoming events displayed.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                     <script type="text/javascript">ToggleDependant('SHOW_UPCOMING_TAB');</script>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Show Month Overlap:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_SHOW_MONTH_OVERLAP" name="SHOW_MONTH_OVERLAP" value="true"
										<?php if ($GLOBALS['Form_SHOW_MONTH_OVERLAP'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_SHOW_MONTH_OVERLAP"> Yes</label>
                        <span id="DataFieldInputExtra_SHOW_MONTH_OVERLAP"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Whether or not events in month view on days that are not actually part of the current month should be shown.</div>
                     <div class="CommentLine">For example, if the first day of the month starts on a Wednesday, then Sunday-Tuesday are from the previous month.</div>
                     <div class="CommentLine">Values must be true or false.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Include Static Pre-Header HTML:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_INCLUDE_STATIC_PRE_HEADER" name="INCLUDE_STATIC_PRE_HEADER" value="true"
										<?php if ($GLOBALS['Form_INCLUDE_STATIC_PRE_HEADER'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_INCLUDE_STATIC_PRE_HEADER"> Yes</label>
                        <span id="DataFieldInputExtra_INCLUDE_STATIC_PRE_HEADER"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Include the file located at ./static-includes/subcalendar-pre-header.txt before the calendar header HTML for all calendars.</div>
                     <div class="CommentLine">This allows you to enforce a standard header for all calendars.</div>
                     <div class="CommentLine">This does not affect the default calendar.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Include Static Post-Header HTML:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_INCLUDE_STATIC_POST_HEADER" name="INCLUDE_STATIC_POST_HEADER" value="true"
										<?php if ($GLOBALS['Form_INCLUDE_STATIC_POST_HEADER'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_INCLUDE_STATIC_POST_HEADER"> Yes</label>
                        <span id="DataFieldInputExtra_INCLUDE_STATIC_POST_HEADER"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Include the file located at ./static-includes/subcalendar-post-header.txt after the calendar header HTML for all calendars.</div>
                     <div class="CommentLine">This allows you to enforce a standard header for all calendars.</div>
                     <div class="CommentLine">This does not affect the default calendar.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Include Static Pre-Footer HTML:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_INCLUDE_STATIC_PRE_FOOTER" name="INCLUDE_STATIC_PRE_FOOTER" value="true"
										<?php if ($GLOBALS['Form_INCLUDE_STATIC_PRE_FOOTER'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_INCLUDE_STATIC_PRE_FOOTER"> Yes</label>
                        <span id="DataFieldInputExtra_INCLUDE_STATIC_PRE_FOOTER"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Include the file located at ./static-includes/subcalendar-pre-footer.txt before the calendar footer HTML for all calendars.</div>
                     <div class="CommentLine">This allows you to enforce a standard footer for all calendars.</div>
                     <div class="CommentLine">This does not affect the default calendar.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Include Static Post-Footer HTML:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_INCLUDE_STATIC_POST_FOOTER" name="INCLUDE_STATIC_POST_FOOTER" value="true"
										<?php if ($GLOBALS['Form_INCLUDE_STATIC_POST_FOOTER'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_INCLUDE_STATIC_POST_FOOTER"> Yes</label>
                        <span id="DataFieldInputExtra_INCLUDE_STATIC_POST_FOOTER"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Include the file located at ./static-includes/subcalendar-post-footer.txt after the calendar footer HTML for all calendars.</div>
                     <div class="CommentLine">This allows you to enforce a standard footer for all calendars.</div>
                     <div class="CommentLine">This does not affect the default calendar.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>Cache:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Max Category Name Cache Size:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_MAX_CACHESIZE_CATEGORYNAME" name="MAX_CACHESIZE_CATEGORYNAME" value="<?php echo htmlentities($GLOBALS['Form_MAX_CACHESIZE_CATEGORYNAME']); ?>" size="60"/> <span id="DataFieldInputExtra_MAX_CACHESIZE_CATEGORYNAME"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Cache the list of category names in memory if the calendar has less than or equal to this number.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Cache 'Subscribe &amp; Download' ICS Files:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_CACHE_ICS" name="CACHE_ICS" value="true"
										<?php if ($GLOBALS['Form_CACHE_ICS'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_CACHE_ICS"> Yes</label>
                        <span id="DataFieldInputExtra_CACHE_ICS"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">When a lot of users subscribe to your calendar via the 'Subscribe &amp; Download' page, this can put a heavy load on your server.</div>
                     <div class="CommentLine">To avoid this, you can either use a server or add-on that supports caching (i.e. Apache 2.2, squid-cache) or you can use a script to periodically retrieve and cache the ICS files to disk for each category </div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>Export:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_EXPORT_PATH" name="EXPORT_PATH" value="<?php echo htmlentities($GLOBALS['Form_EXPORT_PATH']); ?>" size="60"/> <span id="DataFieldInputExtra_EXPORT_PATH"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">The URL extension to the export script. Must NOT being with a slash (/).</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Maximum Exported Events:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_MAX_EXPORT_EVENTS" name="MAX_EXPORT_EVENTS" value="<?php echo htmlentities($GLOBALS['Form_MAX_EXPORT_EVENTS']); ?>" size="60"/> <span id="DataFieldInputExtra_MAX_EXPORT_EVENTS"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">The maximum number of events that can be exported using the subscribe, download or export pages.</div>
                     <div class="CommentLine">Calendar and main admins can export all data using the VTCalendar (XML) format.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Export Data Lifetime (in minutes):</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="text" id="Input_EXPORT_CACHE_MINUTES" name="EXPORT_CACHE_MINUTES" value="<?php echo htmlentities($GLOBALS['Form_EXPORT_CACHE_MINUTES']); ?>" size="60"/> <span id="DataFieldInputExtra_EXPORT_CACHE_MINUTES"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">The number of minutes that a browser will be told to cache exported data.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Allow Export in VTCalendar (XML) Format:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_PUBLIC_EXPORT_VTCALXML" name="PUBLIC_EXPORT_VTCALXML" value="true"
										<?php if ($GLOBALS['Form_PUBLIC_EXPORT_VTCALXML'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_PUBLIC_EXPORT_VTCALXML"> Yes</label>
                        <span id="DataFieldInputExtra_PUBLIC_EXPORT_VTCALXML"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">The VTCalendar (XML) export format contains all information about an event, which you may not want to allow the public to view.</div>
                     <div class="CommentLine">However, users that are part of the admin sponsor, or are main admins, can always export in this format.</div>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
<h2>E-Mail:</h2>
<blockquote>
   <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
      <tr>
         <td class="VariableName" nowrap="nowrap" valign="top">
            <b>Send E-mail via Pear::Mail:</b>
         </td>
         <td class="VariableBody">
            <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
               <tr>
                  <td class="DataField">
                     <div class="DataFieldInput"><input type="checkbox" id="CheckBox_EMAIL_USEPEAR" name="EMAIL_USEPEAR" value="true"
										onclick="ToggleDependant('EMAIL_USEPEAR');" onchange="ToggleDependant('EMAIL_USEPEAR');"<?php if ($GLOBALS['Form_EMAIL_USEPEAR'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_EMAIL_USEPEAR"> Yes</label>
                        <span id="DataFieldInputExtra_EMAIL_USEPEAR"> </span>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td class="Comment">
                     <div class="CommentLine">Send e-mail using Pear::Mail rather than the built-in PHP Mail function.</div>
                     <div class="CommentLine">This should be used if you are on Windows or do not have sendmail installed.</div>
                  </td>
               </tr>
               <tr id="Dependants_EMAIL_USEPEAR">
                  <td>
                     <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>SMTP Host:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_EMAIL_SMTP_HOST" name="EMAIL_SMTP_HOST" value="<?php echo htmlentities($GLOBALS['Form_EMAIL_SMTP_HOST']); ?>" size="60"/> <span id="DataFieldInputExtra_EMAIL_SMTP_HOST"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">The SMTP host name to connect to.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>SMTP Port:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_EMAIL_SMTP_PORT" name="EMAIL_SMTP_PORT" value="<?php echo htmlentities($GLOBALS['Form_EMAIL_SMTP_PORT']); ?>" size="60"/> <span id="DataFieldInputExtra_EMAIL_SMTP_PORT"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">The SMTP port number to connect to.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>SMTP Authentication:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="checkbox" id="CheckBox_EMAIL_SMTP_AUTH" name="EMAIL_SMTP_AUTH" value="true"
										onclick="ToggleDependant('EMAIL_SMTP_AUTH');" onchange="ToggleDependant('EMAIL_SMTP_AUTH');"<?php if ($GLOBALS['Form_EMAIL_SMTP_AUTH'] == 'true') echo ' checked="checked"'; ?>/><label for="CheckBox_EMAIL_SMTP_AUTH"> Yes</label>
                                          <span id="DataFieldInputExtra_EMAIL_SMTP_AUTH"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">Whether or not to use SMTP authentication.</div>
                                    </td>
                                 </tr>
                                 <tr id="Dependants_EMAIL_SMTP_AUTH">
                                    <td>
                                       <table class="VariableTable" border="0" cellspacing="0" cellpadding="6">
                                          <tr>
                                             <td class="VariableName" nowrap="nowrap" valign="top">
                                                <b>SMTP Username:</b>
                                             </td>
                                             <td class="VariableBody">
                                                <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                                   <tr>
                                                      <td class="DataField">
                                                         <div class="DataFieldInput"><input type="text" id="Input_EMAIL_SMTP_USERNAME" name="EMAIL_SMTP_USERNAME" value="<?php echo htmlentities($GLOBALS['Form_EMAIL_SMTP_USERNAME']); ?>" size="60"/> <span id="DataFieldInputExtra_EMAIL_SMTP_USERNAME"> </span>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td class="Comment">
                                                         <div class="CommentLine">The username to use for SMTP authentication.</div>
                                                      </td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td class="VariableName" nowrap="nowrap" valign="top">
                                                <b>SMTP Password:</b>
                                             </td>
                                             <td class="VariableBody">
                                                <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                                   <tr>
                                                      <td class="DataField">
                                                         <div class="DataFieldInput"><input type="text" id="Input_EMAIL_SMTP_PASSWORD" name="EMAIL_SMTP_PASSWORD" value="<?php echo htmlentities($GLOBALS['Form_EMAIL_SMTP_PASSWORD']); ?>" size="60"/> <span id="DataFieldInputExtra_EMAIL_SMTP_PASSWORD"> </span>
                                                         </div>
                                                      </td>
                                                   </tr>
                                                   <tr>
                                                      <td class="Comment">
                                                         <div class="CommentLine">The password to use for SMTP authentication.</div>
                                                      </td>
                                                   </tr>
                                                </table>
                                             </td>
                                          </tr>
                                       </table>
                                       <script type="text/javascript">ToggleDependant('EMAIL_SMTP_AUTH');</script>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>SMTP EHLO/HELO:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_EMAIL_SMTP_HELO" name="EMAIL_SMTP_HELO" value="<?php echo htmlentities($GLOBALS['Form_EMAIL_SMTP_HELO']); ?>" size="60"/> <span id="DataFieldInputExtra_EMAIL_SMTP_HELO"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">The value to give when sending EHLO or HELO.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                        <tr>
                           <td class="VariableName" nowrap="nowrap" valign="top">
                              <b>SMTP Timeout:</b>
                           </td>
                           <td class="VariableBody">
                              <table class="ContentTable" width="100%" border="0" cellspacing="0" cellpadding="6">
                                 <tr>
                                    <td class="DataField">
                                       <div class="DataFieldInput"><input type="text" id="Input_EMAIL_SMTP_TIMEOUT" name="EMAIL_SMTP_TIMEOUT" value="<?php echo htmlentities($GLOBALS['Form_EMAIL_SMTP_TIMEOUT']); ?>" size="60"/> <span id="DataFieldInputExtra_EMAIL_SMTP_TIMEOUT"> </span>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="Comment">
                                       <div class="CommentLine">The SMTP connection timeout.</div>
                                       <div class="CommentLine">Set the value to 0 to have no timeout.</div>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                        </tr>
                     </table>
                     <script type="text/javascript">ToggleDependant('EMAIL_USEPEAR');</script>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</blockquote>
