<?php
$hostname = "localhost";
$username = "root";
$password = "cs4112018";
$database = "healthyfood";

$con=mysqli_connect($hostname, $username, $password, $database);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 mysqli_set_charset($con, 'utf8');
?>