<!-- This is the main page where users can access/upload their own files privately stored on the server -->

<!DOCTYPE html>
<head>
	<title>Main Page: Module 2 Group</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
</head>

<body>
	
	<?php
		session_start();
		$user = $_SESSION['Username'];
		printf("<p id='UserText'>Hello %s</p>\n", 
			htmlentities($user)
		);

	?>

	<div id="UploadForm">
	<form enctype="multipart/form-data" action="FileUpload.php" method="POST">

		<h1>
			Upload a file:
		</h1>

		
		<input type="file" name="UploadedFile" id="UploadButton">
		<input type="submit" name="upload">

	</form>
	</div>

	<h1>
		Your Files
	</h1>

	<div id="FilesDiv">
	<?php
		$full_path = sprintf("/srv/Module2Uploads/%s", $user);
		$file_array = array_diff(scandir($full_path), array('.', '..'));

		foreach ($file_array as $file_name) {
			if ($file_name != '.' || $file_name != '..') {
				echo "<span class='FileText'>".$file_name."</span>";
				echo "   ";


				$Download_link = sprintf("http://ec2-18-217-124-67.us-east-2.compute.amazonaws.com/Module2Group/spring2018-module2-group-451806-435393/DownloadFile.php?DownloadFileName=%s&Download=Submit", $file_name);
				echo '<a href="'.$Download_link.'">Download</a>';

				echo "   ";

				$Delete_link = sprintf("http://ec2-18-217-124-67.us-east-2.compute.amazonaws.com/Module2Group/spring2018-module2-group-451806-435393/FileDelete.php?DeletedFile=%s&Delete=Submit", $file_name);
				echo '<a href="'.$Delete_link.'">Delete</a>';


				echo "<br />";
				
			}
			

		}
	?>
	</div>
	<br />
	<br />
	<br />
	<br />
	<br />
	<div id="LogoutDiv">	
		
		<form action="LogOut.php">
			
    		<input type="submit" value="Logout" />
		</form>
	</div>



</body>
</html>