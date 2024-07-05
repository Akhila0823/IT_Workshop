<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="s2.css">
    <title>Hall Ticket</title>
</head>
<body>
<br><br><br>

<div class="page-container">
    <div class="content-container">
        <div class="ticket">
            <h1>Hall Ticket</h1>
            <div class="details">
                <?php
                session_start();

                if (!isset($_SESSION['student_id'])) {
                    header("Location: login.html");
                    exit();
                }

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "exam_registration";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $student_id = $_SESSION['student_id'];

                $sql = "SELECT * FROM students WHERE student_id='$student_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<div class='details-left'>";
                    echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                    echo "<p><strong>ID:</strong> " . $row['student_id'] . "</p>";
                    echo "<p><strong>Year:</strong> " . $row['year'] . "</p>";
                    echo "<p><strong>Semester:</strong> " . $row['semester'] . "</p>";
                    echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
                    echo "<p><strong>Mobile:</strong> " . $row['mobile'] . "</p>";
                    echo "<p><strong>Subjects:</strong> " . $row['subjects'] . "</p>";
                    echo "</div>";
                    echo "<div class='photo'>";
                    echo "<img src='uploads/" . $row['photo'] . "' alt='Photo'>";
                    echo "</div>";
                    echo "<div style='clear:both'></div>"; 
                } else {
                    echo "No data found.";
                }

                $conn->close();
                ?>
            </div>
        </div>

        <div class="instructions-container">
            <h2>Guidelines And Instructions</h2>
            <ol class="instructions">
                <li><span>Admit Card Requirements:</span> This hall ticket must be carried to each examination session. </li>
                
                <li><span>Examination Timings:</span> Arrive at the examination center at least 30 minutes before the scheduled time. </li>
                <li><span>Seating:</span> Sit in your assigned seat as per the seating arrangement provided in the examination hall.</li>
                <li><span>Prohibited Items:</span> Electronic devices (mobile phones, smartwatches, calculators unless specified), books, and notes are not allowed inside the examination hall. </li>
                <li><span>Examination Conduct:</span> Follow all instructions given by the invigilators. Maintain silence and do not engage in any form of communication with other candidates during the exam. Raise your hand if you need assistance or need to use the restroom.</li>
                
                <li><span>Malpractice:</span> Any form of cheating or malpractice will result in immediate disqualification and further disciplinary action. Do not attempt to bring in any unauthorized materials or engage in unfair practices.</li>
                
            </ol>
        </div>
    </div>
</div>

<div class="print-button-container">
    <button class="print-button" onclick="window.print()">Print</button>
</div>

</body>
</html>

