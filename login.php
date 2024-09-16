<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/login.css">
</head>
<body>

    <header>
        <h1>Welcome to the Prison Management System</h1>
    </header>

    <div class="container">
        <main>
            <h2>Login</h2>
            <form method="POST" action="login.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>

                <input type="submit" value="Login">
            </form>
        </main>
    </div>

    <footer>
        <p>&copy; 2024 Your Company</p>
    </footer>

</body>
</html>
