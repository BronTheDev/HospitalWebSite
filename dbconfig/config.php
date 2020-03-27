<?php
/*creates a connection or dies
localhost = server
root = username
Aubron07 = password
*/
$con = mysqli_connect("localhost","root","Aubron07") or die("unable to connect");
//selects which database to connect to
mysqli_select_db($con, 'HospitalDB');





?>