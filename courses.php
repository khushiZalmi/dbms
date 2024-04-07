<?php
$mysqli = new mysqli("localhost", "root", "", "ucms");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Display courses with department names, professor names, and enrollment count
$sql = "SELECT Courses.CourseID, Courses.CourseName, Departments.DepartmentName, Professors.PName, Courses.EnrollmentCount 
        FROM Courses 
        INNER JOIN Departments ON Courses.DepartmentID = Departments.DepartmentID
        INNER JOIN Professors ON Courses.ProfessorID = Professors.ProfessorID";
$result = $mysqli->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Courses</title>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>
    <header>
        <h1>Courses</h1>
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
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Department</th>
                <th>Professor</th>
                <th>Enrollment Count</th>
            </tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["CourseID"] . "</td><td>" . $row["CourseName"] . "</td><td>" . $row["DepartmentName"] . "</td><td>" . $row["PName"] . "</td><td>" . $row["EnrollmentCount"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>No courses found</td></tr>";
}
echo "</table>
    </section>
</body>
</html>";

// Add new course
if (isset($_POST['action']) && $_POST['action'] === 'add_course') {
    if ($_POST['action'] === 'add_course') {
        $course_name = $_POST['course_name'];
        $dept_id = $_POST['course_dept_id'];
        $prof_id = $_POST['course_prof_id'];
    
        $sql = "INSERT INTO Courses (CourseName, DepartmentID, ProfessorID) VALUES ('$course_name', $dept_id, $prof_id)";
    
        if ($mysqli->query($sql) === TRUE) {
            echo "New course added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

// Update course
if (isset($_POST['action']) && $_POST['action'] === 'update_course') {
    if ($_POST['action'] === 'update_course') {
        $course_id = $_POST['update_course_id'];
        $course_name = $_POST['update_course_name'];
        $dept_id = $_POST['update_course_dept_id'];
        $prof_id = $_POST['update_course_prof_id'];
    
        $sql = "UPDATE Courses SET CourseName='$course_name', DepartmentID=$dept_id, ProfessorID=$prof_id WHERE CourseID=$course_id";
    
        if ($mysqli->query($sql) === TRUE) {
            echo "Course updated successfully";
        } else {
            echo "Error updating course: " . $mysqli->error;
        }
    }
}

// Delete course
if (isset($_POST['action']) && $_POST['action'] === 'delete_course') {
    $course_id = $_POST['delete_course_id'];
    
    $sql = "DELETE FROM Courses WHERE CourseID=$course_id";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "Course deleted successfully";
    } else {
        echo "Error deleting course: " . $mysqli->error;
    }
}

$mysqli->close();
?>
