const query = document.getElementById("searchQuery");
const container = document.getElementById("data-container");
const profile = "http://localhost/IDS/Backend/profile.php";
const searchbar = "http://localhost/IDS/Backend/searchbar.php";

function isLoggedIn() {
    return localStorage.getItem("userToken");
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
                container.innerHTML = `<div class="data-block">
                                        <h3>${data.item[i].keyword}</h3>
                                        <p>${data.item[i].title}</p>
                                        <p>${data.item[i].hashtag}</p>
                                    </div>`;

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

async function seeItem() {
    try {
        const response = await fetch(searchbar, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
            },
        });
        if (!response.ok) throw new Error("Search Failed");
        const data = await response.json();
        for (var i = 0; i < data.item.length; i++) {
            container.innerHTML = `<div class="data-block">
                                        <h3>${data.item[i].keyword}</h3>
                                        <p>${data.item[i].title}</p>
                                        <p>${data.item[i].hashtag}</p>
                                    </div>`;

        }
    } catch (err) {
        console.error("An error:", err);
        alert("An error occurred during fetching." + err);
    }
}

function logout() {
    localStorage.removeItem("userToken");
    window.location.href = "Login.php";
}