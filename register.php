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
        $userId = $conn->lastInsertId();

        switch ($role) {
            case 'admin':
                $adminName = $_POST['admin_name'];
                $adminContact = $_POST['admin_contact'];
                $stmt = $conn->prepare("INSERT INTO Administrator (Admin_Name, Contact, Email) VALUES (:admin_name, :admin_contact, :email)");
                $stmt->bindParam(':admin_name', $adminName);
                $stmt->bindParam(':admin_contact', $adminContact);
                $stmt->bindParam(':email', $email);
                break;

            case 'jailors':
                $jailorName = $_POST['jailor_name'];
                $jailorContact = $_POST['jailor_contact'];
                $qualification = $_POST['jailor_qualification'];
                $jailorResidence = $_POST['jailor_residence'];
                $stmt = $conn->prepare("INSERT INTO Jailor (Jailor_Name, Contact, Qualification, Residence, Email) VALUES (:jailor_name, :jailor_contact, :qualification, :jailor_residence, :email)");
                $stmt->bindParam(':jailor_name', $jailorName);
                $stmt->bindParam(':jailor_contact', $jailorContact);
                $stmt->bindParam(':qualification', $qualification);
                $stmt->bindParam(':jailor_residence', $jailorResidence);
                $stmt->bindParam(':email', $email);
                break;

            case 'visitors':
                $visitorName = $_POST['visitor_name'];
                $relationship = $_POST['visitor_relationship'];
                $visitorContact = $_POST['visitor_contact'];
                $stmt = $conn->prepare("INSERT INTO Visitors (U_ID, Visitor_Name, Relationship, Contact) VALUES (:u_id, :visitor_name, :relationship, :visitor_contact)");
                $stmt->bindParam(':u_id', $userId);
                $stmt->bindParam(':visitor_name', $visitorName);
                $stmt->bindParam(':relationship', $relationship);
                $stmt->bindParam(':visitor_contact', $visitorContact);
                break;

            case 'guards':
                $guardName = $_POST['guard_name'];
                $guardContact = $_POST['guard_contact'];
                $guardResidence = $_POST['guard_residence'];
                $dutyHours = $_POST['guard_duty_hours'];
                $shift = $_POST['guard_shift'];
                $stmt = $conn->prepare("INSERT INTO Guards (Guard_Name, Contact, Residence, Duty_hours, Shift) VALUES (:guard_name, :guard_contact, :guard_residence, :duty_hours, :shift)");
                $stmt->bindParam(':guard_name', $guardName);
                $stmt->bindParam(':guard_contact', $guardContact);
                $stmt->bindParam(':guard_residence', $guardResidence);
                $stmt->bindParam(':duty_hours', $dutyHours);
                $stmt->bindParam(':shift', $shift);
                break;
        }

        if (isset($stmt)) {
            if ($stmt->execute()) {
                echo "Registration successful!";
                header("Location: login.php");
                exit;
            } else {
                echo "Failed to insert into role-specific table.";
                print_r($stmt->errorInfo());
            }
        } else {
            echo "Failed to prepare role-specific insert statement.";
        }
    } else {
        echo "Failed to register user.";
        print_r($stmt->errorInfo());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="assets/register.css">
    <script>
        function showFields(role) {
            const roleSpecificDivs = document.querySelectorAll('.role-specific');
            roleSpecificDivs.forEach(el => el.style.display = 'none');

            if (role) {
                const roleDiv = document.querySelector(`.${role}`);
                roleDiv.style.display = 'block';

                const form = document.querySelector('form');
                form.style.height = 'auto';
                form.style.maxHeight = 'none';
                form.offsetHeight;
                form.style.maxHeight = form.scrollHeight + 'px';
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Prison Management System</h1>
        <h2>Registration Form</h2>
    </header>
    <div class="container">
        <form method="POST" action="register.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>

            <label for="role">Role:</label>
            <select name="role" id="role" onchange="showFields(this.value)" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="jailors">Jailors</option>
                <option value="guards">Guards</option>
                <option value="visitors">Visitors</option>
            </select><br><br>

            <div class="role-specific admin" style="display:none;">
                <label for="admin_name">Admin Name:</label>
                <input type="text" name="admin_name" id="admin_name"><br><br>
                <label for="admin_contact">Contact:</label>
                <input type="text" name="admin_contact" id="admin_contact"><br><br>
            </div>

            <div class="role-specific jailors" style="display:none;">
                <label for="jailor_name">Jailor Name:</label>
                <input type="text" name="jailor_name" id="jailor_name"><br><br>
                <label for="jailor_contact">Contact:</label>
                <input type="text" name="jailor_contact" id="jailor_contact"><br><br>
                <label for="jailor_qualification">Qualification:</label>
                <input type="text" name="jailor_qualification" id="jailor_qualification"><br><br>
                <label for="jailor_residence">Residence:</label>
                <input type="text" name="jailor_residence" id="jailor_residence"><br><br>
            </div>

            <div class="role-specific visitors" style="display:none;">
                <label for="visitor_name">Visitor Name:</label>
                <input type="text" name="visitor_name" id="visitor_name"><br><br>
                <label for="visitor_relationship">Relationship:</label>
                <input type="text" name="visitor_relationship" id="visitor_relationship"><br><br>
                <label for="visitor_contact">Contact:</label>
                <input type="text" name="visitor_contact" id="visitor_contact"><br><br>
            </div>

            <div class="role-specific guards" style="display:none;">
                <label for="guard_name">Guard Name:</label>
                <input type="text" name="guard_name" id="guard_name"><br><br>
                <label for="guard_contact">Contact:</label>
                <input type="text" name="guard_contact" id="guard_contact"><br><br>
                <label for="guard_residence">Residence:</label>
                <input type="text" name="guard_residence" id="guard_residence"><br><br>
                <label for="guard_duty_hours">Duty Hours:</label>
                <input type="number" name="guard_duty_hours" id="guard_duty_hours"><br><br>
                <label for="guard_shift">Shift:</label>
                <input type="text" name="guard_shift" id="guard_shift"><br><br>
            </div>

            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
