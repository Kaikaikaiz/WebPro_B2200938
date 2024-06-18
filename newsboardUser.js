document.addEventListener('DOMContentLoaded', () => {
    // Example of fetching news data. Replace with your own data source.
    const newsData = [
        {
            title: "New Wing Opening",
            description: "We are excited to announce the opening of our new wing.",
            photo: "new-wing.jpg"
        },
        {
            title: "Health Fair",
            description: "Join us for a health fair with free screenings and consultations.",
            photo: "health-fair.jpg"
        }
    ];

    const newsBoard = document.getElementById('news-board');

    newsData.forEach(news => {
        const newsArticle = document.createElement('div');
        newsArticle.classList.add('news-article');

        const title = document.createElement('h2');
        title.textContent = news.title;

        const description = document.createElement('p');
        description.textContent = news.description;

        const photo = document.createElement('img');
        photo.src = news.photo;
        photo.alt = news.title;

        newsArticle.appendChild(title);
        newsArticle.appendChild(description);
        newsArticle.appendChild(photo);

        newsBoard.appendChild(newsArticle);
    });
});
