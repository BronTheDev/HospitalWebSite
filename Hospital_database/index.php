<?php
require 'dbconfig/config.php';
ob_start();
session_start();
//Checks if user is logged in and redirects them to the specific page
if(isset($_SESSION["username"])){
	$query = "select * from user WHERE username ='$username'";
	$query_run = mysqli_query($con, $query);
	$Login = mysqli_fetch_array($query_run);
	if ($Login['role'] == "doctor") {
		header('Location: https://www.hospital.ncat/Hospital_database/Doctor.php');
		exit();
	} elseif ($Login['role'] == "nurse") {
		header('Location: https://www.hospital.ncat/Hospital_database/Nurse.php');
		exit();
	} else {
		header('Location: https://www.hospital.ncat/Hospital_database/Patient.php');
		exit();
	}
}
//Faculty login sequence 
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$enPassword = md5($password);
	$query = "select * from user WHERE username ='$username' AND password = '$enPassword'";
	$query_run = mysqli_query($con, $query);
	$usertypes = mysqli_fetch_array($query_run);
	if ($usertypes['role'] == "doctor") {
		//Valid User
		//$_SESSION['username'] = $username;
		header('Location: https://www.hospital.ncat/Hospital_database/Doctor.php');
		$_SESSION['username'] = $username;
		$_SESSION['loggedIn'] = true;

		exit();
	} elseif ($usertypes['role'] == "nurse") {
		//Valid User
		header('Location: https://www.hospital.ncat/Hospital_database/Nurse.php');
		$_SESSION['username'] = $username;
		$_SESSION['loggedIn'] = true;
		exit();
	} else {
		$_SESSION['status'] = "Invalid Credentials";
		echo '<script type="text/javascript"> alert("Error! User Name is Taken") </script>';
		//header('location: index.php');
	}
}
//Patient login sequence
if (isset($_POST['plogin'])) {
	$pname = $_POST['pname'];
	$password = $_POST['pword'];
	$pword = md5($password);

	$query = "select * from patients WHERE username ='$pname' AND password = '$pword'";
	$query_run = mysqli_query($con, $query);
	$count = mysqli_num_rows($query_run);
	if ($count == 1) {
		header('Location: https://www.hospital.ncat/Hospital_database/Patient.php');
		$_SESSION['username'] = $pname;
		$_SESSION['loggedIn'] = true;
		exit();
	}
	else{
		$_SESSION['status'] = "Invalid Credentials";
		echo '<script type="text/javascript"> alert("Error! User Name is Taken") </script>';
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie = edge">
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style>
	#main-wrapper {
		height: fit-content;
		width: fit-content;
		margin: 0 auto;
		background: #f1c40f;
		padding: 35px;
		border-radius: 100px;
		border: 10px solid rgb(48, 63, 159);
	}

	.navbar-brand,
	.nav>li>a {
		padding: 30px 15px;
	}
</style>
<!-- Create back color navy blue -->

<body style="background-color:#2c3e50 ">
	<div id="main-wrapper">
		<ul class="nav nav-tabs list-inline">
			<li><a data-toggle="tab" href="#facLogin">Faculty Login</a></li>
			<li class="active"><a data-toggle="tab" href="#patLogin">Patient Login</a></li>
		</ul>
		<div class="tab-content">
			<div id="facLogin" class="tab-pane fade">
				<center>
					<h2>NCAT HEALTH CENTER</h2>
					<img src="imgs/logo.png" class="avatar" /><br>
					</center>

					<form class="myform" action="index.php" method="post">
						<label><b>Username:</label></b>
						<input name="username" type="text" class="inputvalues" placeholder="Type your username" required /><br>

						<label><b>Password:</label></b>
						<input name="password" type="Password" class="inputvalues" placeholder="Type your password" required /><br>
					<Center>
						<input name="login" type="submit" id="login_btn" value="Login" />
						<a href="Registration.php"><input type="button" id="register_btn" value="Register" /></a>
					</Center>
					</form>
				
			</div>
			<div id="patLogin" class="tab-pane fade in active">
				<center>
					<h2>NCAT HEALTH CENTER</h2>
					<img src="imgs/logo.png" class="avatar" />


					<form class="myform" action="index.php" method="post">
						<label><b>Username:</label></b>
						<input name="pname" type="text" class="inputvalues" placeholder="Type your username" required /><br>

						<label><b>Password:</label></b>
						<input name="pword" type="Password" class="inputvalues" placeholder="Type your password" required /><br>

						<input name="plogin" type="submit" id="login_btn" value="Login" />
					</form>
				</center>
			</div>


		</div>


	</div>


</body>

</html>