<?php
// Start session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "school_db"); // Change DB name if needed

// Check login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll = $_POST["roll"];
    $dob = $_POST["dob"];

    $sql = "SELECT * FROM students WHERE roll = ? AND dob = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $roll, $dob);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();  // Fetch the student details
        $_SESSION["student_logged_in"] = true;
        $_SESSION["roll"] = $roll;
        $_SESSION["student_name"] = $row['name'];  // Store the student's name in the session
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error = "Invalid Roll Number or Date of Birth!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(to right, #fef6fb, #f89af8);
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            max-width: 400px;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            color: #87337b;
            margin-bottom: 20px;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: 2px solid #87337b;
            border-radius: 8px;
            font-size: 16px;
        }

        .login-container button {
            background: #87337b;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background: #a4508b;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Student Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="roll" placeholder="Roll Number" required>
        <input type="date" name="dob" placeholder="Date of Birth" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
