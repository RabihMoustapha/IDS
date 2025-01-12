// Function to handle the login process
function login(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get the usermail and password values from the form
    const usermail = document.getElementById('usermail').value.trim();
    const password = document.getElementById('password').value.trim();

    // Make sure both fields are not empty
    if (!usermail || !password) {
        alert('Please enter both usermail and password.');
        return;
    }

    // Create an object with the login credentials
    const credentials = {
        usermail: usermail,
        password: password
    };

    // API endpoint for login (example URL)
    const apiUrl = 'http://localhost/IDS/Backend/profile.php';

    // Send a POST request to the login API
    fetch(apiUrl, {
        method: 'POST',  // HTTP method
        headers: {
            'Content-Type': 'application/json'  // We are sending JSON
        },
        body: JSON.stringify(credentials)  // Send credentials as a JSON string
    })
        .then(response => response.json())  // Parse the JSON response
        .then(data => {
            if (data.token) {
                // If login is successful and a token is received
                alert('Login successful!');
                // Store the authentication token (for example in localStorage or sessionStorage)
                localStorage.setItem('basic cG9zdG1hbiBwYXNzd29yZA', data.token);
                // Optionally, redirect the user to a different page
                window.location.href = 'home.html';  // Redirect to a dashboard page
            } else {
                // If no token is received, the login failed
                alert('Invalid usermail or password.');
            }
        })
        .catch(error => {
            // Handle network errors or other issues
            console.error('Error:', error);
            alert('An error occurred during login. Please try again.');
        });
}
