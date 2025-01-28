const query = document.getElementById('searchQuery');
const container = document.getElementById('data-container');
const profile = 'http://localhost/IDS/Backend/profile.php';
const searchbar = 'http://localhost/IDS/Backend/searchbar.php';
const post = 'http://localhost/IDS/Backend/post.php';

function isLoggedIn() {
    return localStorage.getItem('userToken');
}

async function getData() {
    const requestData = {
        query: query.value,
    };
    try {
        const response = await fetch(searchbar, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        });
        if (!response.ok) throw new Error('Search Failed');
        const data = await response.json();
        container.innerHTML = '';
        if (data.success) {
            data.item.forEach(element => {
                container.innerHTML += `<tr class="data-block">
    <td>
      <table>
        <tr class="header">
          <td>
          <img src= ${element.userImg} alt="User Profile" />
          </td>
          <td>
            <div class="user-info">
              <span class="username">${element.name}</span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="post-content">
            This is an example post content. Here you can write about your thoughts, experiences, or anything else!
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <img src="${element.post - img}.jpg" alt="Post Image" />
          </td>
        </tr>
        <tr class="actions">
          <td class="like-button">
            <span onclick='Like()'>👍</span> Like
          </td>
          <td class="comment-button">
            <span onclick='Comment.js'>💬</span> Comment
          </td>
        </tr>
      </table>
    </td>
  </tr>`;
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
        container.innerHTML = '';
        if (data.success) {
            data.item.forEach(element => {
                container.innerHTML += `<tr class="data-block">
    <td>
      <table>
        <tr class="header">
          <td>
          <img src= ${element.userImg} alt="User Profile" />
          </td>
          <td>
            <div class="user-info">
              <span class="username">${element.name}</span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="post-content">
            This is an example post content. Here you can write about your thoughts, experiences, or anything else!
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <img src="${element.post - img}.jpg" alt="Post Image" />
          </td>
        </tr>
        <tr class="actions">
          <td class="like-button">
            <span onclick='Like()'>👍</span> Like
          </td>
          <td class="comment-button">
            <span onclick='Comment.js'>💬</span> Comment
          </td>
        </tr>
      </table>
    </td>
  </tr>`;
            });
        }
    } catch (err) {
        alert('An error occurred during fetching.' + err);
    }
}

function logout() {
    localStorage.removeItem('userToken');
    window.location.href = 'Login.php';
}