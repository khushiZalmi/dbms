<?php
$mysqli = new mysqli("localhost", "root", "", "ucms");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Display students with department names
$sql = "SELECT Students.StudentID, Students.SName, Students.Email, Departments.DepartmentName 
        FROM Students 
        INNER JOIN Departments ON Students.DepartmentID = Departments.DepartmentID";
$result = $mysqli->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Students</title>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>
    <header>
        <h1>Students</h1>
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
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
            </tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["StudentID"] . "</td><td>" . $row["SName"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["DepartmentName"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='4'>No students found</td></tr>";
}
echo "</table>
    </section>
</body>
</html>";

// Add new student
if (isset($_POST['action']) && $_POST['action'] === 'add_student') {
    if ($_POST['action'] === 'add_student') {
        $sname = $_POST['sname'];
        $email = $_POST['email'];
        $dept_id = $_POST['dept_id'];
    
        $sql = "INSERT INTO Students (SName, Email, DepartmentID) VALUES ('$sname', '$email', $dept_id)";
    
        if ($mysqli->query($sql) === TRUE) {
            echo "New student added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

// Update student
if (isset($_POST['action']) && $_POST['action'] === 'update_student') {
    if ($_POST['action'] === 'update_student') {
        $student_id = $_POST['update_student_id'];
        $sname = $_POST['update_student_name'];
        $email = $_POST['update_student_email'];
    
        $sql = "UPDATE Students SET SName='$sname', Email='$email' WHERE StudentID=$student_id";
    
        if ($mysqli->query($sql) === TRUE) {
            echo "Student updated successfully";
        } else {
            echo "Error updating student: " . $mysqli->error;
        }
    }
}

// Delete student
// Delete student
if (isset($_POST['action']) && $_POST['action'] === 'delete_student') {
    $student_id = $_POST['delete_student_id'];
    
    $sql = "DELETE FROM Students WHERE StudentID=$student_id";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "Student deleted successfully";
    } else {
        echo "Error deleting student: " . $mysqli->error;
    }
}


$mysqli->close();
?>
