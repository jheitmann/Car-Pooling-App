<?php require('header2.php'); ?>

<?php
	if(!empty($_GET)){
	    require("db_connect.php");
		$query = "DELETE FROM person WHERE email = '".$_GET["email"]."';";
	    $result = pg_query($con, $query);
	    require("db_close.php");        
		header("Location: admin_user.php");
		exit;
	}
?>
