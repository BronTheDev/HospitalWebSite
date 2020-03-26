<?php
	require 'dbconfig/config.php';
	ob_start();
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">>
</head>
<!-- Create back color navy blue -->
<body style="background-color:#2c3e50 ">

	<div id="main-wrapper"> 
		<center>
			<h2>NCAT HEALTH CENTER</h2>
			<img src="imgs/logo.png" class="avatar"/>
		</center>

		<form class="myform" action="index.php" method="post">
			<label><b>Username:</label></b><br>
			<input name="username" type="text" class="inputvalues" placeholder="Type your username" required /><br>
			
			<label><b>Password:</label></b><br>
			<input  name="password" type="Password" class="inputvalues" placeholder="Type your password" required />
			
			<input  name="login" type="submit" id="login_btn" value="Login"/><br>
			<a href="Registration.php"><input type="button" id="register_btn" value="Register"/></a>
	</form>
	<?php
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query= "select * from user WHERE username ='$username' AND password = '$password'";
		$query_run = mysqli_query($con,$query);
		$usertypes = mysqli_fetch_array($query_run);

		if($usertypes['role'] == "patient"){
			//Valid User
			
			header('Location: Patient.php');
			$_SESSION['username'] = $username;
			exit();
		}
		elseif($usertypes['role'] == "doctor"){
			//Valid User
			//$_SESSION['username'] = $username;
			header('Location: Doctor.php');
			$_SESSION['username'] = $username;
			exit();
		}
		elseif($usertypes['role'] == "nurse"){
			//Valid User
			//$_SESSION['username'] = $username;
			header('Location: Nurse.php');
			$_SESSION['username'] = $username;
			exit();
		}
		else{
		$_SESSION['status'] = "Invalid Credentials";
		echo '<script type="text/javascript"> alert("Error! User Name is Taken") </script>';
			//header('location: index.php');
		}

	}


	?>


	</div>
</body>
</html>