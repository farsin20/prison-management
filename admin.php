<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
require 'db/db.php';

$admins = $conn->query("SELECT * FROM Administrator")->fetchAll(PDO::FETCH_ASSOC);
$jailors = $conn->query("SELECT * FROM Jailor")->fetchAll(PDO::FETCH_ASSOC);
$guards = $conn->query("SELECT * FROM Guards")->fetchAll(PDO::FETCH_ASSOC);
$visitors = $conn->query("SELECT * FROM Visitors")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/admin.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="logout.php" class="login-btn">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Administrators</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?= htmlspecialchars($admin['Admin_ID']) ?></td>
                            <td><?= htmlspecialchars($admin['Admin_Name']) ?></td>
                            <td><?= htmlspecialchars($admin['Contact']) ?></td>
                            <td><?= htmlspecialchars($admin['Email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Jailors</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Qualification</th>
                        <th>Residence</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jailors as $jailor): ?>
                        <tr>
                            <td><?= htmlspecialchars($jailor['Jailor_ID']) ?></td>
                            <td><?= htmlspecialchars($jailor['Jailor_Name']) ?></td>
                            <td><?= htmlspecialchars($jailor['Contact']) ?></td>
                            <td><?= htmlspecialchars($jailor['Qualification']) ?></td>
                            <td><?= htmlspecialchars($jailor['Residence']) ?></td>
                            <td><?= htmlspecialchars($jailor['Email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Guards</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Residence</th>
                        <th>Duty Hours</th>
                        <th>Shift</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($guards as $guard): ?>
                        <tr>
                            <td><?= htmlspecialchars($guard['Guard_ID']) ?></td>
                            <td><?= htmlspecialchars($guard['Guard_Name']) ?></td>
                            <td><?= htmlspecialchars($guard['Contact']) ?></td>
                            <td><?= htmlspecialchars($guard['Residence']) ?></td>
                            <td><?= htmlspecialchars($guard['Duty_hours']) ?></td>
                            <td><?= htmlspecialchars($guard['Shift']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Visitors</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Relationship</th>
                        <th>Contact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($visitors as $visitor): ?>
                        <tr>
                            <td><?= htmlspecialchars($visitor['V_ID']) ?></td>
                            <td><?= htmlspecialchars($visitor['Visitor_Name']) ?></td>
                            <td><?= htmlspecialchars($visitor['Relationship']) ?></td>
                            <td><?= htmlspecialchars($visitor['Contact']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>Admin Dashboard &copy; 2024</p>
    </footer>
</body>
</html>
