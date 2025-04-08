<?php
session_start();
require_once '../db.php'; // Adjust path based on your folder structure

if (!isset($_SESSION["student_logged_in"])) {
    header("Location: student_login.php");
    exit();
}

$roll = $_SESSION["roll"];
$query = "SELECT total_fee, paid_fee, due_date FROM fees WHERE roll = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $roll);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
} else {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fee Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fef6fb;
            padding: 20px;
        }
        h2 {
            color: #87337b;
        }
        .fee-box {
            background-color: #fff;
            border: 2px solid #87337b;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            box-shadow: 2px 2px 10px rgba(135, 51, 123, 0.2);
        }
        .fee-box p {
            font-size: 16px;
            margin: 10px 0;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #87337b;
            text-decoration: none;
        }
        a:hover {
            color: #f89af8;
        }
    </style>
</head>
<body>
    <h2>Your Fee Status</h2>
    <div class="fee-box">
        <?php if ($data): ?>
            <p><strong>Total Fee:</strong> ₹<?php echo $data['total_fee']; ?></p>
            <p><strong>Paid:</strong> ₹<?php echo $data['paid_fee']; ?></p>
            <p><strong>Due Date:</strong> <?php echo $data['due_date']; ?></p>
        <?php else: ?>
            <p>No fee record found for your roll number.</p>
        <?php endif; ?>
    </div>
    <a href="student_dashboard.php">⬅ Back to Dashboard</a>
</body>
</html>
