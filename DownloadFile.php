<!-- This is the php code for locating and downloading a user's file from their personal directory on the server -->

<?php

	session_start();

	// Get the filename and make sure it is valid
	$filename = $_GET['DownloadFileName'];
	
	if( !preg_match('/^[\w_\s*\.\-]+$/', $filename) ){
	 	echo "Invalid filename";
	 	exit;
	 }

	//Get the username and make sure it is valid
	 $username = $_SESSION['Username'];
	 if( !preg_match('/^[\w_\s*\-]+$/', $username) ){
	 	echo "Invalid username";
	 	exit;
	 }

	 $full_path = sprintf("/srv/Module2Uploads/%s/%s", $username, $filename);
	 echo $full_path;
	 if (file_exists($full_path)){
	 	// this would allow the pictures, pdfs and html to be viewed, while other types of files will be downloaded
	 	if (mime_content_type($full_path) == 'image/gif' || mime_content_type($full_path) == 'image/jpeg' || mime_content_type($full_path) == 'image/png' || mime_content_type($full_path) == 'application/pdf'|| mime_content_type($full_path) == 'text/plain' || mime_content_type($full_path) == 'text/html'){

	 	$finfo = new finfo(FILEINFO_MIME_TYPE);
	 	$mime = $finfo->file($full_path);
	 	header("Content-Type: ".$mime);
	 	ob_get_clean();
	 	readfile($full_path);
	 	ob_end_flush();
	 	exit;
	 	}

	 	// all of the following headers to help download the files were (mostly) taken from https://stackoverflow.com/questions/8485886/force-file-download-with-php-using-header

	 	header('Content-Description: File Transfer');
	 	header('Content-Type: application/octet-stream');
	 	header("Content-Disposition: attachment; filename=" . $filename);
	 	header('Expires: 0');
	 	header('Cache-Control: must-revalidate');
	 	header('Pragma: public');
	 	header('Content-Length: '.filesize($full_path));
	 	ob_get_clean();
    	readfile($full_path);
    	ob_end_flush();
    	exit;

	 } else {
	 	echo "No file like that!";
	 	exit;
	 }


?>