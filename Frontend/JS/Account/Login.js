//Readable values and apis
const email = document.getElementById('email');
const password = document.getElementById('password');
const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';

//Read items from the database
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

//Login function
async function login() {
    const requestData = {
        email: email.value,
        password: password.value,
    };
    try {
        const response = await fetch(profile, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error("Login Failed");
        const data = await response.json();
        if (data.success) {
            window.location.href = "Home.php";
        }else{
            alert("Login failed: " + data.message);
            email.value = "";
            password.value = "";
        }
    } catch (err) {
        email.value = "";
        password.value = "";
    }
}