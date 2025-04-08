<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: dashboard/admin-dashboard.php");
        exit();
    } elseif ($_SESSION['role'] == 'student') {
        header("Location: dashboard/student-dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Prachiti School</title>
    <link rel="stylesheet" href="css/style.css"> <!-- optional CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0e9f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .login-box h2 {
            margin-bottom: 20px;
            color: #87337b;
            text-align: center;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #87337b;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <?php if (isset($_GET['error'])) { echo '<p class="error">' . $_GET['error'] . '</p>'; } ?>
    <form method="POST" action="includes/auth.php">
        <select name="role" required>
            <option value="">-- Select Role --</option>
            <option value="admin">Admin</option>
            <option value="student">Student</option>
        </select>

        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>

        <input type="submit" name="login" value="Login">
    </form>
</div>

</body>
</html>
