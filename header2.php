<?php
  session_start();
  if(!isset($_SESSION['email'])){
    header("Location: login.php");
    exit;
  }
  elseif(!isset($_SESSION['is_admin'])){
    echo "ACCESS DENIED";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Easieride</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="error_msg.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="admin.php">Easieride</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="admin_user.php">Users</a></li>
      <li><a href="admin_car.php">Cars</a></li>
      <li><a href="admin_ride.php">Rides</a></li>
      <li><a href="admin_bid.php">Bids</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php">Home</a></li>
    </ul>
  </div>
</nav>
