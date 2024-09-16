<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'guards') {
    header("Location: login.php");
    exit;
}

require 'db/db.php';

$stmt = $conn->prepare("
    SELECT Guards.Guard_Name, Prisoner.Prisoner_Name
    FROM Guards
    LEFT JOIN Keep ON Guards.Guard_ID = Keep.Guard_ID
    LEFT JOIN Prisoner ON Keep.Pri_ID = Prisoner.Pri_ID
    ORDER BY Guards.Guard_Name, Prisoner.Prisoner_Name
");
$stmt->execute();

$assignments = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="logout.php" class="login-btn">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>All Guards and Their Assigned Prisoners</h2>
            <?php if ($assignments): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Guard Name</th>
                            <th>Prisoner Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($assignments as $assignment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($assignment['Guard_Name']); ?></td>
                                <td><?php echo htmlspecialchars($assignment['Prisoner_Name']) ?: 'Not Assigned'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No assignments found.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
