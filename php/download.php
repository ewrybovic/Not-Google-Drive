<?php
  //user directory name files;
  $files = scandir("../files");
  for ($i=2; $i < count($files) ; $i++) {
    // code...
    ?>
    <p>
      <a  download="<?php echo $files[$i]?>" href="../files/<?php echo $files[$i]?>"><?php echo $files[$i]?></a>
    </p>

    <?php
  }
?>
