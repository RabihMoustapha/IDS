const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';
var email = document.getElementById('email').value;
var password = document.getElementById('password').value;

function login() {
    fetch(profile)
        .then(response => response.json())
        .then(data => isloggedin(data))
        .catch(error => console.error('Unable to get items.', error));
}

function getItem() {
    fetch(post)
        .then(response => response.json())
        .then(data => isloggedin(data))
        .catch(error => console.error('Unable to get items.', error));
}

function isloggedin(data) {
    const isMatch = data.some(element => {
        return element.email === email && element.password === password;
    });

    if (isMatch) {
        window.location.href = 'Home.php';
    } else {
        alert('Not matched');
    }
}