<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'jailors') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jailor Dashboard</title>
    <link rel="stylesheet" href="assets/jailor.css">
</head>
<body>
    <header>
        <h1>Jailor Dashboard</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Welcome Jailor</h2>
            <p>Manage prisoners and handle their activities here.</p>
        </section>
    </main>
</body>
</html>
