<!-- submit_review.php -->
<?php
session_start();
include 'db_connection.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movie_title = $_POST['movie_title'];
    $movie_year = $_POST['movie_year'];
    $review_text = $_POST['review_text'];
    $user_id = $_SESSION['user_id'];

    // Prepare SQL statement to insert review into the database
    $sql = "INSERT INTO reviews (user_id, movie_title, movie_year, review_text) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $user_id, $movie_title, $movie_year, $review_text);

    if ($stmt->execute()) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
