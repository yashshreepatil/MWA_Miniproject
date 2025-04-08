<?php
// Connect to DB
$host = "localhost";
$user = "root";
$password = "";
$db = "school_db"; // Update with your DB name

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll = $_POST["roll"];
    $sname = $_POST["sname"];
    $english = $_POST["english"];
    $maths = $_POST["maths"];
    $science = $_POST["science"];

    $sql = "INSERT INTO marks (roll, sname, english, maths, science) 
            VALUES ('$roll', '$sname', '$english', '$maths', '$science')";

    if ($conn->query($sql) === TRUE) {
        $message = "Marks inserted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enter Marks</title>
    <link rel="stylesheet" href="style.css"> <!-- your main theme -->
    <style>
        .container {
            max-width: 700px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #87337b;
            margin-bottom: 20px;
        }

        form label {
            font-weight: bold;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .btn {
            background: #87337b;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #a4508b;
        }

        .message {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Enter Student Marks</h2>

    <?php if (!empty($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Roll Number:</label>
        <input type="text" name="roll" required>

        <label>Student Name:</label>
        <input type="text" name="sname" required>

        <label>English Marks:</label>
        <input type="number" name="english" min="0" max="100" required>

        <label>Maths Marks:</label>
        <input type="number" name="maths" min="0" max="100" required>

        <label>Science Marks:</label>
        <input type="number" name="science" min="0" max="100" required>

        <input type="submit" value="Submit Marks" class="btn">
    </form>
</div>

</body>
</html>
