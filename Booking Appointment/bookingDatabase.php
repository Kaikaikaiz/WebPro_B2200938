<?php
session_start();

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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $userid = $_SESSION['userid'];
    $childName = $_POST['childName'];
    $dob = $_POST['dob'];
    $parentName = $_POST['parentName'];
    $contactNumber = $_POST['contactNumber'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentTime = $_POST['appointmentTime'];
    $medicalService = $_POST['medicalService'];
    $doctorInCharge = $_POST['doctorInCharge'];
    $reason = $_POST['reason'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, childName, dob, parentName, contactNumber, appointmentDate, appointmentTime, medicalService, doctorInCharge, purpose) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $userid, $childName, $dob, $parentName, $contactNumber, $appointmentDate, $appointmentTime, $medicalService, $doctorInCharge, $reason);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to user profile page after successful booking
        header("Location: ../My Account/UserProfile.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>