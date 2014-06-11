<!DOCTYPE html>
<html>
  <head>
    <title>new Apartment</title>
  </head>
  <body>
  <a href = "rateHome.html">Home</a>
    <form method = "POST" action = "newApt.php">
      <?php
        echo "Apartment Name:<input type = \"text\" name = \"name\">\n<br />";
        echo "Address: <input type = \"text\" name = \"address\">\n<br />";
        echo "Price: <input type = \"text\" name = \"price\">\n<br />";
        echo "Amenities: <input type = \"text\" name = \"amenities\">\n<br />";
      ?>
      <input type = "submit">
    </form>
  </body>
</html>