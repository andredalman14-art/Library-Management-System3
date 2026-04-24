<?php
require_once 'db_connect.php';

$error   = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $gender     = trim($_POST['gender']);
    $email      = trim($_POST['email']);
    $password   = $_POST['password'];
    $confirm    = $_POST['confirm_password'];

    if (empty($first_name) || empty($last_name) || empty($gender) || empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } else {
        $check = $conn->prepare("SELECT User_ID FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email is already registered.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $role   = "user";

            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, gender, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $first_name, $last_name, $gender, $email, $hashed, $role);

            if ($stmt->execute()) {
                $success = "Registration successful! <a href='Login.php'>Login here</a>.";
            } else {
                $error = "Registration failed: " . $stmt->error;
            }
            $stmt->close();
        }
        $check->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DB Library Registration</title>
    <link rel="stylesheet" href="css/style_registration.css">
</head>
<body class="auth-page">
    <div class="wrapper">
        <a href="Login.php" class="icon-close">
            <ion-icon name="close"></ion-icon>
        </a>
        <div class="form-box register">
            <h2>Registration</h2>

            <?php if ($error): ?>
                <p style="color:red; font-weight:bold; text-align:center;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p style="color:green; font-weight:bold; text-align:center;"><?= $success ?></p>
            <?php endif; ?>

            <form action="Reg.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="first_name" value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>" required>
                    <label>First Name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="last_name" value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>" required>
                    <label>Last Name</label>
                </div>
                <div class="input-box">
                    <select name="gender" required>
                        <option value="">Gender</option>
                        <option value="male"   <?= (($_POST['gender'] ?? '') == 'male')   ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= (($_POST['gender'] ?? '') == 'female') ? 'selected' : '' ?>>Female</option>
                        <option value="other"  <?= (($_POST['gender'] ?? '') == 'other')  ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="confirm_password" required>
                    <label>Confirmed Password</label>
                </div>

                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Have an account? <a href="Login.php" class="register-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="login_reg.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>