<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'visitors') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitor Dashboard</title>
    <link rel="stylesheet" href="assets/visitor.css">
</head>
<body>
    <header>
        <h1>Visitor Dashboard</h1>
        <nav>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Welcome Visitor</h2>
            <p>View your visit details and schedule here.</p>
        </section>
    </main>
</body>
</html>
