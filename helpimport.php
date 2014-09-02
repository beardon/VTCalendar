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
Importing Events
</H3>
<P>In order to be able to add event data into the VT calendar without using 
its web interface for manual input, the calendar enables you to import events from other sources.
This feature allows you to prepare a file containing all new events which then will be 
uploaded to the calendar. Nevertheless, <b>changes to existing events have to be made using the 
calendar web interface</b>.
</P>
<P>The process of adding a batch of events is the following:
<ol>
<li>prepare a file containing the event information (the structure is described further below)
and place it in a directory of a web server
<li>login to the VT calendar
<li>choose the "import events from remote location" option, specify the 
  URL of the file and press the button "Start Import"</li>              
</ol>
<P>
The data, that is going to be added to the calendar, is contained in an <a href="http://www.xml.org/">XML</a> (extensible markup 
language) file with the following structure (this example contains 2 events): 
</P>
<hr size="1">
<pre>
&lt;events&gt;
  &lt;event&gt;
    &lt;displayedsponsor&gt;Athletics Department&lt;/displayedsponsor&gt;
    &lt;displayedsponsorurl&gt;http://www.hokiesports.com/&lt;/displayedsponsorurl&gt;
    &lt;date&gt;2000-03-15&lt;/date&gt;
    &lt;timebegin&gt;15:00&lt;/timebegin&gt;
    &lt;timeend&gt;&lt;/timeend&gt;
    &lt;categoryid&gt;9&lt;/categoryid&gt;
    &lt;title&gt;Baseball vs. Kent&lt;/title&gt;
    &lt;description&gt;VT is playing vs. Kent...&lt;/description&gt;
    &lt;location&gt;English Field&lt;/location&gt;
    &lt;price&gt;free&lt;/price&gt;
    &lt;contact_name&gt;Jennifer Meyers&lt;/contact_name&gt;
    &lt;contact_phone&gt;231-4933&lt;/contact_phone&gt;
    &lt;contact_email&gt;jmeyer@vt.edu&lt;/contact_email&gt;
    &lt;url&gt;http://www.hokiesportsinfo.com/baseball/&lt;/url&gt;
  &lt;/event&gt;
  &lt;event&gt;
    &lt;displayedsponsor&gt;Indian Student Association&lt;/displayedsponsor&gt;
    &lt;displayedsponsorurl&gt;http://fbox.vt.edu:10021/org/isa/&lt;/displayedsponsorurl&gt;
    &lt;date&gt;1999-11-06&lt;/date&gt;
    &lt;timebegin&gt;17:00&lt;/timebegin&gt;
    &lt;timeend&gt;21:00&lt;/timeend&gt;
    &lt;categoryid&gt;9&lt;/categoryid&gt;
    &lt;title&gt;Diwali '99&lt;/title&gt;
    &lt;description&gt;A two and half hour cultural show at Buruss Auditorium. 
    The show includes traditional Indian dance, a fashion show featuring traditional 
    clothes from different parts of India, a live orchestra playing popular hindi songs, 
    a tickle-your-belly skit based on the recent elections in India, a jam of guitar and 
    Indian classical musical instruments, children's show among others events.
    &lt;/description&gt;
    &lt;location&gt;Buruss Auditorium&lt;/location&gt;
    &lt;price&gt;free&lt;/price&gt;
    &lt;contact_name&gt;Akash Rai&lt;/contact_name&gt;
    &lt;contact_phone&gt;540-951-7764&lt;/contact_phone&gt;
    &lt;contact_email&gt;arai@vt.edu&lt;/contact_email&gt;
    &lt;url&gt;http://fbox.vt.edu:10021/org/isa/diwali99/&lt;/url&gt;
  &lt;/event&gt;
  &lt;event&gt;
    ...
  &lt;/event&gt;
  ...  
&lt;/events&gt;
</pre>
<hr size="1">
<br>Please note the following facts:
<ul>
<li>The order of the events in the XML file does not matter
<li>If <code>&lt;timebegin&gt;</code> is set to &quot;00:00&quot; and <CODE>&lt;timeend&gt;</CODE> to &quot;23:59&quot;,
the event is an &quot;all day event&quot;
<li>If <code>&lt;timeend&gt;</code> does not enclose
any value at all, the event does not have a specified ending time
<li>The value for <code>&lt;categoryid&gt;</code> is one of the following index numbers:
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
</li>            
</ul>
<p>The following table contains all the fields that 
describe an event, their intended usage, the allowed field length, the syntax and an indicator whether an element
can be empty or not (like <code>&lt;timeend&gt;&lt;/timeend&gt;</code>).</p>
<br>
<table border="1" cellspacing="0" cellpadding="5">
  <tr>
    <th>field name</th>
    <th>usage</th>
    <th>field length [character]</th>
    <th>syntax</th>
    <th>empty element allowed</th>
  </tr>
  <tr>
    <td>displayedsponsor</td>
    <td>the name of the sponsor that is displayed in the calendar's detailed view</td>
    <td>max. 100</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>displayedsponsorurl</td>
    <td>the URL of the homepage of the sponsor that is displayed in the calendar's detailed view</td>
    <td>max. 100</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>date</td>
    <td>the date the event takes place, written in the ISO-8601 format</td>
    <td>exactly 10</td>
    <td>YYYY-MM-DD</td>
    <td>no</td>
  </tr>
  <tr>
    <td>timebegin</td>
    <td>
      <ul>
        <li>the time the event begins, written in the ISO-8601 format (military/24 hour time)</li>
        <li>e.g. for 9am use &quot;09:00&quot;, for 8pm use &quot;20:00&quot;</li>
        <li>if the value is &quot;00:00&quot; and timeend is &quot;23:59&quot; the event is considered to be an 
            &quot;all day event&quot;</li>
        <li>the time is only displayed in the weekly and detailed view (not in the monthly view)</li>
      </ul>  
    </td>
    <td>exactly 5</td>
    <td>HH:MM</td>
    <td>no</td>
  </tr>
  <tr>
    <td>timeend</td>
    <td>
      <ul>
        <li>the time the event ends, written in the ISO-8601 format (military/24 hour time)</li>
        <li>e.g. for 9am use &quot;09:00&quot;, for 8pm use &quot;20:00&quot;</li>
        <li>if the value is completely ommitted the event is considered to not have a specified
        ending time (no ending time is displayed in the calendar)</li>
        <li>the time is only displayed in the detailed view (not in the weekly or monthly view)</li>
      </ul>
    </td>
    <td>exactly 5</td>
    <td>HH:MM</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>categoryid</td>
    <td>
      <ul>
        <li>an index number indicating the category of the event (see table above)</li>
        <li>the associated category is only displayed in the weekly and detailed view (not in the monthly view)</li>
      </ul
    ></td>
    <td>number from table above</td>
    <td>number</td>
    <td>no</td>
  </tr>
  <tr>
    <td>title</td>
    <td>the event title (displayed in weekly, monthly and detailed view)</td>
    <td>max. 40</td>
    <td>free text</td>
    <td>no</td>
  </tr>
  <tr>
    <td>description</td>
    <td>a long text describing the specifics of an event<br>
    the description is only displayed in the detailed view</td>
    <td>max. 5000</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>location</td>
    <td>the location where the event takes place</td>
    <td>max. 100</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>price</td>
    <td>
      <ul>
        <li>the price of the event</li>
        <li>use &quot;free&quot; if there is no charge</li>
        <li>e.g. you could use something like &quot;$5 for VT students, $10 for general public&quot;</li>
      </ul>
    </td>
    <td>max. 100</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>contact_name</td>
    <td>the name of a person that can be contacted if further info is required</td>
    <td>max. 100</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>contact_phone</td>
    <td>
      <ul>
        <li>contact phone number(s)</li>
        <li>e.g. use &quot;231-2343 for general info, 231-5600 for tickets&quot;</li>
      </ul>
    </td>
    <td>max. 100</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>contact_email</td>
    <td>contact email address</td>
    <td>max. 100</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
  <tr>
    <td>url</td>
    <td>URL of a web page specifically describing the event</td>
    <td>max. 100</td>
    <td>free text</td>
    <td>yes</td>
  </tr>
</table>
<br>
<?php
  helpbox_end();
?>