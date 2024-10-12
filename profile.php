<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login_or_signup.html"); // Redirect to login if not logged in
    exit();
}

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

// Get user details
$username = $_SESSION['username'];
$sql = "SELECT username, email FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <p>Username: <?php echo $user['username']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <!-- You can also add recent reviews here -->
</body>
</html>
