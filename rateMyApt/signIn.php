<!DOCTYPE html>
<html>
  <head>
    <title>signIn</title>
  </head>
  <body>
  <a href = "rateHome.html">Home</a>
  <a href = "logOut.php">Log Out</a>
    <h1>Sign in</h1>
    
    <?php          
    session_start();
    if(isset($_SESSION['mycokkieLogsIn324']))
    {
      echo "\n <br />currently logged in as ".$_SESSION['mycokkieLogsIn324']."\n <br />";
    }
      $formNeeded = true;
      $message = "";
      if(isset($_POST["name"])  && isset($_POST["password"]))
      {
        try
        {
          $host = getenv("OPENSHIFT_MYSQL_DB_HOST");
          $port = getenv("OPENSHIFT_MYSQL_DB_PORT");
          $user = getEnv("OPENSHIFT_MYSQL_DB_USERNAME");
          $password = getEnv("OPENSHIFT_MYSQL_DB_PASSWORD");
          $db = new PDO("mysql:host=$host;dbname=myapp", $user, $password);
        }
        catch(PDOException $ex)
        {
          echo "Database is unavaliable at the moment, after trying to sign in please check again later";
          die();
        }
        $name = $_POST["name"];
        $containsName = false;
        $checking = $db->query("SELECT name, password, id FROM person");
        $correctPassword = false;
        $usersIDS = -1;
        foreach($checking as $row)
        {
            if($name == $row["name"])
            {
              if($_POST["password"] == $row["password"])
              {
                $correctPassword = true;
                $containsName = true;
                $usersIDS = $row["id"];
              }
              
            }
        }
        if($containsName == true && $correctPassword == true)
        {
          echo "<p>thank you for signing in</p>";
          echo "Click here to continue to add a review<a href = \"createForm.php\"> here</a>";

          $_SESSION['mycokkieLogsIn324'] = $usersIDS;
          echo "<br /> \nsesion cookies set".$_SESSION['mycokkieLogsIn324'];
          
          $formNeeded = false;
        }
        else
        { 
          $message = "<p>Either the user name or the password was wrong</p>";
        }
      }
      if($formNeeded == true)
      {
        echo $message;
        echo "<form method = \"POST\" action = \"signIn.php\"> ";
        echo "User name: <input type = \"text\" name = \"name\">\n<br />";
        echo "Password:   <input type = \"password\" name = \"password\"/>\n<br />";
        echo "<input type = \"submit\">";
        echo "</form>";
        echo "<a href = \"signUp.html\">CREATE a new user</a>";
      }
    ?>
  </body>
</html>