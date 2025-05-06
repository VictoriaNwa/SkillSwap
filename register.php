<?php
// starts session 
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    try {
        $db = new PDO('sqlite:./db/skillswap.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // hashes password and creates insertion query of user information
        $hashedPW = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, email, phone_number, password)
        VALUES (:username, :email, :phone_number, :password)");
        
        // bind given fields to parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':password', $hashedPW);
        $stmt->execute();
    } catch (PDOException $error) {
        echo 'Registration Error: ' . $error->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
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
            <h1>Welcome to SkillSwap! Don't think we've met before...</h1>
            </div>
            <div class="right">
                <h2>Register Your Account</h2>
                <p>Already have an account?&nbsp;<a href="login.php">Log-In</a></p>
                <form id="rForm" method="POST" action="register.php">
                        <input type="text" name="username" class="inputs" placeholder="username" required><br>
                        <input type="text" name="email" placeholder="email" class="inputs" required><br>
                        <input type="text" name="phonenum" placeholder="phone number" class="inputs" required><br>
                        <input type="text" name="password" placeholder="password" class="inputs" required><br>
                        <div class="regErrors"></div><br>
                        <input type="submit" name="submit" id="submit" value="Register">
                </form>
            </div>
        </div>
        <script src="scripts/script.js"></script>
    </body>
</html>