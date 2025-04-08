<?php
session_start();
require_once(__DIR__ . '/db.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $role = $_POST['role']; // 'admin' or 'student'

    if ($role === 'admin') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Admin not found.";
        }

        $stmt->close();

    } elseif ($role === 'student') {
        $roll = trim($_POST['roll']);
        $dob = trim($_POST['dob']);

        $stmt = $conn->prepare("SELECT id, roll, dob FROM students WHERE roll = ? AND dob = ?");
        $stmt->bind_param("ss", $roll, $dob);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $student = $result->fetch_assoc();
            $_SESSION['student_logged_in'] = true;
            $_SESSION['student_id'] = $student['id'];
            $_SESSION['roll'] = $student['roll'];
            header("Location: ../student/dashboard.php");
            exit();
        } else {
            echo "Invalid Roll Number or DOB.";
        }

        $stmt->close();
    } else {
        echo "Invalid role.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
