<?php
require 'security.php';
require 'dbconfig/config.php';
//Makes sure a user is logged in unless it redirects them to the login page
if ($_SESSION['loggedIn']) {
	//allows user entry

} else {
	//redirect to the login page
	header('Location: https://www.hospital.ncat/Hospital_database/index.php');
	exit();
}
//Log Out of Session
if (isset($_POST["logout"])) {
	session_start();
	session_destroy();
	unset($_SESSION["username"]);

	header('Location: index.php');
	exit;
}







//Create Patient
if (isset($_POST["Add"])) {
	$username = $_POST['uname'];
	$password = $_POST['pword'];
	$name = $_POST['pname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$bill = $_POST['bill'];

	$enPassword = md5($password);

	$query = "insert into patients(username,password,Name,Email,Phone,Billing) values('$username','$enPassword','$name','$email','$phone','$bill')";
	$query_run = mysqli_query($con, $query);
	if ($query_run) {
		echo '<script type="text/javascript"> alert("Patient Created") </script>';
	} else {
		echo '<script type="text/javascript"> alert("Error! recheck formatting") </script>';
	}
}


//Delete Patient


//Create Login
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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

<body style="background-color:#2c3e50 ">

	<div id="main-wrapper">
		<ul class="nav nav-tabs list-inline">
			<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
			<li><a data-toggle="tab" href="#SearchPatient">Patients</a></li>
			<li><a data-toggle="tab" href="#addPatient">Update Database</a></li>
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
				<?php
				$query = "SELECT * FROM patients";
				$query_run = mysqli_query($con, $query);
				?>

				<table id="myTable">
					<thead>
						<tr class="header">
							<th style="width:5%;">ID</th>
							<th style="width:20%;">Name</th>
							<th style="width:20%;">Email</th>
							<th style="width:20%;">Phone</th>
							<th style="width:20%;">Billing</th>
							<th style="width:20%;">Last Updated</th>
							<th style="width:20%;">Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (mysqli_num_rows($query_run) > 0) {
							while ($row = mysqli_fetch_assoc($query_run)) {

								?>

								
						<tr>
							<td><?php echo $row['ID']; ?></td>
							<td><?php echo $row['Name']; ?></td>
							<td><?php echo $row['Email']; ?></td>
							<td><?php echo $row['Phone']; ?></td>
							<td><?php echo $row['Billing']; ?></td>
							<td><?php echo $row['TimeUpdated']; ?></td>
							<td>
								<form action="pedit.php" method="post">
									<input type="hidden" name="edit_id" value="<?php echo $row['ID']; ?>">
								<button type="submit" name="edit_btn" class="btn btn-success"> Edit</button>
								</form>
							</td>
						</tr>
						<?php
							}
						}

						?>
					</tbody>
				</table>

				<script>
					//searches table for specific name
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
			<div id="addPatient" class="tab-pane fade">
				<h3> Add Patients</h3>
				<form action="Nurse.php" class="was-validated" method="post">
					<div class="form-group">
						<label for="uname">Username:</label>
						<input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>

					<div class="form-group">
						<label for="pword">Password:</label>
						<input type="text" class="form-control" id="pword" placeholder="Enter password" name="pword" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>

					<div class="form-group">
						<label for="pname">Patient Name:</label>
						<input type="text" class="form-control" id="uname" placeholder="Enter Patients Full Name" name="pname" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>

					<div class="form-group">
						<label for="phone">Patient Phone Number:</label>
						<input type="text" class="form-control" id="phone" placeholder="Enter Phone Number" name="phone">
					</div>

					<div class="form-group">
						<label for="email">Email:</label>
						<input type="text" class="form-control" id="email" placeholder="Enter Patients Email" name="email">
					</div>

					<div class="form-group">
						<label for="bill">Bill Amount:</label>
						<input type="text" class="form-control" id="bill" placeholder="Enter Patients Bill" name="bill" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>
					<button name="Add" id="Add" type="submit" class="btn btn-primary">Add Patient</button>
			</div>

			</form>
		</div>

	</div>



	</div>

</body>

</html>