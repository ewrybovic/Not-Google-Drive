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
  <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
  //user directory name files;
  $files = scandir("../users/");
  for ($i=2; $i < count($files) ; $i++) {
    // add $user in session
    echo "<p><a href= \"../users/" .$files[$i]. "\"download>" . $files[$i]. "</a>";
  }
?>
</head>
</html>
