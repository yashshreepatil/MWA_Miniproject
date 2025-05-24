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
    $dob = $_POST['dob'];
    $name = $_POST['name'];

    // Check if record exists
    $check = $conn->prepare("SELECT id FROM students WHERE roll = ?");
if (!$check) {
    die("Prepare failed (SELECT): " . $conn->error);
}
$check->bind_param("s", $roll);

    $check->bind_param("s", $roll);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows > 0) {
        // Update
        $update = $conn->prepare("UPDATE students SET name = ?, dob = ? WHERE roll = ?");
        $update->bind_param("sss", $name, $dob, $roll);
        $update->execute();
    } else {
        // Insert
        $insert = $conn->prepare("INSERT INTO students (roll, dob, name) VALUES (?, ?, ?)");
        $insert->bind_param("sss", $roll, $dob, $name);
        $insert->execute();
    }
}

// Fetch all students
$result = $conn->query("SELECT * FROM students");

if (!$result) {
    die("Query Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Student Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fef6fb;
        color: #333;
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

    input[type="text"],
    input[type="date"] {
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
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #f89af8;
        color: #87337b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #87337b;
    }

    th, td {
        padding: 10px;
        text-align: center;
    }
</style>

<h2>Student Management (Admin)</h2>

<form method="POST">
    <input type="text" name="roll" placeholder="Student Roll No" required><br>
    <input type="text" name="name" placeholder="Student Name" required><br>
    <input type="date" name="dob" placeholder="Date of Birth" required><br>
    <button type="submit">Save Student</button>
</form>

<h3>All Students</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Roll No</th>
        <th>Name</th>
        <th>Date of Birth</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['roll']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['dob']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
