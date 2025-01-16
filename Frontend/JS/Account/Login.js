const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';

function login() {
    fetch(profile)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            } else {
                return response.json();
            }
        })
        .then(data => {
            if (data.success) {
                window.location.href = 'Home.php';
            } else {
                alert('Login failed: ' + data.message);
            }
        })
        .catch(error => alert('Error' + error));
}

function getItem() {
    fetch(post)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                window.location.href = 'Home.php';
            } else {
                alert('Login failed: ' + data.message);
            }
        })
        .catch(error => console.error('Unable to get items.', error));
}