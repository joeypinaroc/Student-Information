<?php 
    session_start();
    if(!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit();
    }

    include "../controllers/StudentController.php";
    $studentController = new StudentController(); // instantiate controller

    // handle Add Student Form Submission
    if(isset($_POST["add_student"])) {
        $studentname = $_POST["studentname"];
        $studentid = $_POST["studentid"];
        $studentemail = $_POST["studentemail"];

        if($studentController->create($studentname, $studentid, $studentemail)) {
            echo "<p>Student added successfully!</p>";
        } else {
            echo "<p>Error adding student.</p>";
        }
    }

    // handle Delete
    if(isset($_POST["delete_student"])) {
        $studentid = $_POST["studentid"];

        if($studentController->delete($studentid)) {
            echo "<p>Student deleted successfully!</p>";
        } else {
            echo "<p>Error deleting student.</p>";
        }
    }

    // fetch all students
    $students = $studentController->read();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <a href="dashboard.php">Back to dashboard</a>
        <h1>Student Information</h1>
        <div class="addStudent">
            <h3>Add Student</h3>
            <form method="POST">
                <table>
                    <tr>
                        <td><label for=""studentname">Student Name:</label></td>
                        <td><input id="studentname" type="text" name="studentname" placeholder="Student Name" required></td>
                    </tr>
                    <tr>
                        <td><label>Student ID:</label></td>
                        <td><input id="studentid" type="text" name="studentid" placeholder="Student ID" required></td>
                    </tr>
                    <tr>
                        <td><label>Student Email:</label></td>
                        <td><input id="studentemail" type="email" name="studentemail" placeholder="Student Email" required></td>
                    </tr>                    
                </table>
                <button type="submit" name="add_student">Add Student</button>
            </form>
        </div>

        <div class="studentList">
            <h3>Student List</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                <?php while($student = $students->fetch_assoc()): ?> 
                    <tr>
                        <td><?php echo $student["studentid"]; ?></td>
                        <td><?php echo $student["studentname"]; ?></td>
                        <td><?php echo $student["studentemail"]; ?></td>
                        <td>
                            <form method="POST">
                                <!-- hidden input sends data(student id) every submit -->
                                <input type="hidden" name="studentid" value="<?php echo $student["studentid"]; ?>">
                                <button type="submit" name="delete_student">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>    

</body>
</html>