<?php
include ('login.php');
if((!isset($_SESSION['login_user']))||(!isset($_SESSION['login_pass']))){
  header("location: ../index.php");
}
echo $_SESSION['login_user'];
echo $_SESSION['login_pass'];
?>
<!DOCTYPE html>
<html>
<head>
  <a href = "logout.php"> LogOut</a></b>
</head>
</html>
