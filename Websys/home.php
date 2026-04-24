<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DJ Library Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <!-- Logo on far left -->
        <div class="logo-container">
            <img src="css/pictures/logo4.png" alt="DJ Library Logo" class="logo">
        </div>

        <!-- Nav Links - centered more to the right -->
        <div class="nav-links">
            <a href="home.php" class="nav-item">Home</a>
            <a href="dashboard.php" class="nav-item">Dashboard</a>
        </div>

        <!-- Login on the right -->
        <div class="login-container">
            <a href="Login.php" class="login-btn">Login</a>
        </div>
    </nav>

    <!-- Hero Section with Background -->
    <section class="hero">
        <div class="hero-bg"></div>   <!-- Background placeholder -->

        <div class="hero-content">
            <!-- Left Side: Text + Popular Books -->
            <div class="library-info">
                <h1 class="system-title">DJ LIBRARY MANAGEMENT SYSTEM</h1>
                <p class="system-description">
                    a web-based platform designed to help manage books, borrowers, and borrowing records efficiently. 
                    It allows users to view available books, monitor borrowing status, and organize library data in a simple and structured way.
                </p>
                
                <a href="#" class="explore-btn">Explore Books</a>

                <!-- Popular Books Section -->
                <div class="popular-books">
                    <h3 class="popular-title">POPULAR BOOKS</h3>
                    <div class="book-grid">
                        <!-- First 3 books (left side) -->
                        <div class="book-card">
                            <img src="css/pictures/Book1.jpg" alt="Popular Book 1" class="book-img">
                            <p class="book-label">Popular Book 1</p>
                        </div>
                        <div class="book-card">
                            <img src="css/pictures/book2.jpg" alt="Popular Book 2" class="book-img">
                            <p class="book-label">Popular Book 2</p>
                        </div>
                        <div class="book-card">
                            <img src="css/pictures/book3.jpg" alt="Popular Book 3" class="book-img">
                            <p class="book-label">Popular Book 3</p>
                        </div>
                        <div class="book-card">
                            <img src="css/pictures/Book1.jpg" alt="Popular Book 4" class="book-img">
                            <p class="book-label">Popular Book 4</p>
                        </div>
                        <div class="book-card">
                            <img src="css/pictures/book2.jpg" alt="Popular Book 5" class="book-img">
                            <p class="book-label">Popular Book 5</p>
                        </div>
                        <div class="book-card">
                            <img src="css/pictures/book3.jpg" alt="Popular Book 6" class="book-img">
                            <p class="book-label">Popular Book 6</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Stack of Books Image -->
            <div class="hero-image">
        
            </div>
        </div>
    </section>

</body>
</html>