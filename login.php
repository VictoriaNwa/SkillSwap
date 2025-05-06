<?php
// starts session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $db = new PDO('sqlite:./db/skillswap.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // searches for all users with the username
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        
        // binds given username to username parameter
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // checks if user exists and passwords matched
        if ($user && password_verify($password, $user['password'])) {
           // saves user info to specific session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo 'Login successful.';
        }
    } catch (PDOException $error) {
        echo 'Login Error: ' . $error->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="navbar">
            <div class="logo">
                <img src="images/books.webp">
                </div>
            <div class="navLinks">
                <input type="button" class="navButton" value="Home" onclick="window.location.href='index.html'">
                <input type="button" class="navButton" value="Login" onclick="window.location.href='login.php'">
                <input type="button" class="navButton" value="Register" onclick="window.location.href='register.php'">
            </div>
        </div>
        <div class="main">
            <div class="left">
                <h1>Welcome Back!</h1>
            </div>
            <div class="right">
                <h2>Log-in</h2>
                <p>Don't have an account?&nbsp;<a href="register.php">Register Now</a></p>
                <form id="lForm" method="POST" action="login.php">
                    <input type="text" name="username" id="username" placeholder="username" class="inputs"> <br>
                    <input type="text" name="password" id="password" placeholder="password" class="inputs"> <br>
                    <div class="logErrors"></div><br>
                    <input type="submit" name="submit" id="submit" value="Login">
                </form>
            </div>
        </div>
        <script src="scripts/log-script.js"></script>
    </body>
</html>