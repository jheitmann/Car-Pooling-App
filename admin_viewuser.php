<?php require('header2.php');?>
<?php
    if(!empty($_GET)){
      require("db_connect.php");
      $email = $_GET["email"];
      $query = "SELECT * FROM person WHERE email = '$email'";
      $result = pg_query($con, $query);
      $row    = pg_fetch_assoc($result);
    }
    else{
      echo "INVALID ACCESS";
      exit;
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
              <tr>
                <td width = "50%">Admin?</td>
                <?php
                if(strcmp($_row["is_admin"],"t")==0){
                  echo "<td>Yes</td>";
                }
                else{
                  echo "<td>No</td>";
                }
                ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- <a href="changepassword.php" class="button">Change Password</a> -->
  </div>
</main>