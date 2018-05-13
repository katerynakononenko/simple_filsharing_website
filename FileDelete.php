<!-- this is the php code for locating and removing a user's file from their personal directory on the server -->

<?php

session_start();


/*this is where the file will be sent to the user's 'file folder' */

// Get the filename and make sure it is valid
$filename = $_GET['DeletedFile'];
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
if (file_exists($full_path)){
unlink($full_path);
header("Location: Main.php");
exit;
} else {
echo "No file like that!";	
}

?>