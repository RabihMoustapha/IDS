<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>

    <!--CSS-->
    <link type="text/css" href="../CSS/Post.css" rel="stylesheet">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="../Images/api.png">
</head>

<body>
    <!--Header-->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="logout.php"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php" style="height: 38px;">
                                <img src="../Images/home.png" style="width: 20px; height: 20px;">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="addpost.php" style="height: 38px;">
                                <img src="../Images/plus.png" style="width: 20px; height: 20px;">
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="Delete.php">Post</a></li>
                                <li><a class="dropdown-item" href="../Profile/Delete.php">Account</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="deleteothers">Others</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="javascript:void(0)" method="get" onsubmit="getItem()" style="flex-grow: 1; margin-right: 10px;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchQuery" oninput="getItem()">
                        <button class="btn btn-outline-success" style="height: 38px;" type="submit"><img src="../Images/search.png" style="height: 20px; width: 20px"></button>
                    </form>
                    <button class="btn btn-outline-danger" type="button" onclick="logout()" style="height: 38px;"><img src="../Images/logout.png" style="width: 20px; height: 20px;"></button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Output for search results -->
    <div id="output" class="container mt-3">
        <h3>Search Results:</h3>
        <div id="results" class="row"></div>
    </div>

    <!--Adding labels-->
    <div class="container mt-5">
        <form class="row g-3 needs-validation" onsubmit="addPost(event)">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <textarea class="form-control" id="title" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <!--Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../JS/Post/AddPost.js"></script>

    <!--Footer-->
    <footer class="footer">
        <div class="footer-container">
            <p>WebApi. All rights reserved.</p>
            <ul class="footer-links">
                <li><a href="tel:+961818140764">Phone Number</a></li>
                <li><a href="mailto:mostapharabih59@gmail.com">Email</a></li>
                <li><a href="https://github.com/RabihMoustapha">GitHub</a></li>
            </ul>
        </div>
    </footer>
</body>

</html>