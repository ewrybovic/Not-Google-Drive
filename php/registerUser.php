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
	if (!$link)
	{
		die ("Connection Failed:" . mysqli_connect_error());	
	}
	echo ("connecting to db |> ");
	//connect to db
	$dbName = "test";
	$connectToDB = mysqli_select_db($link, $dbName) or die ("Unable to connect to host $hostName");
	//read sql command
	$filePath = "/home/" . (string)$_POST['name'];
	$values = array((string)$_POST['name'], (string)$_POST['pw'], (string)$_POST['email'], $filePath);
	$positions = array("$1", "$2", "$3", "$4");
	$getString = file_get_contents("AddUserTable.sql");
	$SQL = str_replace($positions, $values, $getString);

	echo ($SQL);
	$Query = mysqli_query($link, $SQL) or die("Unable to run query $SQL");	
	
	mysqli_close($link);
	echo ("Done |X");
	
?>
<br>

</body>
</html>
