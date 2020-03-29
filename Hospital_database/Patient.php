<?php
require 'security.php';
require 'dbconfig/config.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie = edge">
	<title>Welcome Doctor</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
	* {
		box-sizing: border-box;
	}

	#main-wrapper {
		height: fit-content;
		width: fit-content;
		margin: 0 auto;
		background: #f1c40f;
		padding: 35px;
		border-radius: 100px;
		border: 10px solid rgb(48, 63, 159);
	}


	#myInput {
		background-position: 10px 10px;
		background-repeat: no-repeat;
		width: 100%;
		font-size: 16px;
		padding: 12px 20px 12px 40px;
		border: 1px solid #ddd;
		margin-bottom: 12px;
	}

	#myTable {
		border-collapse: collapse;
		width: 100%;
		border: 1px solid #ddd;
		font-size: 18px;
	}

	#myTable th,
	#myTable td {
		text-align: left;
		padding: 12px;
	}

	#myTable tr {
		border-bottom: 1px solid #ddd;
	}

	#myTable tr.header,
	#myTable tr:hover {
		background-color: #f1f1f1;
	}
</style>

<body style="background-color:#2c3e50 ">

	<div id="main-wrapper">
		<center>
			<h2>NCAT HEALTH CENTER</h2>
			<img src="imgs/logo.png" class="avatar" />
			<h4> Welcome <?php echo $_SESSION['username']; ?> </h4>
			<form class="myform" action="Patient.php" method="post">
		</center>
		<?php
		$query = "SELECT * FROM patients WHERE username = '" . $_SESSION['username'] . "'";
		$query_run = mysqli_query($con, $query);
		?>

		<table id="myTable">
			<thead>
				<tr class="header">
					<th style="width:20%;">Name</th>
					<th style="width:20%;">Billing</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (mysqli_num_rows($query_run) > 0) {
					while ($row = mysqli_fetch_assoc($query_run)) {

				?>


						<tr>

							<td><?php echo $row['Name']; ?></td>
							<td><?php echo $row['Billing']; ?></td>
						</tr>
				<?php
					}
				}

				?>
			</tbody>
		</table>

		<center>
			<input name="logout" type="submit" id="back_btn" value="Log Out" />
		</center>
		</form>

		<?php
		if (isset($_POST["logout"])) {
			session_start();
			session_destroy();
			unset($_SESSION["username"]);
			$_SESSION = array();
			header('Location: https://www.hospital.ncat/Hospital_database/index.php');
			exit();
		}


		?>
		</center>


	</div>



</body>

</html>