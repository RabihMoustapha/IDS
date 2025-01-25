const post = 'http://localhost/IDS/Backend/post.php';
const title = document.getElementById('title');
const hashtag = document.getElementById('hashtag');
const content = document.getElementById('content');

function isLoggedIn() {
    return localStorage.getItem('userToken');
}

async function Delete() {
    const requestData = {
        title: title.value,
        content: content.value,
        hashtag: hashtag.value
    };
    try {
        const response = await fetch(post, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error('Delete Failed');
        const data = await response.json();
        if (data.success === true) {
            alert('Delete successful');
            window.location.href = '../../Frontend/Home.php';
        }
    } catch (err) {
        console.error('An error:', err);
        alert('An error occurred during fetching.' + err);
        email.value = '';
        password.value = '';
    }
}

function logout() {
    localStorage.removeItem('userToken');
    window.location.href = '../../Frontend/Login.php';
}