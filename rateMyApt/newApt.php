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
  $statement = "INSERT INTO apartment (name, address, pricing, amenities) VALUES(";
  $statement = $statement.":name, :address, :pricing, :amenities)";
  $prepare = $db->prepare($statement);
  $prepare->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
  $prepare->bindValue(':address', $_POST["address"], PDO::PARAM_STR);
  $prepare->bindValue(':pricing', $_POST["price"], PDO::PARAM_INT);
  $prepare->bindValue(':amenities', $_POST["amenities"], PDO::PARAM_STR);
  $result = $prepare->execute();
  echo "results were";
  var_dump($result);
  header('Location: createForm.php');
  die();
  
?>