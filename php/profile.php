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

<input type="text" id="input" onkeyup="SearchFunction()"><br/>
<ul id="list">
<?php
  //user directory name files;
  $files = scandir("../users/".$_SESSION['login_user']);
  for ($i=2; $i < count($files) ; $i++) {
    // add $user in session
    echo "<li><a href= \"../users/" .$files[$i]. "\"download>" . $files[$i]. "</a></li><br/>";
  }
?>
</ul>
</head>
</html>
<script type="text/javascript">

function SearchFunction()
{

  // Get input from textbox
  var input = document.getElementById('input').value;
  list = document.getElementById('list').getElementsByTagName('li');
  if (input)
  {
    //list.innerHTML += jsonData;
    //for(var i = 0; i < filenames.length; ++i)
    //elements.forEach(function(filename)
    for(i =0; i < list.length; i++)
    {
      filename = list[i].getElementsByTagName("a")[0];
      filename = filename.textContent || filename.innerHTML;
      // Check if input is in the filename
      if (filename.indexOf(input) > -1)
      {
        list[i].style.display = "";
      }
      else
      {
        list[i].style.display = "none";
      }
    }
  }
}
</script>