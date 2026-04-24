<?php
require_once 'db_connect.php';
session_start();

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($conn->real_escape_string($_POST['email']));
    $password = $_POST['password'];

    $sql    = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id']    = $user['User_ID'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['role']       = $user['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "Email not found.";
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DB Library Login</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body class="auth-page">
    <div class="wrapper">
        <a href="home.php" class="icon-close">
            <ion-icon name="close"></ion-icon>
        </a>
        <div class="form-box login">
            <h2>Login</h2>

            <?php if ($error_message): ?>
                <p style="color:red; font-weight:bold; text-align:center;">
                    <?php echo $error_message; ?>
                </p>
            <?php endif; ?>

            <form action="Login.php" method="POST">
                <!-- Email -->
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <!-- Password -->
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account? 
                        <a href="Reg.php" class="register-link">Register Now</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="login_reg.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>