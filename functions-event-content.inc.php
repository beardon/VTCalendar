<?php
function print_event($event, $linkfeatures=true) {
	?>
	<table id="EventTable" width="100%" border="0" cellpadding="6" cellspacing="0">
		<tr>
			<!-- Start Left Column -->
			<td id="EventLeftColumn" valign="top" align="center" nopwrap><b>
				<?php 
					if ($event['wholedayevent']==0) {
						echo timestring($event['timebegin_hour'],$event['timebegin_min'],$event['timebegin_ampm']);
						if ( ! ($event['timeend_hour']==DAY_END_H && $event['timeend_min']==59) ) {
							echo "<br>",lang('to'),"<br>";
							echo timestring($event['timeend_hour'],$event['timeend_min'],$event['timeend_ampm']);
						}
					}
					else {
						echo lang('all_day'),"\n";
					}
				?></b></td>
			
			<!-- Start Right Column -->
			<td id="EventRightColumn" width="100%" valign="top">
				<div id="EventTitle"><b><?php echo htmlentities($event['title']); ?></b></div>
				<div id="EventCategory">(<?php echo htmlentities($event['category_name']); ?>)</div>
				<?php 
				if (!empty($event['description'])) {
					?><p id="EventDescription"><?php echo str_replace("\r", "<br>", make_clickable(htmlentities($event['description']))); ?></p><?php
				}
				?>
				
				<div id="EventDetailPadding"><table id="EventDetail" border="0" cellpadding="6" cellspacing="0"><?php 
					
					if (!empty($event['location'])) {
						?>
						<tr> 
							<td class="EventDetail-Label" align="left" valign="top" nowrap><strong><?php echo lang('location'); ?>:</strong></td>
							<td><?php echo htmlentities($event['location']); ?></td>
						</tr>
						<?php
					} // end: if (!empty($event['location'])) {
					
					if (!empty($event['price'])) {
						?>
						<tr> 
							<td class="EventDetail-Label" align="left" valign="top" nowrap><strong><?php echo lang('price'); ?>:</strong></td>
							<td><?php echo htmlentities($event['price']); ?></td>
						</tr>
						<?php
					} // end: if (!empty($event['price'])) {
					
					if (!empty($event['displayedsponsor'])) {
						?>
						<tr> 
							<td class="EventDetail-Label" align="left" valign="top" nowrap><strong><?php echo lang('sponsor'); ?>:</strong></td>
							<td><?php 
								if (!empty($event['displayedsponsorurl'])) {
									echo '<a href="',$event['displayedsponsorurl'],'">';
									echo htmlentities($event['displayedsponsor']);
									echo "</a>";
								}
								else {
									echo htmlentities($event['displayedsponsor']);
								}
							?></td>
						</tr>
						<?php
					} // end: if (!empty($event['displayedsponsor'])) {
					
					if (!empty($event['contact_name']) ||
							!empty($event['contact_email']) ||
							!empty($event['contact_phone']) )
					{
						?>
						<tr> 
							<td class="EventDetail-Label" align="left" valign="top" nowrap><strong><?php echo lang('contact'); ?>:</strong></td>
							<td><?php
								if (!empty($event['contact_name']) )
									{ echo htmlentities($event['contact_name']),"<br>"; }
								if (!empty($event['contact_email']) )
								{ 
									echo '<img src="images/email.gif" width="20" height="20" alt="',lang('email'),'" align="absmiddle">';
									echo " <a href=\"mailto:",htmlentities($event['contact_email']),"\">",htmlentities($event['contact_email']),"</a><br>";
								}
								if (!empty($event['contact_phone']) )
								{ 
									echo '<img src="images/phone.gif" width="20" height="20" align="absmiddle"> ';
									echo htmlentities($event['contact_phone']),"<br>";
								} 
							?></td>
						</tr>
						<?php
					} // end: if (...)
					?>
				</table>
				</div>
				<?php
				if ($linkfeatures) {
					?>
					<div id="iCalendarLink">
							<?php
							if (!empty($event['id'])) {
								?>						
								<a href="<?php echo EXPORT_PATH; ?>?calendarid=default&format=ical&id=<?php echo urlencode($event['id']); ?>"><img 
									src="images/vcalendar.gif" width="20" height="20" border="0" align="absmiddle"></a>
								<a href="<?php echo EXPORT_PATH; ?>?calendarid=default&format=ical&id=<?php echo urlencode($event['id']); ?>"><?php echo lang('copy_event_to_pda'); ?></a>
								<?php
							}
							?>
					</div>
					<?php
				} ?>
			</td>
		</tr>
	</table>
<?php		
} // end: Function print_event

function adminButtons($eventORshowdate, $buttons, $size, $orientation) {
	if (is_array($buttons)) {
	
		if (isset($eventORshowdate['id']) && !isset($eventORshowdate['eventid'])) {
			$eventORshowdate['eventid'] = $eventORshowdate['id'];
		}
		elseif (!isset($eventORshowdate['id']) && isset($eventORshowdate['eventid'])) {
			$eventORshowdate['id'] = $eventORshowdate['eventid'];
		}
		?>
		<div <?php if ($size=="small") { echo 'id="AdminButtons-Small"'; } ?>>
		<table id="AdminButtons" border="0" cellpadding="3" cellspacing="0">
			<tr>
				<?php
				foreach ($buttons as $button) {
					if ($button == "new") {
						$IDExt = '-New';
						$HRef = 'addevent.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']);
						if (isset($eventORshowdate['year']) && isset($eventORshowdate['month']) && isset($eventORshowdate['day'])) {
							$HRef .= '&timebegin_year=' . $eventORshowdate['year'] . '&timebegin_month=' . $eventORshowdate['month'] . '&timebegin_day=' . $eventORshowdate['day'];
						}
						if ($size == "small") {
							$Label = "New";
						}
						else {					
							$Label = lang('add_new_event');
						}
					}
					elseif ($button == "approve") {
						$IDExt = '-Approve';
						$HRef = 'approval.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&';
						if (!empty($eventORshowdate['repeatid'])) {
							$HRef .= "approveall=1";
						}
						else {
							$HRef .= "approvethis=1";
						}
						$HRef .= '&eventid=' . $eventORshowdate['eventid'];
						$Label = lang('approve');
					}
					elseif ($button == "reject") {
						$IDExt = '-Reject';
						$HRef = 'approval.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&reject=1&eventid=' . $eventORshowdate['eventid'];
						$Label = lang('reject');
					}
					elseif ($button == "edit") {
						$IDExt = '-Edit';
						$HRef = 'changeeinfo.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&eventid=' . $eventORshowdate['eventid'];
						$Label = lang('edit');
					}
					elseif ($button == "update") {
						$IDExt = '-Edit';
						$HRef = 'changeeinfo.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&eventid=' . $eventORshowdate['eventid'];
						$Label = 'Update';
					}
					elseif ($button == "copy") {
						$IDExt = '-Copy';
						// Note: Do not use &copy in the URL. Some browsers will think you are trying to do &copy; which is a copyright symbol.
						$HRef = 'changeeinfo.php?copy=1&calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&eventid=' . $eventORshowdate['eventid'];
						$Label = lang('copy');
					}
					elseif ($button == "delete") {
						$IDExt = '-Delete';
						$HRef = 'deleteevent.php?calendarid='.urlencode($_SESSION['CALENDAR_ID']).'&check=1&eventid=' . $eventORshowdate['eventid'];
						$Label = lang('delete');
					}
					
					if ($orientation == "vertical") {
						echo '<tr>';
						echo '<td style="padding-bottom: 3px !important;">';
					}
					else {
						echo '<td style="padding-right: 5px !important;">';
					}
					
					echo '<a id="AdminButtons' . $IDExt . '" href="' . $HRef . '">' . $Label . '</a></td>';
					if ($orientation == "vertical") { echo '</tr>'; }
				}
				?>
			</tr>
		</table>
		</div>
		<?php
	}
}

?>