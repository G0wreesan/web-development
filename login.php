<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "movies";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get login credentials from form
$email = $_POST['email'];
$password = $_POST['password'];

// Fetch the user from the database
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    
    // Verify the password
    if (password_verify($password, $user['password'])) {
        // Password is correct, log the user in
        $_SESSION['username'] = $user['username'];
        header("Location: index.html");
    } else {
        echo "Incorrect password!";
    }
} else {
    echo "No user found with this email!";
}

$conn->close();
?>