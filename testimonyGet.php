<?php
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

$sql = "SELECT t.content, u.username FROM testimonies t JOIN users u ON t.user_id = u.id ORDER BY t.created_at DESC";
$result = $conn->query($sql);

$testimonies = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $testimonies[] = $row;
    }
}

echo json_encode($testimonies);

$conn->close();
?>
