<!DOCTYPE html>
<html>
  <head>
    <title>Sending to questionair</title>
  </head>
  <body>

    <p>you shouldnt see this page</p>
    <?php
        session_start();
        if (isset($_SESSION["survy"]))
        {
       
          header("location: qResults.php");
          die();
        }
        else
        {

          $_SESSION["survy"] = 1;
          header("location: questionair.html");
          die();
        }
    ?>
  </body>
</html>