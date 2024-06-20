document.addEventListener('DOMContentLoaded', () => {
    const postsContainer = document.getElementById('postsContainer');
    loadPosts();

    function loadPosts() {
        const posts = JSON.parse(localStorage.getItem('posts')) || [];
        posts.forEach(post => {
            addPostToDOM(post);
        });
    }

    function addPostToDOM(post) {
        const postCard = createPostCard(post);
        postsContainer.appendChild(postCard);
    }

    function createPostCard(post) {
        const card = document.createElement('div');
        card.classList.add('card');

        const imageDiv = document.createElement('div');
        imageDiv.classList.add('image');
        const img = document.createElement('img');
        img.src = post.image;
        imageDiv.appendChild(img);

        const title = document.createElement('h2');
        title.innerText = post.title;

        const content = document.createElement('p');
        content.innerText = post.content;

        card.appendChild(imageDiv);
        card.appendChild(title);
        card.appendChild(content);

        return card;
    }
});
