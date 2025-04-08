<?php
include 'auth.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $day = $_POST['day'];
    $subject = $_POST['subject'];
    $time = $_POST['time'];

    mysqli_query($conn, "INSERT INTO timetable (day, subject, time) VALUES ('$day', '$subject', '$time')");
    echo "Timetable entry added!";
}
?>

<h2>Manage Timetable</h2>
<form method="post">
    Day: <input type="text" name="day" required><br>
    Subject: <input type="text" name="subject" required><br>
    Time: <input type="text" name="time" required><br>
    <input type="submit" value="Add">
</form>
