<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sunnysmile";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";  // Initialize an empty message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        $message = "Passwords do not match.";
    } elseif (strlen($newPassword) < 8 ||
              !preg_match('/[A-Z]/', $newPassword) ||
              !preg_match('/[a-z]/', $newPassword) ||
              !preg_match('/\d/', $newPassword) ||
              !preg_match('/[^A-Za-z\d]/', $newPassword)) {
        $message = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one symbol.";
    } else {
        $newPasswordHashed = password_hash($newPassword, PASSWORD_DEFAULT);

        // Prepare select query based on email
        $sql_select = "SELECT * FROM users WHERE email = ?";
        $stmt_select = $conn->prepare($sql_select);
        if (!$stmt_select) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt_select->bind_param("s", $email);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        if ($result->num_rows > 0) {
            // Fetch user data
            $user = $result->fetch_assoc();
            
            // Update user's password
            $sql_update = "UPDATE users SET password = ? WHERE email = ?";
            $stmt_update = $conn->prepare($sql_update);
            if (!$stmt_update) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt_update->bind_param("ss", $newPasswordHashed, $email);
            
            // Execute update query
            if ($stmt_update->execute()) {
                // Password reset successful
                $message = "Your password has been reset. Please <a href='LogInUser.php'>Log in</a>.";
                echo "<script>alert('$message');</script>"; 
            } else {
                $message = "Error updating password: " . $conn->error;
            }

            $stmt_update->close();
        } else {
            $message = "Invalid email.";
        }

        $stmt_select->close();
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="LoginUser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .reset-message {
            color: red;
        }
    </style>
</head>
<body>
<header>
    <figure class="logo">
        <img src="hospitalLogo.jpeg" alt="Hospital Logo">
    </figure>
    <nav style="background-color:#FFC145 ;">
        <div class="nav-section-a">
            <a href="#Booking Appointment">Booking Appointment</a>
            <a href="#Doctor Profile">Doctor Profile</a>
            <a href="#Common Disease">Common Disease</a>
        </div>
        <div class="nav-section-b">
            <div class="dropdown">
                <div class="dropdown-word">Medical Service</div>
            </div>
            <div class="dropdown">
                <div class="dropdown-word">About Us</div>
                <ul class="dropdown-content">
                    <li><a href="AboutUs_History.html">Hospital History</a></li>
                    <li><a href="Mission&Vision.html">Vision & Mission</a></li>
                    <li><a href="newsboardUser.html">News Board</a></li>
                    <li><a href="survey.html">Survey</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <div class="dropdown-word"><a href="http://127.0.0.1:3000/ContactUs.html">Contact Us</a></div>
            </div>
            <div class="dropdown">
                <div class="dropdown-word">My Account</div>
                <ul class="dropdown-content">
                    <li><a href="MyAccountSignUp.php">Sign Up / Log In</a></li>
                    <li><a href="UserAccount.php">My Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="title-band">
    <h1>Reset Password</h1>
</div>
<main>
    <section class="login-form">
        <?php if (!empty($message)): ?>
            <div class="reset-message">
                <?php echo $message; ?>
            </div>
            <?php if ($message === "Passwords do not match."): ?>
                <br>
                <a href="reset_password.php">Go back to reset password page</a>
            <?php endif; ?>
        <?php else: ?>
            <h2>Enter New Password</h2>
            <form method="POST" onsubmit="return validatePassword()">
                <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" required>
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <button type="submit">Reset Password</button>
            </form>
        <?php endif; ?>
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
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Medical Service</a></li>
                <li><a href="">Our Doctors</a></li>
                <li><a href="">Appointment Booking</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">Contact Us</a></li>
            </ul>
        </div>
    </div>
    <div class="footerBottom">
        <p>Copyright &copy;2024  <span class="designer">SUNNY SMILE HOSPITAL</span></p>
    </div>
</footer>

<script>
function validatePassword() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const errorDiv = document.querySelector('.reset-message');

    if (password !== confirmPassword) {
        errorDiv.innerHTML = "Passwords do not match.";
        return false;
    } else if (!password.match(/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/)) {
        errorDiv.innerHTML = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one symbol.";
        return false;
    }

    return true;
}
</script>

</body>
</html>
