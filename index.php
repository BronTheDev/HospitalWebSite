<?php

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
			<input type="text" class="inputvalues" placeholder="Type your username"/><br>
			<label><b>Password:</label></b><br>
			<input type="Password" class="inputvalues" placeholder="Type your password"/>
			<input type="submit" id="login_btn" value="Login"/><br>
			<a href="Registration.php"><input type="button" id="register_btn" value="Register"/></a>
	</form>
	</div>



</body>
</html>