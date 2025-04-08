<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION["student_logged_in"])) {
    header("Location: student_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional external stylesheet -->
    <style>
        body {
            background: #fef6fb;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

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
            background: #f89af8;
            color: #87337b;
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
        <h1>Welcome, <?php echo $_SESSION['student_name']; ?></h1>
        <p>Your academic details in one place</p>
    </div>

    <div class="dashboard-actions">
        <div class="dashboard-card">
            <h3>View Marksheet</h3>
            <a href="view_marksheet.php">Go</a>
        </div>
        <div class="dashboard-card">
            <h3>Fee Details</h3>
            <a href="student/fees_status.php">Go</a>
        </div>
        <div class="dashboard-card">
            <h3>Timetable</h3>
            <a href="timetable.php">Go</a>
        </div>
    </div>

    <div class="logout">
        <p><a href="logout.php">Logout</a></p>
    </div>
</div>

</body>
</html>
