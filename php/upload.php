<?php
/*
* Uploads a file from the clients computer to the server
*/

// Get current directory of php script
//$target_dir = getcwd();// . "/users/";
$target_dir = "/var/www/html/users/";

// Concatinate the target directory and the file name
$target_file_dir = $target_dir . basename($_FILES["file"]["name"]);

if(isset($_POST["submit"]))
{

	// Check if the file exists on the server
	if(file_exists($target_file_dir))
	{
		echo "<p>File already exists, updating file</p>";
	}

	// Move uploaded file to target
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_dir))
	{
		echo "<p>The file " . basename($_FILES['file']['name']) . " has been uploaded<p>";
	}
	else
	{
		echo "<h1>Sorry an error happened</h1>";
	}
}
?>