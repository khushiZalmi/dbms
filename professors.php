<?php
$mysqli = new mysqli("localhost", "root", "", "ucms");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Display professors with department names
$sql = "SELECT Professors.ProfessorID, Professors.PName, Departments.DepartmentName 
        FROM Professors 
        INNER JOIN Departments ON Professors.DepartmentID = Departments.DepartmentID";
$result = $mysqli->query($sql);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Professors</title>
    <link rel='stylesheet' href='styles.css'>
</head>
<body>
    <header>
        <h1>Professors</h1>
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
                <th>Professor ID</th>
                <th>Name</th>
                <th>Department</th>
            </tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["ProfessorID"] . "</td><td>" . $row["PName"] . "</td><td>" . $row["DepartmentName"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>No professors found</td></tr>";
}
echo "</table>
    </section>
</body>
</html>";

// Add new professor
if (isset($_POST['action']) && $_POST['action'] === 'add_professor') {
    if ($_POST['action'] === 'add_professor') {
        $pname = $_POST['pname'];
        $dept_id_prof = $_POST['prof_dept_id'];
    
        $sql = "INSERT INTO Professors (PName, DepartmentID) VALUES ('$pname', $dept_id_prof)";
    
        if ($mysqli->query($sql) === TRUE) {
            echo "New professor added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

// Update professor
if (isset($_POST['action']) && $_POST['action'] === 'update_professor') {
    if ($_POST['action'] === 'update_professor') {
        $professor_id = $_POST['update_professor_id'];
        $pname = $_POST['update_professor_name'];
        $dept_id = $_POST['update_professor_dept_id'];
    
        $sql = "UPDATE Professors SET PName='$pname', DepartmentID=$dept_id WHERE ProfessorID=$professor_id";
    
        if ($mysqli->query($sql) === TRUE) {
            echo "Professor updated successfully";
        } else {
            echo "Error updating professor: " . $mysqli->error;
        }
    }
}

// Delete professor
if (isset($_POST['action']) && $_POST['action'] === 'delete_professor') {
    $professor_id = $_POST['delete_professor_id'];
    
    $sql = "DELETE FROM Professors WHERE ProfessorID=$professor_id";
    
    if ($mysqli->query($sql) === TRUE) {
        echo "Professor deleted successfully";
    } else {
        echo "Error deleting professor: " . $mysqli->error;
    }
}

$mysqli->close();
?>
