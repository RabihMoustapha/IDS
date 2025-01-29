const query = document.getElementById('searchQuery');
const container = document.getElementById('data-container');
const profile = 'http://localhost/IDS/Backend/profile.php';
const post = 'http://localhost/IDS/Backend/post.php';

function isLoggedIn() {
    return localStorage.getItem('userToken');
}

async function getData() {
    const requestData = {
        description: query.value,
    };
    try {
        const response = await fetch(post, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error('Search Failed');
        const data = await response.json();
        if (data.success) {
            data.item.forEach(element => {
                container.innerHTML = `<div class='data-block'>
                    <div class='post-details'>
                        <p>${element.title}</p>
                        <p>${element.description}</p>
                    </div>
                    <div class='actions'>
                        <div class='like-button' onclick='Like()'>👍 Like</div>
                        <div class='comment-button' onclick='Comment()'>💬 Comment</div>
                        <button class='btn btn-outline-danger' type='button' onclick='Delete()' style='height: 38px;'><img src='Images/delete.png' style='width: 20px; height: 20px;'></button>
                    </div>
                </div>`;
            });
        } else {
            alert('Fatal error ' + data.message);
            query.value = '';
        }
    } catch (err) {
        alert('An error occurred during fetching.' + err);
        query.value = '';
    }
}

async function seeItem() {
    try {
        const response = await fetch(post);
        if (!response.ok) throw new Error('Fetch Failed');
        const data = await response.json();
        if (data.success) {
            data.item.forEach(element => {
                container.innerHTML += `
                <div class='data-block'>
                    <div class='post-details'>
                        <p>${element.title}</p>
                        <p>${element.description}</p>
                    </div>
                    <div class='actions'>
                        <div class='like-button' onclick='Like()'>👍 Like</div>
                        <div class='comment-button' onclick='Comment()'>💬 Comment</div>
                    </div>
                </div>
                `;
            });
        } else {
            alert('Fatal error ' + data.message);
        }
    } catch (err) {
        alert('An error occurred during fetching.' + err);
    }
}

function logout() {
    localStorage.removeItem('userToken');
    window.location.href = 'Login.php';
}

async function Delete() {
    const email = prompt('Enter your email');
    const password = prompt('Enter your password');
    const requestData = {
        email: email,
        password: password,
    };
    try {
        const response = await fetch(profile, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error('Delete Failed');
        const data = await response.json();
        if (data.success) {
            alert('Profile Deleted Successfully');
        } else {
            alert('Fatal error ' + data.message);
        }
    } catch (err) {
        alert('An error occurred during fetching.' + err);
    }
}
