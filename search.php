

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Search Results</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assuming you have a styles.css file for styling -->
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="favicon.ico" sizes="48x48" type="image/x-icon">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            /* Add this CSS to your main CSS file */
.movie-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.5); /* 50% transparency with black background */
    padding: 20px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    color: #fff; /* Make the text more visible */
}

.movie-info {
    flex: 1;
    padding-right: 20px;
}

.movie-poster {
    flex: 0 0 150px;
    text-align: right;
}

.movie-poster img {
    width: 150px;
    height: 200px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: transform 0.3s ease; /* Smooth hover effect */
}

.movie-poster img:hover {
    transform: scale(1.1); /* Zoom effect on hover */
}

.movie-details h3 a, 
.movie-details p {
    color: #fff; /* Text color inside the movie details */
    text-decoration: none;
}

.movie-details h3 a:hover {
    color: #ffcc00; /* Hover color for clickable title */
}

        </style>
    </head>
<body>
<div id="site-content">
    <header class="site-header">
        <div class="container">
            <a href="index.html" id="branding">
                <img src="2.png" alt="" class="logo">
                <div class="logo-copy">
                    <h1 class="site-title">PopCorn Critics</h1>
                    <small class="site-description">Discover, Review, Repeat</small>
                </div>
            </a> <!-- #branding -->

            <div class="main-navigation">
                <button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
                <ul class="menu">
                    <li class="menu-item current-menu-item"><a href="index.html">Home</a></li>
                    <li class="menu-item"><a href="about.html">About</a></li>
                    <li class="menu-item"><a href="review.1.html">Movies</a></li>
                    <li class="menu-item"><a href="joinus.html">Join Us</a></li>
                    <li class="menu-item"><a href="contact.html">About Us</a></li>
                </ul> <!-- .menu -->

                <form action="search.php" class="search-form" method="get">
                    <input type="text" name="search" placeholder="Search..." required>
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                
            </div> <!-- .main-navigation -->

            <div class="mobile-navigation"></div>
        </div>
    </header>
    <script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
</body>
</html>

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



