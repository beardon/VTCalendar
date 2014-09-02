<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  if ( isset($_SERVER["HTTPS"]) ) { $calendarurl = "https"; } else { $calendarurl = "http"; } 
	$calendarurl .= "://".$_SERVER['HTTP_HOST'].substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'], "/"))."/";
  $database = DBopen();
  helpbox_begin();
?>
<H3><IMG alt="" border=0 height=16 src="images/help.gif" width=16>
Exporting Events
</H3>
<P>You can export all or a subset of the data of the event calendar in two different ways:
<ul>
  <li>by choosing the link 
  &quot;export events&quot; in the sponsor's options menu</li>
  <li>or by directly accessing the export URL<br>e.g. 
  &quot;<?php echo $calendarurl; ?>export.php?calendar=<?php echo $_SESSION["CALENDARID"]; ?>&amp;type=xml&amp;timebegin=2000-03-17&amp;timeend=2000-05-20</a>&quot;.</li>
</ul>
Currently the calendar supports only XML as an export format.<br>
</P>
<br>
This is an example of the XML format the event data is exported in:
<hr size="1">
<pre>
&lt;events&gt;
  &lt;event&gt;
    &lt;eventid&gt;3454&lt;/eventid&gt;
    &lt;sponsorid&gt;uusa&lt;/sponsorid&gt;
    &lt;inputsponsor&gt;University Unions & Student Activities&lt;/inputsponsor&gt;
    &lt;displayedsponsor&gt;Graduate Student Assembly&lt;/displayedsponsor&gt;
    &lt;displayedsponsorurl&gt;http://gsa.uusa.vt.edu&lt;/displayedsponsorurl&gt;
    &lt;date&gt;2000-03-27&lt;/date&gt;
    &lt;timebegin&gt;18:00&lt;/timebegin&gt;
    &lt;timeend&gt;19:00&lt;/timeend&gt;
    &lt;repeat_vcaldef&gt;&lt;/repeat_vcaldef&gt;
    &lt;repeat_startdate&gt;&lt;/repeat_startdate&gt;
    &lt;repeat_enddate&gt;&lt;/repeat_enddate&gt;
    &lt;categoryid&gt;8&lt;/categoryid&gt;
    &lt;category&gt;Lectures&lt;/category&gt;
    &lt;title&gt;Lethal Viruses: Ebola & the Hot Zone&lt;/title&gt;
    &lt;description&gt;Colonel Nancy Jaax is delivering this keynote address for the Research Symposium.  
    She is a leading specialist in biological hazards. &lt;/description&gt;
    &lt;location&gt;Commonwealth Ballroom&lt;/location&gt;
    &lt;price&gt;free&lt;/price&gt;
    &lt;contact_name&gt;Kali Phelps&lt;/contact_name&gt;
    &lt;contact_phone&gt;231-7919&lt;/contact_phone&gt;
    &lt;contact_email&gt;kkniel@vt.edu&lt;/contact_email&gt;
    &lt;url&gt;http://gsa.uusa.vt.edu&lt;/url&gt;
    &lt;recordchangedtime&gt;2000-03-27 09:50:08&lt;/recordchangedtime&gt;
    &lt;recordchangeduser&gt;jsmith&lt;/recordchangeduser&gt;
  &lt;/event&gt;
  &lt;event&gt;
    ...
  &lt;/event&gt;
  ...
&lt;/events&gt;
</pre>
<hr size="1">
<br>
<P>
The following table describes the data format:<br>
<br>
<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>field name</th>
    <th>usage</th>
  </tr>
  <tr>
    <td>eventid</td>
    <td>the index number of this event</td>
  </tr>
  <tr>
    <td>sponsorid</td>
    <td>the short identifier of the organization that inputed the event into the calendar</td>
  </tr>
  <tr>
    <td>inputsponsor</td>
    <td>the name of the organization that inputed the event into the calendar</td>
  </tr>
  <tr>
    <td>displayedsponsor</td>
    <td>the name of the sponsor that is displayed in the calendar's detailed view</td>
  </tr>
  <tr>
    <td>displayedsponsorurl</td>
    <td>the URL of the homepage of the sponsor that is displayed in the calendar's detailed view</td>
  </tr>
  <tr>
    <td>date</td>
    <td>the date the event takes place, written in the ISO-8601 format</td>
  </tr>
  <tr>
    <td>timebegin</td>
    <td>
      <ul>
        <li>the time the event begins, written in the ISO-8601 format (military/24 hour time)</li>
        <li>if the value is &quot;00:00&quot; and timeend is &quot;23:59&quot; the event is considered to be an 
            &quot;all day event&quot;</li>
      </ul>  
    </td>
  </tr>
  <tr>
    <td>timeend</td>
    <td>
      <ul>
        <li>the time the event ends, written in the ISO-8601 format (military/24 hour time)</li>
        <li>if the value is completely ommitted the event is considered to not have a specified
        ending time</li>
      </ul>
    </td>
  </tr>
  <tr>
    <td>repeat_vcaldef</td>
    <td>
      <ul>
        <li>if the event is a recurring event it contains the recurrence definition in 
        <a href="http://www.imc.org/pdi/vcal-10.txt">vCalendar format</a></li>
        <li>e.g. &quot;W1 MO WE FR 20000502T235900&quot; means that an event repeats every week<br>
            Monday, Wednesday &amp; Friday until May 2, 2000</li>
      </ul>
    </td>
  </tr>
  <tr>
    <td>repeat_startdate</td>
    <td>
      if the event is a recurring event it contains the date where the recurrence starts
    </td>
  </tr>
  <tr>
    <td>repeat_enddate</td>
    <td>
      if the event is a recurring event it contains the date where the recurrence ends
    </td>
  </tr>
  <tr>
    <td>categoryid</td>
    <td>
      an index number indicating the category of the event (see table below)
    </td>
  </tr>
  <tr>
    <td>category</td>
    <td>
      the name of the category associated with the event
    </td>
  </tr>
  <tr>
    <td>title</td>
    <td>the event title (displayed in weekly, monthly and detailed view)</td>
  </tr>
  <tr>
    <td>description</td>
    <td>a long text describing the specifics of an event<br>
    the description is only displayed in the detailed view</td>
  </tr>
  <tr>
    <td>location</td>
    <td>the location where the event takes place (building, room etc.)</td>
  </tr>
  <tr>
    <td>price</td>
    <td>
      the price of the event
    </td>
  </tr>
  <tr>
    <td>contact_name</td>
    <td>the name of a person that can be contacted if further info is required</td>
  </tr>
  <tr>
    <td>contact_phone</td>
    <td>
      contact phone number(s)
    </td>
  </tr>
  <tr>
    <td>contact_email</td>
    <td>contact email address</td>
  </tr>
  <tr>
    <td>url</td>
    <td>URL of a web page specifically describing the event</td>
  </tr>
  <tr>
    <td>recordchanged</td>
    <td>a timestamp indicating when this event was changed the last time</td>
  </tr>
</table>
<br>
The value for &quot;categoryid&quot; is one of the following index numbers:
<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>index</th>
    <th>name</th>
  </tr>
<?php
  // read event categories from DB
  $result = DBQuery($database, "SELECT * FROM vtcal_category WHERE calendarid='".sqlescape($_SESSION["CALENDARID"])."' ORDER BY name ASC" ); 

  // print list with categories and select the one read from the DB
  for ($i=0;$i<$result->numRows();$i++) {
    $category = $result->fetchRow(DB_FETCHMODE_ASSOC,$i);
		echo "  <tr>\n";
		echo "    <td>",$category['id'],"</td>";
		echo "    <td>",$category['name'],"</td>";
		echo "  </tr>";
  }
?>
</table>
<br>
<?php
  helpbox_end();
?>