// Dummy data for initial news
let newsData = [
    { title: "Hospital Expansion Project Started", content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus efficitur felis a metus dignissim, et vehicula libero consequat." },
    { title: "New Equipment Arrives for ICU", content: "Sed fermentum mauris quis magna tincidunt fermentum. Nulla facilisi. Phasellus consequat interdum urna ut finibus." }
];

// Function to display news
function displayNews() {
    const newsList = document.getElementById("news-list");

    // Clear existing list
    newsList.innerHTML = '';

    // Add news items
    newsData.forEach(news => {
        let li = document.createElement('li');
        li.innerHTML = `<h3>${news.title}</h3><p>${news.content}</p>`;
        newsList.appendChild(li);
    });
}

// Display initial news
displayNews();

// Form submit event listener
document.getElementById("news-form").addEventListener("submit", function(event) {
    event.preventDefault();

    // Get form values
    let title = document.getElementById("news-title").value;
    let content = document.getElementById("news-content").value;

    // Add new news item
    newsData.push({ title: title, content: content });

    // Display updated news
    displayNews();

    // Clear form
    document.getElementById("news-title").value = '';
    document.getElementById("news-content").value = '';
});
