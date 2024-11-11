<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
    

}
include 'dbconfig.php';
include('navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HRMS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php  ?>
    <div class="container">
        <h2 class="mt-4">Welcome to Human Resource Management System Dashboard</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Employees</h5>
                        <p class="card-text">
                            <?php
                            $sql = "SELECT COUNT(*) AS total FROM employees";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- More Cards for Attendance, Payroll, Leaves -->
        </div>
    </div>
    <?php ?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
