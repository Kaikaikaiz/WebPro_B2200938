document.addEventListener('DOMContentLoaded', () => {
    const newsForm = document.getElementById('news-form');
    const newsBoard = document.getElementById('news-board');

    let newsData = [
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

    function renderNews() {
        newsBoard.innerHTML = '';
        newsData.forEach((news, index) => {
            const newsArticle = document.createElement('div');
            newsArticle.classList.add('news-article');

            const title = document.createElement('h2');
            title.textContent = news.title;

            const description = document.createElement('p');
            description.textContent = news.description;

            const photo = document.createElement('img');
            photo.src = news.photo;
            photo.alt = news.title;

            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.onclick = () => {
                newsData.splice(index, 1);
                renderNews();
            };

            newsArticle.appendChild(title);
            newsArticle.appendChild(description);
            newsArticle.appendChild(photo);
            newsArticle.appendChild(deleteButton);

            newsBoard.appendChild(newsArticle);
        });
    }

    newsForm.onsubmit = (e) => {
        e.preventDefault();
        const newNews = {
            title: e.target.title.value,
            description: e.target.description.value,
            photo: e.target.photo.value
        };
        newsData.push(newNews);
        renderNews();
        newsForm.reset();
    };

    renderNews();
});
