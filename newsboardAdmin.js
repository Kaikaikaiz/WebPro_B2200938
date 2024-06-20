document.addEventListener('DOMContentLoaded', () => {
    const postForm = document.getElementById('postForm');
    const postsContainer = document.getElementById('postsContainer');
    let editIndex = -1;

    loadPosts();

    postForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const title = postForm.title.value;
        const content = postForm.content.value;
        
        const imageFile = postForm.image.files[0];
        if (imageFile) {
            const reader = new FileReader();
            reader.onload = (event) => {
                const image = event.target.result;
                const newPost = { image, title, content };
                
                if (editIndex === -1) {
                    addPost(newPost);
                } else {
                    updatePost(newPost, editIndex);
                }

                postForm.reset();
                editIndex = -1;
            };
            reader.readAsDataURL(imageFile);
        }
    });

    function loadPosts() {
        const posts = JSON.parse(localStorage.getItem('posts')) || [];
        posts.forEach(post => {
            addPostToDOM(post);
        });
    }

    function savePosts(posts) {
        localStorage.setItem('posts', JSON.stringify(posts));
    }

    function addPost(post) {
        const posts = JSON.parse(localStorage.getItem('posts')) || [];
        posts.push(post);
        savePosts(posts);
        addPostToDOM(post);
    }

    function updatePost(post, index) {
        const posts = JSON.parse(localStorage.getItem('posts')) || [];
        posts[index] = post;
        savePosts(posts);
        postsContainer.children[index].replaceWith(createPostCard(post, index));
    }

    function addPostToDOM(post) {
        const postCard = createPostCard(post, postsContainer.children.length);
        postsContainer.appendChild(postCard);
    }

    function createPostCard(post, index) {
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

        const actionsDiv = document.createElement('div');
        actionsDiv.classList.add('actions');

        const editButton = document.createElement('button');
        editButton.innerText = 'Edit';
        editButton.addEventListener('click', () => editPost(post, index));

        const deleteButton = document.createElement('button');
        deleteButton.innerText = 'Delete';
        deleteButton.addEventListener('click', () => deletePost(index));

        actionsDiv.appendChild(editButton);
        actionsDiv.appendChild(deleteButton);

        card.appendChild(imageDiv);
        card.appendChild(title);
        card.appendChild(content);
        card.appendChild(actionsDiv);

        return card;
    }

    function editPost(post, index) {
        editIndex = index;
        const dataTransfer = new DataTransfer();
        const file = dataURLtoFile(post.image, 'image.jpg');
        dataTransfer.items.add(file);
        postForm.image.files = dataTransfer.files;
        postForm.title.value = post.title;
        postForm.content.value = post.content;
    }

    function deletePost(index) {
        const posts = JSON.parse(localStorage.getItem('posts')) || [];
        posts.splice(index, 1);
        savePosts(posts);
        postsContainer.removeChild(postsContainer.children[index]);
    }

    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }
        return new File([u8arr], filename, { type: mime });
    }
});
