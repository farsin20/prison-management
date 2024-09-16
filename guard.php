<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'guards') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guard Dashboard</title>
    <link rel="stylesheet" href="assets/guard.css">
</head>
<body>
    <header>
        <h1>Guard Dashboard</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Welcome Guard</h2>
            <p>Manage security and surveillance tasks here.</p>
        </section>
    </main>
</body>
</html>
