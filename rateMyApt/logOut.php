<!DOCTYPE html>
<html>
<head>
<title>logOut</title>
</head>
<body>
<p>
<?php
  session_start();
  if(isset($_SESSION['mycokkieLogsIn324'])
  {
    echo "logged you out";
    unset($_SESSION['mycokkieLogsIn324']);
    session_destroy();
  }
  else
    echo "you werent logged in!";
  //header("Location: rateHome.html");
  die();
?>
</p>
</body>
</html>