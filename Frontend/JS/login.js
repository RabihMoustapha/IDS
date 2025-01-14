const url = 'http://localhost/IDS/Backend/profile.php';
var email = document.getElementById('usermail').value;
var password = document.getElementById('password').value;

function login() {
    fetch(url)
        .then(response => response.json())
        .then(data => isloggedin(data))
    //.catch(error => console.error('Unable to get items.', error));
}

function isloggedin(data) {
    var isMatch = data.some(element => {
        return element.email === email && element.password === password;
    });

    if (isMatch) {
        teleport();
    } else {
        alert('Not matched');
    }
}

function teleport() {
    window.location.href = 'home.php';
}