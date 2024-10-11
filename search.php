<?php
// Connect to your database
$conn = new mysqli("localhost", "root", "", "movies"); // Replace 'your_database_name' with the actual name

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']); // Secure the input
    
    // Query to search by movie title
    $query = "SELECT * FROM movies WHERE title LIKE '%$search%'"; // Replace 'your_table_name' with the table name
    $result = $conn->query($query);

    // Check if any results were found
    if ($result->num_rows > 0) {
        echo "<h2>Search Results for '$search':</h2>";
        while ($row = $result->fetch_assoc()) {
            // Display movie information
            echo "<div>";
            echo "<h3>" . $row['Title'] . "</h3>";
            echo "<p>Year: " . $row['Year'] . "</p>";
            echo "<p>Category: " . $row['Category'] . "</p>";
            echo "<p>Director: " . $row['Director'] . "</p>";
            echo "<p>Actors: " . $row['Actors'] . "</p>";
            echo "</div><hr>";
        }
    } else {
        // If no results are found
        echo "<h3>No search results found for '$search'.</h3>";
        echo "<a href='index.html'>Go back to search</a>";  // Replace with the actual search form page URL
    }
}

$conn->close();
?>
