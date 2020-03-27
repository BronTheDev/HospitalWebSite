<?php
session_start();
//require 'security.php';
require 'dbconfig/config.php';
if (isset($_POST["logout"])) {
		session_start();
		session_destroy();
		unset($_SESSION["username"]);

		header('Location: index.php');
		exit;
}
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

	.navbar-brand,
	.nav>li>a {
		padding: 30px 15px;
	}
</style>
<!-- Create back color navy blue -->



<body style="background-color:#2c3e50 ">

	<div id="main-wrapper">
		<ul class="nav nav-tabs list-inline">
			<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
			<li><a data-toggle="tab" href="#SearchPatient">Patients</a></li>
			<li><a data-toggle="tab" href="#UpdatePatient">Update Database</a></li>
		</ul>



		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">

				<center>
					<h2>NCAT HEALTH CENTER</h2>
					<img src="imgs/logo.png" class="avatar" />
					<h4> Welcome <?php echo $_SESSION['username']; ?> </h4>
					<form class="myform" action="Nurse.php" method="post">
						<input name="logout" type="submit" class="btn btn-info btn-lg" id="back_btn" value="Log Out" />
				</center>
			</div>
			<div id="SearchPatient" class="tab-pane fade">
				<center>
					<h2>NCAT HEALTH CENTER</h2>
					<img src="imgs/logo.png" class="avatar" />
					<h4> Welcome <?php echo $_SESSION['username']; ?> </h4>
					<form class="myform" action="Nurse.php" method="post">
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

				</center>
				<table id="myTable">
					<tr class="header">
						<th style="width:5%;">ID</th>
						<th style="width:20%;">Name</th>
						<th style="width:20%;">Email</th>
						<th style="width:20%;">Phone</th>
						<th style="width:20%;">Billing</th>
						<th style="width:20%;">Last Updated</th>
					</tr>
					<tr>
						<td>1</td>
						<td>Geogio Armani</td>
						<td>Alfreds@gmail.com</td>
						<td>(919)-345-6849</td>
						<td>$12,323.23</td>
						<td>12:45 AM</td>
					</tr>
				</table>

				<script>
					function myFunction() {
						var input, filter, table, tr, td, i, txtValue;
						input = document.getElementById("myInput");
						filter = input.value.toUpperCase();
						table = document.getElementById("myTable");
						tr = table.getElementsByTagName("tr");
						for (i = 0; i < tr.length; i++) {
							td = tr[i].getElementsByTagName("td")[1];
							if (td) {
								txtValue = td.textContent || td.innerText;
								if (txtValue.toUpperCase().indexOf(filter) > -1) {
									tr[i].style.display = "";
								} else {
									tr[i].style.display = "none";
								}
							}
						}
					}
				</script>
				<center>


					</form>

			</div>
			<div id="UpdatePatient" class="tab-pane fade">
				<h3>Menu 2</h3>
				<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
			</div>

		</div>



	</div>

</body>

</html>