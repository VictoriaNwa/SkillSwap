<?
// starts session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $db = new PDO('sqlite:./db/skillswap.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // searches for all users with the username
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username)");
        
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
        } else {
            echo 'Invalid username or password';
        }
    } catch (PDOException $error) {
        echo 'Login Error: ' . $error->getMessage();
    }
}
?>