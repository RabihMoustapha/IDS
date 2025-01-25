const url = 'http://localhost/IDS/Backend/post.php';
var email = document.getElementById('usermail').value;
var password = document.getElementById('password').value;
var username = document.getElementById('username').value;

function create() {

    const item = {
        isComplete: false,
        username,
        email,
        password,
    };

    fetch(url, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(item)
    })
        .then(response => response.json())
        .then(() => {
            login();
        })
        .catch(error => console.error('Unable to add item.', error));
}