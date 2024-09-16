<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'jailors') {
    header("Location: login.php");
    exit;
}

require 'db/db.php';

$guardsStmt = $conn->query("SELECT * FROM Guards");
$guards = $guardsStmt->fetchAll(PDO::FETCH_ASSOC);

$prisonersStmt = $conn->query("SELECT * FROM Prisoner");
$prisoners = $prisonersStmt->fetchAll(PDO::FETCH_ASSOC);

$assignmentsStmt = $conn->query("SELECT Keep.*, Guards.Guard_Name, Prisoner.Prisoner_Name FROM Keep 
                                 JOIN Guards ON Keep.Guard_ID = Guards.Guard_ID 
                                 JOIN Prisoner ON Keep.Pri_ID = Prisoner.Pri_ID");
$assignments = $assignmentsStmt->fetchAll(PDO::FETCH_ASSOC);

$visitsStmt = $conn->query("SELECT Visits.V_ID, Prisoner.Prisoner_Name, Visitors.Visitor_Name, Visits.Approved 
                             FROM Visits 
                             JOIN Prisoner ON Visits.Pri_ID = Prisoner.Pri_ID 
                             JOIN Visitors ON Visits.V_ID = Visitors.V_ID");
$visits = $visitsStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    $visit_id = $_POST['visit_id'];

    $updateStmt = $conn->prepare("UPDATE Visits SET Approved = 1 WHERE V_ID = :visit_id");
    $updateStmt->bindParam(':visit_id', $visit_id);

    if ($updateStmt->execute()) {
        header("Refresh:0");
        exit;
    } else {
        $error = "Failed to approve visit.";
    }
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
            <a href="logout.php" class="logout-btn">Logout</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Welcome Jailor</h2>
            <p>Manage prisoners and handle their activities here.</p>
        </section>

        <section>
            <h2>Assign Guard to Prisoner</h2>
            <?php if (isset($message)) { echo "<p class='success'>$message</p>"; } ?>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

            <form method="POST" action="jailor.php">
                <label for="guard">Select Guard:</label>
                <select name="guard_id" id="guard" required>
                    <option value="">Select Guard</option>
                    <?php foreach ($guards as $guard): ?>
                        <option value="<?php echo $guard['Guard_ID']; ?>"><?php echo $guard['Guard_Name']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="prisoner">Select Prisoner:</label>
                <select name="prisoner_id" id="prisoner" required>
                    <option value="">Select Prisoner</option>
                    <?php foreach ($prisoners as $prisoner): ?>
                        <option value="<?php echo $prisoner['Pri_ID']; ?>"><?php echo $prisoner['Prisoner_Name']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <input type="submit" value="Assign Guard">
            </form>
        </section>

        <section>
            <h2>All Guards</h2>
            <table>
                <thead>
                    <tr>
                        <th>Guard ID</th>
                        <th>Guard Name</th>
                        <th>Contact</th>
                        <th>Residence</th>
                        <th>Duty Hours</th>
                        <th>Shift</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($guards as $guard): ?>
                        <tr>
                            <td><?php echo $guard['Guard_ID']; ?></td>
                            <td><?php echo $guard['Guard_Name']; ?></td>
                            <td><?php echo $guard['Contact']; ?></td>
                            <td><?php echo $guard['Residence']; ?></td>
                            <td><?php echo $guard['Duty_hours']; ?></td>
                            <td><?php echo $guard['Shift']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>All Prisoners</h2>
            <table>
                <thead>
                    <tr>
                        <th>Prisoner ID</th>
                        <th>Prisoner Name</th>
                        <th>Contact</th>
                        <th>Residence</th>
                        <th>Crime</th>
                        <th>Punishment</th>
                        <th>Relative Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prisoners as $prisoner): ?>
                        <tr>
                            <td><?php echo $prisoner['Pri_ID']; ?></td>
                            <td><?php echo $prisoner['Prisoner_Name']; ?></td>
                            <td><?php echo $prisoner['Contact']; ?></td>
                            <td><?php echo $prisoner['Residence']; ?></td>
                            <td><?php echo $prisoner['Crime']; ?></td>
                            <td><?php echo $prisoner['Punishment']; ?></td>
                            <td><?php echo $prisoner['Relative_details']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Guard Assignments</h2>
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
                            <td><?php echo $assignment['Guard_Name']; ?></td>
                            <td><?php echo $assignment['Prisoner_Name']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Visitor Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th>Visitor Name</th>
                        <th>Prisoner Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($visits as $visit): ?>
                        <tr>
                            <td><?php echo $visit['Visitor_Name']; ?></td>
                            <td><?php echo $visit['Prisoner_Name']; ?></td>
                            <td><?php echo $visit['Approved'] ? 'Approved' : 'Pending'; ?></td>
                            <td>
                                <?php if (!$visit['Approved']): ?>
                                    <form method="POST" action="jailor.php" style="display:inline;">
                                        <input type="hidden" name="visit_id" value="<?php echo $visit['V_ID']; ?>">
                                        <input type="submit" name="approve" value="Approve">
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
