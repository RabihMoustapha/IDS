<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!--CSS-->
    <link type="text/css" href="CSS/Login.css" rel="stylesheet">

    <!--Bootstrap-->
    <link rel="icon" type="image/x-icon" href="IMG/api.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

    <!--Header-->
    <header id="nav">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <form class="d-flex" role="search" action="javascript:void(0)" method="post" onsubmit="getItem()" style="flex-grow: 1; margin-right: 10px;">
                    <input class="form-control me-2" style="cursor: not-allowed" type="search" placeholder="Search" aria-label="Search" id="searchQuery" disabled="true">
                    <button class="btn btn-outline-success" style="height: 38px" type="submit" disabled="true"><img src="IMG/search.png" style="height: 20px; width: 20px"></button>
                </form>
                <button class="btn btn-outline-danger" style="cursor: pointer" type="button" onclick="logout()" style="height: 38px;"><img src="IMG/logout.png" style="width: 20px; height: 20px;"></button>
            </div>
        </nav>
    </header>

    <!--Login form-->
    <form class="form-floating" action="javascript:void(0)" method="post" onsubmit="Login()">
        <div class="form-floating mb-3">
            <input autocomplete="email" type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
            <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input autocomplete="password" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
        <button class="btn btn-outline-success" type="submit">Login</button>
        <a href="Profile/Create.php">
            If you dont have an acoount create one
        </a>
    </form>

    <!--Scripts-->
    <script type="text/javascript" src="JS/Profile/Login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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