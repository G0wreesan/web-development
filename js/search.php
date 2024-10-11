<?php
// search.php

// Get the search query from the URL
$searchQuery = $_GET['query'];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {<?php
    // Get the search query from the form
    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
    
    // Database connection details
    $servername = "localhost";
    $username = "root"; // Change if needed
    $password = ""; // Leave empty if there's no password
    $dbname = "movies"; // Your database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // If there's a search query, fetch movies from the database
    if ($searchQuery != '') {
        // Prepare SQL query with wildcard search
        $sql = "SELECT title, year, category, director, actor, poster FROM movies WHERE title LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchTerm = "%{$searchQuery}%"; // Add wildcards for partial matches
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    
        // Check if there are results
        if ($result->num_rows > 0) {
            // Output the results
            echo "<h1>Search Results for '{$searchQuery}':</h1>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "<h2>" . htmlspecialchars($row['title']) . " (" . $row['year'] . ")</h2>";
                echo "<p>Category: " . htmlspecialchars($row['category']) . "</p>";
                echo "<p>Director: " . htmlspecialchars($row['director']) . "</p>";
                echo "<p>Actor: " . htmlspecialchars($row['actor']) . "</p>";
    
                // Display poster if it exists (since it's a blob, it needs special handling)
                if (!empty($row['poster'])) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['poster']) . '" width="150" height="220" alt="Poster" />';
                }
    
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h1>No movies found with the title '{$searchQuery}'.</h1>";
        }
    
        // Close the statement
        $stmt->close();
    } else {
        echo "<h1>Please enter a search term.</h1>";
    }
    
    // Close the database connection
    $conn->close();
    ?>
    
    die("Connection failed: check database credentialz " . $conn->connect_error);
}

// Prepare the SQL query to search for movies
$sql = "SELECT * FROM movies WHERE title LIKE '%$searchQuery%'";

// Execute the query
$result = $conn->query($sql);

// Check if any results were found
if ($result->num_rows > 0) {
    echo "<h2>Search Results for '$searchQuery'</h2>";
    echo "<ul>";
    
    // Output data for each row found
    while($row = $result->fetch_assoc()) {
        echo "<li><a href='movie-details.php?id=" . $row["id"] . "'>" . $row["title"] . "</a></li>";
    }
    
    echo "</ul>";
} else {
    echo "No results found for '$searchQuery'.";
}

// Close the database connection
$conn->close();
?>
