const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';
const email = document.getElementById('email');
const password = document.getElementById('password');


function login() {
    fetch(profile)
        .then(response => response.json())
        .then(data => {
            if(data.success){
                window.location.href = 'Home.php';
            }else{
                alert('Login failed: ' + data.message)
            }
        })
        .catch(error => alert('Error', error));
}

function getItem() {
    fetch(post)
        .then(response => response.json())
        .then(data => isloggedin(data))
        .catch(error => console.error('Unable to get items.', error));
}