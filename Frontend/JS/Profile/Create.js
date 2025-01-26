const profile = 'http://localhost/IDS/Backend/Create/profile.php';
const email = document.getElementById('email');
const password = document.getElementById('password');
const name = document.getElementById('name');

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

        if (!response.ok) throw new Error('Creation Failed. Server error.');

        const data = await response.json();
        if (data.success) {
            alert('Account created successfully');
            window.location.href = '../../Frontend/Home.php';
        } else {
            alert('Account creation failed. Please try again.');
            email.value = '';
            password.value = '';
            name.value = '';
        }
    } catch (err) {
        console.error('An error occurred:', err);
        alert(`An error occurred during fetching. ${err.message}`);
        email.value = '';
        password.value = '';
        name.value = '';
    }
}