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
    <title>View Attendance - HRMS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php ?>
    <div class="container">
        <h2 class="mt-4">View Attendance Records</h2>
        <form method="get" class="mb-3">
            <div class="form-group">
                <label for="date">Select Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary">View</button>
        </form>

        <?php if (isset($_GET['date'])): ?>
            <h3 class="mt-3">Attendance for <?php echo htmlspecialchars($_GET['date']); ?></h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $date = $_GET['date'];
                    $sql = "SELECT employees.id, employees.name, attendance.status 
                            FROM attendance 
                            JOIN employees ON attendance.employee_id = employees.id 
                            WHERE attendance.date = '$date'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['status']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No attendance records found for this date.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <?php  ?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
