// Mock data for testimonies
const testimonies = [
    {
        username: "MottoSky",
        content: "The staff was incredibly helpful and the facilities were top-notch."
    },
    {
        username: "KaizWee",
        content: "I had a wonderful experience with my treatment here."
    }
];

// Function to display testimonies
function displayTestimonies() {
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
    const textInput = document.getElementById('textUpload');

    const newTestimony = {
        username: "New User", // Placeholder for dynamic username retrieval
        content: textInput.value
    };

    testimonies.push(newTestimony);
    displayTestimonies();

    // Clear input field
    textInput.value = '';
}

// Display testimonies on page load
window.onload = displayTestimonies;
