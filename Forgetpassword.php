<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="ForgotPassword.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
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
                    <div class="dropdown-word"><a href="ContactUs.html">Contact Us</a></div>
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
        <h1>Forgot Password</h1>
    </div>
 
    <main>
        <section class="forgot-password-form">
            <h2>Forgot Password</h2>
            <p class="dark-purple">Please enter your email address to receive a password reset link.</p>
            <?php
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;
 
                require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';
 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sunnysmile";
 
                $conn = new mysqli($servername, $username, $password, $dbname);
 
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
 
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
                    $user_email = $_POST['email'];
 
                    // Check if the user exists in the database
                    $sql = "SELECT * FROM user WHERE email = '$user_email'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // Send password reset email
                        $mail = new PHPMailer(true);
                        try {
                            //Server settings
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'your email@gmail.com';
                            $mail->Password = '';
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;
 
                            //Recipients
                            $mail->setFrom('youremail@gmail.com', 'name');
                            $mail->addAddress($user_email);
 
                            //Content
                            $mail->isHTML(true);
                            $mail->Subject = 'Password Reset Request';
                            $mail->Body = "Dear user,<br><br>We received a request to reset your password. Please click the link below to reset your password:<br><br><a href='http://yourwebsite.com/reset_password.php?token=$token'>Reset Password</a><br><br>If you did not request a password reset, please ignore this email.";
 
                            $mail->send();
                            echo "<div class='container'><div class='alert alert-success'>Password reset link has been sent to $user_email.</div></div>";
                        } catch (Exception $e) {
                            echo "<div class='container'><div class='alert alert-danger'>Error sending email: {$mail->ErrorInfo}</div></div>";
                        }
                    } else {
                        echo "<div class='container'><div class='alert alert-danger'>Email not found.</div></div>";
                    }
                }
 
                $conn->close();
            ?>
            <form action="" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Reset Password</button>
            </form>
            <p class="light-purple">Remembered your password? <a href="LogInUser.html">Log in</a></p>
            <p class="light-purple">Don't have an account yet? <a href="MyAccountSignUp.html">Sign Up</a></p>
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
</body>
</html>
 