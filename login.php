<?php
require 'db/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

  
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; 
        $_SESSION['role'] = $user['role'];  

        
        switch ($user['role']) {
            case 'admin':
                header("Location: admin.php");
                break;
            case 'jailors':
                header("Location: jailor.php");
                break;
            case 'guards':
                header("Location: guard.php");
                break;
            case 'visitors':
                header("Location: visitor.php");
                break;
            default:
                header("Location: login.php");
                break;
        }
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/login.css">
</head>
<body>
    <header>
        <h1>Prison Management System</h1>
        <h2>Login</h2>
    </header>
    <div class="container">
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <input type="submit" value="Login"><br>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>
</html>
