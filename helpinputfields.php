<?php
  session_start();
  require_once('globalsettings.inc.php');
  require_once('functions.inc.php');

  helpbox_begin();
?>
<H3><IMG src="images/help.gif" width="16" height="16" alt="" border="0">
Input Fields
</H3>
The following table shows the meaning of the input fields:<BR>
<BR>
<TABLE width="100%" border="1" cellspacing="1" cellpadding="3">
  <TR align="left">
    <TH class="helpbox">Field name</TH>
    <TH class="helpbox">Meaning</TH>
  </TR>
    <TR>
      <TD class="helpbox">Date</TD>
      <TD class="helpbox">Choose between one of the radio buttons to determine whether your
      event is a one-time or a recurring event. Then you will be given the opportunity to specify the
      date of the one-time event or define the recurrence for a repeating event.<BR>
      The validity of the date you picked is checked after pressing the &quot;Preview Event&quot; button.<BR>
      </TD>
    <TR>
    <TR>
      <TD class="helpbox">Time</TD>
      <TD class="helpbox">Declare the event as being an
      &quot;all day event&quot; (for example "Thanksgiving Day") or specify start and ending time for the event. Pick &quot;???&quot; for the hour of the
      ending time if the event does not have a specified ending time.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Category</TD>
      <TD class="helpbox">Classify your event into one of the given categories to facilitate searching.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Title</TD>
      <TD class="helpbox">Give your event a descriptive title. When choosing one, remember that
      the category is always displayed along with the title.<BR>
      <BR>
      Neither the weekly nor the monthly view shows your sponsor name. That's why you have to
      make sure that the user will have a rough idea about the event just by reading the title.<BR>
      <BR>
      The input space for the title is limited to 40 characters to avoid cluttering the
      screen with too long titles.
      </TD>
    <TR>
    <TR>
      <TD class="helpbox">Description</TD>
      <TD class="helpbox">Give a detailed description of the event here. Remember that you can save people
      a lot of hassle if you give all the information available to you, so that
      they are not required to call you or send out an email.<BR>
      <BR>
      You are not limited in space.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Location</TD>
      <TD class="helpbox">Describe the location of the event (building, room number etc.)</TD>
    <TR>
    <TR>
      <TD class="helpbox">Price</TD>
      <TD class="helpbox">Specify, if there is a charge for taking part in the event. If it's free just
      use the word &quot;free&quot;.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Contact name</TD>
      <TD class="helpbox">Specify the name of a person that can be contacted by people interested to learn
      more about the event.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Contact phone</TD>
      <TD class="helpbox">Specify a phone number that everybody who needs further information can call.
      If you have a fax machine you can also provide its number.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Contact email</TD>
      <TD class="helpbox">Specify an email address that can be used to request further information.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Event page web address</TD>
      <TD class="helpbox">If you have a specific web page that gives more information about that particular event
      write down its address here. Do not use this field to publicize your homepage's address. For this purpose
      you can use the field &quot;Sponsor page web address&quot; below.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Displayed sponsor name</TD>
      <TD class="helpbox">By default this field will contain the name of your organisation agreed upon when
      signing up with the event calendar. You are free to change it. You might have to use it if
      you want to submit events on behalf of an organisation who did not sign up itself.</TD>
    <TR>
    <TR>
      <TD class="helpbox">Sponsor page web address</TD>
      <TD class="helpbox">Specify the address for the homepage of your organization here.</TD>
    <TR>
</TABLE>
<?php
  helpbox_end();
?>