<!DOCTYPE html>
<html>
<head>
<title>hmmhooa</title>
</head>
<body>
<?php
if (!isset($_GET["nameAp"]))
    {$message = "didnt get the passed value";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die();
    }
    session_start();
  //if(!isset($_SESSION["mycokkieLogsIn324"]) || !isset($_PUT["name"])
  //{
  //  header("Location: rateHome.html")
  //}
   try
   {
       $host = getenv("OPENSHIFT_MYSQL_DB_HOST");
       $port = getenv("OPENSHIFT_MYSQL_DB_PORT");
       $user = getEnv("OPENSHIFT_MYSQL_DB_USERNAME");
       $password = getEnv("OPENSHIFT_MYSQL_DB_PASSWORD");
       $db = new PDO("mysql:host=$host;dbname=myapp", $user, $password);
     echo "apartment name =",$_GET["nameAp"];
   }
   catch(PDOException $ex)
   {
     echo "Database is unavaliable at the moment,  please check again later";
     die();
   }
   try
   {
    
    $name = $_GET["nameAp"];
    $contains = false;
    $checking = $db->query("SELECT name, id FROM apartment");
    foreach($checking as $row)
    {
      echo "checking ", $row["id"],"\n<br />";
        if($name == $row["id"])
        {
          $contains = true;
        }
    }
    if ($contains == false)
    {
    
    {$message = "aprt didnt already exist";
    echo "<script type='text/javascript'>alert('$message');</script>";
    die();
    }
      $apInst = $db->prepare("INSERT INTO apartment (name, address, pricing, amenities) VALUES(
                             :name, :address, :pricing, :amenities");
      $apInst->bindValue(':name', $_POST["aptNAME"], PDO::PARAM_STR);
      $apInst->bindValue(':address', $_POST["address"], PDO::PARAM_STR);
      $apInst->bindValue(':pricing', $_POST["pricing"], PDO::PARAM_INT);
      $apInst->bindValue(':amenities', $_POST["amenities"], PDO::PARAM_STR);
      $apInst->execute();
      echo "added apartment";
    }
    //
    // $db ->query("INSERT INTO review (context, rate, apID, userID) VALUES(\"try try again\", 9, 1, 1)");                    
    //gets the list again, just in case one was added
   try
   {
   $rate = $_GET["rate"];
   /*
   $result= $inset = $db->query("INSERT INTO review (context, rate, apID, userID) VALUES(
  \"try try again\",
  7,
  2,
  1);");
  echo "thr first insert = "; var_dump($result);*/
   $inserting = $db->prepare("INSERT INTO review (context, rate, apID, userID) VALUES(:context, :rate, :apID,".$_SESSION['mycokkieLogsIn324'].")");
   
    if ($inserting->bindValue(':context', $_GET["comments"], PDO::PARAM_STR))
    {
      echo "binding worked first time\n<br />";
    };
    echo "comments = ", $_GET["comments"], "\n, <br />";
    
    if($inserting->bindValue(':rate', $_GET["rate"], PDO::PARAM_INT))
    {
      echo "binding 2 worked";
    };
    
    echo "rate = ", $_GET["rate"], "\n, <br />";
    if(!$inserting->bindValue(':apID', $name, PDO::PARAM_INT))
    {
      echo "binding 3 failed";
    };
    
    echo "apID = ", $name, "\n, <br />";
    
    var_dump($inserting);
    //echo "insert into review (blah blah) VALUES( ", ;
    $result = $inserting->execute();
    echo " result = "; 
    var_dump($result);
    }
    catch(PDOException $ex)
    {
      echo "rigth212";
    }
    header("Location: rProfessorq.php");
   }
   catch(PDOException $ex)
   {
    echo "2nd try failed $ex";
   }

?>
</body>
</html>