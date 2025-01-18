const email = document.getElementById('email').value;
const password = document.getElementById('password').value;

// function getItem() {
//     fetch(post)
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok: ' + response.status);
//             }
//             return response.json();
//         })
//         .then(data => {
//             if (data.success) {
//                 window.location.href = 'Home.php';
//             } else {
//                 alert('Login failed: ' + data.message);
//             }
//         })
//         .catch(error => console.error('Unable to get items.', error));
// }

async function login(email, password) {
    const url = "http://localhost/IDS/Backend/profile.php";
    const requestData = {
        email: email,
        password: password,
    };
    try {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error("Login Failed");
        const data = await response.json();
        if (data) {
            //sessionStorage.setItem("token", data.token);
            window.location.href = "Home.php";
        }
    } catch (err) {
        email.current.value = "";
        password.current.value = "";
    }
}