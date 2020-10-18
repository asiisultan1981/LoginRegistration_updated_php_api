<?php


$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "loginregisterdb";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if($conn){
	echo "successfull connection";
}else
{
	echo "connection failed";
}


?>




