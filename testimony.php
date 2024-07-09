<?php
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = ""; // default password for XAMPP
$dbname = "sunnysmile";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all testimonies
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM testimonies";
    $result = $conn->query($sql);

    $testimonies = array();
    while ($row = $result->fetch_assoc()) {
        $testimonies[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($testimonies);
}

// Insert a new testimony
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $username = $_POST['username'];

    $stmt = $conn->prepare("INSERT INTO testimonies (username, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $content);
    $stmt->execute();

    echo "New testimony added successfully";
}

$conn->close();
?>
