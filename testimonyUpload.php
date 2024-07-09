<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "sunnysmile";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"]; // Assuming you have set the session with username during login
    $content = $conn->real_escape_string($_POST["content"]);

    $sql = "INSERT INTO testimonies (username, content) VALUES ('$username', '$content')";

    if ($conn->query($sql) === TRUE) {
        echo "New testimony created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
