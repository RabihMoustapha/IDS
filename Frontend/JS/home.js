const query = document.getElementById('searchQuery');
const container = document.getElementById('data-container');
const profile = 'http://localhost/IDS/Backend/profile.php';
const searchbar = 'http://localhost/IDS/Backend/searchbar.php';
const post = 'http://localhost/IDS/Backend/post.php';

function isLoggedIn() {
    return localStorage.getItem('userToken');
}

async function getData() {
    const requestData = {
        query: query.value,
    };
    try {
        const response = await fetch(searchbar, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error('Search Failed');
        const data = await response.json();
        container.innerHTML = '';
        if (data.success) {
            data.item.forEach(element => {
                container.innerHTML += `<div class='data-block'>
                                            <h3>${element.title}</h3>
                                            <p>${element.hashtag}</p>
                                            <p>${element.keyword}</p>
                                        </div>`;
            });
        } else {
            alert('Fatal error ' + data.message);
            query.value = '';
        }
    } catch (err) {
        alert('An error occurred during fetching.' + err);
        query.value = '';
    }
}

async function seeItem() {
    try {
        const response = await fetch(post);
        if (!response.ok) throw new Error('Fetch Failed');
        const data = await response.json();
        container.innerHTML = '';
        if (data.success) {
            data.item.forEach(item => {
                container.innerHTML += `<div class='data-block'>
                                        <h3>${item.description}</h3>
                                        <p>${item.title}</p>
                                        <p>${item.codesnippets}</p>
                                    </div>`;
            });
        }
    } catch (err) {
        alert('An error occurred during fetching.' + err);
    }
}

function logout() {
    localStorage.removeItem('userToken');
    window.location.href = 'Login.php';
}