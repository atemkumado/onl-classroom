<?php
// $severname = "localhost"; JUST ONLY USE FOR LOCAL HOST SERVER
// $username = "root";
// $password = "";
// $dbname = "classroom";

$severname = "remotemysql.com";
$username = "BGXa3Czsb8";
$password = "3mAMrgtIdf";
$dbname = "BGXa3Czsb8";

$conn = new mysqli($severname, $username, $password, $dbname); // mysqli_connect()

// Check connection
if ($conn->connect_error) { // !$conn
	die("Connection failed: " . $conn->connect_error); // mysqli_connect_error()
}
?>