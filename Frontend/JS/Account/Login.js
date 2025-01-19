// Readable values and APIs
const email = document.getElementById("email");
const password = document.getElementById("password");
const query = document.getElementById("searchQuery").value;
const profile = "http://localhost/IDS/Backend/profile.php";
const searchbar = "http://localhost/IDS/Backend/searchbar.php";

function isLoggedIn() {
    return localStorage.getItem("userToken");
}

async function getItem() {
    const query = document.getElementById("searchQuery").value;
    if (query.length < 3) {
        document.getElementById("output").style.display = "none";
        return;
    }

    try {
        const response = await fetch(searchbar, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ query: query }),
        });
        if (!response.ok) throw new Error("Search Failed");
        const data = await response.json();
        displayResults(data);
    } catch (err) {
        console.error("Search error:", err);
        alert("An error occurred during search.");
    }
}

function displayResults(data) {
    const resultsContainer = document.getElementById("results");
    resultsContainer.innerHTML = "";
    if (data.length === 0) {
        resultsContainer.innerHTML = "<p>No results found.</p>";
    } else {
        data.forEach(item => {
            const resultItem = document.createElement("div");
            resultItem.className = "col-md-4";
            resultItem.innerHTML = `
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">${item.title}</h5>
                        <p class="card-text">${item.keyword}</p>
                        <p class="card-text"><small class="text-muted">${item.hashtag}</small></p>
                    </div>
                </div>
            `;
            resultsContainer.appendChild(resultItem);
        });
    }
    document.getElementById("output").style.display = "block";
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

function logout() {
    localStorage.removeItem("userToken");
    window.location.href = "Login.php";
}