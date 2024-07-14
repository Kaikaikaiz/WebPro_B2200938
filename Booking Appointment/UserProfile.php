<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: LogInUser.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sunnysmile";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in user's username
$loggedInUser = $_SESSION['username'];

// Retrieve bookings for the logged-in user
$sql = "SELECT * FROM appointments WHERE parentName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUser);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <link rel="stylesheet" href="UserProfile.css"> <!-- Link your CSS file -->
</head>
<body>
    <header>
        <h1>My Appointments</h1>
    </header>
    <main>
        <section>
            <h2>Booked Appointments</h2>
            <table>
                <tr>
                    <th>Child's Name</th>
                    <th>Date of Birth</th>
                    <th>Contact Number</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Medical Service</th>
                    <th>Doctor In Charge</th>
                    <th>Reason</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['childName'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['contactNumber'] . "</td>";
                    echo "<td>" . $row['appointmentDate'] . "</td>";
                    echo "<td>" . $row['appointmentTime'] . "</td>";
                    echo "<td>" . $row['medicalService'] . "</td>";
                    echo "<td>" . $row['doctorInCharge'] . "</td>";
                    echo "<td>" . $row['reason'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </section>
    </main>
</body>
</html>

<?php
// Close statement and connection
$stmt->close();
$conn->close();
?>
