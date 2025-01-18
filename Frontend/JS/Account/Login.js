// Readable values and APIs
const email = document.getElementById("email");
const password = document.getElementById("password");
const query = document.getElementById("searchQuery").value;
const profile = "http://localhost/IDS/Backend/profile.php";
const searchbar = "http://localhost/IDS/Backend/searchbar.php";

function isLoggedIn() {
    return !!localStorage.getItem("userToken");
}

function getItem() {
    if (!isLoggedIn()) {
        alert("You must be logged in to search.");
        window.location.href = "Login.php";
        query = "";
        return;
    }
    if (query.length < 3) {
        document.getElementById("output").innerHTML = "";
        return;
    }
    fetch(`${searchbar}?q=${query}`)
        .then((response) => response.json())
        .then((data) => {
            let output = "<ul class='list-group'>";
            data.forEach(function (item) {
                output += `
                <li class="list-group-item">
                    <h5>${item.title}</h5>
                    <p>${item.content}</p>
                </li>
                `;
            });
            output += "</ul>";
            document.getElementById("output").innerHTML = output;
            document.getElementById("output").style.display = "block"; // Show the output
        })
        .catch(error => console.error("Unable to get items.", error));
}

// Login function
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
            localStorage.setItem("userToken", data.token); // Assuming the backend sends a token
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

// Logout function
function logout() {
    localStorage.removeItem("userToken");
    window.location.href = "Login.php";
}

document.getElementById("searchQuery").addEventListener("input", getItem);
document.querySelector("form[role='search']").addEventListener("submit", getItem);