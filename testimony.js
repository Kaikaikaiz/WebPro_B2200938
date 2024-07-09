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
    fetch('testimonyFetch.php')
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

function uploadTestimony() {
    var content = document.getElementById("textUpload").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "testimonyUpload", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
            location.reload(); // Reload the page to show the new testimony
        }
    };
    xhr.send("content=" + encodeURIComponent(content));
}


// Fetch testimonies on page load
window.onload = fetchTestimonies;

