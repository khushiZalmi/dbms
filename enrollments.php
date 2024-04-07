<?php
$mysqli = new mysqli("localhost", "root", "", "ucms");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Display enrollments with student names, course names, and grades
$sql = "SELECT Enrollments.EnrollmentID, Students.SName, Courses.CourseName, Enrollments.Grade 
        FROM Enrollments 
        INNER JOIN Students ON Enrollments.StudentID = Students.StudentID 
        INNER JOIN Courses ON Enrollments.CourseID = Courses.CourseID";
$result = $mysqli->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Enrollments</title>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>
    <header>
        <h1>Enrollments</h1>
    </header>
    <nav>
        <ul>
            <li><a href='index.php'>Home</a></li>
            <li><a href='departments.php'>Departments</a></li>
            <li><a href='students.php'>Students</a></li>
            <li><a href='professors.php'>Professors</a></li>
            <li><a href='courses.php'>Courses</a></li>
            <li><a href='enrollments.php'>Enrollments</a></li>
        </ul>
    </nav>
    <section>
        <table>
            <tr>
                <th>Enrollment ID</th>
                <th>Student Name</th>
                <th>Course Name</th>
                <th>Grade</th>
            </tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["EnrollmentID"] . "</td><td>" . $row["SName"] . "</td><td>" . $row["CourseName"] . "</td><td>" . $row["Grade"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='4'>No enrollments found</td></tr>";
}
echo "</table>
    </section>
</body>
</html>";

$mysqli->close();
?>
