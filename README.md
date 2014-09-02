This project is an import of the original [VTCalendar](http://vtcalendar.sourceforge.net/ "Permalink to VTCalendar") hosted on SourceForge.

# VTCalendar

_April 8, 2009_ \- **Release Candidate of VTCalendar 2.3.0**

* A release candidate is considered free of all known bugs. While it is considered ready for production, it should not be used in mission-critical environments.
* See [installation guide][1] for important notes and installation instructions.
* Changes since second beta:
    * manageeevents.php was mostly rewritten to correctly display events.
One-time and reoccurring events are now displayed separately.
Moved some human-readable text into the language file.
The drop-down list now shows totals for only the sponsor and not the whole calendar.
    * Bug [[2722268][2]]: Added backwards compatibility for http_build_query, which is not available prior to PHP 5.
    * Bug [[2714647][3]]: Added error message for when an event's ending time is before the starting time. While this was being checked, it was not being reported to the user.

_February 11, 2009_ \- **Second Beta 2.3.0 Rev. 541 Released for Testing**

* This is the last beta release. The release candidate will be released mid-March.
* See the [change log][4] for a detailed list of changes.

_November 12, 2008_ \- **First Beta 2.3.0 Rev. 505 Released for Testing**

* 2.3.0 is now considered to be feature complete.
* Major changes since the third alpha:
    * Added 'RSS Feed' links to the 'Subscribe &amp; Download' page.
    * The database upgrade script now supports PostgreSQL for fresh installs, and PostgreSQL 8+ for upgrading an existing database.
    * RSS and iCal files are now cached in a [completely different way][5].
* See the [change log][6] for more changes.

_October 16, 2008_ \- **Third Alpha 2.3.0 Rev. 382 Released for Testing**

* This is a small, but critical, fix to the second alpha.
* Changes since second alpha:
    * Bug fix: Database upgrade script now properly inserts the records for the default calendar when doing a fresh install.
    * Renamed images/Go.gif to images/go.gif for case sensitive file systems.
    * Made sure all TIMESTAMP columns are NOT NULL since it they cannot be NULL in MySQL. Was confusing the database upgrade script.

_October 15, 2008_ \- **Second Alpha 2.3.0 Rev. 375 Released for Testing**

* Changes since first alpha:
    * Converted most DB columns from 'text' to more specific types (i.e. varchar, timestamp, int, etc)
    * Revamped exporting with new export types including RSS 2.0, HTML (optionally wrapped with document.write) and JavaScript.
    * Fixed bug where an event's end time could be before the begin time.
    * Added RSS  in the  to allow browsers to detect the calendar's RSS feed.
    * Timezone setting changed to use PHP's built in TZ variable to adjust the calendar's time.
    * Better support for PostgreSQL (based on testing with version 8.3)
    * When main admins login, VTCalendar will check to see if a new version is available.
    * Links added to update.php to the forums, mailing list, etc.
    * Moved a lot of inline text to the $lang array.
    * The english language file is now always included. If LANGUAGE is something besides 'en' then that file will also be included. Other language files will only need to override what is translated, and will not need to include everything from en.inc.php.
    * Pear::Mail can now be used to send e-mail via SMTP. The sendmail() function can also be overridden to use any other method of sending e-mail.
    * Added Swedish as an available language [[1440229][7]]. Thanks Björn Wiberg!
    * HTML can now be included before/after the header and before/after the footer from static files. This allows for standard headers and footers throughout all calendars. Does not apply to the default calendar.
    * The number of years that events can be added to is now customizable.
    * Added new "view authentication" mode that allows any successfully authenticated user to view the calendar.
    * Table names can now be prefixed with something like 'public.' to allow for use of multiple schema in PostgreSQL.
    * Improved print view when a sponsor is logged in.
    * Bug fix [[1421279][8]]: Sponsors can now view the calendar regardless of what users are entered into the box under "Login required for viewing the calendar?".

_October 1, 2008_ \- **Alpha 2.3.0 Rev. 215 Released for Testing**

* See [change log][9] for list of changes in this release.

_September 24, 2008_ \- **Development of VTCalendar Resumes**

* Andre Mekkawi has taken over development of VTCalendar.
* A new version, 2.3.0, is being developed. See the "[Features][10]" section below.
It is currently in **pre-alpha** and is available in the SVN repository.

_See older announcements in the [archive][11]._

[1]: http://vtcalendar.sourceforge.net/docs/install/2.3.0.php
[2]: https://sourceforge.net/tracker/?func=detail&amp;aid=2722268&amp;group_id=131443&amp;atid=721062
[3]: https://sourceforge.net/tracker/?func=detail&amp;aid=2714647&amp;group_id=131443&amp;atid=721062
[4]: http://vtcalendar.sourceforge.net/docs/changelog.php#2_3_0Rev541
[5]: http://vtcalendar.sourceforge.net/docs/cache/index.php
[6]: http://vtcalendar.sourceforge.net/docs/changelog.php#2_3_0Rev505
[7]: https://sourceforge.net/tracker/index.php?func=detail&amp;aid=1440229&amp;group_id=131443&amp;atid=721065
[8]: https://sourceforge.net/tracker/index.php?func=detail&amp;aid=1421279&amp;group_id=131443&amp;atid=721062
[9]: http://vtcalendar.sourceforge.net/docs/changelog.php#2_3_0Rev215
[10]: http://vtcalendar.sourceforge.net#Features
[11]: http://vtcalendar.sourceforge.net/announcements/index.php
  
