const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';
var email = document.getElementById('email').value;
var password = document.getElementById('password').value;
var name = document.getElementById('name').value;

function update() {
    const item = {
        name,
        email,
        password
    };

    fetch(`${profile}/${email}`, {
        method: 'PUT',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(item)
    })
        .then(() => getItem())
        .catch(error => console.error('Unable to update account.', error));

    return false;
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