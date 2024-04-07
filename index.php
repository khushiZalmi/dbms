<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Course Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>University Course Management System</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="departments.php">Departments</a></li>
            <li><a href="students.php">Students</a></li>
            <li><a href="professors.php">Professors</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="enrollments.php">Enrollments</a></li>
        </ul>
    </nav>
    
    <section>
        <!-- Student CRUD form -->
        <div class="form-section">
            <h2>Student Management</h2>
            <div class="column">
                <form action="students.php" method="post">
                    <input type="hidden" name="action" value="add_student">
                    <label for="sname">Student Name:</label>
                    <input type="text" id="sname" name="sname" required><br>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br>
                    <label for="dept_id">Department ID:</label>
                    <input type="number" id="dept_id" name="dept_id" required><br>
                    <button type="submit">Add Student</button>
                </form>
            </div>
            <div class="column">
                <form action="students.php" method="post">
                    <input type="hidden" name="action" value="update_student">
                    <label for="update_student_id">Student ID to Update:</label>
                    <input type="number" id="update_student_id" name="update_student_id" required><br>
                    <label for="update_student_name">New Student Name:</label>
                    <input type="text" id="update_student_name" name="update_student_name" required><br>
                    <label for="update_student_email">New Email:</label>
                    <input type="email" id="update_student_email" name="update_student_email" required><br>
                    <button type="submit">Update Student</button>
                </form>
            </div>
            <div class="column">
                <form action="students.php" method="post">
                    <input type="hidden" name="action" value="delete_student">
                    <label for="delete_student_id">Student ID to Delete:</label>
                    <input type="number" id="delete_student_id" name="delete_student_id" required><br>
                    <label for="confirm_delete_student">Confirm Deletion:</label>
                    <input type="checkbox" id="confirm_delete_student" name="confirm_delete_student" required><br>
                    <button type="submit">Delete Student</button>
                </form>
            </div>
        </div>
        
        <!-- Professor CRUD form -->
        <div class="form-section">
            <h2>Professor Management</h2>
            <div class="column">
                <form action="professors.php" method="post">
                    <input type="hidden" name="action" value="add_professor">
                    <label for="pname">Professor Name:</label>
                    <input type="text" id="pname" name="pname" required><br>
                    <label for="prof_dept_id">Department ID:</label>
                    <input type="number" id="prof_dept_id" name="prof_dept_id" required><br>
                    <button type="submit">Add Professor</button>
                </form>
            </div>
            <div class="column">
                <form action="professors.php" method="post">
                    <input type="hidden" name="action" value="update_professor">
                    <label for="update_professor_id">Professor ID to Update:</label>
                    <input type="number" id="update_professor_id" name="update_professor_id" required><br>
                    <label for="update_professor_name">New Professor Name:</label>
                    <input type="text" id="update_professor_name" name="update_professor_name" required><br>
                    <label for="update_professor_dept_id">New Department ID:</label>
                    <input type="number" id="update_professor_dept_id" name="update_professor_dept_id" required><br>
                    <button type="submit">Update Professor</button>
                </form>
            </div>
            <div class="column">
                <form action="professors.php" method="post">
                    <input type="hidden" name="action" value="delete_professor">
                    <label for="delete_professor_id">Professor ID to Delete:</label>
                    <input type="number" id="delete_professor_id" name="delete_professor_id" required><br>
                    <label for="confirm_delete_professor">Confirm Deletion:</label>
                    <input type="checkbox" id="confirm_delete_professor" name="confirm_delete_professor" required><br>
                    <button type="submit">Delete Professor</button>
                </form>
            </div>
        </div>

        <!-- Department CRUD form -->
        <div class="form-section">
            <h2>Department Management</h2>
            <div class="column">
                <form action="departments.php" method="post">
                    <input type="hidden" name="action" value="add_department">
                    <label for="department_name">Department Name:</label>
                    <input type="text" id="department_name" name="department_name" required><br>
                    <button type="submit">Add Department</button>
                </form>
            </div>
            <div class="column">
                <form action="departments.php" method="post">
                    <input type="hidden" name="action" value="update_department">
                    <label for="update_department_id">Department ID to Update:</label>
                    <input type="number" id="update_department_id" name="update_department_id" required><br>
                    <label for="update_department_name">New Department Name:</label>
                    <input type="text" id="update_department_name" name="update_department_name" required><br>
                    <button type="submit">Update Department</button>
                </form>
            </div>
            <div class="column">
                <form action="departments.php" method="post">
                    <input type="hidden" name="action" value="delete_department">
                    <label for="delete_department_id">Department ID to Delete:</label>
                    <input type="number" id="delete_department_id" name="delete_department_id" required><br>
                    <label for="confirm_delete_department">Confirm Deletion:</label>
                    <input type="checkbox" id="confirm_delete_department" name="confirm_delete_department" required><br>
                    <button type="submit">Delete Department</button>
                </form>
            </div>
        </div>

        <!-- Course CRUD form -->
        <div class="form-section">
            <h2>Course Management</h2>
            <div class="column">
                <form action="courses.php" method="post">
                    <input type="hidden" name="action" value="add_course">
                    <label for="course_name">Course Name:</label>
                    <input type="text" id="course_name" name="course_name" required><br>
                    <label for="course_dept_id">Department ID:</label>
                    <input type="number" id="course_dept_id" name="course_dept_id" required><br>
                    <label for="course_prof_id">Professor ID:</label>
                    <input type="number" id="course_prof_id" name="course_prof_id" required><br>
                    <button type="submit">Add Course</button>
                </form>
            </div>
            <div class="column">
                <form action="courses.php" method="post">
                    <input type="hidden" name="action" value="update_course">
                    <label for="update_course_id">Course ID to Update:</label>
                    <input type="number" id="update_course_id" name="update_course_id" required><br>
                    <label for="update_course_name">New Course Name:</label>
                    <input type="text" id="update_course_name" name="update_course_name" required><br>
                    <label for="update_course_dept_id">New Department ID:</label>
                    <input type="number" id="update_course_dept_id" name="update_course_dept_id" required><br>
                    <label for="update_course_prof_id">New Professor ID:</label>
                    <input type="number" id="update_course_prof_id" name="update_course_prof_id" required><br>
                    <button type="submit">Update Course</button>
                </form>
            </div>
            <div class="column">
                <form action="courses.php" method="post">
                    <input type="hidden" name="action" value="delete_course">
                    <label for="delete_course_id">Course ID to Delete:</label>
                    <input type="number" id="delete_course_id" name="delete_course_id" required><br>
                    <label for="confirm_delete_course">Confirm Deletion:</label>
                    <input type="checkbox" id="confirm_delete_course" name="confirm_delete_course" required><br>
                    <button type="submit">Delete Course</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
