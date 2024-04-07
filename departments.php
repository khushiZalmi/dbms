<?php
$mysqli = new mysqli("localhost", "root", "", "ucms");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Display departments
$sql = "SELECT * FROM Departments";
$result = $mysqli->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Departments</title>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>
    <header>
        <h1>Departments</h1>
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
                <th>Department ID</th>
                <th>Department Name</th>
            </tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["DepartmentID"] . "</td><td>" . $row["DepartmentName"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='2'>No departments found</td></tr>";
}
echo "</table>
    </section>
</body>
</html>";

// Add new department
if (isset($_POST['action']) && $_POST['action'] === 'add_department') {
    if ($_POST['action'] === 'add_department') {
        $dept_name = $_POST['department_name'];
    
        $sql = "INSERT INTO Departments (DepartmentName) VALUES ('$dept_name')";
    
        if ($mysqli->query($sql) === TRUE) {
            echo "New department added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

// Update department
if (isset($_POST['action']) && $_POST['action'] === 'update_department') {
    if ($_POST['action'] === 'update_department') {
        $department_id = $_POST['update_department_id'];
        $department_name = $_POST['update_department_name'];
    
        $sql = "UPDATE Departments SET DepartmentName='$department_name' WHERE DepartmentID=$department_id";
    
        if ($mysqli->query($sql) === TRUE) {
            echo "Department updated successfully";
        } else {
            echo "Error updating department: " . $mysqli->error;
        }
    }
}

// Delete department
if (isset($_POST['action']) && $_POST['action'] === 'delete_department') {
    $department_id = $_POST['delete_department_id'];
    
    $sql = "DELETE FROM Departments WHERE DepartmentID=$department_id";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "Department deleted successfully";
    } else {
        echo "Error deleting department: " . $mysqli->error;
    }
}

$mysqli->close();
?>
