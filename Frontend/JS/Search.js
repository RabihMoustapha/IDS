function isLoggedIn() {
    return localStorage.getItem('userToken');
}

if(!isLoggedIn()){
    window.location.href = '../Frontend/Login.php';
}

function logout() {
    localStorage.removeItem('userToken');
    window.location.href = '../Frontend/Login.php';
}