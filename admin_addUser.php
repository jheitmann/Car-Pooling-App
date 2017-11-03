<?php require("header2.php"); ?>

<?php
	if(!empty($_POST)){
		require("db_connect.php");
	    $query = "SELECT * FROM person WHERE email = '".$_POST["email"]."'";
	    $result = pg_query($con, $query);
	    $row    = pg_fetch_assoc($result);
	    if(empty($row)){
			$email_not_available = false;
			$pass = $_POST["password"];
			$repass = $_POST["password2"];
			if(strcmp($pass,$repass)==0){
				$pass_match = true;
				$pass = hash('sha256',$pass);
				if(strcmp($_POST["is_admin"],"yes")==0){
					$query = "INSERT INTO person VALUES('".$_POST["email"]."', '".$_POST["name"]."', ".$_POST["phone"].", '".$_POST["creditcard"]."', '".$pass."', TRUE)";
				}
				else{
					$query = "INSERT INTO person VALUES('".$_POST["email"]."', '".$_POST["name"]."', ".$_POST["phone"].", '".$_POST["creditcard"]."', '".$pass."', TRUE)";
				}
				echo $query;
				exit;
				$result = pg_query($con, $query);
				if(!$result){
				  echo "Error";
				  exit;
				}
				else{
				  require("db_close.php");
				  header("Location: admin_user.php");
				  exit;
				}
			}
		    else{
				$pass_match = false;
		    }
		}
		else{
			$email_not_available = true;
			$match = true;
		}
	}
	else{
		$email_not_available = false;
		$match = true;
	}
?>



<div class="container">
    <form class="form-horizontal" method="POST" action="admin_addUser.php">
      <div class="form-group">
        <label for="email">Email:</label>
        <input name="email" type="email" class="form-control" id="email" required>
      	<?php if($email_not_available){
              ?>
                <span class="help-block">Email already used</span>
              <?php
            } ?>
      </div>
      <div class="form-group">
        <label for="name">Name:</label>
        <input name="name" type="text" class="form-control" id="name" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input name="phone" type="number" class="form-control" id="phone" required>
      </div>
      <div class="form-group">
        <label for="creditcard">Credit Card Number:</label>
        <input name="creditcard" type="text" class="form-control" id="creditcard" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input name="password" type="password" class="form-control" id="password" required>
      </div>
      <div class="form-group">
        <label for="password2">Retype Password:</label>
        <input name="password2" type="password" class="form-control" id="password" required>
      <?php if(!$match){
            ?>
                <span class="help-block">Password doesnot match</span>
            <?php
          } ?>
      </div>
      <div class="form-group">
        <label for="is_admin">Admin:</label>
        <select class="form-control" id="is_admin" name="is_admin">
              <option value="no">No</option>
              <option value="yes">Yes</option>
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