<?php

$servername = "localhost";
$username = "postgres";
$password = "mdmaimsmahyr";
$db="car_pooling";

$con = pg_connect("host=$servername port=5432 dbname=$db user=$username password=$password");
 
// echo "Connected successfully";
?>