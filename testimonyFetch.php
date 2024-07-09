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

$sql = "SELECT * FROM testimonies";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="testimony.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Patient Testimonies</title>
</head>
<body>
    <header>
    <div class="logo">
            <img src="LogoSShospital.png" alt="Hospital Logo">
        </div>

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
                        <li><a href="https://www.andorracare.com/delivery-packages">Hospital History</a></li>
                        <li><a href="https://www.andorracare.com/vaccination-package">Vision & Mission</a></li>
                        <li><a href="newsboardUser.html">News Board</a></li>
                        <li><a href="survey.html">Survey</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <div class="dropdown-word">Contact Us</div>
                </div>
                <div class="dropdown">
                    <div class="dropdown-word">My Account</div>
                    <ul class="dropdown-content">
                        <li><a href="https://www.andorracare.com/delivery-packages">Log In</a></li>
                        <li><a href="https://www.andorracare.com/vaccination-package">My Profile</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="testimony-section">
            <h1>Patient Testimonies</h1>
            <div id="testimonies">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="testimony">';
                        echo '<span class="username">' . $row["username"] . '</span>: ';
                        echo '<span class="content">' . $row["content"] . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo "No testimonies found.";
                }
                $conn->close();
                ?>
            </div>
            <div class="upload-bar">
                <input type="text" id="textUpload" placeholder="Share your experience..." />
                <button onclick="uploadTestimony()">Upload</button>
            </div>
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
            <p>Copyright &copy;2024 <span class="designer">SUNNY SMILE HOSPITAL</span></p>
        </div>
    </footer>

    <script src="testimony.js"></script>
</body>
</html>