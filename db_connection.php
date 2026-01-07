<?php
// database connection details
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "rohan";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
