<!-- This is the php code to append the private users.txt file on the server and create the assiciated directory for a newly created account -->

<?php
		session_start();
		$new_User= $_POST["newUserName"];
		$full_path = sprintf("/srv/Module2Uploads/%s", $new_User);
		//$user = $_SESSION['Username'];
		$file = "/srv/Module2Uploads/users.txt";

		$fp = fopen($file,"a") or die("Couldn't open $file");
		$oldmask = umask(0);
		mkdir("$full_path", 0777);
		umask($oldmask);
		fputs($fp, "\n");
		fputs($fp, "$new_User");
		fclose($fp);
		header("Location: LogIn.html");
		session_destroy();

	?>