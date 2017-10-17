<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
  }

?>

<!DOCTYPE html>
<head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="w3.css">
<style>
li {
list-style: none;
}
</style>
</head>
<body>
	<?php require('header.html'); require("db_connect.php");?>

	<h2>Enter data into book table</h2>
	<ul>
		<form name="insert" action="offerRide.php" method="POST" >
			<li>Car ID:</li><li><input type="text" name="carid" /></li>
			<li>time_stamp:</li><li><input type="text" name="time_stamp" /></li>
			<li>origin:</li><li><input type="text" name="origin" /></li>
			<li>destination:</li><li><input type="text" name="destination" /></li>
			<li>price:</li><li><input type="text" name="price" /></li>
			<li>rideid:</li><li><input type="text" name="rideid" /></li>
			<li><input type="submit" /></li>
		</form>
	</ul>
</body>
</html>
<?php
#$db = pg_connect("host=localhost port=5432 dbname=carpool user=application password=database2017");
$query = "INSERT INTO ride VALUES ('$_POST[carid]',$_POST[time_stamp]','$_POST[origin]',
'$_POST[destination]','$_POST[price]','$_POST[rideid]'
)";
#$result = pg_query($query);
pg_query($con, $query);

require("db_close.php");
?>
