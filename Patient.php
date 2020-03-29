<?php
session_start();
require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">>
</head>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
<!-- Create back color navy blue -->
<body style="background-color:#2c3e50 ">

	<div id="main-wrapper"> 
		<div style="text-align: center;">
			<h2>NCAT HEALTH CENTER</h2>
			<img src="imgs/logo.png" class="avatar"/>
			<h4> Wel <?php echo $_SESSION['username'];        ?> </h4>
		

		<form class="myform" action="Patient.php" method="post">
            <?php
            $serverName = "DESKTOP-GMPS9UK";
            $dbName="Hospital";
            $username = $_SESSION['userName'];
            $password = $_SESSION['passWord'];
            $dbh = new PDO( "sqlsrv:server=".$serverName."; Database=".$dbName, $username, $password);
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $searchPatient = "select * from patients where ID = '$password'";
            ?>


            <table id="myTable">
                <tr class="header">
                    <th style="width:5%;">ID</th>
                    <th style="width:20%;">Name</th>
                    <th style="width:20%;">Email</th>
                    <th style="width:20%;">Phone</th>
                    <th style="width:20%;">Billing</th>
                    <th style="width:20%;">Last Updated</th>
                </tr>
                <?php
                foreach ($dbh->query($searchPatient) as $rows) {
                    ?>
                    <tr>
                        <td><?php echo ($rows['name']) ?></td>
                        <td><?php echo $rows['address'] ?></td>
                        <td><?php echo $rows['ID'] ?></td>
                        <td><?php echo $rows['phone_number'] ?></td>
                        <td><?php echo $rows['account_balance'] ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

            </table>

            <input name ="logout" type="submit" id="back_btn" value="Log Out"/>
	</form>
	<?php
	if (isset($_POST["logout"])) {
	session_start();
    session_destroy();
    unset($_SESSION["username"]);

    header('Location: index.php');
    exit;

    echo '<script type="text/javascript"> alert("Error! User Name is Taken") </script>';
	
	}


	?>
	</div>


	</div>



</body>
</html>