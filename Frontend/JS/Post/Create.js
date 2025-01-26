const post = 'http://localhost/IDS/Backend/Create/post.php';
const email = document.getElementById('email');
const title = document.getElementById('title');
const codesnippets = document.getElementById('codesnippets');
const content = document.getElementById('content');

async function Create() {
    const requestData = {
        codesnippets: codesnippets.value,
        email: email.value,
        title: title.value,
        content: content.value,
    };

    try {
        const response = await fetch(post, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(requestData),
        });

        if (!response.ok) throw new Error('Creation Failed. Server error.');

        const data = await response.json();
        if (data.success) {
            alert('Post created successfully');
            window.location.href = '../../Frontend/Home.php';
        } else {
            alert('Post creation failed. Please try again.');
            email.value = '';
            title.value = '';
            codesnippets.value = '';
            content.value = '';
        }
    } catch (err) {
        console.error('An error occurred:', err);
        alert(`An error occurred during fetching. ${err.message}`);
        email.value = '';
        title.value = '';
        codesnippets.value = '';
        content.value = '';
    }
}