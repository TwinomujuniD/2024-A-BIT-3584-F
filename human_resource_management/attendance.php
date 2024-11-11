<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
include 'dbconfig.php';
include('navbar.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];

    foreach ($_POST['status'] as $employee_id => $status) {
        $sql = "INSERT INTO attendance (employee_id, date, status) 
                VALUES ('$employee_id', '$date', '$status')
                ON DUPLICATE KEY UPDATE status='$status'";
        $conn->query($sql);
    }

    $message = "Attendance recorded successfully for $date.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - HRMS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php  ?>
    <div class="container">
        <h2 class="mt-4">Mark Attendance</h2>
        <?php if (isset($message)) { echo "<div class='alert alert-success'>$message</div>"; } ?>
        <form method="post">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id, name FROM employees";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>
                                        <select name='status[{$row['id']}]' class='form-select'>
                                            <option value='Present'>Present</option>
                                            <option value='Absent'>Absent</option>
                                        </select>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No employees found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit Attendance</button>
        </form>
    </div>
    <?php ; ?>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
