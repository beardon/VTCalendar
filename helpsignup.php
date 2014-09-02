<?php
require_once('application.inc.php');

	helpwindow_header();
?>
<h3><img src="images/help.gif" width="16" height="16" alt="" border="0">
<?php echo lang('help_signup'); ?>
</h3>
<?php echo lang('help_signup_authorization'); ?>
<a href="mailto:<?php echo htmlentities($_SESSION['CALENDAR_ADMINEMAIL']); ?>"><?php echo htmlentities($_SESSION['CALENDAR_ADMINEMAIL']); ?></a>.
<?php echo lang('help_signup_contents'); ?>
<?php
	helpwindow_footer();
?>