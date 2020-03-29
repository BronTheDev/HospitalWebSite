<?php
require 'dbconfig/config.php';
ob_start();
session_start();
if (isset($_POST['login'])) {
    $userName = $_POST['username'];
    $passWord = $_POST['password'];
	$_SESSION['userName'] = $_POST['username'];
	$_SESSION['passWord'] = $_POST['password'];

    try {
        $serverName =  "DESKTOP-GMPS9UK"; //DESKTOP-GMPS9UK\Hospital
        $connectionInfo = array("Database"=>"Hospital", "UID"=>$userName, "PWD"=>$passWord);
        $conn = sqlsrv_connect($serverName, $connectionInfo);

        if ($conn == false) {
            print_r("A Connection could not be established");
            die(FormatErrors(sqlsrv_errors()));
        }

    } catch(Exception $e)
    {
        echo("Error!");
    }

        $query= "select [role] from users where user_name = '$userName' and password = '$passWord'";
        print_r($query);

		$query_run = sqlsrv_query($conn,$query);
        if( $query_run === false ) {
            die( print_r( sqlsrv_errors(), true));
        }

        // Make the first (and in this case, only) row of the result set available for reading.

        if ( sqlsrv_fetch( $query_run ) == false) {
		    die( print_r( sqlsrv_errors(), true));
        }
        // Get the row fields. Field indices start at 0 and must be retrieved in order.
        // Retrieving row fields by name is not supported by sqlsrv_get_field.

		$user_types = sqlsrv_get_field($query_run, 0);
        print_r(gettype($user_types));
        $user_type = trim($user_types);
		if($user_type == "Patient"){
			//Valid User

			header('Location: Patient.php');
			$_SESSION['username'] = $userName;
			exit();
		}
		elseif($user_type == "Doctor"){
			//Valid User
			//$_SESSION['username'] = $username;
			header('Location: Doctor.php');
			$_SESSION['username'] = $userName;
			exit();
		}
		elseif($user_type == "Nurse"){
			//Valid User
			//$_SESSION['username'] = $username;
			header('Location: Nurse.php');
			$_SESSION['username'] = $userName;
			exit();
		}
		else{
		$_SESSION['status'] = "Invalid Credentials";
		echo '<script type="text/javascript"> alert("Error! User Name is Taken") </script>';
		//header('location: index.php');
	}

}

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
			<img src="imgs/logo.png" class="avatar" />


			<form class="myform" action="index.php" method="post">
				<label><b>Username:</label></b>
				<input name="username" type="text" class="inputvalues" placeholder="Type your username" required /><br>

				<label><b>Password:</label></b>
				<input name="password" type="Password" class="inputvalues" placeholder="Type your password" required /><br>

				<input name="login" type="submit" id="login_btn" value="Login" />
				<a href="Registration.php"><input type="button" id="register_btn" value="Register" /></a>
			</form>
		</center>
	</div>

</body>

</html>