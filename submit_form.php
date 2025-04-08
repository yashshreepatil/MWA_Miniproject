<?php
// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your actual MySQL password
$database = "school_db";
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$s_name = $_POST['s_name'];
$email = $_POST['email'];
$c_ubject = $_POST['c_subject'];
$msg = $_POST['msg'];


// Insert into database
$sql = "INSERT INTO contact_form  (s_name, email, c_subject, msg) 
        VALUES ('$s_name', '$email', '$c_subject', '$msg')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Message send successfully'); window.location.href='contact.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
