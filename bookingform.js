document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('appointmentDate').setAttribute('min', today);
});

document.getElementById('bookingForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Form submitted successfully!');
});


    // Check if the user is logged in
    const isLoggedIn = false; // Replace with actual logic to check if the user is logged in

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
