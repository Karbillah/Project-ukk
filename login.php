<!DOCTYPE html>
<?php
	include "connection/koneksi.php";
	session_start();
	if(isset ($_SESSION['username'])){
		header('location: beranda.php');
	} else {
?>
<html lang="en">
<head>
	<title>login || Restaurant</title>
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

	<div class="limiter">
		<div class="container-login100" style="background-image: url('template/login/images/carva.jpg'); background-size: 50%; margin-left: 65px; background-position: left top; margin-top: 50px;">
			<div class="wrap-login100 p-t-120 p-b-30">
				<form action="" method="post" class="login100-form validate-form" style="margin-top: -120px;">
					<?php 
						if(isset($_SESSION['eror'])){
					?>
						<div class='container'>	
							<div class = 'alert alert-danger'>
								<span>
									<center>Mungkin Akun Anda Salah Atau Belum Divalidasi</center>
								</span>
							</div> 
						</div>
					<?php 
						unset($_SESSION['eror']);
						}
					?>
					<div class="login100-form-avatar">
						<img src="template/login/images/koki.png" alt="AVATAR">
					</div>

					<span class="login100-form-title p-t-20 p-b-45">
						RESTAURANT CARVA
					</span>
					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button type="submit" name="login" class="login100-form-btn">
							Login
						</button>
					</div>
					<?php 
						if(isset($_SESSION['username'])){
					?>
					<div class="text-center w-full">
						<a class="txt1" href="logout.php">
							Log Out
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
					<?php
						} else {
					?>
					<br><br><br>
					<div class="text-center w-full">
						<a class="txt1" href="register.php" style="color: black; opacity: 1.0;">
							Create new account
							<i class="fa fa-long-arrow-right"></i>						
						</a>
					</div>
					<?php
						}
					?>
				</form>
			</div>
		</div>
	</div>

	<?php
     if (isset($_REQUEST['login'])) {
         $arr_level = array();
         $c_level = mysqli_query($conn, "select * from level");

         while ($r = mysqli_fetch_array($c_level)) {
             array_push($arr_level, $r['nama_level']);
         }
         foreach ($arr_level as $kontens) {
             //echo $kontens." || ";
         }
         $username = $_REQUEST['username'];
         $password = $_REQUEST['password'];

         $akun = mysqli_query($conn, "select * from user natural join level");
         echo mysqli_error($conn);
         while ($r = mysqli_fetch_array($akun)) {
             if ($r['username'] == $username and $r['password'] == $password and $r['status'] == 'aktif') {
                 $_SESSION['username'] = $username;
                 $_SESSION['id_user'] = $r['id_user'];
                 $_SESSION['level'] = $r['id_level'];
                 if (isset($_SESSION['eror'])) {
                     unset($_SESSION['eror']);
                 }
					header('location: beranda.php');
					//echo "<br>";
					//echo $r['username'] . " || " . $r['password'] . " || " . $r['id_level'] . " || " . $r['nama_level'];
					//echo "<br></br>";
					break;
				} else {
					$_SESSION['eror'] = 'salah';
					header('location: login.php');
				}
			} 
		} 
	?>

<!--===============================================================================================-->	
<script src="template/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="template/login/vendor/bootstrap/js/popper.js"></script> 
	<script src="template/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="template/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="template/login/js/main.js"></script>
</body>
</html>
<?php
	}
?>