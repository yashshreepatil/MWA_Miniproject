<?php
session_start();

// If not logged in, redirect to login
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Your main CSS file -->
    <style>
        .dashboard-container {
            max-width: 1000px;
            margin: 50px auto;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .dashboard-header h1 {
            color: #87337b;
        }
        .dashboard-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }
        .dashboard-card {
            width: 250px;
            padding: 30px;
            text-align: center;
            background: #f2f2f2;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .dashboard-card h3 {
            margin-bottom: 15px;
            color: #87337b;
        }
        .dashboard-card a {
            background: #87337b;
            color: white;
            padding: 10px 20px;
            display: inline-block;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
        .dashboard-card a:hover {
            background: #a4508b;
        }

        .logout {
            margin-top: 30px;
            text-align: center;
        }

        .logout a {
            color: red;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Welcome, Admin</h1>
        <p>Manage student data efficiently</p>
    </div>

    <div class="dashboard-actions">
        <div class="dashboard-card">
            <h3>Enter Marks</h3>
            <a href="enter_marks.php">Go</a>
        </div>
        <div class="dashboard-card">
            <h3>Generate Marksheet</h3>
            <a href="admin/generate_marksheet.php">Go</a>
        </div>
        <div class="dashboard-card">
            <h3>Fee Management</h3>
            <a href="admin/fess_management.php">Go</a>
        </div>
    </div>

    <div class="logout">
        <p><a href="logout.php">Logout</a></p>
    </div>
</div>

</body>
</html>
