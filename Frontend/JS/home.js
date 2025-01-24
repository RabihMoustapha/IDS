const query = document.getElementById("searchQuery");
const container = document.getElementById("data-container");
const profile = "http://localhost/IDS/Backend/profile.php";
const searchbar = "http://localhost/IDS/Backend/searchbar.php";
const post = "http://localhost/IDS/Backend/post.php";

function isLoggedIn() {
    return localStorage.getItem("userToken");
}

async function getData() {
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
        if (data.status) {
            for (var i = 0; i < data.length; i++) {
                container.innerHTML = `<div class="data-block">
                                            <h3>${data[i].item.keyword}</h3>
                                            <p>${data[i].item.title}</p>
                                            <p>${data[i].item.hashtag}</p>
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
        const response = await fetch(post);
        if (!response.ok) throw new Error("Fetch Failed");
        const data = await response.json();
        if (data.status === true) {
            for (var i = 0; i < data.length; i++) {
                container.innerHTML += `<div class="data-block">
                                        <h3>${data.item[i].description}</h3>
                                        <p>${data.item[i].title}</p>
                                        <p>${data.item[i].codesnippets}</p>
                                    </div>`;
            };
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

function getItem() {
    fetch(`${searchbar}?q=${query}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                data.data.forEach(item => {
                    container.innerHTML += `<div class="data-block">
                    <h3>${item.title}</h3>
                    <p>${item.description}</p>
                    <p>${item.codesnippets}</p>
                </div>`;
                });
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error("An error:", error);
            alert("An error occurred during fetching." + error);
        });
}