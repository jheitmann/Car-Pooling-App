<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
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
  session_start();
  $email = $_SESSION['email']; 
  require('db_connect.php');
  $query = "SELECT * FROM person WHERE email = '$email'";
  $result = pg_query($con, $query);
  $row = pg_fetch_assoc($result);
  if(empty($row)) {
    return;
  }
?>

<main style="background-color: #fff">
  <div class="container" align="center" style="margin-left: 20px">
    <div class="col l8 offset-l2"> 
      <h5 style="text-align: center;padding: 20px;padding-bottom:0">
        <?php echo $row["name"]; ?> </h5>
        <div class="container" style="margin-bottom: 20px;margin-top: 25px;">
          <table class="bordered" style="margin-top: 10px">
            <tbody>
              <tr>
                <td width = "50%">Email id</td>
                <td ><?php echo $row['email']; ?></td>
              </tr>
              <tr>
                <td width = "50%">Phone Number</td>
                <td><?php echo $row['phone']; ?></td>
              </tr>
              <tr>
                <td width = "50%">Credit Card Number</td>
                <td><?php echo $row['creditcard']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <a href="changepassword.php" class="button">Change Password</a><!-- 
    <button onclick="window.location.href='changepassword.php'">Change Password</button>
    <button onclick="window.location.href='editprofile.php'">Edit details</button> -->
  </div>
</main>


</body>
</html>
