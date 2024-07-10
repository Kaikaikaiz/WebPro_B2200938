document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('appointmentDate').setAttribute('min', today);
});

document.getElementById('bookingForm').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Form submitted successfully!');
});
