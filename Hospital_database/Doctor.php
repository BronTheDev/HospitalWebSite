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
		</ul>



		<div class="tab-content">
			<div id="home" class="tab-pane fade in active">

				<center>
					<h2>NCAT HEALTH CENTER</h2>
					<img src="imgs/logo.png" class="avatar" />
					<h4> Welcome <?php echo $_SESSION['username']; ?> </h4>
					<form class="myform" action="Doctor.php" method="post">
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
							<th style="width:20%;">Delete</th>
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
									<input type="text" name="edit_id" value="<?php echo $row['ID']; ?>">
								<button type="submit" name="edit_btn" class="btn btn-success"> Edit</button>
								</form>
							</td>
							<td>
								<button type="submit" class="btn btn-danger"> Delete</button>
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



	</div>

</body>

</html>