<?php
require 'db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $role = $_POST['role'];


    $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: login.php"); 
        exit;
    } else {
        $error = "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="assets/register.css">
</head>
<body>
    <header>
        <h1>Prison Management System</h1>
        <h2>Registration Form</h2>
    </header>
    <div class="container">
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" action="register.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>

            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="jailors">Jailors</option>
                <option value="guards">Guards</option>
                <option value="visitors">Visitors</option>
            </select><br><br>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
