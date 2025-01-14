const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';
var email = document.getElementById('usermail').value;
var password = document.getElementById('password').value;

function login() {
    fetch(profile)
        .then(response => response.json())
        .then(data => isloggedin(data))
    //.catch(error => console.error('Unable to get items.', error));
}

function isloggedin(data) {
    const isMatch = data.some(element => {
        return element.email === email && element.password === password;
    });

    if (isMatch) {
        teleport();
    } else {
        alert('Not matched');
    }
}

function teleport() {
    window.location.href = 'Home.php';
}

function getItem() {
    fetch(post)
        .then(response => response.json())
        .then(data => isloggedin(data))
        .catch(error => console.error('Unable to get items.', error));
}