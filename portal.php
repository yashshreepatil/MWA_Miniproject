<!DOCTYPE html>
<html>
<head>
    <title>Prachiti International School</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .header {
            background-color: #87337b;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
        }

        .main-content {
            padding: 40px;
            text-align: center;
        }

        .main-content h2 {
            margin-bottom: 20px;
            color: #87337b;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }

        .feature-box {
            background-color: white;
            padding: 25px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        .feature-box h3 {
            color: #a4508b;
        }

        .login-buttons {
            margin-top: 40px;
        }

        .login-buttons a {
            margin: 10px;
            padding: 12px 30px;
            background-color: #87337b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .login-buttons a:hover {
            background-color: #a4508b;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #eee;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Prachiti International School</h1>
    <p>Empowering Students with Digital Education</p>
</div>

<div class="main-content">
    <h2>Welcome to Our School Management System</h2>

    <div class="features">
        <div class="feature-box">
            <h3>Student Records</h3>
            <p>Manage and view student information securely.</p>
        </div>
        <div class="feature-box">
            <h3>Timetables</h3>
            <p>Dynamic and real-time class scheduling system.</p>
        </div>
        <div class="feature-box">
            <h3>Marksheet</h3>
            <p>View and generate student exam results easily.</p>
        </div>
        <div class="feature-box">
            <h3>Fees Management</h3>
            <p>Track and manage student fees and dues.</p>
        </div>
    </div>

    <div class="login-buttons">
        <a href="admin/admin_login.php">Admin Login</a>
        <a href="student/student_login.php">Student Login</a>
    </div>
</div>

<div class="footer">
    &copy; <?php echo date("Y"); ?> Prachiti International School. All rights reserved.
</div>

</body>
</html>
