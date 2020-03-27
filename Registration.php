<?php
require 'dbconfig/config.php';
include('function.php');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Registration Page</title>
	<link rel="stylesheet" href="css/style.css">>
</head>
<!-- Create back color navy blue -->

<body style="background-color:#2c3e50 ">

	<div id="main-wrapper">
		<center>
			<h2>NCAT HEALTH CENTER</h2>
			<img src="imgs/logo.png" class="avatar" />
		</center>
		<center>
		<form class="myform" action="Registration.php" method="post">
			<label><b>Username:</label></b>
			<input name="username" type="text" class="inputvalues" placeholder="Type your username" required /><br>

			<label><b>Password:</label></b>
			<input name="password" type="Password" class="inputvalues" placeholder="Enter your password" required /><br>

			<label><b>Confirm Password:</label></b>
			<input name="cpassword" type="Password" class="inputvalues" placeholder="Reenter your password" required /><br>

			<b>Please specify your role:</b>
			<input type="radio" name="role" value="doctor">
			<label for="doctor">Doctor</label>

			<input type="radio" name="role" value="nurse">
			<label for="nurse">Nurse</label><br>
			
				<input name="submit_btn" type="submit" id="signup_btn" value="Sign Up" />
				<a href="index.php"><input name="back_btn" type="button" id="back_btn" value="Back to Login" /></a>
		</form>
		</center>
		<?php
		if (isset($_POST["submit_btn"])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$cpassword = $_POST['cpassword'];
			$role = $_POST['role'];




			//If password is equal to confirmed password
			if ($password == $cpassword) {
				$query = "select * from user WHERE username='username'";

				$query_run = mysqli_query($con, $query);
				if (mysqli_num_rows($query_run) > 0) {
					echo '<script type="text/javascript"> alert("User already exists... try another username") </script>';
				} {
					$query = "insert into user(username,password,role) values('$username','$password','$role')";
					$query_run = mysqli_query($con, $query);
					if ($query_run) {
						echo '<script type="text/javascript"> alert("User Created. Return to login page to login") </script>';
					} else {
						echo '<script type="text/javascript"> alert("Error! User Name is Taken") </script>';
					}
				}
			} else {
				echo '<script type="text/javascript"> alert("Passwords do not match") </script>';
			}
		}

		?>
	</div>



</body>

</html>