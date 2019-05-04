<?php
// include ('login.php');

// if((!isset($_SESSION['login_user']))||(!isset($_SESSION['login_pass']))){
//   header("location: ../index.php");
// }
// echo $_SESSION['login_user'];
// echo $_SESSION['login_pass'];

header('Content-Type: application/json');

$aResult = array();

if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($aResult['error']) ) {
    switch($_POST['functionname']) {
        case 'profile':
              //$files = scandir("../users/".$_SESSION['login_user']."/");
              $files = scandir("../users/test/");
              //$aResult['directory'] = "file:///".dirname(getcwd())."/users/test/";
              $aResult['directory'] = "file:////users/test/";

              //$files = scandir("/home/server/Desktop/test");
              //$aResult['directory'] = "file:////home/server/Desktop/test/";
             $aResult['result'] = $files;
           break;
         case 'test':
            $aResult['result'] = 'yes';
          break;
        default:
           $aResult['error'] = 'What are you doing'.$_POST['functionname'].'!';
           break;
    }
}
header("HTTP/1.1 201 Success");
echo json_encode($aResult);

?>