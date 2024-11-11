<?php
include 'dbconfig.php';

// Create users with different roles
$users = [
    ['username' => 'admin', 'password' => 'admin', 'role' => 'administrator'],
    ['username' => 'employee', 'password' => 'employee', 'role' => 'employee'],
    ['username' => 'employee1', 'password' => 'employee', 'role' => 'employee']
];

foreach ($users as $user) {
    $username = $user['username'];
    $password = password_hash($user['password'], PASSWORD_BCRYPT); // Hash the password for security
    $role = $user['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "User '$username' with role '$role' created successfully.<br>";
    } else {
        echo "Error creating user '$username': " . $conn->error . "<br>";
    }
}

$conn->close();
?>