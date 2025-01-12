// login.js
function login(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get user input values from the form
    const usermail = document.getElementById('usermail').value.trim();
    const password = document.getElementById('password').value.trim();

    // Validate the form fields
    if (!usermail || !password) {
        alert('Please enter both usermail and password.');
        return;
    }

    // Prepare the login credentials
    const credentials = {
        usermail: usermail,
        password: password
    };

    // The PHP backend URL that will handle the login
    const apiUrl = 'http://localhost/IDS/Backend/profile.php';  // Change as per your setup

    // Send a POST request to the backend (PHP API)
    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'  // We're sending JSON data
        },
        body: JSON.stringify(credentials)  // Convert the credentials object to a JSON string
    })
        .then(response => response.json())  // Parse the JSON response from PHP
        .then(data => {
            if (data.token) {
                // Successful login: store token in localStorage or sessionStorage
                localStorage.setItem('authToken', data.token);  // Store token in browser storage (for example)
                window.location.href = 'home.php';  // Redirect to a different page (e.g., dashboard)
            } else {
                // Invalid credentials or other error
                alert(data.message || 'Login failed. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred during login. Please try again.');
        });
}