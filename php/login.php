<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <?php
  session_start();
  error_reporting( E_ALL );
  ini_set('display_errors', 1);

  $hostName = "localhost";
  $userName = "server";
  $dbpassword = "1234567890";


  $link = mysqli_connect($hostName, $userName, $dbpassword);
  // check if connection was successful
  if (!$link)
  {
    die ("Connection Failed:" . mysqli_connect_error());
  }

  //connect to db
  $dbName = "test";
  $connectToDB = mysqli_select_db($link, $dbName) or die ("Unable to connect to host $hostName");

  function clean_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  error_reporting( E_ALL );
  ini_set('display_errors', 1);

  if (isset($_POST['login_user'])) {

    $useremail = clean_input($_POST['useremail']);
    $password = clean_input( $_POST['password']);

    $sql = "SELECT * FROM `users` WHERE `email` LIKE '$useremail' AND `pass` LIKE '$password'";
    $result=mysqli_query($link, $sql);
    $num_rows=mysqli_num_rows($result);

    echo $num_rows;
    if($num_rows>0) {
      echo "found users";
      $_SESSION['login_user'] = $useremail;
      $_SESSION['login_pass'] = $password;
      header("location:profile.php");
    }
    else {
      echo "no users on database";
    }

  }

  mysqli_close($link);
  ?>

</body>
</html>
