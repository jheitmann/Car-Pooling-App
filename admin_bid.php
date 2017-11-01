<?php require('header2.php'); ?>

<?php
    require("db_connect.php");
    echo "<p></p>";
    
    $bids = pg_query($con, "SELECT * FROM bid ORDER BY client;");
    if (pg_num_rows($bids) == 0) { 
		echo " <section>
			<svg width='1000' height='100'>
				<rect x='20' y='20' rx='20' ry='20' width='900' height='80'
				  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
				<text x='60' y='70' font-family='Verdana' font-size='30' fill='blue'> No bids found </text>
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
		        <th>client</th>
		        <th>rideid</th>
		        <th>bid_price</th>
		        <th></th>
		        <th></th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>
		<?php
		while($row = pg_fetch_assoc($bids)){
			echo " <tr>
		        <td>".$row['client']."</td>
		        <td>".$row['rideid']."</td>
		        <td>".$row['bid_price']."</td>";
		        #if(strcmp($row["is_admin"],"t") == 0){
		        #	echo "<td> Admin </td>";
		        #}
		        #else{
		        #	echo "<td> Non-Admin User</td>";
		        #}
		        /* echo '<td><form action = "admin_resetpassword.php" method="POST">
		  	<input type = "hidden" name = "email" value = "'.$row["email"].'">
		  	  <button type="submit" class="btn">Reset Password</button>
		  </form></td>';
		  		echo '<td><form action = "admin_modifyuser.php" method="POST">
		  	<input type = "hidden" name = "email" value = "'.$row["email"].'">
		  	  <button type="submit" class="btn">Modify</button>
		  </form></td>'; */
		  		echo '<td><form action = "admin_deletebid.php" method="POST">
		  	<input type = "hidden" name = "client" value = "'.$row["client"].'">
		  	<input type = "hidden" name = "rideid" value = "'.$row["rideid"].'">
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
