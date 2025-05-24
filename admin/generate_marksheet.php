<?php
session_start();
require_once('db.php'); // Ensure this file exists in admin folder

// Check if admin is logged in
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM marks");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Generated Marksheets</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 style="text-align:center; color:#87337b;">Generated Marksheets</h2>
    <table border="1" cellpadding="10" cellspacing="0" style="margin: 0 auto; border-collapse: collapse;">
        <tr style="background-color: #f2f2f2;">
            <th>Roll No</th>
            <th>Student Name</th>
            <th>English</th>
            <th>Maths</th>
            <th>Science</th>
            <th>Total</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['roll'] ?></td>
                <td><?= $row['sname'] ?></td>
                <td><?= $row['english'] ?></td>
                <td><?= $row['maths'] ?></td>
                <td><?= $row['science'] ?></td>
                <td><?= $row['english'] + $row['maths'] + $row['science'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
