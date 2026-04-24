<?php
require_once 'db_connect.php';
session_start();

$success_message = '';
$error_message   = '';

// ============================================
// CREATE OPERATION - Add New Book
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    $title         = trim($conn->real_escape_string($_POST['title']));
    $author        = trim($conn->real_escape_string($_POST['author']));
    $category      = trim($conn->real_escape_string($_POST['category']));
    $available_qty = (int)$_POST['available_qty'];

    if (!empty($title) && !empty($author) && !empty($category)) {
        $sql = "INSERT INTO books (title, author, category, available_qty)
                VALUES ('$title', '$author', '$category', '$available_qty')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Book added successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    } else {
        $error_message = "Please fill in all required fields.";
    }
}

// ============================================
// READ OPERATION - Fetch All Books
// ============================================
$books_result = $conn->query("SELECT * FROM books ORDER BY Books_ID DESC");

// READ - Stats
$total_books     = $conn->query("SELECT COUNT(*) AS c FROM books")->fetch_assoc()['c'] ?? 0;
$books_assigned  = $conn->query("SELECT COUNT(*) AS c FROM borrow_records WHERE status='borrowed' OR status='overdue'")->fetch_assoc()['c'] ?? 0;
$books_returned  = $conn->query("SELECT COUNT(*) AS c FROM borrow_records WHERE status='returned'")->fetch_assoc()['c'] ?? 0;
$books_available = $conn->query("SELECT SUM(available_qty) AS s FROM books")->fetch_assoc()['s'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DJ Library</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo-container">
            <img src="css/pictures/logo4.png" alt="DJ Library Logo" class="logo">
        </div>
        <div class="nav-links">
            <a href="home.php" class="nav-item">Home</a>
            <a href="dashboard.php" class="nav-item">Dashboard</a>
        </div>
        <div class="login-container">
            <a href="Login.php" class="login-btn">Login</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <h1 class="page-title">Dashboard</h1>

        <!-- Stats Cards (READ) -->
        <div class="stats-grid">
            <div class="stat-box">
                <h3>Total Books</h3>
                <h2 class="stat-number"><?php echo $total_books; ?></h2>
            </div>
            <div class="stat-box">
                <h3>Books Assigned</h3>
                <h2 class="stat-number"><?php echo $books_assigned; ?></h2>
            </div>
            <div class="stat-box">
                <h3>Books Returned</h3>
                <h2 class="stat-number"><?php echo $books_returned; ?></h2>
            </div>
            <div class="stat-box">
                <h3>Available</h3>
                <h2 class="stat-number"><?php echo $books_available; ?></h2>
            </div>
        </div>

        <!-- Book List (READ) -->
        <div class="recent-activity">
            <h2 class="section-title">All Books</h2>
            <table class="activity-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Available Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($books_result && $books_result->num_rows > 0): ?>
                        <?php while ($row = $books_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['Books_ID']; ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['author']); ?></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                                <td><?php echo $row['available_qty']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">No books found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Add New Book (CREATE) -->
        <div class="add-record">
            <h2 class="section-title">Add New Book</h2>

            <?php if ($success_message): ?>
                <p style="color:green; font-weight:bold;"><?php echo $success_message; ?></p>
            <?php endif; ?>
            <?php if ($error_message): ?>
                <p style="color:red; font-weight:bold;"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form class="record-form" method="POST" action="dashboard.php">
                <div class="form-row">
                    <input type="text" name="title" placeholder="Book Title" required>
                    <input type="text" name="author" placeholder="Author" required>
                </div>
                <div class="form-row">
                    <input type="text" name="category" placeholder="Category" required>
                    <input type="number" name="available_qty" 
                           placeholder="Available Quantity" min="0" required>
                </div>
                <button type="submit" name="add_book" class="submit-btn">Add Book</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>