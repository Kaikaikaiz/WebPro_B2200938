// Function to fetch testimonies from server
function fetchTestimonies() {
    fetch('fetch_testimonies.php')
        .then(response => response.json())
        .then(data => {
            // Process fetched testimonies
            displayTestimonies(data);
        })
        .catch(error => console.error('Error fetching testimonies:', error));
}

// Function to display testimonies on the page
function displayTestimonies(testimonies) {
    const testimonyContainer = document.getElementById('testimonies');
    testimonyContainer.innerHTML = '';

    testimonies.forEach(testimony => {
        const testimonyElement = document.createElement('div');
        testimonyElement.classList.add('testimony');

        const usernameElement = document.createElement('span');
        usernameElement.classList.add('username');
        usernameElement.textContent = testimony.username;

        const contentElement = document.createElement('p');
        contentElement.textContent = testimony.content;

        testimonyElement.appendChild(usernameElement);
        testimonyElement.appendChild(contentElement);

        testimonyContainer.appendChild(testimonyElement);
    });
}

// Function to upload testimony
function uploadTestimony() {
    const textInput = document.getElementById('textUpload').value;

    // Check if input is empty
    if (!textInput.trim()) {
        alert('Please enter a testimony.');
        return;
    }

    fetch('upload_testimony.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ content: textInput }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to upload testimony');
        }
        return response.json();
    })
    .then(data => {
        console.log('Testimony uploaded successfully:', data.message);
        // Fetch testimonies again to update the list
        fetchTestimonies();
    })
    .catch(error => console.error('Error uploading testimony:', error));
}

// Display testimonies on page load
window.onload = function() {
    fetchTestimonies();
}
