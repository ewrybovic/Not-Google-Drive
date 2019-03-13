<?php

	// Function for deleting file
	// Returns array of two values:
	//		worked - boolean; true if worked false otherwise
	//		error - string; "none" if worked, 
	//						"unlink" if could not unlink, 
	//						"no_file" if no file found  
	// TODO Check if file is a filder and delete folder
	function deleteFile($filePath)
	{
		$didWork = array(
				"worked" => false,
				"error" => "none"
				);
		// Check if file exists
		if (file_exists($filePath))
		{
			// Deletes the file
			if (unlink(realpath($filePath)) === true)
			{
				$didWork["worked"] = true;
			}
			else
			{
				$didWork["error"] = "unlink";
			}
		}
		else
		{
			$didWork["error"] = "no_file";
		}

		return $didWork;
	}

//var_dump(deleteFile("test.txt"));
?>