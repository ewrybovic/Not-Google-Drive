<?php
/*
* Uploads a file from the clients computer to the server
*/
session_start();

// Get current directory of php script
//$target_dir = getcwd();// . "/users/";
$target_dir = "/var/www/html/users/". $_SESSION['login_user'] . "/";
//$target_dir = "/home/server/Desktop/";

// Concatinate the target directory and the file name
$target_file_dir = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if(isset($_POST["submit"]))
{

	// Check if the file exists on the server
	if(file_exists($target_file_dir))
	{
		echo "<p>File already exists, updating file</p>";
	}

	// Move uploaded file to target
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_dir))
	{
		echo "<p>The file " . basename($_FILES['fileToUpload']['name']) . " has been uploaded<p>";

		// Redirect back to profile page
		header("Location:profile.php");
		exit();
	}
	else
	{
		echo "<p>" .  basename($_FILES['fileToUpload']['name']) . "</p>";
		echo "<p>" .  basename($_FILES['fileToUpload']['tmp_name']) . "</p>";
		echo "<p>" .  $target_file_dir .  "</p>";
		echo "<h1>Sorry an error happened</h1>";
	}
}
?>