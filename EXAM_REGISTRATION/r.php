<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_registration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $photo = $_FILES['photo']['name'];
    $subjects = implode(", ", $_POST['subjects']);

   
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

    $sql = "INSERT INTO students (year, semester, student_id, name, gender, mobile, photo, subjects)
            VALUES ('$year', '$semester', '$student_id', '$name', '$gender', '$mobile', '$photo', '$subjects')";

    if ($conn->query($sql) === TRUE) {
        echo '<div style="text-align: center; margin-top: 20px; color: green;">Registration successful!</div>';

        echo '<div style="text-align: center; margin-top: 10px;"><form action="log.html" method="get"><input type="submit" value="Login" style="color: red;"></form></div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

