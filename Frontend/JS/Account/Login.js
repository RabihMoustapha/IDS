const email = document.getElementById("email");
const password = document.getElementById("password");
const query = document.getElementById("searchQuery");
const table = document.getElementById("output");
const profile = "http://localhost/IDS/Backend/profile.php";
const searchbar = "http://localhost/IDS/Backend/searchbar.php";

function isLoggedIn() {
    return localStorage.getItem("userToken");
}

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
            localStorage.setItem("userToken", data.token);
            window.location.href = "Home.php";
        } else {
            alert("Login failed: " + data.message);
            email.value = "";
            password.value = "";
        }
    } catch (err) {
        console.error("Login error:", err);
        alert("An error occurred during login.");
        email.value = "";
        password.value = "";
    }
}

function logout() {
    localStorage.removeItem("userToken");
    window.location.href = "Login.php";
}

async function getItem() {
    const requestData = {
        query: query.value,
    };
    try {
        const response = await fetch(searchbar, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error("Search Failed");
        const data = await response.json();
        if (data.status === true) {
            for (var i = 0; i < data.item.length; i++) {
                output.innerHTML = `<tr>
                                    <th>Keyword</th>
                                    <th>Hashtag</th>
                                    <th>Title</th>
                                </tr>
                                <tr>
                                    <td>${data.item[i].keyword}</td>
                                    <td>${data.item[i].hashtag}</td>
                                    <td>${data.item[i].title}</td>
                                </tr>`;

            }
        } else {
            alert("Fatal error " + data.message);
            query.value = "";
        }
    } catch (err) {
        console.error("An error:", err);
        alert("An error occurred during fetching." + err);
        query.value = "";
    }
}