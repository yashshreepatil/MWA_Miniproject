<?php
require 'dompdf/autoload.inc.php'; // Path to dompdf
use Dompdf\Dompdf;

// Connect to DB
$conn = new mysqli("localhost", "root", "", "school_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll = $_POST["roll"];
    $sql = "SELECT * FROM marks WHERE roll='$roll'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Generate HTML Marksheet
        $html = '
        <h2 style="text-align:center; color:#87337b;">Student Marksheet</h2>
        <p><strong>Roll Number:</strong> '.$row["roll"].'</p>
        <p><strong>Name:</strong> '.$row["name"].'</p>
        <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
            <tr style="background-color:#f89af8;">
                <th>Subject</th>
                <th>Marks</th>
            </tr>
            <tr><td>English</td><td>'.$row["english"].'</td></tr>
            <tr><td>Maths</td><td>'.$row["maths"].'</td></tr>
            <tr><td>Science</td><td>'.$row["science"].'</td></tr>
        </table>';

        // Create PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF
        $dompdf->stream("Marksheet_".$row["roll"].".pdf");
        exit;
    } else {
        $error = "Roll number not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Download Marksheet</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #87337b;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            background: #87337b;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #a4508b;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Download Marksheet</h2>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <label>Enter Roll Number:</label>
        <input type="text" name="roll" required>
        <input type="submit" class="btn" value="Download">
    </form>
</div>

</body>
</html>
\\\=-