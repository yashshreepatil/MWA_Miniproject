<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_db"; // replace with your DB name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
