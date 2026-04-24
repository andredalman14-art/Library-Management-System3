<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DB Library Login</title>
    <link rel="stylesheet" href="css/style_forgotpassword.css">
</head>

<body class="auth-page">
    <!-- NEW CODE - Proper Close Button that goes back to Home -->
    <div class="wrapper">
        <a href="Login.php" class="icon-close">
            <ion-icon name="close"></ion-icon>
        </a>
        <!-- Login Form -->
        <div class="form-box login">
            <h2> Forgot Password</h2>
            <form action="#">
                <!-- Email -->
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span> 
                    <input type="email"required>
                    <label>Email</label>
                </div>
                <button type="submit" class="btn">Submit</button>
                <div class="forgot-login">
                    <p> <a href="Login.html" class="login-link">Back to Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="login_reg.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>