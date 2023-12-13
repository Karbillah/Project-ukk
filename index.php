<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Restaurant Carva</title>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="template/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="template/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="template/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="template/login/css/main.css">
	<link rel="stylesheet" href="template/dashboard/css/style.css" />
</head>
<body>
<nav>
    <div class="left">
      <a href="">RESTAURANT CARVA</a>
    </div>
    <div class="right">
	  <a class="txt1" href="index.php">HOME</a>
    </div>
    <div class="right">
	  <a class="txt1" href="login.php">LOGIN</a>
    </div>
</nav>

    <div class="slides">
      <div class="slide">
        <img src="gambar/gambar1.jpg" style="width: 1500px; height: 530px;">
      </div>
      <div class="slide">
        <img src="gambar/gambar2.jpg" style="width: 1500px; height: 530px;">
      </div>
      <div class="slide">
        <img src="gambar/gambar3.jpg" style="width: 1500px; height: 530px;">
      </div>
      <div class="slide">
        <img src="gambar/gambar4.jpg" style="width: 1500px; height: 530px;">
      </div>
      <!-- <div class="navigation">
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div> -->
    </div>

    <script>
      var slideIndex = 0;
      showSlides();

      function showSlides() {
        var i;
        var slides = document.getElementsByClassName("slide");
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
          slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 3000); // Ganti gambar setiap 3 detik
      }

      function plusSlides(n) {
        slideIndex += n;
        if (slideIndex > slides.length) {
          slideIndex = 1;
        }
        if (slideIndex < 1) {
          slideIndex = slides.length;
        }
        showSlides();
      }
    </script>
  </body>
</html>
