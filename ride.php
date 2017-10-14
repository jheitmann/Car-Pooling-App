<?php
/*
 * index.php
 * 
 * Copyright 2017 Unknown <loic@loic-ThinkPad-T450s>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body>
	
<!-- Navigation -->
<nav class="w3-bar w3-black">
  <a href="index.ph" class="w3-button w3-bar-item">Home</a>
  <a href="#band" class="w3-button w3-bar-item">Ride</a>
  <a href="#tour" class="w3-button w3-bar-item">Login</a>
  <a href="#tour" class="w3-button w3-bar-item">Sign In</a>
</nav>

<!-- Slide Show -->
<section>
  <!-- <img class="mySlides" src="img_car.jpg"
  style="width:100%">-->
</section>

<!-- Band Description -->
<section class="w3-container w3-center w3-content" style="max-width:600px">
  <h2 class="w3-wide">These are the available rides</h2>
  <!--<p class="w3-opacity"><i>Every journey is </i></p> -->
</section>

<script>
// Automatic Slideshow - change image every 3 seconds
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 3000);
}
</script>

</body>
</html>
