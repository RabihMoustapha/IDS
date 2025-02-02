<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Add Post</title>

    <!--CSS-->
    <link type='text/css' href='../CSS/Post.css' rel='stylesheet'>

    <!--Bootstrap-->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css'>
    <link rel='icon' type='image/x-icon' href='../Images/api.png'>
</head>

<body>
    <!--Header-->
    <header>
        <nav class='navbar navbar-expand-lg bg-body-tertiary'>
            <div class='container-fluid'>
                <a class='navbar-brand' href='logout.php'></a>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse'
                    data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent'
                    aria-expanded='false' aria-label='Toggle navigation'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
                        <li class='nav-item'>
                            <a class='nav-link active' aria-current='page' href='../home.php' style='height: 38px;'>
                                <img src='../Images/home.png' style='width: 20px; height: 20px;'>
                            </a>
                        </li>
                    </ul>
                    <form class='d-flex' role='search' action='javascript:void(0)' method='get' onsubmit='getItem()' style='flex-grow: 1; margin-right: 10px;'>
                        <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' id='searchQuery' disabled>
                        <button class='btn btn-outline-success' style='height: 38px;' type='submit' disabled><img src='../Images/search.png' style='height: 20px; width: 20px'></button>
                    </form>
                    <button class='btn btn-outline-danger' type='button' onclick='logout()' style='height: 38px;'><img src='../Images/logout.png' style='width: 20px; height: 20px;'></button>
                </div>
            </div>
        </nav>
    </header>

    <!--Adding labels-->
    <div class='container mt-5'>
        <form action='../../Backend/Create/post.php' method='POST' enctype='multipart/form-data'>
            <div class='mb-3'>
                <label for='email' class='form-label'>Email address</label>
                <input type='email' class='form-control' name='email' id='email' placeholder='name@example.com' required>
            </div>
            <div class='mb-3'>
                <label for='title' class='form-label'>Title</label>
                <textarea class='form-control' name='title' id='title' rows='3' required></textarea>
            </div>
            <div class='mb-3'>
                <label for='description' class='form-label'>Description</label>
                <textarea class='form-control' name='description' id='description' rows='5' required></textarea>
            </div>
            <div class='mb-3'>
                <label for='image'>Choose an image:</label>
                <input type='file' id='image' name='image' accept='image/*'>
            </div>
            <button type='submit' class='btn btn-success'>Submit</button>
        </form>
    </div>

    <!--Scripts-->
    <script type='text/javascript' src='../JS/Post/Create.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>

    <!--Footer-->
    <footer class='footer'>
        <div class='footer-container'>
            <p>WebApi. All rights reserved.</p>
            <ul class='footer-links'>
                <li><a href='tel:+961818140764'>Phone Number</a></li>
                <li><a href='mailto:mostapharabih59@gmail.com'>Email</a></li>
                <li><a href='https://github.com/RabihMoustapha'>GitHub</a></li>
            </ul>
        </div>
    </footer>
</body>

</html>