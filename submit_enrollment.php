<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "school_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$student_name = $_POST['student_name'];
$dob = $_POST['dob'];
$parent_name = $_POST['parent_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$grade = $_POST['grade'];
$address = $_POST['add1'];

// Insert into database
$sql = "INSERT INTO enrollments (student_name, dob, parent_name, phone, email, grade,add1) 
        VALUES ('$student_name', '$dob', '$parent_name', '$phone', '$email', '$grade', '$address')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Enrollment submitted successfully!'); window.location.href='enroll.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
