<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name"; // replace with your DB name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
