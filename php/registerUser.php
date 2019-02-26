<html>
<body>
MSG:
<?php
	// remove comments/echos and clean up before merging to master
	//connect to server
	echo ("connecting to server |> ");
	$hostName = "localhost";
	$userName = "server";
	$password = "1234567890";
	echo("attempting connection|> ");
	$link = mysqli_connect($hostname, $userName, $password);
	// check if connection was successful
	if (!$link)
	{
		die ("Connection Failed:" . mysqli_connect_error());	
	}
	echo ("connecting to db |> ");
	//connect to db
	$dbName = "test";
	$connectToDB = mysqli_select_db($link, $dbName) or die ("Unable to connect to host $hostName");

	// get information from forms and prep for db queary
	$uName = $uEmail = $uPassword = "";
	$values = array();
	// to check in the end of any of the fields were missing, might need to expand this one
	$missingField = false;
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		echo ("Request method is post...");
		// check user name is valid and enterd 
		if (empty($POST["inputName"]))
		{
			// tell page that user name is required
			$missField = True;
		} else
		{
			$uName = clean_input((string)$_POST['inputName']);
			// check if name only has letter and numbers
			if (!preg_match("/^[a-zA-Z][0-9]*$/",$uName)) 
			{
				echo("Only letters and numbers allowed |X");
			}
		}
		
		// check user email is valid and enterd 
		if (empty($POST["inputEmail"]))
		{
			// tell page that user name is required
			$missField = True;
		} else
		{
			$uEmail = clean_input((string)$_POST['inputEmail']);
			// check if name only has letter and numbers
			if (!filter_var($uEmail,FILTER_VALIDATE_EMAIL)) 
			{
				echo("Invalid Email format |X");
			}
		}

		// check user pw is valid and enterd 
		if (empty($POST["inputPw"]))
		{
			// tell page that user name is required
			$missField = True;
		} else
		{
			$uP = password_hash(clean_input((string)$_POST['inputPw']), PASSWORD_DEFAULT);
			$uConfP = password_hash(clean_input((string)$_POST['inputConfirmPw']), PASSWORD_DEFAULT);
			// check if name only has letter and numbers
			if ($uP == $uConfP) 
			{
				echo("passwords do not match |X");
			}
		}
	}
	//read sql command
	//$values = array((string)$_POST['inputName'], (string)$_POST['inputEmail'], (string)$_POST['inputPassword'], $filePath);
	if (!$missField)
	{
		//set up values to be in query
		$filePath = "/home/" . $uName;
		$values = array_push($values, $uName, $uEmail, $uP, $filePath);
		$positions = array("$1", "$2", "$3", "$4");

		//read querya nd replace values with form ones
		$getString = file_get_contents("AddUserTable.sql");
		$SQL = str_replace($positions, $values, $getString);

		echo ($SQL);
		$Query = mysqli_query($link, $SQL) or die("Unable to run query $SQL");	
		
		echo ("Done |X");
	} else
	{
		$values = array_push($values, $uName, $uEmail, $uP, $filePath);
		print_r ("Values: " + (string)$values);
		echo ("missing field |X");
	}
	mysqli_close($link);
	function clean_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
?>
<br>

</body>
</html>
