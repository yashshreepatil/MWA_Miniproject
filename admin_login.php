<?php
// Start session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "school_db"); // Change DB name

// Check login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css"> <!-- Your existing CSS -->
    <style>
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        .login-container h2 {
            text-align: center;
            color: #87337b;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container button {
            background: #87337b;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-container button:hover {
            background: #a4508b;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Admin Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="hidden" name="role" value="admin">
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
