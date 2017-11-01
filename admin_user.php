<?php require('header2.php'); ?>

<?php
    require("db_connect.php");
    echo "<p></p>";
    
	    $users = pg_query($con, "SELECT * FROM person ORDER BY email;");
    if (pg_num_rows($users) == 0) { 
		echo " <section>
			<svg width='1000' height='100'>
				<rect x='20' y='20' rx='20' ry='20' width='900' height='80'
				  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
				<text x='60' y='70' font-family='Verdana' font-size='30' fill='blue'> No users found </text>
				Sorry, your browser does not support inline SVG.
			</svg>
		</section>
		
		";
	} else {
		?>

		<div class="table-responsive">          
		  <table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Email</th>
		        <th>Name</th>
		        <th>Phone</th>
		        <th>Credit Card</th>
		        <th>Clearance</th>
		        <th></th>
		        <th colspan="2"><button class='btn btn-success' align = "center" onclick="location.href = './admin_addUser.php'">Add User</button></th>
		      </tr>
		    </thead>
		    <tbody>
		    
		<?php
		while($row = pg_fetch_assoc($users)){
			echo " <tr>
		        <td>".$row['email']."</td>
		        <td>".$row['name']."</td>
		        <td>".$row['phone']."</td>
		        <td>".$row['creditcard']."</td>";
		        if(strcmp($row["is_admin"],"t") == 0){
		        	echo "<td> Admin </td>";
		        }
		        else{
		        	echo "<td> Non-Admin User</td>";
		        }
		        echo '<td><form action = "admin_resetpassword.php" method="GET">
		  	<input type = "hidden" name = "email" value = "'.$row["email"].'">
		  	  <button type="submit" class="btn">Reset Password</button>
		  </form></td>';
		  		echo '<td><form action = "admin_modifyuser.php" method="GET">
		  	<input type = "hidden" name = "email" value = "'.$row["email"].'">
		  	  <button type="submit" class="btn">Modify</button>
		  </form></td>';
		  		echo '<td><form action = "admin_deleteuser.php" method="GET">
		  	<input type = "hidden" name = "email" value = "'.$row["email"].'">
		  	  <button type="submit" class="btn btn-danger">Delete</button>
		  </form></td>';
			echo " </tr>";
		}
		?>
		</tbody>
		  </table>
		  </div>
		<?php 
	} 
    
    require("db_close.php");
?>	
</body>
</html>