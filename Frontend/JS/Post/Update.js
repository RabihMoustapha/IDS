function isLoggedIn() {
    return localStorage.getItem('userToken');
}

if (!isLoggedIn()) {
    window.location.href = '../Login.php';
}

function logout() {
    localStorage.removeItem('userToken');
    window.location.href = '../Login.php';
}