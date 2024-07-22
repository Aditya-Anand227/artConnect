<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_marketplace";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

// Prepare and bind
$stmt = $conn->prepare("SELECT name, email, password FROM users WHERE email = ? AND role = ?");
$stmt->bind_param("ss", $email, $role);
$stmt->execute();
$stmt->store_result();

// Check if user exists and verify password
if ($stmt->num_rows > 0) {
    $stmt->bind_result($name, $email, $hashed_password);
    $stmt->fetch();
    if ($password === $hashed_password) { // In a real-world scenario, use password hashing and verify with password_verify()
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        if ($role === 'artist') {
            header("Location: artist_dashboard.php");
        } elseif ($role === 'buyer') {
            header("Location: buyer_dashboard.php");
        }
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found.";
}

$stmt->close();
$conn->close();
?>
