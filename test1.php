<?php
// Assuming you have established a database connection
session_start();
$username = $_SESSION['username']; // Retrieve username from session
// Fetch other user data from the database as needed

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="favicon.ico" sizes="48x48" type="image/x-icon">
		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <h1>User Profile</h1>
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
							
							<!-- Conditional login/signup or profile display -->
							<?php if (isset($_SESSION['username'])): ?>
								<li class="menu-item"><a href="test1.php">Hi, <?php echo $_SESSION['username']; ?>, Welcome back!</a></li>
							<?php else: ?>
								<li class="menu-item"><a href="login_or_signup.html">Login/Sign up</a></li>
							<?php endif; ?>
							
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
    
    <main>
        <section id="profile-info">
            <h2>Profile Information</h2>
            <p>Name: <span id="username"><?php echo htmlspecialchars($username); ?></span></p>
            <!-- Add other profile details -->
        </section>
        <section id="reviews">
            <h2>Your Reviews</h2>
            <ul id="reviews-list">
                <!-- Populate reviews from the database -->
            </ul>
        </section>
    </main>
    <footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia tempore vitae mollitia nesciunt saepe cupiditate</p>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Recent Review</h3>
								<ul class="no-bullet">
									<li><a href="#">Lorem ipsum dolor</a></li>
									<li><a href="#">Sit amet consecture</a></li>
									<li><a href="#">Dolorem respequem</a></li>
									<li><a href="#">Invenore veritae</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Help Center</h3>
								<ul class="no-bullet">
									<li><a href="#">Lorem ipsum dolor</a></li>
									<li><a href="#">Sit amet consecture</a></li>
									<li><a href="#">Dolorem respequem</a></li>
									<li><a href="#">Invenore veritae</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Join Us</h3>
								<ul class="no-bullet">
									<li><a href="#">Lorem ipsum dolor</a></li>
									<li><a href="#">Sit amet consecture</a></li>
									<li><a href="#">Dolorem respequem</a></li>
									<li><a href="#">Invenore veritae</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Social Media</h3>
								<ul class="no-bullet">
									<li><a href="#">Facebook</a></li>
									<li><a href="#">Twitter</a></li>
									<li><a href="#">Google+</a></li>
									<li><a href="#">Pinterest</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Newsletter</h3>
								<form action="#" class="subscribe-form">
									<input type="text" placeholder="Email Address">
								</form>
							</div>
						</div>
					</div> <!-- .row -->

					<div class="colophon">Copyright 2014 Company name, Designed by Themezy. All rights reserved</div>
				</div> <!-- .container -->

			</footer>
    <script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
</body>
</html>