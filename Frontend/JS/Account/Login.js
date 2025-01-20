const email = document.getElementById("email");
const password = document.getElementById("password");
const query = document.getElementById("searchQuery");
const output = document.getElementById("output");
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
    if (!isLoggedIn()) {
        alert("Please login to view search results.");
        return;
    }

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
        console.log("Search results:", data);
        const resultsContainer = document.getElementById("resultsTableBody");
        resultsContainer.innerHTML = "";

        if (data.status === true && data.data.length > 0) {
            data.data.forEach(item => {
                const row = document.createElement("tr");
                const titleCell = document.createElement("td");
                titleCell.textContent = item.title;
                row.appendChild(titleCell);
                const descriptionCell = document.createElement("td");
                descriptionCell.textContent = item.description;
                row.appendChild(descriptionCell);
                const linkCell = document.createElement("td");
                linkCell.innerHTML = `<a href="${item.link}">${item.link}</a>`;
                row.appendChild(linkCell);
                resultsContainer.appendChild(row);
            });
            document.getElementById("resultsContainer").style.display = "block";
        } else {
            document.getElementById("resultsContainer").style.display = "none";
        }
    } catch (err) {
        console.error("Search error:", err);
        alert("An error occurred during search: " + err.message);
        document.getElementById("resultsContainer").style.display = "none";
    }
}