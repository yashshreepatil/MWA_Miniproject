<?php
session_start();
require_once 'db.php';

// Redirect if not logged in
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

// Handle Add or Update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $roll = $_POST['roll'];
    $class = $_POST['class'];
    $day = $_POST['day'];
    $subject = $_POST['subject'];
    $time = $_POST['time'];

    // Check if a timetable entry for same roll, class, day & subject exists
    $check = $conn->prepare("SELECT id FROM timetable WHERE roll = ? AND class = ? AND day = ? AND subject = ?");
    if (!$check) die("Prepare failed: " . $conn->error);
    $check->bind_param("isss", $roll, $class, $day, $subject);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows > 0) {
        // Update time if entry exists
        $update = $conn->prepare("UPDATE timetable SET time = ? WHERE roll = ? AND class = ? AND day = ? AND subject = ?");
        $update->bind_param("sisss", $time, $roll, $class, $day, $subject);
        $update->execute();
    } else {
        // Insert new
        $insert = $conn->prepare("INSERT INTO timetable (roll, class, day, subject, time) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("issss", $roll, $class, $day, $subject, $time);
        $insert->execute();
    }
}

// Fetch all timetable records
$result = $conn->query("SELECT * FROM timetable");
if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Timetable Management</title>
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fef6fb;
        padding: 20px;
    }

    h2, h3 {
        color: #87337b;
    }

    form {
        background-color: #fff;
        border: 2px solid #87337b;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        margin-bottom: 30px;
        box-shadow: 2px 2px 10px rgba(135, 51, 123, 0.2);
    }

    input, select {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button {
        background-color: #87337b;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #f89af8;
        color: #87337b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
    }
</style>

<h2>Timetable Management (Admin)</h2>

<form method="POST">
    <input type="number" name="roll" placeholder="Student Roll No" required><br>
    <input type="text" name="class" placeholder="Class" required><br>
    <select name="day" required>
        <option value="">Select Day</option>
        <option>Monday</option>
        <option>Tuesday</option>
        <option>Wednesday</option>
        <option>Thursday</option>
        <option>Friday</option>
        <option>Saturday</option>
    </select><br>
    <input type="text" name="subject" placeholder="Subject" required><br>
    <input type="text" name="time" placeholder="Time (e.g., 10:00 AM - 11:00 AM)" required><br>
    <button type="submit">Save Timetable</button>
</form>

<h3>All Timetable Records</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Roll</th>
        <th>Class</th>
        <th>Day</th>
        <th>Subject</th>
        <th>Time</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['roll']; ?></td>
        <td><?php echo $row['class']; ?></td>
        <td><?php echo $row['day']; ?></td>
        <td><?php echo $row['subject']; ?></td>
        <td><?php echo $row['time']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
