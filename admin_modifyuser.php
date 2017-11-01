<?php require('header2.php');?>
<?php
    if(!empty($_GET)){
      require("db_connect.php");
      $email = $_GET["email"];
      $query = "SELECT * FROM person WHERE email = '$email'";
      $result = pg_query($con, $query);
      $row    = pg_fetch_assoc($result);
    }
    elseif(!empty($_POST)){
      require("db_connect.php");
      $email = $_POST["old_email"];
      if(strcmp($_POST["is_admin"],"yes")==0){
        $query = "UPDATE person SET email = '".$_POST["email"]."', name = '".$_POST["name"]."', phone = '".$_POST["phone"]."', creditcard = '".$_POST["creditcard"]."', is_admin = TRUE WHERE email = '$email';";
      }
      else{
        $query = "UPDATE person SET email = '".$_POST["email"]."', name = '".$_POST["name"]."', phone = '".$_POST["phone"]."', creditcard = '".$_POST["creditcard"]."', is_admin = FALSE WHERE email = '$email';";
      }
      $result = pg_query($con, $query);
      require("db_close.php");
      header("Location: admin_user.php");
      exit;
    }
    else{
      echo "INVALID ACCESS";
      exit;
    }
?>

<div class="container">
    <form class="form-horizontal" method="POST" action="admin_modifyuser.php">
      <div class="form-group">
        <label for="email">Email:</label>
        <?php echo '<input name="email" type="email" class="form-control" id="email" value = "'.$row["email"].'"required>'; ?>
        <?php echo '<input name="old_email" type="hidden" value = "'.$row["email"].'">'; ?>
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
        <label for="is_admin">Admin:</label>
        <select class="form-control" id="is_admin" name="is_admin">
          <?php if(strcmp($row["is_admin"],"t")==0){?>
              <option value="yes">Yes</option>
              <option value="no">No</option>
          <?php }
                else{ ?>
              <option value="no">No</option>
              <option value="yes">Yes</option>
          <?php } ?>
        </select>
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