<?php require('header2.php'); ?>

<?php
    require("db_connect.php");
	$query = "DELETE FROM person WHERE email = '".$_POST["email"]."';";
    $result = pg_query($con, $query);
    require("db_close.php");        
	header("Location: admin_user.php");
	exit;
?>
