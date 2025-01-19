const email = document.getElementById("email");
const password = document.getElementById("password");
const query = document.getElementById("searchQuery").value;
const profile = "http://localhost/IDS/Backend/profile.php";
const searchbar = "http://localhost/IDS/Backend/searchbar.php";

function isLoggedIn() {
    return localStorage.getItem("userToken");
}

document.addEventListener("DOMContentLoaded", () => {
    if (!isLoggedIn()) {
        document.getElementById("searchQuery").disabled = true;
        document.querySelector("button[type='submit']").disabled = true;
    }
});

function getItem() {

    const item = {
        hashtag: query,

    };

    fetch(searchbar, {
        method: "POST",
        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        body: JSON.stringify(item)
    })
        .then(response => response.json())
        .then(() => {
            getItem();
            searchQuery.value = "";
        })
        .catch(error => console.error("Unable to get items.", error));
}

function logout() {
    localStorage.removeItem("userToken");
    window.location.href = "Login.php";
}