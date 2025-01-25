const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';
const email = document.getElementById('email');
const password = document.getElementById('password');

function isLoggedIn() {
    return localStorage.getItem('userToken');
}

async function Delete() {
    const requestData = {
        email: email.value,
        password: password.value,
    };
    try {
        const response = await fetch(profile, {
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