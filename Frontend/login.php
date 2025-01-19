<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!--CSS-->
    <link type="text/css" href="CSS/Login.css" rel="stylesheet">

    <!--Bootstrap-->
    <link rel="icon" type="image/x-icon" href="Images/api.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

    <!--Header-->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php" style="height: 38px;">
                                <img src="Images/home.png" style="width: 20px; height: 20px;">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="addpost.php" style="height: 38px;">
                                <img src="Images/plus.png" style="width: 20px; height: 20px;">
                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="javascript:void(0)" method="get" onsubmit="getItem()" style="flex-grow: 1; margin-right: 10px;">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchQuery" oninput="getItem()">
                        <button class="btn btn-outline-success" style="height: 38px;" type="submit"><img src="Images/search.png" style="height: 20px; width: 20px"></button>
                    </form>
                    <button class="btn btn-outline-danger" type="button" onclick="logout()" style="height: 38px;"><img src="Images/logout.png" style="width: 20px; height: 20px;"></button>
                </div>
            </div>
        </nav>
    </header>

    <!--Login form-->
    <form class="form-floating" action="javascript:void(0)" method="post" onsubmit="login()">
        <div class="form-floating mb-3">
            <input autocomplete="email" type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
            <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input autocomplete="password" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <button class="btn btn-outline-success" type="submit">Login</button>
    </form>

    <!-- Output for search results -->
    <div id="output" style="display: none;" class="container mt-3">
        <h3>Search Results:</h3>
        <div id="results" class="row"></div>
    </div>

    <!--Scripts-->
    <script type="text/javascript" src="JS/Account/Login.js"></script>

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