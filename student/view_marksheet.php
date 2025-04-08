<?php
session_start();
require_once '../admin/db.php'; // adjust the path if needed

// Check if student is logged in
if (!isset($_SESSION["student_logged_in"]) || !isset($_SESSION["roll"])) {
    header("Location: student_login.php");
    exit();
}

$roll = $_SESSION["roll"];
$query = "SELECT * FROM marks WHERE roll = ?";
$stmt = $conn->prepare($query);

// Error check
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $roll);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Marksheet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fef6fb;
            color: #333;
            padding: 20px;
        }
        h2 {
            color: #87337b;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #87337b;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f89af8;
            color: #87337b;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #87337b;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #f89af8;
            color: #87337b;
        }
    </style>
</head>
<body>
    <h2>Your Marksheet</h2>

    <?php if ($data): ?>
        <table>
            <tr>
                <th>Student Name</th>
                <td><?php echo $data['sname']; ?></td>
            </tr>
            <tr>
                <th>Roll Number</th>
                <td><?php echo $data['roll']; ?></td>
            </tr>
            <tr>
                <th>English</th>
                <td><?php echo $data['english']; ?></td>
            </tr>
            <tr>
                <th>Maths</th>
                <td><?php echo $data['maths']; ?></td>
            </tr>
            <tr>
                <th>Science</th>
                <td><?php echo $data['science']; ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>No marks found for your roll number.</p>
    <?php endif; ?>

    <a href="student_dashboard.php">Back to Dashboard</a>
</body>
</html>
