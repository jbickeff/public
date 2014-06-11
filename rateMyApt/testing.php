<!DOCTYPE html>
<html>
  <head>
  <title>Rate My Appartment Complex</title>
  </head>
  <body>
    
      <h1>List of Apartments</h1>
      </ br>
      <table style = "width:500px" border = "1">
      <td><strong>Apartment</strong></td><td><strong>Address</strong></td><td><strong>Price</strong></td>
      <td><strong>rating</strong></td>
      <?php
        try
        {
          $user = "php";
          $password = "php-pass";
          
          echo "used $user"; 
          $host = getenv("OPENSHIFT_MYSQL_DB_HOST");
          
          $port = getenv("OPENSHIFT_MYSQL_DB_PORT");
          $user = getEnv("OPENSHIFT_MYSQL_DB_USERNAME");
          $password = getEnv("OPENSHIFT_MYSQL_DB_PASSWORD");
          echo "host = $host, port = $port user = $user";
          $db = new PDO("mysql:host=$host;dbname=myapp", $user, $password);
         //somthign
        }
        catch(PDOException $ex)
        {
          echo "sign in failed $ex";
          die();
        }
        try
        {
        $results = $db->query("SELECT name FROM apartment");
        var_dump($results);
        foreach ($results as $rates)
        {
          echo " name =".$rates["name"];
        }
        }
        catch(PDOException $ex)
        {
          echo "ummsomthing $ex";
          die();
        }
        ?>
    </body>
</html>