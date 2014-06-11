<?php
  //require 'password.php';
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
  if(!isset($_POST["name"]) || !isset ($_POST["password"]))
  {
    header('Location: signUp.html');
    die();
  }
  //$storPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
  try
  {
  echo "name = ",$_POST["name"];
  
  $inset = $db->prepare("INSERT INTO person (name, password, email) VALUES(:name, :pass, :email)");
  $inset->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
  $inset->bindValue(':pass', $_POST["password"], PDO::PARAM_STR);
  $inset->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
  
  echo "Getting ready to insert";
  var_dump($inset);
  
  $result = $inset->execute();
  
  echo "Results were:";
  
  var_dump($result);
  
  }
  catch(PDOException $ex)
  {
    echo "try 2 fail $ex";
  }
  header('Location: signIn.php');
  die();
?>