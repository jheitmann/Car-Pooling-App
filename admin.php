<!-- Navigation -->
<?php require('header2.php'); ?>

<!-- Slide Show -->
<section>
  <img class="mySlides" src="img_car.jpg"
  style="width:100%">
</section>

<!-- Band Description -->
<section class="w3-container w3-center w3-content" style="max-width:600px">
  <h2 class="w3-wide">EASIERIDE</h2>
  <p class="w3-opacity"><i>Every journey is a new friendship</i></p>
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
