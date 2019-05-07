<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Not Google Drive</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/freelancer.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/login.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="index.php">Not Google Drive</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li>
            <?php
              session_start();
              $user_name = $_SESSION['login_user'];
              echo "<a style= 'color:white;' class='nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger'>"."Welcome "."$user_name"."</a>";
             ?>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="login.html">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!-- File List -->

<section id="files">
   <div class="file-view-container">

    <br /><br /><br />

        <form action="php/upload.php" method="post" enctype="multipart/form-data">
          <div class="download">
            <input class="inputLogin" type="file" name="fileToUpload" id="fileToUpload" required>
            <input class="upload-button" type="submit" name="submit" value="Upload File">
            <input class="inputLogin" id="input" type="text" onkeyup="SearchFunction()" placeholder="Type the file name here to search" style="width:300px;"></input>
          </div>
        </form>

    <!-- search bar -->
    <span style="width:50%">
    </span>

    <!-- file list -->
    <table class="table table-bordered"  id="list">
      <thead>
        <tr class="table-header">
          <th><h5>Filename</h5></th>
          <th><h5>Last Modified</h5></th>
          <th><h5>Size</h5></th>
          <th><h5>Delete</h5></th>
        </tr>
        <?php
        session_start();
        $folder_name = $_SESSION['login_user'];
        echo "<br>";
        echo "<h5 style='text-align:center;'>Folder's name: ";
        echo "$folder_name"."/</h5>";
        echo "<h5 style='text-align:center;'>Total files count: ";
        $target_dir = "users/". $_SESSION['login_user'] . "/";
        $files = scandir("$target_dir");
        $index_count = count($files)-2;
        print ("$index_count files<br>\n</h5>");
        echo "<br>";
        clearstatcache();
          for ($i=2; $i < count($files) ; $i++) {
            // code...
            echo "<tr class = 'file'>";
            echo "<th>";
            echo "<a href= \"$target_dir" .$files[$i]. "\"download>" . $files[$i]. "</a>";
            echo "</th>";

            echo "<th>";
            echo "". date ("F d Y H:i:s.", filemtime($target_dir."/".$files[$i]));

            echo "</th>";

            echo "<th>";
            echo "". filesize($target_dir."/".$files[$i]) . " bytes";
            echo "</th>";


            echo "<th>";
            echo "<a href ='php/delete_file.php?name=$target_dir"."$files[$i]' name= 'delete'>Delete</a>";
            echo "</th>";

            echo "</tr>";

          }

        ?>
      </thead>

    </table>


  </div>
</section>

  <!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4">Location</h4>
          <p class="lead mb-0">800 N State College Blvd
            <br>Fullerton, CA 92831</p>
        </div>
        <div class="col-md-4 mb-5 mb-lg-0">
          <h4 class="text-uppercase mb-4">Around the Web</h4>
          <ul class="list-inline mb-0">
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-facebook-f"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-google-plus-g"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-twitter"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-linkedin-in"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                <i class="fab fa-fw fa-dribbble"></i>
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
          <h4 class="text-uppercase mb-4">About Not Goolge Drive</h4>
          <p class="lead mb-0">It is a online place for files management.
        </div>
      </div>
    </div>
  </footer>
  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <small>Copyright &copy; CPSC 466 TEAM</small>
    </div>
  </div>
  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top d-lg-none position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/freelancer.min.js"></script>


<script>
function SearchFunction()
{
   // Get input from textbox
  var input = document.getElementById('input').value;
  list = document.getElementById('list');
  if (input)
  {
    //list.innerHTML += jsonData;
    //for(var i = 0; i < filenames.length; ++i)
    //elements.forEach(function(filename)
    //for(i =0; i < list.length; i++)
    // Set row to 1 to not include the header
    var r = 1;
    while(row = list.rows[r++])
    {


      var filename = row.cells[0].getElementsByTagName("a")[0];
      filename = filename.textContent || filename.innerHTML;
      console.log(filename);

      // Check if input is in the filename
      if (filename.indexOf(input) > -1)
      {
        row.style.display = "";
      }
      else
      {
        row.style.display = "none";
      }
    }
  }
  else
  {
    var r = 1;
    while(row = list.rows[r++])
    {
      row.style.display = "";

    }
  }
}
</script>
</body>

</html>
