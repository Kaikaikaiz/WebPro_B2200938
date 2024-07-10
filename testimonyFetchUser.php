<?php
// Include your database connection file
require_once 'testimonyDatabase.php';

// Query to fetch testimonies with usernames
$query = "SELECT testimonies.*, users.username 
          FROM testimonies 
          LEFT JOIN users ON testimonies.user_id = users.id 
          ORDER BY testimonies.id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching testimonies: " . mysqli_error($conn));
}

// Fetch testimonies as an associative array
$testimonies = array();
while ($row = mysqli_fetch_assoc($result)) {
    $testimonies[] = $row;
}

// Close connection
mysqli_close($conn);

// Output testimonies as JSON
header('Content-Type: application/json');
echo json_encode($testimonies);
?>
