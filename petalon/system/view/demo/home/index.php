<?php
$tmpl->place('header');
?>
<div class="primary">

	<?php
	$first = TRUE;
	foreach ($meetups as $meetup) {
		?>
		<h2><?php echo $meetup->prepareDate('l, F j<\s\u\p>S</\s\u\p>, Y') ?></h2>
		<div class="location">
			at <strong><?php echo $meetup->prepareVenue() ?></strong>
			in <strong><?php echo $meetup->prepareCity() ?>, <?php echo $meetup->prepareState() ?></strong>
		</div>

		<?php echo $meetup->prepareDescription(TRUE) ?>

		<h3>Meetup Details</h3>

		<ul>
			<li><strong>Date:</strong> <?php echo $meetup->prepareDate('l, F j<\s\u\p>S</\s\u\p>') ?></li>
			<li><strong>Start:</strong> <?php echo $meetup->prepareStartTime('g:i a') ?></li>
			<li><strong>End:</strong> <?php echo $meetup->prepareEndTime('g:i a') ?></li>
			<li>
				<strong>Location:</strong>
				<?php
				if ($meetup->getVenueWebsite()) {
					?>
					<a href="<?php echo $meetup->prepareVenueWebsite() ?>"><?php echo $meetup->prepareVenue() ?></a>
					<?php
				} else {
					echo $meetup->prepareVenue();
				}
				?>
			</li>
		</ul>

		<h3>On Other Sites</h3>
		<ul>
			<li><a href="http://www.facebook.com/group.php?gid=13809661338">NSWG Facebook Group</a></li>
			<?php
			if ($meetup->getYahooUpcomingUrl()) {
				?>
				<li><a href="<?php echo $meetup->prepareYahooUpcomingUrl() ?>">Yahoo Upcoming <?php echo $meetup->prepareDate('F Y') ?></a></li>
				<?php
			}
			?>
		</ul>
		<?php
		if ($first) {
			$first = FALSE;
			?>
			<h3>Travel Tips</h3>

			<ul>
				<li><strong>By Automobile</strong>: Downtown Newburyport is ~3 miles off of Interstate 95, so it’s very easy to find and fast to get into/out of by car.</li>
				<li><strong>By Commuter Rail</strong>: Newburyport is at the end of the commuter rail and the train station is about a mile away from the pub (<a href="http://www.mbta.com/schedules_and_maps/rail/lines/?route=NBRYROCK&amp;direction=O&amp;timing=W&amp;RedisplayTime=Redisplay+Time">commuter rail schedule</a>)</li>
			</ul>

			<?php
			if ($meetup->getGoogleMapsHtml()) {
				echo $meetup->prepareGoogleMapsHtml();
			}
		}
	}
	?>

</div>

<div class="secondary">
  <?php $tmpl->place('right_block') ?>
</div>
<?php $tmpl->place('footer') ?>