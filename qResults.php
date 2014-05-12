<!DOCTYPE html>
<html>
  <head>
    <title>Results</title>
  </head>
  <body>
  
    <?php
      $file = fopen("results.txt", "r") or die("File failed to open");
      if($file == false)
      {
        echo "File failed to open";
        exit();
      }
      $i = 1;
      while (!feof($file))
      {
        echo "survy $i:<br />";
        $line = fgets($file);
        $length = strlen($line);
        if($length > 1)
        {
          $r = explode( ",", $line);
          echo ("hero: $r[0], drink: $r[1], food: $r[2], button: $r[3]<br />");
        }
        else
        {
        }
        $i = $i + 1;
      }
    ?>
    
  </body>
</html>