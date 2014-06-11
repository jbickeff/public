<!DOCTYPE html>
<html>
<head>
  <title>Leave a Review</title>
  <script>
    function additionalForm()
    {
      var aptSelected = document.getElementByID('aptList').value;
      alert(aptSelected);
      var text = "";
      if (aptSelected == "0" )
      {
        var text = "apartment name:<input = \"text\" name = \"aptNAME\"><br />";
        text += "address:<input = \"text\" name = \"address\"><br />";
        text += "price:<input = \"text\" name = \"pricing\"><br />";
        text += "amenities:<input = \"text\" name = \"amenities\"><br />";
      }
      
      document.getElementById('AdditionalInfo').innerHTML = text
    }
  </script>
</head>
<body>
  <?php
  //echo "this should not work right now".$_SEESION['mycokkieLogsIn324']."\n<br />";
  session_start();
  if(!isset($_SESSION['mycokkieLogsIn324']))
  { 
    echo "session failed to have a log in";
    header("Location: rateHome.html");
  }
  /*
  else
  {
    echo "loged in as user id".$_SESSION["mycokkieLogsIn324"];
  }*/
  ?>
  <a href = "rateHome.html">Home</a>
  <h1>Rate an apartment!!</h1><br>
  <h3>Thanks for taking time to rate an apartment</h3>
  <p>If you dont see the apartment listed below please please follow this 
  <a href = "addingApt.php">link</a></p>
  <form action = "rmAs.php" method = "GET">
  <?php
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
      echo "Database is unavaliable at the moment,  please check again later";
      die();
    }
    $apartments = $db->query("SELECT name, id FROM apartment");
    echo "<select name = \"nameAp\" id = \"aptList\"onchange = \"additionalForm()\">";
    echo "<option value =\"\", disabled selected>Pick a apartment</option>";
    forEach($apartments as $row)
    {
      echo "<option value = ",$row["id"],">",$row["name"],"</option>";
    }
    
  ?>
    <option value = "0">Other</option>
  </select>
  <p>Rate: <select name = "rate"> <option value = "1">1</option>
  <option value = "2">2</option>
  <option value = "3">3</option>
  <option value = "4">4</option>
  <option value = "5">5</option>
  <option value = "6">6</option>
  <option value = "7">7</option>
  <option value = "8">8</option>
  <option value = "9">9</option>
  <option value = "10">10</option>
    </select>
  </p>
  <br/>
  <!--needs to make an additional for apear -->
  
  Comments: <br/> 
  <textarea name = "comments" cols = "60" rows = "10">Comments </textArea> <br/>
  <input type = "Submit">
  <div id = "AdditionalInfo"></div>
  </form>
</body>
</html>