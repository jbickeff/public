<!DOCTYPE html>
<html>
  <head>
  <title>Rate My Appartment Complex</title>
  </head>
  <body>
   <p>
      <a href = "rateHome.html">home</a> <a href = "createForm.php"> rate an apartment</a>
      <a href = "logOut.php">Log Out</a>
      </p>
      <h1>List of Apartments</h1>
      <br />
      <table style = "width:500px" border = "1">
      <td><strong>Apartment</strong></td><td><strong>Address</strong></td><td><strong>Price</strong></td>
      <td><strong>rating</strong></td>
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
          echo "sign in failed";
          die();
        }
        $a = array();
        $c = array();
        $i = 0;
        foreach ($db->query("SELECT rate, apID FROM review") as $rates)
        {
          if(isset($a[$rates["apID"]]))
          {
            $a[$rates["apID"]] = ($a[$rates["apID"]] + $rates["rate"]);
            $c[$rates["apID"]] = $c[$rates["apID"]] + 1;
          }
          else
          {
            $temp = array($rates["apID"] => ($rates["rate"]));
            $a = array_merge($a, $temp);
            $temp = array($rates["apID"] => 1);
            $c = array_merge($c, $temp);
          }
          $i += 1;
        }
        
        foreach ($db->query("SELECT name, address, pricing, id FROM apartment") as $row)
        {
          echo "<tr><td>" . $row['name'] . "</td>";
          echo "<td>" . $row['address'] . "</td>" . "<td>$" .$row['pricing'] . "</td>";
          if(isset($a[$row['id']]))
          {
            echo"<td>".($a[$row["id"]] / $c[$row["id"]])." </td>";
          }
          else
          {
            echo "<td>no ratings found</td>";
          }
          echo"</tr>";
          
        }
        

      ?>
      </table>
      
      <?php
      
        foreach ($db->query("SELECT name, id FROM apartment") as $coms)
        {
        //begin the apartment heding
            echo "</ br><strong>".$coms["name"]."</strong></ br><table style = \"width:500px\" >";
            foreach($db->query("SELECT context, rate FROM review WHERE apID = ".$coms["id"])as $somthing)
            {
           
            //i should set a stlye for p or make a style for this part
              echo "<tr><td><p>".$somthing["context"]."</p></td><td>".$somthing["rate"]."</td></tr>";
            }
            echo "</table>";
        }
        
      ?>
  </body>
</html>