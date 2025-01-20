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
        alert("Please login to view your profile.");
        return;
    } else {
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
            const resultsContainer = document.getElementById("results");
            resultsContainer.innerHTML = "";

            if (data.status === true && data.data.length > 0) {
                const table = document.createElement("table");
                table.className = "table table-striped";
                const thead = document.createElement("thead");
                const headerRow = document.createElement("tr");
                const headers = ["HashTag", "Title", "Keyword"];
                headers.forEach(headerText => {
                    const th = document.createElement("th");
                    th.textContent = headerText;
                    headerRow.appendChild(th);
                });
                thead.appendChild(headerRow);
                table.appendChild(thead);

                const tbody = document.createElement("tbody");
                data.data.forEach(item => {
                    const row = document.createElement("tr");
                    const tagCell = document.createElement("td");
                    tagCell.textContent = item.hashtag;
                    row.appendChild(nameCell);
                    const titleCell = document.createElement("td");
                    titleCell.textContent = item.title;
                    row.appendChild(titleCell);
                    const keywordCell = document.createElement("td");
                    keywordCell.textContent = item.keyword;
                    row.appendChild(keywordCell);
                    tbody.appendChild(row);
                });
                table.appendChild(tbody);
                resultsContainer.appendChild(table);
                output.style.display = "block";
            } else {
                output.style.display = "none";
            }
        } catch (err) {
            console.error("Search error:", err);
            alert("An error occurred during search: " + err.message);
            output.style.display = "none";
        }
    }
}