<?php
      $hero =$_POST["hero"];
      $drink = $_POST["drink"];
      $food = $_POST["food"];
      $button = $_POST["button"];

      echo "<!DOCTYPE html><html><head><title>testing</title></head><body><p>your hero is 
      $hero</p></body></html>";
      $input = fopen("results.txt", "a") or die("error opening file");
      if($input)
      {
        fwrite($input, "$hero,$drink,$food,$button\n");
      }
      
      else
      {
        alert("Failed to load file to save");
        exit();
      }
      fclose($input);
      header("location: qResults.php");
      die();
?>
  