<?php
$severname = "localhost";
$username = "root";
$password = "";
$dbname = "classroom";

$conn = new mysqli($severname, $username, $password, $dbname); // mysqli_connect()

// Check connection
if ($conn->connect_error) { // !$conn
	die("Connection failed: " . $conn->connect_error); // mysqli_connect_error()
}
?>