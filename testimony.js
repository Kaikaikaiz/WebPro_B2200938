// Mock data for testimonies
const testimonies = [
    {
        username: "MottoSky",
        content: "The staff was incredibly helpful and the facilities were top-notch."
    },
    {
        username: "Kaigene",
        content: "I had a wonderful experience with my treatment here."
    }
];

// Function to fetch and display testimonies
function fetchTestimonies() {
    fetch('testimonies.php')
        .then(response => response.json())
        .then(data => {
            const testimonyContainer = document.getElementById('testimonies');
            testimonyContainer.innerHTML = '';

            data.forEach(testimony => {
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
        });
}

// Function to upload a new testimony
function uploadTestimony() {
    const textInput = document.getElementById('textUpload');
    const username = "New User"; // Replace with dynamic username retrieval

    const formData = new FormData();
    formData.append('content', textInput.value);
    formData.append('username', username);

    fetch('testimonies.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        fetchTestimonies();
        textInput.value = '';
    });
}

// Fetch testimonies on page load
window.onload = fetchTestimonies;

