			</div>
		</div>
		
		<div id="footer">
			<div class="bound">
				<div class="login">
					<?php if (fAuthorization::checkLoggedIn()) { ?>
						<a href="manage">Manage</a> |
						<a href="user/log_out">Log Out</a>
					<?php } else { ?>
						<a href="user/log_in">Log In</a>
					<?php } ?>
				</div>
				&copy; <?php echo date('Y') ?> Will Bond
			</div>
		</div>
	</body>
</html>