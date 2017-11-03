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
  <?php require('header.php');
        require("db_connect.php");
        $email = $_SESSION["email"];
        $query = "SELECT * FROM person WHERE email = '$email'";
        $result = pg_query($con, $query);
        $row    = pg_fetch_assoc($result);
  ?>

  <div class="container">

      <form class="form-horizontal" method="POST" action="editprofile.php">
        <div class="form-group">
          <label for="email">Email:</label>
          <?php echo '<input name="email" type="email" class="form-control" id="email" value = "'.$row["email"].'"disabled>'; ?>
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <?php echo '<input name="name" type="text" class="form-control" id="name" value = "'.$row["name"].'"required>'; ?>
        </div>
        <div class="form-group">
          <label for="phone">Phone Number:</label>
          <?php echo '<input name="phone" type="number" class="form-control" id="phone" value = "'.$row["phone"].'"required>'; ?>
        </div>
        <div class="form-group">
          <label for="creditcard">Credit Card Number:</label>
          <?php echo '<input name="creditcard" type="text" class="form-control" id="creditcard" value = "'.$row["creditcard"].'"required>'; ?>
        </div>
        <div class="form-group"> 
          <div class="text-center">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form> 
    </div>
</body>
</html>