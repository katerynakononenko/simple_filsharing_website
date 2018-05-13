<!-- This is the php code for uploading a user's file to their personal directory on the server -->

<?php

session_start();


/*this is where the file will be sent to the user's 'file folder' */

// Get the filename and make sure it is valid, using the regex to filter out invalid input
$filename = basename($_FILES['UploadedFile']['name']);
echo $filename;
if( !preg_match('/^[\w_\s*\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

// Get the username and make sure it is valid
$username = $_SESSION['Username'];
echo $username;
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

//path of where to put the files
$full_path = sprintf("/srv/Module2Uploads/%s/%s", $username, $filename);

//actually moving the file to the path and printing out a failure message if not able to complete the upload
if(move_uploaded_file($_FILES['UploadedFile']['tmp_name'], $full_path) ){
	header("Location: Main.php");
	exit;
}else{
	echo "There was a failure to upload!";
	exit;
}

?>