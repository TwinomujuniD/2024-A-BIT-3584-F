<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include 'dbconfig.php';
include('navbar.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $join_date = $_POST['join_date'];

    $sql = "INSERT INTO employees (name, email, phone, department, position, salary, join_date) 
            VALUES ('$name', '$email', '$phone', '$department', '$position', '$salary', '$join_date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?success=Employee added successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee - HRMS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php ?>
    <div class="container">
        <h2 class="mt-4">Add New Employee</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" required>
            </div>
            <div class="form-group">
                <label for="join_date">Join Date</label>
                <input type="date" class="form

-control" id="join_date" name="join_date" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add Employee</button>
        </form>
    </div>
    <?php  ?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
