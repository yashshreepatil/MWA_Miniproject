<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll = $_POST["roll"];
    $dob = $_POST["dob"];

    $query = "SELECT * FROM students WHERE roll = ? AND dob = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $roll, $dob);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION["student_logged_in"] = true;
        $_SESSION["roll"] = $roll;
        header("Location: student_dashboard.php");
    } else {
        header("Location: student_login.php?error=Invalid Roll Number or DOB");
    }
}
?>
