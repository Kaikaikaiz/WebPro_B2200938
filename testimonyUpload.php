<?php
// Include your database connection file
require_once 'testimonyDatabase.php';

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assume you have a session or user authentication mechanism to get user ID
    $user_id = $_SESSION['user_id']; // Adjust as per your authentication mechanism
    
    // Escape user inputs for security
    $textUpload = mysqli_real_escape_string($conn, $_POST['textUpload']);

    // Insert testimony into the database
    $query = "INSERT INTO testimonies (user_id, text) VALUES ('$user_id', '$textUpload')";
    if (mysqli_query($conn, $query)) {
        echo "Testimony uploaded successfully!";
    } else {
        echo "Error uploading testimony: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
