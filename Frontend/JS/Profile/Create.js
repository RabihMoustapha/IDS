const profile = 'http://localhost/IDS/Backend/Create/profile.php';
const email = document.getElementById('email').value;
const password = document.getElementById('password').value;
const name = document.getElementById('name').value;

async function Create() {
    const requestData = {
        name: name.value,
        email: email.value,
        password: password.value,
    };
    try {
        const response = await fetch(profile, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error('Created Failed');
        const data = await response.json();
        if (data.success === true) {
            alert('Created successful');
            window.location.href = '../../Frontend/Home.php';
        }
    } catch (err) {
        console.error('An error:', err);
        alert('An error occurred during fetching.' + err);
        email.value = '';
        password.value = '';
        name.value = '';
    }
}