<?php require('header2.php');?>  
<?php
  if(!empty($_POST)){
    require("db_connect.php");
    $email = $_POST["email"];
    $query = "SELECT * FROM person WHERE email = '$email'";
    $result = pg_query($con, $query);
    $row    = pg_fetch_assoc($result);
    if(!empty($row)){
      if(strcmp($_POST['new_password'],$_POST["new_password2"])==0){
        $match = true;
        $query = "UPDATE person SET password = '".hash('sha256',$_POST["new_password"])."' WHERE email = '$email'";
        $result = pg_query($con, $query);
        require("db_close.php");
        header("Location: admin_user.php");
        exit;
      }
      else{
        $match = false;
      }
    }
  }
  else{
    $match = true;
  }
?>
    <div class = "container">
      <form class="form-horizontal" method="POST" action="admin_resetpassword2.php">
        <div class="form-group">
          <label for="new_password">New Password:</label>
          <input name="new_password" type="password" class="form-control" id="new_password" required>
        </div>
        <div class="form-group">
          <label for="new_password2">Retype New Password:</label>
          <input name="new_password2" type="password" class="form-control" id="new_password2" required>
          <?php if(!$match){
            ?>
                <span class="help-block">Password doesnot match</span>
            <?php
          } ?>
        </div>
        <?php 
          echo '<input name="email" type="hidden" value="'.$email.'">';
        ?>
        <div class="form-group"> 
          <div class="text-center">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
      </form> 
    </div>
</body>
</html>