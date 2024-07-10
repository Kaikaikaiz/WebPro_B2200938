<?php
session_start();

// Get user data from query parameters
$username = isset($_GET['username']) ? $_GET['username'] : 'Guest';
$email = isset($_GET['email']) ? $_GET['email'] : 'No Email Provided';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="UserProfile.css"> <!-- Link your CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <figure class="logo">
            <img src="../image/hospitalLogo.jpeg" alt="Hospital Logo">
        </figure>
        <nav style="background-color:#FFC145;">
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
        <h1>User Profile</h1>
    </div>
    <main>
        <section class="profile-info">
            <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
            <p>Email: <?php echo htmlspecialchars($email); ?></p>
            <button onclick="window.location.href='login.php'">Log In</button>
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
                <ul><li><a href="">Home</a></li>
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
        document.addEventListener("DOMContentLoaded", function() {
            var testimonyButton = document.querySelector('.testimony-button');
            testimonyButton.addEventListener('click', function() {
                window.location.href = 'testimony.html';
            });
        });
 
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
 
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('profileImage');
                output.src = dataURL;
            };
 
            reader.readAsDataURL(input.files[0]);
        }
</script>
</body>
</html>