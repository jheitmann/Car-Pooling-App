<?php require('header2.php'); ?>

<?php
    require("db_connect.php");
    echo "<p></p>";
    
    $users = pg_query($con, "SELECT car.owner, r.origin, r.destination, r.time_stamp, r.price, c.client, r.rideid
    FROM car,ride r LEFT OUTER JOIN complete_ride c ON r.rideid=c.rideid 
    WHERE car.carid=r.carid ORDER BY r.time_stamp;");
    if (pg_num_rows($users) == 0) { 
		echo " <section>
			<svg width='1000' height='100'>
				<rect x='20' y='20' rx='20' ry='20' width='900' height='80'
				  style='fill:gray;stroke:black;stroke-width:5;opacity:0.5' />
				<text x='60' y='70' font-family='Verdana' font-size='30' fill='red'> No rides found </text>
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
				<th>Driver</th>
		        <th>Origin</th>
		        <th>Destination</th>
		        <th>Date</th>
		        <th>Price</th>
		        <th>Status</th>
		        <th>Client</th>
		        <th></th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>
		<?php
		while($row = pg_fetch_assoc($users)){
			echo " <tr>
				<td>".$row['owner']."</td>
		        <td>".$row['origin']."</td>
		        <td>".$row['destination']."</td>
		        <td>".$row['time_stamp']."</td>
		        <td>".$row['price']."</td>";
		        if($row['client']){
		        	echo "<td style='background-color:green'> Completed </td>
							<td>".$row['client']."</td>";
		        }
		        else{
		        	echo "<td style='background-color:orange'> Pending </td>
							<td> ... </td>";
		        }
		  		echo '<td><form action = "admin_modifyride.php" method="POST">
		  	<input type = "hidden" name = "rideid" value = "'.$row["rideid"].'">
		  	  <button type="submit" class="btn">Modify</button>
		  </form></td>';
		  		echo '<td><form action = "admin_deleteride.php" method="POST">
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
