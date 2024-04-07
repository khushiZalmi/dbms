-- Creating the Schema
CREATE DATABASE ucms;
USE ucms;
DROP DATABASE ucms;

-- Creating the Relations
-- Departments table
CREATE TABLE Departments (
    DepartmentID INT AUTO_INCREMENT PRIMARY KEY,
    DepartmentName VARCHAR(100)
);

-- Students table
CREATE TABLE Students (
    StudentID INT AUTO_INCREMENT PRIMARY KEY,
    SName VARCHAR(50),
    Email VARCHAR(100),
    DepartmentID INT,
    FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID)
);

-- Professors table
CREATE TABLE Professors (
    ProfessorID INT AUTO_INCREMENT PRIMARY KEY,
    PName VARCHAR(50),
    DepartmentID INT,
    FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID)
);

-- Courses table
CREATE TABLE Courses (
    CourseID INT AUTO_INCREMENT PRIMARY KEY,
    CourseName VARCHAR(100),
    DepartmentID INT,
    ProfessorID INT,
    EnrollmentCount INT DEFAULT 0,
    FOREIGN KEY (DepartmentID) REFERENCES Departments(DepartmentID),
    FOREIGN KEY (ProfessorID) REFERENCES Professors(ProfessorID)
);

-- Enrollments table
CREATE TABLE Enrollments (
    EnrollmentID INT AUTO_INCREMENT PRIMARY KEY,
    StudentID INT,
    CourseID INT,
    Grade VARCHAR(2),
    FOREIGN KEY (StudentID) REFERENCES Students(StudentID),
    FOREIGN KEY (CourseID) REFERENCES Courses(CourseID)
);

-- Creating the Triggers
-- Trigger to enforce Grade Constraints
DELIMITER //
CREATE TRIGGER Enrollments_GradeCheck
BEFORE INSERT ON Enrollments
FOR EACH ROW
BEGIN
    IF NEW.Grade NOT IN ('A', 'B', 'C', 'D', 'F') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid grade. Grades must be A, B, C, D, or F.';
    END IF;
END //
DELIMITER ;

-- Trigger to update Course Enrollment Count
DELIMITER //
CREATE TRIGGER Enrollments_UpdateCount
AFTER INSERT ON Enrollments
FOR EACH ROW
BEGIN
    UPDATE Courses
    SET EnrollmentCount = EnrollmentCount + 1
    WHERE CourseID = NEW.CourseID;
END //
DELIMITER ;

-- CASCADE DELETION TRIGGERS
DELIMITER $$

-- Trigger for deleting students and related enrollments
CREATE TRIGGER delete_student_enrollments 
BEFORE DELETE ON Students 
FOR EACH ROW 
BEGIN
    DELETE FROM Enrollments WHERE StudentID = OLD.StudentID;
END $$

-- Trigger for deleting professors and related courses
CREATE TRIGGER delete_professor_courses 
BEFORE DELETE ON Professors 
FOR EACH ROW 
BEGIN
    DELETE FROM Courses WHERE ProfessorID = OLD.ProfessorID;
END $$

-- Trigger for deleting departments and related professors and courses
CREATE TRIGGER delete_department_professors_courses 
BEFORE DELETE ON Departments 
FOR EACH ROW 
BEGIN
    DECLARE dept_id_val INT;
    SET dept_id_val = OLD.DepartmentID;
    DELETE FROM Professors WHERE DepartmentID = dept_id_val;
    DELETE FROM Courses WHERE DepartmentID = dept_id_val;
END $$

-- Trigger for deleting courses and related enrollments
CREATE TRIGGER delete_course_enrollments 
BEFORE DELETE ON Courses 
FOR EACH ROW 
BEGIN
    DELETE FROM Enrollments WHERE CourseID = OLD.CourseID;
END $$

DELIMITER ;


-- Inserting Sample Values
-- Insert values into Departments table
INSERT INTO Departments (DepartmentName) VALUES
('Computer Science'),
('Electrical Engineering'),
('Mechanical Engineering'),
('Physics'),
('Mathematics'),
('Chemistry'),
('Biology'),
('English'),
('History'),
('Art'),
('Computer Engineering'),
('Civil Engineering'),
('Environmental Science'),
('Psychology'),
('Sociology'),
('Anthropology'),
('Political Science'),
('Economics'),
('Geography'),
('Linguistics');

-- Insert values into Professors table
INSERT INTO Professors (PName, DepartmentID) VALUES
('Prof. Smith', 1),
('Prof. Johnson', 2),
('Prof. Lee', 3),
('Prof. Rodriguez', 4),
('Prof. Smithson', 5),
('Prof. Martinez', 6),
('Prof. Thompson', 7),
('Prof. Davis', 8),
('Prof. Garcia', 9),
('Prof. Wilson', 10),
('Prof. Brown', 11),
('Prof. Clark', 12),
('Prof. Evans', 13),
('Prof. Harris', 14),
('Prof. Jackson', 15),
('Prof. Lewis', 16),
('Prof. Miller', 17),
('Prof. Parker', 18),
('Prof. Robinson', 19),
('Prof. Scott', 20);

-- Insert values into Courses table
INSERT INTO Courses (CourseName, DepartmentID, ProfessorID) VALUES
('Database Management', 1, 1),
('Data Structures', 1, 1),
('Circuit Analysis', 2, 2),
('Quantum Mechanics', 1, 3),
('Calculus', 2, 4),
('Organic Chemistry', 6, 7),
('Biology 101', 7, 8),
('Introduction to Literature', 8, 9),
('World History', 9, 10),
('Art Appreciation', 10, 5),
('Computer Networks', 11, 13),
('Structural Engineering', 12, 14),
('Environmental Policy', 13, 15),
('Introduction to Psychology', 14, 16),
('Sociological Theory', 15, 17),
('Cultural Anthropology', 16, 18),
('International Relations', 17, 19),
('Microeconomics', 18, 20),
('World Geography', 19, 11),
('Phonetics', 20, 12);

-- Insert values into Students table
INSERT INTO Students (SName, Email, DepartmentID) VALUES
('Amanda Dias', 'amanda@example.com', 1),
('Brandon Fernandes', 'brandon@example.com', 2),
('Carmen Quadros', 'carmen@example.com', 3),
('David D`souza', 'david@example.com', 1),
('Emma D`Sa', 'emma@example.com', 2),
('Sophia Menezes', 'sophia@example.com', 3),
('James Rodrigues', 'james@example.com', 4),
('Olivia D`Mello', 'olivia@example.com', 5),
('William D`Costa', 'william@example.com', 6),
('Isabella Sequeira', 'isabella@example.com', 7),
('Jack Smith', 'jack@example.com', 11),
('Emily Johnson', 'emily@example.com', 12),
('Sophie Lee', 'sophie@example.com', 13),
('Noah Martinez', 'noah@example.com', 14),
('Ethan Thompson', 'ethan@example.com', 15),
('Ava Davis', 'ava@example.com', 16),
('Mia Garcia', 'mia@example.com', 17),
('James Wilson', 'jamesw@example.com', 18),
('Alexander Brown', 'alexander@example.com', 19),
('Charlotte Clark', 'charlotte@example.com', 20);

-- Insert values into Enrollments table
INSERT INTO Enrollments (StudentID, CourseID, Grade) VALUES
(1, 1, 'A'),
(2, 1, 'B'),
(3, 3, 'C'),
(4, 5, 'B'),
(5, 6, 'A'),
(6, 7, 'A'),
(7, 8, 'B'),
(8, 9, 'C'),
(9, 10, 'A'),
(10, 4, 'B'),
(11, 12, 'A'),
(12, 13, 'B'),
(13, 14, 'C'),
(14, 15, 'B'),
(15, 16, 'A'),
(16, 17, 'A'),
(17, 18, 'B'),
(18, 19, 'C'),
(19, 20, 'A'),
(20, 11, 'B');