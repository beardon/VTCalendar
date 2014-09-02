<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  $database = DBopen();
  pageheader("Privacy Policy - Event Calendar",
             "Privacy Policy",
	           "","",$database);
	echo "<BR>\n";
	box_begin("inputbox","");
  if ( isset($_SERVER["HTTPS"]) ) { $calendarurl = "https"; } else { $calendarurl = "http"; } 
	$calendarurl .= "://".$_SERVER['HTTP_HOST'].substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'], "/"))."/?calendar=default";
?>
<h2>Privacy Statement</h2>
<P>Virginia Tech has created this privacy statement in order to demonstrate our firm commitment to privacy. 
The following discloses the information gathering and dissemination practices for this Web page: <?php echo $calendarurl; ?> </P>
<br><br>
<B><P>Information Automatically Logged</P><br>
</B><P>We use your IP address to help diagnose problems with our server and to administer our Web page. 
We also record the browser type to monitor market penetration of various web browsers so we can better 
determine what Internet technologies we may utilize in the design of our pages.<br>
<br>
We use page referrer data--that is, information about the web page that pointed you to our page--to determine 
to what extent our page is referenced by other resources on the web. 
These data may be used to preserve the integrity of our computing resources.<br>
<br>
In order to improve the quality of the calendar we also log the use of the search feature.
We record a time stamp, IP address, the keyword entered into the search box and the number of returned results. 
</P>
<br><br>
<B><P>Personal Information </P><br>
</B><P>This Web page does not request any personal information or collect any information that personally 
identifies you or allows you to be personally contacted. </P><br>
<P>Since we do not collect any personal information on this Web site, we do not share any 
personal information with any third parties nor do we use any personal information for any purposes. </P>
<br><br>
<B><P>Links to Virginia Tech pages</P><br>
</B><P>This site contains links to other Virginia Tech pages. 
The privacy practices of other pages may vary with the purposes of the page. Consult the privacy statement on each page. </P>
<br><br>
<B><P>External Links</P><br>
</B><P>This site contains links to other sites. Virginia Tech is not responsible for the privacy practices or the content of such Web sites.</P>
<br><br>
<B><P>Security</P><br>
</B><P>This site has security measures in place to protect the loss, misuse, and alteration of the information under our control. Log file access is restricted to system administrators while stored on the server. </P>
<P>Users should also consult Virginia Tech's policy on Acceptable Use. <A HREF="http://www.vt.edu/admin/policies/acceptuseguide.html">http://www.vt.edu/admin/policies/acceptuseguide.html</A></P>
<P>Virginia Tech complies with all statutory and legal requirements with respect to access to information.</P>
<br><br>
<B><P>Contacting the Web Site </P><br>
</B><P>If you have any questions about this privacy statement, the practices of this site, 
or your dealings with this Web site, you can contact: <A HREF="mailto:<?php echo $_SESSION["ADMINEMAIL"]; ?>"><?php  echo $_SESSION["ADMINEMAIL"]; ?></A>.</P><br>
<P>
<form>
<input type="button" value="Back to previous page" onClick="history.back(-1)"></a>
</form>
<?php
  box_end();
  echo "<br><br>\n";
  require("footer.inc.php");
?>
