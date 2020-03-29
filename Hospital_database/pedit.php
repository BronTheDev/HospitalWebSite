<?php
require 'security.php';
require 'dbconfig/config.php';




//Updates Patient Information
if (isset($_POST['update_btn'])) {
    $id = $_POST['edit_id'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$bill = $_POST['bill'];

	$query = "UPDATE patients SET Name='$name',Email='$email',Phone='$phone',Billing='$bill' WHERE ID = '$id'";
    $query_run = mysqli_query($con, $query);
	if ($query_run) {
        echo '<script type="text/javascript"> alert("Patient Created") </script>';
        header('Location: https://www.hospital.ncat/Hospital_database/Nurse.php');
        exit();
	} else {
        echo '<script type="text/javascript"> alert("Error! recheck formatting") </script>';
        header('Location: https://www.hospital.ncat/Hospital_database/pedit.php');
        exit();
	}

}


//Deletes Patient Information
if (isset($_POST['delete_btn'])) {
    $id = $_POST['edit_id'];
	$query = "DELETE FROM patients WHERE ID = '$id'";
    $query_run = mysqli_query($con, $query);
	if ($query_run) {

        header('Location: https://www.hospital.ncat/Hospital_database/Nurse.php');
        exit();
	} else {
        header('Location: https://www.hospital.ncat/Hospital_database/pedit.php');
        exit();
	}

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie = edge">
    <title>Patient Editor</title>
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
        height: 100%;
        width: 35%;
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
</style>

<body style="background-color:#2c3e50 ">


    <?php
    //Update Patient
    if (isset($_POST['edit_btn'])) {

        $id = $_POST['edit_id'];
        $query = "SELECT * FROM patients WHERE ID='$id' ";
        $query_run = mysqli_query($con, $query);

        foreach ($query_run as $row) {
    ?>

            <div id="main-wrapper">

                <h3> Edit Patient</h3>
                <form action="pedit.php" class="myform" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['ID'] ?>">
                    <div class="form-group">
                        <label for="pname">Patient Name:</label>
                        <input type="text" class="form-control" value="<?php echo $row['Name'] ?>" placeholder="Enter Patients Full Name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Patient Phone Number:</label>
                        <input type="text" class="form-control" value="<?php echo $row['Phone'] ?>" placeholder="Enter Phone Number"name="phone">
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" value="<?php echo $row['Email'] ?>" placeholder="Enter Patients Email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="bill">Bill Amount:</label>
                        <input type="text" class="form-control" value="<?php echo $row['Billing'] ?>" placeholder="Enter Patients Bill"  name="bill"required>
                    </div>


                    <center>
                        <button name="update_btn" id="update_btn" type="submit" class="btn btn-primary">Update</button>
                        <button name="delete_btn" id="delete_btn" type="submit" class="btn btn-danger">Delete</button>
                    </center>
                </form>

            </div>
    <?php
        }
    }
    ?>
</body>

</html>