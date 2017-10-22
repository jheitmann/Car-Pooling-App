<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
  }

  if(!empty($_POST)){
    require("db_connect.php");
    $email = $_SESSION["email"];
    $query = "UPDATE person SET name = '".$_POST["name"]."', phone = '".$_POST["phone"]."', creditcard = '".$_POST["creditcard"]."' WHERE email = '$email';";
    $result = pg_query($con, $query);
    require("db_close.php");
    header("Location: profile.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body>
  	
  <!-- Navigation -->
  <?php require('header.html');
        require("db_connect.php");
        $email = $_SESSION["email"];
        $query = "SELECT * FROM person WHERE email = '$email'";
        $result = pg_query($con, $query);
        $row    = pg_fetch_assoc($result);
  ?>
  <form action='editprofile.php' method = 'POST'> 
    Email : <?php echo $email; ?><br>
    Name: <?php echo '<input type="text" name="name" value="'.$row['name'].'">'; ?><br>
    phone: <?php echo '<input type="number" name="phone" value="'.$row['phone'].'">'; ?><br>
    Credit Card Number: <?php echo '<input type="text" name="creditcard" value="'.$row['creditcard'].'">'; ?><br>
    <input type="submit" value="Submit">
  </form> 

</body>
</html>
