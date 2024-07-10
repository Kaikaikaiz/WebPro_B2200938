<?php
session_start();

// Assuming you have established a database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "sunnysmile"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user input from the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email']; 
    $password = $_POST['password'];
}
// Protect against SQL injection
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Check for admin login
if (strpos($email, '@sunnysmile.com') !== false) {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // If admin exists, fetch user data
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])){
            // If password is correct
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            echo "Welcome Admin: ", htmlspecialchars($user['username']). "<br>Email:". htmlspecialchars($user['email']);
            exit();
        }
    }
}

// Query to check if the user exists with the provided email and password
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // If user exists, fetch user data
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])){
        // If password is correct
        $_SESSION['username'] = $user['username']; // Assuming your users table has a username column
        $_SESSION['email'] = $user['email'];

        // Redirect to profile page
        header("Location: ../My Account/UserAccount.php");
        exit();
    }
} 

// If no matching user found, redirect back to login page with an error message
header("Location: LogInUser.php?error=1");
exit();


// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="LogInUser.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<header>
        <figure class="logo">
            <img src="../image/LogoSShospital.png" alt="Hospital Logo">
        </figure>
        <nav style="background-color:#FFC145 ;">
            <div class="nav-section-a">
                <a href="../Booking Appointment/bookingform.html">Booking Appointment</a>
                <a href="../Doctor Profile/doctors profile.html">Doctor Profile</a>
                <a href="../Common Disease/common diseases.html">Common Disease</a>
            </div>
            <div class="nav-section-b">
                    <div class="dropdown-word">
                        <a href="../Medical Service/medical services.html" class="dropdown-word">Medical Service</a>
                    </div>
                <div class="dropdown">
                    <div class="dropdown-word">About Us</div>
                    <ul class="dropdown-content">
                        <li><a href="../About Us/AboutUs_History.html">Hospital History</a></li>
                        <li><a href="../About Us/">Vision & Mission</a></li>
                        <li><a href="../Newsboard/newsboardUser.html">News Board</a></li>
                        <li><a href="../Survey/survey.html">Survey</a></li>
                    </ul>
                </div>
                <div class="dropdown-word">
                    <a href="../Contact Us/ContactUs.html" class="dropdown-word">Contact Us</a>
                </div>
                <div class="dropdown">
                    <div class="dropdown-word">My Account</div>
                    <ul class="dropdown-content">
                        <li><a href="../Login System/LogInUser.php">Log In</a></li>
                        <li><a href="../My Account/UserProfile.php">My Profile</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="title-band">
        <h1>Login / Sign Up</h1>
    </div>
    <main>
        <section class="login-form">
            <h2>Login</h2>
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo "<p style='color:red;'>Incorrect email or password. Please try again.</p>";
            }
            ?>
            <form action="login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
            <p>Don't have an account yet? <a href="MyAccountSignUp.html">Sign Up</a></p>
            <p>Forgot your password? <a href="Forgetpassword.php">Reset it here</a></p>
        </section>
    </main>
    <footer>
        <div class="footerContainer">
            <div class="socialIcons">
                <a href=""><i class="fa-brands fa-facebook"></i></a>
                <a href=""><i class="fa-brands fa-instagram"></i></a>
                <a href=""><i class="fa-brands fa-twitter"></i></a>
                <a href=""><i class="fa-brands fa-google-plus"></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="footerNav">
                <ul><li><a href="../Homepage/combine.html">Home</a></li>
                    <li><a href="../Medical Service/medical services.html">Medical Service</a></li>
                    <li><a href="../Doctor Profile/doctors profile.html">Our Doctors</a></li>
                    <li><a href="../Booking Appointment/bookingform.html">Appointment Booking</a></li>
                    <li><a href="../About Us/AboutUs_History.html">About Us</a></li>
                    <li><a href="../Contact Us/ContactUs.html">Contact Us</a></li>
                </ul>
            </div>
            
        </div>
        <div class="footerBottom">
            <p>Copyright &copy;2024  <span class="designer">SUNNY SMILE HOSPITAL</span></p>
        </div>
    </footer>
</body>
</html>