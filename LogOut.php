<!-- This is the php code that destroys a users session and all session variables before redirecting them to LogIn.html when they choose to Logout -->

	<?php
		session_start();
		session_destroy();
		header("Location: LogIn.html");

	?>