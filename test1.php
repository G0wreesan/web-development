<?php
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

// Get the search query
$search = $_GET['search'];

// Prepare the SQL query to search by title, year, or actors
$sql = "SELECT title, year, category, director, actors, poster, link FROM movies WHERE title LIKE ? OR year LIKE ? OR actors LIKE ?";

$stmt = $conn->prepare($sql);
$searchTerm = '%' . $search . '%';
$stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any results
if ($result->num_rows > 0) {
    // Output results in HTML format
    while ($row = $result->fetch_assoc()) {
        // Adding a link to the title and image
        $movieLink = !empty($row['link']) ? $row['link'] : "#"; // Fallback to '#' if no link

        echo "<div class='movie-details'>";
        
        // Movie details on the left
        echo "<div class='movie-info'>";
        // Clickable title
        echo "<h3><a href='" . $movieLink . "'>" . $row['title'] . " (" . $row['year'] . ")</a></h3>";
        echo "<p>Category: " . $row['category'] . "</p>";
        echo "<p>Director: " . $row['director'] . "</p>";
        echo "<p>Actors: " . $row['actors'] . "</p>";
        echo "</div>";

        // Movie poster on the right (clickable)
        echo "<div class='movie-poster'>";
        // Convert the binary data to base64
        $posterData = base64_encode($row['poster']);
        // Clickable image
        echo "<a href='" . $movieLink . "'>";
        echo "<img src='data:image/jpeg;base64," . $posterData . "' alt='Movie Poster'>";
        echo "</a>";
        echo "</div>";
        
        echo "</div><hr>";
    }
} else {
    echo "<p>No results found for '$search'</p>";
}

// Close the connection
$conn->close();
?>
