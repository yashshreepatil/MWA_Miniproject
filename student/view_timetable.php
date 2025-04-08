<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION["student_logged_in"])) {
    header("Location: student_login.php");
    exit();
}

$roll = $_SESSION["roll"];

// Fetch timetable based on roll number
$stmt = $conn->prepare("SELECT day, subject, time FROM timetable WHERE roll = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("s", $roll);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Timetable</title>
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fef6fb;
        margin: 0;
        padding: 30px;
        color: #333;
    }

    h2 {
        color: #87337b;
        text-align: center;
        margin-bottom: 30px;
    }

    table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(135, 51, 123, 0.1);
    }

    th, td {
        padding: 12px 20px;
        border: 1px solid #87337b;
        text-align: center;
    }

    th {
        background-color: #87337b;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #fce7f5;
    }

    tr:hover {
        background-color: #f89af8;
        color: #fff;
    }

    a {
        display: block;
        width: fit-content;
        margin: 30px auto 0;
        padding: 10px 20px;
        text-align: center;
        background-color: #87337b;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: 0.3s;
    }

    a:hover {
        background-color: #a4508b;
    }
</style>

    <h2>Your Timetable</h2>
    <table border="1">
        <tr>
            <th>Day</th>
            <th>Subject</th>
            <th>Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['day']; ?></td>
                <td><?php echo $row['subject']; ?></td>
                <td><?php echo $row['time']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
