document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('appointmentDate').setAttribute('min', today);

    // Replace with actual logic to check if the user is logged in
    const isLoggedIn = checkLoginStatus(); 

    if (!isLoggedIn) {
        document.getElementById('loginPrompt').style.display = 'block';
        document.getElementById('bookingForm').style.display = 'none';
    } else {
        document.getElementById('loginPrompt').style.display = 'none';
        document.getElementById('bookingForm').style.display = 'block';
    }
});

document.getElementById('bookingForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Form submitted successfully!');
});

function checkLoginStatus() {
    // Replace with actual logic to determine if the user is logged in
    // For demonstration purposes, let's assume we have a function that returns true or false
    return false; // Change this to true if you want to test the form being displayed
}


