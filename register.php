<?
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