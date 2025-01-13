const url = 'http://localhost/IDS/Backend/profile.php';
// Assuming you want to send data to a backend PHP script using JavaScript
function handleLogin() {
    const email = document.getElementById('usermail').value;
    const password = document.getElementById('password').value;

    // Replace this with the backend URL that handles login
    const loginUrl = 'http://localhost/IDS/Backend/profile.php';

    const loginData = {
        email: email,
        password: password,
        action: "login"
    };

    fetch(loginUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(loginData)
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = 'home.php';  // Redirect on successful login
            } else {
                alert('Login failed. Please try again.');
            }
        })
        .catch(error => console.error('Error logging in:', error));

    return false;  // Prevent form from submitting the traditional way
}

// Function to update item (for demonstration purposes, make sure `id` and `item` are defined properly)
function updateItem(id, item) {
    fetch(`${url}/${id}`, {
        method: 'PUT',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(item)
    })
        .then(response => response.json())
        .then(() => getItems())
        .catch(error => console.error('Unable to update item.', error));
}

// Example usage of updateItem
const updatedItem = {
    isComplete: true,
    name: 'newemail@example.com'
};

const itemId = 1;  // Assuming item ID is 1
updateItem(itemId, updatedItem);
