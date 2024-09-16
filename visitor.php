<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'visitors') {
    header("Location: login.php");
    exit;
}

require 'db/db.php';

$user_id = $_SESSION['user_id']; 

$visitorsStmt = $conn->prepare("SELECT * FROM Visitors WHERE U_ID = :user_id");
$visitorsStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$visitorsStmt->execute();
$visitors = $visitorsStmt->fetchAll(PDO::FETCH_ASSOC);

$prisonersStmt = $conn->query("SELECT * FROM Prisoner");
$prisoners = $prisonersStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $visitor_id = $_POST['visitor_id'];
    $prisoner_id = $_POST['prisoner_id'];

    $checkStmt = $conn->prepare("SELECT * FROM Visits WHERE V_ID = :visitor_id AND Pri_ID = :prisoner_id");
    $checkStmt->bindParam(':visitor_id', $visitor_id, PDO::PARAM_INT);
    $checkStmt->bindParam(':prisoner_id', $prisoner_id, PDO::PARAM_INT);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $message = "This request already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO Visits (V_ID, Pri_ID, Approved) VALUES (:visitor_id, :prisoner_id, NULL)");
        $stmt->bindParam(':visitor_id', $visitor_id, PDO::PARAM_INT);
        $stmt->bindParam(':prisoner_id', $prisoner_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $message = "Request for meeting submitted successfully!";
        } else {
            $error = "Failed to submit the request.";
        }
    }
}

$requestsStmt = $conn->prepare("SELECT v.V_ID, p.Pri_ID, vi.Visitor_Name, p.Prisoner_Name, v.Approved
                                FROM Visits v
                                JOIN Prisoner p ON v.Pri_ID = p.Pri_ID
                                JOIN Visitors vi ON v.V_ID = vi.V_ID
                                WHERE vi.U_ID = :user_id");
$requestsStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$requestsStmt->execute();
$requests = $requestsStmt->fetchAll(PDO::FETCH_ASSOC);
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
            <h2>Request Meeting</h2>
            <?php if (isset($message)) { echo "<p class='success'>$message</p>"; } ?>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

            <form method="POST" action="visitor.php">
                <label for="visitor">Select Visitor:</label>
                <select name="visitor_id" id="visitor" required>
                    <option value="">Select Visitor</option>
                    <?php foreach ($visitors as $visitor): ?>
                        <option value="<?php echo $visitor['V_ID']; ?>"><?php echo htmlspecialchars($visitor['Visitor_Name']); ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="prisoner">Select Prisoner:</label>
                <select name="prisoner_id" id="prisoner" required>
                    <option value="">Select Prisoner</option>
                    <?php foreach ($prisoners as $prisoner): ?>
                        <option value="<?php echo $prisoner['Pri_ID']; ?>"><?php echo htmlspecialchars($prisoner['Prisoner_Name']); ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <input type="submit" value="Request Meeting">
            </form>
        </section>

        <section>
            <h2>Pending Requests</h2>
            <?php if (count($requests) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Visitor Name</th>
                            <th>Prisoner Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($request['Visitor_Name']); ?></td>
                                <td><?php echo htmlspecialchars($request['Prisoner_Name']); ?></td>
                                <td><?php echo $request['Approved'] === NULL ? 'Pending' : 'Approved'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No pending requests.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
