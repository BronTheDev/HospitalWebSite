<?php
session_start();
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
?>