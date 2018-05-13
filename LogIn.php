<!-- This is the php code to validate that the username entered on the LogIn.html page exists in the private users.txt file stored on the server -->

<?php
session_start();

$possible_User= $_POST["userName"];
$full_path_txt = "/srv/Module2Uploads/users.txt";
$user_array = array();
$user_file = fopen($full_path_txt, "r") or die("Unable to open file!");

while( !feof($user_file) ){
		$text = trim(fgets($user_file));
		array_push($user_array, $text);
}
fclose($user_file);


foreach ($user_array as $user){
	if ($user == $possible_User && $user != ""){
		echo "You are in!";
		$_SESSION['Username'] = $possible_User;
		print_r($_SESSION);
		header("Location: Main.php");
		exit; 
		break;
	}
}
		echo "No user like that! Please go back to the Log In page";
		exit;
	


?>