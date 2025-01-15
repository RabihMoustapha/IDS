const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';
var email = document.getElementById('email');
var password = document.getElementById('password');

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
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        const myObj = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML = myObj.name;
    }
    xmlhttp.open("GET", "../../Backend/profile.php");
    xmlhttp.send();
}