function isLoggedIn() {
    return localStorage.getItem('userToken');
}

function logout() {
    localStorage.removeItem('userToken');
    window.location.href = '../Login.php';
}