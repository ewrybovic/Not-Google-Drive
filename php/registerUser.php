<html>
<body>
MSG:
<?php
	// remove comments/echos and clean up before merging to master
	//connect to server
	$debugMode = true;
	$hostName = "localhost";
	$userName = "server";
	$password = "1234567890";
	$link = mysqli_connect($hostname, $userName, $password);
	// check if connection was successful
	if (!$link)
	{
		die ("Connection Failed:" . mysqli_connect_error());	
	}
	//connect to db
	$dbName = "Users";
	$connectToDB = mysqli_select_db($link, $dbName) or die ("Unable to connect to host $hostName");

	// get information from forms and prep for db queary
	$uName = $uEmail = $pwHash = "";
	$values = array();
	// to check in the end of any of the fields were missing, might need to expand this one
	$missingField = false;
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if ($debugMode){
			echo((string)$_POST["inputUsername"]);
			echo("||");
			echo((string)$_POST["inputEmail"]);
			echo("||");
			echo((string)$_POST["inputPassword"]);
			echo("||");
			echo((string)$_POST["inputConfirmPw"]);
			echo("||");
			echo ("Request method is post...");
		}
		// check user name is valid and enterd 
		if (empty($_POST["inputUsername"]))
		{
			// tell page that user name is required
			echo("Empty Username");
			$missingField = True;
		} else
		{
			$uName = clean_input((string)$_POST['inputUsername']);
			// check if name only has letter and numbers
			if (!preg_match("/^[a-zA-Z0-9]*$/",$uName)) 
			{
				echo("Only letters and numbers allowed |X");
				$missingField = True;
			}
		}
		
		// check user email is valid and enterd 
		if (empty($_POST["inputEmail"]))
		{
			// tell page that user name is required
			echo("Empty email");
			$missingField = True;
		} else
		{
			$uEmail = clean_input((string)$_POST['inputEmail']);
			// check if nvalide email
			if (!filter_var($uEmail,FILTER_VALIDATE_EMAIL)) 
			{
				echo("Invalid Email format |X");
				$missingField = True;
			}
		}

		// check user pw is valid and enterd 
		if (empty($_POST["inputPassword"]))
		{
			// tell page that user name is required
			echo("empty password || confirm pw");
			$missingField = True;
		} else
		{
			$pwHash = password_hash(clean_input((string)$_POST['inputPassword']), PASSWORD_DEFAULT); //generate a hash for this 
			// check if hashed password is equal to the hash of the confirm password 
			if (!password_verify(clean_input((string)$_POST['inputConfirmPw']), $pwHash)) 
			{
				echo("passwords do not match |X");
				$missingField = True;
			}
			else{ # stores plain text password, need to update login.php for hashed pw
				$pwHash = clean_input((string)$_POST['inputConfirmPw']);
			}
		}
	}
	//read sql command
	//$values = array((string)$_POST['inputUsername'], (string)$_POST['inputEmail'], (string)$_POST['inputPassword'], $filePath);
	if (!$missingField)
	{
		//set up values to be in query
		$filePath = "/home/" . $uName;
		$values = array($uName, $pwHash, $uEmail, $filePath);
		$positions = array("uname", "pwhash", "uemail", "fp");

		//read querya nd replace values with form ones
		$getString = file_get_contents("../sql/AddUserTable.sql");
		$SQL = str_replace($positions, $values, $getString);
		
		if ($debugMode){
			echo ($SQL);
		}

		//$Query = mysqli_query($link, $SQL) or die("Unable to run query");
		if (!mysqli_query($link, $SQL)) {
			printf("Errormessage: %s\n", mysqli_error($link));
		}
		else{
			echo ("Done |X");
			mkdir("../users/" . $_POST['inputUsername']);
			header("location:../login.html");
		}

	} else
	{
		header("Location:../register.html");
		// add buttons to return 
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
